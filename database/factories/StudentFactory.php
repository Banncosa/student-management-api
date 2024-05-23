<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'birthdate' => $this->faker->date(),
            'sex' => $this->faker->randomElement(['MALE', 'FEMALE']),
            'address' => $this->faker->address,
            'year' => $this->faker->numberBetween(1, 5),
            'course' => $this->faker->randomElement(['Computer Science', 'Engineering', 'Mathematics']),
            'section' => $this->faker->randomElement(['A', 'B', 'C']),
        ];
    }
}