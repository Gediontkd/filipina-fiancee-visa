<!-- resources\views\web\visa-application\adjustment-of-status\sponsor-part-1.blade.php -->
<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentSponsorPart1'), 'id' => 'adjustmentSponsorPart1']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>Sponsor's Information Part 1</h2>
                <p>The sponsor is the U.S. citizen relative of the Alien.</p>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("f_name", "Sponsor's first name") }}
                        <span class="required">*</span>
                        {{ Form::text("f_name", @$step->detail['f_name'], ['class' => 'form-control', 'placeholder' => "Enter Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("m_name", "Sponsor's full middle name") }}
                        <span class="required">*</span>
                        {{ Form::text("m_name", @$step->detail['m_name'], ['class' => 'form-control MName', 'placeholder' => "Enter Name"]) }}
                        {{ Form::label('does_not_apply', "None") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "MName"
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("l_name", "Sponsor's last name (family name).") }}
                        <span class="required">*</span>
                        <p>If you have a suffix after your name such as Jr. or III, put that here after the last name.</p>
                        {{ Form::text("l_name", @$step->detail['l_name'], ['class' => 'form-control', 'placeholder' => "Enter Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("dob", "Sponsor's Date of Birth (mm/dd/yyyy)") }}
                        <span class="required">*</span>
                        {{ Form::text("dob", @$step->detail['dob'], ['class' => 'form-control dateOfBirth', 'placeholder' => "Enter Date of Birth"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("city_of_birth", "Sponsor's City of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("city_of_birth", @$step->detail['city_of_birth'], ['class' => 'form-control', 'placeholder' => "Enter City of Birth"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("state_province", "Sponsor's State or Province of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("state_province", @$step->detail['state_province'], ['class' => 'form-control', 'placeholder' => "Enter State or Province "]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('country_of_birth', "Sponsor's Country of Birth") }}
                        <span class="required">*</span>
                        {{ Form::select('country_of_birth', getAllCountry(), @$step->detail['country_of_birth'], ['class' => 'form-control',]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('m_no_country', "Mobile Number Country") }}
                        <span class="required">*</span>
                        {{ Form::select('m_no_country', getCountryPhoneCode(), @$step->detail['m_no_country'], ['class' => 'form-control',]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('p_number', "Phone number. Use cell phone to receive text updates.") }}
                        <span class="required">*</span>
                        {{ Form::text('p_number', @$step->detail['p_number'], ['class' => 'form-control', 'placeholder' => 'Enter Number']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('ss_number', "Social Security Number  (Format: 123-45-6789)") }}
                        <span class="required">*</span>
                        {{ Form::text('ss_number', @$step->detail['ss_number'], ['class' => 'form-control', 'placeholder' => 'Enter Number']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('sponsor_a', "Sponsor's A#, if any.  Uncommon") }}
                        <span class="required">*</span>
                        {{ Form::text('sponsor_a', @$step->detail['sponsor_a'], ['class' => 'form-control', 'placeholder' => 'Enter if any']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Sponsor's Gender</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio("gender", 'male', @$step->detail['gender'] == 'male' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Male
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio("gender", 'female', @$step->detail['gender'] == 'female' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Female
                            </label>
                        </div>
                        <div class="gender"></div>
                    </div>
                </div>
                 <h4>Sponsor's Biographic Data</h4>
                <h5>Height</h5>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('feet', "Feet") }}
                        <span class="required">*</span>
                        {{ Form::text('feet', @$step->detail['feet'], ['class' => 'form-control', 'placeholder' => 'Enter Feet']) }}        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('inches', "Inches") }}
                        <span class="required">*</span>
                        {{ Form::text('inches', @$step->detail['inches'], ['class' => 'form-control', 'placeholder' => 'Enter Inches']) }}        
                    </div>
                </div>
                <h5>Weight</h5>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('pounds', "Pounds") }}
                        <span class="required">*</span>
                        {{ Form::text('pounds', @$step->detail['pounds'], ['class' => 'form-control', 'placeholder' => 'Enter Pounds']) }}        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Ethnicity</b> <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('ethnicity', 'not_hispanic_or_latino', @$step->detail['ethnicity'] == 'not_hispanic_or_latino' ? true : '', [
                                    'class' => 'custom-control-input diffrentMailingAddress'
                                ]) }}
                                <span class="custom-control-label"></span> Not Hispanic or Latino
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('ethnicity', 'hispanic_or_latino', @$step->detail['ethnicity'] == 'hispanic_or_latino' ? true : '', [
                                    'class' => 'custom-control-input diffrentMailingAddress'
                                ]) }}
                                <span class="custom-control-label"></span> Hispanic or Latino
                            </label>
                            <div class="ethnicity"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Race</b> <span class="required">*</span></label>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::checkbox('race1', 'white', @$step->detail['race1'] == 'white' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> White
                                </label>                                
                            </div>
                            <div class="col-md-6">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::checkbox('race2', 'asian', @$step->detail['race2'] == 'asian' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Asian
                                </label>                                
                            </div>
                            <div class="col-md-6">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::checkbox('race3', 'black_or_african_amer', @$step->detail['race3'] == 'black_or_african_amer' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Black or African American
                                </label>                                
                            </div>
                            <div class="col-md-6">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::checkbox('race4', 'amer_indi_or_alaska_native', @$step->detail['race4'] == 'amer_indi_or_alaska_native' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> American Indian or Alaska Native
                                </label>                                
                            </div>
                            <div class="col-md-6">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::checkbox('race5', 'native_hawaiian_or_other_pacific_islander', @$step->detail['race5'] == 'native_hawaiian_or_other_pacific_islander' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Native Hawaiian or Other Pacific Islander
                                </label>                                
                            </div>
                            <div class="race"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><b>Hair Color</b> <span class="required">*</span></label>
                        <div class="row radiogroup">
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'black', @$step->detail['hair_color'] == 'black' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Black
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'brown', @$step->detail['hair_color'] == 'brown' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Brown
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'blond', @$step->detail['hair_color'] == 'blond' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Blond
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'gray', @$step->detail['hair_color'] == 'gray' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Gray
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'white', @$step->detail['hair_color'] == 'white' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> White
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'red', @$step->detail['hair_color'] == 'red' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Red
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'sandy', @$step->detail['hair_color'] == 'sandy' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Sandy
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'bald_no_hair', @$step->detail['hair_color'] == 'bald_no_hair' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Bald (No Hair)
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'other', @$step->detail['hair_color'] == 'other' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Other
                                </label>                                
                            </div>
                            <div class="hair_color"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><b>Eye Color</b> <span class="required">*</span></label>
                        <div class="row radiogroup">
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'black', @$step->detail['eye_color'] == 'black' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Black
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'blue', @$step->detail['eye_color'] == 'blue' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Blue
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'brown', @$step->detail['eye_color'] == 'brown' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Brown
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'gray', @$step->detail['eye_color'] == 'gray' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Gray
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'green', @$step->detail['eye_color'] == 'green' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Green
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'hazel', @$step->detail['eye_color'] == 'hazel' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Hazel
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'maroon', @$step->detail['eye_color'] == 'maroon' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Maroon
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'other', @$step->detail['eye_color'] == 'other' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Other
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'pink', @$step->detail['eye_color'] == 'pink' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Pink
                                </label>                                
                            </div>
                            <div class="eye_color"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Is the sponsor currently a member of the United States Armed Forces on active duty?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio("member_of_us", 'no', @$step->detail['member_of_us'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio("member_of_us", 'yes', @$step->detail['member_of_us'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="member_of_us"></div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Has anyone else ever filed a petition for the beneficiary?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio("beneficiary", 'no', @$step->detail['beneficiary'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio("beneficiary", 'yes', @$step->detail['beneficiary'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio("beneficiary", 'unknown', @$step->detail['beneficiary'] == 'unknown' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Unknown
                            </label>
                        </div>
                        <div class="beneficiary"></div>
                    </div>
                </div>
                 <div class="col-md-12">
                    <div class="form-group">
                        <label>Sponsor's Method of Citizenship</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio("citizenship", 'usa', @$step->detail['citizenship'] == 'usa' ? true : '', [
                                    'class' => 'custom-control-input citizenship'
                                ]) }}
                                <span class="custom-control-label"></span> Born in U.S.A
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio("citizenship", 'naturalized', @$step->detail['citizenship'] == 'naturalized' ? true : '', [
                                    'class' => 'custom-control-input citizenship'
                                ]) }}
                                <span class="custom-control-label"></span> Naturalized
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio("citizenship", 'parents', @$step->detail['citizenship'] == 'parents' ? true : '', [
                                    'class' => 'custom-control-input citizenship'
                                ]) }}
                                <span class="custom-control-label"></span> From Parents
                            </label>
                        </div>
                        <div class="citizenship"></div>
                    </div>
                </div>
                <div class="col-md-12 citizenshipSec" style="display: none;">
                    <div class="form-group">
                        <label class="citizenshipLabel" style="display: none;">You indicated that you received your citizenship through your parents.</label>
                        <label>Have you obtained a certificate of citizenship in your own name?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio("certificate", 'no', @$step->detail['certificate'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input certificate'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio("certificate", 'yes', @$step->detail['certificate'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input certificate'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                            
                        </div>
                        <div class="certificate"></div>
                    </div>
                </div>
                <div class="row certificateSec" style="display: none;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>If you no longer have your Naturalization Certificate enter Lost in the first two fields and estimate the date.</label>
                            {{ Form::label('naturalization', "Naturalization Certificate Number") }}
                            <span class="required">*</span>
                            {{ Form::text('naturalization', @$step->detail['naturalization'], ['class' => 'form-control', 'placeholder' => 'Enter Number']) }}        
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('place_of_issue', "Place of Issue, City and State") }}
                            <span class="required">*</span>
                            {{ Form::text('place_of_issue', @$step->detail['place_of_issue'], ['class' => 'form-control', 'placeholder' => 'Enter City and State']) }}        
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('date_of_issue', "Date of Issue mm/dd/yyyy") }}
                            <span class="required">*</span>
                            {{ Form::text('date_of_issue', @$step->detail['date_of_issue'], ['class' => 'form-control datePicker', 'placeholder' => 'Enter Date']) }}        
                        </div>
                    </div>
                </div>
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'sponsor-part-1') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'sponsor-part-2') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'civil-status'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'sponsor-part-2'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentSponsorPart1Btn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('change', '.citizenship', function(){
            switch ($(this).val()) {
                case 'usa':
                    $('.citizenshipSec').hide();
                    $('.citizenshipLabel').hide();
                break;
                case 'naturalized':
                    $('.citizenshipSec').show();                
                    $('.citizenshipLabel').hide();                
                break;
                case 'parents':
                    $('.citizenshipSec').show();              
                    $('.citizenshipLabel').show();              
                break;      
            }
        });

        $(document).on('change', '.certificate', function(){
            switch ($(this).val()) {
                case 'no':
                    $('.certificateSec').hide();
                break;
                case 'yes':
                    $('.certificateSec').show();                  
                break;                     
            }
        });

        $("#adjustmentSponsorPart1").validate({
            rules: {
                f_name: {
                    required: true,
                },
                m_name: {
                    required: true,
                },
                l_name: {
                    required: true,
                },
                dob: {
                    required: true,
                },
                city_of_birth: {
                    required: true,
                },
                state_province: {
                    required: true,
                },
                country_of_birth: {
                    required: true,
                },
                m_no_country: {
                    required: true,
                },
                p_number: {
                    required: true,
                },
                ss_number: {
                    required: true,
                },
                sponsor_a: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                feet: {
                    required: true,
                },
                inches: {
                    required: true,
                },
                pounds: {
                    required: true,
                },
                ethnicity: {
                    required: true,
                },
                hair_color: {
                    required: true,
                },
                eye_color: {
                    required: true,
                },
                member_of_us: {
                    required: true,
                },
                beneficiary: {
                    required: true,
                },
                citizenship: {
                    required: true,
                },
                certificate: {
                    required: true,
                },
                naturalization: {
                    required: true,
                },
                place_of_issue: {
                    required: true,
                },
                date_of_issue: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "ethnicity" || element.attr("name") == "hair_color" || element.attr("name") == "eye_color" || element.attr("name") == "member_of_us" || element.attr("name") == "beneficiary" || element.attr("name") == "citizenship" || element.attr("name") == "certificate" || element.attr("name") == "gender") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               f_name: "Please enter name!",                                  
               m_name: "Please enter name!",                                  
               l_name: "Please enter name!",                                  
               dob: "Please enter date!",                                  
               city_of_birth: "Please enter city!",                                  
               state_province: "Please enter address!",                                  
               country_of_birth: "Please enter country!",                                  
               m_no_country: "Please enter country!",                                  
               p_number: "Please enter number!",                                  
               ss_number: "Please enter number!",                                  
               sponsor_a: "Please enter if any!",                                  
               gender: "Please choose gender!",                                  
               feet: "Please enter feet!",                                  
               inches: "Please enter inches!",                                  
               pounds: "Please enter pounds!",                                  
               ethnicity: "Please choose ethnicity!",                                  
               hair_color: "Please choose hair color!",                                  
               eye_color: "Please choose eye color!",                                  
               member_of_us: "Please choose option!",                                  
               beneficiary: "Please choose option!",                                  
               citizenship: "Please choose option!",                                  
               certificate: "Please choose option!",                                  
               naturalization: "Please enter number!",                                  
               place_of_issue: "Please enter place!",                                  
               date_of_issue: "Please enter date!",                                  
            },
            submitHandler: function(form) {
                $('#adjustmentSponsorPart1Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentSponsorPart1') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.sponsor-part-1').removeClass('active');
                            $('.sponsor-part-2').addClass('active');
                            $('.adjustmentStatusForm').html(data.data);                    
                        }
                        if (data.status == false) {
                            toastr.options.timeOut = 10000;
                            toastr.error(data.message);                           
                        }
                    }
                });
               return false;
            }
        });        
    </script>   
</div>