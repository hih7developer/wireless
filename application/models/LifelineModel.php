<?php

class LifelineModel extends CI_Model
{
    public function get_sac_no_by_service_provider_state_id($id)
    {
        return $this->db->get_where('service_provider_states',['service_provider_state_id'=>$id])->row_array();
    }
    public function update_action($id,$formArray)
    {
        $this->db->where('service_provider_state_id',$id);
        $this->db->update('service_provider_states',$formArray);
    }
    public function delete($id)
    {
        $this->db->delete('service_provider_states',['service_provider_state_id'=>$id]);
    }
}


?>