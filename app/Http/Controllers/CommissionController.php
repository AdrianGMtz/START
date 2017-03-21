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
        $commissions = Commission::latest()->get();

        return view('index', compact('commissions'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Commission $commission) {
        return view('commissions.details', compact('commission'));
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Commission $commission) {

        return view('commissions.edit', compact('commission'));
    }
}
