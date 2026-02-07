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
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_other_names', 'Other Names Used') }}
                {{ Form::textarea('applicant_other_names_raw', optional($application)->applicant_other_names ? implode("\n", optional($application)->applicant_other_names) : '', [
                    'class' => 'form-control',
                    'rows' => 2,
                    'placeholder' => 'One name per line'
                ]) }}
                {{ Form::hidden('applicant_other_names_json', json_encode(optional($application)->applicant_other_names ?? [])) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('uscis_account_number', 'USCIS Online Account Number') }}
                {{ Form::text('uscis_account_number', optional($application)->uscis_account_number ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '12-digit number (if any)'
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_citizenship', 'Country of Citizenship/Nationality') }}
                <span class="text-danger">*</span>
                {{ Form::select('applicant_citizenship', getCountries(), optional($application)->applicant_citizenship ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
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
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_gender', 'Gender') }}
                <span class="text-danger">*</span>
                {{ Form::select('applicant_gender', [
                    '' => '-Select-',
                    'Male' => 'Male',
                    'Female' => 'Female'
                ], optional($application)->applicant_gender ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_place_of_birth', 'City of Birth') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_place_of_birth', optional($application)->applicant_place_of_birth ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'e.g., Manila',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <!-- Biographic Information (Part 7) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-ruler-vertical me-2"></i>Biographic Information</h5>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group mb-3">
                {{ Form::label('ethnicity', 'Ethnicity') }}
                <span class="text-danger">*</span>
                {{ Form::select('ethnicity', [
                    '' => '-Select-',
                    'Hispanic or Latino' => 'Hispanic or Latino',
                    'Not Hispanic or Latino' => 'Not Hispanic or Latino'
                ], optional($application)->ethnicity ?? '', ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group mb-3">
                {{ Form::label('race', 'Race') }}
                <span class="text-danger">*</span>
                {{ Form::select('race', [
                    '' => '-Select-',
                    'White' => 'White',
                    'Asian' => 'Asian',
                    'Black or African American' => 'Black or African American',
                    'American Indian or Alaska Native' => 'American Indian or Alaska Native',
                    'Native Hawaiian or Other Pacific Islander' => 'Native Hawaiian or Other Pacific Islander'
                ], optional($application)->race ?? '', ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group mb-3">
                {{ Form::label('height_feet', 'Height (ft)') }}
                {{ Form::number('height_feet', optional($application)->height_feet ?? '', ['class' => 'form-control', 'min' => 1, 'max' => 8]) }}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group mb-3">
                {{ Form::label('height_inches', 'Height (in)') }}
                {{ Form::number('height_inches', optional($application)->height_inches ?? '', ['class' => 'form-control', 'min' => 0, 'max' => 11]) }}
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group mb-3">
                {{ Form::label('weight_pounds', 'Weight (lbs)') }}
                {{ Form::number('weight_pounds', optional($application)->weight_pounds ?? '', ['class' => 'form-control', 'min' => 50, 'max' => 500]) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('eye_color', 'Eye Color') }}
                <span class="text-danger">*</span>
                {{ Form::select('eye_color', [
                    '' => '-Select-',
                    'Black' => 'Black', 'Blue' => 'Blue', 'Brown' => 'Brown', 'Gray' => 'Gray', 
                    'Green' => 'Green', 'Hazel' => 'Hazel', 'Maroon' => 'Maroon', 'Pink' => 'Pink', 'Unknown' => 'Unknown'
                ], optional($application)->eye_color ?? '', ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('hair_color', 'Hair Color') }}
                <span class="text-danger">*</span>
                {{ Form::select('hair_color', [
                    '' => '-Select-',
                    'Bald' => 'Bald', 'Black' => 'Black', 'Blond' => 'Blond', 'Brown' => 'Brown', 
                    'Gray' => 'Gray', 'Red' => 'Red', 'Sandy' => 'Sandy', 'White' => 'White', 'Unknown' => 'Unknown'
                ], optional($application)->hair_color ?? '', ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
    </div>

    <!-- Address Information -->
    <h5 class="mb-3 mt-4"><i class="fa fa-home me-2"></i>Address Information</h5>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                {{ Form::label('applicant_address', 'Physical Address (Street Name and Number)') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_address', optional($application)->applicant_address ?? '', ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_city', 'City or Town') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_city', optional($application)->applicant_city ?? '', ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_state', 'State') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_state', optional($application)->applicant_state ?? '', ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_zip', 'ZIP Code') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_zip', optional($application)->applicant_zip ?? '', ['class' => 'form-control', 'required' => true]) }}
            </div>
        </div>
    </div>

    <!-- Mailing Address Section -->
    <div class="mailing-address-toggle bg-light p-3 border rounded mb-4">
        <div class="form-check">
            {{ Form::checkbox('use_mailing_address', 1, optional($application)->use_mailing_address ?? false, [
                'class' => 'form-check-input',
                'id' => 'use_mailing_address_toggle'
            ]) }}
            {{ Form::label('use_mailing_address_toggle', 'Is your mailing address different from your physical address?', ['class' => 'form-check-label']) }}
        </div>
        
        <div id="mailing_address_fields" class="mt-3 {{ optional($application)->use_mailing_address ? '' : 'd-none' }}">
            <h6>Mailing Address</h6>
            <div class="row">
                <div class="col-md-12 mb-3">
                    {{ Form::label('mailing_street', 'Mailing Street Address') }}
                    {{ Form::text('mailing_street', optional($application)->mailing_street ?? '', ['class' => 'form-control']) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('mailing_city', 'City') }}
                    {{ Form::text('mailing_city', optional($application)->mailing_city ?? '', ['class' => 'form-control']) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('mailing_state', 'State') }}
                    {{ Form::text('mailing_state', optional($application)->mailing_state ?? '', ['class' => 'form-control']) }}
                </div>
                <div class="col-md-4">
                    {{ Form::label('mailing_zip', 'ZIP Code') }}
                    {{ Form::text('mailing_zip', optional($application)->mailing_zip ?? '', ['class' => 'form-control']) }}
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

    <!-- Navigation -->
    <div class="d-flex justify-content-end mt-4">
        {{ Form::button('Next <i class="fa fa-arrow-right ms-2"></i>', [
            'class' => 'btn btn-primary next-step aos-action-btn',
            'type' => 'button',
            'data-next-tab' => 'basis-tab'
        ]) }}
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#use_mailing_address_toggle').on('change', function() {
            if ($(this).is(':checked')) {
                $('#mailing_address_fields').removeClass('d-none');
            } else {
                $('#mailing_address_fields').addClass('d-none');
            }
        });
    });
</script>