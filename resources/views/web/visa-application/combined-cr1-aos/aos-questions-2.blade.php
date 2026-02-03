<!-- resources/views/web/visa-application/combined-cr1-aos/aos-questions-2.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedAosQuestions2'), 'id' => 'combinedAosQuestions2']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Adjustment of Status Questions (Part 2)</h2>
             <p>Have you EVER...</p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Been arrested or convicted of a crime?</label>
                    <span class="required">*</span>
                     <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::radio('arrested', 'YES', @$step->detail['arrested'] == 'YES' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Yes
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio('arrested', 'NO', @$step->detail['arrested'] == 'NO' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> No
                        </label>
                    </div>
                </div>
            </div>
             <div class="col-md-12 mt-3">
                <div class="form-group">
                    <label>Violated the terms of your nonimmigrant status?</label>
                    <span class="required">*</span>
                     <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::radio('violated_status', 'YES', @$step->detail['violated_status'] == 'YES' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Yes
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio('violated_status', 'NO', @$step->detail['violated_status'] == 'NO' ? true : '', [
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
    {!! Form::hidden('name', 'aos-questions-2') !!}
    {!! Form::hidden('next', 'work-authorization') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'aos-questions-1',
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
            'data-form' => 'work-authorization',
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedAosQuestions2Btn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedAosQuestions2").validate({
            rules: {
                arrested: { required: true },
                violated_status: { required: true },
            },
            messages: {
                arrested: "Please answer the question!",
                violated_status: "Please answer the question!",
            },
            submitHandler: function(form) {
                $('#combinedAosQuestions2Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedAosQuestions2') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activeaos-questions-2').removeClass('active');
                            $('.activework-authorization').addClass('active');
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
