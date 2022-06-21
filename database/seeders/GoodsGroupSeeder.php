<?php

namespace Database\Seeders;

use App\Models\GoodsGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodsGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        GoodsGroup::factory()->create([
            'description' => '04 AGRICOLA Y PESQUERO'
        ]);

        GoodsGroup::factory()->create([
            'description' => '11 AIRE ACONDICIONADO Y REFRIGERACION'
        ]);

        GoodsGroup::factory()->create([
            'description' => '18 ANIMALES'
        ]);

        GoodsGroup::factory()->create([
            'description' => '25 ASEO Y LIMPIEZA'
        ]);

        GoodsGroup::factory()->create([
            'description' => '32 COCINA Y COMEDOR'
        ]);

        GoodsGroup::factory()->create([
            'description' => '39 CULTURA Y ARTE'
        ]);

        GoodsGroup::factory()->create([
            'description' => '46 ELECTRICIDAD Y ELECTRONICA'
        ]);

        GoodsGroup::factory()->create([
            'description' => '53 HOSPITALIZACION'
        ]);

        GoodsGroup::factory()->create([
            'description' => '60 INSTRUMENTO DE MEDICION'
        ]);

        GoodsGroup::factory()->create([
            'description' => '67 MAQUINARIA, VEHICULOS Y OTROS'
        ]);

        GoodsGroup::factory()->create([
            'description' => '74 OFICINA'
        ]);

        GoodsGroup::factory()->create([
            'description' => '81 RECREACION Y DEPORTE'
        ]);

        GoodsGroup::factory()->create([
            'description' => '88 SEGURIDAD INDUSTRIAL'
        ]);

        GoodsGroup::factory()->create([
            'description' => '95 TELECOMUNICACIONES'
        ]);
    }
}
