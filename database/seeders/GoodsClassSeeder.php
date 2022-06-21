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
            'description' => '04 AERONAVE',
            'is_active' => true
        ]);

        GoodsClass::factory()->create([
            'description' => '08 COMPUTO',
            'is_active' => true
        ]);

        GoodsClass::factory()->create([
            'description' => '22 EQUIPO',
            'is_active' => true
        ]);
        GoodsClass::factory()->create([
            'description' => '29 FERROCARRIL',
            'is_active' => true
        ]);

        GoodsClass::factory()->create([
            'description' => '36 MAQUINARIA PESADA',
            'is_active' => true
        ]);

        GoodsClass::factory()->create([
            'description' => '50 MAQUINA',
            'is_active' => true
        ]);

        GoodsClass::factory()->create([
            'description' => '64 MOBILIARIO',
            'is_active' => true
        ]);

        GoodsClass::factory()->create([
            'description' => '71 NAVE O ARTEFACTO NAVAL',
            'is_active' => true
        ]);

        GoodsClass::factory()->create([
            'description' => '78 PRODUCCION Y SEGURIDAD',
            'is_active' => true
        ]);

        GoodsClass::factory()->create([
            'description' => '82 VEHICULO',
            'is_active' => true
        ]);
    }
}
