<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\WarehouseResource;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $warehouses = Warehouse::query();

        $orderColumn = $request->input('order_column', 'warehouses.id');
        $orderDirection = $request->input('order_direction', 'asc');

        if ($request->filled('include')) {
            //Check Errors on includes
            $errors = $this->checkRequestRelationshipErrors($request, Warehouse::$relationships);
            if (!empty($errors['errors'])) {
                return response()->json($errors, 422);
            }
            $this->setRequestRelationships($request, $warehouses, Warehouse::$relationships);
        }

        $warehouses->orderBy($orderColumn, $orderDirection);

        $warehouses->when($request->filled('search_is_active'), function ($query) use ($request) {
            $query->where('warehouses.is_active', $request->input('search_is_active'));
        })
            ->when($request->filled('search_id'), function ($query) use ($request) {
                $query->where('warehouses.id', 'LIKE', '%' . $request->input('search_id') . '%');
            })
            ->when($request->filled('search_description'), function ($query) use ($request) {
                $query->where('warehouses.description', 'LIKE', '%' . $request->input('search_description') . '%');
            });

        if($request->filled('search_user')){
            $warehouses->whereHas('users', function($query) use($request){
                $query->where('first_name', 'like', '%'. $request->input('search_user'). '%');
            });
//            ->when($request->filled('search_user'), function ($query) use ($request) {
//                    $query->where('users.description', 'LIKE', '%' . $request->input('search_user') . '%');
//                })
        }

        return WarehouseResource::collection($warehouses->paginate(10));
    }

    public function indexall(){
        return response()->json(['data' => Warehouse::select('id', 'description')->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Warehouse $warehouse
     * @return WarehouseResource|\Illuminate\Http\JsonResponse
     */
    public function show(Request $request, Warehouse $warehouse)
    {
        if ($request->filled('include')) {
            //Check Errors on includes
            $errors = $this->checkRequestRelationshipErrors($request, Warehouse::$relationships);
            if (!empty($errors['errors'])) {
                return response()->json($errors, 422);
            }
            $this->setRequestRelationships($request, $warehouse, Warehouse::$relationships);
        }

        return WarehouseResource::make($warehouse);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Warehouse $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
