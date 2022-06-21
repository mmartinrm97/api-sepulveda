<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory()->create([
            'description' => 'Administrador',
            'is_active' => true
        ]);

        Role::factory()->create([
            'description' => 'Encargado',
            'is_active' => true
        ]);
    }
}
