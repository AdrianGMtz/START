<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Commission;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth')->except(['showArtist']);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show() {
		$user = User::find(auth()->user()->id);
		
		$commissions = User::find($user->id)->commissions()->latest()->get();

		$photography_commissions = Commission::latest()->where([['type', 'Photography'],['user_id', $user->id]])->get();
		$digital_commissions = Commission::latest()->where([['type', 'Digital Art'],['user_id', $user->id]])->get();
		$sketch_commissions = Commission::latest()->where([['type', 'Sketch'],['user_id', $user->id]])->get();

		return view('profile.show', compact('user', 'photography_commissions', 'digital_commissions', 'sketch_commissions'));
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showArtist(User $profile) {
		$result = User::where([['artist', true],['id', $profile->id]])->get();
		
		if (!$result->isEmpty()) {
			$user = $result[0];

			$current_user = auth()->user()->id;

			if ($user->id != $current_user) {
				$commissions = User::find($user->id)->commissions()->latest()->get();
				
				$photography_commissions = Commission::latest()->where([['type', 'Photography'],['user_id', $user->id]])->get();
				$digital_commissions = Commission::latest()->where([['type', 'Digital Art'],['user_id', $user->id]])->get();
				$sketch_commissions = Commission::latest()->where([['type', 'Sketch'],['user_id', $user->id]])->get();

				return view('profile.show', compact('user', 'photography_commissions', 'digital_commissions', 'sketch_commissions'));
			}
		}

		return redirect('/profile');
	}

	public function becomeArtist() {

		// Create new post
		$user = auth()->user();
		$user->artist = true;
		$user->save();

	 	// return view
		return redirect('/profile');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit() {
		$user = auth()->user();

		return view('profile.edit', compact('user'));
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('profile.create');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store() {
		// Validate form
	 	$this->validate(request(), [
	 		'description' => 'required|min:2'
	 	]);

	 	// Create new post
		$user = auth()->user();
		$user->description = (request('description'));
		$user->save();

	 	// return view
		return redirect('/profile');
	}
}
