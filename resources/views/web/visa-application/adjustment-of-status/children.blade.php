<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentChildren'), 'id' => 'adjustmentChildren']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>All questions are about the Alien (foreign citizen).</h2>
                <p class="text-danger">Do not write your answers in all capital letters and never use any type of non-English characters.</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you have any children?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('have_child', 'no', @$step->detail['have_child'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input haveChild',
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('have_child', 'yes', @$step->detail['have_child'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input haveChild',
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="have_child"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 addChildernSec" style="display: {{ @$step->detail['have_child'] == 'yes' ? 'block' : 'none' }};">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Is this child applying with you?</label>
                            <div class="radiogroup">
                                <label class="custom-control custom-radio mb-0 ">
                                    {{ Form::radio('applying', 'no', @$step->detail['applying'] == 'no' ? true : '', [
                                            'class' => 'custom-control-input',
                                        ])
                                    }}
                                    <span class="custom-control-label"></span> No
                                </label>
                                <label class="custom-control custom-radio mb-0 ms-3">
                                    {{ Form::radio('applying', 'yes', @$step->detail['applying'] == 'yes' ? true : '', [
                                            'class' => 'custom-control-input',
                                        ]) 
                                    }}
                                    <span class="custom-control-label"></span> Yes
                                </label>
                                <div class="applying"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Is this child part of your household?</label>
                            <div class="radiogroup">
                                <label class="custom-control custom-radio mb-0 ">
                                    {{ Form::radio('household', 'no', @$step->detail['household'] == 'no' ? true : '', [
                                            'class' => 'custom-control-input',
                                        ])
                                    }}
                                    <span class="custom-control-label"></span> No
                                </label>
                                <label class="custom-control custom-radio mb-0 ms-3">
                                    {{ Form::radio('household', 'yes', @$step->detail['household'] == 'yes' ? true : '', [
                                            'class' => 'custom-control-input',
                                        ]) 
                                    }}
                                    <span class="custom-control-label"></span> Yes
                                </label>
                                <div class="household"></div>
                            </div>
                        </div>
                    </div>
                    <p class="text-danger">IMPORTANT! You must list first those children who are applying with you on this application.</p>
                    <p>List all children of alien including adult children and children who will not be included in this Adjustment of Status.</p>
                    <div class="appendChildern">
                        @for ($i = 1; $i <= 5; $i++)
                            @if (!empty($step->detail["first_name$i"]))                    
                                @include('web.component.children', [
                                    'index' => $i,
                                    'data' => @$step->detail,
                                ])
                            @endif
                        @endfor
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-tra-grey addChildern">+ Add another child</a>
                    </div>                 
                </div>                                               
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'children') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'affiliations') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'interpreter'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'affiliations'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentChildrenBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">        
        $(document).on('change', '.showTextArea', function(){
            var textArea = $(this).data('text');
            switch ($(this).val()) {
                case 'yes':
                    $('.'+textArea).show();                  
                break;         
                case 'no':
                    $('.'+textArea).hide();
                break;
            }
        });

        $(document).on('change', '.showNoSec', function(){
            var sec = $(this).data('text');
            switch ($(this).val()) {
                case 'yes':
                    $('.'+sec).hide();
                break;         
                case 'no':
                    $('.'+sec).show();                  
                break;
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
        
        $("#adjustmentChildren").validate({
            rules: {
                have_child: {
                    required: true,
                },
                understand_english: {
                    required: true,
                },
                applying: {
                    required: true,
                },
                household: {
                    required: true,
                },
                household: {
                    required: true,
                },
                first_name1: {
                    required: true,
                },
                middle_name1: {
                    required: true,
                },
                last_name1: {
                    required: true,
                },
                child_address1: {
                    required: true,
                },
                child_address1: {
                    required: true,
                },
                dob1: {
                    required: true,
                },
                cob1: {
                    required: true,
                },
                state_province1: {
                    required: true,
                },
                country_of_birth1: {
                    required: true,
                },
                country_of_citizenship1: {
                    required: true,
                },
                child_citizenship1: {
                    required: true,
                },
                child_citizenship1: {
                    required: true,
                },
                child_reg_no1: {
                    required: true,
                },
                ssa1: {
                    required: true,
                },
                ssa1: {
                    required: true,
                },
                ssn1: {
                    required: true,
                },
                ssc1: {
                    required: true,
                },
                ssc1: {
                    required: true,
                },
                relationship1: {
                    required: true,
                },
                relationship1: {
                    required: true,
                },
                relationship1: {
                    required: true,
                },
                relationship1: {
                    required: true,
                },
                arrested1: {
                    required: true,
                },
                arrested1: {
                    required: true,
                },
                joining1: {
                    required: true,
                },
                joining1: {
                    required: true,
                },
                pl_name1: {
                    required: true,
                },
                pf_name1: {
                    required: true,
                },
                pm_name1: {
                    required: true,
                },
                p_other_name1: {
                    required: true,
                },
                p_other_name1: {
                    required: true,
                },
                pol_name1: {
                    required: true,
                },
                pof_name1: {
                    required: true,
                },
                pom_name1: {
                    required: true,
                },
                p_dob1: {
                    required: true,
                },
                p_gender1: {
                    required: true,
                },
                p_gender1: {
                    required: true,
                },
                p_town_vilage1: {
                    required: true,
                },
                p_country_of_birth1: {
                    required: true,
                },
                city_residence1: {
                    required: true,
                },
                first_name2: {
                    required: true,
                },
                middle_name2: {
                    required: true,
                },
                last_name2: {
                    required: true,
                },
                child_address2: {
                    required: true,
                },
                child_address2: {
                    required: true,
                },
                dob2: {
                    required: true,
                },
                cob2: {
                    required: true,
                },
                state_province2: {
                    required: true,
                },
                country_of_birth2: {
                    required: true,
                },
                country_of_citizenship2: {
                    required: true,
                },
                child_citizenship2: {
                    required: true,
                },
                child_citizenship2: {
                    required: true,
                },
                child_reg_no2: {
                    required: true,
                },
                ssa2: {
                    required: true,
                },
                ssa2: {
                    required: true,
                },
                ssn2: {
                    required: true,
                },
                ssc2: {
                    required: true,
                },
                ssc2: {
                    required: true,
                },
                relationship2: {
                    required: true,
                },
                relationship2: {
                    required: true,
                },
                relationship2: {
                    required: true,
                },
                relationship2: {
                    required: true,
                },
                arrested2: {
                    required: true,
                },
                arrested2: {
                    required: true,
                },
                joining2: {
                    required: true,
                },
                joining2: {
                    required: true,
                },
                pl_name2: {
                    required: true,
                },
                pf_name2: {
                    required: true,
                },
                pm_name2: {
                    required: true,
                },
                p_other_name2: {
                    required: true,
                },
                p_other_name2: {
                    required: true,
                },
                pol_name2: {
                    required: true,
                },
                pof_name2: {
                    required: true,
                },
                pom_name2: {
                    required: true,
                },
                p_dob2: {
                    required: true,
                },
                p_gender2: {
                    required: true,
                },
                p_gender2: {
                    required: true,
                },
                p_town_vilage2: {
                    required: true,
                },
                p_country_of_birth2: {
                    required: true,
                },
                city_residence2: {
                    required: true,
                },
                first_name3: {
                    required: true,
                },
                middle_name3: {
                    required: true,
                },
                last_name3: {
                    required: true,
                },
                child_address3: {
                    required: true,
                },
                child_address3: {
                    required: true,
                },
                dob3: {
                    required: true,
                },
                cob3: {
                    required: true,
                },
                state_province3: {
                    required: true,
                },
                country_of_birth3: {
                    required: true,
                },
                country_of_citizenship3: {
                    required: true,
                },
                child_citizenship3: {
                    required: true,
                },
                child_citizenship3: {
                    required: true,
                },
                child_reg_no3: {
                    required: true,
                },
                ssa3: {
                    required: true,
                },
                ssa3: {
                    required: true,
                },
                ssn3: {
                    required: true,
                },
                ssc3: {
                    required: true,
                },
                ssc3: {
                    required: true,
                },
                relationship3: {
                    required: true,
                },
                relationship3: {
                    required: true,
                },
                relationship3: {
                    required: true,
                },
                relationship3: {
                    required: true,
                },
                arrested3: {
                    required: true,
                },
                arrested3: {
                    required: true,
                },
                joining3: {
                    required: true,
                },
                joining3: {
                    required: true,
                },
                pl_name3: {
                    required: true,
                },
                pf_name3: {
                    required: true,
                },
                pm_name3: {
                    required: true,
                },
                p_other_name3: {
                    required: true,
                },
                p_other_name3: {
                    required: true,
                },
                pol_name3: {
                    required: true,
                },
                pof_name3: {
                    required: true,
                },
                pom_name3: {
                    required: true,
                },
                p_dob3: {
                    required: true,
                },
                p_gender3: {
                    required: true,
                },
                p_gender3: {
                    required: true,
                },
                p_town_vilage3: {
                    required: true,
                },
                p_country_of_birth3: {
                    required: true,
                },
                city_residence3: {
                    required: true,
                },
                first_name4: {
                    required: true,
                },
                middle_name4: {
                    required: true,
                },
                last_name4: {
                    required: true,
                },
                child_address4: {
                    required: true,
                },
                child_address4: {
                    required: true,
                },
                dob4: {
                    required: true,
                },
                cob4: {
                    required: true,
                },
                state_province4: {
                    required: true,
                },
                country_of_birth4: {
                    required: true,
                },
                country_of_citizenship4: {
                    required: true,
                },
                child_citizenship4: {
                    required: true,
                },
                child_citizenship4: {
                    required: true,
                },
                child_reg_no4: {
                    required: true,
                },
                ssa4: {
                    required: true,
                },
                ssa4: {
                    required: true,
                },
                ssn4: {
                    required: true,
                },
                ssc4: {
                    required: true,
                },
                ssc4: {
                    required: true,
                },
                relationship4: {
                    required: true,
                },
                relationship4: {
                    required: true,
                },
                relationship4: {
                    required: true,
                },
                relationship4: {
                    required: true,
                },
                arrested4: {
                    required: true,
                },
                arrested4: {
                    required: true,
                },
                joining4: {
                    required: true,
                },
                joining4: {
                    required: true,
                },
                pl_name4: {
                    required: true,
                },
                pf_name4: {
                    required: true,
                },
                pm_name4: {
                    required: true,
                },
                p_other_name4: {
                    required: true,
                },
                p_other_name4: {
                    required: true,
                },
                pol_name4: {
                    required: true,
                },
                pof_name4: {
                    required: true,
                },
                pom_name4: {
                    required: true,
                },
                p_dob4: {
                    required: true,
                },
                p_gender4: {
                    required: true,
                },
                p_gender4: {
                    required: true,
                },
                p_town_vilage4: {
                    required: true,
                },
                p_country_of_birth4: {
                    required: true,
                },
                city_residence4: {
                    required: true,
                },
                first_name5: {
                    required: true,
                },
                middle_name5: {
                    required: true,
                },
                last_name5: {
                    required: true,
                },
                child_address5: {
                    required: true,
                },
                child_address5: {
                    required: true,
                },
                dob5: {
                    required: true,
                },
                cob5: {
                    required: true,
                },
                state_province5: {
                    required: true,
                },
                country_of_birth5: {
                    required: true,
                },
                country_of_citizenship5: {
                    required: true,
                },
                child_citizenship5: {
                    required: true,
                },
                child_citizenship5: {
                    required: true,
                },
                child_reg_no5: {
                    required: true,
                },
                ssa5: {
                    required: true,
                },
                ssa5: {
                    required: true,
                },
                ssn5: {
                    required: true,
                },
                ssc5: {
                    required: true,
                },
                ssc5: {
                    required: true,
                },
                relationship5: {
                    required: true,
                },
                relationship5: {
                    required: true,
                },
                relationship5: {
                    required: true,
                },
                relationship5: {
                    required: true,
                },
                arrested5: {
                    required: true,
                },
                arrested5: {
                    required: true,
                },
                joining5: {
                    required: true,
                },
                joining5: {
                    required: true,
                },
                pl_name5: {
                    required: true,
                },
                pf_name5: {
                    required: true,
                },
                pm_name5: {
                    required: true,
                },
                p_other_name5: {
                    required: true,
                },
                p_other_name5: {
                    required: true,
                },
                pol_name5: {
                    required: true,
                },
                pof_name5: {
                    required: true,
                },
                pom_name5: {
                    required: true,
                },
                p_dob5: {
                    required: true,
                },
                p_gender5: {
                    required: true,
                },
                p_gender5: {
                    required: true,
                },
                p_town_vilage5: {
                    required: true,
                },
                p_country_of_birth5: {
                    required: true,
                },
                city_residence5: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                var name = element.attr("name");
                if (name == "have_child" || name == "understand_english" || name == "applying" || name == "resident_status" || name == "household" || name == "child_address1" || name == "child_address2" || name == "child_address3" || name == "child_address4" || name == "child_address5" || name == "child_citizenship1" || name == "child_citizenship2" || name == "child_citizenship3" || name == "child_citizenship4" || name == "child_citizenship5") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
                have_child: "Please choose option!",
                understand_english: "Please choose option!",
                applying: "This field is required!",
                household: "This field is required!",
                household: "This field is required!",
                first_name1: "This field is required!",
                middle_name1: "This field is required!",
                last_name1: "This field is required!",
                child_address1: "This field is required!",
                child_address1: "This field is required!",
                dob1: "This field is required!",
                cob1: "This field is required!",
                state_province1: "This field is required!",
                country_of_birth1: "This field is required!",
                country_of_citizenship1: "This field is required!",
                child_citizenship1: "This field is required!",
                child_citizenship1: "This field is required!",
                child_reg_no1: "This field is required!",
                ssa1: "This field is required!",
                ssa1: "This field is required!",
                ssn1: "This field is required!",
                ssc1: "This field is required!",
                ssc1: "This field is required!",
                relationship1: "This field is required!",
                relationship1: "This field is required!",
                relationship1: "This field is required!",
                relationship1: "This field is required!",
                arrested1: "This field is required!",
                arrested1: "This field is required!",
                joining1: "This field is required!",
                joining1: "This field is required!",
                pl_name1: "This field is required!",
                pf_name1: "This field is required!",
                pm_name1: "This field is required!",
                p_other_name1: "This field is required!",
                p_other_name1: "This field is required!",
                pol_name1: "This field is required!",
                pof_name1: "This field is required!",
                pom_name1: "This field is required!",
                p_dob1: "This field is required!",
                p_gender1: "This field is required!",
                p_gender1: "This field is required!",
                p_town_vilage1: "This field is required!",
                p_country_of_birth1: "This field is required!",
                city_residence1: "This field is required!",
                first_name2: "This field is required!",
                middle_name2: "This field is required!",
                last_name2: "This field is required!",
                child_address2: "This field is required!",
                child_address2: "This field is required!",
                dob2: "This field is required!",
                cob2: "This field is required!",
                state_province2: "This field is required!",
                country_of_birth2: "This field is required!",
                country_of_citizenship2: "This field is required!",
                child_citizenship2: "This field is required!",
                child_citizenship2: "This field is required!",
                child_reg_no2: "This field is required!",
                ssa2: "This field is required!",
                ssa2: "This field is required!",
                ssn2: "This field is required!",
                ssc2: "This field is required!",
                ssc2: "This field is required!",
                relationship2: "This field is required!",
                relationship2: "This field is required!",
                relationship2: "This field is required!",
                relationship2: "This field is required!",
                arrested2: "This field is required!",
                arrested2: "This field is required!",
                joining2: "This field is required!",
                joining2: "This field is required!",
                pl_name2: "This field is required!",
                pf_name2: "This field is required!",
                pm_name2: "This field is required!",
                p_other_name2: "This field is required!",
                p_other_name2: "This field is required!",
                pol_name2: "This field is required!",
                pof_name2: "This field is required!",
                pom_name2: "This field is required!",
                p_dob2: "This field is required!",
                p_gender2: "This field is required!",
                p_gender2: "This field is required!",
                p_town_vilage2: "This field is required!",
                p_country_of_birth2: "This field is required!",
                city_residence2: "This field is required!",
                first_name3: "This field is required!",
                middle_name3: "This field is required!",
                last_name3: "This field is required!",
                child_address3: "This field is required!",
                child_address3: "This field is required!",
                dob3: "This field is required!",
                cob3: "This field is required!",
                state_province3: "This field is required!",
                country_of_birth3: "This field is required!",
                country_of_citizenship3: "This field is required!",
                child_citizenship3: "This field is required!",
                child_citizenship3: "This field is required!",
                child_reg_no3: "This field is required!",
                ssa3: "This field is required!",
                ssa3: "This field is required!",
                ssn3: "This field is required!",
                ssc3: "This field is required!",
                ssc3: "This field is required!",
                relationship3: "This field is required!",
                relationship3: "This field is required!",
                relationship3: "This field is required!",
                relationship3: "This field is required!",
                arrested3: "This field is required!",
                arrested3: "This field is required!",
                joining3: "This field is required!",
                joining3: "This field is required!",
                pl_name3: "This field is required!",
                pf_name3: "This field is required!",
                pm_name3: "This field is required!",
                p_other_name3: "This field is required!",
                p_other_name3: "This field is required!",
                pol_name3: "This field is required!",
                pof_name3: "This field is required!",
                pom_name3: "This field is required!",
                p_dob3: "This field is required!",
                p_gender3: "This field is required!",
                p_gender3: "This field is required!",
                p_town_vilage3: "This field is required!",
                p_country_of_birth3: "This field is required!",
                city_residence3: "This field is required!",
                first_name4: "This field is required!",
                middle_name4: "This field is required!",
                last_name4: "This field is required!",
                child_address4: "This field is required!",
                child_address4: "This field is required!",
                dob4: "This field is required!",
                cob4: "This field is required!",
                state_province4: "This field is required!",
                country_of_birth4: "This field is required!",
                country_of_citizenship4: "This field is required!",
                child_citizenship4: "This field is required!",
                child_citizenship4: "This field is required!",
                child_reg_no4: "This field is required!",
                ssa4: "This field is required!",
                ssa4: "This field is required!",
                ssn4: "This field is required!",
                ssc4: "This field is required!",
                ssc4: "This field is required!",
                relationship4: "This field is required!",
                relationship4: "This field is required!",
                relationship4: "This field is required!",
                relationship4: "This field is required!",
                arrested4: "This field is required!",
                arrested4: "This field is required!",
                joining4: "This field is required!",
                joining4: "This field is required!",
                pl_name4: "This field is required!",
                pf_name4: "This field is required!",
                pm_name4: "This field is required!",
                p_other_name4: "This field is required!",
                p_other_name4: "This field is required!",
                pol_name4: "This field is required!",
                pof_name4: "This field is required!",
                pom_name4: "This field is required!",
                p_dob4: "This field is required!",
                p_gender4: "This field is required!",
                p_gender4: "This field is required!",
                p_town_vilage4: "This field is required!",
                p_country_of_birth4: "This field is required!",
                city_residence4: "This field is required!",
                first_name5: "This field is required!",
                middle_name5: "This field is required!",
                last_name5: "This field is required!",
                child_address5: "This field is required!",
                child_address5: "This field is required!",
                dob5: "This field is required!",
                cob5: "This field is required!",
                state_province5: "This field is required!",
                country_of_birth5: "This field is required!",
                country_of_citizenship5: "This field is required!",
                child_citizenship5: "This field is required!",
                child_citizenship5: "This field is required!",
                child_reg_no5: "This field is required!",
                ssa5: "This field is required!",
                ssa5: "This field is required!",
                ssn5: "This field is required!",
                ssc5: "This field is required!",
                ssc5: "This field is required!",
                relationship5: "This field is required!",
                relationship5: "This field is required!",
                relationship5: "This field is required!",
                relationship5: "This field is required!",
                arrested5: "This field is required!",
                arrested5: "This field is required!",
                joining5: "This field is required!",
                joining5: "This field is required!",
                pl_name5: "This field is required!",
                pf_name5: "This field is required!",
                pm_name5: "This field is required!",
                p_other_name5: "This field is required!",
                p_other_name5: "This field is required!",
                pol_name5: "This field is required!",
                pof_name5: "This field is required!",
                pom_name5: "This field is required!",
                p_dob5: "This field is required!",
                p_gender5: "This field is required!",
                p_gender5: "This field is required!",
                p_town_vilage5: "This field is required!",
                p_country_of_birth5: "This field is required!",
                city_residence5: "This field is required!",
            },
            submitHandler: function(form) {
                $('#adjustmentChildrenBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentChildren') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.children').removeClass('active');
                            $('.affiliations').addClass('active');
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

        function addChildernHtml(index) {
            datePicker();
            removeBtn = '';
            if (index != 1) {
                removeBtn = '<a class="btn btn-tra-grey removeChildern">- Remove Child</a>';
            }
            return '<div class="row addChildernForm "> <div class="col-md-12">'+removeBtn+'</div> <div class="col-md-12"> <div class="form-group"> </div> </div> <h5>Child '+index+'</h5> <div class="col-md-6"> <div class="form-group"> <label for="first_name">First Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="first_name'+index+'" type="text" id="first_name"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="middle_name">Middle Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="middle_name'+index+'" type="text" id="middle_name"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="last_name">Last Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="last_name'+index+'" type="text" id="last_name"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label>Is the address for this child the same as the alien parent?</label> <div class="radiogroup"> <label class="custom-control custom-radio mb-0 "> <input class="custom-control-input" name="child_address'+index+'" type="radio" value="no"> <span class="custom-control-label"></span> No </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input" name="child_address'+index+'" type="radio" value="yes"> <span class="custom-control-label"></span> Yes </label> <div class="child_address"></div> </div> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="dob">Date of Birth (mm/dd/yyyy)</label> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="Enter Date of Birth" name="dob'+index+'" type="text" id="dob"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="cob">City of Birth</label> <span class="required">*</span> <input class="form-control" placeholder="Enter City of Birth" name="cob'+index+'" type="text" id="cob"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="state_province">State or Province of Birth</label> <span class="required">*</span> <input class="form-control" placeholder="Enter State or Province of Birth" name="state_province'+index+'" type="text" id="state_province"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="country_of_birth">Country of Birth</label> <span class="required">*</span> <select class="form-control" id="country_of_birth" name="country_of_birth'+index+'"> <option value="" selected="selected">-Select Country-</option> @foreach (getAllCountry() as $country) <option value="{{$country}}">{{$country}}</option> @endforeach </select> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="country_of_citizenship">Country of Citizenship</label> <span class="required">*</span> <select class="form-control" id="country_of_citizenship" name="country_of_citizenship'+index+'"> <option value="" selected="selected">-Select Country-</option> @foreach (getAllCountry() as $country) <option value="{{$country}}">{{$country}}</option> @endforeach </select> </div> </div> <div class="col-md-12"> <div class="form-group"> <label>Does this child have citizenship in another country?</label> <div class="radiogroup"> <label class="custom-control custom-radio mb-0 "> <input class="custom-control-input showTextArea" data-text="childCitizenshipSec" name="child_citizenship'+index+'" type="radio" value="no"> <span class="custom-control-label"></span> No </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input showTextArea" data-text="childCitizenshipSec" name="child_citizenship'+index+'" type="radio" value="yes"> <span class="custom-control-label"></span> Yes </label> <div class="child_citizenship"></div> </div> </div> </div> <div class="col-md-12 childCitizenshipSec" style="display: none;"> <div class="form-group"> <label for="child_reg_no">Childs A# (Alien Registration Number).</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Number" name="child_reg_no'+index+'" type="text" id="child_reg_no"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label>Has the Social Security Administration (SSA) ever officially issued a Social Security card to you? </label> <div class="radiogroup"> <label class="custom-control custom-radio mb-0 "> <input class="custom-control-input showTextArea" data-text="ssaSec" name="ssa'+index+'" type="radio" value="no"> <span class="custom-control-label"></span> No </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input showTextArea" data-text="ssaSec" name="ssa'+index+'" type="radio" value="yes"> <span class="custom-control-label"></span> Yes </label> <div class="ssa"></div> </div> </div> </div> <div class="col-md-12 ssaSec" style="display: none;"> <div class="form-group"> <label for="ssn">Social Security Number  Format: 123-45-6789 Uncommon</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Number" name="ssn'+index+'" type="text" id="ssn"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label>Do you want the SSA to issue you a Social Security card?</label> <div class="radiogroup"> <label class="custom-control custom-radio mb-0 "> <input class="custom-control-input showTextArea" data-text="sscSec" name="ssc'+index+'" type="radio" value="no"> <span class="custom-control-label"></span> No </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input showTextArea" data-text="sscSec" name="ssc'+index+'" type="radio" value="yes"> <span class="custom-control-label"></span> Yes </label> <div class="ssc"></div> </div> </div> </div> <div class="col-md-12 sscSec" style="display: none;"> <p class="text-danger">Note: By answering "Yes", you authorize the disclosure of information from this application to the SSA as required for the purpose of assigning you(beneficiary) an SSN and issuing you(beneficiary) a Social Security card.</p> </div> <div class="col-md-12"> <div class="form-group"> <label>Relationship to Alien Beneficiary</label> <div class="radiogroup"> <label class="custom-control custom-radio mb-0 "> <input class="custom-control-input" name="relationship'+index+'" type="radio" value="sun"> <span class="custom-control-label"></span> Sun </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input" name="relationship'+index+'" type="radio" value="daughter"> <span class="custom-control-label"></span> Daughter </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input" name="relationship'+index+'" type="radio" value="step-son"> <span class="custom-control-label"></span> Step-Son </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input" name="relationship'+index+'" type="radio" value=" step-daughter"> <span class="custom-control-label"></span>  Step-Daughter </label> <div class="relationship"></div> </div> </div> </div> <div class="col-md-12"> <div class="form-group"> <label>Has the child mentioned above been arrested for and/or convicted of any crime?</label> <div class="radiogroup"> <label class="custom-control custom-radio mb-0 "> <input class="custom-control-input" name="arrested'+index+'" type="radio" value="no"> <span class="custom-control-label"></span> No </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input" name="arrested'+index+'" type="radio" value="yes"> <span class="custom-control-label"></span> Yes </label> <div class="arrested"></div> </div> </div> </div> <div class="col-md-12"> <div class="form-group"> <label>Will this child be joining you in your Adjustment of Status? You must have married the U.S. citizen (sponsor) before the child became 18 years of age.</label> <div class="radiogroup"> <label class="custom-control custom-radio mb-0 "> <input class="custom-control-input" name="joining'+index+'" type="radio" value="no"> <span class="custom-control-label"></span> No </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input" name="joining'+index+'" type="radio" value="yes"> <span class="custom-control-label"></span> Yes </label> <div class="joining"></div> </div> </div> </div> <p>Parent 2s Information</p> <div class="col-md-12"> <div class="form-group"> <label for="pl_name">Parent 2s Last Name of Birth</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="pl_name'+index+'" type="text" id="pl_name"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="pf_name">Parent 2s First Name of Birth</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="pf_name'+index+'" type="text" id="pf_name"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="pm_name">Parent 2s Middle Name of Birth</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="pm_name'+index+'" type="text" id="pm_name"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label>Has your Parent 2 used any other names?</label> <div class="radiogroup"> <label class="custom-control custom-radio mb-0 "> <input class="custom-control-input showTextArea" data-text="pOtherNameSec" name="p_other_name'+index+'" type="radio" value="no"> <span class="custom-control-label"></span> No </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input showTextArea" data-text="pOtherNameSec" name="p_other_name'+index+'" type="radio" value="yes"> <span class="custom-control-label"></span> Yes </label> <div class="p_other_name"></div> </div> </div> </div> <div class="col-md-12 pOtherNameSec" style="display: none;"> <div class="form-group"> <label for="pol_name">Parent 2s Other Last Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="pol_name'+index+'" type="text" id="pol_name"> </div> <div class="form-group"> <label for="pof_name">Parent 2s Other First Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="pof_name'+index+'" type="text" id="pof_name"> </div> <div class="form-group"> <label for="pom_name">Parent 2s Other Middle Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="pom_name'+index+'" type="text" id="pom_name"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="p_dob">Parent 2s Date of Birth (mm/dd/yyyy)</label> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="Enter Date" name="p_dob'+index+'" type="text" id="p_dob"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label>Parent 2s Gender</label> <div class="radiogroup"> <label class="custom-control custom-radio mb-0 "> <input class="custom-control-input showTextArea" data-text="pOtherNameSec" name="p_gender'+index+'" type="radio" value="no"> <span class="custom-control-label"></span> No </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input showTextArea" data-text="pOtherNameSec" name="p_gender'+index+'" type="radio" value="yes"> <span class="custom-control-label"></span> Yes </label> <div class="p_gender"></div> </div> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="p_town_vilage">Parent 2s City/Town/Village of Birth</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Address" name="p_town_vilage'+index+'" type="text" id="p_town_vilage"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="p_country_of_birth">Parent 2s Country of Birth</label> <span class="required">*</span> <select class="form-control" id="p_country_of_birth" name="p_country_of_birth'+index+'"> <option value="" selected="selected">-Select Country-</option> @foreach (getAllCountry() as $country) <option value="{{$country}}">{{$country}}</option> @endforeach </select> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="city_residence">Parent 2s Current City of Residence Enter Deceased if appropriate.</label> <span class="required">*</span> <input class="form-control" placeholder="Enter City" name="city_residence'+index+'" type="text" id="city_residence"> </div> </div> </div>';
        }
    </script>   
</div>