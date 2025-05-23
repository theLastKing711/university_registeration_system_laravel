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
        Schema::create('course_regiteration_classroom', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_regiteration_id')->constrained();
            $table->foreignId('classroom_id')->constrained();
            $table->integer('day_of_week');
            $table->time('from');
            $table->time('to');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_regiteration_classroom')
    }
};
