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
use App\Order;
use App\User;
use App\Commission;
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

class OrderController extends Controller
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
		$client_orders = auth()->user()->orders()->latest()->get();

		$user_orders = Order::where('client_id', auth()->user()->id)
			->latest()
			->get();

		return view('orders.orders', compact('client_orders', 'user_orders'));
	}

	/**
	 * Show the pay with paypal page.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showOrder($id)
	{
		$order = Order::find($id);

		$current_user = auth()->user();

		// Verify current user is either the artist of the order or the client
		if ($current_user->id == $order->user_id || $current_user->id == $order->client_id) {
			$artist = ($current_user->id == $order->user_id) ? $current_user : User::find($order->user_id);

			$commission = Commission::find($order->commission_id);

			return view('orders.order', compact('order', 'artist', 'commission'));
		}

		return redirect('/orders');
	}

	/**
	 * Store a details of payment with paypal.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function postPayment(Request $request)
	{
		// Validate form
        $this->validate(request(), [
            'commission_description' => 'required',
            'commission_type' => 'required',
            'commission_price' => 'required',
            'artist_id' => 'required',
            'order_id' => 'required'
        ]);

        // Get Order
        $order_id = $request->get('order_id');

        // Get Artist
        $artist = User::find($request->get('artist_id'));

		// Create new Payer and set it to PayPal
		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		// Create Commission Item
		$item = new Item();
		$item->setName($request->get('commission_description'))
			->setCurrency('USD')
			->setQuantity(1)
			->setDescription($request->get('commission_type'))
			->setPrice($request->get('commission_price'));

		// Add Commission to checkout item list
		$item_list = new ItemList();
		$item_list->setItems(array($item));

		// Set Amount currency and total
		$amount = new Amount();
		$amount->setCurrency('USD')
			->setTotal($request->get('commission_price'));

		// Set artist paypal account
		$payee = new Payee();
		$payee->setEmail($artist->email);

		// Create new transaction with amount, item list and description
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setPayee($payee)
			->setItemList($item_list)
			->setDescription('START Order Payment to ' . $artist->name);

		// Set success and cancel redirect urls
		$redirect_urls = new RedirectUrls();
		$redirect_urls->setReturnUrl(URL::to('/pay/' . $order_id))
			->setCancelUrl(URL::to('/pay/' . $order_id));

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
				$this->validate()->errors()->add('error','Connection timeout');
				return redirect('/orders/' . $order_id);
				// echo "Exception: " . $ex->getMessage() . PHP_EOL;
				// $err_data = json_decode($ex->getData(), true);
				// exit;
			} else {
				$this->validate()->errors()->add('error','Unexpected error occurred, sorry for the inconvenience');
				return redirect('/orders/' . $order_id);
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

		// Add order id to session
		Session::put('order', $request->get('order_id'));

		if(isset($redirect_url)) {
			// redirect to paypal
			return redirect($redirect_url);
		}
		$this->validate()->errors()->add('error','Unknown error occurred');
		return redirect('/orders/' . $order_id);
	}

	/**
	 * Get payment details.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function getPaymentStatus(Request $request)
	{
		// Get the payment ID before session clear
		$payment_id = Session::get('paypal_payment_id');
		
		// clear the session payment ID
		Session::forget('paypal_payment_id');

		// Get order
		$order = Order::find(Session::get('order'));

		// clear the order ID
		Session::forget('order');

		// Verify PlayerID & token are set
		if (empty($request->get('PayerID')) || empty($request->get('token'))) {
			Session::put('error','Payment failed');
			return redirect('/orders/' . $order->id);
		}

		/**
		* PaymentExecution object includes information necessary
		* to execute a PayPal account payment.
		* The payer_id is added to the request query parameters
		* when the user is redirected from paypal back to your site
		*/
		$execution = new PaymentExecution();
		$execution->setPayerId($request->get('PayerID'));

		/**Execute the payment **/
		$payment = Payment::get($payment_id, $this->_api_context);
		$result = $payment->execute($execution, $this->_api_context);
		// dd($result);exit;

		// Verify payment state
		if ($result->getState() == 'approved') { 
			// Update order status to 'paid'
			$order->paid = true;
			$order->save();

			Session::put('success','Payment success');
			return redirect('/orders/' . $order->id);
		}
		Session::put('error','Payment failed');
		return redirect('/orders/' . $order->id);
	}
}
