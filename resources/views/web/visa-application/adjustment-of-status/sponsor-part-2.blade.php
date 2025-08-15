<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentSponsorPart2'), 'id' => 'adjustmentSponsorPart2']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>Sponsor's Information Part 2, Sponsor's Marital Status</h2>
                <p>The sponsor is the U.S. citizen relative of the Alien.</p>
            </div>
            <div class="row">               
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Was the sponsor ever married prior to the current marriage?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio("married_prior", 'no', @$step->detail['married_prior'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input marriedPrior'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio("married_prior", 'yes', @$step->detail['married_prior'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input marriedPrior'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="married_prior"></div>
                    </div>
                </div>
                <div class="col-md-12 marriedPriorSec" style="display: none;">
                    <h4>Enter Prior Spouse Information. Space is limited to match USCIS forms. Abbreviate as necessary.</h4>
                    <div class="appendPriorSpouse">
                        @if (empty($step->detail["maiden_lname1"]))
                            @include('web.component.prior-spouse', [
                                'index' => 1,
                                'sec' => '',
                                'data' => @$step->detail,
                            ])    
                        @endif                      
                        @for ($i = 1; $i <= 2; $i++)
                            @if (isset($step->detail["maiden_lname$i"]))
                                @include('web.component.prior-spouse', [
                                    'index' => $i,
                                    'sec' => '',
                                    'data' => @$step->detail,
                                ])                            
                            @endif
                        @endfor
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-tra-grey addPriorSpouse">+ Add second prior spouse</a>
                    </div>
                </div>
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'sponsor-part-2') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'question-part-1') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'sponsor-part-1'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'question-part-1'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentSponsorPart2Btn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('change', '.marriedPrior', function(){
            if ($(this).val() == 'yes') {
                $('.marriedPriorSec').show();
            } else {
                $('.marriedPriorSec').hide();
            }
        });        

        $("#adjustmentSponsorPart2").validate({
            rules: {
                married_prior: {
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
                date_of_marriage1: {
                    required: true,
                },
                place_of_marriage1: {
                    required: true,
                },
                place_marriage_ended1: {
                    required: true,
                },
                date_marriage_ended1: {
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
                date_of_marriage2: {
                    required: true,
                },
                place_of_marriage2: {
                    required: true,
                },
                place_marriage_ended2: {
                    required: true,
                },
                date_marriage_ended2: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "married_prior") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               married_prior: "Please choose option!",                                       
               maiden_lname1: "Please enter name!",                                       
               middle_name1: "Please enter name!",                                       
               first_name1: "Please enter name!",                                       
               dob1: "Please enter date!",                                       
               date_of_marriage1: "Please enter date!",                                       
               place_of_marriage1: "Please enter place!",                                       
               place_marriage_ended1: "Please enter place!",                       
               date_marriage_ended1: "Please enter date!",
               maiden_lname2: "Please enter name!",                                       
               middle_name2: "Please enter name!",                                       
               first_name2: "Please enter name!",                                       
               dob2: "Please enter date!",                                       
               date_of_marriage2: "Please enter date!",                                       
               place_of_marriage2: "Please enter place!",                                       
               place_marriage_ended2: "Please enter place!",                       
               date_marriage_ended2: "Please enter date!",                                       
            },
            submitHandler: function(form) {
                $('#adjustmentSponsorPart2Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentSponsorPart2') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.sponsor-part-2').removeClass('active');
                            $('.question-part-1').addClass('active');
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

        function priorSpouseHtml(index) {
            datePicker();
            var removeBtn = '';
            if (index != 1) {
                removeBtn = '<div class="col-md-6 mb-4"> <a class="btn btn-tra-grey removePriorSpouse">- Remove #'+index+' prior spouse</a> </div>';
            }
            return '<div class="priorSpouseForm"> '+removeBtn+' <h5>Prior Spouse #'+index+'</h5> <div class="row"> <div class="col-md-4"> <div class="form-group"> <label for="maiden_lname'+index+'">Maiden Last Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="maiden_lname'+index+'" type="text" value="" id="maiden_lname'+index+'"> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="middle_name'+index+'">Middle Name</label> <span class="required">*</span> <input class="form-control middleMame'+index+'" placeholder="Enter name" name="middle_name'+index+'" type="text" value="" id="middle_name'+index+'"><label for="middleMame'+index+'">Does Not Apply</label><input class="custom-control-input doesNotApply" data-field="middleMame'+index+'" type="checkbox"></div> </div> <div class="col-md-4"> <div class="form-group"> <label for="first_name'+index+'">First Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="first_name'+index+'" type="text" value="" id="first_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="dob'+index+'">Date of Birth (mm/dd/yyyy, okay to estimate or enter Unknown)</label> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="Enter Date of Birth" name="dob'+index+'" type="text" value="" id="dob'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="date_of_marriage'+index+'">Date of Marriage</label> <span class="required">*</span> <input class="form-control datePicker" placeholder="Enter Date Of Marriage" name="date_of_marriage'+index+'" type="text" value="" id="date_of_marriage'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="place_of_marriage'+index+'">Place of Marriage</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Place of Marriage" name="place_of_marriage'+index+'" type="text" value="" id="place_of_marriage'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="date_marriage_ended'+index+'">Date Marriage Ended</label> <span class="required">*</span> <input class="form-control datePicker" placeholder="Enter Date Marriage Ended" name="date_marriage_ended'+index+'" type="text" value="" id="date_marriage_ended'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="place_marriage_ended'+index+'">Place Marriage Ended </label> <span class="required">*</span> <input class="form-control" placeholder="Enter Place Marriage Ended" name="place_marriage_ended'+index+'" type="text" value="" id="place_marriage_ended'+index+'"> </div> </div> </div> </div>'; 
        }  
    </script>   
</div>