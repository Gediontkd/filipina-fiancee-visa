<div class="background-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-clipboard-list me-2 text-primary"></i>Background Questions
    </h4>
    <p class="text-muted mb-4">Answer the following questions truthfully. These are standard questions required by USCIS.</p>

    <div class="alert alert-info">
        <i class="fa fa-info-circle me-2"></i>
        <strong>Important:</strong> Answer all questions honestly. False information can result in denial of your application and future immigration benefits.
    </div>

    <!-- Criminal History -->
    <h5 class="mb-3 mt-4"><i class="fa fa-gavel me-2"></i>Criminal History</h5>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-4">
                <label class="d-block mb-2">
                    <strong>Have you EVER been arrested, cited, charged, or detained for any reason by any law enforcement official (including but not limited to for any driving violation)?</strong>
                </label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        {{ Form::radio('arrested_or_convicted', 'yes', 
                            (optional($application)->arrested_or_convicted ?? '') === 'yes', [
                            'class' => 'form-check-input',
                            'id' => 'arrested_yes'
                        ]) }}
                        <label class="form-check-label" for="arrested_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('arrested_or_convicted', 'no', 
                            (optional($application)->arrested_or_convicted ?? '') === 'no', [
                            'class' => 'form-check-input',
                            'id' => 'arrested_no'
                        ]) }}
                        <label class="form-check-label" for="arrested_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Immigration Violations -->
    <h5 class="mb-3 mt-4"><i class="fa fa-exclamation-triangle me-2"></i>Immigration Violations</h5>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-4">
                <label class="d-block mb-2">
                    <strong>Have you EVER violated the terms or conditions of your nonimmigrant status (overstayed, worked without authorization, etc.)?</strong>
                </label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        {{ Form::radio('immigration_violations', 'yes', 
                            (optional($application)->immigration_violations ?? '') === 'yes', [
                            'class' => 'form-check-input',
                            'id' => 'violations_yes'
                        ]) }}
                        <label class="form-check-label" for="violations_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('immigration_violations', 'no', 
                            (optional($application)->immigration_violations ?? '') === 'no', [
                            'class' => 'form-check-input',
                            'id' => 'violations_no'
                        ]) }}
                        <label class="form-check-label" for="violations_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Public Assistance -->
    <h5 class="mb-3 mt-4"><i class="fa fa-hand-holding-usd me-2"></i>Public Benefits</h5>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-4">
                <label class="d-block mb-2">
                    <strong>Have you EVER received public assistance (welfare, food stamps, Medicaid, etc.) in the United States?</strong>
                </label>
                <div class="d-flex gap-4">
                    <div class="form-check">
                        {{ Form::radio('public_assistance', 'yes', 
                            (optional($application)->public_assistance ?? '') === 'yes', [
                            'class' => 'form-check-input',
                            'id' => 'assistance_yes'
                        ]) }}
                        <label class="form-check-label" for="assistance_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('public_assistance', 'no', 
                            (optional($application)->public_assistance ?? '') === 'no', [
                            'class' => 'form-check-input',
                            'id' => 'assistance_no'
                        ]) }}
                        <label class="form-check-label" for="assistance_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Explanation Section -->
    <div id="explanation_section" style="display: {{ 
        ((optional($application)->arrested_or_convicted ?? '') === 'yes' || 
         (optional($application)->immigration_violations ?? '') === 'yes' || 
         (optional($application)->public_assistance ?? '') === 'yes') ? 'block' : 'none' 
    }};">
        <h5 class="mb-3 mt-4"><i class="fa fa-comment-alt me-2"></i>Additional Explanation</h5>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-3">
                    {{ Form::label('background_explanation', 'Please provide detailed explanation for any "Yes" answers above') }}
                    {{ Form::textarea('background_explanation', optional($application)->background_explanation ?? '', [
                        'class' => 'form-control',
                        'rows' => 6,
                        'placeholder' => 'Provide complete details including dates, locations, circumstances, and outcomes. Be thorough and honest.',
                        'maxlength' => 2000
                    ]) }}
                    <small class="form-text text-muted">
                        <span id="bg-char-count">{{ strlen(optional($application)->background_explanation ?? '') }}</span>/2000 characters
                    </small>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-warning mt-4">
        <i class="fa fa-shield-alt me-2"></i>
        <strong>Note:</strong> Answering "Yes" to these questions does not automatically disqualify you. However, providing false information will result in denial and may affect future applications.
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between mt-4 pt-4 border-top">
        {{ Form::button('<i class="fa fa-arrow-left me-2"></i>Previous: Sponsor', [
            'class' => 'btn btn-outline-secondary',
            'type' => 'button',
            'onclick' => '$(\'#sponsor-tab\').tab(\'show\')'
        ]) }}
        <div>
            <small class="text-muted me-3">
                <i class="fa fa-info-circle"></i> Complete all required fields to enable submission
            </small>
        </div>
    </div>
</div>

<script>
    // Character counter for explanation
    $(document).on('input', 'textarea[name="background_explanation"]', function() {
        const length = $(this).val().length;
        $('#bg-char-count').text(length);
    });

    // Show/hide explanation section
    $(document).on('change', 'input[name="arrested_or_convicted"], input[name="immigration_violations"], input[name="public_assistance"]', function() {
        const showExplanation = $('input[name="arrested_or_convicted"]:checked').val() === 'yes' ||
                               $('input[name="immigration_violations"]:checked').val() === 'yes' ||
                               $('input[name="public_assistance"]:checked').val() === 'yes';
        
        if (showExplanation) {
            $('#explanation_section').show();
        } else {
            $('#explanation_section').hide();
            $('textarea[name="background_explanation"]').val('');
        }
    });
</script>