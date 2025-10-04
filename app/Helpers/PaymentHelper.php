<?php
// app/Helpers/PaymentHelper.php

namespace App\Helpers;

use App\Models\UserSubmittedApplication;
use Illuminate\Support\Facades\Log;

class PaymentHelper
{
    /**
     * Check if user has paid for their application
     *
     * @param int $userId
     * @return array
     */
    public static function checkPaymentStatus(int $userId): array
    {
        $application = UserSubmittedApplication::where('user_id', $userId)
            ->latest()
            ->first();

        if (!$application) {
            return [
                'has_paid' => false,
                'payment_required' => false,
                'amount' => 0,
                'message' => 'No application found.',
            ];
        }

        // Check if payment is completed
        if ($application->payment_completed) {
            return [
                'has_paid' => true,
                'payment_required' => false,
                'amount' => $application->payment_amount,
                'paid_at' => $application->paid_at,
                'message' => 'Payment completed successfully.',
            ];
        }

        // Get payment amount based on application type
        $amount = self::getPaymentAmount($application->visaApplication->name);

        return [
            'has_paid' => false,
            'payment_required' => true,
            'amount' => $amount,
            'application_id' => $application->id,
            'message' => 'Payment required to download PDF package.',
        ];
    }

    /**
     * Get payment amount for application type
     *
     * @param string $applicationType
     * @return float
     */
    public static function getPaymentAmount(string $applicationType): float
    {
        $amounts = [
            'Fiance Visa' => 850.00,
            'Spouse Visa' => 750.00,
            'Adjustment of Status' => 800.00,
        ];

        foreach ($amounts as $type => $amount) {
            if (stripos($applicationType, $type) !== false) {
                return $amount;
            }
        }

        return 99.00; // Default amount
    }

    /**
     * Mark application as paid
     *
     * @param int $applicationId
     * @param string $paymentIntentId
     * @param float $amount
     * @return bool
     */
    public static function markAsPaid(int $applicationId, string $paymentIntentId, float $amount): bool
    {
        try {
            $application = UserSubmittedApplication::find($applicationId);
            
            if (!$application) {
                return false;
            }

            $application->update([
                'payment_completed' => true,
                'payment_intent_id' => $paymentIntentId,
                'payment_amount' => $amount,
                'paid_at' => now(),
            ]);

            Log::info('Application marked as paid', [
                'application_id' => $applicationId,
                'payment_intent_id' => $paymentIntentId,
                'amount' => $amount,
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Failed to mark application as paid', [
                'application_id' => $applicationId,
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}