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
        $users = User::all()->pluck('id')->toArray();
        Warehouse::factory(20)->create()->each(function ($warehouse) use (&$users) {

            $userKey = array_rand($users);
            $userId = $users[$userKey];
            $users = array_filter($users, function($element) use($userId){
                return $element !== $userId;
            });

            $warehouse->users()->attach(
                $userId,
                ['is_active' => rand(0, 1)]
            );
        });
    }
}
