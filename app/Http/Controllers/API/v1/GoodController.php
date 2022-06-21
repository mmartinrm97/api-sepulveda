<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\GoodResource;
use App\Models\Good;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GoodController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $goods = Good::all();

        if ($request->filled('include')) {
            //Check Errors on includes
            $errors = $this->checkRequestRelationshipErrors($request, Good::$relationships);
            if (!empty($errors['errors'])) {
                return response()->json($errors, 422);
            }
            $this->setRequestRelationships($request, $goods, Good::$relationships);
        }

        return GoodResource::collection($goods);
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
     * @param  \App\Models\Good  $good
     * @return GoodResource
     */
    public function show(Request $request, Good $good)
    {

        $this->setRequestRelationships($request, $good, Good::$relationships);

        return GoodResource::make($good);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Good $good)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Good  $good
     * @return \Illuminate\Http\Response
     */
    public function destroy(Good $good)
    {
        //
    }
}
