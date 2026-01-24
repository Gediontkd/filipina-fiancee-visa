<?php
// FILE: database/migrations/2025_XX_XX_XXXXXX_update_simplified_spouse_visa_applications_table.php
// Add new fields and remove old ones

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
        // Migration no longer needed as create migration now includes all fields
        // Keeping for compatibility
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            // Drop new fields
            $table->dropColumn([
                'sponsor_sex',
                'sponsor_apt',
                'sponsor_parent1_first_name',
                'sponsor_parent1_middle_name',
                'sponsor_parent1_last_name',
                'sponsor_parent1_dob',
                'sponsor_parent1_sex',
                'sponsor_parent1_country',
                'sponsor_parent2_first_name',
                'sponsor_parent2_middle_name',
                'sponsor_parent2_last_name',
                'sponsor_parent2_dob',
                'sponsor_parent2_sex',
                'sponsor_parent2_country',
                'beneficiary_sex',
                'beneficiary_apt',
                'beneficiary_parent1_first_name',
                'beneficiary_parent1_middle_name',
                'beneficiary_parent1_last_name',
                'beneficiary_parent1_dob',
                'beneficiary_parent1_sex',
                'beneficiary_parent1_country',
                'beneficiary_parent2_first_name',
                'beneficiary_parent2_middle_name',
                'beneficiary_parent2_last_name',
                'beneficiary_parent2_dob',
                'beneficiary_parent2_sex',
                'beneficiary_parent2_country',
                'marriage_location_state',
                'marriage_location_province',
                'sponsor_times_married',
                'sponsor_prev_spouse_first_name',
                'sponsor_prev_spouse_last_name',
                'beneficiary_prev_spouse_first_name',
                'beneficiary_prev_spouse_last_name'
            ]);
        });
        
        // Re-add removed fields
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            $table->date('first_met_date')->nullable();
            $table->string('first_met_location', 200)->nullable();
            $table->integer('times_met_in_person')->nullable();
            $table->date('last_meeting_date')->nullable();
            $table->string('communication_methods', 500)->nullable();
            $table->text('relationship_description')->nullable();
        });
    }
};