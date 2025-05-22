<?php

use App\Http\Controllers\API\v1\AuthController;
use App\Http\Controllers\API\v1\DeviceController;
use App\Http\Controllers\API\v1\NotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['api']], function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);

        Route::group(['prefix' => '', 'middleware' => ['auth:api']], function () {
            Route::get('profile', [AuthController::class, 'profile']);
            Route::post('logout', [AuthController::class, 'logout']);

            Route::group(['prefix' => 'devices'], function () {
//                Route::get('', [DeviceController::class, 'index']);
                Route::post('register', [DeviceController::class, 'store']);
            });

//            Route::group(['prefix' => 'notifications'], function () {
//                Route::get('', [NotificationController::class, 'index']);
//                Route::get('{notification?}', [NotificationController::class, 'show']);
//                Route::post('', [NotificationController::class, 'store']);
//            });
        });
    });
});
