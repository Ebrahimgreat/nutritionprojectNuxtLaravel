<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'activityLevel' => $this->faker->numberBetween(-10000, 10000),
            'weight' => $this->faker->numberBetween(50, 80),
            'height' => $this->faker->numberBetween(140, 200),
            'sex'=>"Male",
            'age'=>$this->faker->numberBetween(18, 50),

            //
        ];
    }
}
