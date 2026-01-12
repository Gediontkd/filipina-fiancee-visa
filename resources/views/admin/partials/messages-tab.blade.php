{{-- resources/views/admin/users/partials/messages-tab.blade.php --}}
@php
    $applications = $user->userSubmittedApplications;
    $allMessages = $user->messages()->with('application')->orderBy('created_at', 'desc')->get();
@endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Compose New Message -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-xl border border-slate-200 p-6 sticky top-6">
            <h3 class="font-semibold text-slate-800 mb-4">
                <i class="fas fa-paper-plane text-blue-500 mr-2"></i>Send Message
            </h3>
            
            <form method="POST" action="{{ route('admin.messages.store') }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                
                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Application</label>
                    <select name="application_id" required class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="">Select application...</option>
                        @foreach($applications as $app)
                            <option value="{{ $app->id }}">
                                {{ $app->visaApplication?->name ?? 'Application' }} (#{{ $app->id }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Subject</label>
                    <input type="text" name="subject" required
                           class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                           placeholder="Message subject...">
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Message</label>
                    <textarea name="message" rows="5" required
                              class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                              placeholder="Type your message..."></textarea>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Priority</label>
                    <select name="priority" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="normal">Normal</option>
                        <option value="high">High</option>
                        <option value="low">Low</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-medium text-slate-500 mb-1">Attachments</label>
                    <input type="file" name="attachments[]" multiple
                           class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>

                <button type="submit" class="w-full px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-paper-plane mr-2"></i>Send Message
                </button>
            </form>
        </div>
    </div>

    <!-- Message History -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl border border-slate-200">
            <div class="px-6 py-4 border-b border-slate-200 flex items-center justify-between">
                <h3 class="font-semibold text-slate-800">Message History</h3>
                <span class="text-sm text-slate-500">{{ $allMessages->count() }} messages</span>
            </div>

            @if($allMessages->count() > 0)
            <div class="divide-y divide-slate-100 max-h-[600px] overflow-y-auto">
                @foreach($allMessages as $message)
                <div class="p-4 hover:bg-slate-50 {{ !$message->read_at && $message->sender_type === 'user' ? 'bg-blue-50/50' : '' }}">
                    <div class="flex items-start space-x-3">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $message->sender_type === 'admin' ? 'bg-purple-100' : 'bg-blue-100' }}">
                                <i class="fas {{ $message->sender_type === 'admin' ? 'fa-user-shield text-purple-600' : 'fa-user text-blue-600' }} text-xs"></i>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-1">
                                <span class="text-sm font-medium text-slate-800">
                                    {{ $message->sender_type === 'admin' ? 'Admin' : $user->name }}
                                </span>
                                @if($message->priority === 'high')
                                    <span class="px-1.5 py-0.5 text-xs bg-red-100 text-red-700 rounded">High</span>
                                @endif
                                @if(!$message->read_at && $message->sender_type === 'user')
                                    <span class="px-1.5 py-0.5 text-xs bg-amber-100 text-amber-700 rounded">Unread</span>
                                @endif
                            </div>
                            
                            <p class="text-sm font-medium text-slate-700">{{ $message->subject }}</p>
                            <p class="text-sm text-slate-600 mt-1 line-clamp-2">{{ $message->message }}</p>
                            
                            <div class="flex items-center space-x-4 mt-2 text-xs text-slate-400">
                                <span>{{ $message->created_at->format('M j, Y g:i A') }}</span>
                                @if($message->application)
                                    <span>App #{{ $message->application_id }}</span>
                                @endif
                                @if($message->attachments && count($message->attachments) > 0)
                                    <span><i class="fas fa-paperclip mr-1"></i>{{ count($message->attachments) }} files</span>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex-shrink-0 flex items-center space-x-1">
                            @if(!$message->read_at && $message->sender_type === 'user')
                            <button onclick="markMessageRead({{ $message->id }})" 
                                    class="p-1.5 text-slate-400 hover:text-emerald-600" title="Mark as read">
                                <i class="fas fa-check"></i>
                            </button>
                            @endif
                            <a href="{{ route('admin.messages.conversation', [$user->id, $message->application_id]) }}"
                               class="p-1.5 text-slate-400 hover:text-blue-600" title="View conversation">
                                <i class="fas fa-comments"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="px-6 py-12 text-center">
                <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-comments text-slate-400 text-2xl"></i>
                </div>
                <h3 class="text-lg font-medium text-slate-800 mb-1">No messages</h3>
                <p class="text-sm text-slate-500">Start a conversation with this user</p>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
function markMessageRead(id) {
    fetch(`/admin/messages/${id}/mark-read`, {
        method: 'POST',
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json'}
    }).then(r => r.json()).then(d => d.success && location.reload());
}
</script>
@endpush