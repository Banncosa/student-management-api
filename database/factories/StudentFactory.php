<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'birthdate' => $this->faker->date($format = 'Y-m-d', $max = '2003-12-31'),
            'sex' => $this->faker->randomElement(['MALE', 'FEMALE']),
            'address' => $this->faker->address,
            'year' => $this->faker->numberBetween(1, 4),
            'course' => $this->faker->randomElement(['BSIT', 'BSCS', 'BSIS']),
            'section' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
        ];
    }
}
