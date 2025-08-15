<div class="step-wizard">
    {{ Form::open(['url' => route('fianceSponsorEmployment'), 'id' => 'fianceSponsorEmployment']) }}
    <div class="form-card">
        <div class="row">
            <div class="col-md-12">
                <div class="heading mb-30">
                    <h2>Your Employment for the Past Five Years (U.S. Citizen Sponsor)</h2>
                    <p>Enter "Unemployed" or "Retired" if appropriate. More space will be provided as needed to go back
                        5 years. You will need a source of income or adequate assets to be approved.</p>
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
                        {{ Form::label('company_school_name', 'Name of Employer/Company') }}
            <span class="required">*</span>
            {{ Form::text('company_school_name', @$step->detail['company_school_name'], [
                            'class' => 'form-control',
                            'placeholder' => 'Name of Employer/Company'
                        ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('occupation_or_job', 'Occupation or Job Title') }}
            <span class="required">*</span>
            {{ Form::text('occupation_or_job', @$step->detail['occupation_or_job'], [
                            'class' => 'form-control',
                            'placeholder' => 'Occupation or Job Title'
                        ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('no_and_street', 'Number and street.  Example: 123 Main Street') }}
            <span class="required">*</span>
            {{ Form::text('no_and_street', @$step->detail['no_and_street'], [
                            'class' => 'form-control',
                            'placeholder' => 'Occupation or Job Title'
                        ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('apartment_suite_or_floor', 'Apartment, Suite or Floor?') }}
            <span class="required">*</span>
            {{ Form::select('apartment_suite_or_floor', apartmentSuiteOrFloor(@$step->detail['apartmentSuiteOrFloor'] ? 'N/A' : ''), @$step->detail['apartment_suite_or_floor'], [
                            'class' => 'form-control apartmentSuiteOrFloor'
                        ]) }}
            @include('web.component.does-not-apply', ['field' => 'apartmentSuiteOrFloor', 'value' => @$step->detail['apartmentSuiteOrFloor']])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number') }}
            <span class="required">*</span>
            {{ Form::text('apartment_suite_or_floor_no', @$step->detail['apartmentSuiteOrFloorNo'] ? 'N/A' : @$step->detail['apartment_suite_or_floor_no'], [
                            'class' => 'form-control apartmentSuiteOrFloorNo',
                            'placeholder' => 'Please Enter Apartment, Suite or Floor Number'
                        ]) }}
            @include('web.component.does-not-apply', ['field' => 'apartmentSuiteOrFloorNo', 'value' => @$step->detail['apartmentSuiteOrFloorNo']])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('city', 'Town or City') }}
            <span class="required">*</span>
            {{ Form::text('city', @$step->detail['city'], [
                            'class' => 'form-control',
                            'placeholder' => 'Please Enter City'
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
            {{ Form::label('state_or_province', 'U.S. State (Select Does Not Apply if not USA)') }}
            <span class="required">*</span>
            {{ Form::text('state_or_province.', @$step->detail['stateOrProvince'] ? 'N/A' : @$step->detail['state_or_province'], [
                            'class' => 'form-control stateOrProvince',
                            'placeholder' => 'Please Enter State or Province.'
                        ]) }}
            @include('web.component.does-not-apply', ['field' => 'stateOrProvince', 'value' => @$step->detail['stateOrProvince']])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('province', 'Province') }}
            <span class="required">*</span>
            {{ Form::text('province', @$step->detail['provinceOptional'] ? 'N/A' : @$step->detail['province'], [
                            'class' => 'form-control provinceOptional',
                            'placeholder' => 'Please Enter Province'
                        ]) }}
            @include('web.component.does-not-apply', ['field' => 'provinceOptional', 'value' => @$step->detail['provinceOptional']])
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('postal_code', 'Postal Code') }}
            <span class="required">*</span>
            {{ Form::text('postal_code', @$step->detail['postalCode'] ? 'N/A' : @$step->detail['postal_code'], [
                            'class' => 'form-control postalCode',
                            'placeholder' => 'Please Enter Postal Code'
                        ]) }}
            @include('web.component.does-not-apply', ['field' => 'postalCode', 'value' => @$step->detail['postalCode']])
        </div>
    </div> --}}
    {{-- <div class="col-md-6">
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
</div> --}}
{{-- <div class="col-md-10">
                    <div class="form-group">
                        {{ Form::label('began_date', 'I began this job on (mm/dd/yyyy)') }}
<span class="required">*</span>
{{ Form::text('began_date', @$step->detail['began_date'], [
                            'class' => 'form-control datePicker beganDate',
                            'placeholder' => 'Enter Date'
                        ]) }}
</div>
</div>
<div class="col-md-2 mt-2 removeEmpBtn1" style="display: none;">
    <button type="button" class="btn btn-primary mt-4 removeEmploperSection" data-sec="1">
        <i class="fa fa-trash"></i>
    </button>
</div> --}}
</div>
{{-- <div class="emploperSection">
                @if (!empty(@$step->detail['employer1']))
                    @for ($i = 1; $i <= 5; $i++)
                        @if (isset($step->detail["employer$i"]))
                            @include('web.component.employer', ['index' => $i, 'data' => @$step->detail])
                        @endif
                    @endfor
                @endif       
            </div>             --}}
</div>
{{ Form::hidden("remaingYear", 'valid', ['class' => "remaingYear"]) }}
{!! Form::hidden('id', @$step->id) !!}
{!! Form::hidden('name', 'employment') !!}
{!! Form::hidden('type', 'sponsor') !!}
{{ Form::button('Back To Start', [
        'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
        'data-form' => 'name',
    ]) }}
{{ Form::button('Previous Step', [
        'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
        'data-form' => 'relationship',
    ]) }}
{{ Form::button('Skip & Continue', [
        'class' => 'btn btn-tra-grey ms-2 sponsorPreviousOrContinue',
        'data-form' => '',
    ]) }}
{{ Form::button('Save & Continue', [
        'class' => 'btn btn-tra-primary ms-2',
        'id' => 'fianceSponsorEmploymentBtn',
        'type' => 'submit',
    ]) }}
{{ Form::close() }}
<script type="text/javascript" src="{{ asset('assets/js/date-range.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // $('.aptsteflr').on('click', function() {
        //     var radio = $(this);
        //     alert(radio.is(':checked'));
        //     if (radio.is(':checked')) {
        //         radio.prop('checked', true);
        //     } else {
        //         radio.prop('checked', false);
        //     }
        // });

        var checkLength = parseInt($('.emploperSection > .emploperSec').length);
        if (checkLength < 5) {
            $('.remaingYear').val('invalid');
        }
    });


    $(document).on('change', '.employementEndDate', function() {
        if ($('input[name=present_date]:checked').length == 1) {
            $('.employementEndDate').addClass('disableDatePicker');
            employerForm1($(this));
        }
    });

    $(document).on('change', '.endDate', function() {
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
                '.  Enter your employment prior to ' + $('.beganDate' + dIndex).val() + '');
            
           
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

    $(document).on('click', '.removeEmploperSection', function() {
        datePicker();
        var sec = $(this).data('sec');
        $('.empSec' + sec).remove();
        $('.beganDate' + parseInt(sec - 1)).removeClass('disableDatePicker');
        $('.beganDate' + parseInt(sec - 1)).val('');
        $('.employementEndDate' + parseInt(sec - 1)).removeClass('disableDatePicker');
        $('.employementEndDate' + parseInt(sec - 1)).val('');
        if (parseInt(sec - 1) == 1) {
            $('.employementEndDate').removeClass('disableDatePicker');
            $('.employementEndDate').prop('checked', false);
        }
        $('.remaingYear').val('invalid');
    });

    // $(document).ready(function(){
    //     getState($('.countryId').val());
    // });

    // $(document).on('change', '.countryId', function(){
    //     var countryId = $(this).val();
    //     getState(countryId);
    // });

    // function getState(countryId)
    // {
    //     $.ajax({                
    //         type: 'get',
    //         url: "{{ route('getState') }}",
    //         data: {
    //             countryId: countryId
    //         },
    //         success: function(data) {
    //             $('.states').html(data);                    
    //         }
    //     });
    // }

    $("#fianceSponsorEmployment").validate({
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
            // apt_ste_flr1: {
            //     required: false,
            // },
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
                required: true,
            },
            full_name_of_employer2: {
                required: true,
            },
            street_number_and_name2: {
                required: true,
            },
            aptsteflr2: {
                required: false,
            },
            apt_ste_flr2: {
                required: false,
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
                required: false,
            },
            apt_ste_flr3: {
                required: false,
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
                required: false,
            },
            apt_ste_flr4: {
                required: false,
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
                required: false,
            },
            apt_ste_flr5: {
                required: false,
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
                required: false,
            },
        },
        messages: {
            full_name_of_employer1: "Please enter full name!",
            street_number_and_name1: "Please enter street number and name!",
            aptsteflr1: "This field is required!",
            // apt_ste_flr1: "This field is required!",
            city1: "Please enter town or city!",
            state1: "Please chose state!",
            zip_code1: "Please enter zip code!",
            province1: "Please enter province!",
            postal_code1: "Please enter postal code!",
            country1: "Please chose country!",
            occupation_specify1: "Please enter occupation specify!",
            employement_start_date1: "Please enter start date!",
            employement_end_date1: "Please enter end date!",
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
        errorPlacement: function(error, element) {
            var name = element.attr("name");
            if (name == "aptsteflr1" || name == "aptsteflr2" || name == "aptsteflr3" || name ==
                "aptsteflr4" || name == "aptsteflr5") {
                error.appendTo($("." + element.attr("name")));
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            // var checkSubmit = $('.remaingYear').val();               
            // if (checkSubmit == 'invalid') {
            //     toastr.options.timeOut = 10000;
            //     toastr.error('You must list your employment for the past 5 years');
            //     return false;
            // }
            $('#fianceSponsorEmploymentBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
            var serializedData = $(form).serialize();
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },
                type: 'post',
                url: "{{ route('fianceSponsorEmployment') }}",
                data: serializedData,
                dataType: 'json',
                success: function(data) {
                    if (data.status == true) {
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