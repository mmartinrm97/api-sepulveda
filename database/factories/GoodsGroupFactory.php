<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GoodsGroup>
 */
class GoodsGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //To optimize tests
        $description = ['04 AGRICOLA Y PESQUERO','11 AIRE ACONDICIONADO Y REFRIGERACION','18 ANIMALES',
            '25 ASEO Y LIMPIEZA', '32 COCINA Y COMEDOR','39 CULTURA Y ARTE','46 ELECTRICIDAD Y ELECTRONICA',
            '53 HOSPITALIZACION', '60 INSTRUMENTO DE MEDICION','67 MAQUINARIA, VEHICULOS Y OTROS','74 OFICINA',
            '81 RECREACION Y DEPORTE','88 SEGURIDAD INDUSTRIAL','95 TELECOMUNICACIONES'];

        return [
            'description' => $this->faker->unique()->randomElement($description),
            'is_active' => true
        ];
    }
}
