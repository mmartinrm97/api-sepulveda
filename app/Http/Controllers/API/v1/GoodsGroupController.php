<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\GoodsGroupResource;
use App\Models\GoodsGroup;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GoodsGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return GoodsGroupResource::collection(GoodsGroup::all());
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
     * @param  \App\Models\GoodsGroup  $goodsGroup
     * @return AnonymousResourceCollection
     */
    public function show(GoodsGroup $goodsGroup)
    {
        return GoodsGroupResource::collection($goodsGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GoodsGroup  $goodsGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodsGroup $goodsGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GoodsGroup  $goodsGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodsGroup $goodsGroup)
    {
        //
    }
}
