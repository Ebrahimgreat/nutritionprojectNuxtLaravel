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
        Schema::create('custom_foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('defaultProtein');
            $table->float('defaultCalories');
            $table->float('defaultCarbs');
            $table->float('defaultFat');
            $table->float('defaultQuantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_foods');
    }
};
