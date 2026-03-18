<!-- resources\views\web\visa-application\fiance-visa\sponsor\other-filings.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceSponsorOtherFilings'), 'id' => 'fianceSponsorOtherFilings', 'files' => true]) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Other Filings</h2>
                    </div>                    
                </div>
                
                <!-- I-130 Question -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Have you ever filed Form I-130, Petition for Alien Relative, for this beneficiary?
                        </label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0">
                                {{ Form::radio('i_130', 'no', @$step->detail['i_130'] == 'no' ? true : (@$step->detail['i_130'] ? '' : true), [
                                    'class' => 'custom-control-input i130Radio'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0">
                                {{ Form::radio('i_130', 'yes', @$step->detail['i_130'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input i130Radio'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="i_130"></div>
                        </div>
                    </div>
                </div>

                <!-- Info Box - Added per Duane's request -->
                <div class="col-md-12 mb-4">
                    <div class="alert" role="alert" style="background-color: #fff9e6; border-color: #ffe69c; color: #664d03;">
                        <h5 class="alert-heading"><strong>Important – Please Read Before Answering</strong></h5>
                        <p class="mb-2">USCIS allows only <strong>two approved K-1 fiancé(e) petitions</strong> in a lifetime.</p>
                        <p class="mb-3">If you are filing another K-1 petition within <strong>2 years</strong> of your previous one, <strong>a waiver is required</strong>.</p>
                        <p class="mb-2"><strong>Please follow these guidelines:</strong></p>
                        <ul class="mb-0">
                            <li>If you have <strong>never filed a K-1 petition before</strong> → Select <strong>No</strong>.</li>
                            <li>If you filed one K-1 petition <strong>more than 2 years ago</strong> → Select <strong>Yes</strong>, then choose <em>"Not applicable, beneficiary is my spouse or I am not a multiple filer."</em> (No waiver is required.)</li>
                            <li>If you filed one K-1 petition <strong>less than 2 years ago</strong> → Select <strong>Yes</strong>, then choose <em>"I am a Multiple Filer, with No Permanent Restraining Orders or Convictions… requesting a General Waiver."</em></li>
                            <li>If you filed <strong>two or more K-1 petitions</strong> in the past → You must select the waiver option that applies to your situation.</li>
                        </ul>
                        <p class="mt-3 mb-0"><small><em>If your previous filing was over 2 years ago and you have no restraining orders or criminal convictions, you are not a multiple filer, and no waiver is needed.</em></small></p>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Have you ever filed Form I-129F, Petition for Alien Fiancé(e) for any other person?
                            <span data-bs-toggle="tooltip" 
                                  data-toggle="tooltip"
                                  data-bs-placement="top"
                                  data-placement="top" 
                                  title="A 'multiple filer' is someone who has filed more than one K-1 petition in the past, or within 2 years of the previous one."
                                  style="cursor: help; color: #0dcaf0; font-weight: bold; font-size: 18px; margin-left: 5px; display: inline-block;">ⓘ</span>
                        </label>
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
                            'class' => 'custom-control-input situationRadio'
                        ]) }}
                        <span class="custom-control-label"></span> I am a Multiple Filer, with No Permanent Restraining Orders or Convictions for a Specified Offense and am requesting a General Waiver.
                    </label>
                    <label class="custom-control custom-radio mb-0 ">
                        {{ Form::radio('situation', 'situation2', @$step->detail['situation'] == 'situation2' ? true : '', [
                            'class' => 'custom-control-input situationRadio'
                        ]) }}
                        <span class="custom-control-label"></span> I am a Multiple Filer, with Prior Permanent Restraining Orders or Criminal Conviction for Specified Offense and am requesting an Extraordinary Circumstances Waiver.
                    </label>
                    <label class="custom-control custom-radio mb-0 ">
                        {{ Form::radio('situation', 'situation3', @$step->detail['situation'] == 'situation3' ? true : '', [
                            'class' => 'custom-control-input situationRadio'
                        ]) }}
                        <span class="custom-control-label"></span> I am a Multiple Filer, with Prior Permanent Restraining Order or Criminal Convictions for Specified Offense Resulting from Domestic Violence and am requesting a Mandatory Waiver.
                    </label>
                    <label class="custom-control custom-radio mb-0 ">
                        {{ Form::radio('situation', 'situation4', @$step->detail['situation'] == 'situation4' ? true : '', [
                            'class' => 'custom-control-input situationRadio'
                        ]) }}
                        <span class="custom-control-label"></span> Not applicable, beneficiary is my spouse or I am not a multiple filer.
                    </label>
                    <div class="situation"></div>
                    
                    <!-- Waiver Document Upload Section -->
                    <div class="col-md-12 waiverUploadSec mt-4" style="display: {{ in_array(@$step->detail['situation'], ['situation1', 'situation2', 'situation3']) ? 'block' : 'none' }};">
                        <div class="alert alert-info">
                            <p class="mb-2"><strong>Waiver Documentation Required</strong></p>
                            <p class="mb-0">Please upload your waiver explanation document (PDF or Word format). This document should detail the circumstances that support your waiver request.</p>
                        </div>
                        <div class="form-group">
                            <label for="waiver_document">Upload Waiver Explanation Document</label>
                            @if(!@$step->detail['waiver_document_path'])
                                <span class="required">*</span>
                            @endif
                            {{ Form::file('waiver_document', [
                                'class' => 'form-control',
                                'accept' => '.pdf,.doc,.docx',
                                'id' => 'waiver_document'
                            ]) }}
                            @if(@$step->detail['waiver_document_path'])
                                <small class="form-text text-success mt-2 d-block">
                                    <i class="fa fa-check-circle"></i> Current file: 
                                    <a href="{{ asset('storage/' . @$step->detail['waiver_document_path']) }}" target="_blank" class="text-primary">
                                        <i class="fa fa-file-pdf"></i> View Document
                                    </a>
                                    <br><em class="text-muted">Upload a new file to replace the existing one.</em>
                                </small>
                                {{ Form::hidden('existing_waiver_document', @$step->detail['waiver_document_path']) }}
                            @endif
                        </div>
                        <div class="waiver_document"></div>
                    </div>

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
        // Initialize Bootstrap tooltips
        $(document).ready(function(){
            // Initialize tooltips - works for both Bootstrap 4 and 5
            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                // Bootstrap 5
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            } else if (typeof $.fn.tooltip !== 'undefined') {
                // Bootstrap 4 or 3
                $('[data-toggle="tooltip"], [data-bs-toggle="tooltip"]').tooltip();
            }

            var state = $('.states').data('state');
            getState(231, state);
            
            var appendPriorSpouse = $('.appendPriorSpouse > .priorSpouseForm').length;
            if (appendPriorSpouse == 2) {
                $('.addPriorSpouse').addClass('d-none');
            }
        });
  
        $(document).on('change', '.i129F', function(){
            if ($(this).val() == 'yes') {
                $('.i129FSec').show();
            } else {
                $('.i129FSec').hide();
                $('.waiverUploadSec').hide();
            }
        });

        // Handle situation radio button changes
        $(document).on('change', '.situationRadio', function(){
            var selectedSituation = $(this).val();
            
            // Show waiver upload for situation1, situation2, situation3
            if (selectedSituation === 'situation1' || selectedSituation === 'situation2' || selectedSituation === 'situation3') {
                $('.waiverUploadSec').show();
            } else {
                // Hide waiver upload for situation4 (Not applicable)
                $('.waiverUploadSec').hide();
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
            

        $(document).on('change', '.i130Radio', function(){
            // No conditional section needed; just record the answer
        });

        $("#fianceSponsorOtherFilings").validate({
            rules: {
                i_130: {
                    required: true,
                },
                i_129F: {
                    required: true,
                },
                situation: {
                    required: true,
                },
                waiver_document: {
                    required: function() {
                        var situation = $('input[name="situation"]:checked').val();
                        var hasExisting = $('input[name="existing_waiver_document"]').length > 0;
                        // Only require if waiver situation selected AND no existing file
                        return (situation === 'situation1' || situation === 'situation2' || situation === 'situation3') && !hasExisting;
                    },
                    extension: "pdf|doc|docx"
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
                if (element.attr("name") == "i_130" || element.attr("name") == "i_129F" || element.attr("name") == "situation" || element.attr("name") == "previous_filing" || element.attr("name") == "approved_i_129F" || element.attr("name") == "previously_filed") {
                    error.appendTo($("."+element.attr("name")));
                } else if (element.attr("name") == "waiver_document") {
                    error.appendTo($(".waiver_document"));
                } else {
                    error.insertAfter(element);
                }               
            },
            messages: {
               i_130: "Please choose option!",
               i_129F: "Please choose option!",                                                                   
               situation: "Please choose option!",
               waiver_document: {
                   required: "Please upload a waiver explanation document!",
                   extension: "Only PDF, DOC, or DOCX files are allowed!"
               },                                             
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
                
                var formData = new FormData(form);
                
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceSponsorOtherFilings') }}",
                    data: formData,
                    processData: false,
                    contentType: false,
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
                            $('#fianceSponsorOtherFilingsBtn').html('Save & Continue');                           
                        }
                    },
                    error: function() {
                        $('#fianceSponsorOtherFilingsBtn').html('Save & Continue');
                        toastr.error('An error occurred. Please try again.');
                    }
                });
               return false;
            }
        });

        function filedPetitionHtml(index) {
            datePicker();
            getState(231);
            return `{!! addslashes(view('web.component.fiance-sponsor.filed-petition')->with(['index' => '${index}'])->render()) !!}`;
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