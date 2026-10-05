<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Job>
 */
class JobFactory extends Factory
{
    public function definition(): array
    {
        return [
            'employer_id' => Employer::factory(),
            'title' => fake()->jobTitle(),
            'salary' => fake()->randomNumber() . ' EGP',
            'location' => fake()->address(),
            'schedule' => fake()->randomElement(['Full-Time' ,'Part-Time' ]) ,
            'description' => fake()->paragraph(),
            'url'=>fake()->url() ,
            'featured'=>fake()->randomElement([false , true])

        ];
    }
}
