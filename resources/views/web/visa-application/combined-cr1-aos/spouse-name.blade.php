<!-- resources/views/web/visa-application/combined-cr1-aos/spouse-name.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedSpouseName'), 'id' => 'combinedSpouseName']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Spouse's Name (Beneficiary)</h2>
            <p>This is the foreign spouse you are petitioning for.</p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('spouse_first_name', "Spouse's First Name") }}
                    <span class="required">*</span>
                    {{ Form::text('spouse_first_name', @$step->detail['spouse_first_name'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter First Name',
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('spouse_middle_name', "Spouse's Middle Name") }}
                    <span class="required">*</span>
                    {{ Form::text('spouse_middle_name', @$step->detail['spouse_middle_name'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Middle Name',
                    ]) }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('spouse_last_name', "Spouse's Last Name") }}
                    <span class="required">*</span>
                    {{ Form::text('spouse_last_name', @$step->detail['spouse_last_name'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Last Name',
                    ]) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'spouse-name') !!}
    {!! Form::hidden('next', 'spouse-birth') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-employment',
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
            'data-form' => 'spouse-birth',
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedSpouseNameBtn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedSpouseName").validate({
            rules: {
                spouse_first_name: { required: true },
                spouse_middle_name: { required: true },
                spouse_last_name: { required: true },
            },
            messages: {
                spouse_first_name: "Please enter spouse's first name!",
                spouse_middle_name: "Please enter spouse's middle name!",
                spouse_last_name: "Please enter spouse's last name!",
            },
            submitHandler: function(form) {
                $('#combinedSpouseNameBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedSpouseName') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activespouse-name').removeClass('active');
                            $('.activespouse-birth').addClass('active');
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
