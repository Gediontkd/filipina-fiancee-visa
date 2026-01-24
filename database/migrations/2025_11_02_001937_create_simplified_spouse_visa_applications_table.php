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

            // Use TEXT for all potentially long fields to avoid row size limits
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            // Sponsor Information
            $table->text('sponsor_first_name')->nullable();
            $table->text('sponsor_middle_name')->nullable();
            $table->text('sponsor_last_name')->nullable();
            $table->text('sponsor_sex')->nullable();
            $table->text('sponsor_email')->nullable();
            $table->text('sponsor_phone')->nullable();
            $table->text('sponsor_address')->nullable();
            $table->text('sponsor_apt')->nullable();
            $table->text('sponsor_city')->nullable();
            $table->text('sponsor_state')->nullable();
            $table->text('sponsor_zip')->nullable();
            $table->text('sponsor_country')->nullable();
            $table->date('sponsor_dob')->nullable();
            $table->text('sponsor_place_of_birth')->nullable();
            $table->text('sponsor_citizenship')->nullable();
            $table->text('sponsor_ssn')->nullable();

            // Sponsor Mailing Address
            $table->text('sponsor_mailing_address')->nullable();
            $table->text('sponsor_mailing_apt')->nullable();
            $table->text('sponsor_mailing_city')->nullable();
            $table->text('sponsor_mailing_state')->nullable();
            $table->text('sponsor_mailing_zip')->nullable();
            $table->text('sponsor_mailing_date_from')->nullable();
            $table->text('sponsor_mailing_date_to')->nullable();
            $table->text('sponsor_same_address')->nullable();

            // Sponsor Parents
            $table->text('sponsor_parent1_first_name')->nullable();
            $table->text('sponsor_parent1_middle_name')->nullable();
            $table->text('sponsor_parent1_last_name')->nullable();
            $table->date('sponsor_parent1_dob')->nullable();
            $table->text('sponsor_parent1_sex')->nullable();
            $table->text('sponsor_parent1_country')->nullable();
            $table->text('sponsor_parent2_first_name')->nullable();
            $table->text('sponsor_parent2_middle_name')->nullable();
            $table->text('sponsor_parent2_last_name')->nullable();
            $table->date('sponsor_parent2_dob')->nullable();
            $table->text('sponsor_parent2_sex')->nullable();
            $table->text('sponsor_parent2_country')->nullable();

            // Sponsor History
            $table->json('sponsor_address_history')->nullable();
            $table->json('sponsor_employment_history')->nullable();

            // Sponsor Employment - OPTIONAL
            $table->text('sponsor_employment_status')->nullable();
            $table->text('sponsor_employer_name')->nullable();
            $table->text('sponsor_occupation')->nullable();
            $table->decimal('sponsor_annual_income', 12, 2)->nullable();

            // Beneficiary Information
            $table->text('beneficiary_first_name')->nullable();
            $table->text('beneficiary_middle_name')->nullable();
            $table->text('beneficiary_last_name')->nullable();
            $table->text('beneficiary_sex')->nullable();
            $table->text('beneficiary_email')->nullable();
            $table->text('beneficiary_phone')->nullable();
            $table->text('beneficiary_address')->nullable();
            $table->text('beneficiary_apt')->nullable();
            $table->text('beneficiary_city')->nullable();
            $table->text('beneficiary_state')->nullable();
            $table->text('beneficiary_zip')->nullable();
            $table->text('beneficiary_country')->nullable();
            $table->date('beneficiary_dob')->nullable();
            $table->text('beneficiary_place_of_birth')->nullable();
            $table->text('beneficiary_citizenship')->nullable();
            $table->text('beneficiary_passport_number')->nullable();
            $table->text('beneficiary_alien_number')->nullable();

            // Beneficiary Mailing Address
            $table->text('beneficiary_mailing_address')->nullable();
            $table->text('beneficiary_mailing_apt')->nullable();
            $table->text('beneficiary_mailing_city')->nullable();
            $table->text('beneficiary_mailing_state')->nullable();
            $table->text('beneficiary_mailing_zip')->nullable();
            $table->text('beneficiary_mailing_country')->nullable();
            $table->text('beneficiary_mailing_date_from')->nullable();
            $table->text('beneficiary_mailing_date_to')->nullable();
            $table->text('beneficiary_same_address')->nullable();

            $table->json('beneficiary_parents_list')->nullable();

            // Beneficiary Parents
            $table->text('beneficiary_parent1_first_name')->nullable();
            $table->text('beneficiary_parent1_middle_name')->nullable();
            $table->text('beneficiary_parent1_last_name')->nullable();
            $table->date('beneficiary_parent1_dob')->nullable();
            $table->text('beneficiary_parent1_sex')->nullable();
            $table->text('beneficiary_parent1_country')->nullable();
            $table->text('beneficiary_parent2_first_name')->nullable();
            $table->text('beneficiary_parent2_middle_name')->nullable();
            $table->text('beneficiary_parent2_last_name')->nullable();
            $table->date('beneficiary_parent2_dob')->nullable();
            $table->text('beneficiary_parent2_sex')->nullable();
            $table->text('beneficiary_parent2_country')->nullable();

            // Beneficiary History
            $table->json('beneficiary_address_history')->nullable();
            $table->json('beneficiary_employment_history')->nullable();

            // Beneficiary Employment - OPTIONAL
            $table->text('beneficiary_employment_status')->nullable();
            $table->text('beneficiary_employer_name')->nullable();
            $table->text('beneficiary_occupation')->nullable();

            // Relationship Information
            $table->date('marriage_date')->nullable();
            $table->text('marriage_location_city')->nullable();
            $table->text('marriage_location_state')->nullable();
            $table->text('marriage_location_province')->nullable();
            $table->text('marriage_location_country')->nullable();
            $table->integer('sponsor_times_married')->nullable();
            $table->json('sponsor_previous_marriages_list')->nullable();
            $table->text('sponsor_prev_spouse_first_name')->nullable();
            $table->text('sponsor_prev_spouse_last_name')->nullable();
            $table->date('sponsor_divorce_date')->nullable();
            $table->json('beneficiary_previous_marriages_list')->nullable();
            $table->text('beneficiary_prev_spouse_first_name')->nullable();
            $table->text('beneficiary_prev_spouse_last_name')->nullable();
            $table->date('beneficiary_divorce_date')->nullable();

            // Previous Marriages (multiple entries)
            $table->json('sponsor_previous_marriages')->nullable();
            $table->json('beneficiary_previous_marriages')->nullable();

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