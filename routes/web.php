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

Route::group(['namespace' => 'Web', 'middleware' => 'web'], function() {

    Route::get('/', 'AppController@index')->name('index');

    Auth::routes(['verify' => true]);

    // Oauth routes
    Route::get('oauth/google/login', 'Auth\AuthController@redirectToGoogle')->name('oauth.google.login');
    Route::get('oauth/google/return', 'Auth\AuthController@handleGoogleCallback')->name('oauth.google.return');

    Route::group(['middleware' => ['auth:web']], function () {
        Route::get('logout', 'Auth\AuthController@logout')->name('logout');
    });

});