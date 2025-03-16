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
        Schema::create('workout_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('workout_id')->references('id')->on('workouts')->onDelete('cascade');
            $table->decimal('volume');
            $table->integer('reps');
            $table->integer('weight');
            $table->integer('set');
            $table->string('difficulty');
            $table->integer('rpe');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_details');
    }
};
