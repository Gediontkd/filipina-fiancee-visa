<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('simplified_aos_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('submitted_app_id')->constrained('user_submitted_applications')->onDelete('cascade');
            
            // Applicant Information
            $table->string('applicant_first_name')->nullable();
            $table->string('applicant_middle_name')->nullable();
            $table->string('applicant_last_name')->nullable();
            $table->string('applicant_email')->nullable();
            $table->string('applicant_phone')->nullable();
            $table->text('applicant_address')->nullable();
            $table->string('applicant_city')->nullable();
            $table->string('applicant_state')->nullable();
            $table->string('applicant_zip')->nullable();
            $table->date('applicant_dob')->nullable();
            $table->string('applicant_place_of_birth')->nullable();
            $table->string('applicant_citizenship')->nullable();
            $table->string('applicant_alien_number')->nullable();
            $table->string('applicant_ssn')->nullable();
            $table->string('applicant_employment_status')->nullable();
            $table->string('applicant_employer_name')->nullable();
            $table->string('applicant_occupation')->nullable();
            
            // Immigration Status
            $table->string('current_visa_type')->nullable();
            $table->date('visa_expiration_date')->nullable();
            $table->string('i94_number')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('passport_country')->nullable();
            $table->date('passport_expiration')->nullable();
            $table->date('entry_date')->nullable();
            $table->string('entry_location')->nullable();
            
            // Sponsor Information
            $table->string('sponsor_first_name')->nullable();
            $table->string('sponsor_middle_name')->nullable();
            $table->string('sponsor_last_name')->nullable();
            $table->string('sponsor_email')->nullable();
            $table->string('sponsor_phone')->nullable();
            $table->text('sponsor_address')->nullable();
            $table->string('sponsor_city')->nullable();
            $table->string('sponsor_state')->nullable();
            $table->string('sponsor_zip')->nullable();
            $table->string('sponsor_relationship')->nullable();
            $table->string('sponsor_citizenship_status')->nullable();
            $table->string('sponsor_ssn')->nullable();
            
            // Marital Information
            $table->string('marital_status')->nullable();
            $table->date('marriage_date')->nullable();
            $table->string('spouse_name')->nullable();
            
            // Background Questions
            $table->enum('arrested_or_convicted', ['yes', 'no'])->nullable();
            $table->enum('immigration_violations', ['yes', 'no'])->nullable();
            $table->enum('public_assistance', ['yes', 'no'])->nullable();
            $table->text('background_explanation')->nullable();
            
            $table->enum('status', ['draft', 'submitted', 'under_review', 'approved', 'rejected'])->default('draft');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'submitted_app_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('simplified_aos_applications');
    }
};