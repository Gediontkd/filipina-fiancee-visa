<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienRelative'), 'id' => 'fianceAlienRelative']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Relatives</h2>
                    </div>
                </div>                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you, the Alien, have a Child, Brother or Sister living in the United States? Do not include step children.</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('sibling_living_in_us', 'no', @$step->detail['sibling_living_in_us'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input siblingLiving'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('sibling_living_in_us', 'yes', @$step->detail['sibling_living_in_us'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input siblingLiving'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="sibling_living_in_us"></div>
                    </div>
                </div>                
                <div class="col-md-12 siblingLivingNoSec" style="display: {{ @$step->detail['sibling_living_in_us'] == 'no' ? 'block' : 'none' }};">
                    <div class="form-group">
                        <label>Do you, the Alien, have any other relatives in the United States? Not counting parents, siblings, children or in-laws.</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('relative_living_in_us', 'no', @$step->detail['relative_living_in_us'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('relative_living_in_us', 'yes', @$step->detail['relative_living_in_us'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="relative_living_in_us"></div>
                    </div>
                </div>  
                <div class="col-md-12 siblingLivingYesSec" style="display: {{ @$step->detail['sibling_living_in_us'] == 'yes' ? 'block' : 'none' }};">
                    <div class="appendRelative">                        
                        @if (empty($step->detail["relative_f_and_name1"]))
                            @include('web.component.relative', [
                                'index' => 1,
                                'data' => @$step->detail,
                            ])
                        @endif
                        @for ($i = 1; $i <= 5; $i++)
                            @if (isset($step->detail["relative_f_and_name$i"]))
                                @include('web.component.relative', [
                                    'index' => $i,
                                    'data' => @$step->detail,
                                ])                       
                            @endif
                        @endfor
                    </div>                                      
                    <div class="col-md-6 mb-4">
                        <a class="btn btn-tra-grey addRelativeBtn">+ Add Another Relative</a>
                    </div>  
                </div>             
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'relatives') !!}
        {!! Form::hidden('next', 'question1') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'languages'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'question1'
        ]) }}
         {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienRelativeBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $(document).on('click', '.siblingLiving', function(){
            if ($(this).val() == 'no') {
                $('.siblingLivingYesSec').hide();
                $('.siblingLivingNoSec').show();
            } else {
                $('.siblingLivingNoSec').hide();
                $('.siblingLivingYesSec').show();
            }
        });

        $(document).ready(function(){
            var index = $('.appendRelative > .appendRelativeForm').length;
            if (index == 5) {
                $('.addRelativeBtn').addClass('d-none');
            }
        })

        $("#fianceAlienRelative").validate({
            rules: {
                sibling_living_in_us: {
                    required: true,
                },
                relative_living_in_us: {
                    required: true,
                },
                relative_f_and_name1: {
                    required: true,
                },
                relative_l_and_name1: {
                    required: true,
                },  
                relationship1: {
                    required: true,
                },
                relative_status1: {
                    required: true,
                }, 
                relative_f_and_name2: {
                    required: true,
                },
                relative_l_and_name2: {
                    required: true,
                },  
                relationship2: {
                    required: true,
                },
                relative_status2: {
                    required: true,
                },  
                relative_f_and_name3: {
                    required: true,
                },
                relative_l_and_name3: {
                    required: true,
                },  
                relationship3: {
                    required: true,
                },
                relative_status3: {
                    required: true,
                },
                relative_f_and_name4: {
                    required: true,
                },
                relative_l_and_name4: {
                    required: true,
                },  
                relationship4: {
                    required: true,
                },
                relative_status4: {
                    required: true,
                },
                relative_f_and_name5: {
                    required: true,
                },
                relative_l_and_name5: {
                    required: true,
                },  
                relationship5: {
                    required: true,
                },
                relative_status5: {
                    required: true,
                },
            },
            messages: {
               sibling_living_in_us: "Please choose option!",               
               relative_living_in_us: "Please choose option!",               
               relative_f_and_name1: "Please enter name!",               
               relative_l_and_name1: "Please enter name!",               
               relationship1: "Please choose option!",               
               relative_status1: "Please choose option!", 
               relative_f_and_name2: "Please enter name!",               
               relative_l_and_name2: "Please enter name!",               
               relationship2: "Please choose option!",               
               relative_status2: "Please choose option!",
               relative_f_and_name3: "Please enter name!",               
               relative_l_and_name3: "Please enter name!",               
               relationship3: "Please choose option!",               
               relative_status3: "Please choose option!", 
               relative_f_and_name4: "Please enter name!",               
               relative_l_and_name4: "Please enter name!",               
               relationship4: "Please choose option!",               
               relative_status4: "Please choose option!", 
               relative_f_and_name5: "Please enter name!",               
               relative_l_and_name5: "Please enter name!",               
               relationship5: "Please choose option!",               
               relative_status5: "Please choose option!",               
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "sibling_living_in_us" || element.attr("name") == "relative_living_in_us") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $('#fianceAlienRelativeBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienRelative') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activerelatives').removeClass('active');
                            $('.activequestion1').addClass('active');
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

        function relativeForm(index) {
            return '<div class="row appendRelativeForm"> <div class="col-md-6 mb-3"> <a class="btn btn-tra-grey removeRelativeBtn">- Remove</a> </div> <h5>Relative '+index+'</h5> <div class="col-md-12"> <div class="form-group"> <label for="relative_f_and_name'+index+'">Relatives First and Middle Name</label> <span class="required">*</span> <input class="form-control disablePastDate" placeholder="Enter Name" name="relative_f_and_name'+index+'" type="text" id="relative_f_and_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="relative_l_and_name'+index+'">Relatives Last Name (family name)</label> <span class="required">*</span> <input class="form-control disablePastDate" placeholder="Enter Last Name" name="relative_l_and_name'+index+'" type="text" id="relative_l_and_name'+index+'"> <span>If there is a suffix after the name such as Jr. or III, put that here after the last name.</span> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="relationship'+index+'">Aliens relationship to this person.</label> <span class="required">*</span> <select class="form-control" id="relationship'+index+'" name="relationship'+index+'"><option value="" selected="selected">Select One</option><option value="Son">Son</option><option value="Daughter">Daughter</option><option value="Brother">Brother</option><option value="Sister">Sister</option></select> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="relative_status'+index+'">Relative Status</label> <span class="required">*</span> <select class="form-control" id="relative_status'+index+'" name="relative_status'+index+'"><option value="" selected="selected">Select One</option><option value="U.S. Citizen">U.S. Citizen</option><option value="U.S. Legal Permanent Resident (LPR)">U.S. Legal Permanent Resident (LPR)</option><option value="NonImmigrant">NonImmigrant</option><option value="Other - Dont Know">Other - Dont Know</option></select> </div> </div> </div>';
        }
    </script>
</div>