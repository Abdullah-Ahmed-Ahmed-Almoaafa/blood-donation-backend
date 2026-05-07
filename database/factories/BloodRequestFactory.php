<?php

namespace Database\Factories;

use App\Models\BloodRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BloodRequestFactory extends Factory
{
    protected $model = BloodRequest::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'patient_name' => $this->faker->name(),
            'blood_type' => $this->faker->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
            'units_required' => $this->faker->numberBetween(1, 5),
            'location' => $this->faker->city(),
            'urgency' => $this->faker->randomElement(['normal', 'high', 'critical']),
            'status' => 'open',
            'expires_at' => now()->addDays(7),
        ];
    }

    public function open(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'open',
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    public function donated(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'donated',
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
        ]);
    }

    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'expires_at' => now()->subDay(),
        ]);
    }
}