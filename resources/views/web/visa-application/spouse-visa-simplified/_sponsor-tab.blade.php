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
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_middle_name', 'Middle Name') }}
                {{ Form::text('sponsor_middle_name', optional($application)->sponsor_middle_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter middle name (optional)'
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
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
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
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_place_of_birth', 'Place of Birth (City, Country)') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_place_of_birth', optional($application)->sponsor_place_of_birth ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'e.g., New York, USA',
                    'required' => true
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
                    'class' => 'form-control',
                    'placeholder' => 'XXX-XX-XXXX',
                    'required' => true,
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
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_phone', 'Phone Number') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_phone', optional($application)->sponsor_phone ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '(123) 456-7890',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <!-- Address -->
    <h5 class="mb-3 mt-4"><i class="fa fa-home me-2"></i>Current Address</h5>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_address', 'Street Address') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_address', optional($application)->sponsor_address ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '123 Main Street, Apt 4B',
                    'required' => true
                ]) }}
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
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_state', 'State') }}
                <span class="text-danger">*</span>
                {{ Form::select('sponsor_state', getUsStates(), optional($application)->sponsor_state ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_zip', 'ZIP Code') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_zip', optional($application)->sponsor_zip ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '12345',
                    'required' => true,
                    'maxlength' => 10
                ]) }}
            </div>
        </div>
    </div>

    <!-- Employment Information -->
    <h5 class="mb-3 mt-4"><i class="fa fa-briefcase me-2"></i>Employment Information</h5>
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
                ], optional($application)->sponsor_employment_status ?? '', [
                    'class' => 'form-control'
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_annual_income', 'Annual Income (USD)') }}
                {{ Form::number('sponsor_annual_income', optional($application)->sponsor_annual_income ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '50000',
                    'min' => 0,
                    'step' => '0.01'
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_employer_name', 'Employer Name') }}
                {{ Form::text('sponsor_employer_name', optional($application)->sponsor_employer_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Company name (if employed)'
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_occupation', 'Occupation/Job Title') }}
                {{ Form::text('sponsor_occupation', optional($application)->sponsor_occupation ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Your job title'
                ]) }}
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