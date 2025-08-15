<div class="step-wizard">
    {{ Form::open(['url' => route('fianceSponsorMaritalStatus'), 'id' => 'fianceSponsorMaritalStatus']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Sponsor's Marital Status</h2>
                    </div>
                    <p class="peragraph text-danger" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants if they are still currently married. The USCIS requires both the U.S citizen sponsor and your fiancé(e) legally free and able to marry in the United States and any previous marriages have been legally terminated by divorce, death, or annulment. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('marital_status', 'married', @$step->detail['marital_status'] == 'married' ? true : '', [
                                    'class' => 'custom-control-input maritalStatus'
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
                                    'class' => 'custom-control-input maritalStatus'
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
                                    'class' => 'custom-control-input maritalStatus'
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
                                    'class' => 'custom-control-input maritalStatus'
                                ]) }}
                                <span class="custom-control-label"></span> Divorced
                            </label>                            
                        </div>
                    </div>
                </div>                
                <div class="marital_status"></div>
                <div class="col-md-12 ms-3 everMarriedBefore" style="display: none;">
                    <div class="form-group">
                        <label>Were you ever married before your current marriage?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('ever_married_before', 'no', @$step->detail['ever_married_before'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('ever_married_before', 'yes', @$step->detail['ever_married_before'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                        </div>
                    </div>
                </div>
                <div class="priorSpouseSec" style="display: {{ @$step->detail['marital_status'] == 'widowed' || @$step->detail['marital_status'] == 'divorced' ? 'block' : 'none' }};">
                    <p>Enter all Prior Spouses, no matter how many or how far back. You must provide a divorce, annulment or death certificate for all prior spouses with no exceptions. Space is limited to match USCIS forms. Abbreviate as necessary.</p>
                    <div class="appendPriorSpouse">
                        @if (@$step->detail['ever_married_before'] == 'yes')                   
                            @for ($i = 1; $i <= 5; $i++)
                                @if (isset($step->detail["maiden_lname$i"]))
                                    @include('web.component.fiance-sponsor.prior-spouse', [
                                        'index' => $i,
                                        'data' => @$step->detail,
                                    ])                      
                                @endif
                            @endfor
                        @else
                            @include('web.component.fiance-sponsor.prior-spouse', [
                                'index' => 1,
                                'data' => @$step->detail,
                            ])     
                        @endif
                    </div>                                   
                    <div class="col-md-6 mb-4">
                        <a class="btn btn-tra-grey addPriorSpouse">+ Add prior spouse</a>
                    </div>
                </div>
                <div class="col-md-12 ms-3">
                    <div class="form-group">
                        <label>Do you have any children under 18 years of age?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('any_children', 'no', @$step->detail['any_children'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input children'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('any_children', 'yes', @$step->detail['any_children'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input children'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ms-3 childrenSec" style="display: {{ @$step->detail['any_children'] == 'yes' ? 'block' : 'none'  }};">
                    <div class="appendChildern">
                        <p>Provide the ages for your children under 18 years of age</p>
                        @if (@$step->detail['any_children'] == 'yes')
                            @for ($i = 1; $i <= 5; $i++)
                                @if (!empty($step->detail["first_name$i"]))                
                                    @include('web.component.fiance-sponsor.children', [
                                        'index' => $i,
                                        'data' => @$step->detail,
                                    ])
                                 @endif
                            @endfor
                        @else
                            @include('web.component.fiance-sponsor.children', [
                                'index' => 1,
                                'data' => @$step->detail,
                            ])
                        @endif
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-tra-grey addChildern">+ Add another child</a>
                    </div>            
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'marital-status') !!}
        {!! Form::hidden('next', 'other-filings') !!}
        {!! Form::hidden('type', 'sponsor') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'status'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 sponsorPreviousOrContinue',
            'data-form' => 'other-filings'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceSponsorMaritalStatusBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">        
        $(document).on('change', '.maritalStatus', function(){
            var status = $(this).val();
            if (status == 'married') {
                $('.everMarriedBefore').show();
            } else {
                $('.everMarriedBefore').hide();
            }
            if (status == 'widowed' || status == 'divorced') {
                $('.priorSpouseSec').show();
            } else {
                $('.priorSpouseSec').hide();
            }
        });

        $(document).on('change', '.children', function(){
            var status = $(this).val();
            if (status == 'yes') {
                $('.childrenSec').show();
            } else {
                $('.childrenSec').hide();
            }            
        });

        $(document).ready(function(){                        
            var appendPriorSpouse = $('.appendPriorSpouse > .priorSpouseForm').length;
            if (appendPriorSpouse == 5) {
                $('.addPriorSpouse').addClass('d-none');
            }            
        });

        $("#fianceSponsorMaritalStatus").validate({
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
                city_state_of_marriage1: {
                    required: true,
                },
                place_of_marriage1: {
                    required: true,
                },
                date_marriage_ended1: {
                    required: true,
                },
                where_marriage_ended1: {
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
                city_state_of_marriage2: {
                    required: true,
                },
                place_of_marriage2: {
                    required: true,
                },
                date_marriage_ended2: {
                    required: true,
                },
                where_marriage_ended2: {
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
                city_state_of_marriage3: {
                    required: true,
                },
                place_of_marriage3: {
                    required: true,
                },
                date_marriage_ended3: {
                    required: true,
                },
                where_marriage_ended3: {
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
                city_state_of_marriage4: {
                    required: true,
                },
                place_of_marriage4: {
                    required: true,
                },
                date_marriage_ended4: {
                    required: true,
                },
                where_marriage_ended4: {
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
                city_state_of_marriage5: {
                    required: true,
                },
                place_of_marriage5: {
                    required: true,
                },
                date_marriage_ended5: {
                    required: true,
                },
                where_marriage_ended5: {
                    required: true,
                },
                first_cname1: {
                    required: true,
                },
                middle_cname1: {
                    required: true,
                },
                first_cname1: {
                    required: true,
                },
                last_cname1: {
                    required: true,
                },
                relationship1: {
                    required: true,
                },
                c_dob1: {
                    required: true,
                },
                country_of_birth1: {
                    required: true,
                },
                first_cname2: {
                    required: true,
                },
                middle_cname2: {
                    required: true,
                },                
                last_cname2: {
                    required: true,
                },
                relationship2: {
                    required: true,
                },
                c_dob2: {
                    required: true,
                },
                country_of_birth2: {
                    required: true,
                },
                first_cname3: {
                    required: true,
                },
                middle_cname3: {
                    required: true,
                },               
                last_cname3: {
                    required: true,
                },
                relationship3: {
                    required: true,
                },
                c_dob3: {
                    required: true,
                },
                country_of_birth3: {
                    required: true,
                },
                first_cname4: {
                    required: true,
                },
                middle_cname4: {
                    required: true,
                },               
                last_cname4: {
                    required: true,
                },
                relationship4: {
                    required: true,
                },
                c_dob4: {
                    required: true,
                },
                country_of_birth4: {
                    required: true,
                },
                first_cname5: {
                    required: true,
                },
                middle_cname5: {
                    required: true,
                },               
                last_cname5: {
                    required: true,
                },
                relationship5: {
                    required: true,
                },
                c_dob5: {
                    required: true,
                },
                country_of_birth5: {
                    required: true,
                },
                first_cname6: {
                    required: true,
                },
                middle_cname6: {
                    required: true,
                },
                first_cname6: {
                    required: true,
                },
                last_cname6: {
                    required: true,
                },
                relationship6: {
                    required: true,
                },
                c_dob6: {
                    required: true,
                },
                country_of_birth6: {
                    required: true,
                },
                first_cname7: {
                    required: true,
                },
                middle_cname7: {
                    required: true,
                },
                first_cname7: {
                    required: true,
                },
                last_cname7: {
                    required: true,
                },
                relationship7: {
                    required: true,
                },
                c_dob7: {
                    required: true,
                },
                country_of_birth7: {
                    required: true,
                },
                first_cname8: {
                    required: true,
                },
                middle_cname8: {
                    required: true,
                },
                first_cname8: {
                    required: true,
                },
                last_cname8: {
                    required: true,
                },
                relationship8: {
                    required: true,
                },
                c_dob8: {
                    required: true,
                },
                country_of_birth8: {
                    required: true,
                },
                first_cname9: {
                    required: true,
                },
                middle_cname9: {
                    required: true,
                },
                first_cname9: {
                    required: true,
                },
                last_cname9: {
                    required: true,
                },
                relationship9: {
                    required: true,
                },
                c_dob9: {
                    required: true,
                },
                country_of_birth9: {
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
               city_state_of_marriage1: "Please enter city and state of marriage!",
               place_of_marriage1: "Please enter place of marriage!",
               date_marriage_ended1: "Please enter date!",
               where_marriage_ended1: "Please enter date!",        
               maiden_lname2: "Please enter name!",
               middle_name2: "Please enter name!",
               first_name2: "Please enter name!",
               dob2: "Please enter date of birth!",
               birth_city2: "Please enter date of birth!",
               birth_province2: "Please enter birth province!",
               birth_country2: "Please enter birth country!",
               citizenship_country2: "Please enter country!",
               date_of_marriage2: "Please enter date of marriage!",
               city_state_of_marriage2: "Please enter city and state of marriage!",
               place_of_marriage2: "Please enter place of marriage!",
               date_marriage_ended2: "Please enter date!",
               where_marriage_ended2: "Please enter date!",   
               maiden_lname3: "Please enter name!",
               middle_name3: "Please enter name!",
               first_name3: "Please enter name!",
               dob3: "Please enter date of birth!",
               birth_city3: "Please enter date of birth!",
               birth_province3: "Please enter birth province!",
               birth_country3: "Please enter birth country!",
               citizenship_country3: "Please enter country!",
               date_of_marriage3: "Please enter date of marriage!",
               city_state_of_marriage3: "Please enter city and state of marriage!",
               place_of_marriage3: "Please enter place of marriage!",
               date_marriage_ended3: "Please enter date!",
               where_marriage_ended3: "Please enter date!",  
               maiden_lname4: "Please enter name!",
               middle_name4: "Please enter name!",
               first_name4: "Please enter name!",
               dob4: "Please enter date of birth!",
               birth_city4: "Please enter date of birth!",
               birth_province4: "Please enter birth province!",
               birth_country4: "Please enter birth country!",
               citizenship_country4: "Please enter country!",
               date_of_marriage4: "Please enter date of marriage!",
               city_state_of_marriage4: "Please enter city and state of marriage!",
               place_of_marriage4: "Please enter place of marriage!",
               date_marriage_ended4: "Please enter date!",
               where_marriage_ended4: "Please enter date!",  
               maiden_lname5: "Please enter name!",
               middle_name5: "Please enter name!",
               first_name5: "Please enter name!",
               dob5: "Please enter date of birth!",
               birth_city5: "Please enter date of birth!",
               birth_province5: "Please enter birth province!",
               birth_country5: "Please enter birth country!",
               citizenship_country5: "Please enter country!",
               date_of_marriage5: "Please enter date of marriage!",
               city_state_of_marriage5: "Please enter city and state of marriage!",
               place_of_marriage5: "Please enter place of marriage!",
               date_marriage_ended5: "Please enter date!",
               where_marriage_ended5: "Please enter date!",               
               first_cname1: "Please enter name!",               
               middle_cname1: "Please enter name!",               
               last_cname1: "Please enter name!",               
               relationship1: "Please choose relationship!",               
               c_dob1: "Please enter date of birth!",               
               country_of_birth1: "Please enter country of birth!", 
               first_cname2: "Please enter name!",               
               middle_cname2: "Please enter name!",               
               last_cname2: "Please enter name!",               
               relationship2: "Please choose relationship!",               
               c_dob2: "Please enter date of birth!",               
               country_of_birth2: "Please enter country of birth!",         
               first_cname3: "Please enter name!",               
               middle_cname3: "Please enter name!",               
               last_cname3: "Please enter name!",               
               relationship3: "Please choose relationship!",               
               c_dob3: "Please enter date of birth!",               
               country_of_birth3: "Please enter country of birth!", 
               first_cname4: "Please enter name!",               
               middle_cname4: "Please enter name!",               
               last_cname4: "Please enter name!",               
               relationship4: "Please choose relationship!",               
               c_dob4: "Please enter date of birth!",               
               country_of_birth4: "Please enter country of birth!",     
               first_cname5: "Please enter name!",               
               middle_cname5: "Please enter name!",               
               last_cname5: "Please enter name!",               
               relationship5: "Please choose relationship!",               
               c_dob5: "Please enter date of birth!",               
               country_of_birth5: "Please enter country of birth!",    
               first_cname6: "Please enter name!",               
               middle_cname6: "Please enter name!",               
               last_cname6: "Please enter name!",               
               relationship6: "Please choose relationship!",               
               c_dob6: "Please enter date of birth!",               
               country_of_birth6: "Please enter country of birth!",     
               first_cname7: "Please enter name!",               
               middle_cname7: "Please enter name!",               
               last_cname7: "Please enter name!",               
               relationship7: "Please choose relationship!",               
               c_dob7: "Please enter date of birth!",               
               country_of_birth7: "Please enter country of birth!", 
               first_cname8: "Please enter name!",               
               middle_cname8: "Please enter name!",               
               last_cname8: "Please enter name!",               
               relationship8: "Please choose relationship!",               
               c_dob8: "Please enter date of birth!",               
               country_of_birth8: "Please enter country of birth!",   
               first_cname9: "Please enter name!",               
               middle_cname9: "Please enter name!",               
               last_cname9: "Please enter name!",               
               relationship9: "Please choose relationship!",               
               c_dob9: "Please enter date of birth!",               
               country_of_birth9: "Please enter country of birth!",               
            },
            submitHandler: function(form) {
                $('#fianceSponsorMaritalStatusBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceSponsorMaritalStatus') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activemarital-status').removeClass('active');
                            $('.activeother-filings').addClass('active');
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
        
        function priorSpouseHtml(index) {
            datePicker();
            // var removeBtn = '';
            // if (index != 1) {
            //     removeBtn = '<div class="col-md-6 mb-4"> <a class="btn btn-tra-grey removePriorSpouse">- Remove #'+index+' prior spouse</a> </div>';
            // }
            // return '<div class="priorSpouseForm">'+removeBtn+'<h5>Prior Spouse #'+index+'</h5> <div class="row"> <div class="col-md-4"> <div class="form-group"> <label for="maiden_lname'+index+'">Maiden Last Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="maiden_lname'+index+'" type="text" value="" id="maiden_lname'+index+'"> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="middle_name'+index+'">Middle Name</label> <span class="required">*</span> <input class="form-control middleMame'+index+'" placeholder="Enter name" name="middle_name'+index+'" type="text" value="" id="middle_name'+index+'"><label for="middleMame'+index+'">Does Not Apply</label><input class="custom-control-input doesNotApply" data-field="middleMame'+index+'" type="checkbox"></div> </div> <div class="col-md-4"> <div class="form-group"> <label for="first_name'+index+'">First Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="first_name'+index+'" type="text" value="" id="first_name'+index+'"> </div> </div> <div class="col-md-'+index+'2"> <div class="form-group"> <label for="dob'+index+'">Date of Birth (mm/dd/yyyy, okay to estimate or enter Unknown)</label> <span class="required">*</span> <input class="form-control dateOfBirth datepicker" placeholder="Enter Date of Birth" name="dob'+index+'" type="text" value="" id="dob'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="date_of_marriage'+index+'">Date of Marriage</label> <span class="required">*</span> <input class="form-control datePicker datepicker" placeholder="Enter Date Of Marriage" name="date_of_marriage'+index+'" type="text" value="" id="date_of_marriage'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="city_state_of_marriage'+index+'">City and State of Marriage (city and country if not USA)</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Place of Marriage" name="city_state_of_marriage'+index+'" type="text" value="" id="city_state_of_marriage'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="date_marriage_ended'+index+'">Date Marriage Ended (mm/dd/yyyy, must match divorce/annulment/death document)</label> <span class="required">*</span> <input class="form-control datePicker datepicker" placeholder="Enter Date Marriage Ended" name="date_marriage_ended'+index+'" type="text" value="" id="date_marriage_ended'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="where_marriage_ended'+index+'">City and State where marriage ended (city and country if not USA) </label> <span class="required">*</span> <input class="form-control" placeholder="Enter City and State where marriage ended" name="where_marriage_ended'+index+'" type="text" value="" id="where_marriage_ended'+index+'"> </div> </div> </div> </div>'; 
            return `{!! addslashes(view('web.component.fiance-sponsor.prior-spouse')->with(['index' => '${index}'])->render()) !!}`;
        }

        function addChildernHtml(index) {
            datePicker();
            // removeBtn = '';
            // if (index != 1) {
            //     removeBtn = '<a class="btn btn-tra-grey removeChildern">- Remove Child</a>';
            // }
            // return '<div class="row addChildernForm"> <div class="col-md-12">'+removeBtn+'</div> <h5>Child  '+index+'</h5> <div class="col-md-6"> <div class="form-group"> <label for="first_cname">First Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="first_cname'+index+'" type="text" id="first_cname"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="middle_cname">Middle Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="middle_cname'+index+'" type="text" id="middle_name"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="last_name">Last Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="last_cname'+index+'" type="text" id="last_name"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label>Relationship to the Beneficiary</label> <div class="radiogroup"> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input" name="relationship'+index+'" type="radio" value="step-son"> <span class="custom-control-label"></span> Step-Son </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input" name="relationship'+index+'" type="radio" value=" step-daughter"> <span class="custom-control-label"></span>  Step-Daughter </label> <div class="relationship"></div> </div> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="c_dob">Date of Birth (mm/dd/yyyy)</label> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="Enter Date" name="c_dob'+index+'" type="text" id="c_dob"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="country_of_birth">Country of Birth</label> <span class="required">*</span> <select class="form-control" id="country_of_birth" name="country_of_birth'+index+'">@foreach (getAllCountry() as $country) <option value="{{$country}}">{{$country}}</option> @endforeach</select> </div> </div> </div>'; }
            return `{!! addslashes(view('web.component.fiance-sponsor.children')->with(['index' => '${index}'])->render()) !!}`;
        }

    </script>
</div>