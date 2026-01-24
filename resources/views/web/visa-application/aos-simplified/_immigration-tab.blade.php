<div class="immigration-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-passport me-2 text-primary"></i>Current Immigration Status
    </h4>
    <p class="text-muted mb-4">Provide details about your current visa and entry into the United States</p>

    <!-- Current Visa Information -->
    <h5 class="mb-3"><i class="fa fa-id-card me-2"></i>Current Visa Status</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('current_visa_type', 'Current Visa Type') }}
                <span class="text-danger">*</span>
                {{ Form::select('current_visa_type', getAOSVisaTypes(), optional($application)->current_visa_type ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('visa_expiration_date', 'Visa Expiration Date') }}
                <span class="text-danger">*</span>
                {{ Form::text('visa_expiration_date', optional($application)->visa_expiration_date ? optional($application)->visa_expiration_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                {{ Form::label('i94_number', 'I-94 Arrival/Departure Number') }}
                {{ Form::text('i94_number', optional($application)->i94_number ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'I-94 number (if applicable)',
                    'id' => 'i94_number'
                ]) }}
                <small class="form-text text-muted">
                    Find your I-94 at <a href="https://i94.cbp.dhs.gov/I94/#/home" target="_blank">i94.cbp.dhs.gov</a>
                </small>
                <div class="form-check mt-2">
                    {{ Form::checkbox('i94_number_na', 1, 
                        (optional($application)->i94_number ?? '') === 'N/A', [
                        'class' => 'form-check-input does-not-apply-checkbox',
                        'data-target' => '#i94_number'
                    ]) }}
                    <label class="form-check-label">Does Not Apply</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Passport Information -->
    <h5 class="mb-3 mt-4"><i class="fa fa-passport me-2"></i>Passport Information</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('passport_number', 'Passport Number') }}
                <span class="text-danger">*</span>
                {{ Form::text('passport_number', optional($application)->passport_number ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Enter passport number',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('passport_country', 'Passport Country') }}
                <span class="text-danger">*</span>
                {{ Form::select('passport_country', getAllCountry(), optional($application)->passport_country ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('passport_expiration', 'Passport Expiration Date') }}
                <span class="text-danger">*</span>
                {{ Form::text('passport_expiration', optional($application)->passport_expiration ? optional($application)->passport_expiration->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY',
                    'required' => true
                ]) }}
                <small class="form-text text-muted">Must be valid for at least 6 months</small>
            </div>
        </div>
    </div>

    <!-- Entry Information -->
    <h5 class="mb-3 mt-4"><i class="fa fa-plane-arrival me-2"></i>Entry into United States</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('entry_date', 'Date of Last Entry') }}
                <span class="text-danger">*</span>
                {{ Form::text('entry_date', optional($application)->entry_date ? optional($application)->entry_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('entry_location', 'Place of Entry (Port of Entry)') }}
                <span class="text-danger">*</span>
                {{ Form::text('entry_location', optional($application)->entry_location ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'e.g., JFK Airport, New York',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <!-- Marital Status -->
    <h5 class="mb-3 mt-4"><i class="fa fa-ring me-2"></i>Marital Status</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marital_status', 'Current Marital Status') }}
                <span class="text-danger">*</span>
                {{ Form::select('marital_status', [
                    '' => '-Select Status-',
                    'Single' => 'Single',
                    'Married' => 'Married',
                    'Divorced' => 'Divorced',
                    'Widowed' => 'Widowed',
                    'Separated' => 'Legally Separated'
                ], optional($application)->marital_status ?? '', [
                    'class' => 'form-control',
                    'required' => true,
                    'id' => 'marital_status'
                ]) }}
            </div>
        </div>
    </div>

    <div class="row" id="marriage_info" style="display: {{ (optional($application)->marital_status ?? '') === 'Married' ? 'block' : 'none' }};">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marriage_date', 'Date of Marriage') }}
                {{ Form::text('marriage_date', optional($application)->marriage_date ? optional($application)->marriage_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('spouse_name', 'Spouse Full Name') }}
                {{ Form::text('spouse_name', optional($application)->spouse_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Spouse full name'
                ]) }}
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4">
        {{ Form::button('<i class="fa fa-arrow-left me-2"></i>Previous: Applicant', [
            'class' => 'btn btn-outline-secondary',
            'type' => 'button',
            'onclick' => '$(\'#applicant-tab\').tab(\'show\')'
        ]) }}
        {{ Form::button('Next: Sponsor/Petitioner <i class="fa fa-arrow-right ms-2"></i>', [
            'class' => 'btn btn-primary',
            'type' => 'button',
            'onclick' => '$(\'#sponsor-tab\').tab(\'show\')'
        ]) }}
    </div>
</div>

<script>
    $(document).on('change', '#marital_status', function() {
        if ($(this).val() === 'Married') {
            $('#marriage_info').show();
        } else {
            $('#marriage_info').hide();
            $('input[name="marriage_date"], input[name="spouse_name"]').val('');
        }
    });
</script>