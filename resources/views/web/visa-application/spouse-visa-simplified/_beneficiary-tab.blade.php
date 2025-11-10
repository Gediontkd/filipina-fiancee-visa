{{-- FILE: resources/views/web/visa-application/spouse-visa-simplified/_beneficiary-tab.blade.php --}}
{{-- FIXED: Added gender, parents info, format validation, N/A checkboxes --}}

<div class="beneficiary-section">
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

    <!-- Current Address -->
    <h5 class="mb-3 mt-4"><i class="fa fa-home me-2"></i>Current Address</h5>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_address', 'Street Address') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_address', optional($application)->beneficiary_address ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Street address, building',
                    'required' => true,
                    'maxlength' => 100
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_apt', 'Apt/Suite/Floor') }}
                <div class="input-group">
                    {{ Form::text('beneficiary_apt', optional($application)->beneficiary_apt ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'Apt #',
                        'maxlength' => 20,
                        'id' => 'beneficiary_apt'
                    ]) }}
                </div>
                <div class="form-check mt-2">
                    {{ Form::checkbox('beneficiary_apt_na', 1, 
                        (optional($application)->beneficiary_apt ?? '') === 'N/A', [
                        'class' => 'form-check-input does-not-apply-checkbox',
                        'data-target' => '#beneficiary_apt'
                    ]) }}
                    <label class="form-check-label">N/A</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_city', 'City') }}
                <span class="text-danger">*</span>
                {{ Form::text('beneficiary_city', optional($application)->beneficiary_city ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter city',
                    'required' => true,
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_country', 'Country') }}
                <span class="text-danger">*</span>
                {{ Form::select('beneficiary_country', getAllCountry(), optional($application)->beneficiary_country ?? '', [
                    'class' => 'form-control country-select',
                    'data-state-target' => '#beneficiary_state',
                    'required' => true
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
    <h5 class="mb-3 mt-4"><i class="fa fa-briefcase me-2"></i>Employment Information (Optional)</h5>
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