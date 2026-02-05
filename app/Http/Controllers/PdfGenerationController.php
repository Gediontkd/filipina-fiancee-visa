<?php
// app/Http/Controllers/PdfGenerationController.php (WITH PAYMENT VERIFICATION)

namespace App\Http\Controllers;

use App\Services\PdfMergeService;
use App\Helpers\PdfControlHelper;
use App\Helpers\PaymentHelper;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PdfGenerationController extends Controller
{
    protected PdfMergeService $pdfService;

    public function __construct(PdfMergeService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    /**
     * Generate PDF for USER (with payment check)
     */
    public function generateUserPdf()
    {
        try {
            $user = Auth::user();
            
            // CHECK 1: Payment Status
            $paymentStatus = PaymentHelper::checkPaymentStatus($user->id);
            
            if (!$paymentStatus['has_paid']) {
                Log::info('PDF download blocked - Payment required', [
                    'user_id' => $user->id,
                    'amount' => $paymentStatus['amount']
                ]);

                return redirect()->route('payment.index')
                    ->with('error', 'Payment required to download PDF package.')
                    ->with('payment_amount', $paymentStatus['amount'])
                    ->with('application_id', $paymentStatus['application_id']);
            }

            // CHECK 2: PDF Files Available
            if (!PdfControlHelper::canGeneratePdf($user->id)) {
                $status = PdfControlHelper::checkPdfStatus($user->id);
                return back()->with('error', $status['message']);
            }
            // All checks passed - Generate PDF
            $this->pdfService->setUserId($user->id);
            $pdfCount = $this->pdfService->getPdfCount();
            
            Log::info('User PDF Generation Started', [
                'user_id' => $user->id,
                'pdf_count' => $pdfCount,
                'payment_verified' => true
            ]);

            $result = $this->pdfService->mergePdfs($user->name);

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            Log::info('User PDF Generated Successfully', [
                'user_id' => $user->id,
                'filename' => $result['filename'],
                'file_count' => $result['file_count']
            ]);

            return response()
                ->download($result['path'], $result['filename'])
                ->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('User PDF Generation Failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Failed to generate PDF. Please contact support.');
        }
    }

    /**
     * Generate PDF for ADMIN (no payment check)
     */
    public function generateAdminPdf(UserSubmittedApplication $application)
    {
        try {
            $userId = $application->user_id;

            if (!PdfControlHelper::canGeneratePdf($userId)) {
                $status = PdfControlHelper::checkPdfStatus($userId);
                return back()->with('error', $status['message']);
            }

            $this->pdfService->setUserId($userId);
            $pdfCount = $this->pdfService->getPdfCount();
            
            Log::info('Admin PDF Generation Started', [
                'admin_id' => Auth::id(),
                'application_id' => $application->id,
                'user_id' => $userId,
                'pdf_count' => $pdfCount
            ]);

            $result = $this->pdfService->mergePdfs($application->user->name);

            if (!$result['success']) {
                return back()->with('error', $result['message']);
            }

            Log::info('Admin PDF Generated Successfully', [
                'admin_id' => Auth::id(),
                'application_id' => $application->id,
                'filename' => $result['filename'],
                'file_count' => $result['file_count']
            ]);

            return response()
                ->download($result['path'], $result['filename'])
                ->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            Log::error('Admin PDF Generation Failed', [
                'admin_id' => Auth::id(),
                'application_id' => $application->id,
                'error' => $e->getMessage()
            ]);

            return back()->with('error', 'Failed to generate PDF.');
        }
    }

    /**
     * Check PDF and Payment status for AJAX
     */
    public function checkPdfStatus()
    {
        try {
            $userId = Auth::id();
            
            // Check payment first
            $paymentStatus = PaymentHelper::checkPaymentStatus($userId);
            
            if (!$paymentStatus['has_paid']) {
                return response()->json([
                    'can_generate' => false,
                    'payment_required' => true,
                    'payment_amount' => $paymentStatus['amount'],
                    'pdf_count' => 0,
                    'message' => 'Payment of $' . number_format($paymentStatus['amount'], 2) . ' required to download PDF package.',
                ]);
            }

            // Payment completed - check PDFs
            $pdfStatus = PdfControlHelper::checkPdfStatus($userId);
            $pdfStatus['payment_required'] = false;
            $pdfStatus['has_paid'] = true;
            
            return response()->json($pdfStatus);
            
        } catch (\Exception $e) {
            return response()->json([
                'can_generate' => false,
                'payment_required' => false,
                'pdf_count' => 0,
                'message' => 'Error checking status'
            ]);
        }
    }
}