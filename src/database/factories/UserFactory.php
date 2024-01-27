<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\help>
 */
final class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'surname' => fake()->lastName,
            'name' => fake()->name,
            'middlename' => fake()->firstName,
            'birth_date' => fake()->date(),
            'city' => fake()->city,
            'email' => fake()->email,
            'password' => Hash::make('12345678'),
        ];
    }
}
