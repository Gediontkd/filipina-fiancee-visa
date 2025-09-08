<?php
// Create migration: php artisan make:migration create_monitoring_changes_table

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('monitoring_changes', function (Blueprint $table) {
            $table->id();
            $table->string('source'); // 'uscis_forms', 'st_lukes_medical'
            $table->string('type'); // 'fee_change', 'form_update', 'content_change'
            $table->string('title');
            $table->text('description');
            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();
            $table->string('url')->nullable();
            $table->timestamp('detected_at');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('monitoring_changes');
    }
};