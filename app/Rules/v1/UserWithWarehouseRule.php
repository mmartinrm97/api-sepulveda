<?php

namespace App\Rules\v1;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class UserWithWarehouseRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = User::find($value);
        $warehouse = request()->route('warehouse');

        foreach ($warehouse->users as $userWarehouse){
            if($userWarehouse->id === $user->id){
                return true;
            }
        }

        if ($user->warehouses()->exists()) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Este usuario ya tiene asignado un área de inventario';
    }
}
