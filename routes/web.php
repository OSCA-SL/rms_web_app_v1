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

Route::get('/','HomeController@welcome')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('artists', "ArtistController");

Route::resource('songs', "SongController");

Route::resource('channels', "ChannelController");

Route::resource('fees', "ChannelFeeController");
