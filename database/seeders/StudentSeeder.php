<?php

namespace Database\Seeders;

use App\Models\Student;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder; // Corrected Namespace

class StudentSeeder extends Seeder
{
    use App\Models\Student;

    public function run()
    {
        Student::factory()->count(50)->create();
    }
    
}
