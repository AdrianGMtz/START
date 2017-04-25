<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Middleware\CheckOwnership;
use App\Http\Middleware\CheckRole;

Auth::routes();

Route::get('/', 'CommissionController@index');

Route::get('/profile', 'UserController@show');

Route::get('/profile/edit', 'UserController@edit');

Route::post('/profile/edit', 'UserController@store');

Route::get('/profile/create', 'UserController@create')->middleware(CheckRole::class);

Route::get('/profile/becomeArtist', 'UserController@becomeArtist');

Route::get('/profile/{profile}', 'UserController@showArtist');

Route::post('/commissions', 'CommissionController@create');

Route::get('/commissions/{commission}', 'CommissionController@show');

Route::get('/commissions/{commission}/edit', 'CommissionController@edit')->middleware(CheckOwnership::class);

Route::post('/commissions/{commission}/edit', 'CommissionController@store');

Route::get('/commissions/{commission}/delete', 'CommissionController@delete')->middleware(CheckOwnership::class);

Route::get('/settings', 'SettingsController@show');

Route::post('/settings', 'SettingsController@changePassword');

Route::get('/register/verify/{token}', 'Auth\RegisterController@verify'); 
