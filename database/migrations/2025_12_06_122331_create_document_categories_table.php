<?php
// database/migrations/2025_12_06_122331_create_document_categories_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_categories', function (Blueprint $table) {
            $table->id();
            $table->string('visa_type', 50); // fiance, spouse, adjustment, etc.
            $table->string('category_key', 100); // petitioner, beneficiary, etc.
            $table->string('category_label');
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['visa_type', 'is_active']);
            $table->unique(['visa_type', 'category_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_categories');
    }
};