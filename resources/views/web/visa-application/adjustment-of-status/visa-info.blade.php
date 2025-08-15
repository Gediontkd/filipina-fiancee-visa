<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentvisaInfo'), 'id' => 'adjustmentvisaInfo']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>AOS Information</h2>
                <h2>{{$type}}'s Visa Information</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("visa_no", "Visa Number") }}
                        <span class="required">*</span>
                        {{ Form::text("visa_no", @$step->detail['visa_no'], ['class' => 'form-control visa_no', 'placeholder' => "Enter Visa Number"]) }}
                        <div>
                            {{ Form::label("does_not_apply", "None") }}
                            {{ Form::checkbox("does_not_apply", true, @$step->detail['does_not_apply'] == true ? true : '', [
                                'class' => 'custom-control-input doesNotApply',
                                'data-field' => 'visa_no'
                            ]) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("visa_issued", "Date your visa was issued, as indicated on the visa. (mm/dd/yyyy)") }}
                        <span class="required">*</span>
                        {{ Form::text("visa_issued", @$step->detail['visa_issued'], ['class' => 'form-control dateOfBirth', 'placeholder' => "Enter Date"]) }}
                    </div>
                </div>               
                <div class="col-md-12">
                    <h5>Place of Last Arrival into the United States</h5>
                    <div class="form-group">
                        {{ Form::label("city_town", "City or Town") }}
                        <span class="required">*</span>
                        {{ Form::text("city_town", @$step->detail['city_town'], ['class' => 'form-control', 'placeholder' => "Enter City or Town"]) }}
                    </div>
                </div>                
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('us_states', "U.S. State (Select Does Not Apply if not USA)") }}
                        <span class="required">*</span>
                        {{ Form::select('us_states', [], @$step->detail['us_states'], ['class' => 'form-control states',]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("entered_us", "Date you last entered the United States (mm/dd/yyyy)") }}
                        <span class="required">*</span>
                        {{ Form::text("entered_us", @$step->detail['entered_us'], ['class' => 'form-control dateOfBirth', 'placeholder' => "Enter Date"]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <h5>Form I-94 Arrival-Departure Information</h5>
                    <div class="form-group">
                        {{ Form::label("i_94_no", "I-94 Number (no spaces) Get it here if you don't know it") }}
                        <span class="required">*</span>
                        {{ Form::text("i_94_no", @$step->detail['i_94_no'], ['class' => 'form-control', 'placeholder' => "Enter Number"]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("authorized_exp_date", "Expiration Date of Authorized Stay Shown on I-94 (mm/dd/yyyy)") }}
                        <span class="required">*</span>
                        {{ Form::text("authorized_exp_date", @$step->detail['authorized_exp_date'], ['class' => 'form-control disablePastDate', 'placeholder' => "Enter Date"]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("current_immig_status", "What is your current immigration status?") }}
                        <span class="required">*</span>
                        {{ Form::text("current_immig_status", @$step->detail['current_immig_status'], ['class' => 'form-control', 'placeholder' => "Enter Status"]) }}
                    </div>
                </div>
                <h5>Your name exactly as it appears on the I-94</h5>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("last_name", "Last Name") }}
                        <span class="required">*</span>
                        {{ Form::text("last_name", @$step->detail['last_name'], ['class' => 'form-control', 'placeholder' => "Enter Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("first_name", "First Name") }}
                        <span class="required">*</span>
                        {{ Form::text("first_name", @$step->detail['first_name'], ['class' => 'form-control', 'placeholder' => "Enter Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("middle_name", "Middle Name") }}
                        <span class="required">*</span>
                        {{ Form::text("middle_name", @$step->detail['middle_name'], ['class' => 'form-control', 'placeholder' => "Enter Name"]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("reg_no", "$type's Registration Number or A#") }}
                        <span class="required">*</span>
                        {{ Form::text("reg_no", @$step->detail['reg_no'], ['class' => 'form-control reg_no', 'placeholder' => "Enter Number"]) }}
                        <div>
                            {{ Form::label("does_not_apply", "None") }}
                            {{ Form::checkbox("does_not_apply", true, @$step->detail['does_not_apply'] == true ? true : '', [
                                'class' => 'custom-control-input doesNotApply',
                                'data-field' => 'reg_no'
                            ]) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("travel_doc_no", "$type's Travel Document Number") }}
                        <span class="required">*</span>
                        {{ Form::text("travel_doc_no", @$step->detail['travel_doc_no'], ['class' => 'form-control travel_doc_no', 'placeholder' => "Enter Number"]) }}
                        <div>
                            {{ Form::label("does_not_apply", "None") }}
                            {{ Form::checkbox("does_not_apply", true, @$step->detail['does_not_apply'] == true ? true : '', [
                                'class' => 'custom-control-input doesNotApply',
                                'data-field' => 'travel_doc_no'
                            ]) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("passport_listed", "Date that your Passport listed on your I-94 expires") }}
                        <span class="required">*</span>
                        {{ Form::text("passport_listed", @$step->detail['passport_listed'], ['class' => 'form-control datePicker', 'placeholder' => "Enter Date"]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('issued_travel_doc', "Country that Issued the Passport or Travel Document") }}
                        <span class="required">*</span>
                        {{ Form::select('issued_travel_doc', getAllCountry(), @$step->detail['issued_travel_doc'], ['class' => 'form-control',]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("receipt_no", "Receipt Number of Underlying Petition. Do not include dashes. (if any)") }}
                        <span class="required">*</span>
                        {{ Form::text("receipt_no", @$step->detail['receipt_no'], ['class' => 'form-control', 'placeholder' => "Enter Number"]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("priority_date", "Priority Date from Underlying Petition (mm/dd/yyyy)") }}
                        <span class="required">*</span>
                        {{ Form::text("priority_date", @$step->detail['priority_date'], ['class' => 'form-control datePicker', 'placeholder' => "Enter Date"]) }}
                        <div>
                            {{ Form::label("does_not_apply", "None") }}
                            {{ Form::checkbox("does_not_apply", true, @$step->detail['does_not_apply'] == true ? true : '', [
                                'class' => 'custom-control-input doesNotApply',
                                'data-field' => 'priority_date'
                            ]) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you been issued a new passport since the one listed on your I-94? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('listed_on_i_94', 'no', @$step->detail['listed_on_i_94'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input listedOnI94'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('listed_on_i_94', 'yes', @$step->detail['listed_on_i_94'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input listedOnI94'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="listed_on_i_94"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 listedOnI94Sec" style="display:{{ @$step->detail['listed_on_i_94'] == 'yes' ? 'block' : 'none' }};">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label("recently_issued_pass", "What is your most recently issued passport number?") }}
                                <span class="required">*</span>
                                {{ Form::text("recently_issued_pass", @$step->detail['recently_issued_pass'], ['class' => 'form-control', 'placeholder' => "Enter Issue"]) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label("passport_exp_date", "What is your most recently issued passport expiration date?") }}
                                <span class="required">*</span>
                                {{ Form::text("passport_exp_date", @$step->detail['passport_exp_date'], ['class' => 'form-control disablePastDate', 'placeholder' => "Enter Date"]) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('pass_country_issue', "What country is your most recently issued passport from?") }}
                                <span class="required">*</span>
                                {{ Form::select('pass_country_issue', getAllCountry(), @$step->detail['pass_country_issue'], ['class' => 'form-control',]) }}
                            </div>
                        </div>
                    </div>
                </div>
                <h5>What consulate or embassy issued your visa?</h5>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('embassy_country', "Embassy Country") }}
                        <span class="required">*</span>
                        {{ Form::select('embassy_country', getEmbassyCountries(), @$step->detail['embassy_country'], ['class' => 'form-control embassyCountryId',]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('embassy_city', "Embassy City") }}
                        <span class="required">*</span>
                        {{ Form::select('embassy_city', ['-Select City-'], @$step->detail['embassy_city'], [
                            'class' => 'form-control cities',
                            'disabled' => true
                        ]) }}
                        {{ Form::hidden('embassy_city', @$step->detail['embassy_city'], ['class' => 'embassyCity']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <h6>List all countries where you are currently a citizen or national <span class="required">*</span></h6>
                        <div class="appendCountry">
                            @if (empty($step->detail["country1"]))
                                @include('web.component.country', [
                                    'index' => 1,
                                    'sec' => '',
                                    'data' => @$step->detail,
                                ])
                            @endif                   
                            @php
                                $i = '';
                            @endphp
                            @for ($i = 1; $i <= 2; $i++)
                                @if (isset($step->detail["country$i"]))
                                    @include('web.component.country', [
                                        'index' => $i,
                                        'sec' => '',
                                        'data' => @$step->detail,
                                    ])                            
                                @endif
                            @endfor
                        </div>
                        <div class="">
                            <a class="btn btn-tra-grey addCountryBtn">+ Add Another Country Visited</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you, the {{$type}}, ever previously applied for an immigrant visa to obtain permanent resident status at a U.S. Embassy or U.S. Consulate abroad? Do not include any K-1 Fiance(e) Visa applications. <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('previously_applied', 'no', @$step->detail['previously_applied'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input previouslyApplied'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('previously_applied', 'yes', @$step->detail['previously_applied'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input previouslyApplied'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="previously_applied"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 previouslyAppliedSec" style="display: none;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label("city", "City") }}
                                <span class="required">*</span>
                                {{ Form::text("city", @$step->detail['city'], ['class' => 'form-control', 'placeholder' => "Enter City"]) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('country', "Country") }}
                                <span class="required">*</span>
                                {{ Form::select('country', getAllCountry(), @$step->detail['country'], ['class' => 'form-control',]) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label("decision", "Decision(for example, approved, refused, denied, withdrawn)") }}
                                <span class="required">*</span>
                                {{ Form::text("decision", @$step->detail['decision'], ['class' => 'form-control', 'placeholder' => "Enter Decision"]) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label("date_of_decision", "Date of Decision (mm/dd/yyyy)") }}
                                <span class="required">*</span>
                                {{ Form::text("date_of_decision", @$step->detail['date_of_decision'], ['class' => 'form-control datePicker', 'placeholder' => "Enter Date"]) }}
                            </div>
                        </div>
                    </div>
                </div>
                <h6>Please provide the city and state that the U.S. Citizenship and Immigration Services (USCIS) office is where you plan to apply for legal permanent residence. Please visit the Field Office Locator at the bottom of this page to determine where your closest USCIS office is. </h6>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("uscis_city_town", "City or Town") }}
                        <span class="required">*</span>
                        {{ Form::text("uscis_city_town", @$step->detail['uscis_city_town'], ['class' => 'form-control', 'placeholder' => "Enter City or Town"]) }}
                    </div>
                </div>
                 <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('uscis_states', "State") }}
                        <span class="required">*</span>
                        {{ Form::select('uscis_states', [], @$step->detail['us_states'], ['class' => 'form-control states',]) }}
                    </div>
                </div>
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'visa-info') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'address') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'place-of-birth'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'address'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentvisaInfoBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            getState(231);
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

        $(document).on('change', '.listedOnI94', function(){
            if ($(this).val() == 'yes') {
                $('.listedOnI94Sec').show();
            } else {
                $('.listedOnI94Sec').hide();
            }
        });

        $(document).on('change', '.previouslyApplied', function(){
            if ($(this).val() == 'yes') {
                $('.previouslyAppliedSec').show();
            } else {
                $('.previouslyAppliedSec').hide();
            }
        });

        $(document).on('change', '.embassyCountryId', function(){
            var countryId = $(this).val();
            getCity(countryId);
        });
        
        function getCity(countryId)
        {
            $.ajax({                
                type: 'get',
                url: "{{ route('getCities') }}",
                data: {
                    countryId: countryId,
                },
                success: function(data) {
                    $('.cities').attr('disabled', false);                    
                    $('.cities').html(data);                    
                }
            });
        }

        $(document).ready(function(){
            var countryCount = $('.appendCountry > .countryForm').length;
            var residedCounCount = $('.appendResidedCounReg > .residedCounReg').length;
            if (countryCount == 2) {
                $('.addCountryBtn').addClass('d-none');
            }
        });

        $("#adjustmentvisaInfo").validate({
            rules: {
                visa_no: {
                    required: true,
                },
                visa_issued: {
                    required: true,
                },
                city_town: {
                    required: true,
                },
                us_states: {
                    required: true,
                },
                entered_us: {
                    required: true,
                },
                i_94_no: {
                    required: true,
                },
                authorized_exp_date: {
                    required: true,
                },
                current_immig_status: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                first_name: {
                    required: true,
                },
                middle_name: {
                    required: true,
                },
                reg_no: {
                    required: true,
                },
                travel_doc_no: {
                    required: true,
                },
                passport_listed: {
                    required: true,
                },
                issued_travel_doc: {
                    required: true,
                },
                receipt_no: {
                    required: true,
                },
                priority_date: {
                    required: true,
                },
                listed_on_i_94: {
                    required: true,
                },
                recently_issued_pass: {
                    required: true,
                },
                passport_exp_date: {
                    required: true,
                },
                pass_country_issue: {
                    required: true,
                },
                embassy_country: {
                    required: true,
                },
                embassy_city: {
                    required: function(element) {
                       return $('#embassy_country').is(':filled');
                    },
                },
                country1: {
                    required: true,
                },
                country2: {
                    required: true,
                },
                previously_applied: {
                    required: true,
                },
                city: {
                    required: true,
                },
                country: {
                    required: true,
                },
                decision: {
                    required: true,
                },
                date_of_decision: {
                    required: true,
                },
                uscis_city_town: {
                    required: true,
                },
                uscis_states: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "listed_on_i_94" || element.attr("name") == "previously_applied") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               visa_no: "Please enter number!",                          
               visa_issued: "Please enter date!",                          
               city_town: "Please enter city or town!",                          
               us_states: "Please choose state!",                          
               entered_us: "Please enter date!",                          
               i_94_no: "Please enter number!",                          
               authorized_exp_date: "Please enter date!",                          
               current_immig_status: "Please enter status!",                          
               last_name: "Please enter name!",                          
               first_name: "Please enter name!",                          
               middle_name: "Please enter name!",                          
               reg_no: "Please enter number!",                          
               travel_doc_no: "Please enter number!",                          
               passport_listed: "Please enter date!",                          
               issued_travel_doc: "Please choose country!",                          
               receipt_no: "Please enter number!",                          
               priority_date: "Please enter date!",                          
               listed_on_i_94: "Please choose option!",                          
               recently_issued_pass: "Please enter issue!",                          
               passport_exp_date: "Please enter issue!",                          
               pass_country_issue: "Please enter issue!",                          
               embassy_country: "Please choose country!",                          
               embassy_city: "Please choose city!",                          
               country1: "Please choose country!",                          
               country2: "Please choose country!",                          
               previously_applied: "Please choose option!",                          
               city: "Please choose city!",                          
               country: "Please choose country!",                          
               decision: "Please enter decision!",                          
               date_of_decision: "Please enter date!",                          
               uscis_city_town: "Please enter city or town!",                          
               uscis_states: "Please choose state!",                          
            },
            submitHandler: function(form) {
                $('#adjustmentvisaInfoBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentvisaInfo') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.visa-info').removeClass('active');
                            $('.address').addClass('active');
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

        function addAnotherCountry(index) {
            return '<div class="countryForm"><div class="pb-4"><a class="btn btn-tra-grey removeCountry">- Remove</a></div><div class="form-group"><select class="form-control countryId" name="country'+index+'"><option value="">-Select Country-</option>@foreach(getCountry() as $country)</option><option value="{{ $country->id }}">{{ $country->name }}</option>@endforeach</select></div></div>';
        }  
    </script>   
</div>