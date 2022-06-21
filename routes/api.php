<?php

use App\Http\Controllers\API\v1\GoodController;
use App\Http\Controllers\API\v1\GoodsClassController;
use App\Http\Controllers\API\v1\GoodsGroupController;
use App\Http\Controllers\API\v1\UserAuthController;
use App\Http\Controllers\API\v1\UserController;
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

Route::controller(UserAuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::apiResource('users', UserController::class);

Route::apiResource('goods-classes', GoodsClassController::class);

Route::apiResource('goods-groups', GoodsGroupController::class);

Route::apiResource('goods', GoodController::class);
