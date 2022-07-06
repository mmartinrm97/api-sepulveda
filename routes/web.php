<?php

use App\Models\Warehouse;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
//    return view('welcome');
    $warehouses = Warehouse::query();

    $warehouses->select(['id','description']);

    $warehouses->when($request->filled('search_warehouse_id'), function ($query) use ($request) {
        $query->where('warehouses.id', $request->input('search_warehouse_id'));
    });

    $warehouses->with([
        'goods' => function($goodQuery){
           $goodQuery->select(['id','description','warehouse_id','goods_catalog_id',
               'trademark','model','type','color','series','state_of_conservation','date_acquired','value',
               'observations']);
           $goodQuery->with(['goodsCatalog' => function ($goodsCatalogQuery){
               $goodsCatalogQuery->select('id','code');
           }]);
        },
        'users'=> function ($userQuery){
            $userQuery->select('users.id','first_name','last_name');
        }
    ]);

    return $warehouses->get();
});
