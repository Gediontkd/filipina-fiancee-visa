<?php
// app/Http/Controllers/Admin/DocumentController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationDocument;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    /**
     * Display all documents
     */
    public function index(Request $request)
    {
        try {
            $query = ApplicationDocument::with(['application.user', 'application.visaApplication', 'reviewer']);

            // Filter by document type
            if ($request->filled('document_type')) {
                $query->where('document_type', $request->document_type);
            }

            // Filter by status
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            // Filter by form name
            if ($request->filled('form_name')) {
                $query->where('form_name', 'LIKE', "%{$request->form_name}%");
            }

            // Filter by uploaded by type
            if ($request->filled('uploaded_by_type')) {
                $query->where('uploaded_by_type', $request->uploaded_by_type);
            }

            // Filter by upload date
            if ($request->filled('date_from')) {
                $query->whereDate('created_at', '>=', $request->date_from);
            }
            if ($request->filled('date_to')) {
                $query->whereDate('created_at', '<=', $request->date_to);
            }

            $documents = $query->orderBy('created_at', 'desc')
                ->paginate(15)
                ->appends($request->all());

            // Get filter options
            $document_types = ApplicationDocument::select('document_type')
                ->distinct()
                ->pluck('document_type');
            
            $form_names = ApplicationDocument::select('form_name')
                ->distinct()
                ->pluck('form_name');

            $statuses = ApplicationDocument::select('status')
                ->distinct()
                ->pluck('status');

            return view('admin.documents.index', compact(
                'documents', 
                'document_types', 
                'form_names', 
                'statuses'
            ));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load documents: ' . $e->getMessage());
        }
    }

    /**
     * Show documents for specific application
     */
    public function applicationDocuments(UserSubmittedApplication $application)
    {
        try {
            $application->load(['user', 'visaApplication']);
            
            $documents = ApplicationDocument::where('application_id', $application->id)
                ->with('reviewer')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('admin.documents.application', compact('application', 'documents'));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to load application documents: ' . $e->getMessage());
        }
    }

    /**
     * Upload a new document
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'application_id' => 'required|exists:user_submitted_applications,id',
                'document_type' => 'required|in:draft,final,signed,supporting',
                'form_name' => 'required|string|max:255',
                'file' => 'required|file|max:51200|mimes:pdf,doc,docx,jpg,jpeg,png,txt', // 50MB max
                'description' => 'nullable|string|max:1000',
                'status' => 'in:draft,ready_for_review,approved,needs_revision',
                'is_final_version' => 'boolean',
            ]);

            $file = $request->file('file');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('application-documents', $filename, 'public');

            ApplicationDocument::create([
                'application_id' => $request->application_id,
                'document_type' => $request->document_type,
                'form_name' => $request->form_name,
                'file_path' => $path,
                'original_filename' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'uploaded_by' => Auth::guard('admin')->id(),
                'uploaded_by_type' => 'admin',
                'status' => $request->status ?? 'draft',
                'description' => $request->description,
                'is_final_version' => $request->boolean('is_final_version'),
            ]);

            return back()->with('success', 'Document uploaded successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to upload document: ' . $e->getMessage());
        }
    }

    /**
     * Review and update document status
     */
    public function review(Request $request, ApplicationDocument $document)
    {
        try {
            $request->validate([
                'status' => 'required|in:draft,ready_for_review,approved,needs_revision',
                'admin_notes' => 'nullable|string|max:1000',
            ]);

            $document->markAsReviewed(
                Auth::guard('admin')->id(),
                $request->status,
                $request->admin_notes
            );

            return back()->with('success', 'Document reviewed successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to review document: ' . $e->getMessage());
        }
    }

    /**
     * Download a document
     */
    public function download(ApplicationDocument $document)
    {
        try {
            if (!$document->fileExists()) {
                return back()->with('error', 'File not found on server.');
            }

            return Storage::disk('public')->download(
                $document->file_path,
                $document->original_filename
            );

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to download document: ' . $e->getMessage());
        }
    }

    /**
     * Delete a document
     */
    public function destroy(ApplicationDocument $document)
    {
        try {
            // Delete file from storage
            $document->deleteFile();
            
            // Delete database record
            $document->delete();

            return back()->with('success', 'Document deleted successfully.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to delete document: ' . $e->getMessage());
        }
    }

    /**
     * Bulk update document statuses
     */
    public function bulkUpdate(Request $request)
    {
        try {
            $request->validate([
                'document_ids' => 'required|array',
                'document_ids.*' => 'exists:application_documents,id',
                'status' => 'required|in:draft,ready_for_review,approved,needs_revision',
                'admin_notes' => 'nullable|string|max:1000',
            ]);

            $adminId = Auth::guard('admin')->id();
            $updatedCount = 0;

            foreach ($request->document_ids as $documentId) {
                $document = ApplicationDocument::find($documentId);
                if ($document) {
                    $document->markAsReviewed(
                        $adminId,
                        $request->status,
                        $request->admin_notes
                    );
                    $updatedCount++;
                }
            }

            return back()->with('success', "Updated {$updatedCount} documents successfully.");

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to update documents: ' . $e->getMessage());
        }
    }

    /**
     * Get document statistics
     */
    public function getStats()
    {
        try {
            $stats = [
                'total_documents' => ApplicationDocument::count(),
                'pending_review' => ApplicationDocument::where('status', 'ready_for_review')->count(),
                'approved_documents' => ApplicationDocument::where('status', 'approved')->count(),
                'needs_revision' => ApplicationDocument::where('status', 'needs_revision')->count(),
                'draft_documents' => ApplicationDocument::where('status', 'draft')->count(),
                'uploaded_by_admin' => ApplicationDocument::where('uploaded_by_type', 'admin')->count(),
                'uploaded_by_user' => ApplicationDocument::where('uploaded_by_type', 'user')->count(),
            ];

            return response()->json($stats);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch statistics'], 500);
        }
    }

    /**
     * Search documents
     */
    public function search(Request $request)
    {
        try {
            $request->validate([
                'query' => 'required|string|min:3|max:255',
            ]);

            $query = $request->input('query');
            
            $documents = ApplicationDocument::with(['application.user', 'application.visaApplication'])
                ->where(function($q) use ($query) {
                    $q->where('original_filename', 'LIKE', "%{$query}%")
                      ->orWhere('form_name', 'LIKE', "%{$query}%")
                      ->orWhere('description', 'LIKE', "%{$query}%")
                      ->orWhereHas('application.user', function($userQ) use ($query) {
                          $userQ->where('name', 'LIKE', "%{$query}%")
                                ->orWhere('email', 'LIKE', "%{$query}%");
                      });
                })
                ->orderBy('created_at', 'desc')
                ->paginate(15)
                ->appends($request->all());

            return view('admin.documents.search', compact('documents', 'query'));

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to search documents: ' . $e->getMessage());
        }
    }
}