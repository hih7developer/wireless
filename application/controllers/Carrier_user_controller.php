<?php

class Carrier_user_controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Carrier_user_Model');
        $this->load->model('user');
    }
 
    public function carrier_user_list()
    {
		$this->login_check();
		$this->role_block([1,2]);

		$data = $this->common_data();
		$data['carrier_users'] = $this->Carrier_user_Model->get_all_carrier_users();
		
		$this->load->view('carrier_user_list', $data);
    }
    

    public function edit()
    {

        // $data['UserDetails']=$this->Carrier_user_Model->get_carrier_user_by_id($user_id);
        // $this->load->view('edit',$data);

        
        $user_id = $this->input->post('user_id');
		echo json_encode($this->Carrier_user_Model->get_carrier_user_by_id($user_id));
       
        // echo json_encode($data);
        
    }
   
    public function delete($id)
    {
        $this->Carrier_user_Model->delete($id);

    }

    public function common_data(){
        $user_id = $this->session->userdata('user_id');
        $data['user'] = $this->user->get_user_by_id($user_id);
        return $data;
    }

    public function edit_carrier_user_action($id){
        $formArray=$this->input->post('carrier_user');
        $this->Carrier_user_Model->update_action($id,$formArray);
    }

    public function carrier_admin_details($user_id)
    {
        $this->login_check();
		$this->role_block([1,2]);

		$data = $this->common_data();
		$data['carrier_admin'] = $this->Carrier_user_Model->get_carrier_admin_by_id($user_id);
		
		$this->load->view('carrier_admin_details', $data);
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

}

?>
