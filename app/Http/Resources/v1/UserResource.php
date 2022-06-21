<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'role_id' => $this->resource->role_id,
            'first_name' => $this->resource->first_name,
            'last_name' => $this->resource->last_name,
            'dni' => $this->resource->dni,
            'username' => $this->resource->username,
            'email' => $this->resource->email,
            'is_active' => boolval($this->resource->is_active),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,


            'links' => [
                'self' => route('api.v1.users.show', $this->resource->getRouteKey()),
            ],

//            'pivot_users_warehouses' => $this->whenPivotLoaded('user_warehouse',
//                fn() => boolval($this->resource->pivot->is_active)),

            'role' => $this->whenLoaded('role',
                fn() => RoleResource::make($this->role)),

            'warehouses' => $this->whenLoaded('warehouses',
                fn() => WarehouseResource::collection($this->warehouses)),
        ];

    }
}

