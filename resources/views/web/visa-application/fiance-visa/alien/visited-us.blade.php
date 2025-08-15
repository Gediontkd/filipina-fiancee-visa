<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienVisitUS'), 'id' => 'fianceAlienVisitUS']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Visited United States</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Has the alien beneficiary ever been in the USA?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('beneficiary_ever_in_usa', 'no', @$step->detail['beneficiary_ever_in_usa'] == 'no' ? true : '', ['class' => 'custom-control-input anticipated']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('beneficiary_ever_in_usa', 'yes', @$step->detail['beneficiary_ever_in_usa'] == 'yes' ? true : '', ['class' => 'custom-control-input anticipated']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="beneficiary_ever_in_usa"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 anticipatedSec" style="display: {{ @$step->detail['beneficiary_ever_in_usa'] == 'yes' ? 'block' : 'none'  }};">
                    <div class="form-group">
                        <label>Is the alien beneficiary currently in the USA?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('beneficiary_currently_in_usa', 'no', @$step->detail['beneficiary_currently_in_usa'] == 'no' ? true : '', ['class' => 'custom-control-input beneficiaryCurrently']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('beneficiary_currently_in_usa', 'yes', @$step->detail['beneficiary_currently_in_usa'] == 'yes' ? true : '', ['class' => 'custom-control-input beneficiaryCurrently']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="beneficiary_currently_in_usa"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 beneficiaryCurrentlyYesSec" style="display: {{ @$step->detail['beneficiary_currently_in_usa'] == 'yes' ? 'block' : 'none'  }};">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('visa_type', "In what status did he or she last enter the USA?") }}
                                <span class="required">*</span>
                                {{ Form::select("visa_type", getAllVisaType(), @$step->detail['visa_type'], [
                                    'class' => 'form-control'
                                ]) }}                       
                            </div>                                                    
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('i_94_number', 'I-94 Number') }}
                                <span class="required">*</span>
                                {{ Form::text('i_94_number', @$step->detail['i94Number'] ? 'N/A' : @$step->detail['i_94_number'], ['class' => 'form-control i94Number', 'placeholder' => 'Enter I-94 Number']) }}
                                @include('web.component.does-not-apply', ['field' => 'i94Number', 'value' => @$step->detail['i94Number']])     
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label("date_the_alien", "Date the alien last entered the United States (mm/dd/yyyy)") }}
                                <span class="required">*</span>
                                {{ Form::text("date_the_alien", @$step->detail['date_the_alien'], ['class' => 'form-control dateOfBirth', 'placeholder' => "Enter date"]) }}       
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label("stay_expire_date", "Date your stay expires, as shown on the I-94 (mm/dd/yyyy)") }}
                                <span class="required">*</span>
                                {{ Form::text("stay_expire_date", @$step->detail['stayExpireDate'] ? 'N/A' : @$step->detail['stay_expire_date'], ['class' => 'form-control disablePastDate stayExpireDate', 'placeholder' => "Enter date"]) }}
                                @include('web.component.does-not-apply', ['field' => 'stayExpireDate', 'value' => @$step->detail['stayExpireDate']])   
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('passport_number', 'Passport Number') }}
                                <span class="required">*</span>
                                {{ Form::text('passport_number', @$step->detail['passportNumber'] ? 'N/A' : @$step->detail['passport_number'], ['class' => 'form-control passportNumber', 'placeholder' => 'Enter Passport Number']) }}
                                @include('web.component.does-not-apply', ['field' => 'passportNumber', 'value' => @$step->detail['passportNumber']])     
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('travel_document_number', 'Travel Document Number') }}
                                <span class="required">*</span>
                                {{ Form::text('travel_document_number', @$step->detail['travelDocNo'] ? 'N/A' : @$step->detail['travel_document_number'], ['class' => 'form-control travelDocNo', 'placeholder' => 'Enter Travel Document Number']) }}
                                @include('web.component.does-not-apply', ['field' => 'travelDocNo', 'value' => @$step->detail['travelDocNo']])  
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label("travel_expire_date", "Date Passport or Travel Document Expires (mm/dd/yyyy)") }}
                                <span class="required">*</span>
                                {{ Form::text("travel_expire_date", @$step->detail['travelExpDate'] ? 'N/A' : @$step->detail['travel_expire_date'], ['class' => 'form-control disablePastDate travelExpDate', 'placeholder' => "Enter date"]) }}
                                @include('web.component.does-not-apply', ['field' => 'travelExpDate', 'value' => @$step->detail['travelExpDate']]) 
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('country_of_issue', "Country of Issue for Passport or Travel Document") }}
                                <span class="required">*</span>
                                {{ Form::select("country_of_issue", getAllCountry(), @$step->detail['country_of_issue'], [
                                    'class' => 'form-control'
                                ]) }}                       
                            </div>                           
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label("anticipated_date", "Date of arrival (mm/dd/yyyy)") }}
                                <span class="required">*</span>
                                {{ Form::text("anticipated_date", @$step->detail['anticipated_date'], ['class' => 'form-control datePicker', 'placeholder' => "Enter date"]) }}       
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 beneficiaryCurrentlySec">
                    <div class="form-group">
                        {{ Form::label("anticipated_arrival_date", "Date of arrival (mm/dd/yyyy)") }}
                        <span class="required">*</span>
                        {{ Form::text("anticipated_arrival_date", @$step->detail['anticipated_arrival_date'], ['class' => 'form-control datePicker', 'placeholder' => "Enter Anticipated arrival date"]) }}       
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been refused a U.S. Visa, or been refused admission to the United States, or withdrawn your application for admission at the port of entry? <span class="required">*</span></label>                        
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('refused_us_visa', 'no', @$step->detail['refused_us_visa'] == 'no' ? true : '', ['class' => 'custom-control-input deniedAdmissions']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('refused_us_visa', 'yes', @$step->detail['refused_us_visa'] == 'yes' ? true : '', ['class' => 'custom-control-input deniedAdmissions']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="refused_us_visa"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 deniedAdmissionsSec" style="display: {{ @$step->detail['refused_us_visa'] == 'yes' ? 'block' : 'none'  }};">
                    <div class="form-group">
                        {{ Form::label('denied_admissions', 'Explain all denied admissions to the United States') }}
                        <span class="required">*</span>
                        {{ Form::textarea('denied_admissions', @$step->detail['denied_admissions'], ['class' => 'form-control', 'rows' => 4]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Has your beneficiary ever been in the United States?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('visited_us', 'no', @$step->detail['visited_us'] == 'no' ? true : '', ['class' => 'custom-control-input visitedUnitedState']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('visited_us', 'yes', @$step->detail['visited_us'] == 'yes' ? true : '', ['class' => 'custom-control-input visitedUnitedState']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="visited_us"></div>
                        </div>
                    </div>
                </div>
                <div class="row visitedUnitedStateSec" style="display: {{ @$step->detail['visited_us'] == 'yes' ? 'block' : 'none'  }};">
                     <div class="appendVisitedUS">
                        @if (empty(@$step->detail['stayed_primary_city_state1']))
                            @include('web.component.visited-place', [
                                'index' => 1,
                                'data' => @$step->detail,
                            ])
                        @endif
                        @php
                            $i = '';
                        @endphp
                        @for ($i = 1; $i <= 3; $i++)
                            @if (isset($step->detail["stayed_primary_city_state$i"]))
                                @include('web.component.visited-place', [
                                    'index' => $i,
                                    'data' => @$step->detail,
                                ])                         
                            @endif
                        @endfor
                    </div>                                       
                    <div class="col-md-12 mb-4">
                        <a class="btn btn-tra-grey addVisitedUS">+ Add another visit</a>
                    </div>
                </div>    
            </div>            
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'visited-us') !!}
        {!! Form::hidden('next', 'address') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'parents'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'address'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienVisitUSBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            getState($('.countryId').val());
        });

        $(document).on('change', '.countryId', function(){
            var countryId = $(this).val();
            getState(countryId);
        });

        function getState(countryId)
        {
            $.ajax({                
                type: 'get',
                url: "{{ route('getState') }}",
                data: {
                    countryId: countryId
                },
                success: function(data) {
                    $('.states').html(data);                    
                }
            });
        }       

        $("#fianceAlienVisitUS").validate({
            rules: {
                beneficiary_ever_in_usa: {
                    required: true,
                },
                beneficiary_currently_in_usa: {
                    required: true,
                },
                anticipated_arrival_date: {
                    required: true,
                },
                refused_us_visa: {
                    required: true,
                },
                denied_admissions: {
                    required: true,
                },
                visited_us: {
                    required: true,
                },
                stayed_primary_city_state1: {
                    required: true,
                },
                what_visa_type1: {
                    required: true,
                },
                registration_number1: {
                    required: true,
                },
                visited_start_date1: {
                    required: true,
                },
                visited_end_date1: {
                    required: true,
                },
                stayed_primary_city_state2: {
                    required: true,
                },
                what_visa_type2: {
                    required: true,
                },
                registration_number2: {
                    required: true,
                },
                visited_start_date2: {
                    required: true,
                },
                visited_end_date2: {
                    required: true,
                },
                stayed_primary_city_state3: {
                    required: true,
                },
                what_visa_type3: {
                    required: true,
                },
                registration_number3: {
                    required: true,
                },
                visited_start_date3: {
                    required: true,
                },
                visited_end_date3: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "beneficiary_ever_in_usa" || element.attr("name") == "refused_us_visa" || element.attr("name") == "beneficiary_currently_in_usa" || element.attr("name") == "visited_us") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               beneficiary_ever_in_usa: "Please choose option!",               
               beneficiary_currently_in_usa: "Please choose option!",               
               anticipated_arrival_date: "Please choose date!",               
               refused_us_visa: "Please choose option!",               
               denied_admissions: "Please explain!",               
               visited_us: "Please choose option!",               
               stayed_primary_city_state1: "Please enter address!",               
               what_visa_type1: "Please choose visa type!",               
               registration_number1: "Please enter number!",               
               visited_start_date1: "Please enter date!",               
               visited_end_date1: "Please enter date!",  
               stayed_primary_city_state2: "Please enter address!",               
               what_visa_type2: "Please choose visa type!",               
               registration_number2: "Please enter number!",               
               visited_start_date2: "Please enter date!",               
               visited_end_date2: "Please enter date!", 
               stayed_primary_city_state3: "Please enter address!",               
               what_visa_type3: "Please choose visa type!",               
               registration_number3: "Please enter number!",               
               visited_start_date3: "Please enter date!",               
               visited_end_date3: "Please enter date!",               
            },
            submitHandler: function(form) {
                $('#fianceAlienVisitUSBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienVisitUS') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activevisited-us').removeClass('active');
                            $('.activeaddress').addClass('active');
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

         $(document).on('change', '.anticipated', function(){
            if ($(this).val() == 'yes') {
                $('.anticipatedSec').show();                
            } 
            if ($(this).val() == 'no') {
                $('.anticipatedSec').hide();                
            }
        });

        $(document).on('change', '.beneficiaryCurrently', function(){
            if ($(this).val() == 'yes') {
                $('.beneficiaryCurrentlySec').hide();
                $('.beneficiaryCurrentlyYesSec').show();
            } 
            if ($(this).val() == 'no') {
                $('.beneficiaryCurrentlyYesSec').hide();
                $('.beneficiaryCurrentlySec').show();
            }
        });  
        
        $(document).on('change', '.deniedAdmissions', function(){
            if ($(this).val() == 'yes') {
                $('.deniedAdmissionsSec').show();
            } else {
                $('.deniedAdmissionsSec').hide();
            }
        }); 

        $(document).on('change', '.visitedUnitedState', function(){
            if ($(this).val() == 'yes') {
                $('.visitedUnitedStateSec').show();
                $('.addfirstPlace').removeClass('d-none');
            } else {
                $('.visitedUnitedStateSec').hide();
                $('.addfirstPlace').addClass('d-none');
            }
        });        

        function visitedPlaceForm(index) {
            return '<div class="row visitedUSForm"> <div class="col-md-12 mb-4"><a class="btn btn-tra-grey removeVisitedUS">- Remove</a></div> <h5>Visit #'+index+'</h5> <div class="col-md-6"> <div class="form-group"> <label for="stayed_primary_city_state'+index+'">Primary city and state where you stayed.</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Primary city and state where you stayed" name="stayed_primary_city_state'+index+'" type="text" id="stayed_primary_city_state'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="what_visa_type'+index+'">Type of visa you used to enter the United States</label> <span class="required">*</span> <select class="form-control" id="what_visa_type'+index+'" name="what_visa_type'+index+'">@foreach(getAllVisaType() as $visaType) <option value="{{$visaType}}">{{$visaType}}</option> @endforeach </select> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="registration_number'+index+'">Your Alien Registration Number. You would not have one if you were a tourist.</label> <span class="required">*</span> <input class="form-control regNo'+index+'" placeholder="Enter Registration Number" name="registration_number'+index+'" type="text" id="registration_number'+index+'"><label for="does_not_apply">None</label> <input class="custom-control-input doesNotApply" data-field="regNo'+index+'" type="checkbox" id="does_not_apply"></div> </div> <div class="col-md-6"> <div class="form-group"> <label for="visited_start_date'+index+'">Start date of this visit.  mm/dd/yyyy</label> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="Enter date" name="visited_start_date'+index+'" type="text" id="visited_start_date'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="visited_end_date'+index+'">End date of this visit.  mm/dd/yyyy</label> <span class="required">*</span> <input class="form-control disablePastDate" placeholder="Enter date" name="visited_end_date'+index+'" type="text" id="visited_end_date'+index+'"> </div> </div> </div>'; } 
    </script>                                
</div>