<?php

namespace App\Http\Resources\v1;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
//        return parent::toArray($request);

//        dd($this);
        return [
            'id' => $this->resource->id,
            'item' => $this->resource->item,
            'code' => $this->resource->code,
            'denomination' => $this->resource->denomination,
            'goods_group_id' => $this->resource->goods_group_id,
            'goods_class_id' => $this->resource->goods_class_id,
            'resolution' => $this->resource->resolution,
            'is_active' => $this->resource->is_active,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,

            'links' => [
                'self' => route('api.v1.goods.show', $this->getRouteKey()),
            ],

            'goods_group' => $this->whenLoaded('goodsGroup',
                fn() => GoodsGroupResource::make($this->goods_group)),

            'goods_class' => $this->whenLoaded('goodsClass',
                fn() => GoodsClassResource::make($this->goodsClass)),
        ];
    }
}
