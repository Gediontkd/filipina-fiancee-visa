{{-- resources/views/admin/messages/conversation.blade.php --}}
@extends('admin.layouts.app')

@section('title', 'Conversation')
@section('page-title', 'Message Conversation')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.messages.index') }}" 
               class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-2">
                <i class="fas fa-arrow-left mr-2"></i>Back to Messages
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Conversation with {{ $user->name }}</h1>
            <p class="text-gray-600">
                Application: {{ $application->visaApplication->name ?? 'N/A' }} #{{ $application->id }} | 
                Email: {{ $user->email }}
            </p>
        </div>
        
        <div class="flex space-x-3">
            <a href="{{ route('admin.applications.show', $application) }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors">
                <i class="fas fa-file-alt mr-2"></i>View Application
            </a>
        </div>
    </div>

    <!-- Application Info Card -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Application Information</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
            <div>
                <span class="font-medium text-gray-500">Type:</span>
                <p>{{ $application->visaApplication->name ?? 'N/A' }}</p>
            </div>
            <div>
                <span class="font-medium text-gray-500">Status:</span>
                <p>{{ ucfirst(str_replace('_', ' ', $application->status)) }}</p>
            </div>
            <div>
                <span class="font-medium text-gray-500">Submitted:</span>
                <p>{{ $application->created_at->format('M j, Y') }}</p>
            </div>
            <div>
                <span class="font-medium text-gray-500">Transaction:</span>
                <p>{{ $application->transaction_id ?? 'N/A' }}</p>
            </div>
        </div>
    </div>

    <!-- Messages Container -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Messages ({{ $messages->count() }})</h3>
                <button onclick="toggleComposeForm()" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                    <i class="fas fa-reply mr-2"></i>Send Message
                </button>
            </div>
        </div>

        <!-- Messages List -->
        <div class="max-h-96 overflow-y-auto p-6 space-y-4" id="messages-container">
            @forelse($messages as $message)
                <div class="mb-4">
                    <div class="w-full {{ $message->isFromAdmin() ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-900' }} rounded-lg p-4">
                        <!-- Message Header -->
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center space-x-2">
                                <span class="text-xs font-medium {{ $message->isFromAdmin() ? 'text-blue-100' : 'text-gray-600' }}">
                                    {{ $message->sender_name }}
                                </span>
                                @if($message->priority === 'high')
                                    <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">
                                        High
                                    </span>
                                @endif
                                @if($message->is_important)
                                    <i class="fas fa-exclamation-triangle text-red-400"></i>
                                @endif
                            </div>
                            <span class="text-xs {{ $message->isFromAdmin() ? 'text-blue-100' : 'text-gray-500' }}">
                                {{ $message->created_at->format('M j, g:i A') }}
                            </span>
                        </div>

                        <!-- Subject (if different from previous) -->
                        @if($loop->first || $message->subject !== $messages[$loop->index - 1]->subject)
                            <h4 class="text-sm font-semibold mb-2 {{ $message->isFromAdmin() ? 'text-blue-100' : 'text-gray-700' }}">
                                {{ $message->subject }}
                            </h4>
                        @endif

                        <!-- Message Content -->
                        <div class="text-sm whitespace-pre-wrap">{{ $message->message }}</div>

                        <!-- Attachments -->
                        @if($message->hasAttachments())
                            <div class="mt-3 pt-3 border-t {{ $message->isFromAdmin() ? 'border-blue-500' : 'border-gray-300' }}">
                                <p class="text-xs {{ $message->isFromAdmin() ? 'text-blue-100' : 'text-gray-600' }} mb-2">
                                    <i class="fas fa-paperclip mr-1"></i>Attachments:
                                </p>
                                <div class="space-y-1">
                                    @foreach($message->attachments as $index => $attachment)
                                        <a href="{{ route('admin.messages.download-attachment', [$message, $index]) }}" 
                                           class="block text-xs {{ $message->isFromAdmin() ? 'text-blue-100 hover:text-white' : 'text-blue-600 hover:text-blue-800' }} underline">
                                            {{ $attachment['original_name'] }}
                                            <span class="text-xs">({{ round($attachment['size'] / 1024) }} KB)</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-comments text-4xl mb-4"></i>
                    <p>No messages in this conversation yet.</p>
                    <p class="text-sm">Start the conversation by sending a message below.</p>
                </div>
            @endforelse
        </div>

        <!-- Compose Form -->
        <div id="compose-form" class="border-t bg-gray-50 p-6 hidden">
            <form action="{{ route('admin.messages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="application_id" value="{{ $application->id }}">

                <div class="space-y-4">
                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" 
                               id="subject" 
                               name="subject" 
                               required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Enter message subject">
                    </div>

                    <!-- Message -->
                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea id="message" 
                                  name="message" 
                                  rows="4" 
                                  required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  placeholder="Type your message here..."></textarea>
                    </div>

                    <!-- Priority and Options -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                            <select id="priority" 
                                    name="priority" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="low">Low</option>
                                <option value="normal" selected>Normal</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div>
                            <label class="flex items-center mt-6">
                                <input type="checkbox" name="is_important" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-700">Mark as important</span>
                            </label>
                        </div>
                    </div>

                    <!-- File Attachments -->
                    <div>
                        <label for="attachments" class="block text-sm font-medium text-gray-700 mb-1">
                            Attachments (optional)
                        </label>
                        <input type="file" 
                               id="attachments" 
                               name="attachments[]" 
                               multiple
                               accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.txt"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <p class="text-xs text-gray-500 mt-1">
                            Max 10MB per file. Allowed: PDF, DOC, DOCX, JPG, PNG, TXT
                        </p>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex items-center justify-end space-x-3">
                        <button type="button" 
                                onclick="toggleComposeForm()" 
                                class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-paper-plane mr-2"></i>Send Message
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function toggleComposeForm() {
        const form = document.getElementById('compose-form');
        form.classList.toggle('hidden');
        
        if (!form.classList.contains('hidden')) {
            document.getElementById('subject').focus();
            scrollToBottom();
        }
    }

    function scrollToBottom() {
        const container = document.getElementById('messages-container');
        container.scrollTop = container.scrollHeight;
    }

    // Auto-scroll to bottom on page load
    document.addEventListener('DOMContentLoaded', function() {
        scrollToBottom();
    });

    // Auto-refresh messages every 30 seconds
    setInterval(() => {
        // You could implement auto-refresh here if needed
        // location.reload();
    }, 30000);
</script>
@endpush