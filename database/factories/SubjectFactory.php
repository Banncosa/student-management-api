<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //variable holders with correct usage of randomFloat
        $prelims = $this->faker->randomFloat(2, 1, 4);
        $midterms= $this->faker->randomFloat(2, 1, 4);
        $pre_finals = $this->faker->randomFloat(2, 1, 4);
        $finals = $this->faker->randomFloat(2, 1, 4);

        //average
        $average = ($prelims + $midterms + $pre_finals + $finals) / 4;
        $average = round($average, 2);
        //remarks logic
        $remarks = $average <= 3.0 ? 'PASSED' : 'FAILED';

        return [
            'subject_code' => $this->faker->regexify('[A-Z]{3}-[0-9]{3}'),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->text(200),
            'instructor' => $this->faker->name,
            'schedule' => $this->faker->randomElement(['MWF 9AM-11AM', 'TH 1PM-4PM', 'MW 7AM-10AM']),
            'grades' => json_encode([
                'prelims' => $prelims,
                'midterms' => $midterms,
                'pre_finals' => $pre_finals,
                'finals' => $finals,
            ]),
            'average_grade' => $average,
            'remarks' => $remarks,
            'date_taken' => $this->faker->date,
        ];
    }
}
