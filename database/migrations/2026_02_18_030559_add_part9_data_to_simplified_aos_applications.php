<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            $table->json('part9_data')->nullable()->after('eligibility_questions');
            $table->text('part9_explanation')->nullable()->after('part9_data');
        });
    }

    public function down(): void
    {
        Schema::table('simplified_aos_applications', function (Blueprint $table) {
            $table->dropColumn(['part9_data', 'part9_explanation']);
        });
    }
};
