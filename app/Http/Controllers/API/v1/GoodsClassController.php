<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\GoodsClassResource;
use App\Models\GoodsClass;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GoodsClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $goodsClasses = GoodsClass::query();
        $orderColumn = $request->input('order_column', 'goods_classes.id');
        $orderDirection = $request->input('order_direction', 'asc');

        $goodsClasses->orderBy($orderColumn, $orderDirection);

        $goodsClasses->when($request->filled('search_description'), function ($query) use ($request) {
                $query->where('goods_classes.description', 'LIKE', '%' . $request->input('search_description') . '%');
            });

        return GoodsClassResource::collection($goodsClasses->paginate(10));
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
     * @param GoodsClass $goodsClass
     * @return GoodsClassResource
     */
    public function show(GoodsClass $goodsClass): GoodsClassResource
    {
        return GoodsClassResource::make($goodsClass);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param GoodsClass $goodsClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodsClass $goodsClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param GoodsClass $goodsClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(GoodsClass $goodsClass)
    {
        //
    }
}
