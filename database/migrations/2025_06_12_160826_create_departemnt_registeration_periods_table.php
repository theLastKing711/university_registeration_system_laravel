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
        Schema::create('departemnt_registeration_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained();
            $table->year('year');
            $table->integer('semester');
            $table->boolean('is_open_for_students');
            $table->unique(['department_id', 'year', 'semester'], 'departemnt_registeration_periods_main_unique');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departemnt_registeration_periods');
    }
};
