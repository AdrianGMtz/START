<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Commission;

class CommissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show() {
        return view('commissions.details');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store() {
        // Validate form
        $this->validate(request(), [
            'description' => 'required|min:2',
            'type' => 'required',
            'price' => 'required'
        ]);

        // Create new post
        auth()->user()->publish(
            new Commission(request(['description', 'type', 'price']))
        );

        // return view
        return redirect('/profile');
    }
}
