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
        Schema::create('classroom_course_teacher', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('classroom_id')
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignId('course_teacher_id')
                ->constrained('course_teacher')
                ->cascadeOnDelete();
            $table->integer('day');
            $table->time('from');
            $table->time('to');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classroom_course_teacher');
    }
};
