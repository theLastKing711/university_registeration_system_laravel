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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('course_teacher_id')
                ->constrained('course_teacher')
                ->cascadeOnDelete();
            $table
                ->foreignId('classroom_id')
                ->constrained('classrooms')
                ->cascadeOnDelete();

            $table->integer('max_mark');
            $table->date('date');
            $table->time('from');
            $table->time('to');
            $table
                ->boolean('is_main_exam')
                ->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
