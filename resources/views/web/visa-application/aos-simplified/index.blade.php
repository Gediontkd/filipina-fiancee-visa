@extends('web.layout.master')

@section('content')
<section class="visa-application ptb-80 bg-lightgrey">
    {{ getLanguage() }}
    <div class="container">
        <div class="row">
            <!-- Header -->
            <div class="col-md-6 section-title mb-0">
                <h3 class="fs-3 mb-0">Adjustment of Status Application (I-485)</h3>
            </div>
            <div class="col-md-6 text-start text-md-end">
                <a href="{{ route('user.page', 'progress') }}" class="btn btn-tra-primary">Back To Profile</a>
            </div>
            
            <!-- Instructions -->
            <div class="col-md-12 mt-3">
                <p class="jumbotron">
                    Complete all sections to submit your Adjustment of Status application. 
                    Your progress is automatically saved.
                </p>
            </div>

            <!-- Main Content -->
            <div class="col-lg-12 mt-4">
                <!-- Progress Bar -->
                <div class="card mb-3">
                    <div class="card-body p-3">
                        <h5 class="mb-3">Application Progress</h5>
                        <div class="progress" style="height: 30px;">
                            <div class="progress-bar progress-bar-striped {{ $completionPercentage >= 100 ? 'bg-success' : 'bg-info' }}" 
                                role="progressbar" 
                                style="width: {{ $completionPercentage }}%" 
                                aria-valuenow="{{ $completionPercentage }}" 
                                aria-valuemin="0" 
                                aria-valuemax="100"
                                id="progressBar">
                                <strong>{{ $completionPercentage }}%</strong>
                            </div>
                        </div>
                        
                        @if($completionPercentage >= 100)
                            <div class="alert alert-success mt-3 mb-0">
                                <i class="fa fa-check-circle me-2"></i>
                                <strong>Ready to Submit!</strong> You have completed all required sections.
                            </div>
                        @elseif($completionPercentage >= 50)
                            <div class="alert alert-info mt-3 mb-0">
                                <i class="fa fa-info-circle me-2"></i>
                                You're {{ $completionPercentage }}% complete. Keep going!
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Application Form -->
                <div class="card p-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-12 p-4">
                                <!-- Tab Navigation -->
                                <ul class="nav nav-tabs mb-4" id="aosTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" 
                                            id="applicant-tab" 
                                            data-bs-toggle="tab" 
                                            data-bs-target="#applicant" 
                                            type="button" 
                                            role="tab">
                                            <i class="fa fa-user me-2"></i>Applicant Information
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" 
                                            id="immigration-tab" 
                                            data-bs-toggle="tab" 
                                            data-bs-target="#immigration" 
                                            type="button" 
                                            role="tab">
                                            <i class="fa fa-passport me-2"></i>Immigration Status
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" 
                                            id="sponsor-tab" 
                                            data-bs-toggle="tab" 
                                            data-bs-target="#sponsor" 
                                            type="button" 
                                            role="tab">
                                            <i class="fa fa-users me-2"></i>Sponsor/Petitioner
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" 
                                            id="background-tab" 
                                            data-bs-toggle="tab" 
                                            data-bs-target="#background" 
                                            type="button" 
                                            role="tab">
                                            <i class="fa fa-clipboard-list me-2"></i>Background Questions
                                        </button>
                                    </li>
                                </ul>

                                <!-- Form -->
                                {{ Form::open(['id' => 'simplifiedAosForm', 'class' => 'needs-validation']) }}
                                    <!-- Tab Content -->
                                    <div class="tab-content" id="aosTabContent">
                                        <!-- Applicant Tab -->
                                        <div class="tab-pane fade show active" id="applicant" role="tabpanel">
                                            @include('web.visa-application.aos-simplified._applicant-tab')
                                        </div>

                                        <!-- Immigration Status Tab -->
                                        <div class="tab-pane fade" id="immigration" role="tabpanel">
                                            @include('web.visa-application.aos-simplified._immigration-tab')
                                        </div>

                                        <!-- Sponsor Tab -->
                                        <div class="tab-pane fade" id="sponsor" role="tabpanel">
                                            @include('web.visa-application.aos-simplified._sponsor-tab')
                                        </div>

                                        <!-- Background Tab -->
                                        <div class="tab-pane fade" id="background" role="tabpanel">
                                            @include('web.visa-application.aos-simplified._background-tab')
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="border-top pt-4 mt-4">
                                        <div class="d-flex justify-content-between flex-wrap gap-3">
                                            <div>
                                                {{ Form::button('<i class="fa fa-save me-2"></i>Save Progress', [
                                                    'class' => 'btn btn-primary',
                                                    'id' => 'saveBtn',
                                                    'type' => 'button',
                                                    'onclick' => 'saveApplication(false)'
                                                ]) }}
                                            </div>
                                            <div>
                                                <a href="{{ route('user.page', 'progress') }}" class="btn btn-outline-secondary me-2">
                                                    <i class="fa fa-times me-2"></i>Cancel
                                                </a>
                                                @if($completionPercentage >= 100)
                                                    <a href="{{ route('application.review') }}" class="btn btn-success">
                                                        <i class="fa fa-paper-plane me-2"></i>Review & Submit Application
                                                    </a>
                                                @else
                                                    <button type="button" 
                                                        class="btn btn-success" 
                                                        disabled 
                                                        title="Complete all sections ({{ $completionPercentage }}% done)">
                                                        <i class="fa fa-lock me-2"></i>Complete All Sections First
                                                    </button>
                                                    <small class="d-block text-muted mt-2">
                                                        {{ 100 - $completionPercentage }}% remaining
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customScript')
<script src="{{ asset('assets/js/date-range.js') }}"></script>
<script>
    function autoSave() {
        saveApplication(true);
    }

    setInterval(autoSave, 30000);

    function saveApplication(isAutoSave = false) {
        const btn = $('#saveBtn');
        const originalText = btn.html();
        
        if (!isAutoSave) {
            btn.html('<i class="fa fa-spinner fa-spin me-2"></i>Saving...').prop('disabled', true);
        }

        $.ajax({
            url: "{{ route('aos-simplified.store') }}",
            type: 'POST',
            data: $('#simplifiedAosForm').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status) {
                    $('#progressBar').css('width', response.completion + '%')
                        .attr('aria-valuenow', response.completion)
                        .html('<strong>' + response.completion + '%</strong>');
                    
                    if (!isAutoSave) {
                        toastr.success('Application saved successfully');
                        
                        if (response.completion >= 100) {
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        }
                    }
                } else {
                    if (!isAutoSave) {
                        toastr.error(response.message || 'Failed to save application');
                    }
                }
            },
            error: function(xhr) {
                if (!isAutoSave) {
                    const errors = xhr.responseJSON?.errors;
                    if (errors) {
                        $.each(errors, function(field, messages) {
                            toastr.error(messages[0]);
                        });
                    } else {
                        toastr.error('An error occurred while saving');
                    }
                }
            },
            complete: function() {
                if (!isAutoSave) {
                    btn.html(originalText).prop('disabled', false);
                }
            }
        });
    }

    $(document).on('change', '.country-select', function() {
        const countryId = $(this).val();
        const stateSelect = $(this).data('state-target');
        const selectedState = $(stateSelect).data('selected');

        if (countryId) {
            $.ajax({
                url: "{{ route('aos-simplified.get-states') }}",
                type: 'GET',
                data: {
                    country_id: countryId,
                    selected_state: selectedState
                },
                success: function(html) {
                    $(stateSelect).html(html);
                }
            });
        }
    });

    $(document).ready(function() {
        $('.country-select').each(function() {
            if ($(this).val()) {
                $(this).trigger('change');
            }
        });
    });

    $(document).on('change', '.does-not-apply-checkbox', function() {
        const targetField = $(this).data('target');
        
        if ($(this).is(':checked')) {
            $(targetField).val('N/A').prop('disabled', true);
        } else {
            $(targetField).val('').prop('disabled', false);
        }
    });

    $(document).ready(function() {
        $('.does-not-apply-checkbox:checked').each(function() {
            const targetField = $(this).data('target');
            $(targetField).val('N/A').prop('disabled', true);
        });
    });
</script>
@endsection