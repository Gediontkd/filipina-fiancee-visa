<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienMilitary'), 'id' => 'fianceAlienMilitary']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>All questions are about the Alien (foreign citizen).</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you have any specialized skills or training, such as firearms, explosives, nuclear, biological, or chemical experience? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('specialized_skill', 'no', @$step->detail['specialized_skill'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input specializedSkill'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('specialized_skill', 'yes', @$step->detail['specialized_skill'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input specializedSkill'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="specialized_skill"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 specializedSkillSec" style="display: {{ @$step->detail['specialized_skill'] == 'yes' ? 'block' : 'none'  }};">
                    <div class="form-group">
                        {{ Form::label('explain_skill', "Explain all specialized skills.") }}
                        <span class="required">*</span>
                        {{ Form::textarea('explain_skill', @$step->detail['explain_skill'], ['class' => 'form-control', 'rows' => 4]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Has the alien ever served in the military? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('served_military', 'no', @$step->detail['served_military'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input servedMilitary'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('served_military', 'yes', @$step->detail['served_military'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input servedMilitary'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="served_military"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 servedMilitarySec" style="display: {{ @$step->detail['served_military'] == 'yes' ? 'block' : 'none'  }};">
                    <div class="appendMilitarySec">
                        @if (empty($step->detail["country_military_service1"]))
                            @include('web.component.military-service', [
                                'index' => 1,
                                'sec' => '',
                                'data' => @$step->detail,
                            ])
                        @endif                   
                        @php
                            $i = '';
                        @endphp
                        @for ($i = 1; $i <= 2; $i++)
                            @if (isset($step->detail["country_military_service$i"]))
                                @include('web.component.military-service', [
                                    'index' => $i,
                                    'sec' => '',
                                    'data' => @$step->detail,
                                ])                         
                            @endif
                        @endfor
                    </div>                                        
                    <div class="pb-4">
                        <a class="btn btn-tra-grey servedMilitarySecBtn">+ Add another military service</a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Has the alien been a participant or victim in an armed conflict? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('participant', 'no', @$step->detail['participant'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input participant'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('participant', 'yes', @$step->detail['participant'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input participant'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="participant"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 participantSec" style="display: {{ @$step->detail['participant'] == 'yes' ? 'block' : 'none'  }};">
                    <div class="form-group">
                        {{ Form::label('explain_involvement', "Explain alien's involvement in this conflict") }}
                        <span class="required">*</span>
                        {{ Form::textarea('explain_involvement', @$step->detail['explain_involvement'], ['class' => 'form-control', 'rows' => 4]) }}
                    </div>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'military') !!}
        {!! Form::hidden('next', 'activity') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'travel'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'activity'
        ]) }}
         {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienMilitaryBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            var militaryForm = $('.appendMilitarySec > .servedMilitaryForm').length;
            if (militaryForm == 2) {
                $('.servedMilitarySecBtn').addClass('d-none');
            }            
        });

        $(document).on('click', '.specializedSkill', function(){
            if ($(this).val() == 'yes') {
                $('.specializedSkillSec').show();
            } else {
                $('.specializedSkillSec').hide();
            }
        });

        $(document).on('click', '.servedMilitary', function(){
            if ($(this).val() == 'yes') {
                $('.servedMilitarySec').show();
            } else {
                $('.servedMilitarySec').hide();
            }
        });

        $(document).on('click', '.participant', function(){
            if ($(this).val() == 'yes') {
                $('.participantSec').show();
            } else {
                $('.participantSec').hide();
            }
        });        

        $("#fianceAlienMilitary").validate({
            rules: {
                specialized_skill: {
                    required: true,
                },
                explain_skill: {
                    required: true,
                },
                served_military: {
                    required: true,
                },
                country_military_service1: {
                    required: true,
                },
                branch_military_service1: {
                    required: true,
                },
                rank_position1: {
                    required: true,
                },
                military_specialty1: {
                    required: true,
                },
                start_date1: {
                    required: true,
                },
                end_date1: {
                    required: true,
                },
                country_military_service2: {
                    required: true,
                },
                branch_military_service2: {
                    required: true,
                },
                rank_position2: {
                    required: true,
                },
                military_specialty2: {
                    required: true,
                },
                start_date2: {
                    required: true,
                },
                end_date2: {
                    required: true,
                },
                participant: {
                    required: true,
                },
                explain_involvement: {
                    required: true,
                },
            },
            messages: {
               specialized_skill: "Please choose option!",
               explain_skill: "Please explain!",
               served_military: "Please choose option!",
               country_military_service1: "Please choose country!",
               branch_military_service1: "Please enter branch service!",
               rank_position1: "Please enter position!",
               military_specialty1: "Please enter military specialty!",
               start_date1: "Please enter date!",
               end_date1: "Please enter date!",
               country_military_service2: "Please choose country!",
               branch_military_service2: "Please enter branch service!",
               rank_position2: "Please enter position!",
               military_specialty2: "Please enter military specialty!",
               start_date2: "Please enter date!",
               end_date2: "Please enter date!",
               participant: "Please choose option!",
               explain_involvement: "Please enplain!",
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "specialized_skill" || element.attr("name") == "served_military" || element.attr("name") == "participant") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $('#fianceAlienMilitaryBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienMilitary') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activemilitary').removeClass('active');
                            $('.activeactivity').addClass('active');
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

        function militaryService(index) {
            return '<div class="row servedMilitaryForm"><div class="pb-4"><a class="btn btn-tra-grey removeMilitaryBtn">- Remove</a></div><h4>Military Service #'+index+'</h4> <div class="col-md-6"> <div class="form-group"> <label for="country_military_service'+index+'">Country of military service</label><span class="required">*</span> <select class="form-control" id="country_military_service'+index+'" name="country_military_service'+index+'"><option value="">-Select Country-</option>@foreach(getCountry() as $country)</option><option value="{{ $country->id }}">{{ $country->name }}</option>@endforeach</select> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="branch_military_service'+index+'">Branch of military service</label><span class="required">*</span> <span class="required">*</span> <input class="form-control" placeholder="Enter Branch" name="branch_military_service'+index+'" value="test" id="branch_military_service'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="rank_position'+index+'">Rank or position</label><span class="required">*</span> <span class="required">*</span> <input class="form-control" placeholder="Enter Rank or position" name="rank_position'+index+'" type="text" id="rank_position'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="military_specialty'+index+'">Military specialty</label><span class="required">*</span> <span class="required">*</span> <input class="form-control" placeholder="Enter Military specialty" name="military_specialty'+index+'" type="text" id="military_specialty'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="start_date'+index+'">Start Date mm/dd/yyyy </label><span class="required">*</span> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="Enter Date" name="start_date'+index+'" type="text" id="start_date'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="end_date'+index+'">End Date mm/dd/yyyy </label><span class="required">*</span> <span class="required">*</span> <input class="form-control disablePastDate" placeholder="Enter Date" name="end_date'+index+'" type="text" id="end_date'+index+'"> </div> </div> </div>';
        }        
    </script>
</div>