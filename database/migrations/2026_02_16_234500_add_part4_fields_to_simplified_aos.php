<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPart4FieldsToSimplifiedAos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            // Part 4: Additional Information About You
            if (!Schema::hasColumn('simplified_aos_applications', 'applied_for_immigrant_visa_abroad')) {
                $table->boolean('applied_for_immigrant_visa_abroad')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'immigrant_visa_location_city')) {
                $table->string('immigrant_visa_location_city')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'immigrant_visa_location_country')) {
                $table->string('immigrant_visa_location_country')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'immigrant_visa_decision')) {
                $table->string('immigrant_visa_decision')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'immigrant_visa_decision_date')) {
                $table->date('immigrant_visa_decision_date')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'applied_for_permanent_residence_us')) {
                $table->boolean('applied_for_permanent_residence_us')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'rescinded_lpr_status')) {
                $table->boolean('rescinded_lpr_status')->nullable();
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
                'applied_for_immigrant_visa_abroad',
                'immigrant_visa_location_city',
                'immigrant_visa_location_country',
                'immigrant_visa_decision',
                'immigrant_visa_decision_date',
                'applied_for_permanent_residence_us',
                'rescinded_lpr_status',
            ]);
        });
    }
}
