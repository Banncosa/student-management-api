<?php

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

$factory->define(Subject::class, function (Faker\Generator $faker) {
    return [
        'subject_code' => $faker->unique()->regexify('[A-Z0-9]{5}-[0-9]{3}'),
        'name' => $faker->sentence,
        'description' => $faker->paragraph,
        'instructor' => $faker->name,
        'schedule' => $faker->randomElement(['MW 7AM-12PM', 'TTh 1PM-5PM', 'WF 8AM-10AM']),
        'grades' => [
            'prelims' => $faker->randomFloat(2, 0, 100),
            'midterms' => $faker->randomFloat(2, 0, 100),
            'pre_finals' => $faker->randomFloat(2, 0, 100),
            'finals' => $faker->randomFloat(2, 0, 100),
        ],
        'average_grade' => $faker->randomFloat(2, 0, 100),
        'remarks' => $faker->randomElement(['PASSED', 'FAILED']),
        'date_taken' => $faker->date('Y-m-d'),
    ];
});
