{{-- FILE: resources/views/web/visa-application/spouse-visa-simplified/_relationship-tab.blade.php --}}
{{-- FIXED: Removed all non-I-130 fields, kept only marriage details + previous marriages --}}

<div class="relationship-section">
    {{-- Include city auto-fill script --}}
    @push('scripts')
    <script src="{{ asset('assets/js/city-auto-fill.js') }}"></script>
    @endpush
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-heart me-2 text-primary"></i>Relationship Information
    </h4>
    <p class="text-muted mb-4">Provide details about your marriage</p>

    <!-- Marriage Information (I-130 Part 2, Items 17-20) -->
    <h5 class="mb-3"><i class="fa fa-ring me-2"></i>Marriage Details</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marriage_date', 'Date of Marriage') }}
                <span class="text-danger">*</span>
                {{ Form::text('marriage_date', optional($application)->marriage_date ? optional($application)->marriage_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_times_married', 'How many times have you been married?') }}
                <span class="text-danger">*</span>
                {{ Form::number('sponsor_times_married', optional($application)->sponsor_times_married ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Number of times',
                    'required' => true,
                    'min' => 1
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marriage_location_city', 'City of Marriage') }}
                <span class="text-danger">*</span>
                {{ Form::text('marriage_location_city', optional($application)->marriage_location_city ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'City where married',
                    'required' => true,
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marriage_location_state', 'State (if married in USA)') }}
                {{ Form::text('marriage_location_state', optional($application)->marriage_location_state ?? '', [
                    'class' => 'form-control state-format',
                    'placeholder' => 'Two-letter code (e.g., CA)',
                    'maxlength' => 2,
                    'pattern' => '[A-Z]{2}',
                    'style' => 'text-transform: uppercase;'
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marriage_location_province', 'Province (if applicable)') }}
                {{ Form::text('marriage_location_province', optional($application)->marriage_location_province ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Province/Region',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marriage_location_country', 'Country of Marriage') }}
                <span class="text-danger">*</span>
                {{ Form::select('marriage_location_country', getAllCountry(), optional($application)->marriage_location_country ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <!-- Previous Marriages (I-130 Part 2, Items 21-24) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-history me-2"></i>Previous Marriages</h5>
    
    <!-- Sponsor Previous Marriages -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>Has the sponsor been previously married?</label>
                <span class="text-danger">*</span>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        {{ Form::radio('sponsor_previous_marriages', 'yes', 
                            (optional($application)->sponsor_previous_marriages ?? '') === 'yes', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_prev_yes',
                            'required' => true
                        ]) }}
                        <label class="form-check-label" for="sponsor_prev_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('sponsor_previous_marriages', 'no', 
                            (optional($application)->sponsor_previous_marriages ?? '') === 'no', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_prev_no',
                            'required' => true
                        ]) }}
                        <label class="form-check-label" for="sponsor_prev_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="sponsor_divorce_section" 
        style="display: {{ (optional($application)->sponsor_previous_marriages ?? '') === 'yes' ? 'block' : 'none' }};">
        <div class="col-md-12">
            <div class="alert alert-info">
                <i class="fa fa-info-circle me-2"></i>
                <strong>Note:</strong> If you were previously married, provide details about your most recent prior marriage.
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_prev_spouse_first_name', 'Previous Spouse First Name') }}
                {{ Form::text('sponsor_prev_spouse_first_name', optional($application)->sponsor_prev_spouse_first_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'First name',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_prev_spouse_last_name', 'Previous Spouse Last Name') }}
                {{ Form::text('sponsor_prev_spouse_last_name', optional($application)->sponsor_prev_spouse_last_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Last name',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_divorce_date', 'Date Previous Marriage Ended') }}
                {{ Form::text('sponsor_divorce_date', optional($application)->sponsor_divorce_date ? optional($application)->sponsor_divorce_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
            </div>
        </div>
    </div>

    <!-- Beneficiary Previous Marriages -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>Has the beneficiary been previously married?</label>
                <span class="text-danger">*</span>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        {{ Form::radio('beneficiary_previous_marriages', 'yes', 
                            (optional($application)->beneficiary_previous_marriages ?? '') === 'yes', [
                            'class' => 'form-check-input',
                            'id' => 'beneficiary_prev_yes',
                            'required' => true
                        ]) }}
                        <label class="form-check-label" for="beneficiary_prev_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('beneficiary_previous_marriages', 'no', 
                            (optional($application)->beneficiary_previous_marriages ?? '') === 'no', [
                            'class' => 'form-check-input',
                            'id' => 'beneficiary_prev_no',
                            'required' => true
                        ]) }}
                        <label class="form-check-label" for="beneficiary_prev_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Last Address Where Sponsor and Beneficiary Lived Together (I-130 Part 4, Items 59-60) -->
<h5 class="mb-3 mt-4"><i class="fa fa-map-marker-alt me-2"></i>Last Address Where You Physically Lived Together</h5>
<div class="alert alert-info">
    <i class="fa fa-info-circle me-2"></i>
    <strong>Note:</strong> Provide the last physical address where you and your spouse lived together. If you have never lived together, check the box below.
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group mb-3">
            <div class="form-check">
                {{ Form::checkbox('never_lived_together', 1, 
                    optional($application)->never_lived_together ?? false, [
                    'class' => 'form-check-input',
                    'id' => 'never_lived_together'
                ]) }}
                <label class="form-check-label" for="never_lived_together">
                    <strong>We have never lived together</strong>
                </label>
            </div>
        </div>
    </div>
</div>

<div id="lived_together_section" 
    style="display: {{ optional($application)->never_lived_together ? 'none' : 'block' }};">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-3">
                {{ Form::label('last_lived_together_address', 'Street Address') }}
                {{ Form::text('last_lived_together_address', optional($application)->last_lived_together_address ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Street address',
                    'maxlength' => 100
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            @include('components.apt-suite-floor', [
                'name' => 'last_lived_together_apt',
                'value' => optional($application)->last_lived_together_apt,
                'required' => false
            ])
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('last_lived_together_city', 'City or Town') }}
                {{ Form::text('last_lived_together_city', optional($application)->last_lived_together_city ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'City',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('last_lived_together_state', 'State (if in USA)') }}
                {{ Form::text('last_lived_together_state', optional($application)->last_lived_together_state ?? '', [
                    'class' => 'form-control state-format',
                    'placeholder' => 'CA',
                    'maxlength' => 2,
                    'style' => 'text-transform: uppercase;'
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('last_lived_together_province', 'Province (if applicable)') }}
                {{ Form::text('last_lived_together_province', optional($application)->last_lived_together_province ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Province',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('last_lived_together_postal', 'Postal Code') }}
                {{ Form::text('last_lived_together_postal', optional($application)->last_lived_together_postal ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Postal code',
                    'maxlength' => 20
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('last_lived_together_country', 'Country') }}
                {{ Form::select('last_lived_together_country', getAllCountry(), optional($application)->last_lived_together_country ?? '', [
                    'class' => 'form-control'
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('last_lived_together_date_from', 'Date From') }}
                {{ Form::text('last_lived_together_date_from', optional($application)->last_lived_together_date_from ? optional($application)->last_lived_together_date_from->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('last_lived_together_date_to', 'Date To') }}
                {{ Form::text('last_lived_together_date_to', optional($application)->last_lived_together_date_to ? optional($application)->last_lived_together_date_to->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
            </div>
        </div>
    </div>
</div>

<!-- Application Location (I-130 Part 5, Items 61-62) -->
<h5 class="mb-3 mt-4"><i class="fa fa-building me-2"></i>Where Will Beneficiary Apply?</h5>
<div class="row">
    <div class="col-md-12">
        <div class="form-group mb-3">
            <label>Where will the beneficiary apply for an immigrant visa or adjustment of status?</label>
            <span class="text-danger">*</span>
            <div class="d-flex flex-column gap-2">
                <div class="form-check">
                    {{ Form::radio('beneficiary_application_location', 'us_adjustment', 
                        (optional($application)->beneficiary_application_location ?? '') === 'us_adjustment', [
                        'class' => 'form-check-input',
                        'id' => 'app_location_us',
                        'required' => true
                    ]) }}
                    <label class="form-check-label" for="app_location_us">
                        <strong>In the United States</strong> - Beneficiary will apply for adjustment of status at a USCIS office
                    </label>
                </div>
                <div class="form-check">
                    {{ Form::radio('beneficiary_application_location', 'abroad_consulate', 
                        (optional($application)->beneficiary_application_location ?? '') === 'abroad_consulate', [
                        'class' => 'form-check-input',
                        'id' => 'app_location_abroad'
                    ]) }}
                    <label class="form-check-label" for="app_location_abroad">
                        <strong>At a U.S. Embassy or Consulate Abroad</strong> - Beneficiary will apply for an immigrant visa
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- US Adjustment Location -->
<div id="us_adjustment_section" 
    style="display: {{ (optional($application)->beneficiary_application_location ?? '') === 'us_adjustment' ? 'block' : 'none' }};">
    <div class="card mb-3 bg-light">
        <div class="card-body">
            <h6 class="mb-3">U.S. USCIS Office Location</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_uscis_office_city', 'City or Town') }}
                        {{ Form::text('beneficiary_uscis_office_city', optional($application)->beneficiary_uscis_office_city ?? '', [
                            'class' => 'form-control',
                            'placeholder' => 'USCIS office city',
                            'maxlength' => 100
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_uscis_office_state', 'State') }}
                        {{ Form::text('beneficiary_uscis_office_state', optional($application)->beneficiary_uscis_office_state ?? '', [
                            'class' => 'form-control state-format',
                            'placeholder' => 'CA',
                            'maxlength' => 2,
                            'style' => 'text-transform: uppercase;'
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Abroad Consulate Location -->
<div id="abroad_consulate_section" 
    style="display: {{ (optional($application)->beneficiary_application_location ?? '') === 'abroad_consulate' ? 'block' : 'none' }};">
    <div class="card mb-3 bg-light">
        <div class="card-body">
            <h6 class="mb-3">U.S. Embassy or Consulate Location</h6>
            <div class="alert alert-warning">
                <i class="fa fa-exclamation-triangle me-2"></i>
                <strong>Note:</strong> Choosing a U.S. Embassy or Consulate outside the beneficiary's country of last residence does not guarantee acceptance. The designated embassy has discretion.
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_consulate_city', 'City or Town') }}
                        {{ Form::text('beneficiary_consulate_city', optional($application)->beneficiary_consulate_city ?? '', [
                            'class' => 'form-control',
                            'placeholder' => 'Manila',
                            'maxlength' => 100
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_consulate_province', 'Province') }}
                        {{ Form::text('beneficiary_consulate_province', optional($application)->beneficiary_consulate_province ?? '', [
                            'class' => 'form-control',
                            'placeholder' => 'Province/Region',
                            'maxlength' => 100
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_consulate_country', 'Country') }}
                        {{ Form::select('beneficiary_consulate_country', getAllCountry(), optional($application)->beneficiary_consulate_country ?? '', [
                            'class' => 'form-control'
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="row" id="beneficiary_divorce_section" 
        style="display: {{ (optional($application)->beneficiary_previous_marriages ?? '') === 'yes' ? 'block' : 'none' }};">
        <div class="col-md-12">
            <div class="alert alert-info">
                <i class="fa fa-info-circle me-2"></i>
                <strong>Note:</strong> If your spouse was previously married, provide details about their most recent prior marriage.
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_prev_spouse_first_name', 'Previous Spouse First Name') }}
                {{ Form::text('beneficiary_prev_spouse_first_name', optional($application)->beneficiary_prev_spouse_first_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'First name',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_prev_spouse_last_name', 'Previous Spouse Last Name') }}
                {{ Form::text('beneficiary_prev_spouse_last_name', optional($application)->beneficiary_prev_spouse_last_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Last name',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_divorce_date', 'Date Previous Marriage Ended') }}
                {{ Form::text('beneficiary_divorce_date', optional($application)->beneficiary_divorce_date ? optional($application)->beneficiary_divorce_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 pt-4 border-top">
        {{ Form::button('<i class="fa fa-arrow-left me-2"></i>Previous: Beneficiary', [
            'class' => 'btn btn-outline-secondary',
            'type' => 'button',
            'onclick' => '$(\'#beneficiary-tab\').tab(\'show\')'
        ]) }}
        <div>
            <small class="text-muted me-3">
                <i class="fa fa-info-circle"></i> Complete all required fields to continue
            </small>
        </div>
    </div>
</div>


<script>
// Show/hide lived together section
$('#never_lived_together').on('change', function() {
    if ($(this).is(':checked')) {
        $('#lived_together_section').slideUp();
        $('#lived_together_section input, #lived_together_section select').val('');
    } else {
        $('#lived_together_section').slideDown();
    }
});

// Show/hide application location sections
$('input[name="beneficiary_application_location"]').on('change', function() {
    if ($(this).val() === 'us_adjustment') {
        $('#us_adjustment_section').slideDown();
        $('#abroad_consulate_section').slideUp();
        $('#abroad_consulate_section input, #abroad_consulate_section select').val('');
    } else if ($(this).val() === 'abroad_consulate') {
        $('#abroad_consulate_section').slideDown();
        $('#us_adjustment_section').slideUp();
        $('#us_adjustment_section input').val('');
    }
});
</script>

<script>
// Show/hide previous marriage details
$(document).on('change', 'input[name="sponsor_previous_marriages"]', function() {
    if ($(this).val() === 'yes') {
        $('#sponsor_divorce_section').slideDown();
    } else {
        $('#sponsor_divorce_section').slideUp();
        $('#sponsor_divorce_section input').val('');
    }
});

$(document).on('change', 'input[name="beneficiary_previous_marriages"]', function() {
    if ($(this).val() === 'yes') {
        $('#beneficiary_divorce_section').slideDown();
    } else {
        $('#beneficiary_divorce_section').slideUp();
        $('#beneficiary_divorce_section input').val('');
    }
});

// Format state input to uppercase
$(document).on('input', '.state-format', function() {
    this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '');
});
</script>