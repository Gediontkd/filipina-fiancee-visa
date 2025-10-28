<!-- resources/views/web/visa-application/spouse-visa/beneficiary/name.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseBeneficiaryName'), 'id' => 'spouseBeneficiaryName']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>Beneficiary's Name and Gender</h2>
                <p class="text-muted small">Enter the foreign spouse's name exactly as it appears on their passport or birth certificate.</p>
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

                <!-- Prior names section -->
                <div class="col-md-12 firstPriorNameSec" style="display: {{ @$step->detail['prior_name1'] == 'yes' ? 'block' : 'none' }};">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('prior_first_name', 'Prior First Name') }}
                                <span class="required">*</span>
                                {{ Form::text('prior_first_name', @$step->detail['prior_first_name'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Prior First Name'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('prior_middle_name', 'Prior Middle Name') }}
                                {{ Form::text('prior_middle_name', @$step->detail['prior_middle_name'], [
                                    'class' => 'form-control priorMiddleName',
                                    'placeholder' => 'Enter Prior Middle Name',
                                    'id' => 'prior_middle_name'
                                ]) }}
                                <div class="form-check mt-2">
                                    {{ Form::checkbox('prior_middle_name_na', true, @$step->detail['prior_middle_name_na'] == true, [
                                        'class' => 'form-check-input doesNotApply',
                                        'data-field' => 'priorMiddleName',
                                        'id' => 'prior_middle_name_na'
                                    ]) }}
                                    {{ Form::label('prior_middle_name_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('prior_last_name', 'Prior Last Name') }}
                                <span class="required">*</span>
                                {{ Form::text('prior_last_name', @$step->detail['prior_last_name'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Prior Last Name'
                                ]) }}
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('section', 'beneficiary') !!}
        {!! Form::hidden('name', 'name') !!}
        {!! Form::hidden('next', 'contact') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'contact',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseBeneficiaryNameBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

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

        $(document).on('change', '.firstPriorName', function(){
            $('.firstPriorNameSec').toggle($(this).val() == 'yes');
        });

        $("#spouseBeneficiaryName").validate({
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
            },
            errorPlacement: function (error, element) {
                if (element.attr("type") == "radio") {
                    error.appendTo($("." + element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               first_name: "Please enter the beneficiary's first name",
               middle_name: "Please enter middle name or check 'Does Not Apply'",
               last_name: "Please enter the beneficiary's last name",
               gender: "Please select gender",
               prior_name1: "Please indicate if other names were used",
            },
            submitHandler: function(form) {
    $('#spouseBeneficiaryNameBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>')
        .prop('disabled', true);
    
    $.ajax({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        url: "{{ route('spouseBeneficiaryName') }}",
        data: $(form).serialize(),
        dataType: 'json',
        success: function(data) {               
            if (data.status) {                                           
                $('.beneficiary-name').removeClass('active');
                $('.beneficiary-contact').addClass('active');
                $('.spouseVisaForm').html(data.data);
                $('html, body').animate({
                    scrollTop: $('.spouseVisaForm').offset().top - 100
                }, 300);
                toastr.success('Name information saved successfully');
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
            $('#spouseBeneficiaryNameBtn').html('Save & Continue')
                .prop('disabled', false);
        }
    });
    return false;
}
        });
    </script>   
</div>