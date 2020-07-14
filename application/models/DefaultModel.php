<?php
class DefaultModel extends CI_Model
{
    public function user_view_all_plans($user_id)
    {
        return $this->db->query("SELECT service_providers.name AS service_provider,states.name AS states_name,service_types.name AS service_type,plans.* FROM plans INNER JOIN service_providers ON plans.user_id=service_providers.user_id INNER JOIN states
        ON plans.state_id=states.id INNER JOIN service_types ON plans.service_type_id=service_types.service_type_id  ")->result();
    }
    public function setting_page_insert($formArray)
    {
        $this->db->insert('settings',$formArray);
    }
    public function view_setting_page()
    {
        return $this->db->get('settings')->result();
    }
    
    public function get_setting_by_id($setting_id)
    {
        return $this->db->get_where('settings', ['setting_id' => $setting_id])->row();
    }
    public function update_action($setting_id,$formArray)
    {
        $this->db->where('setting_id',$setting_id);
        $this->db->update('settings',$formArray);      

    }
    public function delete($setting_id)
    {
        $this->db->delete('settings',['setting_id'=>$setting_id]);
    }
}



?>