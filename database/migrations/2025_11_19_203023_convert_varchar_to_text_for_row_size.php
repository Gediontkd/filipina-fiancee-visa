<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Convert large VARCHAR columns to TEXT to free up row size
     * This must run BEFORE dropping duplicate columns
     */
    public function up(): void
    {
        // Convert existing VARCHAR columns to TEXT to reduce row size
        DB::statement('ALTER TABLE simplified_spouse_visa_applications 
            MODIFY COLUMN sponsor_address TEXT NULL,
            MODIFY COLUMN sponsor_city TEXT NULL,
            MODIFY COLUMN sponsor_mailing_address TEXT NULL,
            MODIFY COLUMN sponsor_mailing_city TEXT NULL,
            MODIFY COLUMN sponsor_parent1_first_name TEXT NULL,
            MODIFY COLUMN sponsor_parent1_last_name TEXT NULL,
            MODIFY COLUMN sponsor_parent1_country TEXT NULL,
            MODIFY COLUMN sponsor_parent2_first_name TEXT NULL,
            MODIFY COLUMN sponsor_parent2_last_name TEXT NULL,
            MODIFY COLUMN sponsor_parent2_country TEXT NULL,
            MODIFY COLUMN beneficiary_address TEXT NULL,
            MODIFY COLUMN beneficiary_city TEXT NULL,
            MODIFY COLUMN beneficiary_mailing_address TEXT NULL,
            MODIFY COLUMN beneficiary_mailing_city TEXT NULL,
            MODIFY COLUMN beneficiary_parent1_first_name TEXT NULL,
            MODIFY COLUMN beneficiary_parent1_last_name TEXT NULL,
            MODIFY COLUMN beneficiary_parent1_country TEXT NULL,
            MODIFY COLUMN beneficiary_parent2_first_name TEXT NULL,
            MODIFY COLUMN beneficiary_parent2_last_name TEXT NULL,
            MODIFY COLUMN beneficiary_parent2_country TEXT NULL,
            MODIFY COLUMN beneficiary_employer_name TEXT NULL,
            MODIFY COLUMN beneficiary_employer_address TEXT NULL,
            MODIFY COLUMN marriage_city TEXT NULL,
            MODIFY COLUMN marriage_country TEXT NULL
        ');
    }

    /**
     * Reverse the migrations (convert back to VARCHAR)
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE simplified_spouse_visa_applications 
            MODIFY COLUMN sponsor_address VARCHAR(100) NULL,
            MODIFY COLUMN sponsor_city VARCHAR(50) NULL,
            MODIFY COLUMN sponsor_mailing_address VARCHAR(100) NULL,
            MODIFY COLUMN sponsor_mailing_city VARCHAR(50) NULL,
            MODIFY COLUMN sponsor_parent1_first_name VARCHAR(50) NULL,
            MODIFY COLUMN sponsor_parent1_last_name VARCHAR(50) NULL,
            MODIFY COLUMN sponsor_parent1_country VARCHAR(100) NULL,
            MODIFY COLUMN sponsor_parent2_first_name VARCHAR(50) NULL,
            MODIFY COLUMN sponsor_parent2_last_name VARCHAR(50) NULL,
            MODIFY COLUMN sponsor_parent2_country VARCHAR(100) NULL,
            MODIFY COLUMN beneficiary_address VARCHAR(100) NULL,
            MODIFY COLUMN beneficiary_city VARCHAR(50) NULL,
            MODIFY COLUMN beneficiary_mailing_address VARCHAR(100) NULL,
            MODIFY COLUMN beneficiary_mailing_city VARCHAR(50) NULL,
            MODIFY COLUMN beneficiary_parent1_first_name VARCHAR(50) NULL,
            MODIFY COLUMN beneficiary_parent1_last_name VARCHAR(50) NULL,
            MODIFY COLUMN beneficiary_parent1_country VARCHAR(100) NULL,
            MODIFY COLUMN beneficiary_parent2_first_name VARCHAR(50) NULL,
            MODIFY COLUMN beneficiary_parent2_last_name VARCHAR(50) NULL,
            MODIFY COLUMN beneficiary_parent2_country VARCHAR(100) NULL,
            MODIFY COLUMN beneficiary_employer_name VARCHAR(100) NULL,
            MODIFY COLUMN beneficiary_employer_address VARCHAR(100) NULL,
            MODIFY COLUMN marriage_city VARCHAR(100) NULL,
            MODIFY COLUMN marriage_country VARCHAR(100) NULL
        ');
    }
};