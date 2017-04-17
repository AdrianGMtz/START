<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show() {
        $user = auth()->user();
        return view('profile.settings', compact('user'));
    }

    public function changePassword() {
        // Get form data
        $data = request()->all();

        // Validate form data
        $validator = Validator::make($data, [
            'oldPassword' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        // After data validation
        $validator->after(function ($validator) {
            // Get current authenticated user
            $user = auth()->user();

            // Get current password
            $hashedPassword = $user->password;

            // Get old password
            $oldPassword = request('oldPassword');

            // Get new password
            $newPassword = request('password');
            
            // Check given password is the same as stored password
            if (Hash::check($oldPassword , $hashedPassword)) {
                // Encrypt new password
                $user -> password = bcrypt($newPassword);

                // Save new password
                $user -> save();

                return redirect('/profile');
            } else {
                // Add error message for given password
                $validator->errors()->add('oldPassword', "Credentials don't match!");
            }
        });

        // If there are any errors return them to settings page
        if ($validator->fails()) {
            return redirect('/settings')
                        ->withErrors($validator);
        }

        return redirect('/profile');
    } 
}