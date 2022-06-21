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
            'description' => '04 AGRICOLA Y PESQUERO',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '11 AIRE ACONDICIONADO Y REFRIGERACION',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '18 ANIMALES',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '25 ASEO Y LIMPIEZA',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '32 COCINA Y COMEDOR',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '39 CULTURA Y ARTE',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '46 ELECTRICIDAD Y ELECTRONICA',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '53 HOSPITALIZACION',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '60 INSTRUMENTO DE MEDICION',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '67 MAQUINARIA, VEHICULOS Y OTROS',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '74 OFICINA',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '81 RECREACION Y DEPORTE',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '88 SEGURIDAD INDUSTRIAL',
            'is_active' => true
        ]);

        GoodsGroup::factory()->create([
            'description' => '95 TELECOMUNICACIONES',
            'is_active' => true
        ]);
    }
}
