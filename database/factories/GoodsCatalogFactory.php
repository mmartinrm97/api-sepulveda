<?php

namespace Database\Factories;

use App\Models\GoodsClass;
use App\Models\GoodsGroup;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GoodsCatalog>
 */
class GoodsCatalogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $goodsGroupIDs = GoodsGroup::pluck('id');
        $goodsClassIDs = GoodsClass::pluck('id');

        //To optimize tests
        $denomination = ['BUZON DE METAL', 'CARPETA MULTIPLE DE MADERA', 'CASILLERO DE MELAMINA', 'COMODA DE MADERA',
            'ESTANTE DE METAL', 'SOFA DE MADERA','CALCULADORA ELECTRONICA',
            'RUTEADOR DE RED - ROUTER','IMPRESORA LASER','COMPUTADORA PERSONAL PORTATIL'];

        return [
            'item' => $this->faker->numberBetween(1000,9000),
            'code' =>  $this->faker->numberBetween(10000000,90000000),
            'denomination' => $this->faker->unique()->randomElement($denomination),
            'goods_group_id' => $goodsGroupIDs->random(),
            'goods_class_id' => $goodsClassIDs->random(),
            'resolution' => $this->faker->buildingNumber() . ' - ' . $this->faker->year() . '/SBN-GO',
            'is_active' => true,
        ];
    }
}
