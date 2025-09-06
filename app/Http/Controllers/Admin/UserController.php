<?php
// app/Http/Controllers/Admin/UserController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display users list
     */
    public function index(Request $request)
    {
        try {
            $query = User::query();

            // Search functionality
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
                });
            }

            // Filter by application type
            if ($request->filled('application_type')) {
                $query->where('chosen_application', $request->application_type);
            }

            // Filter by registration date
            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            $users = $query->withCount('userSubmittedApplications')
                ->orderBy('created_at', 'desc')
                ->paginate(15)
                ->appends($request->all());

            $application_types = User::select('chosen_application')
                ->whereNotNull('chosen_application')
                ->where('chosen_application', '!=', '')
                ->distinct()
                ->pluck('chosen_application');

            return view('admin.users.index', compact('users', 'application_types'));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load users: ' . $e->getMessage());
        }
    }

    /**
     * Show user details
     */
    public function show(User $user)
    {
        try {
            $user->load([
                'userSubmittedApplications',
                'fianceVisaSteps',
                'spouseVisaSteps',
                'adjustmentVisaSteps'
            ]);

            return view('admin.users.show', compact('user'));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load user details: ' . $e->getMessage());
        }
    }

    /**
     * Show user edit form
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update user
     */
    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
                'chosen_application' => 'nullable|string',
                'password' => 'nullable|min:8|confirmed',
            ]);

            $data = $request->only(['name', 'email', 'chosen_application']);
            
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            $user->update($data);

            return redirect()->route('admin.users.show', $user)
                ->with('success', 'User updated successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to update user: ' . $e->getMessage());
        }
    }

    /**
     * Delete user
     */
    public function destroy(User $user)
    {
        try {
            // Check if user has submitted applications
            if ($user->userSubmittedApplications()->count() > 0) {
                return back()->with('error', 'Cannot delete user with submitted applications.');
            }

            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'User deleted successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to delete user: ' . $e->getMessage());
        }
    }
}