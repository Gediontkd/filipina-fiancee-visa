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
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('status_at_last_entry', 'Status at Last Entry') }}
                <span class="text-danger">*</span>
                {{ Form::text('status_at_last_entry', optional($application)->status_at_last_entry ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'e.g., K-1 Fiance, B-2 Tourist, Parolee',
                    'required' => true
                ]) }}
                <small class="text-muted">Type of visa/status you used to enter the U.S. most recently.</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('i94_expiration_date', 'I-94 Expiration Date') }}
                {{ Form::text('i94_expiration_date', optional($application)->i94_expiration_date ? optional($application)->i94_expiration_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
                <small class="text-muted">Enter the "Admit Until" date from your I-94 or "D/S".</small>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between flex-wrap mt-4 gap-2">
        {{ Form::button('<i class="fa fa-arrow-left me-2"></i>Previous', [
            'class' => 'btn btn-primary aos-action-btn',
            'type' => 'button',
            'onclick' => '$(\'#family-tab\').tab(\'show\')'
        ]) }}
        <button type="button" class="btn btn-primary next-step aos-action-btn" data-next-tab="sponsor-tab">
            Next <i class="fa fa-arrow-right ms-2"></i>
        </button>
    </div>
</div>