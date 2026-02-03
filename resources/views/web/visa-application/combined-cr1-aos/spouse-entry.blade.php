<!-- resources/views/web/visa-application/combined-cr1-aos/spouse-entry.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedSpouseEntry'), 'id' => 'combinedSpouseEntry']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Spouse's Entry Information</h2>
            <p>Information from the I-94 Arrival-Departure Record</p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
             <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('i94_number', 'I-94 Number') }}
                    <span class="required">*</span>
                    {{ Form::text('i94_number', @$step->detail['i94_number'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter I-94 Number'
                    ]) }}
                </div>
            </div>
             <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('passport_number', 'Passport Number Used at Entry') }}
                    <span class="required">*</span>
                    {{ Form::text('passport_number', @$step->detail['passport_number'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Passport Number'
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('date_of_entry', 'Date of Last Arrival') }}
                    <span class="required">*</span>
                    {{ Form::date('date_of_entry', @$step->detail['date_of_entry'], [
                        'class' => 'form-control',
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('status_at_entry', 'Status at Last Entry (e.g. B-2 Visitor)') }}
                    <span class="required">*</span>
                    {{ Form::text('status_at_entry', @$step->detail['status_at_entry'], [
                        'class' => 'form-control',
                        'placeholder' => 'e.g., Visitor, Student'
                    ]) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'spouse-entry') !!}
    {!! Form::hidden('next', 'spouse-address') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'spouse-birth',
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
            'data-form' => 'spouse-address',
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedSpouseEntryBtn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedSpouseEntry").validate({
            rules: {
                i94_number: { required: true },
                passport_number: { required: true },
                date_of_entry: { required: true },
                 status_at_entry: { required: true },
            },
            messages: {
                i94_number: "Please enter I-94 number!",
                passport_number: "Please enter passport number!",
                date_of_entry: "Please select date of entry!",
                 status_at_entry: "Please enter status at entry!",
            },
            submitHandler: function(form) {
                $('#combinedSpouseEntryBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedSpouseEntry') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activespouse-entry').removeClass('active');
                            $('.activespouse-address').addClass('active');
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
