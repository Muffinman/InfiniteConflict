<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index')->name('index');

// Authentication routes
// Route::get('auth/login', 'Auth\AuthController@getLogin');
// Route::post('auth/login', 'Auth\AuthController@postLogin');
// Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Normal Registration routes
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');

// Oauth routes
Route::get('oauth/google/login', 'Auth\AuthController@redirectToGoogle')->name('oauth.google.login');
Route::get('oauth/google/return', 'Auth\AuthController@handleGoogleCallback')->name('oauth.google.return');

// All routes under here must be authed and ruler must have a home planet
Route::group(['middleware' => ['auth', 'planets']], function () {
    Route::get('planets', 'PlanetsController@index')->name('planets.index');
    Route::get('planets/{id}', 'PlanetsController@view')->name('planets.view');

    Route::get('fleets', 'FleetsController@index')->name('fleets.index');
    Route::get('fleets/{$id}', 'FleetsController@view')->name('fleets.view');

    Route::get('navigation', 'NavigationController@index')->name('navigation.index');
    Route::get('navigation/{galaxy}', 'NavigationController@galaxy')->name('navigation.galaxy');
    Route::get('navigation/{galaxy}/{system}', 'NavigationController@system')->name('navigation.system');

    Route::get('research', 'ResearchController@index')->name('research.index');

    Route::get('alliances', 'AlliancesController@index')->name('alliances.index');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('ruler/create', 'RulerController@createEmpire')->name('ruler.create');
    Route::post('ruler/create', 'RulerController@storeEmpire');
});
