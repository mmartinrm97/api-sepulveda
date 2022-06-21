<?php

namespace Tests\Traits;

use App\Models\GoodsClass;
use App\Models\GoodsGroup;
use App\Models\Role;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;

trait AssertModelJsonDataTrait
{
    /**
     * @param $goodsClass
     * @return array
     */
    public function goodsClassJsonStructure($goodsClass)
    {
        return [
            'id' => $goodsClass->id,
            'description' => $goodsClass->description,
            'is_active' => boolval($goodsClass->is_active),
            'created_at' => $goodsClass->created_at,
            'updated_at' => $goodsClass->updated_at,
            'links' => [
                'self' => route('api.v1.goods-classes.show', $goodsClass->getRouteKey()),
            ]
        ];
    }

    /**
     * @param GoodsClass|Collection $goodsClasses
     * @return array
     */
    public function goodsClassJsonData(GoodsClass|Collection $goodsClasses): array
    {

        if ($goodsClasses instanceof GoodsClass) {
            return $this->goodsClassJsonStructure($goodsClasses);
        }
        else {
            $dataGoodsGroupJson = [];
            foreach ($goodsClasses as $goodsClass) {
                $dataGoodsGroupJson [] = $this->goodsClassJsonStructure($goodsClass);
            }
              return $dataGoodsGroupJson;
        }
    }

    /**
     * @param $goodsGroup
     * @return array
     */
    public function goodsGroupJsonStructure($goodsGroup)
    {
        return [
            'id' => $goodsGroup->id,
            'description' => $goodsGroup->description,
            'is_active' => boolval($goodsGroup->is_active),
            'created_at' => $goodsGroup->created_at,
            'updated_at' => $goodsGroup->updated_at,
            'links' => [
                'self' => route('api.v1.goods-groups.show', $goodsGroup->getRouteKey()),
            ]
        ];
    }

    /**
     * @param GoodsGroup|Collection $goodsGroups
     * @return array
     */
    public function goodsGroupJsonData(GoodsGroup|Collection $goodsGroups): array
    {

        if ($goodsGroups instanceof GoodsGroup) {
            return $this->goodsGroupJsonStructure($goodsGroups);
        }
        else {
            $dataGoodsGroupJson = [];
            foreach ($goodsGroups as $goodsGroup) {
                $dataGoodsGroupJson [] = $this->goodsGroupJsonStructure($goodsGroup);
            }
            return $dataGoodsGroupJson;
        }
    }

    /**
     * @param $role
     * @return array
     */
    public function roleJsonStructure($role)
    {
        return [
            'id' => $role->id,
            'description' => $role->description,
            'is_active' => boolval($role->is_active),
            'created_at' => $role->created_at,
            'updated_at' => $role->updated_at,
            'links' => [
                'self' => route('api.v1.roles.show', $role->getRouteKey()),
            ]
        ];
    }

    /**
     * @param Role|Collection $roles
     * @return array
     */
    public function roleJsonData(Role|Collection $roles): array
    {

        if ($roles instanceof Role) {
            return $this->roleJsonStructure($roles);
        }
        else {
            $dataRoleJson = [];
            foreach ($roles as $role) {
                $dataRoleJson [] = $this->roleJsonStructure($role);
            }
            return $dataRoleJson;
        }
    }

    /**
     * @param $user
     * @return array
     */
    public function userJsonStructure($user): array
    {
        $userJson = [
            'id' => $user->id,
            'role_id' => $user->role_id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'dni' => $user->dni,
            'username' => $user->username,
            'email' => $user->email,
            'is_active' => boolval($user->is_active),
            'created_at' => $user->created_at,
            'updated_at' => $user->updated_at,

            'links' => [
                'self' => route('api.v1.users.show', $user->getRouteKey()),
            ]
        ];

        if($user->relationLoaded('role')){
            $userJson = Arr::add($userJson, 'role', $this->roleJsonData($user->role));
        }

//        if($user->whenPivotLoaded('user_warehouse')){
//            $userJson = Arr::add($userJson, 'pivot_users_warehouses', ($user->pivot->is_active));
//        }

        if($user->relationLoaded('warehouses')){
            $userJson = Arr::add($userJson, 'warehouses', $this->warehouseJsonData($user->warehouses));
        }

        return $userJson;
    }

    /**
     * @param User|Collection $users
     * @return array
     */
    public function userJsonData(User|Collection $users): array
    {

        if ($users instanceof User) {
            return $this->userJsonStructure($users);
        }
        else {
            $dataUserJson = [];
            foreach ($users as $user) {
                $dataUserJson [] = $this->userJsonStructure($user);
            }
            return $dataUserJson;
        }
    }

    /**
     * @param $warehouse
     * @return array
     */
    public function warehouseJsonStructure($warehouse): array
    {
        $warehouseJson = [
            'id' => $warehouse->id,
            'description' => $warehouse->description,
            'is_active' => boolval($warehouse->is_active),
            'created_at' => $warehouse->created_at,
            'updated_at' => $warehouse->updated_at,
            'links' => [
                'self' => route('api.v1.warehouses.show', $warehouse->getRouteKey()),
            ]
        ];

        if($warehouse->relationLoaded('users')){
            $warehouseJson = Arr::add($warehouseJson, 'users', $this->userJsonData($warehouse->users));
        }

        return $warehouseJson;
    }

    /**
     * @param Warehouse|Collection $warehouses
     * @return array
     */
    public function warehouseJsonData(Warehouse|Collection $warehouses): array
    {

        if ($warehouses instanceof Warehouse) {
            return $this->warehouseJsonStructure($warehouses);
        }
        else {
            $dataWarehouseJson = [];
            foreach ($warehouses as $warehouse) {
                $dataWarehouseJson [] = $this->warehouseJsonStructure($warehouse);
            }
            return $dataWarehouseJson;
        }
    }
}
