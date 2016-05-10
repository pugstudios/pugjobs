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
    /* Create */ Route::get('/create', 'User\UserController@create');
    /* Create */ Route::post('/create', 'User\UserController@createPost');
    /* Create */ Route::get('/create/company', 'User\UserController@createCompany');
    /* Login */ Route::get('/login', 'User\UserController@login');
    /* Login */ Route::post('/login', 'User\UserController@loginPost');
    /* Logout */ Route::get('/logout', 'User\UserController@logout');
});

Route::group(['prefix' => 'job'], function () {
    /* Create */ Route::get('/create', 'Job\JobController@create');
    /* Payment */ Route::post('/payment', 'Job\JobController@payment');
    /* Finalize */ Route::post('/payment/finalize', 'Job\JobController@finalize');
});

Route::group(['prefix' => 'payment'], function () {
    /* Payment */ Route::post('/', 'Payment\PaymentController@payment');
    /* Finalize */ Route::post('/finalize', 'Payment\PaymentController@finalize');
});