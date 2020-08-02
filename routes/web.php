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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/customer/edit/{id}', 'CustomerController@edit')->name('customer.edit');
Route::post('/customer/update/{id}', 'CustomerController@update')->name('customer.update');
Route::get('/customer/back', 'CustomerController@back')->name('customer.back');
Route::get('/customer/back', 'CustomerController@back')->name('customer.back');
Route::get('/product/index', 'ProductController@index')->name('product');
Route::get('/product/create', 'ProductController@create')->name('product.create');





