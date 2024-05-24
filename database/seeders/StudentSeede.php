<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run()
    {
        Student::create([
            'firstname' => 'Irvin',
            'lastname' => 'Pogi',
            'birthdate' => '2000-11-01',
            'sex' => 'MALE',
            'address' => 'Basey',
            'year' => 3,
            'course' => 'BSIT',
            'section' => 'B'
        ]);
        // Add more students if needed
    }
}
