<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienMaritalStatus'), 'id' => 'fianceAlienMaritalStatus']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Alien's Marital Status</h2>
                    </div>
                    <p class="peragraph text-danger" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants if they are still currently married. The USCIS requires both the U.S citizen sponsor and your fiancé(e) legally free and able to marry in the United States and any previous marriages have been legally terminated by divorce, death, or annulment. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('marital_status', 'married', @$step->detail['marital_status'] == 'married' ? true : '', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> Married
                            </label>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="radiogroup">                            
                            <label class="custom-control custom-radio mb-0">
                                {{ Form::radio('marital_status', 'single', @$step->detail['marital_status'] == 'single' ? true : '', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> Single (never married)
                            </label>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="radiogroup">                                                        
                            <label class="custom-control custom-radio mb-0">
                                {{ Form::radio('marital_status', 'widowed', @$step->detail['marital_status'] == 'widowed' ? true : '', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> Widowed
                            </label>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="radiogroup">                                                        
                            <label class="custom-control custom-radio mb-0">
                                {{ Form::radio('marital_status', 'divorced', @$step->detail['marital_status'] == 'divorced' ? true : '', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> Divorced
                            </label>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="radiogroup">                           
                            <label class="custom-control custom-radio mb-0">
                                {{ Form::radio('marital_status', 'annulled', @$step->detail['marital_status'] == 'annulled' ? true : '', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> Annulled
                            </label>
                        </div>
                    </div>
                </div>
                <div class="marital_status"></div>
                @php
                    $priorSpouse = '';
                    if (empty($step->detail['marital_status'])) {
                        $priorSpouse = 'none';
                    } elseif (@$step->detail['marital_status'] == 'widowed' || @$step->detail['marital_status'] == 'divorced' || @$step->detail['marital_status'] == 'annulled') {
                        $priorSpouse = 'block';
                    } else {
                        $priorSpouse = 'none';
                    }

                @endphp
                <div class="priorSpouseSec" style="display: {{ $priorSpouse }};">
                    <h5>Enter Prior Spouse Information. Abbreviate if necessary.</h5>
                    <p>You must provide a divorce certificate, annulment document or death certificate for all prior marriages no matter how far back.</p>
                    <div class="appendPriorSpouse">
                        {{-- @if (empty($step->detail["maiden_lname1"]))
                            @include('web.component.prior-spouse', [
                                'index' => 1,
                                'data' => @$step->detail,
                            ])
                        @endif --}}
                        @php
                            $i = '';
                        @endphp
                        @for ($i == 1; $i <= 5; $i++)
                            @if (isset($step->detail["maiden_lname$i"]))
                                @include('web.component.prior-spouse', [
                                    'index' => $i,
                                    'data' => @$step->detail,
                                ])                      
                            @endif
                        @endfor
                    </div>                                   
                    <div class="col-md-6 mb-4">
                        <a class="btn btn-tra-grey addPriorSpouse">+ Add prior spouse</a>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'marital-status') !!}
        {!! Form::hidden('next', 'parents') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'contact'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'parents'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienMaritalStatusBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">        
        $(document).ready(function(){
            var appendPriorSpouse = $('.appendPriorSpouse > .priorSpouseForm').length;
            if (appendPriorSpouse == 5) {
                $('.addPriorSpouse').addClass('d-none');
            }            
        });

        $("#fianceAlienMaritalStatus").validate({
            rules: {
                marital_status: {
                    required: true,
                },
                maiden_lname1: {
                    required: true,
                },
                middle_name1: {
                    required: true,
                },
                first_name1: {
                    required: true,
                },
                dob1: {
                    required: true,
                },
                birth_city1: {
                    required: true,
                },
                birth_province1: {
                    required: true,
                },
                birth_country1: {
                    required: true,
                },
                citizenship_country1: {
                    required: true,
                },
                date_of_marriage1: {
                    required: true,
                },
                place_of_marriage1: {
                    required: true,
                },
                date_marriage_ended1: {
                    required: true,
                },
                place_marriage_ended1: {
                    required: true,
                },
                how_marriage_ended1: {
                    required: true,
                },
                maiden_lname2: {
                    required: true,
                },
                middle_name2: {
                    required: true,
                },
                first_name2: {
                    required: true,
                },
                dob2: {
                    required: true,
                },
                birth_city2: {
                    required: true,
                },
                birth_province2: {
                    required: true,
                },
                birth_country2: {
                    required: true,
                },
                citizenship_country2: {
                    required: true,
                },
                date_of_marriage2: {
                    required: true,
                },
                place_of_marriage2: {
                    required: true,
                },
                date_marriage_ended2: {
                    required: true,
                },
                place_marriage_ended2: {
                    required: true,
                },
                how_marriage_ended2: {
                    required: true,
                },
                maiden_lname3: {
                    required: true,
                },
                middle_name3: {
                    required: true,
                },
                first_name3: {
                    required: true,
                },
                dob3: {
                    required: true,
                },
                birth_city3: {
                    required: true,
                },
                birth_province3: {
                    required: true,
                },
                birth_country3: {
                    required: true,
                },
                citizenship_country3: {
                    required: true,
                },
                date_of_marriage3: {
                    required: true,
                },
                place_of_marriage3: {
                    required: true,
                },
                date_marriage_ended3: {
                    required: true,
                },
                place_marriage_ended3: {
                    required: true,
                },
                how_marriage_ended3: {
                    required: true,
                },
                maiden_lname4: {
                    required: true,
                },
                middle_name4: {
                    required: true,
                },
                first_name4: {
                    required: true,
                },
                dob4: {
                    required: true,
                },
                birth_city4: {
                    required: true,
                },
                birth_province4: {
                    required: true,
                },
                birth_country4: {
                    required: true,
                },
                citizenship_country4: {
                    required: true,
                },
                date_of_marriage4: {
                    required: true,
                },
                place_of_marriage4: {
                    required: true,
                },
                date_marriage_ended4: {
                    required: true,
                },
                place_marriage_ended4: {
                    required: true,
                },
                how_marriage_ended4: {
                    required: true,
                },
                maiden_lname5: {
                    required: true,
                },
                middle_name5: {
                    required: true,
                },
                first_name5: {
                    required: true,
                },
                dob5: {
                    required: true,
                },
                birth_city5: {
                    required: true,
                },
                birth_province5: {
                    required: true,
                },
                birth_country5: {
                    required: true,
                },
                citizenship_country5: {
                    required: true,
                },
                date_of_marriage5: {
                    required: true,
                },
                place_of_marriage5: {
                    required: true,
                },
                date_marriage_ended5: {
                    required: true,
                },
                place_marriage_ended5: {
                    required: true,
                },
                how_marriage_ended5: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "marital_status") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }               
            },
            messages: {
               marital_status: "Please choose option!",
               maiden_lname1: "Please enter name!",
               middle_name1: "Please enter name!",
               first_name1: "Please enter name!",
               dob1: "Please enter date of birth!",
               birth_city1: "Please enter date of birth!",
               birth_province1: "Please enter birth province!",
               birth_country1: "Please enter birth country!",
               citizenship_country1: "Please enter country!",
               date_of_marriage1: "Please enter date of marriage!",
               place_of_marriage1: "Please enter place of marriage!",
               date_marriage_ended1: "Please enter date!",
               place_marriage_ended1: "Please enter date!",
               how_marriage_ended1: "Please choose resone!",
               maiden_lname2: "Please enter name!",
               middle_name2: "Please enter name!",
               first_name2: "Please enter name!",
               dob2: "Please enter date of birth!",
               birth_city2: "Please enter date of birth!",
               birth_province2: "Please enter birth province!",
               birth_country2: "Please enter birth country!",
               citizenship_country2: "Please enter country!",
               date_of_marriage2: "Please enter date of marriage!",
               place_of_marriage2: "Please enter place of marriage!",
               date_marriage_ended2: "Please enter date!",
               place_marriage_ended2: "Please enter date!",
               how_marriage_ended2: "Please choose resone!",
               maiden_lname3: "Please enter name!",
               middle_name3: "Please enter name!",
               first_name3: "Please enter name!",
               dob3: "Please enter date of birth!",
               birth_city3: "Please enter date of birth!",
               birth_province3: "Please enter birth province!",
               birth_country3: "Please enter birth country!",
               citizenship_country3: "Please enter country!",
               date_of_marriage3: "Please enter date of marriage!",
               place_of_marriage3: "Please enter place of marriage!",
               date_marriage_ended3: "Please enter date!",
               place_marriage_ended3: "Please enter date!",
               how_marriage_ended3: "Please choose resone!",
               maiden_lname4: "Please enter name!",
               middle_name4: "Please enter name!",
               first_name4: "Please enter name!",
               dob4: "Please enter date of birth!",
               birth_city4: "Please enter date of birth!",
               birth_province4: "Please enter birth province!",
               birth_country4: "Please enter birth country!",
               citizenship_country4: "Please enter country!",
               date_of_marriage4: "Please enter date of marriage!",
               place_of_marriage4: "Please enter place of marriage!",
               date_marriage_ended4: "Please enter date!",
               place_marriage_ended4: "Please enter date!",
               how_marriage_ended4: "Please choose resone!",
               maiden_lname5: "Please enter name!",
               middle_name5: "Please enter name!",
               first_name5: "Please enter name!",
               dob5: "Please enter date of birth!",
               birth_city5: "Please enter date of birth!",
               birth_province5: "Please enter birth province!",
               birth_country5: "Please enter birth country!",
               citizenship_country5: "Please enter country!",
               date_of_marriage5: "Please enter date of marriage!",
               place_of_marriage5: "Please enter place of marriage!",
               date_marriage_ended5: "Please enter date!",
               place_marriage_ended5: "Please enter date!",
               how_marriage_ended5: "Please choose resone!",
            },
            submitHandler: function(form) {
                $('#fianceAlienMaritalStatusBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienMaritalStatus') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activemarital-status').removeClass('active');
                            $('.activeparents').addClass('active');
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

        function priorSpouseHtml(index) {
            datePicker();
            var removeBtn = '';
            if (index != 1) {
                removeBtn = '<div class="col-md-6 mb-4"> <a class="btn btn-tra-grey removePriorSpouse">- Remove #'+index+' prior spouse</a> </div>';
            }
            return '<div class="priorSpouseForm"> '+removeBtn+' <h5>Prior Spouse #'+index+'</h5> <div class="row"> <div class="col-md-4"> <div class="form-group"> <label for="maiden_lname'+index+'">Maiden Last Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="maiden_lname'+index+'" type="text" value="" id="maiden_lname'+index+'"> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="middle_name'+index+'">Middle Name</label> <span class="required">*</span> <input class="form-control middleMame'+index+'" placeholder="Enter name" name="middle_name'+index+'" type="text" value="" id="middle_name'+index+'"><label for="middleMame'+index+'">Does Not Apply</label><input class="custom-control-input doesNotApply" data-field="middleMame'+index+'" type="checkbox"></div> </div> <div class="col-md-4"> <div class="form-group"> <label for="first_name'+index+'">First Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="first_name'+index+'" type="text" value="" id="first_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="dob'+index+'">Date of Birth (mm/dd/yyyy, okay to estimate or enter Unknown)</label> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="Enter Date of Birth" name="dob'+index+'" type="text" value="" id="dob'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="birthCity'+index+'">Birth City</label> <span class="required">*</span> <input class="form-control birthCity'+index+'" placeholder="Enter City of Birth" name="birth_city'+index+'" type="text" value="" id="birth_city'+index+'" aria-invalid="false"><label for="birthCity'+index+'">Does Not Apply</label><input class="custom-control-input doesNotApply" data-field="birthCity'+index+'" type="checkbox"></div> </div> <div class="col-md-6"> <div class="form-group"> <label for="birth_province'+index+'">Birth Province</label> <span class="required">*</span> <input class="form-control birthProvince'+index+'" placeholder="Enter Birth Province" name="birth_province'+index+'" type="text" value="" id="birth_province'+index+'"><label for="birthProvince'+index+'">Does Not Apply</label><input class="custom-control-input doesNotApply" data-field="birthProvince'+index+'" type="checkbox"></div> </div> <div class="col-md-6"> <div class="form-group"> <label for="birth_country'+index+'">Country of Birth </label> <span class="required">*</span> <select class="form-control" id="birth_country'+index+'" name="birth_country'+index+'"> <option value="">-Select Country-</option> @foreach(getCountry() as $country)</option> <option value="{{ $country->id }}">{{ $country->name }}</option> @endforeach </select> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="citizenship_country'+index+'">Country of Citizenship (Nationality)</label> <span class="required">*</span> <select class="form-control" id="citizenship_country'+index+'" name="citizenship_country'+index+'"> <option value="">-Select Country-</option> @foreach(getCountry() as $country)</option> <option value="{{ $country->id }}">{{ $country->name }}</option> @endforeach </select> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="date_of_marriage'+index+'">Date of Marriage</label> <span class="required">*</span> <input class="form-control datePicker" placeholder="Enter Date Of Marriage" name="date_of_marriage'+index+'" type="text" value="" id="date_of_marriage'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="place_of_marriage'+index+'">Place of Marriage</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Place of Marriage" name="place_of_marriage'+index+'" type="text" value="" id="place_of_marriage'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="date_marriage_ended'+index+'">Date Marriage Ended</label> <span class="required">*</span> <input class="form-control datePicker" placeholder="Enter Date Marriage Ended" name="date_marriage_ended'+index+'" type="text" value="" id="date_marriage_ended'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="place_marriage_ended'+index+'">Place Marriage Ended </label> <span class="required">*</span> <input class="form-control" placeholder="Enter Place Marriage Ended" name="place_marriage_ended'+index+'" type="text" value="" id="place_marriage_ended'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="how_marriage_ended'+index+'">How Marriage Ended (Legal documentation required)</label> <span class="required">*</span> <select class="form-control" id="how_marriage_ended'+index+'" name="how_marriage_ended'+index+'"> <option value="">Select</option> <option value="Annulment">Annulment</option> <option value="Death">Death</option> <option value="Divorce">Divorce</option> </select> </div> </div> </div> </div>'; 
        }      
    </script>
</div>