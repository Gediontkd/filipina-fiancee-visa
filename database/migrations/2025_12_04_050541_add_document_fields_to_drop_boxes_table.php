<?php
// database/migrations/2025_12_04_050541_add_document_fields_to_drop_boxes_table.php

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
        Schema::table('drop_boxes', function (Blueprint $table) {
            // Add new columns for document categorization
            $table->string('original_filename')->nullable()->after('name');
            $table->unsignedBigInteger('file_size')->nullable()->after('original_filename');
            $table->string('mime_type', 100)->nullable()->after('file_size');
            $table->string('visa_type', 50)->nullable()->after('mime_type')->index();
            $table->string('document_category', 100)->nullable()->after('visa_type')->index();
            $table->string('document_type', 100)->nullable()->after('document_category')->index();
            $table->text('description')->nullable()->after('document_type');
            
            // Add verification fields
            $table->boolean('is_verified')->default(false)->after('description');
            $table->timestamp('verified_at')->nullable()->after('is_verified');
            $table->unsignedBigInteger('verified_by')->nullable()->after('verified_at');
            
            // Add foreign key for verified_by (admin)
            $table->foreign('verified_by')
                ->references('id')
                ->on('admins')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drop_boxes', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['verified_by']);
            
            // Drop columns
            $table->dropColumn([
                'original_filename',
                'file_size',
                'mime_type',
                'visa_type',
                'document_category',
                'document_type',
                'description',
                'is_verified',
                'verified_at',
                'verified_by',
            ]);
        });
    }
};