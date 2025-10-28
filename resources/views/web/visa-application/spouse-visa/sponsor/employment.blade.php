<!-- resources\views\web\visa-application\spouse-visa\sponsor\employment.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseEmployment'), 'id' => 'spouseEmployment']) }}
        <div class="form-card">
            <div class="row">                
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Your Employment for the Past Five Years (U.S. Citizen Sponsor)</h2>
                        <p>Enter "Unemployed" or "Retired" if appropriate. More space will be provided as needed to go back 5 years. You will need a source of income or adequate assets to be approved.</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('employer_name', 'Name of Employer/Company') }}
                        <span class="required">*</span>
                        {{ Form::text('employer_name', @$step->detail['employer_name'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter name'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('occupation', 'Occupation or Job Title') }}
                        <span class="required">*</span>
                        {{ Form::text('occupation', @$step->detail['occupation'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Occupation or Job Title'
                        ]) }}
                    </div>
                </div>                                             
               <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('number_street', 'Number and street. Example: 123 Main Street') }}
                        <span class="required">*</span>
                        {{ Form::text('number_street', @$step->detail['number_street'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Number and street'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('apartment_suite_or_floor', 'Apartment, Suite or Floor?') }}
                        <span class="required">*</span>
                        {{ Form::select('apartment_suite_or_floor', [
                            '' => 'Select', 
                            'Apartment' => 'Apartment',
                            'Suite' => 'Suite',
                            'Floor' => 'Floor',
                            'Does Not Apply' => 'Does Not Apply'
                        ], @$step->detail['apartment_suite_or_floor'], [
                            'class' => 'form-control'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('apartment', 'Apartment, Suite or Floor Number. Example: 43 or 532-B. Do not add "Apt" or "#".') }}
                        <span class="required">*</span>
                        {{ Form::text('apartment', @$step->detail['apartment'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Apartment'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('town_city', 'Town or City') }}
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
                            'class' => 'form-control countryId'
                        ]) }}                       
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('state', "U.S. State (Select Does Not Apply if not USA)") }}
                        <span class="required">*</span>
                        {{ Form::select('state', [], @$step->detail['state'], [
                            'class' => 'form-control states',
                            'data-state' => @$step->detail['state']
                        ]) }}                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('province', 'Province') }}
                        <span class="required">*</span>
                        {{ Form::text('province', @$step->detail['province'], [
                            'class' => 'form-control province',
                            'placeholder' => 'Enter Province'
                        ]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('province_not_apply', true, @$step->detail['province_not_apply'] == true ? true : '', [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "province",
                                'id' => 'province_not_apply'
                            ]) }}
                            {{ Form::label('province_not_apply', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('postal_code', 'Postal Code') }}
                        <span class="required">*</span>
                        {{ Form::text('postal_code', @$step->detail['postal_code'], [
                            'class' => 'form-control postalCode',
                            'placeholder' => 'Enter Postal Code'
                        ]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('postal_not_apply', true, @$step->detail['postal_not_apply'] == true ? true : '', [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "postalCode",
                                'id' => 'postal_not_apply'
                            ]) }}
                            {{ Form::label('postal_not_apply', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
               <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('job_category', 'Pick the category that best describes your job') }}
                        <span class="required">*</span>
                        {{ Form::select('job_category', [
                            '' => '- Select One -', 
                            'Agriculture' => 'Agriculture',
                            'Artist/Performer' => 'Artist/Performer',
                            'Communications' => 'Communications',
                            'Computer Science' => 'Computer Science',
                            'Culinary/Food Services' => 'Culinary/Food Services',
                            'Education' => 'Education',
                            'Engineering' => 'Engineering',
                            'Government' => 'Government',
                            'Homemaker' => 'Homemaker',
                            'Legal Profession' => 'Legal Profession',
                        ], @$step->detail['job_category'], [
                            'class' => 'form-control'
                        ]) }}                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('date', 'I began this job on (mm/dd/yyyy)') }}
                        <span class="required">*</span>
                        {{ Form::text('date', @$step->detail['date'], [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'Enter Date'
                        ]) }}
                    </div>
                </div>   
            </div>            
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'employment') !!}
        {!! Form::hidden('next', 'name') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name',
            'data-section' => 'sponsor',
            'type' => 'button'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'relationship',
            'data-section' => 'sponsor',
            'type' => 'button'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'name',
            'data-section' => 'sponsor',
            'type' => 'button'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseEmploymentBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">                
        $(document).ready(function(){
            var state = $('.states').data('state');
            getState(231, state);
        });

        $(document).on('change', '.countryId', function(){
            getState(231);
        });

        function getState(countryId, state = '')
        {
            $.ajax({                
                type: 'get',
                url: "{{ route('getState') }}",
                data: {
                    countryId: countryId,
                    state: state
                },
                success: function(data) {
                    $('.states').html(data);                    
                }
            });
        }

        // Handle "Does Not Apply" checkboxes
        $(document).on('change', '.doesNotApply', function() {
            var field = $(this).data('field');
            if ($(this).is(':checked')) {
                $('.' + field).val('N/A');
                $('.' + field).prop('disabled', true);
            } else {
                $('.' + field).val('');
                $('.' + field).prop('disabled', false);
            }
        });

        $("#spouseEmployment").validate({
            rules: {
                employer_name: { required: true },
                occupation: { required: true },
                number_street: { required: true },
                apartment_suite_or_floor: { required: true },
                apartment: { required: true },
                town_city: { required: true },
                country: { required: true },
                state: { required: true },
                province: { 
                    required: function() {
                        return !$('#province_not_apply').is(':checked');
                    }
                },
                postal_code: { 
                    required: function() {
                        return !$('#postal_not_apply').is(':checked');
                    }
                },
                job_category: { required: true },
                date: { required: true },
            },            
            messages: {
               employer_name: "Please enter name!",                                            
               occupation: "Please enter occupation!",                                            
               number_street: "Please enter number and street!",                                       
               apartment_suite_or_floor: "Please select an option!",                                       
               apartment: "Please enter apartment/suite/floor number!",                                            
               town_city: "Please enter town or city!",                                            
               country: "Please choose country!",                                            
               state: "Please choose state!",                                            
               province: "Please enter province or check 'Does Not Apply'!",                                            
               postal_code: "Please enter postal code or check 'Does Not Apply'!",                                            
               job_category: "Please choose job category!",                                            
               date: "Please enter date!",                                            
            },
            submitHandler: function(form) {
                $('#spouseEmploymentBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('spouseEmployment') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.employment').removeClass('active');
                            $('.name').addClass('active');
                            $('.spouseVisaForm').html(data.data);                    
                        }
                        if (data.status == false) {
                            $('#spouseEmploymentBtn').html('Save & Continue');
                            toastr.options.timeOut = 10000;
                            toastr.error(data.message);                           
                        }
                    },
                    error: function() {
                        $('#spouseEmploymentBtn').html('Save & Continue');
                        toastr.error('An error occurred. Please try again.');
                    }
                });
               return false;
            }
        });             
    </script>
</div>