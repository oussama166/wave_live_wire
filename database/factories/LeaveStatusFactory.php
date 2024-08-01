<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LeaveStatus>
 */
class LeaveStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    private array $statuses = [
        'Pending',
        'Approved',
        'Rejected',
    ];

    public function definition(): array
    {
        return [
            "label" => $this->faker->unique()->randomElement($this->statuses),
            "description" => $this->faker->text(),
        ];
    }
}
