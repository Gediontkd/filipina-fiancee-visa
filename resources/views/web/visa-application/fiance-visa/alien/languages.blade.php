<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienLanguage'), 'id' => 'fianceAlienLanguage']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>All questions are about the Alien (foreign citizen).</h2>
                    </div>
                </div>                
                <div class="col-md-12 appendLanguage">
                    @if (empty($step->detail["language1"]))
                        <div class="language">
                            <div class="form-group">
                                {{ Form::label('language1', "Language 1") }}
                                <span class="required">*</span>
                                {{ Form::text('language1', @$step->detail['language1'], ['class' => 'form-control', 'placeholder' => 'Enter Language']) }}
                            </div>
                        </div>
                    @endif
                    @php
                        $i = '';
                    @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        @if (isset($step->detail["language$i"]))
                            <div class="language">
                                @if ($i != 1)
                                <div class="col-md-6 mb-4">
                                    <a class="btn btn-tra-grey removeLanguage">- Remove</a>
                                </div>
                                @endif
                                <div class="form-group">
                                    {{ Form::label("language$i", "Language $i") }}
                                    <span class="required">*</span>
                                    {{ Form::text("language$i", @$step->detail["language$i"], ['class' => 'form-control', 'placeholder' => 'Enter Language']) }}
                                </div>
                            </div>                         
                        @endif
                    @endfor
                </div>                
               <div class="col-md-6 mb-4">
                    <a class="btn btn-tra-grey addLanguageBtn">+ Add Another Language</a>
                </div>                                    
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'languages') !!}
        {!! Form::hidden('next', 'relatives') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'immigration'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'relatives'
        ]) }}
         {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienLanguageBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">        
        $("#fianceAlienLanguage").validate({
            rules: {
                language1: {
                    required: true,
                },
                language2: {
                    required: true,
                },
                language3: {
                    required: true,
                },
                language4: {
                    required: true,
                },
                language5: {
                    required: true,
                },                 
            },
            messages: {
               language1: "Please enter language!",                            
               language2: "Please enter language!",                            
               language3: "Please enter language!",                            
               language4: "Please enter language!",                            
               language5: "Please enter language!",                            
            },            
            submitHandler: function(form) {
                $('#fianceAlienLanguageBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienLanguage') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activactiveelanguages').removeClass('active');
                            $('.activerelatives').addClass('active');
                            $('.fianceVisaForm').html(data.data);                    
                        }
                        if (data.status == false) {
                            toastr.options.timeOut = 10000;
                            toastr.error(data.message);                          
                        }
                    }
                });
               return false;
            }
        });

        function languageField(index) {
            return '<div class="language"> <div class="col-md-6 mb-4"> <a class="btn btn-tra-grey removeLanguage">- Remove</a> </div> <div class="form-group"> <label for="language1">Language '+index+'</label> <span class="required">*</span> <input class="form-control" placeholder="Enter Language" name="language'+index+'" type="text" id="language'+index+'"> </div> </div>';
        }
    </script>
</div>