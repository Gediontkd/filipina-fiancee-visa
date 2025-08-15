<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentAlienParents'), 'id' => 'adjustmentAlienParents']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>Alien's Parents</h2>
            </div>
            <div class="row">
                <h4>Alien's Father Information</h4>
                 <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("father_last_name", "Father's Last Name") }}
                        <span class="required">*</span>
                        {{ Form::text("father_last_name", @$step->detail['father_last_name'], ['class' => 'form-control', 'placeholder' => "Enter Last Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("father_first_name", "Father's First Name") }}
                        <span class="required">*</span>
                        {{ Form::text("father_first_name", @$step->detail['father_first_name'], ['class' => 'form-control', 'placeholder' => "Enter First Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("father_middle_name", "Father's Middle Name") }}
                        <span class="required">*</span>
                        {{ Form::text("father_middle_name", @$step->detail['father_middle_name'], ['class' => 'form-control fatherMiddleName', 'placeholder' => "Enter Middle Name"]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "fatherMiddleName"
                        ]) }} 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Has your Father used any other names?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('father_other_name', 'no', @$step->detail['father_other_name'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input fatherOtherName',
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('father_other_name', 'yes', @$step->detail['father_other_name'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input fatherOtherName',
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="father_other_name"></div>
                        </div>
                    </div>
                </div>
                <div class="row fatherOtherNameSec" style="display: none;">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label("father_other_last_name", "Father's Other Last Name") }}
                            <span class="required">*</span>
                            {{ Form::text("father_other_last_name", @$step->detail['father_other_last_name'], ['class' => 'form-control', 'placeholder' => "Enter Last Name"]) }}
                        </div>                        
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label("father_other_first_name", "Father's Other First Name") }}
                            <span class="required">*</span>
                            {{ Form::text("father_other_first_name", @$step->detail['father_other_first_name'], ['class' => 'form-control', 'placeholder' => "Enter First Name"]) }}
                        </div>                        
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label("father_other_middle_name", "Father's Other Middle Name") }}
                            <span class="required">*</span>
                            {{ Form::text("father_other_middle_name", @$step->detail['father_other_middle_name'], ['class' => 'form-control fatherMiddleName', 'placeholder' => "Enter Middle Name"]) }}
                            {{ Form::label('does_not_apply', "Does Not Apply") }}
                            {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                'class' => 'custom-control-input doesNotApply',
                                'data-field' => "fatherMiddleName"
                            ]) }} 
                        </div>                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("father_dob", "Father's Date of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("father_dob", @$step->detail['father_dob'], ['class' => 'form-control dateOfBirth fatherDob', 'placeholder' => "Enter Date of Birth"]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "fatherDob"
                        ]) }}   
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("father_city_town", "Father's City/Town/Village of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("father_city_town", @$step->detail['father_city_town'], ['class' => 'form-control fatherCityTown', 'placeholder' => "Enter Place"]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "fatherCityTown"
                        ]) }}
                    </div>
                </div>                
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('father_birth_country', "Father's Country of Birth") }}
                        <span class="required">*</span>
                        {{ Form::select('father_birth_country', getAllCountry(), @$step->detail['father_birth_country'], ['class' => 'form-control fatherBirthCountry',]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "fatherBirthCountry"
                        ]) }}              
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("father_current_city", "Father's Current City of Residence. Enter Deceased if appropriate.") }}
                        <span class="required">*</span>
                        {{ Form::text("father_current_city", @$step->detail['father_current_city'], ['class' => 'form-control fatherCityTown', 'placeholder' => "Enter Place"]) }}
                        {{ Form::label('does_not_apply', "Unkown") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "fatherCityTown"
                        ]) }}
                    </div>
                </div> 
                <h4>Alien's Mother Information</h4>
                 <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_last_name", "Mother's Last Name") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_last_name", @$step->detail['mother_last_name'], ['class' => 'form-control', 'placeholder' => "Enter Last Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_first_name", "Mother's First Name") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_first_name", @$step->detail['mother_first_name'], ['class' => 'form-control', 'placeholder' => "Enter First Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_middle_name", "Mother's Middle Name") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_middle_name", @$step->detail['mother_middle_name'], ['class' => 'form-control motherMiddleName', 'placeholder' => "Enter Middle Name"]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "motherMiddleName"
                        ]) }} 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Has your mother used any other names?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('mother_other_name', 'no', @$step->detail['mother_other_name'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input motherOtherName',
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('mother_other_name', 'yes', @$step->detail['mother_other_name'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input motherOtherName',
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="mother_other_name"></div>
                        </div>
                    </div>
                </div>
                <div class="row motherOtherNameSec" style="display: none;">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label("mother_other_last_name", "Mother's Other Last Name") }}
                            <span class="required">*</span>
                            {{ Form::text("mother_other_last_name", @$step->detail['mother_other_last_name'], ['class' => 'form-control', 'placeholder' => "Enter Last Name"]) }}
                        </div>                        
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label("mother_other_first_name", "Mother's Other First Name") }}
                            <span class="required">*</span>
                            {{ Form::text("mother_other_first_name", @$step->detail['mother_other_first_name'], ['class' => 'form-control', 'placeholder' => "Enter First Name"]) }}
                        </div>                        
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label("mother_other_middle_name", "Mother's Other Middle Name") }}
                            <span class="required">*</span>
                            {{ Form::text("mother_other_middle_name", @$step->detail['mother_other_middle_name'], ['class' => 'form-control motherMiddleName', 'placeholder' => "Enter Middle Name"]) }}
                            {{ Form::label('does_not_apply', "Does Not Apply") }}
                            {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                'class' => 'custom-control-input doesNotApply',
                                'data-field' => "motherMiddleName"
                            ]) }} 
                        </div>                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_dob", "Mother's Date of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_dob", @$step->detail['mother_dob'], ['class' => 'form-control dateOfBirth motherDob', 'placeholder' => "Enter Date of Birth"]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "motherDob"
                        ]) }}   
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("mother_city_town", "Mother's City/Town/Village of Birth") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_city_town", @$step->detail['mother_city_town'], ['class' => 'form-control motherCityTown', 'placeholder' => "Enter Place"]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "motherCityTown"
                        ]) }}
                    </div>
                </div>                
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('mother_birth_country', "Mother's Country of Birth") }}
                        <span class="required">*</span>
                        {{ Form::select('mother_birth_country', getAllCountry(), @$step->detail['mother_birth_country'], ['class' => 'form-control motherBirthCountry',]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "motherBirthCountry"
                        ]) }}              
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("mother_current_city", "Mother's Current City of Residence. Enter Deceased if appropriate.") }}
                        <span class="required">*</span>
                        {{ Form::text("mother_current_city", @$step->detail['mother_current_city'], ['class' => 'form-control motherCityTown', 'placeholder' => "Enter Place"]) }}
                        {{ Form::label('does_not_apply', "Unkown") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "motherCityTown"
                        ]) }}
                    </div>
                </div>                                                         
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'alien-parents') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'employment') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'affiliations'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'employment'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentAlienParentsBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('change', '.fatherOtherName', function(){
            switch ($(this).val()) {
                case 'yes':
                    $('.fatherOtherNameSec').show();                  
                break;         
                case 'no':
                    $('.fatherOtherNameSec').hide();
                break;
            }
        });

        $(document).on('change', '.motherOtherName', function(){
            switch ($(this).val()) {
                case 'yes':
                    $('.motherOtherNameSec').show();                  
                break;         
                case 'no':
                    $('.motherOtherNameSec').hide();
                break;
            }
        });        
        
        $("#adjustmentAlienParents").validate({
            rules: {
                father_last_name: {
                    required: true,
                },
                father_last_name: {
                    required: true,
                },
                father_first_name: {
                    required: true,
                },
                father_middle_name: {
                    required: true,
                },                
                father_other_name: {
                    required: true,
                },
                father_other_name: {
                    required: true,
                },
                father_other_last_name: {
                    required: true,
                },
                father_other_first_name: {
                    required: true,
                },
                father_other_middle_name: {
                    required: true,
                },                
                father_dob: {
                    required: true,
                },                
                father_city_town: {
                    required: true,
                },                
                father_birth_country: {
                    required: true,
                },                
                father_current_city: {
                    required: true,
                },                
                mother_last_name: {
                    required: true,
                },
                mother_first_name: {
                    required: true,
                },
                mother_middle_name: {
                    required: true,
                },                
                mother_other_name: {
                    required: true,
                },
                mother_other_name: {
                    required: true,
                },
                mother_dob: {
                    required: true,
                },
                mother_other_last_name: {
                    required: true,
                },
                mother_other_first_name: {
                    required: true,
                },
                mother_other_middle_name: {
                    required: true,
                },
                mother_city_town: {
                    required: true,
                },
                mother_birth_country: {
                    required: true,
                },
                mother_current_city: {
                    required: true,
                },              
            },
            errorPlacement: function (error, element) {
                var name = element.attr("name");
                if (name == "affiliation") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
                father_last_name: "Please enter name!", 
                father_last_name: "Please enter name",
                father_first_name: "Please enter name",
                father_middle_name: "Please enter name",
                father_other_name: "Please enter name",
                father_other_name: "Please enter name",
                father_other_last_name: "Please enter name",
                father_other_first_name: "Please enter name",
                father_other_middle_name: "Please enter name",
                father_dob: "Please enter date",
                father_city_town: "Please enter town",
                does_not_apply: "Please enter apply",
                father_birth_country: "Please enter country",
                father_current_city: "Please enter city",
                mother_last_name: "Please enter name",
                mother_first_name: "Please enter name",
                mother_middle_name: "Please enter name",
                mother_other_name: "Please enter name",
                mother_other_name: "Please enter name",
                mother_other_last_name: "Please enter name",
                mother_other_first_name: "Please enter name",
                mother_other_middle_name: "Please enter name",
                mother_dob: "Please enter date",
                mother_city_town: "Please enter town",
                mother_birth_country: "Please enter country",
                mother_current_city: "Please enter city",                           
            },
            submitHandler: function(form) {
                $('#adjustmentAlienParentsBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentAlienParents') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.alien-parents').removeClass('active');
                            $('.employment').addClass('active');
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