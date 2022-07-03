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
        Warehouse::factory(15)->create()->each(function ($warehouse) use (&$users) {

            $userKeys = array_rand($users);
//            dd($userKeys);
////            echo nl2br('userKey ' . $userKeys. '  ->  ');
////            dd($userKeys);
            unset($users[$userKeys]);
            $warehouse->users()->attach(
                ($userKeys+1), ['is_active' => rand(0,1)]
            );
//            foreach ($userKeys as $userKey) {
//                $warehouse->users()->attach(
//                    $userKey, ['is_active' => rand(0,1)]
//                );
//            }

        });
    }
}
