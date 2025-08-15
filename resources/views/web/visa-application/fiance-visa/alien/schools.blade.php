<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienSchool'), 'id' => 'fianceAlienSchool']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>All questions are about the Alien (foreign citizen)</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you graduated high school or earned a high school equivalent diploma? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('equivalent_diploma', 'no', @$step->detail['equivalent_diploma'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input school'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('equivalent_diploma', 'yes', @$step->detail['equivalent_diploma'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input school'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="equivalent_diploma"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 schoolNoSec" style="display: {{ @$step->detail['equivalent_diploma'] == 'no' ? 'block' : 'none'  }};">
                    <div class="form-group">
                        {{ Form::label('highest_grade', 'If you answered No, then list the highest grade completed.') }}
                        <span class="required">*</span>
                        {{ Form::text('highest_grade', @$step->detail['highest_grade'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter highest grade'
                        ]) }}
                    </div>
                </div>  
                <div class="schoolYesSec" style="display: {{ @$step->detail['equivalent_diploma'] == 'yes' ? 'block' : 'none' }};">
                    <div class="appendSchool">
                        @if (empty($step->detail["school_name1"]))
                            @include('web.component.school-name', [
                                'index' => 1,
                                'sec' => '',
                                'data' => @$step->detail,
                            ])
                        @endif
                        @php
                            $i = '';
                        @endphp
                        @for ($i = 1; $i <= 4; $i++)
                            @if (isset($step->detail["school_name$i"]))
                                @include('web.component.school-name', [
                                    'index' => $i,
                                    'sec' => '',
                                    'data' => @$step->detail,
                                ])                          
                            @endif
                        @endfor
                    </div>
                    <div class="col-md-12 mb-4">
                        <a class="btn btn-tra-grey addSchoolBtn">+ Add another School</a>
                    </div>               
                </div>                          
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you have any occupational skills? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('occupational_skills', 'no', @$step->detail['occupational_skills'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input occupationalSkill'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('occupational_skills', 'yes', @$step->detail['occupational_skills'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input occupationalSkill'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="occupational_skills"></div>
                        </div>
                    </div>
                </div>
                <div class="occupationalSkillSec" style="display: {{ @$step->detail['occupational_skills'] == 'yes' ? 'block' : 'none' }};">
                    <div class="appendSkill">
                        @if (empty($step->detail["certifi_lice_occu_skill$i"]))
                            @include('web.component.occupational-skills', [
                                'index' => 1,
                                'sec' => '',
                                'data' => @$step->detail,
                            ])
                        @endif
                        @php
                            $i = '';
                        @endphp
                        @for ($i = 1; $i <= 3; $i++)
                            @if (isset($step->detail["certifi_lice_occu_skill$i"]))
                                @include('web.component.occupational-skills', [
                                    'index' => $i,
                                    'sec' => '',
                                    'data' => @$step->detail,
                                ])                        
                            @endif
                        @endfor
                    </div>
                    <div class="col-md-12 mb-4">
                        <a class="btn btn-tra-grey addSkill">+ Add Another Occupational skill</a>
                    </div>                 
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'schools') !!}
        {!! Form::hidden('next', 'travel') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'employment'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'travel'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienSchoolBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('click', '.school', function(){
            if ($(this).val() == 'no') {
                $('.schoolYesSec').hide();
                $('.schoolNoSec').show();
            } else if ($(this).val() == 'yes') {
                $('.schoolNoSec').hide();
                $('.schoolYesSec').show();
            }
        })

        $(document).on('click', '.occupationalSkill', function(){
            if ($(this).val() == 'yes') {
                $('.occupationalSkillSec').show();
            } else {
                $('.occupationalSkillSec').hide();
            }
        });        

        $(document).ready(function(){
            getState($('.countryId').val());
        });

        $(document).on('change', '.countryId', function(){
            var countryId = $(this).val();
            getState(countryId);
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

        $("#fianceAlienSchool").validate({
            rules: {
                equivalent_diploma: {
                    required: true,
                },
                occupational_skills: {
                    required: true,
                },
                school_name1: {
                    required: true,
                },
                street1: {
                    required: true,
                },
                city1: {
                    required: true,
                },
                state_or_province1: {
                    required: true,
                },
                postal_code1: {
                    required: true,
                },
                country1: {
                    required: true,
                },
                course_of_study1: {
                    required: true,
                },
                degree_or_diploma1: {
                    required: true,
                },
                start_date1: {
                    required: true,
                },
                end_date1: {
                    required: true,
                },  
                school_name2: {
                    required: true,
                },
                street2: {
                    required: true,
                },
                city2: {
                    required: true,
                },
                state_or_province2: {
                    required: true,
                },
                postal_code2: {
                    required: true,
                },
                country2: {
                    required: true,
                },
                course_of_study2: {
                    required: true,
                },
                degree_or_diploma2: {
                    required: true,
                },
                start_date2: {
                    required: true,
                },
                end_date2: {
                    required: true,
                },  
                school_name3: {
                    required: true,
                },
                street3: {
                    required: true,
                },
                city3: {
                    required: true,
                },
                state_or_province3: {
                    required: true,
                },
                postal_code3: {
                    required: true,
                },
                country3: {
                    required: true,
                },
                course_of_study3: {
                    required: true,
                },
                degree_or_diploma3: {
                    required: true,
                },
                start_date3: {
                    required: true,
                },
                end_date3: {
                    required: true,
                },  
                school_name4: {
                    required: true,
                },
                street4: {
                    required: true,
                },
                city4: {
                    required: true,
                },
                state_or_province4: {
                    required: true,
                },
                postal_code4: {
                    required: true,
                },
                country4: {
                    required: true,
                },
                course_of_study4: {
                    required: true,
                },
                degree_or_diploma4: {
                    required: true,
                },
                start_date4: {
                    required: true,
                },
                end_date4: {
                    required: true,
                }, 
                certifi_lice_occu_skill1: {
                    required: true,
                },
                date_obtained1: {
                    required: true,
                },
                issued_lice_or_certi1: {
                    required: true,
                },
                license_no1: {
                    required: true,
                },
                exp_renewal_date1: {
                    required: true,
                },
                certifi_lice_occu_skill2: {
                    required: true,
                },
                date_obtained2: {
                    required: true,
                },
                issued_lice_or_certi2: {
                    required: true,
                },
                license_no2: {
                    required: true,
                },
                exp_renewal_date2: {
                    required: true,
                },
                certifi_lice_occu_skill3: {
                    required: true,
                },
                date_obtained3: {
                    required: true,
                },
                issued_lice_or_certi3: {
                    required: true,
                },
                license_no3: {
                    required: true,
                },
                exp_renewal_date3: {
                    required: true,
                },  
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "equivalent_diploma" || element.attr("name") == "occupational_skills") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               equivalent_diploma: "Please choose option!",
               occupational_skills: "Please choose option!",
               highest_grade: "Please choose option!",
               school_name1: "Please enter name!",
               street1: "Please enter street!",
               city1: "Please enter city!",
               state_or_province1: "Please enter state!",
               postal_code1: "Please enter postal code!",
               country1: "Please choose country!",
               course_of_study1: "Please enter course of study!",
               degree_or_diploma1: "Please enter degree or diploma!",
               start_date1: "Please enter date!",
               end_date1: "Please enter date!",
               school_name2: "Please enter name!",
               street2: "Please enter street!",
               city2: "Please enter city!",
               state_or_province2: "Please enter state!",
               postal_code2: "Please enter postal code!",
               country2: "Please choose country!",
               course_of_study2: "Please enter course of study!",
               degree_or_diploma2: "Please enter degree or diploma!",
               start_date2: "Please enter date!",
               end_date2: "Please enter date!",
               school_name3: "Please enter name!",
               street3: "Please enter street!",
               city3: "Please enter city!",
               state_or_province3: "Please enter state!",
               postal_code3: "Please enter postal code!",
               country3: "Please choose country!",
               course_of_study3: "Please enter course of study!",
               degree_or_diploma3: "Please enter degree or diploma!",
               start_date3: "Please enter date!",
               end_date3: "Please enter date!",
               school_name4: "Please enter name!",
               street4: "Please enter street!",
               city4: "Please enter city!",
               state_or_province4: "Please enter state!",
               postal_code4: "Please enter postal code!",
               country4: "Please choose country!",
               course_of_study4: "Please enter course of study!",
               degree_or_diploma4: "Please enter degree or diploma!",
               start_date4: "Please enter date!",
               end_date4: "Please enter date!",
               certifi_lice_occu_skill1: "Please enter skill!",
               date_obtained1: "Please enter date!",
               issued_lice_or_certi1: "Please enter certificate issue!",
               license_no1: "Please enter number!",
               exp_renewal_date1: "Please enter date!",
               certifi_lice_occu_skill2: "Please enter skill!",
               date_obtained2: "Please enter date!",
               issued_lice_or_certi2: "Please enter certificate issue!",
               license_no2: "Please enter number!",
               exp_renewal_date2: "Please enter date!",
               certifi_lice_occu_skill3: "Please enter skill!",
               date_obtained3: "Please enter date!",
               issued_lice_or_certi3: "Please enter certificate issue!",
               license_no3: "Please enter number!",
               exp_renewal_date3: "Please enter date!",
               certifi_lice_occu_skill4: "Please enter skill!",
               date_obtained4: "Please enter date!",
               issued_lice_or_certi4: "Please enter certificate issue!",
               license_no4: "Please enter number!",
               exp_renewal_date4: "Please enter date!",
            },
            submitHandler: function(form) {
                $('#fianceAlienSchoolBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienSchool') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activeschools').removeClass('active');
                            $('.activetravel').addClass('active');
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

        function schoolForm(index) {
            datePicker();
            return '<div class="row schoolForm"> <div class="col-md-12 mb-4"> <a class="btn btn-tra-grey removeSchoolSec">- Remove School #'+index+'</a> </div> <h4>School #'+index+'</h4> <div class="col-md-6"> <div class="form-group"> <label for="school_name'+index+'">School name</label><span class="required">*</span><input class="form-control" placeholder="Enter School name " name="school_name'+index+'" type="text" id="school_name'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="street'+index+'">Street</label><span class="required">*</span><input class="form-control" placeholder="Enter Street" name="street'+index+'" type="text" id="street'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="city'+index+'">City</label><span class="required">*</span><input class="form-control" placeholder="Enter city" name="city'+index+'" type="text" id="city'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="state_or_province'+index+'">State or Province</label><span class="required">*</span><input class="form-control stateProvince'+index+'" placeholder="Enter State or Province." name="state_or_province'+index+'" type="text" id="state_or_province'+index+'"><label>Does Not Apply</label> <input class="custom-control-input doesNotApply" data-field="stateProvince'+index+'" type="checkbox"></div> </div> <div class="col-md-6"> <div class="form-group"> <label for="postal_code'+index+'">Postal Code</label><span class="required">*</span><input class="form-control postalCode'+index+'" placeholder="Enter Postal Code." name="postal_code'+index+'" type="text" id="postal_code'+index+'"><label>Does Not Apply</label> <input class="custom-control-input doesNotApply" data-field="postalCode'+index+'" type="checkbox"></div> </div> <div class="col-md-6"> <div class="form-group"> <label for="country'+index+'">Country</label><span class="required">*</span><select class="form-control countryId" id="country'+index+'" name="country'+index+'"><option value="" selected="selected">-Select Country-</option>@foreach(getCountry() as $country)</option><option value="{{ $country->id }}">{{ $country->name }}</option>@endforeach</select> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="course_of_study'+index+'">Course of study</label><span class="required">*</span><input class="form-control" placeholder="Enter Course of study." name="course_of_study'+index+'" type="text" id="course_of_study'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="degree_or_diploma'+index+'">Degree or Diploma</label><span class="required">*</span><input class="form-control" placeholder="Enter Degree or Diploma." name="degree_or_diploma'+index+'" type="text" id="degree_or_diploma'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="start_date'+index+'">Start Date  mm/dd/yyyy</label><span class="required">*</span><input class="form-control datePicker" placeholder="Enter Start Date" name="start_date'+index+'" type="text" id="start_date'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="end_date'+index+'">End Date  mm/dd/yyyy</label><span class="required">*</span><input class="form-control datePicker" placeholder="Enter End Date" name="end_date'+index+'" type="text" id="end_date'+index+'"> </div> </div> </div>';
        }             

        function occupationalSkillForm(index) {
            datePicker();
            return '<div class="row skillForm"> <div class="col-md-12 mb-4"> <a class="btn btn-tra-grey removeSkill">- Remove</a> </div> <h4>Occupational #'+index+'</h4> <div class="col-md-6"> <div class="form-group"> <label for="certifi_lice_occu_skill'+index+'">Certification/License Type/Occupational Skill</label><span class="required">*</span><input class="form-control" placeholder="Enter Skills" name="certifi_lice_occu_skill'+index+'" type="text" id="certifi_lice_occu_skill'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="date_obtained'+index+'">Date Obtained mm/dd/yyyy</label><span class="required">*</span> <input class="form-control datePicker" placeholder="Enter Date" name="date_obtained'+index+'" type="text" id="date_obtained'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="issued_lice_or_certi'+index+'">Who Issued Your License or Certification? (if any)</label><span class="required">*</span> <input class="form-control" placeholder="Enter Who Issued" name="issued_lice_or_certi'+index+'" type="text" id="issued_lice_or_certi'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="license_no'+index+'">License Number? (if any)</label><span class="required">*</span> <input class="form-control" placeholder="Enter number" name="license_no'+index+'" type="text" id="license_no'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="exp_renewal_date'+index+'">Expiration/Renewal Date  mm/dd/yyyy</label><span class="required">*</span> <input class="form-control disablePastDate expRenewalDate'+index+'" placeholder="Enter Date" name="exp_renewal_date'+index+'" type="text" id="exp_renewal_date'+index+'"><label>Does Not Apply</label> <input class="custom-control-input doesNotApply" data-field="expRenewalDate'+index+'" type="checkbox"></div> </div> </div>';
        }
        
    </script>
</div>