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
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            // Add new sponsor fields
            $table->string('sponsor_sex', 10)->nullable()->after('sponsor_last_name');
            $table->string('sponsor_apt', 20)->nullable()->after('sponsor_address');
            
            // Add sponsor parent 1 fields
            $table->string('sponsor_parent1_first_name', 50)->nullable()->after('sponsor_ssn');
            $table->string('sponsor_parent1_middle_name', 50)->nullable()->after('sponsor_parent1_first_name');
            $table->string('sponsor_parent1_last_name', 50)->nullable()->after('sponsor_parent1_middle_name');
            $table->date('sponsor_parent1_dob')->nullable()->after('sponsor_parent1_last_name');
            $table->string('sponsor_parent1_sex', 10)->nullable()->after('sponsor_parent1_dob');
            $table->string('sponsor_parent1_country', 100)->nullable()->after('sponsor_parent1_sex');
            
            // Add sponsor parent 2 fields
            $table->string('sponsor_parent2_first_name', 50)->nullable()->after('sponsor_parent1_country');
            $table->string('sponsor_parent2_middle_name', 50)->nullable()->after('sponsor_parent2_first_name');
            $table->string('sponsor_parent2_last_name', 50)->nullable()->after('sponsor_parent2_middle_name');
            $table->date('sponsor_parent2_dob')->nullable()->after('sponsor_parent2_last_name');
            $table->string('sponsor_parent2_sex', 10)->nullable()->after('sponsor_parent2_dob');
            $table->string('sponsor_parent2_country', 100)->nullable()->after('sponsor_parent2_sex');
            
            // Add new beneficiary fields
            $table->string('beneficiary_sex', 10)->nullable()->after('beneficiary_last_name');
            $table->string('beneficiary_apt', 20)->nullable()->after('beneficiary_address');
            
            // Add beneficiary parent 1 fields
            $table->string('beneficiary_parent1_first_name', 50)->nullable()->after('beneficiary_alien_number');
            $table->string('beneficiary_parent1_middle_name', 50)->nullable()->after('beneficiary_parent1_first_name');
            $table->string('beneficiary_parent1_last_name', 50)->nullable()->after('beneficiary_parent1_middle_name');
            $table->date('beneficiary_parent1_dob')->nullable()->after('beneficiary_parent1_last_name');
            $table->string('beneficiary_parent1_sex', 10)->nullable()->after('beneficiary_parent1_dob');
            $table->string('beneficiary_parent1_country', 100)->nullable()->after('beneficiary_parent1_sex');
            
            // Add beneficiary parent 2 fields
            $table->string('beneficiary_parent2_first_name', 50)->nullable()->after('beneficiary_parent1_country');
            $table->string('beneficiary_parent2_middle_name', 50)->nullable()->after('beneficiary_parent2_first_name');
            $table->string('beneficiary_parent2_last_name', 50)->nullable()->after('beneficiary_parent2_middle_name');
            $table->date('beneficiary_parent2_dob')->nullable()->after('beneficiary_parent2_last_name');
            $table->string('beneficiary_parent2_sex', 10)->nullable()->after('beneficiary_parent2_dob');
            $table->string('beneficiary_parent2_country', 100)->nullable()->after('beneficiary_parent2_sex');
            
            // Add new marriage fields
            $table->string('marriage_location_state', 2)->nullable()->after('marriage_location_city');
            $table->string('marriage_location_province', 50)->nullable()->after('marriage_location_state');
            $table->integer('sponsor_times_married')->nullable()->after('marriage_location_country');
            
            // Add previous spouse name fields
            $table->string('sponsor_prev_spouse_first_name', 50)->nullable()->after('sponsor_previous_marriages');
            $table->string('sponsor_prev_spouse_last_name', 50)->nullable()->after('sponsor_prev_spouse_first_name');
            
            $table->string('beneficiary_prev_spouse_first_name', 50)->nullable()->after('beneficiary_previous_marriages');
            $table->string('beneficiary_prev_spouse_last_name', 50)->nullable()->after('beneficiary_prev_spouse_first_name');
        });
        
        // Drop columns that are not on I-130 form
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            // Remove non-I-130 relationship fields
            if (Schema::hasColumn('simplified_spouse_visa_applications', 'first_met_date')) {
                $table->dropColumn([
                    'first_met_date',
                    'first_met_location',
                    'times_met_in_person',
                    'last_meeting_date',
                    'communication_methods',
                    'relationship_description'
                ]);
            }
        });
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