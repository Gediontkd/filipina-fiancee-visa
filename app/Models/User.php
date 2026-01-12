<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'chosen_application',
        'stripe_customer_id',
        'application_route',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    // OLD STEP-BASED SYSTEMS
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

    // NEW SIMPLIFIED SYSTEMS
    public function simplifiedSpouseVisaApplications()
    {
        return $this->hasMany(SimplifiedSpouseVisaApplication::class);
    }

    public function simplifiedAosApplications()
    {
        return $this->hasMany(SimplifiedAosApplication::class);
    }
    

    /*
    |--------------------------------------------------------------------------
    | Messaging Relationships
    |--------------------------------------------------------------------------
    */

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class)->where('sender_type', 'user');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class)->where('sender_type', 'admin');
    }

    public function unreadMessages()
    {
        return $this->hasMany(Message::class)
            ->where('sender_type', 'admin')
            ->whereNull('read_at');
    }

    /**
     * User's uploaded documents (DropBox files)
     * Required for admin workspace documents tab
     */
    public function dropboxFiles()
    {
        return $this->hasMany(DropBox::class);
    }

    /**
     * Alias for dropboxFiles (for compatibility)
     */
    public function uploadedDocuments()
    {
        return $this->dropboxFiles();
    }

    /*
    |--------------------------------------------------------------------------
    | Document Relationships
    |--------------------------------------------------------------------------
    */

    public function applicationDocuments()
    {
        return $this->hasManyThrough(
            ApplicationDocument::class,
            UserSubmittedApplication::class,
            'user_id',
            'application_id',
            'id',
            'id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function getLatestApplicationAttribute()
    {
        return $this->userSubmittedApplications()
            ->with('visaApplication')
            ->latest()
            ->first();
    }

    public function getUnreadMessageCountAttribute()
    {
        return $this->unreadMessages()->count();
    }

    public function hasSubmittedApplications()
    {
        return $this->userSubmittedApplications()->exists();
    }

    public function hasUnreadMessages()
    {
        return $this->unreadMessages()->exists();
    }

    public function getMessagesForApplication($applicationId)
    {
        return $this->messages()
            ->where('application_id', $applicationId)
            ->with('admin')
            ->orderBy('created_at', 'asc')
            ->get();
    }

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
     * Check if user has form data for specific application (UPDATED FOR NEW SYSTEMS)
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
                // Check BOTH old and new systems
                return $this->simplifiedSpouseVisaApplications()
                    ->where('submitted_app_id', $application->id)
                    ->exists() || 
                    $this->spouseVisaSteps()->exists();
            
            case 'adjustment':
                // Check BOTH old and new systems
                return $this->simplifiedAosApplications()
                    ->where('submitted_app_id', $application->id)
                    ->exists() || 
                    $this->adjustmentVisaSteps()->exists();
            
            default:
                return false;
        }
    }

    public function getFullNameAttribute()
    {
        return $this->name ?: 'Unknown User';
    }

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

    public function getStatusColorAttribute()
    {
        if (!$this->hasSubmittedApplications()) {
            return 'gray';
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

    public function markAllMessagesAsRead()
    {
        return $this->unreadMessages()->update(['read_at' => now()]);
    }

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