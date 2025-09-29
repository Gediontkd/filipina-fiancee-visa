{{-- Update your existing progress view to include submit functionality --}}
@extends('web.layout.master')
@section('content')
<section class="myaccount ptb-80 bg-lightgrey">
    {{getLanguage()}}
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-4  mb-mob-15">
                @include('web.component.profile-sidebar')
            </div>
            <div class="col-lg-8 col-xl-9 col-xxl-9 col-md-9">
                <!-- Check Submission Status First -->
                @php
                    $hasSubmission = \App\Models\UserSubmittedApplication::where('user_id', Auth::id())->exists();
                @endphp

                @if($hasSubmission)
                    @php
                        $submission = \App\Models\UserSubmittedApplication::where('user_id', Auth::id())
                            ->with('visaApplication')
                            ->latest()
                            ->first();
                    @endphp
                    
                    <!-- Application Submitted -->
                    <div class="card mb-3">
                        <div class="card-header p-3 bg-success text-white">
                            <h2 class="card-title text-white mb-0">
                                <i class="fa fa-check-circle me-2"></i>Application Submitted
                            </h2>
                        </div>
                        <div class="card-body p-3">
                            <div class="alert alert-success">
                                <h5><i class="fa fa-check-circle me-2"></i>Your application has been successfully submitted!</h5>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <strong>Application Type:</strong> {{ $submission->visaApplication->name ?? 'N/A' }}<br>
                                        <strong>Submitted Date:</strong> {{ $submission->created_at->format('M j, Y') }}<br>
                                        <strong>Transaction ID:</strong> {{ $submission->transaction_id }}
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Current Status:</strong> 
                                        <span class="badge {{ 
                                            $submission->status === 'approved' ? 'bg-success' : 
                                            ($submission->status === 'under_review' ? 'bg-info' : 
                                            ($submission->status === 'rejected' ? 'bg-danger' : 'bg-warning'))
                                        }}">
                                            {{ ucfirst(str_replace('_', ' ', $submission->status)) }}
                                        </span><br>
                                        <strong>Last Updated:</strong> {{ $submission->updated_at->format('M j, Y') }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-info">
                                <h6><i class="fa fa-info-circle me-2"></i>What's Next?</h6>
                                <ul class="mb-0">
                                    <li>Our team will review your application within 2-3 business days</li>
                                    <li>You will receive updates via email and in your dashboard</li>
                                    <li>You can now send messages to our support team for any questions</li>
                                    <li>Keep checking your dashboard for status updates</li>
                                </ul>
                            </div>

                           <div class="d-flex gap-3 flex-wrap">
                                <button onclick="generateUserPdf()" id="user-pdf-btn" class="btn btn-danger">
                                    <i class="fa fa-file-pdf me-2"></i>Generate PDF Package
                                </button>
                                
                                <a href="{{ route('messages.compose') }}" class="btn btn-primary">
                                    <i class="fa fa-comments me-2"></i>Send Message to Support
                                </a>
                                
                                <a href="{{ route('messages.index') }}" class="btn btn-outline-primary">
                                    <i class="fa fa-envelope me-2"></i>View Messages
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Section Progress -->
                <div class="card mb-3">
                    <div class="card-header p-3">
                        <h2 class="card-title text-center">Section Progress</h2>
                    </div>
                    <div class="card-body p-3">
                       <div class="row">
                           <div class="col-md-4">
                               <h6>Section</h6>
                               <a href="{{ route('fianceSponsorApplication') }}" class="btn btn-tra-grey my-2">U.S. Sponsor Questions</a>
                               <a href="{{ route('fianceAlienApplication') }}" class="btn btn-tra-grey my-2">Alien Questions</a>
                               <a href="{{ route('fianceAlienChildApplication') }}" class="btn btn-tra-grey my-2">Alien Children Questions</a>
                           </div>
                           <div class="col-md-8">
                               <h6>Progress</h6>
                               <div class="progress my-4">
                                <div class="progress-bar progress-bar-striped bg-success" 
                                    role="progressbar" 
                                    style="width: {{ $sponsorTotal }}%" 
                                    aria-valuenow="{{ $sponsorTotal }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100">
                                    {{ $sponsorTotal }}%
                                </div>
                                </div>
                                <div class="progress my-4" style="margin-top: 42px !important;">
                                <div class="progress-bar progress-bar-striped bg-success" 
                                    role="progressbar" 
                                    style="width: {{ $alienTotal }}%" 
                                    aria-valuenow="{{ $alienTotal }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100">
                                    {{ $alienTotal }}%
                                </div>
                                </div>
                                <div class="progress my-4" style="margin-top: 42px !important;">
                                <div class="progress-bar progress-bar-striped bg-success" 
                                    role="progressbar" 
                                    style="width: {{ $alienChildrenTotal }}%" 
                                    aria-valuenow="{{ $alienChildrenTotal }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100">
                                    {{ $alienChildrenTotal }}%
                                </div>
                                </div>
                           </div>
                       </div>
                    </div>
                </div>

                <!-- Overall Progress -->
                <div class="card mb-3">
                    <div class="card-header p-3">
                        <h2 class="card-title text-center">Overall Progress</h2>
                    </div>
                    <div class="card-body p-3">
                       <div class="progress" style="height: 30px;">
                            <div class="progress-bar progress-bar-striped bg-success" 
                                role="progressbar" 
                                style="width: {{ $overAll }}%" 
                                aria-valuenow="{{ $overAll }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100">
                                <strong>{{ $overAll }}%</strong>
                            </div>
                            </div>

                            @if($hasSubmission)
                                <!-- PDF Generation Option for Submitted Applications -->
                                <div class="mt-4">
                                    <div class="alert alert-info">
                                        <h6><i class="fa fa-file-pdf me-2"></i>Download Complete Application Package</h6>
                                        <p class="mb-3">You can download a complete PDF package of your application forms.</p>
                                        <button onclick="generateUserPdf()" id="user-pdf-btn-2" class="btn btn-danger">
                                            <i class="fa fa-file-pdf me-2"></i>Generate PDF Package
                                        </button>
                                    </div>
                                </div>
                            @endif
                        
                        @if($overAll >= 100 && !$hasSubmission)
                            <!-- Ready to Submit -->
                            <div class="mt-4">
                                <div class="alert alert-success">
                                    <h5><i class="fa fa-check-circle me-2"></i>Ready to Submit!</h5>
                                    <p>Congratulations! You have completed all required sections. Your application is ready for submission.</p>
                                </div>
                                
                                <div class="text-center">
                                    <a href="{{ route('application.review') }}" class="btn btn-success btn-lg">
                                        <i class="fa fa-paper-plane me-2"></i>Review & Submit Application
                                    </a>
                                    <p class="text-muted mt-2 small">
                                        Review your information and submit your application for processing
                                    </p>
                                </div>
                            </div>
                        @elseif($overAll < 100 && !$hasSubmission)
                            <!-- Still Need to Complete -->
                            <div class="mt-4">
                                <div class="alert alert-warning">
                                    <h6><i class="fa fa-exclamation-triangle me-2"></i>Complete All Sections</h6>
                                    <p class="mb-0">Please complete all required sections before submitting your application.</p>
                                </div>
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
<script type="text/javascript">
    // PDF Generation for User
    function generateUserPdf() {
        const btns = document.querySelectorAll('[id^="user-pdf-btn"]');
        
        // Disable all PDF buttons and show loading
        btns.forEach(btn => {
            btn.disabled = true;
            btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Generating PDF...';
        });
        
        // Show loading notification
        showNotification('Generating your PDF package. This may take a moment...', 'info');
        
        // Navigate to PDF generation route
        window.location.href = '{{ route("user.generate-pdf") }}';
        
        // Re-enable buttons after delay
        setTimeout(() => {
            btns.forEach(btn => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fa fa-file-pdf me-2"></i>Generate PDF Package';
            });
        }, 5000);
    }

    // Notification function
    function showNotification(message, type) {
        const bgColors = {
            'success': 'bg-success',
            'error': 'bg-danger',
            'info': 'bg-info',
            'warning': 'bg-warning'
        };
        
        const notification = document.createElement('div');
        notification.className = `alert ${bgColors[type] || 'bg-info'} text-white position-fixed top-0 end-0 m-3`;
        notification.style.zIndex = '9999';
        notification.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="fa fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 5000);
    }

    // Auto-refresh submission status if needed
    @if(!$hasSubmission && $overAll >= 100)
        setInterval(function() {
            fetch('{{ route("application.status") }}')
                .then(response => response.json())
                .then(data => {
                    if (data.has_submission) {
                        location.reload();
                    }
                })
                .catch(error => console.log('Status check failed'));
        }, 30000);
    @endif

    // Check PDF availability on page load
    @if($hasSubmission)
        fetch('{{ route("user.check-pdf-status") }}')
            .then(response => response.json())
            .then(data => {
                if (!data.available || data.count === 0) {
                    const pdfBtns = document.querySelectorAll('[id^="user-pdf-btn"]');
                    pdfBtns.forEach(btn => {
                        btn.disabled = true;
                        btn.innerHTML = '<i class="fa fa-exclamation-triangle me-2"></i>No PDFs Available';
                        btn.title = 'PDF files are not yet ready for your application';
                    });
                }
            })
            .catch(error => console.log('PDF status check failed'));
    @endif
</script>
@endsection