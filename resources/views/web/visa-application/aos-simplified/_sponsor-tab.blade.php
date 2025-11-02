<div class="sponsor-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-users me-2 text-primary"></i>Sponsor/Petitioner Information
    </h4>
    <p class="text-muted mb-4">Enter information about the person sponsoring your green card</p>

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
                    'placeholder' => 'Middle name (optional)'
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

    <!-- Relationship and Status -->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_relationship', 'Relationship to You') }}
                <span class="text-danger">*</span>
                {{ Form::select('sponsor_relationship', [
                    '' => '-Select Relationship-',
                    'Spouse' => 'Spouse',
                    'Parent' => 'Parent',
                    'Child' => 'Child (21 or older)',
                    'Sibling' => 'Sibling',
                    'Employer' => 'Employer',
                    'Other' => 'Other'
                ], optional($application)->sponsor_relationship ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_citizenship_status', 'Citizenship/Immigration Status') }}
                <span class="text-danger">*</span>
                {{ Form::select('sponsor_citizenship_status', [
                    '' => '-Select Status-',
                    'U.S. Citizen' => 'U.S. Citizen',
                    'U.S. National' => 'U.S. National',
                    'Lawful Permanent Resident' => 'Lawful Permanent Resident'
                ], optional($application)->sponsor_citizenship_status ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
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
    <h5 class="mb-3 mt-4"><i class="fa fa-home me-2"></i>Address</h5>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_address', 'Street Address') }}
                <span class="text-danger">*</span>
                {{ Form::text('sponsor_address', optional($application)->sponsor_address ?? '', [
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

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4">
        {{ Form::button('<i class="fa fa-arrow-left me-2"></i>Previous: Immigration Status', [
            'class' => 'btn btn-outline-secondary',
            'type' => 'button',
            'onclick' => '$(\'#immigration-tab\').tab(\'show\')'
        ]) }}
        {{ Form::button('Next: Background Questions <i class="fa fa-arrow-right ms-2"></i>', [
            'class' => 'btn btn-primary',
            'type' => 'button',
            'onclick' => '$(\'#background-tab\').tab(\'show\')'
        ]) }}
    </div>
</div>