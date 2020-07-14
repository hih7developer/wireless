<?php

require_once('./vendor/autoload.php');

use Postmark\PostmarkClient;

class AdminViewListController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ApplicationModel');
		$this->load->model('user');
	}


	public function login_check($redirect_url = NULL)
	{
		if (!$this->session->userdata('user_id')) {
			if (!is_null($redirect_url)) {
				$this->session->set_flashdata('redirect_url', $redirect_url);
			}
			redirect('login');
		}
	}

	public function role_block($roles)
	{
		$data = $this->common_data();

		if (!in_array($data['user']->role_id, $roles))
			redirect('dashboard');
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

	public function admin_view_application_list()
	{
		$userId = $this->session->userdata('user_id');
		// print_r($userId);die;
		$data['ApplicationList'] = $this->ApplicationModel->seller_view_application_list($userId);
		$status = $this->input->get('status');

		if (in_array($status, ['all', ''])) {
			$data['applications'] = $this->db->select('*, plans.name as plan_name, applications.created_at as application_created_at, applications.updated_at as application_updated_at, service_providers.name as service_provider_name')->from('applications')->join('plans', 'plans.plan_id = applications.plan_id')->join('service_providers', 'plans.user_id = service_providers.user_id')->where(['applications.user_id' => $user_id])->order_by('applications.updated_at', 'DESC')->get()->result();
		} else {
			$data['applications'] = $this->db->select('*, plans.name as plan_name, applications.created_at as application_created_at, applications.updated_at as application_updated_at, service_providers.name as service_provider_name')->from('applications')->join('plans', 'plans.plan_id = applications.plan_id')->join('service_providers', 'plans.user_id = service_providers.user_id')->where(['applications.user_id' => $user_id, 'applications.status' => $status])->order_by('applications.updated_at', 'DESC')->get()->result();
		}
		// echo $this->db->last_query();
		// die;
		$this->load->view('dashboard', $data);
	}

	public function application_details($application_id)
	{
		$this->login_check('carrier/application/details/' . $application_id);
		$this->role_block([1, 2, 3]);
		$data = $this->common_data();

		if ($data['user']->role_id != 1) {
			$carrier_admin_user_id = $data['user']->user_id;
			if ($data['user']->role_id == 3) {
				$carrier_admin_user_id = $this->db->select('service_providers.user_id as carrier_admin_user_id')->from('service_providers')->join('carrier_users', 'carrier_users.service_provider_id = service_providers.service_provider_id')->where('carrier_users.user_id', $data['user']->user_id)->get()->row()->carrier_admin_user_id;
			}

			$plans = $this->db->get_where('plans', ['user_id' => $carrier_admin_user_id])->result();
			$plans = array_column($plans, 'plan_id');

			$application_ids = $this->db->where_in('plan_id', $plans)->get('applications')->result();
			$application_ids = array_column($application_ids, 'application_id');

			if (!in_array($application_id, $application_ids)) {
				redirect('/');
			}
		}


		$data['application'] = $this->ApplicationModel->get_applier_details_by_id($application_id);

		$this->load->view('applier_profile', $data);
	}

	public function add_incomplete_reasons($application_id)
	{
		$incomplete = $this->input->post('reason');
		// $incomplete['status'] == 'incomplete';

		$this->ApplicationModel->update_incomplete_application($application_id, implode(',', $incomplete));
		$this->session->set_flashdata('status', 'Application Status is now Incomplete');

		$application_user_id = $this->db->get_where('applications', ['application_id' => $application_id])->row()->user_id;
		$mail['email'] = $this->db->get_where('users', ['user_id' => $application_user_id])->row()->email;
		// $mail['email'] = 'sutanubose.2011@gmail.com';
		$mail['template_id'] = 14193919;
		$mail['details'] = [
			"first_name" => $this->db->get_where('consumers', ['user_id' => $application_user_id])->row()->first_name,
			"company" => "Wireless-Matchup",
			"order_id" => $this->db->get_where('applications', ['application_id' => $application_id])->row()->application_id,
			"contact_phone" => $this->db->get_where('applications', ['application_id' => $application_id])->row()->contact_no,
		];

		$this->postmark($mail);


		redirect('AdminViewListController/application_details/' . $application_id);
	}

	public function add_reject_reasons($application_id)
	{
		$reason = $this->input->post('reason');
		// $reason['status'] == 'reject';

		$this->ApplicationModel->update_reject_application($application_id, implode(',', $reason));
		$this->session->set_flashdata('reject', 'Application Status is now Rejected');

		$application_user_id = $this->db->get_where('applications', ['application_id' => $application_id])->row()->user_id;
		$mail['email'] = $this->db->get_where('users', ['user_id' => $application_user_id])->row()->email;
		// $mail['email'] = 'sutanubose.2011@gmail.com';
		$mail['template_id'] = 14192864;
		$mail['details'] = [
			"first_name" => $this->db->get_where('consumers', ['user_id' => $application_user_id])->row()->first_name,
			"company" => "Wireless-Matchup",
			"contact_phone" => $this->db->get_where('applications', ['application_id' => $application_id])->row()->contact_no,
			// "product_name" => "product_name_Value",
			// "product_url" => "product_url_Value",
			// "company_name" => "company_name_Value",
			// "company_address" => "company_address_Value",
		];
		$this->postmark($mail);


		redirect('AdminViewListController/application_details/' . $application_id);
	}

	public function add_approve($application_id)
	{
		$track = $this->input->post('track');
		$contact = $this->input->post('contact_no');
		$device = $this->input->post('device');


		// charging carrier
		$this->load->model('payment');
		$charge = $this->payment->chargeCustomerProfile($application_id);
		if ($charge !== true) {
			$this->session->set_flashdata('error', $charge);
			return redirect('carrier/application/details/' . $application_id);
		}
		// die;
		$charge_id = $this->db->insert_id();
		$transaction_id = $this->db->get_where('charges', ['charge_id' => $charge_id])->row()->transaction_id;


		$this->ApplicationModel->approve_insert($application_id, $track, $contact, $device);
		// echo $this->db->last_query();die;

		$application_user_id = $this->db->get_where('applications', ['application_id' => $application_id])->row()->user_id;
		$mail['email'] = $this->db->get_where('users', ['user_id' => $application_user_id])->row()->email;
		// $mail['email'] = 'sutanubose.2011@gmail.com';
		$mail['template_id'] = 14090305;
		$mail['details'] = [
			"first_name" => $this->db->get_where('consumers', ['user_id' => $application_user_id])->row()->first_name,
			"Provider" => "Wireless-Matchup",
			"Provided_Account_ID" => $this->db->get_where('applications', ['application_id' => $application_id])->row()->application_id,
			"Provided_Phone_Number" => $this->db->get_where('applications', ['application_id' => $application_id])->row()->contact_no,
			"Provided_Tracking_Number" => $this->db->get_where('applications', ['application_id' => $application_id])->row()->track,
			// "Toll_Free" => "Toll_Free_Value",
			// "email_address" => "email_address_Value",
		];

		$this->postmark($mail);

		$this->session->set_flashdata('approve', "Application Status is now Approved. You are charged $15. Here is your trnasaction id: " . $transaction_id);


		redirect('carrier/application/details/' . $application_id);
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


	public function common_data()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->user->get_user_by_id($user_id);

		return $data;
	}
}