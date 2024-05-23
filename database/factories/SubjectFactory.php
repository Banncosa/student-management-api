<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    protected $model = Subject::class;

    public function definition()
    {
        $grades = [
            'prelims' => $this->faker->randomFloat(2, 1, 5),
            'midterms' => $this->faker->randomFloat(2, 1, 5),
            'pre_finals' => $this->faker->randomFloat(2, 1, 5),
            'finals' => $this->faker->randomFloat(2, 1, 5),
        ];
        $average_grade = array_sum($grades) / count($grades);
        $remarks = $average_grade >= 3.0 ? 'PASSED' : 'FAILED';

        return [
            'subject_code' => $this->faker->regexify('[A-Z0-9]{3}-[0-9]{3}'),
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'instructor' => $this->faker->name,
            'schedule' => $this->faker->randomElement(['MW 7AM-12PM', 'TTH 1PM-5PM']),
            'grades' => json_encode($grades),
            'average_grade' => $average_grade,
            'remarks' => $remarks,
            'date_taken' => $this->faker->date('Y-m-d')
        ];
    }
}

