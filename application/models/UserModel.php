<?php 
class UserModel extends CI_Model
{
    public function view($id)
    {
        return $this->db->get_where('users',['user_id'=>$id])->row_array();
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
}





?>