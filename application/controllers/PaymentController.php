<?php

require 'vendor/autoload.php';

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use Postmark\PostmarkClient;

class PaymentController extends CI_Controller
{

	private $authorize;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('payment');
		$this->authorize['merchant_login_id'] = '4KJH456Lvrs';
		$this->authorize['merchant_transaction_key'] = '978g423XUfZ9Gwn7';
		// $this->authorize['merchant_login_id'] = '8X7vDXDb4m4F';
		// $this->authorize['merchant_transaction_key'] = '5p3b876U3As34MkK';

	}

	public function update_payment_method($user_id)
	{

		$card_deatils['card_name'] = ucwords(strtolower($this->input->post('name')));
		$card_deatils['card_number'] = (int) preg_replace('/\s+/', '', $this->input->post('number'));
		$expiry = explode('/', preg_replace('/\s+/', '', $this->input->post('expiry')));
		$card_deatils['expiry'] = '20' . $expiry[1] . '-' . $expiry[0];
		$card_deatils['cvc'] = $this->input->post('cvc');

		// print_r($card_deatils);die;
		$exist_payment = $this->payment->check_payment_method_exists($user_id);

		// print_r($payment_method);
		if ($exist_payment === false) {
			$result = $this->payment->create_customer_profile($card_deatils, $user_id);
		} else {
			// print_r($card_deatils);die;
			$result = $this->payment->update_customer_profile($card_deatils, $exist_payment->customer_profile_id, $exist_payment->customer_payment_profile_id);
		}



		if ($result === true) {
			$user = $this->db->get_where('users', ['user_id' => $user_id])->row();
			$mail['email'] = $user->email;
			$mail['template_id'] = 17917793;
			$mail['details'] = [
				"name" => $user->name,
				"login_url" => base_url('login'),
			];

			try {
				$this->postmark($mail);
			} catch (\Throwable $th) {
				$this->session->set_flashdata('error', 'Mail not sent for internal error');
			}

			$this->session->set_flashdata('success', 'Payment method updated');
		} else {
			$this->session->set_flashdata('error', $result);
		}
		// die;
		return redirect('carrier_admin/profile/');
	}

	public function get_customer_profile($customer_profile_id = 1511419029)
	{
		/* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		$merchantAuthentication->setName($this->authorize['merchant_login_id']);
		$merchantAuthentication->setTransactionKey($this->authorize['merchant_transaction_key']);

		$request = new AnetAPI\GetCustomerProfileRequest();
		$request->setMerchantAuthentication($merchantAuthentication);
		$request->setCustomerProfileId($customer_profile_id);
		$controller = new AnetController\GetCustomerProfileController($request);
		$response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
		// $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
		echo '<pre>';
		print_r($response->getProfile());
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