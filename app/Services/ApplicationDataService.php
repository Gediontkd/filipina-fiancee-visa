<?php
// app/Services/ApplicationDataService.php

namespace App\Services;

use App\Models\User;
use App\Models\UserSubmittedApplication;
use App\Models\FianceVisaSubmittedStep;
use App\Models\SpouseVisaSubmittedStep;
use App\Models\AdjustmentVisaSubmittedStep;
use Illuminate\Support\Facades\Log;

/**
 * Service for collecting and formatting application data
 */
class ApplicationDataService
{
    /**
     * Collect all application data for a user
     *
     * @param UserSubmittedApplication $application
     * @return array
     */
    public function collectApplicationData(UserSubmittedApplication $application): array
    {
        $user = $application->user;
        $applicationType = $application->visaApplication->name;

        $data = [
            'application_info' => [
                'id' => $application->id,
                'transaction_id' => $application->transaction_id,
                'type' => $applicationType,
                'status' => $application->status,
                'submitted_at' => $application->created_at->toDateTimeString(),
            ],
            'user_info' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ],
        ];

        // Collect data based on application type
        if (stripos($applicationType, 'Fiance') !== false) {
            $data['form_data'] = $this->collectFianceVisaData($application);
        } elseif (stripos($applicationType, 'Spouse') !== false) {
            $data['form_data'] = $this->collectSpouseVisaData($application);
        } elseif (stripos($applicationType, 'Adjustment') !== false) {
            $data['form_data'] = $this->collectAdjustmentData($application);
        }

        return $data;
    }

    /**
     * Collect Fiance Visa application data
     *
     * @param UserSubmittedApplication $application
     * @return array
     */
    private function collectFianceVisaData(UserSubmittedApplication $application): array
    {
        $steps = FianceVisaSubmittedStep::where('user_id', $application->user_id)
            ->where('submitted_app_id', $application->id)
            ->get();

        $data = [
            'sponsor' => [],
            'alien' => [],
            'children' => [],
        ];

        foreach ($steps as $step) {
            $detail = $step->detail;
            
            if ($step->type === 'sponsor') {
                $data['sponsor'][$step->step] = $detail;
            } elseif ($step->type === 'alien') {
                $data['alien'][$step->step] = $detail;
            } elseif ($step->type === 'alien-children') {
                $data['children'][$step->step] = $detail;
            }
        }

        return $data;
    }

    /**
     * Collect Spouse Visa application data
     *
     * @param UserSubmittedApplication $application
     * @return array
     */
    private function collectSpouseVisaData(UserSubmittedApplication $application): array
    {
        $steps = SpouseVisaSubmittedStep::where('user_id', $application->user_id)
            ->where('submitted_app_id', $application->id)
            ->get();

        $data = [];

        foreach ($steps as $step) {
            $data[$step->step] = $step->detail;
        }

        return $data;
    }

    /**
     * Collect Adjustment of Status application data
     *
     * @param UserSubmittedApplication $application
     * @return array
     */
    private function collectAdjustmentData(UserSubmittedApplication $application): array
    {
        $steps = AdjustmentVisaSubmittedStep::where('user_id', $application->user_id)
            ->where('submitted_app_id', $application->id)
            ->get();

        $data = [];

        foreach ($steps as $step) {
            $data[$step->step] = $step->detail;
        }

        return $data;
    }

    /**
     * Format data as JSON
     *
     * @param array $data
     * @return string
     */
    public function formatAsJson(array $data): string
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Save JSON to temporary file
     *
     * @param string $jsonData
     * @param string $filename
     * @return string Path to file
     */
    public function saveJsonFile(string $jsonData, string $filename): string
    {
        $tempPath = storage_path('app/temp');
        
        if (!file_exists($tempPath)) {
            mkdir($tempPath, 0755, true);
        }

        $filePath = $tempPath . '/' . $filename;
        file_put_contents($filePath, $jsonData);

        return $filePath;
    }
}