<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FixMilitaryIconInFianceSteps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('fiance_steps')
            ->where('slug', 'military')
            ->where('type', 'alien')
            ->update(['icon' => 'fa-shield-alt']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('fiance_steps')
            ->where('slug', 'military')
            ->where('type', 'alien')
            ->update(['icon' => 'fa-shield']);
    }
}
