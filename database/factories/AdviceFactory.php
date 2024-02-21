<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Advice>
 */
class AdviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'plant_id' => $this->faker->randomElements([1, 2, 3, 4, 5])[0],
            'user_id' => $this->faker->randomElements([1, 2, 3])[0],
            'content' => $this->faker->text(),
        ];
    }
}
