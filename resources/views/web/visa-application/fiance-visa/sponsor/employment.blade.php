<!-- resources\views\web\visa-application\fiance-visa\sponsor\employment.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceSponsorEmployment'), 'id' => 'fianceSponsorEmployment']) }}
    <div class="form-card">
        <div class="row">
            <div class="col-md-12">
                <div class="heading mb-30">
                    <h2>Your Employment for the Past Five Years (U.S. Citizen Sponsor)</h2>
                    <p>Employment must be a continuous 5-year timeline. Employer 1 must always be your current or present status.</p>
                    <p>Enter <strong>Unemployed</strong> with a start date and <strong>PRESENT</strong> if you are not working right now. Enter <strong>Retired</strong> if that is your current status.</p>
                </div>
            </div>
            <div class="emploperSection">
                @if (empty(@$step->detail['employer1']))
                    @include('web.component.employer', ['index' => 1, 'data' => @$step->detail])
                @endif
                @if (!empty(@$step->detail['employer1']))
                    @for ($i = 1; $i <= 5; $i++)
                        @if (isset($step->detail["employer$i"]))
                            @include('web.component.employer', ['index' => $i, 'data' => @$step->detail])
                        @endif
                    @endfor
                @endif
            </div>
        </div>
    </div>
    {{-- Part 7: Preparer and/or Interpreter --}}
    <div class="form-card mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="heading mb-30">
                    <h2>Part 7 — Preparer and/or Interpreter (Optional)</h2>
                    <p>Complete this section if someone other than you prepared or helped prepare this petition. Leave blank if you completed this form yourself.</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Did someone help you prepare or interpret this form?</label>
                    <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::radio('has_preparer', 'no', @$step->detail['has_preparer'] == 'no' ? true : (@$step->detail['has_preparer'] ? '' : true), [
                                'class' => 'custom-control-input hasPreparer'
                            ]) }}
                            <span class="custom-control-label"></span> No
                        </label>
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::radio('has_preparer', 'yes', @$step->detail['has_preparer'] == 'yes' ? true : '', [
                                'class' => 'custom-control-input hasPreparer'
                            ]) }}
                            <span class="custom-control-label"></span> Yes
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-md-12 preparerSec" style="display: {{ @$step->detail['has_preparer'] == 'yes' ? 'block' : 'none' }};">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('preparer_family_name', 'Preparer Family Name (Last Name)') }}
                            {{ Form::text('preparer_family_name', @$step->detail['preparer_family_name'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter last name'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('preparer_given_name', 'Preparer Given Name (First Name)') }}
                            {{ Form::text('preparer_given_name', @$step->detail['preparer_given_name'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter first name'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('preparer_business_name', 'Business or Organization Name (if applicable)') }}
                            {{ Form::text('preparer_business_name', @$step->detail['preparer_business_name'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter business or organization name'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('preparer_daytime_phone', 'Preparer Daytime Phone Number') }}
                            {{ Form::text('preparer_daytime_phone', @$step->detail['preparer_daytime_phone'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter phone number'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('preparer_email', 'Preparer Email Address') }}
                            {{ Form::text('preparer_email', @$step->detail['preparer_email'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter email address'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Did an interpreter assist in completing this form?</label>
                            <div class="radiogroup">
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('has_interpreter', 'no', @$step->detail['has_interpreter'] == 'no' ? true : (@$step->detail['has_interpreter'] ? '' : true), [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> No
                                </label>
                                <label class="custom-control custom-radio mb-0">
                                    {{ Form::radio('has_interpreter', 'yes', @$step->detail['has_interpreter'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <span class="custom-control-label"></span> Yes
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        $(document).on('change', '.hasPreparer', function() {
            if ($(this).val() == 'yes') {
                $('.preparerSec').show();
            } else {
                $('.preparerSec').hide();
            }
        });

        $(document).ready(function() {
            var checkLength = parseInt($('.emploperSection > .emploperSec').length);
            if (checkLength < 5) {
                $('.remaingYear').val('invalid');
            }

            // Handle "Present?" checkbox on page load
            if ($('input[name=present_date]:checked').length == 1) {
                $('.employementEndDate1').prop('disabled', true);
                $('.employementEndDate1').val('Present');
                $('.employementEndDate1').removeClass('error');
            }
        });

        // Handle "Present?" checkbox change
        $(document).on('change', 'input[name=present_date]', function() {
            if ($(this).is(':checked')) {
                // Set end date to "Present" and disable field
                $('.employementEndDate1').val('Present');
                $('.employementEndDate1').prop('disabled', true);
                $('.employementEndDate1').addClass('disableDatePicker');
                $('.employementEndDate1').removeClass('error');
                
                // Remove any validation error
                $('label[for="employement_end_date1"].error').remove();
                
                // Trigger employer form logic
                employerForm1($('.employementEndDate1'));
            } else {
                // Re-enable field and clear value
                $('.employementEndDate1').val('');
                $('.employementEndDate1').prop('disabled', false);
                $('.employementEndDate1').removeClass('disableDatePicker');
            }
        });

        $(document).on('change', '.endDate', function() {
            if (!$(this).prop('disabled')) {
                $('.employementEndDate').addClass('disableDatePicker');
                employerForm1($(this));
            }
        });

        function employerForm1(field) {
            datePicker();
            var dIndex = field.data('index');
            var startDate = new Date($('.beganDate' + dIndex).val());
            
            // Handle "Present" value
            var endDateValue = field.val();
            var endDate;
            
            if (endDateValue === 'Present' || $('input[name=present_date]:checked').length == 1) {
                endDate = new Date(); // Use current date
            } else {
                endDate = new Date(endDateValue);
            }
            
            var yearDiff = endDate.getFullYear() - startDate.getFullYear();
           
            if (endDate.getMonth() < startDate.getMonth() || (endDate.getMonth() === startDate.getMonth() && endDate
                    .getDate() < startDate.getDate())) {
                yearDiff--;
            }

            var lastEndDate = new Date($('.endDate').val());
            
            var monthDiff = lastEndDate.getMonth() - startDate.getMonth();

            if (monthDiff < 0) {
                monthDiff += 12;
            }
            
            var existsRemaingYears = parseInt($('.remaingYears' + dIndex).val());
            if (existsRemaingYears && existsRemaingYears > 0) {
                yearDiff = existsRemaingYears - yearDiff;
            }
            
            var index = parseInt($('.emploperSection > .emploperSec').length + 1);
            var sec = parseInt(field.data('sec') + 1);

            if (yearDiff <= 5 && yearDiff > 0) {
                var minDate = new Date();
                minDate.setFullYear(minDate.getFullYear() - 5);

                if (startDate < minDate) {
                    $('.remaingYear').val('valid');
                    return;
                }

                $('.remaingYear').val('invalid');
                $('.removeEmpBtn' + yearDiff).show();
                $('.emploperSection').append(`{!! addslashes(
                        view('web.component.employer')->with(['index' => '${index}'])->render(),
                    ) !!}`);

                var maxDate = new Date(moment($('.beganDate' + dIndex).val(), "MM/DD/YYYY").format("YYYY-MM-DD"));
                
                $('.sectionHeading' + index).html('You must list your employment for the past ' + yearDiff +
                    ' years. Enter your employment prior to ' + $('.beganDate' + dIndex).val() + '');
                
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
                $('input[name=present_date]').prop('checked', false);
                $('.employementEndDate1').prop('disabled', false);
            }
            
            $('.remaingYear').val('invalid');
        });

        $("#fianceSponsorEmployment").validate({
            rules: {
                full_name_of_employer1: { required: true },
                street_number_and_name1: { required: true },
                aptsteflr1: { required: true },
                city1: { required: true },
                state1: { required: true },
                zip_code1: { required: true },
                province1: { required: true },
                postal_code1: { required: true },
                country1: { required: true },
                occupation_specify1: { required: true },
                employement_start_date1: { required: true },
                employement_end_date1: { 
                    required: function() {
                        // Not required if "Present?" is checked
                        return $('input[name=present_date]:checked').length == 0;
                    }
                },
                full_name_of_employer2: { required: true },
                street_number_and_name2: { required: true },
                aptsteflr2: { required: false },
                city2: { required: true },
                state2: { required: true },
                zip_code2: { required: true },
                province2: { required: true },
                postal_code2: { required: true },
                country2: { required: true },
                occupation_specify2: { required: true },
                employement_start_date2: { required: true },
                employement_end_date2: { required: true },
                full_name_of_employer3: { required: true },
                street_number_and_name3: { required: true },
                aptsteflr3: { required: false },
                city3: { required: true },
                state3: { required: true },
                zip_code3: { required: true },
                province3: { required: true },
                postal_code3: { required: true },
                country3: { required: true },
                occupation_specify3: { required: true },
                employement_start_date3: { required: true },
                employement_end_date3: { required: true },
                full_name_of_employer4: { required: true },
                street_number_and_name4: { required: true },
                aptsteflr4: { required: false },
                city4: { required: true },
                state4: { required: true },
                zip_code4: { required: true },
                province4: { required: true },
                postal_code4: { required: true },
                country4: { required: true },
                occupation_specify4: { required: true },
                employement_start_date4: { required: true },
                employement_end_date4: { required: true },
                full_name_of_employer5: { required: true },
                street_number_and_name5: { required: true },
                aptsteflr5: { required: false },
                city5: { required: true },
                state5: { required: true },
                zip_code5: { required: true },
                province5: { required: true },
                postal_code5: { required: true },
                country5: { required: true },
                occupation_specify5: { required: true },
                employement_start_date5: { required: true },
                employement_end_date5: { required: false },
                preparer_family_name: {
                    required: function() { return $('input[name=has_preparer]:checked').val() == 'yes'; }
                },
                preparer_given_name: {
                    required: function() { return $('input[name=has_preparer]:checked').val() == 'yes'; }
                },
                preparer_daytime_phone: {
                    required: function() { return $('input[name=has_preparer]:checked').val() == 'yes'; }
                },
                preparer_email: {
                    required: function() { return $('input[name=has_preparer]:checked').val() == 'yes'; },
                    email: true
                },
            },
            messages: {
                full_name_of_employer1: "Please enter full name!",
                street_number_and_name1: "Please enter street number and name!",
                aptsteflr1: "This field is required!",
                city1: "Please enter town or city!",
                state1: "Please chose state!",
                zip_code1: "Please enter zip code!",
                province1: "Please enter province!",
                postal_code1: "Please enter postal code!",
                country1: "Please chose country!",
                occupation_specify1: "Please enter occupation specify!",
                employement_start_date1: "Please enter start date!",
                employement_end_date1: "Please enter end date or check 'Present?'!",
                full_name_of_employer2: "Please enter full name!",
                street_number_and_name2: "Please enter street number and name!",
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
                if (!$('#present_date_checkbox').is(':checked')) {
                    toastr.error('Employer 1 must always be your current or present status. If you are not working, enter Unemployed and mark PRESENT.');
                    return false;
                }

                $('#fianceSponsorEmploymentBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                
                // Re-enable end date field temporarily for form submission
                var wasDisabled = $('.employementEndDate1').prop('disabled');
                if (wasDisabled) {
                    $('.employementEndDate1').prop('disabled', false);
                }
                
                var serializedData = $(form).serialize();
                
                // Disable it again
                if (wasDisabled) {
                    $('.employementEndDate1').prop('disabled', true);
                }
                
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
                            $('#fianceSponsorEmploymentBtn').html('Save & Continue');
                            toastr.options.timeOut = 10000;
                            toastr.error(data.message);
                        }
                    },
                    error: function() {
                        $('#fianceSponsorEmploymentBtn').html('Save & Continue');
                        toastr.error('An error occurred. Please try again.');
                    }
                });
                return false;
            }
        });
    </script>
</div>
