<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailedAddressFieldsToSimplifiedAosApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('simplified_aos_applications', 'applicant_unit_type')) {
                $table->string('applicant_unit_type')->nullable()->after('applicant_zip');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'applicant_unit_number')) {
                $table->string('applicant_unit_number')->nullable()->after('applicant_unit_type');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'applicant_in_care_of')) {
                $table->string('applicant_in_care_of')->nullable()->after('applicant_unit_number');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'current_address_from_date')) {
                $table->date('current_address_from_date')->nullable()->after('applicant_in_care_of');
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
                'applicant_unit_type',
                'applicant_unit_number',
                'applicant_in_care_of',
                'current_address_from_date'
            ]);
        });
    }
}
