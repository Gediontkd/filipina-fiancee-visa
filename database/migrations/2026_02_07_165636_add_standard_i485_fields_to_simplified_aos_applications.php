<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStandardI485FieldsToSimplifiedAosApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $col) {
            // Part 1: Additional Applicant Information
            $col->string('status_at_last_entry')->nullable()->after('entry_location');
            $col->date('i94_expiration_date')->nullable()->after('status_at_last_entry');
            $col->boolean('use_mailing_address')->default(0)->after('applicant_zip');
            $col->string('mailing_street')->nullable()->after('use_mailing_address');
            $col->string('mailing_city')->nullable()->after('mailing_street');
            $col->string('mailing_state')->nullable()->after('mailing_city');
            $col->string('mailing_zip')->nullable()->after('mailing_state');

            // Part 2: Application Type or Filing Category
            $col->string('filing_category')->nullable()->after('submitted_app_id');
            $col->string('receipt_number_underlying_petition')->nullable()->after('filing_category');
            $col->date('priority_date')->nullable()->after('receipt_number_underlying_petition');
            $col->boolean('is_principal_applicant')->default(1)->after('priority_date');
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
                'status_at_last_entry',
                'i94_expiration_date',
                'use_mailing_address',
                'mailing_street',
                'mailing_city',
                'mailing_state',
                'mailing_zip',
                'filing_category',
                'receipt_number_underlying_petition',
                'priority_date',
                'is_principal_applicant'
            ]);
        });
    }
}
