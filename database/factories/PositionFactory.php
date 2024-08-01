<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private array $posotions = [
        "Frontend",
        "Backend",
        "Fullstack",
        "Comptable",
        "Assitant",
        "HR"
    ];

    public function definition(): array
    {
        return [
            "label" => $this->faker->unique()->randomElement($this->posotions),
            "description" => $this->faker->text(),
        ];
    }
}
