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

Route::get('/', function () {
    return view('login');
});

Route::post('/', 'ReportingController@merchantLogin');

Route::get('/dashboard', 'ReportingController@getDashboardData');

Route::get('/logout', 'ReportingController@merchantLogout');

Route::get('/transactions', 'ReportingController@getTransactions');

Route::get('/transaction', 'ReportingController@getTransactionDetail');

Route::get('/client', 'ReportingController@getClientDetail');