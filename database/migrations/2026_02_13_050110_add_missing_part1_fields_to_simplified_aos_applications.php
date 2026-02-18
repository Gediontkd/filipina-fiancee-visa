<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingPart1FieldsToSimplifiedAosApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('simplified_aos_applications', 'applicant_birth_country')) {
                $table->string('applicant_birth_country', 100)->nullable()->after('applicant_place_of_birth');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'has_other_dob')) {
                $table->boolean('has_other_dob')->nullable()->default(0)->after('applicant_dob');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'other_dobs')) {
                $table->text('other_dobs')->nullable()->after('has_other_dob');
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
            $table->dropColumn(['applicant_birth_country', 'has_other_dob', 'other_dobs']);
        });
    }
}
