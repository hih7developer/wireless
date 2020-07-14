<?php

require_once('./vendor/autoload.php');

use Postmark\PostmarkClient;


class ForgetPasswordController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user');
		$this->load->model('ForgetPasswordModel');
		$this->load->helper('string');
		$this->load->library('form_validation');
	}

	public function enter_email_page()
	{
		// $this->login_check();
		$this->load->view('forget_password');
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

	public function email_check()
	{
		// $this->login_check();
		$email = $this->input->post('email');
		$user = $this->ForgetPasswordModel->email_check($email);

		if (empty($user)) {
			$this->session->set_flashdata('error', 'Email Not Found , Please Enter Valid Email');
			redirect('forget_password/email_check/');
		}


		$otp = mt_rand(100000, 999999);

		$forget_password['user_id'] = $user->user_id;
		$forget_password['otp'] = $otp;

		$this->ForgetPasswordModel->otp_check($forget_password);



		// -------------------------------MAIL SEND----------------------------------------

		$to = $this->input->post('email');

		$mail['email'] = $this->input->post('email');
		$mail['template_id'] = 18636133;
		// $mail['template_id'] = 17994044;
		$mail['details'] = [
			"name" =>  $this->db->get_where('users', ['email' => $to])->row()->name,
			"otp" => $otp,
			'otp_url' => base_url('forget_password/otp_check')
		];

		try {
			$this->postmark($mail);
			$this->session->set_tempdata('forget_password', $user->user_id, 60 * 10);
			$this->session->set_flashdata('success', 'OTP has been send to your Email');
			redirect('forget_password/otp_check/');
		} catch (Exception $e) {
			//Email Failed To Send
			$this->session->set_flashdata('error', 'Oop! Something went wrong');
			redirect('forget_password/email_check/');
		}
	}

	public function insert_otp()
	{
		// $this->login_check();
		if (!$this->session->tempdata('forget_password')) {
			$this->session->set_flashdata('error', 'Session expired');
			redirect('forget_password/email_check/');
		}

		$data['user_id'] = $this->session->tempdata('forget_password');
		$this->load->view('otp_verification', $data);
	}

	public function otp_check($user_id)
	{
		// $this->login_check();
		if (!$this->session->tempdata('forget_password')) {
			$this->session->set_flashdata('error', 'Session expired');
			redirect('forget_password/email_check/');
		}

		$otp = $this->input->post('otp');
		$data = $this->ForgetPasswordModel->match_inserted_otp($otp, $user_id);

		if (!empty($data)) {
			redirect("forget_password/new_password/");
		}

		$this->session->set_flashdata('error', 'OTP Not matched');
		redirect('forget_password/otp_check/');
	}

	public function insert_new_password()
	{
		// $this->login_check();
		if (!$this->session->tempdata('forget_password')) {
			$this->session->set_flashdata('error', 'Session expired');
			redirect('forget_password/email_check/');
		}

		$data['user_id'] = $this->session->tempdata('forget_password');
		$this->load->view('set_new_password', $data);
	}

	public function insert_new_password_action($id)
	{
		// $this->login_check();
		if (!$this->session->tempdata('forget_password')) {
			$this->session->set_flashdata('error', 'Session expired');
			redirect('forget_password/email_check/');
		}

		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('confirmPassword', 'confirmPassword', 'required|matches[password]');

		if ($this->form_validation->run() == false) {
			$this->session->set_flashdata('error', 'Password Not Matched');
			redirect('forget_password/new_password/');
			// echo (validation_errors());
		}
		$password = $this->input->post('password');
		$this->ForgetPasswordModel->insert_new_password($id, $password);

		$user = $this->db->get_where('users', ['user_id' => $id])->row();

		$mail['email'] = $user->email;
		$mail['template_id'] = 17916830;
		$mail['details'] = [
			"name" => $user->name,
			"email" => $user->email,
			"login_url" => base_url('login'),
		];

		$this->postmark($mail);


		$this->session->set_flashdata('success', 'Password Updated Successfully');
		redirect('forget_password/new_password/');
	}
	// public function login_check()
	// {
	//    if(!$this->session->userdata('user_id'));
	//    return redirect('login');
	// }
}