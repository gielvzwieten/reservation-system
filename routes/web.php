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
    return view('welcome');
});

Auth::routes();


Route::resource('/reservations', 'ReservationController')->except('index');
Route::get('/reservations/{year?}/{month?}', 'ReservationController@index')->name('reservations.index');


Route::get('/invoices/{reservation}', 'InvoiceController@show')->name('invoices.show');

//Route::resource('/invoices', 'InvoiceController');