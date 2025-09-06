<?php
// app/Http/Controllers/Admin/ApplicationController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VisaApplication;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**
     * Display applications list
     */
    public function index(Request $request)
    {
        try {
            $query = UserSubmittedApplication::with(['user', 'visaApplication', 'reviewer']);

            // Search by user name or email
            if ($request->filled('search')) {
                $search = $request->search;
                $query->whereHas('user', function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
                });
            }

            // Filter by visa application type
            if ($request->filled('application_type')) {
                $query->whereHas('visaApplication', function($q) use ($request) {
                    $q->where('name', 'LIKE', "%{$request->application_type}%");
                });
            }

            // Filter by status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            // Filter by submission date
            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            $applications = $query->orderBy('created_at', 'desc')
                ->paginate(15)
                ->appends($request->all());

            // Get filter options
            $visa_applications = VisaApplication::select('name')
                ->distinct()
                ->pluck('name');
            
            $statuses = UserSubmittedApplication::select('status')
                ->distinct()
                ->pluck('status');

            return view('admin.applications.index', compact(
                'applications', 
                'visa_applications', 
                'statuses'
            ));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load applications: ' . $e->getMessage());
        }
    }

    /**
     * Show application details
     */
    public function show(UserSubmittedApplication $application)
    {
        try {
            $application->load(['user', 'visaApplication', 'reviewer']);
            
            // Get related application data
            $application_data = $this->getApplicationData($application);

            return view('admin.applications.show', compact('application', 'application_data'));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load application details: ' . $e->getMessage());
        }
    }

    /**
     * Update application status
     */
    public function updateStatus(Request $request, UserSubmittedApplication $application)
    {
        try {
            $request->validate([
                'status' => 'required|in:pending,under_review,approved,rejected',
                'admin_notes' => 'nullable|string|max:1000',
            ]);

            $application->update([
                'status' => $request->status,
                'admin_notes' => $request->admin_notes,
                'reviewed_at' => now(),
                'reviewed_by' => auth()->guard('admin')->id(),
            ]);

            return back()->with('success', 'Application status updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to update status: ' . $e->getMessage());
        }
    }

    /**
     * Get related application data
     */
    private function getApplicationData(UserSubmittedApplication $application)
    {
        $user = $application->user;
        $data = [];

        // Get step data based on user's chosen application
        if ($user->chosen_application) {
            switch (strtolower($user->chosen_application)) {
                case 'fiance':
                case 'fiancee':
                    $data['sponsor'] = $user->fianceVisaSteps ?? null;
                    $data['alien'] = $user->fianceAlien ?? null;
                    $data['children'] = $user->fianceAlienChildren ?? null;
                    break;
                
                case 'spouse':
                    $data['spouse_data'] = $user->spouseVisaSteps ?? null;
                    break;
                
                case 'adjustment':
                    $data['adjustment_data'] = $user->adjustmentVisaSteps ?? null;
                    break;
            }
        }

        return $data;
    }

    /**
     * Export applications
     */
    public function export(Request $request)
    {
        try {
            // This would implement CSV/Excel export functionality
            $applications = UserSubmittedApplication::with(['user', 'visaApplication'])->get();
            
            $filename = 'applications_' . now()->format('Y-m-d_H-i-s') . '.csv';
            
            $headers = [
                'Content-type' => 'text/csv',
                'Content-Disposition' => "attachment; filename={$filename}",
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0'
            ];

            $callback = function() use ($applications) {
                $file = fopen('php://output', 'w');
                
                // CSV headers
                fputcsv($file, [
                    'ID',
                    'User Name', 
                    'User Email',
                    'Application Type',
                    'Status',
                    'Transaction ID',
                    'Submitted Date',
                    'Admin Notes',
                    'Reviewed At',
                    'Reviewed By'
                ]);

                // CSV data
                foreach ($applications as $app) {
                    fputcsv($file, [
                        $app->id,
                        $app->user->name,
                        $app->user->email,
                        $app->visaApplication->name ?? 'N/A',
                        ucfirst($app->status),
                        $app->transaction_id,
                        $app->created_at->format('Y-m-d H:i:s'),
                        $app->admin_notes,
                        $app->reviewed_at ? $app->reviewed_at->format('Y-m-d H:i:s') : '',
                        $app->reviewer->name ?? ''
                    ]);
                }

                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
            
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to export applications: ' . $e->getMessage());
        }
    }
}