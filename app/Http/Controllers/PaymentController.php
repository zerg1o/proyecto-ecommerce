<?php

namespace App\Http\Controllers;

use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Config;
use PayPal\Exception\PayPalConnectionException;

class PaymentController extends Controller
{
    private $apiContext;
    public function __construct(){
      $paypalConfig = Config::get('paypal');

      // After Step 1
    $this->apiContext = new ApiContext(
        new OAuthTokenCredential(
            $paypalConfig['client_id'],     // ClientID
            $paypalConfig['secret']      // ClientSecret
        )
    );
    }



    public function payWithPaypal(){
        // After Step 2
        // echo 1;
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        // $amount->setTotal(CartController::getTotal());
        $amount->setTotal('1.00');
        // $amount->setCurrency('PEN');
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $callBackUrl = url('/pay/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callBackUrl)
            ->setCancelUrl($callBackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

            // After Step 3
            try {
                $payment->create($this->apiContext);
                // echo $payment;
                dd($payment->getApprovalLink());
                return redirect()->away($payment->getApprovalLink());
                // echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
            }
            catch (PayPalConnectionException $ex) {
                // This will print the detailed information on the exception.
                //REALLY HELPFUL FOR DEBUGGING
                echo $ex->getData();
            }


    }

    public function status(Request $request){
        return View('payment.status');
        // dd($request->all());
    }
}
