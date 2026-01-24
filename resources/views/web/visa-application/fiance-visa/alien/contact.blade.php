<!-- resources\views\web\visa-application\fiance-visa\alien\contact.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienContact'), 'id' => 'fianceAlienContact']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Alien's Contact Information</h2>
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
                    {{ Form::select('country_code', getCountryPhoneCode(), @$step->detail['country_code'], ['class' => 'form-control']) }}
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
                    {{ Form::select('mob_no_country', getCountryPhoneCode(), @$step->detail['mob_no_country'], ['class' => 'form-control']) }}
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
                    {{ Form::label('reg_no', 'Alien Registration Number or A#') }}
                    <span class="required">*</span>
                    {{ Form::text('reg_no', @$step->detail['regNo'] ? 'N/A' : @$step->detail['reg_no'], ['class' => 'form-control regNo', 'placeholder' => 'Enter Registration number']) }}
                    @include('web.component.does-not-apply', [
                        'field' => 'regNo',
                        'value' => @$step->detail['regNo'],
                    ])
                </div>
            </div>
            {{-- <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("tax_id", "United States Tax ID") }}
                        <span class="required">*</span>
                        {{ Form::text("tax_id", @$step->detail['taxId'] ? 'N/A' : @$step->detail['tax_id'], ['class' => 'form-control taxId', 'placeholder' => "Enter Id"]) }}
                        @include('web.component.does-not-apply', ['field' => 'taxId', 'value' => @$step->detail['taxId']])  
                    </div>
                </div> --}}
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('social_sec_no', 'U.S. Social Security Number') }}
                    <span class="required">*</span>
                    {{ Form::text('social_sec_no', @$step->detail['socialSecNo'] ? 'N/A' : @$step->detail['social_sec_no'], ['class' => 'form-control socialSecNo', 'placeholder' => 'Enter number']) }}
                    @include('web.component.does-not-apply', [
                        'field' => 'socialSecNo',
                        'value' => @$step->detail['socialSecNo'],
                    ])
                </div>
            </div>
            {{-- <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("uscis_no", "USCIS Online Account Number") }}
                        <span class="required">*</span>
                        {{ Form::text("uscis_no", @$step->detail['uscisNo'] ? 'N/A' : @$step->detail['uscis_no'], ['class' => 'form-control uscisNo', 'placeholder' => "Enter number"]) }}
                        @include('web.component.does-not-apply', ['field' => 'uscisNo', 'value' => @$step->detail['uscisNo']])      
                    </div>
                </div> --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label>Is your mailing address different from your physical address?</label>
                    <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0 ">
                            {{ Form::radio(
                                'diffrent_mailing_address',
                                'no',
                                @$step->detail['diffrent_mailing_address'] == 'no' ? true : '',
                                [
                                    'class' => 'custom-control-input diffrentMailingAddress',
                                ],
                            ) }}
                            <span class="custom-control-label"></span> No
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio(
                                'diffrent_mailing_address',
                                'yes',
                                @$step->detail['diffrent_mailing_address'] == 'yes' ? true : '',
                                [
                                    'class' => 'custom-control-input diffrentMailingAddress',
                                ],
                            ) }}
                            <span class="custom-control-label"></span> Yes
                        </label>
                        <div class="diffrent_mailing_address"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 diffrentMailingAddressSec"
                style="display: {{ @$step->detail['diffrent_mailing_address'] == 'yes' ? 'block' : 'none' }};">
                <h5>Enter mailing address only if it is different from the physical address. No foreign characters.</h5>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('in_care_name', 'In Care Of Name') }}
                            <span class="required">*</span>
                            {{ Form::text('in_care_name', @$step->detail['inCareName'] ? 'N/A' : @$step->detail['in_care_name'], [
                                'class' => 'form-control inCareName',
                                'placeholder' => 'Enter name',
                            ]) }}
                            @include('web.component.does-not-apply', [
                                'field' => 'inCareName',
                                'value' => @$step->detail['inCareName'],
                            ])
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number.  Example: 43 or 532-B.  Do not add "Apt" or "#". ') }}
                            <span class="required">*</span>
                            {{ Form::text('apartment_suite_or_floor_no', @$step->detail['apartment_suite_or_floor_no'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter address',
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

                            {{ Form::label("apartmentSuiteOrFloor", 'Does Not Apply') }}
                            {{ Form::checkbox("apartmentSuiteOrFloor", @$step->detail['apartmentSuiteOrFloor'], @$step->detail['apartmentSuiteOrFloor'] == true ? true : '', [
                                'class' => 'custom-control-input doesNotApplySelect',
                                'data-field' => "apartmentSuiteOrFloor",
                                'data-subfield' => "add_num_street"
                            ]) }}

                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('number_and_street', 'Number and street.  Example: 123 Main Street') }}
                            <span class="required">*</span>
                            {{ Form::text('number_and_street', @$step->detail['number_and_street'], [
                                'class' => 'form-control add_num_street',
                                'placeholder' => 'Enter address',
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('town_or_city', 'Town or City') }}
                            <span class="required">*</span>
                            {{ Form::text('town_or_city', @$step->detail['town_or_city'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Town or City',
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('country', 'Country') }}
                            <span class="required">*</span>
                            {{ Form::select('country', getAllCountry(), @$step->detail['country'], [
                                'class' => 'form-control countryId',
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('state', 'U.S. State') }}
                            <span class="required">*</span>
                            {{ Form::select('state', [], @$step->detail['state'], [
                                'class' => 'form-control contactState',
                                'data-state' => @$step->detail['contactState'] ? 'N/A' : @$step->detail['state'],
                                'disabled' => @$step->detail['contactState'] ? true : false
                            ]) }}
                            @include('web.component.does-not-apply', ['field' => 'contactState', 'value' => @$step->detail['contactState']])
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('province', 'Province') }}
                            <span class="required">*</span>
                            {{ Form::text('province', @$step->detail['provinceApply'] ? 'N/A' : @$step->detail['province'], [
                                'class' => 'form-control provinceApply',
                                'placeholder' => 'Enter Province',
                            ]) }}
                            @include('web.component.does-not-apply', [
                                'field' => 'provinceApply',
                                'value' => @$step->detail['provinceApply'],
                            ])
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('postal_code', 'Postal Code') }}
                            <span class="required">*</span>
                            {{ Form::text('postal_code', @$step->detail['postalCode'] ? 'N/A' : @$step->detail['postal_code'], [
                                'class' => 'form-control postalCode',
                                'placeholder' => 'Enter Postal Code',
                            ]) }}
                            @include('web.component.does-not-apply', [
                                'field' => 'postalCode',
                                'value' => @$step->detail['postalCode'],
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'contact') !!}
    {!! Form::hidden('next', 'marital-status') !!}
    {!! Form::hidden('type', 'alien') !!}
    {{ Form::button('Back To Start', [
        'class' => 'btn btn-tra-grey previousOrContinue',
        'data-form' => 'name',
    ]) }}
    {{ Form::button('Previous Step', [
        'class' => 'btn btn-tra-grey previousOrContinue',
        'data-form' => 'embassy',
    ]) }}
    {{ Form::button('Skip & Continue', [
        'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
        'data-form' => 'marital-status',
    ]) }}
    {{ Form::button('Save & Continue', [
        'class' => 'btn btn-tra-primary ms-2',
        'id' => 'fianceAlienContactBtn',
        'type' => 'submit',
    ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $(document).on('change', '.diffrentMailingAddress', function() {
            if ($(this).val() == 'yes') {
                $('.diffrentMailingAddressSec').show();
            } else {
                $('.diffrentMailingAddressSec').hide();
            }
        });

        $(document).ready(function() {
            var state = $('.contactState').data('state');
            getState(231, state);
        });

        $(document).on('change', '.countryId', function() {            
            getState(231);
        });

        function getState(countryId, state='') {
            $.ajax({
                type: 'get',
                url: "{{ route('getState') }}",
                data: {
                    countryId: countryId,
                    state: state
                },
                success: function(data) {
                    $('.contactState').html(data);
                }
            });
        }

        $("#fianceAlienContact").validate({
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
                    maxlength: 10
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
            errorPlacement: function(error, element) {
                if (element.attr("name") == "diffrent_mailing_address") {
                    error.appendTo($("." + element.attr("name")));
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
                apartment_suite_or_floor_no: {
                    required: "Please enter address!",
                    maxlength: "Max length should be at least 10!"
                },
                town_or_city: "Please enter city or town!",
                country: "Please enter country!",
                state: "Please enter state!",
                province: "Please enter province!",
                postal_code: "Please enter postal code!",
            },
            submitHandler: function(form) {
                $('#fianceAlienContactBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienContact') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activecontact').removeClass('active');
                            $('.activemarital-status').addClass('active');
                            $('.fianceVisaForm').html(data.data);
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
