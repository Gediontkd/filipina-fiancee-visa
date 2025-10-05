<?php
// app/Http/Controllers/StripeController.php (FIXED)

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

    public function index(Request $request)
    {
        $user = Auth::user();
        $paymentStatus = PaymentHelper::checkPaymentStatus($user->id);
        
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

            $application = UserSubmittedApplication::find($paymentStatus['application_id']);
            
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'PDF Package - ' . $application->visaApplication->name,
                            'description' => 'Complete application package download',
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

    /**
     * Payment success callback - FIXED
     */
    public function success(Request $request)
    {
        try {
            $sessionId = $request->get('session_id');
            
            Log::info('Payment success callback received', [
                'session_id' => $sessionId,
                'all_params' => $request->all()
            ]);

            if (!$sessionId) {
                Log::error('No session ID in payment success callback');
                return redirect()->route('user.page', 'progress')
                    ->with('error', 'Invalid payment session - no session ID');
            }

            // Retrieve session from Stripe
            $session = StripeSession::retrieve($sessionId);
            
            Log::info('Stripe session retrieved', [
                'session_id' => $sessionId,
                'payment_status' => $session->payment_status,
                'client_reference_id' => $session->client_reference_id
            ]);

            if ($session->payment_status === 'paid') {
                $applicationId = $session->client_reference_id;
                $paymentIntentId = $session->payment_intent;
                $amount = $session->amount_total / 100;

                Log::info('Marking application as paid', [
                    'application_id' => $applicationId,
                    'payment_intent_id' => $paymentIntentId,
                    'amount' => $amount
                ]);

                $result = PaymentHelper::markAsPaid($applicationId, $paymentIntentId, $amount);

                if ($result) {
                    return redirect()->route('user.page', 'progress')
                        ->with('success', 'Payment successful! You can now download your PDF package.');
                } else {
                    Log::error('Failed to mark application as paid');
                    return redirect()->route('user.page', 'progress')
                        ->with('error', 'Payment received but database update failed. Please contact support.');
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

    public function cancel()
    {
        return redirect()->route('user.page', 'progress')
            ->with('error', 'Payment cancelled. You can try again when ready.');
    }
}