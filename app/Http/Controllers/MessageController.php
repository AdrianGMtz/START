<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Nahid\Talk\Facades\Talk;
use Auth;
use View;

class MessageController extends Controller
{
	protected $authUser;
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function show()
	{
		$user = Auth::user();

		Talk::setAuthUserId($user->id);

		$threads = Talk::threads();

		$messages = [];

		return view('chat.chat', compact('threads', 'messages', 'user'));
	}

	public function chatHistory($id)
	{
		$user = Auth::user();

		if ($user->id == $id) {
			return redirect('/messages');
		}

		Talk::setAuthUserId($user->id);

		$threads = Talk::threads();

		$conversations = Talk::getMessagesByUserId($id);
		$user = '';
		$messages = [];
		if(!$conversations) {
			$user = User::find($id);
		} else {
			$user = $conversations->withUser;
			$messages = $conversations->messages;
		}

		return view('chat.chat', compact('threads', 'messages', 'user'));
	}

	public function ajaxSendMessage(Request $request)
	{
		$rules = [
			'message-data' => 'required',
			'_id' => 'required',
			'type' => 'required'
		];

		$this->validate($request, $rules);

		$body = $request->input('message-data');
		$userId = $request->input('_id');
		// Type 1 (Text), 2 (File), 3 (Payment)
		$messageType = $request->input('type');
		Talk::setAuthUserId(Auth::user()->id);
		
		if ($message = Talk::sendMessageByUserId($userId, $body, $messageType)) {
			$html = view('chat.newMessageHtml', compact('message'))->render();
			return response()->json(['status'=>'success', 'html'=>$html], 200);
		}
	}
}
