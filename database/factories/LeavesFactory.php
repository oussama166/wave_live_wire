<?php

namespace Database\Factories;

use App\Models\LeaveStatus;
use App\Models\User;
use App\Models\VacationType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Leaves>
 */
class LeavesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate the end_at date first
        $endAt = $this->faker->dateTimeThisYear();

        // Ensure the start_at date is after the end_at date
        $startAt = $this->faker->dateTimeBetween($endAt, 'now');

        return [
            "start_at" => $endAt,
            "end_at" => $startAt,
            "description" => $this->faker->text(),
            "user_id" => User::inRandomOrder()->first()->id,
            "vacation_type_id" => VacationType::inRandomOrder()->first()->id,
            "leave_status_id" => LeaveStatus::inRandomOrder()->first()->id,
        ];
    }
}
