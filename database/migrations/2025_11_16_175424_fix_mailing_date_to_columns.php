<?php
// FILE: database/migrations/2025_11_16_000001_fix_mailing_date_to_columns.php
// FIXED: Using raw SQL instead of Doctrine DBAL

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // Migration no longer needed as create migration now uses TEXT
    }

    public function down()
    {
        // Revert back to DATE columns
        // WARNING: This will fail if any rows contain "Present" string
        DB::statement('ALTER TABLE simplified_spouse_visa_applications 
            MODIFY COLUMN sponsor_mailing_date_to DATE NULL');
        
        DB::statement('ALTER TABLE simplified_spouse_visa_applications 
            MODIFY COLUMN beneficiary_mailing_date_to DATE NULL');
    }
};