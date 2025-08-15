<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentAddress'), 'id' => 'adjustmentAddress']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>{{$type}}'s Current Address</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('in_care_name', 'In Care Of Name') }}
                        <span class="required">*</span>
                        {{ Form::text('in_care_name', @$step->detail['in_care_name'], [
                            'class' => 'form-control inCareName',
                            'placeholder' => 'Enter Name'
                        ]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "inCareName"
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('number_and_street', 'Number and street. Example: 123 Main Street ') }}
                        <span class="required">*</span>
                        {{ Form::text('number_and_street', @$step->detail['number_and_street'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter number and street'
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
                        {{ Form::label('apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number. Example: 43 or 532-B.  Do not add "Apt" or "#".') }}
                        <span class="required">*</span>
                        {{ Form::text('apartment_suite_or_floor_no', @$step->detail['apartment_suite_or_floor_no'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Apartment, Suite or Floor Number'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('city', 'City') }}
                        <span class="required">*</span>
                        {{ Form::text('city', @$step->detail['city'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter City'
                        ]) }}
                    </div>
                </div>               
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('state', "U.S. State") }}
                        <span class="required">*</span>
                        {{ Form::select('state', ['-Select State-'], @$step->detail['state'], [
                            'class' => 'form-control states'
                        ]) }}                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('zip_code', 'Zip Code') }}
                        <span class="required">*</span>
                        {{ Form::text('zip_code', @$step->detail['zip_code'], [
                            'class' => 'form-control zipCode',
                            'placeholder' => 'Enter Zip Code'
                        ]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "zipCode"
                        ]) }}
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('country', "Country (Must be United States)") }}
                        <span class="required">*</span>
                        {{ Form::select('country', getAllCountry(), @$step->detail['country'], [
                            'class' => 'form-control countryId',
                        ]) }}                       
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('date_from', "$type's has lived at this address since (mm/dd/yyyy)") }}
                        <span class="required">*</span>
                        {{ Form::text('date_from', @$step->detail['date_from'], [
                            'class' => 'form-control dateOfBirth',
                            'placeholder' => 'Enter Date'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Is the alien's mailing address in the United States but different from the physical address?</b> <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('different_address', 'no', @$step->detail['different_address'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input diffrentAddress'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('different_address', 'yes', @$step->detail['different_address'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input diffrentAddress'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="different_address"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 diffrentAddressSec" style="display:{{@$step->detail['different_address'] == 'yes' ? 'block' : 'none'}};">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('us_in_care_name', 'In Care Of Name') }}
                                <span class="required">*</span>
                                {{ Form::text('us_in_care_name', @$step->detail['us_in_care_name'], [
                                    'class' => 'form-control usInCareName',
                                    'placeholder' => 'Enter Name'
                                ]) }}
                                {{ Form::label('does_not_apply', "Does Not Apply") }}
                                {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                    'class' => 'custom-control-input doesNotApply',
                                    'data-field' => "usInCareName"
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('us_number_and_street', 'Number and street') }}
                                <span class="required">*</span>
                                {{ Form::text('us_number_and_street', @$step->detail['us_number_and_street'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter number and street'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('us_apartment_suite_or_floor', 'Apartment, Suite or Floor?') }}
                                <span class="required">*</span>
                                {{ Form::select('us_apartment_suite_or_floor', [
                                    '' => 'Select', 
                                    'Apartment' => 'Apartment',
                                    'Suite' => 'Suite',
                                    'Floor' => 'Floor',
                                    'Dose Not Apply' => 'Dose Not Apply'
                                ], @$step->detail['us_apartment_suite_or_floor'], [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('us_apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number') }}
                                <span class="required">*</span>
                                {{ Form::text('us_apartment_suite_or_floor_no', @$step->detail['us_apartment_suite_or_floor_no'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Apartment, Suite or Floor Number'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('us_town_or_city', 'Town or City') }}
                                <span class="required">*</span>
                                {{ Form::text('us_town_or_city', @$step->detail['us_town_or_city'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Town or City'
                                ]) }}
                            </div>
                        </div>                   
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('us_state', "U.S. State") }}
                                <span class="required">*</span>
                                {{ Form::select('us_state', [], @$step->detail['us_state'], [
                                    'class' => 'form-control states'
                                ]) }}                        
                            </div>
                        </div>                   
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('us_zip_code', 'Zip Code') }}
                                <span class="required">*</span>
                                {{ Form::text('us_zip_code', @$step->detail['us_zip_code'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Postal Code'
                                ]) }}
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'address') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'civil-status') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'visa-info'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'civil-status'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentAddressBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('change', '.diffrentAddress', function(){
            if ($(this).val() == 'yes') {
                $('.diffrentAddressSec').show();
            } else {
                $('.diffrentAddressSec').hide();
            }
        });

        $(document).ready(function(){
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

        $("#adjustmentAddress").validate({
            rules: {
                in_care_name: {
                    required: true,
                },
                number_and_street: {
                    required: true,
                },
                apartment_suite_or_floor: {
                    required: true,
                },
                apartment_suite_or_floor_no: {
                    required: true,
                },
                city: {
                    required: true,
                },
                state: {
                    required: true,
                },
                zip_code: {
                    required: true,
                },
                country: {
                    required: true,
                },
                date_from: {
                    required: true,
                },
                different_address: {
                    required: true,
                },
                us_in_care_name: {
                    required: true,
                },
                us_number_and_street: {
                    required: true,
                },
                us_apartment_suite_or_floor: {
                    required: true,
                },
                us_apartment_suite_or_floor_no: {
                    required: true,
                },
                us_town_or_city: {
                    required: true,
                },
                us_zip_code: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "different_address") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               in_care_name: "Please enter name!",                          
               number_and_street: "Please enter address!",                          
               apartment_suite_or_floor: "Please enter address!",                          
               apartment_suite_or_floor_no: "Please enter address!",                          
               city: "Please enter city!",                          
               state: "Please enter state!",                          
               zip_code: "Please enter state!",                          
               country: "Please enter country!",                          
               date_from: "Please enter date!",                          
               different_address: "Please choose option!",                          
               us_in_care_name: "Please enter name!",                          
               us_number_and_street: "Please enter address!",                          
               us_apartment_suite_or_floor: "Please enter address!",                          
               us_apartment_suite_or_floor_no: "Please enter address!",                          
               us_town_or_city: "Please enter city or town!",                          
               us_state: "Please enter state!",                          
               us_zip_code: "Please enter zip code!",                          
            },
            submitHandler: function(form) {
                $('#adjustmentAddressBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentAddress') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.address').removeClass('active');
                            $('.civil-status').addClass('active');
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