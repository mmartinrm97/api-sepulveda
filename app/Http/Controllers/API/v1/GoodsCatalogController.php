<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\GoodsCatalogResource;
use App\Http\Resources\v1\GoodsClassResource;
use App\Models\GoodsCatalog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GoodsCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request): JsonResponse|AnonymousResourceCollection
    {
        $goodsCatalogs = GoodsCatalog::query();
        $orderColumn = $request->input('order_column', 'goods_catalogs.id');
        $orderDirection = $request->input('order_direction', 'asc');

        if ($request->filled('include')) {
            //Check Errors on includes
            $errors = $this->checkRequestRelationshipErrors($request, GoodsCatalog::$relationships);
            if (!empty($errors['errors'])) {
                return response()->json($errors, 422);
            }
            $this->setRequestRelationships($request, $goodsCatalogs, GoodsCatalog::$relationships);
        }

        $goodsCatalogs->orderBy($orderColumn, $orderDirection);

        $goodsCatalogs->when($request->filled('search_code'), function ($query) use ($request) {
            $query->where('goods_catalogs.code', 'LIKE', '%' . $request->input('search_code') . '%');
        })
            ->when($request->filled('search_denomination'), function ($query) use ($request) {
                $query->where('goods_catalogs.denomination', 'LIKE', '%' . $request->input('search_denomination') . '%');
            });

        return GoodsCatalogResource::collection($goodsCatalogs->paginate(10));
    }


    public function indexAll()
    {
        return response()->json(['data' =>
            GoodsCatalog::select('id','denomination')->get()
        ]);
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
     * @param GoodsCatalog $goodsCatalog
     * @return GoodsCatalogResource
     */
    public function show(GoodsCatalog $goodsCatalog): GoodsCatalogResource
    {

        return GoodsCatalogResource::make($goodsCatalog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param GoodsCatalog $goodsCatalog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodsCatalog $goodsCatalog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GoodsCatalog $goodsCatalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodsCatalog $goodsCatalog)
    {
        //
    }
}
