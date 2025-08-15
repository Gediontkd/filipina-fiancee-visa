<div class="step-wizard">
    {{ Form::open(['url' => route('spouseName'), 'id' => 'spouseName']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>Sponsor's name and gender.</h2>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label('first_name', "Alien's First Name") }}
                        <span class="required">*</span>
    					{{ Form::text('first_name', @$step->detail['first_name'], [
                            'class' => 'form-control f_m_l_name',
                            'placeholder' => 'Enter First Name'
                        ]) }} 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label('middle_name', "Alien's Middle Name") }}
                        <span class="required">*</span>
    					{{ Form::text('middle_name', @$step->detail['middle_name'], [
                            'class' => 'form-control f_m_l_name',
                            'placeholder' => 'Enter Middle Name'
                        ]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => 'f_m_l_name'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    	{{ Form::label('last_name', "Alien's Last Name (family name) ") }}
                        <span class="required">*</span>
    					{{ Form::text('last_name', @$step->detail['last_name'], [
                            'class' => 'form-control f_m_l_name',
                            'placeholder' => 'Enter Last Name'
                        ]) }}
                        <span>If there is a suffix after the name such as Jr. or III, put that here after the last name.</span>
                    </div>
                </div>               
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Alien's Gender</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('gender', 'male', @$step->detail['gender'] == 'male' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                            	<span class="custom-control-label"></span> Male
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('gender', 'female', @$step->detail['gender'] == 'female' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                            	<span class="custom-control-label"></span> Female
                            </label>
                        </div>
                        <div class="gender"></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Is your fiancée related to you? </label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('related_to_you', 'no', @$step->detail['related_to_you'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input fianceeRelated'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('related_to_you', 'yes', @$step->detail['related_to_you'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input fianceeRelated'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="related_to_you"></div>
                    </div>
                </div>
                <div class="col-md-12 fianceeRelatedSec" style="display: none;">
                    <div class="form-group">
                        {{ Form::label('how_related', "How are you related? (third cousin, maternal uncle, etc.)") }}
                        <span class="required">*</span>
                        {{ Form::text('how_related', @$step->detail['how_related'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Relation'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever used another name including a maiden name but not including nicknames?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('prior_name1', 'no', @$step->detail['prior_name1'] == false ? true : '', [
                                    'class' => 'custom-control-input firstPriorName'
                                ]) }}
                            	<span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('prior_name1', 'yes', @$step->detail['prior_name1'] == true ? true : '', [
                                    'class' => 'custom-control-input firstPriorName'
                                ]) }}
                            	<span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="prior_name1"></div>
                    </div>
                </div>

                <div class="col-md-12 firstPriorNameSec" style="display: {{ @$step->detail['prior_name1'] == 'yes' ? 'block' : 'none'  }}">
                    <div class="form-group">
                        <label>Were any of your name changes for reasons other than marriage or divorce, such as adoption or court order?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('adoption_or_court_order', 'no', @$step->detail['adoption_or_court_order'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('adoption_or_court_order', 'yes', @$step->detail['adoption_or_court_order'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="adoption_or_court_order"></div>
                    </div>
                    <h5>Prior Name #1</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label("prior1_fname", 'First Name (given name)') }}
                                <span class="required">*</span>
                                {{ Form::text("prior1_fname", @$step->detail['prior1_fname'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter name'
                                ]) }}                                        
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label("prior1_mname", 'Middle Name') }}
                                <span class="required">*</span>
                                {{ Form::text("prior1_mname", @$step->detail['prior1_mname'], [
                                    'class' => 'form-control mName1',
                                    'placeholder' => 'Enter name'
                                ]) }}
                                {{ Form::label('does_not_apply', "Does Not Apply") }}
                                {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                    'class' => 'custom-control-input doesNotApply',
                                    'data-field' => 'mName1'
                                ]) }}           
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label("prior1_lname", 'Last Name (family name)') }}
                                <span class="required">*</span>
                                {{ Form::text("prior1_lname", @$step->detail['prior1_lname'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter name'
                                ]) }}                                        
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Is this your maiden name? </label>
                                <span class="required">*</span>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio("prior1_maiden_name", 'no', @$step->detail['prior1_maiden_name'] == 'no' ? true : '', [
                                            'class' => 'custom-control-input'
                                        ]) }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("prior1_maiden_name", 'yes', @$step->detail['prior1_maiden_name'] == 'yes' ? true : '', [
                                            'class' => 'custom-control-input'
                                        ]) }}
                                        <span class="custom-control-label"></span> Yes
                                    </label>
                                </div>
                                <div class="prior1_maiden_name"></div>
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Do you have another prior name to add?</label>
                                <span class="required">*</span>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio("prior_name2", 'no', @$step->detail['prior_name2'] == 'no' ? true : '', [
                                            'class' => 'custom-control-input secondPriorName'
                                        ]) }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("prior_name2", 'yes', @$step->detail['prior_name2'] == 'yes' ? true : '', [
                                            'class' => 'custom-control-input secondPriorName'
                                        ]) }}
                                        <span class="custom-control-label"></span> Yes
                                    </label>
                                </div>
                                <div class="prior_name2"></div>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12 secondPriorNameSec" style="display: {{ @$step->detail['prior_name2'] == 'yes' ? 'block' : 'none'  }}">
                    <h5>Prior Name #2</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label("prior2_fname", 'First Name (given name)') }}
                                <span class="required">*</span>
                                {{ Form::text("prior2_fname", @$step->detail['prior2_fname'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter name'
                                ]) }}                                        
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label("prior2_mname", 'Middle Name') }}
                                <span class="required">*</span>
                                {{ Form::text("prior2_mname", @$step->detail['prior2_mname'], [
                                    'class' => 'form-control mName2',
                                    'placeholder' => 'Enter name'
                                ]) }}
                                {{ Form::label('does_not_apply', "Does Not Apply") }}
                                {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                    'class' => 'custom-control-input doesNotApply',
                                    'data-field' => 'mName2'
                                ]) }}                       
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label("prior2_lname", 'Last Name (family name)') }}
                                <span class="required">*</span>
                                {{ Form::text("prior2_lname", @$step->detail['prior2_lname'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter name'
                                ]) }}                                        
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Is this your maiden name? </label>
                                <span class="required">*</span>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio("prior2_maiden_name", 'no', @$step->detail['prior2_maiden_name'] == 'no' ? true : '', [
                                            'class' => 'custom-control-input'
                                        ]) }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("prior2_maiden_name", 'yes', @$step->detail['prior2_maiden_name'] == 'yes' ? true : '', [
                                            'class' => 'custom-control-input'
                                        ]) }}
                                        <span class="custom-control-label"></span> Yes
                                    </label>
                                </div>
                                <div class="prior2_maiden_name"></div>
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Do you have another prior name to add?</label>
                                <span class="required">*</span>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio("prior_name3", 'no', @$step->detail['prior_name3'] == 'no' ? true : '', [
                                            'class' => 'custom-control-input thirdPriorName'
                                        ]) }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("prior_name3", 'yes', @$step->detail['prior_name3'] == 'yes' ? true : '', [
                                            'class' => 'custom-control-input thirdPriorName'
                                        ]) }}
                                        <span class="custom-control-label"></span> Yes
                                    </label>
                                </div>
                                <div class="prior_name3"></div>
                            </div>                            
                        </div>
                    </div>
                </div>
                <div class="col-md-12 thirdPriorNameSec" style="display: {{ @$step->detail['prior_name3'] == 'yes' ? 'block' : 'none'  }}">
                    <h5>Prior Name #3</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label("prior3_fname", 'First Name (given name)') }}
                                <span class="required">*</span>
                                {{ Form::text("prior3_fname", @$step->detail['prior3_fname'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter name'
                                ]) }}                                        
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label("prior3_mname", 'Middle Name') }}
                                <span class="required">*</span>
                                {{ Form::text("prior3_mname", @$step->detail['prior3_mname'], [
                                    'class' => 'form-control mName3',
                                    'placeholder' => 'Enter name'
                                ]) }}
                                {{ Form::label('does_not_apply', "Does Not Apply") }}
                                {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                    'class' => 'custom-control-input doesNotApply',
                                    'data-field' => 'mName3'
                                ]) }}                
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label("prior3_lname", 'Last Name (family name)') }}
                                <span class="required">*</span>
                                {{ Form::text("prior3_lname", @$step->detail['prior3_lname'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter name'
                                ]) }}                                        
                            </div>                            
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Is this your maiden name? </label>
                                <span class="required">*</span>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio("prior3_maiden_name", 'no', @$step->detail['prior3_maiden_name'] == 'no' ? true : '', [
                                            'class' => 'custom-control-input'
                                        ]) }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("prior3_maiden_name", 'yes', @$step->detail['prior3_maiden_name'] == 'yes' ? true : '', [
                                            'class' => 'custom-control-input'
                                        ]) }}
                                        <span class="custom-control-label"></span> Yes
                                    </label>
                                </div>
                                <div class="prior3_maiden_name"></div>
                            </div>                                                                  
                        </div>
                    </div>
                </div>                
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'name') !!}
        {!! Form::hidden('next', 'contact') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'contact'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseNameBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $(document).on('change', '.firstPriorName', function(){
            if ($(this).val() == 'yes') {
                $('.firstPriorNameSec').show();
            } else {
                $('.firstPriorNameSec').hide();
            }
        });
        $(document).on('change', '.secondPriorName', function(){
            if ($(this).val() == 'yes') {
                $('.secondPriorNameSec').show();
            } else {
                $('.secondPriorNameSec').hide();
            }
        });
        $(document).on('change', '.thirdPriorName', function(){
            if ($(this).val() == 'yes') {
                $('.thirdPriorNameSec').show();
            } else {
                $('.thirdPriorNameSec').hide();
            }
        });

        $(document).on('change', '.fianceeRelated', function(){
            if ($(this).val() == 'yes') {
                $('.fianceeRelatedSec').show();
            } else {
                $('.fianceeRelatedSec').hide();
            }
        });

        $("#spouseName").validate({
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
                phone_number_country: {
                    required: true,
                },
                daytime_phone_number: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                related_to_you: {
                    required: true,
                },
                how_related: {
                    required: true,
                },
                prior_name1: {
                    required: true,
                },
                maiden_name: {
                    required: true,
                },
                prior1_fname: {
                    required: true,
                },
                prior1_mname: {
                    required: true,
                },
                prior1_lname: {
                    required: true,
                },
                prior1_maiden_name: {
                    required: true,
                },
                prior_name2: {
                    required: true,
                },
                prior2_fname: {
                    required: true,
                },
                prior2_mname: {
                    required: true,
                },
                prior2_lname: {
                    required: true,
                },
                prior2_maiden_name: {
                    required: true,
                },
                prior_name3: {
                    required: true,
                },
                prior3_fname: {
                    required: true,
                },
                prior3_mname: {
                    required: true,
                },
                prior3_lname: {
                    required: true,
                },
                prior3_maiden_name: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "gender" || element.attr("name") == "related_to_you" || element.attr("name") == "prior_name1" || element.attr("name") == "prior1_maiden_name" || element.attr("name") == "prior_name2" || element.attr("name") == "prior2_maiden_name" || element.attr("name") == "prior_name3" || element.attr("name") == "prior3_maiden_name") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               first_name: "Please enter your first name!",
               middle_name: "Please enter your middle name!",
               last_name: "Please enter your last name!",
               phone_number_country: "Please choose country!",
               daytime_phone_number: "Please enter phone number!",
               gender: "Please choose gender!",
               related_to_you: "Please choose option!",
               how_related: "Please enter relation!",
               prior_name1: "Please choose option!",
               maiden_name: "Please choose option!",
               prior1_fname: "Please enter name!",
               prior1_mname: "Please enter name!",
               prior1_lname: "Please enter name!",
               prior1_maiden_name: "Please choose option!",
               prior_name2: "Please choose option!",
               prior2_fname: "Please enter name!",
               prior2_mname: "Please enter name!",
               prior2_lname: "Please enter name!",
               prior2_maiden_name: "Please choose option!",
               prior_name3: "Please choose option!",
               prior3_fname: "Please enter name!",
               prior3_mname: "Please enter name!",
               prior3_lname: "Please enter name!",
               prior3_maiden_name: "Please choose option!",
            },
            submitHandler: function(form) {
                $('#spouseNameBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('spouseName') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.name').removeClass('active');
                            $('.contact').addClass('active');
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