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

Route::get('/posts', 'CustomerController@index')->name('posts.index');
Route::get('/posts/details/{id}', 'CustomerController@details')->name('posts.details');
Route::get('/posts/add', 'CustomerController@add')->name('posts.add');
Route::post('/posts/insert', 'CustomerController@insert')->name('posts.insert');
Route::get('/posts/edit/{id}', 'CustomerController@edit')->name('posts.edit');
Route::post('/posts/update/{id}', 'CustomerController@update')->name('posts.update');
Route::get('/posts/delete/{id}', 'CustomerController@delete')->name('posts.delete');
Route::get('/posts/back', 'CustomerController@back')->name('posts.back');





