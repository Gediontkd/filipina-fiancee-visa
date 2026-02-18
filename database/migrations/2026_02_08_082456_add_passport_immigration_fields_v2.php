<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPassportImmigrationFieldsV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            // Passport/Travel Document Information
            if (!Schema::hasColumn('simplified_aos_applications', 'passport_number')) {
                $table->string('passport_number', 50)->nullable()->after('other_a_numbers');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'passport_expiration_date')) {
                $table->date('passport_expiration_date')->nullable()->after('passport_number');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'passport_issuing_country')) {
                $table->string('passport_issuing_country', 100)->nullable()->after('passport_expiration_date');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'nonimmigrant_visa_number')) {
                $table->string('nonimmigrant_visa_number', 50)->nullable()->after('passport_issuing_country');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'nonimmigrant_visa_issue_date')) {
                $table->date('nonimmigrant_visa_issue_date')->nullable()->after('nonimmigrant_visa_number');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'last_arrival_city')) {
                $table->string('last_arrival_city', 100)->nullable()->after('nonimmigrant_visa_issue_date');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'last_arrival_state')) {
                $table->string('last_arrival_state', 50)->nullable()->after('last_arrival_city');
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'last_arrival_date')) {
                $table->date('last_arrival_date')->nullable()->after('last_arrival_state');
            }
            
            // Recent Immigration History
            if (!Schema::hasColumn('simplified_aos_applications', 'immigration_entry_type')) {
                $table->string('immigration_entry_type', 50)->nullable()->after('last_arrival_date'); // 'admitted', 'paroled', 'no_admission'
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'immigration_entry_status')) {
                $table->string('immigration_entry_status', 200)->nullable()->after('immigration_entry_type'); // Description for admitted/paroled
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
            $columnsToDrop = [];
            
            if (Schema::hasColumn('simplified_aos_applications', 'passport_number')) $columnsToDrop[] = 'passport_number';
            if (Schema::hasColumn('simplified_aos_applications', 'passport_expiration_date')) $columnsToDrop[] = 'passport_expiration_date';
            if (Schema::hasColumn('simplified_aos_applications', 'passport_issuing_country')) $columnsToDrop[] = 'passport_issuing_country';
            if (Schema::hasColumn('simplified_aos_applications', 'nonimmigrant_visa_number')) $columnsToDrop[] = 'nonimmigrant_visa_number';
            if (Schema::hasColumn('simplified_aos_applications', 'nonimmigrant_visa_issue_date')) $columnsToDrop[] = 'nonimmigrant_visa_issue_date';
            if (Schema::hasColumn('simplified_aos_applications', 'last_arrival_city')) $columnsToDrop[] = 'last_arrival_city';
            if (Schema::hasColumn('simplified_aos_applications', 'last_arrival_state')) $columnsToDrop[] = 'last_arrival_state';
            if (Schema::hasColumn('simplified_aos_applications', 'last_arrival_date')) $columnsToDrop[] = 'last_arrival_date';
            if (Schema::hasColumn('simplified_aos_applications', 'immigration_entry_type')) $columnsToDrop[] = 'immigration_entry_type';
            if (Schema::hasColumn('simplified_aos_applications', 'immigration_entry_status')) $columnsToDrop[] = 'immigration_entry_status';

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
}
