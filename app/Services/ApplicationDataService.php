<?php
// app/Services/ApplicationDataService.php (SIMPLE - JUST GET THE DATA!)

namespace App\Services;

use App\Models\User;
use App\Models\UserSubmittedApplication;
use App\Models\FianceVisaSubmittedStep;
use App\Models\SpouseVisaSubmittedStep;
use App\Models\AdjustmentVisaSubmittedStep;
use Illuminate\Support\Facades\Log;

class ApplicationDataService
{
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

        // SIMPLE: Just get data by user_id and type
        if (stripos($applicationType, 'Fiance') !== false) {
            $data['form_data'] = $this->getFianceData($user->id);
        } elseif (stripos($applicationType, 'Spouse') !== false) {
            $data['form_data'] = $this->getSpouseData($user->id);
        } elseif (stripos($applicationType, 'Adjustment') !== false) {
            $data['form_data'] = $this->getAdjustmentData($user->id);
        }

        return $data;
    }

    private function getFianceData($userId): array
    {
        // SIMPLE: Get ALL records for this user
        $steps = FianceVisaSubmittedStep::where('user_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        $data = [
            'sponsor' => [],
            'alien' => [],
            'children' => [],
        ];

        foreach ($steps as $step) {
            $detail = $step->detail; // Already unserialized by model
            
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

    private function getSpouseData($userId): array
    {
        $steps = SpouseVisaSubmittedStep::where('user_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        $data = [];
        foreach ($steps as $step) {
            $data[$step->step] = $step->detail;
        }

        return $data;
    }

    private function getAdjustmentData($userId): array
    {
        $steps = AdjustmentVisaSubmittedStep::where('user_id', $userId)
            ->orderBy('id', 'asc')
            ->get();

        $data = [];
        foreach ($steps as $step) {
            $data[$step->step] = $step->detail;
        }

        return $data;
    }

    public function formatAsJson(array $data): string
    {
        return json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

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