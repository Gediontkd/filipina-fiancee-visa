<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            $table->json('sponsor_previous_marriages_list')->nullable()->after('sponsor_previous_marriages');
            $table->json('beneficiary_previous_marriages_list')->nullable()->after('beneficiary_previous_marriages');
        });
    }

    public function down()
    {
        Schema::table('simplified_spouse_visa_applications', function (Blueprint $table) {
            $table->dropColumn(['sponsor_previous_marriages_list', 'beneficiary_previous_marriages_list']);
        });
    }
};