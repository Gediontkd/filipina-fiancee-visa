<?php
// database/migrations/2025_09_17_000002_add_missing_columns_to_messages_table.php

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
        Schema::table('messages', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('messages', 'priority')) {
                $table->enum('priority', ['low', 'normal', 'high'])->default('normal')->after('message');
            }
            
            if (!Schema::hasColumn('messages', 'is_important')) {
                $table->boolean('is_important')->default(false)->after('priority');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn(['priority', 'is_important']);
        });
    }
};