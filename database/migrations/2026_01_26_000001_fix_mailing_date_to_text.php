<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // FIX: Ensure columns are TEXT to support "Present" value
        // Note: Using raw SQL because doctrine/dbal might not be installed
        DB::statement('ALTER TABLE simplified_spouse_visa_applications 
            MODIFY COLUMN sponsor_mailing_date_to TEXT NULL');
        
        DB::statement('ALTER TABLE simplified_spouse_visa_applications 
            MODIFY COLUMN beneficiary_mailing_date_to TEXT NULL');
    }

    public function down()
    {
        // No down needed as we don't want to revert to DATE which causes data loss
    }
};
