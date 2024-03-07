<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CandidateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => createOrRandomFactory(\App\Models\User::class),
			'subscription_type' => $this->faker->firstName(),
			'verified_status' => $this->faker->firstName(),
			'bpo_id' => createOrRandomFactory(\App\Models\Bpo::class),
			'profile_image' => $this->faker->firstName(),
			'resume' => $this->faker->firstName(),
        ];
    }
}
