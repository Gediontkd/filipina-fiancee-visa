{{-- FILE: resources/views/web/visa-application/spouse-visa-simplified/_relationship-tab.blade.php --}}

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

    <!-- Sponsor Previous Marriages (FIXED: Now supports multiple entries) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-history me-2"></i>Sponsor's Previous Marriages</h5>
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

    <!-- Sponsor Previous Marriages Container (shown if Yes) -->
    <div id="sponsor_prev_marriages_section" 
        style="display: {{ (optional($application)->sponsor_previous_marriages ?? '') === 'yes' ? 'block' : 'none' }};">
        
        <div class="alert alert-info">
            <i class="fa fa-info-circle me-2"></i>
            <strong>Note:</strong> Provide details about ALL previous marriages, starting with the most recent.
        </div>

        <div id="sponsor_prev_marriages_container">
            @php
                $sponsorPrevMarriages = optional($application)->sponsor_previous_marriages_list ?? [];
            @endphp
            
            @if(!empty($sponsorPrevMarriages))
                @foreach($sponsorPrevMarriages as $index => $marriage)
                    <div class="card mb-3 prev-marriage-item" data-index="{{ $index }}">
                        <div class="card-header bg-light d-flex justify-content-between">
                            <strong>Previous Marriage {{ $index + 1 }}</strong>
                            <button type="button" class="btn btn-sm btn-danger remove-prev-marriage" 
                                data-person="sponsor" data-index="{{ $index }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Previous Spouse First Name</label>
                                        <input type="text" name="sponsor_previous_marriages_list[{{ $index }}][first_name]" 
                                            class="form-control" value="{{ $marriage['first_name'] ?? '' }}" maxlength="50">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Previous Spouse Last Name</label>
                                        <input type="text" name="sponsor_previous_marriages_list[{{ $index }}][last_name]" 
                                            class="form-control" value="{{ $marriage['last_name'] ?? '' }}" maxlength="50">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Date Marriage Ended</label>
                                        <input type="text" name="sponsor_previous_marriages_list[{{ $index }}][date_ended]" 
                                            class="form-control datePicker" value="{{ $marriage['date_ended'] ?? '' }}" 
                                            placeholder="MM/DD/YYYY">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>How Marriage Ended</label>
                                        <select name="sponsor_previous_marriages_list[{{ $index }}][how_ended]" 
                                            class="form-control">
                                            <option value="">-Select-</option>
                                            <option value="Divorce" {{ ($marriage['how_ended'] ?? '') === 'Divorce' ? 'selected' : '' }}>Divorce</option>
                                            <option value="Annulment" {{ ($marriage['how_ended'] ?? '') === 'Annulment' ? 'selected' : '' }}>Annulment</option>
                                            <option value="Death of Spouse" {{ ($marriage['how_ended'] ?? '') === 'Death of Spouse' ? 'selected' : '' }}>Death of Spouse</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            
            <input type="hidden" name="sponsor_prev_marriages_count" 
                value="{{ count($sponsorPrevMarriages) }}" id="sponsor_prev_marriages_count">
        </div>

        <button type="button" class="btn btn-outline-secondary mb-4" id="addSponsorPrevMarriage">
            <i class="fa fa-plus me-2"></i>Add Previous Marriage
        </button>
    </div>

    <!-- Beneficiary Previous Marriages (FIXED: Moved right after question) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-history me-2"></i>Beneficiary's Previous Marriages</h5>
    <div class="row">
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

    <!-- Beneficiary Previous Marriages Container (shown if Yes) -->
    <div id="beneficiary_prev_marriages_section" 
        style="display: {{ (optional($application)->beneficiary_previous_marriages ?? '') === 'yes' ? 'block' : 'none' }};">
        
        <div class="alert alert-info">
            <i class="fa fa-info-circle me-2"></i>
            <strong>Note:</strong> Provide details about ALL previous marriages, starting with the most recent.
        </div>

        <div id="beneficiary_prev_marriages_container">
            @php
                $beneficiaryPrevMarriages = optional($application)->beneficiary_previous_marriages_list ?? [];
            @endphp
            
            @if(!empty($beneficiaryPrevMarriages))
                @foreach($beneficiaryPrevMarriages as $index => $marriage)
                    <div class="card mb-3 prev-marriage-item" data-index="{{ $index }}">
                        <div class="card-header bg-light d-flex justify-content-between">
                            <strong>Previous Marriage {{ $index + 1 }}</strong>
                            <button type="button" class="btn btn-sm btn-danger remove-prev-marriage" 
                                data-person="beneficiary" data-index="{{ $index }}">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Previous Spouse First Name</label>
                                        <input type="text" name="beneficiary_previous_marriages_list[{{ $index }}][first_name]" 
                                            class="form-control" value="{{ $marriage['first_name'] ?? '' }}" maxlength="50">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Previous Spouse Last Name</label>
                                        <input type="text" name="beneficiary_previous_marriages_list[{{ $index }}][last_name]" 
                                            class="form-control" value="{{ $marriage['last_name'] ?? '' }}" maxlength="50">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Date Marriage Ended</label>
                                        <input type="text" name="beneficiary_previous_marriages_list[{{ $index }}][date_ended]" 
                                            class="form-control datePicker" value="{{ $marriage['date_ended'] ?? '' }}" 
                                            placeholder="MM/DD/YYYY">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>How Marriage Ended</label>
                                        <select name="beneficiary_previous_marriages_list[{{ $index }}][how_ended]" 
                                            class="form-control">
                                            <option value="">-Select-</option>
                                            <option value="Divorce" {{ ($marriage['how_ended'] ?? '') === 'Divorce' ? 'selected' : '' }}>Divorce</option>
                                            <option value="Annulment" {{ ($marriage['how_ended'] ?? '') === 'Annulment' ? 'selected' : '' }}>Annulment</option>
                                            <option value="Death of Spouse" {{ ($marriage['how_ended'] ?? '') === 'Death of Spouse' ? 'selected' : '' }}>Death of Spouse</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            
            <input type="hidden" name="beneficiary_prev_marriages_count" 
                value="{{ count($beneficiaryPrevMarriages) }}" id="beneficiary_prev_marriages_count">
        </div>

        <button type="button" class="btn btn-outline-secondary mb-4" id="addBeneficiaryPrevMarriage">
            <i class="fa fa-plus me-2"></i>Add Previous Marriage
        </button>
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
$(document).ready(function() {
    // ============================================
    // SPONSOR PREVIOUS MARRIAGES
    // ============================================
    
    // Show/hide sponsor previous marriages section
    $('input[name="sponsor_previous_marriages"]').on('change', function() {
        if ($(this).val() === 'yes') {
            $('#sponsor_prev_marriages_section').slideDown();
        } else {
            $('#sponsor_prev_marriages_section').slideUp();
            $('#sponsor_prev_marriages_container').empty();
            $('#sponsor_prev_marriages_count').val(0);
        }
    });

    // Add sponsor previous marriage
    $('#addSponsorPrevMarriage').on('click', function() {
        const count = parseInt($('#sponsor_prev_marriages_count').val());
        const newIndex = count;
        
        const html = `
            <div class="card mb-3 prev-marriage-item" data-index="${newIndex}">
                <div class="card-header bg-light d-flex justify-content-between">
                    <strong>Previous Marriage ${newIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-prev-marriage" 
                        data-person="sponsor" data-index="${newIndex}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Previous Spouse First Name</label>
                                <input type="text" name="sponsor_previous_marriages_list[${newIndex}][first_name]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Previous Spouse Last Name</label>
                                <input type="text" name="sponsor_previous_marriages_list[${newIndex}][last_name]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Date Marriage Ended</label>
                                <input type="text" name="sponsor_previous_marriages_list[${newIndex}][date_ended]" 
                                    class="form-control datePicker" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>How Marriage Ended</label>
                                <select name="sponsor_previous_marriages_list[${newIndex}][how_ended]" class="form-control">
                                    <option value="">-Select-</option>
                                    <option value="Divorce">Divorce</option>
                                    <option value="Annulment">Annulment</option>
                                    <option value="Death of Spouse">Death of Spouse</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#sponsor_prev_marriages_container').append(html);
        $('#sponsor_prev_marriages_count').val(newIndex + 1);
        
        // Reinitialize datepickers
        $('.datePicker').datepicker({ format: 'mm/dd/yyyy', autoclose: true });
    });

    // Remove sponsor previous marriage
    $(document).on('click', '.remove-prev-marriage[data-person="sponsor"]', function() {
        $(this).closest('.prev-marriage-item').remove();
    });

    // ============================================
    // BENEFICIARY PREVIOUS MARRIAGES
    // ============================================
    
    // Show/hide beneficiary previous marriages section
    $('input[name="beneficiary_previous_marriages"]').on('change', function() {
        if ($(this).val() === 'yes') {
            $('#beneficiary_prev_marriages_section').slideDown();
        } else {
            $('#beneficiary_prev_marriages_section').slideUp();
            $('#beneficiary_prev_marriages_container').empty();
            $('#beneficiary_prev_marriages_count').val(0);
        }
    });

    // Add beneficiary previous marriage
    $('#addBeneficiaryPrevMarriage').on('click', function() {
        const count = parseInt($('#beneficiary_prev_marriages_count').val());
        const newIndex = count;
        
        const html = `
            <div class="card mb-3 prev-marriage-item" data-index="${newIndex}">
                <div class="card-header bg-light d-flex justify-content-between">
                    <strong>Previous Marriage ${newIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-prev-marriage" 
                        data-person="beneficiary" data-index="${newIndex}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Previous Spouse First Name</label>
                                <input type="text" name="beneficiary_previous_marriages_list[${newIndex}][first_name]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Previous Spouse Last Name</label>
                                <input type="text" name="beneficiary_previous_marriages_list[${newIndex}][last_name]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Date Marriage Ended</label>
                                <input type="text" name="beneficiary_previous_marriages_list[${newIndex}][date_ended]" 
                                    class="form-control datePicker" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>How Marriage Ended</label>
                                <select name="beneficiary_previous_marriages_list[${newIndex}][how_ended]" class="form-control">
                                    <option value="">-Select-</option>
                                    <option value="Divorce">Divorce</option>
                                    <option value="Annulment">Annulment</option>
                                    <option value="Death of Spouse">Death of Spouse</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#beneficiary_prev_marriages_container').append(html);
        $('#beneficiary_prev_marriages_count').val(newIndex + 1);
        
        // Reinitialize datepickers
        $('.datePicker').datepicker({ format: 'mm/dd/yyyy', autoclose: true });
    });

    // Remove beneficiary previous marriage
    $(document).on('click', '.remove-prev-marriage[data-person="beneficiary"]', function() {
        $(this).closest('.prev-marriage-item').remove();
    });

    // ============================================
    // OTHER SECTIONS
    // ============================================
    
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

    // Format state input to uppercase
    $(document).on('input', '.state-format', function() {
        this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '');
    });
});
</script>