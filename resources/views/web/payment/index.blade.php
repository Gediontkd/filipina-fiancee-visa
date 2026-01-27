{{-- resources/views/web/payment/index.blade.php --}}
@extends('web.layout.master')

@section('content')
<section class="payment-section ptb-80 bg-lightgrey">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0 text-white">
                            <i class="fa fa-credit-card me-2"></i>Complete Payment
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <!-- Payment Info -->
                        <div class="alert alert-info">
                            <h5><i class="fa fa-info-circle me-2"></i>Payment Required</h5>
                            <p class="mb-0">To download your complete PDF application package, please complete the payment below.</p>
                        </div>

                        <!-- Order Summary -->
                        <div class="bg-light p-4 rounded mb-4">
                            <h5 class="mb-3">Order Summary</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Application Type:</span>
                                <strong>{{ $application->visaApplication->name }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Application ID:</span>
                                <strong>#{{ $application->id }}</strong>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <h5>Total Amount:</h5>
                                <h5 class="text-primary">${{ number_format($amount, 2) }}</h5>
                            </div>
                        </div>

                        <!-- What You Get -->
                        <div class="mb-4">
                            <h5 class="mb-3">What You'll Receive:</h5>
                            <ul class="list-unstyled">
                                <li><i class="fa fa-check-circle text-success me-2"></i>Complete PDF application package</li>
                                <li><i class="fa fa-check-circle text-success me-2"></i>All required forms merged into one file</li>
                                <li><i class="fa fa-check-circle text-success me-2"></i>Ready for submission</li>
                                <li><i class="fa fa-check-circle text-success me-2"></i>Instant download access</li>
                            </ul>
                        </div>

                        <!-- Payment Button -->
                        <button id="checkout-button" class="btn btn-primary btn-lg w-100">
                            <i class="fa fa-lock me-2"></i>Proceed to Secure Payment
                        </button>

                        <p class="text-center text-muted mt-3 mb-0">
                            <small><i class="fa fa-shield-alt me-1"></i>Secured by Stripe - Your payment information is encrypted and secure</small>
                        </p>
                    </div>
                </div>

                <!-- Back Button -->
                <div class="text-center mt-3">
                    <a href="{{ route('user.page', 'progress') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customScript')
<script src="https://js.stripe.com/v3/"></script>
<script>
    const stripe = Stripe('{{ $stripeKey }}');
    const checkoutButton = document.getElementById('checkout-button');

    checkoutButton.addEventListener('click', async () => {
        checkoutButton.disabled = true;
        checkoutButton.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Processing...';

        try {
            // Create checkout session
            const response = await fetch('{{ route("payment") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                credentials: 'same-origin'
            });

            const data = await response.json();

            if (data.success) {
                // Redirect to Stripe Checkout
                const result = await stripe.redirectToCheckout({
                    sessionId: data.sessionId
                });

                if (result.error) {
                    alert(result.error.message);
                    checkoutButton.disabled = false;
                    checkoutButton.innerHTML = '<i class="fa fa-lock me-2"></i>Proceed to Secure Payment';
                }
            } else {
                alert(data.message || 'Payment initialization failed');
                checkoutButton.disabled = false;
                checkoutButton.innerHTML = '<i class="fa fa-lock me-2"></i>Proceed to Secure Payment';
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Payment initialization failed. Please try again.');
            checkoutButton.disabled = false;
            checkoutButton.innerHTML = '<i class="fa fa-lock me-2"></i>Proceed to Secure Payment';
        }
    });
</script>
@endsection