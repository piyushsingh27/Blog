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



Route::get('/index','PagesController@index');

Route::get('/about','PagesController@about') ;

Route::get('/services','PagesController@services');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('verify/{token}','\App\Http\Controllers\Auth\RegisterController@verify')->name('verify');

//Route::get('verifyEmailFirst','\App\Http\Controllers\Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');

Route::resource('/posts', 'PostsController');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
