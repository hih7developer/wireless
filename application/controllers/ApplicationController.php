<?php

require_once('./vendor/autoload.php');

use Postmark\PostmarkClient;
use Dompdf\Dompdf;



class ApplicationController extends CI_Controller
{
	// public $username = '02q7.yl.c_6aeq9kd@gws.tkugdedqck';
	// public $username = '30xur5ew1yl@8vxikvd3i4nlnqhe.jks';
	// public $password = 'h$3!8z-f@$_S5@*(y36^@5!)!_O_)g*V';
	// public $password = '!!T892Aa)7^=s8(-_=-(T240^@!)-6$z';

	public $username = '87@lhg9cw4tgx9j7bj.uqfodzypztrnp';
	public $password = 'yU_)a_2Sr$jKlH-_4s^@QTbiLN9)^FFz';

	public $url = 'https://api.universalservice.org/svc/1/verify/';
	public $nv_url = 'https://api.universalservice.org/nvca-svc/consumer/eligibility-check/';


	public function __construct()
	{
		parent::__construct();
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

	public function common_data()
	{
		$user_id = $this->session->userdata('user_id');
		$data['user'] = $this->user->get_user_by_id($user_id);

		return $data;
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

	public function profile_eligibilty_check($plan_id)
	{
		$this->login_check();
		$this->role_block([4]);

		$data = $this->common_data();
		$data['plan_id'] = $plan_id;
		$data['consumer'] = $this->user->get_consumer_by_id($data['user']->user_id);
		$data['service_provider_state'] = $this->plan->get_service_provider_states();



		//check if any pending application with same seller
		$seller_id = $this->db->get_where('plans', ['plan_id' => $plan_id])->row()->user_id;
		$seller_plans = $this->db->get_where('plans', ['user_id' => $seller_id])->result();
		$pending_applications = $this->db->where_in('plan_id', array_column($seller_plans, 'plan_id'))->where('status', 'pending')->get('applications')->num_rows();
		if ($pending_applications > 0) {
			$this->session->set_flashdata('error', "There is already an application applied and pending for review, please wait or contact administration");
			redirect('plans/search/' . $data['consumer']->state_id);
		}

		//check if any pending application with same seller

		$data['nv_check'] = in_array($data['consumer']->state_id, [6, 43, 51, 53]) ? false : true;

		return $this->load->view('application_eligibility_check', $data);
	}

	public function nv_check($plan_id)
	{

		$this->session->unset_tempdata('nv_response');
		$this->session->unset_tempdata('lifeline_certificate');
		$this->session->unset_tempdata('household_worksheet');
		$this->session->unset_tempdata('household');

		//profile update
		$user_id = $this->session->userdata('user_id');


		$user = $this->input->post('user');
		$consumer = $this->input->post('consumer');
		$user['name'] = $consumer['first_name'] . ' ' . $consumer['last_name'];

		$this->session->unset_userdata('state_id');
		$this->session->set_userdata('state_id', $consumer['state_id']);




		if (!isset($consumer['shipping_address_set'])) {
			$consumer['shipping_address_set'] = 0;
		}


		$this->user->update_user_where_id($user_id, $user);
		$this->user->update_consumer_where_id($user_id, $consumer);


		//state change check with plan state
		$plan_state_id = $this->db->get_where('plans', ['plan_id' => $plan_id])->row()->state_id;
		$state_name = $this->db->get_where('states', ['id' => $consumer['state_id']])->row()->name;
		if (!in_array($consumer['state_id'], explode(',', $plan_state_id))) {
			$this->session->set_flashdata('error', "The Plan you are selected to apply is not available on this state ($state_name). plan lists are update.");
			redirect('plans/search/' . $consumer['state_id']);
		}
		//end        

		$is_lifeline = $this->db->get_where('plans', ['plan_id' => $plan_id])->row()->lifeline_service == 1 ? true : false;
		if (!$is_lifeline) {
			$this->session->set_tempdata('application_apply', ['user_id' => $user_id, 'plan_id' => $plan_id], 300 * 2);
			redirect('application/confirm/' . $plan_id);
		}


		// state check
		if (in_array($consumer['state_id'], [6, 43, 51, 53])) {
			$this->session->set_tempdata('application_apply', ['user_id' => $user_id, 'plan_id' => $plan_id], 300 * 2);
			redirect('application/lifeline_program/' . $plan_id);
		}
		// state check




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


		$credentials = $this->user->get_nlad_cred(['plan_id' => $plan_id]);

		if (!$credentials)
			return redirect('/');

		$header = array('Content-Type:application/json');

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $this->nv_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_USERPWD, $credentials['username'] . ":" . $credentials['password']);

		$result = curl_exec($ch);
		curl_close($ch);

		$data = json_decode($result, true);

		// end nv logs
		$log['user_id'] = $user_id;
		$log['request'] = json_encode($customer_data);
		$log['response'] = $result;

		$this->db->insert('nv_logs', $log);
		// end nv logs

		if (in_array($data['status'], ['FORBIDDEN'])) {
			$this->session->set_flashdata('nv_forbidden_error', "There's an internal technal error with national verifier, Please contact with admin. Please stay with us we will resolve this issue as soon as possible.");
			$this->user->update_service_provider_is_nlad_verified(['plan_id' => $plan_id]);
		}


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
			$this->session->set_tempdata('application_apply', ['user_id' => $user_id, 'plan_id' => $plan_id], 300 * 2);
			$this->session->set_tempdata('nv_success', $data, 300 * 2);
			redirect('application/lifeline_program/' . $plan_id);
		}

		return redirect('application/eligibility_check/' . $plan_id);
	}

