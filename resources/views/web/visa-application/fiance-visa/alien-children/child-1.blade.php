<!-- resources\views\web\visa-application\fiance-visa\alien-children\child-1.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienChild1'), 'id' => 'fianceAlienChild1']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Children of Alien Beneficiary</h2>    
                        <p>You must list all children but only children age 20 or younger can immigrate with your fiancée.</p>                    
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Does the alien beneficiary have children?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('beneficiary', 'no', @$step->detail['beneficiary'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input beneficiary'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('beneficiary', 'yes', @$step->detail['beneficiary'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input beneficiary'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                            <div class="beneficiary"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 ms-3 beneficiarySec" style="display: {{ @$step->detail['beneficiary'] == 'yes' ? 'block' : 'none' }};">
                    <div class="row">                        
                        <p class="text-danger">Your children must travel within the validity of their K-2 visas. Separate petitions are not required
                            if the children accompany or following to join you within one year from the date of issuance of
                            your K-1 visa. If they want to travel later than one year from the date your K-1 visa was issued,
                            they will not be eligible to receive K-2 visas, and separate immigrant visa petitions will be
                            required. If your child has a valid K-2 visa and you have already adjusted status to that of
                            permanent resident, your child may still travel on the K-2 visa. Note that if this child is not
                            traveling to the USA at the same time as the alien parent, the child is not eligible for Filipina
                            Fiancée Visa’s child discount when doing their Adjustment of Status. <b>If the child is the biological
                                child of the Petioner, they cannot receive a visa as part of this petition.</b></p>

                        <p>List children who are immigrating first, followed by children who will not be coming.</p>
                        <h4>Child 1</h4>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label("first_name", "First Name") }}
                                <span class="required">*</span>
                                {{ Form::text("first_name", @$step->detail["first_name"], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Name'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label("middle_name", "Middle Name") }}
                                <span class="required">*</span>
                                {{ Form::text("middle_name", @$step->detail["middle_name"], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Name'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label("last_name", "Last Name") }}
                                <span class="required">*</span>
                                {{ Form::text("last_name", @$step->detail["last_name"], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Name'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Is the address for this child the same as the alien parent?</label>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio("child_address", 'no', @$step->detail["child_address"] == 'no' ? true : '', [
                                                'class' => 'custom-control-input childAddress',
                                            ])
                                        }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("child_address", 'yes', @$step->detail["child_address"] == 'yes' ? true : '', [
                                                'class' => 'custom-control-input childAddress',
                                            ]) 
                                        }}
                                        <span class="custom-control-label"></span> Yes
                                    </label>
                                    <div class="child_address"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 childAddressNo" style="display: none;">
                            <div class="form-group">
                                {{ Form::label("street", "Street") }}
                                <span class="required">*</span>
                                {{ Form::text("street", @$step->detail["street"], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Street'
                                ]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('apartment_suite_or_floor', 'Apartment, Suite or Floor?') }}
                                <span class="required">*</span>
                                {{ Form::select('apartment_suite_or_floor', [
                                    '' => 'Select', 
                                    'Apartment' => 'Apartment',
                                    'Suite' => 'Suite',
                                    'Floor' => 'Floor',
                                    'Dose Not Apply' => 'Dose Not Apply'
                                ], @$step->detail['apartment_suite_or_floor'], [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number') }}
                                <span class="required">*</span>
                                {{ Form::text('apartment_suite_or_floor_no', @$step->detail['apartment_suite_or_floor_no'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Please Enter Apartment, Suite or Floor Number'
                                ]) }}                        
                            </div>
                            <div class="form-group">
                                {{ Form::label('city', 'City') }}
                                <span class="required">*</span>
                                {{ Form::text('city', @$step->detail['city'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Please Enter City'
                                ]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('province', 'Province (State if USA) Enter None if appropriate.') }}
                                <span class="required">*</span>
                                {{ Form::text('province', @$step->detail['province'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Please Enter Province'
                                ]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label('country', "Country") }}
                                <span class="required">*</span>
                                {{ Form::select('country', getAllCountry(), @$step->detail['country'], [
                                    'class' => 'form-control countryId'
                                ]) }}                        
                            </div>
                            <div class="form-group">
                                {{ Form::label('postal_code', 'Postal Code') }}
                                <span class="required">*</span>
                                {{ Form::text('postal_code', @$step->detail['postal_code'], [
                                    'class' => 'form-control postalCode',
                                    'placeholder' => 'Please Enter Postal Code'
                                ]) }}
                                {{ Form::label('does_not_apply', "Does Not Apply") }}
                                {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                    'class' => 'custom-control-input doesNotApply',
                                    'data-field' => "postalCode"
                                ]) }}
                            </div>
                            
                        </div>                        
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label("dob", "Date of Birth (mm/dd/yyyy)") }}
                                <span class="required">*</span>
                                {{ Form::text("dob", @$step->detail["dob"], [
                                    'class' => 'form-control dateOfBirth',
                                    'placeholder' => 'Enter Date of Birth'
                                ]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label("cob", "City of Birth") }}
                                <span class="required">*</span>
                                {{ Form::text("cob", @$step->detail["cob"], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter City of Birth'
                                ]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label("state_province", "State or Province of Birth") }}
                                <span class="required">*</span>
                                {{ Form::text("state_province", @$step->detail['stateProvince'] ? 'N/A' : @$step->detail["state_province"], [
                                    'class' => 'form-control stateProvince',
                                    'placeholder' => 'Enter State or Province of Birth'
                                ]) }}
                                @include('web.component.does-not-apply', ['field' => 'stateProvince', 'value' => @$step->detail['stateProvince']])
                            </div>
                             <div class="form-group">
                                {{ Form::label("country_of_birth", "Country of Birth") }}
                                <span class="required">*</span>
                                {{ Form::select("country_of_birth", getAllCountry(), @$step->detail["country_of_birth"], [
                                    'class' => 'form-control',
                                ]) }}                       
                            </div>
                            <div class="form-group">
                                {{ Form::label("country_of_citizenship", "Country of Citizenship") }}
                                <span class="required">*</span>
                                {{ Form::select("country_of_citizenship", getAllCountry(), @$step->detail["country_of_citizenship"], [
                                    'class' => 'form-control',
                                ]) }}                       
                            </div>
                             <div class="form-group">
                                {{ Form::label("child_a", "Child's A# or check 'Does Not Apply") }}
                                <span class="required">*</span>
                                {{ Form::text("child_a", @$step->detail['childA'] ? 'N/A' : @$step->detail["child_a"], [
                                    'class' => 'form-control childA',
                                    'placeholder' => ''
                                ]) }}
                                @include('web.component.does-not-apply', ['field' => 'childA', 'value' => @$step->detail['childA']])
                            </div>
                            <div class="form-group">
                                {{ Form::label("ssn", "Social Security Number Format: 123-45-6789 or N/A") }}
                                <span class="required">*</span>
                                {{ Form::text("ssn", @$step->detail['ssnApply'] ? 'N/A' : @$step->detail["ssn"], [
                                    'class' => 'form-control ssnApply',
                                    'placeholder' => ''
                                ]) }}
                                @include('web.component.does-not-apply', ['field' => 'ssnApply', 'value' => @$step->detail['ssnApply']])
                            </div>                                                      
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label("current_job", "Current Job") }}
                                <span class="required">*</span>
                                {{ Form::text("current_job", @$step->detail['currentJob'] ? 'N/A' : @$step->detail["current_job"], [
                                    'class' => 'form-control currentJob',
                                    'placeholder' => ''
                                ]) }}
                                @include('web.component.does-not-apply', ['field' => 'currentJob', 'value' => @$step->detail['currentJob']])
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Relationship to Alien Beneficiary</label>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio("alien_beneficiary", 'son', @$step->detail["alien_beneficiary"] == 'son' ? true : '', [
                                                'class' => 'custom-control-input',
                                            ])
                                        }}
                                        <span class="custom-control-label"></span> Son
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("alien_beneficiary", 'daughter', @$step->detail["alien_beneficiary"] == 'daughter' ? true : '', [
                                                'class' => 'custom-control-input',
                                            ]) 
                                        }}
                                        <span class="custom-control-label"></span> Daughter
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("alien_beneficiary", 'step-son', @$step->detail["alien_beneficiary"] == 'step-son' ? true : '', [
                                                'class' => 'custom-control-input',
                                            ]) 
                                        }}
                                        <span class="custom-control-label"></span> Step-Son
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("alien_beneficiary", 'step-daughter', @$step->detail["alien_beneficiary"] == 'step-daughter' ? true : '', [
                                                'class' => 'custom-control-input',
                                            ]) 
                                        }}
                                        <span class="custom-control-label"></span> Step-Daughter
                                    </label>
                                    <div class="alien_beneficiary"></div>
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Is this child age 20 or under and joining the beneficiary on this visa?</label>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio("under_and_joining", 'no', @$step->detail["under_and_joining"] == 'no' ? true : '', [
                                                'class' => 'custom-control-input underAndJoining',
                                            ])
                                        }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("under_and_joining", 'yes', @$step->detail["under_and_joining"] == 'yes' ? true : '', [
                                                'class' => 'custom-control-input underAndJoining',
                                            ]) 
                                        }}
                                        <span class="custom-control-label"></span> Yes
                                    </label>                                   
                                    <div class="under_and_joining"></div>
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-12 underAndJoiningNo" style="display: none;">
                            <div class="form-group">
                                <label>Was the child ever in immigration proceedings?</label>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio("immigration_proceedings", 'no', @$step->detail["immigration_proceedings"] == 'no' ? true : '', [
                                                'class' => 'custom-control-input immigrationProceedings',
                                            ])
                                        }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("immigration_proceedings", 'yes', @$step->detail["immigration_proceedings"] == 'yes' ? true : '', [
                                                'class' => 'custom-control-input immigrationProceedings',
                                            ]) 
                                        }}
                                        <span class="custom-control-label"></span> Yes
                                    </label>                                   
                                    <div class="immigration_proceedings"></div>
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-12 immigrationProceedingsSec" style="display: none;">
                            <div class="form-group">
                                {{ Form::label("where", "Where?") }}
                                <span class="required">*</span>
                                {{ Form::text("where", @$step->detail["where"], [
                                    'class' => 'form-control',
                                    'placeholder' => ''
                                ]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label("exact_date", "When? Estimate if you don't know the exact date. format mm/dd/yyyy") }}
                                <span class="required">*</span>
                                {{ Form::text("exact_date", @$step->detail["exact_date"], [
                                    'class' => 'form-control',
                                    'placeholder' => ''
                                ]) }}
                            </div>
                            <div class="form-group">
                                <label>What type of proceeding was it? Check all that apply</label>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("type_of_proceeding", 'Removal', @$step->detail["type_of_proceeding"] == 'Removal' ? true : '', [
                                                'class' => 'custom-control-input immigrationProceedings',
                                            ])
                                        }}
                                        <span class="custom-control-label"></span> Removal
                                    </label><br>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("type_of_proceeding", 'ExclusionDeportation', @$step->detail["type_of_proceeding"] == 'ExclusionDeportation' ? true : '', [
                                                'class' => 'custom-control-input immigrationProceedings',
                                            ]) 
                                        }}
                                        <span class="custom-control-label"></span> Exclusion/Deportation
                                    </label> <br>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("type_of_proceeding", 'Rescission', @$step->detail["type_of_proceeding"] == 'Rescission' ? true : '', [
                                                'class' => 'custom-control-input immigrationProceedings',
                                            ]) 
                                        }}
                                        <span class="custom-control-label"></span> Rescission
                                    </label> <br>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("type_of_proceeding", 'Judicial Proceedings', @$step->detail["type_of_proceeding"] == 'Judicial Proceedings' ? true : '', [
                                                'class' => 'custom-control-input immigrationProceedings',
                                            ]) 
                                        }}
                                        <span class="custom-control-label"></span> Judicial Proceedings (choose this option if none of the others apply)

                                    </label>                                   
                                    <div class="immigration_proceedings"></div>
                                    <p>Attach to your petition a copy of the official documentation relating to this proceeding.</p>
                                </div>
                            </div>  
                        </div>
                        <div class="col-md-12 underAndJoiningYes" style="display: none;">
                            <div class="form-group">
                                {{ Form::label("m_first_name", "Mother's First Name") }}
                                <span class="required">*</span>
                                {{ Form::text("m_first_name", @$step->detail["m_first_name"], [
                                    'class' => 'form-control',
                                    'placeholder' => ''
                                ]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label("m_middle_name", "Mother's Middle Name") }}
                                <span class="required">*</span>
                                {{ Form::text("m_middle_name", @$step->detail["m_middle_name"], [
                                    'class' => 'form-control',
                                    'placeholder' => ''
                                ]) }}
                            </div>
                            <div class="form-group">
                                {{ Form::label("m_last_name", "Mother's Last Name") }}
                                <span class="required">*</span>
                                {{ Form::text("m_last_name", @$step->detail["m_last_name"], [
                                    'class' => 'form-control',
                                    'placeholder' => ''
                                ]) }}
                                <span>If there is a suffix after the name such as Jr. or III, put that here after the last name.</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Is this child traveling to the United States at a later date to join you? </label>
                                    <div class="radiogroup">
                                        <label class="custom-control custom-radio mb-0 ">
                                            {{ Form::radio("traveling_to_us", 'no', @$step->detail["traveling_to_us"] == 'no' ? true : '', [
                                                    'class' => 'custom-control-input',
                                                ])
                                            }}
                                            <span class="custom-control-label"></span> No
                                        </label>
                                        <label class="custom-control custom-radio mb-0 ms-3">
                                            {{ Form::radio("traveling_to_us", 'yes', @$step->detail["traveling_to_us"] == 'yes' ? true : '', [
                                                    'class' => 'custom-control-input',
                                                ]) 
                                            }}
                                            <span class="custom-control-label"></span> Yes
                                        </label>                                   
                                        <div class="traveling_to_us"></div>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'child-1') !!}
        {!! Form::hidden('next', 'child-2') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}        
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'child-2'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienChild1Btn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('change', '.beneficiary', function(){
            if ($(this).val() == 'yes') {
                $('.beneficiarySec').show();
            } else {
                $('.beneficiarySec').hide();
            }
        });

        $(document).on('change', '.childAddress', function(){
            if ($(this).val() == 'yes') {
                $('.childAddressYes').show();
                $('.childAddressNo').hide();
            } else {
                $('.childAddressYes').hide();
                $('.childAddressNo').show();
            }
        });

        $(document).on('change', '.underAndJoining', function(){
            if ($(this).val() == 'yes') {
                $('.underAndJoiningYes').show();
                $('.underAndJoiningNo').hide();
            } else {
                $('.underAndJoiningYes').hide();
                $('.underAndJoiningNo').show();
            }
        });

        $(document).on('change', '.immigrationProceedings', function(){
            if ($(this).val() == 'yes') {
                $('.immigrationProceedingsSec').show();
            } else {
                $('.immigrationProceedingsSec').hide();
            }
        });

        $(document).ready(function(){
            getState(231);
        });

        $(document).on('change', '.countryId', function(){
            // var countryId = $(this).val();
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

        $("#fianceAlienChild1").validate({
            rules: {                
                beneficiary: {
                    required: true,
                },   
                first_name: {
                    required: true,
                }, 
                middle_name: {
                    required: true,
                }, 
                last_name: {
                    required: true,
                },  
                child_address: {
                    required: true,
                },
                street: {
                    required: true,
                },
                apartment_suite_or_floor: {
                    required: true,
                },
                apartment_suite_or_floor_no: {
                    required: true,
                },
                city: {
                    required: true,
                },
                province: {
                    required: true,
                },
                country: {
                    required: true,
                },
                postal_code: {
                    required: true,
                },
                dob: {
                    required: true,
                },
                cob: {
                    required: true,
                },
                state_province: {
                    required: true,
                },
                country_of_birth: {
                    required: true,
                },
                country_of_citizenship: {
                    required: true,
                },
                child_a: {
                    required: true,
                },
                ssn: {
                    required: true,
                },
                current_job: {
                    required: true,
                },
                alien_beneficiary: {
                    required: true,
                },
                under_and_joining: {
                    required: true,
                },
                traveling_to_us: {
                    required: true,
                },
                immigration_proceedings: {
                    required: true,
                },
                where: {
                    required: true,
                },
                exact_date: {
                    required: true,
                },
                type_of_proceeding: {
                    required: true,
                },
                m_first_name: {
                    required: true,
                },
                m_middle_name: {
                    required: true,
                },
                m_last_name: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "beneficiary" || element.attr("name") == "child_address" || element.attr("name") == "alien_beneficiary" || element.attr("name") == "under_and_joining" || element.attr("name") == "traveling_to_us" || element.attr("name") == "immigration_proceedings" || element.attr("name") == "type_of_proceeding") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {               
               beneficiary: "Please enter beneficiary!",              
               first_name: "Please enter name!",              
               middle_name: "Please enter name!",              
               last_name: "Please enter name!",              
               child_address: "Please choose option!",              
               street: "Please enter street!",              
               apartment_suite_or_floor: "Please enter address!",              
               apartment_suite_or_floor_no: "Please enter address!",              
               city: "Please enter city!",              
               province: "Please enter province!",              
               country: "Please enter country!",              
               postal_code: "Please enter postal code!",              
               dob: "Please enter date of birth!",              
               cob: "Please enter city of birth!",              
               state_province: "Please enter state province!",              
               country_of_birth: "Please enter country!",              
               country_of_citizenship: "Please enter country of citizenship!",              
               child_a: "Please enter Child's A#!",              
               ssn: "Please enter Social Security Number!",              
               current_job: "Please enter current job!",              
               alien_beneficiary: "Please choose option!",              
               under_and_joining: "Please choose option!",              
               traveling_to_us: "Please choose option!",              
               immigration_proceedings: "Please choose option!",              
               where: "Please enter where!",              
               exact_date: "Please enter date!",              
               type_of_proceeding: "Please choose option!",              
               m_first_name: "Please enter name!",              
               m_middle_name: "Please enter name!",              
               m_last_name: "Please enter name!",              
            },
            submitHandler: function(form) {
                $('#fianceAlienChild1Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienChild1') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activechild-1').removeClass('active');
                            $('.activechild-2').addClass('active');
                            $('.fianceAlienChildrenForm').html(data.data);                    
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