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

Route::group(['prefix' => 'tasks'], function () {
    Route::get('/', ['uses' => 'TaskController@index', 'as' => 'tasks.index']);
    Route::post('/', ['uses' => 'TaskController@store', 'as' => 'tasks.store']);
    Route::delete('{id}', ['uses' => 'TaskController@destroy', 'as' => 'tasks.destroy']);
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', ['uses' => 'UserController@index', 'as' => 'users.index']);
    Route::post('/', ['uses' => 'UserController@store', 'as' => 'users.store']);
    Route::get('{id}', ['uses' => 'UserController@view', 'as' => 'users.view']);
    Route::delete('{id}', ['uses' => 'UserController@destroy', 'as' => 'users.destroy']);
});

// Basic route to get us into the application.
Route::get('/', function () {
    return view('main');
});
