<!-- resources\views\web\visa-application\spouse-visa\relationship.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseRelationship'), 'id' => 'spouseRelationship']) }}
        <div class="form-card">
            <div class="row">                
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Relationship</h2>
                        <p>List the date and place of your current marriage.</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('wedding_date', 'Wedding Date (mm/dd/yyyy)') }}
                        <span class="required">*</span>
                        {{ Form::text('wedding_date', @$step->detail['wedding_date'], [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'Enter Date'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('wedding_city', 'Wedding City') }}
                        <span class="required">*</span>
                        {{ Form::text('wedding_city', @$step->detail['wedding_city'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter city'
                        ]) }}
                    </div>
                </div>               
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('wedding_state', 'Wedding State, Province or Region (Enter N/A for None)') }}
                        <span class="required">*</span>
                        {{ Form::text('wedding_state', @$step->detail['wedding_state'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Wedding State, Province or Region'
                        ]) }}
                    </div>
                </div>               
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('wedding_country ', "Wedding Country ") }}
                        <span class="required">*</span>
                        {{ Form::select('wedding_country', getAllCountry(), @$step->detail['wedding_country'], [
                            'class' => 'form-control'
                        ]) }}                       
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you and your spouse ever lived together? Do not include vacations. It is not necessary that you have lived together to receive a Spousal Visa. Most people applying for a Spousal Visa have not lived together and are still approved.</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('lived_together', 'no', @$step->detail['lived_together'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input livedTogether'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('lived_together', 'yes', @$step->detail['lived_together'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input livedTogether'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <span class="lived_together"></span>                        
                    </div>
                </div>
                <div class="livedTogetherSec" style="display:{{ @$step->detail['lived_together'] == 'yes' ? 'block' : 'none' }};">
                    <h4>List the address where you lived together.</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('street', 'Street') }}
                                <span class="required">*</span>
                                {{ Form::text('street', @$step->detail['street'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Street'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('apartment_suite_or_floor', 'Apartment, Suite or Floor?') }}
                                <span class="required">*</span>
                                {{ Form::select('apartment_suite_or_floor', [
                                    '' => 'Select', 
                                    'Apartment' => 'Apartment',
                                    'Suite' => 'Suite',
                                    'Floor' => 'Floor',
                                    'Dose Not Apply' => 'Dose Not Apply'
                                ], @$step->detail['apartment_suite_or_floor'], [
                                    'class' => 'form-control'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('apartment', 'Apartment') }}
                                <span class="required">*</span>
                                {{ Form::text('apartment', @$step->detail['apartment'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Apartment'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('city', 'City') }}
                                <span class="required">*</span>
                                {{ Form::text('city', @$step->detail['city'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter City'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('country', "Country ") }}
                                <span class="required">*</span>
                                {{ Form::select('country', getAllCountry(), @$step->detail['country'], [
                                    'class' => 'form-control countryId'
                                ]) }}                       
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('state', "U.S. State (Select Does Not Apply if not USA)") }}
                                <span class="required">*</span>
                                {{ Form::select('state', [], @$step->detail['state'], [
                                    'class' => 'form-control states'
                                ]) }}                        
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('province', 'Province') }}
                                <span class="required">*</span>
                                {{ Form::text('province', @$step->detail['province'], [
                                    'class' => 'form-control province',
                                    'placeholder' => 'Enter Province'
                                ]) }}
                                {{ Form::label('does_not_apply', "Does Not Apply") }}
                                {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                    'class' => 'custom-control-input doesNotApply',
                                    'data-field' => "province"
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('postal_code', 'Postal Code') }}
                                <span class="required">*</span>
                                {{ Form::text('postal_code', @$step->detail['postal_code'], [
                                    'class' => 'form-control postalCode',
                                    'placeholder' => 'Enter Postal Code'
                                ]) }}
                                {{ Form::label('does_not_apply', "Does Not Apply") }}
                                {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                    'class' => 'custom-control-input doesNotApply',
                                    'data-field' => "postalCode"
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('start_date', 'Date From (mm/dd/yyyy) ') }}
                                <span class="required">*</span>
                                {{ Form::text('start_date', @$step->detail['start_date'], [
                                    'class' => 'form-control datePicker',
                                    'placeholder' => 'Enter Date'
                                ]) }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('end_date', 'Date To (mm/dd/yyyy) ') }}
                                <span class="required">*</span>
                                {{ Form::text('end_date', @$step->detail['end_date'], [
                                    'class' => 'form-control datePicker',
                                    'placeholder' => 'Enter Date'
                                ]) }}
                            </div>
                        </div>
                    </div>
                </div>      
            </div>            
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'relationship') !!}
        {!! Form::hidden('next', 'employment') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'address'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'employment'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseRelationshipBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">        
        $(document).on('change', '.livedTogether', function(){
            if ($(this).val() == 'yes') {
                $('.livedTogetherSec').show();
            } else {
                $('.livedTogetherSec').hide();
            }
        })

        $(document).ready(function(){
            // getState($('.countryId').val());
            getState(231);
        });

        $(document).on('change', '.countryId', function(){
            var countryId = $(this).val();            
        });

        function getState(countryId)
        {
            $.ajax({                
                type: 'get',
                url: "{{ route('getState') }}",
                data: {
                    countryId: countryId
                },
                success: function(data) {
                    if (countryId == 231) {
                        $('.states').html(data); 
                    } else {
                        $('.states').html('<option>- Does Not Apply</option>');
                    }                                       
                }
            });
        }

        $("#spouseRelationship").validate({
            rules: {
                wedding_date: {
                    required: true,
                },
                wedding_city: {
                    required: true,
                },
                wedding_state: {
                    required: true,
                },
                wedding_country: {
                    required: true,
                },
                lived_together: {
                    required: true,
                },
                street: {
                    required: true,
                },
                apartment_suite_or_floor: {
                    required: true,
                },
                apartment: {
                    required: true,
                },
                city: {
                    required: true,
                },
                country: {
                    required: true,
                },
                state: {
                    required: true,
                },
                province: {
                    required: true,
                },
                postal_code: {
                    required: true,
                },
                start_date: {
                    required: true,
                },
                end_date: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "lived_together") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }               
            },
            messages: {
               wedding_date: "Please enter date!",                                
               wedding_city: "Please enter city!",                                
               wedding_state: "Please enter state!",                                
               wedding_country: "Please enter country!",                             
               lived_together: "Please choose option!",                             
               street: "Please enter street!",                             
               apartment_suite_or_floor: "Please enter address!",                             
               apartment: "Please enter apartment!",                             
               city: "Please enter city!",                             
               country: "Please enter country!",                             
               state: "Please enter state!",                             
               province: "Please enter province!",                             
               postal_code: "Please enter postal code!",                             
               start_date: "Please enter date!",                             
               end_date: "Please enter date!",                             
            },
            submitHandler: function(form) {
    $('#spouseRelationshipBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>')
        .prop('disabled', true);
    
    $.ajax({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        url: "{{ route('spouseRelationship') }}",
        data: $(form).serialize(),
        dataType: 'json',
        success: function(data) {               
            if (data.status) {                                           
                $('.relationship').removeClass('active');
                toastr.success('Relationship information saved successfully');
                
                // Optionally redirect to progress page
                setTimeout(function() {
                    window.location.href = "{{ route('user.page', 'progress') }}";
                }, 2000);
            } else {
                toastr.error(data.message || 'Failed to save information');                           
            }
        },
        error: function(xhr) {
            var errors = xhr.responseJSON?.errors;
            if (errors) {
                $.each(errors, function(field, messages) {
                    toastr.error(messages[0]);
                });
            } else {
                toastr.error(xhr.responseJSON?.message || 'An error occurred. Please try again.');
            }
        },
        complete: function() {
            $('#spouseRelationshipBtn').html('Save & Continue')
                .prop('disabled', false);
        }
    });
    return false;
}
        });       
    </script>
</div>