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

Route::group(['namespace' => 'Api'], function () {
    Route::get('index', 'IndexController@index');
    Route::post('login', 'AuthController@login');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::post('refresh', 'AuthController@refresh');
        Route::post('logout', 'AuthController@logout');
        Route::get('me', 'AuthController@me');
        Route::get('ping', 'PingController@ping');

        Route::get('ruler/create', 'IndexController@createEmpire');
        Route::post('ruler/create', 'IndexController@storeEmpire');

        Route::apiResource('alliances', AllianceController::class);
        Route::apiResource('buildings', BuildingController::class);
        Route::apiResource('fleets', FleetController::class);
        Route::apiResource('galaxies', GalaxyController::class);
        Route::apiResource('planets', PlanetController::class);
        Route::apiResource('research', ResearchController::class);
        Route::apiResource('resources', ResourceController::class);
        Route::apiResource('rulers', RulerController::class);
        Route::apiResource('systems', SystemController::class);
        Route::apiResource('units', UnitController::class);
    });
});
