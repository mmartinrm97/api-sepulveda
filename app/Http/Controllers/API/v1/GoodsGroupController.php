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
    public function index(Request $request)
    {
        $goodsGroups = GoodsGroup::query();
        $orderColumn = $request->input('order_column', 'goods_groups.id');
        $orderDirection = $request->input('order_direction', 'asc');

        $goodsGroups->orderBy($orderColumn, $orderDirection);

        $goodsGroups->when($request->filled('search_description'), function ($query) use ($request) {
            $query->where('goods_groups.description', 'LIKE', '%' . $request->input('search_description') . '%');
        });

        return GoodsGroupResource::collection($goodsGroups->paginate(10));
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
     * @param GoodsGroup $goodsGroup
     * @return GoodsGroupResource
     */
    public function show(GoodsGroup $goodsGroup)
    {
        return GoodsGroupResource::make($goodsGroup);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param GoodsGroup $goodsGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodsGroup $goodsGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GoodsGroup $goodsGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodsGroup $goodsGroup)
    {
        //
    }
}
