<div class="relationship-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-heart me-2 text-primary"></i>Relationship Information
    </h4>
    <p class="text-muted mb-4">Provide details about your marriage and relationship history</p>

    <!-- Marriage Information -->
    <h5 class="mb-3"><i class="fa fa-ring me-2"></i>Marriage Details</h5>
    <div class="row">
        <div class="col-md-4">
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
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('marriage_location_city', 'City of Marriage') }}
                <span class="text-danger">*</span>
                {{ Form::text('marriage_location_city', optional($application)->marriage_location_city ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'City where married',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
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

    <!-- First Meeting -->
    <h5 class="mb-3 mt-4"><i class="fa fa-users me-2"></i>First Meeting</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('first_met_date', 'Date You First Met') }}
                <span class="text-danger">*</span>
                {{ Form::text('first_met_date', optional($application)->first_met_date ? optional($application)->first_met_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY',
                    'required' => true
                ]) }}
                <small class="form-text text-muted">Must be before marriage date</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('first_met_location', 'Where You First Met') }}
                <span class="text-danger">*</span>
                {{ Form::text('first_met_location', optional($application)->first_met_location ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'City, Country',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <!-- In-Person Meetings -->
    <h5 class="mb-3 mt-4"><i class="fa fa-calendar-check me-2"></i>In-Person Meetings</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('times_met_in_person', 'Times Met in Person') }}
                <span class="text-danger">*</span>
                {{ Form::number('times_met_in_person', optional($application)->times_met_in_person ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Number of times',
                    'required' => true,
                    'min' => 1
                ]) }}
                <small class="form-text text-muted">Must be at least 1 for spouse visa</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('last_meeting_date', 'Date of Last Meeting') }}
                {{ Form::text('last_meeting_date', optional($application)->last_meeting_date ? optional($application)->last_meeting_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
            </div>
        </div>
    </div>

    <!-- Communication -->
    <h5 class="mb-3 mt-4"><i class="fa fa-comments me-2"></i>Communication</h5>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                {{ Form::label('communication_methods', 'How Do You Communicate?') }}
                <span class="text-danger">*</span>
                {{ Form::text('communication_methods', optional($application)->communication_methods ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'e.g., WhatsApp, Video calls, Phone, Email, In-person visits',
                    'required' => true
                ]) }}
                <small class="form-text text-muted">List all methods you use to stay in contact</small>
            </div>
        </div>
    </div>

    <!-- Relationship Description -->
    <h5 class="mb-3 mt-4"><i class="fa fa-file-alt me-2"></i>Relationship Description</h5>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                {{ Form::label('relationship_description', 'Describe Your Relationship') }}
                <span class="text-danger">*</span>
                {{ Form::textarea('relationship_description', optional($application)->relationship_description ?? '', [
                    'class' => 'form-control',
                    'rows' => 6,
                    'placeholder' => 'Tell the story of your relationship: How you met, how your relationship developed, important moments together, plans for the future, etc. (Minimum 50 characters)',
                    'required' => true,
                    'minlength' => 50,
                    'maxlength' => 2000
                ]) }}
                <small class="form-text text-muted">
                    <span id="char-count">{{ strlen(optional($application)->relationship_description ?? '') }}</span>/2000 characters
                    (Minimum 50 characters required)
                </small>
            </div>
        </div>
    </div>

    <!-- Previous Marriages -->
    <h5 class="mb-3 mt-4"><i class="fa fa-history me-2"></i>Previous Marriages</h5>
    
    <!-- Sponsor Previous Marriages -->
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>Has the sponsor been previously married?</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        {{ Form::radio('sponsor_previous_marriages', 'yes', 
                            (optional($application)->sponsor_previous_marriages ?? '') === 'yes', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_prev_yes'
                        ]) }}
                        <label class="form-check-label" for="sponsor_prev_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('sponsor_previous_marriages', 'no', 
                            (optional($application)->sponsor_previous_marriages ?? '') === 'no', [
                            'class' => 'form-check-input',
                            'id' => 'sponsor_prev_no'
                        ]) }}
                        <label class="form-check-label" for="sponsor_prev_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="sponsor_divorce_section" 
        style="display: {{ (optional($application)->sponsor_previous_marriages ?? '') === 'yes' ? 'block' : 'none' }};">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('sponsor_divorce_date', 'Date Previous Marriage Ended') }}
                {{ Form::text('sponsor_divorce_date', optional($application)->sponsor_divorce_date ? optional($application)->sponsor_divorce_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
                <small class="form-text text-muted">Divorce, annulment, or death date</small>
            </div>
        </div>
    </div>

    <!-- Beneficiary Previous Marriages -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>Has the beneficiary been previously married?</label>
                <div class="d-flex gap-3">
                    <div class="form-check">
                        {{ Form::radio('beneficiary_previous_marriages', 'yes', 
                            (optional($application)->beneficiary_previous_marriages ?? '') === 'yes', [
                            'class' => 'form-check-input',
                            'id' => 'beneficiary_prev_yes'
                        ]) }}
                        <label class="form-check-label" for="beneficiary_prev_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('beneficiary_previous_marriages', 'no', 
                            (optional($application)->beneficiary_previous_marriages ?? '') === 'no', [
                            'class' => 'form-check-input',
                            'id' => 'beneficiary_prev_no'
                        ]) }}
                        <label class="form-check-label" for="beneficiary_prev_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="beneficiary_divorce_section" 
        style="display: {{ (optional($application)->beneficiary_previous_marriages ?? '') === 'yes' ? 'block' : 'none' }};">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('beneficiary_divorce_date', 'Date Previous Marriage Ended') }}
                {{ Form::text('beneficiary_divorce_date', optional($application)->beneficiary_divorce_date ? optional($application)->beneficiary_divorce_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
                <small class="form-text text-muted">Divorce, annulment, or death date</small>
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
                <i class="fa fa-info-circle"></i> Complete all required fields to enable submission
            </small>
        </div>
    </div>
</div>

<script>
    // Character counter for relationship description
    $(document).on('input', 'textarea[name="relationship_description"]', function() {
        const length = $(this).val().length;
        $('#char-count').text(length);
    });

    // Show/hide divorce date fields based on previous marriage selection
    $(document).on('change', 'input[name="sponsor_previous_marriages"]', function() {
        if ($(this).val() === 'yes') {
            $('#sponsor_divorce_section').show();
        } else {
            $('#sponsor_divorce_section').hide();
            $('input[name="sponsor_divorce_date"]').val('');
        }
    });

    $(document).on('change', 'input[name="beneficiary_previous_marriages"]', function() {
        if ($(this).val() === 'yes') {
            $('#beneficiary_divorce_section').show();
        } else {
            $('#beneficiary_divorce_section').hide();
            $('input[name="beneficiary_divorce_date"]').val('');
        }
    });
</script>