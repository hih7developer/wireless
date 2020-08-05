<?php 

require 'vendor/autoload.php';
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class Payment extends CI_Model
{

    private $authorize;
    
    public function __construct(){
        parent::__construct();
        $this->authorize['merchant_login_id'] = $this->config->item('authorize_net_merchant_login_id');
        $this->authorize['merchant_transaction_key'] = $this->config->item('authorize_net_merchant_transaction_key');

    }

    public function check_payment_method_exists($user_id){
        $result = $this->db->get_where('payment_methods', ['user_id' => $user_id])->row();
        if(empty($result))
            return false;
        return $result;
    }
    
    public function create_customer_profile($card_details, $user_id){

        $user = $this->db->get_where('users', ['user_id' => $user_id])->row();

        /* Create a merchantAuthenticationType object with authentication details
       retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($this->authorize['merchant_login_id']);
        $merchantAuthentication->setTransactionKey($this->authorize['merchant_transaction_key']);
        
        // Set the transaction's refId
        $refId = 'ref' . time();

        // Set credit card information for payment profile
        $creditCard = new AnetAPI\CreditCardType();
        $creditCard->setCardNumber((int) $card_details['card_number']);
        $creditCard->setExpirationDate(date('Y-m', strtotime($card_details['expiry'])));
        $creditCard->setCardCode($card_details['cvc']);
        $paymentCreditCard = new AnetAPI\PaymentType();
        $paymentCreditCard->setCreditCard($creditCard);

        // Create a new CustomerPaymentProfile object
        $paymentProfile = new AnetAPI\CustomerPaymentProfileType();
        $paymentProfile->setCustomerType('individual');
        $paymentProfile->setPayment($paymentCreditCard);
        $paymentProfiles[] = $paymentProfile;


		// Create a new CustomerProfileType and add the payment profile object
		$role = ucwords($this->db->get_where('roles', ['role_id' => $user->role_id])->row()->name);
        $customerProfile = new AnetAPI\CustomerProfileType();
        $customerProfile->setDescription("$role: $user->name");
        $customerProfile->setMerchantCustomerId("M_" . time());
        $customerProfile->setEmail($user->email);
        $customerProfile->setpaymentProfiles($paymentProfiles);


        // Assemble the complete transaction request
        $request = new AnetAPI\CreateCustomerProfileRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId($refId);
        $request->setProfile($customerProfile);

        // Create the controller and get the response
        $controller = new AnetController\CreateCustomerProfileController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        // $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::SANDBOX);

        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok")) {
            $paymentProfiles = $response->getCustomerPaymentProfileIdList();

            $payment_method['user_id'] = $user_id;
            $payment_method['card_name'] = $card_details['card_name'];
            $payment_method['card_number'] = substr($card_details['card_number'], -4);
            $payment_method['expiry'] = date('Y-m', strtotime($card_details['expiry']));
            $payment_method['customer_profile_id'] = $response->getCustomerProfileId();
            $payment_method['customer_payment_profile_id'] = $paymentProfiles[0];
            $payment_method['is_validated'] = 1;

            
            $this->db->insert('payment_methods', $payment_method);
          

            return true;
        } else {
            $errorMessages = $response->getMessages()->getMessage();
            return "Response : " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText();
        }
      
      
    }

    public function update_customer_profile($card_details, $customerProfileId = "1511420207", $customerPaymentProfileId = "1511265906"){

        /* Create a merchantAuthenticationType object with authentication details
        retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($this->authorize['merchant_login_id']);
        $merchantAuthentication->setTransactionKey($this->authorize['merchant_transaction_key']);
        
        // Set the transaction's refId
        $refId = 'ref' . time();

        $request = new AnetAPI\GetCustomerPaymentProfileRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId( $refId);
        $request->setCustomerProfileId($customerProfileId);
        $request->setCustomerPaymentProfileId($customerPaymentProfileId);
        
        $controller = new AnetController\GetCustomerPaymentProfileController($request);
        $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        // $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
   
        if (($response != null) && ($response->getMessages()->getResultCode() == "Ok"))
        {
            $billto = new AnetAPI\CustomerAddressType();
            $billto = $response->getPaymentProfile()->getbillTo();
            
            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber((int) $card_details['card_number'] );
            $creditCard->setExpirationDate($card_details['expiry']);
            $creditCard->setCardCode($card_details['cvc']);

            
            $paymentCreditCard = new AnetAPI\PaymentType();
            $paymentCreditCard->setCreditCard($creditCard);
            $paymentprofile = new AnetAPI\CustomerPaymentProfileExType();
            $paymentprofile->setCustomerPaymentProfileId($customerPaymentProfileId);
            $paymentprofile->setPayment($paymentCreditCard);	

            // Submit a UpdatePaymentProfileRequest
            $request = new AnetAPI\UpdateCustomerPaymentProfileRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setCustomerProfileId($customerProfileId);
            $request->setPaymentProfile( $paymentprofile );

            $controller = new AnetController\UpdateCustomerPaymentProfileController($request);
            $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
            // $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
            if (($response != null) && ($response->getMessages()->getResultCode() == "Ok") )
            {
                $payment_method['card_name'] = $card_details['card_name'];
                $payment_method['card_number'] = substr($card_details['card_number'], -4);
                $payment_method['expiry'] = $card_details['expiry'];
                $payment_method['is_validated'] = 1;
                $payment_method['updated_at'] = date('Y-m-d H:i:s');

                $this->db->update('payment_methods', $payment_method, ['customer_profile_id' => $customerProfileId]);
                return true;
            }
            else if ($response != null)
            {
                $errorMessages = $response->getMessages()->getMessage();
                return "Failed to Update Customer Payment Profile :  " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText();
            }
        }
        else
        {
            return "Failed to Get Customer Payment Profile :  " . $errorMessages[0]->getCode() . "  " .$errorMessages[0]->getText();
        }

    }

    public function chargeCustomerProfile($application_id)
    {
        $application = $this->db->get_where('applications', ['application_id' => $application_id])->row();
        $plan = $this->db->get_where('plans', ['plan_id' => $application->plan_id])->row();
        $user_id = $plan->user_id;
        $payment_methods = $this->db->get_where('payment_methods', ['user_id' => $user_id])->row();

        if(empty($payment_methods)){
            return "Please update your payment method";
        }

        $profileid = $payment_methods->customer_profile_id;
        $paymentprofileid = $payment_methods->customer_payment_profile_id;

        $amount_type = $plan->tribal_plan == 1 ? 'tribal_yes' : 'tribal_no';
		$charge_amount = $this->db->get_where('service_providers', ['user_id' => $user_id])->row()->charge_amount;
		if($charge_amount == null){
            return "Something went wrong";
		} else {
			$charge_amount = json_decode($charge_amount);
		}

		if($plan->tribal_plan == 1 && $plan->lifeline_service == 1)
			$amount = $charge_amount->lifeline_yes_tribal_yes;
		else if($plan->tribal_plan != 1 && $plan->lifeline_service == 1)
			$amount = $charge_amount->lifeline_yes_tribal_no;
		else if($plan->lifeline_service != 1)
			$amount = $charge_amount->lifeline_no;
        /* Create a merchantAuthenticationType object with authentication details
        retrieved from the constants file */
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $merchantAuthentication->setName($this->authorize['merchant_login_id']);
        $merchantAuthentication->setTransactionKey($this->authorize['merchant_transaction_key']);
        
        // Set the transaction's refId
        $refId = 'ref' . time();

        $profileToCharge = new AnetAPI\CustomerProfilePaymentType();
        $profileToCharge->setCustomerProfileId($profileid);
        $paymentProfile = new AnetAPI\PaymentProfileType();
        $paymentProfile->setPaymentProfileId($paymentprofileid);
        $profileToCharge->setPaymentProfile($paymentProfile);

        $transactionRequestType = new AnetAPI\TransactionRequestType();
        $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
        $transactionRequestType->setAmount($amount);
        $transactionRequestType->setProfile($profileToCharge);

        $request = new AnetAPI\CreateTransactionRequest();
        $request->setMerchantAuthentication($merchantAuthentication);
        $request->setRefId( $refId);
        $request->setTransactionRequest( $transactionRequestType);
        $controller = new AnetController\CreateTransactionController($request);
        // $response = $controller->executeWithApiResponse(\net\authorize\api\constants\ANetEnvironment::PRODUCTION);
        $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);

        if ($response != null)
        {
            if($response->getMessages()->getResultCode() == "Ok")
            {
                $tresponse = $response->getTransactionResponse();
                
                if ($tresponse != null && $tresponse->getMessages() != null)   
                {
                    $charge['user_id'] = $user_id;
                    $charge['application_id'] = $application_id;
                    $charge['amount'] = $amount;
                    $charge['status'] = 'paid';
                    $charge['auth_code'] = $tresponse->getAuthCode();
                    $charge['transaction_id'] = $tresponse->getTransId();

                    $this->db->insert('charges', $charge);

                    return true;
                }
                else
                {
                    $error = "Transaction Failed.";
                    if($tresponse->getErrors() != null)
                    {
                        $error .= " Error code  : " . $tresponse->getErrors()[0]->getErrorCode();
                        $error .= " Error message : " . $tresponse->getErrors()[0]->getErrorText();            
                    }


                    // is validated set to 0
                    $payment_method['is_validated'] = 0;
                    $this->db->update('payment_methods', $payment_method, ['user_id' => $user_id]);

                    return $error;
                }
            }
            else
            {
                $error = "Transaction Failed";
                $tresponse = $response->getTransactionResponse();
                if($tresponse != null && $tresponse->getErrors() != null)
                {
                    $error .= " Error code  : " . $tresponse->getErrors()[0]->getErrorCode();
                    $error .= " Error message : " . $tresponse->getErrors()[0]->getErrorText();                      
                }
                else
                {
                    $error .= " Error code  : " . $response->getMessages()->getMessage()[0]->getCode();
                    $error .= " Error message : " . $response->getMessages()->getMessage()[0]->getText();
                }


                // is validated set to 0
                $payment_method['is_validated'] = 0;
                $this->db->update('payment_methods', $payment_method, ['user_id' => $user_id]);


                return $error;
            }
        }
        else
        {
            return  "No response returned";
        }
    }

    public function get_customer_profile($customer_profile_id = 1511419029){
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

    public function payment_method($user_id){
        $payment_method = $this->db->get_where('payment_methods', ['user_id' => $user_id])->row();

        if(empty($payment_method)){
            return true;
        }

        if($payment_method->is_validated == 2){
            return false;
        }

        return true;

    }
}

?>
