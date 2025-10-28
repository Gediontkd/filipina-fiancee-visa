<!-- resources/views/web/visa-application/spouse-visa/beneficiary/employment.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseBeneficiaryEmployment'), 'id' => 'spouseBeneficiaryEmployment']) }}
        <div class="form-card">
            <div class="row">                
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Beneficiary's Employment History (Past 5 Years)</h2>
                        <p>Enter 'Unemployed', 'Retired', or 'Student' if applicable. Provide employment history for the past 5 years.</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('employer_name', 'Employer Name') }}
                        <span class="required">*</span>
                        {{ Form::text('employer_name', @$step->detail['employer_name'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Employer Name'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('occupation', 'Job Title/Occupation') }}
                        <span class="required">*</span>
                        {{ Form::text('occupation', @$step->detail['occupation'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Job Title or Occupation'
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
                            'placeholder' => 'Enter Number'
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
                        {{ Form::label('state', "State/Province (Select Does Not Apply if not USA)") }}
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
                            {{ Form::checkbox('province_not_apply', true, @$step->detail['province_not_apply'] == true, [
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
                            {{ Form::checkbox('postal_not_apply', true, @$step->detail['postal_not_apply'] == true, [
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
                        {{ Form::label('job_category', 'Pick the category that best describes the job') }}
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
                            'Medical/Healthcare' => 'Medical/Healthcare',
                            'Military' => 'Military',
                            'Retail/Sales' => 'Retail/Sales',
                            'Student' => 'Student',
                            'Unemployed' => 'Unemployed',
                            'Other' => 'Other',
                        ], @$step->detail['job_category'], [
                            'class' => 'form-control'
                        ]) }}                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('date', 'Employment start date (mm/dd/yyyy)') }}
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
        {!! Form::hidden('section', 'beneficiary') !!}
        {!! Form::hidden('name', 'employment') !!}
        {!! Form::hidden('next', 'relationship') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'marital-status',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'relationship',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseBeneficiaryEmploymentBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">     
        $(document).on('change', '.doesNotApply', function() {
            var fieldClass = $(this).data('field');
            var field = $('.' + fieldClass);
            
            if ($(this).is(':checked')) {
                field.val('N/A');
                field.prop('disabled', true);
                field.prop('readonly', true);
            } else {
                field.val('');
                field.prop('disabled', false);
                field.prop('readonly', false);
            }
        });

        $(document).ready(function() {
            $('.doesNotApply:checked').each(function() {
                var fieldClass = $(this).data('field');
                var field = $('.' + fieldClass);
                field.val('N/A');
                field.prop('disabled', true);
                field.prop('readonly', true);
            });
        });

        $(document).ready(function(){
            var state = $('.states').data('state');
            getState($('.countryId').val(), state);
        });

        $(document).on('change', '.countryId', function(){
            var countryId = $(this).val();
            getState(countryId);
        });

        function getState(countryId, state = '')
        {
            $.ajax({                
                type: 'get',
                url: "{{ route('spouseGetState') }}",
                data: {
                    countryId: countryId,
                    state: state
                },
                success: function(data) {
                    $('.states').html(data);                    
                }
            });
        }

        $("#spouseBeneficiaryEmployment").validate({
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
               employer_name: "Please enter employer name",                                            
               occupation: "Please enter job title/occupation",                                            
               number_street: "Please enter number and street",                                       
               apartment_suite_or_floor: "Please select an option",                                       
               apartment: "Please enter apartment/suite/floor number",                                            
               town_city: "Please enter town or city",                                            
               country: "Please select country",                                            
               state: "Please select state/province",                                            
               province: "Please enter province or check 'Does Not Apply'",                                            
               postal_code: "Please enter postal code or check 'Does Not Apply'",                                            
               job_category: "Please select job category",                                            
               date: "Please enter employment start date",                                            
            },
            submitHandler: function(form) {
                $('#spouseBeneficiaryEmploymentBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                $.ajax({
                    headers: { 'X-CSRF-Token': $('input[name="_token"]').val() },
                    type: 'post',
                    url: "{{ route('spouseBeneficiaryEmployment') }}",
                    data: $(form).serialize(),
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status) {                                           
                            $('.beneficiary-employment').removeClass('active');
                            $('.relationship').addClass('active');
                            $('.spouseVisaForm').html(data.data);                    
                        } else {
                            $('#spouseBeneficiaryEmploymentBtn').html('Save & Continue');
                            toastr.error(data.message);                           
                        }
                    },
                    error: function() {
                        $('#spouseBeneficiaryEmploymentBtn').html('Save & Continue');
                        toastr.error('An error occurred. Please try again.');
                    }
                });
               return false;
            }
        });             
    </script>
</div>