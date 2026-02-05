<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddSubmittedAtToUserSubmittedApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_submitted_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('user_submitted_applications', 'submitted_at')) {
                $table->timestamp('submitted_at')->nullable()->after('status');
            }
        });

        // Backfill existing records: set submitted_at to created_at for records that don't have it
        DB::table('user_submitted_applications')
            ->whereNull('submitted_at')
            ->update(['submitted_at' => DB::raw('created_at')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_submitted_applications', function (Blueprint $table) {
            $table->dropColumn('submitted_at');
        });
    }
}
