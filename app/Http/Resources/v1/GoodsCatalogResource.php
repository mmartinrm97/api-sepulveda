<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class GoodsCatalogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        return parent::toArray($request);
        return [
            'id' => $this->resource->id,
            'item' => $this->resource->item,
            'code' => $this->resource->code,
            'denomination' => $this->resource->denomination,
            'goods_class_id' => $this->resource->goods_class_id,
            'goods_group_id' => $this->resource->goods_group_id,
            'is_active' => boolval($this->resource->is_active),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,

            'links' => [
                'self' => route('api.v1.goods-catalogs.show', $this->getRouteKey()),
            ],
        ];

    }
}
