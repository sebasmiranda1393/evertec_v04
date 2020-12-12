<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'customers'], function () {
    Route::get('edit/{id}', 'CustomerController@edit')->name('customers.edit');
    Route::post('update/{user}', 'CustomerController@update')->name('customers.update');
    Route::get('back', 'CustomerController@back')->name('customers.back');
});

Route::resource('home', HomeController::class);

Route::resource('product', ProductController::class);

Route::group(['prefix' => 'products'], function () {
    Route::get('back', 'CustomerController@backCustomer')->name('backCustomer');
    Route::get('description/{id}', 'ProductController@description')->name('product.description')->middleware('roleCustomer');
});

route::resource('admin', AdminController::class)->middleware('roleAdmin');

Route::resource('excel', ImportProductController::class)->only(["show", "store", "index"]);
Route::group(['prefix' => 'excel'], function () {
    Route::get('export', 'ImportProductController@exportProducts')->name('excel.exportProducts');

});

Route::resource('report', ReportController::class)->only([ "create"]);
Route::group(['prefix' => 'report'], function () {
    Route::post('byDate', 'ReportController@reportByDateTopSellingProduct')->name('reportByDateTopSellingProduct');
    Route::post('report', 'ReportController@higher_quantity')->name('higher_quantity');
    Route::post('stock', 'ReportController@stockProducts')->name('stockProducts');
    Route::post('less_quantity', 'ReportController@less_quantity')->name('less_quantity');
    Route::get('view', 'ReportController@view')->name('view');
    Route::post('download_report', 'ReportController@download_report')->name('download_report');
    Route::get('back', 'ReportController@back')->name('back');
});

route::resource('cart', CartController::class)->middleware('roleCustomer');


route::resource('order', OrderController::class);

Route::group(['prefix' => 'order'], function () {
    Route::get('buyNow/{id}', 'OrderController@buyNow')->name('order.buy_now')->middleware('roleCustomer');
    Route::get('increaseProduct/{id}', 'OrderController@increaseProduct')->name('order.increaseProduct')->middleware('roleCustomer');
    Route::get('decreaseProduct/{id}', 'OrderController@decreaseProduct')->name('order.decreaseProduct')->middleware('roleCustomer');
    Route::get('delete/{id}', 'OrderController@delete')->name('order.delete')->middleware('roleCustomer');
    Route::get('empty/{id}', 'OrderController@empty')->name('order.empty')->middleware('roleCustomer');

    });





