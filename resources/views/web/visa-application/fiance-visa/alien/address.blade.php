<!-- resources\views\web\visa-application\fiance-visa\alien\address.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienAddress'), 'id' => 'fianceAlienAddress']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Alien’s Current Physical Address</h2>
                        <p>Enter your physical address here. If your mailing address is different you will enter that on another page. Changing your address later, using a P.O. box or a non-USA address is complicated and may cause your petition to be delayed.</p>
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
                        {{ Form::select('apartment_suite_or_floor', apartmentSuiteOrFloor(@$step->detail['apartmentSuiteOrFloor']), @$step->detail['apartment_suite_or_floor'], [
                            'class' => 'form-control apartmentSuiteOrFloor'
                        ]) }}
                        @include('web.component.does-not-apply', ['field' => 'apartmentSuiteOrFloor', 'value' => @$step->detail['apartmentSuiteOrFloor']])
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number') }}
                        <span class="required">*</span>
                        {{ Form::text('apartment_suite_or_floor_no', @$step->detail['apartmentSuiteOrFloorNo'] ? 'N/A' : @$step->detail['apartment_suite_or_floor_no'], [
                            'class' => 'form-control apartmentSuiteOrFloorNo',
                            'placeholder' => 'Enter Apartment, Suite or Floor Number'
                        ]) }}
                        @include('web.component.does-not-apply', ['field' => 'apartmentSuiteOrFloorNo', 'value' => @$step->detail['apartmentSuiteOrFloorNo']])
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
                        {{ Form::select('state', getAllUsStates(@$step->detail['dontHasState']), @$step->detail['state'], [
                            'class' => 'form-control dontHasState',
                            'data-state' => @$step->detail['dontHasState'] ? 'N/A' : @$step->detail['state'],
                            'disabled' => @$step->detail['dontHasState'] ? true : false
                        ]) }}     
                        @include('web.component.does-not-apply', ['field' => 'dontHasState', 'value' => @$step->detail['dontHasState']])                  
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('province', 'Province') }}
                        <span class="required">*</span>
                        {{ Form::text('province', @$step->detail['provinceApply'] ? 'N/A' : @$step->detail['province'], [
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
                        {{ Form::text('postal_code', @$step->detail['postalCode'] ? 'N/A' : @$step->detail['postal_code'], [
                            'class' => 'form-control postalCode',
                            'placeholder' => 'Enter Postal Code'
                        ]) }}
                        @include('web.component.does-not-apply', ['field' => 'postalCode', 'value' => @$step->detail['postalCode']])
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('date_from', 'Date From (mm/dd/yyyy)') }}
                        <span class="required">*</span>
                        {{ Form::text('date_from', @$step->detail['date_from'], [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'Enter Date'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('date_to', 'Date To (mm/dd/yyyy)') }}
                        <span class="required">*</span>
                        {{ Form::text('date_to', @$step->detail['date_to'] ? @$step->detail['date_to'] : 'PRESENT', [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'PRESENT or Enter Date'
                        ]) }}
                        <small class="text-muted">Enter PRESENT if you still live at this address.</small>
                    </div>
                </div>

                {{-- Prior Physical Address (Address 2) --}}
                <div class="col-md-12 mt-3">
                    <h5>Prior Physical Address (Address 2)</h5>
                    <p>Do you have a prior physical address to report?</p>
                    <div class="form-group">
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0">
                                {{ Form::radio('has_prior_address', 'no', @$step->detail['has_prior_address'] == 'no' || !isset($step->detail['has_prior_address']) ? true : '', [
                                    'class' => 'custom-control-input alienHasPriorAddress'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0">
                                {{ Form::radio('has_prior_address', 'yes', @$step->detail['has_prior_address'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input alienHasPriorAddress'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 alienPriorAddressSec" style="display: {{ @$step->detail['has_prior_address'] == 'yes' ? 'block' : 'none' }};">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('p_number_and_street', 'Street Number and Name') }}
                                {{ Form::text('p_number_and_street', @$step->detail['p_number_and_street'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter number and street'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('p_apartment_suite_or_floor', 'Apartment, Suite or Floor?') }}
                                {{ Form::select('p_apartment_suite_or_floor', [
                                    '' => 'Select',
                                    'Apartment' => 'Apartment',
                                    'Suite' => 'Suite',
                                    'Floor' => 'Floor',
                                    'Does Not Apply' => 'Does Not Apply'
                                ], @$step->detail['p_apartment_suite_or_floor'], [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('p_apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number') }}
                                {{ Form::text('p_apartment_suite_or_floor_no', @$step->detail['p_apartment_suite_or_floor_no'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter number'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('p_town_or_city', 'City or Town') }}
                                {{ Form::text('p_town_or_city', @$step->detail['p_town_or_city'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter city or town'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('p_province', 'Province') }}
                                {{ Form::text('p_province', @$step->detail['p_province'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter province'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('p_postal_code', 'Postal Code') }}
                                {{ Form::text('p_postal_code', @$step->detail['p_postal_code'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter postal code'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('p_country', 'Country') }}
                                {{ Form::select('p_country', getAllCountry(), @$step->detail['p_country'], [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('p_date_from', 'Date From (mm/dd/yyyy)') }}
                                {{ Form::text('p_date_from', @$step->detail['p_date_from'], [
                                    'class' => 'form-control datePicker',
                                    'placeholder' => 'Enter date'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('p_date_to', 'Date To (mm/dd/yyyy)') }}
                                {{ Form::text('p_date_to', @$step->detail['p_date_to'], [
                                    'class' => 'form-control datePicker',
                                    'placeholder' => 'Enter date'
                                ]) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-3">
                    <div class="alert alert-info mb-0">
                        <strong>Native alphabet rule:</strong> complete this section exactly as it should appear on the package.
                        For Philippine cases, both fields below should be <strong>N/A</strong>.
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('native_alphabet_name', 'Beneficiary Name in Native Alphabet') }}
                        <span class="required">*</span>
                        {{ Form::text('native_alphabet_name', @$step->detail['native_alphabet_name'], [
                            'class' => 'form-control nativeAlphabetName',
                            'placeholder' => 'Enter native alphabet name or N/A'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('native_alphabet_address', 'Beneficiary Physical Address in Native Alphabet') }}
                        <span class="required">*</span>
                        {{ Form::textarea('native_alphabet_address', @$step->detail['native_alphabet_address'], [
                            'class' => 'form-control nativeAlphabetAddress',
                            'rows' => 3,
                            'placeholder' => 'Enter native alphabet address or N/A'
                        ]) }}
                    </div>
                </div>
            </div>            
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'address') !!}
        {!! Form::hidden('next', 'employment') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'visited-us'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'employment'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienAddressBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('change', '.alienHasPriorAddress', function(){
            if ($(this).val() == 'yes') {
                $('.alienPriorAddressSec').show();
            } else {
                $('.alienPriorAddressSec').hide();
            }
        });

        $(document).ready(function(){
            getState(231);
            applyNativeAlphabetRule($('.countryId').val());
        });

        $(document).on('change', '.countryId', function(){
            // var countryId = $(this).val();
            getState(231);
            applyNativeAlphabetRule($(this).val());
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

        function applyNativeAlphabetRule(country) {
            const isPhilippines = (country || '').toString().trim() === 'Philippines';
            const $nameField = $('.nativeAlphabetName');
            const $addressField = $('.nativeAlphabetAddress');

            if (isPhilippines) {
                $nameField.val('N/A').prop('readonly', true);
                $addressField.val('N/A').prop('readonly', true);
            } else {
                if (($nameField.val() || '').trim().toUpperCase() === 'N/A') {
                    $nameField.val('');
                }
                if (($addressField.val() || '').trim().toUpperCase() === 'N/A') {
                    $addressField.val('');
                }
                $nameField.prop('readonly', false);
                $addressField.prop('readonly', false);
            }
        }

        $("#fianceAlienAddress").validate({
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
                date_from: {
                    required: true,
                },
                date_to: {
                    required: true,
                },
                p_number_and_street: {
                    required: function() { return $('input[name=has_prior_address]:checked').val() == 'yes'; }
                },
                p_town_or_city: {
                    required: function() { return $('input[name=has_prior_address]:checked').val() == 'yes'; }
                },
                p_country: {
                    required: function() { return $('input[name=has_prior_address]:checked').val() == 'yes'; }
                },
                p_date_from: {
                    required: function() { return $('input[name=has_prior_address]:checked').val() == 'yes'; }
                },
                p_date_to: {
                    required: function() { return $('input[name=has_prior_address]:checked').val() == 'yes'; }
                },
                native_alphabet_name: {
                    required: true,
                },
                native_alphabet_address: {
                    required: true,
                },
            },
            messages: {
               in_care_name: "Please enter name!",
               number_and_street: "Please enter number and street!",
               apartment_suite_or_floor: "Please enter address!",
               apartment_suite_or_floor_no: "Please enter address!",
               town_or_city: "Please enter town or city!",
               country: "Please choose birth country!",
               state: "Please choose state!",
                province: "Please enter province!",
                date_from: "Please choose date!",
                date_to: "Please enter date or PRESENT!",
                p_number_and_street: "Please enter prior address street!",
                p_town_or_city: "Please enter prior address city!",
                p_country: "Please choose prior address country!",
                p_date_from: "Please enter prior address date from!",
                p_date_to: "Please enter prior address date to!",
                native_alphabet_name: "Please enter the beneficiary name in native alphabet or N/A.",
                native_alphabet_address: "Please enter the beneficiary address in native alphabet or N/A.",
            },
            submitHandler: function(form) {
                $('#fianceAlienAddressBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienAddress') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activeaddress').removeClass('active');
                            $('.activeemployment').addClass('active');
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
