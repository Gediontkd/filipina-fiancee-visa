<?php
// app/Http/Controllers/StripeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\PaymentHelper;
use App\Models\UserSubmittedApplication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class StripeController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(config('services.stripe.secret'));
    }

    /**
     * Show payment page
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get payment status
        $paymentStatus = PaymentHelper::checkPaymentStatus($user->id);
        
        // If already paid, redirect back
        if ($paymentStatus['has_paid']) {
            return redirect()->route('user.page', 'progress')
                ->with('success', 'Payment already completed!');
        }

        $application = UserSubmittedApplication::find($paymentStatus['application_id']);
        
        return view('web.payment.index', [
            'amount' => $paymentStatus['amount'],
            'application' => $application,
            'stripeKey' => config('services.stripe.key'),
        ]);
    }

    /**
     * Create Stripe checkout session
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            
            // Get payment details
            $paymentStatus = PaymentHelper::checkPaymentStatus($user->id);
            
            if ($paymentStatus['has_paid']) {
                return response()->json([
                    'success' => false,
                    'message' => 'Payment already completed',
                ]);
            }

            $application = UserSubmittedApplication::find($paymentStatus['application_id']);
            
            // Create Stripe Checkout Session
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'PDF Package - ' . $application->visaApplication->name,
                            'description' => 'Complete application package download',
                        ],
                        'unit_amount' => $paymentStatus['amount'] * 100, // Convert to cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success', ['session_id' => '{CHECKOUT_SESSION_ID}']),
                'cancel_url' => route('payment.cancel'),
                'client_reference_id' => $application->id,
                'customer_email' => $user->email,
                'metadata' => [
                    'user_id' => $user->id,
                    'application_id' => $application->id,
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
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment initialization failed: ' . $e->getMessage(),
            ]);
        }
    }

    /**
     * Payment success callback
     */
    public function success(Request $request)
    {
        try {
            $sessionId = $request->get('session_id');
            
            if (!$sessionId) {
                return redirect()->route('user.page', 'progress')
                    ->with('error', 'Invalid payment session');
            }

            // Retrieve session from Stripe
            $session = StripeSession::retrieve($sessionId);
            
            if ($session->payment_status === 'paid') {
                // Mark application as paid
                $applicationId = $session->client_reference_id;
                $paymentIntentId = $session->payment_intent;
                $amount = $session->amount_total / 100;

                PaymentHelper::markAsPaid($applicationId, $paymentIntentId, $amount);

                return redirect()->route('user.page', 'progress')
                    ->with('success', 'Payment successful! You can now download your PDF package.');
            }

            return redirect()->route('payment.index')
                ->with('error', 'Payment not completed');

        } catch (\Exception $e) {
            Log::error('Payment success handling failed', [
                'session_id' => $request->get('session_id'),
                'error' => $e->getMessage(),
            ]);

            return redirect()->route('user.page', 'progress')
                ->with('error', 'Payment verification failed');
        }
    }

    /**
     * Payment cancelled
     */
    public function cancel()
    {
        return redirect()->route('user.page', 'progress')
            ->with('error', 'Payment cancelled. You can try again when ready.');
    }
}