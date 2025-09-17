{{-- resources/views/web/messages/conversation.blade.php --}}
@extends('web.layout.master')

@section('content')
<section class="myaccount ptb-80 bg-lightgrey">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-4 mb-mob-15">
                @include('web.component.profile-sidebar')
            </div>
            <div class="col-lg-8 col-xl-9 col-xxl-9 col-md-9">
                <!-- Header -->
                <div class="card mb-3">
                    <div class="card-header p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('messages.index') }}" class="text-decoration-none">
                                    <i class="fa fa-arrow-left me-2"></i>Back to Messages
                                </a>
                                <h2 class="card-title mb-0 mt-2">Conversation</h2>
                                <small class="text-muted">
                                    {{ $application->visaApplication->name ?? 'Application' }} #{{ $application->id }}
                                </small>
                            </div>
                            <button onclick="toggleComposeForm()" class="btn btn-tra-primary">
                                <i class="fa fa-reply me-2"></i>Send Message
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Application Info -->
                <div class="card mb-3">
                    <div class="card-body p-3">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <strong>Application Type</strong>
                                <br>
                                <span class="badge bg-primary">{{ $application->visaApplication->name ?? 'N/A' }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Status</strong>
                                <br>
                                <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $application->status)) }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Submitted</strong>
                                <br>
                                <small>{{ $application->created_at->format('M j, Y') }}</small>
                            </div>
                            <div class="col-md-3">
                                <strong>Messages</strong>
                                <br>
                                <span class="badge bg-success">{{ $messages->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Messages Container -->
                <div class="card">
                    <div class="card-header p-3">
                        <h5 class="mb-0">
                            <i class="fa fa-comments me-2"></i>Messages
                        </h5>
                    </div>
                    
                    <!-- Messages List -->
                    <div class="card-body p-0" style="max-height: 500px; overflow-y: auto;" id="messages-container">
                        @forelse($messages as $message)
                            <div class="p-3 border-bottom">
                                <div class="d-flex {{ $message->isFromUser() ? 'justify-content-end' : 'justify-content-start' }}">
                                    <div class="message-bubble {{ $message->isFromUser() ? 'user-message' : 'admin-message' }}" style="max-width: 75%;">
                                        <!-- Message Header -->
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="d-flex align-items-center">
                                                @if($message->isFromUser())
                                                    <i class="fa fa-user text-primary me-2"></i>
                                                    <strong class="text-primary">You</strong>
                                                @else
                                                    <i class="fa fa-user-shield text-success me-2"></i>
                                                    <strong class="text-success">Support Team</strong>
                                                @endif
                                                
                                                @if($message->priority === 'high')
                                                    <span class="badge bg-danger ms-2 small">High Priority</span>
                                                @endif
                                                @if($message->is_important)
                                                    <i class="fa fa-exclamation-triangle text-warning ms-2" title="Important"></i>
                                                @endif
                                            </div>
                                            <small class="text-muted">
                                                {{ $message->created_at->format('M j, g:i A') }}
                                            </small>
                                        </div>

                                        <!-- Subject (if different from previous) -->
                                        @if($loop->first || $message->subject !== $messages[$loop->index - 1]->subject)
                                            <h6 class="fw-bold mb-2 text-dark">{{ $message->subject }}</h6>
                                        @endif

                                        <!-- Message Content -->
                                        <div class="message-content mb-2" style="white-space: pre-wrap;">
                                            {{ $message->message }}
                                        </div>

                                        <!-- Attachments -->
                                        @if($message->hasAttachments())
                                            <div class="border-top pt-2 mt-2">
                                                <small class="text-muted">
                                                    <i class="fa fa-paperclip me-1"></i>Attachments:
                                                </small>
                                                <div class="mt-1">
                                                    @foreach($message->attachments as $index => $attachment)
                                                        <div class="attachment-item">
                                                            <a href="{{ route('messages.download-attachment', [$message, $index]) }}" 
                                                               class="text-decoration-none">
                                                                <i class="fa fa-download me-1"></i>
                                                                {{ $attachment['original_name'] }}
                                                                <small class="text-muted">({{ round($attachment['size'] / 1024) }} KB)</small>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="fa fa-comments fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No Messages Yet</h5>
                                <p class="text-muted">Start the conversation by sending your first message.</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Compose Form -->
                    <div id="compose-form" class="border-top bg-light p-3" style="display: none;">
                        <form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="application_id" value="{{ $application->id }}">

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="subject" class="form-label">Subject</label>
                                    <input type="text" 
                                           id="subject" 
                                           name="subject" 
                                           class="form-control" 
                                           required
                                           placeholder="Enter message subject">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="message" class="form-label">Message</label>
                                    <textarea id="message" 
                                              name="message" 
                                              class="form-control" 
                                              rows="4" 
                                              required
                                              placeholder="Type your message here..."></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="priority" class="form-label">Priority</label>
                                    <select id="priority" name="priority" class="form-select">
                                        <option value="low">Low</option>
                                        <option value="normal" selected>Normal</option>
                                        <option value="high">High</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="attachments" class="form-label">Attachments (optional)</label>
                                    <input type="file" 
                                           id="attachments" 
                                           name="attachments[]" 
                                           class="form-control" 
                                           multiple
                                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.txt">
                                    <small class="text-muted">Max 10MB per file. PDF, DOC, JPG, PNG, TXT allowed.</small>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" onclick="toggleComposeForm()" class="btn btn-secondary">
                                            Cancel
                                        </button>
                                        <button type="submit" class="btn btn-tra-primary">
                                            <i class="fa fa-paper-plane me-2"></i>Send Message
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.user-message {
    background-color: #007bff;
    color: white;
    padding: 15px;
    border-radius: 15px 15px 5px 15px;
    margin-left: 20px;
}

.admin-message {
    background-color: #f8f9fa;
    color: #333;
    padding: 15px;
    border-radius: 15px 15px 15px 5px;
    border: 1px solid #dee2e6;
    margin-right: 20px;
}

.user-message .text-primary {
    color: #cce7ff !important;
}

.user-message .text-muted {
    color: #b8daff !important;
}

.user-message .text-dark {
    color: #e3f2fd !important;
}

.attachment-item {
    background-color: rgba(255,255,255,0.1);
    padding: 5px 10px;
    border-radius: 5px;
    margin-bottom: 5px;
    display: inline-block;
}

.admin-message .attachment-item {
    background-color: rgba(0,0,0,0.05);
}
</style>
@endsection

@section('customScript')
<script>
    function toggleComposeForm() {
        const form = document.getElementById('compose-form');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
            document.getElementById('subject').focus();
            scrollToBottom();
        } else {
            form.style.display = 'none';
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

    // Mark messages as read when viewing
    document.addEventListener('DOMContentLoaded', function() {
        // This would be handled server-side when loading the conversation
        console.log('Conversation loaded and messages marked as read');
    });
</script>
@endsection