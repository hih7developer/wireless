<?php

class User extends CI_Model {

    public function login_check($user){
        return $this->db->get_where('users', ['email' => $user['email'], 'password' => md5($user['password'])])->row();
    }

    public function get_user_by_id($user_id){
        return $this->db->get_where('users', ['user_id' => $user_id])->row();
    }
    
    public function get_user_by_email($email){
        return $this->db->get_where('users', ['email' => $email])->row();
    }

    public function user_check($email){
        $user = $this->db->get_where('users', ['email' => $email])->num_rows();

        if($user == 0)
            return true;
        return false;
    }
    
    public function consumer_check($email){
        $user = $this->db->get_where('users', ['email' => $email])->num_rows();

        if($user == 0)
            return false;

        $user = $this->db->get_where('users', ['email' => $email, 'role_id' => 4])->num_rows();

        if($user == 0)
            return 'user exist with another role';

        return true;
    }

    public function zip_code_check($state_id, $zip)
    {
        $zip_code_check = $this->db->select('*')->from('states')->join('zipcodes', 'states.code = zipcodes.state')->where(['zipcodes.zipcode' => $zip, 'states.id' => $state_id])->get()->row();

        if(empty($zip_code_check)){
            return false;
        }
        return true;

    }
    public function tribal_check($zip)
    {
        return $this->db->get_where('zipcodes',['zipcode'=>$zip])->row()->tribal;
       
    }

    public function get_consumer_by_id($user_id){
        return $this->db->get_where('consumers', ['user_id' => $user_id])->row();
    }

    public function insert_carrier_admin($user){
        $user['password'] = md5($user['password']);
        $this->db->insert('users', $user);
    }
    
    public function insert_user($user){
        $user['password'] = md5($user['password']);
        $this->db->insert('users', $user);
    }

    public function get_all_carrier_admins(){
        return $this->db->select("users.name as user_name, users.email as user_email, users.*, service_providers.*")->from('users')->join('service_providers', 'users.user_id = service_providers.user_id')->where('users.role_id', 2)->get()->result();
    }

    public function get_carrier_admin_count(){
        return $this->db->get_where('users', ['users.role_id' => 2])->num_rows();

    }
    
    public function get_carrier_user_count(){
        return $this->db->get_where('users', ['users.role_id' => 3])->num_rows();
    }

    public function get_carrier_user_count_by_service_provider_id($user_id){
        $service_provider_id = $this->db->get_where('service_providers', ['user_id' => $user_id])->row()->service_provider_id;

        return $this->db->select('*')->from('users')->join('carrier_users', 'carrier_users.user_id = users.user_id')->where(['carrier_users.service_provider_id' => $service_provider_id])->get()->num_rows();
    }

    public function get_buyer_count(){
        return $this->db->get_where('users', ['users.role_id' => 4])->num_rows();
    }
    
    public function get_all_carrier_users(){
        return $this->db->get_where('users', ['role_id' => 3])->result();
    }
    
    public function get_carrier_users_by_carrier_admin(){
        $carrier_admin = $this->get_carrier_admin_by_id($this->session->userdata('user_id'));
		return $this->db->select('*')->from('users')->join('carrier_users', 'users.user_id = carrier_users.user_id')->where(['carrier_users.service_provider_id' => $carrier_admin->service_provider_id])->get()->result();
    }
    
    public function get_all_service_providers(){
        return $this->db->get('service_providers')->result();
    }

    public function update_user_where_id($user_id, $data){
        $data['updated_at'] = date('Y-m-d H:i:s');
		return $this->db->update('users', $data, ['user_id' => $user_id]);
    }
    

    public function update_consumer_shipping_address_check($consumer_id, $data){
        $data['updated_at'] = date('Y-m-d H:i:s');
		return $this->db->update('consumer', $data, ['consumer_id' => $consumer_id]);
    }

    public function update_consumer_where_id($user_id, $data){
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['dob'] = date('Y-m-d', strtotime($data['dob']));
        if(isset($data['contact_no']))
            $data['contact_no'] = str_replace(' ','',$data['contact_no']);
		return $this->db->update('consumers', $data, ['user_id' => $user_id]);
    }

    public function update_service_provider_where_user_id($user_id, $data){
        $data['updated_at'] = date('Y-m-d H:i:s');
		return $this->db->update('service_providers', $data, ['user_id' => $user_id]);
    }

    public function insert_service_provider($data){
        $this->db->insert('service_providers', $data);
    }

    public function get_states(){
        return $this->db->get('states')->result();
    }

    public function get_carrier_admin_by_id($user_id){
        return $this->db->select("users.name as user_name, users.email as user_email, users.*, service_providers.*")->from('users')->join('service_providers', 'users.user_id = service_providers.user_id')->where('users.user_id', $user_id)->get()->row();
    }

    public function get_state_by_state_id($state_id){
        return $this->db->get_where('states', ['id' => $state_id])->row();
    }

    public function is_password_updated_consumer($user_id){
        $password_updated = $this->db->get_where('consumers', ['user_id' => $user_id])->row()->password_updated;

        if($password_updated == 0)
            return false;
        return true;
    }

    public function get_nlad_cred($data){
        if(isset($data['plan_id'])){
            $user_id = $this->db->get_where('plans', ['plan_id' => $data['plan_id']])->row()->user_id;
        } else if(isset($data['user_id'])){
            $user_id = $data['user_id'];
        }
        $service_provider = $this->db->get_where('service_providers', ['user_id' => $user_id])->row();
        
        if($service_provider->nlad_verified == 0){
            return false;
        }
        else{
            $cred['username'] = $service_provider->nlad_username;
            $cred['password'] = $service_provider->nlad_password;
            return $cred;
        }
    }

    public function update_service_provider_is_nlad_verified($data){
        if(isset($data['plan_id'])){
            $user_id = $this->db->get_where('plans', ['plan_id' => $data['plan_id']])->row()->user_id;
        } else if(isset($data['user_id'])){
            $user_id = $data['user_id'];
        }

        $this->db->update('service_providers', ['nlad_verified' => 0, 'updated_at' => date('Y-m-d H:i:s')], ['user_id' => $user_id]);
    }


}