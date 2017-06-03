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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('dates', 'DateController');
Route::resource('posts', 'PostController');
Route::resource('terms', 'TermController');
Route::post('timeline/{slug}/relation', 'TermController@relation')->where('slug', '[a-z,0-9-]+');
Route::post('timeline/{slug}/date/{id}/post', 'TermController@post')->where('slug', '[a-z,0-9-]+');
Route::post('timeline/{slug}/date', 'TermController@date')->where('slug', '[a-z,0-9-]+');
Route::get('timeline/{slug}', 'WebController@timeline')->where('slug', '[a-z,0-9-]+')->name('timeline');
