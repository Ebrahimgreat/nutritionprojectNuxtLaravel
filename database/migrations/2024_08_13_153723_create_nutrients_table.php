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
        Schema::create('nutrients', function (Blueprint $table) {
            $table->float('Protein')->default(0);
            $table->float('Carbs')->default(0);
            $table->float('Fat')->default(0);
            $table->float('Fiber')->default(0);
            $table->float('Water')->default(0);
            $table->float('Calories')->default(0);
            $table->float('Target Calories');
            $table->foreignid('foods_id')->references('id')->on('foods');
            $table->foreignid('user_profile_id')->references('id')->on('user_profiles');
            $table->String('food_name');
            $table->float('quantity');
            $table->time('time');
            $table->id();
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutritionController');
    }
};
