<!-- resources/views/web/visa-application/combined-cr1-aos/petitioner-address.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedPetitionerAddress'), 'id' => 'combinedPetitionerAddress']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Petitioner's Current Mailing Address</h2>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('address', 'Street Address') }}
                    <span class="required">*</span>
                    {{ Form::text('address', @$step->detail['address'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Street Address'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('city', 'City') }}
                    <span class="required">*</span>
                    {{ Form::text('city', @$step->detail['city'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter City'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('state', 'State') }}
                    <span class="required">*</span>
                    {{ Form::text('state', @$step->detail['state'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter State'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('zip', 'Zip Code') }}
                    <span class="required">*</span>
                    {{ Form::text('zip', @$step->detail['zip'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Zip Code'
                    ]) }}
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('country', 'Country') }}
                    <span class="required">*</span>
                    {{ Form::text('country', @$step->detail['country'] ?? 'United States', [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Country'
                    ]) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'petitioner-address') !!}
    {!! Form::hidden('next', 'petitioner-employment') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-status',
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
            'data-form' => 'petitioner-employment',
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedPetitionerAddressBtn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedPetitionerAddress").validate({
            rules: {
                address: { required: true },
                city: { required: true },
                state: { required: true },
                zip: { required: true },
                country: { required: true },
            },
            messages: {
                address: "Please enter street address!",
                city: "Please enter city!",
                state: "Please enter state!",
                zip: "Please enter zip code!",
                country: "Please enter country!",
            },
            submitHandler: function(form) {
                $('#combinedPetitionerAddressBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedPetitionerAddress') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activepetitioner-address').removeClass('active');
                            $('.activepetitioner-employment').addClass('active');
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
