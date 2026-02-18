<div class="basis-section">
    <h4 class="mb-4 border-bottom pb-2">
        Part 2. Application Type or Filing Category
    </h4>

    <!-- 1. EOIR Question -->
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label>1. Are you filing for adjustment of status with the Executive Office for Immigration Review (EOIR) while in removal, exclusion, rescission, or deportation proceedings?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('filing_with_eoir', 1, optional($application)->filing_with_eoir === true, ['class' => 'form-check-input', 'id' => 'eoir_yes']) }}
                        <label class="form-check-label" for="eoir_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('filing_with_eoir', 0, optional($application)->filing_with_eoir === false, ['class' => 'form-check-input', 'id' => 'eoir_no']) }}
                        <label class="form-check-label" for="eoir_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Underlying Petition and Filing Status -->
    <div class="row mt-3">
        <!-- Underlying Petition Information (appears first) -->
        <div class="col-12 mb-2">
            <label class="fw-bold">2. Provide the receipt number and priority date of the underlying petition (if any):</label>
        </div>
        <div class="col-md-6 mb-3">
            {{ Form::label('receipt_number_underlying_petition', 'Receipt Number of Underlying Petition (if any)') }}
            {{ Form::text('receipt_number_underlying_petition', optional($application)->receipt_number_underlying_petition ?? '', ['class' => 'form-control', 'placeholder' => 'MSC1234567890']) }}
        </div>
        <div class="col-md-6 mb-3">
            {{ Form::label('priority_date', 'Priority Date from Underlying Petition (if any) (mm/dd/yyyy)') }}
            {{ Form::text('priority_date', optional($application)->priority_date ? optional($application)->priority_date->format('m/d/Y') : '', [
                'class' => 'form-control datePicker',
                'placeholder' => 'MM/DD/YYYY'
            ]) }}
        </div>

        <div class="col-12 mb-3">
            <label class="fw-bold">I am filing this Form I-485 as a (select only one box):</label>
        </div>

        <!-- Filing Status Radio Buttons (appears after petition info) -->
        <div class="col-12 mb-2 mt-3 border-top pt-3">
            <p class="small mb-2">Select your filing status:</p>
        </div>
        <div class="col-12 mb-3">
            <div class="d-flex gap-3">
                <div class="form-check">
                    {{ Form::radio('is_principal_applicant', 1, optional($application)->is_principal_applicant ?? true, ['class' => 'form-check-input', 'id' => 'principal_applicant']) }}
                    <label class="form-check-label" for="principal_applicant">Principal Applicant</label>
                </div>
                <div class="form-check">
                    {{ Form::radio('is_principal_applicant', 0, optional($application)->is_principal_applicant === false, ['class' => 'form-check-input', 'id' => 'derivative_applicant']) }}
                    <label class="form-check-label" for="derivative_applicant">Derivative Applicant</label>
                </div>
            </div>
        </div>
    </div>

    <!-- Principal Applicant's Information (for Derivative Applicants) -->
    <div id="derivative_info_section" class="{{ (optional($application)->is_principal_applicant === false) ? '' : 'd-none' }} border p-3 rounded bg-light mb-4 mt-3">
        <label class="fw-bold mb-2">Principal Applicant's Information</label>
        <p class="small text-muted mb-3">(Provide the following information about the principal applicant.)</p>
        <div class="row">
            <div class="col-md-4 mb-3">
                {{ Form::label('derivative_principal_last_name', 'Family Name (Last Name)') }}
                {{ Form::text('derivative_principal_last_name', optional($application)->derivative_principal_last_name ?? '', ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
            </div>
            <div class="col-md-4 mb-3">
                {{ Form::label('derivative_principal_first_name', 'Given Name (First Name)') }}
                {{ Form::text('derivative_principal_first_name', optional($application)->derivative_principal_first_name ?? '', ['class' => 'form-control', 'placeholder' => 'First Name']) }}
            </div>
            <div class="col-md-4 mb-3">
                {{ Form::label('derivative_principal_middle_name', 'Middle Name (if applicable)') }}
                {{ Form::text('derivative_principal_middle_name', optional($application)->derivative_principal_middle_name ?? '', ['class' => 'form-control', 'placeholder' => 'Middle Name']) }}
            </div>
            <div class="col-md-6 mb-3">
                {{ Form::label('derivative_principal_a_number', "Principal Applicant's A-Number (if any)") }}
                <div class="input-group">
                    <span class="input-group-text">A-</span>
                    {{ Form::text('derivative_principal_a_number', optional($application)->derivative_principal_a_number ?? '', ['class' => 'form-control', 'placeholder' => '123456789']) }}
                </div>
            </div>
            <div class="col-md-6 mb-3">
                {{ Form::label('derivative_principal_dob', "Principal Applicant's Date of Birth (mm/dd/yyyy)") }}
                {{ Form::text('derivative_principal_dob', optional($application)->derivative_principal_dob ? optional($application)->derivative_principal_dob->format('m/d/Y') : '', [
                    'class' => 'form-control datePicker',
                    'placeholder' => 'MM/DD/YYYY'
                ]) }}
            </div>
        </div>
    </div>




    <!-- 3. Basis for Eligibility -->
    <h5 class="mb-3 mt-4 border-bottom pb-2">3. I am applying based on the following category</h5>
    <p class="small text-muted mb-3">Select the category that applies to you (Select ONLY ONE main category from 3.a to 3.g):</p>
    
    <div class="card mb-4 border shadow-sm category-selection">
        <div class="card-body">
            <!-- 4.a Family-based Categories -->
            <div class="form-check mb-3">
                {{ Form::radio('immigrant_category', 'family_based', optional($application)->immigrant_category === 'family_based', ['class' => 'form-check-input category-toggle', 'id' => 'cat_family']) }}
                <label class="form-check-label fw-bold" for="cat_family">3.a Family-based Categories</label>
            </div>
            <div id="section_family_based" class="category-detail-section ms-4 mb-4 border-start ps-3 {{ optional($application)->immigrant_category === 'family_based' ? '' : 'd-none' }}">
                <h6 class="text-primary small fw-bold">Select one family-based category:</h6>
                @php 
                    $familyData = optional($application)->immigrant_category === 'family_based' ? optional($application)->immigrant_category_detail : ''; 
                    $familyOptions = [
                        'spouse_usc' => 'Immediate relative of U.S. citizen: Spouse',
                        'child_usc' => 'Immediate relative of U.S. citizen: Unmarried child (<21)',
                        'parent_usc' => 'Immediate relative of U.S. citizen: Parent',
                        'fiance_usc' => 'Immediate relative of U.S. citizen: Fiancé(e) or child of fiancé(e)',
                        'widow_usc' => 'Immediate relative of U.S. citizen: Widow(er)',
                        'deceased_service_usc' => 'Immediate relative of U.S. citizen: Spouse/child/parent of deceased service member',
                        'unmarried_son_usc' => 'Other relative of U.S. citizen: Unmarried son/daughter (21+)',
                        'married_son_usc' => 'Other relative of U.S. citizen: Married son/daughter',
                        'sibling_usc' => 'Other relative of U.S. citizen: Brother/sister',
                        'spouse_lpr' => 'Relative of Lawful Permanent Resident (LPR): Spouse',
                        'child_lpr' => 'Relative of Lawful Permanent Resident (LPR): Unmarried child (<21)',
                        'unmarried_son_lpr' => 'Relative of Lawful Permanent Resident (LPR): Unmarried son/daughter (21+)',
                        'vawa_spouse' => 'VAWA self-petitioner: Spouse',
                        'vawa_child' => 'VAWA self-petitioner: child',
                        'vawa_parent' => 'VAWA self-petitioner: parent',
                    ];
                @endphp
                @foreach($familyOptions as $val => $lab)
                    <div class="form-check mb-2">
                        {{ Form::radio('immigrant_category_detail', $val, $familyData === $val, ['class' => 'form-check-input']) }}
                        <label class="form-check-label small">{{ $lab }}</label>
                    </div>
                @endforeach
            </div>

            <!-- 4.b Employment-based Categories -->
            <div class="form-check mb-3">
                {{ Form::radio('immigrant_category', 'employment_based', optional($application)->immigrant_category === 'employment_based', ['class' => 'form-check-input category-toggle', 'id' => 'cat_employment']) }}
                <label class="form-check-label fw-bold" for="cat_employment">3.b Employment-based Categories</label>
            </div>
            <div id="section_employment_based" class="category-detail-section ms-4 mb-4 border-start ps-3 {{ optional($application)->immigrant_category === 'employment_based' ? '' : 'd-none' }}">
                @php $empData = optional($application)->employment_categories_data ?? []; @endphp
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="small fw-bold">Select primary category:</label>
                        <div class="form-check">
                            {{ Form::radio('employment_categories_data[primary]', 'alien_investor', ($empData['primary'] ?? '') === 'alien_investor', ['class' => 'form-check-input']) }}
                            <label class="form-check-label small">Alien Investor (I-526/I-526E)</label>
                        </div>
                        <div class="form-check">
                            {{ Form::radio('employment_categories_data[primary]', 'alien_worker', ($empData['primary'] ?? '') === 'alien_worker', ['class' => 'form-check-input', 'id' => 'emp_i140']) }}
                            <label class="form-check-label small">Alien Workers (I-140)</label>
                        </div>
                    </div>
                    
                    <div id="i140_subcats" class="col-12 mb-3 ms-3 {{ ($empData['primary'] ?? '') === 'alien_worker' ? '' : 'd-none' }}">
                        <label class="small fw-bold">I-140 Specific Sub-categories:</label>
                        @php 
                            $subs = [
                                'extraordinary' => 'Extraordinary Ability',
                                'prof_researcher' => 'Outstanding Professor/Researcher',
                                'exec_manager' => 'Multinational Executive/Manager',
                                'adv_degree' => 'Advanced Degree/Exceptional Ability',
                                'professional' => 'Professional',
                                'skilled_worker' => 'Skilled Worker',
                                'other_worker' => 'Other Worker',
                                'niw' => 'National Interest Waiver'
                            ];
                            $storedSubs = $empData['sub_categories'] ?? [];
                        @endphp
                        @foreach($subs as $val => $lab)
                            <div class="form-check">
                                <input type="checkbox" name="employment_categories_data[sub_categories][]" value="{{ $val }}" class="form-check-input" {{ in_array($val, $storedSubs) ? 'checked' : '' }}>
                                <label class="form-check-label small">{{ $lab }}</label>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-12 border-top pt-2">
                        <div class="form-group mb-3">
                            <label class="small fw-bold">Did a relative file or have 5%+ ownership interest in the petitioning business?</label>
                            <div class="d-flex gap-3 mt-1">
                                @foreach(['Yes', 'No', 'N/A'] as $opt)
                                    <div class="form-check">
                                        {{ Form::radio('employment_categories_data[relative_interest]', $opt, ($empData['relative_interest'] ?? '') === $opt, ['class' => 'form-check-input']) }}
                                        <label class="form-check-label small">{{ $opt }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small fw-bold">Relative Relationship</label>
                                {{ Form::select('employment_categories_data[relative_relationship]', [
                                    'Father' => 'Father', 'Mother' => 'Mother', 'Child' => 'Child', 
                                    'Adult Son' => 'Adult Son', 'Adult Daughter' => 'Adult Daughter', 
                                    'Brother' => 'Brother', 'Sister' => 'Sister', 'None' => 'None'
                                ], $empData['relative_relationship'] ?? '', ['class' => 'form-control form-control-sm', 'placeholder' => '-Select-']) }}
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small fw-bold">Relative Status</label>
                                {{ Form::select('employment_categories_data[relative_status]', [
                                    'U.S. Citizen' => 'U.S. Citizen', 'U.S. National' => 'U.S. National', 
                                    'LPR' => 'LPR', 'None' => 'None'
                                ], $empData['relative_status'] ?? '', ['class' => 'form-control form-control-sm', 'placeholder' => '-Select-']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4.c Special Immigrant Categories -->
            <div class="form-check mb-3">
                {{ Form::radio('immigrant_category', 'special_immigrant', optional($application)->immigrant_category === 'special_immigrant', ['class' => 'form-check-input category-toggle', 'id' => 'cat_special']) }}
                <label class="form-check-label fw-bold" for="cat_special">3.c Special Immigrant Categories</label>
            </div>
            <div id="section_special_immigrant" class="category-detail-section ms-4 mb-4 border-start ps-3 {{ optional($application)->immigrant_category === 'special_immigrant' ? '' : 'd-none' }}">
                @php 
                    $specialData = optional($application)->special_immigrant_categories_data ?? []; 
                    $specials = [
                        'juvenile' => 'Juvenile',
                        'afghan_iraqi' => 'Afghan/Iraqi National',
                        'broadcaster' => 'Broadcaster',
                        'g4_nato6' => 'G-4/NATO-6',
                        'armed_forces' => 'Armed Forces Member',
                        'panama_canal' => 'Panama Canal Zone Employee',
                        'physician' => 'Physician',
                        'us_gov_abroad' => 'U.S. Gov. Employee Abroad',
                        'religious' => 'Religious Worker'
                    ];
                    $storedSpecials = $specialData['categories'] ?? [];
                @endphp
                <label class="small fw-bold">Select category:</label>
                @foreach($specials as $val => $lab)
                    <div class="form-check">
                        <input type="checkbox" name="special_immigrant_categories_data[categories][]" value="{{ $val }}" class="form-check-input" {{ in_array($val, $storedSpecials) ? 'checked' : '' }}>
                        <label class="form-check-label small">{{ $lab }}</label>
                    </div>
                @endforeach
            </div>

            <!-- 4.d Asylee or Refugee -->
            <div class="form-check mb-3">
                {{ Form::radio('immigrant_category', 'asylee_refugee', optional($application)->immigrant_category === 'asylee_refugee', ['class' => 'form-check-input category-toggle', 'id' => 'cat_asylee']) }}
                <label class="form-check-label fw-bold" for="cat_asylee">3.d Asylee or Refugee</label>
            </div>
            <div id="section_asylee_refugee" class="category-detail-section ms-4 mb-4 border-start ps-3 {{ optional($application)->immigrant_category === 'asylee_refugee' ? '' : 'd-none' }}">
                @php $asyData = optional($application)->asylee_refugee_data ?? []; @endphp
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            {{ Form::radio('asylee_refugee_data[type]', 'asylum', ($asyData['type'] ?? '') === 'asylum', ['class' => 'form-check-input']) }}
                            <label class="form-check-label small">Asylum Status</label>
                        </div>
                        <div class="mt-2 ms-4">
                            <label class="small">Date Granted (mm/dd/yyyy)</label>
                            <input type="text" name="asylee_refugee_data[asylum_date]" class="form-control form-control-sm datePicker" value="{{ $asyData['asylum_date'] ?? '' }}">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            {{ Form::radio('asylee_refugee_data[type]', 'refugee', ($asyData['type'] ?? '') === 'refugee', ['class' => 'form-check-input']) }}
                            <label class="form-check-label small">Refugee Status</label>
                        </div>
                        <div class="mt-2 ms-4">
                            <label class="small">Date of Admission (mm/dd/yyyy)</label>
                            <input type="text" name="asylee_refugee_data[refugee_date]" class="form-control form-control-sm datePicker" value="{{ $asyData['refugee_date'] ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4.e Trafficking or Crime Victim -->
            <div class="form-check mb-3">
                {{ Form::radio('immigrant_category', 'victim', optional($application)->immigrant_category === 'victim', ['class' => 'form-check-input category-toggle', 'id' => 'cat_victim']) }}
                <label class="form-check-label fw-bold" for="cat_victim">3.e Trafficking or Crime Victim</label>
            </div>
            <div id="section_victim" class="category-detail-section ms-4 mb-4 border-start ps-3 {{ optional($application)->immigrant_category === 'victim' ? '' : 'd-none' }}">
                @php $vicData = optional($application)->trafficking_crime_victim_data ?? []; @endphp
                <div class="form-check">
                    {{ Form::radio('trafficking_crime_victim_data[type]', 'T', ($vicData['type'] ?? '') === 'T', ['class' => 'form-check-input']) }}
                    <label class="form-check-label small">Human Trafficking Victim (T)</label>
                </div>
                <div class="form-check">
                    {{ Form::radio('trafficking_crime_victim_data[type]', 'U', ($vicData['type'] ?? '') === 'U', ['class' => 'form-check-input']) }}
                    <label class="form-check-label small">Crime Victim (U)</label>
                </div>
            </div>

            <!-- 4.f Special Programs (Public Laws) -->
            <div class="form-check mb-3">
                {{ Form::radio('immigrant_category', 'special_programs', optional($application)->immigrant_category === 'special_programs', ['class' => 'form-check-input category-toggle', 'id' => 'cat_programs']) }}
                <label class="form-check-label fw-bold" for="cat_programs">3.f Special Programs (Public Laws)</label>
            </div>
            <div id="section_special_programs" class="category-detail-section ms-4 mb-4 border-start ps-3 {{ optional($application)->immigrant_category === 'special_programs' ? '' : 'd-none' }}">
                @php 
                    $progData = optional($application)->special_program_categories_data ?? []; 
                    $progs = [
                        'cuban' => 'Cuban Adjustment Act',
                        'hrifa' => 'HRIFA (Dependent)',
                        'lautenberg' => 'Lautenberg Parolee',
                        'diplomat' => 'Diplomat (Section 13)',
                        'se_asia' => 'S.E. Asia (PL 106-429)',
                        'amerasian' => 'Amerasian Act'
                    ];
                    $storedProgs = $progData['categories'] ?? [];
                @endphp
                @foreach($progs as $val => $lab)
                    <div class="form-check">
                        <input type="checkbox" name="special_program_categories_data[categories][]" value="{{ $val }}" class="form-check-input" {{ in_array($val, $storedProgs) ? 'checked' : '' }}>
                        <label class="form-check-label small">{{ $lab }}</label>
                    </div>
                @endforeach
            </div>

            <!-- 4.g Additional Options -->
            <div class="form-check mb-3">
                {{ Form::radio('immigrant_category', 'additional', optional($application)->immigrant_category === 'additional', ['class' => 'form-check-input category-toggle', 'id' => 'cat_additional']) }}
                <label class="form-check-label fw-bold" for="cat_additional">3.g Additional Options</label>
            </div>
            <div id="section_additional" class="category-detail-section ms-4 mb-4 border-start ps-3 {{ optional($application)->immigrant_category === 'additional' ? '' : 'd-none' }}">
                @php $addData = optional($application)->additional_options_data ?? []; @endphp
                <div class="form-check mb-2">
                    {{ Form::radio('additional_options_data[type]', 'diversity', ($addData['type'] ?? '') === 'diversity', ['class' => 'form-check-input']) }}
                    <label class="form-check-label small">Diversity Visa</label>
                    <div class="mt-1 ms-4">
                        <label class="small">Rank Number</label>
                        <input type="text" name="additional_options_data[dv_rank]" class="form-control form-control-sm" value="{{ $addData['dv_rank'] ?? '' }}" placeholder="Rank #">
                    </div>
                </div>
                @foreach(['registry' => 'Continuous Residence (Registry)', 'diplomatic' => 'Born under Diplomatic Status', 's_nonimmigrant' => 'S Nonimmigrant', 'other' => 'Other'] as $val => $lab)
                    <div class="form-check">
                        {{ Form::radio('additional_options_data[type]', $val, ($addData['type'] ?? '') === $val, ['class' => 'form-check-input']) }}
                        <label class="form-check-label small">{{ $lab }}</label>
                    </div>
                @endforeach
                <div class="mt-2 ms-4 {{ ($addData['type'] ?? '') === 'other' ? '' : 'd-none' }}" id="additional_other_field">
                    <label class="small">Specify 'Other'</label>
                    <input type="text" name="additional_options_data[other_specify]" class="form-control form-control-sm" value="{{ $addData['other_specify'] ?? '' }}">
                </div>
            </div>
        </div>
    </div>

    <!-- 4. Section 245(i) Adjustment -->
    <div class="row mt-3 border-top pt-3">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="fw-bold">4. Are you applying for adjustment of status based on INA section 245(i)?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('applying_under_245i', 1, optional($application)->applying_under_245i === true, ['class' => 'form-check-input', 'id' => '245i_yes']) }}
                        <label class="form-check-label" for="245i_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('applying_under_245i', 0, optional($application)->applying_under_245i === false, ['class' => 'form-check-input', 'id' => '245i_no']) }}
                        <label class="form-check-label" for="245i_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 5. Child Status Protection Act (CSPA) -->
    <div class="row mt-3 border-top pt-3">
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="fw-bold">5. Are you 21 years of age or older and applying for adjustment of status based on classification as a child under the Child Status Protection Act (CSPA)?</label>
                <div class="d-flex gap-3 mt-1">
                    <div class="form-check">
                        {{ Form::radio('applying_under_cspa', 1, optional($application)->applying_under_cspa === true, ['class' => 'form-check-input', 'id' => 'cspa_yes']) }}
                        <label class="form-check-label" for="cspa_yes">Yes</label>
                    </div>
                    <div class="form-check">
                        {{ Form::radio('applying_under_cspa', 0, optional($application)->applying_under_cspa === false, ['class' => 'form-check-input', 'id' => 'cspa_no']) }}
                        <label class="form-check-label" for="cspa_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Principal Applicant toggle
        $('input[name="is_principal_applicant"]').on('change', function() {
            if ($(this).val() == '0') {
                $('#derivative_info_section').removeClass('d-none').hide().slideDown(300);
            } else {
                $('#derivative_info_section').slideUp(300, function() {
                    $(this).addClass('d-none');
                });
            }
        });

        // Main Category toggle
        $('.category-toggle').on('change', function() {
            $('.category-detail-section').addClass('d-none');
            const target = '#section_' + $(this).val();
            $(target).removeClass('d-none').hide().slideDown(300);
        });

        // Employment sub-category toggle
        $('input[name="employment_categories_data[primary]"]').on('change', function() {
            if ($(this).attr('id') === 'emp_i140') {
                $('#i140_subcats').removeClass('d-none').hide().slideDown(300);
            } else {
                $('#i140_subcats').slideUp(300);
            }
        });

        // Additional 'Other' toggle
        $('input[name="additional_options_data[type]"]').on('change', function() {
            if ($(this).val() === 'other') {
                $('#additional_other_field').removeClass('d-none').hide().slideDown(300);
            } else {
                $('#additional_other_field').slideUp(300);
            }
        });
    });
</script>
