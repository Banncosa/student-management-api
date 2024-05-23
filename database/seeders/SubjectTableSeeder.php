<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Subject;

class StudentSubjectSeeder extends Seeder
{
    /**
     * 
     *
     * @return void
     */
    public function run()
    {

        $students = Student::all();

        foreach ($students as $student) {

            $this->seedSubjects($student);
        }
    }

    /**
     * 
     *
     * @param  Student  
     * @return void
     */
    private function seedSubjects(Student $student)
    {
       
        $numberOfSubjects = 5;

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
     * 
     *
     * @return float
     */
    private function generateAverageGrade()
    {

        return mt_rand(10, 50) / 10; 
    }
}
