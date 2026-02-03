<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('combined_cr1_aos_submitted_steps', function (Blueprint $table) {
            $table->unsignedBigInteger('submitted_app_id')->nullable()->after('user_id');
            $table->longText('detail')->nullable()->after('step');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('combined_cr1_aos_submitted_steps', function (Blueprint $table) {
            $table->dropColumn(['submitted_app_id', 'detail']);
        });
    }
};
