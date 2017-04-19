<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Nahid\Talk\Facades\Talk;
use Auth;
use View;

use App\Order;

class MessageController extends Controller
{
	protected $authUser;
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function show()
	{
		$requested_user = auth()->user();

		Talk::setAuthUserId($requested_user->id);

		$threads = Talk::threads();

		$messages = [];
		$commissions = $requested_user->commissions;

		return view('chat.chat', compact('threads', 'messages', 'requested_user', 'commissions'));
	}

	public function chatHistory($id)
	{
		// Get the current user
		$current_user = auth()->user();

		// If chat requested is the same user ID redirect
		if ($current_user->id == $id) {
			return redirect('/messages');
		}

		// Get the requested user
		$requested_user = User::find($id);

		// If current user and requested user are not artists redirect
		if (($current_user->artist == 0) && ($requested_user->artist == 0)) {
			return redirect('/messages');
		}

		// Set Talk with current user
		Talk::setAuthUserId($current_user->id);

		// Get all conversations for current user
		$threads = Talk::threads();
		
		// Get conversation between current user and requested user
		$conversation = Talk::getMessagesByUserId($id);

		$messages = [];
		$commissions = [];

		// Fetch messages if conversation exists
		if($conversation) {
			$messages = $conversation->messages;
		}

		// If current user is an artist, fetch commissions
		if ($current_user->artist == 1) {
			$commissions = $current_user->commissions;
		}

		return view('chat.chat', compact('threads', 'messages', 'requested_user', 'commissions'));
	}

	public function sendPayment(Request $request)
	{
		// Validate form
		$this->validate(request(), [
			'commission_id' => 'required',
			'message-data' => 'required',
			'client_id' => 'required',
			'type' => 'required'
		]);

		$body = request('message-data');
		$client_id = request('client_id');
		// Type 1 (Text), 2 (File), 3 (Payment)
		$messageType = request('type');
		Talk::setAuthUserId(auth()->user()->id);

		auth()->user()->order(
			new Order(request(['commission_id', 'client_id']))
		);
		
		if ($message = Talk::sendMessageByUserId($client_id, $body, $messageType)) {
			$html = view('chat.newMessageHtml', compact('message'))->render();
			return response()->json(['status'=>'success', 'html'=>$html], 200);
		}
	}

	public function sendMessage(Request $request)
	{
		// Validate form
		$this->validate(request(), [
			'message-data' => 'required',
			'_id' => 'required',
			'type' => 'required'
		]);

		$body = request('message-data');
		$userId = request('_id');
		// Type 1 (Text), 2 (File), 3 (Payment)
		$messageType = request('type');
		Talk::setAuthUserId(auth()->user()->id);
		
		if ($message = Talk::sendMessageByUserId($userId, $body, $messageType)) {
			$html = view('chat.newMessageHtml', compact('message'))->render();
			return response()->json(['status'=>'success', 'html'=>$html], 200);
		}
	}
}
