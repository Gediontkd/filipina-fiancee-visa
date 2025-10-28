<!-- resources/views/web/visa-application/spouse-visa/beneficiary/status.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseBeneficiaryStatus'), 'id' => 'spouseBeneficiaryStatus']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>Beneficiary's Biographic Information</h2>
                <div class="card bg-info">
                    <p class="text-center pt-3 text-white">Do not write your answers in all capital letters and never use any type of non-English characters.</p>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
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
                                {{ Form::radio('ethnicity', 'not_hispanic_or_latino', @$step->detail['ethnicity'] == 'not_hispanic_or_latino', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Not Hispanic or Latino
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('ethnicity', 'hispanic_or_latino', @$step->detail['ethnicity'] == 'hispanic_or_latino', [
                                    'class' => 'custom-control-input'
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
                                <label class="custom-control custom-checkbox mb-0">
                                    {{ Form::checkbox('race1', 'white', @$step->detail['race1'] == 'white', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> White
                                </label>                                
                            </div>
                            <div class="col-md-6">
                                <label class="custom-control custom-checkbox mb-0">
                                    {{ Form::checkbox('race2', 'asian', @$step->detail['race2'] == 'asian', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Asian
                                </label>                                
                            </div>
                            <div class="col-md-6">
                                <label class="custom-control custom-checkbox mb-0">
                                    {{ Form::checkbox('race3', 'black_or_african_amer', @$step->detail['race3'] == 'black_or_african_amer', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Black or African American
                                </label>                                
                            </div>
                            <div class="col-md-6">
                                <label class="custom-control custom-checkbox mb-0">
                                    {{ Form::checkbox('race4', 'amer_indi_or_alaska_native', @$step->detail['race4'] == 'amer_indi_or_alaska_native', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> American Indian or Alaska Native
                                </label>                                
                            </div>
                            <div class="col-md-6">
                                <label class="custom-control custom-checkbox mb-0">
                                    {{ Form::checkbox('race5', 'native_hawaiian_or_other_pacific_islander', @$step->detail['race5'] == 'native_hawaiian_or_other_pacific_islander', [
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
                                    {{ Form::radio('hair_color', 'black', @$step->detail['hair_color'] == 'black', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Black
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'brown', @$step->detail['hair_color'] == 'brown', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Brown
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'blond', @$step->detail['hair_color'] == 'blond', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Blond
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'gray', @$step->detail['hair_color'] == 'gray', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Gray
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'white', @$step->detail['hair_color'] == 'white', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> White
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'red', @$step->detail['hair_color'] == 'red', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Red
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'sandy', @$step->detail['hair_color'] == 'sandy', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Sandy
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'bald_no_hair', @$step->detail['hair_color'] == 'bald_no_hair', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Bald (No Hair)
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('hair_color', 'other', @$step->detail['hair_color'] == 'other', [
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
                                    {{ Form::radio('eye_color', 'black', @$step->detail['eye_color'] == 'black', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Black
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'blue', @$step->detail['eye_color'] == 'blue', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Blue
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'brown', @$step->detail['eye_color'] == 'brown', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Brown
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'gray', @$step->detail['eye_color'] == 'gray', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Gray
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'green', @$step->detail['eye_color'] == 'green', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Green
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'hazel', @$step->detail['eye_color'] == 'hazel', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Hazel
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'maroon', @$step->detail['eye_color'] == 'maroon', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Maroon
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'other', @$step->detail['eye_color'] == 'other', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Other
                                </label>                                
                            </div>
                            <div class="col-md-3">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('eye_color', 'pink', @$step->detail['eye_color'] == 'pink', [
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
        {!! Form::hidden('section', 'beneficiary') !!}
        {!! Form::hidden('name', 'status') !!}
        {!! Form::hidden('next', 'marital-status') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'place-of-birth',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'marital-status',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseBeneficiaryStatusBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">        
        $("#spouseBeneficiaryStatus").validate({
            rules: {
                feet: { required: true },
                inches: { required: true },
                pounds: { required: true },
                ethnicity: { required: true },
                hair_color: { required: true },
                eye_color: { required: true },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "ethnicity" || element.attr("name") == "hair_color" || element.attr("name") == "eye_color") {
                    error.appendTo($("." + element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               feet: "Please enter feet",               
               inches: "Please enter inches",               
               pounds: "Please enter pounds",               
               ethnicity: "Please select ethnicity",               
               hair_color: "Please select hair color",               
               eye_color: "Please select eye color",               
            },
            submitHandler: function(form) {
                $('#spouseBeneficiaryStatusBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                $.ajax({
                    headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
                    type: 'post',
                    url: "{{ route('spouseBeneficiaryStatus') }}",
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status) {                                           
                            $('.beneficiary-status').removeClass('active');
                            $('.beneficiary-marital-status').addClass('active');
                            $('.spouseVisaForm').html(data.data);                    
                        } else {
                            $('#spouseBeneficiaryStatusBtn').html('Save & Continue');
                            toastr.error(data.message);
                        }
                    },
                    error: function() {
                        $('#spouseBeneficiaryStatusBtn').html('Save & Continue');
                        toastr.error('An error occurred. Please try again.');
                    }
                });
               return false;
            }
        });
    </script>                    
</div>