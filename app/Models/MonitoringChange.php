<?php
// app/Models/MonitoringChange.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonitoringChange extends Model
{
    use HasFactory;

    protected $fillable = [
        'source',
        'type',
        'title',
        'description',
        'old_data',
        'new_data',
        'url',
        'detected_at',
        'is_read',
    ];

    protected $casts = [
        'old_data' => 'json',
        'new_data' => 'json',
        'detected_at' => 'datetime',
        'is_read' => 'boolean',
    ];

    /**
     * Scope for unread changes
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope for specific source
     */
    public function scopeForSource($query, $source)
    {
        return $query->where('source', $source);
    }

    /**
     * Mark as read
     */
    public function markAsRead()
    {
        $this->update(['is_read' => true]);
    }

    /**
     * Get badge color based on type
     */
    public function getBadgeColorAttribute()
    {
        return match($this->type) {
            'fee_change' => 'bg-red-100 text-red-800',
            'form_update' => 'bg-blue-100 text-blue-800',
            'content_change' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Get source display name
     */
    public function getSourceDisplayAttribute()
    {
        return match($this->source) {
            'uscis_forms' => 'USCIS Forms',
            'st_lukes_medical' => "St. Luke's Medical",
            default => ucfirst($this->source),
        };
    }
}