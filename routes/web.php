<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'customers'], function () {
    Route::get('edit/{id}', 'CustomerController@edit')->name('customers.edit');
    Route::post('update/{user}', 'CustomerController@update')->name('customers.update');
    Route::get('back', 'CustomerController@back')->name('customers.back');
});


Auth::routes(['verify' => true]);


Route::resource('home', HomeController::class);

Route::resource('product', ProductController::class)->middleware('roleAdmin');
Route::group(['prefix' => 'products'], function () {
    Route::get('description/{id}', 'ProductController@description')->name('product.description')->middleware('roleCustomer');
});


Route::group(['prefix' => 'admin'], function () {
    Route::get('home', 'AdminController@home')->name('admin.home')->middleware('roleAdmin');
    Route::get('search/{id}', 'AdminController@search')->name('admin.search')->middleware('roleAdmin');
    Route::get('welcome', 'AdminController@welcome')->name('admin.welcome')->middleware('roleAdmin');
});

Route::group(['prefix' => 'carts'], function () {
    Route::get('delete/{id}', 'CartController@delete')->name('cart.delete')->middleware('roleCustomer');
    Route::get('increaseProduct/{id}', 'CartController@increaseProduct')->name('cart.increaseProduct')->middleware('roleCustomer');
    Route::get('decreaseProduct/{id}', 'CartController@decreaseProduct')->name('cart.decreaseProduct')->middleware('roleCustomer');
    Route::get('listCarts', 'CartController@listCarts')->name('list.carts')->middleware('roleCustomer');
    Route::get('myCarts/{id}', 'CartController@myCarts')->name('myCarts.carts')->middleware('roleCustomer');
    Route::get('emptyCar', 'CartController@emptyCar')->name('cart.emptyCar')->middleware('roleCustomer');
    Route::get('saveCart', 'CartController@saveCart')->name('saveCart')->middleware('roleCustomer');
    Route::get('carts', 'CartController@cart')->name('cart.cart')->middleware('roleCustomer');
    Route::get('add-to-cart/{id}', 'CartController@addToCart')->name('cart.add-to-cart')->middleware('roleCustomer');
    Route::post('update', 'CartController@update')->name('cart.update')->middleware('roleCustomer');


});


Route::post('statuses', 'StatusesController@store')->name('statuses.store');



