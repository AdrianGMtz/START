<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use View;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
/** All Paypal Details class **/
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payee;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PayPalController extends Controller
{
	private $_api_context;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
		
		// setup PayPal api context
		$paypal_conf = \Config::get('paypal');
		$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
	}

	/**
	 * Show the pay with paypal page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show()
	{
		return view('payment.pay');
	}

	/**
	 * Store a details of payment with paypal.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postPayment(Request $request)
	{
		// Create new Payer and set it to PayPal
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		// Create Commission Item
		$item_1 = new Item();
		$item_1->setName('Item 1')
			->setCurrency('USD')
			->setQuantity(1)
			->setDescription('Commission')
			->setPrice($request->get('amount'));

		// Add Commission to checkout item list
		$item_list = new ItemList();
		$item_list->setItems(array($item_1));

		// Set Amount currency and total
		$amount = new Amount();
		$amount->setCurrency('USD')
			->setTotal($request->get('amount'));

		// Set artist paypal account
		$payee = new Payee();
		$payee->setEmail('marco@example.com');

		// Create new transaction with amount, item list and description
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setPayee($payee)
			->setItemList($item_list)
			->setDescription('START Commission Payment');

		// Set success and cancel redirect urls
		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(URL::to('/pay'))
			->setCancelUrl(URL::to('/pay'));

		// Create new payment with payer, transaction and redirect urls
		$payment = new Payment();
		$payment->setIntent('Sale')
			->setPayer($payer)
			->setRedirectUrls($redirect_urls)
			->setTransactions(array($transaction));
		// dd($payment->create($this->_api_context));exit;

		try {
			$payment->create($this->_api_context);
		} catch (\PayPal\Exception\PPConnectionException $ex) {
			if (\Config::get('app.debug')) {
				\Session::put('error','Connection timeout');
				return Redirect::route('/payment');
				// echo "Exception: " . $ex->getMessage() . PHP_EOL;
				// $err_data = json_decode($ex->getData(), true);
				// exit;
			} else {
				\Session::put('error','Unexpected error occurred, sorry for the inconvenience');
				return Redirect::route('/payment');
				// die('Some error occur, sorry for inconvenient');
			}
		}
		foreach($payment->getLinks() as $link) {
			if($link->getRel() == 'approval_url') {
				$redirect_url = $link->getHref();
				break;
			}
		}
		// add payment ID to session
		Session::put('paypal_payment_id', $payment->getId());
		if(isset($redirect_url)) {
			// redirect to paypal
			return Redirect::away($redirect_url);
		}
		\Session::put('error','Unknown error occurred');
		return Redirect::route('/payment');
	}

	/**
	 * Get payment details.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getPaymentStatus()
	{
		// Get the payment ID before session clear
		$payment_id = Session::get('paypal_payment_id');
		
		// clear the session payment ID
		Session::forget('paypal_payment_id');

		// Verify PlayerID & token are set
		if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
			\Session::put('error','Payment failed');
			return Redirect::route('/payment');
		}

		/**
		* PaymentExecution object includes information necessary
		* to execute a PayPal account payment.
		* The payer_id is added to the request query parameters
		* when the user is redirected from paypal back to your site
		*/
		$execution = new PaymentExecution();
		$execution->setPayerId(Input::get('PayerID'));

		/**Execute the payment **/
		$payment = Payment::get($payment_id, $this->_api_context);
		$result = $payment->execute($execution, $this->_api_context);
		// dd($result);exit;

		// Verify payment state
		if ($result->getState() == 'approved') { 
			// Here Write your database logic like that insert record or value in database if you want
			\Session::put('success','Payment success');
			return Redirect::route('/payment');
		}
		\Session::put('error','Payment failed');
		return Redirect::route('/payment');
	}
}
