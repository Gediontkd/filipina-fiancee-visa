{{-- resources/views/admin/users/documents.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'User Documents')
@section('page-title', 'User Documents')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.users.show', $user) }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-2">
                <i class="fas fa-arrow-left mr-2"></i>Back to User Details
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Documents - {{ $user->name }}</h1>
            <p class="text-gray-600">Visa Type: {{ ucfirst($visaType) }}</p>
        </div>
    </div>

    <!-- Document Progress -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Document Completion Progress</h3>
        
        <div class="mb-4">
            <div class="flex justify-content-between items-center mb-2">
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
                        {{ \App\Config\DocumentRequirements::getCategoryLabel($categoryKey) }}
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
    @foreach($requirements as $categoryKey => $category)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b">
                <h3 class="text-lg font-semibold text-gray-900">{{ $category['label'] }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Document Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Uploaded Files</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($category['documents'] as $doc)
                            @php
                                $uploadedDocs = isset($uploadedDocuments[$categoryKey]) 
                                    ? $uploadedDocuments[$categoryKey]->where('document_type', $doc['id'])
                                    : collect();
                                $isUploaded = $uploadedDocs->count() > 0;
                            @endphp
                            <tr>
                                <td class="px-6 py-4">
                                    <div class="font-medium text-gray-900">{{ $doc['name'] }}</div>
                                    @if($doc['required'])
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            Required
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Optional
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $doc['description'] }}
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
                                        <button onclick="viewDocuments('{{ $categoryKey }}', '{{ $doc['id'] }}', '{{ $doc['name'] }}')"
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
                    : '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800"><i class="fas fa-clock mr-1"></i>Unverified</span>';
                
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
                                <a href="${doc.file_url}" target="_blank" 
                                   class="inline-flex items-center px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm rounded-lg">
                                    <i class="fas fa-eye mr-2"></i>View
                                </a>
                                ${!doc.is_verified ? `
                                    <button onclick="verifyDocument(${doc.id})"
                                            class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg">
                                        <i class="fas fa-check mr-2"></i>Verify
                                    </button>
                                ` : ''}
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

        fetch(`/admin/documents/${documentId}/verify`, {
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
    document.getElementById('view-documents-modal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>
@endpush