{{-- resources/views/admin/documents/uploaded/user-documents.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'User Documents - ' . $user->name)
@section('page-title', 'Documents: ' . $user->name)

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.users.show', $user) }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-2">
                <i class="fas fa-arrow-left mr-2"></i>Back to User Details
            </a>
            <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}'s Documents</h1>
            <p class="text-gray-600">{{ $user->email }} | Visa Type: {{ ucfirst($visaType) }}</p>
        </div>
        
        <div class="flex space-x-3">
            <a href="{{ route('admin.documents.uploaded.download-package', $user) }}" 
               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg">
                <i class="fas fa-download mr-2"></i>Download All (ZIP)
            </a>
        </div>
    </div>

    <!-- Progress Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Document Completion Progress</h3>
        
        <div class="mb-4">
            <div class="flex justify-between items-center mb-2">
                <span class="font-medium">Overall Progress</span>
                <span class="text-sm text-gray-600">
                    {{ $completionStats['total_uploaded'] }} / {{ $completionStats['total_required'] }} Required Documents
                </span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-6">
                <div class="bg-blue-600 h-6 rounded-full flex items-center justify-center text-white text-sm font-medium"
                     style="width: {{ $completionStats['overall_percentage'] }}%">
                    {{ $completionStats['overall_percentage'] }}%
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            @foreach($completionStats['categories'] as $categoryKey => $stats)
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="font-medium text-gray-900 mb-2">
                        {{ ucwords(str_replace('_', ' ', $categoryKey)) }}
                    </h4>
                    <div class="flex justify-between text-sm mb-2">
                        <span>{{ $stats['uploaded'] }} / {{ $stats['required'] }}</span>
                        <span>{{ $stats['percentage'] }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-600 h-2 rounded-full" 
                             style="width: {{ $stats['percentage'] }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Documents by Category -->
    @foreach($categories as $category)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-lg font-semibold text-gray-900">{{ $category->category_label }}</h3>
                @if($category->description)
                    <p class="text-sm text-gray-600 mt-1">{{ $category->description }}</p>
                @endif
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Document Type</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Uploaded Files</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($category->activeDocumentTypes as $docType)
                            @php
                                $uploadedDocs = isset($uploadedDocuments[$category->category_key]) 
                                    ? $uploadedDocuments[$category->category_key]->where('document_type', $docType->type_key)
                                    : collect();
                                $isUploaded = $uploadedDocs->count() > 0;
                            @endphp
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $docType->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $docType->description }}</div>
                                    @if($docType->is_required)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 mt-1">
                                            Required
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($isUploaded)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check mr-1"></i>Uploaded
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center text-sm">
                                    {{ $uploadedDocs->count() }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    @if($isUploaded)
                                        <button onclick="viewDocuments('{{ $category->category_key }}', '{{ $docType->type_key }}', '{{ $docType->name }}')"
                                                class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye mr-1"></i>View Files
                                        </button>
                                    @else
                                        <span class="text-gray-400">No files</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endforeach

    <!-- All Documents List -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold text-gray-900">All Documents ({{ $allDocuments->count() }})</h3>
        </div>
        <div class="p-6">
            @if($allDocuments->count() > 0)
                <div class="space-y-3">
                    @foreach($allDocuments as $document)
                        <div class="border border-gray-200 rounded-lg p-4 flex items-center justify-between">
                            <div class="flex items-center flex-1">
                                <i class="fas {{ $document->getIconClass() }} mr-3 text-2xl"></i>
                                <div class="flex-1">
                                    <div class="font-medium text-gray-900">{{ $document->original_filename }}</div>
                                    <div class="text-sm text-gray-500">
                                        {{ $document->document_type_label }} • 
                                        {{ $document->formatted_file_size }} • 
                                        {{ $document->created_at->format('M j, Y') }}
                                    </div>
                                    @if($document->description)
                                        <div class="text-sm text-gray-600 italic mt-1">{{ $document->description }}</div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3 ml-4">
                                @if($document->is_verified)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i>Verified
                                    </span>
                                @else
                                    <button onclick="verifyDocument({{ $document->id }})"
                                            class="inline-flex items-center px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded">
                                        <i class="fas fa-check mr-1"></i>Verify
                                    </button>
                                @endif
                                
                                <a href="{{ route('admin.documents.uploaded.preview', $document->id) }}" 
                                   class="text-blue-600 hover:text-blue-900"
                                   title="Preview">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <a href="{{ route('admin.documents.uploaded.download', $document->id) }}" 
                                   class="text-green-600 hover:text-green-900"
                                   title="Download">
                                    <i class="fas fa-download"></i>
                                </a>
                                
                                <button onclick="deleteDocument({{ $document->id }}, '{{ $document->original_filename }}')"
                                        class="text-red-600 hover:text-red-900"
                                        title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-center text-gray-500 py-8">No documents uploaded yet</p>
            @endif
        </div>
    </div>
</div>

<!-- View Documents Modal -->
<div id="view-documents-modal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg max-w-4xl w-full max-h-[90vh] overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900" id="modal-title"></h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6 overflow-y-auto max-h-[70vh]" id="modal-content">
                <!-- Content will be loaded here -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    const uploadedDocuments = @json($uploadedDocuments);

    function viewDocuments(category, docType, docName) {
        const categoryDocs = uploadedDocuments[category] || [];
        const filteredDocs = categoryDocs.filter(doc => doc.document_type === docType);
        
        document.getElementById('modal-title').textContent = docName;
        
        let html = '';
        if (filteredDocs.length === 0) {
            html = '<p class="text-gray-500">No documents found.</p>';
        } else {
            html = '<div class="space-y-4">';
            filteredDocs.forEach(doc => {
                const verifiedBadge = doc.is_verified 
                    ? '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800"><i class="fas fa-check-circle mr-1"></i>Verified</span>'
                    : '<button onclick="verifyDocument(' + doc.id + ')" class="inline-flex items-center px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-sm rounded"><i class="fas fa-check mr-1"></i>Verify</button>';
                
                html += `
                    <div class="border border-gray-200 rounded-lg p-4">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <i class="fas ${getFileIcon(doc.name)} mr-2"></i>
                                    <h4 class="font-medium text-gray-900">${doc.original_filename}</h4>
                                </div>
                                <div class="text-sm text-gray-500 space-y-1">
                                    <div>Size: ${doc.formatted_file_size}</div>
                                    <div>Uploaded: ${formatDate(doc.created_at)}</div>
                                    ${doc.description ? `<div class="mt-2 italic">"${doc.description}"</div>` : ''}
                                </div>
                                <div class="mt-2">
                                    ${verifiedBadge}
                                </div>
                            </div>
                            <div class="flex space-x-2 ml-4">
                                <a href="/admin/documents/uploaded/${doc.id}/preview" target="_blank" 
                                   class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg">
                                    <i class="fas fa-eye mr-2"></i>View
                                </a>
                                <a href="/admin/documents/uploaded/${doc.id}/download"
                                   class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg">
                                    <i class="fas fa-download mr-2"></i>Download
                                </a>
                            </div>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
        }
        
        document.getElementById('modal-content').innerHTML = html;
        document.getElementById('view-documents-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('view-documents-modal').classList.add('hidden');
    }

    function verifyDocument(documentId) {
        if (!confirm('Mark this document as verified?')) {
            return;
        }

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
                location.reload();
            } else {
                alert('Failed to verify document');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        });
    }

    function deleteDocument(id, filename) {
        if (!confirm(`Delete "${filename}"?`)) {
            return;
        }

        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/documents/uploaded/${id}`;
        
        const csrf = document.createElement('input');
        csrf.type = 'hidden';
        csrf.name = '_token';
        csrf.value = '{{ csrf_token() }}';
        
        const method = document.createElement('input');
        method.type = 'hidden';
        method.name = '_method';
        method.value = 'DELETE';
        
        form.appendChild(csrf);
        form.appendChild(method);
        document.body.appendChild(form);
        form.submit();
    }

    function getFileIcon(filename) {
        const ext = filename.split('.').pop().toLowerCase();
        const iconMap = {
            'pdf': 'fa-file-pdf text-red-600',
            'doc': 'fa-file-word text-blue-600',
            'docx': 'fa-file-word text-blue-600',
            'jpg': 'fa-file-image text-green-600',
            'jpeg': 'fa-file-image text-green-600',
            'png': 'fa-file-image text-green-600',
            'txt': 'fa-file-alt text-gray-600'
        };
        return iconMap[ext] || 'fa-file text-gray-600';
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString() + ' ' + date.toLocaleTimeString();
    }

    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Close modal on backdrop click
    document.getElementById('view-documents-modal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endpush