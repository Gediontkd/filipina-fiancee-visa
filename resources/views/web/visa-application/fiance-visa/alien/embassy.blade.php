<!-- resources\views\web\visa-application\fiance-visa\alien\embassy.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienEmbassy'), 'id' => 'fianceAlienEmbassy']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>United States Embassy Overseas</h2>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label>At which U.S. Embassy abroad will your beneficiary have their interview <span class="required">*</span></label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('country', "Embassy Country") }}
                        <span class="required">*</span>
                        {{ Form::select('embassy_country', getAllCountry(), @$step->detail['embassy_country'], [
                            'class' => 'form-control embassy_country'
                        ]) }}                       
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('city', "Embassy City") }}
                        <span class="required">*</span>                        
                        {{ Form::select('city', [], @$step->detail['city'], [
                            'class' => 'form-control cities'
                        ]) }}
                        {{ Form::hidden('embassy_city', @$step->detail['city'], ['class' => 'embassyCity']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="mb-4">Normally the State Department will assign you to interview in the country where you live, as determined
                            by the address you (the alien) listed as your current residence. While you can request a different
                            embassy this request may not be granted. <span class="required">*</span></label>                        
                        <div class="radiogroup mt-4">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('english', 'no', @$step->detail['english'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input english'
                                ]) }}
                            	<span class="custom-control-label"></span> I can read and understand English.
                            </label>
                            <label class="custom-control custom-radio mb-0">
                                {{ Form::radio('english', 'yes', @$step->detail['english'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input english'
                                ]) }}
                            	<span class="custom-control-label"></span> An interpreter read the instructions and every question to me in the language below.
                            </label>
                            <div class="english"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 englishSec" style="display: {{ @$step->detail['english'] == 'yes' ? 'block' : 'none'  }};">
                    <h5>Enter mailing address only if it is different from the physical address. No foreign characters.</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('language', 'Language') }}
                                <span class="required">*</span>
                                {{ Form::text("language", @$step->detail['language'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Language'
                                ]) }}                                        
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Did you (the petitioner) act as the interpreter when filling out the form? <span class="required">*</span></label>                                
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio('petitioner', 'no', @$step->detail['petitioner'] == 'no' ? true : '', [
                                            'class' => 'custom-control-input actAsInterpreter'
                                        ]) }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0">
                                        {{ Form::radio('petitioner', 'yes', @$step->detail['petitioner'] == 'yes' ? true : '', [
                                            'class' => 'custom-control-input actAsInterpreter'
                                        ]) }}
                                        <span class="custom-control-label"></span> Yes

                                    </label>
                                    <div class="petitioner"></div>
                                </div>
                            </div>                          
                        </div>                                   
                    </div>
                    <div class="row actAsInterpreterSec" style="display: {{ @$step->detail['petitioner'] == 'no' ? 'block' : 'none'  }};">
                        <div class="col-md-12">
                            <div class="row">
                                <h2>Interpreter's Full Name</h2>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('interpreter_lname', "Interpreter's Family Name (Last Name)") }}
                                        <span class="required">*</span>
                                        {{ Form::text("interpreter_lname", @$step->detail['interpreter_lname'], [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter name'
                                        ]) }}                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('interpreter_fname', "Interpreter's Given Name (First Name)") }}
                                        <span class="required">*</span>
                                        {{ Form::text("interpreter_fname", @$step->detail['interpreter_fname'], [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter name'
                                        ]) }}                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('interpreter_buss_org', "Interpreter's Business or Organization Name (if any)") }}
                                        <span class="required">*</span>
                                        {{ Form::text("interpreter_buss_org", @$step->detail['interpreter_buss_org'], [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter name'
                                        ]) }}                                        
                                    </div>
                                </div>                            
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <h2>Interpreter's Mailing Address</h2>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('street_number_name', "Street Number and Name. (Example: 123 Main Street)") }}
                                        <span class="required">*</span>
                                        {{ Form::text("street_number_name", @$step->detail['street_number_name'], [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter address'
                                        ]) }}                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('apartment_suite_or_floor', 'Apartment, Suite or Floor?') }}
                                        <span class="required">*</span>
                                        {{ Form::select('apartment_suite_or_floor', [
                                            '' => 'Select', 
                                            'Apartment' => 'Apartment',
                                            'Suite' => 'Suite',
                                            'Floor' => 'Floor',
                                            'Dose Not Apply' => 'Dose Not Apply'
                                        ], @$step->detail['apartment_suite_or_floor'], [
                                            'class' => 'form-control'
                                        ]) }}
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('apartment_suite_floor_no', 'Apartment, Suite or Floor Number.  Example: 43 or 532-B.  Do not add "Apt" or "#"') }}
                                        <span class="required">*</span>
                                        {{ Form::text("apartment_suite_floor_no", @$step->detail['apartment_suite_floor_no'], [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter address'
                                        ]) }}                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('town_city', 'Town or City') }}
                                        <span class="required">*</span>
                                        {{ Form::text("town_city", @$step->detail['town_city'], [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Town or City'
                                        ]) }}                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('country', "Country") }}
                                        <span class="required">*</span>
                                        {{ Form::select('country', getAllCountry(), @$step->detail['country'], [
                                            'class' => 'form-control countryId'
                                        ]) }}                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('state', "U.S. State (Select Does Not Apply if not USA)") }}
                                        <span class="required">*</span>
                                        {{ Form::select('state', [], @$step->detail['state'], [
                                            'class' => 'form-control states'
                                        ]) }}                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('province', 'Province') }}
                                        <span class="required">*</span>
                                        {{ Form::text("province", @$step->detail['provinceApply'] ? 'N/A' : @$step->detail['province'], [
                                            'class' => 'form-control provinceApply',
                                            'placeholder' => 'Enter Province'
                                        ]) }}
                                        @include('web.component.does-not-apply', ['field' => 'provinceApply', 'value' => @$step->detail['provinceApply']])                                                         
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('postal_code', 'Postal Code') }}
                                        <span class="required">*</span>
                                        {{ Form::text("postal_code", @$step->detail['postalCode'] ? 'N/A' : @$step->detail['postal_code'], [
                                            'class' => 'form-control postalCode',
                                            'placeholder' => 'Enter Postal Code'
                                        ]) }}
                                        @include('web.component.does-not-apply', ['field' => 'postalCode', 'value' => @$step->detail['postalCode']])                                                                            
                                    </div>
                                </div>                      
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <h2>Interpreter's Contact Information</h2>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('country_code', 'Phone Number Country') }}
                                        <span class="required">*</span>
                                        {{ Form::select('country_code', getCountryPhoneCode(), @$step->detail['country_code'], ['class' => 'form-control',]) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('daytime_tele_no', "Interpreter's Daytime Telephone Number") }}
                                        <span class="required">*</span>
                                        {{ Form::text("daytime_tele_no", @$step->detail['daytime_tele_no'], [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter number'
                                        ]) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('mob_country_code', 'Mobile Number Country') }}
                                        <span class="required">*</span>
                                        {{ Form::select('mob_country_code', getCountryPhoneCode(), @$step->detail['mob_country_code'], ['class' => 'form-control',]) }}                          
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('Interpreter_mob_tele_no', "Interpreter's Mobile Telephone Number(if any)") }}
                                        <span class="required">*</span>
                                        {{ Form::text("Interpreter_mob_tele_no", @$step->detail['Interpreter_mob_tele_no'], [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter number'
                                        ]) }}                                        
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {{ Form::label('interpreter_email_add', "Interpreter's Email Address(if any)") }}
                                        <span class="required">*</span>
                                        {{ Form::text("interpreter_email_add", @$step->detail['interpreter_email_add'], [
                                            'class' => 'form-control',
                                            'placeholder' => 'Enter Email'
                                        ]) }}                                        
                                    </div>
                                </div>                      
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'embassy') !!}
        {!! Form::hidden('next', 'contact') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'citizenship'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'contact'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienEmbassyBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">       
        $(document).on('change', '.english', function(){
            if ($(this).val() == 'yes') {
                $('.englishSec').show();
            } else {
                $('.englishSec').hide();
            }
        });
        $(document).on('change', '.actAsInterpreter', function(){
            if ($(this).val() == 'no') {
                $('.actAsInterpreterSec').show();
            } else {
                $('.actAsInterpreterSec').hide();
            }
        });

        $(document).ready(function(){
            var embassyCity = $('.embassyCity').val();
            getState(231);
            getCity($('.countryId').val(), embassyCity);
        });       

        $(document).on('change', '.countryId', function(){
            var countryId = $(this).val();
            getCity(countryId);
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
                    countryId: countryId,
                },
                success: function(data) {
                    $('.states').html(data);                    
                }
            });
        }  

        function getCity(countryId, selected='') {
        if (!countryId) {
            $('.cities').html('<option value="">-Select City-</option>');
            return;
        }
        $.ajax({                
            type: 'get',
            url: "{{ route('getCities') }}",
            data: {
                countryId: countryId,
                selected: selected,
            },
            success: function(data) {
                $('.cities').html(data);                    
            }
        });
    }

    $(document).on('change', '.embassy_country', function(){
        var countryId = $(this).val();
        getCity(countryId);
    });

    $(document).ready(function(){
        var embassyCity = $('.embassyCity').val();
        var countryId = $('.embassy_country').val();
        
        getState(231);
        
        if (countryId) {
            getCity(countryId, embassyCity);
        }
    });

    $(document).on('change', '.countryId', function(){
        getState($(this).val());
    });

        $("#fianceAlienEmbassy").validate({
            rules: {
                country: {
                    required: true,
                },    
                city: {
                    required: true,
                }, 
                english: {
                    required: true,
                },
                language: {
                    required: true,
                },
                petitioner: {
                    required: true,
                },
                interpreter_lname: {
                    required: true,
                },
                interpreter_fname: {
                    required: true,
                },
                interpreter_buss_org: {
                    required: true,
                },
                street_number_name: {
                    required: true,
                },
                apartment_suite_or_floor: {
                    required: true,
                },
                apartment_suite_floor_no: {
                    required: true,
                },
                town_city: {
                    required: true,
                },
                country: {
                    required: true,
                },
                province: {
                    required: true,
                },
                postal_code: {
                    required: true,
                },
                country_code: {
                    required: true,
                },
                daytime_tele_no: {
                    required: true,
                },
                mob_country_code: {
                    required: true,
                },
                Interpreter_mob_tele_no: {
                    required: true,
                },
                interpreter_email_add: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "english" || element.attr("name") == "petitioner") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               country: "Please enter your country!",               
               city: "Please enter your city!",               
               english: "Please choose option!",               
               language: "Please enter language!",               
               petitioner: "Please enter petitioner!",               
               interpreter_lname: "Please enter name!",               
               interpreter_fname: "Please enter name!",               
               interpreter_buss_org: "Please enter name!",               
               street_number_name: "Please enter address!",               
               apartment_suite_or_floor: "Please enter address!",               
               apartment_suite_floor_no: "Please enter address!",               
               town_city: "Please enter town or city!",               
               country: "Please enter country!",               
               province: "Please enter province!",               
               postal_code: "Please enter postal code!",               
               country_code: "Please enter country code!",               
               daytime_tele_no: "Please enter number!",               
               mob_country_code: "Please enter mobile country code!",               
               Interpreter_mob_tele_no: "Please enter mobile number!",               
               interpreter_email_add: "Please enter email!",               
            },
            submitHandler: function(form) {
                $('#fianceAlienEmbassyBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienEmbassy') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activeembassy').removeClass('active');
                            $('.activecontact').addClass('active');
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