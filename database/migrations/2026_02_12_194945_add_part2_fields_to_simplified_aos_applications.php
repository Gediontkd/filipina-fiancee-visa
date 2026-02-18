<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPart2FieldsToSimplifiedAosApplications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            $table->boolean('filing_with_eoir')->nullable()->after('is_principal_applicant');
            $table->string('derivative_principal_first_name')->nullable()->after('filing_with_eoir');
            $table->string('derivative_principal_last_name')->nullable()->after('derivative_principal_first_name');
            $table->string('derivative_principal_middle_name')->nullable()->after('derivative_principal_last_name');
            $table->string('derivative_principal_a_number')->nullable()->after('derivative_principal_middle_name');
            $table->date('derivative_principal_dob')->nullable()->after('derivative_principal_a_number');
            $table->text('immigrant_category')->nullable()->after('derivative_principal_dob');
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
                'filing_with_eoir',
                'derivative_principal_first_name',
                'derivative_principal_last_name',
                'derivative_principal_middle_name',
                'derivative_principal_a_number',
                'derivative_principal_dob',
                'immigrant_category'
            ]);
        });
    }
}
