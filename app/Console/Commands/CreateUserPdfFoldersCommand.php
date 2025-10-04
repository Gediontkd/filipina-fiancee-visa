<?php
// app/Console/Commands/CreateUserPdfFoldersCommand.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Services\PdfMergeService;

/**
 * Artisan command to create PDF folders for all existing users
 * Useful for retroactive setup after implementing the folder system
 */
class CreateUserPdfFoldersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf:create-user-folders 
                            {--force : Force creation even if folders exist}
                            {--user= : Create folder for specific user ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create PDF folders for all users or a specific user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $force = $this->option('force');
        $userId = $this->option('user');

        if ($userId) {
            return $this->createSingleUserFolder($userId, $force);
        }

        return $this->createAllUserFolders($force);
    }

    /**
     * Create folder for a single user
     *
     * @param int $userId
     * @param bool $force
     * @return int
     */
    private function createSingleUserFolder($userId, $force)
    {
        $user = User::find($userId);

        if (!$user) {
            $this->error("User with ID {$userId} not found.");
            return 1;
        }

        $folderPath = resource_path('views/pdf/user_' . $userId);

        if (!$force && file_exists($folderPath)) {
            $this->warn("Folder already exists for user {$userId}. Use --force to recreate.");
            return 1;
        }

        if (PdfMergeService::createUserFolder($userId)) {
            $this->info("✓ Created PDF folder for user: {$user->name} (ID: {$userId})");
            return 0;
        } else {
            $this->error("✗ Failed to create folder for user: {$user->name} (ID: {$userId})");
            return 1;
        }
    }

    /**
     * Create folders for all users
     *
     * @param bool $force
     * @return int
     */
    private function createAllUserFolders($force)
    {
        $users = User::all();
        $totalUsers = $users->count();

        if ($totalUsers === 0) {
            $this->warn('No users found in the database.');
            return 1;
        }

        $this->info("Creating PDF folders for {$totalUsers} users...");
        $this->output->progressStart($totalUsers);

        $successCount = 0;
        $skippedCount = 0;
        $failedCount = 0;

        foreach ($users as $user) {
            $folderPath = resource_path('views/pdf/user_' . $user->id);

            // Skip if folder exists and not forcing
            if (!$force && file_exists($folderPath)) {
                $skippedCount++;
                $this->output->progressAdvance();
                continue;
            }

            // Create folder
            if (PdfMergeService::createUserFolder($user->id)) {
                $successCount++;
            } else {
                $failedCount++;
                $this->newLine();
                $this->error("Failed to create folder for user: {$user->name} (ID: {$user->id})");
            }

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();

        // Summary
        $this->newLine();
        $this->info("===== Summary =====");
        $this->info("Total users: {$totalUsers}");
        $this->info("Successfully created: {$successCount}");
        
        if ($skippedCount > 0) {
            $this->warn("Skipped (already exist): {$skippedCount}");
        }
        
        if ($failedCount > 0) {
            $this->error("Failed: {$failedCount}");
        }

        return $failedCount > 0 ? 1 : 0;
    }
}