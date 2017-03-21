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

Auth::routes();

Route::get('/', 'CommissionController@index');

Route::get('/profile', 'UserController@show');

Route::get('/profile/edit', 'UserController@edit');

Route::post('/profile/edit', 'UserController@store');

Route::get('/profile/create', 'UserController@create');

Route::post('/commissions', 'CommissionController@store');

//Route::get('/profile/{profile}', 'UserController@showArtist');


