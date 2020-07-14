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

Route::get('/','PagesController@index');
Route::get('/about','PagesController@about');
Route::get('/services','PagesController@services');
Route::resource('post','PostsController');

// Route::get('/hello', function () {
//     // return view('welcome');
//     return "<h1>Hello World</h1>";
// });


Auth::routes();

Route::get('/Dashboard', 'DashboardController@index'); 
