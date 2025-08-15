<div class="step-wizard">
    {{ Form::open(['url' => route('fianceSponsorPlaceOfBirth'), 'id' => 'fianceSponsorPlaceOfBirth']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Sponsor's Birth Information</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("s_dob", "Sponsor's Date of Birth as mm/dd/yyyy") }}
                        <span class="required">*</span>
                        {{ Form::text("s_dob",  @$step->detail['s_dob'], ['class' => 'form-control dateOfBirth fatherDob', 'placeholder' => "Enter Date of Birth"]) }}                       
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("s_city_of_birth", "Sponsor's City of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("s_city_of_birth", @$step->detail['s_city_of_birth'], ['class' => 'form-control', 'placeholder' => "Enter City"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("s_state_of_birth", "Sponsor's State of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("s_state_of_birth", @$step->detail['s_state_of_birth'], ['class' => 'form-control', 'placeholder' => "Enter State"]) }}
                    </div>
                </div>               
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('s_country_of_birth', "Sponsor's Country of Birth") }}
                        <span class="required">*</span>
                        {{ Form::select('s_country_of_birth', getAllCountryForSponsor(), @$step->detail['s_country_of_birth'], ['class' => 'form-control',]) }}                             
                    </div>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Sponsor's Father Information</h2>
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
                        {{ Form::text("father_dob", @$step->detail['fatherDob'] ? 'N/A' : @$step->detail['father_dob'], ['class' => 'form-control dateOfBirth fatherDob', 'placeholder' => "Enter Date of Birth"]) }}
                        @include('web.component.does-not-apply', ['field' => 'fatherDob', 'value' => @$step->detail['fatherDob']]) 
                    </div>
                </div>               
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("father_city_or_province_of_birth", "Father's City of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("father_city_or_province_of_birth", @$step->detail['father_city_or_province_of_birth'], ['class' => 'form-control', 'placeholder' => "Enter City or Province"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('father_birth_country', "Father's Country of Birth") }}
                        <span class="required">*</span>
                        {{ Form::select('father_birth_country', getAllCountryForSponsor(), @$step->detail['father_birth_country'], ['class' => 'form-control',]) }}
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
                <div class="col-md-12 fatherAddressSec" style="display: {{ @$step->detail['he_deceased'] == 'no' ? 'block' : 'none'  }};">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('father_city_of_res', "Father's City of Current Residence") }}
                                <span class="required">*</span>
                                {{ Form::text('father_city_of_res', @$step->detail['father_city_of_res'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter City of  Current Residence'
                                ]) }}
                            </div>
                        </div>                        
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('father_country', "Father's Country of Current Residence") }}
                                <span class="required">*</span>
                                {{ Form::select('father_country', getAllCountryForSponsor(), @$step->detail['father_country'], [
                                    'class' => 'form-control countryId'
                                ]) }}                       
                            </div>
                        </div>                       
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Sponsor's Mother Information</h2>
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
                        {{ Form::label("mother_dob", "Mother's Date of Birth (mm/dd/yyyy)") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_dob", @$step->detail['motherDob'] ? 'N/A' : @$step->detail['mother_dob'], ['class' => 'form-control dateOfBirth motherDob', 'placeholder' => "Enter Date of Birth"]) }}
                        @include('web.component.does-not-apply', ['field' => 'motherDob', 'value' => @$step->detail['motherDob']])  
                    </div>
                </div>              
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('mother_birth_country', "Mother's Country of Birth") }}
                        <span class="required">*</span>
                        {{ Form::select('mother_birth_country', getAllCountryForSponsor(@$step->detail['motherBirthCountry']), @$step->detail['mother_birth_country'], ['class' => 'form-control motherBirthCountry']) }}
                        @include('web.component.does-not-apply', ['field' => 'motherBirthCountry', 'value' => @$step->detail['motherBirthCountry']])                                
                    </div>
                </div>                
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_city_of_birth", "Mother's City of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_city_of_birth", @$step->detail['mother_city_of_birth'], ['class' => 'form-control', 'placeholder' => "Enter City of Birth"]) }}                                        
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
                <div class="col-md-12 motherAddressSec" style="display: {{ @$step->detail['she_deceased'] == 'no' ? 'block' : 'none' }};">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('mother_city_of_res', "Mother's City of Current Residence") }}
                                <span class="required">*</span>
                                {{ Form::text('mother_city_of_res', @$step->detail['mother_city_of_res'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter City of Current Residence'
                                ]) }}
                            </div>
                        </div>                       
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('mother_country', "Country") }}
                                <span class="required">*</span>
                                {{ Form::select('mother_country', getAllCountryForSponsor(), @$step->detail['mother_country'], [
                                    'class' => 'form-control countryId'
                                ]) }}                       
                            </div>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'place-of-birth') !!}
        {!! Form::hidden('next', 'status') !!}
        {!! Form::hidden('type', 'sponsor') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'contact'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 sponsorPreviousOrContinue',
            'data-form' => 'status'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceSponsorPlaceOfBirthBtn',
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
            } 
            if ($(this).val() == 'no') {
                $('.fatherAddressSec').show();
            }
        });

        $(document).on('change', '.isSheDeceased', function(){
            if ($(this).val() == 'yes') {
                $('.motherAddressSec').hide();
            } 
            if ($(this).val() == 'no') {
                $('.motherAddressSec').show();
            }
        });      

        $("#fianceSponsorPlaceOfBirth").validate({
            rules: {               
                s_dob: {
                    required: true,
                },
                s_city_of_birth: {
                    required: true,
                },
                s_state_of_birth: {
                    required: true,
                },
                s_country_of_birth: {
                    required: true,
                },
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
                father_city_or_province_of_birth: {
                    required: true,
                },
                father_birth_country: {
                    required: true,
                },
                he_deceased: {
                    required: true,
                },                                                
                father_country: {
                    required: true,
                },
                father_city_of_res: {
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
                mother_birth_country: {
                    required: true,
                },
                mother_city_of_birth: {
                    required: true,
                },
                she_deceased: {
                    required: true,
                },                
                mother_country: {
                    required: true,
                },
                mother_city_of_res: {
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
               s_dob: "Please enter date of birth!",
               s_city_of_birth: "Please enter city of birth!",
               s_state_of_birth: "Please enter state of birth!",
               s_country_of_birth: "Please enter country of birth!",
               father_first_name: "Please enter name!",
               father_middle_name: "Please enter name!",
               father_last_name: "Please enter name!",
               father_dob: "Please enter date of birth!",               
               father_city_or_province_of_birth: "Please enter city or date!",
               father_birth_country: "Please choose country!",
               he_deceased: "Please choose option!",               
               father_city_of_res: "Please enter city!",                              
               father_country: "Please enter country!",                              
               mother_first_name: "Please enter name!",
               mother_middle_name: "Please enter name!",
               mother_maiden_last_name: "Please enter name!",
               mother_dob: "Please choose dob!",                              
               mother_city_of_birth: "Please enter city!",
               mother_birth_country: "Please choose country!",
               she_deceased: "Please choose option!",               
               mother_city_of_res: "Please enter city!",                              
               mother_country: "Please enter country!",                              
            },
            submitHandler: function(form) {
                $('#fianceSponsorPlaceOfBirthBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceSponsorPlaceOfBirth') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activeplace-of-birth').removeClass('active');
                            $('.activestatus').addClass('active');
                            $('.fianceSponsorForm').html(data.data);                    
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