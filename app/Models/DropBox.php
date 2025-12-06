<?php
// app/Models/DropBox.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

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
    | File Management Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Check if physical file exists on disk
     */
    public function fileExists(): bool
    {
        $filePath = 'dropbox/' . $this->name;
        return Storage::disk('public')->exists($filePath);
    }

    /**
     * Get the full file path
     */
    public function getFilePath(): string
    {
        return 'dropbox/' . $this->name;
    }

    /**
     * Get the absolute file path on server
     */
    public function getAbsoluteFilePath(): string
    {
        return storage_path('app/public/dropbox/' . $this->name);
    }

    /**
     * Delete physical file from storage
     */
    public function deleteFile(): bool
    {
        $filePath = $this->getFilePath();
        
        if (Storage::disk('public')->exists($filePath)) {
            return Storage::disk('public')->delete($filePath);
        }
        
        return false;
    }

    /*
    |--------------------------------------------------------------------------
    | Verification Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Mark document as verified
     * 
     * @param int|null $adminId - The admin ID who verified the document
     * @return void
     */
    public function markAsVerified(?int $adminId = null): void
    {
        // Only set verified_by if adminId is provided and not null
        $updateData = [
            'is_verified' => true,
            'verified_at' => now(),
        ];

        // Only include verified_by if we have a valid admin ID
        if ($adminId !== null) {
            $updateData['verified_by'] = $adminId;
        }

        $this->update($updateData);
    }

    /**
     * Mark document as unverified
     */
    public function markAsUnverified(): void
    {
        $this->update([
            'is_verified' => false,
            'verified_at' => null,
            'verified_by' => null,
        ]);
    }

    /**
     * Check if document is verified
     */
    public function isVerified(): bool
    {
        return $this->is_verified;
    }

    /*
    |--------------------------------------------------------------------------
    | File Type Helper Methods
    |--------------------------------------------------------------------------
    */

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
     * Check if file is document (Word, Excel, etc.)
     */
    public function isDocument(): bool
    {
        $docExtensions = ['doc', 'docx', 'xls', 'xlsx', 'txt', 'rtf'];
        return in_array(strtolower($this->getExtension()), $docExtensions);
    }

    /**
     * Get icon class for file type (Font Awesome)
     */
    public function getIconClass(): string
    {
        $extension = strtolower($this->getExtension());

        $iconMap = [
            'pdf' => 'fa-file-pdf text-red-600',
            'doc' => 'fa-file-word text-blue-600',
            'docx' => 'fa-file-word text-blue-600',
            'xls' => 'fa-file-excel text-green-600',
            'xlsx' => 'fa-file-excel text-green-600',
            'jpg' => 'fa-file-image text-purple-600',
            'jpeg' => 'fa-file-image text-purple-600',
            'png' => 'fa-file-image text-purple-600',
            'gif' => 'fa-file-image text-purple-600',
            'txt' => 'fa-file-alt text-gray-600',
        ];

        return $iconMap[$extension] ?? 'fa-file text-gray-600';
    }

    /**
     * Get a human-readable mime type description
     */
    public function getMimeTypeDescription(): string
    {
        $descriptions = [
            'application/pdf' => 'PDF Document',
            'image/jpeg' => 'JPEG Image',
            'image/png' => 'PNG Image',
            'image/gif' => 'GIF Image',
            'application/msword' => 'Word Document',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => 'Word Document',
            'application/vnd.ms-excel' => 'Excel Spreadsheet',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' => 'Excel Spreadsheet',
        ];

        return $descriptions[$this->mime_type] ?? 'Unknown File Type';
    }
}