<?php

class ApplicationModel extends CI_Model
{
    public function seller_view_application_list($userId)
    {
        return $this->db->query("SELECT users.name as applier_name, applications.user_id as app_user_id, plans.name as plan_name,plans.user_id AS applier_plan_id,plans.tribal_plan,applications.*
        FROM applications JOIN plans ON plans.plan_id = applications.plan_id JOIN users ON users.user_id = plans.user_id
        WHERE plans.user_id=$userId ORDER BY applications.created_at DESC")->result_array();
    }
    
    
    public function all_application_list()
    {
        return $this->db->query("SELECT users.name as applier_name, applications.user_id as app_user_id, plans.name as plan_name,plans.user_id AS applier_plan_id,plans.tribal_plan,applications.*
        FROM applications INNER JOIN plans ON plans.plan_id = applications.plan_id INNER JOIN users ON users.user_id = applications.user_id ORDER BY applications.created_at DESC")->result_array();
    }
    public function get_applier_details_by_id($application_id){
        return $this->db->query("SELECT applications.*, consumers.first_name,consumers.last_name,consumers.contact_no,consumers.dob,consumers.ssn,consumers.lifeline_program,consumers.address_type,consumers.address,consumers.apt_room,consumers.city,applications.user_id AS applicant_id,users.email
        FROM consumers JOIN applications ON consumers.user_id = applications.user_id JOIN users ON users.user_id = applications.user_id
         where applications.application_id =$application_id")->row_array();
    }
    public function update_reject_application($applicationId,$reason)
    {
        $this->db->where('application_id',$applicationId);
        $this->db->update('applications',['reason'=>$reason,'status'=>'rejected','updated_at'=> date('Y-m-d H:i:s')]);
    }
    public function update_incomplete_application($applicationId,$reason)
    {
        $this->db->where('application_id',$applicationId);
        $this->db->update('applications',['reason'=>$reason,'status'=>'incomplete','updated_at'=> date('Y-m-d H:i:s')]);
    }
    public function approve_insert($applicationId,$track,$contact,$device)
    {
        $this->db->where('application_id',$applicationId);
        $this->db->update('applications',['status'=>'approved','track'=>$track,'contact_no'=>$contact,'device'=>$device,'updated_at'=>date('Y-m-d H:i:s')]);
    }
} 



?>