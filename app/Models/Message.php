<?php
// app/Models/Message.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admin_id',
        'application_id',
        'sender_type',
        'subject',
        'message',
        'read_at',
        'attachments',
        'priority',
        'is_important',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'attachments' => 'array',
        'is_important' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Message belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Message belongs to an admin (optional)
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Message belongs to an application
     */
    public function application()
    {
        return $this->belongsTo(UserSubmittedApplication::class, 'application_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    /**
     * Scope for unread messages
     */
    public function scopeUnread(Builder $query): Builder
    {
        return $query->whereNull('read_at');
    }

    /**
     * Scope for read messages
     */
    public function scopeRead(Builder $query): Builder
    {
        return $query->whereNotNull('read_at');
    }

    /**
     * Scope for messages by sender type
     */
    public function scopeBySenderType(Builder $query, string $senderType): Builder
    {
        return $query->where('sender_type', $senderType);
    }

    /**
     * Scope for messages by priority
     */
    public function scopeByPriority(Builder $query, string $priority): Builder
    {
        return $query->where('priority', $priority);
    }

    /**
     * Scope for important messages
     */
    public function scopeImportant(Builder $query): Builder
    {
        return $query->where('is_important', true);
    }

    /**
     * Scope for messages in a conversation thread
     */
    public function scopeInConversation(Builder $query, int $userId, int $applicationId): Builder
    {
        return $query->where('user_id', $userId)
                    ->where('application_id', $applicationId)
                    ->orderBy('created_at', 'asc');
    }

    /*
    |--------------------------------------------------------------------------
    | Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Mark message as read
     */
    public function markAsRead(): void
    {
        if (!$this->read_at) {
            $this->update(['read_at' => now()]);
        }
    }

    /**
     * Check if message is read
     */
    public function isRead(): bool
    {
        return !is_null($this->read_at);
    }

    /**
     * Check if message is from admin
     */
    public function isFromAdmin(): bool
    {
        return $this->sender_type === 'admin';
    }

    /**
     * Check if message is from user
     */
    public function isFromUser(): bool
    {
        return $this->sender_type === 'user';
    }

    /**
     * Get message sender name
     */
    public function getSenderNameAttribute(): string
    {
        if ($this->isFromAdmin() && $this->admin) {
            return $this->admin->name;
        }
        
        if ($this->isFromUser() && $this->user) {
            return $this->user->name;
        }
        
        return 'Unknown Sender';
    }

    /**
     * Get formatted message date
     */
    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('M j, Y \a\t g:i A');
    }

    /**
     * Get priority color class for UI
     */
    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'high' => 'text-red-600',
            'normal' => 'text-blue-600',
            'low' => 'text-gray-600',
            default => 'text-gray-600',
        };
    }

    /**
     * Check if message has attachments
     */
    public function hasAttachments(): bool
    {
        return !empty($this->attachments);
    }

    /**
     * Get attachment count
     */
    public function getAttachmentCountAttribute(): int
    {
        return count($this->attachments ?? []);
    }
}