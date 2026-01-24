<!-- resources/views/web/visa-application/spouse-visa/beneficiary/marital-status.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseBeneficiaryMaritalStatus'), 'id' => 'spouseBeneficiaryMaritalStatus']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Beneficiary's Marital Status</h2>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Is this a Proxy Marriage?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('proxy_marriage', 'no', @$step->detail['proxy_marriage'] == 'no', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('proxy_marriage', 'yes', @$step->detail['proxy_marriage'] == 'yes', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="proxy_marriage"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Was the beneficiary ever married before?</label>
                        <span class="required">*</span>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('ever_married_before', 'no', @$step->detail['ever_married_before'] == 'no', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('ever_married_before', 'yes', @$step->detail['ever_married_before'] == 'yes', [
                                    'class' => 'custom-control-input priorSpouse'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="ever_married_before"></div>
                        </div>
                    </div>
                </div>
                <div class="priorSpouseSec" style="display: {{ @$step->detail['ever_married_before'] == 'yes' ? 'block' : 'none' }};">
                    <p>Enter all Prior Spouses, no matter how many or how far back. You must provide a divorce, annulment or death certificate for all prior spouses with no exceptions. Space is limited to match USCIS forms. Abbreviate as necessary.</p>
                    <div class="appendPriorSpouse">                        
                        @for ($i = 1; $i <= 5; $i++)
                            @if (isset($step->detail["maiden_lname$i"]))
                                @include('web.component.prior-spouse', [
                                    'index' => $i,
                                    'data' => @$step->detail,
                                ])                      
                            @endif
                        @endfor
                    </div>                                   
                    <div class="col-md-6 mb-4">
                        <a class="btn btn-tra-grey addPriorSpouse">+ Add prior spouse</a>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label>Does the beneficiary have any children from previous relationships?</label>
                    <span class="required">*</span>
                    <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0 ">
                            {{ Form::radio('biological_child', 'no', @$step->detail['biological_child'] == 'no', [
                                'class' => 'custom-control-input biologicalChild'
                            ]) }}
                            <span class="custom-control-label"></span> No
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio('biological_child', 'yes', @$step->detail['biological_child'] == 'yes', [
                                'class' => 'custom-control-input biologicalChild'
                            ]) }}
                            <span class="custom-control-label"></span> Yes
                        </label>
                        <div class="biological_child"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 biologicalChildSec" style="display:{{ @$step->detail['biological_child'] == 'yes' ? 'block' : 'none' }};">
               <div class="row appendbiologicalChild">                                                        
                    @for ($i = 1; $i <= 9; $i++)
                        @if (isset($step->detail["given_first_name$i"]))
                            @include('web.component.biological-children', [
                                'index' => $i,
                                'data' => @$step->detail,
                            ])                      
                        @endif
                    @endfor
                </div>                                   
                <div class="col-md-6 mb-4">
                    <a class="btn btn-tra-grey addbiologicalChild">+ Add Child</a>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('section', 'beneficiary') !!}
        {!! Form::hidden('name', 'marital-status') !!}
        {!! Form::hidden('next', 'employment') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'status',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'employment',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseBeneficiaryMaritalStatusBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        // Initialize improved date pickers
        function initDatePickersWithDropdowns() {
            // Date of Birth picker with year dropdown
            $('.dateOfBirth').datepicker({
                dateFormat: 'mm/dd/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: '1900:' + new Date().getFullYear(),
                maxDate: new Date(),
                showButtonPanel: true
            });

            // General date picker for marriage dates
            $('.datePicker').datepicker({
                dateFormat: 'mm/dd/yy',
                changeMonth: true,
                changeYear: true,
                yearRange: '1900:' + (new Date().getFullYear() + 5),
                showButtonPanel: true
            });
        }

        $(document).ready(function(){
            initDatePickersWithDropdowns();
            
            var appendPriorSpouse = $('.appendPriorSpouse > .priorSpouseForm').length;
            if (appendPriorSpouse == 2) {
                $('.addPriorSpouse').addClass('d-none');
            }            
        });

        $(document).on('change', '.priorSpouse', function(){
            $('.priorSpouseSec').toggle($(this).val() == 'yes');
        });

        $(document).on('change', '.biologicalChild', function(){
            $('.biologicalChildSec').toggle($(this).val() == 'yes');
        });

        $(document).on('click', '.addPriorSpouse', function(){
            var priorSpouseCount = $('.appendPriorSpouse > .priorSpouseForm').length;
            if (priorSpouseCount < 2) {
                var index = priorSpouseCount + 1;
                $('.appendPriorSpouse').append(priorSpouseHtml(index));
                if (index == 2) {
                    $('.addPriorSpouse').addClass('d-none');
                }
            }
        });

        $(document).on('click', '.removePriorSpouse', function(){
            $(this).closest('.priorSpouseForm').remove();
            $('.addPriorSpouse').removeClass('d-none');
        });

        $(document).on('click', '.addbiologicalChild', function(){
            var biologicalChildCount = $('.appendbiologicalChild > .biologicalChildForm').length;
            if (biologicalChildCount < 9) {
                var index = biologicalChildCount + 1;
                $('.appendbiologicalChild').append(biologicalChildHtml(index));
            }
        });

        $(document).on('click', '.removebiologicalChild', function(){
            $(this).closest('.biologicalChildForm').remove();
        });

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

        $("#spouseBeneficiaryMaritalStatus").validate({
            rules: {
                proxy_marriage: { required: true },
                ever_married_before: { required: true },
                biological_child: { required: true },
            },
            errorPlacement: function (error, element) {
                if (element.attr("type") == "radio") {
                    error.appendTo($("." + element.attr("name")));
                } else {
                    error.insertAfter(element);
                }               
            },
            messages: {
               proxy_marriage: "Please select an option",               
               ever_married_before: "Please select an option",               
               biological_child: "Please select an option",               
            },
            submitHandler: function(form) {
    $('#spouseBeneficiaryMaritalStatusBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>')
        .prop('disabled', true);
    
    $.ajax({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        url: "{{ route('spouseBeneficiaryMaritalStatus') }}",
        data: $(form).serialize(),
        dataType: 'json',
        success: function(data) {               
            if (data.status) {                                           
                $('.beneficiary-marital-status').removeClass('active');
                $('.beneficiary-employment').addClass('active');
                $('.spouseVisaForm').html(data.data);
                $('html, body').animate({
                    scrollTop: $('.spouseVisaForm').offset().top - 100
                }, 300);
                toastr.success('Marital status saved successfully');
            } else {
                toastr.error(data.message || 'Failed to save information');                           
            }
        },
        error: function(xhr) {
            var errors = xhr.responseJSON?.errors;
            if (errors) {
                $.each(errors, function(field, messages) {
                    toastr.error(messages[0]);
                });
            } else {
                toastr.error(xhr.responseJSON?.message || 'An error occurred. Please try again.');
            }
        },
        complete: function() {
            $('#spouseBeneficiaryMaritalStatusBtn').html('Save & Continue')
                .prop('disabled', false);
        }
    });
    return false;
}
        });

        function priorSpouseHtml(index) {
            var removeBtn = '';
            if (index != 1) {
                removeBtn = '<div class="col-md-6 mb-4"> <a class="btn btn-tra-grey removePriorSpouse">- Remove #'+index+' prior spouse</a> </div>';
            }
            var html = '<div class="priorSpouseForm">'+removeBtn+'<h5>Prior Spouse #'+index+'</h5> <div class="row"> <div class="col-md-4"> <div class="form-group"> <label for="maiden_lname'+index+'">Maiden Last Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="maiden_lname'+index+'" type="text" value="" id="maiden_lname'+index+'"> </div> </div> <div class="col-md-4"> <div class="form-group"> <label for="middle_name'+index+'">Middle Name</label> <span class="required">*</span> <input class="form-control middleName'+index+'" placeholder="Enter name" name="middle_name'+index+'" type="text" value="" id="middle_name'+index+'"><div class="form-check mt-2"><input class="form-check-input doesNotApply" data-field="middleName'+index+'" type="checkbox" id="middle_name_na'+index+'"><label for="middle_name_na'+index+'" class="form-check-label">Does Not Apply</label></div></div> </div> <div class="col-md-4"> <div class="form-group"> <label for="first_name'+index+'">First Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter name" name="first_name'+index+'" type="text" value="" id="first_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="dob'+index+'">Date of Birth (mm/dd/yyyy, okay to estimate or enter Unknown)</label> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="mm/dd/yyyy" name="dob'+index+'" type="text" value="" id="dob'+index+'" autocomplete="off"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="birthCity'+index+'">Birth City</label> <span class="required">*</span> <input class="form-control birthCity'+index+'" placeholder="Enter City of Birth" name="birth_city'+index+'" type="text" value="" id="birth_city'+index+'"><div class="form-check mt-2"><input class="form-check-input doesNotApply" data-field="birthCity'+index+'" type="checkbox" id="birth_city_na'+index+'"><label for="birth_city_na'+index+'" class="form-check-label">Does Not Apply</label></div></div> </div> <div class="col-md-6"> <div class="form-group"> <label for="date_of_marriage'+index+'">Date of Marriage</label> <span class="required">*</span> <input class="form-control datePicker" placeholder="mm/dd/yyyy" name="date_of_marriage'+index+'" type="text" value="" id="date_of_marriage'+index+'" autocomplete="off"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="city_state_of_marriage'+index+'">City and State of Marriage (city and country if not USA)</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Place of Marriage" name="city_state_of_marriage'+index+'" type="text" value="" id="city_state_of_marriage'+index+'"> </div> </div> <div class="col-md-6"> <div class="form-group"> <label for="date_marriage_ended'+index+'">Date Marriage Ended (mm/dd/yyyy, must match divorce/annulment/death document)</label> <span class="required">*</span> <input class="form-control datePicker" placeholder="mm/dd/yyyy" name="date_marriage_ended'+index+'" type="text" value="" id="date_marriage_ended'+index+'" autocomplete="off"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="where_marriage_ended'+index+'">City and State where marriage ended (city and country if not USA) </label> <span class="required">*</span> <input class="form-control" placeholder="City and State where marriage ended" name="where_marriage_ended'+index+'" type="text" value="" id="where_marriage_ended'+index+'"> </div> </div> </div> </div>'; 
            
            setTimeout(function() {
                initDatePickersWithDropdowns();
            }, 100);
            
            return html;
        }

        function biologicalChildHtml(index) {
            var removeBtn = '';
            if (index != 1) {
                removeBtn = '<div class="col-md-6 mb-4"> <a class="btn btn-tra-grey removebiologicalChild">- Remove Child</a> </div>';
            }
            var html = '<div class="biologicalChildForm mb-4">'+removeBtn+'<div class="col-md-12"> <div class="form-group"> <label for="given_first_name'+index+'">Given Name (First Name)</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="given_first_name'+index+'" type="text" id="given_first_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="middle_name'+index+'">Middle Name</label> <span class="required">*</span> <input class="form-control childMiddleName'+index+'" placeholder="Enter Name" name="middle_name'+index+'" type="text" id="middle_name'+index+'"><div class="form-check mt-2"><input class="form-check-input doesNotApply" data-field="childMiddleName'+index+'" type="checkbox" id="child_middle_name_na'+index+'"><label for="child_middle_name_na'+index+'" class="form-check-label">Does Not Apply</label></div></div> </div> <div class="col-md-12"> <div class="form-group"> <label for="last_name'+index+'">Last Name</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Name" name="last_name'+index+'" type="text" id="last_name'+index+'"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label>Relationship to the sponsor</label> <div class="radiogroup"> <label class="custom-control custom-radio mb-0 "> <input class="custom-control-input" name="relationship'+index+'" type="radio" value="stepdaughter"> <span class="custom-control-label"></span> Stepdaughter </label> <label class="custom-control custom-radio mb-0 ms-3"> <input class="custom-control-input" name="relationship'+index+'" type="radio" value="stepson"> <span class="custom-control-label"></span> Stepson </label> </div> <div class="relationship'+index+'"></div> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="child_dob'+index+'">Date of Birth (mm/dd/yyyy)</label> <span class="required">*</span> <input class="form-control dateOfBirth" placeholder="mm/dd/yyyy" name="child_dob'+index+'" type="text" id="child_dob'+index+'" autocomplete="off"> </div> </div> <div class="col-md-12"> <div class="form-group"> <label for="country_of_birth'+index+'">Country of Birth</label> <span class="required">*</span> <select class="form-control" id="country_of_birth'+index+'" name="country_of_birth'+index+'"> <option value="" selected="selected">-Select Country-</option> @foreach(getCountry() as $country)</option><option value="{{ $country->id }}">{{ $country->name }}</option>@endforeach </select> </div> </div> </div>'; 
            
            setTimeout(function() {
                initDatePickersWithDropdowns();
            }, 100);
            
            return html;
        }
    </script>
</div>