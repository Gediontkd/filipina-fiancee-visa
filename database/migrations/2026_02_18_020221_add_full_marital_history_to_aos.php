<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFullMaritalHistoryToAos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('simplified_aos_applications', 'spouse_is_military')) {
                $table->boolean('spouse_is_military')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'spouse_a_number')) {
                $table->string('spouse_a_number')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'spouse_dob')) {
                $table->date('spouse_dob')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'spouse_birth_country')) {
                $table->string('spouse_birth_country')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'spouse_address_data')) {
                $table->text('spouse_address_data')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'spouse_marriage_place_data')) {
                $table->text('spouse_marriage_place_data')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'spouse_applying_with_you')) {
                $table->boolean('spouse_applying_with_you')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'prior_marriages_full_data')) {
                $table->text('prior_marriages_full_data')->nullable();
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
                'spouse_is_military',
                'spouse_a_number',
                'spouse_dob',
                'spouse_birth_country',
                'spouse_address_data',
                'spouse_marriage_place_data',
                'spouse_applying_with_you',
                'prior_marriages_full_data',
            ]);
        });
    }
}
