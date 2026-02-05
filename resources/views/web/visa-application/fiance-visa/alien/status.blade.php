<!-- resources\views\web\visa-application\fiance-visa\alien\status.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceContact'), 'id' => 'statusForm']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Sponsor's Status</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>What is your current status?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                            	{{ Form::radio('current_status', 'U.S. Citizen', @$step->current_status == 'U.S. Citizen' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> U.S. Citizen
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('current_status', 'Permanent Resident (green card holder)', @$step->current_status == 'Permanent Resident (green card holder)' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Permanent Resident (green card holder)
                            </label>
                            <div class="current_status"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Biographic Data</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    	{{ Form::label("height_feet", "Height") }}
    					{{ Form::number("height_feet", @$step->height_feet, ['class' => 'form-control', 'placeholder' => "Enter Feet", 'step' => '0.1', 'id' => 'alien_height_feet']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    	{{ Form::label("height_inches", "Height") }}
    					{{ Form::number("height_inches", @$step->height_inches, ['class' => 'form-control', 'placeholder' => "Enter Inches", 'step' => '0.1', 'id' => 'alien_height_inches']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                    	{{ Form::label("weight", "Weight") }}
    					{{ Form::number("weight", @$step->weight, ['class' => 'form-control', 'placeholder' => "Enter Pounds", 'step' => '0.1']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Ethnicity</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('ethnicity', 'Not Hispanic or Latino', @$step->ethnicity == 'Not Hispanic or Latino' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Not Hispanic or Latino
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('ethnicity', 'Hispanic or Latino', @$step->ethnicity == 'Hispanic or Latino' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Hispanic or Latino
                            </label>
                            <div class="ethnicity"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Race</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::checkbox('race', 'White', @$step->race == 'White' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> White
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::checkbox('race', 'Asian', @$step->race == 'Asian' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Asian
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::checkbox('race', 'Black or African American', @$step->race == 'Black or African American' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Black or African American
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::checkbox('race', 'American Indian or Alaska Native', @$step->race == 'American Indian or Alaska Native' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> American Indian or Alaska Native
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::checkbox('race', 'Native Hawaiian or Other Pacific Islander', @$step->race == 'Native Hawaiian or Other Pacific Islander' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Native Hawaiian or Other Pacific Islander
                            </label>
                            <div class="race"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Hair Color</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Black', @$step->hair_color == 'Black' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Black
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Brown', @$step->hair_color == 'Brown' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Brown
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Blond', @$step->hair_color == 'Blond' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Blond
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Gray', @$step->hair_color == 'Gray' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Gray
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'White', @$step->hair_color == 'White' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> White
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Red', @$step->hair_color == 'Red' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Red
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Sandy', @$step->hair_color == 'Sandy' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Sandy
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Bald (No Hair)', @$step->hair_color == 'Bald (No Hair)' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Bald (No Hair)
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Other', @$step->hair_color == 'Other' ? true : '', ['class' => 'custom-control-input']) }}
                            	<span class="custom-control-label"></span> Other
                            </label>
                            <div class="hair_color"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Eye Color</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Black', @$step->eye_color == 'Black' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Black
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Blue', @$step->eye_color == 'Blue' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Blue
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Brown', @$step->eye_color == 'Brown' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Brown
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Gray', @$step->eye_color == 'Gray' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Gray
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Green', @$step->eye_color == 'Green' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Green
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Hazel', @$step->eye_color == 'Hazel' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Hazel
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Maroon', @$step->eye_color == 'Maroon' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Maroon
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Other', @$step->eye_color == 'Other' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Other
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Pink', @$step->eye_color == 'Pink' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Pink
                            </label>
                            <div class="eye_color"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'place-of-birth'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'marital-status'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'statusFormBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $("#statusForm").validate({
            rules: {
                current_status: {
                    required: true,
                },
                height_feet: {
                    required: true,
                },
                height_inches: {
                    required: true,
                },
                weight: {
                    required: true,
                },
                ethnicity: {
                    required: true,
                },
                race: {
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
                if (element.attr("name") == "current_status" || element.attr("name") == "ethnicity" || element.attr("name") == "race" || element.attr("name") == "hair_color" || element.attr("name") == "eye_color") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               current_status: "Please choose your current status!",
               height_feet: "Please enter feet!",
               height_inches: "Please enter inches!",
               weight: "Please enter weight!",
               ethnicity: "Please choose ethnicity!",
               race: "Please choose race!",
               hair_color: "Please choose hair color!",
               eye_color: "Please choose eye color!",
            },
            submitHandler: function(form) {
                $('#statusFormBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: _baseURL + "/fiance-visa/status-form",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activestatus').removeClass('active');
                            $('.activemarital-status').addClass('active');
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
        
        document.addEventListener('DOMContentLoaded', function() {
            const feetInput = document.getElementById('alien_height_feet');
            const incInput = document.getElementById('alien_height_inches');

            if (feetInput && incInput) {
                // Handle decimal feet (e.g. 5.5 -> 5' 6")
                feetInput.addEventListener('blur', function() {
                    const val = parseFloat(this.value);
                    if (!isNaN(val) && val % 1 !== 0) {
                        const feet = Math.floor(val);
                        const inches = parseFloat(((val - feet) * 12).toFixed(1));
                        
                        feetInput.value = feet;
                        incInput.value = inches;
                    }
                });

                // Handle total inches (e.g. 70 -> 5' 10")
                incInput.addEventListener('blur', function() {
                    const val = parseFloat(this.value);
                    if (!isNaN(val) && val >= 12) {
                        const feet = Math.floor(val / 12);
                        const inches = parseFloat((val % 12).toFixed(1));
                        
                        feetInput.value = feet;
                        incInput.value = inches;
                    }
                });
            }
        });
    </script>   
</div>