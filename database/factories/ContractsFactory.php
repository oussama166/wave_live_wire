<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contracts>
 */
class ContractsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private array $contracts = [
        "CDI",
        "CDD",
        "ANAPEC",
        "Contrat prestation"

    ];

    public function definition(): array
    {
        return [
            "label" => $this->faker->unique()->randomElement($this->contracts),
            "description" => $this->faker->text()
        ];


    }
}
