<?php
// app/Http/Controllers/Admin/DashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        try {
            $stats = $this->getStatistics();
            $recent_users = $this->getRecentUsers();
            $recent_applications = $this->getRecentApplications();
            $application_stats = $this->getApplicationStatistics();

            return view('admin.dashboard', compact(
                'stats', 
                'recent_users', 
                'recent_applications', 
                'application_stats'
            ));

        } catch (\Exception $e) {
            \Log::error('Dashboard Error: ' . $e->getMessage());
            return back()->with('error', 'Unable to load dashboard data. Please try again.');
        }
    }

    /**
     * Get general statistics
     */
    private function getStatistics(): array
    {
        return [
            'total_users' => User::count(),
            'active_applications' => UserSubmittedApplication::count(),
            'pending_applications' => UserSubmittedApplication::where('status', 'pending')->count(),
            'approved_applications' => UserSubmittedApplication::where('status', 'approved')->count(),
            'rejected_applications' => UserSubmittedApplication::where('status', 'rejected')->count(),
            'recent_registrations' => User::where('created_at', '>=', now()->subDays(7))->count(),
        ];
    }

    /**
     * Get recent users
     */
    private function getRecentUsers()
    {
        return User::latest()
            ->take(5)
            ->get(['id', 'name', 'email', 'chosen_application', 'created_at']);
    }

    /**
     * Get recent applications with valid user relationships
     * 
     * Filters out applications without users to prevent null pointer errors
     */
    private function getRecentApplications()
    {
        return UserSubmittedApplication::with(['user', 'visaApplication'])
            ->whereHas('user') // Only get applications that have associated users
            ->latest()
            ->take(5)
            ->get();
    }

    /**
     * Get application statistics grouped by visa type
     */
    private function getApplicationStatistics(): array
    {
        return UserSubmittedApplication::with('visaApplication')
            ->whereHas('visaApplication') // Only count applications with valid visa types
            ->get()
            ->groupBy(function($item) {
                return strtolower($item->visaApplication->name ?? 'unknown');
            })
            ->map(function($group) {
                return $group->count();
            })
            ->toArray();
    }
}