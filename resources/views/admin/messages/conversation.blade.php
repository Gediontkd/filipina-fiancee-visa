{{-- resources/views/admin/messages/conversation.blade.php --}}
@extends('admin.layouts.app')
@section('title', 'Conversation with ' . $user->name)
@section('page-title')
    <div class="flex items-center space-x-3">
        <a href="{{ route('admin.messages.index') }}" class="text-slate-400 hover:text-slate-600">
            <i class="fas fa-arrow-left"></i>
        </a>
        <span>Conversation</span>
    </div>
@endsection

@section('content')
<div class="h-[calc(100vh-180px)] flex flex-col">
    <!-- Header -->
    <div class="bg-white rounded-t-xl border border-slate-200 border-b-0 p-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.users.show', $user) }}" class="flex items-center space-x-3 hover:opacity-80">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-medium">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="font-semibold text-slate-800">{{ $user->name }}</h3>
                        <p class="text-xs text-slate-500">{{ $user->email }}</p>
                    </div>
                </a>
            </div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 text-xs font-medium bg-blue-50 text-blue-700 rounded-full">
                    {{ $application->visaApplication?->name ?? 'Application' }} #{{ $application->id }}
                </span>
                <a href="{{ route('admin.users.show', $user) }}" 
                   class="px-3 py-1.5 text-sm bg-slate-100 text-slate-600 rounded-lg hover:bg-slate-200">
                    <i class="fas fa-folder-open mr-1"></i>Workspace
                </a>
            </div>
        </div>
    </div>

    <!-- Messages Container -->
    <div id="messages-container" class="flex-1 overflow-y-auto bg-slate-50 border-x border-slate-200 p-4 space-y-4">
        @forelse($messages as $message)
        <div class="flex {{ $message->sender_type === 'admin' ? 'justify-end' : 'justify-start' }}">
            <div class="max-w-[70%] {{ $message->sender_type === 'admin' ? 'order-2' : '' }}">
                <!-- Avatar -->
                @if($message->sender_type !== 'admin')
                <div class="flex items-start space-x-3">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user text-blue-600 text-xs"></i>
                    </div>
                @else
                <div class="flex items-start space-x-3 flex-row-reverse">
                    <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-user-shield text-purple-600 text-xs"></i>
                    </div>
                @endif
                    <div class="{{ $message->sender_type === 'admin' ? 'bg-blue-600 text-white' : 'bg-white border border-slate-200' }} rounded-2xl px-4 py-3 shadow-sm">
                        <!-- Subject -->
                        <p class="text-xs {{ $message->sender_type === 'admin' ? 'text-blue-200' : 'text-slate-500' }} mb-1">
                            {{ $message->subject }}
                        </p>
                        <!-- Message -->
                        <p class="text-sm whitespace-pre-wrap">{{ $message->message }}</p>
                        
                        <!-- Attachments -->
                        @if($message->attachments && count($message->attachments) > 0)
                        <div class="mt-3 pt-3 border-t {{ $message->sender_type === 'admin' ? 'border-blue-500' : 'border-slate-100' }}">
                            <p class="text-xs {{ $message->sender_type === 'admin' ? 'text-blue-200' : 'text-slate-500' }} mb-2">
                                <i class="fas fa-paperclip mr-1"></i>{{ count($message->attachments) }} attachment(s)
                            </p>
                            <div class="space-y-1">
                                @foreach($message->attachments as $index => $attachment)
                                <a href="{{ route('admin.messages.download-attachment', [$message->id, $index]) }}"
                                   class="flex items-center space-x-2 text-xs {{ $message->sender_type === 'admin' ? 'text-blue-100 hover:text-white' : 'text-blue-600 hover:text-blue-700' }}">
                                    <i class="fas fa-download"></i>
                                    <span>{{ basename($attachment) }}</span>
                                </a>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <!-- Timestamp -->
                        <p class="text-xs {{ $message->sender_type === 'admin' ? 'text-blue-200' : 'text-slate-400' }} mt-2">
                            {{ $message->created_at->format('M j, g:i A') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="flex items-center justify-center h-full">
            <div class="text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-comments text-slate-400 text-2xl"></i>
                </div>
                <p class="text-slate-500">No messages yet</p>
                <p class="text-sm text-slate-400">Start the conversation below</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Reply Form -->
    <div class="bg-white rounded-b-xl border border-slate-200 border-t-0 p-4">
        <form method="POST" action="{{ route('admin.messages.store') }}" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <input type="hidden" name="application_id" value="{{ $application->id }}">
            
            <div class="flex items-start space-x-3">
                <div class="flex-1 space-y-3">
                    <input type="text" name="subject" required placeholder="Subject..."
                           class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    
                    <textarea name="message" rows="3" required placeholder="Type your message..."
                              class="w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"></textarea>
                    
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <label class="cursor-pointer flex items-center space-x-2 text-sm text-slate-500 hover:text-slate-700">
                                <i class="fas fa-paperclip"></i>
                                <span>Attach files</span>
                                <input type="file" name="attachments[]" multiple class="hidden">
                            </label>
                            <select name="priority" class="px-3 py-1.5 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                                <option value="normal">Normal</option>
                                <option value="high">High Priority</option>
                                <option value="low">Low Priority</option>
                            </select>
                        </div>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium transition-colors">
                            <i class="fas fa-paper-plane mr-2"></i>Send
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Scroll to bottom on load
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('messages-container');
    container.scrollTop = container.scrollHeight;
});

// Show selected files
document.querySelector('input[type="file"]')?.addEventListener('change', function() {
    const label = this.previousElementSibling;
    if (this.files.length > 0) {
        label.innerHTML = `<i class="fas fa-paperclip"></i> ${this.files.length} file(s) selected`;
    }
});
</script>
@endpush