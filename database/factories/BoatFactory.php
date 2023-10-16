<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Boat>
 */
class BoatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->name(),
            "description" => fake()->paragraph($nbSentences = 5),
            "year" => fake()->year(),
            "price" => fake()->randomNumber(7),
            "length" => fake()->randomNumber(2),
            "location" => fake()->city().', '.fake()->country(),
            "sold" => random_int(0,1)
        ];
    }
}

