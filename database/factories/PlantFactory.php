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
            'address' => $this->faker->address,
            'path_image' => $this->faker->imageUrl(),
            'user_created' => $this->faker->randomElements([1, 2, 3])[0],
            'date_begin' => $this->faker->date(),
            'date_end' => $this->faker->date(),
            'is_published' => $this->faker->boolean,
        ];
    }
}
