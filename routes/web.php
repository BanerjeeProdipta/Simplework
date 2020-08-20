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

Route::get('/', 'ArticleController@welcome');

Route::get('/about', 'ArticleController@about');

Route::get('/articles', 'ArticleController@index');

Route::get('/articles/{article}', 'ArticleController@show'); 


Route::get('/profile', 'ArticleController@profile')->middleware('auth');


Route::post('/articles', 'ArticleController@store')->middleware('auth');

Route::get('/articles/{article}/edit', 'ArticleController@edit')->middleware('auth');

Route::put('/articles/{article}', 'ArticleController@update')->middleware('auth');

Route::get('/articles/{article}/delete', 'ArticleController@destroy')->middleware('auth');


Route::post('/reply/{article}', 'ReplyController@store')->middleware('auth');

Route::get('/article/{article}/reply/{reply}/edit', 'ReplyController@edit')->middleware('auth');

Route::put('/article/{article}/reply/{reply}/update', 'ReplyController@update')->middleware('auth');

Route::delete('/article/{article}/reply/{reply}/delete', 'ReplyController@destroy')->middleware('auth');


Route::post('/best_reply/{reply}','BestReplyController@store')->middleware('auth');

//Its better to use named routes as the uri might be changed in the future 

Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('auth');

Route::get('/contact', 'ContactController@create')->middleware('auth');

Route::post('/contact', 'ContactController@store')->middleware('auth');

Route::get('/payment', 'PaymentController@create')->middleware('auth');

Route::post('/payment', 'PaymentController@store')->middleware('auth');

Route::get('/notification', 'NotificationController@show')->middleware('auth');
