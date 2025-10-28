<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add 'type' column to spouse_steps
        Schema::table('spouse_steps', function (Blueprint $table) {
            $table->enum('type', ['sponsor', 'beneficiary', 'shared'])
                ->default('sponsor')
                ->after('icon');
        });

        // Add 'section' column to spouse_visa_steps
        Schema::table('spouse_visa_steps', function (Blueprint $table) {
            $table->enum('section', ['sponsor', 'beneficiary', 'shared'])
                ->default('sponsor')
                ->after('step_id');
        });

        // Add 'section' column to spouse_visa_submitted_steps
        Schema::table('spouse_visa_submitted_steps', function (Blueprint $table) {
            $table->enum('section', ['sponsor', 'beneficiary', 'shared'])
                ->default('sponsor')
                ->after('submitted_app_id');
        });

        // Create user_spouse_visa_types table
        Schema::create('user_spouse_visa_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['sponsor', 'beneficiary']);
            $table->enum('status', ['in-progress', 'completed'])->default('in-progress');
            $table->timestamps();
            
            $table->unique(['user_id', 'type']);
            $table->index(['user_id', 'type', 'status']);
        });

        // Create spouse_sponsors table
        Schema::create('spouse_sponsors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('step_id')->constrained('spouse_visa_submitted_steps')->onDelete('cascade');
            $table->string('name'); // step name: 'name', 'contact', etc.
            $table->timestamps();
            
            $table->index(['user_id', 'name']);
        });

        // Create spouse_beneficiaries table
        Schema::create('spouse_beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('step_id')->constrained('spouse_visa_submitted_steps')->onDelete('cascade');
            $table->string('name'); // step name: 'name', 'contact', etc.
            $table->timestamps();
            
            $table->index(['user_id', 'name']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('spouse_beneficiaries');
        Schema::dropIfExists('spouse_sponsors');
        Schema::dropIfExists('user_spouse_visa_types');
        
        Schema::table('spouse_visa_submitted_steps', function (Blueprint $table) {
            $table->dropColumn('section');
        });
        
        Schema::table('spouse_visa_steps', function (Blueprint $table) {
            $table->dropColumn('section');
        });
        
        Schema::table('spouse_steps', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};