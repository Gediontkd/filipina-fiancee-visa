<!-- resources\views\web\visa-application\adjustment-of-status\employment.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienEmployment'), 'id' => 'fianceAlienEmployment']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Alien's Employment Last Five Years</h2>
                        <p>More space will be provided if needed. Enter Unemployed or Student if appropriate.</p>
                        <h4>Current Job</h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('company_school_name', 'Name of Company or School') }}
                        <span class="required">*</span>
                        {{ Form::text('company_school_name', @$step->detail['company_school_name'], [
                            'class' => 'form-control',
                            'placeholder' => 'Name of Company or School'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('street', 'Street') }}
                        <span class="required">*</span>
                        {{ Form::text('street', @$step->detail['street'], [
                            'class' => 'form-control',
                            'placeholder' => 'Please Enter Street'
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
                            'Dose Not Apply' => 'Dose Not Apply'
                        ], @$step->detail['apartment_suite_or_floor'], [
                            'class' => 'form-control'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number') }}
                        <span class="required">*</span>
                        {{ Form::text('apartment_suite_or_floor_no', @$step->detail['apartment_suite_or_floor_no'], [
                            'class' => 'form-control',
                            'placeholder' => 'Please Enter Apartment, Suite or Floor Number'
                        ]) }}                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('city', 'City') }}
                        <span class="required">*</span>
                        {{ Form::text('city', @$step->detail['city'], [
                            'class' => 'form-control',
                            'placeholder' => 'Please Enter City'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('state_or_province', 'State or Province.') }}
                        <span class="required">*</span>
                        {{ Form::text('state_or_province.', @$step->detail['state_or_province'], [
                            'class' => 'form-control stateProvince',
                            'placeholder' => 'Please Enter State or Province.'
                        ]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "stateProvince"
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
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
                        {{ Form::label('phone', 'Phone') }}
                        <span class="required">*</span>
                        {{ Form::text('phone', @$step->detail['phone'], [
                            'class' => 'form-control',
                            'placeholder' => 'Please Enter Phone Number'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('supervisor_fname', "Supervisor's First Name.") }}
                        <span class="required">*</span>
                        {{ Form::text('supervisor_fname', @$step->detail['supervisor_fname'], [
                            'class' => 'form-control supervisorFName',
                            'placeholder' => 'Please Enter First Name'
                        ]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "supervisorFName"
                        ]) }}
                    </div>
                </div> 
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('supervisor_lname', "Supervisor's Last Name.") }}
                        <span class="required">*</span>
                        {{ Form::text('supervisor_lname', @$step->detail['supervisor_lname'], [
                            'class' => 'form-control supervisorLName',
                            'placeholder' => 'Please Enter Last Name'
                        ]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "supervisorLName"
                        ]) }}
                    </div>
                </div>  
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('monthly_income', "Monthly Income in Local Currency.") }}
                        <span class="required">*</span>
                        {{ Form::text('monthly_income', @$step->detail['monthly_income'], [
                            'class' => 'form-control monthlyIncome',
                            'placeholder' => 'Please Enter Income'
                        ]) }}
                        {{ Form::label('does_not_apply', "Does Not Apply") }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "monthlyIncome"
                        ]) }}
                    </div>
                </div>   
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('briefly_explain', "Briefly explain your duties, studies or reason for this status below.") }}
                        <span class="required">*</span>
                        {{ Form::textarea('briefly_explain', @$step->detail['briefly_explain'], ['class' => 'form-control', 'rows' => 4]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('occupation_or_job', "Occupation or Job Title") }}
                        <span class="required">*</span>
                        {{ Form::text('occupation_or_job', @$step->detail['occupation_or_job'], [
                            'class' => 'form-control',
                            'placeholder' => 'Please Enter Title'
                        ]) }}
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
                        {{ Form::label('began_date', 'I began this job on (mm/dd/yyyy)') }}
                        <span class="required">*</span>
                        {{ Form::text('began_date', @$step->detail['began_date'], [
                            'class' => 'form-control dateOfBirth',
                            'placeholder' => 'Enter Date'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('work_type', 'What type of work do you intend to do in the United States? Pick the category that best describes your intended occupation.') }}
                        <span class="required">*</span>
                        {{ Form::select('work_type', [
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
                        ], @$step->detail['work_type'], [
                            'class' => 'form-control'
                        ]) }}                        
                    </div>
                </div>         
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'employment') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'schools') !!}
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
            'data-form' => 'schools'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienEmploymentBtn',
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

        $("#fianceAlienEmployment").validate({
            rules: {
                company_school_name: {
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
                state_or_province: {
                    required: true,
                },
                postal_code: {
                    required: true,
                },
                country: {
                    required: true,
                },
                phone: {
                    required: true,
                },
                supervisor_fname: {
                    required: true,
                },
                supervisor_lname: {
                    required: true,
                },
                monthly_income: {
                    required: true,
                },
                briefly_explain: {
                    required: true,
                },
                occupation_or_job: {
                    required: true,
                },
                job_category: {
                    required: true,
                },
                began_date: {
                    required: true,
                },
                work_type: {
                    required: true,
                },
            },
            messages: {
               company_school_name: "Please enter name!",
               street: "Please enter street!",
               apartment_suite_or_floor: "Please enter address!",
               apartment_suite_or_floor_no: "Please enter number!",
               city: "Please enter town or city!",
               state_or_province: "Please enter state or province.!",
               postal_code: "Please enter postal code!",
               country: "Please choose country!",
               phone: "Please enter number!",
               supervisor_fname: "Please enter name!",
               supervisor_lname: "Please enter name!",
               monthly_income: "Please enter income!",
               briefly_explain: "Please explain!",
               occupation_or_job: "Please enter occupation or job title!",
               job_category: "Please enter job category!",
               began_date: "Please choose date!",
               work_type: "Please choose work type!",
            },
            submitHandler: function(form) {
                $('#fianceAlienEmploymentBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentAlienEmployement') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            // $('.employment').removeClass('active');
                            // $('.alien-parents').addClass('active');
                            // $('.adjustmentStatusForm').html(data.data); 
                            window.location.href = "{{ route('user.page', 'progress') }}";                     
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