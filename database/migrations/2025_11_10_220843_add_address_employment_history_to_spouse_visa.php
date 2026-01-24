<?php
// database/migrations/2024_XX_XX_add_address_employment_history_to_spouse_visa.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Migration no longer needed as create migration now includes all fields
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