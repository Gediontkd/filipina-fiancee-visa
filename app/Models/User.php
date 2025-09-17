<?php
// app/Models/User.php (Enhanced with messaging relationships)

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'chosen_application',
        'stripe_customer_id',
        'application_route',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Application Relationships
    |--------------------------------------------------------------------------
    */

    public function userSubmittedApplications()
    {
        return $this->hasMany(UserSubmittedApplication::class);
    }

    public function fianceVisaSteps()
    {
        return $this->hasMany(FianceVisaStep::class);
    }

    public function spouseVisaSteps()
    {
        return $this->hasMany(SpouseVisaStep::class);
    }

    public function adjustmentVisaSteps()
    {
        return $this->hasMany(AdjustmentVisaStep::class);
    }

    public function fianceAlien()
    {
        return $this->hasOne(FianceAlien::class);
    }

    public function fianceAlienChildren()
    {
        return $this->hasOne(FianceAlienChildren::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Messaging Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * All messages for this user (sent and received)
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Messages sent by this user
     */
    public function sentMessages()
    {
        return $this->hasMany(Message::class)->where('sender_type', 'user');
    }

    /**
     * Messages received by this user (from admins)
     */
    public function receivedMessages()
    {
        return $this->hasMany(Message::class)->where('sender_type', 'admin');
    }

    /**
     * Unread messages received by this user
     */
    public function unreadMessages()
    {
        return $this->hasMany(Message::class)
            ->where('sender_type', 'admin')
            ->whereNull('read_at');
    }

    /*
    |--------------------------------------------------------------------------
    | Document Relationships
    |--------------------------------------------------------------------------
    */

    /**
     * Documents related to user's applications
     */
    public function applicationDocuments()
    {
        return $this->hasManyThrough(
            ApplicationDocument::class,
            UserSubmittedApplication::class,
            'user_id', // Foreign key on UserSubmittedApplication table
            'application_id', // Foreign key on ApplicationDocument table
            'id', // Local key on User table
            'id' // Local key on UserSubmittedApplication table
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Get the user's latest submitted application
     */
    public function getLatestApplicationAttribute()
    {
        return $this->userSubmittedApplications()
            ->with('visaApplication')
            ->latest()
            ->first();
    }

    /**
     * Get unread message count
     */
    public function getUnreadMessageCountAttribute()
    {
        return $this->unreadMessages()->count();
    }

    /**
     * Check if user has any submitted applications
     */
    public function hasSubmittedApplications()
    {
        return $this->userSubmittedApplications()->exists();
    }

    /**
     * Check if user has unread messages
     */
    public function hasUnreadMessages()
    {
        return $this->unreadMessages()->exists();
    }

    /**
     * Get messages for a specific application
     */
    public function getMessagesForApplication($applicationId)
    {
        return $this->messages()
            ->where('application_id', $applicationId)
            ->with('admin')
            ->orderBy('created_at', 'asc')
            ->get();
    }

    /**
     * Get user's application progress summary
     */
    public function getApplicationProgressSummary()
    {
        $applications = $this->userSubmittedApplications()->with('visaApplication')->get();
        $summary = [];

        foreach ($applications as $application) {
            $messageCount = $this->messages()->where('application_id', $application->id)->count();
            $unreadCount = $this->unreadMessages()->where('application_id', $application->id)->count();
            $documentCount = ApplicationDocument::where('application_id', $application->id)->count();

            $summary[] = [
                'application' => $application,
                'message_count' => $messageCount,
                'unread_count' => $unreadCount,
                'document_count' => $documentCount,
                'has_form_data' => $this->hasFormDataForApplication($application),
            ];
        }

        return $summary;
    }

    /**
     * Check if user has form data for specific application
     */
    private function hasFormDataForApplication($application)
    {
        switch (strtolower($this->chosen_application)) {
            case 'fiance':
            case 'fiancee':
                return $this->fianceVisaSteps()->exists() || 
                       $this->fianceAlien()->exists() || 
                       $this->fianceAlienChildren()->exists();
            
            case 'spouse':
                return $this->spouseVisaSteps()->exists();
            
            case 'adjustment':
                return $this->adjustmentVisaSteps()->exists();
            
            default:
                return false;
        }
    }

    /**
     * Get user's full name with fallback
     */
    public function getFullNameAttribute()
    {
        return $this->name ?: 'Unknown User';
    }

    /**
     * Get user's initials for avatar
     */
    public function getInitialsAttribute()
    {
        $names = explode(' ', $this->name);
        $initials = '';
        
        foreach ($names as $name) {
            $initials .= strtoupper(substr($name, 0, 1));
            if (strlen($initials) >= 2) break;
        }
        
        return $initials ?: 'U';
    }

    /**
     * Get user's status color based on application progress
     */
    public function getStatusColorAttribute()
    {
        if (!$this->hasSubmittedApplications()) {
            return 'gray'; // No applications
        }

        $latestApp = $this->latest_application;
        if (!$latestApp) {
            return 'gray';
        }

        return match($latestApp->status) {
            'approved' => 'green',
            'under_review' => 'blue',
            'rejected' => 'red',
            'pending' => 'yellow',
            default => 'gray',
        };
    }

    /**
     * Mark all user's messages as read
     */
    public function markAllMessagesAsRead()
    {
        return $this->unreadMessages()->update(['read_at' => now()]);
    }

    /**
     * Get conversation summary for all applications
     */
    public function getConversationSummary()
    {
        $applications = $this->userSubmittedApplications()->with('visaApplication')->get();
        $conversations = [];

        foreach ($applications as $application) {
            $lastMessage = $this->messages()
                ->where('application_id', $application->id)
                ->latest()
                ->first();

            $unreadCount = $this->unreadMessages()
                ->where('application_id', $application->id)
                ->count();

            if ($lastMessage || $unreadCount > 0) {
                $conversations[] = [
                    'application' => $application,
                    'last_message' => $lastMessage,
                    'unread_count' => $unreadCount,
                    'total_messages' => $this->messages()->where('application_id', $application->id)->count(),
                ];
            }
        }

        return collect($conversations)->sortByDesc(function ($conv) {
            return $conv['last_message']?->created_at ?? $conv['application']->created_at;
        });
    }
}