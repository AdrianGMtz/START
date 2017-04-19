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

// Profile Routes
Route::get('/profile', 'UserController@show');

Route::get('/profile/edit', 'UserController@edit');

Route::post('/profile/edit', 'UserController@store');

Route::get('/profile/create', 'UserController@create')->middleware(CheckRole::class);

Route::get('/profile/becomeArtist', 'UserController@becomeArtist');

Route::get('/profile/{profile}', 'UserController@showArtist');

// Commission Routes
Route::get('/', 'CommissionController@index');

Route::post('/commissions', 'CommissionController@create');

Route::get('/commissions/{commission}', 'CommissionController@show');

Route::get('/commissions/{commission}/edit', 'CommissionController@edit')->middleware(CheckOwnership::class);

Route::post('/commissions/{commission}/edit', 'CommissionController@store');

Route::get('/commissions/{commission}/delete', 'CommissionController@delete')->middleware(CheckOwnership::class);

// Chat Routes
Route::get('/messages', 'MessageController@show');

Route::get('/message/{id}', 'MessageController@chatHistory');

Route::post('/message/send', 'MessageController@sendMessage');

Route::post('/message/payment', 'MessageController@sendPayment');

// Payment Routes
Route::get('/payment', 'PayPalController@show');

Route::post('/pay', 'PayPalController@postPayment');

Route::get('/pay', 'PayPalController@getPaymentStatus');
