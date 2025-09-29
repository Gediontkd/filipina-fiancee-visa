<?php
// app/Http/Controllers/PdfGenerationController.php

namespace App\Http\Controllers;

use App\Services\PdfMergeService;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Controller for generating and merging PDF documents
 */
class PdfGenerationController extends Controller
{
    protected PdfMergeService $pdfService;

    public function __construct(PdfMergeService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * Generate and download merged PDF for user
     * 
     * @return \Illuminate\Http\Response
     */
    public function generateUserPdf()
    {
        try {
            $user = Auth::user();
            
            // Check if PDFs exist
            if (!$this->pdfService->hasPdfFiles()) {
                return back()->with('error', 'No PDF files available for generation.');
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

            // Download file
            return response()->download($result['path'], $result['filename'])->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('User PDF generation failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Failed to generate PDF. Please try again or contact support.');
        }
    }

    /**
     * Generate and download merged PDF for admin
     * 
     * @param UserSubmittedApplication $application
     * @return \Illuminate\Http\Response
     */
    public function generateAdminPdf(UserSubmittedApplication $application)
    {
        try {
            // Check if PDFs exist
            if (!$this->pdfService->hasPdfFiles()) {
                return back()->with('error', 'No PDF files available for generation.');
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

            // Download file
            return response()->download($result['path'], $result['filename'])->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('Admin PDF generation failed', [
                'admin_id' => Auth::id(),
                'application_id' => $application->id,
                'error' => $e->getMessage()
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
        return response()->json([
            'available' => $this->pdfService->hasPdfFiles(),
            'count' => $this->pdfService->getPdfCount()
        ]);
    }
}