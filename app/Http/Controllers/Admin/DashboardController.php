<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSubmittedApplication;
use App\Models\FianceVisaStep;
use App\Models\SpouseVisaStep;
use App\Models\AdjustmentVisaStep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        try {
            // Get statistics
            $stats = [
                'total_users' => User::count(),
                'active_applications' => UserSubmittedApplication::count(),
                'pending_applications' => UserSubmittedApplication::where('status', 'pending')->count(),
                'approved_applications' => UserSubmittedApplication::where('status', 'approved')->count(),
                'rejected_applications' => UserSubmittedApplication::where('status', 'rejected')->count(),
                'recent_registrations' => User::where('created_at', '>=', now()->subDays(7))->count(),
            ];

            // Recent users
            $recent_users = User::latest()
                ->take(5)
                ->get(['id', 'name', 'email', 'chosen_application', 'created_at']);

            // Recent applications
            $recent_applications = UserSubmittedApplication::with(['user', 'visaApplication'])
                ->latest()
                ->take(5)
                ->get();

            // Application stats by visa type
            $application_stats = UserSubmittedApplication::with('visaApplication')
                ->get()
                ->groupBy(function($item) {
                    return strtolower($item->visaApplication->name ?? 'unknown');
                })
                ->map(function($group) {
                    return $group->count();
                })
                ->toArray();

            return view('admin.dashboard', compact(
                'stats', 
                'recent_users', 
                'recent_applications', 
                'application_stats'
            ));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load dashboard data: ' . $e->getMessage());
        }
    }
}