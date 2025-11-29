{{-- FILE: resources/views/web/visa-application/spouse-visa-simplified/_beneficiary-tab.blade.php --}}

<div class="beneficiary-section">
    {{-- Include city auto-fill script --}}
@push('scripts')
<script src="{{ asset('assets/js/city-auto-fill.js') }}"></script>
@endpush
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-user-friends me-2 text-primary"></i>Beneficiary Information
    </h4>
    <p class="text-muted mb-4">Enter information about the foreign spouse (beneficiary)</p>

    <!-- Personal Information -->
    <h5 class="mb-3"><i class="fa fa-id-card me-2"></i>Personal Information</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_first_name', 'First Name') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_first_name', optional($application)->beneficiary_first_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter first name',
                    'required' => true,
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_middle_name', 'Middle Name') }}
                {{ Form::text('beneficiary_middle_name', optional($application)->beneficiary_middle_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Middle name (optional)',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_last_name', 'Last Name') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_last_name', optional($application)->beneficiary_last_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter last name',
                    'required' => true,
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
    </div>

    <!-- Other Names Used -->
<h5 class="mb-3 mt-4"><i class="fa fa-user-tag me-2"></i>Other Names Used</h5>
<div class="alert alert-info">
    <i class="fa fa-info-circle me-2"></i>
    <strong>Note:</strong> Provide all other names the beneficiary has ever used, including aliases, maiden name, and nicknames. If none, you can skip this section.
</div>

<div id="beneficiary_other_names_container">
    @php
        $benOtherNames = optional($application)->beneficiary_other_names ?? [];
    @endphp
    
    @if(!empty($benOtherNames))
        @foreach($benOtherNames as $index => $name)
            <div class="card mb-3 other-name-item" data-index="{{ $index }}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <strong>Other Name {{ $index + 1 }}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-other-name" data-person="beneficiary" data-index="{{ $index }}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Family Name (Last Name)</label>
                                <input type="text" name="beneficiary_other_names[{{ $index }}][last_name]" 
                                    class="form-control" value="{{ $name['last_name'] ?? '' }}" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Given Name (First Name)</label>
                                <input type="text" name="beneficiary_other_names[{{ $index }}][first_name]" 
                                    class="form-control" value="{{ $name['first_name'] ?? '' }}" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Middle Name</label>
                                <input type="text" name="beneficiary_other_names[{{ $index }}][middle_name]" 
                                    class="form-control" value="{{ $name['middle_name'] ?? '' }}" maxlength="50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    
    <input type="hidden" name="beneficiary_other_names_count" value="{{ count($benOtherNames) }}" id="beneficiary_other_names_count">
</div>

<button type="button" class="btn btn-outline-secondary mb-4" id="addBeneficiaryOtherName">
    <i class="fa fa-plus me-2"></i>Add Other Name
</button>

<!-- Additional IDs -->
<h5 class="mb-3 mt-4"><i class="fa fa-id-badge me-2"></i>Additional Identification Numbers</h5>
<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_ssn', 'U.S. Social Security Number') }}
            <div class="input-group">
                {{ Form::text('beneficiary_ssn', optional($application)->beneficiary_ssn ?? '', [
                    'class' => 'form-control ssn-format',
                    'placeholder' => '###-##-####',
                    'id' => 'beneficiary_ssn',
                    'pattern' => '\d{3}-\d{2}-\d{4}',
                    'maxlength' => 11
                ]) }}
            </div>
            <div class="form-check mt-2">
                {{ Form::checkbox('beneficiary_ssn_na', 1, 
                    (optional($application)->beneficiary_ssn ?? '') === 'N/A', [
                    'class' => 'form-check-input does-not-apply-checkbox',
                    'data-target' => '#beneficiary_ssn'
                ]) }}
                <label class="form-check-label">Does Not Apply</label>
            </div>
            <small class="form-text text-muted">If beneficiary has never been assigned a U.S. SSN, check "Does Not Apply"</small>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_uscis_account', 'USCIS Online Account Number') }}
            <div class="input-group">
                {{ Form::text('beneficiary_uscis_account', optional($application)->beneficiary_uscis_account ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'USCIS Account Number',
                    'id' => 'beneficiary_uscis_account',
                    'maxlength' => 20
                ]) }}
            </div>
            <div class="form-check mt-2">
                {{ Form::checkbox('beneficiary_uscis_account_na', 1, 
                    (optional($application)->beneficiary_uscis_account ?? '') === 'N/A', [
                    'class' => 'form-check-input does-not-apply-checkbox',
                    'data-target' => '#beneficiary_uscis_account'
                ]) }}
                <label class="form-check-label">Does Not Apply</label>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_petition_filed_before', 'Has anyone filed petition for beneficiary before?') }}
            <span class="text-danger">*</span>
            {{ Form::select('beneficiary_petition_filed_before', [
                '' => '-Select-',
                'Yes' => 'Yes',
                'No' => 'No',
                'Unknown' => 'Unknown'
            ], optional($application)->beneficiary_petition_filed_before ?? '', [
                'class' => 'form-control',
                'required' => true
            ]) }}
        </div>
    </div>
</div>

<!-- Passport Details -->
<h5 class="mb-3 mt-4"><i class="fa fa-passport me-2"></i>Passport Details</h5>
<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_passport_country', 'Country of Issuance for Passport') }}
            {{ Form::select('beneficiary_passport_country', getAllCountry(), optional($application)->beneficiary_passport_country ?? '', [
                'class' => 'form-control',
                'placeholder' => 'Select country'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_passport_expiration', 'Passport Expiration Date') }}
            {{ Form::text('beneficiary_passport_expiration', optional($application)->beneficiary_passport_expiration ? optional($application)->beneficiary_passport_expiration->format('m/d/Y') : '', [
                'class' => 'form-control datePicker',
                'placeholder' => 'MM/DD/YYYY'
            ]) }}
            <small class="form-text text-muted">Leave blank if passport not yet obtained</small>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_dob', 'Date of Birth') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_dob', optional($application)->beneficiary_dob ? optional($application)->beneficiary_dob->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_sex', 'Sex') }}
                <span class="text-danger">*</span>
                {{ Form::select('beneficiary_sex', [
                    '' => '-Select-',
                    'Male' => 'Male',
                    'Female' => 'Female'
                ], optional($application)->beneficiary_sex ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_place_of_birth', 'Place of Birth (City, Country)') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_place_of_birth', optional($application)->beneficiary_place_of_birth ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'e.g., Manila, Philippines',
                    'required' => true,
                    'maxlength' => 100
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_citizenship', 'Country of Citizenship') }}
                <span class="text-danger">*</span>
                {{ Form::select('beneficiary_citizenship', getAllCountry(), optional($application)->beneficiary_citizenship ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_passport_number', 'Passport Number') }}
                <div class="input-group">
                    {{ Form::text('beneficiary_passport_number', optional($application)->beneficiary_passport_number ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter passport number',
                        'maxlength' => 50,
                        'id' => 'beneficiary_passport_number'
                    ]) }}
                </div>
                <div class="form-check mt-2">
                    {{ Form::checkbox('beneficiary_passport_na', 1, 
                        (optional($application)->beneficiary_passport_number ?? '') === 'N/A', [
                        'class' => 'form-check-input does-not-apply-checkbox',
                        'data-target' => '#beneficiary_passport_number'
                    ]) }}
                    <label class="form-check-label">Does Not Apply / Will Get Later</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_alien_number', 'Alien Registration Number (A-Number)') }}
                <div class="input-group">
                    {{ Form::text('beneficiary_alien_number', optional($application)->beneficiary_alien_number ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'A12345678',
                        'id' => 'beneficiary_alien_number',
                        'maxlength' => 20
                    ]) }}
                </div>
                <div class="form-check mt-2">
                    {{ Form::checkbox('beneficiary_alien_number_na', 1, 
                        (optional($application)->beneficiary_alien_number ?? '') === 'N/A', [
                        'class' => 'form-check-input does-not-apply-checkbox',
                        'data-target' => '#beneficiary_alien_number'
                    ]) }}
                    <label class="form-check-label">Does Not Apply</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <h5 class="mb-3 mt-4"><i class="fa fa-phone me-2"></i>Contact Information</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_email', 'Email Address') }}
                <span class="text-danger">*</span>
                {{ Form::email('beneficiary_email', optional($application)->beneficiary_email ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'beneficiary@example.com',
                    'required' => true,
                    'maxlength' => 100
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_phone', 'Phone Number') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_phone', optional($application)->beneficiary_phone ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '+63 912 345 6789 or (###) ###-####',
                    'required' => true,
                    'maxlength' => 50
                ]) }}
                <small class="form-text text-muted">International format accepted</small>
            </div>
        </div>
    </div>

    <!-- Daytime Telephone (Separate from Mobile) -->
<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_daytime_phone', 'Daytime Telephone Number') }}
            <span class="text-danger">*</span>
            {{ Form::text('beneficiary_daytime_phone', optional($application)->beneficiary_daytime_phone ?? '', [
                'class' => 'form-control',
                'placeholder' => '+63 32 555 0198 or (###) ###-####',
                'required' => true,
                'maxlength' => 50
            ]) }}
            <small class="form-text text-muted">Can be same as mobile if no landline</small>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_mobile_phone', 'Mobile Telephone Number') }}
            {{ Form::text('beneficiary_mobile_phone', optional($application)->beneficiary_phone ?? '', [
                'class' => 'form-control',
                'placeholder' => '+63 917 123 4567',
                'maxlength' => 50
            ]) }}
        </div>
    </div>
</div>

    <!-- Mailing Address -->
    <h5 class="mb-3 mt-4"><i class="fa fa-envelope me-2"></i>Mailing Address</h5>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_mailing_address', 'Street Address') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_mailing_address', optional($application)->beneficiary_mailing_address ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Street address, building',
                    'required' => true,
                    'maxlength' => 100
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            @include('components.apt-suite-floor', [
                'name' => 'beneficiary_mailing_apt',
                'value' => optional($application)->beneficiary_mailing_apt,
                'required' => false
            ])
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_mailing_city', 'City') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_mailing_city', optional($application)->beneficiary_mailing_city ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter city',
                    'required' => true,
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_mailing_country', 'Country') }}
                <span class="text-danger">*</span>
                {{ Form::select('beneficiary_mailing_country', getAllCountry(), optional($application)->beneficiary_mailing_country ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_mailing_state', 'State/Province') }}
                {{ Form::text('beneficiary_mailing_state', optional($application)->beneficiary_mailing_state ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'State or Province',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_mailing_zip', 'Postal/ZIP Code') }}
                {{ Form::text('beneficiary_mailing_zip', optional($application)->beneficiary_mailing_zip ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter postal code',
                    'maxlength' => 20
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_mailing_date_from', 'Date From') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_mailing_date_from', optional($application)->beneficiary_mailing_date_from ? optional($application)->beneficiary_mailing_date_from->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
    <div class="form-group mb-3">
        {{ Form::label('beneficiary_mailing_date_to', 'Date To') }}
        <span class="text-danger">*</span>
        
        {{-- Display field showing PRESENT --}}
        <div class="form-control" style="background-color: #e9ecef; cursor: default;">
            PRESENT
        </div>
        
        {{-- Hidden date field (empty, not used) --}}
        {{ Form::hidden('beneficiary_mailing_date_to', '') }}
        
        {{-- Hidden checkbox that's always checked - this tells backend to save "Present" --}}
        {{ Form::hidden('beneficiary_mailing_present', 1) }}
    </div>
</div>
    </div>

    <!-- Same Address Question -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>Is your current physical address the same as your mailing address?</label>
                <span class="text-danger">*</span>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        {{ Form::radio('beneficiary_same_address', 1, 
                            optional($application)->beneficiary_same_address ?? true, [
                            'class' => 'form-check-input',
                            'id' => 'beneficiary_same_yes'
                        ]) }}
                        <label class="form-check-label" for="beneficiary_same_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('beneficiary_same_address', 0, 
                            optional($application)->beneficiary_same_address === false, [
                            'class' => 'form-check-input',
                            'id' => 'beneficiary_same_no'
                        ]) }}
                        <label class="form-check-label" for="beneficiary_same_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Intended U.S. Address (I-130 Part 4, Item 12) -->
<h5 class="mb-3 mt-4"><i class="fa fa-home me-2"></i>Intended Address in the United States</h5>
<div class="alert alert-info">
    <i class="fa fa-info-circle me-2"></i>
    <strong>Note:</strong> This is where the beneficiary intends to live in the United States. If same as sponsor's address, you can check the box below.
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group mb-3">
            <div class="form-check">
                {{ Form::checkbox('beneficiary_intended_address_same', 1, 
                    optional($application)->beneficiary_intended_address_same ?? false, [
                    'class' => 'form-check-input',
                    'id' => 'beneficiary_intended_address_same'
                ]) }}
                <label class="form-check-label" for="beneficiary_intended_address_same">
                    <strong>Same as sponsor's mailing address</strong>
                </label>
            </div>
        </div>
    </div>
</div>

<div id="beneficiary_intended_address_section" 
    style="display: {{ optional($application)->beneficiary_intended_address_same ? 'none' : 'block' }};">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_intended_address', 'Street Address') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_intended_address', optional($application)->beneficiary_intended_address ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Street address in USA',
                    'maxlength' => 100
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            @include('components.apt-suite-floor', [
                'name' => 'beneficiary_intended_apt',
                'value' => optional($application)->beneficiary_intended_apt,
                'required' => false
            ])
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_intended_city', 'City') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_intended_city', optional($application)->beneficiary_intended_city ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter city',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_intended_state', 'State') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_intended_state', optional($application)->beneficiary_intended_state ?? '', [
                    'class' => 'form-control state-format',
                    'placeholder' => 'CA',
                    'pattern' => '[A-Z]{2}',
                    'maxlength' => 2,
                    'style' => 'text-transform: uppercase;'
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_intended_zip', 'ZIP Code') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_intended_zip', optional($application)->beneficiary_intended_zip ?? '', [
                    'class' => 'form-control zip-format',
                    'placeholder' => '12345 or 12345-6789',
                    'pattern' => '\d{5}(-\d{4})?',
                    'maxlength' => 10
                ]) }}
            </div>
        </div>
    </div>
</div>

    <!-- Physical Address (shown if different) -->
    <div id="beneficiary_physical_address_section" 
        style="display: {{ optional($application)->beneficiary_same_address === false ? 'block' : 'none' }};">
        <h5 class="mb-3"><i class="fa fa-home me-2"></i>Physical Address</h5>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group mb-3">
                    {{ Form::label('beneficiary_address', 'Street Address') }}
                    {{ Form::text('beneficiary_address', optional($application)->beneficiary_address ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'Street address, building',
                        'maxlength' => 100
                    ]) }}
                </div>
            </div>
            <div class="col-md-4">
                @include('components.apt-suite-floor', [
                    'name' => 'beneficiary_apt',
                    'value' => optional($application)->beneficiary_apt,
                    'required' => false
                ])
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    {{ Form::label('beneficiary_city', 'City') }}
                    {{ Form::text('beneficiary_city', optional($application)->beneficiary_city ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter city',
                        'maxlength' => 50
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    {{ Form::label('beneficiary_country', 'Country') }}
                    {{ Form::select('beneficiary_country', getAllCountry(), optional($application)->beneficiary_country ?? '', [
                        'class' => 'form-control country-select',
                        'data-state-target' => '#beneficiary_state'
                    ]) }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    {{ Form::label('beneficiary_state', 'State/Province') }}
                    {{ Form::text('beneficiary_state', optional($application)->beneficiary_state ?? '', [
                        'class' => 'form-control',
                        'id' => 'beneficiary_state',
                        'placeholder' => 'State or Province',
                        'maxlength' => 50
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    {{ Form::label('beneficiary_zip', 'Postal/ZIP Code') }}
                    {{ Form::text('beneficiary_zip', optional($application)->beneficiary_zip ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter postal code',
                        'maxlength' => 20
                    ]) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Address History (5 Years) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-history me-2"></i>Address History (Last 5 Years)</h5>
    <div class="alert alert-info">
        <i class="fa fa-info-circle me-2"></i>
        <strong>Required:</strong> Provide your complete address history for the past five years. Include all addresses where you have lived.
    </div>

    <div id="beneficiary_address_history_container">
        @php
            $addressHistory = optional($application)->beneficiary_address_history ?? [];
        @endphp
        
        @if(empty($addressHistory))
            <input type="hidden" name="beneficiary_address_history_count" value="0" id="beneficiary_address_history_count">
        @else
            @foreach($addressHistory as $index => $address)
                <div class="card mb-3 address-history-item" data-index="{{ $index }}">
                    <div class="card-header bg-light d-flex justify-content-between">
                        <strong>Previous Address {{ $index + 1 }}</strong>
                        <button type="button" class="btn btn-sm btn-danger remove-address" data-person="beneficiary" data-index="{{ $index }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label>Street Address</label>
                                    <input type="text" name="beneficiary_address_history[{{ $index }}][address]" 
                                        class="form-control" value="{{ $address['address'] ?? '' }}" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-4">
                                @include('components.apt-suite-floor', [
                                    'name' => "beneficiary_address_history[{$index}][apt]",
                                    'value' => $address['apt'] ?? '',
                                    'required' => false
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>City</label>
                                    <input type="text" name="beneficiary_address_history[{{ $index }}][city]" 
                                        class="form-control" value="{{ $address['city'] ?? '' }}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Country</label>
                                    <select name="beneficiary_address_history[{{ $index }}][country]" class="form-control">
                                        @foreach(getAllCountry() as $code => $name)
                                            <option value="{{ $code }}" {{ ($address['country'] ?? '') == $code ? 'selected' : '' }}>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>State/Province</label>
                                    <input type="text" name="beneficiary_address_history[{{ $index }}][state]" 
                                        class="form-control" value="{{ $address['state'] ?? '' }}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Postal Code</label>
                                    <input type="text" name="beneficiary_address_history[{{ $index }}][zip]" 
                                        class="form-control" value="{{ $address['zip'] ?? '' }}" maxlength="20">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Date From</label>
                                    <input type="text" name="beneficiary_address_history[{{ $index }}][date_from]" 
                                        class="form-control datePicker" value="{{ $address['date_from'] ?? '' }}" 
                                        placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Date To</label>
                                    @php
                                        $benAddrDateTo = $address['date_to'] ?? '';
                                        $isBenAddrPresent = ($benAddrDateTo === 'Present' || $benAddrDateTo === 'present');
                                    @endphp
                                    <input type="text" 
                                        name="beneficiary_address_history[{{ $index }}][date_to]" 
                                        class="form-control datePicker addr-date-to" 
                                        value="{{ $isBenAddrPresent ? '' : $benAddrDateTo }}" 
                                        placeholder="MM/DD/YYYY"
                                        id="beneficiary_addr_date_to_{{ $index }}"
                                        {{ $isBenAddrPresent ? 'disabled' : '' }}>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" 
                                            class="form-check-input present-checkbox" 
                                            id="beneficiary_addr_present_{{ $index }}"
                                            data-target="#beneficiary_addr_date_to_{{ $index }}"
                                            {{ $isBenAddrPresent ? 'checked' : '' }}>
                                        <label class="form-check-label" for="beneficiary_addr_present_{{ $index }}">
                                            Present
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <input type="hidden" name="beneficiary_address_history_count" value="{{ count($addressHistory) }}" id="beneficiary_address_history_count">
        @endif
    </div>

    <button type="button" class="btn btn-outline-primary mb-4" id="addBeneficiaryAddress">
        <i class="fa fa-plus me-2"></i>Add Previous Address
    </button>

    <div id="beneficiary_address_coverage_warning" class="alert alert-warning" style="display: none;">
        <i class="fa fa-exclamation-triangle me-2"></i>
        <strong>Incomplete:</strong> Your address history must cover at least five full years.
    </div>

    <!-- Entry Information (I-130 Part 4, Items 45-46) -->
<h5 class="mb-3 mt-4"><i class="fa fa-plane me-2"></i>U.S. Entry Information</h5>
<div class="row">
    <div class="col-md-12">
        <div class="form-group mb-3">
            <label>Was the beneficiary EVER in the United States?</label>
            <span class="text-danger">*</span>
            <div class="d-flex gap-3">
                <div class="form-check">
                    {{ Form::radio('beneficiary_ever_in_us', 'yes', 
                        (optional($application)->beneficiary_ever_in_us ?? '') === 'yes', [
                        'class' => 'form-check-input',
                        'id' => 'beneficiary_ever_in_us_yes',
                        'required' => true
                    ]) }}
                    <label class="form-check-label" for="beneficiary_ever_in_us_yes">Yes</label>
                </div>
                <div class="form-check">
                    {{ Form::radio('beneficiary_ever_in_us', 'no', 
                        (optional($application)->beneficiary_ever_in_us ?? '') === 'no', [
                        'class' => 'form-check-input',
                        'id' => 'beneficiary_ever_in_us_no',
                        'required' => true
                    ]) }}
                    <label class="form-check-label" for="beneficiary_ever_in_us_no">No</label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Entry Details (shown if Yes) -->
<div id="beneficiary_entry_section" 
    style="display: {{ (optional($application)->beneficiary_ever_in_us ?? '') === 'yes' ? 'block' : 'none' }};">
    <div class="card mb-3 bg-light">
        <div class="card-body">
            <h6 class="mb-3">Most Recent U.S. Entry Details</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_class_of_admission', 'Class of Admission') }}
                        {{ Form::text('beneficiary_class_of_admission', optional($application)->beneficiary_class_of_admission ?? '', [
                            'class' => 'form-control',
                            'placeholder' => 'e.g., B-2, F-1, etc.',
                            'maxlength' => 20
                        ]) }}
                        <small class="form-text text-muted">Visa type they entered with</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_i94_number', 'Form I-94 Arrival-Departure Record Number') }}
                        {{ Form::text('beneficiary_i94_number', optional($application)->beneficiary_i94_number ?? '', [
                            'class' => 'form-control',
                            'placeholder' => 'I-94 number',
                            'maxlength' => 20
                        ]) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_date_of_arrival', 'Date of Arrival') }}
                        {{ Form::text('beneficiary_date_of_arrival', optional($application)->beneficiary_date_of_arrival ? optional($application)->beneficiary_date_of_arrival->format('m/d/Y') : '', [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'MM/DD/YYYY'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_date_authorized_stay_expires', 'Date Authorized Stay Expires') }}
                        {{ Form::text('beneficiary_date_authorized_stay_expires', optional($application)->beneficiary_date_authorized_stay_expires ?? '', [
                            'class' => 'form-control',
                            'placeholder' => 'MM/DD/YYYY or D/S',
                            'maxlength' => 20
                        ]) }}
                        <small class="form-text text-muted">Enter date or "D/S" for Duration of Status</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Immigration Proceedings (I-130 Part 4, Items 53-56) -->
<h5 class="mb-3 mt-4"><i class="fa fa-gavel me-2"></i>Immigration Proceedings</h5>
<div class="row">
    <div class="col-md-12">
        <div class="form-group mb-3">
            <label>Was the beneficiary EVER in immigration proceedings?</label>
            <span class="text-danger">*</span>
            <div class="d-flex gap-3">
                <div class="form-check">
                    {{ Form::radio('beneficiary_immigration_proceedings', 'yes', 
                        (optional($application)->beneficiary_immigration_proceedings ?? '') === 'yes', [
                        'class' => 'form-check-input',
                        'id' => 'beneficiary_proceedings_yes',
                        'required' => true
                    ]) }}
                    <label class="form-check-label" for="beneficiary_proceedings_yes">Yes</label>
                </div>
                <div class="form-check">
                    {{ Form::radio('beneficiary_immigration_proceedings', 'no', 
                        (optional($application)->beneficiary_immigration_proceedings ?? '') === 'no', [
                        'class' => 'form-check-input',
                        'id' => 'beneficiary_proceedings_no',
                        'required' => true
                    ]) }}
                    <label class="form-check-label" for="beneficiary_proceedings_no">No</label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Proceedings Details (shown if Yes) -->
<div id="beneficiary_proceedings_section" 
    style="display: {{ (optional($application)->beneficiary_immigration_proceedings ?? '') === 'yes' ? 'block' : 'none' }};">
    <div class="card mb-3 bg-light">
        <div class="card-body">
            <h6 class="mb-3">Proceedings Details</h6>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        <label>Type of Proceedings</label>
                        <div class="d-flex flex-column gap-2">
                            <div class="form-check">
                                {{ Form::checkbox('beneficiary_proceedings_types[]', 'Removal', 
                                    in_array('Removal', optional($application)->beneficiary_proceedings_types ?? []), [
                                    'class' => 'form-check-input',
                                    'id' => 'proceedings_removal'
                                ]) }}
                                <label class="form-check-label" for="proceedings_removal">Removal</label>
                            </div>
                            <div class="form-check">
                                {{ Form::checkbox('beneficiary_proceedings_types[]', 'Exclusion/Deportation', 
                                    in_array('Exclusion/Deportation', optional($application)->beneficiary_proceedings_types ?? []), [
                                    'class' => 'form-check-input',
                                    'id' => 'proceedings_deportation'
                                ]) }}
                                <label class="form-check-label" for="proceedings_deportation">Exclusion/Deportation</label>
                            </div>
                            <div class="form-check">
                                {{ Form::checkbox('beneficiary_proceedings_types[]', 'Rescission', 
                                    in_array('Rescission', optional($application)->beneficiary_proceedings_types ?? []), [
                                    'class' => 'form-check-input',
                                    'id' => 'proceedings_rescission'
                                ]) }}
                                <label class="form-check-label" for="proceedings_rescission">Rescission</label>
                            </div>
                            <div class="form-check">
                                {{ Form::checkbox('beneficiary_proceedings_types[]', 'Other', 
                                    in_array('Other', optional($application)->beneficiary_proceedings_types ?? []), [
                                    'class' => 'form-check-input',
                                    'id' => 'proceedings_other'
                                ]) }}
                                <label class="form-check-label" for="proceedings_other">Other Judicial Proceedings</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_proceedings_city', 'City/Town') }}
                        {{ Form::text('beneficiary_proceedings_city', optional($application)->beneficiary_proceedings_city ?? '', [
                            'class' => 'form-control',
                            'placeholder' => 'Location of proceedings',
                            'maxlength' => 100
                        ]) }}
                    </div>
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_proceedings_state', 'State') }}
                        {{ Form::text('beneficiary_proceedings_state', optional($application)->beneficiary_proceedings_state ?? '', [
                            'class' => 'form-control state-format',
                            'placeholder' => 'CA',
                            'maxlength' => 2,
                            'style' => 'text-transform: uppercase;'
                        ]) }}
                    </div>
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_proceedings_date', 'Date of Proceedings') }}
                        {{ Form::text('beneficiary_proceedings_date', optional($application)->beneficiary_proceedings_date ? optional($application)->beneficiary_proceedings_date->format('m/d/Y') : '', [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'MM/DD/YYYY'
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Employment History (5 Years) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-briefcase me-2"></i>Employment History (Last 5 Years)</h5>
    <div class="alert alert-info">
        <i class="fa fa-info-circle me-2"></i>
        <strong>Important:</strong> Even if you are unemployed, you must enter this like a job. 
        For Employer Name, enter "Unemployed." For Address, enter "N/A." Include the Start and End Dates of that period.
    </div>

    <div id="beneficiary_employment_history_container">
        @php
            $employmentHistory = optional($application)->beneficiary_employment_history ?? [];
        @endphp
        
        @if(empty($employmentHistory))
            <input type="hidden" name="beneficiary_employment_history_count" value="0" id="beneficiary_employment_history_count">
        @else
            @foreach($employmentHistory as $index => $job)
                <div class="card mb-3 employment-history-item" data-index="{{ $index }}">
                    <div class="card-header bg-light d-flex justify-content-between">
                        <strong>Employment {{ $index + 1 }}</strong>
                        <button type="button" class="btn btn-sm btn-danger remove-employment" data-person="beneficiary" data-index="{{ $index }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Employer Name</label>
                                    <input type="text" name="beneficiary_employment_history[{{ $index }}][employer]" 
                                        class="form-control" value="{{ $job['employer'] ?? '' }}" 
                                        placeholder="Company name or 'Unemployed'" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Occupation</label>
                                    <input type="text" name="beneficiary_employment_history[{{ $index }}][occupation]" 
                                        class="form-control" value="{{ $job['occupation'] ?? '' }}" 
                                        placeholder="Job title or 'N/A'" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Employer Address</label>
                                    <input type="text" name="beneficiary_employment_history[{{ $index }}][address]" 
                                        class="form-control" value="{{ $job['address'] ?? '' }}" 
                                        placeholder="Full address or 'N/A' for unemployment" maxlength="200">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Date From</label>
                                    <input type="text" name="beneficiary_employment_history[{{ $index }}][date_from]" 
                                        class="form-control datePicker" value="{{ $job['date_from'] ?? '' }}" 
                                        placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Date To</label>
                                    @php
                                        $benEmpDateTo = $job['date_to'] ?? '';
                                        $isBenEmpPresent = ($benEmpDateTo === 'Present' || $benEmpDateTo === 'present');
                                    @endphp
                                    <input type="text" 
                                        name="beneficiary_employment_history[{{ $index }}][date_to]" 
                                        class="form-control datePicker employment-date-to" 
                                        value="{{ $isBenEmpPresent ? '' : $benEmpDateTo }}" 
                                        placeholder="MM/DD/YYYY"
                                        id="beneficiary_emp_date_to_{{ $index }}"
                                        {{ $isBenEmpPresent ? 'disabled' : '' }}>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" 
                                            class="form-check-input present-checkbox" 
                                            id="beneficiary_emp_present_{{ $index }}"
                                            data-target="#beneficiary_emp_date_to_{{ $index }}"
                                            {{ $isBenEmpPresent ? 'checked' : '' }}>
                                        <label class="form-check-label" for="beneficiary_emp_present_{{ $index }}">
                                            Present (Currently working here)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <input type="hidden" name="beneficiary_employment_history_count" value="{{ count($employmentHistory) }}" id="beneficiary_employment_history_count">
        @endif
    </div>

    <button type="button" class="btn btn-outline-primary mb-4" id="addBeneficiaryEmployment">
        <i class="fa fa-plus me-2"></i>Add Employment Period
    </button>

    <div id="beneficiary_employment_coverage_warning" class="alert alert-warning" style="display: none;">
        <i class="fa fa-exclamation-triangle me-2"></i>
        <strong>Incomplete:</strong> Your employment history must cover at least five full years.
    </div>

<!-- Parents Information (FIXED: Now supports multiple entries) -->
<h5 class="mb-3 mt-4"><i class="fa fa-users me-2"></i>Beneficiary's Parents Information</h5>
<div class="alert alert-info">
    <i class="fa fa-info-circle me-2"></i>
    <strong>Note:</strong> Provide information about the beneficiary's biological or adoptive parents. You can add multiple parents/guardians.
</div>

<div id="beneficiary_parents_container">
    @php
        $beneficiaryParents = optional($application)->beneficiary_parents_list ?? [];
    @endphp
    
    @if(!empty($beneficiaryParents))
        @foreach($beneficiaryParents as $index => $parent)
            <div class="card mb-3 parent-item" data-index="{{ $index }}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <strong>Person {{ $index + 1 }}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-parent" 
                        data-person="beneficiary" data-index="{{ $index }}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" name="beneficiary_parents_list[{{ $index }}][first_name]" 
                                    class="form-control" value="{{ $parent['first_name'] ?? '' }}" 
                                    maxlength="50" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>Middle Name</label>
                                <input type="text" name="beneficiary_parents_list[{{ $index }}][middle_name]" 
                                    class="form-control" value="{{ $parent['middle_name'] ?? '' }}" 
                                    maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="beneficiary_parents_list[{{ $index }}][last_name]" 
                                    class="form-control" value="{{ $parent['last_name'] ?? '' }}" 
                                    maxlength="50" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>Relationship <span class="text-danger">*</span></label>
                                <input type="text" name="beneficiary_parents_list[{{ $index }}][relationship]" 
                                    class="form-control" value="{{ $parent['relationship'] ?? '' }}" 
                                    placeholder="e.g., Mother, Father" maxlength="50" required>
                                <small class="form-text text-muted">Mother, Father, Adoptive Parent, etc.</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Date of Birth <span class="text-danger">*</span></label>
                                <input type="text" name="beneficiary_parents_list[{{ $index }}][dob]" 
                                    class="form-control datePicker" value="{{ $parent['dob'] ?? '' }}" 
                                    placeholder="MM/DD/YYYY" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Country of Birth <span class="text-danger">*</span></label>
                                <select name="beneficiary_parents_list[{{ $index }}][country]" 
                                    class="form-control" required>
                                    <option value="">-Select Country-</option>
                                    @foreach(getAllCountry() as $code => $name)
                                        <option value="{{ $code }}" 
                                            {{ ($parent['country'] ?? '') == $code ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @else
        {{-- Show at least 2 parents by default --}}
        @for($i = 0; $i < 2; $i++)
            <div class="card mb-3 parent-item" data-index="{{ $i }}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <strong>Person {{ $i + 1 }}</strong>
                    @if($i >= 2)
                        <button type="button" class="btn btn-sm btn-danger remove-parent" 
                            data-person="beneficiary" data-index="{{ $i }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>First Name <span class="text-danger">*</span></label>
                                <input type="text" name="beneficiary_parents_list[{{ $i }}][first_name]" 
                                    class="form-control" maxlength="50" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>Middle Name</label>
                                <input type="text" name="beneficiary_parents_list[{{ $i }}][middle_name]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="beneficiary_parents_list[{{ $i }}][last_name]" 
                                    class="form-control" maxlength="50" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>Relationship <span class="text-danger">*</span></label>
                                <input type="text" name="beneficiary_parents_list[{{ $i }}][relationship]" 
                                    class="form-control" placeholder="e.g., Mother, Father" 
                                    maxlength="50" required>
                                <small class="form-text text-muted">Mother, Father, Adoptive Parent, etc.</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Date of Birth <span class="text-danger">*</span></label>
                                <input type="text" name="beneficiary_parents_list[{{ $i }}][dob]" 
                                    class="form-control datePicker" placeholder="MM/DD/YYYY" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Country of Birth <span class="text-danger">*</span></label>
                                <select name="beneficiary_parents_list[{{ $i }}][country]" 
                                    class="form-control" required>
                                    <option value="">-Select Country-</option>
                                    @foreach(getAllCountry() as $code => $name)
                                        <option value="{{ $code }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endfor
    @endif
    
    <input type="hidden" name="beneficiary_parents_count" 
        value="{{ count($beneficiaryParents) > 0 ? count($beneficiaryParents) : 2 }}" 
        id="beneficiary_parents_count">
</div>

<button type="button" class="btn btn-outline-secondary mb-4" id="addBeneficiaryParent">
    <i class="fa fa-plus me-2"></i>Add Another Person/Guardian
</button>

    <!-- Current Employment Information (I-130 Part 4, Items 51-52) -->
<h5 class="mb-3 mt-4"><i class="fa fa-briefcase me-2"></i>Current Employment Information</h5>
<div class="alert alert-info">
    <i class="fa fa-info-circle me-2"></i>
    <strong>Note:</strong> Provide information about current employment. If unemployed, enter "Unemployed" for employer name.
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_employer_name', 'Name of Current Employer') }}
            {{ Form::text('beneficiary_employer_name', optional($application)->beneficiary_employer_name ?? '', [
                'class' => 'form-control',
                'placeholder' => 'Company name or "Unemployed"',
                'maxlength' => 100
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_occupation', 'Occupation/Job Title') }}
            {{ Form::text('beneficiary_occupation', optional($application)->beneficiary_occupation ?? '', [
                'class' => 'form-control',
                'placeholder' => 'Job title or "N/A"',
                'maxlength' => 100
            ]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_employment_status', 'Employment Status') }}
            {{ Form::select('beneficiary_employment_status', [
                '' => '-Select Status-',
                'Employed' => 'Employed',
                'Self-Employed' => 'Self-Employed',
                'Unemployed' => 'Unemployed',
                'Retired' => 'Retired',
                'Student' => 'Student',
                'Homemaker' => 'Homemaker'
            ], optional($application)->beneficiary_employment_status ?? '', [
                'class' => 'form-control'
            ]) }}
            <small class="form-text text-muted">Optional: Select current employment status</small>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_employer_address_full', 'Employer Street Address') }}
            {{ Form::text('beneficiary_employer_address_full', optional($application)->beneficiary_employer_address_full ?? '', [
                'class' => 'form-control',
                'placeholder' => 'Full street address or "N/A"',
                'maxlength' => 100
            ]) }}
        </div>
    </div>
    <div class="col-md-4">
        @include('components.apt-suite-floor', [
            'name' => 'beneficiary_employer_apt',
            'value' => optional($application)->beneficiary_employer_apt,
            'required' => false
        ])
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_employer_city', 'City or Town') }}
            {{ Form::text('beneficiary_employer_city', optional($application)->beneficiary_employer_city ?? '', [
                'class' => 'form-control',
                'placeholder' => 'City',
                'maxlength' => 50
            ]) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_employer_province', 'State/Province') }}
            {{ Form::text('beneficiary_employer_province', optional($application)->beneficiary_employer_province ?? '', [
                'class' => 'form-control',
                'placeholder' => 'State or Province',
                'maxlength' => 50
            ]) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_employer_postal', 'Postal Code') }}
            {{ Form::text('beneficiary_employer_postal', optional($application)->beneficiary_employer_postal ?? '', [
                'class' => 'form-control',
                'placeholder' => 'Postal code',
                'maxlength' => 20
            ]) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_employer_country', 'Country') }}
            {{ Form::select('beneficiary_employer_country', getAllCountry(), optional($application)->beneficiary_employer_country ?? '', [
                'class' => 'form-control',
                'placeholder' => 'Select country'
            ]) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            {{ Form::label('beneficiary_employment_start_date', 'Date Employment Began') }}
            {{ Form::text('beneficiary_employment_start_date', optional($application)->beneficiary_employment_start_date ? optional($application)->beneficiary_employment_start_date->format('m/d/Y') : '', [
                'class' => 'form-control datePicker',
                'placeholder' => 'MM/DD/YYYY'
            ]) }}
        </div>
    </div>
</div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4">
        {{ Form::button('<i class="fa fa-arrow-left me-2"></i>Previous: Sponsor', [
            'class' => 'btn btn-outline-secondary',
            'type' => 'button',
            'onclick' => '$(\'#sponsor-tab\').tab(\'show\')'
        ]) }}
        {{ Form::button('Next: Relationship Information <i class="fa fa-arrow-right ms-2"></i>', [
            'class' => 'btn btn-primary',
            'type' => 'button',
            'onclick' => '$(\'#relationship-tab\').tab(\'show\')'
        ]) }}
    </div>
</div>


<script>
$(document).ready(function() {
    // Add other name
    $('#addBeneficiaryOtherName').on('click', function() {
        const count = parseInt($('#beneficiary_other_names_count').val());
        const newIndex = count;
        
        const html = `
            <div class="card mb-3 other-name-item" data-index="${newIndex}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <strong>Other Name ${newIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-other-name" data-person="beneficiary" data-index="${newIndex}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Family Name (Last Name)</label>
                                <input type="text" name="beneficiary_other_names[${newIndex}][last_name]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Given Name (First Name)</label>
                                <input type="text" name="beneficiary_other_names[${newIndex}][first_name]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Middle Name</label>
                                <input type="text" name="beneficiary_other_names[${newIndex}][middle_name]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#beneficiary_other_names_container').append(html);
        $('#beneficiary_other_names_count').val(newIndex + 1);
    });

    $(document).on('click', '.remove-other-name[data-person="beneficiary"]', function() {
        $(this).closest('.other-name-item').remove();
    });

    // Show/hide intended address section
    $('#beneficiary_intended_address_same').on('change', function() {
        if ($(this).is(':checked')) {
            $('#beneficiary_intended_address_section').slideUp();
        } else {
            $('#beneficiary_intended_address_section').slideDown();
        }
    });

    // Show/hide US entry details
    $('input[name="beneficiary_ever_in_us"]').on('change', function() {
        if ($(this).val() === 'yes') {
            $('#beneficiary_entry_section').slideDown();
        } else {
            $('#beneficiary_entry_section').slideUp();
            $('#beneficiary_entry_section input').val('');
        }
    });

    // Show/hide immigration proceedings details
    $('input[name="beneficiary_immigration_proceedings"]').on('change', function() {
        if ($(this).val() === 'yes') {
            $('#beneficiary_proceedings_section').slideDown();
        } else {
            $('#beneficiary_proceedings_section').slideUp();
            $('#beneficiary_proceedings_section input, #beneficiary_proceedings_section select').val('');
            $('#beneficiary_proceedings_section input[type="checkbox"]').prop('checked', false);
        }
    });

    // Format SSN for beneficiary
    $(document).on('input', '#beneficiary_ssn', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 9) value = value.substring(0, 9);
        
        if (value.length >= 5) {
            this.value = value.substring(0, 3) + '-' + value.substring(3, 5) + '-' + value.substring(5);
        } else if (value.length >= 3) {
            this.value = value.substring(0, 3) + '-' + value.substring(3);
        } else {
            this.value = value;
        }
    });
});
</script>

<script>
$(document).ready(function() {
    
    // Show/hide physical address
    $('input[name="beneficiary_same_address"]').on('change', function() {
        if ($(this).val() == '0') {
            $('#beneficiary_physical_address_section').slideDown();
        } else {
            $('#beneficiary_physical_address_section').slideUp();
        }
    });

    // Handle Present checkbox
    $(document).on('change', '.present-checkbox', function() {
        const targetId = $(this).data('target');
        const targetField = $(targetId);
        const hiddenFieldName = targetField.attr('name').replace('[date_to]', '[is_present]');
        
        if ($(this).is(':checked')) {
            targetField.val('Present').prop('readonly', true).addClass('bg-light');
            
            // Add hidden field
            let hiddenField = $('input[name="' + hiddenFieldName + '"]');
            if (hiddenField.length === 0) {
                targetField.after('<input type="hidden" name="' + hiddenFieldName + '" value="1" class="present-hidden-field">');
            } else {
                hiddenField.val('1');
            }
        } else {
            targetField.val('').prop('readonly', false).removeClass('bg-light');
            $('input[name="' + hiddenFieldName + '"]').remove();
        }
    });

    // Initialize on page load
    $('.present-checkbox:checked').each(function() {
        const targetId = $(this).data('target');
        const targetField = $(targetId);
        const hiddenFieldName = targetField.attr('name').replace('[date_to]', '[is_present]');
        
        targetField.val('Present').prop('readonly', true).addClass('bg-light');
        
        if ($('input[name="' + hiddenFieldName + '"]').length === 0) {
            targetField.after('<input type="hidden" name="' + hiddenFieldName + '" value="1" class="present-hidden-field">');
        }
    });

    $('#simplifiedSpouseVisaForm').on('submit', function() {
        $('.present-checkbox:checked').each(function() {
            const targetInput = $($(this).data('target'));
            targetInput.prop('disabled', false);
        });
    });

    // Add address history
    $('#addBeneficiaryAddress').on('click', function() {
        const count = parseInt($('#beneficiary_address_history_count').val());
        const newIndex = count;
        
        const countryOptions = @json(getAllCountry());
        let countryOptionsHtml = '';
        for (const [code, name] of Object.entries(countryOptions)) {
            countryOptionsHtml += `<option value="${code}">${name}</option>`;
        }
        
        const html = `
            <div class="card mb-3 address-history-item" data-index="${newIndex}">
                <div class="card-header bg-light d-flex justify-content-between">
                    <strong>Previous Address ${newIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-address" data-index="${newIndex}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label>Street Address</label>
                                <input type="text" name="beneficiary_address_history[${newIndex}][address]" 
                                    class="form-control" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Apt/Suite/Floor</label>
                                <div class="apt-suite-floor-component" data-target-field="beneficiary_address_history[${newIndex}][apt]">
                                    <div class="d-flex gap-3 mb-2">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input apt-type-checkbox" value="Apt">
                                            <label class="form-check-label">Apt.</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input apt-type-checkbox" value="Ste">
                                            <label class="form-check-label">Ste.</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input apt-type-checkbox" value="Flr">
                                            <label class="form-check-label">Flr.</label>
                                        </div>
                                    </div>
                                    <div class="apt-number-container" style="display: none;">
                                        <input type="text" class="form-control apt-number-input" 
                                            placeholder="Enter number (max 6 chars)" maxlength="6" style="max-width: 150px;">
                                        <small class="form-text text-muted">Letters and numbers only, no spaces</small>
                                    </div>
                                </div>
                                <input type="hidden" name="beneficiary_address_history[${newIndex}][apt]">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>City</label>
                                <input type="text" name="beneficiary_address_history[${newIndex}][city]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Country</label>
                                <select name="beneficiary_address_history[${newIndex}][country]" class="form-control">
                                    ${countryOptionsHtml}
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>State/Province</label>
                                <input type="text" name="beneficiary_address_history[${newIndex}][state]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Postal Code</label>
                                <input type="text" name="beneficiary_address_history[${newIndex}][zip]" 
                                    class="form-control" maxlength="20">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Date From</label>
                                <input type="text" name="beneficiary_address_history[${newIndex}][date_from]" 
                                    class="form-control datePicker" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Date To</label>
                                <input type="text" name="beneficiary_address_history[${newIndex}][date_to]" 
                                    class="form-control datePicker" placeholder="MM/DD/YYYY"
                                    id="beneficiary_addr_date_to_${newIndex}">
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input present-checkbox" 
                                        id="beneficiary_addr_present_${newIndex}"
                                        data-target="#beneficiary_addr_date_to_${newIndex}">
                                    <label class="form-check-label" for="beneficiary_addr_present_${newIndex}">
                                        Present
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#beneficiary_address_history_container').append(html);
        $('#beneficiary_address_history_count').val(newIndex + 1);
        
        if (window.initAptComponents) {
        window.initAptComponents();
    }
        
        $('.datePicker').datepicker({ format: 'mm/dd/yyyy', autoclose: true });
    });

    $(document).on('click', '.remove-address', function() {
        $(this).closest('.address-history-item').remove();
    });

    // Add employment history
    $('#addBeneficiaryEmployment').on('click', function() {
        const count = parseInt($('#beneficiary_employment_history_count').val());
        const newIndex = count;
        
        const html = `
            <div class="card mb-3 employment-history-item" data-index="${newIndex}">
                <div class="card-header bg-light d-flex justify-content-between">
                    <strong>Employment ${newIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-employment" data-index="${newIndex}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Employer Name</label>
                                <input type="text" name="beneficiary_employment_history[${newIndex}][employer]" 
                                    class="form-control" placeholder="Company name or 'Unemployed'" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Occupation</label>
                                <input type="text" name="beneficiary_employment_history[${newIndex}][occupation]" 
                                    class="form-control" placeholder="Job title or 'N/A'" maxlength="100">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Employer Address</label>
                                <input type="text" name="beneficiary_employment_history[${newIndex}][address]" 
                                    class="form-control" placeholder="Full address or 'N/A' for unemployment" maxlength="200">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Date From</label>
                                <input type="text" name="beneficiary_employment_history[${newIndex}][date_from]" 
                                    class="form-control datePicker" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Date To</label>
                                <input type="text" name="beneficiary_employment_history[${newIndex}][date_to]" 
                                    class="form-control datePicker" placeholder="MM/DD/YYYY"
                                    id="beneficiary_emp_date_to_${newIndex}">
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input present-checkbox" 
                                        id="beneficiary_emp_present_${newIndex}"
                                        data-target="#beneficiary_emp_date_to_${newIndex}">
                                    <label class="form-check-label" for="beneficiary_emp_present_${newIndex}">
                                        Present (Currently working here)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#beneficiary_employment_history_container').append(html);
        $('#beneficiary_employment_history_count').val(newIndex + 1);
        
        $('.datePicker').datepicker({ format: 'mm/dd/yyyy', autoclose: true });
    });

    $(document).on('click', '.remove-employment', function() {
        $(this).closest('.employment-history-item').remove();
    });

    // Handle "Does Not Apply" checkboxes for passport and alien number
    $(document).on('change', '.does-not-apply-checkbox', function() {
        const targetId = $(this).data('target');
        const targetField = $(targetId);
        
        if ($(this).is(':checked')) {
            targetField.data('original-value', targetField.val());
            targetField.val('N/A').prop('readonly', true).addClass('bg-light');
        } else {
            const originalValue = targetField.data('original-value') || '';
            targetField.val(originalValue).prop('readonly', false).removeClass('bg-light');
        }
    });
    
    // Initialize on page load
    $('.does-not-apply-checkbox:checked').each(function() {
        const targetId = $(this).data('target');
        const targetField = $(targetId);
        targetField.val('N/A').prop('readonly', true).addClass('bg-light');
    });
});

// ============================================
// BENEFICIARY PARENTS (Multiple entries)
// ============================================

// Add beneficiary parent
$('#addBeneficiaryParent').on('click', function() {
    const count = parseInt($('#beneficiary_parents_count').val());
    const newIndex = count;
    
    const countryOptions = @json(getAllCountry());
    let countryOptionsHtml = '<option value="">-Select Country-</option>';
    for (const [code, name] of Object.entries(countryOptions)) {
        countryOptionsHtml += `<option value="${code}">${name}</option>`;
    }
    
    const html = `
        <div class="card mb-3 parent-item" data-index="${newIndex}">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <strong>Person ${newIndex + 1}</strong>
                <button type="button" class="btn btn-sm btn-danger remove-parent" 
                    data-person="beneficiary" data-index="${newIndex}">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" name="beneficiary_parents_list[${newIndex}][first_name]" 
                                class="form-control" maxlength="50" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>Middle Name</label>
                            <input type="text" name="beneficiary_parents_list[${newIndex}][middle_name]" 
                                class="form-control" maxlength="50">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" name="beneficiary_parents_list[${newIndex}][last_name]" 
                                class="form-control" maxlength="50" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-3">
                            <label>Relationship <span class="text-danger">*</span></label>
                            <input type="text" name="beneficiary_parents_list[${newIndex}][relationship]" 
                                class="form-control" placeholder="e.g., Mother, Father" 
                                maxlength="50" required>
                            <small class="form-text text-muted">Mother, Father, Adoptive Parent, etc.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Date of Birth <span class="text-danger">*</span></label>
                            <input type="text" name="beneficiary_parents_list[${newIndex}][dob]" 
                                class="form-control datePicker" placeholder="MM/DD/YYYY" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label>Country of Birth <span class="text-danger">*</span></label>
                            <select name="beneficiary_parents_list[${newIndex}][country]" 
                                class="form-control" required>
                                ${countryOptionsHtml}
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    $('#beneficiary_parents_container').append(html);
    $('#beneficiary_parents_count').val(newIndex + 1);
    
    // Reinitialize datepickers
    $('.datePicker').datepicker({ format: 'mm/dd/yyyy', autoclose: true });
});

// Remove beneficiary parent
$(document).on('click', '.remove-parent[data-person="beneficiary"]', function() {
    const parentCount = $('.parent-item').length;
    
    // Require at least 2 parents
    if (parentCount <= 2) {
        alert('You must have at least 2 parents listed.');
        return;
    }
    
    $(this).closest('.parent-item').remove();
});
</script>