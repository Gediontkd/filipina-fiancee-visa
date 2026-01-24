<!-- resources/views/web/visa-application/spouse-visa/beneficiary/place-of-birth.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseBeneficiaryPlaceOfBirth'), 'id' => 'spouseBeneficiaryPlaceOfBirth']) }}
        <div class="form-card">
            <h3>Beneficiary's Birth and Parents Information</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h4>Beneficiary's Birth Information</h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("dob", "Date of Birth (mm/dd/yyyy)") }}
                        <span class="required">*</span>
                        {{ Form::text("dob", @$step->detail['dob'], ['class' => 'form-control dateOfBirth', 'placeholder' => "Enter Date"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("city_of_birth", "City of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("city_of_birth", @$step->detail['city_of_birth'], ['class' => 'form-control', 'placeholder' => "Enter City"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("state_of_birth", "State/Province of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("state_of_birth", @$step->detail['state_of_birth'], ['class' => 'form-control stateOfBirth', 'placeholder' => "Enter State/Province"]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('state_of_birth_na', true, @$step->detail['state_of_birth_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "stateOfBirth",
                                'id' => 'state_of_birth_na'
                            ]) }}
                            {{ Form::label('state_of_birth_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('birth_country', "Country of Birth") }}
                        <span class="required">*</span>
                        {{ Form::select('birth_country', getAllCountry(), @$step->detail['birth_country'], ['class' => 'form-control']) }}              
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h4>Beneficiary's Father Information</h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("father_last_name", "Father's Last Name") }}
                        <span class="required">*</span>
                        {{ Form::text("father_last_name", @$step->detail['father_last_name'], ['class' => 'form-control', 'placeholder' => "Enter Last Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("father_first_name", "Father's First Name") }}
                        <span class="required">*</span>
                        {{ Form::text("father_first_name", @$step->detail['father_first_name'], ['class' => 'form-control', 'placeholder' => "Enter First Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("father_middle_name", "Father's Middle Name") }}
                        <span class="required">*</span>
                        {{ Form::text("father_middle_name", @$step->detail['father_middle_name'], ['class' => 'form-control fatherMiddleName', 'placeholder' => "Enter Middle Name"]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('father_middle_name_na', true, @$step->detail['father_middle_name_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "fatherMiddleName",
                                'id' => 'father_middle_name_na'
                            ]) }}
                            {{ Form::label('father_middle_name_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("father_dob", "Father's Date of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("father_dob", @$step->detail['father_dob'], ['class' => 'form-control dateOfBirth fatherDob', 'placeholder' => "Enter Date of Birth"]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('father_dob_na', true, @$step->detail['father_dob_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "fatherDob",
                                'id' => 'father_dob_na'
                            ]) }}
                            {{ Form::label('father_dob_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>               
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("father_city_or_province_of_birth", "Father's City or Province of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("father_city_or_province_of_birth", @$step->detail['father_city_or_province_of_birth'], ['class' => 'form-control fatherCityProvBirth', 'placeholder' => "Enter City or Province"]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('father_city_birth_na', true, @$step->detail['father_city_birth_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "fatherCityProvBirth",
                                'id' => 'father_city_birth_na'
                            ]) }}
                            {{ Form::label('father_city_birth_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('father_birth_country', "Father's Country of Birth") }}
                        <span class="required">*</span>
                        {{ Form::select('father_birth_country', getAllCountry(), @$step->detail['father_birth_country'], ['class' => 'form-control fatherBirthCountry',]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('father_birth_country_na', true, @$step->detail['father_birth_country_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "fatherBirthCountry",
                                'id' => 'father_birth_country_na'
                            ]) }}
                            {{ Form::label('father_birth_country_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Is he deceased? </label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('he_deceased', 'no', @$step->detail['he_deceased'] == 'no', ['class' => 'custom-control-input isHeDeceased']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('he_deceased', 'yes', @$step->detail['he_deceased'] == 'yes', ['class' => 'custom-control-input isHeDeceased']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="he_deceased"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 heDeceasedSec" style="display: {{ @$step->detail['he_deceased'] == 'yes' ? 'block' : 'none'  }};">
                    <div class="form-group">
                        {{ Form::label("father_dod", "Father's Date of Death") }}
                        <span class="required">*</span>
                        {{ Form::text("father_dod", @$step->detail['father_dod'], ['class' => 'form-control dateOfBirth', 'placeholder' => "Enter Date"]) }}
                    </div>
                </div>
                <div class="col-md-12 fatherAddressSec" style="display: {{ @$step->detail['he_deceased'] == 'no' ? 'block' : 'none'  }};">
                    <div class="row">
                        <h4>Father's Current Address</h4>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('father_number_and_street', 'Number and street') }}
                                <span class="required">*</span>
                                {{ Form::text('father_number_and_street', @$step->detail['father_number_and_street'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter number and street'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('father_apartment_suite_or_floor', 'Apartment, Suite or Floor?') }}
                                <span class="required">*</span>
                                {{ Form::select('father_apartment_suite_or_floor', [
                                    '' => 'Select', 
                                    'Apartment' => 'Apartment',
                                    'Suite' => 'Suite',
                                    'Floor' => 'Floor',
                                    'Does Not Apply' => 'Does Not Apply'
                                ], @$step->detail['father_apartment_suite_or_floor'], [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('father_apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number') }}
                                <span class="required">*</span>
                                {{ Form::text('father_apartment_suite_or_floor_no', @$step->detail['father_apartment_suite_or_floor_no'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Number'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('father_town_or_city', 'Town or City') }}
                                <span class="required">*</span>
                                {{ Form::text('father_town_or_city', @$step->detail['father_town_or_city'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Town or City'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('father_country', "Country") }}
                                <span class="required">*</span>
                                {{ Form::select('father_country', getAllCountry(), @$step->detail['father_country'], [
                                    'class' => 'form-control countryId'
                                ]) }}                       
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('father_state', "State/Province") }}
                                <span class="required">*</span>
                                {{ Form::select('father_state', [], @$step->detail['father_state'], [
                                    'class' => 'form-control states'
                                ]) }}                        
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('father_province', 'Province') }}
                                <span class="required">*</span>
                                {{ Form::text("father_province", @$step->detail['father_province'], [
                                    'class' => 'form-control fatherProvince',
                                    'placeholder' => 'Enter Province'
                                ]) }}
                                <div class="form-check mt-2">
                                    {{ Form::checkbox('father_province_na', true, @$step->detail['father_province_na'] == true, [
                                        'class' => 'form-check-input doesNotApply',
                                        'data-field' => "fatherProvince",
                                        'id' => 'father_province_na'
                                    ]) }}
                                    {{ Form::label('father_province_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                                </div>
                            </div>                            
                        </div>   
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('father_postal_code', 'Postal Code') }}
                                <span class="required">*</span>
                                {{ Form::text('father_postal_code', @$step->detail['father_postal_code'], [
                                    'class' => 'form-control fatherPostalCode',
                                    'placeholder' => 'Enter Postal Code'
                                ]) }}
                                <div class="form-check mt-2">
                                    {{ Form::checkbox('father_postal_code_na', true, @$step->detail['father_postal_code_na'] == true, [
                                        'class' => 'form-check-input doesNotApply',
                                        'data-field' => "fatherPostalCode",
                                        'id' => 'father_postal_code_na'
                                    ]) }}
                                    {{ Form::label('father_postal_code_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Beneficiary's Mother Information</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_maiden_last_name", "Mother's Maiden Last Name") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_maiden_last_name", @$step->detail['mother_maiden_last_name'], ['class' => 'form-control', 'placeholder' => "Enter Last Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_first_name", "Mother's First Name") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_first_name", @$step->detail['mother_first_name'], ['class' => 'form-control', 'placeholder' => "Enter First Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_middle_name", "Mother's Middle Name") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_middle_name", @$step->detail['mother_middle_name'], ['class' => 'form-control motherMiddleName', 'placeholder' => "Enter Middle Name"]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('mother_middle_name_na', true, @$step->detail['mother_middle_name_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "motherMiddleName",
                                'id' => 'mother_middle_name_na'
                            ]) }}
                            {{ Form::label('mother_middle_name_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_dob", "Mother's Date of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_dob", @$step->detail['mother_dob'], ['class' => 'form-control dateOfBirth motherDob', 'placeholder' => "Enter Date of Birth"]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('mother_dob_na', true, @$step->detail['mother_dob_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "motherDob",
                                'id' => 'mother_dob_na'
                            ]) }}
                            {{ Form::label('mother_dob_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_city_or_province_of_birth", "Mother's City or Province of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_city_or_province_of_birth", @$step->detail['mother_city_or_province_of_birth'], ['class' => 'form-control motherCityProBirth', 'placeholder' => "Enter City or Province"]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('mother_city_birth_na', true, @$step->detail['mother_city_birth_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "motherCityProBirth",
                                'id' => 'mother_city_birth_na'
                            ]) }}
                            {{ Form::label('mother_city_birth_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('mother_birth_country', "Mother's Country of Birth") }}
                        <span class="required">*</span>
                        {{ Form::select('mother_birth_country', getAllCountry(), @$step->detail['mother_birth_country'], ['class' => 'form-control motherBirthCountry']) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('mother_birth_country_na', true, @$step->detail['mother_birth_country_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "motherBirthCountry",
                                'id' => 'mother_birth_country_na'
                            ]) }}
                            {{ Form::label('mother_birth_country_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Is she deceased?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('she_deceased', 'no', @$step->detail['she_deceased'] == 'no', ['class' => 'custom-control-input isSheDeceased']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('she_deceased', 'yes', @$step->detail['she_deceased'] == 'yes', ['class' => 'custom-control-input isSheDeceased']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="she_deceased"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 sheDeceasedSec" style="display: {{ @$step->detail['she_deceased'] == 'yes' ? 'block' : 'none' }};">
                    <div class="form-group">
                        {{ Form::label("mother_dod", "Mother's Date of Death") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_dod", @$step->detail['mother_dod'], ['class' => 'form-control dateOfBirth', 'placeholder' => "Enter Date"]) }}                                   
                    </div>
                </div>                
                <div class="col-md-12 motherAddressSec" style="display: {{ @$step->detail['she_deceased'] == 'no' ? 'block' : 'none' }};">
                    <div class="row">
                        <h4>Mother's Current Address</h4>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('mother_number_and_street', 'Number and street') }}
                                <span class="required">*</span>
                                {{ Form::text('mother_number_and_street', @$step->detail['mother_number_and_street'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter number and street'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('mother_apartment_suite_or_floor', 'Apartment, Suite or Floor?') }}
                                <span class="required">*</span>
                                {{ Form::select('mother_apartment_suite_or_floor', [
                                    '' => 'Select', 
                                    'Apartment' => 'Apartment',
                                    'Suite' => 'Suite',
                                    'Floor' => 'Floor',
                                    'Does Not Apply' => 'Does Not Apply'
                                ], @$step->detail['mother_apartment_suite_or_floor'], [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('mother_apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number') }}
                                <span class="required">*</span>
                                {{ Form::text('mother_apartment_suite_or_floor_no', @$step->detail['mother_apartment_suite_or_floor_no'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Number'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('mother_town_or_city', 'Town or City') }}
                                <span class="required">*</span>
                                {{ Form::text('mother_town_or_city', @$step->detail['mother_town_or_city'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Town or City'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('mother_country', "Country") }}
                                <span class="required">*</span>
                                {{ Form::select('mother_country', getAllCountry(), @$step->detail['mother_country'], [
                                    'class' => 'form-control countryId'
                                ]) }}                       
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('mother_state', "State/Province") }}
                                <span class="required">*</span>
                                {{ Form::select('mother_state', [], @$step->detail['mother_state'], [
                                    'class' => 'form-control states'
                                ]) }}                        
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('mother_province', 'Province') }}
                                <span class="required">*</span>
                                {{ Form::text("mother_province", @$step->detail['mother_province'], [
                                    'class' => 'form-control motherProvince',
                                    'placeholder' => 'Enter Province'
                                ]) }}
                                <div class="form-check mt-2">
                                    {{ Form::checkbox('mother_province_na', true, @$step->detail['mother_province_na'] == true, [
                                        'class' => 'form-check-input doesNotApply',
                                        'data-field' => "motherProvince",
                                        'id' => 'mother_province_na'
                                    ]) }}
                                    {{ Form::label('mother_province_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                                </div>
                            </div>                            
                        </div>   
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('mother_postal_code', 'Postal Code') }}
                                <span class="required">*</span>
                                {{ Form::text('mother_postal_code', @$step->detail['mother_postal_code'], [
                                    'class' => 'form-control motherPostalCode',
                                    'placeholder' => 'Enter Postal Code'
                                ]) }}
                                <div class="form-check mt-2">
                                    {{ Form::checkbox('mother_postal_code_na', true, @$step->detail['mother_postal_code_na'] == true, [
                                        'class' => 'form-check-input doesNotApply',
                                        'data-field' => "motherPostalCode",
                                        'id' => 'mother_postal_code_na'
                                    ]) }}
                                    {{ Form::label('mother_postal_code_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('section', 'beneficiary') !!}
        {!! Form::hidden('name', 'place-of-birth') !!}
        {!! Form::hidden('next', 'status') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'address',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'status',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseBeneficiaryPlaceOfBirthBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('change', '.doesNotApply', function() {
            var fieldClass = $(this).data('field');
            var field = $('.' + fieldClass);
            
            if ($(this).is(':checked')) {
                field.val('N/A');
                field.prop('disabled', true);
                field.prop('readonly', true);
            } else {
                field.val('');
                field.prop('disabled', false);
                field.prop('readonly', false);
            }
        });

        $(document).ready(function() {
            $('.doesNotApply:checked').each(function() {
                var fieldClass = $(this).data('field');
                var field = $('.' + fieldClass);
                field.val('N/A');
                field.prop('disabled', true);
                field.prop('readonly', true);
            });
        });

        $(document).ready(function(){
            getState($('.countryId').val());
        });

        $(document).on('change', '.countryId', function(){
            var countryId = $(this).val();
            getState(countryId);
        });

        function getState(countryId)
        {
            $.ajax({                
                type: 'get',
                url: "{{ route('spouseGetState') }}",
                data: {
                    countryId: countryId
                },
                success: function(data) {
                    $('.states').html(data);                    
                }
            });
        }

        $(document).on('change', '.isHeDeceased', function(){
            if ($(this).val() == 'yes') {
                $('.fatherAddressSec').hide();
                $('.heDeceasedSec').show();
            } else {
                $('.heDeceasedSec').hide();
                $('.fatherAddressSec').show();
            }
        });

        $(document).on('change', '.isSheDeceased', function(){
            if ($(this).val() == 'yes') {
                $('.motherAddressSec').hide();
                $('.sheDeceasedSec').show();
            } else {
                $('.sheDeceasedSec').hide();
                $('.motherAddressSec').show();
            }
        });      

        $("#spouseBeneficiaryPlaceOfBirth").validate({
            rules: {               
                dob: { required: true },
                city_of_birth: { required: true },
                state_of_birth: { 
                    required: function() {
                        return !$('#state_of_birth_na').is(':checked');
                    }
                },
                birth_country: { required: true },
                father_first_name: { required: true },
                father_middle_name: { 
                    required: function() {
                        return !$('#father_middle_name_na').is(':checked');
                    }
                },
                father_last_name: { required: true },
                father_dob: { 
                    required: function() {
                        return !$('#father_dob_na').is(':checked');
                    }
                },
                father_city_or_province_of_birth: { 
                    required: function() {
                        return !$('#father_city_birth_na').is(':checked');
                    }
                },
                father_birth_country: { 
                    required: function() {
                        return !$('#father_birth_country_na').is(':checked');
                    }
                },
                he_deceased: { required: true },
                mother_first_name: { required: true },
                mother_middle_name: { 
                    required: function() {
                        return !$('#mother_middle_name_na').is(':checked');
                    }
                },
                mother_maiden_last_name: { required: true },
                mother_dob: { 
                    required: function() {
                        return !$('#mother_dob_na').is(':checked');
                    }
                },
                mother_city_or_province_of_birth: { 
                    required: function() {
                        return !$('#mother_city_birth_na').is(':checked');
                    }
                },
                mother_birth_country: { 
                    required: function() {
                        return !$('#mother_birth_country_na').is(':checked');
                    }
                },
                she_deceased: { required: true },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "he_deceased" || element.attr("name") == "she_deceased") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               dob: "Please enter date of birth",
               city_of_birth: "Please enter city",
               state_of_birth: "Please enter state/province or check 'Does Not Apply'",
               birth_country: "Please select country",
               father_first_name: "Please enter father's first name",
               father_middle_name: "Please enter middle name or check 'Does Not Apply'",
               father_last_name: "Please enter father's last name",
               father_dob: "Please enter date of birth or check 'Does Not Apply'",
               father_city_or_province_of_birth: "Please enter city or province or check 'Does Not Apply'",
               father_birth_country: "Please select country or check 'Does Not Apply'",
               he_deceased: "Please select an option",
               mother_first_name: "Please enter mother's first name",
               mother_middle_name: "Please enter middle name or check 'Does Not Apply'",
               mother_maiden_last_name: "Please enter mother's maiden last name",
               mother_dob: "Please enter date of birth or check 'Does Not Apply'",
               mother_city_or_province_of_birth: "Please enter city or province or check 'Does Not Apply'",
               mother_birth_country: "Please select country or check 'Does Not Apply'",
               she_deceased: "Please select an option",
            },
            submitHandler: function(form) {
    $('#spouseBeneficiaryPlaceOfBirthBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>')
        .prop('disabled', true);
    
    $.ajax({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        url: "{{ route('spouseBeneficiaryPlaceOfBirth') }}",
        data: $(form).serialize(),
        dataType: 'json',
        success: function(data) {               
            if (data.status) {                                           
                $('.beneficiary-place-of-birth').removeClass('active');
                $('.beneficiary-status').addClass('active');
                $('.spouseVisaForm').html(data.data);
                $('html, body').animate({
                    scrollTop: $('.spouseVisaForm').offset().top - 100
                }, 300);
                toastr.success('Birth information saved successfully');
            } else {
                toastr.error(data.message || 'Failed to save information');                            
            }
        },
        error: function(xhr) {
            var errors = xhr.responseJSON?.errors;
            if (errors) {
                $.each(errors, function(field, messages) {
                    toastr.error(messages[0]);
                });
            } else {
                toastr.error(xhr.responseJSON?.message || 'An error occurred. Please try again.');
            }
        },
        complete: function() {
            $('#spouseBeneficiaryPlaceOfBirthBtn').html('Save & Continue')
                .prop('disabled', false);
        }
    });
    return false;
}
        });
    </script>                                
</div>