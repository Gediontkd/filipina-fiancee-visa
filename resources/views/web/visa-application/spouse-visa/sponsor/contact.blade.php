<!-- resources\views\web\visa-application\spouse-visa\sponsor\contact.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseContact'), 'id' => 'spouseContact']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>Sponsors Contact Information</h2>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    	{{ Form::label('email', "Alien's Email Address") }}
                        <span class="required">*</span>
    					{{ Form::text('email', @$step->detail['email'], ['class' => 'form-control', 'placeholder' => 'Enter Email address']) }}        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label('country_code', 'Phone Number Country') }}
                        <span class="required">*</span>
    					{{ Form::select('country_code', getCountryPhoneCode(), @$step->detail['country_code'], ['class' => 'form-control',]) }}                          
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label('telephone_number', 'Daytime Telephone Number') }}
                        <span class="required">*</span>
    					{{ Form::text('telephone_number', @$step->detail['telephone_number'], ['class' => 'form-control', 'placeholder' => 'Enter Telephone number']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('mob_no_country', 'Mobile Number Country') }}
                        <span class="required">*</span>
                        {{ Form::select('mob_no_country', getCountryPhoneCode(), @$step->detail['mob_no_country'], ['class' => 'form-control',]) }}                          
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('mob_telephone_number', 'Mobile Telephone Number') }}
                        <span class="required">*</span>
                        {{ Form::text('mob_telephone_number', @$step->detail['mob_telephone_number'], ['class' => 'form-control', 'placeholder' => 'Enter Telephone number']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    	{{ Form::label("reg_no", "Alien Registration Number or A#") }}
                        <span class="required">*</span>
    					{{ Form::text("reg_no", @$step->detail['reg_no'], ['class' => 'form-control regNo', 'placeholder' => "Enter Registration number"]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => 'regNo'
                        ]) }}      
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("tax_id", "United States Tax ID") }}
                        <span class="required">*</span>
                        {{ Form::text("tax_id", @$step->detail['tax_id'], ['class' => 'form-control taxId', 'placeholder' => "Enter Id"]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => 'taxId'
                        ]) }}   
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("social_sec_no", "U.S. Social Security Number") }}
                        <span class="required">*</span>
                        {{ Form::text("social_sec_no", @$step->detail['social_sec_no'], ['class' => 'form-control socialSecNo', 'placeholder' => "Enter number"]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => 'socialSecNo'
                        ]) }}    
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("uscis_no", "USCIS Online Account Number") }}
                        <span class="required">*</span>
                        {{ Form::text("uscis_no", @$step->detail['uscis_no'], ['class' => 'form-control uscisNo', 'placeholder' => "Enter number"]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => 'uscisNo'
                        ]) }}      
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Is your mailing address different from your physical address?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('diffrent_mailing_address', 'no', @$step->detail['diffrent_mailing_address'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input diffrentMailingAddress'
                                ]) }}
                            	<span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('diffrent_mailing_address', 'yes', @$step->detail['diffrent_mailing_address'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input diffrentMailingAddress'
                                ]) }}
                            	<span class="custom-control-label"></span> Yes
                            </label>
                            <div class="diffrent_mailing_address"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 diffrentMailingAddressSec" style="display: {{ @$step->detail['diffrent_mailing_address'] == 'yes' ? 'block' : 'none'  }};">
                    <h5>Enter mailing address only if it is different from the physical address. No foreign characters.</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('in_care_name', 'In Care Of Name') }}
                                <span class="required">*</span>
                                {{ Form::text("in_care_name", @$step->detail['in_care_name'], [
                                    'class' => 'form-control inCareName',
                                    'placeholder' => 'Enter name'
                                ]) }}
                                {{ Form::label('does_not_apply', "Does Not Apply") }}
                                {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                    'class' => 'custom-control-input doesNotApply',
                                    'data-field' => 'inCareName'
                                ]) }}                                    
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('apartment_suite_or_floor', 'Apartment, Suite or Floor?') }}
                                <span class="required">*</span>
                                {{ Form::select("apartment_suite_or_floor", [
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
                                {{ Form::label('number_and_street', 'Number and street.  Example: 123 Main Street') }}
                                <span class="required">*</span>
                                {{ Form::text("number_and_street", @$step->detail['number_and_street'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter address'
                                ]) }}                                        
                            </div>                            
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number.  Example: 43 or 532-B.  Do not add "Apt" or "#". ') }}
                                <span class="required">*</span>
                                {{ Form::text("apartment_suite_or_floor_no", @$step->detail['apartment_suite_or_floor_no'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter address'
                                ]) }}                                        
                            </div>                            
                        </div>                   
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('town_or_city', 'Town or City') }}
                                <span class="required">*</span>
                                {{ Form::text("town_or_city", @$step->detail['town_or_city'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Town or City'
                                ]) }}
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('country', "Country") }}
                                <span class="required">*</span>
                                {{ Form::select("country", getAllCountry(), @$step->detail['country'], [
                                    'class' => 'form-control countryId'
                                ]) }}                       
                            </div>                           
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('state', "U.S. State") }}
                                <span class="required">*</span>
                                {{ Form::select("state", [], @$step->detail['state'], [
                                    'class' => 'form-control states'
                                ]) }}                        
                            </div>                            
                        </div>               
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('province', 'Province') }}
                                <span class="required">*</span>
                                {{ Form::text("province", @$step->detail['province'], [
                                    'class' => 'form-control province',
                                    'placeholder' => 'Enter Province'
                                ]) }}
                                {{ Form::label('does_not_apply', "Does Not Apply") }}
                                {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                    'class' => 'custom-control-input doesNotApply',
                                    'data-field' => 'province'
                                ]) }} 
                            </div>                            
                        </div>               
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('postal_code', 'Postal Code') }}
                                <span class="required">*</span>
                                {{ Form::text("postal_code", @$step->detail['postal_code'], [
                                    'class' => 'form-control postalCode',
                                    'placeholder' => 'Enter Postal Code'
                                ]) }}
                                {{ Form::label('does_not_apply', "Does Not Apply") }}
                                {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                    'class' => 'custom-control-input doesNotApply',
                                    'data-field' => 'postalCode'
                                ]) }} 
                            </div>                            
                        </div>               
                    </div>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'contact') !!}
        {!! Form::hidden('next', 'place-of-birth') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'place-of-birth'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseContactBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $(document).on('change', '.diffrentMailingAddress', function(){
            if ($(this).val() == 'yes') {
                $('.diffrentMailingAddressSec').show();
            } else {
                $('.diffrentMailingAddressSec').hide();
            }
        });

        $(document).ready(function(){
            getState(231);
        });

        $(document).on('change', '.countryId', function(){
            var countryId = $(this).val();
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

        $("#spouseContact").validate({
            rules: {
                email: {
                    required: true,
                },
                country_code: {
                    required: true,
                },
                mobile_number: {
                    required: true,
                },
                telephone_number: {
                    required: true,
                },
                mob_no_country: {
                    required: true,
                },
                mob_telephone_number: {
                    required: true,
                },
                reg_no: {
                    required: true,
                },
                tax_id: {
                    required: true,
                },
                social_sec_no: {
                    required: true,
                },
                uscis_no: {
                    required: true,
                },
                diffrent_mailing_address: {
                    required: true,
                },
                in_care_name: {
                    required: true,
                },
                apartment_suite_or_floor: {
                    required: true,
                },
                number_and_street: {
                    required: true,
                },
                apartment_suite_or_floor_no: {
                    required: true,
                },
                town_or_city: {
                    required: true,
                },
                country: {
                    required: true,
                },
                state: {
                    required: true,
                },
                province: {
                    required: true,
                },
                postal_code: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "diffrent_mailing_address") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               email: "Please enter your email!",
               country_code: "Please choose country code!",
               mobile_number: "Please enter mobile number!",
               telephone_number: "Please enter number!",
               mob_no_country: "Please enter number!",
               mob_telephone_number: "Please enter number",
               reg_no: "Please enter number!",
               tax_id: "Please enter id!",
               social_sec_no: "Please enter social securety number!",
               uscis_no: "Please enter number!",
               diffrent_mailing_address: "Please enter address!",
               in_care_name: "Please enter name!",
               apartment_suite_or_floor: "Please choose address!",
               number_and_street: "Please address!",
               apartment_suite_or_floor_no: "Please enter address!",
               town_or_city: "Please enter city or town!",
               country: "Please enter country!",
               state: "Please enter state!",
               province: "Please enter province!",
               postal_code: "Please enter postal code!",
            },
            submitHandler: function(form) {
                $('#spouseContactBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('spouseContact') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.contact').removeClass('active');
                            $('.place-of-birth').addClass('active');
                            $('.spouseVisaForm').html(data.data);                    
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