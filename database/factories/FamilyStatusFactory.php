<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamilyStatus>
 */
class FamilyStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private array $status = [
        "Célibataire",
        "Marié",
        "Divorcé",
        "Veuf"
    ];

    public function definition(): array
    {
        return [
            "label" => $this->faker->unique()->randomElement($this->status),
            "description" => $this->faker->text(),
        ];
    }
}
