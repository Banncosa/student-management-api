<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 50; $i++) {
            Student::create([
                'firstname' => $faker->firstName,
                'lastname' => $faker->lastName,
                'birthdate' => $faker->date('Y-m-d'),
                'sex' => $faker->randomElement(['MALE', 'FEMALE']),
                'address' => $faker->address,
                'year' => $faker->numberBetween(1, 4),
                'course' => $faker->word,
                'section' => strtoupper($faker->randomLetter)
            ]);
        }
    }
}
