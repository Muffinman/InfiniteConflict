<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AllianceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BuildingController;
use App\Http\Controllers\Api\FleetController;
use App\Http\Controllers\Api\GalaxyController;
use App\Http\Controllers\Api\IndexController;
use App\Http\Controllers\Api\PingController;
use App\Http\Controllers\Api\PlanetController;
use App\Http\Controllers\Api\ResearchController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\RulerController;
use App\Http\Controllers\Api\SystemController;
use App\Http\Controllers\Api\UnitController;

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

Route::get('index', [IndexController::class, 'index']);

/*
 * Auth routes
 */
Route::group(['prefix' => 'auth'], function () {
    Route::post('login/password', [AuthController::class, 'loginWithPassword']);
    Route::get('login/google', [AuthController::class, 'redirectToGoogle']);
    Route::post('login/google', [AuthController::class, 'loginWithGoogle']);
});

Route::group(['middleware' => 'auth:sanctum'], function () {

    /*
     * Auth routes
     */
    Route::group(['prefix' => 'auth'], function () {
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::post('setup', [AuthController::class, 'setupEmpire']);
    });

    Route::get('ping', [PingController::class, 'ping']);

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
