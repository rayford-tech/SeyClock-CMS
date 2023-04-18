<?php

use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('auth')->group(function () {
    Route::post('register', [UserController::class, 'register']);
    Route::post('login', [UserController::class, 'login']);

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('details', [UserController::class, 'details']);
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('configs', [UserController::class, 'configs']);
    Route::post('clockin', [UserController::class, 'Clockin']);
    Route::post('clockout/{id}', [UserController::class, 'Clockout']);
});
