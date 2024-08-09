<?php

namespace Database\Factories;

use App\Models\Contracts;
use App\Models\ExperienceLevels;
use App\Models\FamilyStatus;
use App\Models\Nationality;
use App\Models\Position;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cin' => $this->faker->unique()->uuid(),
            'cnss' => $this->faker->unique()->uuid(),
            'email' => $this->faker->unique()->safeEmail(),
            'name' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'role' => $this->faker->randomElement(['admin', 'user']),
            'birth_date' => $this->faker->date(),
            'hiring_date' => $this->faker->date(),
            'password' => "password12345",
            'sexe' => $this->faker->randomElement(['male', 'female']),
            'phone' => $this->faker->unique()->phoneNumber(),
            'adresse' => $this->faker->unique()->address(),
            'balance' => $this->faker->randomFloat(2, 1.5, 102),
            'salary' => $this->faker->randomFloat(2, 3000, 30000),
            'experience_level_id' => ExperienceLevels::inRandomOrder()->first()->id,
            'family_status_id' => FamilyStatus::inRandomOrder()->first()->id,
            'nationality_id' => Nationality::inRandomOrder()->first()->id,
            'position_id' => Position::inRandomOrder()->first()->id,
            'contract_id' => Contracts::inRandomOrder()->first()->id,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function verfied(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => now(),
        ]);
    }
}
