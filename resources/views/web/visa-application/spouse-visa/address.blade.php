<!-- resources\views\web\visa-application\spouse-visa\address.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseAddress'), 'id' => 'spouseAddress']) }}
        <div class="form-card">
            <div class="row">                
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Your (sponsor's) Current Physical Address.</h2>
                        <p>Enter your physical address here. If your mailing address is different you will enter that on another page. Changing your address later, using a P.O. box or a non-USA address is complicated and may cause your petition to be delayed.</p>
                    </div>
                </div>
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
                        {{ Form::select('country', getAllCountry(), @$step->detail['country'], [
                            'class' => 'form-control countryId'
                        ]) }}                       
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('state', "U.S. State") }}
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
                        {{ Form::text('province', @$step->detail['province'], [
                            'class' => 'form-control province',
                            'placeholder' => 'Enter Province'
                        ]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "province"
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('postal_code', 'Postal Code') }}
                        <span class="required">*</span>
                        {{ Form::text('postal_code', @$step->detail['postal_code'], [
                            'class' => 'form-control postalCode',
                            'placeholder' => 'Enter Postal Code'
                        ]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "postalCode"
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('lived', 'I have lived at this address since (mm/dd/yyyy)') }}
                        <span class="required">*</span>
                        {{ Form::text('lived', @$step->detail['lived'], [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'Enter Date'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Provide all U.S. states and foreign countries in which you have resided since your 18th birthday</h4>
                    <div class="appendCountry">
                        @if (empty($step->detail["country1"]))
                            @include('web.component.country', [
                                'index' => 1,
                                'sec' => '',
                                'data' => @$step->detail,
                            ])
                        @endif                   
                        @php
                            $i = '';
                        @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if (isset($step->detail["country$i"]))
                                @include('web.component.country', [
                                    'index' => $i,
                                    'sec' => '',
                                    'data' => @$step->detail,
                                ])                            
                            @endif
                        @endfor
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-tra-grey addCountryBtn">+ Add Address</a>
                    </div>
                </div>         
            </div>            
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'address') !!}
        {!! Form::hidden('next', 'relationship') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'military-convictions'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'relationship'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseAddressBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">        
        $(document).ready(function(){
            var countryCount = $('.appendCountry > .countryForm').length;
            if (countryCount == 10) {
                $('.addCountryBtn').addClass('d-none');
            }
        });

        $(document).ready(function(){
            // getState($('.countryId').val());
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

        $("#spouseAddress").validate({
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
                lived: {
                    required: true,
                },
                country1: {
                    required: true,
                },
                country2: {
                    required: true,
                },
                country3: {
                    required: true,
                },
                country4: {
                    required: true,
                },
                country5: {
                    required: true,
                },
                country6: {
                    required: true,
                },
                country7: {
                    required: true,
                },
                country8: {
                    required: true,
                },
                country9: {
                    required: true,
                },
                country10: {
                    required: true,
                },
            },            
            messages: {
               in_care_name: "Please enter name!",                                        
               number_and_street: "Please enter address!",                                        
               apartment_suite_or_floor: "Please enter address!",                                        
               apartment_suite_or_floor_no: "Please enter address!",                                
               town_or_city: "Please enter town or city!",                                        
               country: "Please choose country!",                                        
               state: "Please choose state!",                                        
               province: "Please enter province!",                                        
               postal_code: "Please enter postal code!",                                        
               lived: "Please enter date!",                                        
               country1: "Please choose country!",                                        
               country2: "Please choose country!",                                        
               country3: "Please choose country!",                                        
               country4: "Please choose country!",                                        
               country5: "Please choose country!",                                        
               country6: "Please choose country!",                                        
               country7: "Please choose country!",                                        
               country8: "Please choose country!",                                        
               country9: "Please choose country!",                                        
               country10: "Please choose country!",                                        
            },
            submitHandler: function(form) {
                $('#spouseAddressBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('spouseAddress') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.address').removeClass('active');
                            $('.relationship').addClass('active');
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

        function addAnotherCountry(index) {
            return '<div class="countryForm"><div class="pb-4"><a class="btn btn-tra-grey removeCountry">- Remove</a></div><div class="form-group"><select class="form-control countryId" name="country'+index+'"><option value="">-Select Country-</option>@foreach(getCountry() as $country)</option><option value="{{ $country->id }}">{{ $country->name }}</option>@endforeach</select></div></div>';
        }        
    </script>
</div>