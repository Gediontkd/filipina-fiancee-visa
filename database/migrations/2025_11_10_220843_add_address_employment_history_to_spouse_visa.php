<?php
// database/migrations/2024_XX_XX_add_address_employment_history_to_spouse_visa.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            // Mailing address with dates
            $table->string('sponsor_mailing_address', 100)->nullable()->after('sponsor_zip');
            $table->string('sponsor_mailing_apt', 20)->nullable()->after('sponsor_mailing_address');
            $table->string('sponsor_mailing_city', 50)->nullable()->after('sponsor_mailing_apt');
            $table->string('sponsor_mailing_state', 2)->nullable()->after('sponsor_mailing_city');
            $table->string('sponsor_mailing_zip', 10)->nullable()->after('sponsor_mailing_state');
            $table->date('sponsor_mailing_date_from')->nullable()->after('sponsor_mailing_zip');
            $table->date('sponsor_mailing_date_to')->nullable()->after('sponsor_mailing_date_from');
            $table->boolean('sponsor_same_address')->default(true)->after('sponsor_mailing_date_to');
            
            // Address history (JSON for multiple addresses)
            $table->json('sponsor_address_history')->nullable()->after('sponsor_same_address');
            $table->json('beneficiary_address_history')->nullable()->after('beneficiary_country');
            
            // Employment history (JSON for multiple jobs)
            $table->json('sponsor_employment_history')->nullable()->after('sponsor_annual_income');
            $table->json('beneficiary_employment_history')->nullable()->after('beneficiary_occupation');
        });
    }

    public function down()
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            $table->dropColumn([
                'sponsor_mailing_address',
                'sponsor_mailing_apt',
                'sponsor_mailing_city',
                'sponsor_mailing_state',
                'sponsor_mailing_zip',
                'sponsor_mailing_date_from',
                'sponsor_mailing_date_to',
                'sponsor_same_address',
                'sponsor_address_history',
                'beneficiary_address_history',
                'sponsor_employment_history',
                'beneficiary_employment_history'
            ]);
        });
    }
};