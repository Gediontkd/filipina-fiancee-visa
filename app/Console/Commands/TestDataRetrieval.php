<?php
// app/Console/Commands/TestDataRetrieval.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\UserSubmittedApplication;
use App\Services\ApplicationDataService;

class TestDataRetrieval extends Command
{
    protected $signature = 'test:data {user_id}';
    protected $description = 'Test data retrieval for a user';

    public function handle()
    {
        $userId = $this->argument('user_id');
        
        $this->info("Testing data retrieval for user ID: {$userId}");
        $this->newLine();

        // Get application
        $application = UserSubmittedApplication::where('user_id', $userId)->latest()->first();
        
        if (!$application) {
            $this->error('No application found for this user!');
            return 1;
        }

        $this->info("Application ID: {$application->id}");
        $this->info("Type: {$application->visaApplication->name}");
        $this->newLine();

        // Get data
        $service = new ApplicationDataService();
        $data = $service->collectApplicationData($application);

        // Show results
        $this->info('=== COLLECTED DATA ===');
        $this->info(json_encode($data, JSON_PRETTY_PRINT));
        $this->newLine();

        // Check form_data
        if (empty($data['form_data'])) {
            $this->error('❌ form_data is EMPTY!');
        } else {
            $this->info('✓ form_data has content');
            
            foreach ($data['form_data'] as $section => $sectionData) {
                $count = is_array($sectionData) ? count($sectionData) : 0;
                $this->info("  - {$section}: {$count} records");
            }
        }

        return 0;
    }
}