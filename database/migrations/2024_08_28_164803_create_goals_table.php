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
        Schema::create('goals', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->foreignId('user_profile_id')->references('id')->on('user_profile')->onDelete('cascade');
            $table->date('GoalStarted');
            $table->string('goalStatus');
            $table->float('goalRate');
            $table->float('goalWeight');
            $table->timestamps();
            $table->string('approach');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
