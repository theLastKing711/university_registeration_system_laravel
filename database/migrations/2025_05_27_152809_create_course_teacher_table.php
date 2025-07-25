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
        Schema::create('course_teacher', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('course_id')
                ->constrained('open_course_registerations')
                ->cascadeOnDelete();

            $table
                ->foreignId('teacher_id')
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->boolean('is_main_teacher')
                ->default(true);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_teacher');
    }
};
