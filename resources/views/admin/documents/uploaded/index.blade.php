{{-- resources/views/admin/documents/uploaded/index.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Uploaded Documents')
@section('page-title', 'All Uploaded Documents')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-file text-blue-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Documents</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_documents']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Verified</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['verified_documents']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Pending Verification</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['unverified_documents']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-hdd text-purple-600 text-xl"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Size</p>
                    <p class="text-2xl font-bold text-gray-900">{{ formatBytes($stats['total_size']) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white p-6 rounded-lg shadow">
        <form method="GET" action="{{ route('admin.documents.uploaded.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            <!-- Search -->
            <div>
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                <input type="text" 
                       id="search" 
                       name="search" 
                       value="{{ request('search') }}"
                       placeholder="Filename..."
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Verification Status -->
            <div>
                <label for="verification_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="verification_status" 
                        name="verification_status"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Status</option>
                    <option value="verified" {{ request('verification_status') == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="unverified" {{ request('verification_status') == 'unverified' ? 'selected' : '' }}>Unverified</option>
                </select>
            </div>

            <!-- Visa Type -->
            <div>
                <label for="visa_type" class="block text-sm font-medium text-gray-700 mb-1">Visa Type</label>
                <select id="visa_type" 
                        name="visa_type"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Types</option>
                    @foreach($visaTypes as $type)
                        <option value="{{ $type }}" {{ request('visa_type') == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Category -->
            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                <select id="category" 
                        name="category"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ ucwords(str_replace('_', ' ', $cat)) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Actions -->
            <div class="flex items-end space-x-2">
                <button type="submit" 
                        class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                
                <a href="{{ route('admin.documents.uploaded.index') }}" 
                   class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Bulk Actions -->
    <div class="bg-white p-4 rounded-lg shadow">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <label class="flex items-center">
                    <input type="checkbox" id="select-all" class="rounded">
                    <span class="ml-2 text-sm text-gray-700">Select All</span>
                </label>
                <span id="selected-count" class="text-sm text-gray-600">0 selected</span>
            </div>
            
            <div class="flex items-center space-x-2">
                <button onclick="bulkVerify()" 
                        id="bulk-verify-btn"
                        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                    <i class="fas fa-check mr-2"></i>Verify Selected
                </button>
            </div>
        </div>
    </div>

    <!-- Documents Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            @if($documents->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left">
                                <input type="checkbox" class="rounded select-all-checkbox">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Document</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Uploaded</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($documents as $document)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <input type="checkbox" 
                                           class="rounded document-checkbox" 
                                           value="{{ $document->id }}"
                                           data-verified="{{ $document->is_verified ? '1' : '0' }}">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $document->user->name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $document->user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <i class="fas {{ $document->getIconClass() }} mr-2 text-lg"></i>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ $document->original_filename }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $document->formatted_file_size }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $document->document_type_label }}</div>
                                    <div class="text-sm text-gray-500">{{ ucwords(str_replace('_', ' ', $document->document_category)) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($document->is_verified)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-check-circle mr-1"></i>Verified
                                        </span>
                                        @if($document->verified_at)
                                            <div class="text-xs text-gray-500 mt-1">
                                                {{ $document->verified_at->format('M j, Y') }}
                                            </div>
                                        @endif
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-clock mr-1"></i>Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div>{{ $document->created_at->format('M j, Y') }}</div>
                                    <div class="text-xs">{{ $document->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex items-center space-x-2">
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
                                        
                                        @if(!$document->is_verified)
                                            <button onclick="verifyDocument({{ $document->id }})"
                                                    class="text-purple-600 hover:text-purple-900"
                                                    title="Verify">
                                                <i class="fas fa-check"></i>
                                            </button>
                                        @endif
                                        
                                        <button onclick="deleteDocument({{ $document->id }}, '{{ $document->original_filename }}')"
                                                class="text-red-600 hover:text-red-900"
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-inbox text-4xl mb-4"></i>
                    <p class="text-lg mb-2">No documents found</p>
                    <p class="text-sm">Try adjusting your search filters</p>
                </div>
            @endif
        </div>

        <!-- Pagination -->
        @if($documents->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $documents->links() }}
            </div>
        @endif
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Select all functionality
    document.getElementById('select-all')?.addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.document-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateSelectedCount();
    });

    document.querySelectorAll('.document-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedCount);
    });

    function updateSelectedCount() {
        const selected = document.querySelectorAll('.document-checkbox:checked');
        document.getElementById('selected-count').textContent = `${selected.length} selected`;
        document.getElementById('bulk-verify-btn').disabled = selected.length === 0;
    }

    function bulkVerify() {
        const selected = Array.from(document.querySelectorAll('.document-checkbox:checked'))
            .map(cb => parseInt(cb.value));
        
        if (selected.length === 0) {
            alert('Please select documents to verify');
            return;
        }

        if (!confirm(`Verify ${selected.length} document(s)?`)) {
            return;
        }

        fetch('{{ route("admin.documents.uploaded.bulk-verify") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ document_ids: selected })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to verify documents');
            }
        });
    }

    function verifyDocument(id) {
        if (!confirm('Verify this document?')) {
            return;
        }

        fetch(`/admin/documents/uploaded/${id}/verify`, {
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
</script>
@endpush

@php
function formatBytes($bytes) {
    if ($bytes == 0) return '0 B';
    $units = ['B', 'KB', 'MB', 'GB'];
    $i = 0;
    while ($bytes > 1024 && $i < count($units) - 1) {
        $bytes /= 1024;
        $i++;
    }
    return round($bytes, 2) . ' ' . $units[$i];
}
@endphp