	public function without_nv_check($plan_id)
	{
		$this->login_check();
		$this->role_block([4]);

		$user_id = $this->session->userdata('user_id');

		if (!$this->session->tempdata('application_apply')) {
			redirect('/');
		}

		$application_apply_session = $this->session->tempdata('application_apply');
		if ($application_apply_session['user_id'] != $user_id && $application_apply_session['plan_id'] != $plan_id) {
			redirect('/');
		}

		$data = $this->common_data();
		$data['plan_id'] = $plan_id;
		$data['plan'] = $this->db->get_where('plans', ['plan_id' => $plan_id])->row();
		$this->load->view('without_nv_check', $data);
	}


	public function application_lifeline_program($plan_id)
	{
		$this->login_check();
		$this->role_block([4]);

		$user_id = $this->session->userdata('user_id');

		if (!$this->session->tempdata('application_apply')) {
			redirect('/');
		}

		$application_apply_session = $this->session->tempdata('application_apply');
		if ($application_apply_session['user_id'] != $user_id && $application_apply_session['plan_id'] != $plan_id) {
			redirect('/');
		}

		$data = $this->common_data();
		$data['plan_id'] = $plan_id;
		$data['nv_success'] = $this->session->tempdata('nv_success');
		$data['plan'] = $this->db->get_where('plans', ['plan_id' => $plan_id])->row();
		$data['consumer'] = $this->user->get_consumer_by_id($user_id);
		$data['lifeline_programs'] = $this->db->get('lifeline_programs')->result();
		$data['lifeline_agreements'] = $this->db->get('lifeline_agreement')->result();


		$this->load->view('application_lifeline_program', $data);
	}

	public function application_lifeline_action($plan_id)
	{
		$this->login_check();
		$this->role_block([4]);

		$user_id = $this->session->userdata('user_id');

		// if (!$this->session->tempdata('application_apply')) {
		// 	redirect('/');
		// }

		// $application_apply_session = $this->session->tempdata('application_apply');
		// if ($application_apply_session['user_id'] != $user_id && $application_apply_session['plan_id'] != $plan_id) {
		// 	redirect('/');
		// }

		$data = $this->common_data();

		$data['lifeline'] = $this->input->post('lifeline');
		$data['plan_id'] = $plan_id;
		$data['lifeline_programs'] = $this->db->get('lifeline_programs')->result();
		$data['lifeline_agreements'] = $this->db->get('lifeline_agreement')->result();
		$data['consumer'] = $this->user->get_consumer_by_id($user_id);

		// return $this->load->view('application_lifeline_program_pdf', $data);
		$html = $this->load->view('application_lifeline_program_pdf', $data, true);


		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');

		// Render the HTML as PDF
		$dompdf->render();


		// Output the generated PDF to Browser
		$pdf = $dompdf->output();
		// $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));


		$filename = uniqid() . '.pdf';

		if (file_put_contents("./uploads/lifeline_pdf/" . $filename, $pdf)) {
			$this->session->set_tempdata('lifeline_certificate', $filename, 300 * 2);
		} else {
			$this->session->set_flashdata('error', 'something went wrong please try again');
			redirect('application/eligibility_check/' . $plan_id);
		}


		//state check where nv is enable
		if (!in_array($data['consumer']->state_id, [6, 43, 51, 53])) {
			redirect('application/confirm/' . $plan_id);
		}

		redirect('application/household/' . $plan_id);
	}

