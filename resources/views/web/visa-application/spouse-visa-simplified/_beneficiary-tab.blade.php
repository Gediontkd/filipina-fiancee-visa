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
                <div class="input-group">
                    {{ Form::text('beneficiary_mailing_date_to', optional($application)->beneficiary_mailing_date_to ? optional($application)->beneficiary_mailing_date_to->format('m/d/Y') : '', [
                        'class' => 'form-control datePicker',
                        'placeholder' => 'MM/DD/YYYY',
                        'required' => true,
                        'id' => 'beneficiary_mailing_date_to'
                    ]) }}
                    <button type="button" class="btn btn-outline-secondary" id="setBeneficiaryMailingPresent">Present</button>
                </div>
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
                                    <input type="text" name="beneficiary_address_history[{{ $index }}][date_to]" 
                                        class="form-control datePicker" value="{{ $address['date_to'] ?? '' }}" 
                                        placeholder="MM/DD/YYYY">
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
                                    <div class="input-group">
                                        <input type="text" name="beneficiary_employment_history[{{ $index }}][date_to]" 
                                            class="form-control datePicker employment-date-to" 
                                            value="{{ $job['date_to'] ?? '' }}" 
                                            placeholder="MM/DD/YYYY">
                                        <button type="button" class="btn btn-outline-secondary set-employment-present">Present</button>
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

    <!-- Parents Information -->
    <h5 class="mb-3 mt-4"><i class="fa fa-users me-2"></i>Beneficiary's Parents Information</h5>
    <p class="text-muted">Provide information about the beneficiary's biological or adoptive parents</p>
    
    <!-- Parent 1 -->
    <div class="card mb-3">
        <div class="card-header bg-light">
            <strong>Parent 1</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_parent1_first_name', 'First Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('beneficiary_parent1_first_name', optional($application)->beneficiary_parent1_first_name ?? '', [
                            'class' => 'form-control',
                            'required' => true,
                            'maxlength' => 50
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_parent1_middle_name', 'Middle Name') }}
                        {{ Form::text('beneficiary_parent1_middle_name', optional($application)->beneficiary_parent1_middle_name ?? '', [
                            'class' => 'form-control',
                            'maxlength' => 50
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_parent1_last_name', 'Last Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('beneficiary_parent1_last_name', optional($application)->beneficiary_parent1_last_name ?? '', [
                            'class' => 'form-control',
                            'required' => true,
                            'maxlength' => 50
                        ]) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_parent1_dob', 'Date of Birth') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('beneficiary_parent1_dob', optional($application)->beneficiary_parent1_dob ? optional($application)->beneficiary_parent1_dob->format('m/d/Y') : '', [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'MM/DD/YYYY',
                            'required' => true
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_parent1_sex', 'Sex') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('beneficiary_parent1_sex', [
                            '' => '-Select-',
                            'Male' => 'Male',
                            'Female' => 'Female'
                        ], optional($application)->beneficiary_parent1_sex ?? '', [
                            'class' => 'form-control',
                            'required' => true
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_parent1_country', 'Country of Birth') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('beneficiary_parent1_country', getAllCountry(), optional($application)->beneficiary_parent1_country ?? '', [
                            'class' => 'form-control',
                            'required' => true
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Parent 2 -->
    <div class="card mb-3">
        <div class="card-header bg-light">
            <strong>Parent 2</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_parent2_first_name', 'First Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('beneficiary_parent2_first_name', optional($application)->beneficiary_parent2_first_name ?? '', [
                            'class' => 'form-control',
                            'required' => true,
                            'maxlength' => 50
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_parent2_middle_name', 'Middle Name') }}
                        {{ Form::text('beneficiary_parent2_middle_name', optional($application)->beneficiary_parent2_middle_name ?? '', [
                            'class' => 'form-control',
                            'maxlength' => 50
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_parent2_last_name', 'Last Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('beneficiary_parent2_last_name', optional($application)->beneficiary_parent2_last_name ?? '', [
                            'class' => 'form-control',
                            'required' => true,
                            'maxlength' => 50
                        ]) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_parent2_dob', 'Date of Birth') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('beneficiary_parent2_dob', optional($application)->beneficiary_parent2_dob ? optional($application)->beneficiary_parent2_dob->format('m/d/Y') : '', [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'MM/DD/YYYY',
                            'required' => true
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_parent2_sex', 'Sex') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('beneficiary_parent2_sex', [
                            '' => '-Select-',
                            'Male' => 'Male',
                            'Female' => 'Female'
                        ], optional($application)->beneficiary_parent2_sex ?? '', [
                            'class' => 'form-control',
                            'required' => true
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('beneficiary_parent2_country', 'Country of Birth') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('beneficiary_parent2_country', getAllCountry(), optional($application)->beneficiary_parent2_country ?? '', [
                            'class' => 'form-control',
                            'required' => true
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Employment Information - OPTIONAL for beneficiary -->
    <h5 class="mb-3 mt-4"><i class="fa fa-briefcase me-2"></i>Current Employment Information (Optional)</h5>
    <div class="row">
        <div class="col-md-6">
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
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_occupation', 'Occupation/Job Title') }}
                {{ Form::text('beneficiary_occupation', optional($application)->beneficiary_occupation ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Job title (if employed)',
                    'maxlength' => 100
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_employer_name', 'Employer Name') }}
                {{ Form::text('beneficiary_employer_name', optional($application)->beneficiary_employer_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Company name (if employed)',
                    'maxlength' => 100
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
    // Show/hide physical address
    $('input[name="beneficiary_same_address"]').on('change', function() {
        if ($(this).val() == '0') {
            $('#beneficiary_physical_address_section').slideDown();
        } else {
            $('#beneficiary_physical_address_section').slideUp();
        }
    });

    // Set mailing date to Present
    $('#setBeneficiaryMailingPresent').on('click', function() {
        $('#beneficiary_mailing_date_to').val('Present');
    });

    // Add address history with apt/suite/floor component
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
                    <button type="button" class="btn btn-sm btn-danger remove-address" data-person="beneficiary" data-index="${newIndex}">
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
                                <div class="d-flex gap-3 mb-2 apt-checkboxes" data-target="beneficiary_address_history_${newIndex}_apt">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input apt-type-checkbox" 
                                            id="beneficiary_addr_${newIndex}_apt" value="Apt">
                                        <label class="form-check-label" for="beneficiary_addr_${newIndex}_apt">Apt.</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input apt-type-checkbox" 
                                            id="beneficiary_addr_${newIndex}_ste" value="Ste">
                                        <label class="form-check-label" for="beneficiary_addr_${newIndex}_ste">Ste.</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input apt-type-checkbox" 
                                            id="beneficiary_addr_${newIndex}_flr" value="Flr">
                                        <label class="form-check-label" for="beneficiary_addr_${newIndex}_flr">Flr.</label>
                                    </div>
                                </div>
                                <div class="apt-number-container" id="beneficiary_addr_${newIndex}_container" style="display: none;">
                                    <input type="text" class="form-control apt-number-input" 
                                        id="beneficiary_addr_${newIndex}_number" 
                                        placeholder="Enter number (max 6 chars)" 
                                        maxlength="6" style="max-width: 150px;">
                                    <small class="form-text text-muted">Letters and numbers only, no spaces</small>
                                </div>
                                <input type="hidden" name="beneficiary_address_history[${newIndex}][apt]" 
                                    id="beneficiary_addr_${newIndex}_hidden">
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
                                    class="form-control datePicker" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#beneficiary_address_history_container').append(html);
        $('#beneficiary_address_history_count').val(newIndex + 1);
        
        // Initialize apt/suite/floor component for new entry
        initDynamicAptComponent(newIndex, 'beneficiary');
        
        // Reinitialize datepicker
        $('.datePicker').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true
        });

        if (typeof window.reinitializeCityAutoFill === 'function') {
            window.reinitializeCityAutoFill('beneficiary');
        }
    });

    // Remove address
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
                    <button type="button" class="btn btn-sm btn-danger remove-employment" data-person="beneficiary" data-index="${newIndex}">
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
                                <div class="input-group">
                                    <input type="text" name="beneficiary_employment_history[${newIndex}][date_to]" 
                                        class="form-control datePicker employment-date-to" placeholder="MM/DD/YYYY">
                                    <button type="button" class="btn btn-outline-secondary set-employment-present">Present</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#beneficiary_employment_history_container').append(html);
        $('#beneficiary_employment_history_count').val(newIndex + 1);
        
        // Reinitialize datepicker
        $('.datePicker').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true
        });
    });

    // Remove employment
    $(document).on('click', '.remove-employment', function() {
        $(this).closest('.employment-history-item').remove();
    });

    // Set employment date to Present
    $(document).on('click', '.set-employment-present', function() {
        $(this).siblings('.employment-date-to').val('Present');
    });

    // Handle "Does Not Apply" checkboxes for passport and alien number
    $(document).on('change', '.does-not-apply-checkbox', function() {
        const target = $(this).data('target');
        if ($(this).is(':checked')) {
            $(target).val('N/A').prop('readonly', true);
        } else {
            $(target).val('').prop('readonly', false);
        }
    });
});

// Function to initialize apt/suite/floor for dynamically added entries
function initDynamicAptComponent(index, person) {
    const uniqueId = person + '_address_history_' + index + '_apt';
    const container = document.querySelector('[data-target="' + uniqueId + '"]');
    
    if (!container) return;
    
    const checkboxes = container.querySelectorAll('.apt-type-checkbox');
    const numberContainer = document.getElementById(person + '_addr_' + index + '_container');
    const numberInput = document.getElementById(person + '_addr_' + index + '_number');
    const hiddenInput = document.getElementById(person + '_addr_' + index + '_hidden');
    
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                checkboxes.forEach(cb => {
                    if (cb !== this) cb.checked = false;
                });
                numberContainer.style.display = 'block';
                numberInput.focus();
            } else {
                const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
                if (!anyChecked) {
                    numberContainer.style.display = 'none';
                    numberInput.value = '';
                    hiddenInput.value = '';
                }
            }
            updateValue();
        });
    });
    
    numberInput.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z0-9]/g, '');
        if (this.value.length > 6) {
            this.value = this.value.substring(0, 6);
        }
        updateValue();
    });
    
    numberInput.addEventListener('paste', function(e) {
        e.preventDefault();
        const pastedText = (e.clipboardData || window.clipboardData).getData('text');
        const cleanedText = pastedText.replace(/[^A-Za-z0-9]/g, '').substring(0, 6);
        this.value = cleanedText;
        updateValue();
    });
    
    numberInput.addEventListener('keypress', function(e) {
        const char = String.fromCharCode(e.which);
        if (!/[A-Za-z0-9]/.test(char)) {
            e.preventDefault();
        }
    });
    
    function updateValue() {
        const selectedCheckbox = Array.from(checkboxes).find(cb => cb.checked);
        const numberValue = numberInput.value.trim();
        
        if (selectedCheckbox && numberValue) {
            hiddenInput.value = selectedCheckbox.value + ':' + numberValue;
        } else {
            hiddenInput.value = '';
        }
    }
}
</script>