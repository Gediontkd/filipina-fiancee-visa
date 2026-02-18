<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddI94FieldsToSimplifiedAosApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('simplified_aos_applications', 'i94_last_name')) {
                $table->string('i94_last_name')->nullable();
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'i94_first_name')) {
                $table->string('i94_first_name')->nullable();
            }
            // i94_expiration_date is already added in a previous migration
            if (!Schema::hasColumn('simplified_aos_applications', 'i94_expiration_date_ds')) {
                $table->boolean('i94_expiration_date_ds')->default(false);
            }
            if (!Schema::hasColumn('simplified_aos_applications', 'i94_status')) {
                $table->string('i94_status')->nullable();
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
                'i94_last_name',
                'i94_first_name',
                'i94_expiration_date',
                'i94_expiration_date_ds',
                'i94_status',
            ]);
        });
    }
}
