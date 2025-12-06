<?php
// app/Http/Controllers/Admin/DocumentManagementController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentCategory;
use App\Models\DocumentType;
use App\Models\DropBox;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DocumentManagementController extends Controller
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
     * Display document management dashboard
     */
    public function index()
    {
        $visaTypes = [
            'fiance' => 'K-1 Fiancé(e) Visa',
            'spouse' => 'CR-1/IR-1 Spousal Visa',
            'child' => 'CR-2/IR-2 Child Visa',
            'adjustment' => 'Adjustment of Status (I-485)',
            'roc' => 'Removal of Conditions (I-751)',
            'naturalization' => 'Naturalization (N-400)',
        ];

        $stats = [
            'total_categories' => DocumentCategory::count(),
            'total_document_types' => DocumentType::count(),
            'total_uploads' => DropBox::count(),
            'active_categories' => DocumentCategory::where('is_active', true)->count(),
        ];

        return view('admin.documents.management.index', compact('visaTypes', 'stats'));
    }

    /**
     * Show categories for specific visa type
     */
    public function showVisaType($visaType)
    {
        $categories = DocumentCategory::forVisaType($visaType)
            ->with('documentTypes')
            ->ordered()
            ->get();

        $visaTypeLabels = [
            'fiance' => 'K-1 Fiancé(e) Visa',
            'spouse' => 'CR-1/IR-1 Spousal Visa',
            'child' => 'CR-2/IR-2 Child Visa',
            'adjustment' => 'Adjustment of Status (I-485)',
            'roc' => 'Removal of Conditions (I-751)',
            'naturalization' => 'Naturalization (N-400)',
        ];

        $visaTypeLabel = $visaTypeLabels[$visaType] ?? ucfirst($visaType);

        return view('admin.documents.management.visa-type', compact('visaType', 'visaTypeLabel', 'categories'));
    }

    /**
     * Store new category
     */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'visa_type' => 'required|string',
            'category_key' => 'required|string|max:100',
            'category_label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            $category = DocumentCategory::create($request->all());

            Log::info('Document category created', [
                'admin_id' => $this->getAdminId(),
                'category_id' => $category->id,
            ]);

            return redirect()->back()->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create category', [
                'admin_id' => $this->getAdminId(),
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Failed to create category.');
        }
    }

    /**
     * Update category - FIXED to handle unchecked checkboxes
     */
    public function updateCategory(Request $request, DocumentCategory $category)
    {
        $request->validate([
            'category_label' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            // IMPORTANT: Handle checkbox explicitly
            // Checkboxes don't send data when unchecked
            $category->update([
                'category_label' => $request->category_label,
                'description' => $request->description,
                'sort_order' => $request->sort_order ?? 0,
                'is_active' => $request->has('is_active'), // Will be true if checked, false if not
            ]);

            Log::info('Document category updated', [
                'admin_id' => $this->getAdminId(),
                'category_id' => $category->id,
                'is_active' => $category->is_active,
            ]);

            return redirect()->back()->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update category', [
                'admin_id' => $this->getAdminId(),
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Failed to update category.');
        }
    }

    /**
     * Delete category
     */
    public function destroyCategory(DocumentCategory $category)
    {
        try {
            // Check if category has uploaded documents
            $uploadCount = DropBox::where('document_category', $category->category_key)->count();
            
            if ($uploadCount > 0) {
                return redirect()->back()->with('error', "Cannot delete category with {$uploadCount} uploaded documents.");
            }

            $category->delete();

            Log::info('Document category deleted', [
                'admin_id' => $this->getAdminId(),
                'category_id' => $category->id,
            ]);

            return redirect()->back()->with('success', 'Category deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete category', [
                'admin_id' => $this->getAdminId(),
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Failed to delete category.');
        }
    }

    /**
     * Reorder categories
     */
    public function reorderCategories(Request $request)
    {
        $request->validate([
            'categories' => 'required|array',
            'categories.*.id' => 'required|exists:document_categories,id',
            'categories.*.sort_order' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->categories as $item) {
                DocumentCategory::where('id', $item['id'])
                    ->update(['sort_order' => $item['sort_order']]);
            }

            DB::commit();

            Log::info('Categories reordered', [
                'admin_id' => $this->getAdminId(),
                'count' => count($request->categories),
            ]);

            return response()->json(['success' => true, 'message' => 'Categories reordered successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to reorder categories', [
                'admin_id' => $this->getAdminId(),
                'error' => $e->getMessage()
            ]);
            return response()->json(['success' => false, 'message' => 'Failed to reorder categories.'], 500);
        }
    }

    /**
     * Store new document type
     */
    public function storeDocumentType(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:document_categories,id',
            'type_key' => 'required|string|max:100',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
            'is_required' => 'boolean',
            'allow_multiple' => 'boolean',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            $documentType = DocumentType::create($request->all());

            Log::info('Document type created', [
                'admin_id' => $this->getAdminId(),
                'document_type_id' => $documentType->id,
            ]);

            return redirect()->back()->with('success', 'Document type created successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to create document type', [
                'admin_id' => $this->getAdminId(),
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Failed to create document type.');
        }
    }

    /**
     * Update document type - FIXED to handle unchecked checkboxes
     */
    public function updateDocumentType(Request $request, DocumentType $documentType)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructions' => 'nullable|string',
            'sort_order' => 'nullable|integer',
        ]);

        try {
            // IMPORTANT: Handle checkboxes explicitly
            // Checkboxes don't send data when unchecked, so we need to set them manually
            $documentType->update([
                'name' => $request->name,
                'description' => $request->description,
                'instructions' => $request->instructions,
                'is_required' => $request->has('is_required'), // Will be true if checked, false if not
                'allow_multiple' => $request->has('allow_multiple'), // Will be true if checked, false if not
                'is_active' => $request->has('is_active'), // Will be true if checked, false if not
                'sort_order' => $request->sort_order ?? 0,
            ]);

            Log::info('Document type updated', [
                'admin_id' => $this->getAdminId(),
                'document_type_id' => $documentType->id,
                'is_required' => $documentType->is_required,
                'allow_multiple' => $documentType->allow_multiple,
                'is_active' => $documentType->is_active,
            ]);

            return redirect()->back()->with('success', 'Document type updated successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to update document type', [
                'admin_id' => $this->getAdminId(),
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Failed to update document type.');
        }
    }

    /**
     * Delete document type
     */
    public function destroyDocumentType(DocumentType $documentType)
    {
        try {
            // Check if document type has uploads
            $uploadCount = DropBox::where('document_type', $documentType->type_key)->count();
            
            if ($uploadCount > 0) {
                return redirect()->back()->with('error', "Cannot delete document type with {$uploadCount} uploaded documents.");
            }

            $documentType->delete();

            Log::info('Document type deleted', [
                'admin_id' => $this->getAdminId(),
                'document_type_id' => $documentType->id,
            ]);

            return redirect()->back()->with('success', 'Document type deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to delete document type', [
                'admin_id' => $this->getAdminId(),
                'error' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Failed to delete document type.');
        }
    }

    /**
     * Reorder document types
     */
    public function reorderDocumentTypes(Request $request)
    {
        $request->validate([
            'document_types' => 'required|array',
            'document_types.*.id' => 'required|exists:document_types,id',
            'document_types.*.sort_order' => 'required|integer',
        ]);

        try {
            DB::beginTransaction();

            foreach ($request->document_types as $item) {
                DocumentType::where('id', $item['id'])
                    ->update(['sort_order' => $item['sort_order']]);
            }

            DB::commit();

            Log::info('Document types reordered', [
                'admin_id' => $this->getAdminId(),
                'count' => count($request->document_types),
            ]);

            return response()->json(['success' => true, 'message' => 'Document types reordered successfully!']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Failed to reorder document types', [
                'admin_id' => $this->getAdminId(),
                'error' => $e->getMessage()
            ]);
            return response()->json(['success' => false, 'message' => 'Failed to reorder document types.'], 500);
        }
    }

    /**
     * View all user documents
     */
    public function viewUserDocuments(User $user)
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

        return view('admin.documents.user-documents', compact(
            'user',
            'visaType',
            'categories',
            'uploadedDocuments',
            'completionStats'
        ));
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
            $categoryRequired = $category->activeDocumentTypes()->where('is_required', true)->count();
            $categoryUploaded = 0;

            foreach ($category->activeDocumentTypes as $docType) {
                if ($docType->is_required && $docType->hasUploadedDocuments($userId)) {
                    $categoryUploaded++;
                }
            }

            $totalRequired += $categoryRequired;
            $totalUploaded += $categoryUploaded;

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