<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExperienceLevels>
 */
class ExperienceLevelsFactory extends Factory
{

    private array $experienceLevels = [
        "Jeune diplômé",
        "Junior",
        "Confirmé",
        "Senior"
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "label" => $this->faker->unique()->randomElement($this->experienceLevels),
            "description" => $this->faker->text(),
        ];
    }
}
