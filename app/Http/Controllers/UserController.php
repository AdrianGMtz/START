<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

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

        return view('profile.show', compact('user'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function showArtist() {
        return view('profile.show');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit() {
        return view('profile.edit');
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
