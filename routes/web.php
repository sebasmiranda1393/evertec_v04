<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {return view('welcome');});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/Admin/edit/{user}', 'AdminController@edit')->name('admin.edit');

Route::post('/Admin/update/{user}', 'AdminController@update')->name('admin.update');

Route::get('/Admin/back', 'AdminController@back')->name('admin.back');

Route::get('/Admin/back', 'AdminController@back')->name('admin.back');

Route::get('/product/index', 'ProductController@index')->name('product');

Route::get('/product/create', 'ProductController@create')->name('product.create');

Route::post('/product/save',  'ProductController@save')->name('product.save');

Route::get('/product/edit/{product}', 'ProductController@edit')->name('product.edit');

Route::post('/product/update/{product}',  'ProductController@update')->name('product.update');

Route::get('/product/search/{id}',  'ProductController@search')->name('product.search');

Route::post('statuses', 'StatusesController@store')->name('statuses.store');

Route::get('/product/customer',  'HomeController@indexejemplo')->name('product.customer');

Route::get('/cart/guardarCarrito',  'CartController@guardarCarrito')->name('cart.guardarCarrito');


Route::get('/product/customer',  'HomeController@home')->name('product.customer');

Route::get('cart', 'CartController@cart')->name('cart.cart');

Route::get('/cart/add-to-cart/{id}', 'CartController@addToCart')->name('cart.add-to-cart');

Route::get('/product/back', 'productController@back')->name('product.back');

Route::post('/cart/update', 'CartController@update')->name('cart.update');

Route::get('/Admin/home',  'AdminController@home')->name('admin.home');

Route::get('/Admin/search/{id}',  'AdminController@search')->name('admin.search');

Route::get('/Product/description',  'ProductController@description')->name('product.description');

Route::get('/Admin/welcome',  'AdminController@welcome')->name('admin.welcome');

Route::get('/cart/delete',  'CartController@delete')->name('cart.delete');

Route::put('/cart/update',  'CartController@update')->name('cart.update');



