<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExtraAddressFieldsToSimplifiedAos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('simplified_aos_applications', 'applicant_in_care_of')) {
                $table->string('applicant_in_care_of')->nullable()->after('applicant_zip');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'applicant_apt_ste_flr')) {
                $table->string('applicant_apt_ste_flr')->nullable()->after('applicant_in_care_of');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'applicant_date_resided_from')) {
                $table->date('applicant_date_resided_from')->nullable()->after('applicant_apt_ste_flr');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'mailing_in_care_of')) {
                $table->string('mailing_in_care_of')->nullable()->after('mailing_zip');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'mailing_apt_ste_flr')) {
                $table->string('mailing_apt_ste_flr')->nullable()->after('mailing_in_care_of');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'foreign_address_data')) {
                $table->text('foreign_address_data')->nullable()->after('most_recent_foreign_address');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'prior_addresses_data')) {
                $table->text('prior_addresses_data')->nullable()->after('applicant_address_history');
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
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            $table->dropColumn([
                'applicant_in_care_of',
                'applicant_apt_ste_flr',
                'applicant_date_resided_from',
                'mailing_in_care_of',
                'mailing_apt_ste_flr',
                'foreign_address_data',
                'prior_addresses_data'
            ]);
        });
    }
}
