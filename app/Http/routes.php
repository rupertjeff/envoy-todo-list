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

Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/', ['uses' => 'TaskController@index', 'as' => 'api.tasks.index']);
        Route::post('/', ['uses' => 'TaskController@store', 'as' => 'api.tasks.store']);
        Route::get('{id}', ['uses' => 'TaskController@view', 'as' => 'api.tasks.view']);
        Route::put('{id}/complete', ['uses' => 'TaskController@complete', 'as' => 'api.tasks.complete']);
        Route::delete('{id}', ['uses' => 'TaskController@destroy', 'as' => 'api.tasks.destroy']);
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', ['uses' => 'UserController@index', 'as' => 'api.users.index']);
        Route::post('/', ['uses' => 'UserController@store', 'as' => 'api.users.store']);
        Route::get('{id}', ['uses' => 'UserController@view', 'as' => 'api.users.view']);
        Route::delete('{id}', ['uses' => 'UserController@destroy', 'as' => 'api.users.destroy']);
    });
});

Route::group(['prefix' => 'templates'], function () {
    Route::get('tasks', ['uses' => 'TemplateController@tasks', 'as' => 'templates.tasks.index']);
    Route::get('tasks/create', ['uses' => 'TemplateController@createTask', 'as' => 'templates.tasks.create']);
    Route::get('users', ['uses' => 'TemplateController@users', 'as' => 'templates.users.index']);
    Route::get('users/create', ['uses' => 'TemplateController@createUser', 'as' => 'templates.users.create']);
});

// Basic route to get us into the application.
Route::get('/', function () {
    return view('main');
});
