<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Weight>
 */
class WeightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'ScaleWeight'=>fake()->randomFloat(2,72,73),
            'date'=>fake()->dateTimeBetween('2024-11-01','2024-11-30')->format('Y-m-d'),
            'user_profile_id'=>1
            //
        ];
    }
}
