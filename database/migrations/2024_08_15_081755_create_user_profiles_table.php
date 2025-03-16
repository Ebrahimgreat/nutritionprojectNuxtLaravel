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
        Schema::create('user_profiles', function (Blueprint $table) {

            $table->foreignId('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->id();
            $table->float('height');
            $table->String('Sex');
            $table->float('activityLevel');
            $table->integer('age');

            $table->float('expenditure');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_profiles');
    }
};
