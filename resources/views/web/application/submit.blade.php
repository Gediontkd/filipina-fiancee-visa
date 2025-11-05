{{-- FILE: resources/views/web/application/submit.blade.php --}}
{{-- ACTION: REPLACE your existing file with this version --}}

@extends('web.layout.master')

@section('content')
<section class="myaccount ptb-80 bg-lightgrey">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xl-3 col-xxl-3 col-md-4 mb-mob-15">
                @include('web.component.profile-sidebar')
            </div>
            <div class="col-lg-8 col-xl-9 col-xxl-9 col-md-9">
                <div class="card mb-3">
                    <div class="card-header p-3">
                        <h2 class="card-title">
                            @if($existingSubmission)
                                Update Your Application
                            @else
                                Review & Submit Your Application
                            @endif
                        </h2>
                        <p class="mb-0 text-muted">
                            @if($existingSubmission)
                                Update and resubmit your application with any changes
                            @else
                                Review your information and submit your application for processing
                            @endif
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <!-- Application Summary -->
                        <div class="alert alert-info">
                            <h5><i class="fa fa-info-circle me-2"></i>Application Summary</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Application Type:</strong> {{ $visaApplication->name }}<br>
                                    <strong>Applicant:</strong> {{ $user->name }}<br>
                                    <strong>Email:</strong> {{ $user->email }}
                                </div>
                            </div>
                        </div>

                        @if($existingSubmission)
                            <!-- Existing Submission Info (ONLY FOR ACTUAL RESUBMISSIONS) -->
                            <div class="alert alert-warning">
                                <h6><i class="fa fa-exclamation-triangle me-2"></i>Existing Submission Found</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Previous Submission:</strong> {{ $existingSubmission->submitted_at->format('M j, Y') }}<br>
                                        <strong>Current Status:</strong> 
                                        <span class="badge {{ 
                                            $existingSubmission->status === 'approved' ? 'bg-success' : 
                                            ($existingSubmission->status === 'under_review' ? 'bg-info' : 
                                            ($existingSubmission->status === 'rejected' ? 'bg-danger' : 'bg-warning'))
                                        }}">
                                            {{ ucfirst(str_replace('_', ' ', $existingSubmission->status)) }}
                                        </span>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="mb-0">You can update your application with new information and resubmit for review.</p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Submission Form -->
                        <form method="POST" action="{{ route('application.submit') }}" id="submission-form">
                            @csrf
                            
                            <input type="hidden" name="submission_type" value="{{ $existingSubmission ? 'update' : 'new' }}">
                            
                            <!-- Terms and Conditions -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">
                                        @if($existingSubmission)
                                            Update Confirmation
                                        @else
                                            Submission Confirmation
                                        @endif
                                    </h5>
                                </div>
                                <div class="card-body">
                                    @if($existingSubmission)
                                        {{-- RESUBMISSION CHECKBOXES --}}
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="confirm_submission" name="confirm_submission" required>
                                            <label class="form-check-label" for="confirm_submission">
                                                I confirm that I want to update my application with the new information.
                                                This will replace my previous submission and return it to our team for review.
                                            </label>
                                        </div>
                                        
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms" required>
                                            <label class="form-check-label" for="agree_terms">
                                                I understand the submission process.
                                            </label>
                                        </div>

                                        <div class="alert alert-info">
                                            <h6><i class="fa fa-info-circle me-2"></i>What Happens Next</h6>
                                            <ul class="mb-0">
                                                <li>Your updated information will be saved and resubmitted for review</li>
                                                <li>Our team will review your updates within 2–3 business days</li>
                                                <li>You can continue to add or adjust information at any time before approval</li>
                                                <li>You'll receive a message as soon as your review is complete</li>
                                            </ul>
                                        </div>
                                    @else
                                        {{-- FIRST-TIME SUBMISSION CHECKBOXES (FIXED TEXT) --}}
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="confirm_submission" name="confirm_submission" required>
                                            <label class="form-check-label" for="confirm_submission">
                                                <strong>I confirm that I want to submit my application.</strong>
                                                I understand that this will send my application to the team for review.
                                            </label>
                                        </div>
                                        
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms" required>
                                            <label class="form-check-label" for="agree_terms">
                                                <strong>I agree to the terms and conditions.</strong>
                                                I understand the submission process.
                                            </label>
                                        </div>

                                        <div class="alert alert-success">
                                            <h6><i class="fa fa-check-circle me-2"></i>What Happens Next</h6>
                                            <ul class="mb-0">
                                                <li>Your application will be submitted with current information</li>
                                                <li>Our team will review within 2-3 business days</li>
                                                <li>You can send messages to our support team for any questions</li>
                                                <li>You can continue adding information later</li>
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('user.page', 'progress') }}" class="btn btn-outline-secondary">
                                    <i class="fa fa-arrow-left me-2"></i>Back to Progress
                                </a>
                                
                                <button type="submit" class="btn btn-success btn-lg" id="submit-btn">
                                    <i class="fa fa-paper-plane me-2"></i>
                                    {{ $existingSubmission ? 'Update Application' : 'Submit Application' }}
                                </button>
                            </div>
                        </form>
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
    const form = document.getElementById('submission-form');
    const submitBtn = document.getElementById('submit-btn');
    
    if (form && submitBtn) {
        form.addEventListener('submit', function(e) {
            // Confirm submission
            const isUpdate = {{ $existingSubmission ? 'true' : 'false' }};
            const confirmMessage = isUpdate 
                ? 'Are you sure you want to update and resubmit your application?' 
                : 'Are you sure you want to submit your application?';
                
            if (!confirm(confirmMessage)) {
                e.preventDefault();
                return false;
            }
            
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>' + 
                (isUpdate ? 'Updating...' : 'Submitting...');
            
            // Re-enable if validation fails
            setTimeout(() => {
                if (!form.checkValidity()) {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fa fa-paper-plane me-2"></i>' + 
                        (isUpdate ? 'Update Application' : 'Submit Application');
                }
            }, 100);
        });
    }
});
</script>
@endsection