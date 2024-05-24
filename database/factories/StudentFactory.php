<?php

namespace Database\Factories;

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'firstname' => $faker->firstName,
        'lastname' => $faker->lastName,
        'birthdate' => $faker->date('Y-m-d'),
        'sex' => $faker->randomElement(['MALE', 'FEMALE']),
        'address' => $faker->address,
        'year' => $faker->numberBetween(1, 4),
        'course' => $faker->word,
        'section' => $faker->word,
    ];
});
