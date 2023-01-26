<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreGoodRequest;
use App\Http\Requests\v1\UpdateGoodRequest;
use App\Http\Resources\v1\GoodResource;
use App\Models\Good;
use App\Models\Warehouse;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class GoodController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        $goods = Good::query();
        $orderColumn = $request->input('order_column', 'goods.id');
        $orderDirection = $request->input('order_direction', 'asc');

        if ($request->filled('include')) {
            //Check Errors on includes
            $errors = $this->checkRequestRelationshipErrors($request, Good::$relationships);
            if (!empty($errors['errors'])) {
                return response()->json($errors, 422);
            }
            $this->setRequestRelationships($request, $goods, Good::$relationships);
        }
        //Sort data
        //Sort data
        if ($orderColumn != 'warehouse_id') {
//            dd('es diferente a wh');
            $goods->orderBy($orderColumn, $orderDirection);
        } else {
            $goods->select('goods.*')
                ->join('warehouses', 'warehouses.id', '=', 'goods.warehouse_id')
                ->orderBy('warehouses.description', $orderDirection);
        }

        $goods->when($request->filled('search_global'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('id', 'LIKE', '%' . $request->input('search_global') . '%')
                    ->orWhere('code', 'LIKE', '%' . $request->input('search_global') . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->input('search_global'));
            });
        })
            ->when($request->filled('search_is_active'), function ($query) use ($request) {
                $query->where('goods.is_active', $request->input('search_is_active'));
            })
            ->when($request->filled('search_warehouse'), function ($query) use ($request) {
                $query->where('goods.warehouse_id', $request->input('search_warehouse'));
            })
            ->when($request->filled('search_id'), function ($query) use ($request) {
                $query->where('goods.id', 'LIKE', '%' . $request->input('search_id') . '%');
            })
            ->when($request->filled('search_code'), function ($query) use ($request) {
                $query->where('goods.code', 'LIKE', '%' . $request->input('search_code') . '%');
            })
            ->when($request->filled('search_description'), function ($query) use ($request) {
                $query->where('goods.description', 'LIKE', '%' . $request->input('search_description') . '%');
            });

        return GoodResource::collection($goods->paginate(10));
    }

    public function list(Request $request): JsonResponse|AnonymousResourceCollection
    {
        $goods = Good::query();
        $orderColumn = $request->input('order_column', 'goods.id');
        $orderDirection = $request->input('order_direction', 'asc');

        if ($request->filled('include')) {
            //Check Errors on includes
            $errors = $this->checkRequestRelationshipErrors($request, Good::$relationships);
            if (!empty($errors['errors'])) {
                return response()->json($errors, 422);
            }
            $this->setRequestRelationships($request, $goods, Good::$relationships);
        }
        //Sort data
        //Sort data
        if ($orderColumn != 'warehouse_id') {
//            dd('es diferente a wh');
            $goods->orderBy($orderColumn, $orderDirection);
        } else {
            $goods->select('goods.*')
                ->join('warehouses', 'warehouses.id', '=', 'goods.warehouse_id')
                ->orderBy('warehouses.description', $orderDirection);
        }

        $goods->when($request->filled('search_global'), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('id', 'LIKE', '%' . $request->input('search_global') . '%')
                    ->orWhere('code', 'LIKE', '%' . $request->input('search_global') . '%')
                    ->orWhere('description', 'LIKE', '%' . $request->input('search_global'));
            });
        })
            ->when($request->filled('search_is_active'), function ($query) use ($request) {
                $query->where('goods.is_active', $request->input('search_is_active'));
            })
            ->when($request->filled('search_warehouse'), function ($query) use ($request) {
                $query->where('goods.warehouse_id', $request->input('search_warehouse'));
            })
            ->when($request->filled('search_id'), function ($query) use ($request) {
                $query->where('goods.id', 'LIKE', '%' . $request->input('search_id') . '%');
            })
            ->when($request->filled('search_code'), function ($query) use ($request) {
                $query->where('goods.code', 'LIKE', '%' . $request->input('search_code') . '%');
            })
            ->when($request->filled('search_description'), function ($query) use ($request) {
                $query->where('goods.description', 'LIKE', '%' . $request->input('search_description') . '%');
            });

        return GoodResource::collection($goods->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGoodRequest $request
     * @return JsonResponse
     */
    public function store(StoreGoodRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $good = Good::create($request->validated());
            DB::commit();
            return response()->json([
                'data' => [
                    'title' => 'Good created successfully',
                    'product' => GoodResource::make($good)
                ]
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'errors' => [
                    'title' => 'Good creation failed',
                    'details' => $e->getMessage()
                ]
            ], 422);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Good $good
     * @return GoodResource
     */
    public function show(Request $request, Good $good): GoodResource
    {

        $this->setRequestRelationships($request, $good, Good::$relationships);

        return GoodResource::make($good);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGoodRequest $request
     * @param Good $good
     * @return JsonResponse
     */
    public function update(UpdateGoodRequest $request, Good $good): JsonResponse
    {
        try {
            DB::beginTransaction();
            $good->update($request->validated());
            DB::commit();
            return response()->json([
                'data' => [
                    'title' => 'Good updated successfully',
                    'product' => GoodResource::make($good)
                ]
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'errors' => [
                    'title' => 'Good update failed',
                    'details' => $e->getMessage()
                ]
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Good $good
     * @return JsonResponse
     */
    public function destroy(Good $good)
    {
        try {
            DB::beginTransaction();
//            $good->warehouse()->Delete();
//            $good->goodsCatalog()->delete();
            $good->delete();
            DB::commit();
            return response()->json([
                'data' => [
                    'title' => 'Good deleted successfully'
                ]
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'errors' => [
                    'title' => 'Good delete failed',
                    'details' => $e->getMessage()
                ]
            ], 422);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function generateReport(Request $request): \Illuminate\Http\Response
    {
//
//        $goods->when($request->filled('search_warehouse'), function ($query) use ($request) {
//            $query->where('goods.warehouse_id', $request->input('search_warehouse'));
//        });
//
//        $goods->select('goods.*')
//            ->join('warehouses', 'warehouses.id', '=', 'goods.warehouse_id')
//            ->orderBy('warehouses.description');
//
//        return GoodPDFResource::collection($goods->get());

        $warehouses = Warehouse::query();

        $warehouses->when($request->filled('search_warehouse_id'), function ($query) use ($request) {
            $query->where('warehouses.id', $request->input('search_warehouse_id'));
        });

        $warehouses->with([
            'goods' => function($goodQuery){
                $goodQuery->select(['id','description','warehouse_id','goods_catalog_id', 'code',
                    'trademark','model','type','color','series','state_of_conservation','date_acquired','value',
                    'observations']);
                $goodQuery->with(['goodsCatalog' => function ($goodsCatalogQuery){
                    $goodsCatalogQuery->select('id','code','denomination');
                }]);
            },
            'users'=> function ($userQuery){
                $userQuery->select('users.id','first_name','last_name');
            }
        ]);


        $data = [
            'titulo' => 'Styde.net',
            'warehouses' => $warehouses->get()
        ];

        return PDF::loadView('reports.reporte', $data)
            ->setPaper('a4', 'landscape')
            ->stream('archivo.pdf');
    }
}
