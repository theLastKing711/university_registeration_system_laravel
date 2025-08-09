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
        Schema::create('student_course_registerations', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('student_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table
                ->foreignId('course_id')
                ->constrained('open_course_registerations')
                ->cascadeOnDelete();

            $table
                ->integer('final_mark')
                ->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_course_registerations');
    }
};
