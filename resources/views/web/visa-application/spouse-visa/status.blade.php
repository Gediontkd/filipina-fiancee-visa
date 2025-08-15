<div class="step-wizard">
    {{ Form::open(['url' => route('spouseStatus'), 'id' => 'spouseStatus']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>Sponsors Status</h2>
                <div class="card bg-danger">
                    <p class="text-center pt-3 text-white">Do not write your answers in all capital letters and never use any type of non-English characters.</p>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>What is your current status?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('current_status', 'u_s_citizen', @$step->detail['current_status'] == 'u_s_citizen' ? true : '', [
                                    'class' => 'custom-control-input diffrentMailingAddress'
                                ]) }}
                                <span class="custom-control-label"></span> U.S. Citizen
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('current_status', 'permanent_resident', @$step->detail['current_status'] == 'permanent_resident' ? true : '', [
                                    'class' => 'custom-control-input diffrentMailingAddress'
                                ]) }}
                                <span class="custom-control-label"></span> Permanent Resident (green card holder)
                            </label>
                            <div class="current_status"></div>
                        </div>
                    </div>
                </div>
                <h4>Biographic Data</h4>
                <h5>Height</h5>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label('feet', "Feet") }}
                        <span class="required">*</span>
    					{{ Form::text('feet', @$step->detail['feet'], ['class' => 'form-control', 'placeholder' => 'Enter Feet']) }}        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('inches', "Inches") }}
                        <span class="required">*</span>
                        {{ Form::text('inches', @$step->detail['inches'], ['class' => 'form-control', 'placeholder' => 'Enter Inches']) }}        
                    </div>
                </div>
                <h5>Weight</h5>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('pounds', "Pounds") }}
                        <span class="required">*</span>
                        {{ Form::text('pounds', @$step->detail['pounds'], ['class' => 'form-control', 'placeholder' => 'Enter Pounds']) }}        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Ethnicity</b> <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('ethnicity', 'not_hispanic_or_latino', @$step->detail['ethnicity'] == 'not_hispanic_or_latino' ? true : '', [
                                    'class' => 'custom-control-input diffrentMailingAddress'
                                ]) }}
                                <span class="custom-control-label"></span> Not Hispanic or Latino
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('ethnicity', 'hispanic_or_latino', @$step->detail['ethnicity'] == 'hispanic_or_latino' ? true : '', [
                                    'class' => 'custom-control-input diffrentMailingAddress'
                                ]) }}
                                <span class="custom-control-label"></span> Hispanic or Latino
                            </label>
                            <div class="ethnicity"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label><b>Race</b> <span class="required">*</span></label>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::checkbox('race1', 'white', @$step->detail['race1'] == 'white' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> White
                                </label>                                
                            </div>
                            <div class="col-md-6">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::checkbox('race2', 'asian', @$step->detail['race2'] == 'asian' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Asian
                                </label>                                
                            </div>
                            <div class="col-md-6">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::checkbox('race3', 'black_or_african_amer', @$step->detail['race3'] == 'black_or_african_amer' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Black or African American
                                </label>                                
                            </div>
                            <div class="col-md-6">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::checkbox('race4', 'amer_indi_or_alaska_native', @$step->detail['race4'] == 'amer_indi_or_alaska_native' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> American Indian or Alaska Native
                                </label>                                
                            </div>
                            <div class="col-md-6">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::checkbox('race5', 'native_hawaiian_or_other_pacific_islander', @$step->detail['race5'] == 'native_hawaiian_or_other_pacific_islander' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Native Hawaiian or Other Pacific Islander
                                </label>                                
                            </div>
                            <div class="race"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><b>Hair Color</b> <span class="required">*</span></label>
                        <div class="row radiogroup">
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'black', @$step->detail['hair_color'] == 'black' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Black
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'brown', @$step->detail['hair_color'] == 'brown' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Brown
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'blond', @$step->detail['hair_color'] == 'blond' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Blond
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'gray', @$step->detail['hair_color'] == 'gray' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Gray
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'white', @$step->detail['hair_color'] == 'white' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> White
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'red', @$step->detail['hair_color'] == 'red' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Red
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'sandy', @$step->detail['hair_color'] == 'sandy' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Sandy
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'bald_no_hair', @$step->detail['hair_color'] == 'bald_no_hair' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Bald (No Hair)
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'other', @$step->detail['hair_color'] == 'other' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Other
                                </label>                                
                            </div>
                            <div class="hair_color"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label><b>Eye Color</b> <span class="required">*</span></label>
                        <div class="row radiogroup">
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'black', @$step->detail['eye_color'] == 'black' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Black
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'blue', @$step->detail['eye_color'] == 'blue' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Blue
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'brown', @$step->detail['eye_color'] == 'brown' ? true : '', [
                                        'class' => 'custom-control-input diffrentMailingAddress'
                                    ]) }}
                                    <span class="custom-control-label"></span> Brown
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'gray', @$step->detail['eye_color'] == 'gray' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Gray
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'green', @$step->detail['eye_color'] == 'green' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Green
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'hazel', @$step->detail['eye_color'] == 'hazel' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Hazel
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'maroon', @$step->detail['eye_color'] == 'maroon' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Maroon
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'other', @$step->detail['eye_color'] == 'other' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Other
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'pink', @$step->detail['eye_color'] == 'pink' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Pink
                                </label>                                
                            </div>
                            <div class="eye_color"></div>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'status') !!}
        {!! Form::hidden('next', 'marital-status') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'place-of-birth'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'marital-status'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseStatusBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">        
        $("#spouseStatus").validate({
            rules: {
                current_status: {
                    required: true,
                },
                feet: {
                    required: true,
                },
                inches: {
                    required: true,
                },
                pounds: {
                    required: true,
                },
                ethnicity: {
                    required: true,
                },
                hair_color: {
                    required: true,
                },
                eye_color: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "current_status" || element.attr("name") == "hair_color" || element.attr("name") == "eye_color") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               current_status: "Please choose option!",               
               feet: "Please enter feet!",               
               inches: "Please enter inches!",               
               pounds: "Please enter pounds!",               
               ethnicity: "Please choose ethnicity!",               
               hair_color: "Please choose hair color!",               
               eye_color: "Please choose eye color!",               
            },
            submitHandler: function(form) {
                $('#spouseStatusBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('spouseStatus') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.status').removeClass('active');
                            $('.marital-status').addClass('active');
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
    </script>                    
</div>