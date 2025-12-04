<?php
// app/Models/DropBox.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DropBox extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
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
    ];

    protected $appends = ['file_url', 'formatted_file_size'];

    protected $casts = [
        'verified_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Document belongs to user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Document verified by admin
     */
    public function verifiedBy()
    {
        return $this->belongsTo(Admin::class, 'verified_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */

    /**
     * Get full file URL
     */
    public function getFileUrlAttribute(): string
    {
        return url('storage/dropbox/' . $this->attributes['name']);
    }

    /**
     * Get formatted file size
     */
    public function getFormattedFileSizeAttribute(): string
    {
        if (!isset($this->attributes['file_size'])) {
            return 'Unknown';
        }

        $bytes = $this->attributes['file_size'];
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;

        while ($bytes > 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get document type label
     */
    public function getDocumentTypeLabelAttribute(): string
    {
        $labels = [
            'petitioner_citizenship' => 'U.S. Citizenship Proof',
            'petitioner_income' => 'Income Proof',
            'beneficiary_birth_certificate' => 'Birth Certificate',
            'beneficiary_passport_photo' => 'Passport Photo',
            // Add more as needed
        ];

        return $labels[$this->document_type] ?? ucfirst(str_replace('_', ' ', $this->document_type));
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Scope for documents by visa type
     */
    public function scopeByVisaType(Builder $query, string $visaType): Builder
    {
        return $query->where('visa_type', $visaType);
    }

    /**
     * Scope for documents by category
     */
    public function scopeByCategory(Builder $query, string $category): Builder
    {
        return $query->where('document_category', $category);
    }

    /**
     * Scope for documents by type
     */
    public function scopeByDocumentType(Builder $query, string $type): Builder
    {
        return $query->where('document_type', $type);
    }

    /**
     * Scope for verified documents
     */
    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('is_verified', true);
    }

    /**
     * Scope for unverified documents
     */
    public function scopeUnverified(Builder $query): Builder
    {
        return $query->where('is_verified', false);
    }

    /*
    |--------------------------------------------------------------------------
    | Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Mark document as verified
     */
    public function markAsVerified(int $adminId): void
    {
        $this->update([
            'is_verified' => true,
            'verified_at' => now(),
            'verified_by' => $adminId,
        ]);
    }

    /**
     * Check if document is verified
     */
    public function isVerified(): bool
    {
        return $this->is_verified;
    }

    /**
     * Get file extension
     */
    public function getExtension(): string
    {
        return pathinfo($this->name, PATHINFO_EXTENSION);
    }

    /**
     * Check if file is PDF
     */
    public function isPdf(): bool
    {
        return strtolower($this->getExtension()) === 'pdf';
    }

    /**
     * Check if file is image
     */
    public function isImage(): bool
    {
        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'];
        return in_array(strtolower($this->getExtension()), $imageExtensions);
    }

    /**
     * Get icon class for file type
     */
    public function getIconClass(): string
    {
        $extension = strtolower($this->getExtension());

        $iconMap = [
            'pdf' => 'fa-file-pdf text-danger',
            'doc' => 'fa-file-word text-primary',
            'docx' => 'fa-file-word text-primary',
            'xls' => 'fa-file-excel text-success',
            'xlsx' => 'fa-file-excel text-success',
            'jpg' => 'fa-file-image text-info',
            'jpeg' => 'fa-file-image text-info',
            'png' => 'fa-file-image text-info',
            'gif' => 'fa-file-image text-info',
        ];

        return $iconMap[$extension] ?? 'fa-file text-secondary';
    }
}