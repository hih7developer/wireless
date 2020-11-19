<?php

require_once('./vendor/autoload.php');

use Postmark\PostmarkClient;

defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->load->model('ApplicationModel');
	}


	// dry functions

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

	public function upload_file()
	{
		$config['upload_path']          = './uploads/';
		$config['allowed_types']          = '*';
		$config['encrypt_name']          = true;

		$this->load->library('upload', $config);

		if ($this->upload->do_upload('file'))
			return $this->upload->data()['file_name'];
	}

	public function send_email($data)
	{

		$config = array(
			'protocol' => 'sendmail', // 'mail', 'sendmail', or 'smtp'
			'smtp_host' => 'mail.hih7.org',
			'smtp_port' => 465,
			'smtp_user' => 'rahul@hih7.org',
			'smtp_pass' => 'team@hih7',
			'smtp_crypto' => 'tls', //can be 'ssl' or 'tls' for example
			'mailtype' => 'html', //plaintext 'text' mails or 'html'
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		// Set to, from, message, etc.
		$this->email->from('webdeveloper@hih7.com', 'Wireless');
		$this->email->to($data['email']);

		$this->email->subject($data['subject']);
		$this->email->message($this->load->view('email_template', $data, true));
		$this->email->send();
		// echo $this->email->print_debugger();

		// exit();

	}

	// dry functions


	// login logout dashboard

	public function login()
	{
		if ($this->session->userdata('user_id'))
			redirect('dashboard');

		$this->load->view('login');
	}

	public function login_action()
	{

		$recaptchaResponse = trim($this->input->post('g-recaptcha-response'));

		$userIp = $this->input->ip_address();

		$secret = $this->config->item('google_recaptcha_secrete_key');
		// $secret = '6Le_J7YUAAAAADXbvjMkB5-8nSlCJHZfnkxKf88V';

		$url = "https://www.google.com/recaptcha/api/siteverify?secret=" . $secret . "&response=" . $recaptchaResponse . "&remoteip=" . $userIp;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$output = curl_exec($ch);
		curl_close($ch);

		$status = json_decode($output);

		if ($status->success != 1) {
			$this->session->set_flashdata('error', 'Please check the recaptcha');
			if ($this->input->post('redirect_url')) {
				$this->session->set_flashdata('redirect_url', $this->input->post('redirect_url'));
			}
			redirect('login');
		}

		$user = $this->input->post('user');

		$user = $this->user->login_check($user);

		if (empty($user)) {
			$this->session->set_flashdata('error', 'Credentials not matched');
			if ($this->input->post('redirect_url')) {
				$this->session->set_flashdata('redirect_url', $this->input->post('redirect_url'));
			}
			redirect('login');
		}

		if ($user->status == 0) {
			$this->session->set_flashdata('error', 'You are not activated yet please contact admin');
			if ($this->input->post('redirect_url')) {
				$this->session->set_flashdata('redirect_url', $this->input->post('redirect_url'));
			}
			redirect('login');
		}

		$user_id = $user->user_id;


		// check user ppayment method is validated
		if ($user->role_id == 2) {
			$payment_method = $this->db->get_where('payment_methods', ['user_id' => $user_id])->row();
			if (empty($payment_method)) {
				$this->session->set_flashdata('payment_method', 'Please update payment method, otherwise your plan will not shown on the marketplace');
			} else {
				if ($payment_method->is_validated == 0) {
					$this->session->set_flashdata('payment_method', 'Please update payment method, otherwise your plan will not shown on the marketplace');
				}
			}

			$is_nlad_verified = $this->db->get_where('service_providers', ['user_id' => $user_id])->row()->nlad_verified;
			if ($is_nlad_verified == 0) {
				$this->session->set_flashdata('nlad_verified', 'Please update nlad credentials, otherwise your plan will not shown on the marketplace');
			}
		}

		if ($user->role_id == 4) {
			$consumer = $this->user->get_consumer_by_id($user->user_id);
			$this->session->set_userdata('state_id', $consumer->state_id);
		}

		$this->db->update('users', ['last_logged_in' => date('Y-m-d H:i:s')], ['user_id' => $user_id]);

		$this->session->set_userdata('user_id', $user->user_id);

		if ($this->input->post('redirect_url')) {
			redirect($this->input->post('redirect_url'));
		}

		redirect('dashboard');
	}

	public function action()
	{
		echo 'dakjshd';
	}

	public function signup()
	{
		$data['service_provider_states'] = $this->plan->get_service_provider_states();

		// echo '<pre>';
		// print_r($data);die;

		$this->load->view('signup', $data);
	}

	public function dashboard()
	{
		$this->login_check();

		$data = $this->common_data();

		if ($data['user']->role_id == 1) {
			$data['count']['plan'] = $this->plan->get_plan_count();
			$data['count']['carrier_admin'] = $this->user->get_carrier_admin_count();
			$data['count']['carrier_user'] = $this->user->get_carrier_user_count();
			$data['count']['buyer'] = $this->user->get_buyer_count();
			$data['applications'] = $this->ApplicationModel->all_application_list();
		} else if ($data['user']->role_id == 2) {
			$data['count']['plan'] = $this->plan->get_plan_count($data['user']->user_id);
			$data['count']['carrier_user'] = $this->user->get_carrier_user_count_by_service_provider_id($data['user']->user_id);
			$data['count']['application'] = $this->db->select('applications.*')->from('applications')->join('plans', 'plans.plan_id = applications.plan_id')->join('users', 'plans.user_id = users.user_id')->where(['users.user_id' => $data['user']->user_id])->get()->num_rows();
			$userId = $this->session->userdata('user_id');
			$data['applications'] = $this->ApplicationModel->seller_view_application_list($userId);
		} else if ($data['user']->role_id == 3) {

			$carrier_admin_user_id = $this->db->select('service_providers.user_id as carrier_admin_user_id')->from('service_providers')->join('carrier_users', 'carrier_users.service_provider_id = service_providers.service_provider_id')->where('carrier_users.user_id', $data['user']->user_id)->get()->row()->carrier_admin_user_id;

			$data['applications'] = $this->ApplicationModel->seller_view_application_list($carrier_admin_user_id);

			$data['count']['application'] = count($data['applications']);
		} else {
			return redirect('plans/search/' . $this->session->userdata('state_id'));
		}


		$this->load->view('dashboard', $data);
	}

	public function logout()
	{
		$this->session->unset_userdata('user_id');
		$this->session->unset_userdata('state_id');
		redirect('login');
	}

	public function email_verification($user_id)
	{
		$user = $this->user->get_user_by_id($user_id);

		if (empty($user))
			redirect('dashboard');

		if ($user->email_verified_at != NULL)
			redirect('dashboard');

		$this->user->update_user_where_id(['email_verified_at' => date('Y-m-d H:i:s'), 'email_verified' => 1], $user_id);
		redirect('dashboard');
	}

	// end login logout dashboard


	// admin
	public function admin_profile()
	{
		$this->login_check();
		$this->role_block([1]);
		$data = $this->common_data();

		return $this->load->view('admin_profile', $data);
	}

	public function admin_update($user_id)
	{
		$this->login_check();
		$this->role_block([1]);

		$user = $this->input->post('user');
		$this->db->update('users', $user, ['user_id' => $user_id]);

		$this->session->set_flashdata('success', 'Profile updated');

		redirect('admin/profile');
	}
	// admin end


	// carrier admin

	public function carrier_admin_insert()
	{
		$user = $this->input->post('user');
		$user['role_id'] = 2;
		$user['status'] = 1;

		$company = $this->input->post('company');

		if (!$this->user->user_check($user['email'])) {
			$this->session->set_flashdata('error', 'Email exist');
			redirect('carrier_admin/create');
		}

		$this->user->insert_carrier_admin($user);
		$user_id = $this->db->insert_id();
		$users = $this->db->get_where('users', ['user_id' => $user_id])->row();
		$company['user_id'] = $user_id;
		$company['logo'] = $this->upload_file();
		$this->user->insert_service_provider($company);

		$this->session->set_flashdata('success', 'One carrier admin added');

		// ------------------------ New Carrier Admin Add Email--------------------------


		$mail['email'] = $this->db->get_where('users', ['user_id' => $users->user_id])->row()->email;
		// $mail['template_id'] = 17915332;
		$mail['template_id'] = 19043979;
		$mail['details'] = [
			"name" => $user['name'],
			"email" => $user['email'],
			"password" => $user['password'],
			"login_url" => base_url('login'),
		];

		$this->postmark($mail);

		redirect('carrier_admin/create');
	}

	public function carrier_admin_list()
	{
		$this->login_check();
		$this->role_block([1]);

		$data = $this->common_data();
		$data['carrier_admins'] = $this->user->get_all_carrier_admins();
		$this->load->view('carrier_admin_list', $data);
	}

	public function add_carrier_admin()
	{
		$this->login_check();
		$this->role_block([1]);

		$data = $this->common_data();
		$data['states'] = $this->user->get_states();
		$this->load->view('add_carrier_admin', $data);
	}

	public function carrier_admin_profile()
	{

		$this->role_block([2]);

		$user_id = $this->session->userdata('user_id');
		$data = $this->common_data();
		$data['carrier_admin'] = $this->user->get_carrier_admin_by_id($user_id);
		$data['states'] = $this->user->get_states();
		$data['payment_method'] = $this->db->get_where('payment_methods', ['user_id' => $user_id])->row();

		$this->load->view('carrier_admin_profile', $data);
	}

	public function edit_carrier_admin()
	{
		$user_id = $this->input->post('user_id');
		echo json_encode($this->user->get_carrier_admin_by_id($user_id));
	}

	public function carrier_admin_update($user_id)
	{
		$user = $this->input->post('user');
		$company = $this->input->post('company');

		$this->user->update_user_where_id($user_id, $user);
		$this->user->update_service_provider_where_user_id($user_id, $company);

		$this->session->set_flashdata('success', 'Carrier admin updated');

		$data = $this->common_data();

		if ($data['user']->role_id == 2)
			return redirect('carrier_admin/profile/');
		return redirect('carrier_admin/details/' . $user_id);
	}

	public function upload_logo_carrier_admin($user_id)
	{
		$carrier_admin = $this->user->get_carrier_admin_by_id($user_id);
		unlink('./uploads/' . $carrier_admin->logo);
		$company['logo'] = $this->upload_file();
		$this->user->update_service_provider_where_user_id($user_id, $company);

		$this->session->set_flashdata('success', 'Carrier admin logo updated');

		redirect('carrier_admin/profile/');
	}

	public function edit_carrier_admin_action_ajax($id)
	{
		$carrier_admin = $this->input->post('carrier_admin');
		$service_provider['charge_amount'] = json_encode($this->input->post('charge_amount'));
		$this->db->update('service_providers', $service_provider, ['user_id' => $id]);
		$this->user->update_user_where_id($id, $carrier_admin);
	}


	// end carrier admin


	// carrier user

	public function carrier_user_insert()
	{
		$user = $this->input->post('user');
		$user['role_id'] = 3;

		if (!$this->user->user_check($user['email'])) {
			$this->session->set_flashdata('error', 'Email exist');
			redirect('carrier_user/create');
		}

		$this->user->insert_user($user);
		$user_id = $this->db->insert_id();
		$users = $this->db->get_where('users', ['user_id' => $user_id])->row();
		// $consumer = $this->db->get_where('consumers', ['user_id' => $user_id])->row();
		$logged_in_user = $this->user->get_carrier_admin_by_id($this->session->userdata('user_id'));

		$carrier_user = $this->input->post('carrier_user');

		$carrier_user['user_id'] = $user_id;
		if ($logged_in_user->role_id == 2) {
			$carrier_user['service_provider_id'] = $logged_in_user->service_provider_id;
		}

		$this->db->insert('carrier_users', $carrier_user);


		$mail['email'] = $user['email'];
		// $mail['email'] = 'sutanubose.2011@gmail.com';
		$mail['template_id'] = 19045717;
		// $mail['template_id'] = 17917786;
		$mail['details'] =
			[
				"name" => $user['name'],
				"email" => $user['email'],
				"password" => $user['password'],
				"login_url" => base_url('login'),
			];

		$this->postmark($mail);

		$this->session->set_flashdata('success', 'One carrier user added');


		redirect('carrier_user/create');
	}

	public function carrier_user_list()
	{
		$this->login_check();
		$this->role_block([1, 2]);

		$data = $this->common_data();

		if ($data['user']->role_id == 1)
			$data['carrier_users'] = $this->user->get_all_carrier_users();
		else if ($data['user']->role_id == 2)
			$data['carrier_users'] = $this->user->get_carrier_users_by_carrier_admin();

		$this->load->view('carrier_user_list', $data);
	}


	public function add_carrier_user()
	{
		$this->login_check();
		$this->role_block([1, 2]);

		$data = $this->common_data();
		$data['service_providers'] = $this->user->get_all_service_providers();
		$this->load->view('add_carrier_user', $data);
	}

	// end carrier user


	// consumer
	public function add_consumer_action()
	{
		$user = $this->input->post('user');
		$user['password'] = 123456;
		$state_id = $this->input->post('state_id');
		$zipcode = $this->input->post('zip');

		$user['role_id'] = 4;
		$user['status'] = 1;

		if ($this->user->consumer_check($user['email']) === false) {

			if ($this->user->zip_code_check($state_id, $zipcode) == false) {
				$this->session->set_flashdata('error', "Zip Code is invalid");
				return redirect('signup');
			}
			$this->user->insert_user($user);
			$user_id = $this->db->insert_id();
			$this->db->insert('consumers', ['user_id' => $user_id, 'state_id' => $state_id, 'zip' => $zipcode]);
		} else if ($this->user->consumer_check($user['email']) === true) {
			// $user_id = $this->user->get_user_by_email($user['email'])->user_id;
			$this->session->set_flashdata('error', 'Already signed up');
			return redirect('signup');
		} else {
			$this->session->set_flashdata('error', 'Email already exist');
			return redirect('signup');
		}



		$this->session->set_userdata('user_id', $user_id);
		$this->session->set_userdata('state_id', $state_id);

		redirect('plans/search/' . $state_id);
	}

	public function consumer_profile()
	{
		$this->login_check();
		$this->role_block([4]);

		// $user_id = $this->session->userdata('user_id');
		$data = $this->common_data();
		$data['consumer'] = $this->user->get_consumer_by_id($data['user']->user_id);
		$data['consumerID'] = $this->user->get_user_by_id($data['user']->user_id);
		// $data['carrier_admin'] = $this->user->get_carrier_admin_by_id($user_id);
		$data['service_provider_state'] = $this->plan->get_service_provider_states();
		$data['lifelines'] = $this->db->get('lifeline_programs')->result();

		$this->load->view('consumer_profile', $data);
	}

	public function edit_consumer_profile()
	{
		$user = $this->input->post('user');
		$consumer = $this->input->post('consumer');
		$user['name'] = $consumer['first_name'] . ' ' . $consumer['last_name'];

		$this->session->unset_userdata('state_id');
		$this->session->set_userdata('state_id', $consumer['state_id']);


		if (!isset($consumer['shipping_address_set'])) {
			$consumer['shipping_address_set'] = 0;
		}


		$this->user->update_user_where_id($this->session->userdata('user_id'), $user);
		$this->user->update_consumer_where_id($this->session->userdata('user_id'), $consumer);

		$this->session->set_flashdata('success', 'Updated successfully');

		redirect('consumer/profile/');
	}

	public function get_income_options()
	{
		$state = $this->input->post('state');
		$income = [];

		switch ($state) {
			case 2:
				$income_rate_increase = 15950;
				$first_income = 5600;
				for ($i = 0; $i < 8; $i++) {
					array_push($income, $income_rate_increase + $first_income * $i);
				}
				break;
			case 15:
				$income_rate_increase = 14680;
				$first_income = 5150;
				for ($i = 0; $i < 8; $i++) {
					array_push($income, $income_rate_increase + $first_income * $i);
				}
				break;

			default:
				$income_rate_increase = 12760;
				$first_income = 4480;
				for ($i = 0; $i < 8; $i++) {
					array_push($income, $income_rate_increase + $first_income * $i);
				}
				break;
		}

?>
<option value="">Select income</option>
<?php
		foreach ($income as $key => $value) : ?>
<option value="<?php echo ($key + 1) . " Adults in my household making $" . $value ?>"><?php echo $key + 1 ?> Adults in
    my household making $<?php echo $value ?></option>
<?php endforeach;
	}
	// end consumer



	// some common function 

	public function upload_password($user_id)
	{
		$prev_ps = $this->input->post('prev_ps');
		$new_ps = $this->input->post('new_ps');
		$con_ps = $this->input->post('con_ps');

		$cnt = $this->db->get_where('users', ['user_id' => $user_id, 'password' => md5($prev_ps)])->num_rows();

		if ($cnt == 0) {
			$this->session->set_flashdata('ps_error', 'Current password not matched');
			redirect($_SERVER['HTTP_REFERER']);
		}

		if ($new_ps !== $con_ps) {
			$this->session->set_flashdata('ps_error', 'Confirm password not matched');
			redirect($_SERVER['HTTP_REFERER']);
		}

		$this->user->update_user_where_id($user_id, ['password' => md5($new_ps)]);

		$user = $this->db->get_where('users', ['user_id' => $user_id])->row();

		$mail['email'] = $user->email;
		$mail['template_id'] = 14214206;
		$mail['details'] = [
			"name" => $user->name,
			"email" => $user->email,
			"login_url" => base_url('login'),
		];

		$this->postmark($mail);

		$this->session->set_flashdata('success', 'Password updated');

		redirect($_SERVER['HTTP_REFERER']);
	}


	public function update_password_consumer_profile($user_id)
	{
		$prev_ps = $this->input->post('prev_ps');
		$new_ps = $this->input->post('new_ps');
		$con_ps = $this->input->post('con_ps');

		$cnt = $this->db->get_where('users', ['user_id' => $user_id, 'password' => md5($prev_ps)])->num_rows();

		if ($cnt == 0) {
			$this->session->set_flashdata('ps_error', 'Current password not matched');
			redirect('consumer/profile');
		}

		if ($new_ps !== $con_ps) {
			$this->session->set_flashdata('ps_error', 'Confirm password not matched');
			redirect('consumer/profile');
		}

		$this->user->update_user_where_id($user_id, ['password' => md5($new_ps)]);

		$this->session->set_flashdata('success', 'Password updated');

		redirect('consumer/profile');
	}




	public function update_password_consumer($user_id)
	{
		$prev_ps = $this->input->post('prev_ps');
		$new_ps = $this->input->post('new_ps');
		$con_ps = $this->input->post('con_ps');

		$cnt = $this->db->get_where('users', ['user_id' => $user_id, 'password' => md5($prev_ps)])->num_rows();

		if ($cnt == 0) {
			echo json_encode(['ps_error' => 'Current password not matched']);
			return;
		}

		if ($new_ps !== $con_ps) {
			echo json_encode(['ps_error' => 'Confirm password not matched']);
			return;
		}

		$this->user->update_user_where_id($user_id, ['password' => md5($new_ps)]);
		$this->db->update('consumers', ['password_updated' => 1], ['user_id' => $user_id]);

		echo json_encode(['success' => 'Password updated']);
		return;
	}


	public function update_status($user_id)
	{
		$status = $this->input->post('status');
		$this->user->update_user_where_id($user_id, ['status' => $status]);
	}

	public function temp()
	{
		$carrier_admin = $this->user->get_carrier_admin_by_id(6);
		$user = $this->db->select('*')->from('users')->join('carrier_users', 'users.user_id = carrier_users.user_id')->where(['carrier_users.service_provider_id' => $carrier_admin->service_provider_id])->get()->result();

		print_r($user);
	}

	public function email_check($user_id = NULL)
	{
		$email = $this->input->post('email');

		if ($user_id === NULL)
			$cnt = $this->db->get_where('users', ['email' => $email])->num_rows();
		else
			$cnt = $this->db->get_where('users', ['email' => $email, 'user_id !=' => $user_id])->num_rows();

		if ($cnt == 0) {
			echo json_encode(['error' => false]);
			return;
		} else {
			echo json_encode(['error' => true]);
			return;
		}
	}

	// some common function 


	public function nlad()
	{
		$url = 'https://api.universalservice.org/svc/1/verify/';

		// $log_provider=$_POST['provider'].":".$_POST['user'];

		// $credential=base64_encode($user.':'. $password);
		$current_date = date('m') . "/" . (date("d") - 1) . "/" . date('Y');

		//$customer_data = array("transactionType" => "enroll","transactionEffectiveDate"=>$current_date,"sac" => "409031" ,"lastName" => "Aramburu","firstName" => "Virginia", "middleName" =>  "", "phoneNumber"=>"4799313187" , "phoneNumberInNlad" => "", "last4ssn" => "7703", "tribalId" => "","dob" => "05/30/1987","serviceType" => "BundledVoiceBroadband","iehFlag" => "","iehCertificationDate" => "","iehRecertificationDate" => "","primaryAddress1" => "3624 E 26th St","primaryAddress2" => "","primaryCity" => "Brownsville","primaryState" => "TX","primaryZipCode" => "78521","primaryUrbanizationCode" => "","primaryPermanentAddressFlag" => "","primaryTribalFlag" => "","primaryRuralFlag" => "","mailingAddress1" => "3624 E 26th St","mailingAddress2" => "","mailingCity" => "Hindsville","mailingState" => "AR","mailingZipCode" => "72738","mailingUrbanizationCode" => "","serviceInitializationDate" => "07/14/2017","serviceReverificationDate" => "","eligibilityCode" => "E2","bqpLastName" => "","bqpFirstName" => "","bqpMiddleName" => "","bqpDob" => "","bqpLast4ssn" => "","bqpTribalId" => "","linkUpServiceDate" => "","lifelineTribalBenefitFlag" => "0","etcGeneralUse" => "","tpivFlag" => "");

		$customer_data = array("transactionType" => "enroll", "transactionEffectiveDate" => $current_date, "sac" => "123456", "lastName" => "DOE", "firstName" => "JOHN", "middleName" => "Wayne", "phoneNumber" => "5555555555", "phoneNumberInNlad" => "", "last4ssn" => "1234", "tribalId" => "1234abcd", "dob" => "04/21/1966", "serviceType" => "Voice", "iehFlag" => "1", "iehCertificationDate" => "09/01/2012", "iehRecertificationDate" => "12/12/2012", "primaryAddress1" => "175 E 196TH ST", "primaryAddress2" => "APT 1138", "primaryCity" => "NEW YORK", "primaryState" => "NY", "primaryZipCode" => "10001", "primaryUrbanizationCode" => "", "primaryPermanentAddressFlag" => "0", "primaryTribalFlag" => "0", "primaryRuralFlag" => "0", "mailingAddress1" => "175 E 196TH ST", "mailingAddress2" => "APT 1138", "mailingCity" => "NEW YORK", "mailingState" => "NY", "mailingZipCode" => "10001", "mailingUrbanizationCode" => "", "serviceInitializationDate" => "01/23/2012", "serviceReverificationDate" => "07/11/2012", "eligibilityCode" => "E13", "bqpLastName" => "DOE", "bqpFirstName" => "Jane", "bqpMiddleName" => "Wanda", "bqpDob" => "08/22/1988", "bqpLast4ssn" => "2234", "bqpTribalId" => "", "linkUpServiceDate" => "", "lifelineTribalBenefitFlag" => "0", "etcGeneralUse" => "A-123456", "tpivFlag" => "0");

		$data_string = json_encode($customer_data);
		$header = array('Content-Type:application/json');
		$username = "02q7.yl.c_6aeq9kd@gws.tkugdedqck";
		$password = 'h$3!8z-f@$_S5@*(y36^@5!)!_O_)g*V';

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERPWD, $username . ":" . $password);

		$result = curl_exec($ch);
		curl_close($ch);

		$data = json_decode($result, true);

		echo '<pre>';
		print_r($data);
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

	public function send()
	{
		$mail['email'] = 'sjgalaxy98@gmail.com';
		$mail['template_id'] = 17915332;
		$mail['details'] = [
			"name" => 'Sudipta Jana',
			"email" => 'sjgalaxy98@gmail.com',
			"password" => '312',
			"login_url" => base_url('login'),
		];

		$this->postmark($mail);
	}
}