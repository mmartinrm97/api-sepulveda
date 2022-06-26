<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseResource extends JsonResource
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
            'user_warehouse' => $this->whenPivotLoadedAs('user_warehouse','user_warehouse', function(){
                return ['is_active' => ($this->resource->user_warehouse->is_active)];
            },null),

            'links' => [
                'self' => route('api.v1.warehouses.show', $this->getRouteKey()),
            ],

//            'pivot_users_warehouses' => $this->whenPivotLoaded('user_warehouse',
//                fn() => boolval($this->resource->pivot->is_active)),

            'users' => $this->whenLoaded('users',
                fn() => UserResource::collection($this->users))
        ];
    }
}
