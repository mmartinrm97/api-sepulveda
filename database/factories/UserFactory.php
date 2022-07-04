<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $roleIDs = Role::pluck('id');
        return [
            'role_id' => $roleIDs->random(),
            'first_name' => rand(0, 1) ?
                $this->faker->firstName('male') . ' ' . $this->faker->firstName('male') :
                $this->faker->firstName('female') . ' ' . $this->faker->firstName('female'),
            'last_name' => $this->faker->lastName() . ' ' . $this->faker->lastName(),
            'dni' => $this->faker->unique()->dni(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'is_active' => rand(0,1)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
