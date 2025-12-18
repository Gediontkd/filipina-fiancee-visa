{{-- FILE: resources/views/web/user/progress/completed-submission.blade.php --}}
{{-- APPLICATION ALREADY SUBMITTED - Show status --}}

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
                    <strong>Submitted Date:</strong> {{ $submission->submitted_at ? $submission->submitted_at->format('M j, Y') : 'N/A' }}<br>
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
                <li>You can message our support team for any questions</li>
            </ul>
        </div>

        <div class="d-flex gap-3 flex-wrap">
            <a href="{{ route('messages.compose') }}" class="btn btn-primary">
                <i class="fa fa-comments me-2"></i>Send Message
            </a>
            <a href="{{ route('messages.index') }}" class="btn btn-outline-primary">
                <i class="fa fa-envelope me-2"></i>View Messages
            </a>
        </div>

        {{-- PDF Download Section --}}
        @if($paymentStatus['has_paid'])
            <div class="mt-4">
                <div class="alert alert-success">
                    <h6><i class="fa fa-check-circle me-2"></i>Payment Completed</h6>
                    <p class="mb-3">
                        <strong>Amount Paid:</strong> ${{ number_format($paymentStatus['amount'], 2) }}<br>
                        <strong>Paid On:</strong> {{ $paymentStatus['paid_at']->format('M j, Y') }}
                    </p>
                    
                    @if($pdfStatus['can_generate'])
                        <button onclick="generateUserPdf()" id="user-pdf-btn-1" class="btn btn-danger">
                            <i class="fa fa-file-pdf me-2"></i>Generate PDF Package
                        </button>
                    @else
                        <div class="alert alert-warning mb-0">
                            <i class="fa fa-clock me-2"></i>{{ $pdfStatus['message'] }}
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>