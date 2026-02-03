<!-- resources/views/web/visa-application/combined-cr1-aos/relationship-story.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('combinedRelationshipStory'), 'id' => 'combinedRelationshipStory']) }}
    <div class="form-card">
        <div class="heading mb-30">
            <h2>Relationship Story</h2>
            <p>Briefly describe how you met and your relationship.</p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('story', 'Your Story') }}
                    <span class="required">*</span>
                    {{ Form::textarea('story', @$step->detail['story'], [
                        'class' => 'form-control',
                        'placeholder' => 'Write your story here...',
                        'rows' => 6
                    ]) }}
                </div>
            </div>
        </div>
    </div>
    {!! Form::hidden('id', @$step->id) !!}
    {!! Form::hidden('name', 'relationship-story') !!}
    {!! Form::hidden('next', 'aos-questions-1') !!}
    {!! Form::hidden('submitted_app_id', request()->submitted_app_id) !!}
    
    <div class="mobile-btn-stack">
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'petitioner-name',
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey combinedPreviousOrContinue',
            'data-form' => 'marriage-details',
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 combinedPreviousOrContinue',
            'data-form' => 'aos-questions-1',
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'combinedRelationshipStoryBtn',
            'type' => 'submit',
        ]) }}
    </div>
    {{ Form::close() }}

    <script type="text/javascript">
        $("#combinedRelationshipStory").validate({
            rules: {
                story: { required: true },
            },
            messages: {
                story: "Please write your relationship story!",
            },
            submitHandler: function(form) {
                $('#combinedRelationshipStoryBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('combinedRelationshipStory') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == true) {
                            $('.activerelationship-story').removeClass('active');
                            $('.activeaos-questions-1').addClass('active');
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
