<?php

namespace App\Http\Controllers;

use App\Points;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Config;
use URL;
use Session;
use Illuminate\Support\Facades\Input;
use App\User;
use Auth;



class PaypalController extends BaseController
{

    private $_api_context;

    public function __construct()
    {


        // setup PayPal api context
        $paypal_conf = Config::get('paypal');

            $client_id = env('CLIENT_ID');
            $secret = env('SECRET');

            $this->_api_context = new ApiContext(new OAuthTokenCredential($client_id, $secret));
            $this->_api_context->setConfig($paypal_conf['settings']);

    }






    public function postPayment($charge , Request $request)
    {
        $request->session()->put('charge', $charge);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $items = [];


        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($charge);

        // add item to list
        $item_list = new ItemList();
        $item_list->setItems($items);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('You will be charged ' .$amount->total.'$');


        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status'))
            ->setCancelUrl(URL::route('payment.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));


        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            if (\Config::get('app.debug')) {

                echo "Exception: " . $ex->getMessage() . PHP_EOL;

                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            // redirect to paypal
            return redirect()->away($redirect_url);
        }

        return redirect()->route('original.route')
            ->with('error', 'Unknown error occurred');
    }


    public function getPaymentStatus(Request $request)
    {

        // Get the payment ID before session clear
        $payment_id = Input::get('paymentId');

        if (!Input::has('PayerID') || !Input::has('token')) {
            Session::flash('error_msg', 'An unknown error occurred. We are sorry for the inconvenience.');
            return redirect()->back()->withInput(Input::all());
        }

        $payment = \PayPal\Api\Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        try {
            $result = $payment->execute($execution, $this->_api_context);
        } catch (\Exception $e) {
            Session::flash('error_msg', 'An unknown error occurred. We are sorry for the inconvenience.');
            return redirect()->back()->withInput(Input::all());
        }


        if ($result->getState() == 'approved') { // payment made

            $charge=$request->session()->pull('charge', 'default');

            $points=Points::where('amount',$charge)->first();

                User::whereId(Auth::user()->id)->increment('points',$points->points);


            return redirect('/dashboard');


        }

        Session::flash('error_msg', 'An unknown error occurred. We are sorry for the inconvenience.');
        return redirect()->back()->withInput(Input::all());


    }

    public function postMembership($charge)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $items = [];


        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($charge);

        // add item to list
        $item_list = new ItemList();
        $item_list->setItems($items);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('You will be charged ' .$amount->total.'$');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('membership.status'))
            ->setCancelUrl(URL::route('membership.status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));


        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            if (\Config::get('app.debug')) {

                echo "Exception: " . $ex->getMessage() . PHP_EOL;

                $err_data = json_decode($ex->getData(), true);
                exit;
            } else {
                die('Some error occur, sorry for inconvenient');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            // redirect to paypal
            return redirect()->away($redirect_url);
        }

        return redirect()->route('original.route')
            ->with('error', 'Unknown error occurred');
    }


    public function getMembershipStatus()
    {

        // Get the payment ID before session clear
        $payment_id = Input::get('paymentId');

        if (!Input::has('PayerID') || !Input::has('token')) {
            Session::flash('error_msg', 'An unknown error occurred. We are sorry for the inconvenience.');
            return redirect()->back()->withInput(Input::all());
        }

        $payment = \PayPal\Api\Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Execute the payment
        try {
            $result = $payment->execute($execution, $this->_api_context);
        } catch (\Exception $e) {
            Session::flash('error_msg', 'An unknown error occurred. We are sorry for the inconvenience.');
            return redirect()->back()->withInput(Input::all());
        }


        if ($result->getState() == 'approved') { // payment made

                User::whereId(Auth::user()->id)->update(['membership' => "paid"]);

            return redirect('/dashboard');


        }

        Session::flash('error_msg', 'An unknown error occurred. We are sorry for the inconvenience.');
        return redirect()->back()->withInput(Input::all());


    }

}