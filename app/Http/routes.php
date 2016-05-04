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

Route::get('/', 'Page\PageController@index');

Route::group(['prefix' => 'user'], function () {
    Route::get('/login', 'User\UserController@login');
    Route::post('/login', 'User\UserController@loginPost');
    Route::get('/create', 'User\UserController@create');
});
