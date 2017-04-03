<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Commission;

use Auth;
use Hash;
use Validator;

class SettingsController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show() {

        $user = auth()->user();
        return view('settings.settings', compact('user'));
    }


    public function changePassword()
    {

        $user = auth()->user();
        $hashedPassword = $user->password;

        $oldPass = request('oldPass');
        $newPass = request('newPass');
        $newPass2 = request('newPass2');

        if (Hash::check( $oldPass , $hashedPassword)) {

            $user -> password = bcrypt($newPass);
            $user -> save();

            return redirect('/profile');
        }

        return redirect('/settings');
    } 

    
}