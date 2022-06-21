<?php

namespace Database\Seeders;

use App\Models\GoodsClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodsClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GoodsClass::factory()->create([
            'description' => '04 AERONAVE'
        ]);

        GoodsClass::factory()->create([
            'description' => '08 COMPUTO'
        ]);

        GoodsClass::factory()->create([
            'description' => '22 EQUIPO'
        ]);
        GoodsClass::factory()->create([
            'description' => '29 FERROCARRIL'
        ]);

        GoodsClass::factory()->create([
            'description' => '36 MAQUINARIA PESADA'
        ]);

        GoodsClass::factory()->create([
            'description' => '50 MAQUINA'
        ]);

        GoodsClass::factory()->create([
            'description' => '64 MOBILIARIO'
        ]);

        GoodsClass::factory()->create([
            'description' => '71 NAVE O ARTEFACTO NAVAL'
        ]);

        GoodsClass::factory()->create([
            'description' => '78 PRODUCCION Y SEGURIDAD'
        ]);

        GoodsClass::factory()->create([
            'description' => '82 VEHICULO'
        ]);
    }
}
