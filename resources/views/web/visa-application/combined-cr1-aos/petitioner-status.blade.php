<!-- resources/views/web/visa-application/combined-cr1-aos/petitioner-status.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedPetitionerStatus'), 'id' => 'combinedPetitionerStatus']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Petitioner's Information</h2>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>I am a:</label>
                    <span class="required">*</span>
                    <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::radio('citizenship_status', 'US_CITIZEN', @$step->detail['citizenship_status'] == 'US_CITIZEN' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> U.S. Citizen
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio('citizenship_status', 'LPR', @$step->detail['citizenship_status'] == 'LPR' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Lawful Permanent Resident
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 mt-3">
                <div class="form-group">
                    <label>How did you acquire citizenship/status?</label>
                    <span class="required">*</span>
                     <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::radio('acquired_via', 'BIRTH', @$step->detail['acquired_via'] == 'BIRTH' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Birth in the U.S.
                        </label>
                        <br>
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::radio('acquired_via', 'NATURALIZATION', @$step->detail['acquired_via'] == 'NATURALIZATION' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Naturalization
                        </label>
                        <br>
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::radio('acquired_via', 'PARENTS', @$step->detail['acquired_via'] == 'PARENTS' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Through Parents
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'petitioner-status') !!}
    {!! Form::hidden('next', 'petitioner-address') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-birth',
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
            'data-form' => 'petitioner-address',
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedPetitionerStatusBtn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedPetitionerStatus").validate({
            rules: {
                citizenship_status: { required: true },
                acquired_via: { required: true },
            },
            messages: {
                citizenship_status: "Please select your status!",
                acquired_via: "Please select how you acquired status!",
            },
            submitHandler: function(form) {
                $('#combinedPetitionerStatusBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedPetitionerStatus') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activepetitioner-status').removeClass('active');
                            $('.activepetitioner-address').addClass('active');
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
