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

        $this->faker->addProvider(new \Faker\Provider\es_ES\Color($this->faker));
        return [
            'code' =>  $this->faker->numberBetween(10000000,90000000),
            'description' => $this->faker->words(rand(2,4),true),
//            'trademark' => $this->faker->realText(),
//            'model' => $this->faker->realText(),
//            'type' => $this->faker->word(),
            'color' => $this->faker->safeColorName(),
            'series' => $this->faker->hexcolor(),
            'state_of_conservation' => $this->faker->randomElement(['A','B','C']),
            'date_acquired' => $this->faker->dateTimeInInterval(),
            'value' => $this->faker->randomFloat(1, 10, 500),
            'goods_catalog_id' => $goodsCatalogIDs->random(),
            'warehouse_id' => $warehouseIDs->random(),
            'observations' =>'MED',
            'is_active' => rand(0,1),
        ];
    }
}
