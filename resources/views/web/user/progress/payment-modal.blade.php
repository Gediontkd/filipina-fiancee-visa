{{-- FILE: resources/views/web/user/progress/payment-modal.blade.php --}}
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
                        <h2 class="text-primary mb-0">${{ number_format($paymentStatus['amount'] ?? 0, 2) }}</h2>
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
                    <i class="fa fa-credit-card me-2"></i>Pay ${{ number_format($paymentStatus['amount'] ?? 0, 2) }} & Submit
                </button>
            </div>
        </div>
    </div>
</div>