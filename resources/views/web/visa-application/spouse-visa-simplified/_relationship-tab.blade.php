{{-- FILE: resources/views/web/visa-application/spouse-visa-simplified/_relationship-tab.blade.php --}}
{{-- FIXED: Removed all non-I-130 fields, kept only marriage details + previous marriages --}}

<div class="relationship-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-heart me-2 text-primary"></i>Relationship Information
    </h4>
    <p class="text-muted mb-4">Provide details about your marriage</p>

    <!-- Marriage Information (I-130 Part 2, Items 17-20) -->
    <h5 class="mb-3"><i class="fa fa-ring me-2"></i>Marriage Details</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marriage_date', 'Date of Marriage') }}
                <span class="text-danger">*</span>
                {{ Form::text('marriage_date', optional($application)->marriage_date ? optional($application)->marriage_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_times_married', 'How many times have you been married?') }}
                <span class="text-danger">*</span>
                {{ Form::number('sponsor_times_married', optional($application)->sponsor_times_married ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Number of times',
                    'required' => true,
                    'min' => 1
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marriage_location_city', 'City of Marriage') }}
                <span class="text-danger">*</span>
                {{ Form::text('marriage_location_city', optional($application)->marriage_location_city ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'City where married',
                    'required' => true,
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marriage_location_state', 'State (if married in USA)') }}
                {{ Form::text('marriage_location_state', optional($application)->marriage_location_state ?? '', [
                    'class' => 'form-control state-format',
                    'placeholder' => 'Two-letter code (e.g., CA)',
                    'maxlength' => 2,
                    'pattern' => '[A-Z]{2}',
                    'style' => 'text-transform: uppercase;'
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marriage_location_province', 'Province (if applicable)') }}
                {{ Form::text('marriage_location_province', optional($application)->marriage_location_province ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Province/Region',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marriage_location_country', 'Country of Marriage') }}
                <span class="text-danger">*</span>
                {{ Form::select('marriage_location_country', getAllCountry(), optional($application)->marriage_location_country ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <!-- Previous Marriages (I-130 Part 2, Items 21-24) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-history me-2"></i>Previous Marriages</h5>
    
    <!-- Sponsor Previous Marriages -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>Has the sponsor been previously married?</label>
                <span class="text-danger">*</span>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        {{ Form::radio('sponsor_previous_marriages', 'yes', 
                            (optional($application)->sponsor_previous_marriages ?? '') === 'yes', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_prev_yes',
                            'required' => true
                        ]) }}
                        <label class="form-check-label" for="sponsor_prev_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('sponsor_previous_marriages', 'no', 
                            (optional($application)->sponsor_previous_marriages ?? '') === 'no', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_prev_no',
                            'required' => true
                        ]) }}
                        <label class="form-check-label" for="sponsor_prev_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="sponsor_divorce_section" 
        style="display: {{ (optional($application)->sponsor_previous_marriages ?? '') === 'yes' ? 'block' : 'none' }};">
        <div class="col-md-12">
            <div class="alert alert-info">
                <i class="fa fa-info-circle me-2"></i>
                <strong>Note:</strong> If you were previously married, provide details about your most recent prior marriage.
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_prev_spouse_first_name', 'Previous Spouse First Name') }}
                {{ Form::text('sponsor_prev_spouse_first_name', optional($application)->sponsor_prev_spouse_first_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'First name',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_prev_spouse_last_name', 'Previous Spouse Last Name') }}
                {{ Form::text('sponsor_prev_spouse_last_name', optional($application)->sponsor_prev_spouse_last_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Last name',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_divorce_date', 'Date Previous Marriage Ended') }}
                {{ Form::text('sponsor_divorce_date', optional($application)->sponsor_divorce_date ? optional($application)->sponsor_divorce_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
            </div>
        </div>
    </div>

    <!-- Beneficiary Previous Marriages -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>Has the beneficiary been previously married?</label>
                <span class="text-danger">*</span>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        {{ Form::radio('beneficiary_previous_marriages', 'yes', 
                            (optional($application)->beneficiary_previous_marriages ?? '') === 'yes', [
                            'class' => 'form-check-input',
                            'id' => 'beneficiary_prev_yes',
                            'required' => true
                        ]) }}
                        <label class="form-check-label" for="beneficiary_prev_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('beneficiary_previous_marriages', 'no', 
                            (optional($application)->beneficiary_previous_marriages ?? '') === 'no', [
                            'class' => 'form-check-input',
                            'id' => 'beneficiary_prev_no',
                            'required' => true
                        ]) }}
                        <label class="form-check-label" for="beneficiary_prev_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="beneficiary_divorce_section" 
        style="display: {{ (optional($application)->beneficiary_previous_marriages ?? '') === 'yes' ? 'block' : 'none' }};">
        <div class="col-md-12">
            <div class="alert alert-info">
                <i class="fa fa-info-circle me-2"></i>
                <strong>Note:</strong> If your spouse was previously married, provide details about their most recent prior marriage.
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_prev_spouse_first_name', 'Previous Spouse First Name') }}
                {{ Form::text('beneficiary_prev_spouse_first_name', optional($application)->beneficiary_prev_spouse_first_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'First name',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_prev_spouse_last_name', 'Previous Spouse Last Name') }}
                {{ Form::text('beneficiary_prev_spouse_last_name', optional($application)->beneficiary_prev_spouse_last_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Last name',
                    'maxlength' => 50
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_divorce_date', 'Date Previous Marriage Ended') }}
                {{ Form::text('beneficiary_divorce_date', optional($application)->beneficiary_divorce_date ? optional($application)->beneficiary_divorce_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 pt-4 border-top">
        {{ Form::button('<i class="fa fa-arrow-left me-2"></i>Previous: Beneficiary', [
            'class' => 'btn btn-outline-secondary',
            'type' => 'button',
            'onclick' => '$(\'#beneficiary-tab\').tab(\'show\')'
        ]) }}
        <div>
            <small class="text-muted me-3">
                <i class="fa fa-info-circle"></i> Complete all required fields to continue
            </small>
        </div>
    </div>
</div>

<script>
// Show/hide previous marriage details
$(document).on('change', 'input[name="sponsor_previous_marriages"]', function() {
    if ($(this).val() === 'yes') {
        $('#sponsor_divorce_section').slideDown();
    } else {
        $('#sponsor_divorce_section').slideUp();
        $('#sponsor_divorce_section input').val('');
    }
});

$(document).on('change', 'input[name="beneficiary_previous_marriages"]', function() {
    if ($(this).val() === 'yes') {
        $('#beneficiary_divorce_section').slideDown();
    } else {
        $('#beneficiary_divorce_section').slideUp();
        $('#beneficiary_divorce_section input').val('');
    }
});

// Format state input to uppercase
$(document).on('input', '.state-format', function() {
    this.value = this.value.toUpperCase().replace(/[^A-Z]/g, '');
});
</script>