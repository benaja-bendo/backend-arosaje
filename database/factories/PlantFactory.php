<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plant>
 */
class PlantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'path_image' => $this->faker->text,
            'user_created' => $this->faker->randomNumber(),
            'date_begin' => $this->faker->date(),
            'date_end' => $this->faker->date(),
            'is_published' => $this->faker->boolean,
        ];
    }
}
