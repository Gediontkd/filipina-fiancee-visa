<!-- resources\views\web\visa-application\adjustment-of-status\place-of-birth.blade.php -->
<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentPlaceOfBirth'), 'id' => 'adjustmentPlaceOfBirth']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>{{$type}}'s Birth Information</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("dob", "Date of Birth (mm/dd/yyyy)") }}
                        <span class="required">*</span>
                        {{ Form::text("dob", @$step->detail['dob'], ['class' => 'form-control dateOfBirth', 'placeholder' => "Enter Date of Birth"]) }}                        
                    </div>
                </div>               
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("city_of_birth", "City of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("city_of_birth", @$step->detail['city_of_birth'], ['class' => 'form-control', 'placeholder' => "Enter City of Birth"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("state_province", "State or Province of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("state_province", @$step->detail['state_province'], ['class' => 'form-control', 'placeholder' => "Enter State or Province "]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('country_of_birth', "Country of Birth") }}
                        <span class="required">*</span>
                        {{ Form::select('country_of_birth', getAllCountry(), @$step->detail['country_of_birth'], ['class' => 'form-control',]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('country_of_citizen', "Country of Citizenship") }}
                        <span class="required">*</span>
                        {{ Form::select('country_of_citizen', getAllCountry(), @$step->detail['country_of_citizen'], ['class' => 'form-control',]) }}
                    </div>
                </div>
                 <h4>{{$type}}'s Biographic Data</h4>
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
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'place-of-birth') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'visa-info') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'visa-info'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentPlaceOfBirthBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">        
        $("#adjustmentPlaceOfBirth").validate({
            rules: {
                dob: {
                    required: true,
                },
                city_of_birth: {
                    required: true,
                },
                state_province: {
                    required: true,
                },
                country_of_birth: {
                    required: true,
                },
                country_of_citizen: {
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
                if (element.attr("name") == "ethnicity" || element.attr("name") == "hair_color" || element.attr("name") == "eye_color") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               dob: "Please enter date!",                           
               city_of_birth: "Please enter city!",                           
               state_province: "Please enter state!",                           
               country_of_birth: "Please choose country!",                           
               country_of_citizen: "Please choose country!",                           
               feet: "Please enter feet!",                           
               inches: "Please enter inches!",                           
               pounds: "Please enter pounds!",                           
               ethnicity: "Please choose option!",                           
               hair_color: "Please choose option!",                           
               eye_color: "Please choose option!",                           
            },
            submitHandler: function(form) {
                $('#adjustmentPlaceOfBirthBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentPlaceOfBirth') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.place-of-birth').removeClass('active');
                            $('.visa-info').addClass('active');
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