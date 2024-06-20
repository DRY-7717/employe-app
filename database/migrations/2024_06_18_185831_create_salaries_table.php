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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id');
            $table->bigInteger('salary');
            $table->bigInteger('education_allowance')->default(0);
            $table->bigInteger('health_allowance')->default(0);
            $table->bigInteger('transportation_allowance')->default(0);
            $table->timestamps();
            $table->foreign('position_id')->on('positions')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
