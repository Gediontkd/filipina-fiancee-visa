<!-- resources/views/web/visa-application/combined-cr1-aos/marriage-details.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedMarriageDetails'), 'id' => 'combinedMarriageDetails']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Marriage Details</h2>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('marriage_date', 'Date of Marriage') }}
                    <span class="required">*</span>
                    {{ Form::date('marriage_date', @$step->detail['marriage_date'], [
                        'class' => 'form-control',
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('marriage_city', 'City of Marriage') }}
                    <span class="required">*</span>
                    {{ Form::text('marriage_city', @$step->detail['marriage_city'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter City'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('marriage_state', 'State/Province of Marriage') }}
                    <span class="required">*</span>
                    {{ Form::text('marriage_state', @$step->detail['marriage_state'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter State/Province'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('marriage_country', 'Country of Marriage') }}
                    <span class="required">*</span>
                    {{ Form::text('marriage_country', @$step->detail['marriage_country'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Country'
                    ]) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'marriage-details') !!}
    {!! Form::hidden('next', 'relationship-story') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'spouse-address',
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
            'data-form' => 'relationship-story',
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedMarriageDetailsBtn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedMarriageDetails").validate({
            rules: {
                marriage_date: { required: true },
                marriage_city: { required: true },
                 marriage_state: { required: true },
                marriage_country: { required: true },
            },
            messages: {
                marriage_date: "Please select marriage date!",
                marriage_city: "Please enter marriage city!",
                 marriage_state: "Please enter marriage state!",
                marriage_country: "Please enter marriage country!",
            },
            submitHandler: function(form) {
                $('#combinedMarriageDetailsBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedMarriageDetails') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activemarriage-details').removeClass('active');
                            $('.activerelationship-story').addClass('active');
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
