<?php
class LifelineController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LifelineModel');
        $this->load->model('user');
    }
    public function edit_sac_number()
    {
        $user_id = $this->input->post('service_provider_state_id');
		echo json_encode($this->LifelineModel->get_sac_no_by_service_provider_state_id($user_id));
    }
    public function edit_sac_number_action($id){
        $formArray=$this->input->post('service_provider_state');
        $this->LifelineModel->update_action($id,$formArray);
        $this->session->set_flashdata('success','Updated Successfully');
        redirect('lifeline');
        
    }
    public function delete($id)
    {
		$data = $this->common_data();

        $state_id = $this->db->get_where('service_provider_states', ['service_provider_state_id' => $id])->row()->state_id;
        $plan_ids = $this->db->select('plan_id, state_id')->where("FIND_IN_SET('$state_id', `state_id`)")->where('user_id', $data['user']->user_id)->get('plans')->result();
        foreach ($plan_ids as $key) {
            $states = explode(',', $key->state_id);
            if (($state_key = array_search($state_id, $states)) !== false) {
                unset($states[$state_key]);
            }
            // echo implode(',', $states);
            $this->db->update('plans', ['state_id' => implode(',', $states)], ['plan_id' => $key->plan_id]);
        }
        // die;
        $this->LifelineModel->delete($id);
        $this->session->set_flashdata('success','Deleted Successfully');
        redirect('lifeline');
    }

    public function common_data(){
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->user->get_user_by_id($user_id);

		return $data;
	}

    public function plan_check_by_state(){
        $state_id = $this->input->post('state');

		$data = $this->common_data();

        $cnt = $this->db->select('plan_id')->where("FIND_IN_SET('$state_id', `state_id`)")->where('user_id', $data['user']->user_id)->get('plans')->num_rows();

        if($cnt == 0)
            echo json_encode(['exist' => false]);
        else
            echo json_encode(['exist' => true]);
        return;
    }
}





?>