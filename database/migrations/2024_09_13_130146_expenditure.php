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
        Schema::create('expenditures', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('user_profile_id')->references('id')->on('user_profiles')->onDelete('cascade');
            $table->float('expenditure');
            $table->timestamps();

        });



        //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
