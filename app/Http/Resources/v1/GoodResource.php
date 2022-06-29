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
        return [
            'id' => $this->resource->id,
            'code' => $this->resource->code,
            'description' => $this->resource->description,
            'warehouse_id' => $this->resource->warehouse_id,
            'goods_catalog_id' => $this->resource->goods_catalog_id,
            'is_active' => boolval($this->resource->is_active),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,

            'links' => [
                'self' => route('api.v1.goods.show', $this->getRouteKey()),
            ],

            'goods_catalog' => $this->whenLoaded('goodsCatalog',
                fn() => GoodsCatalogResource::make($this->goodsCatalog)),

            'warehouse' => $this->whenLoaded('warehouse',
                fn() => WarehouseResource::make($this->warehouse)),
        ];
    }
}
