<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'Api'], function() {

    Route::get('index', 'IndexController@index');

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::get('me', 'AuthController@me');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('ping', 'PingController@ping');
    });

    Route::get('ruler/create', 'RulerController@createEmpire')->name('ruler.create');
    Route::post('ruler/create', 'RulerController@storeEmpire');
});