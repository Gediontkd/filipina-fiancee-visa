<!-- resources\views\web\visa-application\spouse-visa\beneficiary\address.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseBeneficiaryAddress'), 'id' => 'spouseBeneficiaryAddress']) }}
        <div class="form-card">
            <div class="row">                
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Beneficiary's Current Physical Address</h2>
                        <p>Enter the beneficiary's physical address. If the mailing address is different, you will enter that on another page.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('in_care_name', 'In Care Of Name') }}
                        <span class="required">*</span>
                        {{ Form::text('in_care_name', @$step->detail['in_care_name'], [
                            'class' => 'form-control inCareName',
                            'placeholder' => 'Enter Name'
                        ]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('in_care_name_na', true, @$step->detail['in_care_name_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "inCareName",
                                'id' => 'in_care_name_na'
                            ]) }}
                            {{ Form::label('in_care_name_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('number_and_street', 'Number and street') }}
                        <span class="required">*</span>
                        {{ Form::text('number_and_street', @$step->detail['number_and_street'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter number and street'
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
                            'Does Not Apply' => 'Does Not Apply'
                        ], @$step->detail['apartment_suite_or_floor'], [
                            'class' => 'form-control'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number') }}
                        <span class="required">*</span>
                        {{ Form::text('apartment_suite_or_floor_no', @$step->detail['apartment_suite_or_floor_no'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Apartment, Suite or Floor Number'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('town_or_city', 'Town or City') }}
                        <span class="required">*</span>
                        {{ Form::text('town_or_city', @$step->detail['town_or_city'], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter Town or City'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('country', "Country") }}
                        <span class="required">*</span>
                        {{ Form::select('country', getAllCountry(), @$step->detail['country'], [
                            'class' => 'form-control countryId'
                        ]) }}                       
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('state', "State/Province") }}
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
                        <div class="form-check mt-2">
                            {{ Form::checkbox('province_na', true, @$step->detail['province_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "province",
                                'id' => 'province_na'
                            ]) }}
                            {{ Form::label('province_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
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
                        <div class="form-check mt-2">
                            {{ Form::checkbox('postal_code_na', true, @$step->detail['postal_code_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => "postalCode",
                                'id' => 'postal_code_na'
                            ]) }}
                            {{ Form::label('postal_code_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('lived', 'Beneficiary has lived at this address since (mm/dd/yyyy)') }}
                        <span class="required">*</span>
                        {{ Form::text('lived', @$step->detail['lived'], [
                            'class' => 'form-control datePicker',
                            'placeholder' => 'Enter Date'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <h4>Provide all countries where the beneficiary has resided since their 18th birthday</h4>
                    <div class="appendCountry">
                        @if (empty($step->detail["country1"]))
                            @include('web.component.country', [
                                'index' => 1,
                                'sec' => '',
                                'data' => @$step->detail,
                            ])
                        @endif                   
                        @php
                            $i = '';
                        @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            @if (isset($step->detail["country$i"]))
                                @include('web.component.country', [
                                    'index' => $i,
                                    'sec' => '',
                                    'data' => @$step->detail,
                                ])                            
                            @endif
                        @endfor
                    </div>
                    <div class="mb-3">
                        <a class="btn btn-tra-grey addCountryBtn">+ Add Address</a>
                    </div>
                </div>         
            </div>            
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('section', 'beneficiary') !!}
        {!! Form::hidden('name', 'address') !!}
        {!! Form::hidden('next', 'place-of-birth') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'contact',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'place-of-birth',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseBeneficiaryAddressBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">        
        $(document).on('change', '.doesNotApply', function() {
            var fieldClass = $(this).data('field');
            var field = $('.' + fieldClass);
            
            if ($(this).is(':checked')) {
                field.val('N/A');
                field.prop('disabled', true);
                field.prop('readonly', true);
            } else {
                field.val('');
                field.prop('disabled', false);
                field.prop('readonly', false);
            }
        });

        $(document).ready(function() {
            $('.doesNotApply:checked').each(function() {
                var fieldClass = $(this).data('field');
                var field = $('.' + fieldClass);
                field.val('N/A');
                field.prop('disabled', true);
                field.prop('readonly', true);
            });
        });

        $(document).ready(function(){
            var countryCount = $('.appendCountry > .countryForm').length;
            if (countryCount == 10) {
                $('.addCountryBtn').addClass('d-none');
            }
        });

        $(document).ready(function(){
            getState($('.countryId').val());
        });

        $(document).on('change', '.countryId', function(){
            var countryId = $(this).val();
            getState(countryId);
        });

        function getState(countryId)
        {
            $.ajax({                
                type: 'get',
                url: "{{ route('spouseGetState') }}",
                data: {
                    countryId: countryId
                },
                success: function(data) {
                    $('.states').html(data);                    
                }
            });
        }

        $("#spouseBeneficiaryAddress").validate({
            rules: {
                in_care_name: { 
                    required: function() {
                        return !$('#in_care_name_na').is(':checked');
                    }
                },
                number_and_street: { required: true },
                apartment_suite_or_floor: { required: true },
                apartment_suite_or_floor_no: { required: true },
                town_or_city: { required: true },
                country: { required: true },
                state: { required: true },
                province: { 
                    required: function() {
                        return !$('#province_na').is(':checked');
                    }
                },
                postal_code: { 
                    required: function() {
                        return !$('#postal_code_na').is(':checked');
                    }
                },
                lived: { required: true },
            },            
            messages: {
               in_care_name: "Please enter name or check 'Does Not Apply'",                                        
               number_and_street: "Please enter address",                                        
               apartment_suite_or_floor: "Please select an option",                                        
               apartment_suite_or_floor_no: "Please enter number",                                
               town_or_city: "Please enter town or city",                                        
               country: "Please choose country",                                        
               state: "Please choose state/province",                                        
               province: "Please enter province or check 'Does Not Apply'",                                        
               postal_code: "Please enter postal code or check 'Does Not Apply'",                                        
               lived: "Please enter date",                                        
            },
            submitHandler: function(form) {
    $('#spouseBeneficiaryAddressBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>')
        .prop('disabled', true);
    
    $.ajax({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        url: "{{ route('spouseBeneficiaryAddress') }}",
        data: $(form).serialize(),
        dataType: 'json',
        success: function(data) {               
            if (data.status) {                                           
                $('.beneficiary-address').removeClass('active');
                $('.beneficiary-place-of-birth').addClass('active');
                $('.spouseVisaForm').html(data.data);
                $('html, body').animate({
                    scrollTop: $('.spouseVisaForm').offset().top - 100
                }, 300);
                toastr.success('Address information saved successfully');
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
            $('#spouseBeneficiaryAddressBtn').html('Save & Continue')
                .prop('disabled', false);
        }
    });
    return false;
}
        });

        function addAnotherCountry(index) {
            return '<div class="countryForm"><div class="pb-4"><a class="btn btn-tra-grey removeCountry">- Remove</a></div><div class="form-group"><select class="form-control countryId" name="country'+index+'"><option value="">-Select Country-</option>@foreach(getCountry() as $country)</option><option value="{{ $country->id }}">{{ $country->name }}</option>@endforeach</select></div></div>';
        }        
    </script>
</div>