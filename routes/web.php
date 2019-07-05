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

Route::group(['domain' => 'rms.'.env('APP_DOMAIN', 'localhost')], function () {

    Route::get('/','HomeController@welcome')->name('welcome');

    Route::get('seta', "ArtistController@seta");

    Auth::routes();

    Route::get('/home', 'HomeController@index');

    Route::resource('artists', "ArtistController");

    Route::resource('songs', "SongController");

    Route::resource('channels', "ChannelController");

    Route::resource('fees', "ChannelFeeController");

    Route::resource('users', "UserController");

});

Route::group(['domain' => 'royalty.'.env('APP_DOMAIN', 'localhost')], function () {

    Route::get('/information','HomeController@royaltyInfo')->name('royaltyInfo');

});

Route::get('/','HomeController@welcome')->name('welcome');

