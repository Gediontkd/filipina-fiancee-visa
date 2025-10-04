<?php
// database/migrations/2025_01_XX_add_payment_to_applications.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('user_submitted_applications', function (Blueprint $table) {
            $table->boolean('payment_completed')->default(false)->after('status');
            $table->string('payment_intent_id')->nullable()->after('payment_completed');
            $table->decimal('payment_amount', 10, 2)->nullable()->after('payment_intent_id');
            $table->timestamp('paid_at')->nullable()->after('payment_amount');
        });
    }

    public function down()
    {
        Schema::table('user_submitted_applications', function (Blueprint $table) {
            $table->dropColumn(['payment_completed', 'payment_intent_id', 'payment_amount', 'paid_at']);
        });
    }
};