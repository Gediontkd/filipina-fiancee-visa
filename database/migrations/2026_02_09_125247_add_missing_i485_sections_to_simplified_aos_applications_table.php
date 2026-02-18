<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingI485SectionsToSimplifiedAosApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('simplified_aos_applications', 'applicant_address_history')) {
                $table->text('applicant_address_history')->nullable()->after('applicant_zip');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'parent1_data')) {
                $table->text('parent1_data')->nullable()->after('hair_color');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'parent2_data')) {
                $table->text('parent2_data')->nullable()->after('parent1_data');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'times_married')) {
                $table->integer('times_married')->nullable()->default(0)->after('spouse_name');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'marital_history')) {
                $table->text('marital_history')->nullable()->after('times_married');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'has_children')) {
                $table->boolean('has_children')->nullable()->default(0)->after('marital_history');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'children_data')) {
                $table->text('children_data')->nullable()->after('has_children');
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
                'applicant_address_history',
                'parent1_data',
                'parent2_data',
                'times_married',
                'marital_history',
                'has_children',
                'children_data'
            ]);
        });
    }
}
