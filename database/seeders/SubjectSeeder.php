<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        Subject::create([
            'student_id' => 1,
            'subject_code' => 'IT3B-123',
            'name' => 'Application Lifecycle Management',
            'description' => 'process of managing the entire lifecycle of a software application from its initial planning and development through deployment, maintenance, and eventual retirement. It encompasses a set of practices, tools, and methodologies that ensure software applications are developed, maintained, and delivered efficiently and effectively.',
            'instructor' => 'Mr. Cy Alonzo',
            'schedule' => 'MW 7AM-12PM',
            'grades' => json_encode(['prelims' => 2.75, 'midterms' => 2.0, 'pre_finals' => 1.75, 'finals' => 1.0]),
            'average_grade' => 1.87,
            'remarks' => 'PASSED',
            'date_taken' => '2024-01-01'
        ]);
        
    }
}
