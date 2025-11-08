{{-- FILE: resources/views/web/user/progress.blade.php --}}
{{-- FIXED: Always-visible Request Review button with payment modal --}}

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
                    use App\Helpers\PaymentHelper;
                    use App\Helpers\PdfControlHelper;
                    
                    $activeSubmission = \App\Models\UserSubmittedApplication::where('user_id', Auth::id())
                        ->where('status', 'pending')
                        ->with('visaApplication')
                        ->first();
                    
                    $completedSubmission = \App\Models\UserSubmittedApplication::where('user_id', Auth::id())
                        ->whereIn('status', ['submitted', 'under_review', 'approved', 'rejected'])
                        ->with('visaApplication')
                        ->latest()
                        ->first();
                    
                    $paymentStatus = PaymentHelper::checkPaymentStatus(Auth::id());
                    $pdfStatus = PdfControlHelper::checkPdfStatus(Auth::id());
                @endphp

                @if($completedSubmission)
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
                                                <i class="fa fa-file-pdf me-2"></i>Download PDF Package
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

                @elseif($activeSubmission)
                    {{-- ACTIVE APPLICATION IN PROGRESS --}}
                    @php
                        $applicationType = $activeSubmission->application_id;
                        
                        // Calculate completion based on app type
                        if ($applicationType == 2) {
                            $aosApp = \App\Models\SimplifiedAosApplication::where('user_id', Auth::id())
                                ->where('submitted_app_id', $activeSubmission->id)->first();
                            if ($aosApp) {
                                $service = new \App\Http\Services\AdjustmentOfStatus\SimplifiedAosService();
                                $overAll = $service->calculateCompletion($aosApp);
                            }
                        } elseif ($applicationType == 3) {
                            $spouseApp = \App\Models\SimplifiedSpouseVisaApplication::where('user_id', Auth::id())
                                ->where('submitted_app_id', $activeSubmission->id)->first();
                            if ($spouseApp) {
                                $service = new \App\Http\Services\Spouse\SimplifiedSpouseVisaService();
                                $overAll = $service->calculateCompletion($spouseApp);
                            }
                        }
                        
                        $isComplete = $overAll >= 100;
                    @endphp

                    {{-- Application Type Specific Progress Cards (Same as before) --}}
                    @if($applicationType == 3)
                        {{-- SPOUSE VISA --}}
                        <div class="card mb-3">
                            <div class="card-header p-3 bg-primary text-white">
                                <h2 class="card-title text-white mb-0">
                                    <i class="fa fa-heart me-2"></i>Spouse Visa Application (CR-1/IR-1)
                                </h2>
                            </div>
                            <div class="card-body p-3">
                                @php
                                    $spouseApp = \App\Models\SimplifiedSpouseVisaApplication::where('user_id', Auth::id())
                                        ->where('submitted_app_id', $activeSubmission->id)->first();
                                @endphp

                                @if($spouseApp)
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h6 class="mb-2">Application Progress</h6>
                                            <div class="progress" style="height: 30px;">
                                                <div class="progress-bar progress-bar-striped {{ $overAll >= 100 ? 'bg-success' : 'bg-info' }}" 
                                                    role="progressbar" 
                                                    style="width: {{ $overAll }}%" 
                                                    aria-valuenow="{{ $overAll }}" 
                                                    aria-valuemin="0" 
                                                    aria-valuemax="100">
                                                    <strong>{{ $overAll }}%</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-4">
                                            <div class="card border-{{ $spouseApp->sponsor_first_name ? 'success' : 'secondary' }}">
                                                <div class="card-body p-3 text-center">
                                                    <i class="fa fa-user fa-2x mb-2 text-{{ $spouseApp->sponsor_first_name ? 'success' : 'muted' }}"></i>
                                                    <h6>Sponsor</h6>
                                                    <span class="badge bg-{{ $spouseApp->sponsor_first_name ? 'success' : 'secondary' }}">
                                                        {{ $spouseApp->sponsor_first_name ? 'Started' : 'Not Started' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border-{{ $spouseApp->beneficiary_first_name ? 'success' : 'secondary' }}">
                                                <div class="card-body p-3 text-center">
                                                    <i class="fa fa-user-friends fa-2x mb-2 text-{{ $spouseApp->beneficiary_first_name ? 'success' : 'muted' }}"></i>
                                                    <h6>Beneficiary</h6>
                                                    <span class="badge bg-{{ $spouseApp->beneficiary_first_name ? 'success' : 'secondary' }}">
                                                        {{ $spouseApp->beneficiary_first_name ? 'Started' : 'Not Started' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card border-{{ $spouseApp->marriage_date ? 'success' : 'secondary' }}">
                                                <div class="card-body p-3 text-center">
                                                    <i class="fa fa-heart fa-2x mb-2 text-{{ $spouseApp->marriage_date ? 'success' : 'muted' }}"></i>
                                                    <h6>Relationship</h6>
                                                    <span class="badge bg-{{ $spouseApp->marriage_date ? 'success' : 'secondary' }}">
                                                        {{ $spouseApp->marriage_date ? 'Started' : 'Not Started' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <a href="{{ route('spouse-visa-simplified.index') }}" class="btn btn-primary btn-lg">
                                            <i class="fa fa-edit me-2"></i>Continue Application
                                        </a>
                                        
                                        @if($spouseApp->status === 'draft')
                                            <p class="text-muted mt-2 mb-0">
                                                <small>
                                                    <i class="fa fa-save me-1"></i>
                                                    Last saved: {{ $spouseApp->updated_at->diffForHumans() }}
                                                </small>
                                            </p>
                                        @endif
                                    </div>
                                @else
                                    <div class="text-center">
                                        <a href="{{ route('spouse-visa-simplified.index') }}" class="btn btn-primary btn-lg">
                                            <i class="fa fa-plus me-2"></i>Start Application
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- REQUEST REVIEW SECTION - ALWAYS VISIBLE --}}
                    <div class="card mb-3 border-primary">
                        <div class="card-header p-3 bg-light">
                            <h3 class="card-title mb-0">
                                <i class="fa fa-paper-plane me-2 text-primary"></i>Ready to Submit?
                            </h3>
                        </div>
                        <div class="card-body p-4">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <h5 class="mb-3">Overall Progress</h5>
                                    <div class="progress" style="height: 35px;">
                                        <div class="progress-bar progress-bar-striped {{ $isComplete ? 'bg-success' : 'bg-warning' }}" 
                                            role="progressbar" 
                                            style="width: {{ $overAll }}%" 
                                            aria-valuenow="{{ $overAll }}" 
                                            aria-valuemin="0" 
                                            aria-valuemax="100">
                                            <strong style="font-size: 16px;">{{ number_format($overAll, 0) }}% Complete</strong>
                                        </div>
                                    </div>
                                    
                                    @if(!$isComplete)
                                        <p class="text-muted mt-2 mb-0">
                                            <i class="fa fa-info-circle me-1"></i>
                                            {{ 100 - $overAll }}% remaining - Complete all sections to request review
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <div class="text-center">
                                {{-- ALWAYS VISIBLE BUTTON --}}
                                <button 
                                    type="button" 
                                    id="requestReviewBtn"
                                    class="btn btn-lg {{ $isComplete ? 'btn-success' : 'btn-secondary' }}"
                                    {{ !$isComplete ? 'disabled' : '' }}
                                    onclick="{{ $isComplete ? 'showPaymentModal()' : 'showIncompleteMessage()' }}"
                                    style="min-width: 280px; padding: 15px 30px; font-size: 18px;">
                                    <i class="fa fa-{{ $isComplete ? 'check-circle' : 'lock' }} me-2"></i>
                                    Request Review
                                </button>
                                
                                @if($isComplete)
                                    <p class="text-success mt-3 mb-0">
                                        <i class="fa fa-check-circle me-1"></i>
                                        <strong>Great! Your application is complete and ready to submit.</strong>
                                    </p>
                                @else
                                    <p class="text-muted mt-3 mb-0">
                                        Complete all required sections above to unlock this button
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                @else
                    {{-- NO APPLICATION --}}
                    <div class="card">
                        <div class="card-body p-4 text-center">
                            <i class="fa fa-exclamation-circle fa-3x text-warning mb-3"></i>
                            <h4>No Application in Progress</h4>
                            <p class="text-muted">You haven't started an application yet.</p>
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

{{-- PAYMENT MODAL --}}
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title text-white" id="paymentModalLabel">
                    <i class="fa fa-shield-alt me-2"></i>Complete Your Full Service Package
                </h4>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-info mb-4">
                    <h5><i class="fa fa-info-circle me-2"></i>What You're Getting</h5>
                    <p class="mb-0">Our comprehensive immigration application service includes:</p>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Expert review of your entire application</li>
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Professional PDF package generation</li>
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Form preparation and formatting</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Document checklist and guidance</li>
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Submission instructions</li>
                            <li class="mb-2"><i class="fa fa-check text-success me-2"></i>Ongoing email support</li>
                        </ul>
                    </div>
                </div>

                <div class="card bg-light mb-4">
                    <div class="card-body text-center">
                        <h3 class="mb-2">Service Fee</h3>
                        <h2 class="text-primary mb-0">${{ number_format($paymentStatus['amount'], 2) }}</h2>
                        <p class="text-muted mb-0">One-time payment</p>
                    </div>
                </div>

                <div class="alert alert-success mb-4">
                    <i class="fa fa-lock me-2"></i>
                    <strong>100% Secure Payment</strong> - Your payment information is encrypted and secure. 
                    We use industry-standard Stripe payment processing.
                </div>

                <p class="text-muted small text-center mb-0">
                    By proceeding, you agree to our terms of service. After successful payment, 
                    your application will be automatically submitted for expert review.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fa fa-times me-2"></i>Cancel
                </button>
                <button type="button" class="btn btn-success btn-lg" onclick="processPayment()" id="payNowBtn">
                    <i class="fa fa-credit-card me-2"></i>Pay ${{ number_format($paymentStatus['amount'], 2) }} & Submit
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('customScript')
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    const stripe = Stripe('{{ config('services.stripe.key') }}');

    function showIncompleteMessage() {
        alert('⚠️ Please complete all required information in your account before requesting a review.');
    }

    function showPaymentModal() {
        const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
        modal.show();
    }

    function processPayment() {
        const btn = document.getElementById('payNowBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Processing...';

        // Create Stripe Checkout Session
        fetch('{{ route('payment') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect to Stripe Checkout
                stripe.redirectToCheckout({
                    sessionId: data.sessionId
                });
            } else {
                alert('❌ Payment failed: ' + data.message);
                btn.disabled = false;
                btn.innerHTML = '<i class="fa fa-credit-card me-2"></i>Pay ${{ number_format($paymentStatus['amount'], 2) }} & Submit';
            }
        })
        .catch(error => {
            console.error('Payment error:', error);
            alert('❌ An error occurred. Please try again.');
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-credit-card me-2"></i>Pay ${{ number_format($paymentStatus['amount'], 2) }} & Submit';
        });
    }

    function generateUserPdf() {
        const btn = document.getElementById('user-pdf-btn-1');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Generating...';
        
        setTimeout(() => {
            window.location.href = '{{ route("user.generate-pdf") }}';
        }, 500);
    }
</script>
@endsection