	public function application_household($plan_id)
	{

		$this->login_check();
		$this->role_block([4]);

		$user_id = $this->session->userdata('user_id');

		if (!$this->session->tempdata('application_apply')) {
			redirect('/');
		}

		$application_apply_session = $this->session->tempdata('application_apply');
		if ($application_apply_session['user_id'] != $user_id && $application_apply_session['plan_id'] != $plan_id) {
			redirect('/');
		}


		$data = $this->common_data();
		$data['plan_id'] = $plan_id;
		$data['consumer'] = $this->user->get_consumer_by_id($user_id);

		$this->load->view('application_household', $data);
	}

	public function application_household_action($plan_id)
	{
		$this->login_check();
		$this->role_block([4]);

		$user_id = $this->session->userdata('user_id');

		if (!$this->session->tempdata('application_apply')) {
			redirect('/');
		}

		$application_apply_session = $this->session->tempdata('application_apply');
		if ($application_apply_session['user_id'] != $user_id && $application_apply_session['plan_id'] != $plan_id) {
			redirect('/');
		}

		if ($this->input->post('household')) {
			$household = $this->input->post('household');

			if ($this->input->post('signature_one_done') == 1) {
				$image = $this->input->post('signature_one');
				$image = str_replace('data:image/png;base64,', '', $image);
				$image = str_replace(' ', '+', $image);
				$filedata = base64_decode($image);
				$file = uniqid(rand(), true) . '.png';
				$success = file_put_contents('uploads/signature/' . $file, $filedata);

				$household['image'][0] = $file;
			}

			if ($this->input->post('signature_two_done') == 1) {
				$image = $this->input->post('signature_two');
				$image = str_replace('data:image/png;base64,', '', $image);
				$image = str_replace(' ', '+', $image);
				$filedata = base64_decode($image);
				$file = uniqid(rand(), true) . '.png';
				$success = file_put_contents('uploads/signature/' . $file, $filedata);
				$household['image'][1] = $file;
			}


			if (!isset($household['question_two'])) {
				$household['question_two'] = null;
			}

			if (!isset($household['question_three'])) {
				$household['question_three'] = null;
			}

			if ($this->input->post('signature_one_done') == 0 && $this->input->post('signature_two_done') == 0) {
				unset($household['date']);
			}

			$this->session->set_tempdata('household', json_encode($household), 300 * 2);
		}

		$data['household'] = json_decode($this->session->tempdata('household'));


		// return $this->load->view('application_household_pdf', $data);

		$html = $this->load->view('application_household_pdf', $data, true);


		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($html);

		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'portrait');

		// Render the HTML as PDF
		$dompdf->render();

		// $dompdf->stream("dompdf_out.pdf", array("Attachment" => false));

		// Output the generated PDF to Browser
		$pdf = $dompdf->output();

		$filename = uniqid() . '.pdf';

		if (file_put_contents("./uploads/household_worksheet/" . $filename, $pdf)) {
			$this->session->set_tempdata('household_worksheet', $filename, 300 * 2);
		} else {
			$this->session->set_flashdata('error', 'something went wrong please try again');
			redirect('application/household/' . $plan_id);
		}

