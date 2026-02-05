<?php
// app/Http/Controllers/Admin/ApplicationController.php (FIXED - Data Display)

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserSubmittedApplication;
use App\Models\VisaApplication;
use App\Services\ApplicationDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ApplicationController extends Controller
{
    protected ApplicationDataService $dataService;

    public function __construct(ApplicationDataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function index(Request $request)
    {
        $query = UserSubmittedApplication::with(['user', 'visaApplication', 'reviewer'])
            ->orderBy('created_at', 'desc');

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

        $applications = $query->paginate(20);
        $visa_applications = VisaApplication::pluck('name')->unique();
        $statuses = ['pending', 'under_review', 'approved', 'rejected'];

        return view('admin.applications.index', compact('applications', 'visa_applications', 'statuses'));
    }

    public function show(UserSubmittedApplication $application)
    {
        $application->load(['user', 'visaApplication', 'reviewer']);

        // Get unread message count (messages from user that admin hasn't read)
        $unreadMessageCount = \App\Models\Message::where('application_id', $application->id)
            ->where('sender_type', 'user')
            ->whereNull('read_at')
            ->count();
        
        // Get total message count for this application
        $messageCount = \App\Models\Message::where('application_id', $application->id)->count();
        
        // Get document count (if you have documents stored in the application)
        $documentCount = $application->documents ? count($application->documents) : 0;

        return view('admin.applications.show', compact(
            'application', 
            'unreadMessageCount',
            'messageCount',
            'documentCount'
        ));
    }

    /**
     * Display application form data - FIXED VERSION
     */
    public function showFormData(UserSubmittedApplication $application)
    {
        $application->load(['user', 'visaApplication']);

        // Collect data using the service
        $collectedData = $this->dataService->collectApplicationData($application);
        
        // Extract only the form_data part for the view
        $applicationData = $collectedData['form_data'] ?? [];



        return view('admin.applications.form-data', compact('application', 'applicationData'));
    }

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
            'reviewed_by' => Auth::guard('admin')->id(),
        ]);

        return redirect()
            ->route('admin.applications.show', $application)
            ->with('success', 'Application status updated successfully.');
    }

    public function export(Request $request)
    {
        $query = UserSubmittedApplication::with(['user', 'visaApplication']);

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

        $filename = 'applications_export_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function() use ($applications) {
            $file = fopen('php://output', 'w');
            
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