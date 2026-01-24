<!-- resources\views\web\visa-application\adjustment-of-status\questions-part-5.blade.php -->
<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentQusPart5'), 'id' => 'adjustmentQusPart5']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>All questions are about the Alien (foreign citizen).</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you plan to practice polygamy in the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('polygamy', 'no', @$step->detail['polygamy'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'foreignNatSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('polygamy', 'yes', @$step->detail['polygamy'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'foreignNatSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="polygamy"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 foreignNatSec" style="display: {{ @$step->detail['polygamy'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('polygamy_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('polygamy_text', @$step->detail['polygamy_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you accompanying another foreign national who requires your protection or guardianship but who is inadmissible after being certified by a medical officer as being helpless from sickness, physical or mental disability, or infancy, as described in INA section 232(c)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('accompanying', 'no', @$step->detail['accompanying'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'accompanyingSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('accompanying', 'yes', @$step->detail['accompanying'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'accompanyingSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="prostitution"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 accompanyingSec" style="display: {{ @$step->detail['accompanying'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('accompanying_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('accompanying_text', @$step->detail['accompanying_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>       
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever assisted in detaining, retaining, or withholding custody of a U.S. citizen who has been granted custody of the child?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('custody', 'no', @$step->detail['custody'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'custodySec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('custody', 'yes', @$step->detail['custody'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'custodySec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="custody"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 custodySec" style="display: {{ @$step->detail['custody'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('custody_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('custody_text', @$step->detail['custody_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever voted in violation of any federal, state, or local constitutional provision, statute, ordinance, or regulation in the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('federal', 'no', @$step->detail['federal'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'federalSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('federal', 'yes', @$step->detail['federal'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'federalSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="federal"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 federalSec" style="display: {{ @$step->detail['federal'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('federal_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('federal_text', @$step->detail['federal_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever renounced U.S. citizenship to avoid being taxed by the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('renounced', 'no', @$step->detail['renounced'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'renouncedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('renounced', 'yes', @$step->detail['renounced'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'renouncedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="renounced"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 renouncedSec" style="display: {{ @$step->detail['federal'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('renounced_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('renounced_text', @$step->detail['renounced_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>                               
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever applied for exemption or discharge from training or service in the U.S. armed forces or in the U.S. National Security Training Corps on the ground that you are a foreign national?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('discharge', 'no', @$step->detail['discharge'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'dischargeSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('discharge', 'yes', @$step->detail['discharge'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'dischargeSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="discharge"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 dischargeSec" style="display: {{ @$step->detail['discharge'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('discharge_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('discharge_text', @$step->detail['discharge_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been relieved or discharged from such training or service on the ground that you are a foreign national?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('discharged', 'no', @$step->detail['discharged'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'dischargedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('discharged', 'yes', @$step->detail['discharged'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'dischargedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="discharged"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 dischargedSec" style="display: {{ @$step->detail['discharged'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('discharged_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('discharged_text', @$step->detail['discharged_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been convicted of desertion from the U.S. armed forces?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('convicted', 'no', @$step->detail['convicted'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'convictedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('convicted', 'yes', @$step->detail['convicted'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'convictedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="convicted"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 convictedSec" style="display: {{ @$step->detail['convicted'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('convicted_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('convicted_text', @$step->detail['convicted_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever left or remained outside the United States to avoid or evade training or service in the U.S. armed forces in time of war or a period declared by the President to be a national emergency?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('war', 'no', @$step->detail['war'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'warSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('war', 'yes', @$step->detail['war'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'warSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="war"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 warSec" style="display: {{ @$step->detail['war'] == 'yes' ? 'block' : 'none' }};">
                    <div class="form-group">
                        {{ Form::label('war_text', 'Explain why you answered Yes to this question and provide details.') }}
                        <span class="required">*</span>
                        {{ Form::textarea('war_text', @$step->detail['war_text'], ['class' => 'form-control', 'rows' => 4]) }}                        
                    </div>
                    <div class="form-group">
                        {{ Form::label('war_input', 'If your answer to the Previous question is YES, what was your nationality or immigration status immediately before you left (for example, U.S. citizen or national, lawful permanent resident, nonimmigrant, parolee, present without admission or parole, or any other status)? ') }}
                        <span class="required">*</span>
                        {{ Form::text('war_input', @$step->detail['war_input'], ['class' => 'form-control']) }}                        
                    </div>
                </div>                                               
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'questions-part-5') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'ead') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'questions-part-4'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'ead'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentQusPart5Btn',
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
        
        $("#adjustmentQusPart5").validate({
            rules: {
                polygamy: {
                    required: true,
                },
                polygamy_text: {
                    required: true,
                },
                accompanying: {
                    required: true,
                },
                accompanying_text: {
                    required: true,
                },
                custody: {
                    required: true,
                },
                custody_text: {
                    required: true,
                },
                federal: {
                    required: true,
                },
                federal_text: {
                    required: true,
                },
                renounced: {
                    required: true,
                },
                renounced_text: {
                    required: true,
                },
                discharge: {
                    required: true,
                },
                discharge_text: {
                    required: true,
                },
                discharged: {
                    required: true,
                },
                discharged_text: {
                    required: true,
                },
                convicted: {
                    required: true,
                },
                convicted_text: {
                    required: true,
                },
                war: {
                    required: true,
                },
                war_text: {
                    required: true,
                },
                war_input: {
                    required: true,
                },                
            },
            errorPlacement: function (error, element) {
                var name = element.attr("name");
                if (name == "polygamy" || name == "accompanying" || name == "custody" || name == "federal" || name == "renounced" || name == "discharge" || name == "discharged" || name == "convicted" || name == "war") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               polygamy: "Please choose option!",               
               polygamy_text: "Please enter detail!",
               accompanying: "Please choose option!",               
               accompanying_text: "Please enter detail!",
               custody: "Please choose option!",               
               custody_text: "Please enter detail!", 
               federal: "Please choose option!",               
               federal_text: "Please enter detail!",
               renounced: "Please choose option!",               
               renounced_text: "Please choose option!",               
               discharge: "Please choose option!",               
               discharge_text: "Please enter detail!", 
               discharged: "Please choose option!",               
               discharged_text: "Please enter detail!",
               war: "Please choose option!",               
               war_text: "Please enter detail!",
               war_input: "Please enter detail!",
               convicted: "Please choose option!",               
               convicted_text: "Please enter detail!",                              
            },
            submitHandler: function(form) {
                $('#adjustmentQusPart5Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentQusPart5') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.questions-part-5').removeClass('active');
                            $('.ead').addClass('active');
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
    </script>   
</div>