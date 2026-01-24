<?php
// app/Helpers/PdfControlHelper.php (Control PDF Button Access)

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class PdfControlHelper
{
    /**
     * Check if user can generate PDF
     *
     * @param int $userId
     * @return array
     */
    public static function checkPdfStatus(int $userId): array
    {
        $userPdfPath = resource_path('views/pdf/user_' . $userId);
        
        // Check folder exists
        if (!File::exists($userPdfPath)) {
            return [
                'can_generate' => false,
                'pdf_count' => 0,
                'pdf_files' => [],
                'message' => 'PDF folder not ready. Contact support.',
            ];
        }

        // Get ALL PDF files
        $pdfFiles = File::glob($userPdfPath . '/*.pdf');
        $pdfCount = count($pdfFiles);

        // Get file names
        $fileNames = array_map('basename', $pdfFiles);

        if ($pdfCount === 0) {
            return [
                'can_generate' => false,
                'pdf_count' => 0,
                'pdf_files' => [],
                'message' => 'No package is ready yet — it’s still being processed.',
            ];
        }

        // PDFs are ready!
        return [
            'can_generate' => true,
            'pdf_count' => $pdfCount,
            'pdf_files' => $fileNames,
            'message' => "Package download.",
        ];
    }

    /**
     * Verify PDFs before generation (called before download)
     *
     * @param int $userId
     * @param int $minPdfCount Minimum PDFs required (default: 1)
     * @return bool
     */
    public static function canGeneratePdf(int $userId, int $minPdfCount = 1): bool
    {
        $status = self::checkPdfStatus($userId);
        
        Log::info('PDF Generation Check', [
            'user_id' => $userId,
            'can_generate' => $status['can_generate'],
            'pdf_count' => $status['pdf_count'],
            'min_required' => $minPdfCount
        ]);

        return $status['can_generate'] && $status['pdf_count'] >= $minPdfCount;
    }

    /**
     * Get detailed PDF information
     *
     * @param int $userId
     * @return array
     */
    public static function getPdfDetails(int $userId): array
    {
        $userPdfPath = resource_path('views/pdf/user_' . $userId);
        
        if (!File::exists($userPdfPath)) {
            return [];
        }

        $pdfFiles = File::glob($userPdfPath . '/*.pdf');
        $details = [];

        foreach ($pdfFiles as $file) {
            $details[] = [
                'name' => basename($file),
                'size' => File::size($file),
                'size_formatted' => self::formatBytes(File::size($file)),
                'modified' => File::lastModified($file),
            ];
        }

        return $details;
    }

    /**
     * Format bytes to human readable
     *
     * @param int $bytes
     * @return string
     */
    private static function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $i = 0;
        
        while ($bytes > 1024 && $i < count($units) - 1) {
            $bytes /= 1024;
            $i++;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }
}