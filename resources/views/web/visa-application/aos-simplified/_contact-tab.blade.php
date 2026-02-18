<div class="contact-information-section">
    <div class="section-header mb-4">
        <h4 class="border-bottom pb-2">Part 10. Applicant's Contact Information, Certification, and Signature</h4>
        <p class="text-muted small">Provide your contact information below. Certification and signature are not required for this simplified online form.</p>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light fw-bold">
            Applicant's Contact Information
        </div>
        <div class="card-body">
            <p class="small mb-4">Provide your daytime telephone number, mobile telephone number (if any), and email address (if any).</p>

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label fw-bold small">1. Applicant's Daytime Telephone Number</label>
                        {{ Form::text('applicant_phone', optional($application)->applicant_phone ?? '', [
                            'class' => 'form-control',
                            'placeholder' => '(000) 000-0000'
                        ]) }}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="form-label fw-bold small">2. Applicant's Mobile Telephone Number (if any)</label>
                        {{ Form::text('applicant_mobile_phone', optional($application)->applicant_mobile_phone ?? '', [
                            'class' => 'form-control',
                            'placeholder' => '(000) 000-0000'
                        ]) }}
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label class="form-label fw-bold small">3. Applicant's Email Address (if any)</label>
                        {{ Form::email('applicant_email', optional($application)->applicant_email ?? '', [
                            'class' => 'form-control',
                            'placeholder' => 'example@email.com'
                        ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Interpreter Toggle -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="form-group">
                <label class="form-label fw-bold">Did you use an interpreter?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="interpreter_data[used_interpreter]" id="interpreter_yes" value="yes" {{ (optional($application)->interpreter_data['used_interpreter'] ?? '') === 'yes' ? 'checked' : '' }}>
                        <label class="form-check-label" for="interpreter_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="interpreter_data[used_interpreter]" id="interpreter_no" value="no" {{ (optional($application)->interpreter_data['used_interpreter'] ?? '') === 'no' ? 'checked' : '' }}>
                        <label class="form-check-label" for="interpreter_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Interpreter Details Section -->
    <div id="interpreter_section" style="display: {{ (optional($application)->interpreter_data['used_interpreter'] ?? '') === 'yes' ? 'block' : 'none' }};">
        <div class="section-header mb-4">
            <h4 class="border-bottom pb-2">Interpreter's Contact Information, Certification, and Signature</h4>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">
                Interpreter's Full Name
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold small">1. Interpreter's Family Name (Last Name)</label>
                            {{ Form::text('interpreter_data[last_name]', optional($application)->interpreter_data['last_name'] ?? '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold small">Interpreter's Given Name (First Name)</label>
                            {{ Form::text('interpreter_data[first_name]', optional($application)->interpreter_data['first_name'] ?? '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label fw-bold small">2. Interpreter's Business or Organization Name (if any)</label>
                            {{ Form::text('interpreter_data[business_name]', optional($application)->interpreter_data['business_name'] ?? '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">
                Interpreter's Contact Information
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold small">3. Interpreter's Daytime Telephone Number</label>
                            {{ Form::text('interpreter_data[phone]', optional($application)->interpreter_data['phone'] ?? '', ['class' => 'form-control', 'placeholder' => '(000) 000-0000']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold small">4. Interpreter's Mobile Telephone Number (if any)</label>
                            {{ Form::text('interpreter_data[mobile]', optional($application)->interpreter_data['mobile'] ?? '', ['class' => 'form-control', 'placeholder' => '(000) 000-0000']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label fw-bold small">5. Interpreter's Email Address (if any)</label>
                            {{ Form::email('interpreter_data[email]', optional($application)->interpreter_data['email'] ?? '', ['class' => 'form-control', 'placeholder' => 'example@email.com']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">
                Interpreter's Certification and Signature
            </div>
            <div class="card-body">
                <div class="alert alert-light border small mb-4">
                    <p class="mb-0">I certify, under penalty of perjury, that I am fluent in English and 
                        <input type="text" name="interpreter_data[language]" class="form-control d-inline-block mx-1" style="width: 150px; height: 30px;" value="{{ optional($application)->interpreter_data['language'] ?? '' }}" placeholder="Language">
                        and I have interpreted every question on the application and Instructions and interpreted the applicant's answers to the questions in that language, and the applicant informed me that he or she understood every instruction, question, and answer on the application.
                    </p>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold small">Interpreter's Signature</label>
                            {{ Form::text('interpreter_data[signature]', optional($application)->interpreter_data['signature'] ?? '', ['class' => 'form-control', 'placeholder' => 'Full Name']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold small">Date of Signature (mm/dd/yyyy)</label>
                            {{ Form::text('interpreter_data[signature_date]', optional($application)->interpreter_data['signature_date'] ?? '', ['class' => 'form-control datePicker', 'placeholder' => 'MM/DD/YYYY']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Preparer Toggle -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="form-group">
                <label class="form-label fw-bold">Did someone prepare this application for you other than the applicant?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="preparer_data[used_preparer]" id="preparer_yes" value="yes" {{ (optional($application)->preparer_data['used_preparer'] ?? '') === 'yes' ? 'checked' : '' }}>
                        <label class="form-check-label" for="preparer_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="preparer_data[used_preparer]" id="preparer_no" value="no" {{ (optional($application)->preparer_data['used_preparer'] ?? '') === 'no' ? 'checked' : '' }}>
                        <label class="form-check-label" for="preparer_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Preparer Details Section -->
    <div id="preparer_section" style="display: {{ (optional($application)->preparer_data['used_preparer'] ?? '') === 'yes' ? 'block' : 'none' }};">
        <div class="section-header mb-4">
            <h4 class="border-bottom pb-2">Contact Information, Certification, and Signature of the Person Preparing this Application, if Other Than the Applicant</h4>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">
                Preparer's Full Name
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold small">1. Preparer's Family Name (Last Name)</label>
                            {{ Form::text('preparer_data[last_name]', optional($application)->preparer_data['last_name'] ?? '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold small">Preparer's Given Name (First Name)</label>
                            {{ Form::text('preparer_data[first_name]', optional($application)->preparer_data['first_name'] ?? '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label fw-bold small">2. Preparer's Business or Organization Name (if any)</label>
                            {{ Form::text('preparer_data[business_name]', optional($application)->preparer_data['business_name'] ?? '', ['class' => 'form-control']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light fw-bold">
                Preparer's Contact Information
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold small">3. Preparer's Daytime Telephone Number</label>
                            {{ Form::text('preparer_data[phone]', optional($application)->preparer_data['phone'] ?? '', ['class' => 'form-control', 'placeholder' => '(000) 000-0000']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-bold small">4. Preparer's Mobile Telephone Number (if any)</label>
                            {{ Form::text('preparer_data[mobile]', optional($application)->preparer_data['mobile'] ?? '', ['class' => 'form-control', 'placeholder' => '(000) 000-0000']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-label fw-bold small">5. Preparer's Email Address (if any)</label>
                            {{ Form::email('preparer_data[email]', optional($application)->preparer_data['email'] ?? '', ['class' => 'form-control', 'placeholder' => 'example@email.com']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Interpreter toggle
    $('input[name="interpreter_data[used_interpreter]"]').on('change', function() {
        if ($(this).val() === 'yes') {
            $('#interpreter_section').show();
        } else {
            $('#interpreter_section').hide();
        }
    });

    // Preparer toggle
    $('input[name="preparer_data[used_preparer]"]').on('change', function() {
        if ($(this).val() === 'yes') {
            $('#preparer_section').show();
        } else {
            $('#preparer_section').hide();
        }
    });
});
</script>
