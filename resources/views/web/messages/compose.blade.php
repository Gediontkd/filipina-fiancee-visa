{{-- resources/views/web/messages/compose.blade.php --}}
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
                                <h2 class="card-title mb-0 mt-2">Compose New Message</h2>
                                <small class="text-muted">Send a message to the support team</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Application Selection Info -->
                @if($applications->count() > 0)
                    <div class="card mb-3">
                        <div class="card-body p-3">
                            <div class="alert alert-info mb-0">
                                <i class="fa fa-info-circle me-2"></i>
                                <strong>Note:</strong> Messages are associated with your applications. 
                                Please select which application this message is related to.
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Compose Form -->
                <div class="card">
                    <div class="card-header p-3">
                        <h5 class="mb-0">
                            <i class="fa fa-edit me-2"></i>New Message
                        </h5>
                    </div>
                    <div class="card-body p-3">
                        @if($applications->count() > 0)
                            <form action="{{ route('messages.store') }}" method="POST" enctype="multipart/form-data" id="compose-form">
                                @csrf

                                <!-- Application Selection -->
                                <div class="form-group mb-3">
                                    <label for="application_id" class="form-label">
                                        <i class="fa fa-file-alt me-2"></i>Related Application *
                                    </label>
                                    <select id="application_id" 
                                            name="application_id" 
                                            class="form-select" 
                                            required>
                                        <option value="">Select an application...</option>
                                        @foreach($applications as $app)
                                            <option value="{{ $app->id }}" 
                                                    {{ $selectedApplication && $selectedApplication->id == $app->id ? 'selected' : '' }}>
                                                {{ $app->visaApplication->name ?? 'Application' }} #{{ $app->id }} 
                                                - {{ ucfirst(str_replace('_', ' ', $app->status)) }}
                                                ({{ $app->created_at->format('M j, Y') }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">
                                        Choose which application this message is related to
                                    </small>
                                </div>

                                <!-- Subject -->
                                <div class="form-group mb-3">
                                    <label for="subject" class="form-label">
                                        <i class="fa fa-tag me-2"></i>Subject *
                                    </label>
                                    <input type="text" 
                                           id="subject" 
                                           name="subject" 
                                           class="form-control" 
                                           required
                                           maxlength="255"
                                           placeholder="Enter a clear subject for your message"
                                           value="{{ old('subject') }}">
                                    <small class="text-muted">
                                        Be specific about your question or concern
                                    </small>
                                </div>

                                <!-- Message -->
                                <div class="form-group mb-3">
                                    <label for="message" class="form-label">
                                        <i class="fa fa-comment me-2"></i>Message *
                                    </label>
                                    <textarea id="message" 
                                              name="message" 
                                              class="form-control" 
                                              rows="6" 
                                              required
                                              placeholder="Describe your question, concern, or provide additional information about your application..."
                                              maxlength="5000">{{ old('message') }}</textarea>
                                    <small class="text-muted">
                                        <span id="char-count">0</span>/5000 characters
                                    </small>
                                </div>

                                <!-- Priority -->
                                <div class="form-group mb-3">
                                    <label for="priority" class="form-label">
                                        <i class="fa fa-exclamation-circle me-2"></i>Priority
                                    </label>
                                    <select id="priority" name="priority" class="form-select">
                                        <option value="low">Low - General inquiry</option>
                                        <option value="normal" selected>Normal - Standard question</option>
                                        <option value="high">High - Urgent matter</option>
                                    </select>
                                    <small class="text-muted">
                                        Select "High" only for urgent matters that require immediate attention
                                    </small>
                                </div>

                                <!-- File Attachments -->
                                <div class="form-group mb-4">
                                    <label for="attachments" class="form-label">
                                        <i class="fa fa-paperclip me-2"></i>Attachments (optional)
                                    </label>
                                    <input type="file" 
                                           id="attachments" 
                                           name="attachments[]" 
                                           class="form-control" 
                                           multiple
                                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,.txt">
                                    <small class="text-muted">
                                        You can attach documents, images, or other files. Max 10MB per file. 
                                        Allowed formats: PDF, DOC, DOCX, JPG, PNG, TXT
                                    </small>
                                    <div id="file-preview" class="mt-2"></div>
                                </div>

                                <!-- Guidelines -->
                                <div class="alert alert-light mb-4">
                                    <h6 class="alert-heading">
                                        <i class="fa fa-lightbulb me-2"></i>Message Guidelines
                                    </h6>
                                    <ul class="mb-0 small">
                                        <li>Be clear and specific about your question or concern</li>
                                        <li>Include relevant details like application ID, dates, or reference numbers</li>
                                        <li>Attach supporting documents if they help explain your question</li>
                                        <li>Our support team typically responds within 24-48 hours</li>
                                        <li>For urgent matters, please mark as "High Priority"</li>
                                    </ul>
                                </div>

                                <!-- Submit Buttons -->
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('messages.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-times me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-tra-primary" id="send-button">
                                        <i class="fa fa-paper-plane me-2"></i>Send Message
                                    </button>
                                </div>
                            </form>
                        @else
                            <!-- No Applications Message -->
                            <div class="text-center py-5">
                                <i class="fa fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                                <h5 class="text-muted">No Applications Found</h5>
                                <p class="text-muted mb-4">
                                    You need to have at least one submitted application to send messages to our support team.
                                </p>
                                <a href="{{ route('service') }}" class="btn btn-tra-primary">
                                    <i class="fa fa-plus me-2"></i>Start New Application
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customScript')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Character counter for message
        const messageTextarea = document.getElementById('message');
        const charCount = document.getElementById('char-count');
        
        if (messageTextarea && charCount) {
            messageTextarea.addEventListener('input', function() {
                const count = this.value.length;
                charCount.textContent = count;
                
                if (count > 4500) {
                    charCount.style.color = '#dc3545'; // Red
                } else if (count > 4000) {
                    charCount.style.color = '#ffc107'; // Yellow
                } else {
                    charCount.style.color = '#6c757d'; // Gray
                }
            });
            
            // Initial count
            charCount.textContent = messageTextarea.value.length;
        }

        // File preview
        const fileInput = document.getElementById('attachments');
        const filePreview = document.getElementById('file-preview');
        
        if (fileInput && filePreview) {
            fileInput.addEventListener('change', function() {
                filePreview.innerHTML = '';
                
                if (this.files.length > 0) {
                    const fileList = document.createElement('div');
                    fileList.className = 'border rounded p-2 bg-light';
                    
                    const header = document.createElement('small');
                    header.className = 'text-muted fw-bold';
                    header.textContent = 'Selected files:';
                    fileList.appendChild(header);
                    
                    Array.from(this.files).forEach(file => {
                        const fileItem = document.createElement('div');
                        fileItem.className = 'd-flex justify-content-between align-items-center py-1';
                        
                        const fileName = document.createElement('span');
                        fileName.className = 'small';
                        fileName.textContent = file.name;
                        
                        const fileSize = document.createElement('span');
                        fileSize.className = 'small text-muted';
                        fileSize.textContent = formatFileSize(file.size);
                        
                        fileItem.appendChild(fileName);
                        fileItem.appendChild(fileSize);
                        fileList.appendChild(fileItem);
                    });
                    
                    filePreview.appendChild(fileList);
                }
            });
        }

        // Form validation
        const form = document.getElementById('compose-form');
        const sendButton = document.getElementById('send-button');
        
        if (form && sendButton) {
            form.addEventListener('submit', function(e) {
                sendButton.disabled = true;
                sendButton.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Sending...';
            });
        }
    });

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Auto-save draft functionality (optional)
    let autoSaveTimeout;
    const formElements = ['subject', 'message', 'priority'];
    
    formElements.forEach(elementId => {
        const element = document.getElementById(elementId);
        if (element) {
            element.addEventListener('input', function() {
                clearTimeout(autoSaveTimeout);
                autoSaveTimeout = setTimeout(() => {
                    // Save to localStorage
                    localStorage.setItem(`message_draft_${elementId}`, this.value);
                }, 2000);
            });
            
            // Load from localStorage
            const saved = localStorage.getItem(`message_draft_${elementId}`);
            if (saved && !element.value) {
                element.value = saved;
                if (elementId === 'message') {
                    // Update character count
                    const charCount = document.getElementById('char-count');
                    if (charCount) charCount.textContent = saved.length;
                }
            }
        }
    });

    // Clear draft when form is submitted successfully
    document.getElementById('compose-form')?.addEventListener('submit', function() {
        formElements.forEach(elementId => {
            localStorage.removeItem(`message_draft_${elementId}`);
        });
    });
</script>
@endSection