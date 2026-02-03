<!-- resources/views/web/visa-application/combined-cr1-aos/petitioner-employment.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedPetitionerEmployment'), 'id' => 'combinedPetitionerEmployment']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Petitioner's Employment Information</h2>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('employer_name', 'Current Employer Name') }}
                    <span class="required">*</span>
                    {{ Form::text('employer_name', @$step->detail['employer_name'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Employer Name'
                    ]) }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('occupation', 'Occupation / Job Title') }}
                    <span class="required">*</span>
                    {{ Form::text('occupation', @$step->detail['occupation'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Occupation'
                    ]) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'petitioner-employment') !!}
    {!! Form::hidden('next', 'spouse-name') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-address',
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
            'data-form' => 'spouse-name',
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedPetitionerEmploymentBtn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedPetitionerEmployment").validate({
            rules: {
                employer_name: { required: true },
                occupation: { required: true },
            },
            messages: {
                employer_name: "Please enter employer name!",
                occupation: "Please enter occupation!",
            },
            submitHandler: function(form) {
                $('#combinedPetitionerEmploymentBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedPetitionerEmployment') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activepetitioner-employment').removeClass('active');
                            $('.activespouse-name').addClass('active');
                            $('.combinedCr1AosForm').html(data.data);
                        }
                        if (data.status == false) {
                            toastr.error(data.message);
                        }
                    }
                });
                return false;
            }
        });
    </script>
</div>
