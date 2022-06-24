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
        return [
            'code' =>  $this->faker->numberBetween(10000000,90000000),
            'description' => $this->faker->sentence(),
            'goods_catalog_id' => GoodsCatalog::inRandomOrder()->first()->id,
            'warehouse_id' => Warehouse::inRandomOrder()->first()->id,
            'is_active' => rand(0,1),
        ];
    }
}
