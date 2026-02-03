<!-- resources/views/web/visa-application/combined-cr1-aos/aos-questions-1.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedAosQuestions1'), 'id' => 'combinedAosQuestions1']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Adjustment of Status Questions (Part 1)</h2>
             <p>Have you EVER...</p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Been denied a visa to the U.S.?</label>
                    <span class="required">*</span>
                     <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::radio('denied_visa', 'YES', @$step->detail['denied_visa'] == 'YES' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Yes
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio('denied_visa', 'NO', @$step->detail['denied_visa'] == 'NO' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> No
                        </label>
                    </div>
                </div>
            </div>
             <div class="col-md-12 mt-3">
                <div class="form-group">
                    <label>Worked in the U.S. without authorization?</label>
                    <span class="required">*</span>
                     <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::radio('worked_unauthorized', 'YES', @$step->detail['worked_unauthorized'] == 'YES' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Yes
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio('worked_unauthorized', 'NO', @$step->detail['worked_unauthorized'] == 'NO' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> No
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'aos-questions-1') !!}
    {!! Form::hidden('next', 'aos-questions-2') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'relationship-story',
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
            'data-form' => 'aos-questions-2',
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedAosQuestions1Btn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedAosQuestions1").validate({
            rules: {
                denied_visa: { required: true },
                worked_unauthorized: { required: true },
            },
            messages: {
                denied_visa: "Please answer the question!",
                worked_unauthorized: "Please answer the question!",
            },
            submitHandler: function(form) {
                $('#combinedAosQuestions1Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedAosQuestions1') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activeaos-questions-1').removeClass('active');
                            $('.activeaos-questions-2').addClass('active');
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
