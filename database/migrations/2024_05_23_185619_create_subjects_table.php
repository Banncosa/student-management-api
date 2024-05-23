<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->string('subject_code');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('instructor')->nullable();
            $table->string('schedule')->nullable();
            $table->integer('credits')->nullable();
            $table->string('semester')->nullable();
            $table->integer('year_level')->nullable();
            $table->enum('status', ['ONGOING', 'COMPLETED', 'DROPPED'])->default('ONGOING');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
