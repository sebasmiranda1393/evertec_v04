<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('c', function () {
    return view('welcome');});

    Route::group(['prefix' => 'customers'], function () {
    Route::get('edit/{id}', 'CustomerController@edit')->name('customers.edit');
    Route::post('update/{user}', 'CustomerController@update')->name('customers.update');
    Route::get('back', 'CustomerController@back')->name('customers.back');
});

Route::resource('home', HomeController::class);

Route::resource('product', ProductController::class)->middleware('roleAdmin');

Route::group(['prefix' => 'products'], function () {
    Route::get('description/{id}', 'ProductController@description')->name('product.description')->middleware('roleCustomer');
});

route::resource('admin', AdminController::class)->middleware('roleAdmin');

Route::resource('excel', ImportExcelController::class);
Route::group(['prefix' => 'excel'], function () {
    Route::get('export', 'ImportExcelController@exportProducts')->name('excel.exportProducts');
});


route::resource('cart', CartController::class)->middleware('roleCustomer');


route::resource('order', OrderController::class);
Route::group(['prefix' => 'order'], function () {
    Route::get('buyNow/{id}', 'OrderController@buyNow')->name('order.buy_now')->middleware('roleCustomer');
    Route::get('increaseProduct/{id}', 'OrderController@increaseProduct')->name('order.increaseProduct')->middleware('roleCustomer');
    Route::get('decreaseProduct/{id}', 'OrderController@decreaseProduct')->name('order.decreaseProduct')->middleware('roleCustomer');
    Route::get('delete/{id}', 'OrderController@delete')->name('order.delete')->middleware('roleCustomer');
});

Route::group(['prefix' => 'order'], function () {
    Route::get('empty/{id}', 'OrderController@empty')->name('order.empty')->middleware('roleCustomer');
    Route::get('increaseProduct/{id}', 'OrderController@increaseProduct')->name('order.increaseProduct')->middleware('roleCustomer');
    Route::get('decreaseProduct/{id}', 'OrderController@decreaseProduct')->name('order.decreaseProduct')->middleware('roleCustomer');
    Route::get('delete/{id}', 'OrderController@delete')->name('order.delete')->middleware('roleCustomer');




});





