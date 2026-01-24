{{-- resources/views/admin/documents/uploaded/preview.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Document Preview')
@section('page-title', 'Document Preview')

@section('content')
<div class="space-y-6">
    <!-- Header with Back Button -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ url()->previous() }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-2">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
            <h1 class="text-2xl font-bold text-gray-900">{{ $document->original_filename }}</h1>
        </div>
        
        <div class="flex space-x-3">
            <!-- Download Button -->
            <a href="{{ route('admin.documents.uploaded.download', $document) }}" 
               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-download mr-2"></i>Download
            </a>
            
            <!-- Verify Button -->
            @if(!$document->is_verified)
                <button onclick="verifyDocument({{ $document->id }})"
                        id="verify-btn"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-check mr-2"></i>Mark as Verified
                </button>
            @endif
            
            <!-- Delete Button -->
            <button onclick="confirmDelete()"
                    class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-trash mr-2"></i>Delete
            </button>
        </div>
    </div>

    <!-- Document Information Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Document Information</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- User Info -->
            <div>
                <label class="block text-sm font-medium text-gray-500">Uploaded By</label>
                <p class="text-gray-900">
                    {{ $document->user->name ?? 'Unknown User' }}
                </p>
                @if($document->user)
                    <a href="{{ route('admin.users.show', $document->user) }}" 
                       class="text-sm text-blue-600 hover:text-blue-800">
                        View User Profile →
                    </a>
                @endif
            </div>
            
            <!-- Upload Date -->
            <div>
                <label class="block text-sm font-medium text-gray-500">Upload Date</label>
                <p class="text-gray-900">{{ $document->created_at->format('M j, Y H:i') }}</p>
                <p class="text-xs text-gray-500">{{ $document->created_at->diffForHumans() }}</p>
            </div>
            
            <!-- File Size -->
            <div>
                <label class="block text-sm font-medium text-gray-500">File Size</label>
                <p class="text-gray-900">{{ $document->formatted_file_size }}</p>
            </div>
            
            <!-- File Type -->
            <div>
                <label class="block text-sm font-medium text-gray-500">File Type</label>
                <p class="text-gray-900">
                    <i class="fas {{ $document->getIconClass() }} mr-2"></i>
                    {{ strtoupper($document->getExtension()) }} - {{ $document->getMimeTypeDescription() }}
                </p>
            </div>
            
            <!-- Visa Type -->
            @if($document->visa_type)
                <div>
                    <label class="block text-sm font-medium text-gray-500">Visa Type</label>
                    <p class="text-gray-900">{{ ucfirst($document->visa_type) }}</p>
                </div>
            @endif
            
            <!-- Document Category -->
            @if($document->document_category)
                <div>
                    <label class="block text-sm font-medium text-gray-500">Category</label>
                    <p class="text-gray-900">{{ ucfirst(str_replace('_', ' ', $document->document_category)) }}</p>
                </div>
            @endif
            
            <!-- Document Type -->
            @if($document->document_type)
                <div>
                    <label class="block text-sm font-medium text-gray-500">Document Type</label>
                    <p class="text-gray-900">{{ $document->document_type_label }}</p>
                </div>
            @endif
            
            <!-- Verification Status -->
            <div>
                <label class="block text-sm font-medium text-gray-500">Verification Status</label>
                @if($document->is_verified)
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>Verified
                    </span>
                    @if($document->verified_at)
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $document->verified_at->format('M j, Y H:i') }}
                        </p>
                    @endif
                @else
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i>Pending Verification
                    </span>
                @endif
            </div>
        </div>
        
        <!-- Description -->
        @if($document->description)
            <div class="mt-6 pt-6 border-t border-gray-200">
                <label class="block text-sm font-medium text-gray-500 mb-2">Description</label>
                <p class="text-gray-900 italic">"{{ $document->description }}"</p>
            </div>
        @endif
    </div>

    <!-- Document Preview -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Document Preview</h3>
        
        <div class="border border-gray-200 rounded-lg overflow-hidden">
            @if($document->isPdf())
                <!-- PDF Preview -->
                <div class="bg-gray-100 p-4 text-center">
                    <i class="fas fa-file-pdf text-red-600 text-6xl mb-4"></i>
                    <p class="text-gray-700 mb-4">PDF Document</p>
                    <div class="space-y-3">
                        <a href="{{ $document->file_url }}" 
                           target="_blank"
                           class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg">
                            <i class="fas fa-external-link-alt mr-2"></i>Open in New Tab
                        </a>
                    </div>
                </div>
                
                <!-- PDF Embed (Optional) -->
                <div class="w-full" style="height: 800px;">
                    <iframe src="{{ $document->file_url }}" 
                            class="w-full h-full border-0"
                            title="PDF Preview">
                    </iframe>
                </div>
                
            @elseif($document->isImage())
                <!-- Image Preview -->
                <div class="bg-gray-50 p-4">
                    <img src="{{ $document->file_url }}" 
                         alt="{{ $document->original_filename }}"
                         class="max-w-full h-auto mx-auto rounded-lg shadow-lg"
                         style="max-height: 800px;">
                </div>
                
            @elseif($document->isDocument())
                <!-- Word/Excel Documents -->
                <div class="bg-gray-100 p-8 text-center">
                    <i class="fas {{ $document->getIconClass() }} text-6xl mb-4"></i>
                    <p class="text-gray-700 mb-2 text-lg font-medium">{{ $document->getMimeTypeDescription() }}</p>
                    <p class="text-gray-500 mb-6">Preview not available for this file type</p>
                    <div class="space-x-3">
                        <a href="{{ route('admin.documents.uploaded.download', $document) }}" 
                           class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                            <i class="fas fa-download mr-2"></i>Download to View
                        </a>
                    </div>
                </div>
                
            @else
                <!-- Other File Types -->
                <div class="bg-gray-100 p-8 text-center">
                    <i class="fas fa-file text-gray-400 text-6xl mb-4"></i>
                    <p class="text-gray-700 mb-2">{{ $document->original_filename }}</p>
                    <p class="text-gray-500 mb-6">Preview not available for this file type</p>
                    <a href="{{ route('admin.documents.uploaded.download', $document) }}" 
                       class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg">
                        <i class="fas fa-download mr-2"></i>Download File
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="delete-modal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Delete Document</h3>
                    <p class="text-sm text-gray-500">This action cannot be undone</p>
                </div>
            </div>
            
            <p class="text-gray-700 mb-6">
                Are you sure you want to delete <strong>{{ $document->original_filename }}</strong>?
            </p>
            
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()" 
                        class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                    Cancel
                </button>
                
                <form action="{{ route('admin.documents.uploaded.destroy', $document) }}" 
                      method="POST" 
                      class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-colors">
                        Delete Document
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    /**
     * Verify document via AJAX
     */
    function verifyDocument(documentId) {
        const btn = document.getElementById('verify-btn');
        
        if (!btn) return;
        
        // Disable button
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Verifying...';
        
        fetch(`/admin/documents/uploaded/${documentId}/verify`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reload page to show updated status
                location.reload();
            } else {
                alert('Failed to verify document: ' + (data.message || 'Unknown error'));
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-check mr-2"></i>Mark as Verified';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while verifying the document');
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-check mr-2"></i>Mark as Verified';
        });
    }
    
    /**
     * Show delete confirmation modal
     */
    function confirmDelete() {
        document.getElementById('delete-modal').classList.remove('hidden');
    }
    
    /**
     * Close delete confirmation modal
     */
    function closeDeleteModal() {
        document.getElementById('delete-modal').classList.add('hidden');
    }
    
    // Close modal on ESC key press
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
    
    // Close modal when clicking on backdrop
    document.getElementById('delete-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
</script>
@endpush