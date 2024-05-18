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
            $table->string('employee_id')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('total_hour')->nullable();
            $table->string('regular_hour')->nullable();
            $table->string('overtime_hour')->nullable();
            $table->string('regular_salary')->nullable();
            $table->string('overtime_salary')->nullable();
            $table->string('total_salary')->nullable();
            $table->string('paid')->nullable();
            $table->string('due')->nullable();
            $table->timestamps();
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
