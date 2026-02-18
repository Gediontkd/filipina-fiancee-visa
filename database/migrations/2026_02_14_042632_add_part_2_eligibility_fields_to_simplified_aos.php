<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPart2EligibilityFieldsToSimplifiedAos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('simplified_aos_applications', 'employment_categories_data')) {
                $table->json('employment_categories_data')->nullable()->after('immigrant_category');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'special_immigrant_categories_data')) {
                $table->json('special_immigrant_categories_data')->nullable()->after('employment_categories_data');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'asylee_refugee_data')) {
                $table->json('asylee_refugee_data')->nullable()->after('special_immigrant_categories_data');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'trafficking_crime_victim_data')) {
                $table->json('trafficking_crime_victim_data')->nullable()->after('asylee_refugee_data');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'special_program_categories_data')) {
                $table->json('special_program_categories_data')->nullable()->after('trafficking_crime_victim_data');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'additional_options_data')) {
                $table->json('additional_options_data')->nullable()->after('special_program_categories_data');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'applying_under_245i')) {
                $table->boolean('applying_under_245i')->nullable()->after('additional_options_data');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'applying_under_cspa')) {
                $table->boolean('applying_under_cspa')->nullable()->after('applying_under_245i');
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
                'employment_categories_data',
                'special_immigrant_categories_data',
                'asylee_refugee_data',
                'trafficking_crime_victim_data',
                'special_program_categories_data',
                'additional_options_data',
                'applying_under_245i',
                'applying_under_cspa',
            ]);
        });
    }
}
