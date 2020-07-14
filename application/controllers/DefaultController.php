<?php


require_once('./vendor/autoload.php');
use Postmark\PostmarkClient;


class DefaultController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user');
        $this->load->model('DefaultModel');
    }
    public function get_all_plans()
    {
        $this->login_check();
        $this->role_block([1]);
        $data= $this->common_data();

        $data['plans']=$this->DefaultModel->user_view_all_plans($data['user']->user_id);
        $this->load->view('all_plans',$data);
    }
    // public function setting_page_view()
    // {
    //     // $this->login_check();
    //     // $this->role_block([2]);
        
    //     
    // }
    public function setting_page_insert()
    {
        $data= $this->common_data();
        $formArray = $this->input->post('setting');
        $this->DefaultModel->setting_page_insert($formArray);
        redirect('settings',$data);
    }
    public function setting_page_view()
    {
        $data= $this->common_data();
        $data['settings']=$this->DefaultModel->view_setting_page();
        // redirect('settings',$data);
        $this->load->view('setting',$data);
    }
    public function update_view_setting_page()
    {
        $setting_id = $this->input->post('setting_id');
        echo json_encode($this->DefaultModel->get_setting_by_id($setting_id));
      
    }
    
    public function update_view_setting_page_action()
    {
        echo $setting_id = $this->input->post('setting_id');
        $formArray=$this->input->post('setting');
        $this->DefaultModel->update_action($setting_id,$formArray);
        return redirect("settings");
    }
    public function delete($setting_id)
    {
        $this->DefaultModel->delete($setting_id);
        return redirect('settings');
    }

    public function login_check(){
        if(!$this->session->userdata('user_id'))
            redirect('login');
    }

    public function role_block($roles){
        $data = $this->common_data();
        
        if(!in_array($data['user']->role_id, $roles))
            redirect('dashboard');
    }

    public function common_data(){
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->user->get_user_by_id($user_id);

        return $data;
    }
    public function postmark($data = NULL){
        $client = new PostmarkClient("e5c84c83-d809-49f3-b0a5-8fee05e84b12");

        // Send an email:
        $sendResult = $client->sendEmail(
          "notifications@wirelessmatchup.com",
          "sjgalaxy98@gmail.com",
          "Hello from Postmark!",
          "This is just a friendly 'hello' from your friends at Postmark."
        );
        
    }
}




?>