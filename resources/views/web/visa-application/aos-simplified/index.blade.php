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
    .btn-cancel-custom {
        background-color: #dc3545 !important;
        color: #fff !important;
        border: none !important;
    }
    .btn-cancel-custom:hover {
        background-color: #8b4513 !important; /* Brownish */
        color: #fff !important;
    }
    .visa-application label, 
    .visa-application h5 {
        font-weight: 400 !important;
    }
    /* Sidebar navigation styles */
    .aos-step-nav a {
        color: inherit;
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
    }
    .aos-step-nav a:hover {
        text-decoration: none !important;
    }
</style>
@endsection

@section('content')
<section class="mypetition myaccount visa-application ptb-80 bg-lightgrey">
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
                            <!-- Sidebar Navigation -->
                            <div class="col-md-4 col-lg-3 br-r-1 pe-0">
                                <ul id="progressbar" class="progessbar2 mb-0">
                                @php
                                    $tabIcons = [
                                        'personal' => 'fa-user',
                                        'filing-category' => 'fa-file-alt',
                                        'exemption' => 'fa-shield-alt',
                                        'address-employment' => 'fa-home',
                                        'family' => 'fa-users',
                                        'sponsor' => 'fa-ring',
                                        'children' => 'fa-child',
                                        'eligibility' => 'fa-id-card',
                                        'additional' => 'fa-info-circle',
                                        'contact' => 'fa-phone',
                                    ];
                                    $tabLabels = [
                                        'personal' => 'Personal & Biographics',
                                        'filing-category' => 'Application Type or Filing Category',
                                        'exemption' => 'Affidavit of Support Exemption',
                                        'address-employment' => 'History & Additional Info',
                                        'family' => 'Family Information',
                                        'sponsor' => 'Marital History',
                                        'children' => 'Information About Your Children',
                                        'eligibility' => 'Biographic Information',
                                        'additional' => 'General Eligibility and Inadmissibility Grounds',
                                        'contact' => 'Applicant\'s Contact Information',
                                    ];
                                @endphp
                                @foreach($steps as $slug => $tabId)
                                    <li class="aos-step-nav {{ $currentStep === $slug ? 'active' : '' }}" 
                                        data-step="{{ $slug }}">
                                        <a href="{{ route('aos-simplified.index', ['step' => $slug]) }}" class="text-decoration-none">
                                            <span><i class="fa {{ $tabIcons[$slug] }}"></i></span>
                                            <strong>{{ $tabLabels[$slug] }}</strong>
                                        </a>
                                    </li>
                                @endforeach
                                </ul>
                            </div>
                            
                            <!-- Form Content -->
                            <div class="col-md-8 col-lg-9">
                                <div class="p-4 p-md-5">
                                    <!-- Form -->
                                    {{ Form::open(['id' => 'simplifiedAosForm', 'class' => 'needs-validation']) }}
                                    {{ Form::hidden('submitted_app_id', $application ? $application->submitted_app_id : request()->submitted_app_id) }}
                                    <!-- Tab Content -->
                                    <div class="tab-content px-1" id="aosTabContent">
                                        <div class="tab-pane fade show active">
                                            @include('web.visa-application.aos-simplified._' . $activeTab . '-tab')
                                        </div>
                                    </div>

                                    <!-- Form Actions -->
                                    <div class="border-top pt-4 mt-4">
                                        @php
                                            $stepKeys = array_keys($steps);
                                            $currentIdx = array_search($currentStep, $stepKeys);
                                            $prevStep = $currentIdx > 0 ? $stepKeys[$currentIdx - 1] : null;
                                            $nextStep = $currentIdx < count($stepKeys) - 1 ? $stepKeys[$currentIdx + 1] : null;
                                        @endphp
                                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                            <!-- Left side: Previous -->
                                            <div class="order-1">
                                                @if($prevStep)
                                                    <a href="{{ route('aos-simplified.index', ['step' => $prevStep]) }}" class="btn btn-outline-primary aos-action-btn">
                                                        <i class="fa fa-arrow-left me-2"></i>Previous
                                                    </a>
                                                @else
                                                    <div class="d-none d-md-block" style="min-width: 160px;"></div>
                                                @endif
                                            </div>

                                            <!-- Middle: Save & Cancel -->
                                            <div class="d-flex gap-2 order-3 order-md-2 mx-auto">
                                                {{ Form::button('<i class="fa fa-save me-2"></i>Save Progress', [
                                                    'class' => 'btn btn-primary aos-action-btn',
                                                    'id' => 'saveBtn',
                                                    'type' => 'button',
                                                    'onclick' => 'saveApplication(false)'
                                                ]) }}
                                                
                                                <a href="{{ route('user.page', 'progress') }}" class="btn btn-cancel-custom aos-action-btn">
                                                    <i class="fa fa-times me-2"></i>Cancel
                                                </a>
                                            </div>

                                            <!-- Right side: Next or Submit -->
                                            <div class="order-2 order-md-3">
                                                @if($nextStep)
                                                    <button type="button" class="btn btn-success aos-action-btn" onclick="saveAndContinue('{{ $nextStep }}')">
                                                        Next <i class="fa fa-arrow-right ms-2"></i>
                                                    </button>
                                                @else
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
                                                @endif
                                            </div>
                                        </div>

                                        @if($completionPercentage < 100)
                                            <div class="text-center text-md-end mt-3">
                                                <small class="text-muted" id="remainingText">
                                                    {{ 100 - $completionPercentage }}% remaining
                                                </small>
                                            </div>
                                        @endif
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

    function saveAndContinue(nextStep) {
        saveApplication(false, null, null, nextStep);
    }

    function saveApplication(isAutoSave = false, callback = null, triggerBtn = null, nextStep = null) {
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
                    
                    if (!isAutoSave) {
                        toastr.success('Application saved successfully');
                        
                        if (nextStep) {
                            window.location.href = "{{ route('aos-simplified.index') }}/" + nextStep;
                            return;
                        }

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
        // Add history/family/other-name items
        $(document).on('click', '.add-history-item, .add-family-item, .add-other-name', function() {
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
                            <div class="col-md-6 mb-2">
                                <label class="small">In Care Of Name (if any)</label>
                                <input type="text" name="applicant_address_history[${index}][in_care_of]" class="form-control" placeholder="In Care Of">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="small">Street Number and Name</label>
                                <input type="text" name="applicant_address_history[${index}][street]" class="form-control" placeholder="Street Address">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">Unit Type</label>
                                <select name="applicant_address_history[${index}][unit_type]" class="form-control">
                                    <option value="">-Select-</option>
                                    <option value="Apt">Apt.</option>
                                    <option value="Ste">Ste.</option>
                                    <option value="Flr">Flr.</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">Unit Number</label>
                                <input type="text" name="applicant_address_history[${index}][unit_number]" class="form-control" placeholder="Number">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">City or Town</label>
                                <input type="text" name="applicant_address_history[${index}][city]" class="form-control" placeholder="City">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">State (U.S. Only)</label>
                                <input type="text" name="applicant_address_history[${index}][state]" class="form-control" placeholder="State">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">ZIP Code (U.S. Only)</label>
                                <input type="text" name="applicant_address_history[${index}][zip]" class="form-control" placeholder="ZIP">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">Province (Foreign Only)</label>
                                <input type="text" name="applicant_address_history[${index}][province]" class="form-control" placeholder="Province">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small">Postal Code (Foreign Only)</label>
                                <input type="text" name="applicant_address_history[${index}][postal_code]" class="form-control" placeholder="Postal Code">
                            </div>
                            <div class="col-md-8 mb-3">
                                <label class="small">Country</label>
                                <input type="text" name="applicant_address_history[${index}][country]" class="form-control" placeholder="Country">
                            </div>
                            <div class="col-md-6">
                                <label class="small">Date From</label>
                                <input type="text" name="applicant_address_history[${index}][date_from]" class="form-control datePicker" placeholder="MM/DD/YYYY">
                            </div>
                            <div class="col-md-6">
                                <label class="small">Date To</label>
                                <input type="text" name="applicant_address_history[${index}][date_to]" class="form-control datePicker" placeholder="MM/DD/YYYY">
                            </div>
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
            } else if (type === 'prior-marriage') {
                container = $('#prior-marriages-container');
                index = container.find('.prior-marriage-item').length;
                itemHtml = `
                    <div class="prior-marriage-item border p-3 mb-3 rounded bg-light shadow-sm">
                        <div class="d-flex justify-content-between mb-2">
                            <h6>Prior Spouse #${index + 1}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-family-item"><i class="fa fa-trash"></i></button>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="small">Legal Name (First and Last)</label>
                                <input type="text" name="marital_history[${index}][spouse_name]" class="form-control">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="small">Date of Marriage</label>
                                <input type="text" name="marital_history[${index}][marriage_date]" class="form-control datePicker">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="small">Date Marriage Legally Ended</label>
                                <input type="text" name="marital_history[${index}][end_date]" class="form-control datePicker">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="small">Place Marriage Legally Ended (City, State/Country)</label>
                                <input type="text" name="marital_history[${index}][end_place]" class="form-control">
                            </div>
                        </div>
                    </div>`;
            } else if (type === 'other-name') {
                container = $('#other-names-container');
                index = container.find('.other-name-item').length;
                itemHtml = `
                    <div class="other-name-item border p-3 mb-3 rounded bg-light shadow-sm">
                        <div class="d-flex justify-content-between mb-2">
                            <h6>Other Name #${index + 1}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-other-name"><i class="fa fa-trash"></i></button>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-2"><label class="small">Family Name (Last Name)</label><input type="text" name="applicant_other_names[${index}][family_name]" class="form-control" placeholder="Last Name"></div>
                            <div class="col-md-4 mb-2"><label class="small">Given Name (First Name)</label><input type="text" name="applicant_other_names[${index}][given_name]" class="form-control" placeholder="First Name"></div>
                            <div class="col-md-4 mb-2"><label class="small">Middle Name</label><input type="text" name="applicant_other_names[${index}][middle_name]" class="form-control" placeholder="Middle Name (if any)"></div>
                        </div>
                    </div>`;
            }

            if (container) {
                container.append(itemHtml);
                initNewDatePickers();
                $(this).prev('p.text-muted').remove(); // Remove "No history added yet" message
            }
        });

        $(document).on('click', '.remove-history-item, .remove-family-item, .remove-other-name', function() {
            var container = $(this).closest('.address-history-container, .employment-history-container, #children-items, #other-names-container');
            $(this).closest('.address-item, .employment-item, .child-item, .other-name-item').fadeOut(300, function() {
                $(this).remove();
            });
        });

        // A-Number conditional display
        $(document).on('change', 'input[name="has_a_number"]', function() {
            if ($(this).val() == '1' && $(this).is(':checked')) {
                $('#a-number-field').slideDown(300);
            } else if ($(this).val() == '0' && $(this).is(':checked')) {
                $('#a-number-field').slideUp(300);
                $('#a-number-field input').val('');
            }
        });

        $(document).on('change', 'input[name="has_other_a_numbers"]', function() {
            if ($(this).val() == '1' && $(this).is(':checked')) {
                $('#other-a-numbers-section').slideDown(300);
            } else if ($(this).val() == '0' && $(this).is(':checked')) {
                $('#other-a-numbers-section').slideUp(300);
                $('#other-a-numbers-container input').val('');
            }
        });

        // Add other A-Number
        $(document).on('click', '.add-other-a-number', function() {
            const container = $('#other-a-numbers-container');
            const newItem = `
                <div class="other-a-number-item mb-2">
                    <div class="d-flex gap-2 align-items-center">
                        <input type="text" name="other_a_numbers[]" class="form-control" placeholder="A-1234567" maxlength="10">
                        <button type="button" class="btn btn-sm btn-outline-danger remove-other-a-number"><i class="fa fa-trash"></i></button>
                    </div>
                </div>`;
            container.append(newItem);
        });

        // Remove other A-Number
        $(document).on('click', '.remove-other-a-number', function() {
            $(this).closest('.other-a-number-item').fadeOut(300, function() {
                $(this).remove();
            });
        });

        // Immigration Entry Type conditional display
        $(document).on('change', 'input[name="immigration_entry_type"]', function() {
            // Hide all status containers first
            $('#admitted_status_container, #paroled_status_container, #other_status_container').slideUp(300);
            
            if ($(this).val() === 'admitted' && $(this).is(':checked')) {
                $('#admitted_status_container').slideDown(300);
            } else if ($(this).val() === 'paroled' && $(this).is(':checked')) {
                $('#paroled_status_container').slideDown(300);
            } else if ($(this).val() === 'other' && $(this).is(':checked')) {
                $('#other_status_container').slideDown(300);
            }
        });

        // Date of Birth conditional display
        $(document).on('change', 'input[name="has_other_dob"]', function() {
            if ($(this).val() == '1' && $(this).is(':checked')) {
                $('#other_dob_field').slideDown(300);
            } else if ($(this).val() == '0' && $(this).is(':checked')) {
                $('#other_dob_field').slideUp(300);
                $('#other_dob_field input').val('');
            }
        });

        // Residency Check Logic
        $(document).on('change', 'input[name="resided_at_current_address_5_years"]', function() {
            if ($(this).val() == '0') {
                $('#prior_addresses_container').slideDown(300).removeClass('d-none');
            } else {
                $('#prior_addresses_container').slideUp(300);
            }
        });

        // Other Names Toggle Logic
        $(document).on('change', 'input[name="has_other_names"]', function() {
            if ($(this).val() == '1') {
                $('#other-names-section').slideDown(300);
            } else {
                $('#other-names-section').slideUp(300);
            }
        });

        // Add prior address
        $(document).on('click', '#add-prior-address', function() {
            const container = $('#prior-address-items');
            const index = container.find('.prior-address-item').length;
            const newItem = `
                <div class="prior-address-item border p-3 mb-3 bg-white rounded shadow-sm" style="display:none">
                    <div class="d-flex justify-content-between mb-2">
                        <h6>Prior Address #${index + 1}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-prior-address"><i class="fa fa-trash"></i></button>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="small">Street Number and Name</label>
                            <input type="text" name="prior_addresses_data[${index}][street]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="small">City or Town</label>
                            <input type="text" name="prior_addresses_data[${index}][city]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="small">State</label>
                            <input type="text" name="prior_addresses_data[${index}][state]" class="form-control">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="small">ZIP Code</label>
                            <input type="text" name="prior_addresses_data[${index}][zip]" class="form-control">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="small">Date From (mm/dd/yyyy)</label>
                            <input type="text" name="prior_addresses_data[${index}][date_from]" class="form-control datePicker">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="small">Date To (mm/dd/yyyy)</label>
                            <input type="text" name="prior_addresses_data[${index}][date_to]" class="form-control datePicker">
                        </div>
                    </div>
                </div>`;
            container.append(newItem);
            container.find('.prior-address-item').last().fadeIn(300);
            initNewDatePickers();
        });

        // Remove prior address
        $(document).on('click', '.remove-prior-address', function() {
            $(this).closest('.prior-address-item').fadeOut(300, function() {
                $(this).remove();
                // Re-index remaining items
                $('#prior-address-items .prior-address-item').each(function(idx) {
                    $(this).find('h6').first().text('Prior Address #' + (idx + 1));
                    $(this).find('input').each(function() {
                        let name = $(this).attr('name');
                        if (name) {
                            $(this).attr('name', name.replace(/\[\d+\]/, '[' + idx + ']'));
                        }
                    });
                });
            });
        });

        // SSA Logic
        $(document).on('change', 'input[name="ssa_ever_issued_card"]', function() {
            if ($(this).val() == '1') {
                $('#ssn_field_container').show();
            } else {
                $('#ssn_field_container').hide();
            }
        });

        $(document).on('change', 'input[name="ssa_issue_card_request"]', function() {
            if ($(this).val() == '1') {
                $('#ssa_consent_container').show();
            } else {
                $('#ssa_consent_container').hide();
            }
        });

        $(document).on('change', '#use_mailing_address_toggle', function() {
            if ($(this).is(':checked')) {
                $('#mailing_address_fields').removeClass('d-none');
            } else {
                $('#mailing_address_fields').addClass('d-none');
            }
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