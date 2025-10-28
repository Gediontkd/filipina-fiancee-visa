<!-- resources\views\web\visa-application\spouse-visa\sponsor\marital-status.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseMaritalStatus'), 'id' => 'spouseMaritalStatus']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Sponsor's Marital Status</h2>
                    </div>
                    <p class="peragraph text-danger" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants if they are still currently married. The USCIS requires both the U.S citizen sponsor and your fiancé(e) legally free and able to marry in the United States and any previous marriages have been legally terminated by divorce, death, or annulment. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Is this a Proxy Marriage?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('proxy_marriage', 'no', @$step->detail['proxy_marriage'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('proxy_marriage', 'yes', @$step->detail['proxy_marriage'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Were you ever married before your current marriage?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('ever_married_before', 'no', @$step->detail['ever_married_before'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('ever_married_before', 'yes', @$step->detail['ever_married_before'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                        </div>
                    </div>
                </div>
                <div class="ever_married_before"></div>              
                <div class="priorSpouseSec" style="display: {{ @$step->detail['ever_married_before'] == 'yes' ? 'block' : 'none' }};">
                    <p>Enter all Prior Spouses, no matter how many or how far back. You must provide a divorce, annulment or death certificate for all prior spouses with no exceptions. Space is limited to match USCIS forms. Abbreviate as necessary.</p>
                    <div class="appendPriorSpouse">                        
                        @for ($i = 1; $i <= 5; $i++)
                            @if (isset($step->detail["maiden_lname$i"]))
                                @include('web.component.prior-spouse', [
                                    'index' => $i,
                                    'data' => @$step->detail,
                                ])                      
                            @endif
                        @endfor
                    </div>                                   
                    <div class="col-md-6 mb-4">
                        <a class="btn btn-tra-grey addPriorSpouse">+ Add prior spouse</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Do you have any children that are not biological children of your current spouse?  </label>
                    <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0 ">
                            {{ Form::radio('biological_child', 'no', @$step->detail['biological_child'] == 'no' ? true : '', [
                                'class' => 'custom-control-input biologicalChild'
                            ]) }}
                            <span class="custom-control-label"></span> No
                        </label>
                        <label class="custom-control custom-radio mb-0 ">
                            {{ Form::radio('biological_child', 'yes', @$step->detail['biological_child'] == 'yes' ? true : '', [
                                'class' => 'custom-control-input biologicalChild'
                            ]) }}
                            <span class="custom-control-label"></span> Yes
                        </label>                          
                    </div>
                </div>
            </div>
            <div class="col-md-12 biologicalChildSec" style="display:{{ @$step->detail['biological_child'] == 'yes' ? 'block' : 'none' }};">
               <div class="row appendbiologicalChild">                                                        
                    @for ($i = 1; $i <= 9; $i++)
                        @if (isset($step->detail["given_first_name$i"]))
                            @include('web.component.biological-children', [
                                'index' => $i,
                                'data' => @$step->detail,
                            ])                      
                        @endif
                    @endfor
                </div>                                   
                <div class="col-md-6 mb-4">
                    <a class="btn btn-tra-grey addbiologicalChild">+ Add Child</a>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'marital-status') !!}
        {!! Form::hidden('next', 'other-filings') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name',
            'data-section' => 'sponsor',
            'type' => 'button'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'status',
            'data-section' => 'sponsor',
            'type' => 'button'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'other-filings',
            'data-section' => 'sponsor',
            'type' => 'button'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseMaritalStatusBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        // Initialize improved date pickers
        function initDatePickersWithDropdowns() {
            // Date of Birth picker with year dropdown
            $('.dateOfBirth').datepicker({
                dateFormat: 'mm/dd/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: '1900:' + new Date().getFullYear(),
                maxDate: new Date(),
                showButtonPanel: true
            });

            // General date picker for marriage dates
            $('.datePicker').datepicker({
                dateFormat: 'mm/dd/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: '1900:' + (new Date().getFullYear() + 5),
                showButtonPanel: true
            });
        }

        $(document).ready(function(){
            initDatePickersWithDropdowns();
            
            var appendPriorSpouse = $('.appendPriorSpouse > .priorSpouseForm').length;
            if (appendPriorSpouse == 2) {
                $('.addPriorSpouse').addClass('d-none');
            }            
        });

        $("#spouseMaritalStatus").validate({
            rules: {
                proxy_marriage: { required: true },
                ever_married_before: { required: true },
                biological_child: { required: true },
                maiden_lname1: { required: true }, 
                middle_name1: { required: true },
                first_name1: { required: true },
                dob1: { required: true },
                birth_city1: { required: true },
                date_of_marriage1: { required: true },
                city_state_of_marriage1: { required: true },
                date_marriage_ended1: { required: true },
                where_marriage_ended1: { required: true },
                maiden_lname2: { required: true }, 
                middle_name2: { required: true },
                first_name2: { required: true },
                dob2: { required: true },
                birth_city2: { required: true },
                date_of_marriage2: { required: true },
                city_state_of_marriage2: { required: true },
                date_marriage_ended2: { required: true },
                where_marriage_ended2: { required: true },
                given_first_name1: { required: true },
                middle_name1: { required: true },
                last_name1: { required: true },
                relationship1: { required: true },
                child_dob1: { required: true },
                country_of_birth1: { required: true },
                given_first_name2: { required: true },
                middle_name2: { required: true },
                last_name2: { required: true },
                relationship2: { required: true },
                child_dob2: { required: true },
                country_of_birth2: { required: true },
                given_first_name3: { required: true },
                middle_name3: { required: true },
                last_name3: { required: true },
                relationship3: { required: true },
                child_dob3: { required: true },
                country_of_birth3: { required: true },
                given_first_name4: { required: true },
                middle_name4: { required: true },
                last_name4: { required: true },
                relationship4: { required: true },
                child_dob4: { required: true },
                country_of_birth4: { required: true },
                given_first_name5: { required: true },
                middle_name5: { required: true },
                last_name5: { required: true },
                relationship5: { required: true },
                child_dob5: { required: true },
                country_of_birth5: { required: true },
                given_first_name6: { required: true },
                middle_name6: { required: true },
                last_name6: { required: true },
                relationship6: { required: true },
                child_dob6: { required: true },
                country_of_birth6: { required: true },
                given_first_name7: { required: true },
                middle_name7: { required: true },
                last_name7: { required: true },
                relationship7: { required: true },
                child_dob7: { required: true },
                country_of_birth7: { required: true },
                given_first_name8: { required: true },
                middle_name8: { required: true },
                last_name8: { required: true },
                relationship8: { required: true },
                child_dob8: { required: true },
                country_of_birth8: { required: true },
                given_first_name9: { required: true },
                middle_name9: { required: true },
                last_name9: { required: true },
                relationship9: { required: true },
                child_dob9: { required: true },
                country_of_birth9: { required: true }
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "ever_married_before" || element.attr("name") == "biological_child" || element.attr("name") == "proxy_marriage" || element.attr("name") == "relationship1" || element.attr("name") == "relationship2" || element.attr("name") == "relationship3" || element.attr("name") == "relationship4" || element.attr("name") == "relationship5" || element.attr("name") == "relationship6" || element.attr("name") == "relationship7" || element.attr("name") == "relationship8" || element.attr("name") == "relationship9") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }               
            },
            messages: {
               proxy_marriage: "Please choose option!",               
               ever_married_before: "Please choose option!",               
               biological_child: "Please choose option!",               
               maiden_lname1: "Please enter name!",               
               middle_name1: "Please enter name!",               
               first_name1: "Please enter name!",               
               dob1: "Please enter date!",               
               birth_city1: "Please enter city!",               
               date_of_marriage1: "Please enter date!",               
               city_state_of_marriage1: "Please enter city or state!",               
               date_marriage_ended1: "Please enter date!",               
               where_marriage_ended1: "Please enter place!",   
               maiden_lname2: "Please enter name!",               
               middle_name2: "Please enter name!",               
               first_name2: "Please enter name!",               
               dob2: "Please enter date!",               
               birth_city2: "Please enter city!",               
               date_of_marriage2: "Please enter date!",               
               city_state_of_marriage2: "Please enter city or state!",               
               date_marriage_ended2: "Please enter date!",               
               where_marriage_ended2: "Please enter place!",               
               given_first_name1: "Please enter name!",               
               middle_name1: "Please enter name!",               
               last_name1: "Please enter name!",               
               relationship1: "Please choose option!",               
               child_dob1: "Please enter date!",               
               country_of_birth1: "Please choose country!", 
               given_first_name2: "Please enter name!",               
               middle_name2: "Please enter name!",               
               last_name2: "Please enter name!",               
               relationship2: "Please choose option!",               
               child_dob2: "Please enter date!",               
               country_of_birth2: "Please choose country!",
               given_first_name3: "Please enter name!",               
               middle_name3: "Please enter name!",               
               last_name3: "Please enter name!",               
               relationship3: "Please choose option!",               
               child_dob3: "Please enter date!",               
               country_of_birth3: "Please choose country!",
               given_first_name4: "Please enter name!",               
               middle_name4: "Please enter name!",               
               last_name4: "Please enter name!",               
               relationship4: "Please choose option!",               
               child_dob4: "Please enter date!",               
               country_of_birth4: "Please choose country!",
               given_first_name5: "Please enter name!",               
               middle_name5: "Please enter name!",               
               last_name5: "Please enter name!",               
               relationship5: "Please choose option!",               
               child_dob5: "Please enter date!",               
               country_of_birth5: "Please choose country!",
               given_first_name6: "Please enter name!",               
               middle_name6: "Please enter name!",               
               last_name6: "Please enter name!",               
               relationship6: "Please choose option!",               
               child_dob6: "Please enter date!",               
               country_of_birth6: "Please choose country!",
               given_first_name7: "Please enter name!",               
               middle_name7: "Please enter name!",               
               last_name7: "Please enter name!",               
               relationship7: "Please choose option!",               
               child_dob7: "Please enter date!",               
               country_of_birth7: "Please choose country!",
               given_first_name8: "Please enter name!",               
               middle_name8: "Please enter name!",               
               last_name8: "Please enter name!",               
               relationship8: "Please choose option!",               
               child_dob8: "Please enter date!",               
               country_of_birth8: "Please choose country!",
               given_first_name9: "Please enter name!",               
               middle_name9: "Please enter name!",               
               last_name9: "Please enter name!",               
               relationship9: "Please choose option!",               
               child_dob9: "Please enter date!",               
               country_of_birth9: "Please choose country!"
            },
            submitHandler: function(form) {
                $('#spouseMaritalStatusBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('spouseMaritalStatus') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.marital-status').removeClass('active');
                            $('.other-filings').addClass('active');
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

        function priorSpouseHtml(index) {
            var removeBtn = '';
            if (index != 1) {
                removeBtn = '<div class="col-md-6 mb-4"> <a class="btn btn-tra-grey removePriorSpouse">- Remove #'+index+' prior spouse</a> </div>';
            }
            var html = '<div class="priorSpouseForm">'+removeBtn+'<h5>Prior Spouse #'+index+'</h5> <div class="row"> <div class="col-md-4"> <div class="form-group"> <label for="maiden_lname'+index+'">Maiden Last Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="maiden_lname'+index+'" type="text" value="" id="maiden_lname'+index+'"> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="middle_name'+index+'">Middle Name</label> <span class="required">*</span> <input class="form-control middleMame'+index+'" placeholder="Enter name" name="middle_name'+index+'" type="text" value="" id="middle_name'+index+'"><label for="middleMame'+index+'">Does Not Apply</label><input class="custom-control-input doesNotApply" data-field="middleMame'+index+'" type="checkbox"></div> </div> <div class="col-md-4"> <div class="form-group"> <label for="first_name'+index+'">First Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="first_name'+index+'" type="text" value="" id="first_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="dob'+index+'">Date of Birth (mm/dd/yyyy, okay to estimate or enter Unknown)</label> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="mm/dd/yyyy" name="dob'+index+'" type="text" value="" id="dob'+index+'" autocomplete="off"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="birthCity'+index+'">Birth City</label> <span class="required">*</span> <input class="form-control birthCity'+index+'" placeholder="Enter City of Birth" name="birth_city'+index+'" type="text" value="" id="birth_city'+index+'" aria-invalid="false"><label for="birthCity'+index+'">Does Not Apply</label><input class="custom-control-input doesNotApply" data-field="birthCity'+index+'" type="checkbox"></div> </div> <div class="col-md-6"> <div class="form-group"> <label for="date_of_marriage'+index+'">Date of Marriage</label> <span class="required">*</span> <input class="form-control datePicker" placeholder="mm/dd/yyyy" name="date_of_marriage'+index+'" type="text" value="" id="date_of_marriage'+index+'" autocomplete="off"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="city_state_of_marriage'+index+'">City and State of Marriage (city and country if not USA)</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Place of Marriage" name="city_state_of_marriage'+index+'" type="text" value="" id="city_state_of_marriage'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="date_marriage_ended'+index+'">Date Marriage Ended (mm/dd/yyyy, must match divorce/annulment/death document)</label> <span class="required">*</span> <input class="form-control datePicker" placeholder="mm/dd/yyyy" name="date_marriage_ended'+index+'" type="text" value="" id="date_marriage_ended'+index+'" autocomplete="off"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="where_marriage_ended'+index+'">City and State where marriage ended (city and country if not USA) </label> <span class="required">*</span> <input class="form-control" placeholder="City and State where marriage ended" name="where_marriage_ended'+index+'" type="text" value="" id="where_marriage_ended'+index+'"> </div> </div> </div> </div>'; 
            
            // Reinitialize datepickers after adding new HTML
            setTimeout(function() {
                initDatePickersWithDropdowns();
            }, 100);
            
            return html;
        }

        function biologicalChildHtml(index) {
            var removeBtn = '';
            if (index != 1) {
                removeBtn = '<div class="col-md-6 mb-4"> <a class="btn btn-tra-grey removebiologicalChild">- Remove Child</a> </div>';
            }
            var html = '<div class="biologicalChildForm mb-4">'+removeBtn+'<div class="col-md-12"> <div class="form-group"> <label for="given_first_name'+index+'">Given Name (First Name)</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="given_first_name'+index+'" type="text" id="given_first_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="middle_name'+index+'">Middle Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="middle_name'+index+'" type="text" id="middle_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="last_name'+index+'">Last Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="last_name'+index+'" type="text" id="last_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label>Relationship to the beneficiary</label> <div class="radiogroup"> <label class="custom-control custom-radio mb-0 "> <input class="custom-control-input" name="relationship'+index+'" type="radio" value="no"> <span class="custom-control-label"></span> Stepdaughter </label> <label class="custom-control custom-radio mb-0 "> <input class="custom-control-input" name="relationship'+index+'" type="radio" value="yes"> <span class="custom-control-label"></span> Stepson </label> </div> <div class="relationship'+index+'"></div> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="child_dob'+index+'">Date of Birth (mm/dd/yyyy)</label> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="mm/dd/yyyy" name="child_dob'+index+'" type="text" id="child_dob'+index+'" autocomplete="off"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="country_of_birth'+index+'">Country of Birth</label> <span class="required">*</span> <select class="form-control" id="country_of_birth'+index+'" name="country_of_birth'+index+'"> <option value="" selected="selected">-Select Country-</option> @foreach(getCountry() as $country)</option><option value="{{ $country->id }}">{{ $country->name }}</option>@endforeach </select> </div> </div> </div>'; 
            
            // Reinitialize datepickers after adding new HTML
            setTimeout(function() {
                initDatePickersWithDropdowns();
            }, 100);
            
            return html;
        }
    </script>
</div>