<!-- resources\views\web\visa-application\adjustment-of-status\accommodations.blade.php -->
<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentAccommodation'), 'id' => 'adjustmentAccommodation']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>All questions are about the Alien (foreign citizen).</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>If required to attend an interview with the USCIS, will you need accommodations because of a disability(ies) and/or impairment(s)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('accommodation', 'no', @$step->detail['accommodation'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'accommodationsSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('accommodation', 'yes', @$step->detail['accommodation'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'accommodationsSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="accommodation"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 accommodationsSec" style="display: {{ @$step->detail['accommodation'] == 'yes' ? 'block' : 'none' }};">
                    <label>Check all boxes that apply:</label>
                    <div class="col-md-12">
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::checkbox('hard_hearing', true, @$step->detail['hard_hearing'] == true ? true : '', [
                                'class' => 'custom-control-input checkBox',
                                'data-sec' => 'hardHearingSec'
                            ]) }}
                            <span class="custom-control-label"></span> I am deaf or hard of hearing.
                        </label>                                
                    </div>
                    <div class="col-md-12">
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::checkbox('blind', true, @$step->detail['blind'] == true ? true : '', [
                                'class' => 'custom-control-input checkBox',
                                'data-sec' => 'blindSec'
                            ]) }}
                            <span class="custom-control-label"></span> I am blind or sight-impaired.
                        </label>                                
                    </div>
                    <div class="col-md-12">
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::checkbox('disability', true, @$step->detail['disability'] == true ? true : '', [
                                'class' => 'custom-control-input checkBox',
                                'data-sec' => 'disabilitySec'
                            ]) }}
                            <span class="custom-control-label"></span> I have another type of disability and/or impairment.
                        </label>                                
                    </div>   
                </div>
                <div class="col-md-12 hardHearingSec" style="display:{{@$step->detail['hard_hearing'] == true ? 'block' : 'none'}};">
                    <div class="form-group">
                        <label for="language">To accommodate my hearing impairment I request the following accommodation(s) (if requesting a sign-language interpreter, indicate which language (e.g., American Sign Language)) <span class="required">*</span></label>
                        {{ Form::text('language', @$step->detail['language'], ['class' => 'form-control']) }}
                    </div>
                </div> 
                <div class="col-md-12 blindSec" style="display:{{@$step->detail['blind'] == true ? 'block' : 'none'}};">
                    <div class="form-group">
                        <label for="impairment">To accommodate my sight impairment I request the following accommodation(s): <span class="required">*</span></label>                        
                        {{ Form::text('impairment', @$step->detail['impairment'], ['class' => 'form-control']) }}
                    </div>
                </div> 
                <div class="col-md-12 disabilitySec" style="display:{{@$step->detail['disability'] == true ? 'block' : 'none'}};">
                    <div class="form-group">
                        <label for="disabilities">Describe the nature of your disabilities or impairments (not hearing or sight related) and accommodations you are requesting: <span class="required">*</span></label>
                        {{ Form::text('disabilities', @$step->detail['disabilities'], ['class' => 'form-control']) }}
                    </div>
                </div>                                                           
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'accommodations') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'interpreter') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'questions-part-5'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'interpreter'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentAccommodationBtn',
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

        $(document).on('change', '.checkBox', function(){
            var sec = $(this).data('sec');
            if ($(this).is(':checked') == true) {
                $('.'+sec).find("input").val('');
            } else {
                $('.'+sec).hide();
            }
        });
        
        $("#adjustmentAccommodation").validate({
            rules: {
                accommodation: {
                    required: true,
                },
                language: {
                    required: true,
                },
                impairment: {
                    required: true,
                },
                disabilities: {
                    required: true,
                },     
            },
            errorPlacement: function (error, element) {
                var name = element.attr("name");
                if (name == "accommodation") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               accommodation: "Please choose option!",                                           
               language: "This field is required!",                                           
               impairment: "This field is required!",                                           
               disabilities: "This field is required!",                                           
            },
            submitHandler: function(form) {
                $('#adjustmentAccommodationBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentAccommodation') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.accommodations').removeClass('active');
                            $('.interpreter').addClass('active');
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