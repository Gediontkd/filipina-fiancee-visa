<!-- resources\views\web\visa-application\fiance-visa\alien\parents.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienParents'), 'id' => 'fianceAlienParents']) }}
        <div class="form-card">
            <h1>Alien's Parents</h1>            
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Alien's Father Information</h2>
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
    					{{ Form::text("father_middle_name", @$step->detail['fatherMiddleName'] ? 'N/A' : @$step->detail['father_middle_name'], ['class' => 'form-control fatherMiddleName', 'placeholder' => "Enter Middle Name"]) }}
                        @include('web.component.does-not-apply', ['field' => 'fatherMiddleName', 'value' => @$step->detail['fatherMiddleName']])
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label("father_dob", "Father's Date of Birth") }}
                        <span class="required">*</span>
    					{{ Form::text("father_dob", @$step->detail["fatherDob"] ? 'Unkown' : @$step->detail['father_dob'], [
                            'class' => 'form-control dateOfBirth fatherDob', 
                            'placeholder' => "Enter Date of Birth",
                            'disabled' => @$step->detail["fatherDob"] ? true : false
                        ]) }}
                        @include('web.component.unknown', ['field' => "fatherDob", 'value' => @$step->detail["fatherDob"]])
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("father_city_town", "Father's City/Town/Village of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("father_city_town", @$step->detail['fatherCityTown'] ? 'N/A' : @$step->detail['father_city_town'], ['class' => 'form-control fatherCityTown', 'placeholder' => "Enter Place"]) }}
                        @include('web.component.does-not-apply', ['field' => 'fatherCityTown', 'value' => @$step->detail['fatherCityTown']])
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label("father_city_or_province_of_birth", "Father's City or Province of Birth") }}
                        <span class="required">*</span>
    					{{ Form::text("father_city_or_province_of_birth", @$step->detail['fatherCityProvBirth'] ? 'N/A' : @$step->detail['father_city_or_province_of_birth'], ['class' => 'form-control fatherCityProvBirth', 'placeholder' => "Enter City or Province"]) }}
                        @include('web.component.does-not-apply', ['field' => 'fatherCityProvBirth', 'value' => @$step->detail['fatherCityProvBirth']])                              
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label('father_birth_country', "Father's Country of Birth") }}
                        <span class="required">*</span>
    					{{ Form::select('father_birth_country', getAllCountry(), @$step->detail['father_birth_country'], ['class' => 'form-control fatherBirthCountry',]) }}
                        {{-- @include('web.component.does-not-apply', ['field' => 'fatherBirthCountry', 'value' => @$step->detail['fatherBirthCountry']])             --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Is he deceased? </label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('he_deceased', 'no', @$step->detail['he_deceased'] == 'no' ? true : '', ['class' => 'custom-control-input isHeDeceased']) }}
                            	<span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('he_deceased', 'yes', @$step->detail['he_deceased'] == 'yes' ? true : '', ['class' => 'custom-control-input isHeDeceased']) }}
                            	<span class="custom-control-label"></span> Yes
                            </label>
                            <div class="he_deceased"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 heDeceasedSec" style="display: {{ @$step->detail['he_deceased'] == 'yes' ? 'block' : 'none'  }};">
                    <div class="form-group">
                        {{ Form::label("father_dod", "Father's Date of Death.") }}
                        <span class="required">*</span>
                        {{ Form::text("father_dod", @$step->detail['father_dod'], ['class' => 'form-control dateOfBirth', 'placeholder' => "Enter Date"]) }}
                    </div>
                </div>
                <div class="col-md-12 fatherAddressSec" style="display: {{ @$step->detail['he_deceased'] == 'no' ? 'block' : 'none'  }};">
                    <div class="row">
                        <h4>Current Address</h4>
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
                                    'Dose Not Apply' => 'Dose Not Apply'
                                ], @$step->detail['father_apartment_suite_or_floor'], [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number') }}
                                <span class="required">*</span>
                                {{ Form::text('father_apartment_suite_or_floor_no', @$step->detail['father_apartment_suite_or_floor_no'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Apartment, Suite or Floor Number'
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
                                {{ Form::label('father_state', "U.S. State") }}
                                <span class="required">*</span>
                                {{ Form::select('father_state', [], @$step->detail['father_country'], [
                                    'class' => 'form-control states'
                                ]) }}                        
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('father_province', 'Province') }}
                                <span class="required">*</span>
                                {{ Form::text("father_province", @$step->detail['fatherProvince'] ? 'N/A' : @$step->detail['father_province'], [
                                    'class' => 'form-control fatherProvince',
                                    'placeholder' => 'Enter Province'
                                ]) }}
                                @include('web.component.does-not-apply', ['field' => 'fatherProvince', 'value' => @$step->detail['fatherProvince']])
                            </div>                            
                        </div>   
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('father_postal_code', 'Postal Code') }}
                                <span class="required">*</span>
                                {{ Form::text('father_postal_code', @$step->detail['fatherPostalCode'] ? 'N/A' : @$step->detail['father_postal_code'], [
                                    'class' => 'form-control fatherPostalCode',
                                    'placeholder' => 'Enter Postal Code'
                                ]) }}
                                @include('web.component.does-not-apply', ['field' => 'fatherPostalCode', 'value' => @$step->detail['fatherPostalCode']])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Alien's Mother Information</h2>
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
    					{{ Form::text("mother_middle_name", @$step->detail['motherMiddleName'] ? 'N/A' : @$step->detail['mother_middle_name'], ['class' => 'form-control motherMiddleName', 'placeholder' => "Enter Middle Name"]) }}
                        @include('web.component.does-not-apply', ['field' => 'motherMiddleName', 'value' => @$step->detail['motherMiddleName']])
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label("mother_dob", "Mother's Date of Birth") }}
                        <span class="required">*</span>
    					{{ Form::text("mother_dob", @$step->detail["motherDob"] ? 'Unkown' : @$step->detail['mother_dob'], [
                            'class' => 'form-control dateOfBirth motherDob', 
                            'placeholder' => "Enter Date of Birth",
                            'disabled' => @$step->detail["motherDob"] ? true : false
                        ]) }}
                        @include('web.component.unknown', ['field' => "motherDob", 'value' => @$step->detail["motherDob"]])  
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_city_town", "Mother's City/Town/Village of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_city_town", @$step->detail['motherCityTown'] ? 'N/A' : @$step->detail['mother_city_town'], ['class' => 'form-control motherCityTown', 'placeholder' => "Enter Address"]) }}
                        @include('web.component.does-not-apply', ['field' => 'motherCityTown', 'value' => @$step->detail['motherCityTown']])
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_city_or_province_of_birth", "Mother's City or Province of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_city_or_province_of_birth", @$step->detail['motherCityProBirth'] ? 'N/A' : @$step->detail['mother_city_or_province_of_birth'], ['class' => 'form-control motherCityProBirth', 'placeholder' => "Enter City or Province"]) }}
                        @include('web.component.does-not-apply', ['field' => 'motherCityProBirth', 'value' => @$step->detail['motherCityProBirth']])                          
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label('mother_birth_country', "Mother's Country of Birth") }}
                        <span class="required">*</span>
    					{{ Form::select('mother_birth_country', getAllCountry(), @$step->detail['mother_birth_country'], ['class' => 'form-control motherBirthCountry']) }}
                        {{-- @include('web.component.does-not-apply', ['field' => 'motherBirthCountry', 'value' => @$step->detail['motherBirthCountry']])                     --}}
                    </div>
                </div>                
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Is she deceased?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('she_deceased', 'no', @$step->detail['she_deceased'] == 'no' ? true : '', ['class' => 'custom-control-input isSheDeceased']) }}
                            	<span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('she_deceased', 'yes', @$step->detail['she_deceased'] == 'yes' ? true : '', ['class' => 'custom-control-input isSheDeceased']) }}
                            	<span class="custom-control-label"></span> Yes
                            </label>
                            <div class="she_deceased"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 sheDeceasedSec" style="display: {{ @$step->detail['she_deceased'] == 'yes' ? 'block' : 'none' }};">
                    <div class="form-group">
                        {{ Form::label("mother_dod", "Mother's Date of Death.") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_dod", @$step->detail['mother_dod'], ['class' => 'form-control dateOfBirth', 'placeholder' => "Enter Date"]) }}                                   
                    </div>
                </div>                
                <div class="col-md-12 motherAddressSec" style="display: {{ @$step->detail['she_deceased'] == 'no' ? 'block' : 'none' }};">
                    <div class="row">
                        <h4>Current Address</h4>
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
                                    'Dose Not Apply' => 'Dose Not Apply'
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
                                    'placeholder' => 'Enter Apartment, Suite or Floor Number'
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
                                {{ Form::label('mother_state', "U.S. State") }}
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
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Province'
                                ]) }}
                            </div>                            
                        </div>   
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('mother_postal_code', 'Postal Code') }}
                                <span class="required">*</span>
                                {{ Form::text('mother_postal_code', @$step->detail['mother_postal_code'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Postal Code'
                                ]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'parents') !!}
        {!! Form::hidden('next', 'visited-us') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'marital-status'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'visited-us'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienParentsBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            getState(231);
        });

        $(document).on('change', '.countryId', function(){
            // var countryId = $(this).val();
            getState(231);
        });

        function getState(countryId)
        {
            $.ajax({                
                type: 'get',
                url: "{{ route('getState') }}",
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
            } 
            if ($(this).val() == 'no') {
                $('.heDeceasedSec').hide();
                $('.fatherAddressSec').show();
            }
        });

        $(document).on('change', '.isSheDeceased', function(){
            if ($(this).val() == 'yes') {
                $('.motherAddressSec').hide();
                $('.sheDeceasedSec').show();
            } 
            if ($(this).val() == 'no') {
                $('.sheDeceasedSec').hide();
                $('.motherAddressSec').show();
            }
        });      

        $("#fianceAlienParents").validate({
            rules: {               
                father_first_name: {
                    required: true,
                },
                father_middle_name: {
                    required: true,
                },
                father_last_name: {
                    required: true,
                },
                father_dob: {
                    required: true,
                },
                father_city_town: {
                    required: true,
                },
                father_city_or_province_of_birth: {
                    required: true,
                },
                father_birth_country: {
                    required: true,
                },
                he_deceased: {
                    required: true,
                },
                father_number_and_street: {
                    required: true,
                },
                father_apartment_suite_or_floor: {
                    required: true,
                },
                father_apartment_suite_or_floor_no: {
                    required: true,
                },
                father_town_or_city: {
                    required: true,
                },
                father_country: {
                    required: true,
                },
                father_province: {
                    required: true,
                },
                father_postal_code: {
                    required: true,
                },
                mother_first_name: {
                    required: true,
                },
                mother_middle_name: {
                    required: true,
                },
                mother_maiden_last_name: {
                    required: true,
                },
                mother_dob: {
                    required: true,
                }, 
                mother_city_town: {
                    required: true,
                },
                mother_city_or_province_of_birth: {
                    required: true,
                },
                mother_birth_country: {
                    required: true,
                },
                she_deceased: {
                    required: true,
                },
                mother_number_and_street: {
                    required: true,
                },
                mother_apartment_suite_or_floor: {
                    required: true,
                },
                mother_apartment_suite_or_floor_no: {
                    required: true,
                },
                mother_town_or_city: {
                    required: true,
                },
                mother_country: {
                    required: true,
                },
                mother_province: {
                    required: true,
                },
                mother_postal_code: {
                    required: true,
                },       
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "he_deceased" || element.attr("name") == "she_deceased") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               father_first_name: "Please enter name!",
               father_middle_name: "Please enter name!",
               father_last_name: "Please enter name!",
               father_dob: "Please choose dob!",
               father_city_town: "Please enter city or town!",
               father_city_or_province_of_birth: "Please enter city or date!",
               father_birth_country: "Please choose country!",
               he_deceased: "Please choose option!",
               father_number_and_street: "Please enter address!",
               father_apartment_suite_or_floor: "Please enter address!",
               father_apartment_suite_or_floor_no: "Please enter address!",
               father_town_or_city: "Please enter city or town!",
               father_country: "Please enter country!",
               father_province: "Please enter province!",
               father_postal_code: "Please enter postal code!",
               mother_first_name: "Please enter name!",
               mother_middle_name: "Please enter name!",
               mother_maiden_last_name: "Please enter name!",
               mother_dob: "Please choose dob!",
               mother_city_town: "Please enter city or town!",
               mother_city_or_province_of_birth: "Please enter address!",
               mother_birth_country: "Please choose country!",
               she_deceased: "Please choose option!",
               mother_number_and_street: "Please enter address!",
               mother_apartment_suite_or_floor: "Please enter address!",
               mother_apartment_suite_or_floor_no: "Please enter address!",
               mother_town_or_city: "Please enter city or town!",
               mother_country: "Please enter country!",
               mother_province: "Please enter province!",
               mother_postal_code: "Please enter postal code!",
            },
            submitHandler: function(form) {
                $('#fianceAlienParentsBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienParents') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activeparents').removeClass('active');
                            $('.activevisited-us').addClass('active');
                            $('.fianceVisaForm').html(data.data);                    
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