<!-- resources/views/web/visa-application/combined-cr1-aos/petitioner-name.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedPetitionerName'), 'id' => 'combinedPetitionerName']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>U.S. Petitioner's Name And Gender</h2>
            <p>This is the U.S. citizen who is petitioning for their foreign spouse</p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('first_name', "Petitioner's First Name") }}
                    <span class="required">*</span>
                    {{ Form::text('first_name', @$step->detail['first_name'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter First Name',
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('middle_name', "Petitioner's Middle Name") }}
                    <span class="required">*</span>
                    {{ Form::text('middle_name', @$step->detail['middle_name'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Middle Name',
                    ]) }}
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('last_name', "Petitioner's Last Name (family name)") }}
                    <span class="required">*</span>
                    {{ Form::text('last_name', @$step->detail['last_name'], [
                        'class' => 'form-control',
                        'placeholder' => 'Enter Last Name',
                    ]) }}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Petitioner's Gender</label>
                    <span class="required">*</span>
                    <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::radio('gender', 'male', @$step->detail['gender'] == 'male' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Male
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio('gender', 'female', @$step->detail['gender'] == 'female' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Female
                        </label>
                    </div>
                    <div class="gender"></div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'petitioner-name') !!}
    {!! Form::hidden('next', 'petitioner-contact') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    {{ Form::button('Back To Start', [
        'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
        'data-form' => 'petitioner-name',
    ]) }}
    {{ Form::button('Skip & Continue', [
        'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
        'data-form' => 'petitioner-contact',
    ]) }}
    {{ Form::button('Save & Continue', [
        'class' => 'btn btn-tra-primary ms-2',
        'id' => 'combinedPetitionerNameBtn',
        'type' => 'submit',
    ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedPetitionerName").validate({
            rules: {
                first_name: { required: true },
                middle_name: { required: true },
                last_name: { required: true },
                gender: { required: true },
            },
            errorPlacement: function(error, element) {
                if (element.attr("name") == "gender") {
                    error.appendTo($("." + element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
                first_name: "Please enter your first name!",
                middle_name: "Please enter your middle name!",
                last_name: "Please enter your last name!",
                gender: "Please choose gender!",
            },
            submitHandler: function(form) {
                $('#combinedPetitionerNameBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedPetitionerName') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activepetitioner-name').removeClass('active');
                            $('.activepetitioner-contact').addClass('active');
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