<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeBiographyFieldsToDecimalInSimplifiedSpouseVisaApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Use raw SQL to avoid doctrine/dbal requirement in Laravel 8
        \DB::statement('ALTER TABLE simplified_spouse_visa_applications MODIFY sponsor_height_feet DECIMAL(8,2) NULL');
        \DB::statement('ALTER TABLE simplified_spouse_visa_applications MODIFY sponsor_height_inches DECIMAL(8,2) NULL');
        \DB::statement('ALTER TABLE simplified_spouse_visa_applications MODIFY sponsor_weight DECIMAL(8,2) NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::statement('ALTER TABLE simplified_spouse_visa_applications MODIFY sponsor_height_feet TINYINT NULL');
        \DB::statement('ALTER TABLE simplified_spouse_visa_applications MODIFY sponsor_height_inches TINYINT NULL');
        \DB::statement('ALTER TABLE simplified_spouse_visa_applications MODIFY sponsor_weight SMALLINT NULL');
    }
}
