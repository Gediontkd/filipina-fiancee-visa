<?php
// app/Models/DocumentType.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'type_key',
        'name',
        'description',
        'instructions',
        'is_required',
        'allow_multiple',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'allow_multiple' => 'boolean',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }

    public function uploadedDocuments()
    {
        return $this->hasMany(DropBox::class, 'document_type', 'type_key');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeRequired(Builder $query): Builder
    {
        return $query->where('is_required', true);
    }

    public function scopeOptional(Builder $query): Builder
    {
        return $query->where('is_required', false);
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

    public function hasUploadedDocuments(int $userId): bool
    {
        return DropBox::where('user_id', $userId)
            ->where('document_type', $this->type_key)
            ->exists();
    }

    public function getUploadedDocumentsCount(int $userId): int
    {
        return DropBox::where('user_id', $userId)
            ->where('document_type', $this->type_key)
            ->count();
    }

    public function getRequirementBadge(): string
    {
        return $this->is_required
            ? '<span class="badge bg-danger">Required</span>'
            : '<span class="badge bg-secondary">Optional</span>';
    }
}