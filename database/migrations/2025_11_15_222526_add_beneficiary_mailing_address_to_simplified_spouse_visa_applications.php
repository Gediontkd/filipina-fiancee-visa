<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            // Add beneficiary mailing address columns
            $table->string('beneficiary_mailing_address', 100)->nullable()->after('beneficiary_alien_number');
            $table->string('beneficiary_mailing_apt', 10)->nullable()->after('beneficiary_mailing_address');
            $table->string('beneficiary_mailing_city', 50)->nullable()->after('beneficiary_mailing_apt');
            $table->string('beneficiary_mailing_state', 50)->nullable()->after('beneficiary_mailing_city');
            $table->string('beneficiary_mailing_country', 100)->nullable()->after('beneficiary_mailing_state');
            $table->string('beneficiary_mailing_zip', 20)->nullable()->after('beneficiary_mailing_country');
            $table->string('beneficiary_mailing_date_from', 20)->nullable()->after('beneficiary_mailing_zip');
            $table->string('beneficiary_mailing_date_to', 20)->nullable()->after('beneficiary_mailing_date_from');
            $table->boolean('beneficiary_same_address')->default(true)->after('beneficiary_mailing_date_to');
        });
    }

    public function down()
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            $table->dropColumn([
                'beneficiary_mailing_address',
                'beneficiary_mailing_apt',
                'beneficiary_mailing_city',
                'beneficiary_mailing_state',
                'beneficiary_mailing_country',
                'beneficiary_mailing_zip',
                'beneficiary_mailing_date_from',
                'beneficiary_mailing_date_to',
                'beneficiary_same_address'
            ]);
        });
    }
};