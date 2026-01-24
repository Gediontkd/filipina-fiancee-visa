{{-- resources/views/admin/documents/uploaded/index.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Uploaded Documents')
@section('page-title', 'Uploaded Documents')

@section('content')
<div class="space-y-6">
    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_documents']) }}</p>
                    <p class="text-xs text-slate-500">Total Documents</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-file text-blue-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-emerald-600">{{ number_format($stats['verified_documents']) }}</p>
                    <p class="text-xs text-slate-500">Verified</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <i class="fas fa-check-circle text-emerald-500"></i>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.documents.uploaded.index', ['verification_status' => 'unverified']) }}"
           class="bg-white rounded-xl border border-slate-200 p-4 hover:border-amber-300 transition-all {{ request('verification_status') === 'unverified' ? 'ring-2 ring-amber-400' : '' }}">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-amber-600">{{ number_format($stats['unverified_documents']) }}</p>
                    <p class="text-xs text-slate-500">Pending</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                    <i class="fas fa-clock text-amber-500"></i>
                </div>
            </div>
        </a>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-purple-600">{{ formatBytes($stats['total_size']) }}</p>
                    <p class="text-xs text-slate-500">Total Size</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center">
                    <i class="fas fa-hdd text-purple-500"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <form method="GET" action="{{ route('admin.documents.uploaded.index') }}" class="flex flex-wrap items-center gap-3">
            <div class="relative flex-1 min-w-[200px]">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Search filename..."
                       class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
            </div>
            <select name="verification_status" class="px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                <option value="">All Status</option>
                <option value="verified" {{ request('verification_status') === 'verified' ? 'selected' : '' }}>Verified</option>
                <option value="unverified" {{ request('verification_status') === 'unverified' ? 'selected' : '' }}>Pending</option>
            </select>
            <select name="visa_type" class="px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                <option value="">All Visa Types</option>
                @foreach($visaTypes as $type)
                    <option value="{{ $type }}" {{ request('visa_type') === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                @endforeach
            </select>
            <select name="category" class="px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>{{ ucwords(str_replace('_',' ',$cat)) }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
                <i class="fas fa-filter mr-1"></i>Filter
            </button>
            <a href="{{ route('admin.documents.uploaded.index') }}" class="px-3 py-2 text-slate-500 hover:text-slate-700 text-sm">Clear</a>
        </form>
    </div>

    <!-- Bulk Actions -->
    <div class="flex items-center justify-between bg-white rounded-xl border border-slate-200 px-5 py-3">
        <div class="flex items-center space-x-4">
            <label class="flex items-center space-x-2 text-sm text-slate-600">
                <input type="checkbox" id="select-all" class="rounded border-slate-300 text-blue-600">
                <span>Select All</span>
            </label>
            <span class="text-sm text-slate-400" id="selected-count">0 selected</span>
        </div>
        <button onclick="bulkVerify()" id="bulk-verify-btn" disabled
                class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700 disabled:opacity-50 disabled:cursor-not-allowed">
            <i class="fas fa-check-double mr-2"></i>Verify Selected
        </button>
    </div>

    <!-- Documents Grid -->
    @if($documents->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
        @foreach($documents as $doc)
        <div class="bg-white rounded-xl border border-slate-200 hover:border-blue-300 hover:shadow-md transition-all group">
            <div class="p-5">
                <div class="flex items-start space-x-4">
                    <input type="checkbox" class="doc-checkbox mt-1 rounded border-slate-300 text-blue-600" 
                           value="{{ $doc->id }}" data-verified="{{ $doc->is_verified ? '1' : '0' }}">
                    
                    <!-- File Icon -->
                    @php
                        $ext = strtolower(pathinfo($doc->original_filename, PATHINFO_EXTENSION));
                        $iconMap = ['pdf' => 'fa-file-pdf text-red-500 bg-red-50', 'jpg' => 'fa-file-image text-blue-500 bg-blue-50', 'jpeg' => 'fa-file-image text-blue-500 bg-blue-50', 'png' => 'fa-file-image text-emerald-500 bg-emerald-50'];
                        $iconClass = $iconMap[$ext] ?? 'fa-file text-slate-400 bg-slate-50';
                    @endphp
                    <div class="w-12 h-12 rounded-lg {{ explode(' ', $iconClass)[2] ?? 'bg-slate-50' }} flex items-center justify-center flex-shrink-0">
                        <i class="fas {{ explode(' ', $iconClass)[0] }} {{ explode(' ', $iconClass)[1] ?? 'text-slate-400' }} text-lg"></i>
                    </div>

                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-800 truncate" title="{{ $doc->original_filename }}">
                            {{ $doc->original_filename }}
                        </p>
                        <p class="text-xs text-slate-500 mt-0.5">{{ $doc->formatted_file_size ?? formatBytes($doc->file_size) }}</p>
                        <div class="flex items-center space-x-2 mt-2">
                            @if($doc->is_verified)
                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-50 text-emerald-700">
                                    <i class="fas fa-check-circle mr-1"></i>Verified
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium rounded-full bg-amber-50 text-amber-700">
                                    <i class="fas fa-clock mr-1"></i>Pending
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- User & Meta -->
                <div class="mt-4 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.users.show', $doc->user) }}" class="flex items-center space-x-2 hover:text-blue-600">
                        <div class="w-6 h-6 rounded-full bg-blue-100 flex items-center justify-center">
                            <span class="text-xs text-blue-600 font-medium">{{ strtoupper(substr($doc->user->name, 0, 1)) }}</span>
                        </div>
                        <span class="text-sm text-slate-600">{{ $doc->user->name }}</span>
                    </a>
                    <div class="flex items-center justify-between mt-2 text-xs text-slate-400">
                        <span>{{ ucwords(str_replace('_',' ',$doc->document_category ?? 'Uncategorized')) }}</span>
                        <span>{{ $doc->created_at->format('M j, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="px-5 py-3 bg-slate-50 rounded-b-xl border-t border-slate-100 flex items-center justify-between opacity-0 group-hover:opacity-100 transition-opacity">
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.documents.uploaded.preview', $doc->id) }}" class="p-2 text-slate-500 hover:text-blue-600" title="Preview">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.documents.uploaded.download', $doc->id) }}" class="p-2 text-slate-500 hover:text-emerald-600" title="Download">
                        <i class="fas fa-download"></i>
                    </a>
                </div>
                <div class="flex items-center space-x-2">
                    @if(!$doc->is_verified)
                    <button onclick="verifyDoc({{ $doc->id }})" class="p-2 text-slate-500 hover:text-emerald-600" title="Verify">
                        <i class="fas fa-check"></i>
                    </button>
                    @endif
                    <button onclick="deleteDoc({{ $doc->id }}, '{{ addslashes($doc->original_filename) }}')" class="p-2 text-slate-500 hover:text-red-600" title="Delete">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($documents->hasPages())
    <div class="flex justify-center">
        {{ $documents->links() }}
    </div>
    @endif
    @else
    <div class="bg-white rounded-xl border border-slate-200 px-6 py-12 text-center">
        <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-full flex items-center justify-center">
            <i class="fas fa-folder-open text-slate-400 text-2xl"></i>
        </div>
        <h3 class="text-lg font-medium text-slate-800 mb-1">No documents found</h3>
        <p class="text-sm text-slate-500">Try adjusting your search filters</p>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
document.getElementById('select-all')?.addEventListener('change', function() {
    document.querySelectorAll('.doc-checkbox').forEach(cb => cb.checked = this.checked);
    updateSelection();
});
document.querySelectorAll('.doc-checkbox').forEach(cb => cb.addEventListener('change', updateSelection));

function updateSelection() {
    const checked = document.querySelectorAll('.doc-checkbox:checked');
    document.getElementById('selected-count').textContent = `${checked.length} selected`;
    document.getElementById('bulk-verify-btn').disabled = checked.length === 0;
}

function verifyDoc(id) {
    if(!confirm('Verify this document?')) return;
    fetch(`/admin/documents/uploaded/${id}/verify`, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'}
    }).then(r => r.json()).then(d => d.success && location.reload());
}

function bulkVerify() {
    const ids = Array.from(document.querySelectorAll('.doc-checkbox:checked')).map(cb => parseInt(cb.value));
    if(!ids.length || !confirm(`Verify ${ids.length} document(s)?`)) return;
    fetch('{{ route("admin.documents.uploaded.bulk-verify") }}', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'},
        body: JSON.stringify({document_ids: ids})
    }).then(r => r.json()).then(d => d.success && location.reload());
}

function deleteDoc(id, name) {
    if(!confirm(`Delete "${name}"?`)) return;
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = `/admin/documents/uploaded/${id}`;
    form.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}"><input type="hidden" name="_method" value="DELETE">`;
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
    while ($bytes > 1024 && $i < count($units) - 1) { $bytes /= 1024; $i++; }
    return round($bytes, 1) . ' ' . $units[$i];
}
@endphp