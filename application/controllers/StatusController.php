<?php
class StatusController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->model('user');
    }
   
    public function status_view()

    {
        if(!$this->session->userdata('userId'))
        return redirect('login');

        $userId=$this->session->userdata('userId');
        $data['carrier_admins']=$this->UserModel->view($userId);
    
    }
    public function edit($id)
    {
        
        $id=$this->input->post('user_id');
        $data['fetchData']=$this->UserModel->view($id);
        // $data = $this->common_data();
        echo json_encode($data);
        // $this->load->view('edit-profile',$data);
    }
   
    public function delete($id)
    {
        $this->UserModel->delete($id);

    }

    public function common_data(){
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->user->get_user_by_id($user_id);
        return $data;
    }

    public function get_edit_data()
    {
        $id=$this->input->post('user_id');
        $data= $this->UserModel->view();
        echo json_encode($data);

    }
    public function edit_carrier_admin_action($id){
        $formArray=$this->input->post('carrier_admin');
        $this->UserModel->update_action($id,$formArray);
    }



    
}





?>