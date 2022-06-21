<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class GoodsClassResource extends JsonResource
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
            'description' => $this->resource->description,
            'is_active' => boolval($this->resource->is_active),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,

            'links' => [
                'self' => route('api.v1.goods-classes.show', $this->getRouteKey()),
            ]
        ];
    }
}
