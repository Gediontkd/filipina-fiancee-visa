<?php
// app/Http/Controllers/PdfGenerationController.php

namespace App\Http\Controllers;

use App\Services\PdfMergeService;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Controller for generating and merging PDF documents from user-specific folders
 */
class PdfGenerationController extends Controller
{
    protected PdfMergeService $pdfService;

    public function __construct(PdfMergeService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * Generate and download merged PDF for authenticated user
     * 
     * @return \Illuminate\Http\Response
     */
    public function generateUserPdf()
    {
        try {
            $user = Auth::user();
            
            // Check if PDF generation is enabled
            if (!$this->pdfService->isPdfGenerationEnabled()) {
                return back()->with('error', 'PDF generation is currently disabled. Please contact support.');
            }
            
            // Set user ID for the service
            $this->pdfService->setUserId($user->id);
            
            // Check if PDFs exist
            if (!$this->pdfService->hasPdfFiles()) {
                return back()->with('error', 'No PDF files available for generation. PDFs will be available after admin review.');
            }

            // Merge PDFs
            $result = $this->pdfService->mergePdfs($user->name);

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            // Log the generation
            Log::info('User PDF generated', [
                'user_id' => $user->id,
                'filename' => $result['filename'],
                'file_count' => $result['file_count']
            ]);

            // Download file and delete after sending
            return response()
                ->download($result['path'], $result['filename'])
                ->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('User PDF generation failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Failed to generate PDF. Please try again or contact support.');
        }
    }

    /**
     * Generate and download merged PDF for admin viewing
     * 
     * @param UserSubmittedApplication $application
     * @return \Illuminate\Http\Response
     */
    public function generateAdminPdf(UserSubmittedApplication $application)
    {
        try {
            // Check if PDF generation is enabled
            if (!$this->pdfService->isPdfGenerationEnabled()) {
                return back()->with('error', 'PDF generation is currently disabled.');
            }

            // Set user ID for the service
            $this->pdfService->setUserId($application->user_id);
            
            // Check if PDFs exist
            if (!$this->pdfService->hasPdfFiles()) {
                return back()->with('error', 'No PDF files available for this application yet.');
            }

            // Merge PDFs with applicant name
            $result = $this->pdfService->mergePdfs($application->user->name);

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            // Log the generation
            Log::info('Admin PDF generated', [
                'admin_id' => Auth::id(),
                'application_id' => $application->id,
                'user_id' => $application->user_id,
                'filename' => $result['filename'],
                'file_count' => $result['file_count']
            ]);

            // Download file and delete after sending
            return response()
                ->download($result['path'], $result['filename'])
                ->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('Admin PDF generation failed', [
                'admin_id' => Auth::id(),
                'application_id' => $application->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Failed to generate PDF. Please try again.');
        }
    }

    /**
     * Get PDF status (for AJAX checks)
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkPdfStatus()
    {
        try {
            $user = Auth::user();
            $this->pdfService->setUserId($user->id);
            
            return response()->json([
                'enabled' => $this->pdfService->isPdfGenerationEnabled(),
                'available' => $this->pdfService->hasPdfFiles(),
                'count' => $this->pdfService->getPdfCount()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'enabled' => false,
                'available' => false,
                'count' => 0,
                'error' => 'Unable to check PDF status'
            ]);
        }
    }
}