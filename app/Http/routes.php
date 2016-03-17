<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => 'users'], function () {
    Route::get('/', ['uses' => 'UserController@index', 'as' => 'users.index']);
});

// Basic route to get us into the application.
Route::get('/', function () {
    return view('main');
});
