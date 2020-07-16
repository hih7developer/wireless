<?php

class Plan extends CI_Model
{

    public function get_all_service_types()
    {
        return $this->db->get('service_types')->result();
    }

    public function insert_plan_details($plan)
    {
        $this->db->insert('plans', $plan);
    }

    public function get_plans_by_carrier_admin($user_id)
    {
        return $this->db->select('plans.name as plan_name, plans.*, service_types.name as service_type_name, service_types.*')->from('plans')->join('service_types', 'service_types.service_type_id = plans.service_type_id')->where(['user_id' => $user_id, 'plans.is_deleted' => 0])->get()->result();
    }

    public function get_plan_count($user_id = NULL)
    {
        if ($user_id == NULL)
            return $this->db->get_where('plans', ['plans.is_deleted' => 0])->num_rows();

        return $this->db->get_where('plans', ['user_id' => $user_id, 'plans.is_deleted' => 0])->num_rows();
    }


    // public function get_plan_count(){
    //     return $this->db->get_where('plans',['plans.is_deleted' => 0])->num_rows();
    // }


    public function get_all_plans_by_id($user_id)
    {
        return $this->db->select("states.name as state,service_types.name as service,plans.*")->from('plans')->join('service_types', 'plans.service_type_id = service_types.service_type_id')->join('states', 'states.id=plans.state_id')->where(['user_id' => $user_id, 'plans.is_deleted' => 0])->get()->result();
        //    return $this->db->query("SELECT states.name as state,service_types.name as service,plans.* FROM `plans` INNER JOIN service_types ON plans.service_type_id=service_types.service_type_id INNER JOIN `states` ON plans.state_id=states.id where plans.user_id = $user_id")->result();

    }

    public function display_plan_details($plan_id)
    {
        return $this->db->get_where('plans', ['plan_id' => $plan_id])->row();
    }

