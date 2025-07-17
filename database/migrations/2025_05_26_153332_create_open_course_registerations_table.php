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
        Schema::create('open_course_registerations', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('course_id')
                ->constrained()
                ->cascadeOnDelete();
            $table
                ->foreignId('academic_year_semester_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->decimal('price_in_usd', '6', '2');
            // $table->unique(['course_id', 'year', 'semester']);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('open_course_registerations');
    }
};
