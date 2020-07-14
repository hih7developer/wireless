
<?php 
class Carrier_user_Model extends CI_Model
{
    
    public function get_carrier_user_by_id($id)
    {
        return $this->db->get_where('users',['user_id'=>$id])->row_array();
        // return $this->db->select("users.name as user_name, users.email as user_email, users.*, service_providers.*")->from('users')->join('service_providers', 'users.user_id = service_providers.user_id')->where('users.user_id', $user_id)->get()->row();
    }
    public function get_all_carrier_users()
    {
        return $this->db->get_where('users', ['role_id' => 3])->result();
    }
    public function update_action($id,$formArray)
    {
        $this->db->where('user_id',$id);
        $this->db->update('users',$formArray);
    }

    public function delete($id)
    {
        $this->db->delete('users',['user_id'=>$id]);
    }
    public function get_carrier_admin_by_id($user_id)
    {
        return $this->db->select("users.name as user_name, users.email as user_email, users.*, service_providers.*")->from('users')->join('service_providers', 'users.user_id = service_providers.user_id')->where('users.user_id', $user_id)->get()->row();
    }
}





?>