{{-- FILE: resources/views/web/visa-application/spouse-visa-simplified/_sponsor-tab.blade.php --}}
{{-- FIXED: Added gender, format validation, locked financial fields --}}

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

    <!-- Address -->
    <h5 class="mb-3 mt-4"><i class="fa fa-home me-2"></i>Current Address</h5>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_address', 'Street Address') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_address', optional($application)->sponsor_address ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '123 Main Street',
                    'required' => true,
                    'maxlength' => 100
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_apt', 'Apt/Suite/Floor') }}
                <div class="input-group">
                    {{ Form::text('sponsor_apt', optional($application)->sponsor_apt ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'Apt #',
                        'maxlength' => 20,
                        'id' => 'sponsor_apt'
                    ]) }}
                </div>
                <div class="form-check mt-2">
                    {{ Form::checkbox('sponsor_apt_na', 1, 
                        (optional($application)->sponsor_apt ?? '') === 'N/A', [
                        'class' => 'form-check-input does-not-apply-checkbox',
                        'data-target' => '#sponsor_apt'
                    ]) }}
                    <label class="form-check-label">N/A</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_city', 'City') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_city', optional($application)->sponsor_city ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter city',
                    'required' => true,
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_state', 'State') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_state', optional($application)->sponsor_state ?? '', [
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
                {{ Form::label('sponsor_zip', 'ZIP Code') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_zip', optional($application)->sponsor_zip ?? '', [
                    'class' => 'form-control zip-format',
                    'placeholder' => '12345 or 12345-6789',
                    'required' => true,
                    'pattern' => '\d{5}(-\d{4})?',
                    'maxlength' => 10
                ]) }}
            </div>
        </div>
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
</script>