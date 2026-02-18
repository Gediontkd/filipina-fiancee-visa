<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddANumberFieldsToSimplifiedAosApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            // Question 4: Do you have an Alien Registration Number (A-Number)?
            $table->boolean('has_a_number')->nullable()->after('applicant_place_of_birth');
            $table->string('a_number', 20)->nullable()->after('has_a_number');
            
            // Question 5: Have you ever used, or been assigned, any other A-Number?
            $table->boolean('has_other_a_numbers')->nullable()->after('a_number');
            $table->json('other_a_numbers')->nullable()->after('has_other_a_numbers');
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
            $table->dropColumn(['has_a_number', 'a_number', 'has_other_a_numbers', 'other_a_numbers']);
        });
    }
}
