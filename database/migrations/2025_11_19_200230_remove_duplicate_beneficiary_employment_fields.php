<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            // Only drop if they exist
            if (Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_current_employer')) {
                $table->dropColumn('beneficiary_current_employer');
            }
            if (Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_current_occupation')) {
                $table->dropColumn('beneficiary_current_occupation');
            }
        });
    }

    public function down(): void
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            $table->string('beneficiary_current_employer', 100)->nullable();
            $table->string('beneficiary_current_occupation', 100)->nullable();
        });
    }
};