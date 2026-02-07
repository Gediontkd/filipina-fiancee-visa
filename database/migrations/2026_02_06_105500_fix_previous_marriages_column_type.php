<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Use raw SQL to avoid dependency on doctrine/dbal for column changes
        DB::statement("ALTER TABLE simplified_spouse_visa_applications MODIFY sponsor_previous_marriages VARCHAR(10) NULL");
        DB::statement("ALTER TABLE simplified_spouse_visa_applications MODIFY beneficiary_previous_marriages VARCHAR(10) NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE simplified_spouse_visa_applications MODIFY sponsor_previous_marriages JSON NULL");
        DB::statement("ALTER TABLE simplified_spouse_visa_applications MODIFY beneficiary_previous_marriages JSON NULL");
    }
};
