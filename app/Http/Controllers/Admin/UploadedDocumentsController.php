<?php
// app/Http/Controllers/Admin/UploadedDocumentsController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DropBox;
use App\Models\User;
use App\Models\DocumentCategory;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use ZipArchive;

class UploadedDocumentsController extends Controller
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
     * Display all uploaded documents dashboard
     */
    public function index(Request $request)
    {
        $query = DropBox::with(['user', 'verifiedBy']);

        // Filter by verification status
        if ($request->filled('verification_status')) {
            if ($request->verification_status === 'verified') {
                $query->where('is_verified', true);
            } elseif ($request->verification_status === 'unverified') {
                $query->where('is_verified', false);
            }
        }

        // Filter by visa type
        if ($request->filled('visa_type')) {
            $query->where('visa_type', $request->visa_type);
        }

        // Filter by document category
        if ($request->filled('category')) {
            $query->where('document_category', $request->category);
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Search by filename
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('original_filename', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $documents = $query->orderBy('created_at', 'desc')
            ->paginate(25)
            ->appends($request->all());

        // Get filter options
        $users = User::select('id', 'name', 'email')->get();
        $visaTypes = DropBox::select('visa_type')
            ->distinct()
            ->whereNotNull('visa_type')
            ->pluck('visa_type');
        $categories = DropBox::select('document_category')
            ->distinct()
            ->whereNotNull('document_category')
            ->pluck('document_category');

        // Statistics
        $stats = [
            'total_documents' => DropBox::count(),
            'verified_documents' => DropBox::where('is_verified', true)->count(),
            'unverified_documents' => DropBox::where('is_verified', false)->count(),
            'total_size' => DropBox::sum('file_size'),
            'documents_today' => DropBox::whereDate('created_at', today())->count(),
            'documents_this_week' => DropBox::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
        ];

        return view('admin.documents.uploaded.index', compact(
            'documents',
            'users',
            'visaTypes',
            'categories',
            'stats'
        ));
    }

    /**
     * View user's documents
     */
    public function userDocuments(User $user)
    {
        $visaType = $this->getVisaTypeFromUser($user);
        
        $categories = DocumentCategory::forVisaType($visaType)
            ->active()
            ->with(['activeDocumentTypes'])
            ->ordered()
            ->get();

        $uploadedDocuments = DropBox::where('user_id', $user->id)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->groupBy('document_category');

        $completionStats = $this->calculateCompletionStats($categories, $uploadedDocuments, $user->id);

        $allDocuments = DropBox::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.documents.uploaded.user-documents', compact(
            'user',
            'visaType',
            'categories',
            'uploadedDocuments',
            'completionStats',
            'allDocuments'
        ));
    }

    /**
     * Preview document
     */
    public function preview($id)
    {
        try {
            $document = DropBox::with('user')->findOrFail($id);

            // Check if file exists using the model method
            if (!$document->fileExists()) {
                return back()->with('error', 'File not found on server.');
            }

            return view('admin.documents.uploaded.preview', compact('document'));
            
        } catch (\Exception $e) {
            Log::error('Document preview failed', [
                'admin_id' => $this->getAdminId(),
                'document_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Failed to preview document.');
        }
    }

    /**
     * Download document
     */
    public function download($id)
    {
        try {
            $document = DropBox::findOrFail($id);

            $filePath = 'dropbox/' . $document->name;

            if (!Storage::disk('public')->exists($filePath)) {
                return back()->with('error', 'File not found.');
            }

            Log::info('Admin downloaded document', [
                'admin_id' => $this->getAdminId(),
                'document_id' => $id,
                'user_id' => $document->user_id,
            ]);

            return Storage::disk('public')->download(
                $filePath,
                $document->original_filename
            );
        } catch (\Exception $e) {
            Log::error('Admin document download failed', [
                'admin_id' => $this->getAdminId(),
                'document_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Failed to download document.');
        }
    }

    /**
     * Verify single document
     */
    public function verify($id)
    {
        try {
            $document = DropBox::findOrFail($id);
            $adminId = $this->getAdminId();

            // Mark as verified with admin ID
            $document->markAsVerified($adminId);

            Log::info('Document verified by admin', [
                'admin_id' => $adminId,
                'document_id' => $id,
                'user_id' => $document->user_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Document verified successfully'
            ]);
        } catch (\Exception $e) {
            Log::error('Document verification failed', [
                'admin_id' => $this->getAdminId(),
                'document_id' => $id,
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
     * Bulk verify documents
     */
    public function bulkVerify(Request $request)
    {
        $request->validate([
            'document_ids' => 'required|array',
            'document_ids.*' => 'exists:drop_boxes,id',
        ]);

        try {
            $count = 0;
            $adminId = $this->getAdminId();

            foreach ($request->document_ids as $id) {
                $document = DropBox::find($id);
                if ($document && !$document->is_verified) {
                    $document->markAsVerified($adminId);
                    $count++;
                }
            }

            Log::info('Bulk document verification', [
                'admin_id' => $adminId,
                'count' => $count,
            ]);

            return response()->json([
                'success' => true,
                'message' => "{$count} documents verified successfully"
            ]);
        } catch (\Exception $e) {
            Log::error('Bulk verification failed', [
                'admin_id' => $this->getAdminId(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Bulk verification failed: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete document
     */
    public function destroy($id)
    {
        try {
            $document = DropBox::findOrFail($id);
            
            // Delete physical file using the model method
            $document->deleteFile();

            $userId = $document->user_id;
            $document->delete();

            Log::info('Admin deleted user document', [
                'admin_id' => $this->getAdminId(),
                'document_id' => $id,
                'user_id' => $userId,
            ]);

            return back()->with('success', 'Document deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Admin document deletion failed', [
                'admin_id' => $this->getAdminId(),
                'document_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Failed to delete document.');
        }
    }

    /**
     * Download all documents for a user as ZIP
     */
    public function downloadUserPackage(User $user)
    {
        try {
            $documents = DropBox::where('user_id', $user->id)->get();

            if ($documents->isEmpty()) {
                return back()->with('error', 'User has no uploaded documents.');
            }

            $zipFileName = 'user_' . $user->id . '_documents_' . date('Y-m-d_His') . '.zip';
            $zipFilePath = storage_path('app/temp/' . $zipFileName);

            // Create temp directory if not exists
            if (!file_exists(storage_path('app/temp'))) {
                mkdir(storage_path('app/temp'), 0755, true);
            }

            $zip = new ZipArchive();
            if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
                return back()->with('error', 'Failed to create ZIP file.');
            }

            $addedFiles = 0;
            foreach ($documents as $document) {
                $filePath = $document->getAbsoluteFilePath();
                
                if (file_exists($filePath)) {
                    // Add file with organized folder structure
                    $zipPath = ($document->document_category ?: 'Uncategorized') . '/' . $document->original_filename;
                    $zip->addFile($filePath, $zipPath);
                    $addedFiles++;
                }
            }

            $zip->close();

            if ($addedFiles === 0) {
                @unlink($zipFilePath);
                return back()->with('error', 'No physical files found to download.');
            }

            Log::info('Admin downloaded user document package', [
                'admin_id' => $this->getAdminId(),
                'user_id' => $user->id,
                'document_count' => $addedFiles,
            ]);

            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            Log::error('User document package download failed', [
                'admin_id' => $this->getAdminId(),
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            return back()->with('error', 'Failed to create document package: ' . $e->getMessage());
        }
    }

    /**
     * Get statistics by visa type
     */
    public function statisticsByVisaType()
    {
        $stats = DropBox::selectRaw('
                visa_type,
                COUNT(*) as total_documents,
                SUM(CASE WHEN is_verified = 1 THEN 1 ELSE 0 END) as verified_count,
                SUM(CASE WHEN is_verified = 0 THEN 1 ELSE 0 END) as unverified_count,
                SUM(file_size) as total_size
            ')
            ->whereNotNull('visa_type')
            ->groupBy('visa_type')
            ->get();

        return view('admin.documents.uploaded.statistics', compact('stats'));
    }

    /**
     * Get visa type from user
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
     * Calculate completion stats
     */
    private function calculateCompletionStats($categories, $uploadedDocuments, $userId): array
    {
        $totalRequired = 0;
        $totalUploaded = 0;
        $categoryStats = [];

        foreach ($categories as $category) {
            $categoryRequired = 0;
            $categoryUploaded = 0;

            foreach ($category->activeDocumentTypes as $docType) {
                if ($docType->is_required) {
                    $categoryRequired++;
                    $totalRequired++;

                    if ($docType->hasUploadedDocuments($userId)) {
                        $categoryUploaded++;
                        $totalUploaded++;
                    }
                }
            }

            $categoryStats[$category->category_key] = [
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