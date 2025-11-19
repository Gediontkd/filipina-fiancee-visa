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
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            // ========================================
            // SPONSOR ADDITIONAL FIELDS
            // ========================================
            
            // Other Names Used
            $table->json('sponsor_other_names')->nullable()->after('sponsor_last_name');
            
            // Additional IDs
            $table->string('sponsor_a_number', 20)->nullable()->after('sponsor_ssn');
            $table->string('sponsor_uscis_account', 20)->nullable()->after('sponsor_a_number');
            
            // Citizenship Details
            $table->string('sponsor_citizenship_method', 50)->nullable()->after('sponsor_citizenship');
            $table->string('sponsor_certificate_number', 50)->nullable()->after('sponsor_citizenship_method');
            $table->text('sponsor_certificate_place')->nullable()->after('sponsor_certificate_number');
            $table->date('sponsor_certificate_date')->nullable()->after('sponsor_certificate_place');
            
            // Biographic Information
            $table->string('sponsor_ethnicity', 50)->nullable()->after('sponsor_citizenship');
            $table->json('sponsor_race')->nullable()->after('sponsor_ethnicity');
            $table->tinyInteger('sponsor_height_feet')->nullable()->after('sponsor_race');
            $table->tinyInteger('sponsor_height_inches')->nullable()->after('sponsor_height_feet');
            $table->smallInteger('sponsor_weight')->nullable()->after('sponsor_height_inches');
            $table->string('sponsor_eye_color', 30)->nullable()->after('sponsor_weight');
            $table->string('sponsor_hair_color', 30)->nullable()->after('sponsor_eye_color');
            
            // Parent Residence Information
            $table->text('sponsor_parent1_city_residence')->nullable()->after('sponsor_parent1_country');
            $table->text('sponsor_parent1_country_residence')->nullable()->after('sponsor_parent1_city_residence');
            $table->text('sponsor_parent2_city_residence')->nullable()->after('sponsor_parent2_country');
            $table->text('sponsor_parent2_country_residence')->nullable()->after('sponsor_parent2_city_residence');
            
            // ========================================
            // BENEFICIARY ADDITIONAL FIELDS
            // ========================================
            
            // Other Names Used
            $table->json('beneficiary_other_names')->nullable()->after('beneficiary_last_name');
            
            // Additional IDs
            $table->string('beneficiary_ssn', 11)->nullable()->after('beneficiary_alien_number');
            $table->string('beneficiary_uscis_account', 20)->nullable()->after('beneficiary_ssn');
            $table->string('beneficiary_petition_filed_before', 20)->nullable()->after('beneficiary_uscis_account');
            
            // Passport Details
            $table->text('beneficiary_passport_country')->nullable()->after('beneficiary_passport_number');
            $table->date('beneficiary_passport_expiration')->nullable()->after('beneficiary_passport_country');
            
            // Contact Information
            $table->string('beneficiary_daytime_phone', 50)->nullable()->after('beneficiary_phone');
            $table->string('beneficiary_mobile_phone', 50)->nullable()->after('beneficiary_daytime_phone');
            
            // Intended U.S. Address
            $table->boolean('beneficiary_intended_address_same')->default(false)->after('beneficiary_mailing_zip');
            $table->text('beneficiary_intended_address')->nullable()->after('beneficiary_intended_address_same');
            $table->string('beneficiary_intended_apt', 10)->nullable()->after('beneficiary_intended_address');
            $table->string('beneficiary_intended_city', 50)->nullable()->after('beneficiary_intended_apt');
            $table->string('beneficiary_intended_state', 2)->nullable()->after('beneficiary_intended_city');
            $table->string('beneficiary_intended_zip', 10)->nullable()->after('beneficiary_intended_state');
            
            // Entry Information
            $table->string('beneficiary_ever_in_us', 10)->nullable()->after('beneficiary_intended_zip');
            $table->string('beneficiary_class_of_admission', 20)->nullable()->after('beneficiary_ever_in_us');
            $table->string('beneficiary_i94_number', 20)->nullable()->after('beneficiary_class_of_admission');
            $table->date('beneficiary_date_of_arrival')->nullable()->after('beneficiary_i94_number');
            $table->string('beneficiary_date_authorized_stay_expires', 20)->nullable()->after('beneficiary_date_of_arrival');
            
            // Immigration Proceedings
            $table->string('beneficiary_immigration_proceedings', 10)->nullable()->after('beneficiary_date_authorized_stay_expires');
            $table->json('beneficiary_proceedings_types')->nullable()->after('beneficiary_immigration_proceedings');
            $table->text('beneficiary_proceedings_city')->nullable()->after('beneficiary_proceedings_types');
            $table->string('beneficiary_proceedings_state', 2)->nullable()->after('beneficiary_proceedings_city');
            $table->date('beneficiary_proceedings_date')->nullable()->after('beneficiary_proceedings_state');
            
            // Current Employment Details
            $table->text('beneficiary_current_employer')->nullable()->after('beneficiary_employer_name');
            $table->text('beneficiary_current_occupation')->nullable()->after('beneficiary_current_employer');
            $table->text('beneficiary_employer_address_full')->nullable()->after('beneficiary_current_occupation');
            $table->string('beneficiary_employer_apt', 10)->nullable()->after('beneficiary_employer_address_full');
            $table->string('beneficiary_employer_city', 50)->nullable()->after('beneficiary_employer_apt');
            $table->string('beneficiary_employer_province', 50)->nullable()->after('beneficiary_employer_city');
            $table->string('beneficiary_employer_postal', 20)->nullable()->after('beneficiary_employer_province');
            $table->text('beneficiary_employer_country')->nullable()->after('beneficiary_employer_postal');
            $table->date('beneficiary_employment_start_date')->nullable()->after('beneficiary_employer_country');
            
            // Parent Birth/Residence Cities
            $table->text('beneficiary_parent1_city_birth')->nullable()->after('beneficiary_parent1_dob');
            $table->text('beneficiary_parent1_city_residence')->nullable()->after('beneficiary_parent1_country');
            $table->text('beneficiary_parent1_country_residence')->nullable()->after('beneficiary_parent1_city_residence');
            $table->text('beneficiary_parent2_city_birth')->nullable()->after('beneficiary_parent2_dob');
            $table->text('beneficiary_parent2_city_residence')->nullable()->after('beneficiary_parent2_country');
            $table->text('beneficiary_parent2_country_residence')->nullable()->after('beneficiary_parent2_city_residence');
            
            // ========================================
            // RELATIONSHIP ADDITIONAL FIELDS
            // ========================================
            
            // Last Address Lived Together
            $table->boolean('never_lived_together')->default(false)->after('beneficiary_divorce_date');
            $table->text('last_lived_together_address')->nullable()->after('never_lived_together');
            $table->string('last_lived_together_apt', 10)->nullable()->after('last_lived_together_address');
            $table->string('last_lived_together_city', 50)->nullable()->after('last_lived_together_apt');
            $table->string('last_lived_together_state', 2)->nullable()->after('last_lived_together_city');
            $table->string('last_lived_together_province', 50)->nullable()->after('last_lived_together_state');
            $table->string('last_lived_together_postal', 20)->nullable()->after('last_lived_together_province');
            $table->text('last_lived_together_country')->nullable()->after('last_lived_together_postal');
            $table->date('last_lived_together_date_from')->nullable()->after('last_lived_together_country');
            $table->date('last_lived_together_date_to')->nullable()->after('last_lived_together_date_from');
            
            // Application Location
            $table->string('beneficiary_application_location', 20)->nullable()->after('last_lived_together_date_to');
            $table->text('beneficiary_uscis_office_city')->nullable()->after('beneficiary_application_location');
            $table->string('beneficiary_uscis_office_state', 2)->nullable()->after('beneficiary_uscis_office_city');
            $table->text('beneficiary_consulate_city')->nullable()->after('beneficiary_uscis_office_state');
            $table->text('beneficiary_consulate_province')->nullable()->after('beneficiary_consulate_city');
            $table->text('beneficiary_consulate_country')->nullable()->after('beneficiary_consulate_province');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            // Sponsor fields
            $table->dropColumn([
                'sponsor_other_names',
                'sponsor_a_number',
                'sponsor_uscis_account',
                'sponsor_citizenship_method',
                'sponsor_certificate_number',
                'sponsor_certificate_place',
                'sponsor_certificate_date',
                'sponsor_ethnicity',
                'sponsor_race',
                'sponsor_height_feet',
                'sponsor_height_inches',
                'sponsor_weight',
                'sponsor_eye_color',
                'sponsor_hair_color',
                'sponsor_parent1_city_residence',
                'sponsor_parent1_country_residence',
                'sponsor_parent2_city_residence',
                'sponsor_parent2_country_residence',
            ]);
            
            // Beneficiary fields
            $table->dropColumn([
                'beneficiary_other_names',
                'beneficiary_ssn',
                'beneficiary_uscis_account',
                'beneficiary_petition_filed_before',
                'beneficiary_passport_country',
                'beneficiary_passport_expiration',
                'beneficiary_daytime_phone',
                'beneficiary_mobile_phone',
                'beneficiary_intended_address_same',
                'beneficiary_intended_address',
                'beneficiary_intended_apt',
                'beneficiary_intended_city',
                'beneficiary_intended_state',
                'beneficiary_intended_zip',
                'beneficiary_ever_in_us',
                'beneficiary_class_of_admission',
                'beneficiary_i94_number',
                'beneficiary_date_of_arrival',
                'beneficiary_date_authorized_stay_expires',
                'beneficiary_immigration_proceedings',
                'beneficiary_proceedings_types',
                'beneficiary_proceedings_city',
                'beneficiary_proceedings_state',
                'beneficiary_proceedings_date',
                'beneficiary_current_employer',
                'beneficiary_current_occupation',
                'beneficiary_employer_address_full',
                'beneficiary_employer_apt',
                'beneficiary_employer_city',
                'beneficiary_employer_province',
                'beneficiary_employer_postal',
                'beneficiary_employer_country',
                'beneficiary_employment_start_date',
                'beneficiary_parent1_city_birth',
                'beneficiary_parent1_city_residence',
                'beneficiary_parent1_country_residence',
                'beneficiary_parent2_city_birth',
                'beneficiary_parent2_city_residence',
                'beneficiary_parent2_country_residence',
            ]);
            
            // Relationship fields
            $table->dropColumn([
                'never_lived_together',
                'last_lived_together_address',
                'last_lived_together_apt',
                'last_lived_together_city',
                'last_lived_together_state',
                'last_lived_together_province',
                'last_lived_together_postal',
                'last_lived_together_country',
                'last_lived_together_date_from',
                'last_lived_together_date_to',
                'beneficiary_application_location',
                'beneficiary_uscis_office_city',
                'beneficiary_uscis_office_state',
                'beneficiary_consulate_city',
                'beneficiary_consulate_province',
                'beneficiary_consulate_country',
            ]);
        });
    }
};