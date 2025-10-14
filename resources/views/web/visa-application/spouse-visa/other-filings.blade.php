<!-- resources\views\web\visa-application\spouse-visa\other-filings.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseOtherFiling'), 'id' => 'spouseOtherFiling']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Other Filings</h2>
                    </div>                    
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever filed for this person before or any other alien before, including an Adjustment of Status, Fiancée Visa, Spousal Visa or any other immigration benefit for a husband or wife or partner?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('filed_petition', 'no', @$step->detail['filed_petition'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input filedPetition'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('filed_petition', 'yes', @$step->detail['filed_petition'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input filedPetition'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                        </div>
                    </div>
                </div>                
                <div class="filed_petition"></div>                
                <div class="filedPetitionSec" style="display:{{ @$step->detail['filed_petition'] == 'yes' ? 'block' : 'none' }};">
                    <div class="row appendfiledPetition">                       
                        @for ($i = 1; $i <= 5; $i++)
                            @if (isset($step->detail["alien_fname$i"]))
                                @include('web.component.filed-petition', [
                                    'index' => $i,
                                    'data' => @$step->detail,
                                ])                      
                            @endif
                        @endfor                       
                    </div>                                   
                    <div class="col-md-6 mb-4">
                        <a class="btn btn-tra-grey addFiledPetition">+ Add Another Filed Petition</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Are you submitting separate petitions for a different relative (including children) right now, at the same time, or do you already have separate petitions filed but not yet approved for a different relative?</label>
                    <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0 ">
                            {{ Form::radio('relative', 'no', @$step->detail['relative'] == 'no' ? true : '', [
                                'class' => 'custom-control-input relative'
                            ]) }}
                            <span class="custom-control-label"></span> No
                        </label>
                        <label class="custom-control custom-radio mb-0 ">
                            {{ Form::radio('relative', 'yes', @$step->detail['relative'] == 'yes' ? true : '', [
                                'class' => 'custom-control-input relative'
                            ]) }}
                            <span class="custom-control-label"></span> Yes
                        </label>                          
                    </div>
                </div>
            </div>
            <div class="col-md-12 relativeSec" style="display:{{ @$step->detail['relative'] == 'yes' ? 'block' : 'none' }};">
               <div class="appendRelative">                                       
                    @for ($i = 1; $i <= 9; $i++)
                        @if (isset($step->detail["fl_name$i"]))
                            @include('web.component.spouse-relative', [
                                'index' => $i,
                                'data' => @$step->detail,
                            ])                      
                        @endif                        
                    @endfor
                </div>                                   
                <div class="col-md-6 mb-4">
                    <a class="btn btn-tra-grey addRelative"> + Add Another Relationship</a>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'other-filings') !!}
        {!! Form::hidden('next', 'military-convictions') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'marital-status'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'military-convictions'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseOtherFilingBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">        
        $(document).ready(function(){
            var appendPriorSpouse = $('.appendPriorSpouse > .priorSpouseForm').length;
            if (appendPriorSpouse == 2) {
                $('.addPriorSpouse').addClass('d-none');
            }            
        });

        $(document).ready(function(){
            // getState($('.countryId').val());
            getState(231);
        });

        // $(document).on('change', '.countryId', function(){
        //     // var countryId = $(this).val();
        //     getState(231);
        // });

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

        $("#spouseOtherFiling").validate({
            rules: {
                filed_petition: {
                    required: true,
                },
                relative: {
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
                fl_name1: {
                    required: true,
                },
                gf_name1: {
                    required: true,
                },
                m_name1: {
                    required: true,
                },
                relationship1: {
                    required: true,
                },
                fl_name2: {
                    required: true,
                },
                gf_name2: {
                    required: true,
                },
                m_name2: {
                    required: true,
                },
                relationship2: {
                    required: true,
                },
                fl_name3: {
                    required: true,
                },
                gf_name3: {
                    required: true,
                },
                m_name3: {
                    required: true,
                },
                relationship3: {
                    required: true,
                },
                fl_name4: {
                    required: true,
                },
                gf_name4: {
                    required: true,
                },
                m_name4: {
                    required: true,
                },
                relationship4: {
                    required: true,
                },
                fl_name5: {
                    required: true,
                },
                gf_name5: {
                    required: true,
                },
                m_name5: {
                    required: true,
                },
                relationship5: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "filed_petition" || element.attr("name") == "relative") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }               
            },
            messages: {
               filed_petition: "Please choose option!",                           
               relative: "Please choose option!",                           
               alien_fname1: "Please enter name!",                           
               alien_mname1: "Please enter name!",                           
               alien_mlname1: "Please enter name!",                           
               alien_reg_no1: "Please enter number!",                           
               alien_city_filing1: "Please enter address!",                           
               us_State1: "Please enter address!",                           
               date_of_filing1: "Please enter date!",                           
               results_of_App1: "Please choose option!",   
               alien_fname2: "Please enter name!",                           
               alien_mname2: "Please enter name!",                           
               alien_mlname2: "Please enter name!",                           
               alien_reg_no2: "Please enter number!",                           
               alien_city_filing2: "Please enter address!",                           
               us_State2: "Please enter address!",                           
               date_of_filing2: "Please enter date!",                           
               results_of_App2: "Please choose option!",  
               alien_fname3: "Please enter name!",                           
               alien_mname3: "Please enter name!",                           
               alien_mlname3: "Please enter name!",                           
               alien_reg_no3: "Please enter number!",                           
               alien_city_filing3: "Please enter address!",                           
               us_State3: "Please enter address!",                           
               date_of_filing3: "Please enter date!",                           
               results_of_App3: "Please choose option!",                           
               fl_name1: "Please enter name!",                           
               gf_name1: "Please enter name!",                           
               m_name1: "Please enter name!",                           
               relationship1: "Please choose option!", 
               fl_name2: "Please enter name!",                           
               gf_name2: "Please enter name!",                           
               m_name2: "Please enter name!",                           
               relationship2: "Please choose option!",
               fl_name3: "Please enter name!",                           
               gf_name3: "Please enter name!",                           
               m_name3: "Please enter name!",                           
               relationship3: "Please choose option!",
               fl_name4: "Please enter name!",                           
               gf_name4: "Please enter name!",                           
               m_name4: "Please enter name!",                           
               relationship4: "Please choose option!",
               fl_name5: "Please enter name!",                           
               gf_name5: "Please enter name!",                           
               m_name5: "Please enter name!",                           
               relationship5: "Please choose option!",                           
            },
            submitHandler: function(form) {
                $('#spouseOtherFilingBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('spouseOtherFiling') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.other-filings').removeClass('active');
                            $('.military-convictions').addClass('active');
                            $('.spouseVisaForm').html(data.data);                    
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
            var removeBtn = '';
            if (index != 1) {
                removeBtn = '<div class="col-md-6 mb-4"> <a class="btn btn-tra-grey removefiledPetition">- Remove #</a> </div>';
            }
            return '<div class="row filedPetitionForm">'+removeBtn+'<div class="col-md-12"> <div class="form-group"> <label for="alien_fname'+index+'">Aliens First Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="alien_fname'+index+'" type="text" id="alien_fname'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="alien_mname'+index+'">Aliens Middle Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="alien_mname'+index+'" type="text" id="alien_mname'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="alien_mlname'+index+'">Aliens Maiden Last Name (family name)</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="alien_mlname'+index+'" type="text" id="alien_mlname'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="alien_reg_no'+index+'">Alien Registration Number or A#. Do not include the "A" or #.</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Number" name="alien_reg_no'+index+'" type="text" id="alien_reg_no'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="alien_city_filing'+index+'">City of Filing</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Number" name="alien_city_filing'+index+'" type="text" id="alien_city_filing'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="us_State'+index+'">U.S. State (Select Does Not Apply if not USA)</label> <span class="required">*</span> <select class="form-control states" name="us_State'+index+'"><option value="">-Select Country-</option></select> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="date_of_filing'+index+'">Date of Filing (mm/dd/yyyy, okay to estimate)</label> <span class="required">*</span> <input class="form-control datePicker" placeholder="Enter Date" name="date_of_filing'+index+'" type="text" id="date_of_filing'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="results_of_App'+index+'">Results of Application</label> <span class="required">*</span> <select class="form-control" id="results_of_App'+index+'" name="results_of_App'+index+'"><option value="" selected="selected">Select</option><option value="Approved, divorced and still in USA.">Approved, divorced and still in USA.</option><option value="Approved, divorced left USA.">Approved, divorced left USA.</option><option value="Approved, divorced location unknown.">Approved, divorced location unknown.</option><option value="Approved but now deceased.">Approved but now deceased.</option><option value="Approved, never came to USA.">Approved, never came to USA.</option><option value="Approved, waiting for a Visa.">Approved, waiting for a Visa.</option><option value="Approved, still in USA.">Approved, still in USA.</option><option value="Approved, no longer in USA.">Approved, no longer in USA.</option><option value="Denied, still in USA.">Denied, still in USA.</option><option value="Denied, no longer in USA.">Denied, no longer in USA.</option><option value="Denied, never came to USA">Denied, never came to USA</option><option value="Denied, location unknown.">Denied, location unknown.</option><option value="Denied and now deceased.">Denied and now deceased.</option><option value="Withdrawn before approval.">Withdrawn before approval.</option><option value="Withdrawn due to death.">Withdrawn due to death.</option><option value="Status Unknown. Location Unknown.">Status Unknown. Location Unknown.</option></select> </div> </div> </div>'; 
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