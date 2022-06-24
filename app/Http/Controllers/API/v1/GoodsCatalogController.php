<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\GoodsCatalogResource;
use App\Http\Resources\v1\GoodsClassResource;
use App\Models\GoodsCatalog;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GoodsCatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return GoodsCatalogResource::collection(GoodsCatalog::all());
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
