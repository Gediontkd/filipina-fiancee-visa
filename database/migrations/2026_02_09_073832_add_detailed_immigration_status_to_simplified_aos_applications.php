<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailedImmigrationStatusToSimplifiedAosApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            // New Immigration Status Fields
            
            // "Was your last arrival the first time you were physically present in the United States?"
            $table->boolean('was_last_arrival_first_time')->nullable()->after('status_at_last_entry');
            
            // "What is your current immigration status (if it has changed since your last arrival)?"
            $table->string('current_immigration_status')->nullable()->after('was_last_arrival_first_time');
            
            // "Expiration Date of Current Immigration Status (mm/dd/yyyy)"
            $table->date('current_immigration_status_expiration_date')->nullable()->after('current_immigration_status');
            
            // "or Type or Print "D/S" for Duration of Status"
            $table->boolean('current_immigration_status_ds')->default(0)->after('current_immigration_status_expiration_date');
            
            // "Have you ever been issued an "alien crewman" visa?"
            $table->boolean('ever_issued_alien_crewman_visa')->nullable()->after('current_immigration_status_ds');
            
            // "Did you last arrive in the United States to join a vessel as a seaman or crewman...?"
            $table->boolean('last_arrival_as_crewman')->nullable()->after('ever_issued_alien_crewman_visa');
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
                'was_last_arrival_first_time',
                'current_immigration_status',
                'current_immigration_status_expiration_date',
                'current_immigration_status_ds',
                'ever_issued_alien_crewman_visa',
                'last_arrival_as_crewman'
            ]);
        });
    }
}
