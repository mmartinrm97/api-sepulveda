<?php

namespace Database\Factories;

use App\Models\GoodsCatalog;
use App\Models\GoodsClass;
use App\Models\GoodsGroup;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Good>
 */
class GoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $goodsCatalogIDs = GoodsCatalog::pluck('id');
        $warehouseIDs = Warehouse::pluck('id');
        return [
            'code' =>  $this->faker->numberBetween(10000000,90000000),
            'description' => $this->faker->sentence(),
            'goods_catalog_id' => $goodsCatalogIDs->random(),
            'warehouse_id' => $warehouseIDs->random(),
            'is_active' => rand(0,1),
        ];
    }
}
