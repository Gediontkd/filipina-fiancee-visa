<!-- resources/views/web/visa-application/combined-cr1-aos/work-authorization.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedWorkAuthorization'), 'id' => 'combinedWorkAuthorization']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Work Authorization</h2>
            <p>Do you also want to apply for permission to work in the US?</p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Apply for Employment Authorization Document (EAD)?</label>
                    <span class="required">*</span>
                     <div class="radiogroup">
                        <label class="custom-control custom-radio mb-0">
                            {{ Form::radio('apply_ead', 'YES', @$step->detail['apply_ead'] == 'YES' ? true : '', [
                                'class' => 'custom-control-input',
                            ]) }}
                            <span class="custom-control-label"></span> Yes
                        </label>
                        <label class="custom-control custom-radio mb-0 ms-3">
                            {{ Form::radio('apply_ead', 'NO', @$step->detail['apply_ead'] == 'NO' ? true : '', [
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
    {!! Form::hidden('name', 'work-authorization') !!}
    {!! Form::hidden('next', 'finish') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'aos-questions-2',
        ]) }}
        
        {{ Form::button('Complete Application', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedWorkAuthorizationBtn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedWorkAuthorization").validate({
            rules: {
                apply_ead: { required: true },
            },
            messages: {
                apply_ead: "Please answer the question!",
            },
            submitHandler: function(form) {
                $('#combinedWorkAuthorizationBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedWorkAuthorization') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            // Redirect to success page or dashboard
                            window.location.href = "{{ route('visa-application.index') }}";
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
