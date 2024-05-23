<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Subject;

class StudentSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Retrieve all students
        $students = Student::all();

        // Loop through each student
        foreach ($students as $student) {
            // Seed subjects for the student
            $this->seedSubjects($student);
        }
    }

    /**
     * Seed subjects for the given student.
     *
     * @param  \App\Models\Student  $student
     * @return void
     */
    private function seedSubjects(Student $student)
    {
        // Define the number of subjects to seed for each student
        $numberOfSubjects = 5;

        // Seed subjects with random grades
        for ($i = 0; $i < $numberOfSubjects; $i++) {
            $subject = new Subject();
            $subject->student_id = $student->id;
            $subject->subject_code = 'SUB' . ($i + 1);
            $subject->name = 'Subject ' . ($i + 1);
            $subject->description = 'Lorem ipsum dolor sit amet.';
            $subject->instructor = 'Mr. John Doe';
            $subject->schedule = 'MW 7AM-12PM';
            $subject->prelims = mt_rand(10, 50) / 10;
            $subject->midterms = mt_rand(10, 50) / 10;
            $subject->pre_finals = mt_rand(10, 50) / 10;
            $subject->finals = mt_rand(10, 50) / 10;
            $subject->average_grade = $this->generateAverageGrade();
            $subject->remarks = $subject->average_grade >= 3.0 ? 'PASSED' : 'FAILED';
            $subject->date_taken = '2024-01-01';

            $subject->save();
        }
    }

    /**
     * Generate a random average grade.
     *
     * @return float
     */
    private function generateAverageGrade()
    {
        // Generate a random average grade between 1.0 and 5.0
        return mt_rand(10, 50) / 10; // Divide by 10 to get a decimal number
    }
}
