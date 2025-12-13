{{-- resources/views/admin/messages/index.blade.php (ENHANCED VERSION) --}}
@extends('admin.layouts.app')

@section('title', 'Messages')
@section('page-title', 'Message Management')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-envelope text-blue-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total Messages</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['total_messages']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-circle text-yellow-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Unread Messages</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['unread_messages']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-green-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">From Users</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['user_messages']) }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-shield text-purple-600"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">From Admins</p>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format($stats['admin_messages']) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
            <div>
                <h3 class="text-lg font-medium text-gray-900">All Messages</h3>
                <p class="text-sm text-gray-500 mt-1">Total: {{ $messages->total() }} messages</p>
            </div>
            
            <div class="flex space-x-3 mt-4 sm:mt-0">
                <!-- Bulk Actions (shown when messages are selected) -->
                <div id="bulk-actions" class="hidden">
                    <span id="selected-count" class="text-sm text-gray-600 mr-3"></span>
                    <button onclick="bulkMarkAsRead()" 
                            class="inline-flex items-center px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition-colors mr-2">
                        <i class="fas fa-check-double mr-2"></i>Mark Read
                    </button>
                    <button onclick="bulkDelete()" 
                            class="inline-flex items-center px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-sm rounded-lg transition-colors">
                        <i class="fas fa-trash mr-2"></i>Delete
                    </button>
                </div>
                
                <a href="{{ route('admin.messages.mark-all-read') }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-check-double mr-2"></i>Mark All Read
                </a>
            </div>
        </div>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.messages.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
            <!-- User Filter -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">User</label>
                <select id="user_id" name="user_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Users</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }} ({{ $user->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Application Filter -->
            <div>
                <label for="application_id" class="block text-sm font-medium text-gray-700 mb-1">Application</label>
                <select id="application_id" name="application_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Applications</option>
                    @foreach($applications as $app)
                        <option value="{{ $app->id }}" {{ request('application_id') == $app->id ? 'selected' : '' }}>
                            Application #{{ $app->id }} - {{ $app->visaApplication->name ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sender Type Filter -->
            <div>
                <label for="sender_type" class="block text-sm font-medium text-gray-700 mb-1">Sender</label>
                <select id="sender_type" name="sender_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Senders</option>
                    <option value="user" {{ request('sender_type') == 'user' ? 'selected' : '' }}>Users</option>
                    <option value="admin" {{ request('sender_type') == 'admin' ? 'selected' : '' }}>Admins</option>
                </select>
            </div>

            <!-- Read Status Filter -->
            <div>
                <label for="read_status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="read_status" name="read_status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Messages</option>
                    <option value="unread" {{ request('read_status') == 'unread' ? 'selected' : '' }}>Unread</option>
                    <option value="read" {{ request('read_status') == 'read' ? 'selected' : '' }}>Read</option>
                </select>
            </div>

            <!-- Priority Filter -->
            <div>
                <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                <select id="priority" name="priority" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">All Priorities</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>High</option>
                    <option value="normal" {{ request('priority') == 'normal' ? 'selected' : '' }}>Normal</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>

            <!-- Filter Actions -->
            <div class="col-span-1 sm:col-span-2 lg:col-span-5 flex flex-col sm:flex-row gap-3 pt-4">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-search mr-2"></i>Filter
                </button>
                
                <a href="{{ route('admin.messages.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors">
                    <i class="fas fa-times mr-2"></i>Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Messages List -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($messages->count() > 0)
            <div class="divide-y divide-gray-200">
                @foreach($messages as $message)
                    <div class="p-6 hover:bg-gray-50 {{ $message->isRead() ? '' : 'bg-blue-50' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4 flex-1">
                                <!-- Checkbox for bulk selection -->
                                <div class="flex-shrink-0 pt-1">
                                    <input type="checkbox" 
                                           class="message-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500" 
                                           value="{{ $message->id }}"
                                           onchange="updateBulkActions()">
                                </div>

                                <!-- Avatar -->
                                <div class="flex-shrink-0">
                                    <div class="w-10 h-10 {{ $message->isFromAdmin() ? 'bg-purple-100' : 'bg-blue-100' }} rounded-full flex items-center justify-center">
                                        <i class="fas {{ $message->isFromAdmin() ? 'fa-user-shield text-purple-600' : 'fa-user text-blue-600' }}"></i>
                                    </div>
                                </div>

                                <!-- Message Content -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center space-x-2 mb-1">
                                        <h4 class="text-sm font-medium text-gray-900">{{ $message->sender_name }}</h4>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $message->priority_color }} bg-opacity-10">
                                            {{ ucfirst($message->priority) }}
                                        </span>
                                        @if($message->is_important)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                                Important
                                            </span>
                                        @endif
                                        @if(!$message->isRead())
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Unread
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <h5 class="text-sm font-medium text-gray-900 mb-1">{{ $message->subject }}</h5>
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($message->message, 150) }}</p>
                                    
                                    <div class="flex items-center space-x-4 mt-2 text-xs text-gray-500">
                                        <span>
                                            <i class="fas fa-user mr-1"></i>{{ $message->user->name }}
                                        </span>
                                        <span>
                                            <i class="fas fa-file-alt mr-1"></i>Application #{{ $message->application_id }}
                                        </span>
                                        <span>{{ $message->formatted_date }}</span>
                                        @if($message->hasAttachments())
                                            <span>
                                                <i class="fas fa-paperclip mr-1"></i>{{ $message->attachment_count }} files
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center space-x-2 ml-4">
                                <a href="{{ route('admin.messages.conversation', [$message->user_id, $message->application_id]) }}" 
                                   class="inline-flex items-center px-3 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-sm rounded-lg transition-colors">
                                    <i class="fas fa-comments mr-1"></i>View
                                </a>
                                
                                @if(!$message->isRead())
                                    <button onclick="markAsRead({{ $message->id }})" 
                                            class="inline-flex items-center px-3 py-1 bg-green-100 hover:bg-green-200 text-green-700 text-sm rounded-lg transition-colors">
                                        <i class="fas fa-check mr-1"></i>Mark Read
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($messages->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $messages->links() }}
                </div>
            @endif
        @else
            <div class="p-8 text-center text-gray-500">
                <i class="fas fa-inbox text-4xl mb-4"></i>
                <p class="text-lg mb-2">No messages found</p>
                <p class="text-sm">Try adjusting your search filters</p>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    /**
     * Mark single message as read
     */
    function markAsRead(messageId) {
        fetch(`/admin/messages/${messageId}/mark-read`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to mark message as read');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to mark message as read');
        });
    }

    /**
     * Update bulk actions visibility based on selected checkboxes
     */
    function updateBulkActions() {
        const checkboxes = document.querySelectorAll('.message-checkbox:checked');
        const bulkActionsDiv = document.getElementById('bulk-actions');
        const selectedCount = document.getElementById('selected-count');
        
        if (checkboxes.length > 0) {
            bulkActionsDiv.classList.remove('hidden');
            selectedCount.textContent = `${checkboxes.length} selected`;
        } else {
            bulkActionsDiv.classList.add('hidden');
        }
    }

    /**
     * Get selected message IDs
     */
    function getSelectedMessageIds() {
        const checkboxes = document.querySelectorAll('.message-checkbox:checked');
        return Array.from(checkboxes).map(cb => cb.value);
    }

    /**
     * Bulk mark messages as read
     */
    function bulkMarkAsRead() {
        const messageIds = getSelectedMessageIds();
        
        if (messageIds.length === 0) {
            alert('Please select messages first');
            return;
        }

        if (!confirm(`Mark ${messageIds.length} message(s) as read?`)) {
            return;
        }

        fetch('/admin/messages/bulk-mark-read', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ message_ids: messageIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Failed to mark messages as read');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to mark messages as read');
        });
    }

    /**
     * Bulk delete messages
     */
    function bulkDelete() {
        const messageIds = getSelectedMessageIds();
        
        if (messageIds.length === 0) {
            alert('Please select messages first');
            return;
        }

        if (!confirm(`Are you sure you want to delete ${messageIds.length} message(s)? This action cannot be undone.`)) {
            return;
        }

        fetch('/admin/messages/bulk-delete', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ message_ids: messageIds })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Failed to delete messages');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Failed to delete messages');
        });
    }
</script>
@endpush