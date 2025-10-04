<?php
// app/Observers/UserObserver.php (UPDATED - Sends Welcome Email)

namespace App\Observers;

use App\Models\User;
use App\Services\PdfMergeService;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

/**
 * Observer for User model events
 * UPDATED: Now sends welcome email on user creation
 */
class UserObserver
{
    /**
     * Handle the User "created" event.
     * Creates PDF folder and sends welcome email
     *
     * @param User $user
     * @return void
     */
    public function created(User $user): void
    {
        try {
            // Create user-specific PDF folder
            $folderCreated = PdfMergeService::createUserFolder($user->id);
            
            if ($folderCreated) {
                Log::info('User PDF folder created successfully', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                ]);
            } else {
                Log::warning('Failed to create user PDF folder', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                ]);
            }

            // Send welcome email
            try {
                Mail::to($user->email)->send(new WelcomeEmail($user));
                
                Log::info('Welcome email sent successfully', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                ]);
            } catch (\Exception $emailException) {
                Log::error('Failed to send welcome email', [
                    'user_id' => $user->id,
                    'user_email' => $user->email,
                    'error' => $emailException->getMessage(),
                ]);
                // Don't throw - registration should succeed even if email fails
            }

        } catch (\Exception $e) {
            Log::error('Error in UserObserver::created', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }

    /**
     * Handle the User "updated" event.
     *
     * @param User $user
     * @return void
     */
    public function updated(User $user): void
    {
        // Add any update logic if needed
    }

    /**
     * Handle the User "deleted" event.
     * Optionally clean up user's PDF folder
     *
     * @param User $user
     * @return void
     */
    public function deleted(User $user): void
    {
        // Optionally delete user's PDF folder
        // Uncomment if you want to remove folders on user deletion
        
        /*
        try {
            $userPdfPath = resource_path('views/pdf/user_' . $user->id);
            
            if (File::exists($userPdfPath)) {
                File::deleteDirectory($userPdfPath);
                
                Log::info('User PDF folder deleted', [
                    'user_id' => $user->id,
                    'path' => $userPdfPath,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error deleting user PDF folder', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
        }
        */
    }

    /**
     * Handle the User "restored" event.
     *
     * @param User $user
     * @return void
     */
    public function restored(User $user): void
    {
        // Recreate PDF folder if user is restored from soft delete
        try {
            PdfMergeService::createUserFolder($user->id);
            
            Log::info('User PDF folder restored', [
                'user_id' => $user->id,
            ]);
        } catch (\Exception $e) {
            Log::error('Error restoring user PDF folder', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}