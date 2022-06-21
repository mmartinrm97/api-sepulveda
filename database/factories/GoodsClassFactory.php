<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class GoodsClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //To optimize tests
        $description = ['04 AERONAVE', '08 COMPUTO', '22 EQUIPO', '29 FERROCARRIL', '36 MAQUINARIA PESADA',
            '50 MAQUINA','64 MOBILIARIO','71 NAVE O ARTEFACTO NAVAL','78 PRODUCCION Y SEGURIDAD','82 VEHICULO'];

        return [
            'description' => $this->faker->unique()->randomElement($description),
            'is_active' => true
        ];
    }
}
