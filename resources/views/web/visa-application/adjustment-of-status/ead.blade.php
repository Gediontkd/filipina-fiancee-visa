<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentEad'), 'id' => 'adjustmentEad']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>All questions are about the Alien (foreign citizen).</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever in the past applied for a United States Employment Authorization Document? Unless you were previously in the United States and applied for authorization to work you should answer "No" here.</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('authorization', 'no', @$step->detail['authorization'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'foreignNatSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('authorization', 'yes', @$step->detail['authorization'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'foreignNatSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="authorization"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 foreignNatSec" style="display: {{ @$step->detail['authorization'] == 'yes' ? 'block' : 'none' }};">
                    <div class="form-group">
                        {{ Form::label('uscis', 'To what USCIS office did you apply for this EAD? (city and state)') }}
                        <span class="required">*</span>
                        {{ Form::text('uscis', @$step->detail['uscis'], ['class' => 'form-control']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('application_date', 'Date of Application (mm/dd/yyyy)') }}
                        <span class="required">*</span>
                        {{ Form::text('application_date', @$step->detail['application_date'], ['class' => 'form-control datePicker']) }}
                    </div>
                    <div class="form-group">
                        <label>Was your request for work authorization approved?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('approved', 'no', @$step->detail['approved'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'foreignNatSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('approved', 'yes', @$step->detail['approved'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'foreignNatSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="approved"></div>
                        </div>
                    </div>
                </div>                                                              
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'ead') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'accommodations') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'questions-part-3'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'accommodations'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentEadBtn',
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
        
        $("#adjustmentEad").validate({
            rules: {
                authorization: {
                    required: true,
                },
                uscis: {
                    required: true,
                },
                application_date: {
                    required: true,
                },
                approved: {
                    required: true,
                },     
            },
            errorPlacement: function (error, element) {
                var name = element.attr("name");
                if (name == "authorization" || name == "approved") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               authorization: "Please choose option!",                                           
               uscis: "Please enter city and state!",                                           
               application_date: "Please enter date!",                                           
               approved: "Please choose option!",                                           
            },
            submitHandler: function(form) {
                $('#adjustmentEadBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentEad') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.ead').removeClass('active');
                            $('.accommodations').addClass('active');
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