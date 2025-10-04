<?php
// app/Console/Commands/CleanupTempPdfsCommand.php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\PdfMergeService;

/**
 * Cleanup old temporary PDF files
 * Can be scheduled to run daily via Laravel's task scheduler
 */
class CleanupTempPdfsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pdf:cleanup-temp 
                            {--hours=24 : Age in hours for files to be considered old}
                            {--dry-run : Show what would be deleted without actually deleting}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean up old temporary PDF files';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $hours = (int) $this->option('hours');
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->info("DRY RUN MODE - No files will be deleted");
        }

        $this->info("Cleaning up temporary PDF files older than {$hours} hours...");

        try {
            if ($dryRun) {
                $count = $this->countOldFiles($hours);
                $this->info("Would delete {$count} file(s)");
            } else {
                $count = PdfMergeService::cleanupTempFiles($hours);
                $this->info("Successfully deleted {$count} file(s)");
            }

            return 0;
        } catch (\Exception $e) {
            $this->error("Cleanup failed: " . $e->getMessage());
            return 1;
        }
    }

    /**
     * Count files that would be deleted (for dry run)
     *
     * @param int $hours
     * @return int
     */
    private function countOldFiles($hours)
    {
        $tempPath = storage_path('app/temp');
        
        if (!file_exists($tempPath)) {
            return 0;
        }

        $files = \File::files($tempPath);
        $count = 0;
        $cutoffTime = now()->subHours($hours)->timestamp;

        foreach ($files as $file) {
            if (\File::lastModified($file) < $cutoffTime) {
                $count++;
            }
        }

        return $count;
    }
}