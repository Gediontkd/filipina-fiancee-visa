<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdoptionAndCountryFieldsToSpouseVisa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Migration no longer needed as create migration now includes all fields
    }

    public function old_up()
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            // ========================================
            // ADD NEW FIELDS (only if they don't exist)
            // ========================================
            
            // Sponsor Adoption Questions
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'sponsor_beneficiary_related_by_adoption')) {
                $table->string('sponsor_beneficiary_related_by_adoption', 10)
                    ->nullable()
                    ->after('sponsor_last_name')
                    ->comment('yes/no/n/a - If beneficiary is sibling, are they related by adoption?');
            }
            
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'sponsor_gained_status_through_adoption')) {
                $table->string('sponsor_gained_status_through_adoption', 10)
                    ->nullable()
                    ->after('sponsor_beneficiary_related_by_adoption')
                    ->comment('yes/no - Did sponsor gain status through adoption?');
            }
            
            // Sponsor Address Country Fields
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'sponsor_mailing_country')) {
                $table->string('sponsor_mailing_country', 100)
                    ->nullable()
                    ->after('sponsor_mailing_zip')
                    ->default('US')
                    ->comment('Sponsor mailing address country');
            }
            
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'sponsor_country')) {
                $table->string('sponsor_country', 100)
                    ->nullable()
                    ->after('sponsor_zip')
                    ->default('US')
                    ->comment('Sponsor physical address country');
            }
            
            // Beneficiary Parent Relationship Fields
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parent1_relationship')) {
                $table->string('beneficiary_parent1_relationship', 50)
                    ->nullable()
                    ->after('beneficiary_parent1_last_name')
                    ->comment('Relationship to beneficiary (e.g., Mother, Father)');
            }
            
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parent2_relationship')) {
                $table->string('beneficiary_parent2_relationship', 50)
                    ->nullable()
                    ->after('beneficiary_parent2_last_name')
                    ->comment('Relationship to beneficiary (e.g., Mother, Father)');
            }
        });
        
        // ========================================
        // REMOVE OLD FIELDS (if they exist)
        // ========================================
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            $columnsToRemove = [
                'beneficiary_parent1_sex',
                'beneficiary_parent1_city_birth',
                'beneficiary_parent1_city_residence',
                'beneficiary_parent1_country_residence',
                'beneficiary_parent2_sex',
                'beneficiary_parent2_city_birth',
                'beneficiary_parent2_city_residence',
                'beneficiary_parent2_country_residence',
            ];
            
            foreach ($columnsToRemove as $column) {
                if (Schema::hasColumn('simplified_spouse_visa_applications', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            // Remove new fields if they exist
            $columnsToRemove = [
                'sponsor_beneficiary_related_by_adoption',
                'sponsor_gained_status_through_adoption',
                'sponsor_mailing_country',
                'sponsor_country',
                'beneficiary_parent1_relationship',
                'beneficiary_parent2_relationship',
            ];
            
            foreach ($columnsToRemove as $column) {
                if (Schema::hasColumn('simplified_spouse_visa_applications', $column)) {
                    $table->dropColumn($column);
                }
            }
            
            // Restore old fields
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parent1_sex')) {
                $table->string('beneficiary_parent1_sex', 10)->nullable();
            }
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parent1_city_birth')) {
                $table->string('beneficiary_parent1_city_birth', 100)->nullable();
            }
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parent1_city_residence')) {
                $table->string('beneficiary_parent1_city_residence', 100)->nullable();
            }
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parent1_country_residence')) {
                $table->string('beneficiary_parent1_country_residence', 100)->nullable();
            }
            
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parent2_sex')) {
                $table->string('beneficiary_parent2_sex', 10)->nullable();
            }
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parent2_city_birth')) {
                $table->string('beneficiary_parent2_city_birth', 100)->nullable();
            }
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parent2_city_residence')) {
                $table->string('beneficiary_parent2_city_residence', 100)->nullable();
            }
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parent2_country_residence')) {
                $table->string('beneficiary_parent2_country_residence', 100)->nullable();
            }
        });
    }
}