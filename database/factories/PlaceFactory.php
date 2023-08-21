<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Place>
 */
class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //'titulo' => $this->faker->randomElement(['Bora Bora', 'Francia', 'Portual', 'Italia', 'Brasil', 'EEUU', 'Irlanda', 'Inglaterra']),
            'user_id' => $this->faker->numberBetween(1, 3),
            'place' => $this->faker->city(),
            'description' => $this->faker->sentence(9)
        ];
    }
}
