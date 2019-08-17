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

    /*
     * Auth routes
     */
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login/password', 'AuthController@loginWithPassword');

        Route::get('login/google', 'AuthController@redirectToGoogle');
        Route::post('login/google', 'AuthController@loginWithGoogle');
    });

    Route::group(['middleware' => 'auth:api'], function () {

        /*
         * Auth routes
         */
        Route::group(['prefix' => 'auth'], function () {
            Route::post('refresh', 'AuthController@refresh');
            Route::post('logout', 'AuthController@logout');
            Route::get('me', 'AuthController@me');
            Route::post('setup', 'AuthController@setupEmpire');
        });

        Route::get('ping', 'PingController@ping');

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
