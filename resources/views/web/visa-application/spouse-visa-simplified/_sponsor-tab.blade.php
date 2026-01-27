{{-- FILE: resources/views/web/visa-application/spouse-visa-simplified/_sponsor-tab.blade.php --}}
{{-- FIXED: Added adoption questions + Country field to addresses --}}

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

    <!-- Adoption Questions (NEW) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-question-circle me-2"></i>Adoption Information</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label>If the beneficiary is your brother/sister, are you related by adoption?</label>
                <span class="text-danger">*</span>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        {{ Form::radio('sponsor_beneficiary_related_by_adoption', 'yes', 
                            (optional($application)->sponsor_beneficiary_related_by_adoption ?? '') === 'yes', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_adoption_yes',
                            'required' => true
                        ]) }}
                        <label class="form-check-label" for="sponsor_adoption_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('sponsor_beneficiary_related_by_adoption', 'no', 
                            (optional($application)->sponsor_beneficiary_related_by_adoption ?? 'no') === 'no', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_adoption_no'
                        ]) }}
                        <label class="form-check-label" for="sponsor_adoption_no">No</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('sponsor_beneficiary_related_by_adoption', 'n/a', 
                            (optional($application)->sponsor_beneficiary_related_by_adoption ?? '') === 'n/a', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_adoption_na'
                        ]) }}
                        <label class="form-check-label" for="sponsor_adoption_na">N/A (Not siblings)</label>
                    </div>
                </div>
                <small class="form-text text-muted">Select "N/A" if beneficiary is not your sibling</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label>Did you gain lawful permanent resident status or citizenship through adoption?</label>
                <span class="text-danger">*</span>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        {{ Form::radio('sponsor_gained_status_through_adoption', 'yes', 
                            (optional($application)->sponsor_gained_status_through_adoption ?? '') === 'yes', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_status_adoption_yes',
                            'required' => true
                        ]) }}
                        <label class="form-check-label" for="sponsor_status_adoption_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('sponsor_gained_status_through_adoption', 'no', 
                            (optional($application)->sponsor_gained_status_through_adoption ?? 'no') === 'no', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_status_adoption_no'
                        ]) }}
                        <label class="form-check-label" for="sponsor_status_adoption_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Other Names Used (I-130 Part 2, Item 5) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-user-tag me-2"></i>Other Names Used</h5>
    <div class="alert alert-info">
        <i class="fa fa-info-circle me-2"></i>
        <strong>Note:</strong> Provide all other names you have ever used, including aliases, maiden name, and nicknames. If none, you can skip this section.
    </div>

    <div id="sponsor_other_names_container">
        @php
            $otherNames = optional($application)->sponsor_other_names ?? [];
        @endphp
        
        @if(!empty($otherNames))
            @foreach($otherNames as $index => $name)
                <div class="card mb-3 other-name-item" data-index="{{ $index }}">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <strong>Other Name {{ $index + 1 }}</strong>
                       <button type="button" class="btn btn-sm btn-danger remove-other-name" data-person="sponsor" data-index="{{ $index }}">
    Exit </button>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Family Name (Last Name)</label>
                                    <input type="text" name="sponsor_other_names[{{ $index }}][last_name]" 
                                        class="form-control" value="{{ $name['last_name'] ?? '' }}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Given Name (First Name)</label>
                                    <input type="text" name="sponsor_other_names[{{ $index }}][first_name]" 
                                        class="form-control" value="{{ $name['first_name'] ?? '' }}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>Middle Name</label>
                                    <input type="text" name="sponsor_other_names[{{ $index }}][middle_name]" 
                                        class="form-control" value="{{ $name['middle_name'] ?? '' }}" maxlength="50">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
        
        <input type="hidden" name="sponsor_other_names_count" value="{{ count($otherNames) }}" id="sponsor_other_names_count">
    </div>

    <button type="button" class="btn btn-outline-secondary mb-4" id="addSponsorOtherName">
        <i class="fa fa-plus me-2"></i>Add Other Name
    </button>

    <!-- Additional IDs -->
    <h5 class="mb-3 mt-4"><i class="fa fa-id-badge me-2"></i>Additional Identification Numbers</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_a_number', 'Alien Registration Number (A-Number)') }}
                <div class="input-group">
                    {{ Form::text('sponsor_a_number', optional($application)->sponsor_a_number ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'A12345678',
                        'id' => 'sponsor_a_number',
                        'maxlength' => 20
                    ]) }}
                </div>
                <div class="form-check mt-2">
                    {{ Form::checkbox('sponsor_a_number_na', 1, 
                        (optional($application)->sponsor_a_number ?? '') === 'N/A', [
                        'class' => 'form-check-input does-not-apply-checkbox',
                        'data-target' => '#sponsor_a_number'
                    ]) }}
                    <label class="form-check-label">Does Not Apply</label>
                </div>
                <small class="form-text text-muted">If you have never been assigned an A-Number, check "Does Not Apply"</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_uscis_account', 'USCIS Online Account Number') }}
                <div class="input-group">
                    {{ Form::text('sponsor_uscis_account', optional($application)->sponsor_uscis_account ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'USCIS Account Number',
                        'id' => 'sponsor_uscis_account',
                        'maxlength' => 20
                    ]) }}
                </div>
                <div class="form-check mt-2">
                    {{ Form::checkbox('sponsor_uscis_account_na', 1, 
                        (optional($application)->sponsor_uscis_account ?? '') === 'N/A', [
                        'class' => 'form-check-input does-not-apply-checkbox',
                        'data-target' => '#sponsor_uscis_account'
                    ]) }}
                    <label class="form-check-label">Does Not Apply</label>
                </div>
                <small class="form-text text-muted">If you don't have a USCIS online account, check "Does Not Apply"</small>
            </div>
        </div>
    </div>

    <!-- Citizenship Details (I-130 Part 2, Items 36-41) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-flag me-2"></i>Citizenship Details</h5>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>How did you acquire U.S. citizenship?</label>
                <span class="text-danger">*</span>
                <div class="d-flex flex-column gap-2">
                    <div class="form-check">
                        {{ Form::radio('sponsor_citizenship_method', 'Birth in the United States', 
                            (optional($application)->sponsor_citizenship_method ?? '') === 'Birth in the United States', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_citizenship_birth',
                            'required' => true
                        ]) }}
                        <label class="form-check-label" for="sponsor_citizenship_birth">Birth in the United States</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('sponsor_citizenship_method', 'Naturalization', 
                            (optional($application)->sponsor_citizenship_method ?? '') === 'Naturalization', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_citizenship_naturalization'
                        ]) }}
                        <label class="form-check-label" for="sponsor_citizenship_naturalization">Naturalization</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('sponsor_citizenship_method', 'Parents', 
                            (optional($application)->sponsor_citizenship_method ?? '') === 'Parents', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_citizenship_parents'
                        ]) }}
                        <label class="form-check-label" for="sponsor_citizenship_parents">Through Parents</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Naturalization Certificate Details (shown if Naturalization or Parents selected) -->
    <div id="sponsor_naturalization_section" 
        style="display: {{ in_array(optional($application)->sponsor_citizenship_method, ['Naturalization', 'Parents']) ? 'block' : 'none' }};">
        <div class="card mb-3 bg-light">
            <div class="card-body">
                <h6 class="mb-3">Certificate of Naturalization or Citizenship Details</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            {{ Form::label('sponsor_certificate_number', 'Certificate Number') }}
                            {{ Form::text('sponsor_certificate_number', optional($application)->sponsor_certificate_number ?? '', [
                                'class' => 'form-control',
                                'placeholder' => 'Certificate number',
                                'maxlength' => 50
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            {{ Form::label('sponsor_certificate_place', 'Place of Issuance') }}
                            {{ Form::text('sponsor_certificate_place', optional($application)->sponsor_certificate_place ?? '', [
                                'class' => 'form-control',
                                'placeholder' => 'City, State',
                                'maxlength' => 100
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            {{ Form::label('sponsor_certificate_date', 'Date of Issuance') }}
                            {{ Form::text('sponsor_certificate_date', optional($application)->sponsor_certificate_date ? optional($application)->sponsor_certificate_date->format('m/d/Y') : '', [
                                'class' => 'form-control datePicker',
                                'placeholder' => 'MM/DD/YYYY'
                            ]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Biographic Information (I-130 Part 3) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-user-circle me-2"></i>Biographic Information</h5>
    <div class="alert alert-info">
        <i class="fa fa-info-circle me-2"></i>
        <strong>Required by USCIS:</strong> The following biographic information is mandatory for all petitioners.
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label>Ethnicity</label>
                <span class="text-danger">*</span>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        {{ Form::radio('sponsor_ethnicity', 'Hispanic or Latino', 
                            (optional($application)->sponsor_ethnicity ?? '') === 'Hispanic or Latino', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_ethnicity_hispanic',
                            'required' => true
                        ]) }}
                        <label class="form-check-label" for="sponsor_ethnicity_hispanic">Hispanic or Latino</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('sponsor_ethnicity', 'Not Hispanic or Latino', 
                            (optional($application)->sponsor_ethnicity ?? '') === 'Not Hispanic or Latino', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_ethnicity_not'
                        ]) }}
                        <label class="form-check-label" for="sponsor_ethnicity_not">Not Hispanic or Latino</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>Race <small class="text-muted">(Select all that apply)</small></label>
                <span class="text-danger">*</span>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-check">
                            {{ Form::checkbox('sponsor_race[]', 'White', 
                                in_array('White', optional($application)->sponsor_race ?? []), [
                                'class' => 'form-check-input',
                                'id' => 'sponsor_race_white'
                            ]) }}
                            <label class="form-check-label" for="sponsor_race_white">White</label>
                        </div>
                        <div class="form-check">
                            {{ Form::checkbox('sponsor_race[]', 'Asian', 
                                in_array('Asian', optional($application)->sponsor_race ?? []), [
                                'class' => 'form-check-input',
                                'id' => 'sponsor_race_asian'
                            ]) }}
                            <label class="form-check-label" for="sponsor_race_asian">Asian</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            {{ Form::checkbox('sponsor_race[]', 'Black or African American', 
                                in_array('Black or African American', optional($application)->sponsor_race ?? []), [
                                'class' => 'form-check-input',
                                'id' => 'sponsor_race_black'
                            ]) }}
                            <label class="form-check-label" for="sponsor_race_black">Black or African American</label>
                        </div>
                        <div class="form-check">
                            {{ Form::checkbox('sponsor_race[]', 'American Indian or Alaska Native', 
                                in_array('American Indian or Alaska Native', optional($application)->sponsor_race ?? []), [
                                'class' => 'form-check-input',
                                'id' => 'sponsor_race_native'
                            ]) }}
                            <label class="form-check-label" for="sponsor_race_native">American Indian or Alaska Native</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-check">
                            {{ Form::checkbox('sponsor_race[]', 'Native Hawaiian or Other Pacific Islander', 
                                in_array('Native Hawaiian or Other Pacific Islander', optional($application)->sponsor_race ?? []), [
                                'class' => 'form-check-input',
                                'id' => 'sponsor_race_pacific'
                            ]) }}
                            <label class="form-check-label" for="sponsor_race_pacific">Native Hawaiian or Other Pacific Islander</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="form-group mb-3">
                <label>Height</label>
                <span class="text-danger">*</span>
                <div class="row">
                    <div class="col-6">
                        {{ Form::text('sponsor_height_feet', optional($application)->sponsor_height_feet ?? '', [
                            'class' => 'form-control height-feet',
                            'placeholder' => 'Feet',
                            'required' => true,
                            'id' => 'sponsor_height_feet'
                        ]) }}
                        <small class="form-text text-muted">Feet</small>
                    </div>
                    <div class="col-6">
                        {{ Form::number('sponsor_height_inches', optional($application)->sponsor_height_inches ?? '', [
                            'class' => 'form-control height-inches',
                            'placeholder' => 'Inches',
                            'required' => true,
                            'min' => 0,
                            'id' => 'sponsor_height_inches'
                        ]) }}
                        <small class="form-text text-muted">Inches</small>
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const feetInput = document.getElementById('sponsor_height_feet');
            const incInput = document.getElementById('sponsor_height_inches');

            // Handle decimal feet (e.g. 5.5 -> 5' 6")
            feetInput.addEventListener('blur', function() {
                const val = parseFloat(this.value);
                if (!isNaN(val) && val % 1 !== 0) {
                    const feet = Math.floor(val);
                    const inches = Math.round((val - feet) * 12);
                    
                    feetInput.value = feet;
                    incInput.value = inches;
                }
            });

            // Handle total inches (e.g. 70 -> 5' 10")
            incInput.addEventListener('blur', function() {
                const val = parseInt(this.value);
                if (!isNaN(val) && val >= 12) {
                    const feet = Math.floor(val / 12);
                    const inches = val % 12;
                    
                    // Only update if feet is empty or 0 to avoid overwriting existing valid data
                    // actually, if they type 70 in inches, they almost certainly mean total height
                    feetInput.value = feet;
                    incInput.value = inches;
                }
            });
        });
        </script>
        <div class="col-md-3">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_weight', 'Weight (Pounds)') }}
                <span class="text-danger">*</span>
                {{ Form::number('sponsor_weight', optional($application)->sponsor_weight ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Weight in lbs',
                    'required' => true,
                    'min' => 0,
                    'max' => 999
                ]) }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_eye_color', 'Eye Color') }}
                <span class="text-danger">*</span>
                {{ Form::select('sponsor_eye_color', [
                    '' => '-Select-',
                    'Black' => 'Black',
                    'Blue' => 'Blue',
                    'Brown' => 'Brown',
                    'Gray' => 'Gray',
                    'Green' => 'Green',
                    'Hazel' => 'Hazel',
                    'Maroon' => 'Maroon',
                    'Pink' => 'Pink',
                    'Unknown/Other' => 'Unknown/Other'
                ], optional($application)->sponsor_eye_color ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_hair_color', 'Hair Color') }}
                <span class="text-danger">*</span>
                {{ Form::select('sponsor_hair_color', [
                    '' => '-Select-',
                    'Bald (No hair)' => 'Bald (No hair)',
                    'Black' => 'Black',
                    'Blond' => 'Blond',
                    'Brown' => 'Brown',
                    'Gray' => 'Gray',
                    'Red' => 'Red',
                    'Sandy' => 'Sandy',
                    'White' => 'White',
                    'Unknown/Other' => 'Unknown/Other'
                ], optional($application)->sponsor_hair_color ?? '', [
                    'class' => 'form-control',
                    'required' => true
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

    <!-- Mailing Address (FIXED: Added Country field) -->
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
        <div class="col-md-3">
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
        <div class="col-md-3">
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
        <div class="col-md-3">
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
        {{-- FIXED: Added Country field --}}
        <div class="col-md-3">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_mailing_country', 'Country') }}
                <span class="text-danger">*</span>
                {{ Form::select('sponsor_mailing_country', getAllCountry(), optional($application)->sponsor_mailing_country ?? 'US', [
                    'class' => 'form-control',
                    'required' => true
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
                
                <div class="form-control" style="background-color: #e9ecef; cursor: default;">
                    PRESENT
                </div>
                
                {{ Form::hidden('sponsor_mailing_date_to', '') }}
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

    <!-- Physical Address (FIXED: Added Country field) -->
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
            <div class="col-md-3">
                <div class="form-group mb-3">
                    {{ Form::label('sponsor_city', 'City') }}
                    {{ Form::text('sponsor_city', optional($application)->sponsor_city ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter city',
                        'maxlength' => 50
                    ]) }}
                </div>
            </div>
            <div class="col-md-3">
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
            <div class="col-md-3">
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
            {{-- FIXED: Added Country field --}}
            <div class="col-md-3">
                <div class="form-group mb-3">
                    {{ Form::label('sponsor_country', 'Country') }}
                    {{ Form::select('sponsor_country', getAllCountry(), optional($application)->sponsor_country ?? 'US', [
                        'class' => 'form-control'
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
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>City</label>
                                    <input type="text" name="sponsor_address_history[{{ $index }}][city]" 
                                        class="form-control" value="{{ $address['city'] ?? '' }}" maxlength="50">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>State</label>
                                    <input type="text" name="sponsor_address_history[{{ $index }}][state]" 
                                        class="form-control state-format" value="{{ $address['state'] ?? '' }}" 
                                        maxlength="2" pattern="[A-Z]{2}" style="text-transform: uppercase;">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>ZIP Code</label>
                                    <input type="text" name="sponsor_address_history[{{ $index }}][zip]" 
                                        class="form-control zip-format" value="{{ $address['zip'] ?? '' }}" maxlength="10">
                                </div>
                            </div>
                            {{-- FIXED: Added Country field --}}
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label>Country</label>
                                    <select name="sponsor_address_history[{{ $index }}][country]" class="form-control">
                                        <option value="">-Select-</option>
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent1_city_residence', 'City/Town of Residence') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('sponsor_parent1_city_residence', optional($application)->sponsor_parent1_city_residence ?? '', [
                            'class' => 'form-control',
                            'placeholder' => 'Current city of residence',
                            'required' => true,
                            'maxlength' => 100
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent1_country_residence', 'Country of Residence') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('sponsor_parent1_country_residence', getAllCountry(), optional($application)->sponsor_parent1_country_residence ?? '', [
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
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent2_city_residence', 'City/Town of Residence') }}
                        <span class="text-danger">*</span>
                        {{ Form::text('sponsor_parent2_city_residence', optional($application)->sponsor_parent2_city_residence ?? '', [
                            'class' => 'form-control',
                            'placeholder' => 'Current city of residence',
                            'required' => true,
                            'maxlength' => 100
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('sponsor_parent2_country_residence', 'Country of Residence') }}
                        <span class="text-danger">*</span>
                        {{ Form::select('sponsor_parent2_country_residence', getAllCountry(), optional($application)->sponsor_parent2_country_residence ?? '', [
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
    // Show/hide naturalization section
    $('input[name="sponsor_citizenship_method"]').on('change', function() {
        if ($(this).val() === 'Naturalization' || $(this).val() === 'Parents') {
            $('#sponsor_naturalization_section').slideDown();
        } else {
            $('#sponsor_naturalization_section').slideUp();
            $('#sponsor_naturalization_section input').val('');
        }
    });

    // Add other name
    $('#addSponsorOtherName').on('click', function() {
        const count = parseInt($('#sponsor_other_names_count').val());
        const newIndex = count;
        
        const html = `
            <div class="card mb-3 other-name-item" data-index="${newIndex}">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <strong>Other Name ${newIndex + 1}</strong>
                    <button type="button" class="btn btn-sm btn-danger remove-other-name" data-person="sponsor" data-index="${newIndex}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Family Name (Last Name)</label>
                                <input type="text" name="sponsor_other_names[${newIndex}][last_name]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Given Name (First Name)</label>
                                <input type="text" name="sponsor_other_names[${newIndex}][first_name]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label>Middle Name</label>
                                <input type="text" name="sponsor_other_names[${newIndex}][middle_name]" 
                                    class="form-control" maxlength="50">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#sponsor_other_names_container').append(html);
        $('#sponsor_other_names_count').val(newIndex + 1);
    });

    $(document).on('click', '.remove-other-name[data-person="sponsor"]', function() {
        $(this).closest('.other-name-item').remove();
    });
});
</script>

<script>
$(document).ready(function() {
    // Format SSN
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

    // Format phone
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

    // Format ZIP
    $(document).on('input', '.zip-format', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 9) value = value.substring(0, 9);
        
        if (value.length > 5) {
            this.value = value.substring(0, 5) + '-' + value.substring(5);
        } else {
            this.value = value;
        }
    });

    // Format state
    $(document).on('input', '.state-format', function() {
        this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '');
    });

    // Handle "Does Not Apply" Checkboxes
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

    // Initialize "Does Not Apply" checkboxes on page load
    $('.does-not-apply-checkbox:checked').each(function() {
        const targetId = $(this).data('target');
        const targetField = $(targetId);
        targetField.val('N/A').prop('readonly', true).addClass('bg-light');
    });

    // Handle "Present" Checkboxes for History
    $(document).on('change', '.present-checkbox', function() {
        const targetId = $(this).data('target');
        const targetField = $(targetId);
        const hiddenFieldName = targetField.attr('name').replace('[date_to]', '[is_present]');
        
        if ($(this).is(':checked')) {
            targetField.val('Present').prop('readonly', true).addClass('bg-light');
            
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

    // Initialize "Present" checkboxes on page load
    $('.present-checkbox:checked').each(function() {
        const targetId = $(this).data('target');
        const targetField = $(targetId);
        const hiddenFieldName = targetField.attr('name').replace('[date_to]', '[is_present]');
        
        targetField.val('Present').prop('readonly', true).addClass('bg-light');
        
        if ($('input[name="' + hiddenFieldName + '"]').length === 0) {
            targetField.after('<input type="hidden" name="' + hiddenFieldName + '" value="1" class="present-hidden-field">');
        }
    });

    // Show/hide physical address
    $('input[name="sponsor_same_address"]').on('change', function() {
        if ($(this).val() == '0') {
            $('#sponsor_physical_address_section').slideDown();
        } else {
            $('#sponsor_physical_address_section').slideUp();
        }
    });

    // Add address history
    $('#addSponsorAddress').on('click', function() {
        const count = parseInt($('#sponsor_address_history_count').val());
        const newIndex = count;
        
        // Get country options
        const countryOptions = @json(getAllCountry());
        let countryOptionsHtml = '<option value="">-Select-</option>';
        for (const [code, name] of Object.entries(countryOptions)) {
            countryOptionsHtml += `<option value="${code}">${name}</option>`;
        }
        
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
                                <div class="apt-suite-floor-component" data-target-field="sponsor_address_history[${newIndex}][apt]">
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
                                <input type="hidden" name="sponsor_address_history[${newIndex}][apt]">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>City</label>
                                <input type="text" name="sponsor_address_history[${newIndex}][city]" class="form-control" maxlength="50">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>State</label>
                                <input type="text" name="sponsor_address_history[${newIndex}][state]" 
                                    class="form-control state-format" maxlength="2" style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>ZIP Code</label>
                                <input type="text" name="sponsor_address_history[${newIndex}][zip]" class="form-control zip-format" maxlength="10">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-3">
                                <label>Country</label>
                                <select name="sponsor_address_history[${newIndex}][country]" class="form-control">
                                    ${countryOptionsHtml}
                                </select>
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
                                    class="form-control datePicker" placeholder="MM/DD/YYYY" id="sponsor_addr_date_to_${newIndex}">
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input present-checkbox" 
                                        id="sponsor_addr_present_${newIndex}" data-target="#sponsor_addr_date_to_${newIndex}">
                                    <label class="form-check-label" for="sponsor_addr_present_${newIndex}">Present</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        $('#sponsor_address_history_container').append(html);
        $('#sponsor_address_history_count').val(newIndex + 1);
        
        if (window.initAptComponents) {
            window.initAptComponents();
        }
        $('.datePicker').datepicker({ format: 'mm/dd/yyyy', autoclose: true });
    });

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
                    <button type="button" class="btn btn-sm btn-danger remove-employment" data-index="${newIndex}">
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
                                    class="form-control datePicker" placeholder="MM/DD/YYYY" id="sponsor_emp_date_to_${newIndex}">
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input present-checkbox" 
                                        id="sponsor_emp_present_${newIndex}" data-target="#sponsor_emp_date_to_${newIndex}">
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
        
        $('.datePicker').datepicker({ format: 'mm/dd/yyyy', autoclose: true });
    });

    $(document).on('click', '.remove-employment', function() {
        $(this).closest('.employment-history-item').remove();
    });
});
</script>