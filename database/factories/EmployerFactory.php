<?php

namespace Database\Factories;

use App\Models\Employer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Employer>
 */
class EmployerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=>User::factory()->state([
                'role'=>'employer'
            ]) ,
            'name'=>fake()->company(),
            'logo'=>fake()->imageUrl() ,
            'description'=>fake()->paragraph(3) ,
            'website'=>fake()->url()
        ];
    }
}
