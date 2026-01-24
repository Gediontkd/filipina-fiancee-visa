<?php
// app/Models/ApplicationDocument.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class ApplicationDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'document_type',
        'form_name',
        'file_path',
        'original_filename',
        'file_size',
        'mime_type',
        'uploaded_by',
        'uploaded_by_type',
        'status',
        'admin_notes',
        'description',
        'reviewed_at',
        'reviewed_by',
        'is_final_version',
    ];

    protected $casts = [
        'reviewed_at' => 'datetime',
        'is_final_version' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Document belongs to an application
     */
    public function application()
    {
        return $this->belongsTo(UserSubmittedApplication::class, 'application_id');
    }

    /**
     * Document reviewed by admin (optional)
     */
    public function reviewer()
    {
        return $this->belongsTo(Admin::class, 'reviewed_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Scope for documents by type
     */
    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('document_type', $type);
    }

    /**
     * Scope for documents by status
     */
    public function scopeByStatus(Builder $query, string $status): Builder
    {
        return $query->where('status', $status);
    }

    /**
     * Scope for final versions
     */
    public function scopeFinalVersions(Builder $query): Builder
    {
        return $query->where('is_final_version', true);
    }

    /**
     * Scope for documents uploaded by admins
     */
    public function scopeUploadedByAdmin(Builder $query): Builder
    {
        return $query->where('uploaded_by_type', 'admin');
    }

    /**
     * Scope for documents uploaded by users
     */
    public function scopeUploadedByUser(Builder $query): Builder
    {
        return $query->where('uploaded_by_type', 'user');
    }

    /**
     * Scope for pending review documents
     */
    public function scopePendingReview(Builder $query): Builder
    {
        return $query->where('status', 'ready_for_review');
    }

    /*
    |--------------------------------------------------------------------------
    | Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Get full file URL
     */
    public function getFileUrlAttribute(): string
    {
        return Storage::url($this->file_path);
    }

    /**
     * Get formatted file size
     */
    public function getFormattedFileSizeAttribute(): string
    {
        if (!$this->file_size) {
            return 'Unknown size';
        }

        $bytes = intval($this->file_size);
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get status color class for UI
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'draft' => 'bg-gray-100 text-gray-800',
            'ready_for_review' => 'bg-yellow-100 text-yellow-800',
            'approved' => 'bg-green-100 text-green-800',
            'needs_revision' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get document type icon
     */
    public function getTypeIconAttribute(): string
    {
        return match($this->document_type) {
            'draft' => 'fas fa-edit',
            'final' => 'fas fa-file-check',
            'signed' => 'fas fa-signature',
            'supporting' => 'fas fa-paperclip',
            default => 'fas fa-file',
        };
    }

    /**
     * Check if document is reviewed
     */
    public function isReviewed(): bool
    {
        return !is_null($this->reviewed_at);
    }

    /**
     * Check if document is approved
     */
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    /**
     * Check if document needs revision
     */
    public function needsRevision(): bool
    {
        return $this->status === 'needs_revision';
    }

    /**
     * Check if document is ready for review
     */
    public function isReadyForReview(): bool
    {
        return $this->status === 'ready_for_review';
    }

    /**
     * Mark document as reviewed
     */
    public function markAsReviewed(int $adminId, string $status, ?string $notes = null): void
    {
        $this->update([
            'status' => $status,
            'reviewed_at' => now(),
            'reviewed_by' => $adminId,
            'admin_notes' => $notes,
        ]);
    }

    /**
     * Get uploader name
     */
    public function getUploaderNameAttribute(): string
    {
        if ($this->uploaded_by_type === 'admin') {
            $admin = Admin::find($this->uploaded_by);
            return $admin ? $admin->name : 'Unknown Admin';
        } else {
            $user = User::find($this->uploaded_by);
            return $user ? $user->name : 'Unknown User';
        }
    }

    /**
     * Check if file exists in storage
     */
    public function fileExists(): bool
    {
        return Storage::exists($this->file_path);
    }

    /**
     * Delete file from storage
     */
    public function deleteFile(): bool
    {
        if ($this->fileExists()) {
            return Storage::delete($this->file_path);
        }
        return true;
    }
}