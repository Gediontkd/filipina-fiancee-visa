<div class="step-wizard">
    {{ Form::open(['url' => route('fianceSponsorOtherFilings'), 'id' => 'fianceSponsorOtherFilings']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Other Filings</h2>
                    </div>                    
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever filed Form I-129F, Petition for Alien Fiancé(e) for any other person?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('i_129F', 'no', @$step->detail['i_129F'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input i129F'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('i_129F', 'yes', @$step->detail['i_129F'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input i129F'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                        </div>
                    </div>
                </div>                
                <div class="i_129F"></div>
                <div class="col-md-12 i129FSec" style="display: {{ @$step->detail['i_129F'] == 'yes' ? 'block' : 'none' }};">
                    <p>Please select the situation that applies to you:</p>
                    <label class="custom-control custom-radio mb-0 ">
                        {{ Form::radio('situation', 'situation1', @$step->detail['situation'] == 'situation1' ? true : '', [
                            'class' => 'custom-control-input'
                        ]) }}
                        <span class="custom-control-label"></span> I am a Multiple Filer, with No Permanent Restraining Orders or Convictions for a Specified Offense and am requesting a General Waiver.
                    </label>
                    <label class="custom-control custom-radio mb-0 ">
                        {{ Form::radio('situation', 'situation2', @$step->detail['situation'] == 'situation2' ? true : '', [
                            'class' => 'custom-control-input'
                        ]) }}
                        <span class="custom-control-label"></span> I am a Multiple Filer, with Prior Permanent Restraining Orders or Criminal Conviction for Specified Offense and am requesting an Extraordinary Circumstances Waiver.
                    </label>
                    <label class="custom-control custom-radio mb-0 ">
                        {{ Form::radio('situation', 'situation3', @$step->detail['situation'] == 'situation3' ? true : '', [
                            'class' => 'custom-control-input'
                        ]) }}
                        <span class="custom-control-label"></span> I am a Multiple Filer, with Prior Permanent Restraining Order or Criminal Convictions for Specified Offense Resulting from Domestic Violence and am requesting a Mandatory Waiver.
                    </label>
                    <label class="custom-control custom-radio mb-0 ">
                        {{ Form::radio('situation', 'situation4', @$step->detail['situation'] == 'situation4' ? true : '', [
                            'class' => 'custom-control-input'
                        ]) }}
                        <span class="custom-control-label"></span> Not applicable, beneficiary is my spouse or I am not a multiple filer .
                    </label>
                    <div class="situation"></div>
                    <div class="mt-4">
                        <div class="row appendfiledPetition">  
                            @if (@$step->detail['i_129F'] == 'yes')                     
                                @for ($i = 1; $i <= 5; $i++)
                                    @if (isset($step->detail["alien_fname$i"]))
                                        @include('web.component.fiance-sponsor.filed-petition', [
                                            'index' => $i,
                                            'data' => @$step->detail,
                                        ])                      
                                    @endif
                                @endfor
                            @else
                                @include('web.component.fiance-sponsor.filed-petition', [
                                        'index' => 1,
                                        'data' => @$step->detail,
                                    ])  
                            @endif
                        </div>                                   
                        <div class="col-md-6 mb-4">
                            <a class="btn btn-tra-grey addFiledPetition">+ Add Another Filed Petition</a>
                        </div>
                    </div>
                    <div class="col-md-12">
                    <p>The government form only provides space to enter one prior filing. If you have more than one prior filing you must record that person(s) information on a separate sheet and attach to your petition.</p>
                    <div class="form-group">
                        <label>Was any previous filing(s) for a fiance?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('previous_filing', 'no', @$step->detail['previous_filing'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input previousFiling'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('previous_filing', 'yes', @$step->detail['previous_filing'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input previousFiling'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                        </div>
                        <div class="previous_filing"></div>
                    </div>
                </div>
                <div class="col-md-12 previousFilingSec" style="display: {{ @$step->detail['previous_filing'] == 'yes' ? 'block' : 'none' }};">
                    <div class="form-group">
                        <p class="text-danger approvedI129FP" style="display: {{ @$step->detail['approved_i_129F'] == 'yes' ? 'block' : 'none' }};">If your previous K1 approval was less than two years ago, your petition requires a special waiver. Once
                            you request a review, please contact our Customer Success team to prepare this waiver request.</p>
                        <label>Was the Receipt Date of your most recently approved I-129F (fiance visa) petition less than two years ago? The Receipt Date is on the From I-797 or I-797C you received in the mail telling you the petition was received. A petition approved by the USCIS counts against you even if the actual K-1 visa was never issued by the embassy. An I-129F petition that was denied or withdrawn before it was approved or denied does not count against you. </label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('approved_i_129F', 'no', @$step->detail['approved_i_129F'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input approvedI129F'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('approved_i_129F', 'yes', @$step->detail['approved_i_129F'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input approvedI129F'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                        </div>
                        <div class="approved_i_129F"></div>
                    </div>
                    <div class="form-group mb-4 approvedI129FSec" style="display: {{ @$step->detail['approved_i_129F'] == 'no' ? 'block' : 'none' }};">
                        <p class="text-danger previouslyFiledP" style="display: none;">You are only allowed TWO fiancee visa petitions in your lifetime, including any previous petitions for this
                            same fiancee. Once these have been used up, your only option is to marry your fiancee and do a spouse
                            petition. Please contact our Customer Success team for more information.</p>
                        <label>Have you previously filed two or more fiance visa applications in your lifetime, including any previous petitions for this same fiance? For the purpose of this question all filings count even if they were denied or withdrawn. A petition is considered filed if you received a Receipt Notice (case number) even when the visa was never issued. </label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('previously_filed', 'no', @$step->detail['previously_filed'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input previouslyFiled'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('previously_filed', 'yes', @$step->detail['previously_filed'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input previouslyFiled'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                        </div>
                        <div class="previously_filed"></div>
                    </div>
                </div> 
                </div>                
            </div>           
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'other-filings') !!}
        {!! Form::hidden('next', 'military-and-convictions') !!}
        {!! Form::hidden('type', 'sponsor') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'marital-status'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 sponsorPreviousOrContinue',
            'data-form' => 'military-and-convictions'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceSponsorOtherFilingsBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">  
        $(document).on('change', '.i129F', function(){
            if ($(this).val() == 'yes') {
                $('.i129FSec').show();
            } else {
                $('.i129FSec').hide();
            }
        });
        $(document).on('change', '.previousFiling', function(){
            if ($(this).val() == 'yes') {
                $('.previousFilingSec').show();
            } else {
                $('.previousFilingSec').hide();
            }
        });
        $(document).on('change', '.approvedI129F', function(){
            if ($(this).val() == 'yes') {
                $('.approvedI129FP').show();
                $('.approvedI129FSec').hide();
            } else {
                $('.approvedI129FP').hide();
                $('.approvedI129FSec').show();
            }
        });
        $(document).on('change', '.previouslyFiled', function(){
            if ($(this).val() == 'yes') {
                $('.previouslyFiledP').show();
            } else {
                $('.previouslyFiledP').hide();
            }
        });
        
        $(document).ready(function(){
            var state = $('.states').data('state');
            getState(231, state);
        });
      
        function getState(countryId, state='')
        {
            $.ajax({                
                type: 'get',
                url: "{{ route('getState') }}",
                data: {
                    countryId: countryId,
                    state: state
                },
                success: function(data) {
                    $('.states').html(data);                    
                }
            });
        }

        $(document).ready(function(){
            var appendPriorSpouse = $('.appendPriorSpouse > .priorSpouseForm').length;
            if (appendPriorSpouse == 2) {
                $('.addPriorSpouse').addClass('d-none');
            }            
        });            

        $("#fianceSponsorOtherFilings").validate({
            rules: {
                i_129F: {
                    required: true,
                },
                situation: {
                    required: true,
                },
                alien_fname1: {
                    required: true,
                },
                alien_mname1: {
                    required: true,
                },
                alien_mlname1: {
                    required: true,
                },
                alien_reg_no1: {
                    required: true,
                },
                alien_city_filing1: {
                    required: true,
                },
                us_State1: {
                    required: true,
                },
                date_of_filing1: {
                    required: true,
                },
                results_of_App1: {
                    required: true,
                },
                alien_fname2: {
                    required: true,
                },
                alien_mname2: {
                    required: true,
                },
                alien_mlname2: {
                    required: true,
                },
                alien_reg_no2: {
                    required: true,
                },
                alien_city_filing2: {
                    required: true,
                },
                us_State2: {
                    required: true,
                },
                date_of_filing2: {
                    required: true,
                },
                results_of_App2: {
                    required: true,
                },
                alien_fname3: {
                    required: true,
                },
                alien_mname3: {
                    required: true,
                },
                alien_mlname3: {
                    required: true,
                },
                alien_reg_no3: {
                    required: true,
                },
                alien_city_filing3: {
                    required: true,
                },
                us_State3: {
                    required: true,
                },
                date_of_filing3: {
                    required: true,
                },
                results_of_App3: {
                    required: true,
                },
                previous_filing: {
                    required: true,
                },
                approved_i_129F: {
                    required: true,
                },
                previously_filed: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "i_129F" || element.attr("name") == "situation" || element.attr("name") == "previous_filing" || element.attr("name") == "approved_i_129F" || element.attr("name") == "previously_filed") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }               
            },
            messages: {
               i_129F: "Please choose option!",                                                                   
               situation: "Please choose option!",                                             
               alien_fname1: "Please enter name!",                                                              
               alien_mname1: "Please enter name!",                                                              
               alien_mlname1: "Please enter name!",                                                              
               alien_reg_no1: "Please enter number!",                               
               alien_city_filing1: "Please enter city filing!",                               
               us_State1: "Please enter state!",                               
               date_of_filing1: "Please enter date of filing!",                               
               results_of_App1: "Please enter results of application!",    
               alien_fname2: "Please enter name!",                                                              
               alien_mname2: "Please enter name!",                                                              
               alien_mlname2: "Please enter name!",                                                              
               alien_reg_no2: "Please enter number!",                               
               alien_city_filing2: "Please enter city filing!",                               
               us_State2: "Please enter state!",                               
               date_of_filing2: "Please enter date of filing!",                               
               results_of_App2: "Please enter results of application!",
               alien_fname3: "Please enter name!",                                                              
               alien_mname3: "Please enter name!",                                                              
               alien_mlname3: "Please enter name!",                                                              
               alien_reg_no3: "Please enter number!",                               
               alien_city_filing3: "Please enter city filing!",                               
               us_State3: "Please enter state!",                               
               date_of_filing3: "Please enter date of filing!",                               
               results_of_App3: "Please enter results of application!",                               
               previous_filing: "Please choose option!",                               
               approved_i_129F: "Please choose option!",                               
               previously_filed: "Please choose option!",                               
            },
            submitHandler: function(form) {
                $('#fianceSponsorOtherFilingsBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceSponsorOtherFilings') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activeother-filings').removeClass('active');
                            $('.activemilitary-and-convictions').addClass('active');
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

        function filedPetitionHtml(index) {
            datePicker();
            getState(231);
            // var removeBtn = '';
            // if (index != 1) {
            //     removeBtn = '<div class="col-md-6 mb-4"> <a class="btn btn-tra-grey removefiledPetition">- Remove #</a> </div>';
            // }
            return `{!! addslashes(view('web.component.fiance-sponsor.filed-petition')->with(['index' => '${index}'])->render()) !!}`;

            // return '<div class="row filedPetitionForm">'+removeBtn+'<div class="col-md-12"> <div class="form-group"> <label for="alien_fname'+index+'">Aliens First Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="alien_fname'+index+'" type="text" id="alien_fname'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="alien_mname'+index+'">Aliens Middle Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="alien_mname'+index+'" type="text" id="alien_mname'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="alien_mlname'+index+'">Aliens Maiden Last Name (family name)</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="alien_mlname'+index+'" type="text" id="alien_mlname'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="alien_reg_no'+index+'">Alien Registration Number or A#. Do not include the "A" or #.</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Number" name="alien_reg_no'+index+'" type="text" id="alien_reg_no'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="alien_city_filing'+index+'">City of Filing</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Number" name="alien_city_filing'+index+'" type="text" id="alien_city_filing'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="us_State'+index+'">U.S. State (Select Does Not Apply if not USA)</label> <span class="required">*</span> <select class="form-control states" name="us_State'+index+'"><option value="">-Select Country-</option></select> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="date_of_filing'+index+'">Date of Filing (mm/dd/yyyy, okay to estimate)</label> <span class="required">*</span> <input class="form-control datePicker" placeholder="Enter Date" name="date_of_filing'+index+'" type="text" id="date_of_filing'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="results_of_App'+index+'">Results of Application</label> <span class="required">*</span> <select class="form-control" id="results_of_App'+index+'" name="results_of_App'+index+'"><option value="" selected="selected">Select</option><option value="Approved, divorced and still in USA.">Approved, divorced and still in USA.</option><option value="Approved, divorced left USA.">Approved, divorced left USA.</option><option value="Approved, divorced location unknown.">Approved, divorced location unknown.</option><option value="Approved but now deceased.">Approved but now deceased.</option><option value="Approved, never came to USA.">Approved, never came to USA.</option><option value="Approved, waiting for a Visa.">Approved, waiting for a Visa.</option><option value="Approved, still in USA.">Approved, still in USA.</option><option value="Approved, no longer in USA.">Approved, no longer in USA.</option><option value="Denied, still in USA.">Denied, still in USA.</option><option value="Denied, no longer in USA.">Denied, no longer in USA.</option><option value="Denied, never came to USA">Denied, never came to USA</option><option value="Denied, location unknown.">Denied, location unknown.</option><option value="Denied and now deceased.">Denied and now deceased.</option><option value="Withdrawn before approval.">Withdrawn before approval.</option><option value="Withdrawn due to death.">Withdrawn due to death.</option><option value="Status Unknown. Location Unknown.">Status Unknown. Location Unknown.</option></select> </div> </div> </div>'; 
        }

        function relativeHtml(index) {
            datePicker();
            var removeBtn = '';
            if (index != 1) {
                removeBtn = '<div class="col-md-6 mb-4"> <a class="btn btn-tra-grey removeRelative">- Remove</a> </div>';
            }
            return '<div class="row relativeForm">'+removeBtn+'<div class="col-md-12"> <div class="form-group"> <label for="fl_name'+index+'">Family Name (Last Name)?</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="fl_name'+index+'" type="text" id="fl_name'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="gf_name'+index+'">Given Name (First Name)</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="gf_name'+index+'" type="text" id="gf_name'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="m_name'+index+'">Middle Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="m_name'+index+'" type="text" id="m_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="relationship'+index+'">Relationship</label> <span class="required">*</span> <select class="form-control" id="relationship'+index+'" name="relationship'+index+'"><option value="" selected="selected">- Select Relationship -</option><option value="Brother">Brother</option><option value="Daughter">Daughter</option><option value="Father">Father</option><option value="Mother">Mother</option><option value="Sister">Sister</option><option value="Son">Son</option><option value="Spouse">Spouse</option><option value="Step-Daughter">Step-Daughter</option><option value="Step-Son">Step-Son</option></select> </div> </div> </div>'; 
        }
    </script>
</div>