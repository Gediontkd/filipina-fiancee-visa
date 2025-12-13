{{-- resources/views/components/messaging-panel.blade.php --}}
@props(['userType' => 'user'])

@php
    // Determine if this is for admin or regular user
    $isAdmin = $userType === 'admin';
    
    // Get unread count based on user type
    if ($isAdmin) {
        $unreadCount = \App\Models\Message::where('sender_type', 'user')
            ->whereNull('read_at')
            ->count();
    } else {
        $unreadCount = \App\Models\Message::where('user_id', Auth::id())
            ->where('sender_type', 'admin')
            ->whereNull('read_at')
            ->count();
    }
@endphp

<!-- Message Notification Icon -->
<div class="relative inline-block" x-data="{ open: false }">
    <!-- Bell Icon with Badge -->
    <button @click="open = !open" 
            type="button"
            class="relative p-2 text-gray-600 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 rounded-full"
            aria-label="View messages">
        <i class="fas fa-bell text-xl"></i>
        
        @if($unreadCount > 0)
            <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
            </span>
        @endif
    </button>

    <!-- Slide-out Panel -->
    <div x-show="open" 
         @click.away="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="fixed inset-y-0 right-0 z-50 w-full sm:w-96 bg-white shadow-2xl overflow-hidden"
         style="display: none;">
        
        <div class="h-full flex flex-col">
            <!-- Panel Header -->
            <div class="flex items-center justify-between px-4 py-3 bg-blue-600 text-white">
                <div class="flex items-center">
                    <i class="fas fa-comments mr-2"></i>
                    <h3 class="text-lg font-semibold">Messages</h3>
                    @if($unreadCount > 0)
                        <span class="ml-2 px-2 py-1 text-xs bg-red-500 rounded-full">
                            {{ $unreadCount }} new
                        </span>
                    @endif
                </div>
                <button @click="open = false" class="text-white hover:text-gray-200">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <!-- Quick Actions -->
            <div class="px-4 py-2 bg-gray-50 border-b flex gap-2">
                @if($isAdmin)
                    <a href="{{ route('admin.messages.index') }}" 
                       class="text-xs text-blue-600 hover:text-blue-800">
                        <i class="fas fa-inbox mr-1"></i>Full Inbox
                    </a>
                    <button onclick="loadMessages()" 
                            class="text-xs text-gray-600 hover:text-gray-800">
                        <i class="fas fa-sync-alt mr-1"></i>Refresh
                    </button>
                @else
                    <a href="{{ route('messages.index') }}" 
                       class="text-xs text-blue-600 hover:text-blue-800">
                        <i class="fas fa-inbox mr-1"></i>Full Inbox
                    </a>
                    <a href="{{ route('messages.compose') }}" 
                       class="text-xs text-green-600 hover:text-green-800">
                        <i class="fas fa-edit mr-1"></i>Compose
                    </a>
                    <button onclick="loadMessages()" 
                            class="text-xs text-gray-600 hover:text-gray-800">
                        <i class="fas fa-sync-alt mr-1"></i>Refresh
                    </button>
                @endif
            </div>

            <!-- Messages List -->
            <div id="messages-list" class="flex-1 overflow-y-auto">
                <div class="flex items-center justify-center h-full">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-spinner fa-spin text-3xl mb-2"></i>
                        <p>Loading messages...</p>
                    </div>
                </div>
            </div>

            <!-- Quick Reply Form (shown when a message is selected) -->
            <div id="quick-reply-form" class="hidden border-t bg-gray-50 p-4">
                <form onsubmit="sendQuickReply(event)">
                    <input type="hidden" id="reply-message-id" name="message_id">
                    <input type="hidden" id="reply-user-id" name="user_id">
                    <input type="hidden" id="reply-application-id" name="application_id">
                    
                    <textarea id="quick-reply-text" 
                              name="message" 
                              rows="3" 
                              placeholder="Type your reply..." 
                              required
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mb-2"></textarea>
                    
                    <div class="flex justify-end gap-2">
                        <button type="button" 
                                onclick="hideQuickReply()"
                                class="px-3 py-1 text-sm bg-gray-200 hover:bg-gray-300 text-gray-700 rounded">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-3 py-1 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded">
                            <i class="fas fa-paper-plane mr-1"></i>Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Configuration based on user type
    const messagingConfig = {
        isAdmin: {{ $isAdmin ? 'true' : 'false' }},
        loadUrl: '{{ $isAdmin ? route("admin.messages.panel-data") : route("messages.panel-data") }}',
        markReadUrl: '{{ $isAdmin ? route("admin.messages.mark-read", ":id") : route("messages.mark-read", ":id") }}',
        replyUrl: '{{ $isAdmin ? route("admin.messages.reply", ":id") : route("messages.reply", ":id") }}',
        conversationUrl: '{{ $isAdmin ? route("admin.messages.conversation", [":userId", ":appId"]) : route("messages.conversation", ":appId") }}',
        @if($isAdmin)
        userProfileUrl: '{{ route("admin.users.show", ":userId") }}'
        @endif
    };

    /**
     * Load messages into the panel
     */
    function loadMessages() {
        const messagesList = document.getElementById('messages-list');
        messagesList.innerHTML = '<div class="flex items-center justify-center h-full"><div class="text-center text-gray-500"><i class="fas fa-spinner fa-spin text-3xl mb-2"></i><p>Loading messages...</p></div></div>';

        fetch(messagingConfig.loadUrl, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                renderMessages(data.messages);
                updateUnreadBadge(data.unread_count);
            } else {
                showError('Failed to load messages');
            }
        })
        .catch(error => {
            console.error('Error loading messages:', error);
            showError('Failed to load messages. Please try again.');
        });
    }

    /**
     * Render messages in the panel
     */
    function renderMessages(messages) {
        const messagesList = document.getElementById('messages-list');
        
        if (messages.length === 0) {
            messagesList.innerHTML = `
                <div class="flex items-center justify-center h-full">
                    <div class="text-center text-gray-500">
                        <i class="fas fa-inbox text-4xl mb-3"></i>
                        <p class="text-lg">No messages</p>
                        <p class="text-sm">You're all caught up!</p>
                    </div>
                </div>
            `;
            return;
        }

        let html = '<div class="divide-y divide-gray-200">';
        
        messages.forEach(message => {
            const isUnread = !message.read_at;
            const bgClass = isUnread ? 'bg-blue-50' : 'bg-white';
            
            html += `
                <div class="p-4 hover:bg-gray-50 cursor-pointer ${bgClass}" 
                     onclick="viewMessage(${message.id})">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full ${message.sender_type === 'admin' ? 'bg-purple-100' : 'bg-blue-100'} flex items-center justify-center mr-3">
                                <i class="fas ${message.sender_type === 'admin' ? 'fa-user-shield text-purple-600' : 'fa-user text-blue-600'} text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">${escapeHtml(message.sender_name)}</p>
                                <p class="text-xs text-gray-500">${message.formatted_date}</p>
                            </div>
                        </div>
                        ${isUnread ? '<span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">New</span>' : ''}
                    </div>
                    
                    <h4 class="text-sm font-semibold text-gray-900 mb-1">${escapeHtml(message.subject)}</h4>
                    <p class="text-sm text-gray-600 line-clamp-2">${escapeHtml(message.message_preview)}</p>
                    
                    <div class="mt-2 flex items-center gap-3 text-xs text-gray-500">
                        ${message.application_name ? `<span><i class="fas fa-file-alt mr-1"></i>${escapeHtml(message.application_name)}</span>` : ''}
                        ${message.priority === 'high' ? '<span class="text-red-600"><i class="fas fa-exclamation-circle mr-1"></i>High Priority</span>' : ''}
                        ${message.has_attachments ? `<span><i class="fas fa-paperclip mr-1"></i>${message.attachment_count} files</span>` : ''}
                    </div>
                    
                    <div class="mt-2 flex gap-2">
                        <button onclick="event.stopPropagation(); showQuickReply(${message.id}, ${message.user_id}, ${message.application_id})" 
                                class="text-xs text-blue-600 hover:text-blue-800">
                            <i class="fas fa-reply mr-1"></i>Reply
                        </button>
                        <a href="${getConversationUrl(message.user_id, message.application_id)}" 
                           class="text-xs text-green-600 hover:text-green-800"
                           onclick="event.stopPropagation()">
                            <i class="fas fa-comments mr-1"></i>View Thread
                        </a>
                        ${messagingConfig.isAdmin ? `
                            <a href="${getUserProfileUrl(message.user_id)}" 
                               class="text-xs text-purple-600 hover:text-purple-800"
                               onclick="event.stopPropagation()">
                                <i class="fas fa-user mr-1"></i>Profile
                            </a>
                        ` : ''}
                    </div>
                </div>
            `;
        });
        
        html += '</div>';
        messagesList.innerHTML = html;
    }

    /**
     * View a single message and mark as read
     */
    function viewMessage(messageId) {
        const url = messagingConfig.markReadUrl.replace(':id', messageId);
        
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                loadMessages(); // Reload to update read status
            }
        })
        .catch(error => console.error('Error marking message as read:', error));
    }

    /**
     * Show quick reply form
     */
    function showQuickReply(messageId, userId, applicationId) {
        document.getElementById('reply-message-id').value = messageId;
        document.getElementById('reply-user-id').value = userId;
        document.getElementById('reply-application-id').value = applicationId;
        document.getElementById('quick-reply-form').classList.remove('hidden');
        document.getElementById('quick-reply-text').focus();
    }

    /**
     * Hide quick reply form
     */
    function hideQuickReply() {
        document.getElementById('quick-reply-form').classList.add('hidden');
        document.getElementById('quick-reply-text').value = '';
    }

    /**
     * Send quick reply
     */
    function sendQuickReply(event) {
        event.preventDefault();
        
        const messageId = document.getElementById('reply-message-id').value;
        const replyText = document.getElementById('quick-reply-text').value;
        const url = messagingConfig.replyUrl.replace(':id', messageId);
        
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                reply_message: replyText
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                hideQuickReply();
                loadMessages();
                showSuccess('Reply sent successfully');
            } else {
                showError(data.message || 'Failed to send reply');
            }
        })
        .catch(error => {
            console.error('Error sending reply:', error);
            showError('Failed to send reply. Please try again.');
        });
    }

    /**
     * Update unread badge count
     */
    function updateUnreadBadge(count) {
        const badges = document.querySelectorAll('.unread-count');
        badges.forEach(badge => {
            if (count > 0) {
                badge.textContent = count > 99 ? '99+' : count;
                badge.style.display = 'inline-flex';
            } else {
                badge.style.display = 'none';
            }
        });
    }

    /**
     * Get conversation URL
     */
    function getConversationUrl(userId, applicationId) {
        if (messagingConfig.isAdmin) {
            return messagingConfig.conversationUrl
                .replace(':userId', userId)
                .replace(':appId', applicationId);
        } else {
            return messagingConfig.conversationUrl.replace(':appId', applicationId);
        }
    }

    /**
     * Get user profile URL (admin only)
     */
    function getUserProfileUrl(userId) {
        if (messagingConfig.isAdmin) {
            return messagingConfig.userProfileUrl.replace(':userId', userId);
        }
        return '#';
    }

    /**
     * Show error message
     */
    function showError(message) {
        // Simple alert for now - you can enhance this with a toast notification
        alert(message);
    }

    /**
     * Show success message
     */
    function showSuccess(message) {
        // Simple alert for now - you can enhance this with a toast notification
        alert(message);
    }

    /**
     * Escape HTML to prevent XSS
     */
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }

    // Auto-refresh messages every 30 seconds
    setInterval(() => {
        if (document.getElementById('messages-list').children.length > 0) {
            loadMessages();
        }
    }, 30000);

    // Load messages when panel is opened
    document.addEventListener('DOMContentLoaded', function() {
        // Optional: Load messages on page load
        // loadMessages();
    });
</script>
@endpush