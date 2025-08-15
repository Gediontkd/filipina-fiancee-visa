<div class="step-wizard">
    {{ Form::open(['url' => route('fianceSponsorAddress'), 'id' => 'fianceSponsorAddress']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        {{-- <h2>Your (sponsor's) Current Physical Address.</h2> --}}
                        <h2>Sponsor's Current Physical Address</h2>
                        <p>Enter your physical address here. If your mailing address is different, you will enter that on another page.
                            Using a P.O. Box or a non-USA address as your physical address may cause your petition to be delayed.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('in_care_name', 'In Care Of Name') }}
                        <span class="required">*</span>
                        {{ Form::text('in_care_name', @$step->detail['inCareName'] ? 'N/A' : @$step->detail['in_care_name'], [
                            'class' => 'form-control inCareName',
                            'placeholder' => 'Enter Name'
                        ]) }}
                        @include('web.component.does-not-apply', ['field' => 'inCareName', 'value' => @$step->detail['inCareName']])
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('number_and_street', 'Number and street') }}
                        <span class="required">*</span>
                        {{ Form::text('number_and_street', @$step->detail['number_and_street'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter number and street'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
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
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number') }}
                        <span class="required">*</span>
                        {{ Form::text('apartment_suite_or_floor_no', @$step->detail['apartment_suite_or_floor_no'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Apartment, Suite or Floor Number'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('town_or_city', 'Town or City') }}
                        <span class="required">*</span>
                        {{ Form::text('town_or_city', @$step->detail['town_or_city'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Town or City'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('country', "Country") }}
                        <span class="required">*</span>
                        {{ Form::select('country', getCountryPhoneCode(), @$step->detail['country'], [
                            'class' => 'form-control countryId'
                        ]) }}                       
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('state', "U.S. State") }}
                        <span class="required">*</span>
                        {{ Form::select('state', [], @$step->detail['state'], [
                            'class' => 'form-control states',
                            'data-state' => @$step->detail['state']
                        ]) }}                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('province', 'Province') }}
                        <span class="required">*</span>
                        {{ Form::text('province', @$step->detail['provinceOption'] ? 'N/A' : @$step->detail['province'], [
                            'class' => 'form-control provinceOption',
                            'placeholder' => 'Enter Province'
                        ]) }}
                        @include('web.component.does-not-apply', ['field' => 'provinceOption', 'value' => @$step->detail['provinceOption']])
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('postal_code', 'Postal Code') }}
                        <span class="required">*</span>
                        {{ Form::text('postal_code', @$step->detail['postalCode'] ? 'N/A' : @$step->detail['postal_code'], [
                            'class' => 'form-control postalCode',
                            'placeholder' => 'Enter Postal Code'
                        ]) }}
                        @include('web.component.does-not-apply', ['field' => 'postalCode', 'value' => @$step->detail['postalCode']])
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('date_from', 'I have lived at this address since (mm/dd/yyyy)') }}
                        <span class="required">*</span>
                        {{ Form::text('date_from', @$step->detail['date_from'], [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'Enter Date'
                        ]) }}
                    </div>
                </div>
                @if (!empty(@$step->detail['country']) && @$step->detail['country'] != 'United States (+1)')
                <div class="col-md-12 hideIfCountryisUs">
                    <div class="form-group">
                        <label>You have indicated your current address is not in the United States. Do you know what your physical address will be when you return to the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('current_address', 'no', @$step->detail['current_address'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input currentAddress'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('current_address', 'yes', @$step->detail['current_address'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input currentAddress'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                            <div class="current_address"></div>
                        </div>
                    </div>
                </div>
                @endif                
                <div class="col-md-12 currentAddressSec" style="display: {{ @$step->detail['current_address'] == 'yes' ? 'block' : 'none' }};">
                    <h4>Sponsor Future Address</h4>
                    <p>Provide the physical address where you will live when you return to the United States. Physical address only, not a post office box or mailing address</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('s_number_and_street', 'Number and street') }}
                                <span class="required">*</span>
                                {{ Form::text('s_number_and_street', @$step->detail['s_number_and_street'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter number and street'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('s_apartment_suite_or_floor', 'Apartment, Suite or Floor?') }}
                                <span class="required">*</span>
                                {{ Form::select('s_apartment_suite_or_floor', [
                                    '' => 'Select', 
                                    'Apartment' => 'Apartment',
                                    'Suite' => 'Suite',
                                    'Floor' => 'Floor',
                                    'Dose Not Apply' => 'Dose Not Apply'
                                ], @$step->detail['s_apartment_suite_or_floor'], [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('s_apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number') }}
                                <span class="required">*</span>
                                {{ Form::text('s_apartment_suite_or_floor_no', @$step->detail['s_apartment_suite_or_floor_no'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Apartment, Suite or Floor Number'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('s_town_or_city', 'City') }}
                                <span class="required">*</span>
                                {{ Form::text('s_town_or_city', @$step->detail['s_town_or_city'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Town or City'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('s_state', "State") }}
                                <span class="required">*</span>
                                {{ Form::select('s_state', [], @$step->detail['s_state'], [
                                    'class' => 'form-control states'
                                ]) }}                        
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('s_postal_code', 'Zip Code') }}
                                <span class="required">*</span>
                                {{ Form::text('s_postal_code', @$step->detail['sPostalCode'] ? 'N/A' : @$step->detail['s_postal_code'], [
                                    'class' => 'form-control sPostalCode',
                                    'placeholder' => 'Enter Postal Code'
                                ]) }}
                                @include('web.component.does-not-apply', ['field' => 'sPostalCode', 'value' => @$step->detail['sPostalCode']])
                            </div>
                        </div>                        
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Provide all U.S. states and foreign countries in which you have resided since your 18th birthday</h4>
                    <div class="appendCountry">
                        @if (empty($step->detail["foreign_state1"]))
                            @include('web.component.states-and-foreign-countries', [
                                'index' => 1,
                                'sec' => '',
                                'data' => @$step->detail,
                            ])
                        @endif                   
                        @php
                            $i = '';
                        @endphp
                        @for ($i = 1; $i <= 10; $i++)
                            @if (isset($step->detail["foreign_state$i"]))
                                @include('web.component.states-and-foreign-countries', [
                                    'index' => $i,
                                    'sec' => '',
                                    'data' => @$step->detail,
                                ])                            
                            @endif
                        @endfor
                    </div>
                    <div class="mb-4">
                        <a class="btn btn-tra-grey addCountryBtn">+ Add Another Country Visited</a>
                    </div>
                </div>
            </div>            
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'address') !!}
        {!! Form::hidden('next', 'relationship') !!}
        {!! Form::hidden('type', 'sponsor') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'military-and-convictions'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 sponsorPreviousOrContinue',
            'data-form' => 'relationship'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceSponsorAddressBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('change', '.currentAddress', function(){
            if ($(this).val() == 'yes') {
                $('.currentAddressSec').show();
            } else {
                $('.currentAddressSec').hide();
            }
        });

        $(document).ready(function(){
            var state = $('#state').data('state');
            getState(231, state);
        });

        $(document).on('change', '.countryId', function(){
            var countryId = $(this).val();
            if (countryId == 'United States (+1)') {
                $('.hideIfCountryisUs').hide();
            } else {
                $('.hideIfCountryisUs').show();
            }
        });

        function getState(countryId, state='')
        {
            $.ajax({                
                type: 'get',
                url: "{{ route('getState') }}",
                data: {
                    countryId: countryId,
                    state: state,
                },
                success: function(data) {
                    $('.states').html(data);                    
                }
            });
        }

        $("#fianceSponsorAddress").validate({
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
                town_or_city: {
                    required: true,
                },                        
                state: {
                    required: true,
                },                
                postal_code: {
                    required: true,
                },
                date_from: {
                    required: true,
                },
                s_number_and_street: {
                    required: true,
                },
                s_apartment_suite_or_floor: {
                    required: true,
                },
                s_apartment_suite_or_floor_no: {
                    required: true,
                },
                s_town_or_city: {
                    required: true,
                },
                s_state: {
                    required: true,
                },
                s_postal_code: {
                    required: true,
                },
                country: {
                    required: true,
                },
                province: {
                    required: true,
                },
                foreign_state1: {
                    required: true,
                },
                foreign_country1: {
                    required: true,
                },
                foreign_state2: {
                    required: true,
                },
                foreign_country2: {
                    required: true,
                },
                foreign_state3: {
                    required: true,
                },
                foreign_country3: {
                    required: true,
                },
                foreign_state4: {
                    required: true,
                },
                foreign_country4: {
                    required: true,
                },
                foreign_state5: {
                    required: true,
                },
                foreign_country5: {
                    required: true,
                },
                foreign_state6: {
                    required: true,
                },
                foreign_country6: {
                    required: true,
                },
                foreign_state7: {
                    required: true,
                },
                foreign_country7: {
                    required: true,
                },
                foreign_state8: {
                    required: true,
                },
                foreign_country8: {
                    required: true,
                },
                foreign_state9: {
                    required: true,
                },
                foreign_country9: {
                    required: true,
                },
                foreign_state10: {
                    required: true,
                },
                foreign_country10: {
                    required: true,
                },       
            },
            messages: {
               in_care_name: "Please enter name!",
               number_and_street: "Please enter number and street!",
               apartment_suite_or_floor: "Please enter address!",
               apartment_suite_or_floor_no: "Please enter address!",
               town_or_city: "Please enter town or city!",
               state: "Please choose state!",
               date_from: "Please choose date!",              
               s_number_and_street: "Please enter address!",              
               s_apartment_suite_or_floor: "Please enter address!",              
               s_apartment_suite_or_floor_no: "Please enter address!",              
               s_town_or_city: "Please enter city!",              
               s_state: "Please choose state!",              
               s_postal_code: "Please enter zip code!",              
               country: "Please enter country!",              
               province: "Please enter province!",              
            },
            submitHandler: function(form) {
                $('#fianceSponsorAddressBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceSponsorAddress') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activeaddress').removeClass('active');
                            $('.activerelationship').addClass('active');
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

        function addAnotherCountry(index) {
            return `{!! addslashes(view('web.component.states-and-foreign-countries')->with(['index' => '${index}'])->render()) !!}`;
            // return '<div class="countryForm"><div class="pb-4"><a class="btn btn-tra-grey removeCountry">- Remove</a></div><div class="form-group"><select class="form-control countryId" name="country'+index+'"><option value="">-Select Country-</option>@foreach(getCountry() as $country)</option><option value="{{ $country->id }}">{{ $country->name }}</option>@endforeach</select></div></div>';
        }  
    </script>
</div>