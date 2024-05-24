<?php
// database/migrations/xxxx_xx_xx_create_subjects_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('subject_code');
            $table->string('name');
            $table->text('description');
            $table->string('instructor');
            $table->string('schedule');
            $table->json('grades');
            $table->double('average_grade');
            $table->string('remarks');
            $table->date('date_taken');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('subjects', function (Blueprint $table) {
            // Drop foreign key constraints
            $table->dropForeign(['student_id']);
        });
    
        // Now drop the subjects table
        Schema::dropIfExists('subjects');
    }
    
}
