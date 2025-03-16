d<?php

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

        Schema::create('nutrition_tracking', function (Blueprint $table) {
            $table->boolean('tracked');
            $table->date('date');
            $table->integer('streak');
            $table->foreignId('nutrientsId')
                ->references('id')           // The column in the 'nutrients' table
                ->on('nutrients')            // The table being referenced
                ->onDelete('cascade');
            $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_tracking');
    }
};
