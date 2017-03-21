<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
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
    	
    	// $commissions = $user->commissions();
    	$commissions = Commission::latest()->where('user_id', $user->id)->get();

    	// dd($commissions);

        return view('profile.show', compact('user', 'commissions'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showArtist(User $profile) {
    	$user = User::find($profile->id);

    	$commissions = Commission::latest()->where('user_id', $user->id)->get();

        return view('profile.show', compact('user', 'commissions'));
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
        auth()->user()->updateUser((request('description')));

     	// return view
    	return redirect('/profile');
    }
}
