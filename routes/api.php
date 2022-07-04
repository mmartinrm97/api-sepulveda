<?php

use App\Http\Controllers\API\v1\GoodController;
use App\Http\Controllers\API\v1\GoodsCatalogController;
use App\Http\Controllers\API\v1\GoodsClassController;
use App\Http\Controllers\API\v1\GoodsGroupController;
use App\Http\Controllers\API\v1\UserAuthController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\WarehouseController;
use App\Http\Controllers\API\v2\RoleController;
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
Route::apiResource('roles', RoleController::class);

Route::get('users/all', [UserController::class, 'indexAll']);
Route::apiResource('users', UserController::class);


Route::apiResource('goods-classes', GoodsClassController::class)
    ->parameters(['goods-classes'=>'goodsClass']);

Route::apiResource('goods-groups', GoodsGroupController::class)
    ->parameters(['goods-groups'=>'goodsGroup']);


Route::get('goods-catalogs/all', [GoodsCatalogController::class, 'indexAll']);
Route::apiResource('goods-catalogs', GoodsCatalogController::class)
    ->parameters(['goods-catalogs'=>'goodsCatalog']);


Route::get('warehouses/all', [WarehouseController::class, 'indexAll']);
Route::apiResource('warehouses', WarehouseController::class);


Route::apiResource('goods', GoodController::class);
