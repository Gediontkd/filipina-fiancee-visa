<!-- resources\views\web\user\progress.blade.php -->
@extends('web.layout.master')
@section('content')
<section class="myaccount ptb-80 bg-lightgrey">
    {{getLanguage()}}
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-4 mb-mob-15">
                @include('web.component.profile-sidebar')
            </div>
            <div class="col-lg-8 col-xl-9 col-xxl-9 col-md-9">
                @php
                    // Get the active pending application
                    $activeSubmission = \App\Models\UserSubmittedApplication::where('user_id', Auth::id())
                        ->where('status', 'pending')
                        ->with('visaApplication')
                        ->first();
                    
                    // Check if there's a completed submission
                    $completedSubmission = \App\Models\UserSubmittedApplication::where('user_id', Auth::id())
                        ->whereIn('status', ['submitted', 'under_review', 'approved', 'rejected'])
                        ->with('visaApplication')
                        ->latest()
                        ->first();
                @endphp

                @if($completedSubmission)
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
                                        <strong>Application Type:</strong> {{ $completedSubmission->visaApplication->name ?? 'N/A' }}<br>
                                        <strong>Submitted Date:</strong> {{ $completedSubmission->submitted_at ? $completedSubmission->submitted_at->format('M j, Y') : 'N/A' }}<br>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Current Status:</strong> 
                                        <span class="badge {{ 
                                            $completedSubmission->status === 'approved' ? 'bg-success' : 
                                            ($completedSubmission->status === 'under_review' ? 'bg-info' : 
                                            ($completedSubmission->status === 'rejected' ? 'bg-danger' : 'bg-warning'))
                                        }}">
                                            {{ ucfirst(str_replace('_', ' ', $completedSubmission->status)) }}
                                        </span><br>
                                        <strong>Last Updated:</strong> {{ $completedSubmission->updated_at->format('M j, Y') }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="alert alert-info">
                                <h6><i class="fa fa-info-circle me-2"></i>What's Next?</h6>
                                <ul class="mb-0">
                                    <li>Our team will review your application within 2-3 business days</li>
                                    <li>You will receive updates via email or message and in your dashboard</li>
                                    <li>You can now send messages to our support team for any questions</li>
                                </ul>
                            </div>

                            <div class="d-flex gap-3 flex-wrap">
                                <a href="{{ route('messages.compose') }}" class="btn btn-primary">
                                    <i class="fa fa-comments me-2"></i>Send Message to Support
                                </a>
                                <a href="{{ route('messages.index') }}" class="btn btn-outline-primary">
                                    <i class="fa fa-envelope me-2"></i>View Messages
                                </a>
                            </div>

                            <!-- PDF Generation for Submitted Applications -->
                            <div class="mt-4">
                                <div class="alert alert-info">
                                    <h6><i class="fa fa-file-pdf me-2"></i>Download Complete Application Package</h6>
                                    <p class="mb-3">You can download a complete PDF package of your application forms.</p>
                                    <button onclick="generateUserPdf()" id="user-pdf-btn-1" class="btn btn-danger">
                                        <i class="fa fa-file-pdf me-2"></i>Generate PDF Package
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @elseif($activeSubmission)
                    <!-- Active Application in Progress -->
                    @php
                        $applicationType = $activeSubmission->application_id;
                    @endphp

                    <!-- Section Progress Card -->
                    @if($applicationType == 1)
                        <!-- Fiancée Visa Sections -->
                        <div class="card mb-3">
                            <div class="card-header p-3">
                                <h2 class="card-title text-center">Section Progress - Fiancée Visa (K-1)</h2>
                            </div>
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6>Section</h6>
                                        <a href="{{ route('fianceSponsorApplication') }}" class="btn btn-tra-grey my-2 w-100">U.S. Sponsor Questions</a>
                                        <a href="{{ route('fianceAlienApplication') }}" class="btn btn-tra-grey my-2 w-100">Alien Questions</a>
                                        <a href="{{ route('fianceAlienChildApplication') }}" class="btn btn-tra-grey my-2 w-100">Alien Children Questions</a>
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
                                                {{ number_format($sponsorTotal, 0) }}%
                                            </div>
                                        </div>
                                        <div class="progress my-4">
                                            <div class="progress-bar progress-bar-striped bg-success" 
                                                role="progressbar" 
                                                style="width: {{ $alienTotal }}%" 
                                                aria-valuenow="{{ $alienTotal }}" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100">
                                                {{ number_format($alienTotal, 0) }}%
                                            </div>
                                        </div>
                                        <div class="progress my-4">
                                            <div class="progress-bar progress-bar-striped bg-success" 
                                                role="progressbar" 
                                                style="width: {{ $alienChildrenTotal }}%" 
                                                aria-valuenow="{{ $alienChildrenTotal }}" 
                                                aria-valuemin="0" 
                                                aria-valuemax="100">
                                                {{ number_format($alienChildrenTotal, 0) }}%
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @elseif($applicationType == 2)
                        <!-- Adjustment of Status -->
                        <div class="card mb-3">
                            <div class="card-header p-3">
                                <h2 class="card-title text-center">Section Progress - Adjustment of Status</h2>
                            </div>
                            <div class="card-body p-3">
                                @php
                                    $adjustmentType = \App\Models\AdjustmentType::where('user_id', Auth::id())
                                        ->where('submitted_app_id', $activeSubmission->id)
                                        ->first();
                                @endphp
                                
                                @if($adjustmentType)
                                    <div class="alert alert-info">
                                        <strong>Application Type:</strong> {{ ucfirst($adjustmentType->name) }}
                                    </div>
                                    <a href="{{ route('adjustmentVisaApplication', ['type' => $adjustmentType->name]) }}" class="btn btn-primary">
                                        <i class="fa fa-edit me-2"></i>Continue Application
                                    </a>
                                @else
                                    <div class="alert alert-warning">
                                        <h6><i class="fa fa-exclamation-triangle me-2"></i>Select Adjustment Type</h6>
                                        <p>Please select which type of Adjustment of Status application you need:</p>
                                    </div>
                                    <a href="{{ route('adjustment.show') }}" class="btn btn-primary">
                                        <i class="fa fa-arrow-right me-2"></i>Select Application Type
                                    </a>
                                @endif
                            </div>
                        </div>
                    @elseif($applicationType == 3)
                        <!-- Spouse Visa -->
                        <div class="card mb-3">
                            <div class="card-header p-3">
                                <h2 class="card-title text-center">Section Progress - Spouse Visa (CR-1/IR-1)</h2>
                            </div>
                            <div class="card-body p-3">
                                <a href="{{ route('spouseVisaApplication') }}" class="btn btn-primary">
                                    <i class="fa fa-edit me-2"></i>Continue Application
                                </a>
                            </div>
                        </div>
                    @elseif($applicationType == 4)
                        <!-- Combined CR-1 + AOS -->
                        <div class="card mb-3">
                            <div class="card-header p-3">
                                <h2 class="card-title text-center">Section Progress - Combined CR-1 + AOS</h2>
                            </div>
                            <div class="card-body p-3">
                                <a href="{{ route('combinedCr1AosApplication') }}" class="btn btn-primary">
                                    <i class="fa fa-edit me-2"></i>Continue Application
                                </a>
                            </div>
                        </div>
                    @endif

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
                                    <strong>{{ number_format($overAll, 0) }}%</strong>
                                </div>
                            </div>

                            @if($overAll >= 100)
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
                            @else
                                <!-- Still Need to Complete -->
                                <div class="mt-4">
                                    <div class="alert alert-warning">
                                        <h6><i class="fa fa-exclamation-triangle me-2"></i>Complete All Sections</h6>
                                        <p class="mb-0">Please complete all required sections before submitting your application. You are {{ number_format($overAll, 0) }}% complete.</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <!-- No Application Selected -->
                    <div class="card">
                        <div class="card-body p-4 text-center">
                            <i class="fa fa-exclamation-circle fa-3x text-warning mb-3"></i>
                            <h4>No Application in Progress</h4>
                            <p class="text-muted">You haven't started an application yet. Please select an application type to begin.</p>
                            <a href="{{ route('service') }}" class="btn btn-primary mt-3">
                                <i class="fa fa-plus me-2"></i>Start New Application
                            </a>
                        </div>
                    </div>
                @endif
            </div>            
        </div>
    </div>
</section>
@endsection

@section('customScript')
<script type="text/javascript">
    function generateUserPdf() {
        const btns = document.querySelectorAll('[id^="user-pdf-btn"]');
        
        btns.forEach(btn => {
            btn.disabled = true;
            btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Checking...';
        });
        
        fetch('{{ route("user.check-pdf-status") }}')
            .then(response => response.json())
            .then(data => {
                if (data.payment_required) {
                    btns.forEach(btn => {
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fa fa-file-pdf me-2"></i>Generate PDF Package';
                    });
                    
                    if (confirm('💳 Payment of $' + data.payment_amount.toFixed(2) + ' required to download PDF package.\n\nProceed to payment?')) {
                        window.location.href = '{{ route("payment.index") }}';
                    }
                    return;
                }
                
                if (!data.can_generate) {
                    btns.forEach(btn => {
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fa fa-file-pdf me-2"></i>Generate PDF Package';
                    });
                    alert('⚠️ ' + data.message);
                    return;
                }
                
                btns.forEach(btn => {
                    btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Generating ' + data.pdf_count + ' PDF(s)...';
                });
                
                setTimeout(() => {
                    window.location.href = '{{ route("user.generate-pdf") }}';
                }, 500);
            })
            .catch(error => {
                console.error('Error:', error);
                btns.forEach(btn => {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa fa-file-pdf me-2"></i>Generate PDF Package';
                });
                alert('Error checking status. Please try again.');
            });
    }
</script>
@endsection