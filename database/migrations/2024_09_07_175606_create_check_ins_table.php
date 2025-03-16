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
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();
            $table->string('checkDay');
            $table->date('date');
            $table->string('complianceDays');
            $table->Boolean('complianceCalories');
            $table->string('targetCalories');
            $table->foreignId('goal_id')->references('id')->on('goals');
            $table->timestamps();
            $table->date('actualCheckInDate')->nullable();
            $table->float('proteinTarget');
            $table->float('carbsTarget');
            $table->float('fatsTarget');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check_ins');
    }
};
