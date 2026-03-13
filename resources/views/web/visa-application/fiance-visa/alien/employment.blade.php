<!-- resources\views\web\visa-application\fiance-visa\alien\employment.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienEmployment'), 'id' => 'fianceAlienEmployment']) }}
    <div class="form-card">
        <div class="row">
            <div class="col-md-12">
                <div class="heading mb-30">
                    <h2>Alien's Employment Last Five Years</h2>
                    <p>Employment must be a continuous 5-year timeline. Employer 1 must always be the beneficiary's current or present status.</p>
                    <p>Enter <strong>Unemployed</strong> with a start date and <strong>PRESENT</strong> if the beneficiary is not working right now. Enter <strong>Student</strong> if school is the current status.</p>
                    {{-- <h4>Current Job</h4> --}}
                </div>
            </div>
            <div class="emploperSection">
                @if (empty(@$step->detail['employer1']))
                @include('web.component.employer', ['index' => 1, 'data' => @$step->detail])
                @endif
                @if (!empty(@$step->detail['employer1']))
                @for ($i = 1; $i <= 5; $i++) @if (isset($step->detail["employer$i"]))
                    @include('web.component.employer', ['index' => $i, 'data' => @$step->detail])
                    @endif
                    @endfor
                    @endif
            </div>
            {{-- <div class="col-md-6">
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
                    {{ Form::select('apartment_suite_or_floor',
                    apartmentSuiteOrFloor(@$step->detail['apartmentSuiteOrFloor']),
                    @$step->detail['apartment_suite_or_floor'], [
                    'class' => 'form-control apartmentSuiteOrFloor'
                    ]) }}
                    @include('web.component.does-not-apply', ['field' => 'apartmentSuiteOrFloor', 'value' =>
                    @$step->detail['apartmentSuiteOrFloor']])
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
                    {{ Form::label('briefly_explain', "Briefly explain your duties, studies or reason for this status
                    below.") }}
                    <span class="required">*</span>
                    {{ Form::textarea('briefly_explain', @$step->detail['briefly_explain'], ['class' => 'form-control',
                    'rows' => 4]) }}
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
                    {{ Form::label('work_type', 'What type of work do you intend to do in the United States? Pick the
                    category that best describes your intended occupation.') }}
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
            </div> --}}
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'employment') !!}
    {!! Form::hidden('next', 'schools') !!}
    {!! Form::hidden('type', 'alien') !!}
    {{ Form::button('Back To Start', [
    'class' => 'btn btn-tra-grey previousOrContinue',
    'data-form' => 'name'
    ]) }}
    {{ Form::button('Previous Step', [
    'class' => 'btn btn-tra-grey previousOrContinue',
    'data-form' => 'address'
    ]) }}
    {{ Form::button('Skip & Continue', [
    'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
    'data-form' => 'travel'
    ]) }}
    {{ Form::button('Save & Continue', [
    'class' => 'btn btn-tra-primary ms-2',
    'id' => 'fianceAlienEmploymentBtn',
    'type' => 'submit',
    ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            if ($('input[name=present_date]:checked').length == 1) {
                $('.employementEndDate1').prop('disabled', true);
                $('.employementEndDate1').val('Present');
                $('.employementEndDate1').removeClass('error');
            }
        });

        $(document).on('change', 'input[name=present_date]', function() {
            if ($(this).is(':checked')) {
                $('.employementEndDate1').val('Present');
                $('.employementEndDate1').prop('disabled', true);
                $('.employementEndDate1').addClass('disableDatePicker');
                $('.employementEndDate1').removeClass('error');
                $('label[for="employement_end_date1"].error').remove();
                employerForm1($('.employementEndDate1'));
            } else {
                $('.employementEndDate1').val('');
                $('.employementEndDate1').prop('disabled', false);
                $('.employementEndDate1').removeClass('disableDatePicker');
            }
        });

        $(document).on('change', '.employementEndDate', function () {
            if ($('input[name=present_date]:checked').length == 1) {
                $('.employementEndDate').addClass('disableDatePicker');
                employerForm1($(this));
            }
        });

        $(document).on('change', '.endDate', function () {
            $('.employementEndDate').addClass('disableDatePicker');
            employerForm1($(this));
        });

        function employerForm1(field) {
            datePicker();
            var dIndex = field.data('index');
            var startDate = new Date($('.beganDate' + dIndex).val());
            var endDate = new Date(field.val());
            var yearDiff = endDate.getFullYear() - startDate.getFullYear();
           
            if (endDate.getMonth() < startDate.getMonth() || (endDate.getMonth() === startDate.getMonth() && endDate
                    .getDate() < startDate.getDate())) {
                yearDiff--;
            }
    
            var lastEndDate = new Date($('.endDate').val());
            
            var monthDiff = lastEndDate.getMonth() - startDate.getMonth();
    
            if (monthDiff < 0) {
                monthDiff += 12; // Adjust months to be positive
            }
            var existsRemaingYears =  endDate.getFullYear() - startDate.getFullYear();
            var existsRemaingYears = parseInt($('.remaingYears' + dIndex).val());
            if (existsRemaingYears && existsRemaingYears > 0) {
                yearDiff = existsRemaingYears - yearDiff;
            }
            
            var index = parseInt($('.emploperSection > .emploperSec').length + 1);
            var sec = parseInt(field.data('sec') + 1);
            console.log('yeardifference ==>', yearDiff);
            console.log('monthdifference ==>', monthDiff);
    
            if (yearDiff <= 5 && yearDiff > 0) {
    
                var minDate = new Date();
                minDate.setFullYear(minDate.getFullYear() - 5);
    
                if (startDate < minDate) {
                    console.log("The start date must be within the last 5 years.");
                    $('.remaingYear').val('valid');
                    return; // Exit the function and prevent further processing
                }
    
                $('.remaingYear').val('invalid');
                $('.removeEmpBtn' + yearDiff).show();
                $('.emploperSection').append(`{!! addslashes(
                        view('web.component.employer')->with(['index' => '${index}'])->render(),
                    ) !!}`);
    
                var newDuration = calculateDurationMinus5Years(startDate, new Date());    
                var maxDate = new Date(moment($('.beganDate' + dIndex).val(), "MM/DD/YYYY").format("YYYY-MM-DD"));
                console.log(newDuration);
                $('.sectionHeading' + index).html('You must list your employment for the past ' + yearDiff +
                    ' years.  Enter your employment prior to ' + $('.beganDate' + dIndex).val() + '');
                
               
                $(".beganDate" + index).datepicker({
                    minDate: minDate,
                    maxDate: maxDate
                });
                $(".employementEndDate" + index).datepicker({
                    maxDate: maxDate
                });
                $('.remaingYears' + index).val(yearDiff);
                $('.beganDate' + dIndex).addClass('disableDatePicker');
                field.addClass('disableDatePicker');
                if (dIndex == 1) {
                    $('.employementEndDate' + dIndex).addClass('disableDatePicker');
                }
            } else {
                $('.remaingYear').val('valid');
            }
    
        }

        function employerForm(field) {
            datePicker();
            var dIndex = field.data('index');
            var startDate = new Date($('.beganDate' + dIndex).val());
            var endDate = new Date(field.val());
            var yearDiff = endDate.getFullYear() - startDate.getFullYear();
            if (endDate.getMonth() < startDate.getMonth() || (endDate.getMonth() === startDate.getMonth() && endDate
                .getDate() < startDate.getDate())) {
                yearDiff--;
            }
            var existsRemaingYears = parseInt($('.remaingYears' + dIndex).val());
            if (existsRemaingYears && existsRemaingYears > 0) {
                yearDiff = existsRemaingYears - yearDiff;
            }
            var index = parseInt($('.emploperSection > .emploperSec').length + 1);
            var sec = parseInt(field.data('sec') + 1);
            console.log('yeardifference ==>',yearDiff);
            if (yearDiff < 5 && yearDiff > 0) {
                $('.remaingYear').val('invalid');
                $('.removeEmpBtn' + yearDiff).show();
                $('.emploperSection').append(`{!! addslashes(
                    view('web.component.employer')->with(['index' => '${index}'])->render(),
                ) !!}`);
                $('.sectionHeading' + index).html('You must list your employment for the past ' + yearDiff +
                    ' years.  Enter your employment prior to ' + $('.beganDate' + dIndex).val() + '');
                var minDate = new Date($('.beganDate' + dIndex).val());
                minDate.setFullYear(minDate.getFullYear() - yearDiff);
                var maxDate = new Date(moment($('.beganDate' + dIndex).val(), "MM/DD/YYYY").format("YYYY-MM-DD"));
                $(".beganDate" + index).datepicker({
                    minDate: minDate,
                    maxDate: maxDate
                });
                $(".employementEndDate" + index).datepicker({
                    maxDate: maxDate
                });
                $('.remaingYears' + index).val(yearDiff);
                $('.beganDate' + dIndex).addClass('disableDatePicker');
                field.addClass('disableDatePicker');
                if (dIndex == 1) {
                    $('.employementEndDate' + dIndex).addClass('disableDatePicker');
                }
            } else {
                $('.remaingYear').val('valid');
            }
        }

        $(document).on('click', '.removeEmploperSection', function () {
            datePicker();
            var sec = $(this).data('sec');

            // if (sec != 1) {
            // sec = sec + 1;
            // console.log(sec);
            $('.empSec' + sec).remove();
            // }   
        });

        $(document).ready(function () {
            getState($('.countryId').val());
        });

        $(document).on('change', '.countryId', function () {
            var countryId = $(this).val();
            getState(countryId);
        });

        function getState(countryId) {
            $.ajax({
                type: 'get',
                url: "{{ route('getState') }}",
                data: {
                    countryId: countryId
                },
                success: function (data) {
                    $('.states').html(data);
                }
            });
        }

        $("#fianceAlienEmployment").validate({
            rules: {
                full_name_of_employer1: {
                    required: true,
                },
                street_number_and_name1: {
                    required: true,
                },
                aptsteflr1: {
                    required: true,
                },
                apt_ste_flr1: {
                    required: true,
                },
                city1: {
                    required: true,
                },
                state1: {
                    required: true,
                },
                zip_code1: {
                    required: true,
                },
                province1: {
                    required: true,
                },
                postal_code1: {
                    required: true,
                },
                country1: {
                    required: true,
                },
                occupation_specify1: {
                    required: true,
                },
                employement_start_date1: {
                    required: true,
                },
                employement_end_date1: {
                    required: function() {
                        return $('input[name=present_date]:checked').length == 0;
                    },
                },
                full_name_of_employer2: {
                    required: true,
                },
                street_number_and_name2: {
                    required: true,
                },
                aptsteflr2: {
                    required: true,
                },
                apt_ste_flr2: {
                    required: true,
                },
                city2: {
                    required: true,
                },
                state2: {
                    required: true,
                },
                zip_code2: {
                    required: true,
                },
                province2: {
                    required: true,
                },
                postal_code2: {
                    required: true,
                },
                country2: {
                    required: true,
                },
                occupation_specify2: {
                    required: true,
                },
                employement_start_date2: {
                    required: true,
                },
                employement_end_date2: {
                    required: true,
                },
                full_name_of_employer3: {
                    required: true,
                },
                street_number_and_name3: {
                    required: true,
                },
                aptsteflr3: {
                    required: true,
                },
                apt_ste_flr3: {
                    required: true,
                },
                city3: {
                    required: true,
                },
                state3: {
                    required: true,
                },
                zip_code3: {
                    required: true,
                },
                province3: {
                    required: true,
                },
                postal_code3: {
                    required: true,
                },
                country3: {
                    required: true,
                },
                occupation_specify3: {
                    required: true,
                },
                employement_start_date3: {
                    required: true,
                },
                employement_end_date3: {
                    required: true,
                },
                full_name_of_employer4: {
                    required: true,
                },
                street_number_and_name4: {
                    required: true,
                },
                aptsteflr4: {
                    required: true,
                },
                apt_ste_flr4: {
                    required: true,
                },
                city4: {
                    required: true,
                },
                state4: {
                    required: true,
                },
                zip_code4: {
                    required: true,
                },
                province4: {
                    required: true,
                },
                postal_code4: {
                    required: true,
                },
                country4: {
                    required: true,
                },
                occupation_specify4: {
                    required: true,
                },
                employement_start_date4: {
                    required: true,
                },
                employement_end_date4: {
                    required: true,
                },
                full_name_of_employer5: {
                    required: true,
                },
                street_number_and_name5: {
                    required: true,
                },
                aptsteflr5: {
                    required: true,
                },
                apt_ste_flr5: {
                    required: true,
                },
                city5: {
                    required: true,
                },
                state5: {
                    required: true,
                },
                zip_code5: {
                    required: true,
                },
                province5: {
                    required: true,
                },
                postal_code5: {
                    required: true,
                },
                country5: {
                    required: true,
                },
                occupation_specify5: {
                    required: true,
                },
                employement_start_date5: {
                    required: true,
                },
                employement_end_date5: {
                    required: true,
                },
            },
            messages: {
                full_name_of_employer1: "Please enter full name!",
                street_number_and_name1: "Please enter street number and name!",
                aptsteflr1: "This field is required!",
                apt_ste_flr1: "This field is required!",
                city1: "Please enter town or city!",
                state1: "Please chose state!",
                zip_code1: "Please enter zip code!",
                province1: "Please enter province!",
                postal_code1: "Please enter postal code!",
                country1: "Please chose country!",
                occupation_specify1: "Please enter occupation specify!",
                employement_start_date1: "Please enter start date!",
                employement_end_date1: "Please enter end date or check PRESENT.",
                full_name_of_employer2: "Please enter full name!",
                street_number_and_name2: "Please enter street number and name!",
                aptsteflr2: "This field is required!",
                apt_ste_flr2: "This field is required!",
                city2: "Please enter town or city!",
                state2: "Please chose state!",
                zip_code2: "Please enter zip code!",
                province2: "Please enter province!",
                postal_code2: "Please enter postal code!",
                country2: "Please chose country!",
                occupation_specify2: "Please enter occupation specify!",
                employement_start_date2: "Please enter start date!",
                employement_end_date2: "Please enter end date!",
                full_name_of_employer3: "Please enter full name!",
                street_number_and_name3: "Please enter street number and name!",
                aptsteflr3: "This field is required!",
                apt_ste_flr3: "This field is required!",
                city3: "Please enter town or city!",
                state3: "Please chose state!",
                zip_code3: "Please enter zip code!",
                province3: "Please enter province!",
                postal_code3: "Please enter postal code!",
                country3: "Please chose country!",
                occupation_specify3: "Please enter occupation specify!",
                employement_start_date3: "Please enter start date!",
                employement_end_date3: "Please enter end date!",
                full_name_of_employer4: "Please enter full name!",
                street_number_and_name4: "Please enter street number and name!",
                aptsteflr4: "This field is required!",
                apt_ste_flr4: "This field is required!",
                city4: "Please enter town or city!",
                state4: "Please chose state!",
                zip_code4: "Please enter zip code!",
                province4: "Please enter province!",
                postal_code4: "Please enter postal code!",
                country4: "Please chose country!",
                occupation_specify4: "Please enter occupation specify!",
                employement_start_date4: "Please enter start date!",
                employement_end_date4: "Please enter end date!",
                full_name_of_employer5: "Please enter full name!",
                street_number_and_name5: "Please enter street number and name!",
                aptsteflr5: "This field is required!",
                apt_ste_flr5: "This field is required!",
                city5: "Please enter town or city!",
                state5: "Please chose state!",
                zip_code5: "Please enter zip code!",
                province5: "Please enter province!",
                postal_code5: "Please enter postal code!",
                country5: "Please chose country!",
                occupation_specify5: "Please enter occupation specify!",
                employement_start_date5: "Please enter start date!",
                employement_end_date5: "Please enter end date!",
            },
            errorPlacement: function (error, element) {
                var name = element.attr("name");
                if (name == "aptsteflr1" || name == "aptsteflr2" || name == "aptsteflr3" || name == "aptsteflr4" || name == "aptsteflr5") {
                    error.appendTo($("." + element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                if (!$('#present_date_checkbox').is(':checked')) {
                    toastr.error('Employer 1 must always be the beneficiary\'s current or present status. If the beneficiary is not working, enter Unemployed and mark PRESENT.');
                    return false;
                }

                $('#fianceAlienEmploymentBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var wasDisabled = $('.employementEndDate1').prop('disabled');
                if (wasDisabled) {
                    $('.employementEndDate1').prop('disabled', false);
                }

                var serializedData = $(form).serialize();

                if (wasDisabled) {
                    $('.employementEndDate1').prop('disabled', true);
                }
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienEmployment') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function (data) {
                        if (data.status == true) {
                            $('.activeemployment').removeClass('active');
                            $('.activetravel').addClass('active');
                            $('.fianceVisaForm').html(data.data);
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
