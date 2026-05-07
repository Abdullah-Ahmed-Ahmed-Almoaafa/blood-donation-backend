<?php

namespace Database\Factories;

use App\Models\Donation;
use App\Models\User;
use App\Models\BloodRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    protected $model = Donation::class;

    public function definition(): array
    {
        return [
            'donor_id' => User::factory(),
            'request_id' => BloodRequest::factory(),
            'status' => 'pending_confirmation',
            'donated_at' => null,
        ];
    }

    public function donated(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'donated',
            'donated_at' => now(),
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'cancelled',
        ]);
    }
}