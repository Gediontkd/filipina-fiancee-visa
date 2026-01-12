<?php
// app/Http/Controllers/Admin/UserController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserSubmittedApplication;
use App\Models\DropBox;
use App\Config\DocumentRequirements;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Get the authenticated admin ID
     */
    protected function getAdminId(): ?int
    {
        return Auth::guard('admin')->id() ?? Auth::id();
    }

    /**
     * Display users list with card-based grid
     * 
     * UPDATED: Added sorting option, improved query structure
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

            // NEW: Sorting options
            $sort = $request->get('sort', 'newest');
            match ($sort) {
                'oldest' => $query->oldest(),
                'name' => $query->orderBy('name'),
                default => $query->latest(),
            };

            $users = $query->withCount('userSubmittedApplications')
                ->paginate(15)
                ->withQueryString(); // UPDATED: Better pagination with query string

            $application_types = User::select('chosen_application')
                ->whereNotNull('chosen_application')
                ->where('chosen_application', '!=', '')
                ->distinct()
                ->pluck('chosen_application');

            return view('admin.users.index', compact('users', 'application_types'));

        } catch (\Exception $e) {
            Log::error('Failed to load users list', ['error' => $e->getMessage()]);
            return back()->with('error', 'Unable to load users: ' . $e->getMessage());
        }
    }

    /**
     * Show user workspace - COMPLETELY UPDATED
     * 
     * This is now the central hub for all user management.
     * Loads all data needed for the tabbed workspace interface.
     */
    public function show(User $user)
    {
        try {
            // Load all relationships needed for the workspace tabs
            $user->load([
                // For Applications Tab
                'userSubmittedApplications' => function ($query) {
                    $query->with(['visaApplication', 'reviewer'])
                          ->orderBy('created_at', 'desc');
                },
                
                // For Documents Tab
                'dropboxFiles' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                },
                
                // For Messages Tab
                'messages' => function ($query) {
                    $query->with('application')
                          ->orderBy('created_at', 'desc');
                },
                
                // Legacy step data (if still needed)
                'fianceVisaSteps',
                'spouseVisaSteps',
                'adjustmentVisaSteps',
            ]);

            return view('admin.users.show', compact('user'));

        } catch (\Exception $e) {
            Log::error('Failed to load user workspace', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
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
     * Update user - UPDATED with image handling
     */
    public function update(Request $request, User $user)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
                'phone' => 'nullable|string|max:20',
                'chosen_application' => 'nullable|string',
                'password' => 'nullable|min:8|confirmed',
                'image' => 'nullable|image|max:2048', // NEW: Image validation
            ]);

            $data = $request->only(['name', 'email', 'phone', 'chosen_application']);
            
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }

            // NEW: Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($user->image) {
                    Storage::disk('public')->delete($user->image);
                }
                $data['image'] = $request->file('image')->store('users', 'public');
            }

            $user->update($data);

            return redirect()->route('admin.users.show', $user)
                ->with('success', 'User updated successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to update user', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Unable to update user: ' . $e->getMessage());
        }
    }

    /**
     * Delete user - UPDATED to handle image deletion
     */
    public function destroy(User $user)
    {
        try {
            // NOTE: Removed the check that prevented deletion if user has applications
            // Applications will remain with user_id but show "Deleted User" in UI
            
            // Delete user image if exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            // Delete user's dropbox files from storage
            foreach ($user->dropboxFiles as $file) {
                if ($file->file_path) {
                    Storage::disk('public')->delete($file->file_path);
                }
            }

            $user->delete();

            return redirect()->route('admin.users.index')
                ->with('success', 'User deleted successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to delete user', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Unable to delete user: ' . $e->getMessage());
        }
    }

    /**
     * Show user documents - kept for backward compatibility
     * (The new workspace has documents in a tab, but this route still works)
     */
    public function documents(User $user)
    {
        try {
            $visaType = $this->getVisaTypeFromUser($user);
            $requirements = DocumentRequirements::getRequirements($visaType);
            
            $uploadedDocuments = DropBox::where('user_id', $user->id)
                ->orderBy('created_at', 'DESC')
                ->get()
                ->groupBy('document_category');
            
            $completionStats = $this->calculateCompletionStats($requirements, $uploadedDocuments);
            
            return view('admin.users.documents', compact(
                'user',
                'visaType',
                'requirements',
                'uploadedDocuments',
                'completionStats'
            ));
            
        } catch (\Exception $e) {
            Log::error('Failed to load user documents', [
                'user_id' => $user->id,
                'error' => $e->getMessage()
            ]);
            return back()->with('error', 'Failed to load documents.');
        }
    }

    /**
     * Verify a document
     */
    public function verifyDocument($documentId)
    {
        try {
            $document = DropBox::findOrFail($documentId);
            $adminId = $this->getAdminId();
            
            $document->markAsVerified($adminId);
            
            Log::info('Document verified by admin', [
                'admin_id' => $adminId,
                'document_id' => $documentId,
                'user_id' => $document->user_id
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Document verified successfully'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Document verification failed', [
                'admin_id' => $this->getAdminId(),
                'document_id' => $documentId,
                'error' => $e->getMessage(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Verification failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get visa type from user's chosen application
     */
    private function getVisaTypeFromUser($user): string
    {
        $visaTypeMap = [
            'fiancee' => 'fiance',
            'fiance' => 'fiance',
            'fiancee visa' => 'fiance',
            'fiance visa' => 'fiance',
            'spouse' => 'spouse',
            'spouse visa' => 'spouse',
            'adjustment' => 'adjustment',
            'adjustment of status' => 'adjustment',
            'combined' => 'spouse',
            'combined cr1 aos' => 'spouse',
        ];
        
        $chosenApp = strtolower($user->chosen_application ?? '');
        return $visaTypeMap[$chosenApp] ?? 'spouse';
    }

    /**
     * Calculate document completion statistics
     */
    private function calculateCompletionStats(array $requirements, $uploadedDocuments): array
    {
        $totalRequired = 0;
        $totalUploaded = 0;
        $categoryStats = [];
        
        foreach ($requirements as $categoryKey => $category) {
            $categoryRequired = 0;
            $categoryUploaded = 0;
            
            foreach ($category['documents'] as $doc) {
                if ($doc['required']) {
                    $categoryRequired++;
                    $totalRequired++;
                    
                    $uploaded = isset($uploadedDocuments[$categoryKey])
                        ? $uploadedDocuments[$categoryKey]->where('document_type', $doc['id'])->count()
                        : 0;
                    
                    if ($uploaded > 0) {
                        $categoryUploaded++;
                        $totalUploaded++;
                    }
                }
            }
            
            $categoryStats[$categoryKey] = [
                'required' => $categoryRequired,
                'uploaded' => $categoryUploaded,
                'percentage' => $categoryRequired > 0
                    ? round(($categoryUploaded / $categoryRequired) * 100, 1)
                    : 100,
            ];
        }
        
        return [
            'total_required' => $totalRequired,
            'total_uploaded' => $totalUploaded,
            'overall_percentage' => $totalRequired > 0
                ? round(($totalUploaded / $totalRequired) * 100, 1)
                : 100,
            'categories' => $categoryStats,
        ];
    }
}