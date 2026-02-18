<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSsaAndExtraAddressFieldsToSimplifiedAosApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('simplified_aos_applications', 'resided_at_current_address_5_years')) {
                $table->boolean('resided_at_current_address_5_years')->nullable()->after('applicant_zip');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'most_recent_foreign_address')) {
                $table->json('most_recent_foreign_address')->nullable()->after('resided_at_current_address_5_years');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'ssa_ever_issued_card')) {
                $table->boolean('ssa_ever_issued_card')->nullable()->after('applicant_ssn');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'ssa_issue_card_request')) {
                $table->boolean('ssa_issue_card_request')->nullable()->after('ssa_ever_issued_card');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'ssa_consent_disclosure')) {
                $table->boolean('ssa_consent_disclosure')->nullable()->after('ssa_issue_card_request');
            }
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
                'resided_at_current_address_5_years',
                'most_recent_foreign_address',
                'ssa_ever_issued_card',
                'ssa_issue_card_request',
                'ssa_consent_disclosure'
            ]);
        });
    }
}
