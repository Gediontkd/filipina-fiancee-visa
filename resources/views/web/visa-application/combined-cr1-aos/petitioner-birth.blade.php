<!-- resources/views/web/visa-application/combined-cr1-aos/petitioner-birth.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedPetitionerBirth'), 'id' => 'combinedPetitionerBirth']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Petitioner's Place/Date of Birth</h2>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('dob', 'Date of Birth') }}
                    <span class="required">*</span>
                    {{ Form::date('dob', @$step->detail['dob'], [
                        'class' => 'form-control',
                        'placeholder' => 'Select Date'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('birth_city', 'City/Town of Birth') }}
                    <span class="required">*</span>
                    {{ Form::text('birth_city', @$step->detail['birth_city'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter City/Town'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('birth_state', 'State/Province of Birth') }}
                    <span class="required">*</span>
                    {{ Form::text('birth_state', @$step->detail['birth_state'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter State/Province'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('birth_country', 'Country of Birth') }}
                    <span class="required">*</span>
                    {{ Form::text('birth_country', @$step->detail['birth_country'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Country'
                    ]) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'petitioner-birth') !!}
    {!! Form::hidden('next', 'petitioner-status') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-contact',
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
            'data-form' => 'petitioner-status',
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedPetitionerBirthBtn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedPetitionerBirth").validate({
            rules: {
                dob: { required: true },
                birth_city: { required: true },
                birth_state: { required: true },
                birth_country: { required: true },
            },
            messages: {
                dob: "Please select date of birth!",
                birth_city: "Please enter city of birth!",
                birth_state: "Please enter state of birth!",
                birth_country: "Please enter country of birth!",
            },
            submitHandler: function(form) {
                $('#combinedPetitionerBirthBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedPetitionerBirth') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activepetitioner-birth').removeClass('active');
                            $('.activepetitioner-status').addClass('active');
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
