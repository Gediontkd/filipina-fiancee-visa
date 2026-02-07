@extends('web.layout.master')

@section('customStyle')
<style>
    .aos-action-btn {
        min-width: 160px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    @media (max-width: 768px) {
        .aos-action-btn {
            min-width: auto;
            padding: 0.4rem 1rem;
            font-size: 0.85rem;
        }
    }
    .nav-tabs-wrapper {
        border-bottom: 1px solid #dee2e6;
        margin-bottom: 1.5rem;
    }
    .nav-tabs-wrapper .nav-tabs {
        border-bottom: none;
    }
    .btn-cancel-custom {
        background-color: #dc3545 !important;
        color: #fff !important;
        border: none !important;
    }
    .btn-cancel-custom:hover {
        background-color: #8b4513 !important; /* Brownish */
        color: #fff !important;
    }
</style>
@endsection

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
                        
                        <div id="completionAlertContainer">
                            @if($completionPercentage >= 100)
                                <div class="alert alert-success mt-3 mb-0">
                                    <i class="fa fa-check-circle me-2"></i>
                                    <strong>Ready to Submit!</strong> You have completed all required sections.
                                </div>
                            @elseif($completionPercentage >= 50)
                                <div class="alert alert-info mt-3 mb-0">
                                    <i class="fa fa-info-circle me-2"></i>
                                    You're <span class="completion-value">{{ $completionPercentage }}</span>% complete. Keep going!
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Application Form -->
                <div class="card p-0">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-12 p-4">
                                <!-- Tab Navigation -->
                                <div class="nav-tabs-wrapper overflow-auto">
                                    <ul class="nav nav-tabs mb-4 flex-nowrap" id="aosTabs" role="tablist" style="min-width: max-content;">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="applicant-tab" data-bs-toggle="tab" data-bs-target="#applicant" type="button" role="tab">
                                            <i class="fa fa-user me-2"></i>1. Personal & Biographics
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="basis-tab" data-bs-toggle="tab" data-bs-target="#basis" type="button" role="tab">
                                            <i class="fa fa-list-check me-2"></i>2. Eligibility Basis
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="history-tab" data-bs-toggle="tab" data-bs-target="#history" type="button" role="tab">
                                            <i class="fa fa-history me-2"></i>3. Address & Employment
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="family-tab" data-bs-toggle="tab" data-bs-target="#family" type="button" role="tab">
                                            <i class="fa fa-users me-2"></i>4. Family Information
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="immigration-tab" data-bs-toggle="tab" data-bs-target="#immigration" type="button" role="tab">
                                            <i class="fa fa-passport me-2"></i>5. Immigration Status
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="sponsor-tab" data-bs-toggle="tab" data-bs-target="#sponsor" type="button" role="tab">
                                            <i class="fa fa-hand-holding-heart me-2"></i>6. Sponsor Info
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="background-tab" data-bs-toggle="tab" data-bs-target="#background" type="button" role="tab">
                                            <i class="fa fa-shield-alt me-2"></i>7. Eligibility
                                        </button>
                                    </li>
                                    </ul>
                                </div>

                                <!-- Form -->
                                {{ Form::open(['id' => 'simplifiedAosForm', 'class' => 'needs-validation']) }}
                                    {{ Form::hidden('submitted_app_id', $application ? $application->submitted_app_id : request()->submitted_app_id) }}
                                    <!-- Tab Content -->
                                    <div class="tab-content" id="aosTabContent">
                                        <!-- Tab 1: Applicant Personal & Biographics (Part 1, 7) -->
                                        <div class="tab-pane fade show active" id="applicant" role="tabpanel">
                                            @include('web.visa-application.aos-simplified._applicant-tab')
                                        </div>

                                        <!-- Tab 2: Eligibility Basis (Part 2) -->
                                        <div class="tab-pane fade" id="basis" role="tabpanel">
                                            @include('web.visa-application.aos-simplified._basis-tab')
                                        </div>

                                        <!-- Tab 3: History (Part 3) -->
                                        <div class="tab-pane fade" id="history" role="tabpanel">
                                            @include('web.visa-application.aos-simplified._history-tab')
                                        </div>

                                        <!-- Tab 4: Family (Part 4, 5, 6) -->
                                        <div class="tab-pane fade" id="family" role="tabpanel">
                                            @include('web.visa-application.aos-simplified._family-tab')
                                        </div>

                                        <!-- Tab 5: Immigration Status (Part 1) -->
                                        <div class="tab-pane fade" id="immigration" role="tabpanel">
                                            @include('web.visa-application.aos-simplified._immigration-tab')
                                        </div>

                                        <!-- Tab 6: Sponsor Info -->
                                        <div class="tab-pane fade" id="sponsor" role="tabpanel">
                                            @include('web.visa-application.aos-simplified._sponsor-tab')
                                        </div>

                                        <!-- Tab 7: Eligibility (Part 8-12) -->
                                        <div class="tab-pane fade" id="background" role="tabpanel">
                                            @include('web.visa-application.aos-simplified._background-tab')
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="border-top pt-4 mt-4">
                                        <div class="d-flex justify-content-between flex-wrap gap-3">
                                            <div>
                                                {{ Form::button('<i class="fa fa-save me-2"></i>Save Progress', [
                                                    'class' => 'btn btn-primary aos-action-btn',
                                                    'id' => 'saveBtn',
                                                    'type' => 'button',
                                                    'onclick' => 'saveApplication(false)'
                                                ]) }}
                                            </div>
                                            <div class="d-flex flex-wrap gap-2" id="submit-action-container">
                                                <a href="{{ route('user.page', 'progress') }}" class="btn btn-cancel-custom aos-action-btn">
                                                    <i class="fa fa-times me-2"></i>Cancel
                                                </a>
                                                @if($completionPercentage >= 100)
                                                    <a href="{{ route('application.review') }}" class="btn btn-success aos-action-btn">
                                                        <i class="fa fa-paper-plane me-2"></i>Review & Submit
                                                    </a>
                                                @else
                                                    <button type="button" 
                                                        class="btn btn-success aos-action-btn" 
                                                        disabled 
                                                        title="Complete all sections ({{ $completionPercentage }}% done)">
                                                        <i class="fa fa-lock me-2"></i>Submit
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                        @if($completionPercentage < 100)
                                            <div class="text-end mt-2">
                                                <small class="text-muted" id="remainingText">
                                                    {{ 100 - $completionPercentage }}% remaining
                                                </small>
                                            </div>
                                        @endif
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

    function saveApplication(isAutoSave = false, callback = null, triggerBtn = null) {
        const btn = triggerBtn || $('#saveBtn');
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
                    
                    // Update remaining text
                    $('#remainingText').html((100 - response.completion) + '% remaining');

                    // Update dynamic alert text
                    if (response.completion >= 100) {
                        $('#completionAlertContainer').html(`
                            <div class="alert alert-success mt-3 mb-0">
                                <i class="fa fa-check-circle me-2"></i>
                                <strong>Ready to Submit!</strong> You have completed all required sections.
                            </div>
                        `);
                    } else if (response.completion >= 50) {
                        $('#completionAlertContainer').html(`
                            <div class="alert alert-info mt-3 mb-0">
                                <i class="fa fa-info-circle me-2"></i>
                                You're <span class="completion-value">${response.completion}</span>% complete. Keep going!
                            </div>
                        `);
                    } else {
                        $('#completionAlertContainer').empty();
                    }
                    
                    if (response.completion >= 100) {
                        $('#submit-action-container').html(`
                            <a href="{{ route('user.page', 'progress') }}" class="btn btn-cancel-custom aos-action-btn">
                                <i class="fa fa-times me-2"></i>Cancel
                            </a>
                            <a href="{{ route('application.review') }}" class="btn btn-success aos-action-btn">
                                <i class="fa fa-paper-plane me-2"></i>Review & Submit
                            </a>
                        `);
                    }
                    
                    if (!isAutoSave) {
                        toastr.success('Application saved successfully');
                        
                        if (callback && typeof callback === 'function') {
                            callback();
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

    /**
     * Scroll to top of form when switching tabs or clicking "Next"
     */
    $(document).on('shown.bs.tab', function (e) {
        $('html, body').animate({
            scrollTop: $(".visa-application").offset().top - 20
        }, 500);
    });

    $(document).ready(function() {
        // Handle "Other Names" raw text to hidden JSON sync
        $(document).on('input', 'textarea[name="applicant_other_names_raw"]', function() {
            const names = $(this).val().split("\n").filter(n => n.trim() !== "");
            $('input[name="applicant_other_names_json"]').val(JSON.stringify(names));
        });

        // Add history/family items
        $(document).on('click', '.add-history-item, .add-family-item', function() {
            const type = $(this).data('type');
            let container, itemHtml, index;

            if (type === 'address') {
                container = $('#address-history-container');
                index = container.find('.address-item').length;
                itemHtml = `
                    <div class="address-item border p-3 mb-3 rounded bg-light shadow-sm">
                        <div class="d-flex justify-content-between mb-2">
                            <h6>Address #${index + 1}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-history-item"><i class="fa fa-trash"></i></button>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-2"><input type="text" name="applicant_address_history[${index}][street]" class="form-control" placeholder="Street Address"></div>
                            <div class="col-md-4 mb-2"><input type="text" name="applicant_address_history[${index}][city]" class="form-control" placeholder="City"></div>
                            <div class="col-md-4 mb-2"><input type="text" name="applicant_address_history[${index}][state]" class="form-control" placeholder="State/Province"></div>
                            <div class="col-md-4 mb-2"><input type="text" name="applicant_address_history[${index}][zip]" class="form-control" placeholder="ZIP Code"></div>
                            <div class="col-md-6"><label class="small">Date From</label><input type="text" name="applicant_address_history[${index}][date_from]" class="form-control datePicker" placeholder="MM/DD/YYYY"></div>
                            <div class="col-md-6"><label class="small">Date To</label><input type="text" name="applicant_address_history[${index}][date_to]" class="form-control datePicker" placeholder="MM/DD/YYYY"></div>
                        </div>
                    </div>`;
            } else if (type === 'employment') {
                container = $('#employment-history-container');
                index = container.find('.employment-item').length;
                itemHtml = `
                    <div class="employment-item border p-3 mb-3 rounded bg-light shadow-sm">
                        <div class="d-flex justify-content-between mb-2">
                            <h6>Employer #${index + 1}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-history-item"><i class="fa fa-trash"></i></button>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2"><input type="text" name="applicant_employment_history[${index}][employer]" class="form-control" placeholder="Employer Name"></div>
                            <div class="col-md-6 mb-2"><input type="text" name="applicant_employment_history[${index}][occupation]" class="form-control" placeholder="Occupation"></div>
                            <div class="col-md-12 mb-2"><input type="text" name="applicant_employment_history[${index}][address]" class="form-control" placeholder="Employer Address"></div>
                            <div class="col-md-6"><label class="small">Date From</label><input type="text" name="applicant_employment_history[${index}][date_from]" class="form-control datePicker" placeholder="MM/DD/YYYY"></div>
                            <div class="col-md-6"><label class="small">Date To</label><input type="text" name="applicant_employment_history[${index}][date_to]" class="form-control datePicker" placeholder="MM/DD/YYYY"></div>
                        </div>
                    </div>`;
            } else if (type === 'child') {
                container = $('#children-items');
                index = container.find('.child-item').length;
                itemHtml = `
                    <div class="child-item border p-3 mb-3 rounded bg-light shadow-sm">
                        <div class="d-flex justify-content-between mb-2">
                            <h6>Child #${index + 1}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-family-item"><i class="fa fa-trash"></i></button>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2"><label class="small">Full Name</label><input type="text" name="children_data[${index}][name]" class="form-control"></div>
                            <div class="col-md-6 mb-2"><label class="small">Date of Birth</label><input type="text" name="children_data[${index}][dob]" class="form-control datePicker"></div>
                            <div class="col-md-12"><label class="small">A-Number (if any)</label><input type="text" name="children_data[${index}][a_number]" class="form-control"></div>
                        </div>
                    </div>`;
            }

            if (container) {
                container.append(itemHtml);
                initNewDatePickers();
                $(this).prev('p.text-muted').remove(); // Remove "No history added yet" message
            }
        });

        $(document).on('click', '.remove-history-item, .remove-family-item', function() {
            var container = $(this).closest('.address-history-container, .employment-history-container, #children-items');
            $(this).closest('.address-item, .employment-item, .child-item').fadeOut(300, function() {
                $(this).remove();
            });
        });

        function initNewDatePickers() {
            if ($.fn.datepicker) {
                $('.datePicker').datepicker({
                    format: 'mm/dd/yyyy',
                    autoclose: true,
                    todayHighlight: true
                });
            }
        }
    });

    // Handle internal "Next" buttons with save
    $('.next-step').on('click', function() {
        const nextTabId = $(this).data('next-tab');
        const currentBtn = $(this);
        
        saveApplication(false, function() {
            $('#' + nextTabId).tab('show');
        }, currentBtn);
    });
</script>
@endsection