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
        Schema::create('cross_listed_courses', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('first_course_id')
                ->constrained('courses')
                ->cascadeOnDelete();
            $table
                ->foreignId('second_course_id')
                ->constrained('courses')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cross_listed_courses');
    }
};
