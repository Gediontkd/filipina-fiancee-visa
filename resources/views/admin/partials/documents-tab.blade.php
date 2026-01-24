{{-- resources/views/admin/users/partials/documents-tab.blade.php --}}
@php
    $documents = $user->dropboxFiles;
    $verified = $documents->where('is_verified', true)->count();
    $unverified = $documents->where('is_verified', false)->count();
    $totalSize = $documents->sum('file_size');
@endphp

<div class="space-y-6">
    <!-- Document Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-2xl font-bold text-slate-800">{{ $documents->count() }}</p>
            <p class="text-xs text-slate-500">Total Documents</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-2xl font-bold text-emerald-600">{{ $verified }}</p>
            <p class="text-xs text-slate-500">Verified</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-2xl font-bold text-amber-600">{{ $unverified }}</p>
            <p class="text-xs text-slate-500">Pending</p>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-2xl font-bold text-slate-800">{{ formatFileSize($totalSize) }}</p>
            <p class="text-xs text-slate-500">Total Size</p>
        </div>
    </div>

    <!-- Actions Bar -->
    @if($documents->count() > 0)
    <div class="flex items-center justify-between bg-white rounded-xl border border-slate-200 px-4 py-3">
        <div class="flex items-center space-x-4">
            <label class="flex items-center space-x-2 text-sm text-slate-600">
                <input type="checkbox" id="select-all-docs" class="rounded border-slate-300 text-blue-600">
                <span>Select All</span>
            </label>
            <span class="text-sm text-slate-400" id="selected-docs-count">0 selected</span>
        </div>
        <div class="flex items-center space-x-2">
            <button onclick="bulkVerifyDocs()" id="bulk-verify-btn" disabled
                    class="px-3 py-1.5 text-sm font-medium bg-emerald-50 text-emerald-700 rounded-lg hover:bg-emerald-100 disabled:opacity-50 disabled:cursor-not-allowed">
                <i class="fas fa-check mr-1"></i>Verify Selected
            </button>
            <a href="{{ route('admin.documents.uploaded.download-package', $user) }}"
               class="px-3 py-1.5 text-sm font-medium bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100">
                <i class="fas fa-download mr-1"></i>Download All
            </a>
        </div>
    </div>
    @endif

    <!-- Documents List -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        @if($documents->count() > 0)
        <div class="divide-y divide-slate-100">
            @foreach($documents->groupBy('document_category') as $category => $categoryDocs)
            <div x-data="{ open: true }">
                <!-- Category Header -->
                <div @click="open = !open" class="px-6 py-3 bg-slate-50 flex items-center justify-between cursor-pointer hover:bg-slate-100">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-folder text-blue-500"></i>
                        <span class="font-medium text-slate-700">{{ ucwords(str_replace('_', ' ', $category)) }}</span>
                        <span class="px-2 py-0.5 text-xs bg-slate-200 text-slate-600 rounded-full">{{ $categoryDocs->count() }}</span>
                    </div>
                    <i class="fas fa-chevron-down text-slate-400 transition-transform" :class="open && 'rotate-180'"></i>
                </div>

                <!-- Documents in Category -->
                <div x-show="open" x-collapse class="divide-y divide-slate-50">
                    @foreach($categoryDocs as $doc)
                    <div class="px-6 py-4 flex items-center hover:bg-slate-50 group">
                        <input type="checkbox" class="doc-checkbox rounded border-slate-300 text-blue-600 mr-4" 
                               value="{{ $doc->id }}" data-verified="{{ $doc->is_verified ? '1' : '0' }}">
                        
                        <!-- File Icon -->
                        <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center mr-4">
                            @php
                                $ext = pathinfo($doc->original_filename, PATHINFO_EXTENSION);
                                $icons = ['pdf' => 'fa-file-pdf text-red-500', 'jpg' => 'fa-file-image text-blue-500', 'jpeg' => 'fa-file-image text-blue-500', 'png' => 'fa-file-image text-blue-500'];
                            @endphp
                            <i class="fas {{ $icons[strtolower($ext)] ?? 'fa-file text-slate-400' }}"></i>
                        </div>

                        <!-- File Info -->
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-slate-800 truncate">{{ $doc->original_filename }}</p>
                            <p class="text-xs text-slate-500">
                                {{ $doc->document_type_label ?? 'Document' }} • {{ formatFileSize($doc->file_size) }} • {{ $doc->created_at->format('M j, Y') }}
                            </p>
                        </div>

                        <!-- Status -->
                        <div class="mx-4">
                            @if($doc->is_verified)
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-emerald-50 text-emerald-700">
                                    <i class="fas fa-check-circle mr-1"></i>Verified
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-amber-50 text-amber-700">
                                    <i class="fas fa-clock mr-1"></i>Pending
                                </span>
                            @endif
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                            <a href="{{ route('admin.documents.uploaded.preview', $doc->id) }}" 
                               class="p-2 text-slate-400 hover:text-blue-600" title="Preview">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.documents.uploaded.download', $doc->id) }}"
                               class="p-2 text-slate-400 hover:text-emerald-600" title="Download">
                                <i class="fas fa-download"></i>
                            </a>
                            @if(!$doc->is_verified)
                            <button onclick="verifySingleDoc({{ $doc->id }})" 
                                    class="p-2 text-slate-400 hover:text-emerald-600" title="Verify">
                                <i class="fas fa-check"></i>
                            </button>
                            @endif
                            <button onclick="deleteDoc({{ $doc->id }}, '{{ addslashes($doc->original_filename) }}')"
                                    class="p-2 text-slate-400 hover:text-red-600" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="px-6 py-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-full flex items-center justify-center">
                <i class="fas fa-folder-open text-slate-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-slate-800 mb-1">No documents</h3>
            <p class="text-sm text-slate-500">This user hasn't uploaded any documents yet</p>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.getElementById('select-all-docs')?.addEventListener('change', function() {
    document.querySelectorAll('.doc-checkbox').forEach(cb => cb.checked = this.checked);
    updateDocSelection();
});
document.querySelectorAll('.doc-checkbox').forEach(cb => cb.addEventListener('change', updateDocSelection));

function updateDocSelection() {
    const checked = document.querySelectorAll('.doc-checkbox:checked');
    document.getElementById('selected-docs-count').textContent = `${checked.length} selected`;
    document.getElementById('bulk-verify-btn').disabled = checked.length === 0;
}

function verifySingleDoc(id) {
    if(!confirm('Verify this document?')) return;
    fetch(`/admin/documents/uploaded/${id}/verify`, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'}
    }).then(r => r.json()).then(d => d.success && location.reload());
}

function bulkVerifyDocs() {
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
function formatFileSize($bytes) {
    if ($bytes == 0) return '0 B';
    $units = ['B', 'KB', 'MB', 'GB'];
    $i = 0;
    while ($bytes > 1024 && $i < count($units) - 1) { $bytes /= 1024; $i++; }
    return round($bytes, 1) . ' ' . $units[$i];
}
@endphp