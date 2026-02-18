<div class="applicant-section">
    <h4 class="mb-4 border-bottom pb-2">
        Part 1. Information About You (Person applying for lawful permanent residence)
    </h4>
    <p class="text-muted mb-4">Enter information about the person adjusting status</p>

    <!-- 1. Your Current Legal Name -->
    <h5 class="mb-3">1. Your Current Legal Name</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_last_name', 'Family Name (Last Name)') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_last_name', optional($application)->applicant_last_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Last name',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_first_name', 'Given Name (First Name)') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_first_name', optional($application)->applicant_first_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'First name',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_middle_name', 'Middle Name') }}
                {{ Form::text('applicant_middle_name', optional($application)->applicant_middle_name ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Middle name'
                ]) }}
            </div>
        </div>
    </div>

    <!-- 2. Other Names Used -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="form-group mb-3">
                <label>2. Have you ever used any other names?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('has_other_names', 1, optional($application)->has_other_names === 1, ['class' => 'form-check-input', 'id' => 'has_other_names_yes']) }}
                        <label class="form-check-label" for="has_other_names_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('has_other_names', 0, optional($application)->has_other_names === 0, ['class' => 'form-check-input', 'id' => 'has_other_names_no']) }}
                        <label class="form-check-label" for="has_other_names_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="other-names-section" style="display: {{ optional($application)->has_other_names === 1 ? 'block' : 'none' }};">
        <div class="col-12">
            <div class="form-group mb-3">
                <label class="small">2.a Other Names Used (if "Yes" to 2)</label>
                <div id="other-names-container">
                    @php
                        $otherNames = optional($application)->applicant_other_names ?? [];
                        if (empty($otherNames)) {
                            $otherNames = [['family_name' => '', 'given_name' => '', 'middle_name' => '']];
                        }
                    @endphp
                    
                    @foreach($otherNames as $index => $name)
                        <div class="other-name-item border p-3 mb-3 rounded bg-light shadow-sm">
                            <div class="d-flex justify-content-between mb-2">
                                <h6>Other Name #{{ $index + 1 }}</h6>
                                @if($index > 0)
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-other-name"><i class="fa fa-trash"></i></button>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label class="small">Family Name (Last Name)</label>
                                    <input type="text" name="applicant_other_names[{{ $index }}][family_name]" class="form-control" value="{{ $name['family_name'] ?? '' }}" placeholder="Last Name">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="small">Given Name (First Name)</label>
                                    <input type="text" name="applicant_other_names[{{ $index }}][given_name]" class="form-control" value="{{ $name['given_name'] ?? '' }}" placeholder="First Name">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="small">Middle Name</label>
                                    <input type="text" name="applicant_other_names[{{ $index }}][middle_name]" class="form-control" value="{{ $name['middle_name'] ?? '' }}" placeholder="Middle Name">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <button type="button" class="btn btn-sm btn-outline-primary add-other-name" data-type="other-name">
                    <i class="fa fa-plus me-1"></i>Add Another Name
                </button>
            </div>
        </div>
    </div>

    <!-- 3. Date of Birth -->
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_dob', '3. Date of Birth (mm/dd/yyyy)') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_dob', optional($application)->applicant_dob ? optional($application)->applicant_dob->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group mb-3">
                <label>3.a Have you ever used any other date of birth?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('has_other_dob', 1, optional($application)->has_other_dob == 1, ['class' => 'form-check-input', 'id' => 'has_other_dob_yes']) }}
                        <label class="form-check-label" for="has_other_dob_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('has_other_dob', 0, optional($application)->has_other_dob == 0, ['class' => 'form-check-input', 'id' => 'has_other_dob_no']) }}
                        <label class="form-check-label" for="has_other_dob_no">No</label>
                    </div>
                </div>
                <div id="other_dob_field" class="mt-2" style="display: {{ optional($application)->has_other_dob == 1 ? 'block' : 'none' }};">
                    <label class="small">3.b Other dates of birth (if "Yes" to 3.a)</label>
                    {{ Form::text('other_dobs', is_array(optional($application)->other_dobs) ? implode(', ', optional($application)->other_dobs) : optional($application)->other_dobs, [
                        'class' => 'form-control',
                        'placeholder' => 'm/d/yyyy, m/d/yyyy'
                    ]) }}
                </div>
            </div>
        </div>
    </div>

    <!-- 4-5. A-Numbers -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="form-group mb-3">
                <label>4. Do you have an Alien Registration Number (A-Number)?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('has_a_number', 1, optional($application)->has_a_number === 1, ['class' => 'form-check-input', 'id' => 'has_a_number_yes']) }}
                        <label class="form-check-label" for="has_a_number_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('has_a_number', 0, optional($application)->has_a_number === 0, ['class' => 'form-check-input', 'id' => 'has_a_number_no']) }}
                        <label class="form-check-label" for="has_a_number_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="a-number-field" style="display: {{ optional($application)->has_a_number === 1 ? 'flex' : 'none' }};">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label>4.a Your A-Number (if "Yes" to 4)</label>
                {{ Form::text('a_number', optional($application)->a_number ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'A-123456789',
                    'maxlength' => 11
                ]) }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="form-group mb-3">
                <label>5. Have you ever used, or been assigned, any other A-Number?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('has_other_a_numbers', 1, optional($application)->has_other_a_numbers === 1, ['class' => 'form-check-input', 'id' => 'has_other_a_numbers_yes']) }}
                        <label class="form-check-label" for="has_other_a_numbers_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('has_other_a_numbers', 0, optional($application)->has_other_a_numbers === 0, ['class' => 'form-check-input', 'id' => 'has_other_a_numbers_no']) }}
                        <label class="form-check-label" for="has_other_a_numbers_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="other-a-numbers-section" style="display: {{ optional($application)->has_other_a_numbers === 1 ? 'block' : 'none' }};">
        <div class="col-12">
            <div class="form-group mb-3">
                <label>5.a Other A-Numbers (if "Yes" to 5)</label>
                <div id="other-a-numbers-container">
                    @php
                        $otherANumbers = optional($application)->other_a_numbers ?? [];
                        if (empty($otherANumbers)) $otherANumbers = [''];
                    @endphp
                    @foreach($otherANumbers as $index => $aNumber)
                        <div class="other-a-number-item mb-2">
                            <div class="d-flex gap-2 align-items-center">
                                <input type="text" name="other_a_numbers[]" class="form-control" value="{{ $aNumber }}" placeholder="A-Number" maxlength="11">
                                @if($index > 0)
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-other-a-number"><i class="fa fa-trash"></i></button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary add-other-a-number mt-1">
                    <i class="fa fa-plus me-1"></i>Add Another A-Number
                </button>
            </div>
        </div>
    </div>

    <!-- 6. Sex -->
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('applicant_gender', '6. Sex') }}
                <span class="text-danger">*</span>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('applicant_gender', 'Male', optional($application)->applicant_gender == 'Male', ['class' => 'form-check-input', 'id' => 'gender_male', 'required' => true]) }}
                        <label class="form-check-label" for="gender_male">Male</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('applicant_gender', 'Female', optional($application)->applicant_gender == 'Female', ['class' => 'form-check-input', 'id' => 'gender_female', 'required' => true]) }}
                        <label class="form-check-label" for="gender_female">Female</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 7. Place of Birth -->
    <div class="row mt-3">
        <div class="col-12">
            <label class="fw-bold">7. Place of Birth</label>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('applicant_place_of_birth', 'City or Town of Birth') }}
                <span class="text-danger">*</span>
                {{ Form::text('applicant_place_of_birth', optional($application)->applicant_place_of_birth ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'City or Town',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('applicant_birth_country', 'Country of Birth') }}
                <span class="text-danger">*</span>
                {{ Form::select('applicant_birth_country', getCountries(), optional($application)->applicant_birth_country ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '-Select Country-',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <!-- 8-9. Citizenship and USCIS Account -->
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('applicant_citizenship', '8. Country of Citizenship or Nationality') }}
                <span class="text-danger">*</span>
                {{ Form::select('applicant_citizenship', getCountries(), optional($application)->applicant_citizenship ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('uscis_account_number', '9. USCIS Online Account Number (if any)') }}
                {{ Form::text('uscis_account_number', optional($application)->uscis_account_number ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Online account number'
                ]) }}
            </div>
        </div>
    </div>

    {{-- Recent Immigration History (Item 10) --}}
    <h5 class="mb-3 mt-4">10. Recent Immigration History</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('passport_number', 'Passport or Travel Document Number Used at Last Arrival') }}
                {{ Form::text('passport_number', optional($application)->passport_number ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Number'
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('passport_expiration_date', 'Expiration Date of this Passport or Travel Document') }}
                {{ Form::text('passport_expiration_date', optional($application)->passport_expiration_date ? optional($application)->passport_expiration_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                {{ Form::label('passport_issuing_country', 'Country that Issued this Passport or Travel Document') }}
                {{ Form::select('passport_issuing_country', getCountries(), optional($application)->passport_issuing_country ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '-Select Country-'
                ]) }}
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('nonimmigrant_visa_number', 'Nonimmigrant Visa Number Used During Most Recent Arrival (if any)') }}
                {{ Form::text('nonimmigrant_visa_number', optional($application)->nonimmigrant_visa_number ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Visa Number'
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('nonimmigrant_visa_issue_date', 'Date Nonimmigrant Visa Was Issued (mm/dd/yyyy)') }}
                {{ Form::text('nonimmigrant_visa_issue_date', optional($application)->nonimmigrant_visa_issue_date ? optional($application)->nonimmigrant_visa_issue_date->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <label class="fw-bold">Place and Date of Last Arrival into the United States</label>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="small">City or Town</label>
                {{ Form::text('last_arrival_city', optional($application)->last_arrival_city ?? '', ['class' => 'form-control', 'placeholder' => 'City']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="small">State</label>
                {{ Form::text('last_arrival_state', optional($application)->last_arrival_state ?? '', ['class' => 'form-control', 'placeholder' => 'State']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group mb-3">
                <label class="small">Date of Last Arrival (mm/dd/yyyy)</label>
                {{ Form::text('last_arrival_date', optional($application)->last_arrival_date ? optional($application)->last_arrival_date->format('m/d/Y') : '', ['class' => 'form-control datePicker', 'placeholder' => 'MM/DD/YYYY']) }}
            </div>
        </div>
    </div>

    {{-- When I last arrived (Item 11) --}}
    <div class="row mt-3">
        <div class="col-12">
            <label class="fw-bold">11. When I last arrived in the United States...</label>
            <div class="form-check mb-2">
                {{ Form::radio('immigration_entry_type', 'admitted', optional($application)->immigration_entry_type === 'admitted', ['class' => 'form-check-input','id' => 'entry_admitted']) }}
                <label class="form-check-label" for="entry_admitted">I was inspected at a Port of Entry and admitted as (e.g., visitor, student)</label>
            </div>
            <div class="ms-4 mb-3" id="admitted_status_container" style="display: {{ optional($application)->immigration_entry_type === 'admitted' ? 'block' : 'none' }};">
                {{ Form::text('immigration_entry_status_admitted', optional($application)->immigration_entry_type === 'admitted' ? optional($application)->immigration_entry_status : '', ['class' => 'form-control', 'placeholder' => 'Enter status']) }}
            </div>

            <div class="form-check mb-2">
                {{ Form::radio('immigration_entry_type', 'paroled', optional($application)->immigration_entry_type === 'paroled', ['class' => 'form-check-input','id' => 'entry_paroled']) }}
                <label class="form-check-label" for="entry_paroled">I was inspected at a Port of Entry and paroled as (e.g., humanitarian parole)</label>
            </div>
            <div class="ms-4 mb-3" id="paroled_status_container" style="display: {{ optional($application)->immigration_entry_type === 'paroled' ? 'block' : 'none' }};">
                {{ Form::text('immigration_entry_status_paroled', optional($application)->immigration_entry_type === 'paroled' ? optional($application)->immigration_entry_status : '', ['class' => 'form-control', 'placeholder' => 'Enter parole type']) }}
            </div>

            <div class="form-check mb-2">
                {{ Form::radio('immigration_entry_type', 'no_admission', optional($application)->immigration_entry_type === 'no_admission', ['class' => 'form-check-input','id' => 'entry_no_admission']) }}
                <label class="form-check-label" for="entry_no_admission">I came into the United States without admission or parole.</label>
            </div>

            <div class="form-check mb-2">
                {{ Form::radio('immigration_entry_type', 'other', optional($application)->immigration_entry_type === 'other', ['class' => 'form-check-input','id' => 'entry_other']) }}
                <label class="form-check-label" for="entry_other">Other</label>
            </div>
            <div class="ms-4 mb-3" id="other_status_container" style="display: {{ optional($application)->immigration_entry_type === 'other' ? 'block' : 'none' }};">
                {{ Form::text('immigration_entry_status_other', optional($application)->immigration_entry_type === 'other' ? optional($application)->immigration_entry_status : '', ['class' => 'form-control', 'placeholder' => 'Enter status']) }}
            </div>
            {{ Form::hidden('immigration_entry_status', optional($application)->immigration_entry_status ?? '') }}
        </div>
    </div>

    <!-- 15. Form I-94 -->
    <div class="row mt-3">
        <div class="col-12">
    <!-- 12. Form I-94 Arrival/Departure Record -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="alert alert-info py-2 small mb-3">
                <i class="fa fa-info-circle me-1"></i>12. If you were issued a Form I-94 Arrival/Departure Record, provide the following information. Find your I-94 at <a href="https://i94.cbp.dhs.gov/I94/#/home" target="_blank" class="alert-link">i94.cbp.dhs.gov</a>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('i94_last_name', 'Family Name (Last Name) Used on Form I-94') }}
                        {{ Form::text('i94_last_name', optional($application)->i94_last_name ?? '', [
                            'class' => 'form-control',
                            'placeholder' => 'Last name'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('i94_first_name', 'Given Name (First Name) Used on Form I-94') }}
                        {{ Form::text('i94_first_name', optional($application)->i94_first_name ?? '', [
                            'class' => 'form-control',
                            'placeholder' => 'First name'
                        ]) }}
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                {{ Form::label('i94_number', '12. Form I-94 Arrival/Departure Record Number') }}
                {{ Form::text('i94_number', optional($application)->i94_number ?? '', [
                    'class' => 'form-control',
                    'placeholder' => '11-digit number'
                ]) }}
            </div>

            <div class="form-group mb-3">
                {{ Form::label('i94_expiration_date', 'Expiration Date of Authorized Stay Shown on Form I-94 (mm/dd/yyyy)') }}
                <div class="d-flex align-items-center gap-3">
                    <div class="flex-grow-1">
                        {{ Form::text('i94_expiration_date', optional($application)->i94_expiration_date ? optional($application)->i94_expiration_date->format('m/d/Y') : '', [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'MM/DD/YYYY',
                            'id' => 'i94_expiration_date'
                        ]) }}
                    </div>
                    <div class="form-check">
                        {{ Form::checkbox('i94_expiration_date_ds', 1, optional($application)->i94_expiration_date_ds == 1, [
                            'class' => 'form-check-input',
                            'id' => 'i94_expiration_date_ds'
                        ]) }}
                        <label class="form-check-label" for="i94_expiration_date_ds">D/S (Duration of Status)</label>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                {{ Form::label('i94_status', 'Immigration Status on Form I-94 (e.g., class of admission)') }}
                {{ Form::text('i94_status', optional($application)->i94_status ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Status'
                ]) }}
            </div>
        </div>
    </div>

    <!-- 13. First time in US? -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="form-group mb-3">
                <label>13. Was your last arrival the first time you were physically present in the United States?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('was_last_arrival_first_time', 1, optional($application)->was_last_arrival_first_time === 1, ['class' => 'form-check-input', 'id' => 'first_time_yes']) }}
                        <label class="form-check-label" for="first_time_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('was_last_arrival_first_time', 0, optional($application)->was_last_arrival_first_time === 0, ['class' => 'form-check-input', 'id' => 'first_time_no']) }}
                        <label class="form-check-label" for="first_time_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 14. Current immigration status -->
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('current_immigration_status', '14. What is your current immigration status (if it has changed since your last arrival)?') }}
                {{ Form::text('current_immigration_status', optional($application)->current_immigration_status ?? '', [
                    'class' => 'form-control',
                    'placeholder' => 'Current Status'
                ]) }}
            </div>
        </div>

        <!-- 15. Exp Date -->
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('current_immigration_status_expiration_date', '15. Expiration Date of Current Immigration Status (mm/dd/yyyy)') }}
                <div class="d-flex align-items-center gap-3">
                    <div class="flex-grow-1">
                        {{ Form::text('current_immigration_status_expiration_date', optional($application)->current_immigration_status_expiration_date ? optional($application)->current_immigration_status_expiration_date->format('m/d/Y') : '', [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'MM/DD/YYYY',
                            'id' => 'current_immigration_status_expiration_date'
                        ]) }}
                    </div>
                    <div class="form-check">
                        {{ Form::checkbox('current_immigration_status_ds', 1, optional($application)->current_immigration_status_ds == 1, [
                            'class' => 'form-check-input',
                            'id' => 'current_immigration_status_ds'
                        ]) }}
                        <label class="form-check-label" for="current_immigration_status_ds">D/S</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 16. Crewman Visa? -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>16. Have you ever been issued an "alien crewman" visa?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('ever_issued_alien_crewman_visa', 1, optional($application)->ever_issued_alien_crewman_visa === 1, ['class' => 'form-check-input', 'id' => 'crewman_visa_yes']) }}
                        <label class="form-check-label" for="crewman_visa_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('ever_issued_alien_crewman_visa', 0, optional($application)->ever_issued_alien_crewman_visa === 0, ['class' => 'form-check-input', 'id' => 'crewman_visa_no']) }}
                        <label class="form-check-label" for="crewman_visa_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 17. Join vessel? -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>17. Did you last arrive in the United States to join a vessel as a seaman or crewman, or while serving in any capacity aboard a vessel or aircraft?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('last_arrival_as_crewman', 1, optional($application)->last_arrival_as_crewman === 1, ['class' => 'form-check-input', 'id' => 'join_vessel_yes']) }}
                        <label class="form-check-label" for="join_vessel_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('last_arrival_as_crewman', 0, optional($application)->last_arrival_as_crewman === 0, ['class' => 'form-check-input', 'id' => 'join_vessel_no']) }}
                        <label class="form-check-label" for="join_vessel_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- 18. Address Information -->
    <h5 class="mb-3 mt-4">18. Address Information</h5>
    <div class="row">
        <div class="col-12 mb-2">
            <label class="fw-bold">18.a Current U.S. Physical Address</label>
        </div>
        <div class="col-md-12 mb-3">
            {{ Form::label('applicant_in_care_of', 'In Care Of Name (if any)') }}
            {{ Form::text('applicant_in_care_of', optional($application)->applicant_in_care_of ?? '', ['class' => 'form-control', 'placeholder' => 'Full Name']) }}
        </div>
        <div class="col-md-12 mb-3">
            {{ Form::label('applicant_address', 'Street Number and Name') }}
            <span class="text-danger">*</span>
            {{ Form::text('applicant_address', optional($application)->applicant_address ?? '', ['class' => 'form-control', 'placeholder' => 'Street address', 'required' => true]) }}
        </div>
        <div class="col-md-4 mb-3">
            {{ Form::label('applicant_apt_ste_flr', 'Apt. Ste. Flr. Number') }}
            {{ Form::text('applicant_apt_ste_flr', optional($application)->applicant_apt_ste_flr ?? '', ['class' => 'form-control', 'placeholder' => 'Number']) }}
        </div>
        <div class="col-md-4 mb-3">
            {{ Form::label('applicant_city', 'City or Town') }}
            <span class="text-danger">*</span>
            {{ Form::text('applicant_city', optional($application)->applicant_city ?? '', ['class' => 'form-control', 'placeholder' => 'City', 'required' => true]) }}
        </div>
        <div class="col-md-2 mb-3">
            {{ Form::label('applicant_state', 'State') }}
            <span class="text-danger">*</span>
            {{ Form::text('applicant_state', optional($application)->applicant_state ?? '', ['class' => 'form-control', 'placeholder' => 'State', 'required' => true]) }}
        </div>
        <div class="col-md-2 mb-3">
            {{ Form::label('applicant_zip', 'ZIP Code') }}
            <span class="text-danger">*</span>
            {{ Form::text('applicant_zip', optional($application)->applicant_zip ?? '', ['class' => 'form-control', 'placeholder' => 'ZIP', 'required' => true]) }}
        </div>
        <div class="col-md-6 mb-3">
            {{ Form::label('applicant_date_resided_from', 'Date First Resided (mm/dd/yyyy)') }}
            {{ Form::text('applicant_date_resided_from', optional($application)->applicant_date_resided_from ? optional($application)->applicant_date_resided_from->format('m/d/Y') : '', [
                'class' => 'form-control datePicker',
                'placeholder' => 'MM/DD/YYYY'
            ]) }}
        </div>
    </div>

    <!-- 18.b/c Mailing Address Section -->
    <div class="mailing-address-toggle bg-light p-3 border rounded mb-4">
        <div class="form-check mb-2">
            {{ Form::checkbox('use_mailing_address', 1, optional($application)->use_mailing_address ?? false, [
                'class' => 'form-check-input',
                'id' => 'use_mailing_address_toggle'
            ]) }}
            <label class="form-check-label fw-bold" for="use_mailing_address_toggle">18.b Is your current mailing address different from your physical address?</label>
        </div>
        
        <div id="mailing_address_fields" class="mt-3 {{ optional($application)->use_mailing_address ? '' : 'd-none' }}">
            <h6 class="mb-3">18.c Current Mailing Address (if "Yes" to 18.b)</h6>
            <div class="row">
                <div class="col-md-12 mb-3">
                    {{ Form::label('mailing_in_care_of', 'In Care Of Name (if any)') }}
                    {{ Form::text('mailing_in_care_of', optional($application)->mailing_in_care_of ?? '', ['class' => 'form-control', 'placeholder' => 'Full Name']) }}
                </div>
                <div class="col-md-12 mb-3">
                    {{ Form::label('mailing_street', 'Street Number and Name') }}
                    {{ Form::text('mailing_street', optional($application)->mailing_street ?? '', ['class' => 'form-control', 'placeholder' => 'Street address']) }}
                </div>
                <div class="col-md-4 mb-3">
                    {{ Form::label('mailing_apt_ste_flr', 'Apt. Ste. Flr. Number') }}
                    {{ Form::text('mailing_apt_ste_flr', optional($application)->mailing_apt_ste_flr ?? '', ['class' => 'form-control', 'placeholder' => 'Number']) }}
                </div>
                <div class="col-md-4 mb-3">
                    {{ Form::label('mailing_city', 'City or Town') }}
                    {{ Form::text('mailing_city', optional($application)->mailing_city ?? '', ['class' => 'form-control', 'placeholder' => 'City']) }}
                </div>
                <div class="col-md-2 mb-3">
                    {{ Form::label('mailing_state', 'State') }}
                    {{ Form::text('mailing_state', optional($application)->mailing_state ?? '', ['class' => 'form-control', 'placeholder' => 'State']) }}
                </div>
                <div class="col-md-2 mb-3">
                    {{ Form::label('mailing_zip', 'ZIP Code') }}
                    {{ Form::text('mailing_zip', optional($application)->mailing_zip ?? '', ['class' => 'form-control', 'placeholder' => 'ZIP']) }}
                </div>
            </div>
        </div>
    </div>
    
    <!-- 18.d Residency History -->
    <div class="residency-check bg-light p-3 border rounded mb-3 mt-3">
        <label class="form-label d-block mb-2 fw-bold">18.d Have you resided at your current address for at least 5 years?</label>
        <div class="d-flex gap-3">
            <div class="form-check">
                {{ Form::radio('resided_at_current_address_5_years', 1, optional($application)->resided_at_current_address_5_years === true, [
                    'class' => 'form-check-input',
                    'id' => 'resided_5_years_yes'
                ]) }}
                <label class="form-check-label" for="resided_5_years_yes">Yes</label>
            </div>
            <div class="form-check">
                {{ Form::radio('resided_at_current_address_5_years', 0, optional($application)->resided_at_current_address_5_years === false, [
                    'class' => 'form-check-input',
                    'id' => 'resided_5_years_no'
                ]) }}
                <label class="form-check-label" for="resided_5_years_no">No</label>
            </div>
        </div>
        
        <!-- 18.e Prior Addresses -->
        <div id="prior_addresses_container" class="mt-4 {{ optional($application)->resided_at_current_address_5_years === false ? '' : 'd-none' }}">
            <h6 class="mb-3">18.e Provide your prior address(es) for the last 5 years</h6>
            <div id="prior-address-items">
                @php
                    $priorAddresses = optional($application)->prior_addresses_data ?? [];
                @endphp
                @foreach($priorAddresses as $index => $addr)
                    <div class="prior-address-item border p-3 mb-3 bg-white rounded shadow-sm">
                        <div class="d-flex justify-content-between mb-2">
                            <h6>Prior Address #{{ $index + 1 }}</h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-prior-address"><i class="fa fa-trash"></i></button>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <label class="small">Street Number and Name</label>
                                <input type="text" name="prior_addresses_data[{{ $index }}][street]" class="form-control" value="{{ $addr['street'] ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">City or Town</label>
                                <input type="text" name="prior_addresses_data[{{ $index }}][city]" class="form-control" value="{{ $addr['city'] ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">State</label>
                                <input type="text" name="prior_addresses_data[{{ $index }}][state]" class="form-control" value="{{ $addr['state'] ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">ZIP Code</label>
                                <input type="text" name="prior_addresses_data[{{ $index }}][zip]" class="form-control" value="{{ $addr['zip'] ?? '' }}">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="small">Date From (mm/dd/yyyy)</label>
                                <input type="text" name="prior_addresses_data[{{ $index }}][date_from]" class="form-control datePicker" value="{{ $addr['date_from'] ?? '' }}">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="small">Date To (mm/dd/yyyy)</label>
                                <input type="text" name="prior_addresses_data[{{ $index }}][date_to]" class="form-control datePicker" value="{{ $addr['date_to'] ?? '' }}">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-sm btn-outline-primary" id="add-prior-address"><i class="fa fa-plus me-1"></i>Add Prior Address</button>
        </div>
    </div>

    <!-- 18.f Recent Address Outside the U.S. -->
    <div class="foreign-address bg-light p-3 border rounded mb-4">
        <h6 class="fw-bold mb-3">18.f Provide your most recent address outside the United States where you lived for more than one year (if not already listed).</h6>
        @php $foreign = optional($application)->foreign_address_data ?? []; @endphp
        <div class="row">
            <div class="col-md-12 mb-3">
                {{ Form::label('foreign_address_street', 'Street Number and Name') }}
                {{ Form::text('foreign_address_data[street]', $foreign['street'] ?? '', ['class' => 'form-control']) }}
            </div>
            <div class="col-md-4 mb-3">
                {{ Form::label('foreign_address_city', 'City or Town') }}
                {{ Form::text('foreign_address_data[city]', $foreign['city'] ?? '', ['class' => 'form-control']) }}
            </div>
            <div class="col-md-4 mb-3">
                {{ Form::label('foreign_address_province', 'Province') }}
                {{ Form::text('foreign_address_data[province]', $foreign['province'] ?? '', ['class' => 'form-control']) }}
            </div>
            <div class="col-md-4 mb-3">
                {{ Form::label('foreign_address_country', 'Country') }}
                {{ Form::text('foreign_address_data[country]', $foreign['country'] ?? '', ['class' => 'form-control']) }}
            </div>
            <div class="col-md-4 mb-3">
                {{ Form::label('foreign_address_postal_code', 'Postal Code') }}
                {{ Form::text('foreign_address_data[postal_code]', $foreign['postal_code'] ?? '', ['class' => 'form-control']) }}
            </div>
            <div class="col-md-4 mb-3">
                {{ Form::label('foreign_address_date_from', 'Date From (mm/dd/yyyy)') }}
                {{ Form::text('foreign_address_data[date_from]', $foreign['date_from'] ?? '', ['class' => 'form-control datePicker']) }}
            </div>
            <div class="col-md-4 mb-3">
                {{ Form::label('foreign_address_date_to', 'Date To (mm/dd/yyyy)') }}
                {{ Form::text('foreign_address_data[date_to]', $foreign['date_to'] ?? '', ['class' => 'form-control datePicker']) }}
            </div>
        </div>
    </div>

    <!-- 19. Social Security Card -->
    <h5 class="mb-3 mt-4">19. Information About Your Social Security Card</h5>
    <div class="row">
        <div class="col-12">
            <div class="form-group mb-3">
                <label>19.a Has the Social Security Administration (SSA) ever officially issued a Social Security card to you?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('ssa_ever_issued_card', 1, optional($application)->ssa_ever_issued_card == 1, ['class' => 'form-check-input', 'id' => 'ssa_issued_yes']) }}
                        <label class="form-check-label" for="ssa_issued_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('ssa_ever_issued_card', 0, optional($application)->ssa_ever_issued_card == 0, ['class' => 'form-check-input', 'id' => 'ssa_issued_no']) }}
                        <label class="form-check-label" for="ssa_issued_no">No</label>
                    </div>
                </div>
            </div>

            <div id="ssn_field_container" style="display: {{ optional($application)->ssa_ever_issued_card == 1 ? 'block' : 'none' }};">
                <div class="form-group mb-3">
                    <label>19.b Provide your Social Security Number (SSN)</label>
                    {{ Form::text('ssn', optional($application)->ssn ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'XXX-XX-XXXX'
                    ]) }}
                </div>
            </div>

            <div class="form-group mb-3">
                <label>19.c Do you want the SSA to issue you a Social Security card?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('ssa_issue_card_request', 1, optional($application)->ssa_issue_card_request == 1, ['class' => 'form-check-input', 'id' => 'ssa_request_yes']) }}
                        <label class="form-check-label" for="ssa_request_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('ssa_issue_card_request', 0, optional($application)->ssa_issue_card_request == 0, ['class' => 'form-check-input', 'id' => 'ssa_request_no']) }}
                        <label class="form-check-label" for="ssa_request_no">No</label>
                    </div>
                </div>
            </div>

            <div id="ssa_consent_container" style="display: {{ optional($application)->ssa_issue_card_request == 1 ? 'block' : 'none' }};">
                <div class="alert alert-warning py-2 small mb-3">
                    <i class="fa fa-exclamation-triangle me-1"></i><strong>Consent for Disclosure:</strong> I authorize disclosure of information from this application to the SSA as required for the purpose of assigning an SSN and issuing a Social Security card.
                </div>
                <div class="form-group mb-3">
                    <label>19.d Do you authorize disclosure of information from this application to the SSA?</label>
                    <div class="d-flex gap-3 mt-1">
                        <div class="form-check">
                            {{ Form::radio('ssa_disclosure_consent', 1, optional($application)->ssa_disclosure_consent == 1, ['class' => 'form-check-input', 'id' => 'ssa_consent_yes']) }}
                            <label class="form-check-label" for="ssa_consent_yes">Yes</label>
                        </div>
                        <div class="form-check">
                            {{ Form::radio('ssa_disclosure_consent', 0, optional($application)->ssa_disclosure_consent == 0, ['class' => 'form-check-input', 'id' => 'ssa_consent_no']) }}
                            <label class="form-check-label" for="ssa_consent_no">No</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>
