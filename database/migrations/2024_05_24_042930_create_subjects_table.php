<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('subject_code');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('instructor');
            $table->string('schedule');
            $table->json('grades')->nullable();
            $table->double('average_grade')->nullable();
            $table->string('remarks')->nullable();
            $table->date('date_taken');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subjects');
    }
}
