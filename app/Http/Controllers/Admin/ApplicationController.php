<?php
// app/Http/Controllers/Admin/ApplicationController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserSubmittedApplication;
use App\Models\FianceVisaSubmittedStep;
use App\Models\SpouseVisaSubmittedStep;
use App\Models\AdjustmentVisaSubmittedStep;
use App\Models\ApplicationDocument;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = UserSubmittedApplication::with(['user', 'visaApplication', 'reviewer'])
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        if ($request->filled('application_type')) {
            $query->whereHas('visaApplication', function($q) use ($request) {
                $q->where('name', 'LIKE', "%{$request->application_type}%");
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

        $applications = $query->paginate(15);

        $statuses = ['pending', 'under_review', 'approved', 'rejected'];
        $visa_applications = UserSubmittedApplication::with('visaApplication')
            ->get()
            ->pluck('visaApplication.name')
            ->unique()
            ->filter()
            ->values();

        return view('admin.applications.index', compact('applications', 'statuses', 'visa_applications'));
    }

    public function show(UserSubmittedApplication $application)
    {
        $application->load(['user', 'visaApplication', 'reviewer']);
        
        $documents = ApplicationDocument::where('application_id', $application->id)->latest()->get();
        $messageCount = Message::where('application_id', $application->id)->count();
        $unreadMessageCount = Message::where('application_id', $application->id)
            ->where('is_read', false)
            ->where('sender_type', 'user')
            ->count();

        $applicationData = $this->getApplicationData($application);

        return view('admin.applications.show', compact(
            'application',
            'documents',
            'messageCount',
            'unreadMessageCount',
            'applicationData'
        ));
    }

    public function showFormData(UserSubmittedApplication $application)
    {
        $application->load(['user', 'visaApplication']);
        $applicationData = $this->getApplicationData($application);

        return view('admin.applications.form-data', compact('application', 'applicationData'));
    }

    protected function getApplicationData(UserSubmittedApplication $application): ?array
    {
        $visaType = $application->visaApplication->name ?? '';

        if (stripos($visaType, 'Fiance') !== false || stripos($visaType, 'K-1') !== false) {
            return $this->getFianceVisaData($application);
        } elseif (stripos($visaType, 'Spouse') !== false) {
            return $this->getSpouseVisaData($application);
        } elseif (stripos($visaType, 'Adjustment') !== false) {
            return $this->getAdjustmentData($application);
        }

        return null;
    }

    protected function getFianceVisaData(UserSubmittedApplication $application): array
    {
        $data = ['sponsor' => [], 'alien' => [], 'children' => []];

        $sponsorSteps = FianceVisaSubmittedStep::where('user_id', $application->user_id)
            ->where('submitted_app_id', $application->id)
            ->where('type', 'sponsor')
            ->get();

        foreach ($sponsorSteps as $step) {
            $data['sponsor'][$step->step] = $step->detail;
        }

        $alienSteps = FianceVisaSubmittedStep::where('user_id', $application->user_id)
            ->where('submitted_app_id', $application->id)
            ->where('type', 'alien')
            ->get();

        foreach ($alienSteps as $step) {
            $data['alien'][$step->step] = $step->detail;
        }

        $childrenSteps = FianceVisaSubmittedStep::where('user_id', $application->user_id)
            ->where('submitted_app_id', $application->id)
            ->where('type', 'alien-children')
            ->get();

        foreach ($childrenSteps as $step) {
            $data['children'][$step->step] = $step->detail;
        }

        return $data;
    }

    protected function getSpouseVisaData(UserSubmittedApplication $application): array
    {
        $data = ['spouse_data' => []];

        $steps = SpouseVisaSubmittedStep::where('user_id', $application->user_id)
            ->where('submitted_app_id', $application->id)
            ->get();

        foreach ($steps as $step) {
            $data['spouse_data'][$step->step] = $step->detail;
        }

        return $data;
    }

    protected function getAdjustmentData(UserSubmittedApplication $application): array
    {
        $data = ['adjustment_data' => []];

        $steps = AdjustmentVisaSubmittedStep::where('user_id', $application->user_id)
            ->where('submitted_app_id', $application->id)
            ->get();

        foreach ($steps as $step) {
            $data['adjustment_data'][$step->step] = $step->detail;
        }

        return $data;
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
            'reviewed_by' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Application status updated successfully.');
    }

    public function export(Request $request)
    {
        $query = UserSubmittedApplication::with(['user', 'visaApplication']);

        // Apply filters
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        $applications = $query->get();

        $filename = 'applications_' . now()->format('Y-m-d_His') . '.csv';
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        fputcsv($handle, ['ID', 'User Name', 'User Email', 'Application Type', 'Transaction ID', 'Status', 'Submitted Date', 'Last Updated']);

        foreach ($applications as $app) {
            fputcsv($handle, [
                $app->id,
                $app->user->name,
                $app->user->email,
                $app->visaApplication->name ?? 'N/A',
                $app->transaction_id,
                ucfirst(str_replace('_', ' ', $app->status)),
                $app->created_at->format('Y-m-d H:i:s'),
                $app->updated_at->format('Y-m-d H:i:s')
            ]);
        }

        fclose($handle);
        exit;
    }
}