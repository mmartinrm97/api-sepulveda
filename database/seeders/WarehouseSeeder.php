<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all()->pluck('id');
        Warehouse::factory(20)->create()->each(function ($warehouse) use (&$users) {

            $userKeys = $users->random(rand(1,3));
            foreach ($userKeys as $userKey) {
                $warehouse->users()->attach(
                    $userKey, ['is_active' => rand(0,1)]
                );
            }

        });
    }
}
