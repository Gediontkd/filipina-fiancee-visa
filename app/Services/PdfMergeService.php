<?php
// app/Services/PdfMergeService.php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;

class PdfMergeService
{
    protected string $pdfDirectory;
    protected string $gsPath;

    public function __construct()
{
    $this->pdfDirectory = resource_path('views/pdf');
    
    // Auto-detect Ghostscript path based on OS
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        // Windows
        $this->gsPath = 'C:\\Program Files\\gs\\gs10.06.0\\bin\\gswin64c.exe';
    } else {
        // Linux/Unix - check common locations (prioritize apt over snap)
        $possiblePaths = [
            '/usr/bin/gs',           // apt installation (preferred)
            '/usr/local/bin/gs',
            'gs'                     // system PATH
        ];
        
        foreach ($possiblePaths as $path) {
            if ($path === 'gs' || file_exists($path)) {
                $this->gsPath = $path;
                break;
            }
        }
    }
}

    public function getPdfFiles(): array
    {
        if (!File::exists($this->pdfDirectory)) {
            Log::warning("PDF directory does not exist: {$this->pdfDirectory}");
            return [];
        }

        $files = File::files($this->pdfDirectory);
        $pdfFiles = [];

        foreach ($files as $file) {
            if (strtolower($file->getExtension()) === 'pdf') {
                $pdfFiles[] = $file->getPathname();
            }
        }

        // Sort files naturally (1.pdf, 2.pdf, ... 10.pdf, 11.pdf)
        usort($pdfFiles, function($a, $b) {
            return strnatcmp(basename($a), basename($b));
        });

        return $pdfFiles;
    }

    public function mergePdfs(?string $applicantName = null): array
    {
        try {
            // Check if Ghostscript is installed
            if (!File::exists($this->gsPath)) {
                return [
                    'success' => false,
                    'path' => null,
                    'filename' => null,
                    'message' => 'Ghostscript is not installed. Please install it from https://ghostscript.com/releases/gsdnld.html'
                ];
            }

            $files = $this->getPdfFiles();
            
            if (empty($files)) {
                return [
                    'success' => false,
                    'path' => null,
                    'filename' => null,
                    'message' => 'No PDF files found in the directory.'
                ];
            }

            Log::info('Starting PDF merge with Ghostscript', [
                'file_count' => count($files),
                'files' => array_map('basename', $files)
            ]);

            // Generate output filename
            $filename = $this->generateFilename($applicantName);
            $outputPath = storage_path('app/temp/' . $filename);
            
            // Create temp directory if needed
            if (!File::exists(storage_path('app/temp'))) {
                File::makeDirectory(storage_path('app/temp'), 0755, true);
            }

            // Prepare input files for command (properly escaped)
            $inputFiles = array_map(function($file) {
                return escapeshellarg($file);
            }, $files);

            // Build Ghostscript command
            $command = sprintf(
                '%s -dBATCH -dNOPAUSE -q -sDEVICE=pdfwrite -dPDFSETTINGS=/prepress -sOutputFile=%s %s 2>&1',
                escapeshellarg($this->gsPath),
                escapeshellarg($outputPath),
                implode(' ', $inputFiles)
            );
            
            Log::info("Executing Ghostscript command");
            
            // Execute command
            exec($command, $output, $returnCode);
            
            Log::info("Ghostscript execution completed", [
                'return_code' => $returnCode,
                'output' => $output
            ]);
            
            // Check if merge was successful
            if ($returnCode === 0 && File::exists($outputPath) && File::size($outputPath) > 0) {
                $fileSize = File::size($outputPath);
                
                Log::info('PDF merge successful', [
                    'output_file' => $filename,
                    'file_size' => $fileSize,
                    'source_files' => count($files)
                ]);
                
                return [
                    'success' => true,
                    'path' => $outputPath,
                    'filename' => $filename,
                    'message' => 'Successfully merged ' . count($files) . ' PDF files.',
                    'file_count' => count($files)
                ];
            }
            
            // If we get here, something went wrong
            $errorMsg = 'Failed to merge PDFs.';
            if (!empty($output)) {
                $errorMsg .= ' Output: ' . implode("\n", $output);
            }
            
            Log::error('PDF merge failed', [
                'return_code' => $returnCode,
                'output' => $output,
                'output_exists' => File::exists($outputPath),
                'output_size' => File::exists($outputPath) ? File::size($outputPath) : 0
            ]);
            
            return [
                'success' => false,
                'path' => null,
                'filename' => null,
                'message' => $errorMsg
            ];
            
        } catch (Exception $e) {
            Log::error('PDF merge exception', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'success' => false,
                'path' => null,
                'filename' => null,
                'message' => 'Failed to merge PDFs: ' . $e->getMessage()
            ];
        }
    }

    protected function generateFilename(?string $applicantName = null): string
    {
        $timestamp = now()->format('Y-m-d_His');
        $random = Str::random(6);
        
        if ($applicantName) {
            $sanitized = Str::slug($applicantName);
            return "K1_Petition_{$sanitized}_{$timestamp}_{$random}.pdf";
        }

        return "K1_Petition_Merged_{$timestamp}_{$random}.pdf";
    }

    public function cleanupTempFile(string $filePath): bool
    {
        if (File::exists($filePath)) {
            return File::delete($filePath);
        }
        
        return false;
    }

    public function getPdfCount(): int
    {
        return count($this->getPdfFiles());
    }

    public function hasPdfFiles(): bool
    {
        return $this->getPdfCount() > 0;
    }
}