<?php

namespace Tests\Feature\v1\Warehouse;

use App\Models\Role;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\Traits\AssertModelJsonDataTrait;
use Tests\Traits\FactorySeedModelDataTrait;

class ListWarehouseTest extends TestCase
{
    use RefreshDatabase, AssertModelJsonDataTrait, FactorySeedModelDataTrait;

    //Initialize structure json to assert
    protected array $arrayData = ['data' => []];

     /** @test */
    public function can_fetch_all_warehouses()
    {
        $warehouses = Warehouse::factory(3)->create();

        $response = $this->getJson(route('api.v1.warehouses.index'));

        $this->arrayData['data'] = $this->warehouseJsonData($warehouses);

        $response
            ->assertExactJson($this->arrayData)
            ->assertSuccessful();
    }

    /** @test */
    public function can_fetch_all_warehouses_with_users()
    {
        Role::factory(2)->create();
        $users = User::factory(3)->create();

        $warehouses = Warehouse::factory(3)->create()->each(function($warehouse) use ($users){
            $this->usersWarehouse($users, $warehouse);
        });

        $response = $this->getJson(route('api.v1.warehouses.index', ['include' => 'users']));

        $warehouses->load('users');

        $this->arrayData['data'] = $this->warehouseJsonData($warehouses);

        $response
            ->assertExactJson($this->arrayData)
            ->assertSuccessful();
    }

    /** @test */
    public function can_fetch_a_single_warehouse()
    {
        $warehouse = Warehouse::factory()->create();

        $response = $this->getJson(route('api.v1.warehouses.show', $warehouse));

        $this->arrayData['data'] = $this->warehouseJsonData($warehouse);

        $response
            ->assertExactJson($this->arrayData)
            ->assertSuccessful();
    }

    /** @test */
    public function can_fetch_a_single_warehouse_with_users()
    {
        Role::factory(2)->create();
        $users = User::factory(3)->create();

        $warehouse = Warehouse::factory(1)->create()->each(function($element) use ($users){
            $this->usersWarehouse($users, $element);
        });

        $warehouse->load('users');
        $warehouse = $warehouse[0];

        $response = $this->getJson(route('api.v1.warehouses.show',
            ['include' => 'users', 'warehouse' => $warehouse]));

        $this->arrayData['data'] = $this->warehouseJsonData($warehouse);

        $response
            ->assertExactJson($this->arrayData)
            ->assertSuccessful();
    }
}
