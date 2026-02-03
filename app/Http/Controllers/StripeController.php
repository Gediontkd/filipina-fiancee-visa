<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\PaymentHelper;
use App\Models\User;
use App\Models\UserSubmittedApplication;
use App\Services\ApplicationDataService;
use App\Mail\ApplicationSubmittedMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripeController extends Controller
{
    protected ApplicationDataService $dataService;

    public function __construct(ApplicationDataService $dataService)
    {
        Stripe::setApiKey(config('services.stripe.secret'));
        $this->dataService = $dataService;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $paymentStatus = PaymentHelper::checkPaymentStatus($user->id);
        
        if ($paymentStatus['has_paid']) {
            return redirect()->route('user.page', 'progress')
                ->with('success', 'Payment already completed!');
        }

        $application = UserSubmittedApplication::with('visaApplication')->find($paymentStatus['application_id']);

        if (!$application || !$application->visaApplication) {
            return redirect()->route('user.page', 'progress')
                ->with('error', 'Application configuration error. Please contact support.');
        }

        return view('web.payment.index', [
            'amount' => $paymentStatus['amount'],
            'application' => $application,
            'stripeKey' => config('services.stripe.key'),
        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $paymentStatus = PaymentHelper::checkPaymentStatus($user->id);
            
            if ($paymentStatus['has_paid']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment already completed',
                ]);
            }

            $application = UserSubmittedApplication::with('visaApplication')->find($paymentStatus['application_id']);

            if (!$application || !$application->visaApplication) {
                Log::error('Application or visa application not found', [
                    'application_id' => $paymentStatus['application_id'],
                    'application_exists' => $application ? true : false,
                    'visa_application_exists' => $application && $application->visaApplication ? true : false,
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Application configuration error. Please contact support.',
                ]);
            }

            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Full Service Package - ' . $application->visaApplication->name,
                            'description' => 'Complete immigration application service including expert review, PDF generation, and support',
                        ],
                        'unit_amount' => $paymentStatus['amount'] * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success') . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('payment.cancel'),
                'client_reference_id' => (string)$application->id,
                'customer_email' => $user->email,
                'metadata' => [
                    'user_id' => (string)$user->id,
                    'application_id' => (string)$application->id,
                    'auto_submit' => 'true', // Flag for auto-submission
                ],
            ]);

            return response()->json([
                'success' => true,
                'sessionId' => $session->id,
            ]);

        } catch (\Exception $e) {
            Log::error('Stripe session creation failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment initialization failed: ' . $e->getMessage(),
            ]);
        }
    }

    
    public function success(Request $request)
    {
        try {
            $sessionId = $request->get('session_id');
            
            Log::info('Payment success callback received', [
                'session_id' => $sessionId,
            ]);

            if (!$sessionId) {
                Log::error('No session ID in payment success callback');
                return redirect()->route('user.page', 'progress')
                    ->with('error', 'Invalid payment session');
            }

            // Retrieve session from Stripe
            $session = StripeSession::retrieve($sessionId);
            
            Log::info('Stripe session retrieved', [
                'session_id' => $sessionId,
                'payment_status' => $session->payment_status,
            ]);

            if ($session->payment_status === 'paid') {
                $applicationId = $session->client_reference_id;
                $paymentIntentId = $session->payment_intent;
                $amount = $session->amount_total / 100;

                DB::beginTransaction();

                try {
                    // Mark payment as complete
                    Log::info('Marking application as paid', [
                        'application_id' => $applicationId,
                        'payment_intent_id' => $paymentIntentId,
                    ]);

                    $paymentResult = PaymentHelper::markAsPaid($applicationId, $paymentIntentId, $amount);

                    if (!$paymentResult) {
                        throw new \Exception('Failed to mark payment');
                    }

                    // AUTO-SUBMIT APPLICATION
                    $submission = UserSubmittedApplication::findOrFail($applicationId);
                    
                    Log::info('Auto-submitting application after payment', [
                        'application_id' => $applicationId,
                        'user_id' => $submission->user_id,
                    ]);

                    // Update submission status
                    $submission->update([
                        'transaction_id' => $this->generateTransactionId(),
                        'status' => 'submitted',
                        'submitted_at' => now(),
                    ]);

                    // Collect and email application data
                    $this->emailApplicationData($submission);

                    DB::commit();

                    Log::info('Application auto-submitted successfully', [
                        'application_id' => $applicationId,
                        'transaction_id' => $submission->transaction_id,
                    ]);

                    return redirect()->route('user.page', 'progress')
                        ->with('success', '🎉 Payment successful! Your application has been submitted for expert review. Our team will contact you within 2-3 business days.');

                } catch (\Exception $e) {
                    DB::rollback();
                    
                    Log::error('Auto-submission failed after payment', [
                        'application_id' => $applicationId,
                        'error' => $e->getMessage(),
                    ]);

                    // Payment succeeded but submission failed - notify user
                    return redirect()->route('user.page', 'progress')
                        ->with('warning', 'Payment received successfully, but there was an issue submitting your application. Please contact support or try submitting manually.');
                }
            }

            Log::warning('Payment not completed', ['payment_status' => $session->payment_status]);
            return redirect()->route('payment.index')
                ->with('error', 'Payment not completed. Status: ' . $session->payment_status);

        } catch (\Exception $e) {
            Log::error('Payment success handling failed', [
                'session_id' => $request->get('session_id'),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('user.page', 'progress')
                ->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    }

    /**
     * Email application data to admin
     */
    private function emailApplicationData($submission)
    {
        try {
            // Collect application data
            $applicationData = $this->dataService->collectApplicationData($submission);
            
            // Format as JSON
            $jsonData = $this->dataService->formatAsJson($applicationData);
            
            // Save JSON file temporarily
            $filename = sprintf(
                'application_%s_%s.json',
                $submission->transaction_id,
                date('Y-m-d_His')
            );
            $jsonFilePath = $this->dataService->saveJsonFile($jsonData, $filename);

            // Get user info
            $user = User::find($submission->user_id);

            // Send email with JSON attachment
            $adminEmail = config('mail.admin_email', 'Sam684751@gmail.com');

            Mail::to($adminEmail)->send(
                new ApplicationSubmittedMail(
                    $applicationData,
                    $jsonFilePath,
                    $user->name,
                    $submission->visaApplication ? $submission->visaApplication->name : 'Unknown'
                )
            );

            // Clean up temporary file
            if (File::exists($jsonFilePath)) {
                File::delete($jsonFilePath);
            }

            Log::info('Application data emailed successfully', [
                'submission_id' => $submission->id,
                'transaction_id' => $submission->transaction_id,
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to email application data', [
                'submission_id' => $submission->id,
                'error' => $e->getMessage(),
            ]);
            // Don't throw - submission already succeeded
        }
    }

    /**
     * Generate unique transaction ID
     */
    private function generateTransactionId()
    {
        return 'APP-' . strtoupper(uniqid()) . '-' . time();
    }

    public function cancel()
    {
        return redirect()->route('user.page', 'progress')
            ->with('info', 'Payment cancelled. You can try again when ready.');
    }
}