		redirect('application/confirm/' . $plan_id);
	}

	public function application_confirm($plan_id)
	{
		$this->login_check();
		$this->role_block([4]);

		$user_id = $this->session->userdata('user_id');

		if (!$this->session->tempdata('application_apply')) {
			redirect('/');
		}

		$application_apply_session = $this->session->tempdata('application_apply');
		if ($application_apply_session['user_id'] != $user_id && $application_apply_session['plan_id'] != $plan_id) {
			redirect('/');
		}

		$data = $this->common_data();
		$data['consumer'] = $this->user->get_consumer_by_id($user_id);
		$data['plan_id'] = $plan_id;
		$data['nv_success'] = $this->session->tempdata('nv_success');
		$data['plan'] = $this->db->get_where('plans', ['plan_id' => $plan_id])->row();
		$data['is_lifeline'] = $data['plan']->lifeline_service == 1 ? true : false;
		$data['in_nv_enable'] = !in_array($data['consumer']->state_id, [6, 43, 51, 53]);


		$this->load->view('application_confirm', $data);
	}

	public function application_confirm_action($plan_id)
	{
		$this->login_check();
		$this->role_block([4]);

		// $plan_id = $this->input->post('plan_id');
		$user_id = $this->session->userdata('user_id');


		if (!$this->session->tempdata('application_apply')) {
			redirect('/');
		}

		$application_apply_session = $this->session->tempdata('application_apply');
		if ($application_apply_session['user_id'] != $user_id && $application_apply_session['plan_id'] != $plan_id) {
			redirect('/');
		}

		$data = $this->common_data();
		$plan = $this->db->get_where('plans', ['plan_id' => $plan_id])->row();
		$application['plan_id'] = $plan_id;
		$application['user_id'] = $user_id;

		//nv response
		$application['nv_response'] = $this->input->post('nv_response') ? $this->input->post('nv_response') : NULL;
		$application['is_nv_enable'] = $this->input->post('nv_response') ? 1 : 0;


		// file upload 
		$application['proof_of_eligibility'] = $this->lifeline_file_upload('proof_of_eligibility');
		$application['photo_id'] = $this->lifeline_file_upload('photo_id');
		$application['lifeline_certification'] = $this->session->tempdata('lifeline_certificate');
		$application['household_worksheet'] = $this->session->tempdata('household_worksheet');
		$application['household'] = $this->session->tempdata('household');


		$this->db->insert('applications', $application);

		$application_id = $this->db->insert_id();

		$email_details['email'] = $this->db->get_where('users', ['user_id' => $plan->user_id])->row()->email;

		//---------------------- New Application submit Email-----------------------------------


		// $mail['email'] = $this->db->get_where('users', ['user_id' => $plan->user_id])->row()->email;
		$mail['email'] = 'sjgalaxy98@gmail.com';
		$mail['template_id'] = 14214394;
		$mail['details'] = [
			"carrier_name" =>  $this->db->get_where('users', ['user_id' => $plan->user_id])->row()->name,
			"application_id" => $application_id,
			"order_timestamp" => $this->db->get_where('applications', ['application_id' => $application_id])->row()->created_at,
			"plan_name" => $this->db->get_where('plans', ['user_id' => $plan->user_id])->row()->name,
			"application_url" => base_url('carrier/application/details/' . $application_id),
		];

		$this->postmark($mail);



		// $mail['email'] = $this->db->get_where('users', ['user_id' => $user_id])->row()->email;
		$mail['email'] = 'sjgalaxy98@gmail.com';
		$mail['template_id'] = 14192860;
		$mail['details'] = [
			"first_name" =>  $this->db->get_where('users', ['user_id' => $plan->user_id])->row()->name,
			"company" =>  $this->db->get_where('service_providers', ['user_id' => $plan->user_id])->row()->name,
			"contact_phone" =>  $this->db->get_where('service_providers', ['user_id' => $plan->user_id])->row()->contact_no,
			"application_id" => $application_id,
			"application_url" => base_url('consumer/application/details/' . $application_id),
		];

		$this->postmark($mail);



		redirect('application/success');
	}

	public function lifeline_file_upload($field)
	{
		$config['upload_path']          = './uploads/lifeline/';
		$config['allowed_types']        = 'jpeg|jpg|png|pdf';
		$config['encrypt_name']          = true;
		$this->load->library('upload', $config);

		if ($this->upload->do_upload($field))
			return $this->upload->data()['file_name'];
		else
			return NULL;
	}

	public function application_success()
	{
		$this->login_check();
		$this->role_block([4]);
		$data = $this->common_data();

		$this->load->view('application_success', $data);
	}

	public function consumer_applications_lists()
	{
		$this->login_check();
		$this->role_block([4]);

		$user_id = $this->session->userdata('user_id');
		$data = $this->common_data();


		$status = $this->input->get('status');

		if (in_array($status, ['all', ''])) {
			$data['applications'] = $this->db->select('*, plans.name as plan_name, applications.created_at as application_created_at, applications.updated_at as application_updated_at, service_providers.name as service_provider_name')->from('applications')->join('plans', 'plans.plan_id = applications.plan_id')->join('service_providers', 'plans.user_id = service_providers.user_id')->where(['applications.user_id' => $user_id])->order_by('applications.updated_at', 'DESC')->get()->result();
		} else {
			$data['applications'] = $this->db->select('*, plans.name as plan_name, applications.created_at as application_created_at, applications.updated_at as application_updated_at, service_providers.name as service_provider_name')->from('applications')->join('plans', 'plans.plan_id = applications.plan_id')->join('service_providers', 'plans.user_id = service_providers.user_id')->where(['applications.user_id' => $user_id, 'applications.status' => $status])->order_by('applications.updated_at', 'DESC')->get()->result();
		}


		$this->load->view('consumer_application_lists', $data);
	}

	public function consumer_application_details($application_id)
	{
		$this->login_check('consumer/application/details/' . $application_id);
		$this->role_block([4]);

		$data = $this->common_data();

		$application_user_id = $this->db->get_where('applications', ['application_id' => $application_id])->row()->user_id;

		if ($application_user_id != $data['user']->user_id) {
			redirect('/');
		}

		$data['application'] = $this->db->select('*, plans.name as plan_name, applications.contact_no as application_contact_no, applications.created_at as application_created_at, applications.updated_at as application_updated_at, service_providers.name as service_provider_name')->from('applications')->join('plans', 'plans.plan_id = applications.plan_id')->join('service_providers', 'plans.user_id = service_providers.user_id')->where(['applications.application_id' => $application_id])->get()->row();

		$this->load->view('consumer_application_details', $data);
	}

	public function cancel_order($application_id)
	{
		$this->login_check();
		$this->role_block([4]);

		$user_id = $this->session->userdata('user_id');

		$application = $this->db->get_where('applications', ['application_id' => $application_id])->row();

		if ($user_id != $application->user_id) {
			redirect('/');
		}

		$this->db->update('applications', ['status' => 'cancelled', 'reason' => NULL, 'updated_at' => date('Y-m-d H:i:s')], ['application_id' => $application_id]);


		//email sending
		$plan = $this->db->get_where('plans', ['plan_id' => $application->plan_id])->row();
		$email_details['email'] = $this->db->get_where('users', ['user_id' => $plan->user_id])->row()->email;

		ob_start();
?>
Hello, <br>
A order is cancelled. Timing of cancellation <?php echo date('H:i d m, Y') ?>.
<p style="text-align: center"><a style="color: #fff;
					text-decoration: none;
					padding: .375rem .75rem;
					text-transform: uppercase;
					letter-spacing: 1px;
					background: #00a69c;
					border: 1px solid #00a69c;
					border-radius: 36px;
					outline: none;
					font-weight: 700;
					line-height: 18px;
					font-size: 12px;" href="<?php echo base_url('carrier/application/details/' . $application_id); ?>">Review</a></p>
<?php
		$email_details['message'] = ob_get_clean();
		$email_details['subject'] = "New Application - WirelessMacthup";
		//email sending


		$this->send_email($email_details);

		$this->session->set_flashdata('success', 'Order is cancelled successfully');
		redirect('consumer/application/details/' . $application_id);
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

	public function get_household_worksheet()
	{
		$this->load->view('template_part/household_worksheet', true);
	}
}