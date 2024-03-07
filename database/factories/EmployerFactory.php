<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => createOrRandomFactory(\App\Models\User::class),
			'bpo_name' => $this->faker->firstName(),
			'profile_image' => $this->faker->firstName(),
			'office_image' => $this->faker->firstName(),
        ];
    }
}
