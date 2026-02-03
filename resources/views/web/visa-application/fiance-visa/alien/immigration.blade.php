<!-- resources\views\web\visa-application\fiance-visa\alien\immigration.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienImmigration'), 'id' => 'fianceAlienImmigration']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Immigration Proceedings</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <p class="peragraph" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have been or currently under any immigration proceedings or any contact with the immigration authorities. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p>
                    <div class="form-group">
                        <label>Was the beneficiary EVER in immigration proceedings?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('immigration_proceed', 'no', @$step->detail['immigration_proceed'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input immigrationProceed'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('immigration_proceed', 'yes', @$step->detail['immigration_proceed'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input immigrationProceed'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="immigration_proceed"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 immigrationProceedSec" style="display: {{ @$step->detail['immigration_proceed'] == 'yes' ? 'block' : 'none'  }};">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('where_enter', "Where? Enter City and State or Country") }}
                                <span class="required">*</span>
                                {{ Form::text('where_enter', @$step->detail['where_enter'], ['class' => 'form-control', 'placeholder' => 'Enter address']) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('estimate_date', "When? Estimate if you don't know the exact date. format mm/dd/yyyy") }}
                                <span class="required">*</span>
                                {{ Form::text('estimate_date', @$step->detail['estimate_date'], ['class' => 'form-control datePicker', 'placeholder' => 'Enter date']) }}
                            </div>
                        </div>
                        <label>What type of proceeding was it? Check all that apply.</label>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="radiogroup">
                                    <label class="custom-control mb-0 ">
                                        {{ Form::checkbox('proceed_type[]', 'removal', is_array(@$step->detail['proceed_type']) && in_array('removal', $step->detail['proceed_type']) ? true : '', [
                                            'class' => 'custom-control-input'
                                        ]) }}
                                        <span class="custom-control-label"></span> Removal
                                    </label>                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="radiogroup">
                                    <label class="custom-control mb-0 ">
                                        {{ Form::checkbox('proceed_type[]', 'exclusion_deportation', is_array(@$step->detail['proceed_type']) && in_array('exclusion_deportation', $step->detail['proceed_type']) ? true : '', [
                                            'class' => 'custom-control-input'
                                        ]) }}
                                        <span class="custom-control-label"></span> Exclusion/Deportation
                                    </label>                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="radiogroup">
                                    <label class="custom-control mb-0 ">
                                        {{ Form::checkbox('proceed_type[]', 'rescission', is_array(@$step->detail['proceed_type']) && in_array('rescission', $step->detail['proceed_type']) ? true : '', [
                                            'class' => 'custom-control-input'
                                        ]) }}
                                        <span class="custom-control-label"></span> Rescission
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="radiogroup">
                                    <label class="custom-control mb-0 ">
                                        {{ Form::checkbox('proceed_type[]', 'judicial_proceed', is_array(@$step->detail['proceed_type']) && in_array('judicial_proceed', $step->detail['proceed_type']) ? true : '', [
                                            'class' => 'custom-control-input'
                                        ]) }}
                                        <span class="custom-control-label"></span> Judicial Proceedings (choose this option if none of the others apply)
                                    </label>                                    
                                </div>
                            </div>
                        </div>
                        <div class="proceed_type"></div>
                        <p>Attach to your petition a copy of the official documentation relating to this proceeding.</p>
                    </div>                   
                </div>                
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'immigration') !!}
        {!! Form::hidden('next', 'languages') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'activity'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'languages'
        ]) }}
         {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienImmigrationBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('click', '.immigrationProceed', function(){
            if ($(this).val() == 'yes') {
                $('.peragraph').show();
                $('.immigrationProceedSec').show();
            } else {
                $('.immigrationProceedSec').hide();
                $('.peragraph').hide();
            }
        });

        $("#fianceAlienImmigration").validate({
            rules: {
                immigration_proceed: {
                    required: true,
                },
                where_enter: {
                    required: true,
                },
                estimate_date: {
                    required: true,
                },
                'proceed_type[]': {
                    required: true,
                },       
            },
            messages: {
               immigration_proceed: "Please choose option!",               
               where_enter: "Please enter!",               
               estimate_date: "Please enter date!",               
               proceed_type: "Please choose option!",               
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "immigration_proceed" || element.attr("name") == "proceed_type[]") {
                    error.appendTo($("."+(element.attr("name").replace('[]', ''))));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $('#fianceAlienImmigrationBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienImmigration') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activeimmigration').removeClass('active');
                            $('.activelanguages').addClass('active');
                            $('.fianceVisaForm').html(data.data);                    
                        }
                        if (data.status == false) {
                            toastr.options.timeOut = 10000;
                            toastr.error(data.message);
                            // setTimeout(function() {
                            //     location.reload();
                            // }, 3000);
                        }
                    }
                });
               return false;
            }
        });        
    </script>
</div>