    public function update_plan_details($plan_id, $formArray)
    {
        $formArray['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('plan_id', $plan_id);
        $this->db->update('plans', $formArray);
    }

    public function delete_pan($plan_id)
    {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $data['is_deleted'] = 1;

        $this->db->update('plans', $data, ['plan_id' => $plan_id]);
    }

    public function get_service_provider_filtered_states($user_id)
    {
        $service_provider_id = $this->db->get_where('service_providers', ['user_id' => $user_id])->row()->service_provider_id;
        $service_provider_states = $this->db->get_where('service_provider_states', ['service_provider_id' => $service_provider_id])->result();
        if (count($service_provider_states) != 0)
            return $states = $this->db->where_not_in('id', array_column($service_provider_states, 'state_id'))->get('states')->result();
        else
            return $this->db->get('states')->result();
    }

    public function get_service_provider_states_by_user_id($user_id)
    {
        $service_provider_id = $this->db->get_where('service_providers', ['user_id' => $user_id])->row()->service_provider_id;
        return $this->db->select('*')->from('service_provider_states')->join('states', 'states.id = service_provider_states.state_id')->where(['service_provider_id' => $service_provider_id])->get()->result();
    }


    public function get_service_provider_states()
    {
        $provider_states = $this->db->distinct()->select('state_id')->from('service_provider_states')->join('service_providers', 'service_provider_states.service_provider_id = service_providers.service_provider_id')->join('users', 'users.user_id = service_providers.user_id')->where('users.status', 1)->get()->result();
        if (empty($provider_states))
            return array();
        $provider_states = array_column($provider_states, 'state_id');
        return $this->db->where_in('id', $provider_states)->get('states')->result();
    }

    public function insert_service_provider($service_provider_state)
    {
        $this->db->insert('service_provider_states', $service_provider_state);
    }

    public function get_plans_by_state_id($state_id)
    {
        return $this->db->select('service_types.name as service, plans.name as plan_name, service_providers.name as service_provider_name, plans.*, service_types.*, service_providers.*')->from('plans')->join('service_types', 'plans.service_type_id = service_types.service_type_id')->join('service_providers', 'plans.user_id = service_providers.user_id')->where("FIND_IN_SET('$state_id', `state_id`)")->get()->result();
    }


    public function get_plans_by_state_id_and_tribal($state_id, $tribal)
    {
        return $this->db
            ->select('service_types.name as service, plans.name as plan_name, service_providers.name as service_provider_name, plans.*, service_types.*, service_providers.*')
            ->from('plans')
            ->join('service_types', 'plans.service_type_id = service_types.service_type_id')
            ->join('service_providers', 'plans.user_id = service_providers.user_id')
            ->join('payment_methods', 'payment_methods.user_id = plans.user_id')
            ->where("FIND_IN_SET('$state_id', `state_id`)")
            ->where(['tribal_plan' => $tribal])
            ->where(['is_active' => 1])
            ->where(['payment_methods.is_validated' => 1])
            ->where(['service_providers.nlad_verified' => 1])
            ->get()->result();
    }

    public function get_plans_by_state_id_load_more($state_id, $tribal, $offset)
    {
        return $this->db
            ->select('service_types.name as service, plans.name as plan_name, service_providers.name as service_provider_name, plans.*, service_types.*, service_providers.*')
            ->from('plans')
            ->join('service_types', 'plans.service_type_id = service_types.service_type_id')
            ->join('service_providers', 'plans.user_id = service_providers.user_id')
            ->join('payment_methods', 'payment_methods.user_id = plans.user_id')
            ->where("FIND_IN_SET('$state_id', `state_id`)")
            ->where(['tribal_plan' => $tribal])
            ->where(['is_active' => 1])
            ->where(['payment_methods.is_validated' => 1])
            ->where(['service_providers.nlad_verified' => 1])
            ->limit(1, $offset)
            ->get()->result();
    }

    public function get_plans_by_state_id_and_carrier_admin($state_id, $user_id)
    {
        return $this->db->select('service_types.name as service, plans.name as plan_name, service_providers.name as service_provider_name, plans.*, service_types.*, service_providers.*')->from('plans')->join('service_types', 'plans.service_type_id = service_types.service_type_id')->join('service_providers', 'plans.user_id = service_providers.user_id')->where("FIND_IN_SET('$state_id', `state_id`)")->where(['plans.user_id' => $user_id])->get()->result();
    }

    public function get_all_plans_voices()
    {
        $plans = $this->db->get('plans')->result();
        $result = [];
        foreach (array_column($plans, 'voice') as $key) {
            array_push($result, json_decode($key)->value);
        }

        return array_unique($result);
    }

    public function get_all_plans_sms()
    {
        $plans = $this->db->get('plans')->result();
        $result = [];
        foreach (array_column($plans, 'sms') as $key) {
            array_push($result, json_decode($key)->value);
        }

        return array_unique($result);
    }


    public function get_all_plans_data()
    {
        $plans = $this->db->get('plans')->result();
        $result = [];
        foreach (array_column($plans, 'data') as $key) {
            array_push($result, json_decode($key)->value);
        }

        return array_unique($result);
    }

    public function voice_percentage($voice)
    {
        $voices = $this->plan->get_all_plans_voices();

        if (($key = array_search('Unlimited', $voices)) !== false) {
            unset($voices[$key]);
        }

        if (empty($voices))
            return 100;

        $max = max($voices);

        switch (strtolower($voice)) {
            case 'unlimited':
                $percentage = 100;
                break;

            case $max:
                $percentage = 90;
                break;

            default:
                $percentage = ($voice * 90) / $max;
                break;
        }

        return $percentage;
    }


    public function sms_percentage($sms)
    {
        $smss = $this->plan->get_all_plans_sms();

        if (($key = array_search('Unlimited', $smss)) !== false) {
            unset($smss[$key]);
        }

        if (empty($smss))
            return 100;

        $max = max($smss);

        switch (strtolower($sms)) {
            case 'unlimited':
                $percentage = 100;
                break;

            case $max:
                $percentage = 90;
                break;

            default:
                $percentage = ($sms * 90) / $max;
                break;
        }

        return $percentage;
    }

    public function data_percentage($data, $type)
    {
        $plans = $this->db->get('plans')->result();
        $result = [];
        foreach (array_column($plans, 'data') as $key) {
            if (json_decode($key)->type == 'mb') {
                if (strtolower(json_decode($key)->value) != 'unlimited')
                    array_push($result, round(json_decode($key)->value / 1024, 2));
                else
                    array_push($result, json_decode($key)->value);
            } else {
                array_push($result, json_decode($key)->value);
            }
        }

        $datas = array_unique($result);

        if (($key = array_search('Unlimited', $datas)) !== false) {
            unset($datas[$key]);
        }

        $max = max($datas);

        if (strtolower($data) != 'unlimited') {
            if ($type == 'mb') {
                $data = round($data / 1024, 2);
            }
        }

        switch (strtolower($data)) {
            case 'unlimited':
                $percentage = 100;
                break;

            case $max:
                $percentage = 90;
                break;

            default:
                $percentage = ($data * 90) / $max;
                break;
        }

        return $percentage;
    }
}
