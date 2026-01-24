<!-- resources\views\web\visa-application\adjustment-of-status\interpreter.blade.php -->
<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentInterpreter'), 'id' => 'adjustmentInterpreter']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>All questions are about the Alien (foreign citizen).</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Can you, the Alien (foreign citizen) read and understand English well enough to answer all these questions without an interpreter?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('understand_english', 'no', @$step->detail['understand_english'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showNoSec',
                                        'data-text' => 'understandEnglishsSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('understand_english', 'yes', @$step->detail['understand_english'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showNoSec',
                                        'data-text' => 'understandEnglishsSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="understand_english"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 understandEnglishsSec" style="display: {{ @$step->detail['understand_english'] == 'no' ? 'block' : 'none' }};">
                    <h5>Interpreter's Full Name</h5>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('last_name', "Interpreter's Family Name (Last Name)") }}
                            <span class="required">*</span>
                            {{ Form::text('last_name', @$step->detail['last_name'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Name'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('first_name', "Interpreter's Given Name (First Name)") }}
                            <span class="required">*</span>
                            {{ Form::text('first_name', @$step->detail['first_name'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Name'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('org_name', "Interpreter's Business or Organization Name (if any)") }}
                            <span class="required">*</span>
                            {{ Form::text('org_name', @$step->detail['org_name'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Name'
                            ]) }}
                        </div>
                    </div>
                    <h5>Interpreter's Mailing Address</h5>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('street_no', "Street Number and Name.  (Example: 123 Main Street)") }}
                            <span class="required">*</span>
                            {{ Form::text('street_no', @$step->detail['street_no'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Street Number and Name'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-12">
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
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number. Example: 43 or 532-B.  Do not add "Apt" or "#".') }}
                            <span class="required">*</span>
                            {{ Form::text('apartment_suite_or_floor_no', @$step->detail['apartment_suite_or_floor_no'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Apartment, Suite or Floor Number'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('town_city', "Town or City") }}
                            <span class="required">*</span>
                            {{ Form::text('town_city', @$step->detail['town_city'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Town or City'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('country', "Country") }}
                            <span class="required">*</span>
                            {{ Form::select('country', getAllCountry(), @$step->detail['country'], [
                                'class' => 'form-control countryId',
                            ]) }}                       
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('us_state', "U.S. State") }}
                            <span class="required">*</span>
                            {{ Form::select('us_state', [], @$step->detail['us_state'], [
                                'class' => 'form-control states'
                            ]) }}                        
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('province', "Province") }}
                            <span class="required">*</span>
                            {{ Form::text('province', @$step->detail['province'], [
                                'class' => 'form-control province',
                                'placeholder' => 'Enter Province'
                            ]) }}
                            {{ Form::label('does_not_apply', "Does Not Apply") }}
                            {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                'class' => 'custom-control-input doesNotApply',
                                'data-field' => "province"
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('postal_code', "Postal Code") }}
                            <span class="required">*</span>
                            {{ Form::text('postal_code', @$step->detail['postal_code'], [
                                'class' => 'form-control postalCode',
                                'placeholder' => 'Enter Postal Code'
                            ]) }}
                            {{ Form::label('does_not_apply', "None") }}
                            {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                'class' => 'custom-control-input doesNotApply',
                                'data-field' => "postalCode"
                            ]) }}
                        </div>
                    </div>
                    <h5>Interpreter's Contact Information</h5>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('telephone_number', "Interpreter's Daytime Telephone Number") }}
                            <span class="required">*</span>
                            {{ Form::text('telephone_number', @$step->detail['telephone_number'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Number'
                            ]) }}                           
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('mob_number', "Interpreter's Mobile Telephone Number (if any)") }}
                            <span class="required">*</span>
                            {{ Form::text('mob_number', @$step->detail['mob_number'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Number'
                            ]) }}                           
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('email', "Interpreter's Email Address (if any)") }}
                            <span class="required">*</span>
                            {{ Form::text('email', @$step->detail['email'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Email'
                            ]) }}                           
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('user_lang', "Language used to read these questions to you.") }}
                            <span class="required">*</span>
                            {{ Form::text('user_lang', @$step->detail['user_lang'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Language'
                            ]) }}                           
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever applied for permanent resident status before (prior to this application)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('resident_status', 'no', @$step->detail['resident_status'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'residentStatussSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('resident_status', 'yes', @$step->detail['resident_status'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'residentStatussSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="resident_status"></div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 residentStatussSec" style="display: {{ @$step->detail['resident_status'] == 'yes' ? 'block' : 'none' }};">
                    <div class="form-group">
                        {{ Form::label('date_place', 'Give date, place and the results of your previous application for permanent resident status:') }}
                        <span class="required">*</span>
                        {{ Form::text('date_place', @$step->detail['date_place'], [
                            'class' => 'form-control',
                            'placeholder' => ''
                        ]) }}
                    </div>
                </div>
                                                                     
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'interpreter') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'children') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'accommodations'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'children'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentInterpreterBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">        
        $(document).on('change', '.showTextArea', function(){
            var textArea = $(this).data('text');
            switch ($(this).val()) {
                case 'yes':
                    $('.'+textArea).show();                  
                break;         
                case 'no':
                    $('.'+textArea).hide();
                break;
            }
        });

        $(document).on('change', '.showNoSec', function(){
            var sec = $(this).data('text');
            switch ($(this).val()) {
                case 'yes':
                    $('.'+sec).hide();
                break;         
                case 'no':
                    $('.'+sec).show();                  
                break;
            }
        });

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
        
        $("#adjustmentInterpreter").validate({
            rules: {
                understand_english: {
                    required: true,
                },
                last_name: {
                    required: true,
                },
                first_name: {
                    required: true,
                },
                org_name: {
                    required: true,
                }, 
                street_no: {
                    required: true,
                },
                apartment_suite_or_floor: {
                    required: true,
                },
                apartment_suite_or_floor_no: {
                    required: true,
                },
                town_city: {
                    required: true,
                },
                country: {
                    required: true,
                },
                us_state: {
                    required: true,
                },
                province: {
                    required: true,
                },
                postal_code: {
                    required: true,
                },
                telephone_number: {
                    required: true,
                },
                mob_number: {
                    required: true,
                },
                email: {
                    required: true,
                },
                user_lang: {
                    required: true,
                },
                resident_status: {
                    required: true,
                },
                date_place: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                var name = element.attr("name");
                if (name == "understand_english" || name == "resident_status") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               understand_english: "Please choose option!",                                           
               last_name: "This field is required!",                                           
               first_name: "This field is required!",                                           
               org_name: "This field is required!",                                           
               street_no: "This field is required!",                                           
               apartment_suite_or_floor: "This field is required!",                                           
               apartment_suite_or_floor_no: "This field is required!",                                           
               town_city: "This field is required!",                                           
               country: "This field is required!",                                           
               us_state: "This field is required!",                                           
               province: "This field is required!",                                           
               postal_code: "This field is required!",                                           
               telephone_number: "This field is required!",                                           
               mob_number: "This field is required!",                                           
               email: "This field is required!",                                           
               user_lang: "This field is required!",                                           
               resident_status: "This field is required!",                                           
               date_place: "This field is required!",                                           
            },
            submitHandler: function(form) {
                $('#adjustmentInterpreterBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentInterpreter') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.interpreter').removeClass('active');
                            $('.children').addClass('active');
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