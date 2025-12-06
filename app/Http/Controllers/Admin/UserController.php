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
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Get the authenticated admin ID
     */
    protected function getAdminId(): ?int
    {
        // Try 'admin' guard first, fall back to default 'web' guard
        return Auth::guard('admin')->id() ?? Auth::id();
    }

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

    /**
     * Show user documents
     */
    public function documents(User $user)
    {
        try {
            // Get visa type from user
            $visaType = $this->getVisaTypeFromUser($user);
            
            // Get document requirements
            $requirements = DocumentRequirements::getRequirements($visaType);
            
            // Get uploaded documents grouped by category
            $uploadedDocuments = DropBox::where('user_id', $user->id)
                ->orderBy('created_at', 'DESC')
                ->get()
                ->groupBy('document_category');
            
            // Calculate completion stats
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
            
            // Mark as verified with admin ID
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
                'trace' => $e->getTraceAsString(),
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
            'spouse' => 'spouse',
            'adjustment' => 'adjustment',
            'combined' => 'spouse',
        ];
        
        return $visaTypeMap[$user->chosen_application] ?? 'spouse';
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
                    
                    // Check if this document type has been uploaded
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