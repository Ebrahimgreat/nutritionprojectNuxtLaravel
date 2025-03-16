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
        Schema::create('habits', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('habits_id')->constrained('habitables');
            $table->foreignId('nutrition_id')->constrained('nutritions');
            $table->foreignId('steps_id')->constrained('steps');

            $table->date('date');
            $table->String('Tracked');
            $table->String('UnTracked');
            $table->id();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habits');
    }
};
