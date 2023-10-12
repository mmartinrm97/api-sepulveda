<?php

use App\Http\Controllers\API\v1\GoodController;
use App\Http\Controllers\API\v1\GoodsCatalogController;
use App\Http\Controllers\API\v1\GoodsClassController;
use App\Http\Controllers\API\v1\GoodsGroupController;
use App\Http\Controllers\API\v1\UserAuthController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\WarehouseController;
use App\Http\Controllers\API\v2\GraphReportController;
use App\Http\Controllers\API\v2\RoleController;
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

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('roles', RoleController::class);

    Route::get('users/list', [UserController::class, 'list'])->name('users.list');
    Route::apiResource('users', UserController::class);


    Route::apiResource('goods-classes', GoodsClassController::class)
        ->parameters(['goods-classes' => 'goodsClass']);

    Route::apiResource('goods-groups', GoodsGroupController::class)
        ->parameters(['goods-groups' => 'goodsGroup']);


    Route::get('goods-catalogs/list', [GoodsCatalogController::class, 'list'])->name('goods-catalogs.list');;
    Route::apiResource('goods-catalogs', GoodsCatalogController::class)
        ->parameters(['goods-catalogs' => 'goodsCatalog']);


    Route::get('warehouses/list', [WarehouseController::class, 'indexAll'])->name('warehouses.list');
    Route::apiResource('warehouses', WarehouseController::class);

    Route::get('reports/generate-reports', [GoodController::class, 'generateReport']);
    Route::get('goods/list', [GoodController::class, 'list']);
    Route::apiResource('goods', GoodController::class);

    //Route group with prefix graphic-reports
    Route::prefix('graphic-reports')->group(function () {
        Route::get('goods-by-conservation-status', [GraphReportController::class, 'getGoodsTotalByStateOfConservation']);
        Route::get('goods-by-date-acquired', [GraphReportController::class, 'getGoodsTotalByDateAcquired']);
//        getWarehousesWithHighestTotalValueGoods
        Route::get('warehouses-with-highest-total-value-goods', [GraphReportController::class, 'getWarehousesWithHighestTotalValueGoods']);
    });

});

Route::controller(UserAuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

