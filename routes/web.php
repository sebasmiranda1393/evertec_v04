<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {return view('welcome');});


Route::group(['prefix' => 'customers'], function() {
    Route::get('edit/{id}', 'CustomerController@edit')->name('customers.edit');
    Route::post('update/{user}', 'CustomerController@update')->name('customers.update');
    Route::get('back', 'CustomerController@back')->name('customers.back');
});


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::group(['prefix' => 'products'], function(){
    Route::get('index', 'ProductController@index')->name('product');
    Route::get('create', 'ProductController@create')->name('product.create');
    Route::get('edit/{product}', 'ProductController@edit')->name('product.edit');
    Route::get('search/{id}',  'ProductController@search')->name('product.search');
    Route::get('customer',  'HomeController@indexejemplo')->name('product.customer');
    Route::get('customer',  'HomeController@home')->name('product.customer');
    Route::get('back', 'productController@back')->name('product.back');
    Route::get('description',  'ProductController@description')->name('product.description');
    Route::get('description/{id}',  'ProductController@description')->name('product.description');
    Route::post('store',  'ProductController@store')->name('product.store');
    Route::post('update/{product}',  'ProductController@update')->name('product.update');
    Route::delete('delete/{product}',  'ProductController@delete')->name('product.delete');
});


Route::group(['prefix' => 'admin'], function(){
    Route::get('home',  'AdminController@home')->name('admin.home');
    Route::get('search/{id}',  'AdminController@search')->name('admin.search');
    Route::get('welcome',  'AdminController@welcome')->name('admin.welcome');
});

Route::group(['prefix' => 'carts'], function(){
    Route::get('delete/{id}',  'CartController@delete')->name('cart.delete');
    Route::get('increaseProduct/{id}',  'CartController@increaseProduct')->name('cart.increaseProduct');
    Route::get('decreaseProduct/{id}',  'CartController@decreaseProduct')->name('cart.decreaseProduct');
    Route::get('listCarts',  'CartController@listCarts')->name('list.carts');
    Route::get('emptyCar',  'CartController@emptyCar')->name('cart.emptyCar');
    Route::get('saveCart',  'CartController@saveCart')->name('saveCart');
    Route::get('carts', 'CartController@cart')->name('cart.cart');
    Route::get('add-to-cart/{id}', 'CartController@addToCart')->name('cart.add-to-cart');
    Route::post('update', 'CartController@update')->name('cart.update');
});



Route::post('statuses', 'StatusesController@store')->name('statuses.store');



