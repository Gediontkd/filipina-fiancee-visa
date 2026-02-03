<!-- resources/views/web/visa-application/combined-cr1-aos/spouse-address.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedSpouseAddress'), 'id' => 'combinedSpouseAddress']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Spouse's Current Address</h2>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('spouse_address', 'Street Address') }}
                    <span class="required">*</span>
                    {{ Form::text('spouse_address', @$step->detail['spouse_address'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Street Address'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('spouse_city', 'City') }}
                    <span class="required">*</span>
                    {{ Form::text('spouse_city', @$step->detail['spouse_city'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter City'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('spouse_state', 'State') }}
                    <span class="required">*</span>
                    {{ Form::text('spouse_state', @$step->detail['spouse_state'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter State'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('spouse_zip', 'Zip Code') }}
                    <span class="required">*</span>
                    {{ Form::text('spouse_zip', @$step->detail['spouse_zip'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Zip Code'
                    ]) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'spouse-address') !!}
    {!! Form::hidden('next', 'marriage-details') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'spouse-entry',
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
            'data-form' => 'marriage-details',
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedSpouseAddressBtn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedSpouseAddress").validate({
            rules: {
                spouse_address: { required: true },
                spouse_city: { required: true },
                spouse_state: { required: true },
                spouse_zip: { required: true },
            },
            messages: {
                spouse_address: "Please enter street address!",
                spouse_city: "Please enter city!",
                spouse_state: "Please enter state!",
                spouse_zip: "Please enter zip code!",
            },
            submitHandler: function(form) {
                $('#combinedSpouseAddressBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedSpouseAddress') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activespouse-address').removeClass('active');
                            $('.activemarriage-details').addClass('active');
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
