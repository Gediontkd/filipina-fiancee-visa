<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration: Simplified Spouse Visa Applications Table
 * Creates a single table to store all spouse visa application data
 */
class CreateSimplifiedSpouseVisaApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('simplified_spouse_visa_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('submitted_app_id')->constrained('user_submitted_applications')->onDelete('cascade');
            
            // Sponsor Information
            $table->string('sponsor_first_name')->nullable();
            $table->string('sponsor_middle_name')->nullable();
            $table->string('sponsor_last_name')->nullable();
            $table->string('sponsor_email')->nullable();
            $table->string('sponsor_phone', 20)->nullable();
            $table->text('sponsor_address')->nullable();
            $table->string('sponsor_city')->nullable();
            $table->string('sponsor_state')->nullable();
            $table->string('sponsor_zip', 20)->nullable();
            $table->string('sponsor_country')->nullable();
            $table->date('sponsor_dob')->nullable();
            $table->string('sponsor_place_of_birth')->nullable();
            $table->string('sponsor_citizenship')->nullable();
            $table->string('sponsor_ssn', 20)->nullable();
            $table->string('sponsor_employment_status')->nullable();
            $table->string('sponsor_employer_name')->nullable();
            $table->string('sponsor_occupation')->nullable();
            $table->decimal('sponsor_annual_income', 12, 2)->nullable();
            
            // Beneficiary Information
            $table->string('beneficiary_first_name')->nullable();
            $table->string('beneficiary_middle_name')->nullable();
            $table->string('beneficiary_last_name')->nullable();
            $table->string('beneficiary_email')->nullable();
            $table->string('beneficiary_phone', 20)->nullable();
            $table->text('beneficiary_address')->nullable();
            $table->string('beneficiary_city')->nullable();
            $table->string('beneficiary_state')->nullable();
            $table->string('beneficiary_zip', 20)->nullable();
            $table->string('beneficiary_country')->nullable();
            $table->date('beneficiary_dob')->nullable();
            $table->string('beneficiary_place_of_birth')->nullable();
            $table->string('beneficiary_citizenship')->nullable();
            $table->string('beneficiary_passport_number', 50)->nullable();
            $table->string('beneficiary_alien_number', 20)->nullable();
            $table->string('beneficiary_employment_status')->nullable();
            $table->string('beneficiary_employer_name')->nullable();
            $table->string('beneficiary_occupation')->nullable();
            
            // Relationship Information
            $table->date('marriage_date')->nullable();
            $table->string('marriage_location_city')->nullable();
            $table->string('marriage_location_country')->nullable();
            $table->date('first_met_date')->nullable();
            $table->string('first_met_location')->nullable();
            $table->text('relationship_description')->nullable();
            $table->integer('times_met_in_person')->nullable();
            $table->date('last_meeting_date')->nullable();
            $table->string('communication_methods')->nullable();
            $table->enum('sponsor_previous_marriages', ['yes', 'no'])->nullable();
            $table->enum('beneficiary_previous_marriages', ['yes', 'no'])->nullable();
            $table->date('sponsor_divorce_date')->nullable();
            $table->date('beneficiary_divorce_date')->nullable();
            
            // Status tracking
            $table->enum('status', ['draft', 'submitted', 'under_review', 'approved', 'rejected'])->default('draft');
            $table->timestamp('submitted_at')->nullable();
            
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['user_id', 'status']);
            $table->index('submitted_app_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('simplified_spouse_visa_applications');
    }
}