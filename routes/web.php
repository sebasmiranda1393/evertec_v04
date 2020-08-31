<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/customer/edit/{user}', 'CustomerController@edit')->name('customer.edit');
Route::post('/customer/update/{user}', 'CustomerController@update')->name('customer.update');
Route::get('/customer/back', 'CustomerController@back')->name('customer.back');
Route::get('/customer/back', 'CustomerController@back')->name('customer.back');
Route::get('/product/index', 'ProductController@index')->name('product');
Route::get('/product/create', 'ProductController@create')->name('product.create');
Route::post('/product/save',  'ProductController@save')->name('product.save');
Route::get('/product/edit/{product}', 'ProductController@edit')->name('product.edit');
Route::post('/product/update/{product}',  'ProductController@update')->name('product.update');
Route::get('/product/search/{id}',  'ProductController@search')->name('product.search');
Route::post('statuses', 'StatusesController@store')->name('statuses.store');
Route::get('/product/customer',  'HomeController@indexejemplo')->name('product.customer');
Route::get('/product/customer',  'HomeController@home')->name('product.customer');
Route::get('cart', 'ProductController@cart')->name('product.cart');

Route::get('/product/add-to-cart/{id}', 'ProductController@addToCart')->name('product.add-to-cart');





