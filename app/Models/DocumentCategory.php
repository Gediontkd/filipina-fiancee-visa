<?php
// app/Models/DocumentCategory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DocumentCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'visa_type',
        'category_key',
        'category_label',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function documentTypes()
    {
        return $this->hasMany(DocumentType::class, 'category_id')
            ->orderBy('sort_order');
    }

    public function activeDocumentTypes()
    {
        return $this->hasMany(DocumentType::class, 'category_id')
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    public function uploadedDocuments()
    {
        return $this->hasMany(DropBox::class, 'document_category', 'category_key');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeForVisaType(Builder $query, string $visaType): Builder
    {
        return $query->where('visa_type', $visaType);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order');
    }

    /*
    |--------------------------------------------------------------------------
    | Methods
    |--------------------------------------------------------------------------
    */

    public function getRequiredDocumentsCount(): int
    {
        return $this->documentTypes()->where('is_required', true)->count();
    }

    public function getUploadedDocumentsCount(int $userId): int
    {
        $requiredTypes = $this->documentTypes()
            ->where('is_required', true)
            ->pluck('type_key');

        return DropBox::where('user_id', $userId)
            ->where('document_category', $this->category_key)
            ->whereIn('document_type', $requiredTypes)
            ->distinct('document_type')
            ->count('document_type');
    }

    public function getCompletionPercentage(int $userId): float
    {
        $required = $this->getRequiredDocumentsCount();
        if ($required === 0) {
            return 100;
        }

        $uploaded = $this->getUploadedDocumentsCount($userId);
        return round(($uploaded / $required) * 100, 1);
    }
}