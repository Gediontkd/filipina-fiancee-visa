<div class="step-wizard">
    <style>
        .nationalIdentiNoText {
            display: none;
        }        
    </style>
    {{ Form::open(['url' => route('fianceAlienCitizenship'), 'id' => 'fianceAlienCitizenship']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Alien's Citizenship and Birth Information</h2>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            @php
                $countries = getAllCountry();
                $philippines = $countries[173];
                unset($countries[173]);
                $countries = array_reverse($countries, true);
                $countries[173] = $philippines;
                $countries = array_reverse($countries, true);
            @endphp
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('dob', 'Date of Birth (mm/dd/yyyy)') }}
                    <span class="required">*</span>
                    {{ Form::text('dob', @$step->detail['dob'], ['class' => 'form-control dateOfBirth', 'placeholder' => 'Enter Date Of Birth']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('city_of_birth', 'City of Birth') }}
                    <span class="required">*</span>
                    {{ Form::text('city_of_birth', @$step->detail['city_of_birth'], ['class' => 'form-control', 'placeholder' => 'Enter City Of Birth']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('province_of_birth', 'Province of Birth') }}
                    <span class="required">*</span>
                    {{ Form::text('province_of_birth', @$step->detail['provinceOfBirth'] ? 'N/A' : @$step->detail['province_of_birth'], ['class' => 'form-control provinceOfBirth', 'placeholder' => 'Enter Province of Birth']) }}
                    @include('web.component.does-not-apply', [
                        'field' => 'provinceOfBirth',
                        'value' => @$step->detail['provinceOfBirth'],
                    ])
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('country_of_birth', 'Country of Birth ') }}
                    <span class="required">*</span>
                    {{ Form::select('country_of_birth', $countries, @$step->detail['country_of_birth'], ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('national_identi_no', 'Alien Registration No or A#') }}
                    {{-- <span class="required">*</span> --}}
                    <span class="nationalIdentiNo"><i class="fa fa-question-circle"></i></span>
                    {{ Form::text('national_identi_no', @$step->detail['NatIdenNo'] ? 'N/A' : @$step->detail['national_identi_no'], ['class' => 'form-control NatIdenNo', 'placeholder' => 'Enter number' ,@$step->detail['NatIdenNo'] ? 'readonly' : '']) }}
                    @include('web.component.does-not-apply', [
                        'field' => 'NatIdenNo',
                        'value' => @$step->detail['NatIdenNo'],
                    ])                    
                </div>
            </div>
            <div class=" col-md-12 alert alert-success nationalIdentiNoText" role="alert">If you have a Alien Registration No you will know it. If
                you don't know what this is then you don't have one and should check Does Not Apply</div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('country_of_citizenship', 'Country of Citizenship (country that authorized passport)') }}
                    <span class="required">*</span>
                    {{ Form::select('country_of_citizenship', $countries, @$step->detail['country_of_citizenship'], ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="heading mb-30">
                <h2>Passport Information</h2>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('passport_number', 'Passport Number') }}
                    <span class="required">*</span>
                    {{ Form::text('passport_number', @$step->detail['passport_number'], ['class' => 'form-control', 'placeholder' => 'Enter Passport Number']) }}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('passport_book_number', 'Passport Book Number') }}
                    {{-- <span class="required">*</span> --}}
                    <span class="passportBookNumber"><i class="fa fa-question-circle"></i></span>
                    {{ Form::text('passport_book_number', @$step->detail['passportBookNo'] ? 'N/A' : @$step->detail['passport_book_number'], ['class' => 'form-control passportBookNo', 'placeholder' => 'Enter Passport Book Number']) }}
                    @include('web.component.does-not-apply', [
                        'field' => 'passportBookNo',
                        'value' => @$step->detail['passportBookNo'],
                    ])
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('city_passport_issue', 'City where Passport Issued') }}
                    <span class="required">*</span>
                    {{ Form::text('city_passport_issue', @$step->detail['cityPassportIssue'] ? 'N/A' : @$step->detail['city_passport_issue'], ['class' => 'form-control cityPassportIssue', 'placeholder' => 'Enter City where Passport Issued']) }}
                    @include('web.component.does-not-apply', [
                        'field' => 'cityPassportIssue',
                        'value' => @$step->detail['cityPassportIssue'],
                    ])
                </div>
            </div>
            <div class=" col-md-12 pb-4 alert-success passportBookNumberText" style="display: none;">The Passport Book Number is commonly called the inventory control number. You may or may not have a
                Passport Book Number on your passport. The location of the Passport Book Number on your passport
                may vary depending on the country that issued your passport. If you are unsure if your passport contains
                a Passport Book Number, just check Does Not Apply.</div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('province_state_passport_issued', 'Province or State where Passport Issued') }}
                    <span class="required">*</span>
                    {{ Form::text('province_state_passport_issued', @$step->detail['provinceStatePassIssued'] ? 'N/A' : @$step->detail['province_state_passport_issued'], ['class' => 'form-control provinceStatePassIssued', 'placeholder' => 'Enter Province or State where Passport Issued']) }}
                    @include('web.component.does-not-apply', [
                        'field' => 'provinceStatePassIssued',
                        'value' => @$step->detail['provinceStatePassIssued'],
                    ])
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('country_passport_issue', 'Country where Passport Issued (or will be issued) ') }}
                    <span class="required">*</span>
                    {{ Form::select('country_passport_issue', getAllCountry(), @$step->detail['country_passport_issue'], ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('date_passport_issue', 'Date Passport Issued (mm/dd/yyyy)') }}
                    <span class="required">*</span>
                    {{ Form::text('date_passport_issue', @$step->detail['date_passport_issue'], ['class' => 'form-control datePicker', 'placeholder' => 'Enter Date']) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('date_passport_expire', 'Date Passport Expires (mm/dd/yyyy)') }}
                    <span class="required">*</span>
                    {{ Form::text('date_passport_expire', @$step->detail['date_passport_expire'], ['class' => 'form-control disablePastDate', 'placeholder' => 'Enter Date']) }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Do you hold or have you held any nationality other than the one indicated above on Country of
                        Citizenship? </label>
                    <span class="required">*</span>
                    <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0 ">
                            {{ Form::radio('nationality', 'no', @$step->detail['nationality'] == 'no' ? true : '', [
                                'class' => 'custom-control-input nationality',
                            ]) }}
                            <span class="custom-control-label"></span> No
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio('nationality', 'yes', @$step->detail['nationality'] == 'yes' ? true : '', [
                                'class' => 'custom-control-input nationality',
                            ]) }}
                            <span class="custom-control-label"></span> Yes
                        </label>
                    </div>
                    <div class="nationality"></div>
                </div>
            </div>
            <div class="col-md-12 nationalitySec"
                style="display: {{ @$step->detail['nationality'] == 'yes' ? 'block' : 'none' }};">
                <div class="form-group">
                    {{ Form::label('other_country_region', 'Other Country/Region of Origin (Nationality)') }}
                    <span class="required">*</span>
                    {{ Form::select('other_country_region', getAllCountry(), @$step->detail['other_country_region'], ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Are you a permanent resident of a country / region other than your country / region of origin
                        (nationality) indicated above?</label>
                    <span class="required">*</span>
                    <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0 ">
                            {{ Form::radio(
                                'permanent_resident_country',
                                'no',
                                @$step->detail['permanent_resident_country'] == 'no' ? true : '',
                                [
                                    'class' => 'custom-control-input permanentResidentCountry',
                                ],
                            ) }}
                            <span class="custom-control-label"></span> No
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio(
                                'permanent_resident_country',
                                'yes',
                                @$step->detail['permanent_resident_country'] == 'yes' ? true : '',
                                [
                                    'class' => 'custom-control-input permanentResidentCountry',
                                ],
                            ) }}
                            <span class="custom-control-label"></span> Yes
                        </label>
                    </div>
                    <div class="permanent_resident_country"></div>
                </div>
            </div>
            <div class="col-md-12 permanentResidentCountrySec"
                style="display: {{ @$step->detail['permanent_resident_country'] == 'yes' ? 'block' : 'none' }};">
                <div class="form-group">
                    {{ Form::label('other_permanent_resident', 'Other Permanent Resident') }}
                    <span class="required">*</span>
                    {{ Form::select('other_permanent_resident', getAllCountry(), @$step->detail['other_permanent_resident'], ['class' => 'form-control']) }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Have ever had a passport lost or stolen?</label>
                    <span class="required">*</span>
                    <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0 ">
                            {{ Form::radio('passport_lost_or_stolen', 'no', @$step->detail['passport_lost_or_stolen'] == 'no' ? true : '', [
                                'class' => 'custom-control-input passportLostOrStolen',
                            ]) }}
                            <span class="custom-control-label"></span> No
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio(
                                'passport_lost_or_stolen',
                                'yes',
                                @$step->detail['passport_lost_or_stolen'] == 'yes' ? true : '',
                                [
                                    'class' => 'custom-control-input passportLostOrStolen',
                                ],
                            ) }}
                            <span class="custom-control-label"></span> Yes
                        </label>
                    </div>
                    <div class="passport_lost_or_stolen"></div>
                </div>
            </div>
            <div class="passportLostOrStolenSec"
                style="display: {{ @$step->detail['passport_lost_or_stolen'] == 'yes' ? 'block' : 'none' }};">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('lost_passport_number', 'Lost Passport Number') }}
                            <span class="required">*</span>
                            {{ Form::text('lost_passport_number', @$step->detail['lost_passport_number'], ['class' => 'form-control lostPassNo', 'placeholder' => 'Enter Lost Passport Number']) }}
                            @include('web.component.does-not-apply', [
                                'field' => 'lostPassportNumber',
                                'value' => @$step->detail['lostPassportNumber'],
                            ])
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('losted_passport_country', 'Country that Issued the Lost Passport') }}
                            <span class="required">*</span>
                            {{ Form::select('losted_passport_country', getAllCountry(), @$step->detail['losted_passport_country'], ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('explain_loosing_passport', 'Explain the circumstances of loosing your passport') }}
                            <span class="required">*</span>
                            {{ Form::textarea('explain_loosing_passport', @$step->detail['explain_loosing_passport'], ['class' => 'form-control', 'rows' => 4]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'citizenship') !!}
    {!! Form::hidden('next', 'embassy') !!}
    {!! Form::hidden('type', 'alien') !!}
    {{ Form::button('Back To Start', [
        'class' => 'btn btn-tra-grey previousOrContinue',
        'data-form' => 'name',
    ]) }}
    {{ Form::button('Previous Step', [
        'class' => 'btn btn-tra-grey previousOrContinue',
        'data-form' => 'name',
    ]) }}
    {{ Form::button('Skip & Continue', [
        'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
        'data-form' => 'embassy',
    ]) }}
    {{ Form::button('Save & Continue', [
        'class' => 'btn btn-tra-primary ms-2',
        'id' => 'fianceAlienCitizenshipBtn',
        'type' => 'submit',
    ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{ asset('assets/js/date-range.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.nationalIdentiNo').hover(
                function() {
                    $('.nationalIdentiNoText').show();
                },
                function () {
                    $('.nationalIdentiNoText').hide();
                }
            );
            $('.passportBookNumber').hover(
                function() {
                    $('.passportBookNumberText').show();
                },
                function () {
                    $('.passportBookNumberText').hide();
                }
            );
        });
        // $('.nationalIdentiNo').hover(function(event) {
        //     $('.nationalIdentiNoText').show();
        // });

        $(document).on('change', '.nationality', function() {
            if ($(this).val() == 'yes') {
                $('.nationalitySec').show();
            } else {
                $('.nationalitySec').hide();
            }
        });
        $(document).on('change', '.permanentResidentCountry', function() {
            if ($(this).val() == 'yes') {
                $('.permanentResidentCountrySec').show();
            } else {
                $('.permanentResidentCountrySec').hide();
            }
        });
        $(document).on('change', '.passportLostOrStolen', function() {
            if ($(this).val() == 'yes') {
                $('.passportLostOrStolenSec').show();
            } else {
                $('.passportLostOrStolenSec').hide();
            }
        });

        $("#fianceAlienCitizenship").validate({
            rules: {
                dob: {
                    required: true,
                },
                city_of_birth: {
                    required: true,
                },
                country_of_birth: {
                    required: true,
                },
                province_of_birth: {
                    required: true,
                },
                national_identi_no: {
                    required: true,
                },
                country_of_citizenship: {
                    required: true,
                },
                passport_number: {
                    required: true,
                },
                passport_book_number: {
                    required: true,
                },
                city_passport_issue: {
                    required: true,
                },
                province_state_passport_issued: {
                    required: true,
                },
                country_passport_issue: {
                    required: true,
                },
                date_passport_issue: {
                    required: true,
                },
                date_passport_expire: {
                    required: true,
                },
                nationality: {
                    required: true,
                },
                other_country_region: {
                    required: true,
                },
                permanent_resident_country: {
                    required: true,
                },
                other_permanent_resident: {
                    required: true,
                },
                passport_lost_or_stolen: {
                    required: true,
                },
                lost_passport_number: {
                    required: true,
                },
                losted_passport_country: {
                    required: true,
                },
                explain_loosing_passport: {
                    required: true,
                },
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "nationality" || element.attr("name") ==
                    "permanent_resident_country" || element.attr("name") == "passport_lost_or_stolen") {
                    error.appendTo($("." + element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
                dob: "Please enter your dob!",
                city_of_birth: "Please choose city of birth!",
                country_of_birth: "Please choose country of birth!",
                province_of_birth: "Please enter province of birth!",
                national_identi_no: "Please enter number!",
                country_of_citizenship: "Please choose country!",
                passport_number: "Please enter passport number!",
                passport_book_number: "Please enter passport book number!",
                city_passport_issue: "Please enter city passport issue!",
                province_state_passport_issued: "Please enter state passport issue!",
                country_passport_issue: "Please enter country passport issue!",
                date_passport_issue: "Please enter date passport issue!",
                date_passport_expire: "Please enter date passport expire!",
                nationality: "Please choose option!",
                other_country_region: "Please choose country!",
                permanent_resident_country: "Please choose option!",
                other_permanent_resident: "Please choose country!",
                passport_lost_or_stolen: "Please choose option!",
                lost_passport_number: "Please passport number!",
                losted_passport_country: "Please choose country!",
                explain_loosing_passport: "Enter explain loosing passport!",
            },
            submitHandler: function(form) {
                $('#fianceAlienCitizenshipBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienCitizenship') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activecitizenship').removeClass('active');
                            $('.activeembassy').addClass('active');
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
