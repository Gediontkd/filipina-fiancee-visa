<!-- resources\views\web\visa-application\spouse-visa\sponsor\military-convictions.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseMilitaryConviction'), 'id' => 'spouseMilitaryConviction']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Military Personnel Overseas</h2>
                    </div>                    
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you currently a member of the United States Armed Forces on active duty?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('member_of_us', 'no', @$step->detail['member_of_us'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('member_of_us', 'yes', @$step->detail['member_of_us'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                        </div>
                    </div>
                </div>                
                <div class="member_of_us"></div>                
            </div>            
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'military-convictions') !!}
        {!! Form::hidden('next', 'address') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'other-filings'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'address'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseMilitaryConvictionBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">        
        $(document).ready(function(){
            var appendPriorSpouse = $('.appendPriorSpouse > .priorSpouseForm').length;
            if (appendPriorSpouse == 2) {
                $('.addPriorSpouse').addClass('d-none');
            }            
        });

        $("#spouseMilitaryConviction").validate({
            rules: {
                member_of_us: {
                    required: true,
                },                
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "member_of_us") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }               
            },
            messages: {
               member_of_us: "Please choose option!",                                        
            },
            submitHandler: function(form) {
                $('#spouseMilitaryConvictionBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('spouseMilitaryConviction') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.military-convictions').removeClass('active');
                            $('.address').addClass('active');
                            $('.spouseVisaForm').html(data.data);                    
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
    </script>
</div>