{{-- resources/views/web/user/progress.blade.php (UPDATED - Payment & PDF for ALL) --}}
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
                    
                    // Check payment status
                    $paymentStatus = PaymentHelper::checkPaymentStatus(Auth::id());
                    
                    // Check PDF status
                    $pdfStatus = PdfControlHelper::checkPdfStatus(Auth::id());
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

                            <!-- PDF Download Section -->
                            <div class="mt-4">
                                @if($paymentStatus['has_paid'])
                                    <!-- Payment Complete - Show PDF Download -->
                                    <div class="alert alert-success">
                                        <h6><i class="fa fa-check-circle me-2"></i>Payment Completed</h6>
                                        <p class="mb-3">
                                            <strong>Amount Paid:</strong> ${{ number_format($paymentStatus['amount'], 2) }}<br>
                                            <strong>Paid On:</strong> {{ $paymentStatus['paid_at']->format('M j, Y') }}
                                        </p>
                                        
                                        @if($pdfStatus['can_generate'])
                                            <button onclick="generateUserPdf()" id="user-pdf-btn-1" class="btn btn-danger">
                                                <i class="fa fa-file-pdf me-2"></i>Download PDF Package ({{ $pdfStatus['pdf_count'] }} file(s))
                                            </button>
                                        @else
                                            <div class="alert alert-warning mb-0">
                                                <i class="fa fa-clock me-2"></i>{{ $pdfStatus['message'] }}
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <!-- Payment Required -->
                                    <div class="alert alert-warning">
                                        <h6><i class="fa fa-credit-card me-2"></i>Payment Required for PDF Download</h6>
                                        <p class="mb-3">Complete payment to download your application package.</p>
                                        <p class="mb-3">
                                            <strong>Amount:</strong> ${{ number_format($paymentStatus['amount'], 2) }}
                                        </p>
                                        <a href="{{ route('payment.index') }}" class="btn btn-warning">
                                            <i class="fa fa-credit-card me-2"></i>Complete Payment (${{ number_format($paymentStatus['amount'], 2) }})
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @elseif($activeSubmission)
                    <!-- Active Application in Progress -->
                    @php
                        $applicationType = $activeSubmission->application_id;
                    @endphp

                    <!-- Application Type Specific Progress -->
                    @if($applicationType == 1)
                        {{-- FIANCE VISA - Keep existing code --}}
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
                        {{-- ADJUSTMENT OF STATUS --}}
                        <div class="card mb-3">
                            <div class="card-header p-3 bg-primary text-white">
                                <h2 class="card-title text-white mb-0">
                                    <i class="fa fa-id-card me-2"></i>Adjustment of Status Application (I-485)
                                </h2>
                            </div>
                            <div class="card-body p-3">
                                @php
                                    $aosApp = \App\Models\SimplifiedAosApplication::where('user_id', Auth::id())
                                        ->where('submitted_app_id', $activeSubmission->id)
                                        ->first();
                                    
                                    $aosCompletion = 0;
                                    if ($aosApp) {
                                        $service = new \App\Http\Services\AdjustmentOfStatus\SimplifiedAosService();
                                        $aosCompletion = $service->calculateCompletion($aosApp);
                                    }
                                @endphp

                                @if($aosApp)
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h6 class="mb-2">Application Progress</h6>
                                            <div class="progress" style="height: 30px;">
                                                <div class="progress-bar progress-bar-striped {{ $aosCompletion >= 100 ? 'bg-success' : 'bg-info' }}" 
                                                    role="progressbar" 
                                                    style="width: {{ $aosCompletion }}%" 
                                                    aria-valuenow="{{ $aosCompletion }}" 
                                                    aria-valuemin="0" 
                                                    aria-valuemax="100">
                                                    <strong>{{ $aosCompletion }}%</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-md-3">
                                            <div class="card border-{{ $aosApp->applicant_first_name ? 'success' : 'secondary' }}">
                                                <div class="card-body p-3 text-center">
                                                    <i class="fa fa-user fa-2x mb-2 text-{{ $aosApp->applicant_first_name ? 'success' : 'muted' }}"></i>
                                                    <h6>Applicant Info</h6>
                                                    <span class="badge bg-{{ $aosApp->applicant_first_name ? 'success' : 'secondary' }}">
                                                        {{ $aosApp->applicant_first_name ? 'Started' : 'Not Started' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card border-{{ $aosApp->current_visa_type ? 'success' : 'secondary' }}">
                                                <div class="card-body p-3 text-center">
                                                    <i class="fa fa-passport fa-2x mb-2 text-{{ $aosApp->current_visa_type ? 'success' : 'muted' }}"></i>
                                                    <h6>Immigration Status</h6>
                                                    <span class="badge bg-{{ $aosApp->current_visa_type ? 'success' : 'secondary' }}">
                                                        {{ $aosApp->current_visa_type ? 'Started' : 'Not Started' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card border-{{ $aosApp->sponsor_first_name ? 'success' : 'secondary' }}">
                                                <div class="card-body p-3 text-center">
                                                    <i class="fa fa-users fa-2x mb-2 text-{{ $aosApp->sponsor_first_name ? 'success' : 'muted' }}"></i>
                                                    <h6>Sponsor</h6>
                                                    <span class="badge bg-{{ $aosApp->sponsor_first_name ? 'success' : 'secondary' }}">
                                                        {{ $aosApp->sponsor_first_name ? 'Started' : 'Not Started' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card border-{{ $aosApp->arrested_or_convicted !== null ? 'success' : 'secondary' }}">
                                                <div class="card-body p-3 text-center">
                                                    <i class="fa fa-clipboard-list fa-2x mb-2 text-{{ $aosApp->arrested_or_convicted !== null ? 'success' : 'muted' }}"></i>
                                                    <h6>Background</h6>
                                                    <span class="badge bg-{{ $aosApp->arrested_or_convicted !== null ? 'success' : 'secondary' }}">
                                                        {{ $aosApp->arrested_or_convicted !== null ? 'Started' : 'Not Started' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <a href="{{ route('aos-simplified.index') }}" class="btn btn-primary btn-lg">
                                            <i class="fa fa-edit me-2"></i>Continue Application
                                        </a>
                                        
                                        @if($aosApp->status === 'draft')
                                            <p class="text-muted mt-2 mb-0">
                                                <small>
                                                    <i class="fa fa-save me-1"></i>
                                                    Last saved: {{ $aosApp->updated_at->diffForHumans() }}
                                                </small>
                                            </p>
                                        @endif
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <h6><i class="fa fa-info-circle me-2"></i>Get Started</h6>
                                        <p class="mb-0">Start your Adjustment of Status application.</p>
                                    </div>
                                    
                                    <div class="text-center">
                                        <a href="{{ route('aos-simplified.index') }}" class="btn btn-primary btn-lg">
                                            <i class="fa fa-plus me-2"></i>Start AOS Application
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                    @elseif($applicationType == 3)
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
                                        ->where('submitted_app_id', $activeSubmission->id)
                                        ->first();
                                    
                                    $spouseCompletion = 0;
                                    if ($spouseApp) {
                                        $service = new \App\Http\Services\Spouse\SimplifiedSpouseVisaService();
                                        $spouseCompletion = $service->calculateCompletion($spouseApp);
                                    }
                                @endphp

                                @if($spouseApp)
                                    <div class="row mb-4">
                                        <div class="col-md-12">
                                            <h6 class="mb-2">Application Progress</h6>
                                            <div class="progress" style="height: 30px;">
                                                <div class="progress-bar progress-bar-striped {{ $spouseCompletion >= 100 ? 'bg-success' : 'bg-info' }}" 
                                                    role="progressbar" 
                                                    style="width: {{ $spouseCompletion }}%" 
                                                    aria-valuenow="{{ $spouseCompletion }}" 
                                                    aria-valuemin="0" 
                                                    aria-valuemax="100">
                                                    <strong>{{ $spouseCompletion }}%</strong>
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
                                    <div class="alert alert-info">
                                        <h6><i class="fa fa-info-circle me-2"></i>Get Started</h6>
                                        <p class="mb-0">Start your spouse visa application.</p>
                                    </div>
                                    
                                    <div class="text-center">
                                        <a href="{{ route('spouse-visa-simplified.index') }}" class="btn btn-primary btn-lg">
                                            <i class="fa fa-plus me-2"></i>Start Spouse Visa Application
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                    @elseif($applicationType == 4)
                        {{-- COMBINED CR-1 + AOS --}}
                        <div class="card mb-3">
                            <div class="card-header p-3">
                                <h2 class="card-title text-center">Combined CR-1 + AOS</h2>
                            </div>
                            <div class="card-body p-3">
                                <a href="{{ route('combinedCr1AosApplication') }}" class="btn btn-primary">
                                    <i class="fa fa-edit me-2"></i>Continue Application
                                </a>
                            </div>
                        </div>
                    @endif

                    <!-- Overall Progress & Submit -->
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
                                <div class="mt-4">
                                    <div class="alert alert-success">
                                        <h5><i class="fa fa-check-circle me-2"></i>Ready to Submit!</h5>
                                        <p>Complete all required sections. Your application is ready for submission.</p>
                                    </div>
                                    
                                    <!-- Payment Required Before Submission -->
                                    @if($paymentStatus['has_paid'])
                                        <div class="text-center">
                                            <a href="{{ route('application.review') }}" class="btn btn-success btn-lg">
                                                <i class="fa fa-paper-plane me-2"></i>Review & Submit Application
                                            </a>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            <h6><i class="fa fa-credit-card me-2"></i>Payment Required Before Submission</h6>
                                            <p class="mb-3">Please complete payment before submitting your application.</p>
                                            <a href="{{ route('payment.index') }}" class="btn btn-warning btn-lg">
                                                <i class="fa fa-credit-card me-2"></i>Pay Now (${{ number_format($paymentStatus['amount'], 2) }})
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="mt-4">
                                    <div class="alert alert-warning">
                                        <h6><i class="fa fa-exclamation-triangle me-2"></i>Complete All Sections</h6>
                                        <p class="mb-0">Please complete all required sections. You are {{ number_format($overAll, 0) }}% complete.</p>
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
                        btn.innerHTML = '<i class="fa fa-file-pdf me-2"></i>Download PDF Package';
                    });
                    
                    if (confirm('💳 Payment of $' + data.payment_amount.toFixed(2) + ' required to download PDF package.\n\nProceed to payment?')) {
                        window.location.href = '{{ route("payment.index") }}';
                    }
                    return;
                }
                
                if (!data.can_generate) {
                    btns.forEach(btn => {
                        btn.disabled = false;
                        btn.innerHTML = '<i class="fa fa-file-pdf me-2"></i>Download PDF Package';
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
                    btn.innerHTML = '<i class="fa fa-file-pdf me-2"></i>Download PDF Package';
                });
                alert('Error checking status. Please try again.');
            });
    }
</script>
@endsection