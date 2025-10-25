<?php
// database/migrations/2025_10_23_205014_create_combined_cr1_aos_steps_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Main progress steps table (like spouse_steps, fiance_steps)
        Schema::create('combined_cr1_aos_steps', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        // User progress tracking (like spouse_visa_steps)
        Schema::create('combined_cr1_aos_visa_steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->unsignedBigInteger('step_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // Submitted step data (like spouse_visa_submitted_steps)
        Schema::create('combined_cr1_aos_submitted_steps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('step')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('combined_cr1_aos_submitted_steps');
        Schema::dropIfExists('combined_cr1_aos_visa_steps');
        Schema::dropIfExists('combined_cr1_aos_steps');
    }
};