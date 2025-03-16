<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nutrients>
 */
class NutrientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'Calories' => fake()->numberBetween(2300, 2400),
            'date' => $this->faker->unique()->dateTimeBetween('2024-08-22', '2024-09-09')->format('Y-m-d'),// Generates random calories between 2300 and 2400
        ];
    }
}
