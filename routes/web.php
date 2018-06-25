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

/*
Route::get('/', function () {
    return view('welcome');
});*/

/*
Route::get('/hello', function () {
    //return view('welcome');
    return("Hello World");
});*/

Route::get('/index','PagesController@index');

Route::get('/about','PagesController@about') ;

Route::get('/services','PagesController@services');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::resource('/posts', 'PostsController');

//Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
   // \UniSharp\LaravelFilemanager\Lfm::routes();
//});
/*
Route::get('/users/{id}', function ($id) {
    //return view('welcome');
    return 'This is user' .$id;
});*/
//Auth::routes();

//Route::get('/home', 'HomeController@index');



//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
