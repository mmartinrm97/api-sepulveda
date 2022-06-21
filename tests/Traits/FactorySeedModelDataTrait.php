<?php

namespace Tests\Traits;

trait FactorySeedModelDataTrait
{
    public function usersWarehouse($users, $warehouse){

        $users = $users->pluck('id')->toArray();

        $userKey = array_rand($users);
        $userId = $users[$userKey];

        $warehouse->users()->attach(
            $userId,
            ['is_active' => rand(0, 1)]
        );
    }
}
