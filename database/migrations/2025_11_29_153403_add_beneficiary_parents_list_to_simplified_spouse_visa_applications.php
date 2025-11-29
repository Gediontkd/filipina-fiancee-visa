<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            // Only add if column doesn't exist
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parents_list')) {
                $table->json('beneficiary_parents_list')->nullable();
            }
        });

        // Drop old columns in separate statement (safer)
        $columnsToCheck = [
            'beneficiary_parent1_first_name',
            'beneficiary_parent1_middle_name',
            'beneficiary_parent1_last_name',
            'beneficiary_parent1_dob',
            'beneficiary_parent1_country',
            'beneficiary_parent1_relationship',
            'beneficiary_parent2_first_name',
            'beneficiary_parent2_middle_name',
            'beneficiary_parent2_last_name',
            'beneficiary_parent2_dob',
            'beneficiary_parent2_sex',
            'beneficiary_parent2_country',
            'beneficiary_parent2_relationship',
        ];

        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) use ($columnsToCheck) {
            $existingColumns = [];
            foreach ($columnsToCheck as $column) {
                if (Schema::hasColumn('simplified_spouse_visa_applications', $column)) {
                    $existingColumns[] = $column;
                }
            }
            
            if (!empty($existingColumns)) {
                $table->dropColumn($existingColumns);
            }
        });
    }

    public function down()
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            if (Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parents_list')) {
                $table->dropColumn('beneficiary_parents_list');
            }
            
            // Restore old fields only if they don't exist
            if (!Schema::hasColumn('simplified_spouse_visa_applications', 'beneficiary_parent1_first_name')) {
                $table->string('beneficiary_parent1_first_name')->nullable();
                $table->string('beneficiary_parent1_middle_name')->nullable();
                $table->string('beneficiary_parent1_last_name')->nullable();
                $table->date('beneficiary_parent1_dob')->nullable();
                $table->string('beneficiary_parent1_country')->nullable();
                $table->string('beneficiary_parent1_relationship')->nullable();
                $table->string('beneficiary_parent2_first_name')->nullable();
                $table->string('beneficiary_parent2_middle_name')->nullable();
                $table->string('beneficiary_parent2_last_name')->nullable();
                $table->date('beneficiary_parent2_dob')->nullable();
                $table->string('beneficiary_parent2_sex')->nullable();
                $table->string('beneficiary_parent2_country')->nullable();
                $table->string('beneficiary_parent2_relationship')->nullable();
            }
        });
    }
};