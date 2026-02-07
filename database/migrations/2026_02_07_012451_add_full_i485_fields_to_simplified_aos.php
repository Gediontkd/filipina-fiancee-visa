<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFullI485FieldsToSimplifiedAos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            // Part 1 & 7: Biographic Information
            $table->string('uscis_account_number')->nullable()->after('applicant_ssn');
            $table->string('applicant_gender')->nullable()->after('uscis_account_number');
            $table->string('ethnicity')->nullable()->after('applicant_gender');
            $table->string('race')->nullable()->after('ethnicity');
            $table->integer('height_feet')->nullable()->after('race');
            $table->integer('height_inches')->nullable()->after('height_feet');
            $table->integer('weight_pounds')->nullable()->after('height_inches');
            $table->string('eye_color')->nullable()->after('weight_pounds');
            $table->string('hair_color')->nullable()->after('eye_color');
            $table->json('applicant_other_names')->nullable()->after('hair_color');

            // Part 3: Address & Employment History
            $table->json('applicant_address_history')->nullable()->after('applicant_zip');
            $table->json('applicant_employment_history')->nullable()->after('applicant_occupation');

            // Part 4: Parents Information
            $table->json('parent1_data')->nullable()->after('applicant_employment_history');
            $table->json('parent2_data')->nullable()->after('parent1_data');

            // Part 5 & 6: Marital & Children
            $table->integer('times_married')->nullable()->after('marital_status');
            $table->json('marital_history')->nullable()->after('times_married');
            $table->boolean('has_children')->default(false)->after('spouse_name');
            $table->json('children_data')->nullable()->after('has_children');

            // Part 8, 9, 10, 11, 12: Complex sections
            $table->json('eligibility_questions')->nullable()->after('background_explanation');
            $table->json('accommodation_details')->nullable()->after('eligibility_questions');
            $table->json('applicant_statement_data')->nullable()->after('accommodation_details');
            $table->json('interpreter_data')->nullable()->after('applicant_statement_data');
            $table->json('preparer_data')->nullable()->after('interpreter_data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            $table->dropColumn([
                'uscis_account_number', 'applicant_gender', 'ethnicity', 'race', 
                'height_feet', 'height_inches', 'weight_pounds', 'eye_color', 
                'hair_color', 'applicant_other_names', 'applicant_address_history',
                'applicant_employment_history', 'parent1_data', 'parent2_data',
                'times_married', 'marital_history', 'has_children', 'children_data',
                'eligibility_questions', 'accommodation_details', 'applicant_statement_data',
                'interpreter_data', 'preparer_data'
            ]);
        });
    }
}
