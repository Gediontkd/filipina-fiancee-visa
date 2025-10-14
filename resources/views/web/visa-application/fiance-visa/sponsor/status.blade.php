<!-- resources\views\web\visa-application\fiance-visa\sponsor\status.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceSponsorStatus'), 'id' => 'fianceSponsorStatus']) }}
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
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('current_status', 'USCitizen', @$step->detail['current_status'] == 'USCitizen' ? true : false, ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> U.S. Citizen 
                            </label><br>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('current_status', 'PermanentResident', @$step->detail['current_status'] == 'PermanentResident' ? true : false, ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Permanent Resident (green card holder)
                            </label><br>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('current_status', 'Nationalborn', @$step->detail['current_status'] == 'Nationalborn' ? true : false, ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span>  U.S. National born in American Samoa, Swains Island or U.S. Minor Outlying Island
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
                <h6>Height</h6>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("height_feet", "Feet") }}
                        {{ Form::text("height_feet", @$step->detail['height_feet'], ['class' => 'form-control', 'placeholder' => "Enter Feet"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("height_inches", "Inches") }}
                        {{ Form::text("height_inches", @$step->detail['height_inches'], ['class' => 'form-control', 'placeholder' => "Enter Inches"]) }}
                    </div>
                </div>
                <h6>Weight</h6>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("weight_pound", "Pounds") }}
                        {{ Form::text("weight_pound", @$step->detail['weight_pound'], ['class' => 'form-control', 'placeholder' => "Enter Pounds"]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h6>Ethnicity</h6>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('ethnicity', 'Not Hispanic or Latino', @$step->detail['ethnicity'] == 'Not Hispanic or Latino' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Not Hispanic or Latino
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('ethnicity', 'Hispanic or Latino', @$step->detail['ethnicity'] == 'Hispanic or Latino' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Hispanic or Latino
                            </label>
                            <div class="ethnicity"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h6>Race</h6>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::checkbox('race', 'White', @$step->detail['race'] == 'White' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> White
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::checkbox('race', 'Asian', @$step->detail['race'] == 'Asian' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Asian
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::checkbox('race', 'Black or African American', @$step->detail['race'] == 'Black or African American' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Black or African American
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::checkbox('race', 'American Indian or Alaska Native', @$step->detail['race'] == 'American Indian or Alaska Native' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> American Indian or Alaska Native
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::checkbox('race', 'Native Hawaiian or Other Pacific Islander', @$step->detail['race'] == 'Native Hawaiian or Other Pacific Islander' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Native Hawaiian or Other Pacific Islander
                            </label>
                            <div class="race"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h6>Hair Color</h6>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Black', @$step->detail['hair_color'] == 'Black' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Black
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Brown', @$step->detail['hair_color'] == 'Brown' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Brown
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Blond', @$step->detail['hair_color'] == 'Blond' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Blond
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Gray', @$step->detail['hair_color'] == 'Gray' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Gray
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'White', @$step->detail['hair_color'] == 'White' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> White
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Red', @$step->detail['hair_color'] == 'Red' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Red
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Sandy', @$step->detail['hair_color'] == 'Sandy' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Sandy
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Bald (No Hair)', @$step->detail['hair_color'] == 'Bald (No Hair)' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Bald (No Hair)
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('hair_color', 'Other', @$step->detail['hair_color'] == 'Other' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Other
                            </label>
                            <div class="hair_color"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h6>Eye Color</h6>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Black', @$step->detail['eye_color'] == 'Black' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Black
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Blue', @$step->detail['eye_color'] == 'Blue' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Blue
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Brown', @$step->detail['eye_color'] == 'Brown' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Brown
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Gray', @$step->detail['eye_color'] == 'Gray' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Gray
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Green', @$step->detail['eye_color'] == 'Green' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Green
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Hazel', @$step->detail['eye_color'] == 'Hazel' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Hazel
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Maroon', @$step->detail['eye_color'] == 'Maroon' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Maroon
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Other', @$step->detail['eye_color'] == 'Other' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Other
                            </label>
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('eye_color', 'Pink', @$step->detail['eye_color'] == 'Pink' ? true : '', ['class' => 'custom-control-input']) }}
                                <span class="custom-control-label"></span> Pink
                            </label>
                            <div class="eye_color"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h6>How did you obtain your citizenship?</h6>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('obtain_citizenship', 'Born in U.S.A', @$step->detail['obtain_citizenship'] == 'Born in U.S.A' ? true : '', ['class' => 'custom-control-input btainCitizenship']) }}
                                <span class="custom-control-label"></span>  Born in U.S.A
                            </label>
                        </div>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('obtain_citizenship', 'Naturalized', @$step->detail['obtain_citizenship'] == 'Naturalized' ? true : '', ['class' => 'custom-control-input obtainCitizenship']) }}
                                <span class="custom-control-label"></span>  Naturalized
                            </label>
                        </div>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('obtain_citizenship', 'From Parents', @$step->detail['obtain_citizenship'] == 'From Parents' ? true : '', ['class' => 'custom-control-input obtainCitizenship']) }}
                                <span class="custom-control-label"></span>   From Parents
                            </label>
                        </div>
                        <div class="obtain_citizenship"></div>
                    </div>
                </div>
                <div class="col-md-12 naturalizedSec" style="display: {{ @$step->detail['obtain_citizenship'] == 'Naturalized' ? 'block' : 'none' }};">
                    <div class="form-group">
                        <h6>Have you obtained a Certificate of Naturalization or a Certificate of Citizenship in your name?</h6>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('certificate_citizenship', 'no', @$step->detail['certificate_citizenship'] == 'no' ? true : '', ['class' => 'custom-control-input certificateCitizenship']) }}
                                <span class="custom-control-label"></span>  No
                            </label>                        
                            <label class="custom-control custom-radio mb-2 me-3">
                                {{ Form::radio('certificate_citizenship', 'yes', @$step->detail['certificate_citizenship'] == 'yes' ? true : '', ['class' => 'custom-control-input certificateCitizenship']) }}
                                <span class="custom-control-label"></span>  Yes
                            </label>
                        </div>    
                        <div class="certificate_citizenship"></div>                    
                    </div>
                </div>
                <div class="col-md-12 certificateCitizenshipSec" style="display: {{ @$step->detail['certificate_citizenship'] == 'yes' ? 'block' : 'none' }};">
                    <p>If you no longer have your Naturalization Certificate enter Lost in the first two fields and estimate the date.</p>
                    <div class="form-group">
                        {{ Form::label("naturalization_certificate", "Naturalization Certificate Number") }}
                        {{ Form::text("naturalization_certificate", @$step->detail['naturalization_certificate'], ['class' => 'form-control', 'placeholder' => "Enter Certificate Number"]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label("place_of_issue", "Place of Issue, City and State") }}
                        {{ Form::text("place_of_issue", @$step->detail['place_of_issue'], ['class' => 'form-control', 'placeholder' => "Enter Place of Issue, City and State"]) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label("dob", "Sponsor's Date of Birth as mm/dd/yyyy") }}
                        <span class="required">*</span>
                        {{ Form::text("dob", @$step->detail['dob'], ['class' => 'form-control dateOfBirth', 'placeholder' => "Enter Date of Birth"]) }}                       
                    </div>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'status') !!}
        {!! Form::hidden('next', 'marital-status') !!}
        {!! Form::hidden('type', 'sponsor') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'place-of-birth'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 sponsorPreviousOrContinue',
            'data-form' => 'marital-status'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceSponsorStatusBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('change', '.obtainCitizenship', function(){
            if ($(this).val() == 'Naturalized') {
                $('.naturalizedSec').show();
            } else {
                $('.naturalizedSec').hide();
            }
        });

        $(document).on('change', '.certificateCitizenship', function(){
            if ($(this).val() == 'yes') {
                $('.certificateCitizenshipSec').show();
            } else {
                $('.certificateCitizenshipSec').hide();
            }
        });

        $("#fianceSponsorStatus").validate({
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
                obtain_citizenship: {
                    required: true,
                },
                certificate_citizenship: {
                    required: true,
                },
                naturalization_certificate: {
                    required: true,
                },
                place_of_issue: {
                    required: true,
                },
                dob: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "current_status" || element.attr("name") == "ethnicity" || element.attr("name") == "race" || element.attr("name") == "hair_color" || element.attr("name") == "eye_color" || element.attr("name") == "obtain_citizenship"|| element.attr("name") == "certificate_citizenship") {
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
               obtain_citizenship: "Please choose option!",
               certificate_citizenship: "Please choose option!",
               naturalization_certificate: "Please enter certificate!",
               place_of_issue: "Please enter issue!",
               dob: "Please enter date of birth!",
            },
            submitHandler: function(form) {
                $('#fianceSponsorStatusBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceSponsorStatus') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activestatus').removeClass('active');
                            $('.activemarital-status').addClass('active');
                            $('.fianceSponsorForm').html(data.data);                    
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