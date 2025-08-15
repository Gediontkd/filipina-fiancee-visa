<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentName'), 'id' => 'adjustmentName']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>{{$type}}'s Name And Gender</h2>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label("first_name", "$type's First Name") }}
                        <span class="required">*</span>
    					{{ Form::text("first_name", @$step->detail['first_name'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter First Name'
                        ]) }} 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label("middle_name", "$type's Middle Name") }}
                        <span class="required">*</span>
    					{{ Form::text("middle_name", @$step->detail['middle_name'], [
                            'class' => 'form-control f_m_l_name',
                            'placeholder' => 'Enter Middle Name'
                        ]) }}
                        {{ Form::label("does_not_apply", "Does Not Apply") }}
                        {{ Form::checkbox("does_not_apply", true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => 'f_m_l_name'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    	{{ Form::label("last_name", "$type's Last Name (family name) ") }}
                        <span class="required">*</span>
    					{{ Form::text("last_name", @$step->detail['last_name'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Last Name'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("email", "Email Address") }}
                        <span class="required">*</span>
                        {{ Form::text("email", @$step->detail['email'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Email'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('country_no', "Phone Number Country") }}
                        <span class="required">*</span>
                        {{ Form::select('country_no', getCountryPhoneCode(), @$step->detail['country_no'], [
                            'class' => 'form-control'
                        ]) }}                       
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("phone_no", "Phone number") }}
                        <span class="required">*</span>
                        {{ Form::text("phone_no", @$step->detail['phone_no'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Phone number'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('mob_no_country', "Mobile Number Country") }}
                        <span class="required">*</span>
                        {{ Form::select('mob_no_country', getCountryPhoneCode(), @$step->detail['mob_no_country'], [
                            'class' => 'form-control'
                        ]) }}                       
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mob_no", "Mobile number") }}
                        <span class="required">*</span>
                        {{ Form::text("mob_no", @$step->detail['mob_no'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Mobile number'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("uscis_no", "USCIS Online Account Number") }}
                        <span class="required">*</span>
                        {{ Form::text("uscis_no", @$step->detail['uscis_no'], [
                            'class' => 'form-control uscis_no',
                            'placeholder' => 'Enter USCIS Online Account Number'
                        ]) }}
                        <div>
                            {{ Form::checkbox("does_not_apply", true, @$step->detail['does_not_apply'] == true ? true : '', [
                                'class' => 'custom-control-input doesNotApply',
                                'data-field' => 'uscis_no'
                            ]) }}
                            {{ Form::label("does_not_apply", " I do not have an account number, or do not know it") }}                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Has the Social Security Administration (SSA) ever officially issued a Social Security card to you?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio("ssa", 'no', @$step->detail['ssa'] == 'male' ? true : '', [
                                    'class' => 'custom-control-input ssa'
                                ]) }}
                            	<span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio("ssa", 'yes', @$step->detail['ssa'] == 'female' ? true : '', [
                                    'class' => 'custom-control-input ssa'
                                ]) }}
                            	<span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="ssa"></div>
                    </div>
                </div>
                <div class="col-md-12 ssaSec" style="display: none;">
                    <div class="form-group">
                        {{ Form::label("us_ssn", "U.S. Social Security Number  Format: 123-45-6789") }}
                        <span class="required">*</span>
                        {{ Form::text("us_ssn", @$step->detail['us_ssn'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Number'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you want the SSA to issue you a new Social Security card <span class="required">*</span></label>                        
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio("ssc", 'no', @$step->detail['ssc'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input ssc'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio("ssc", 'yes', @$step->detail['ssc'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input ssc'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="ssc"></div>
                    </div>
                </div>
                <div class="col-md-12 sscSec" style="display: none;">
                    <p class="text-danger">Note: By answering "Yes", you authorize the disclosure of information from this application to the SSA as required for the purpose of assigning you (beneficiary) an SSN and issuing you (beneficiary) a Social Security card.</p>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>{{$type}}'s Gender</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio("gender", 'male', @$step->detail['gender'] == 'male' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Male
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio("gender", 'female', @$step->detail['gender'] == 'female' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Female
                            </label>
                        </div>
                        <div class="gender"></div>
                    </div>
                </div>
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'name') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'place-of-birth') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'place-of-birth'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentNameBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $(document).on('change', '.ssa', function(){
            if ($(this).val() == 'yes') {
                $('.ssaSec').show();
            } else {
                $('.ssaSec').hide();
            }
        });

        $(document).on('change', '.ssc', function(){
            if ($(this).val() == 'yes') {
                $('.sscSec').show();
            } else {
                $('.sscSec').hide();
            }
        });

        $("#adjustmentName").validate({
            rules: {
                first_name: {
                    required: true,
                },
                middle_name: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                email: {
                    required: true,
                },
                country_no: {
                    required: true,
                },
                phone_no: {
                    required: true,
                },
                mob_no_country: {
                    required: true,
                },
                mob_no: {
                    required: true,
                },
                uscis_no: {
                    required: true,
                },
                ssa: {
                    required: true,
                },
                ssc: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                us_ssn: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "ssa" || element.attr("name") == "ssc" || element.attr("name") == "gender") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               first_name: "Please enter your first name!",
               middle_name: "Please enter your middle name!",
               last_name: "Please enter your last name!",               
               email: "Please enter email!",               
               country_no: "Please choose phone number country!",               
               phone_no: "Please enter phone number!",               
               mob_no_country: "Please choose mobile number country!",               
               mob_no: "Please enter mobile number!",               
               uscis_no: "Please enter number!",               
               ssa: "Please enter number!",               
               ssc: "Please enter number!",               
               gender: "Please choose gender!",               
               us_ssn: "Please enter number!",               
            },
            submitHandler: function(form) {
                $('#adjustmentNameBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentName') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.name').removeClass('active');
                            $('.place-of-birth').addClass('active');
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