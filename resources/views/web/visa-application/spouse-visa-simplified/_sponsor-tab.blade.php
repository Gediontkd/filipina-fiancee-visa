{{-- FILE: resources/views/web/visa-application/spouse-visa-simplified/_sponsor-tab.blade.php --}}

<div class="sponsor-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-user me-2 text-primary"></i>U.S. Sponsor Information
    </h4>
    <p class="text-muted mb-4">Enter information about the U.S. citizen sponsor (petitioner)</p>

    <!-- Personal Information -->
    <h5 class="mb-3"><i class="fa fa-id-card me-2"></i>Personal Information</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_first_name', 'First Name') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_first_name', optional($application)->sponsor_first_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter first name',
                    'required' => true,
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_middle_name', 'Middle Name') }}
                {{ Form::text('sponsor_middle_name', optional($application)->sponsor_middle_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Middle name (optional)',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_last_name', 'Last Name') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_last_name', optional($application)->sponsor_last_name ?? '', [
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
                {{ Form::label('sponsor_dob', 'Date of Birth') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_dob', optional($application)->sponsor_dob ? optional($application)->sponsor_dob->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_sex', 'Sex') }}
                <span class="text-danger">*</span>
                {{ Form::select('sponsor_sex', [
                    '' => '-Select-',
                    'Male' => 'Male',
                    'Female' => 'Female'
                ], optional($application)->sponsor_sex ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_place_of_birth', 'Place of Birth (City, Country)') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_place_of_birth', optional($application)->sponsor_place_of_birth ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'e.g., New York, USA',
                    'required' => true,
                    'maxlength' => 100
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_citizenship', 'Citizenship') }}
                <span class="text-danger">*</span>
                {{ Form::select('sponsor_citizenship', [
                    '' => '-Select Citizenship-',
                    'U.S. Citizen' => 'U.S. Citizen',
                    'U.S. National' => 'U.S. National'
                ], optional($application)->sponsor_citizenship ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_ssn', 'Social Security Number') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_ssn', optional($application)->sponsor_ssn ?? '', [
                    'class' => 'form-control ssn-format',
                    'placeholder' => '###-##-####',
                    'required' => true,
                    'pattern' => '\d{3}-\d{2}-\d{4}',
                    'maxlength' => 11
                ]) }}
            </div>
        </div>
    </div>

    <!-- Contact Information -->
    <h5 class="mb-3 mt-4"><i class="fa fa-phone me-2"></i>Contact Information</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_email', 'Email Address') }}
                <span class="text-danger">*</span>
                {{ Form::email('sponsor_email', optional($application)->sponsor_email ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'sponsor@example.com',
                    'required' => true,
                    'maxlength' => 100
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_phone', 'Phone Number') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_phone', optional($application)->sponsor_phone ?? '', [
                    'class' => 'form-control phone-format',
                    'placeholder' => '(###) ###-####',
                    'required' => true,
                    'pattern' => '\(\d{3}\) \d{3}-\d{4}',
                    'maxlength' => 14
                ]) }}
                <small class="form-text text-muted">Format: (###) ###-####</small>
            </div>
        </div>
    </div>

    <!-- Mailing Address -->
    <h5 class="mb-3 mt-4"><i class="fa fa-envelope me-2"></i>Mailing Address</h5>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_mailing_address', 'Street Address') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_mailing_address', optional($application)->sponsor_mailing_address ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '123 Main Street',
                    'required' => true,
                    'maxlength' => 100
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            @include('components.apt-suite-floor', [
                'name' => 'sponsor_mailing_apt',
                'value' => optional($application)->sponsor_mailing_apt,
                'required' => false
            ])
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_mailing_city', 'City') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_mailing_city', optional($application)->sponsor_mailing_city ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter city',
                    'required' => true,
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_mailing_state', 'State') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_mailing_state', optional($application)->sponsor_mailing_state ?? '', [
                    'class' => 'form-control state-format',
                    'placeholder' => 'CA',
                    'required' => true,
                    'pattern' => '[A-Z]{2}',
                    'maxlength' => 2,
                    'style' => 'text-transform: uppercase;'
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_mailing_zip', 'ZIP Code') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_mailing_zip', optional($application)->sponsor_mailing_zip ?? '', [
                    'class' => 'form-control zip-format',
                    'placeholder' => '12345 or 12345-6789',
                    'required' => true,
                    'pattern' => '\d{5}(-\d{4})?',
                    'maxlength' => 10
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_mailing_date_from', 'Date From') }}
                <span class="text-danger">*</span>
                {{ Form::text(
                    'sponsor_mailing_date_from',
                    optional($application)->sponsor_mailing_date_from
                        ? \Carbon\Carbon::parse($application->sponsor_mailing_date_from)->format('m/d/Y')
                        : '',
                    ['class' => 'form-control datePicker', 'placeholder' => 'MM/DD/YYYY', 'required' => true]
                ) }}
            </div>
        </div>
        <div class="col-md-6">
    <div class="form-group mb-3">
        {{ Form::label('sponsor_mailing_date_to', 'Date To') }}
        <span class="text-danger">*</span>
        
        {{-- Display field showing PRESENT --}}
        <div class="form-control" style="background-color: #e9ecef; cursor: default;">
            PRESENT
        </div>
        
        {{-- Hidden date field (empty, not used) --}}
        {{ Form::hidden('sponsor_mailing_date_to', '') }}
        
        {{-- Hidden checkbox that's always checked - this tells backend to save "Present" --}}
        {{ Form::hidden('sponsor_mailing_present', 1) }}
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
                        {{ Form::radio('sponsor_same_address', 1, 
                            optional($application)->sponsor_same_address ?? true, [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_same_yes'
                        ]) }}
                        <label class="form-check-label" for="sponsor_same_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('sponsor_same_address', 0, 
                            optional($application)->sponsor_same_address === false, [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_same_no'
                        ]) }}
                        <label class="form-check-label" for="sponsor_same_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Physical Address (shown if different) -->
    <div id="sponsor_physical_address_section" 
        style="display: {{ optional($application)->sponsor_same_address === false ? 'block' : 'none' }};">
        <h5 class="mb-3"><i class="fa fa-home me-2"></i>Physical Address</h5>
        <div class="row">
            <div class="col-md-8">
                <div class="form-group mb-3">
                    {{ Form::label('sponsor_address', 'Street Address') }}
                    {{ Form::text('sponsor_address', optional($application)->sponsor_address ?? '', [
                        'class' => 'form-control',
                        'placeholder' => '123 Main Street',
                        'maxlength' => 100
                    ]) }}
                </div>
            </div>
            <div class="col-md-4">
                @include('components.apt-suite-floor', [
                    'name' => 'sponsor_apt',
                    'value' => optional($application)->sponsor_apt,
                    'required' => false
                ])
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-4">
                <div class="form-group mb-3">
                    {{ Form::label('sponsor_city', 'City') }}
                    {{ Form::text('sponsor_city', optional($application)->sponsor_city ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter city',
                        'maxlength' => 50
                    ]) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group mb-3">
                    {{ Form::label('sponsor_state', 'State') }}
                    {{ Form::text('sponsor_state', optional($application)->sponsor_state ?? '', [
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
                    {{ Form::label('sponsor_zip', 'ZIP Code') }}
                    {{ Form::text('sponsor_zip', optional($application)->sponsor_zip ?? '', [
                        'class' => 'form-control zip-format',
                        'placeholder' => '12345 or 12345-6789',
                        'pattern' => '\d{5}(-\d{4})?',
                        'maxlength' => 10
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

    <div id="sponsor_address_history_container">
        @php
            $addressHistory = optional($application)->sponsor_address_history ?? [];
        @endphp
        
        @if(empty($addressHistory))
            <input type="hidden" name="sponsor_address_history_count" value="0" id="sponsor_address_history_count">
        @else
            @foreach($addressHistory as $index => $address)
                <div class="card mb-3 address-history-item" data-index="{{ $index }}">
                    <div class="card-header bg-light d-flex justify-content-between">
                        <strong>Previous Address {{ $index + 1 }}</strong>
                        <button type="button" class="btn btn-sm btn-danger remove-address" data-person="sponsor" data-index="{{ $index }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label>Street Address</label>
                                    <input type="text" name="sponsor_address_history[{{ $index }}][address]" 
                                        class="form-control" value="{{ $address['address'] ?? '' }}" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-4">
                                @include('components.apt-suite-floor', [
                                    'name' => "sponsor_address_history[{$index}][apt]",
                                    'value' => $address['apt'] ?? '',
                                    'required' => false
                                ])
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>City</label>
                                    <input type="text" name="sponsor_address_history[{{ $index }}][city]" 
                                        class="form-control" value="{{ $address['city'] ?? '' }}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>State</label>
                                    <input type="text" name="sponsor_address_history[{{ $index }}][state]" 
                                        class="form-control state-format" value="{{ $address['state'] ?? '' }}" 
                                        maxlength="2" pattern="[A-Z]{2}" style="text-transform: uppercase;">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>ZIP Code</label>
                                    <input type="text" name="sponsor_address_history[{{ $index }}][zip]" 
                                        class="form-control zip-format" value="{{ $address['zip'] ?? '' }}" maxlength="10">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Date From</label>
                                    <input type="text" name="sponsor_address_history[{{ $index }}][date_from]" 
                                        class="form-control datePicker" value="{{ $address['date_from'] ?? '' }}" 
                                        placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Date To</label>
                                    @php
                                        $addrDateTo = $address['date_to'] ?? '';
                                        $isAddrPresent = ($addrDateTo === 'Present' || $addrDateTo === 'present');
                                    @endphp
                                    <input type="text" 
                                        name="sponsor_address_history[{{ $index }}][date_to]" 
                                        class="form-control datePicker addr-date-to" 
                                        value="{{ $isAddrPresent ? '' : $addrDateTo }}" 
                                        placeholder="MM/DD/YYYY"
                                        id="sponsor_addr_date_to_{{ $index }}"
                                        {{ $isAddrPresent ? 'disabled' : '' }}>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" 
                                            class="form-check-input present-checkbox" 
                                            id="sponsor_addr_present_{{ $index }}"
                                            data-target="#sponsor_addr_date_to_{{ $index }}"
                                            {{ $isAddrPresent ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sponsor_addr_present_{{ $index }}">
                                            Present
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <input type="hidden" name="sponsor_address_history_count" value="{{ count($addressHistory) }}" id="sponsor_address_history_count">
        @endif
    </div>

    <button type="button" class="btn btn-outline-primary mb-4" id="addSponsorAddress">
        <i class="fa fa-plus me-2"></i>Add Previous Address
    </button>

    <div id="sponsor_address_coverage_warning" class="alert alert-warning" style="display: none;">
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

    <div id="sponsor_employment_history_container">
        @php
            $employmentHistory = optional($application)->sponsor_employment_history ?? [];
        @endphp
        
        @if(empty($employmentHistory))
            <input type="hidden" name="sponsor_employment_history_count" value="0" id="sponsor_employment_history_count">
        @else
            @foreach($employmentHistory as $index => $job)
                <div class="card mb-3 employment-history-item" data-index="{{ $index }}">
                    <div class="card-header bg-light d-flex justify-content-between">
                        <strong>Employment {{ $index + 1 }}</strong>
                        <button type="button" class="btn btn-sm btn-danger remove-employment" data-person="sponsor" data-index="{{ $index }}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Employer Name</label>
                                    <input type="text" name="sponsor_employment_history[{{ $index }}][employer]" 
                                        class="form-control" value="{{ $job['employer'] ?? '' }}" 
                                        placeholder="Company name or 'Unemployed'" maxlength="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Occupation</label>
                                    <input type="text" name="sponsor_employment_history[{{ $index }}][occupation]" 
                                        class="form-control" value="{{ $job['occupation'] ?? '' }}" 
                                        placeholder="Job title or 'N/A'" maxlength="100">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label>Employer Address</label>
                                    <input type="text" name="sponsor_employment_history[{{ $index }}][address]" 
                                        class="form-control" value="{{ $job['address'] ?? '' }}" 
                                        placeholder="Full address or 'N/A' for unemployment" maxlength="200">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Date From</label>
                                    <input type="text" name="sponsor_employment_history[{{ $index }}][date_from]" 
                                        class="form-control datePicker" value="{{ $job['date_from'] ?? '' }}" 
                                        placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label>Date To</label>
                                    @php
                                        $empDateTo = $job['date_to'] ?? '';
                                        $isEmpPresent = ($empDateTo === 'Present' || $empDateTo === 'present');
                                    @endphp
                                    <input type="text" 
                                        name="sponsor_employment_history[{{ $index }}][date_to]" 
                                        class="form-control datePicker employment-date-to" 
                                        value="{{ $isEmpPresent ? '' : $empDateTo }}" 
                                        placeholder="MM/DD/YYYY"
                                        id="sponsor_emp_date_to_{{ $index }}"
                                        {{ $isEmpPresent ? 'disabled' : '' }}>
                                    <div class="form-check mt-2">
                                        <input type="checkbox" 
                                            class="form-check-input present-checkbox" 
                                            id="sponsor_emp_present_{{ $index }}"
                                            data-target="#sponsor_emp_date_to_{{ $index }}"
                                            {{ $isEmpPresent ? 'checked' : '' }}>
                                        <label class="form-check-label" for="sponsor_emp_present_{{ $index }}">
                                            Present (Currently working here)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <input type="hidden" name="sponsor_employment_history_count" value="{{ count($employmentHistory) }}" id="sponsor_employment_history_count">
        @endif
    </div>

    <button type="button" class="btn btn-outline-primary mb-4" id="addSponsorEmployment">
        <i class="fa fa-plus me-2"></i>Add Employment Period
    </button>

    <div id="sponsor_employment_coverage_warning" class="alert alert-warning" style="display: none;">
        <i class="fa fa-exclamation-triangle me-2"></i>
        <strong>Incomplete:</strong> Your employment history must cover at least five full years.
    </div>

    <div id="sponsor_unemployment_reminder" class="alert alert-warning" style="display: none;">
        <i class="fa fa-exclamation-triangle me-2"></i>
        <strong>Reminder:</strong> If you are currently unemployed, USCIS may issue a Request for Evidence (RFE) 
        asking how you intend to financially support your spouse. You can avoid delays by ensuring your income 
        situation is clearly documented later in the process.
    </div>

    <!-- Parents Information (I-130 Items 25-35) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-users me-2"></i>Parents Information</h5>
    <p class="text-muted">Provide information about your biological or adoptive parents</p>
    
    <!-- Parent 1 -->
    <div class="card mb-3">
        <div class="card-header bg-light">
            <strong>Parent 1</strong>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent1_first_name', 'First Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('sponsor_parent1_first_name', optional($application)->sponsor_parent1_first_name ?? '', [
                            'class' => 'form-control',
                            'required' => true,
                            'maxlength' => 50
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent1_middle_name', 'Middle Name') }}
                        {{ Form::text('sponsor_parent1_middle_name', optional($application)->sponsor_parent1_middle_name ?? '', [
                            'class' => 'form-control',
                            'maxlength' => 50
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent1_last_name', 'Last Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('sponsor_parent1_last_name', optional($application)->sponsor_parent1_last_name ?? '', [
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
                        {{ Form::label('sponsor_parent1_dob', 'Date of Birth') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('sponsor_parent1_dob', optional($application)->sponsor_parent1_dob ? optional($application)->sponsor_parent1_dob->format('m/d/Y') : '', [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'MM/DD/YYYY',
                            'required' => true
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent1_sex', 'Sex') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('sponsor_parent1_sex', [
                            '' => '-Select-',
                            'Male' => 'Male',
                            'Female' => 'Female'
                        ], optional($application)->sponsor_parent1_sex ?? '', [
                            'class' => 'form-control',
                            'required' => true
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent1_country', 'Country of Birth') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('sponsor_parent1_country', getAllCountry(), optional($application)->sponsor_parent1_country ?? '', [
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
                        {{ Form::label('sponsor_parent2_first_name', 'First Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('sponsor_parent2_first_name', optional($application)->sponsor_parent2_first_name ?? '', [
                            'class' => 'form-control',
                            'required' => true,
                            'maxlength' => 50
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent2_middle_name', 'Middle Name') }}
                        {{ Form::text('sponsor_parent2_middle_name', optional($application)->sponsor_parent2_middle_name ?? '', [
                            'class' => 'form-control',
                            'maxlength' => 50
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent2_last_name', 'Last Name') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('sponsor_parent2_last_name', optional($application)->sponsor_parent2_last_name ?? '', [
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
                        {{ Form::label('sponsor_parent2_dob', 'Date of Birth') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('sponsor_parent2_dob', optional($application)->sponsor_parent2_dob ? optional($application)->sponsor_parent2_dob->format('m/d/Y') : '', [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'MM/DD/YYYY',
                            'required' => true
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent2_sex', 'Sex') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('sponsor_parent2_sex', [
                            '' => '-Select-',
                            'Male' => 'Male',
                            'Female' => 'Female'
                        ], optional($application)->sponsor_parent2_sex ?? '', [
                            'class' => 'form-control',
                            'required' => true
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent2_country', 'Country of Birth') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('sponsor_parent2_country', getAllCountry(), optional($application)->sponsor_parent2_country ?? '', [
                            'class' => 'form-control',
                            'required' => true
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Employment Information - LOCKED until USCIS approval -->
    <h5 class="mb-3 mt-4"><i class="fa fa-briefcase me-2"></i>Employment Information</h5>
    <div class="alert alert-warning">
        <i class="fa fa-lock me-2"></i>
        <strong>Post-Approval Section:</strong> Financial and employment information will be needed after USCIS approval when preparing for the National Visa Center (NVC) stage. This section will unlock after you receive approval notice.
    </div>
    
    <div class="financial-locked-section" style="opacity: 0.5; pointer-events: none;">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    {{ Form::label('sponsor_employment_status', 'Employment Status') }}
                    {{ Form::select('sponsor_employment_status', [
                        '' => '-Select Status-',
                        'Employed' => 'Employed',
                        'Self-Employed' => 'Self-Employed',
                        'Unemployed' => 'Unemployed',
                        'Retired' => 'Retired',
                        'Student' => 'Student'
                    ], '', [
                        'class' => 'form-control',
                        'disabled' => true
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    {{ Form::label('sponsor_annual_income', 'Annual Income (USD)') }}
                    {{ Form::number('sponsor_annual_income', '', [
                        'class' => 'form-control',
                        'placeholder' => '50000',
                        'disabled' => true
                    ]) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-end mt-4">
        {{ Form::button('Next: Beneficiary Information <i class="fa fa-arrow-right ms-2"></i>', [
            'class' => 'btn btn-primary',
            'type' => 'button',
            'onclick' => '$(\'#beneficiary-tab\').tab(\'show\')'
        ]) }}
    </div>
</div>

<script>
$(document).ready(function() {
    // Format SSN as ###-##-####
    $(document).on('input', '.ssn-format', function() {
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

    // Format phone as (###) ###-####
    $(document).on('input', '.phone-format', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 10) value = value.substring(0, 10);
        
        if (value.length >= 6) {
            this.value = '(' + value.substring(0, 3) + ') ' + value.substring(3, 6) + '-' + value.substring(6);
        } else if (value.length >= 3) {
            this.value = '(' + value.substring(0, 3) + ') ' + value.substring(3);
        } else if (value.length > 0) {
            this.value = '(' + value;
        }
    });

    // Format ZIP code
    $(document).on('input', '.zip-format', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 9) value = value.substring(0, 9);
        
        if (value.length > 5) {
            this.value = value.substring(0, 5) + '-' + value.substring(5);
        } else {
            this.value = value;
        }
    });

    // Format state to uppercase
    $(document).on('input', '.state-format', function() {
        this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '');
    });

    // Show/hide physical address
    $('input[name="sponsor_same_address"]').on('change', function() {
        if ($(this).val() == '0') {
            $('#sponsor_physical_address_section').slideDown();
        } else {
            $('#sponsor_physical_address_section').slideUp();
        }
    });

    // FIXED: Handle Present checkbox for all date_to fields
    $(document).on('change', '.present-checkbox', function() {
        const targetInput = $($(this).data('target'));
        
        if ($(this).is(':checked')) {
            // Store current value before disabling
            targetInput.data('previous-value', targetInput.val());
            targetInput.val('Present').prop('disabled', true).prop('readonly', true);
        } else {
            // Restore previous value or clear
            const prevValue = targetInput.data('previous-value') || '';
            targetInput.val(prevValue).prop('disabled', false).prop('readonly', false);
        }
    });

    // Prevent form submission from changing Present value
    $('#simplifiedSpouseVisaForm').on('submit', function() {
        $('.present-checkbox:checked').each(function() {
            const targetInput = $($(this).data('target'));
            targetInput.prop('disabled', false);
        });
    });

    // Add address history with apt/suite/floor component
    $('#addSponsorAddress').on('click', function() {
        const count = parseInt($('#sponsor_address_history_count').val());
        const newIndex = count;
        
        const html = `
            <div class="card mb-3 address-history-item" data-index="${newIndex}">
                <div class="card-header bg-light d-flex justify-content-between">
                    <strong>Previous Address ${newIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-address" data-person="sponsor" data-index="${newIndex}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label>Street Address</label>
                                <input type="text" name="sponsor_address_history[${newIndex}][address]" 
                                    class="form-control" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Apt/Suite/Floor</label>
                                <div class="d-flex gap-3 mb-2 apt-checkboxes" data-target="sponsor_address_history_${newIndex}_apt">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input apt-type-checkbox" 
                                            id="sponsor_addr_${newIndex}_apt" value="Apt">
                                        <label class="form-check-label" for="sponsor_addr_${newIndex}_apt">Apt.</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input apt-type-checkbox" 
                                            id="sponsor_addr_${newIndex}_ste" value="Ste">
                                        <label class="form-check-label" for="sponsor_addr_${newIndex}_ste">Ste.</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input apt-type-checkbox" 
                                            id="sponsor_addr_${newIndex}_flr" value="Flr">
                                        <label class="form-check-label" for="sponsor_addr_${newIndex}_flr">Flr.</label>
                                    </div>
                                </div>
                                <div class="apt-number-container" id="sponsor_addr_${newIndex}_container" style="display: none;">
                                    <input type="text" class="form-control apt-number-input" 
                                        id="sponsor_addr_${newIndex}_number" 
                                        placeholder="Enter number (max 6 chars)" 
                                        maxlength="6" style="max-width: 150px;">
                                    <small class="form-text text-muted">Letters and numbers only, no spaces</small>
                                </div>
                                <input type="hidden" name="sponsor_address_history[${newIndex}][apt]" 
                                    id="sponsor_addr_${newIndex}_hidden">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>City</label>
                                <input type="text" name="sponsor_address_history[${newIndex}][city]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>State</label>
                                <input type="text" name="sponsor_address_history[${newIndex}][state]" 
                                    class="form-control state-format" maxlength="2" pattern="[A-Z]{2}" 
                                    style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>ZIP Code</label>
                                <input type="text" name="sponsor_address_history[${newIndex}][zip]" 
                                    class="form-control zip-format" maxlength="10">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Date From</label>
                                <input type="text" name="sponsor_address_history[${newIndex}][date_from]" 
                                    class="form-control datePicker" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Date To</label>
                                <input type="text" name="sponsor_address_history[${newIndex}][date_to]" 
                                    class="form-control datePicker addr-date-to" placeholder="MM/DD/YYYY"
                                    id="sponsor_addr_date_to_${newIndex}">
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input present-checkbox" 
                                        id="sponsor_addr_present_${newIndex}"
                                        data-target="#sponsor_addr_date_to_${newIndex}">
                                    <label class="form-check-label" for="sponsor_addr_present_${newIndex}">
                                        Present
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#sponsor_address_history_container').append(html);
        $('#sponsor_address_history_count').val(newIndex + 1);
        
        // Initialize apt/suite/floor component for new entry
        initDynamicAptComponent(newIndex, 'sponsor');
        
        // Reinitialize datepicker
        $('.datePicker').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true
        });

        if (typeof window.reinitializeCityAutoFill === 'function') {
            window.reinitializeCityAutoFill('sponsor');
        }
    });

    // Remove address
    $(document).on('click', '.remove-address', function() {
        $(this).closest('.address-history-item').remove();
    });

    // Add employment history
    $('#addSponsorEmployment').on('click', function() {
        const count = parseInt($('#sponsor_employment_history_count').val());
        const newIndex = count;
        
        const html = `
            <div class="card mb-3 employment-history-item" data-index="${newIndex}">
                <div class="card-header bg-light d-flex justify-content-between">
                    <strong>Employment ${newIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-employment" data-person="sponsor" data-index="${newIndex}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Employer Name</label>
                                <input type="text" name="sponsor_employment_history[${newIndex}][employer]" 
                                    class="form-control" placeholder="Company name or 'Unemployed'" maxlength="100">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Occupation</label>
                                <input type="text" name="sponsor_employment_history[${newIndex}][occupation]" 
                                    class="form-control" placeholder="Job title or 'N/A'" maxlength="100">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label>Employer Address</label>
                                <input type="text" name="sponsor_employment_history[${newIndex}][address]" 
                                    class="form-control" placeholder="Full address or 'N/A' for unemployment" maxlength="200">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Date From</label>
                                <input type="text" name="sponsor_employment_history[${newIndex}][date_from]" 
                                    class="form-control datePicker" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Date To</label>
                                <input type="text" name="sponsor_employment_history[${newIndex}][date_to]" 
                                    class="form-control datePicker employment-date-to" placeholder="MM/DD/YYYY"
                                    id="sponsor_emp_date_to_${newIndex}">
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input present-checkbox" 
                                        id="sponsor_emp_present_${newIndex}"
                                        data-target="#sponsor_emp_date_to_${newIndex}">
                                    <label class="form-check-label" for="sponsor_emp_present_${newIndex}">
                                        Present (Currently working here)
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#sponsor_employment_history_container').append(html);
        $('#sponsor_employment_history_count').val(newIndex + 1);
        
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

    // Check for unemployment and show reminder
    $(document).on('input', 'input[name^="sponsor_employment_history"][name$="[employer]"]', function() {
        if ($(this).val().toLowerCase() === 'unemployed') {
            $('#sponsor_unemployment_reminder').slideDown();
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