<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Steps>
 */
class StepsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_Id'=>1,
            'date'=>fake()->date(),
            'steps'=>10000,
            'Month'=>'January',
            'goal'=>5000

            //
        ];
    }
}
