<?php
// app/Http/Controllers/Admin/ApplicationController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserSubmittedApplication;
use App\Models\VisaApplication;
use App\Services\ApplicationDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Controller for managing visa applications in admin panel
 */
class ApplicationController extends Controller
{
    protected ApplicationDataService $dataService;

    public function __construct(ApplicationDataService $dataService)
    {
        $this->dataService = $dataService;
    }

    /**
     * Display listing of all applications
     */
    public function index(Request $request)
    {
        $query = UserSubmittedApplication::with(['user', 'visaApplication', 'reviewer'])
            ->orderBy('created_at', 'desc');

        // Apply search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Apply application type filter
        if ($request->filled('application_type')) {
            $query->whereHas('visaApplication', function($q) use ($request) {
                $q->where('name', $request->application_type);
            });
        }

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Apply date filters
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $applications = $query->paginate(20);

        // Get unique visa application types for filter
        $visa_applications = VisaApplication::pluck('name')->unique();

        // Get unique statuses
        $statuses = ['pending', 'under_review', 'approved', 'rejected'];

        return view('admin.applications.index', compact('applications', 'visa_applications', 'statuses'));
    }

    /**
     * Display specific application details
     */
    public function show(UserSubmittedApplication $application)
    {
        $application->load(['user', 'visaApplication', 'reviewer']);

        // Get unread message count for this application
        $unreadMessageCount = \App\Models\Message::where('application_id', $application->id)
            ->where('sender_type', 'user')
            ->where('is_read', false)
            ->count();

        return view('admin.applications.show', compact('application', 'unreadMessageCount'));
    }

    /**
     * Display application form data for PDF generation
     */
    public function showFormData(UserSubmittedApplication $application)
    {
        $application->load(['user', 'visaApplication']);

        // Collect all application data using the service
        $applicationData = $this->dataService->collectApplicationData($application);

        return view('admin.applications.form-data', compact('application', 'applicationData'));
    }

    /**
     * Update application status
     */
    public function updateStatus(Request $request, UserSubmittedApplication $application)
    {
        $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $application->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'reviewed_at' => now(),
            'reviewed_by' => Auth::id(),
        ]);

        // You can add notification to user here
        // event(new ApplicationStatusUpdated($application));

        return redirect()
            ->route('admin.applications.show', $application)
            ->with('success', 'Application status updated successfully.');
    }

    /**
     * Export applications to CSV
     */
    public function export(Request $request)
    {
        $query = UserSubmittedApplication::with(['user', 'visaApplication']);

        // Apply same filters as index
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('application_type')) {
            $query->whereHas('visaApplication', function($q) use ($request) {
                $q->where('name', $request->application_type);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $applications = $query->get();

        // Generate CSV
        $filename = 'applications_export_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($applications) {
            $file = fopen('php://output', 'w');
            
            // CSV Headers
            fputcsv($file, [
                'ID',
                'Transaction ID',
                'User Name',
                'User Email',
                'Application Type',
                'Status',
                'Submitted Date',
                'Reviewed Date',
                'Reviewed By',
            ]);

            // CSV Data
            foreach ($applications as $application) {
                fputcsv($file, [
                    $application->id,
                    $application->transaction_id,
                    $application->user->name,
                    $application->user->email,
                    $application->visaApplication->name ?? 'N/A',
                    ucfirst(str_replace('_', ' ', $application->status)),
                    $application->created_at->format('Y-m-d H:i:s'),
                    $application->reviewed_at ? $application->reviewed_at->format('Y-m-d H:i:s') : 'Not reviewed',
                    $application->reviewer->name ?? 'N/A',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}