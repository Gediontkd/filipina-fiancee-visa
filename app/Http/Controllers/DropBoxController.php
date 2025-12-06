<?php
// app/Http/Controllers/DropBoxController.php - UPDATED TO USE DATABASE

namespace App\Http\Controllers;

use App\Models\DropBox;
use App\Models\DocumentCategory;
use App\Models\DocumentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DropBoxController extends Controller
{
    /**
     * Display document upload page with requirements FROM DATABASE
     */
    public function index()
    {
        $user = Auth::user();
        $visaType = $this->getVisaTypeFromUser($user);

        // Get document categories and types from database
        $categories = DocumentCategory::forVisaType($visaType)
            ->active()
            ->with(['activeDocumentTypes' => function($query) {
                $query->ordered();
            }])
            ->ordered()
            ->get();

        // Get uploaded documents grouped by category
        $uploadedDocuments = DropBox::where('user_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->get()
            ->groupBy('document_category');

        // Calculate completion status
        $completionStats = $this->calculateCompletionStats($categories, $uploadedDocuments);

        $availableVisaTypes = [
            'fiance' => 'K-1 Fiancé(e) Visa',
            'spouse' => 'CR-1/IR-1 Spousal Visa',
            'child' => 'CR-2/IR-2 Child Visa',
            'adjustment' => 'Adjustment of Status (I-485)',
            'roc' => 'Removal of Conditions (I-751)',
            'naturalization' => 'Naturalization (N-400)',
        ];

        return view('web.user.dropbox.index', compact(
            'categories',
            'uploadedDocuments',
            'visaType',
            'availableVisaTypes',
            'completionStats'
        ));
    }

    /**
     * Show specific document
     */
    public function show($id)
    {
        $file = DropBox::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('web.user.dropbox.show', compact('file'));
    }

    /**
     * Store uploaded document
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|max:10240|mimes:pdf,doc,docx,jpg,jpeg,png,txt',
                'visa_type' => 'required|string',
                'document_category' => 'required|string',
                'document_type' => 'required|string',
                'description' => 'nullable|string|max:500',
            ]);

            if (!$request->hasFile('file')) {
                return response()->json([
                    'status' => false,
                    'message' => 'No file uploaded',
                ], 400);
            }

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            
            // Generate unique filename
            $extension = $file->getClientOriginalExtension();
            $uniqueName = Str::uuid() . '_' . time() . '.' . $extension;

            // Store file
            $path = $file->storeAs('public/dropbox', $uniqueName);

            // Create database record
            $dropbox = DropBox::create([
                'user_id' => Auth::id(),
                'name' => $uniqueName,
                'original_filename' => $originalName,
                'file_size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'visa_type' => $request->visa_type,
                'document_category' => $request->document_category,
                'document_type' => $request->document_type,
                'description' => $request->description,
                'is_verified' => false,
            ]);

            Log::info('Document uploaded', [
                'user_id' => Auth::id(),
                'document_id' => $dropbox->id,
                'document_type' => $request->document_type,
                'filename' => $originalName,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Document uploaded successfully!',
                'data' => [
                    'id' => $dropbox->id,
                    'filename' => $dropbox->original_filename,
                    'size' => $dropbox->formatted_file_size,
                ],
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed: ' . implode(', ', $e->validator->errors()->all()),
            ], 422);

        } catch (\Exception $e) {
            Log::error('Document upload failed', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Upload failed. Please try again.',
            ], 500);
        }
    }

    /**
     * Delete document
     */
    public function destroy(Request $request, $id)
    {
        try {
            $document = DropBox::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // Delete physical file
            if (Storage::disk('public')->exists('dropbox/' . $document->name)) {
                Storage::disk('public')->delete('dropbox/' . $document->name);
            }

            // Delete database record
            $document->delete();

            Log::info('Document deleted', [
                'user_id' => Auth::id(),
                'document_id' => $id,
                'filename' => $document->original_filename,
            ]);

            return redirect()->back()->with('success', 'Document deleted successfully!');

        } catch (\Exception $e) {
            Log::error('Document deletion failed', [
                'user_id' => Auth::id(),
                'document_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Failed to delete document.');
        }
    }

    /**
     * Download document
     */
    public function download($id)
    {
        try {
            $document = DropBox::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $filePath = 'dropbox/' . $document->name;

            if (!Storage::disk('public')->exists($filePath)) {
                return redirect()->back()->with('error', 'File not found.');
            }

            return Storage::disk('public')->download(
                $filePath,
                $document->original_filename
            );

        } catch (\Exception $e) {
            Log::error('Document download failed', [
                'user_id' => Auth::id(),
                'document_id' => $id,
                'error' => $e->getMessage(),
            ]);

            return redirect()->back()->with('error', 'Failed to download document.');
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
    private function calculateCompletionStats($categories, $uploadedDocuments): array
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

                    // Check if this document type has been uploaded
                    $uploaded = isset($uploadedDocuments[$category->category_key])
                        ? $uploadedDocuments[$category->category_key]->where('document_type', $docType->type_key)->count()
                        : 0;

                    if ($uploaded > 0) {
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