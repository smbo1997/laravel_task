<?php
/**
 * Created by PhpStorm.
 * User: Smbat Hambardzumyan
 * Date: 25.02.2017
 * Time: 10:41
 */

namespace App;

use Auth;
use Braintree_Transaction;
use Braintree_Customer;
use Braintree_WebhookNotification;
use Braintree_Subscription;
use Braintree_CreditCard;
use App\Bankcard;
use Braintree\Configuration;


class Payment
{
    public $aa = 'helooo';

    public function addOrder($userId,$amount)
    {

        $getcard = Bankcard::select('*')
            ->where('user_id',$userId)
            ->first();

        $cardnumber =$getcard->card_no;
        $cardmonth = $getcard->exp_month;
        $cardcvc = $getcard->cvc;
        $subscribed= true;
        $customer_id = $this->registerUserOnBrainTree();
       // echo 'customer id - '.$customer_id;/// Create card token
        $card_token = $this->getCardToken($customer_id,$cardnumber,$cardmonth,$cardcvc);
        //echo 'card_token - '.$card_token;
/// gateway will provide this plan id whenever you creat plans there
        $plan_id = '95wb';
        $transction_id = $this->createTransaction($card_token,$customer_id,$plan_id,$subscribed,$amount);
        //dd($transction_id);
    }


    public function registerUserOnBrainTree() {
        $result = Braintree_Customer::create(array(
            'firstName' => Auth::user()->name,
            'lastName' =>  Auth::user()->name,
            'email' =>  Auth::user()->email,
            'phone' => '9999999999'
        ));
        if ($result->success) {
            return $result->customer->id;
        } else {
            $errorFound = '';
            foreach ($result->errors->deepAll() as $error) {
                $errorFound .= $error->message . "<br />";
            }
            echo $errorFound;
        }
    }


    public function getCardToken($customer_id,$cardnumber,$cardmonth,$cardcvc)
    {
        $card_result = Braintree_CreditCard::create(array(
//'cardholderName' => mysql_real_escape_string($_POST['full_name']),
            'number' => $cardnumber,
            'expirationDate' => trim($cardmonth),
            'customerId' => $customer_id,
            'cvv' => $cardcvc
        ));
        if($card_result->success)
        {
            return $card_result->creditCard->token;
        }
        else {
            return false;
        }
    }


    public function createTransaction($creditCardToken,$customerId,$planId,$subscribed,$amount){
        if($subscribed)
        {
            $subscriptionData = array(
                'paymentMethodToken' => $creditCardToken,
                'planId' => $planId
            );

            $this->cancelSubscription();
            $subscription_result = Braintree_Subscription::create($subscriptionData);
            //echo 'Subscription id'. $subscription_result->subscription->id;
        }
        else {
            $this->cancelSubscription();
        }
        $result = Braintree_Transaction::sale(
            [
                'customerId' => $customerId,
                'amount' => $amount,
                'orderId' => '131231'
            ]
        );
        if ($result->success) {
            return $result->transaction->id;
        } else {
            $errorFound = '';
            foreach ($result->errors->deepAll() as $error1) {
                $errorFound .= $error1->message . "<br />";
            }
        }
    }


    public function cancelSubscription()
    {
        $gateway_subscription_id = '';
        if($gateway_subscription_id!='')
        {
            Braintree_Subscription::cancel($gateway_subscription_id);
        }
    }


//// for subscription Braintree_WebhookNotification
    public function subscription()
    {
        try{
            if(isset($_POST["bt_signature"]) && isset($_POST["bt_payload"])) {
                $webhookNotification = Braintree_WebhookNotification::parse(
                    $_POST["bt_signature"], $_POST["bt_payload"]
                );// $message =
// "[Webhook Received " . $webhookNotification->timestamp->format('Y-m-d H:i:s') . "] "
// . "Kind: " . $webhookNotification->kind . " | "
// . "Subscription: " . $webhookNotification->subscription->id . "\n";Log::info("msg " . Log::info("subscription " . json_encode($webhookNotification->subscription));
                Log::info("transactions " . json_encode($webhookNotification->subscription->transactions));
                Log::info("transactions_id " . json_encode($webhookNotification->subscription->transactions[0]->id));
                Log::info("customer_id " . json_encode($webhookNotification->subscription->transactions[0]->customerDetails->id));
                Log::info("amount " . json_encode($webhookNotification->subscription->transactions[0]->amount));
            }
        }
        catch (\Exception $ex) {
            Log::error("PaymentController::subscription() " . $ex->getMessage());
        }
    }
}