<!-- resources\views\web\visa-application\adjustment-of-status\civil-status.blade.php -->
<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentCivilStatus'), 'id' => 'adjustmentCivilStatus']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>{{$type}}'s Marital Status</h2>
                <p>List the date and place of your current marriage.</p>
            </div>
            <div class="row">                
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('wedding_date', "Wedding Date (mm/dd/yyyy)") }}
                        <span class="required">*</span>
                        {{ Form::text('wedding_date', @$step->detail['wedding_date'], [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'Enter Date'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('wedding_city', "Wedding City") }}
                        <span class="required">*</span>
                        {{ Form::text('wedding_city', @$step->detail['wedding_city'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter City'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('wedding_state', "Wedding State, Province or Region") }}
                        <span class="required">*</span>
                        {{ Form::text('wedding_state', @$step->detail['wedding_state'], [
                            'class' => 'form-control weddingState',
                            'placeholder' => 'Enter State'
                        ]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => 'weddingState'
                        ]) }} 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('wedding_country', "Wedding Country") }}
                        <span class="required">*</span>
                        {{ Form::select('wedding_country', getAllCountry(), @$step->detail['wedding_country'], [
                            'class' => 'form-control',
                        ]) }}                       
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever used another name including a maiden name but not including nicknames?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('nickname', 'no', @$step->detail['nickname'] == false ? true : '', [
                                    'class' => 'custom-control-input firstPriorName'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('nickname', 'yes', @$step->detail['nickname'] == true ? true : '', [
                                    'class' => 'custom-control-input firstPriorName'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="nickname"></div>
                    </div>
                </div>
                <div class="col-md-12 firstPriorNameSec" style="display: {{ @$step->detail['name1'] == true ? 'block' : 'none'  }}">
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
                                        {{ Form::radio("prior_name2", 'no', @$step->detail['prior_name2'] == false ? true : '', [
                                            'class' => 'custom-control-input secondPriorName'
                                        ]) }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("prior_name2", 'yes', @$step->detail['prior_name2'] == true ? true : '', [
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
                <div class="col-md-12 secondPriorNameSec" style="display: {{ @$step->detail['prior_name2'] == true ? 'block' : 'none'  }}">
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
                                        {{ Form::radio("prior_name3", 'no', @$step->detail['prior_name3'] == false ? true : '', [
                                            'class' => 'custom-control-input thirdPriorName'
                                        ]) }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("prior_name3", 'yes', @$step->detail['prior_name3'] == true ? true : '', [
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
                <div class="col-md-12 thirdPriorNameSec" style="display: {{ @$step->detail['prior_name3'] == true ? 'block' : 'none'  }}">
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
                <div class="col-md-12">
                     <div class="form-group">
                        <label>Was the alien ever married before the current marriage? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('prior_name1', 'no', @$step->detail['prior_name1'] == false ? true : '', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('prior_name1', 'yes', @$step->detail['prior_name1'] == true ? true : '', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="prior_name1"></div>
                    </div>
                </div>
                <div class="col-md-12 priorSpouseSec" style="display: none;">
                    <div class="appendPriorSpouse">                        
                        @for ($i = 1; $i <= 2; $i++)
                            @if (isset($step->detail["marriage$i"]))
                                @include('web.component.marriage', [
                                    'index' => $i,
                                    'sec' => '',
                                    'data' => @$step->detail,
                                ])                            
                            @endif
                        @endfor
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-tra-grey addPriorSpouse">+ Add second prior spouse</a>
                    </div>
                </div>  
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'civil-status') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'sponsor-part-1') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'address'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'sponsor-part-1'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentCivilStatusBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
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

        $("#adjustmentCivilStatus").validate({
            rules: {
                wedding_date: {
                    required: true,
                },
                wedding_city: {
                    required: true,
                },
                wedding_state: {
                    required: true,
                },
                wedding_country: {
                    required: true,
                },
                nickname: {
                    required: true,
                },
                adoption_or_court_order: {
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
                last_name1: {
                    required: true,
                },
                first_name1: {
                    required: true,
                },
                middle_name1: {
                    required: true,
                },
                dob1: {
                    required: true,
                },
                date_of_marriage1: {
                    required: true,
                },
                first_city_town1: {
                    required: true,
                },
                first_state_province1: {
                    required: true,
                },
                first_country1: {
                    required: true,
                },
                first_date_marriage_ended1: {
                    required: true,
                },
                second_city_town1: {
                    required: true,
                },
                second_state_province1: {
                    required: true,
                },
                second_country1: {
                    required: true,
                },
                last_name2: {
                    required: true,
                },
                first_name2: {
                    required: true,
                },
                middle_name2: {
                    required: true,
                },
                dob2: {
                    required: true,
                },
                date_of_marriage2: {
                    required: true,
                },
                first_city_town2: {
                    required: true,
                },
                first_state_province2: {
                    required: true,
                },
                first_country2: {
                    required: true,
                },
                first_date_marriage_ended2: {
                    required: true,
                },
                second_city_town2: {
                    required: true,
                },
                second_state_province2: {
                    required: true,
                },
                second_country2: {
                    required: true,
                },             
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "nickname" || element.attr("name") == "adoption_or_court_order" || element.attr("name") == "prior1_maiden_name" || element.attr("name") == "prior_name2"|| element.attr("name") == "prior2_maiden_name"|| element.attr("name") == "prior3_maiden_name") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
                wedding_date: "Please enter date!",                          
                wedding_city: "Please enter city!",                          
                wedding_state: "Please enter state!",                          
                wedding_country: "Please enter country!",                          
                nickname: "Please choose option!",                          
                adoption_or_court_order: "Please choose option!",                          
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
                last_name1: "PLease enter name!",
                first_name1: "PLease enter name!",
                middle_name1: "PLease enter name!",
                dob1: "PLease enter date of birth!",
                date_of_marriage1: "PLease enter date!",
                first_city_town1: "PLease enter address!",
                first_state_province1: "PLease enter address!",
                first_country1: "PLease choose country!",
                first_date_marriage_ended1: "PLease enter date!",
                second_city_town1: "PLease enter address!",
                second_state_province1: "PLease enter address!",
                second_country1: "PLease choose country!",
                last_name2: "PLease enter name!",
                first_name2: "PLease enter name!",
                middle_name2: "PLease enter name!",
                dob2: "PLease enter date of birth!",
                date_of_marriage2: "PLease enter date!",
                first_city_town2: "PLease enter address!",
                first_state_province2: "PLease enter address!",
                first_country2: "PLease choose country!",
                first_date_marriage_ended2: "PLease enter date!",
                second_city_town2: "PLease enter address!",
                second_state_province2: "PLease enter address!",
                second_country2: "PLease choose country!",                                      
            },
            submitHandler: function(form) {
                $('#adjustmentCivilStatusBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentCivilStatus') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.civil-status').removeClass('active');
                            $('.sponsor-part-1').addClass('active');
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

        function priorSpouseHtml(index) {
            datePicker();
            removeBtn = '';
            if (index != 1) {
                removeBtn = '<a class="btn btn-tra-grey removePriorSpouse">- Remove '+index+' prior spouse</a>';
            }
            return '<div class="priorSpouseForm"> <div class="col-md-12 mb-4"> '+removeBtn+' </div> <h5>Prior Spouse #'+index+'</h5> <div class="row"> <div class="col-md-12"> <div class="form-group"> <label for="last_name'+index+'">Last Name (maiden name for wife)</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="last_name'+index+'" type="text" id="last_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="first_name'+index+'">First Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="first_name'+index+'" type="text" id="first_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="middle_name'+index+'">Middle Name</label> <span class="required">*</span> <input class="form-control middleName'+index+'" placeholder="Enter name" name="middle_name'+index+'" type="text" id="middle_name'+index+'"> <label for="does_not_apply">Does Not Apply</label> <input class="custom-control-input doesNotApply" data-field="middleName'+index+'" name="does_not_apply" type="checkbox" value="'+index+'" id="does_not_apply"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="dob'+index+'">Date of Birth</label> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="Enter Date of Birth" name="dob'+index+'" type="text" id="dob'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="date_of_marriage'+index+'">Date of Marriage</label> <span class="required">*</span> <input class="form-control datePicker" placeholder="Enter Date Of Marriage" name="date_of_marriage'+index+'" type="text" id="date_of_marriage'+index+'"> </div> </div> <h5>Place of Marriage to Prior Spouse</h5> <div class="col-md-12"> <div class="form-group"> <label for="first_city_town'+index+'">City Or Town</label> <span class="required">*</span> <input class="form-control" placeholder="Enter City Or Town" name="first_city_town'+index+'" type="text" id="first_city_town'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="first_state_province'+index+'">State or Province</label> <span class="required">*</span> <input class="form-control" placeholder="Enter State or Province" name="first_state_province'+index+'" type="text" id="first_state_province'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="first_country'+index+'">Country</label> <span class="required">*</span> <select class="form-control" id="first_country'+index+'" name="first_country'+index+'"><option value="" selected="selected">-Select Country-</option>@foreach (getAllCountry() as $country) <option value="{{$country}}">{{$country}}</option> @endforeach</select> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="first_date_marriage_ended'+index+'">Date Marriage Ended</label> <span class="required">*</span> <input class="form-control datePicker" placeholder="Enter Date Marriage Ended" name="first_date_marriage_ended'+index+'" type="text" id="first_date_marriage_ended'+index+'"> </div> </div> <h5>Place Where Marriage with Prior Spouse Legally Ended</h5> <div class="col-md-12"> <div class="form-group"> <label for="second_city_town'+index+'">City Or Town</label> <span class="required">*</span> <input class="form-control" placeholder="Enter City Or Town" name="second_city_town'+index+'" type="text" id="second_city_town'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="second_state_province'+index+'">State or Province</label> <span class="required">*</span> <input class="form-control" placeholder="Enter State or Province" name="second_state_province'+index+'" type="text" id="second_state_province'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="second_country'+index+'">Country</label> <span class="required">*</span> <select class="form-control" id="second_country'+index+'" name="second_country'+index+'"><option value="" selected="selected">-Select Country-</option>@foreach (getAllCountry() as $country) <option value="{{$country}}">{{$country}}</option> @endforeach</select> </div> </div> </div> </div></div>';
        }
    </script>   
</div>