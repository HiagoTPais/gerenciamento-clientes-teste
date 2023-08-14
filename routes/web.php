<?php

use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function() { return redirect('/seller'); });

    Route::get('/seller', 'SellerController@index')->name('seller');

    Route::get('/seller-create', 'SellerController@create');

    Route::post('/seller-store', 'SellerController@store');

    Route::get('/seller-delete/{id}', 'SellerController@delete');

    Route::get('/seller-edit/{id}', 'SellerController@edit');

    Route::put('/seller-update/{id}', 'SellerController@update');
    

    Route::get('/customer', 'CustomerController@index');

    Route::get('/customer-create', 'CustomerController@create');

    Route::post('/customer-store', 'CustomerController@store');

    Route::get('/customer-delete/{id}', 'CustomerController@delete');

    Route::get('/customer-edit/{id}', 'CustomerController@edit');

    Route::put('/customer-update/{id}', 'CustomerController@update'); 
});

Auth::routes();