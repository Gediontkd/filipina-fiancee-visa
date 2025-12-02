{{-- FILE: resources/views/web/user/progress.blade.php --}}
{{-- FIXED: Properly handles all three visa types --}}

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
                    {{-- APPLICATION ALREADY SUBMITTED --}}
                    @include('web.user.progress.completed-submission', [
                        'submission' => $completedSubmission,
                        'paymentStatus' => $paymentStatus,
                        'pdfStatus' => $pdfStatus
                    ])

                @elseif($activeSubmission)
                    {{-- ACTIVE APPLICATION IN PROGRESS --}}
                    @php
                        $applicationType = $activeSubmission->application_id;
                        $overAll = 0;
                        
                        // Calculate completion based on app type
                        if ($applicationType == 1) {
                            // Fiancée Visa (K-1)
                            $fianceeSponsor = \App\Models\FianceVisaStep::where('user_id', Auth::id())->first();
                            $fianceeAlien = \App\Models\FianceAlien::where('user_id', Auth::id())->first();
                            
                            if ($fianceeSponsor || $fianceeAlien) {
                                $sponsorComplete = $fianceeSponsor ? 50 : 0;
                                $alienComplete = $fianceeAlien ? 50 : 0;
                                $overAll = $sponsorComplete + $alienComplete;
                            }
                            
                        } elseif ($applicationType == 2) {
                            // Adjustment of Status (AOS)
                            $aosApp = \App\Models\SimplifiedAosApplication::where('user_id', Auth::id())
                                ->where('submitted_app_id', $activeSubmission->id)->first();
                            if ($aosApp) {
                                $service = new \App\Http\Services\AdjustmentOfStatus\SimplifiedAosService();
                                $overAll = $service->calculateCompletion($aosApp);
                            }
                            
                        } elseif ($applicationType == 3) {
                            // Spouse Visa (CR-1/IR-1)
                            $spouseApp = \App\Models\SimplifiedSpouseVisaApplication::where('user_id', Auth::id())
                                ->where('submitted_app_id', $activeSubmission->id)->first();
                            if ($spouseApp) {
                                $service = new \App\Http\Services\Spouse\SimplifiedSpouseVisaService();
                                $overAll = $service->calculateCompletion($spouseApp);
                            }
                        }
                        
                        $isComplete = $overAll >= 100;
                    @endphp

                    {{-- APPLICATION TYPE SPECIFIC PROGRESS CARDS --}}
                    @if($applicationType == 1)
                        @include('web.user.progress.fiancee-visa', [
                            'activeSubmission' => $activeSubmission,
                            'overAll' => $overAll
                        ])
                    @elseif($applicationType == 2)
                        @include('web.user.progress.adjustment-of-status', [
                            'activeSubmission' => $activeSubmission,
                            'overAll' => $overAll
                        ])
                    @elseif($applicationType == 3)
                        @include('web.user.progress.spouse-visa', [
                            'activeSubmission' => $activeSubmission,
                            'overAll' => $overAll
                        ])
                    @endif

                    {{-- REQUEST REVIEW SECTION - ALWAYS VISIBLE --}}
                    @include('web.user.progress.request-review', [
                        'overAll' => $overAll,
                        'isComplete' => $isComplete,
                        'paymentStatus' => $paymentStatus
                    ])

                @else
                    {{-- NO APPLICATION --}}
                    @include('web.user.progress.no-application')
                @endif
            </div>            
        </div>
    </div>
</section>

{{-- PAYMENT MODAL --}}
@include('web.user.progress.payment-modal', ['paymentStatus' => $paymentStatus])

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
                stripe.redirectToCheckout({ sessionId: data.sessionId });
            } else {
                alert('❌ Payment failed: ' + data.message);
                btn.disabled = false;
                btn.innerHTML = '<i class="fa fa-credit-card me-2"></i>Pay ${{ number_format($paymentStatus['amount'] ?? 0, 2) }} & Submit';
            }
        })
        .catch(error => {
            console.error('Payment error:', error);
            alert('❌ An error occurred. Please try again.');
            btn.disabled = false;
            btn.innerHTML = '<i class="fa fa-credit-card me-2"></i>Pay ${{ number_format($paymentStatus['amount'] ?? 0, 2) }} & Submit';
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