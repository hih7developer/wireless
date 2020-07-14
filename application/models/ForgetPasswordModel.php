<?php
 class ForgetPasswordModel extends CI_Model
 {
     public function email_check($email)
     {
        return $this->db->get_where('users',['email'=>$email ])->row();
     }
     public function match_inserted_otp($otp,$user_id)
     {
         return $this->db->get_where('forget_password',['otp'=>$otp , 'user_id'=>$user_id])->row();
     }
     public function otp_check($forget_password)
     {
        $otp_check = $this->db->get_where('forget_password',['user_id'=>$forget_password['user_id']])->row();
        
        if (empty($otp_check)){
            $this->db->insert('forget_password',$forget_password);
        }
        else{
            $this->db->where('user_id',$forget_password['user_id']);
            $this->db->update('forget_password',['otp'=>$forget_password['otp']]);
            
        }  
           
     }
     
     public function update_otp($user_id,$otp)
     {
         $this->db->where('user_id',$user_id);
         $this->db->update('forget_password',['otp'=>$otp]);
     }
   
     public function insert_new_password($id,$password)
     {
         $this->db->where('user_id',$id);
         $this->db->update('users', ['password' => md5($password)]);
     }
 }




?>