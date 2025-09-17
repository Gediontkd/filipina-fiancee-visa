<?php
// database/migrations/2025_09_15_000002_create_application_documents_table.php

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
        Schema::create('application_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->string('document_type'); // 'draft', 'final', 'signed', 'supporting'
            $table->string('form_name'); // I-129F, I-485, etc.
            $table->string('file_path');
            $table->string('original_filename');
            $table->string('file_size')->nullable();
            $table->string('mime_type')->nullable();
            $table->unsignedBigInteger('uploaded_by');
            $table->enum('uploaded_by_type', ['admin', 'user']);
            $table->enum('status', ['draft', 'ready_for_review', 'approved', 'needs_revision'])->default('draft');
            $table->text('admin_notes')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->unsignedBigInteger('reviewed_by')->nullable();
            $table->boolean('is_final_version')->default(false);
            $table->timestamps();
            
            $table->foreign('application_id')->references('id')->on('user_submitted_applications')->onDelete('cascade');
            $table->foreign('reviewed_by')->references('id')->on('admins')->onDelete('set null');
            
            $table->index(['application_id', 'document_type']);
            $table->index(['status', 'created_at']);
            $table->index('uploaded_by_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_documents');
    }
};