<?php
defined('BASEPATH') or exit('No direct script access allowed');


require_once('./vendor/autoload.php');

use Postmark\PostmarkClient;

class PlanController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->load->model('plan');
		$this->load->model('payment');
		$this->load->library('form_validation');
	}

	public function login_check()
	{
		if (!$this->session->userdata('user_id'))
			redirect('login');
	}

	public function role_block($roles)
	{
		$data = $this->common_data();

		if (!in_array($data['user']->role_id, $roles))
			redirect('dashboard');
	}

	public function common_data()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->user->get_user_by_id($user_id);

		return $data;
	}

	public function view_plans()
	{
		$this->login_check();
		$this->role_block([1, 2]);

		$data = $this->common_data();
		$data['plans'] = $this->plan->get_plans_by_carrier_admin($this->session->userdata('user_id'));
		$data['states'] = $this->plan->get_service_provider_states_by_user_id($data['user']->user_id);


		$this->load->view('plan_lists', $data);
	}

	public function create_plan()
	{
		$this->login_check();
		$this->role_block([1, 2]);


		$data = $this->common_data();
		$data['service_types'] = $this->plan->get_all_service_types();
		$data['states'] = $this->plan->get_service_provider_states_by_user_id($data['user']->user_id);
		$data['plan_voices'] = $this->plan->get_all_plans_voices();
		$data['plan_sms'] = $this->plan->get_all_plans_sms();
		$data['plan_data'] = $this->plan->get_all_plans_data();
		$this->load->view('create_plan', $data);
	}

	public function create_plan_action()
	{
		$this->login_check();
		$this->role_block([1, 2]);

		$data = $this->common_data();

		$plan = $this->input->post('plan');

		$plan['state_id'] = implode(',', $plan['state_id']);



		$plan['file'] = $this->upload_file();
		$plan['user_id'] = $this->session->userdata('user_id');
		$plan['voice'] = json_encode($plan['voice']);

		// echo '<pre>';
		// print_r($plan['voice']);die;


		$plan['data'] = json_encode($plan['data']);
		$plan['sms'] = json_encode($plan['sms']);



		$this->plan->insert_plan_details($plan);

		$mail['email'] = $this->db->get_where('users', ['user_id' => 1])->row()->email;
		$mail['template_id'] = 17919109;
		$mail['details'] = [
			"name" => $this->db->get_where('users', ['user_id' => $this->session->userdata('user_id')])->row()->name,
			"plan_url" => base_url('login'),
		];

		$this->postmark($mail);

		$this->session->set_flashdata('success', 'Your plan has been created successfully');
		redirect("plan/create");
	}

	public function upload_file()
	{

		$config['upload_path']          = './uploads/';
		$config['allowed_types']          = '*';
		$config['encrypt_name']          = true;
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('file'))
			return $this->upload->data()['file_name'];
	}

	public function view_plans_by_carrier_admin($user_id)
	{
		$this->login_check();

		$data = $this->common_data();
		$data['fetch_plan'] = $this->plan->get_all_plans_by_id($user_id);
		$this->load->view('view_plans_by_carrier_admin', $data);

		// echo $this->db->last_query();

	}

	public function edit_plans_by_carrier_admin($plan_id)
	{
		$this->login_check();

		$data = $this->common_data();
		$data['plan'] = $this->plan->display_plan_details($plan_id);
		$data['service_types'] = $this->plan->get_all_service_types();
		$data['states'] = $this->plan->get_service_provider_states_by_user_id($data['plan']->user_id);
		$data['plan_voices'] = $this->plan->get_all_plans_voices();
		$data['plan_sms'] = $this->plan->get_all_plans_sms();
		$data['plan_data'] = $this->plan->get_all_plans_data();

		$this->load->view('edit_create_plan', $data);
	}

	public function edit_plans_by_carrier_admin_action($plan_id)
	{
		$plan = $this->input->post('plan');
		$plan['state_id'] = implode(',', $plan['state_id']);
		$plan['voice'] = json_encode($plan['voice']);
		$plan['data'] = json_encode($plan['data']);
		$plan['sms'] = json_encode($plan['sms']);


		if ($_FILES['file']['error'] == 0) {
			$prev_img = $this->db->get_where('plans', ['plan_id' => $plan_id])->row()->file;
			$plan['file'] = $this->upload_file();
			unlink(FCPATH . 'uploads/' . $prev_img);
		}

		$this->plan->update_plan_details($plan_id, $plan);
		$this->session->set_flashdata('success', 'Your profile has been updated successfully');
		return redirect("plan/edit/" . $plan_id);
	}

	public function delete_plan($plan_id)
	{
		$this->login_check();
		$this->role_block([2]);

		$this->plan->delete_pan($plan_id);

		$this->session->set_flashdata('success', 'Successfully deleted');
		redirect('plans');
	}

	public function lifeline()
	{
		$this->login_check();
		$this->role_block([2]);

		$data = $this->common_data();
		$data['service_provider_filtered_states'] = $this->plan->get_service_provider_filtered_states($data['user']->user_id);
		$data['service_provider_states'] = $this->plan->get_service_provider_states_by_user_id($data['user']->user_id);
		$data['service_provider'] = $this->db->get_where('service_providers', ['user_id' => $data['user']->user_id])->row();

		$this->load->view('lifeline', $data);
	}

	public function add_service_provider_state()
	{
		$this->form_validation->set_rules('service_provider_state[sac]', 'sac', 'is_unique[service_provider_states.sac]');

		if ($this->form_validation->run() == false) {

			$this->session->set_flashdata('error', 'Sac number already exist, Please try another one');
			return redirect('lifeline');
		}
		$service_provider_state = $this->input->post('service_provider_state');
		$data = $this->common_data();

		$service_provider_state['service_provider_id'] = $this->user->get_carrier_admin_by_id($this->session->userdata('user_id'))->service_provider_id;

		$this->plan->insert_service_provider($service_provider_state);

		$this->session->set_flashdata('success', 'Successfully added');
		redirect('lifeline');
	}

	public function search_plans($state_id)
	{
		$this->login_check();
		$this->role_block([4]);

		$data = $this->common_data();

		$zip =  $this->db->get_where('consumers', ['user_id' => $data['user']->user_id])->row()->zip;

		$tribal = $this->db->get_where('zipcodes', ['zipcode' => $zip])->row()->tribal;

		$data['plans'] = $this->plan->get_plans_by_state_id_load_more($state_id, $tribal, 0);

		$data['total_plans'] = count($this->plan->get_plans_by_state_id_and_tribal($state_id, $tribal));

		$data['state'] = $this->user->get_state_by_state_id($state_id);

		$this->load->view('search_plans', $data);
	}

	public function nlad()
	{

		$url = 'https://nlad.universalservice.org/svc/1/verify/';
		$username = '0g@vkmzp9kmsau3kfnw6.ajmfdfiztgd';
		$password = '__$LQna5oi6~($^I^J)z2~-(yc$I8!_t';

		$credential = ['Username' => '0g@vkmzp9kmsau3kfnw6.ajmfdfiztgd', 'Password' => '__$LQna5oi6~($^I^J)z2~-(yc$I8!_t'];
		// this is only part of the data you need to sen
		$customer_data = array(
			"transactionType" => "enroll",
			"transactionEffectiveDate" => "02/25/2020",
			"sac" => "439038",
			"lastName" => "Melton",
			"firstName" => "Chris",
			"middleName" =>  "",
			"phoneNumber" => "4799313187",
			"phoneNumberInNlad" => "",
			"last4ssn" => "9833",
			"tribalId" => "",
			"dob" => "10/30/1980",
			"serviceType" => "BundledVoiceBroadband",
			"iehFlag" => "",
			"iehCertificationDate" => "",
			"iehRecertificationDate" => "",
			"primaryAddress1" => "12012 S 36th West Ave",
			"primaryAddress2" => "",
			"primaryCity" => "Sapupla",
			"primaryState" => "OK",
			"primaryZipCode" => "74066",
			"primaryUrbanizationCode" => "",
			"primaryPermanentAddressFlag" => "",
			"primaryTribalFlag" => "",
			"primaryRuralFlag" => "",
			"mailingAddress1" => "",
			"mailingAddress2" => "",
			"mailingCity" => "",
			"mailingState" => "",
			"mailingZipCode" => "",
			"mailingUrbanizationCode" => "",
			"serviceInitializationDate" => date('m/d/Y'),
			"serviceReverificationDate" => "",
			"eligibilityCode" => "E2",
			"bqpLastName" => "",
			"bqpFirstName" => "",
			"bqpMiddleName" => "",
			"bqpDob" => "",
			"bqpLast4ssn" => "",
			"bqpTribalId" => "",
			"linkUpServiceDate" => "",
			"lifelineTribalBenefitFlag" => "0",
			"etcGeneralUse" => "",
			"tpivFlag" => ""
		);
		// As per your API, the customer data should be structured this way
		//$data = array("customer" => $customer_data);
		// And then encoded as a json string
		// echo '<pre>';
		$data_string = json_encode($customer_data);
		// echo '</pre>';
		$ch = curl_init($url);
		// die;

		/*curl_setopt_array($ch, array(
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_HEADER => true,
        CURLOPT_HTTPHEADER => array('Content-Type:application/json','Authorization: Basic '.$credential.', Content-Length: ' . strlen($data_string))
        ));
        */
		$header = array('Content-Type:application/json', 'Authorization: Basic ' . $credential, 'Content-Length: ' . strlen($data_string));

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//  curl_setopt($ch,CURLOPT_POST,count($f));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		$result = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($result, true);

		print_r($data);
	}

	public function sort_plan_carrier_admin()
	{
		$state_id = $this->input->post('state_id');
		$data = $this->common_data();
		$data['plans'] = $this->plan->get_plans_by_state_id_and_carrier_admin($state_id, $data['user']->user_id);

		$this->load->view('template_part/carrier_admin_plan_list_table', $data);
	}

	public function load_more_plan()
	{
		$offset = $this->input->post('offset');
		$this->sort_plan_consumer($offset);
	}

	public function sort_plan_consumer($offset = 0)
	{
		$state_id = $this->session->userdata('state_id');


		// data sorting
		$sort_data = $this->input->post('sort_data');

		$sort_data = explode(' ', $sort_data);

		$sort_data = $this->plan->data_percentage($sort_data[0], isset($sort_data[1]) ? strtolower($sort_data[1]) : 'gb');


		$data = $this->common_data();

		$zip =  $this->db->get_where('consumers', ['user_id' => $data['user']->user_id])->row()->zip;

		$tribal = $this->db->get_where('zipcodes', ['zipcode' => $zip])->row()->tribal;

		$plans = $this->plan->get_plans_by_state_id_and_tribal($state_id, $tribal);

		$sorted_data_plans = [];

		if ($sort_data != 100) {
			foreach ($plans as $key) {
				$plan_data = json_decode($key->data);
				$plan_data_percentage = $this->plan->data_percentage(strtolower($plan_data->value), $plan_data->type);
				if ($sort_data >= $plan_data_percentage && $plan_data_percentage <= 90) {
					array_push($sorted_data_plans, $key);
				}
			}
		} else if ($sort_data == 100) {
			$sorted_data_plans = $plans;
		}

		// data sorting end


		// sms sorting

		$sort_sms = $this->input->post('sort_sms');

		$sort_sms = $this->plan->sms_percentage($sort_sms);

		$sorted_sms_plans = [];

		if ($sort_sms != 100) {
			foreach ($sorted_data_plans as $key) {
				$plan_sms = json_decode($key->sms);
				$plan_sms_percentage = $this->plan->sms_percentage($plan_sms->value);
				if ($sort_sms >= $plan_sms_percentage && $plan_sms_percentage <= 90) {
					array_push($sorted_sms_plans, $key);
				}
			}
		} else if ($sort_sms == 100) {
			$sorted_sms_plans = $sorted_data_plans;
		}


		// sms sorting end



		// voice sorting

		$sort_voice = $this->input->post('sort_voice');

		$sort_voice = $this->plan->voice_percentage($sort_voice);

		$sorted_voice_plans = [];

		if ($sort_voice != 100) {
			foreach ($sorted_sms_plans as $key) {
				$plan_voice = json_decode($key->voice);
				$plan_voice_percentage = $this->plan->voice_percentage($plan_voice->value);
				if ($sort_voice >= $plan_voice_percentage && $plan_voice_percentage <= 90) {
					array_push($sorted_voice_plans, $key);
				}
			}
		} else if ($sort_voice == 100) {
			$sorted_voice_plans = $sorted_sms_plans;
		}

		// voice sorting end



		$sorted_plans = $sorted_voice_plans;

		// print_r($sorted_sms_plans);die;


		$data['plans'] = array_slice($sorted_plans, $offset, 1);

		$result['plan_view'] = $this->load->view('template_part/consumer_plan_row', $data, true);
		$result['total_plan'] = count($sorted_plans);

		echo json_encode($result);
	}

	public function update_active_plan($plan_id)
	{
		$active = $this->input->post('active');
		$this->db->update('plans', ['is_active' => $active], ['plan_id' => $plan_id]);
	}

	public function postmark($data = NULL)
	{
		$client = new PostmarkClient($this->config->item('postmark_token'));

		$sendResult = $client->sendEmailWithTemplate(
			"notifications@wirelessmatchup.com",
			$data['email'],
			$data['template_id'],
			$data['details']
		);
	}
}