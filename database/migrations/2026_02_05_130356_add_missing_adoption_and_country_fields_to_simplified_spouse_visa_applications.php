<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingAdoptionAndCountryFieldsToSimplifiedSpouseVisaApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
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
            
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'sponsor_mailing_country')) {
                $table->string('sponsor_mailing_country', 100)
                    ->nullable()
                    ->after('sponsor_mailing_zip')
                    ->default('US')
                    ->comment('Sponsor mailing address country');
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
            $table->dropColumn([
                'sponsor_beneficiary_related_by_adoption',
                'sponsor_gained_status_through_adoption',
                'sponsor_mailing_country',
            ]);
        });
    }
}
