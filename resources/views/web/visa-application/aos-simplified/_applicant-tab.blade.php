<div class="applicant-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-user me-2 text-primary"></i>Applicant Information
    </h4>
    <p class="text-muted mb-4">Enter information about the person adjusting status</p>

    <!-- Personal Information -->
    <h5 class="mb-3"><i class="fa fa-id-card me-2"></i>Personal Information</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_first_name', 'First Name') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_first_name', optional($application)->applicant_first_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter first name',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_middle_name', 'Middle Name') }}
                {{ Form::text('applicant_middle_name', optional($application)->applicant_middle_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Middle name (optional)'
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_last_name', 'Last Name') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_last_name', optional($application)->applicant_last_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter last name',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('applicant_dob', 'Date of Birth') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_dob', optional($application)->applicant_dob ? optional($application)->applicant_dob->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('applicant_place_of_birth', 'Place of Birth (City, Country)') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_place_of_birth', optional($application)->applicant_place_of_birth ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'e.g., Manila, Philippines',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('applicant_citizenship', 'Country of Citizenship') }}
                <span class="text-danger">*</span>
                {{ Form::select('applicant_citizenship', getAllCountry(), optional($application)->applicant_citizenship ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('applicant_alien_number', 'Alien Registration Number (A-Number)') }}
                {{ Form::text('applicant_alien_number', optional($application)->applicant_alien_number ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'A12345678 (if applicable)',
                    'id' => 'applicant_alien_number'
                ]) }}
                <div class="form-check mt-2">
                    {{ Form::checkbox('applicant_alien_number_na', 1, 
                        (optional($application)->applicant_alien_number ?? '') === 'N/A', [
                        'class' => 'form-check-input does-not-apply-checkbox',
                        'data-target' => '#applicant_alien_number'
                    ]) }}
                    <label class="form-check-label">Does Not Apply</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('applicant_ssn', 'Social Security Number') }}
                {{ Form::text('applicant_ssn', optional($application)->applicant_ssn ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'XXX-XX-XXXX (if applicable)',
                    'maxlength' => 11,
                    'id' => 'applicant_ssn'
                ]) }}
                <div class="form-check mt-2">
                    {{ Form::checkbox('applicant_ssn_na', 1, 
                        (optional($application)->applicant_ssn ?? '') === 'N/A', [
                        'class' => 'form-check-input does-not-apply-checkbox',
                        'data-target' => '#applicant_ssn'
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
                {{ Form::label('applicant_email', 'Email Address') }}
                <span class="text-danger">*</span>
                {{ Form::email('applicant_email', optional($application)->applicant_email ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'applicant@example.com',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('applicant_phone', 'Phone Number') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_phone', optional($application)->applicant_phone ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '(123) 456-7890',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <!-- Current U.S. Address -->
    <h5 class="mb-3 mt-4"><i class="fa fa-home me-2"></i>Current U.S. Address</h5>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                {{ Form::label('applicant_address', 'Street Address') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_address', optional($application)->applicant_address ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Street address, apartment, building',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_city', 'City') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_city', optional($application)->applicant_city ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter city',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_state', 'State') }}
                <span class="text-danger">*</span>
                {{ Form::select('applicant_state', getUsStates(), optional($application)->applicant_state ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_zip', 'ZIP Code') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_zip', optional($application)->applicant_zip ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '12345',
                    'required' => true,
                    'maxlength' => 10
                ]) }}
            </div>
        </div>
    </div>

    <!-- Employment Information -->
    <h5 class="mb-3 mt-4"><i class="fa fa-briefcase me-2"></i>Employment Information (Optional)</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('applicant_employment_status', 'Employment Status') }}
                {{ Form::select('applicant_employment_status', [
                    '' => '-Select Status-',
                    'Employed' => 'Employed',
                    'Self-Employed' => 'Self-Employed',
                    'Unemployed' => 'Unemployed',
                    'Student' => 'Student'
                ], optional($application)->applicant_employment_status ?? '', [
                    'class' => 'form-control'
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('applicant_occupation', 'Occupation/Job Title') }}
                {{ Form::text('applicant_occupation', optional($application)->applicant_occupation ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Job title (if employed)'
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                {{ Form::label('applicant_employer_name', 'Employer Name') }}
                {{ Form::text('applicant_employer_name', optional($application)->applicant_employer_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Company name (if employed)'
                ]) }}
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-end mt-4">
        {{ Form::button('Next: Immigration Status <i class="fa fa-arrow-right ms-2"></i>', [
            'class' => 'btn btn-primary',
            'type' => 'button',
            'onclick' => '$(\'#immigration-tab\').tab(\'show\')'
        ]) }}
    </div>
</div>