<?php
// app/Http/Controllers/Admin/MonitoringController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MonitoringChange;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class MonitoringController extends Controller
{
    /**
     * Display monitoring dashboard
     */
    public function index(Request $request)
    {
        try {
            // Get filter parameters
            $source = $request->get('source');
            $type = $request->get('type');
            $status = $request->get('status');

            // Build query
            $query = MonitoringChange::query();

            if ($source) {
                $query->forSource($source);
            }

            if ($type) {
                $query->where('type', $type);
            }

            if ($status === 'unread') {
                $query->unread();
            } elseif ($status === 'read') {
                $query->where('is_read', true);
            }

            $changes = $query->orderBy('detected_at', 'desc')
                ->paginate(20)
                ->appends($request->all());

            // Get statistics
            $stats = [
                'total_changes' => MonitoringChange::count(),
                'unread_changes' => MonitoringChange::unread()->count(),
                'uscis_changes' => MonitoringChange::forSource('uscis_forms')->count(),
                'medical_changes' => MonitoringChange::forSource('st_lukes_medical')->count(),
                'recent_changes' => MonitoringChange::where('detected_at', '>=', now()->subDays(7))->count(),
            ];

            // Get last check times
            $lastChecks = [
                'uscis_forms' => $this->getLastCheckTime('uscis_forms'),
                'st_lukes_medical' => $this->getLastCheckTime('st_lukes_medical'),
            ];

            return view('admin.monitoring.index', compact(
                'changes', 
                'stats', 
                'lastChecks'
            ));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load monitoring data: ' . $e->getMessage());
        }
    }

    /**
     * Check for USCIS form changes
     */
    public function checkUscisChanges()
    {
        try {
            // USCIS forms to monitor
            $formsToCheck = [
                'I-129F' => 'https://www.uscis.gov/i-129f',
                'I-130' => 'https://www.uscis.gov/i-130',
                'I-485' => 'https://www.uscis.gov/i-485',
                'I-864' => 'https://www.uscis.gov/i-864',
            ];

            $changesDetected = 0;

            foreach ($formsToCheck as $formName => $url) {
                $changes = $this->checkUscisFormPage($formName, $url);
                $changesDetected += count($changes);
            }

            $this->updateLastCheckTime('uscis_forms');

            return response()->json([
                'success' => true,
                'message' => "USCIS check completed. {$changesDetected} changes detected.",
                'changes_detected' => $changesDetected
            ]);

        } catch (\Exception $e) {
            Log::error('USCIS monitoring error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error checking USCIS forms: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check for St. Luke's medical fee changes
     */
    public function checkMedicalFees()
    {
        try {
            $url = 'https://slec.ph/registration/us/visa-applicant.php';
            $changes = $this->checkStLukesFeePage($url);

            $this->updateLastCheckTime('st_lukes_medical');

            return response()->json([
                'success' => true,
                'message' => "Medical fees check completed. " . count($changes) . " changes detected.",
                'changes_detected' => count($changes)
            ]);

        } catch (\Exception $e) {
            Log::error('Medical fees monitoring error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error checking medical fees: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Check specific USCIS form page
     */
    private function checkUscisFormPage($formName, $url)
    {
        try {
            $response = Http::timeout(30)->get($url);
            
            if (!$response->successful()) {
                Log::warning("Failed to fetch USCIS form {$formName}: " . $response->status());
                return [];
            }

            $currentContent = $response->body();
            $contentHash = md5($currentContent);
            
            // Get stored content hash
            $storedHash = Storage::get("monitoring/uscis_{$formName}_hash.txt");
            
            if ($storedHash && $storedHash !== $contentHash) {
                // Content changed - try to detect what changed
                $changes = $this->detectUscisChanges($formName, $url, $currentContent);
                
                // Store new hash
                Storage::put("monitoring/uscis_{$formName}_hash.txt", $contentHash);
                
                return $changes;
            } elseif (!$storedHash) {
                // First time checking - store hash
                Storage::put("monitoring/uscis_{$formName}_hash.txt", $contentHash);
            }

            return [];

        } catch (\Exception $e) {
            Log::error("Error checking USCIS form {$formName}: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Check St. Luke's fee page
     */
    private function checkStLukesFeePage($url)
    {
        try {
            $response = Http::timeout(30)->get($url);
            
            if (!$response->successful()) {
                Log::warning("Failed to fetch St. Luke's page: " . $response->status());
                return [];
            }

            $currentContent = $response->body();
            
            // Extract fee information using regex
            $feePattern = '/(?:fee|cost|price|amount).*?(?:PHP|₱|USD|\$)\s*[\d,]+(?:\.\d{2})?/i';
            preg_match_all($feePattern, $currentContent, $currentFees);
            
            $currentFeesData = $currentFees[0] ?? [];
            $currentHash = md5(implode('|', $currentFeesData));
            
            // Get stored fees
            $storedFeesJson = Storage::get("monitoring/st_lukes_fees.json");
            $storedData = $storedFeesJson ? json_decode($storedFeesJson, true) : null;
            
            if ($storedData && $storedData['hash'] !== $currentHash) {
                // Fees changed
                $changes = $this->createMedicalFeeChange($currentFeesData, $storedData['fees']);
                
                // Store new data
                Storage::put("monitoring/st_lukes_fees.json", json_encode([
                    'hash' => $currentHash,
                    'fees' => $currentFeesData,
                    'updated_at' => now()->toISOString()
                ]));
                
                return $changes;
            } elseif (!$storedData) {
                // First time checking
                Storage::put("monitoring/st_lukes_fees.json", json_encode([
                    'hash' => $currentHash,
                    'fees' => $currentFeesData,
                    'updated_at' => now()->toISOString()
                ]));
            }

            return [];

        } catch (\Exception $e) {
            Log::error("Error checking St. Luke's fees: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Detect changes in USCIS content
     */
    private function detectUscisChanges($formName, $url, $content)
    {
        // Simple change detection - in a real implementation, you'd want more sophisticated parsing
        $change = MonitoringChange::create([
            'source' => 'uscis_forms',
            'type' => 'content_change',
            'title' => "Form {$formName} Updated",
            'description' => "Changes detected on USCIS Form {$formName} page. Please review the official page for details.",
            'url' => $url,
            'detected_at' => now(),
            'new_data' => [
                'form_name' => $formName,
                'content_length' => strlen($content),
                'detected_keywords' => $this->extractKeywords($content)
            ]
        ]);

        return [$change];
    }

    /**
     * Create medical fee change record
     */
    private function createMedicalFeeChange($currentFees, $oldFees)
    {
        $change = MonitoringChange::create([
            'source' => 'st_lukes_medical',
            'type' => 'fee_change',
            'title' => "St. Luke's Medical Fees Updated",
            'description' => "Changes detected in St. Luke's medical examination fees. Please check the official website for current pricing.",
            'url' => 'https://slec.ph/registration/us/visa-applicant.php',
            'detected_at' => now(),
            'old_data' => ['fees' => $oldFees],
            'new_data' => ['fees' => $currentFees]
        ]);

        return [$change];
    }

    /**
     * Extract keywords from content
     */
    private function extractKeywords($content)
    {
        $keywords = ['fee', 'cost', 'price', 'filing', 'biometric', 'updated', 'revised', 'effective'];
        $found = [];
        
        foreach ($keywords as $keyword) {
            if (stripos($content, $keyword) !== false) {
                $found[] = $keyword;
            }
        }
        
        return $found;
    }

    /**
     * Mark change as read
     */
    public function markAsRead(MonitoringChange $change)
    {
        $change->markAsRead();
        
        return response()->json(['success' => true]);
    }

    /**
     * Mark all changes as read
     */
    public function markAllAsRead()
    {
        MonitoringChange::unread()->update(['is_read' => true]);
        
        return back()->with('success', 'All changes marked as read.');
    }

    /**
     * Get last check time for source
     */
    private function getLastCheckTime($source)
{
    $file = "monitoring/{$source}_last_check.txt";
    
    if (!Storage::exists($file)) {
        return null;
    }
    
    $timestamp = Storage::get($file);
    
    return $timestamp ? \Carbon\Carbon::parse($timestamp) : null;
}

    /**
     * Update last check time
     */
    private function updateLastCheckTime($source)
    {
        Storage::put("monitoring/{$source}_last_check.txt", now()->toISOString());
    }
}