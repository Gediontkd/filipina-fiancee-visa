<!-- resources\views\web\visa-application\spouse-visa\sponsor\name.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseSponsorName'), 'id' => 'spouseSponsorName']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>Sponsor's Name and Gender</h2>
                <p class="text-muted small">Please enter your name exactly as it appears on your birth certificate or passport.</p>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('first_name', "First Name (Given Name)") }}
                        <span class="required">*</span>
                        {{ Form::text('first_name', @$step->detail['first_name'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter First Name'
                        ]) }} 
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('middle_name', "Middle Name") }}
                        <span class="required">*</span>
                        {{ Form::text('middle_name', @$step->detail['middle_name'], [
                            'class' => 'form-control middleName',
                            'placeholder' => 'Enter Middle Name',
                            'id' => 'middle_name'
                        ]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('middle_name_na', true, @$step->detail['middle_name_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => 'middleName',
                                'id' => 'middle_name_na'
                            ]) }}
                            {{ Form::label('middle_name_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('last_name', "Last Name (Family Name)") }}
                        <span class="required">*</span>
                        {{ Form::text('last_name', @$step->detail['last_name'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Last Name'
                        ]) }}
                        <small class="form-text text-muted">Include any suffix (Jr., Sr., III, etc.) after the last name.</small>
                    </div>
                </div>               
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Gender <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('gender', 'male', @$step->detail['gender'] == 'male', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Male
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('gender', 'female', @$step->detail['gender'] == 'female', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Female
                            </label>
                        </div>
                        <div class="gender"></div>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever used another name (including maiden name, but not nicknames)? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('prior_name1', 'no', @$step->detail['prior_name1'] == 'no', [
                                    'class' => 'custom-control-input firstPriorName'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('prior_name1', 'yes', @$step->detail['prior_name1'] == 'yes', [
                                    'class' => 'custom-control-input firstPriorName'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="prior_name1"></div>
                    </div>
                </div>

                <div class="col-md-12 firstPriorNameSec" style="display: {{ @$step->detail['prior_name1'] == 'yes' ? 'block' : 'none'  }}">
                    <div class="form-group">
                        <label>Were any name changes for reasons other than marriage or divorce (e.g., adoption, court order)? <span class="required">*</span></label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('adoption_or_court_order', 'no', @$step->detail['adoption_or_court_order'] == 'no', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('adoption_or_court_order', 'yes', @$step->detail['adoption_or_court_order'] == 'yes', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <div class="adoption_or_court_order"></div>
                    </div>
                    
                    <h5>Prior Name #1</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label("prior1_fname", 'First Name') }}
                                <span class="required">*</span>
                                {{ Form::text("prior1_fname", @$step->detail['prior1_fname'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter name'
                                ]) }}                                        
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label("prior1_mname", 'Middle Name') }}
                                <span class="required">*</span>
                                {{ Form::text("prior1_mname", @$step->detail['prior1_mname'], [
                                    'class' => 'form-control mName1',
                                    'placeholder' => 'Enter name',
                                    'id' => 'prior1_mname'
                                ]) }}
                                <div class="form-check mt-2">
                                    {{ Form::checkbox('prior1_mname_na', true, @$step->detail['prior1_mname_na'] == true, [
                                        'class' => 'form-check-input doesNotApply',
                                        'data-field' => 'mName1',
                                        'id' => 'prior1_mname_na'
                                    ]) }}
                                    {{ Form::label('prior1_mname_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                                </div>
                            </div>                            
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label("prior1_lname", 'Last Name') }}
                                <span class="required">*</span>
                                {{ Form::text("prior1_lname", @$step->detail['prior1_lname'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter name'
                                ]) }}                                        
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Is this your maiden name? <span class="required">*</span></label>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio("prior1_maiden_name", 'no', @$step->detail['prior1_maiden_name'] == 'no', [
                                            'class' => 'custom-control-input'
                                        ]) }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("prior1_maiden_name", 'yes', @$step->detail['prior1_maiden_name'] == 'yes', [
                                            'class' => 'custom-control-input'
                                        ]) }}
                                        <span class="custom-control-label"></span> Yes
                                    </label>
                                </div>
                                <div class="prior1_maiden_name"></div>
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Do you have another prior name to add? <span class="required">*</span></label>
                                <div class="radiogroup">
                                    <label class="custom-control custom-radio mb-0 ">
                                        {{ Form::radio("prior_name2", 'no', @$step->detail['prior_name2'] == 'no', [
                                            'class' => 'custom-control-input secondPriorName'
                                        ]) }}
                                        <span class="custom-control-label"></span> No
                                    </label>
                                    <label class="custom-control custom-radio mb-0 ms-3">
                                        {{ Form::radio("prior_name2", 'yes', @$step->detail['prior_name2'] == 'yes', [
                                            'class' => 'custom-control-input secondPriorName'
                                        ]) }}
                                        <span class="custom-control-label"></span> Yes
                                    </label>
                                </div>
                                <div class="prior_name2"></div>
                            </div>                            
                        </div>
                    </div>
                </div>
                
                <!-- Additional prior names sections remain similar -->
                
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('section', 'sponsor') !!}
        {!! Form::hidden('name', 'name') !!}
        {!! Form::hidden('next', 'contact') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'start',
            'data-section' => 'sponsor'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'contact',
            'data-section' => 'sponsor'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseSponsorNameBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        // Improved "Does Not Apply" checkbox handler
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

        // Initialize on page load
        $(document).ready(function() {
            $('.doesNotApply:checked').each(function() {
                var fieldClass = $(this).data('field');
                var field = $('.' + fieldClass);
                field.val('N/A');
                field.prop('disabled', true);
                field.prop('readonly', true);
            });
        });

        $(document).on('change', '.firstPriorName', function(){
            if ($(this).val() == 'yes') {
                $('.firstPriorNameSec').show();
            } else {
                $('.firstPriorNameSec').hide();
            }
        });

        $(document).on('change', '.secondPriorName', function(){
            if ($(this).val() == 'yes') {
                $('.secondPriorNameSec').show();
            } else {
                $('.secondPriorNameSec').hide();
            }
        });

        $("#spouseSponsorName").validate({
            rules: {
                first_name: { required: true },
                middle_name: { 
                    required: function() {
                        return !$('#middle_name_na').is(':checked');
                    }
                },
                last_name: { required: true },
                gender: { required: true },
                prior_name1: { required: true },
                // Additional validation rules...
            },
            errorPlacement: function (error, element) {
                if (element.attr("type") == "radio") {
                    error.appendTo($("." + element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               first_name: "Please enter your first name",
               middle_name: "Please enter your middle name or check 'Does Not Apply'",
               last_name: "Please enter your last name",
               gender: "Please select your gender",
               prior_name1: "Please indicate if you have used other names",
            },
            submitHandler: function(form) {
                $('#spouseSponsorNameBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('spouseSponsorName') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.sponsor-name').removeClass('active');
                            $('.sponsor-contact').addClass('active');
                            $('.spouseVisaForm').html(data.data);                    
                        }
                        if (data.status == false) {
                            $('#spouseSponsorNameBtn').html('Save & Continue');
                            toastr.options.timeOut = 10000;
                            toastr.error(data.message);                           
                        }
                    },
                    error: function() {
                        $('#spouseSponsorNameBtn').html('Save & Continue');
                        toastr.error('An error occurred. Please try again.');
                    }
                });
               return false;
            }
        });
    </script>   
</div>