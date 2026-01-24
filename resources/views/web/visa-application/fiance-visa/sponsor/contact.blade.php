<!-- resources\views\web\visa-application\fiance-visa\sponsor\contact.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceSponsorContact'), 'id' => 'fianceSponsorContact']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>Sponsor's Contact Information</h2>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    	{{ Form::label('email', "Email Address") }}
                        <span class="required">*</span>
    					{{ Form::text('email', @$step->detail['email'], ['class' => 'form-control', 'placeholder' => 'Enter Email address']) }}        
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label('country_code', 'Mobile Number Country') }}
                        <span class="required">*</span>
    					{{ Form::select('country_code', getCountryPhoneCode(), @$step->detail['country_code'], ['class' => 'form-control',]) }}                          
                    </div>
                </div> --}}
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label('daytime_telephone_no', 'Daytime Phone') }}
                        <span class="required">*</span>
    					{{ Form::text('daytime_telephone_no', @$step->detail['daytime_telephone_no'], ['class' => 'form-control', 'placeholder' => 'Enter daytime phone']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label('mobile_telephone_number', 'Mobile Phone') }}
                        <span class="required">*</span>
    					{{ Form::text('mobile_telephone_number', @$step->detail['mobile_telephone_number'], ['class' => 'form-control', 'placeholder' => 'Enter mobile phone']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("social_sec_no", "Social Security Number (Format: 123-45-6789)") }}
                        <span class="required">*</span>
                        {{ Form::text("social_sec_no", @$step->detail['socialSecNo'] ? 'N/A' : @$step->detail['social_sec_no'], ['class' => 'form-control socialSecNo', 'placeholder' => "Enter number"]) }}
                        @include('web.component.does-not-apply', ['field' => 'socialSecNo', 'value' => @$step->detail['socialSecNo']])                       
                    </div>
                </div>
                {{-- <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("uscis_no", "USCIS Online Account Number. Uncommon") }}
                        <span class="required">*</span>
                        {{ Form::text("uscis_no", @$step->detail['uscisNo'] ? 'N/A' : @$step->detail['uscis_no'], ['class' => 'form-control uscisNo', 'placeholder' => "Enter number"]) }}
                        @include('web.component.does-not-apply', ['field' => 'uscisNo', 'value' => @$step->detail['uscisNo']])                        
                    </div>
                </div> --}}
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('sponsor_a', "Sponsor's A#. Uncommon") }}
                        <span class="required">*</span>
                        {{ Form::text('sponsor_a', @$step->detail['sponsorA'] ? 'N/A' : @$step->detail['sponsor_a'], ['class' => 'form-control sponsorA', 'placeholder' => '']) }}
                        @include('web.component.does-not-apply', ['field' => 'sponsorA', 'value' => @$step->detail['sponsorA']])
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
                    <p class="text-danger" style="font-weight: bold;">Enter your mailing address only if it is different from your physical address. Using a Post Office box or a foreign address is risky and should be avoided unless it is your only option for mail delivery.</p>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('in_care_name', 'In Care Of Name') }}
                                <span class="required">*</span>
                                {{ Form::text("in_care_name", @$step->detail['inCareName'] ? 'N/A' : @$step->detail['in_care_name'], [
                                    'class' => 'form-control inCareName',
                                    'placeholder' => 'Enter name'
                                ]) }}
                                @include('web.component.does-not-apply', ['field' => 'inCareName', 'value' => @$step->detail['inCareName']])                                                               
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
                                {{ Form::select("country", getAllCountryForSponsor(), @$step->detail['country'], [
                                    'class' => 'form-control countryId'
                                ]) }}                       
                            </div>                           
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('state', "U.S. State") }}
                                <span class="required">*</span>
                                {{ Form::select("state", getAllUsStates(@$step->detail['contactUsState']), @$step->detail['state'], [
                                    'class' => 'form-control contactUsState',
                                    'data-state' => @$step->detail['contactUsState'] ? 'N/A' : @$step->detail['state'],
                                    'disabled' => @$step->detail['contactUsState'] ? true : false
                                ]) }}     
                                @include('web.component.does-not-apply', ['field' => 'contactUsState', 'value' => @$step->detail['contactUsState']])                
                            </div>                            
                        </div>               
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('province', 'Province') }}
                                <span class="required">*</span>
                                {{ Form::text("province", @$step->detail['province'] ? 'N/A' : @$step->detail['province'], [
                                    'class' => 'form-control province',
                                    'placeholder' => 'Enter Province'
                                ]) }}
                                @include('web.component.does-not-apply', ['field' => 'province', 'value' => @$step->detail['province']])
                            </div>                            
                        </div>               
                        <div class="col-md-12">
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
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'contact') !!}
        {!! Form::hidden('next', 'place-of-birth') !!}
        {!! Form::hidden('type', 'sponsor') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 sponsorPreviousOrContinue',
            'data-form' => 'place-of-birth'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceSponsorContactBtn',
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
            var state = $('.contactUsState').data('state');
            getState(231, state);
        });

        $(document).on('change', '.countryId', function(){
            // var countryId = $(this).val();
            getState(231);
        });

        function getState(countryId, state='')
        {
            $.ajax({                
                type: 'get',
                url: "{{ route('getState') }}",
                data: {
                    countryId: countryId,
                    state: state
                },
                success: function(data) {
                    $('.contactUsState').html(data);                    
                }
            });
        }

        $("#fianceSponsorContact").validate({
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
                sponsor_a: {
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
               sponsor_a: "Please enter sponsor a!",
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
                $('#fianceSponsorContactBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceSponsorContact') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activecontact').removeClass('active');
                            $('.activeplace-of-birth').addClass('active');
                            $('.fianceSponsorForm').html(data.data);                    
                        }
                        if (data.status == false) {
                            toastr.options.timeOut = 10000;
                            toastr.error(data.message);
                            // setTimeout(function() {
                            //     location.reload();
                            // }, 3000);
                        }
                    }
                });
               return false;
            }
        });
    </script>                    
</div>