<!-- resources/views/web/visa-application/combined-cr1-aos/petitioner-contact.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedPetitionerContact'), 'id' => 'combinedPetitionerContact']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Petitioner's Contact Information</h2>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('email', "Email Address") }}
                    <span class="required">*</span>
                    {{ Form::text('email', @$step->detail['email'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Email address'
                    ]) }}        
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('daytime_telephone_no', 'Daytime Phone') }}
                    <span class="required">*</span>
                    {{ Form::text('daytime_telephone_no', @$step->detail['daytime_telephone_no'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter daytime phone',
                        'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('mobile_telephone_number', 'Mobile Phone') }}
                    <span class="required">*</span>
                    {{ Form::text('mobile_telephone_number', @$step->detail['mobile_telephone_number'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter mobile phone',
                        'oninput' => "this.value = this.value.replace(/[^0-9]/g, '')"
                    ]) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'petitioner-contact') !!}
    {!! Form::hidden('next', 'place-of-birth') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    {{ Form::button('Back To Start', [
        'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
        'data-form' => 'petitioner-name',
    ]) }}
    {{ Form::button('Previous Step', [
        'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
        'data-form' => 'petitioner-name',
    ]) }}
    {{ Form::button('Skip & Continue', [
        'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
        'data-form' => 'place-of-birth',
    ]) }}
    {{ Form::button('Save & Continue', [
        'class' => 'btn btn-tra-primary ms-2',
        'id' => 'combinedPetitionerContactBtn',
        'type' => 'submit',
    ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedPetitionerContact").validate({
            rules: {
                email: { required: true, email: true },
                daytime_telephone_no: { required: true, digits: true },
                mobile_telephone_number: { required: true, digits: true },
            },
            messages: {
                email: "Please enter a valid email!",
                daytime_telephone_no: "Please enter a valid daytime phone number (digits only)!",
                mobile_telephone_number: "Please enter a valid mobile number (digits only)!",
            },
            submitHandler: function(form) {
                $('#combinedPetitionerContactBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedPetitionerContact') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activepetitioner-contact').removeClass('active');
                            $('.activeplace-of-birth').addClass('active');
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
