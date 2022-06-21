<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        //To optimize tests
        $description = ['Administrador', 'Encargado'];

        return [
            'description' => $this->faker->unique()->randomElement($description),
            'is_active' => true
        ];
    }
}
