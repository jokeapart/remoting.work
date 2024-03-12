<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class JobPostingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'employer_id' => createOrRandomFactory(\App\Models\Employer::class),
			'title' => $this->faker->firstName(),
			'description' => $this->faker->text(),
			'skills_required' => $this->faker->firstName(),
			'requirements' => $this->faker->text(),
			'application_status' => $this->faker->firstName(),
        ];
    }
}
