<?php
// database/migrations/2025_12_06_122406_create_document_types_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('document_categories')->onDelete('cascade');
            $table->string('type_key', 100); // petitioner_citizenship, etc.
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('instructions')->nullable();
            $table->boolean('is_required')->default(true);
            $table->boolean('allow_multiple')->default(false);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['category_id', 'is_active']);
            $table->unique(['category_id', 'type_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_types');
    }
};