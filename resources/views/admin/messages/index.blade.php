{{-- resources/views/admin/messages/index.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Messages')
@section('page-title', 'Messages')

@section('content')
<div class="space-y-6">
    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-slate-800">{{ number_format($stats['total_messages']) }}</p>
                    <p class="text-xs text-slate-500">Total Messages</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fas fa-envelope text-blue-500"></i>
                </div>
            </div>
        </div>
        <a href="{{ route('admin.messages.index', ['read_status' => 'unread']) }}"
           class="bg-white rounded-xl border border-slate-200 p-4 hover:border-amber-300 transition-all {{ request('read_status') === 'unread' ? 'ring-2 ring-amber-400' : '' }}">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-amber-600">{{ number_format($stats['unread_messages']) }}</p>
                    <p class="text-xs text-slate-500">Unread</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-amber-50 flex items-center justify-center">
                    <i class="fas fa-envelope-open text-amber-500"></i>
                </div>
            </div>
        </a>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-emerald-600">{{ number_format($stats['user_messages']) }}</p>
                    <p class="text-xs text-slate-500">From Users</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center">
                    <i class="fas fa-user text-emerald-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-2xl font-bold text-purple-600">{{ number_format($stats['admin_messages']) }}</p>
                    <p class="text-xs text-slate-500">From Admins</p>
                </div>
                <div class="w-10 h-10 rounded-lg bg-purple-50 flex items-center justify-center">
                    <i class="fas fa-user-shield text-purple-500"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters & Actions -->
    <div class="bg-white rounded-xl border border-slate-200 p-5">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <form method="GET" action="{{ route('admin.messages.index') }}" class="flex flex-wrap items-center gap-3 flex-1">
                <select name="user_id" class="px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
                <select name="sender_type" class="px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    <option value="">All Senders</option>
                    <option value="user" {{ request('sender_type') === 'user' ? 'selected' : '' }}>Users</option>
                    <option value="admin" {{ request('sender_type') === 'admin' ? 'selected' : '' }}>Admins</option>
                </select>
                <select name="read_status" class="px-3 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                    <option value="">All Messages</option>
                    <option value="unread" {{ request('read_status') === 'unread' ? 'selected' : '' }}>Unread</option>
                    <option value="read" {{ request('read_status') === 'read' ? 'selected' : '' }}>Read</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium">
                    <i class="fas fa-filter mr-1"></i>Filter
                </button>
                <a href="{{ route('admin.messages.index') }}" class="px-3 py-2 text-slate-500 hover:text-slate-700 text-sm">Clear</a>
            </form>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.messages.mark-all-read') }}" 
                   class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 text-sm font-medium">
                    <i class="fas fa-check-double mr-2"></i>Mark All Read
                </a>
            </div>
        </div>
    </div>

    <!-- Bulk Actions (shown when selected) -->
    <div id="bulk-actions" class="hidden bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-center justify-between">
        <span class="text-sm text-blue-700"><span id="selected-count">0</span> messages selected</span>
        <div class="flex items-center space-x-2">
            <button onclick="bulkMarkAsRead()" class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-sm font-medium hover:bg-emerald-700">
                <i class="fas fa-check mr-1"></i>Mark Read
            </button>
            <button onclick="bulkDelete()" class="px-3 py-1.5 bg-red-600 text-white rounded-lg text-sm font-medium hover:bg-red-700">
                <i class="fas fa-trash mr-1"></i>Delete
            </button>
        </div>
    </div>

    <!-- Messages List -->
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
        @if($messages->count() > 0)
        <div class="divide-y divide-slate-100">
            @foreach($messages as $message)
            <div class="flex items-start p-5 hover:bg-slate-50 {{ !$message->read_at && $message->sender_type === 'user' ? 'bg-blue-50/50' : '' }}">
                <!-- Checkbox -->
                <input type="checkbox" class="message-checkbox mt-1 mr-4 rounded border-slate-300 text-blue-600" 
                       value="{{ $message->id }}" onchange="updateBulkActions()">
                
                <!-- Avatar -->
                <div class="flex-shrink-0 mr-4">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $message->sender_type === 'admin' ? 'bg-purple-100' : 'bg-blue-100' }}">
                        <i class="fas {{ $message->sender_type === 'admin' ? 'fa-user-shield text-purple-600' : 'fa-user text-blue-600' }} text-sm"></i>
                    </div>
                </div>

                <!-- Content -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center flex-wrap gap-2 mb-1">
                        <span class="text-sm font-medium text-slate-800">{{ $message->sender_name }}</span>
                        <span class="text-slate-300">→</span>
                        <a href="{{ route('admin.users.show', $message->user_id) }}" class="text-sm text-blue-600 hover:text-blue-700">
                            {{ $message->user->name }}
                        </a>
                        @if($message->priority === 'high')
                            <span class="px-1.5 py-0.5 text-xs bg-red-100 text-red-700 rounded">High</span>
                        @endif
                        @if(!$message->read_at && $message->sender_type === 'user')
                            <span class="px-1.5 py-0.5 text-xs bg-amber-100 text-amber-700 rounded">Unread</span>
                        @endif
                    </div>
                    <p class="text-sm font-medium text-slate-700">{{ $message->subject }}</p>
                    <p class="text-sm text-slate-500 mt-1 line-clamp-1">{{ Str::limit($message->message, 120) }}</p>
                    <div class="flex items-center space-x-4 mt-2 text-xs text-slate-400">
                        <span>{{ $message->created_at->format('M j, Y g:i A') }}</span>
                        <span>App #{{ $message->application_id }}</span>
                        @if($message->attachments && count($message->attachments) > 0)
                            <span><i class="fas fa-paperclip mr-1"></i>{{ count($message->attachments) }}</span>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center space-x-2 ml-4">
                    <a href="{{ route('admin.messages.conversation', [$message->user_id, $message->application_id]) }}"
                       class="px-3 py-1.5 bg-blue-50 text-blue-700 rounded-lg text-sm font-medium hover:bg-blue-100">
                        <i class="fas fa-comments mr-1"></i>View
                    </a>
                    @if(!$message->read_at && $message->sender_type === 'user')
                    <button onclick="markAsRead({{ $message->id }})"
                            class="p-2 text-slate-400 hover:text-emerald-600" title="Mark as read">
                        <i class="fas fa-check"></i>
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @if($messages->hasPages())
        <div class="px-5 py-4 border-t border-slate-200">
            {{ $messages->links() }}
        </div>
        @endif
        @else
        <div class="px-6 py-12 text-center">
            <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-full flex items-center justify-center">
                <i class="fas fa-inbox text-slate-400 text-2xl"></i>
            </div>
            <h3 class="text-lg font-medium text-slate-800 mb-1">No messages found</h3>
            <p class="text-sm text-slate-500">Try adjusting your filters</p>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
function updateBulkActions() {
    const checked = document.querySelectorAll('.message-checkbox:checked');
    const bulkDiv = document.getElementById('bulk-actions');
    document.getElementById('selected-count').textContent = checked.length;
    bulkDiv.classList.toggle('hidden', checked.length === 0);
}

function getSelectedIds() {
    return Array.from(document.querySelectorAll('.message-checkbox:checked')).map(cb => cb.value);
}

function markAsRead(id) {
    fetch(`/admin/messages/${id}/mark-read`, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'}
    }).then(r => r.json()).then(d => d.success && location.reload());
}

function bulkMarkAsRead() {
    const ids = getSelectedIds();
    if(!ids.length) return;
    fetch('/admin/messages/bulk-mark-read', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'},
        body: JSON.stringify({message_ids: ids})
    }).then(r => r.json()).then(d => d.success && location.reload());
}

function bulkDelete() {
    const ids = getSelectedIds();
    if(!ids.length || !confirm(`Delete ${ids.length} message(s)?`)) return;
    fetch('/admin/messages/bulk-delete', {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json'},
        body: JSON.stringify({message_ids: ids})
    }).then(r => r.json()).then(d => d.success && location.reload());
}
</script>
@endpush