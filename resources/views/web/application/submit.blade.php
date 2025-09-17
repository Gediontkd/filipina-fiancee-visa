{{-- resources/views/web/application/submit.blade.php --}}
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
                                Submit Your Application
                            @endif
                        </h2>
                        <p class="mb-0 text-muted">
                            @if($existingSubmission)
                                Update and resubmit your application with any changes
                            @else
                                Submit your application with the information you have available
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
                                <div class="col-md-6">
                                    <strong>Completion Status:</strong> 
                                    <span class="badge {{ $completionStatus['completion_percentage'] >= 100 ? 'bg-success' : ($completionStatus['completion_percentage'] >= 50 ? 'bg-warning' : 'bg-secondary') }}">
                                        {{ $completionStatus['completion_percentage'] }}% Complete
                                    </span><br>
                                    <strong>Sections with Data:</strong> {{ $completionStatus['completed_sections'] }}/{{ $completionStatus['total_sections'] }}
                                </div>
                            </div>
                        </div>

                        @if($existingSubmission)
                            <!-- Existing Submission Info -->
                            <div class="alert alert-warning">
                                <h6><i class="fa fa-exclamation-triangle me-2"></i>Existing Submission Found</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>Previous Submission:</strong> {{ $existingSubmission->created_at->format('M j, Y') }}<br>
                                        <strong>Transaction ID:</strong> {{ $existingSubmission->transaction_id }}<br>
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

                        <!-- Completion Status -->
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5 class="mb-0">Application Sections Status</h5>
                            </div>
                            <div class="card-body">
                                @if($completionStatus['has_any_data'])
                                    @if($user->chosen_application == 'fiance' || $user->chosen_application == 'fiancee')
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="text-center p-3 border rounded">
                                                    <i class="fa fa-user text-primary fa-2x mb-2"></i>
                                                    <h6>U.S. Sponsor</h6>
                                                    <span class="badge {{ $completionStatus['sections']['sponsor'] ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $completionStatus['sections']['sponsor'] ? 'Complete' : 'Not Started' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center p-3 border rounded">
                                                    <i class="fa fa-user-friends text-primary fa-2x mb-2"></i>
                                                    <h6>Alien Information</h6>
                                                    <span class="badge {{ $completionStatus['sections']['alien'] ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $completionStatus['sections']['alien'] ? 'Complete' : 'Not Started' }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-center p-3 border rounded">
                                                    <i class="fa fa-child text-primary fa-2x mb-2"></i>
                                                    <h6>Children (if any)</h6>
                                                    <span class="badge {{ $completionStatus['sections']['children'] ? 'bg-success' : 'bg-secondary' }}">
                                                        {{ $completionStatus['sections']['children'] ? 'Complete' : 'Not Started' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center p-4 border rounded">
                                            <i class="fa fa-check-circle text-success fa-3x mb-3"></i>
                                            <h5>Application data has been provided</h5>
                                            <p class="text-muted">{{ $completionStatus['completion_percentage'] }}% of sections completed</p>
                                        </div>
                                    @endif
                                    
                                    <div class="alert alert-success mt-3">
                                        <i class="fa fa-check-circle me-2"></i>
                                        <strong>Ready to Submit!</strong> You have provided information that can be submitted for review.
                                        @if($completionStatus['completion_percentage'] < 100)
                                            You can always update your application later with additional information.
                                        @endif
                                    </div>
                                @else
                                    <div class="alert alert-warning">
                                        <i class="fa fa-exclamation-triangle me-2"></i>
                                        <strong>No Data Found:</strong> You haven't started filling out any application sections yet.
                                        You can still submit a placeholder application and complete it later.
                                    </div>
                                @endif
                            </div>
                        </div>

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
                                            Terms and Conditions
                                        @endif
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="confirm_submission" name="confirm_submission" required>
                                        <label class="form-check-label" for="confirm_submission">
                                            @if($existingSubmission)
                                                <strong>I confirm that I want to update my application.</strong>
                                                I understand that this will reset my application status to pending for re-review.
                                            @else
                                                <strong>I confirm that the information provided is accurate.</strong>
                                                I understand that I can update my application later if needed.
                                            @endif
                                        </label>
                                    </div>
                                    
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="agree_terms" name="agree_terms" required>
                                        <label class="form-check-label" for="agree_terms">
                                            <strong>I agree to the terms and conditions.</strong>
                                            I understand the submission process and my rights.
                                        </label>
                                    </div>

                                    <div class="alert {{ $existingSubmission ? 'alert-info' : 'alert-success' }}">
                                        <h6><i class="fa fa-info-circle me-2"></i>What happens next?</h6>
                                        <ul class="mb-0">
                                            @if($existingSubmission)
                                                <li>Your application will be updated with current information</li>
                                                <li>Status will be reset to "Pending" for re-review</li>
                                                <li>You'll receive a new transaction ID</li>
                                            @else
                                                <li>Your application will be submitted for review</li>
                                                <li>You'll receive a confirmation with transaction ID</li>
                                            @endif
                                            <li>Our team will review within 2-3 business days</li>
                                            <li>You can send messages to our support team</li>
                                            <li>You can continue adding information later</li>
                                            <li>Updates will be sent via email and dashboard</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('user.page', 'progress') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-2"></i>Back to Progress
                                </a>
                                
                                <button type="submit" class="btn {{ $existingSubmission ? 'btn-warning' : 'btn-success' }} btn-lg" id="submit-btn">
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