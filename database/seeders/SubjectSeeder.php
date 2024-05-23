<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;
use App\Models\Student;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        $students = Student::all();

        foreach ($students as $student) {
            Subject::factory()->count(5)->create(['student_id' => $student->id]);
        }
    }
}
