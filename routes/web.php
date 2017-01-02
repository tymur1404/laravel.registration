<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//registration
Route::get('register' , ['as' => 'register.index' , 'uses' => 'Auth\RegisterController@index']);
Route::get('register/email_code' , ['as' => 'register.email_code' , 'uses' => 'Auth\RegisterController@email_code']);
Route::post('register/add_user' , ['as' => 'register.validate' , 'uses' => 'Auth\RegisterController@add_user']);
Route::post('register/check_code' , ['as' => 'register.check_code' , 'uses' => 'Auth\RegisterController@check_code']);




//login
Route::get('/' , ['as' => 'login.index' , 'uses' => 'Auth\LoginController@index']);
Route::get('logout' , ['as' => 'login.logout' , 'uses' => 'Auth\LoginController@logout']);
Route::get('users' , ['as' => 'login.users' , 'uses' => 'Auth\LoginController@users']);
Route::post('login' , ['as' => 'login.login' , 'uses' => 'Auth\LoginController@login']);

