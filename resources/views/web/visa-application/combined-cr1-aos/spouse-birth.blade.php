<!-- resources/views/web/visa-application/combined-cr1-aos/spouse-birth.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedSpouseBirth'), 'id' => 'combinedSpouseBirth']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Spouse's Birth Information</h2>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('spouse_dob', 'Date of Birth') }}
                    <span class="required">*</span>
                    {{ Form::date('spouse_dob', @$step->detail['spouse_dob'], [
                        'class' => 'form-control',
                        'placeholder' => 'Select Date'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('spouse_birth_country', 'Country of Birth') }}
                    <span class="required">*</span>
                    {{ Form::text('spouse_birth_country', @$step->detail['spouse_birth_country'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Country'
                    ]) }}
                </div>
            </div>
             <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('spouse_birth_city', 'City/Town of Birth') }}
                    <span class="required">*</span>
                    {{ Form::text('spouse_birth_city', @$step->detail['spouse_birth_city'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter City/Town'
                    ]) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'spouse-birth') !!}
    {!! Form::hidden('next', 'spouse-entry') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'spouse-name',
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
            'data-form' => 'spouse-entry',
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedSpouseBirthBtn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedSpouseBirth").validate({
            rules: {
                spouse_dob: { required: true },
                spouse_birth_country: { required: true },
                spouse_birth_city: { required: true },
            },
            messages: {
                spouse_dob: "Please select date of birth!",
                spouse_birth_country: "Please enter country of birth!",
                spouse_birth_city: "Please enter city of birth!",
            },
            submitHandler: function(form) {
                $('#combinedSpouseBirthBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedSpouseBirth') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activespouse-birth').removeClass('active');
                            $('.activespouse-entry').addClass('active');
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
