<?php
// app/Services/PdfMergeService.php (FIXED - Merges ALL PDFs)

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Service for managing and merging user-specific PDF files
 * FIXED: Now properly merges ALL PDFs in user folder
 */
class PdfMergeService
{
    private string $basePdfPath;
    private ?int $userId;

    public function __construct()
    {
        $this->basePdfPath = resource_path('views/pdf');
        $this->userId = Auth::id();
    }

    /**
     * Set user ID manually (for admin usage)
     *
     * @param int $userId
     * @return self
     */
    public function setUserId(int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * Get the user-specific PDF directory path
     *
     * @return string
     */
    public function getUserPdfDirectory(): string
    {
        if (!$this->userId) {
            throw new \Exception('User ID not set');
        }

        return $this->basePdfPath . '/user_' . $this->userId;
    }

    /**
     * Create user-specific PDF folder
     *
     * @param int $userId
     * @return bool
     */
    public static function createUserFolder(int $userId): bool
    {
        try {
            $folderPath = resource_path('views/pdf/user_' . $userId);
            
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
                
                // Create a .gitkeep file to ensure folder is tracked
                File::put($folderPath . '/.gitkeep', '');
                
                Log::info('Created PDF folder for user', ['user_id' => $userId, 'path' => $folderPath]);
                return true;
            }
            
            return true;
        } catch (\Exception $e) {
            Log::error('Failed to create user PDF folder', [
                'user_id' => $userId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Check if PDF generation is enabled in configuration
     *
     * @return bool
     */
    public function isPdfGenerationEnabled(): bool
    {
        return config('app.pdf_generation_enabled', true);
    }

    /**
     * Check if user has any PDF files
     *
     * @return bool
     */
    public function hasPdfFiles(): bool
    {
        try {
            $userDir = $this->getUserPdfDirectory();
            
            if (!File::exists($userDir)) {
                return false;
            }

            $pdfFiles = File::glob($userDir . '/*.pdf');
            return count($pdfFiles) > 0;
        } catch (\Exception $e) {
            Log::error('Error checking PDF files', [
                'user_id' => $this->userId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Get count of PDF files in user directory
     *
     * @return int
     */
    public function getPdfCount(): int
    {
        try {
            $userDir = $this->getUserPdfDirectory();
            
            if (!File::exists($userDir)) {
                return 0;
            }

            $pdfFiles = File::glob($userDir . '/*.pdf');
            return count($pdfFiles);
        } catch (\Exception $e) {
            Log::error('Error counting PDF files', [
                'user_id' => $this->userId,
                'error' => $e->getMessage()
            ]);
            return 0;
        }
    }

    /**
     * Get list of PDF files in user directory
     *
     * @return array
     */
    public function getPdfFiles(): array
    {
        try {
            $userDir = $this->getUserPdfDirectory();
            
            if (!File::exists($userDir)) {
                return [];
            }

            $pdfFiles = File::glob($userDir . '/*.pdf');
            
            // Sort files alphabetically
            sort($pdfFiles);
            
            return $pdfFiles;
        } catch (\Exception $e) {
            Log::error('Error getting PDF files', [
                'user_id' => $this->userId,
                'error' => $e->getMessage()
            ]);
            return [];
        }
    }

    /**
     * Merge all PDFs in user directory
     * FIXED: Now properly merges ALL PDFs
     *
     * @param string $applicantName
     * @return array Result with success status and file information
     */
    public function mergePdfs(string $applicantName): array
    {
        try {
            if (!$this->isPdfGenerationEnabled()) {
                return [
                    'success' => false,
                    'message' => 'PDF generation is currently disabled.',
                ];
            }

            $pdfFiles = $this->getPdfFiles();

            if (empty($pdfFiles)) {
                return [
                    'success' => false,
                    'message' => 'No PDF files found to merge.',
                ];
            }

            Log::info('Starting PDF merge', [
                'user_id' => $this->userId,
                'file_count' => count($pdfFiles),
                'files' => array_map('basename', $pdfFiles)
            ]);

            // If only one PDF, return it directly
            if (count($pdfFiles) === 1) {
                return $this->prepareSinglePdf($pdfFiles[0], $applicantName);
            }

            // FIXED: Merge multiple PDFs properly
            return $this->mergeMultiplePdfs($pdfFiles, $applicantName);

        } catch (\Exception $e) {
            Log::error('PDF merge failed', [
                'user_id' => $this->userId,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to generate PDF: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Prepare single PDF file for download
     *
     * @param string $pdfPath
     * @param string $applicantName
     * @return array
     */
    private function prepareSinglePdf(string $pdfPath, string $applicantName): array
    {
        $filename = $this->generateFilename($applicantName, 1);
        $tempPath = storage_path('app/temp/' . $filename);

        // Create temp directory if it doesn't exist
        if (!File::exists(dirname($tempPath))) {
            File::makeDirectory(dirname($tempPath), 0755, true);
        }

        // Copy file to temp location
        File::copy($pdfPath, $tempPath);

        return [
            'success' => true,
            'path' => $tempPath,
            'filename' => $filename,
            'file_count' => 1,
            'message' => 'PDF package generated successfully.',
        ];
    }

    /**
     * Merge multiple PDF files
     * FIXED: Now properly merges ALL PDFs using pdftk
     *
     * @param array $pdfFiles
     * @param string $applicantName
     * @return array
     */
    private function mergeMultiplePdfs(array $pdfFiles, string $applicantName): array
    {
        $filename = $this->generateFilename($applicantName, count($pdfFiles));
        $outputPath = storage_path('app/temp/' . $filename);

        // Create temp directory if it doesn't exist
        if (!File::exists(dirname($outputPath))) {
            File::makeDirectory(dirname($outputPath), 0755, true);
        }

        // FIXED: Try using pdftk with ALL files
        if ($this->isPdftkAvailable()) {
            $result = $this->mergeWithPdftk($pdfFiles, $outputPath);
            if ($result) {
                Log::info('PDFs merged successfully with pdftk', [
                    'user_id' => $this->userId,
                    'file_count' => count($pdfFiles),
                    'output' => $filename
                ]);

                return [
                    'success' => true,
                    'path' => $outputPath,
                    'filename' => $filename,
                    'file_count' => count($pdfFiles),
                    'message' => 'PDF package with ' . count($pdfFiles) . ' files generated successfully.',
                ];
            }
        }

        // FIXED: Fallback - Create ZIP file with all PDFs if pdftk not available
        Log::warning('pdftk not available, creating ZIP archive instead', [
            'user_id' => $this->userId
        ]);

        return $this->createZipArchive($pdfFiles, $applicantName);
    }

    /**
     * Check if pdftk is available
     *
     * @return bool
     */
    private function isPdftkAvailable(): bool
    {
        $output = [];
        $returnVar = 0;
        @exec('pdftk --version 2>&1', $output, $returnVar);
        return $returnVar === 0;
    }

    /**
     * Merge PDFs using pdftk command
     * FIXED: Now properly handles ALL input files
     *
     * @param array $pdfFiles
     * @param string $outputPath
     * @return bool
     */
    private function mergeWithPdftk(array $pdfFiles, string $outputPath): bool
    {
        try {
            // Escape all file paths properly
            $escapedFiles = array_map(function($file) {
                return escapeshellarg($file);
            }, $pdfFiles);

            $filesString = implode(' ', $escapedFiles);
            
            // Build pdftk command to merge ALL files
            $command = sprintf(
                'pdftk %s cat output %s 2>&1',
                $filesString,
                escapeshellarg($outputPath)
            );

            Log::info('Executing pdftk command', [
                'user_id' => $this->userId,
                'file_count' => count($pdfFiles),
                'command' => $command
            ]);

            $output = [];
            $returnVar = 0;
            exec($command, $output, $returnVar);

            if ($returnVar === 0 && File::exists($outputPath)) {
                Log::info('pdftk merge successful', [
                    'user_id' => $this->userId,
                    'output_size' => File::size($outputPath)
                ]);
                return true;
            }

            Log::warning('pdftk merge failed', [
                'user_id' => $this->userId,
                'command' => $command,
                'output' => $output,
                'return_code' => $returnVar
            ]);

            return false;
        } catch (\Exception $e) {
            Log::error('pdftk execution error', [
                'user_id' => $this->userId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Create ZIP archive with all PDFs (fallback when pdftk not available)
     *
     * @param array $pdfFiles
     * @param string $applicantName
     * @return array
     */
    private function createZipArchive(array $pdfFiles, string $applicantName): array
    {
        try {
            $sanitizedName = preg_replace('/[^A-Za-z0-9_-]/', '_', $applicantName);
            $timestamp = date('Y-m-d_His');
            $zipFilename = "Application_Package_{$sanitizedName}_{$timestamp}.zip";
            $zipPath = storage_path('app/temp/' . $zipFilename);

            $zip = new \ZipArchive();
            
            if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== true) {
                throw new \Exception('Could not create ZIP archive');
            }

            // Add all PDFs to ZIP
            foreach ($pdfFiles as $index => $pdfPath) {
                $filename = basename($pdfPath);
                $zip->addFile($pdfPath, $filename);
            }

            $zip->close();

            Log::info('ZIP archive created successfully', [
                'user_id' => $this->userId,
                'file_count' => count($pdfFiles),
                'zip_size' => File::size($zipPath)
            ]);

            return [
                'success' => true,
                'path' => $zipPath,
                'filename' => $zipFilename,
                'file_count' => count($pdfFiles),
                'message' => 'PDF package created as ZIP archive with ' . count($pdfFiles) . ' files (pdftk not available for merging).',
            ];

        } catch (\Exception $e) {
            Log::error('ZIP archive creation failed', [
                'user_id' => $this->userId,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Failed to create PDF package: ' . $e->getMessage(),
            ];
        }
    }

    /**
     * Generate filename for merged PDF
     *
     * @param string $applicantName
     * @param int $fileCount
     * @return string
     */
    private function generateFilename(string $applicantName, int $fileCount): string
    {
        $sanitizedName = preg_replace('/[^A-Za-z0-9_-]/', '_', $applicantName);
        $timestamp = date('Y-m-d_His');
        
        return sprintf(
            'Application_Package_%s_%dfiles_%s.pdf',
            $sanitizedName,
            $fileCount,
            $timestamp
        );
    }

    /**
     * Clean up old temporary files
     *
     * @param int $hoursOld
     * @return int Number of files deleted
     */
    public static function cleanupTempFiles(int $hoursOld = 24): int
    {
        try {
            $tempPath = storage_path('app/temp');
            
            if (!File::exists($tempPath)) {
                return 0;
            }

            $files = File::files($tempPath);
            $deleted = 0;
            $cutoffTime = now()->subHours($hoursOld)->timestamp;

            foreach ($files as $file) {
                if (File::lastModified($file) < $cutoffTime) {
                    File::delete($file);
                    $deleted++;
                }
            }

            return $deleted;
        } catch (\Exception $e) {
            Log::error('Temp file cleanup failed', ['error' => $e->getMessage()]);
            return 0;
        }
    }
}