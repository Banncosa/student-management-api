<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        Student::all()->each(function ($student) {
            Subject::factory()->count(8)->create([
                'student_id' => $student->id
            ]);
        });
    }
}
