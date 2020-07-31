<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NladController extends CI_Controller
{

	// public $username = '02q7.yl.c_6aeq9kd@gws.tkugdedqck';
	public $username = '30xur5ew1yl@8vxikvd3i4nlnqhe.jks';
	// public $password = 'h$3!8z-f@$_S5@*(y36^@5!)!_O_)g*V';
	public $password = '!!T892Aa)7^=s8(-_=-(T240^@!)-6$z';
	public $url = 'https://api.universalservice.org/svc/1/verify/';
	public $nv_url = 'https://api.universalservice.org/nvca-svc/consumer/eligibility-check/';


	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->load->model('plan');
	}


	public function check($user_id)
	{

		$consumer = $this->user->get_consumer_by_id($user_id);

		$dob = date('m/d/Y');

		// this is only part of the data you need to send
		$customer_data = array(
			"transactionType" => "enroll",
			"transactionEffectiveDate" => "02/25/2020",
			"sac" => "439038",
			"lastName" => "$consumer->last_name",
			"firstName" => "$consumer->first_name",
			"middleName" =>  "",
			"phoneNumber" => "$consumer->contact_no",
			"phoneNumberInNlad" => "",
			"last4ssn" => "$consumer->ssn",
			"tribalId" => "",
			"dob" => date('m/d/Y', strtotime($consumer->dob)),
			"serviceType" => "BundledVoiceBroadband",
			"iehFlag" => "",
			"iehCertificationDate" => "",
			"iehRecertificationDate" => "",
			"primaryAddress1" => "$consumer->address",
			"primaryAddress2" => "",
			"primaryCity" => "$consumer->city",
			"primaryState" => $this->user->get_state_by_state_id($consumer->state_id)->code,
			"primaryZipCode" => "$consumer->zip",
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
			"tpivFlag" => "",
			"repId" => Null,
			"repNotAssisted" => 1,
		);
		// As per your API, the customer data should be structured this way

		// echo '<pre>';
		// print_r($customer_data);
		// echo '</pre>';

		$data_string = json_encode($customer_data);
		$header = array('Content-Type:application/json');

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);

		$result = curl_exec($ch);
		curl_close($ch);

		$data = json_decode($result, true);

		// echo '<pre>';
		// print_r($data);die;

		if (isset($data['header']['failureType'])) {
			$this->session->set_flashdata('error', $data['body']);
		}

		redirect('consumer/profile/');
		// redirect('aplication/eligibility_check/'.$plan_id);
	}

	public function update_nlad_cred()
	{
		$username = $this->input->post('nlad_username');
		$password = $this->input->post('nlad_password');

		$user_id = $this->session->userdata('user_id');

		$this->db->update('service_providers', ['nlad_username' => $username, 'nlad_password' => $password], ['user_id' => $user_id]);

		$this->session->set_flashdata('success', 'Nlad Credentials are updated');

		redirect('lifeline');
	}


	public function verify_check()
	{

		$user_id = $this->session->userdata('user_id');
		$service_provider = $this->db->get_where('service_providers', ['user_id' => $user_id])->row();

		$username = $service_provider->nlad_username;
		$password = $service_provider->nlad_password;
		$current_date = date('m') . "/" . (date("d") - 1) . "/" . date('Y');

		// this is only part of the data you need to send
		$customer_data = array(
			"transactionType" => "enroll",
			"transactionEffectiveDate" => "$current_date",
			"sac" => "123456",
			"lastName" => "DOE",
			"firstName" => "JOHN",
			"middleName" => "Wayne",
			"phoneNumber" => "5555555555",
			"phoneNumberInNlad" => "",
			"last4ssn" => "1234",
			"tribalId" => "1234abcd",
			"dob" => "04/21/1966",
			"serviceType" => "Voice",
			"iehFlag" => "1",
			"iehCertificationDate" => "09/01/2012",
			"iehRecertificationDate" => "12/12/2012",
			"primaryAddress1" => "175 E 196TH ST",
			"primaryAddress2" => "APT 1138",
			"primaryCity" => "NEW YORK",
			"primaryState" => "NY",
			"primaryZipCode" => "10001",
			"primaryUrbanizationCode" => "",
			"primaryPermanentAddressFlag" => "0",
			"primaryTribalFlag" => "0",
			"primaryRuralFlag" => "0",
			"mailingAddress1" => "175 E 196TH ST",
			"mailingAddress2" => "APT 1138",
			"mailingCity" => "NEW YORK",
			"mailingState" => "NY",
			"mailingZipCode" => "10001",
			"mailingUrbanizationCode" => "",
			"serviceInitializationDate" => "01/23/2012",
			"serviceReverificationDate" => "07/11/2012",
			"eligibilityCode" => "E13",
			"bqpLastName" => "DOE",
			"bqpFirstName" => "Jane",
			"bqpMiddleName" => "Wanda",
			"bqpDob" => "08/22/1988",
			"bqpLast4ssn" => "2234",
			"bqpTribalId" => "",
			"linkUpServiceDate" => "",
			"lifelineTribalBenefitFlag" => "0",
			"etcGeneralUse" => "A-123456",
			"tpivFlag" => "0",
			"repId" => Null,
			"repNotAssisted" => 1,
		);
		// As per your API, the customer data should be structured this way

		$data_string = json_encode($customer_data);
		$header = array('Content-Type:application/json');

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);

		$result = curl_exec($ch);
		curl_close($ch);

		$data = json_decode($result, true);


		$log['user_id'] = $user_id;
		$log['request'] = json_encode($customer_data);
		$log['response'] = $result;

		$this->db->insert('nv_logs', $log);

		if (isset($data['description'])) {
			if ($data['description'] == 'The credentials provided were invalid.') {
				$this->db->update('service_providers', ['nlad_verified' => 0], ['user_id' => $user_id]);
				$this->session->set_flashdata('nlad_error', 'Nlad Credentials are not verified. All plan will be removed from the market place until you veriify nlad');
			}
		} else {
			$this->db->update('service_providers', ['nlad_verified' => 1], ['user_id' => $user_id]);
			$this->session->set_flashdata('success', 'Nlad Credentials are verified');
		}

		redirect('lifeline');
	}


	public function nv_check($user_id)
	{


		//profile update
		// $user_id = $this->session->userdata('user_id');

		//nv check
		$consumer = $this->user->get_consumer_by_id($user_id);
		$user = $this->user->get_user_by_id($user_id);


		// this is only part of the data you need to send
		$customer_data = array(
			"firstName" => "$consumer->first_name",
			"middleName" => "",
			"lastName" => "$consumer->last_name",
			"address" => "$consumer->address",
			"state" => $this->user->get_state_by_state_id($consumer->state_id)->code,
			"city" => "$consumer->city",
			"zipCode" => "$consumer->zip",
			"urbanizationCode" => "",
			"dob" => date('Y-m-d', strtotime($consumer->dob)),
			"ssn4" => "$consumer->ssn",
			"tribalId" => "",
			"bqpFirstName" => "",
			"bqpLastName" => "",
			"bqpDob" => "",
			"bqpSsn4" => "",
			"bqpTribalId" => "",
			"eligibilityProgramCode" => "E1,E2,E3",
			"consentInd" => "Y",
			"contactPhoneNumber" => "$consumer->contact_no",
			"contactEmail" => "$user->email",
			"contactAddress" => "$consumer->address",
			"contactCity" => "$consumer->city",
			"contactState" => $this->user->get_state_by_state_id($consumer->state_id)->code,
			"contactZipCode" => "$consumer->zip",
			"contactUrbCode" => "",
			"repId" => Null,
			"repNotAssisted" => 1,
			"carrierUrl" => "https://gotruewireless.com"
		);

		$data_string = json_encode($customer_data);
		$header = array('Content-Type:application/json');

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $this->nv_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERPWD, $this->username . ":" . $this->password);

		$result = curl_exec($ch);
		curl_close($ch);

		$data = json_decode($result, true);

		// end nv logs
		$log['user_id'] = $user_id;
		$log['request'] = json_encode($customer_data);
		$log['response'] = $result;

		$this->db->insert('nv_logs', $log);
		// end nv logs

		if (in_array($data['status'], ['BAD_REQUEST'])) {
			$this->session->set_flashdata('nv_error', $data['errors']);
			$this->session->set_flashdata('nv_error_status', $data['status']);
		}

		if (in_array($data['status'], ['PENDING_RESOLUTION', 'PENDING_CERT'])) {
			$this->session->set_flashdata('nv_error', $data['failures']);
			$this->session->set_flashdata('nv_error_status', $data['status']);
			$this->session->set_flashdata('nv_error_links', $data['_links']);
		}


		if (in_array($data['status'], ['COMPLETE'])) {
			$this->session->set_flashdata('nv_success', $data);
			$this->session->set_flashdata('nv_success_status', $data['status']);
		}

		return redirect('consumer/profile/');
	}
}
