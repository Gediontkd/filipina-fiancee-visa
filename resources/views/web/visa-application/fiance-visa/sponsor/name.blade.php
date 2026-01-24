<!-- resources\views\web\visa-application\fiance-visa\sponsor\name.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceSponsorName'), 'id' => 'fianceSponsorName']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Sponsor's Name And Gender</h2>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('first_name', "Sponsor's First Name") }}
                    <span class="required">*</span>
                    {{ Form::text('first_name', @$step->detail['first_name'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter First Name',
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('middle_name', "Sponsor's Middle Name") }}
                    <span class="required">*</span>
                    {{ Form::text('middle_name', @$step->detail['f_m_l_name'] == true ? 'N/A' : @$step->detail['middle_name'], [
                        'class' => 'form-control f_m_l_name',
                        'placeholder' => 'Enter Middle Name',
                    ]) }}
                    @include('web.component.does-not-apply', [
                        'field' => 'f_m_l_name',
                        'value' => @$step->detail['f_m_l_name'],
                    ])
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('last_name', "Sponsor's Last Name (family name) ") }}
                    <span class="required">*</span>
                    {{ Form::text('last_name', @$step->detail['last_name'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Last Name',
                    ]) }}
                    <span>If you have a suffix after your name such as Jr. or III, put that here after your last
                        name.</span>
                </div>
            </div>
            {{-- <div class="col-md-6">
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
                </div> --}}
            <div class="col-md-6">
                <div class="form-group">
                    <label>Sponsor's Gender</label>
                    <span class="required">*</span>
                    <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0 ">
                            {{ Form::radio('gender', 'male', @$step->detail['gender'] == 'male' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Male
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio('gender', 'female', @$step->detail['gender'] == 'female' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Female
                        </label>
                    </div>
                    <div class="gender"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Have you ever used another name including a maiden name but not including nicknames?</label>
                    <span class="required">*</span>
                    <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0 ">
                            {{ Form::radio('prior_name1', 'no', @$step->detail['prior_name1'] == 'no' ? true : '', [
                                'class' => 'custom-control-input priorName1',
                            ]) }}
                            <span class="custom-control-label"></span> No
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio('prior_name1', 'yes', @$step->detail['prior_name1'] == 'yes' ? true : '', [
                                'class' => 'custom-control-input priorName1',
                            ]) }}
                            <span class="custom-control-label"></span> Yes
                        </label>
                    </div>
                    <div class="prior_name1"></div>
                </div>
            </div>
            <div class="col-md-12 firstPriorNameSec"
                style="display: {{ @$step->detail['prior_name1'] == 'yes' ? 'block' : 'none' }}">
                <div class="row">
                    @include('web.component.prior-name', ['index' => 1])
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Do you have another prior name to add?</label>
                            <span class="required">*</span>
                            <div class="radiogroup">
                                <label class="custom-control custom-radio mb-0 ">
                                    {{ Form::radio('prior_name2', 'no', @$step->detail['prior_name2'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input priorName2',
                                    ]) }}
                                    <span class="custom-control-label"></span> No
                                </label>
                                <label class="custom-control custom-radio mb-0 ms-3">
                                    {{ Form::radio('prior_name2', 'yes', @$step->detail['prior_name2'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input priorName2',
                                    ]) }}
                                    <span class="custom-control-label"></span> Yes
                                </label>
                            </div>
                            <div class="prior_name2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 secondPriorNameSec"
                    style="display: {{ @$step->detail['prior_name2'] == 'yes' ? 'block' : 'none' }}">
                    <div class="row">
                        @include('web.component.prior-name', ['index' => 2])
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Do you have another prior name to add?</label>
                                <span class="required">*</span>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio('prior_name3', 'no', @$step->detail['prior_name3'] == 'no' ? true : '', [
                                            'class' => 'custom-control-input priorName3',
                                        ]) }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio('prior_name3', 'yes', @$step->detail['prior_name3'] == 'yes' ? true : '', [
                                            'class' => 'custom-control-input priorName3',
                                        ]) }}
                                        <span class="custom-control-label"></span> Yes
                                    </label>
                                </div>
                                <div class="prior_name3"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 thirdPriorNameSec"
                        style="display: {{ @$step->detail['prior_name3'] == 'yes' ? 'block' : 'none' }}">
                        <div class="row">
                            @include('web.component.prior-name', ['index' => 3])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'name') !!}
    {!! Form::hidden('next', 'contact') !!}
    {!! Form::hidden('type', 'sponsor') !!}
    {{ Form::button('Back To Start', [
        'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
        'data-form' => 'name',
    ]) }}
    {{ Form::button('Skip & Continue', [
        'class' => 'btn btn-tra-grey ms-2 sponsorPreviousOrContinue',
        'data-form' => 'contact',
    ]) }}
    {{ Form::button('Save & Continue', [
        'class' => 'btn btn-tra-primary ms-2',
        'id' => 'fianceSponsorNameBtn',
        'type' => 'submit',
    ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $(document).on('change', '.priorName1', function() {
            if ($(this).val() == 'yes') {
                $('.firstPriorNameSec').show();
            } else {
                if ($(this).val() == 'no') {
                    $('.firstPriorNameSec input[type="text"]').val('');
                    $('.firstPriorNameSec input[type="radio"]').prop('checked', false);
                }
                $('.firstPriorNameSec').hide();
            }
        });
        $(document).on('change', '.priorName2', function() {
            if ($(this).val() == 'yes') {
                $('.secondPriorNameSec').show();
            } else {
                if ($(this).val() == 'no') {
                    $('.secondPriorNameSec input[type="text"]').val('');
                    $('.secondPriorNameSec input[type="radio"]').prop('checked', false);
                }
                $('.secondPriorNameSec').hide();
            }
        });
        $(document).on('change', '.priorName3', function() {
            if ($(this).val() == 'yes') {
                $('.thirdPriorNameSec').show();
            } else {
                if ($(this).val() == 'no') {
                    $('.thirdPriorNameSec input[type="text"]').val('');
                    $('.thirdPriorNameSec input[type="radio"]').prop('checked', false);
                }
                $('.thirdPriorNameSec').hide();
            }
        });

        $("#fianceSponsorName").validate({
            rules: {
                first_name: {
                    required: true,
                },
                middle_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                phone_number_country: {
                    required: true,
                },
                daytime_phone_number: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                related_to_you: {
                    required: true,
                },
                how_related: {
                    required: true,
                },
                prior_name1: {
                    required: true,
                },
                maiden_name: {
                    required: true,
                },
                prior_fname1: {
                    required: true,
                },
                prior_mname1: {
                    required: true,
                },
                prior_lname1: {
                    required: true,
                },
                prior_maiden_name1: {
                    required: true,
                },
                prior_name2: {
                    required: true,
                },
                prior_fname2: {
                    required: true,
                },
                prior_mname2: {
                    required: true,
                },
                prior_lname2: {
                    required: true,
                },
                prior_maiden_name2: {
                    required: true,
                },
                prior_name3: {
                    required: true,
                },
                prior_fname3: {
                    required: true,
                },
                prior_mname3: {
                    required: true,
                },
                prior_lname3: {
                    required: true,
                },
                prior_maiden_name3: {
                    required: true,
                },
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "gender" || element.attr("name") == "related_to_you" || element
                    .attr("name") == "prior_name1" || element.attr("name") == "prior_maiden_name1" || element
                    .attr("name") == "prior_name2" || element.attr("name") == "prior_maiden_name2" || element
                    .attr("name") == "prior_name3" || element.attr("name") == "prior_maiden_name3") {
                    error.appendTo($("." + element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
                first_name: "Please enter your first name!",
                middle_name: "Please enter your middle name!",
                last_name: "Please enter your last name!",
                phone_number_country: "Please choose country!",
                daytime_phone_number: "Please enter phone number!",
                gender: "Please choose gender!",
                related_to_you: "Please choose option!",
                how_related: "Please enter relation!",
                prior_name1: "Please choose option!",
                maiden_name: "Please choose option!",
                prior_fname1: "Please enter name!",
                prior_mname1: "Please enter name!",
                prior_lname1: "Please enter name!",
                prior_maiden_name1: "Please choose option!",
                prior_name2: "Please choose option!",
                prior_fname2: "Please enter name!",
                prior_mname2: "Please enter name!",
                prior_lname2: "Please enter name!",
                prior_maiden_name2: "Please choose option!",
                prior_name3: "Please choose option!",
                prior_fname3: "Please enter name!",
                prior_mname3: "Please enter name!",
                prior_lname3: "Please enter name!",
                prior_maiden_name3: "Please choose option!",
            },
            submitHandler: function(form) {
                $('#fianceSponsorNameBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceSponsorName') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activename').removeClass('active');
                            $('.activecontact').addClass('active');
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
