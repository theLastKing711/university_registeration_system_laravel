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
        Schema::create('department_registeration_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained();

            $table->unsignedBigInteger('academic_year_semester_id');
            $table->foreign('academic_year_semester_id', 'department_registeration_periods_semester_id_foreign')->references('id')->on('academic_year_semesters');

            $table->boolean('is_open_for_students');
            // $table->unique(['department_id', 'year', 'semester'], 'department_registeration_periods_main_unique');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_registeration_periods');
    }
};
