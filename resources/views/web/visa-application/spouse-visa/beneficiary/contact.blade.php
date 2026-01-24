<!-- resources/views/web/visa-application/spouse-visa/beneficiary/contact.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('spouseBeneficiaryContact'), 'id' => 'spouseBeneficiaryContact']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>Beneficiary's Contact Information</h2>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    	{{ Form::label('email', "Email Address") }}
                        <span class="required">*</span>
    					{{ Form::text('email', @$step->detail['email'], ['class' => 'form-control', 'placeholder' => 'Enter Email address']) }}        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label('country_code', 'Phone Country Code') }}
                        <span class="required">*</span>
    					{{ Form::select('country_code', getCountryPhoneCode(), @$step->detail['country_code'], ['class' => 'form-control',]) }}                          
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    	{{ Form::label('telephone_number', 'Telephone Number') }}
                        <span class="required">*</span>
    					{{ Form::text('telephone_number', @$step->detail['telephone_number'], ['class' => 'form-control', 'placeholder' => 'Enter Telephone number']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('mob_no_country', 'Mobile Country Code') }}
                        <span class="required">*</span>
                        {{ Form::select('mob_no_country', getCountryPhoneCode(), @$step->detail['mob_no_country'], ['class' => 'form-control',]) }}                          
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('mob_telephone_number', 'Mobile Telephone Number') }}
                        <span class="required">*</span>
                        {{ Form::text('mob_telephone_number', @$step->detail['mob_telephone_number'], ['class' => 'form-control', 'placeholder' => 'Enter Mobile number']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                    	{{ Form::label("reg_no", "Alien Registration Number (if applicable)") }}
                        <span class="required">*</span>
    					{{ Form::text("reg_no", @$step->detail['reg_no'], ['class' => 'form-control regNo', 'placeholder' => "Enter Registration number"]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('reg_no_na', true, @$step->detail['reg_no_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => 'regNo',
                                'id' => 'reg_no_na'
                            ]) }}
                            {{ Form::label('reg_no_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("tax_id", "U.S. Tax ID (if applicable)") }}
                        <span class="required">*</span>
                        {{ Form::text("tax_id", @$step->detail['tax_id'], ['class' => 'form-control taxId', 'placeholder' => "Enter Tax ID"]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('tax_id_na', true, @$step->detail['tax_id_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => 'taxId',
                                'id' => 'tax_id_na'
                            ]) }}
                            {{ Form::label('tax_id_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("social_sec_no", "U.S. Social Security Number (if applicable)") }}
                        <span class="required">*</span>
                        {{ Form::text("social_sec_no", @$step->detail['social_sec_no'], ['class' => 'form-control socialSecNo', 'placeholder' => "Enter Social Security Number"]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('social_sec_no_na', true, @$step->detail['social_sec_no_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => 'socialSecNo',
                                'id' => 'social_sec_no_na'
                            ]) }}
                            {{ Form::label('social_sec_no_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("uscis_no", "USCIS Online Account Number (if applicable)") }}
                        <span class="required">*</span>
                        {{ Form::text("uscis_no", @$step->detail['uscis_no'], ['class' => 'form-control uscisNo', 'placeholder' => "Enter USCIS number"]) }}
                        <div class="form-check mt-2">
                            {{ Form::checkbox('uscis_no_na', true, @$step->detail['uscis_no_na'] == true, [
                                'class' => 'form-check-input doesNotApply',
                                'data-field' => 'uscisNo',
                                'id' => 'uscis_no_na'
                            ]) }}
                            {{ Form::label('uscis_no_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Is the mailing address different from the physical address?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('diffrent_mailing_address', 'no', @$step->detail['diffrent_mailing_address'] == 'no', [
                                    'class' => 'custom-control-input diffrentMailingAddress'
                                ]) }}
                            	<span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('diffrent_mailing_address', 'yes', @$step->detail['diffrent_mailing_address'] == 'yes', [
                                    'class' => 'custom-control-input diffrentMailingAddress'
                                ]) }}
                            	<span class="custom-control-label"></span> Yes
                            </label>
                            <div class="diffrent_mailing_address"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 diffrentMailingAddressSec" style="display: {{ @$step->detail['diffrent_mailing_address'] == 'yes' ? 'block' : 'none'  }};">
                    <h5>Mailing Address (if different from physical address)</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('in_care_name', 'In Care Of Name') }}
                                <span class="required">*</span>
                                {{ Form::text("in_care_name", @$step->detail['in_care_name'], [
                                    'class' => 'form-control inCareName',
                                    'placeholder' => 'Enter name'
                                ]) }}
                                <div class="form-check mt-2">
                                    {{ Form::checkbox('in_care_name_na', true, @$step->detail['in_care_name_na'] == true, [
                                        'class' => 'form-check-input doesNotApply',
                                        'data-field' => 'inCareName',
                                        'id' => 'in_care_name_na'
                                    ]) }}
                                    {{ Form::label('in_care_name_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                                </div>
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('apartment_suite_or_floor', 'Apartment, Suite or Floor?') }}
                                <span class="required">*</span>
                                {{ Form::select("apartment_suite_or_floor", [
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
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('number_and_street', 'Number and street. Example: 123 Main Street') }}
                                <span class="required">*</span>
                                {{ Form::text("number_and_street", @$step->detail['number_and_street'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter address'
                                ]) }}                                        
                            </div>                            
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('apartment_suite_or_floor_no', 'Apartment, Suite or Floor Number. Example: 43 or 532-B. Do not add "Apt" or "#".') }}
                                <span class="required">*</span>
                                {{ Form::text("apartment_suite_or_floor_no", @$step->detail['apartment_suite_or_floor_no'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter number'
                                ]) }}                                        
                            </div>                            
                        </div>                   
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('town_or_city', 'Town or City') }}
                                <span class="required">*</span>
                                {{ Form::text("town_or_city", @$step->detail['town_or_city'], [
                                    'class' => 'form-control',
                                    'placeholder' => 'Enter Town or City'
                                ]) }}
                            </div>                            
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('country', "Country") }}
                                <span class="required">*</span>
                                {{ Form::select("country", getAllCountry(), @$step->detail['country'], [
                                    'class' => 'form-control countryId'
                                ]) }}                       
                            </div>                           
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('state', "U.S. State") }}
                                <span class="required">*</span>
                                {{ Form::select("state", [], @$step->detail['state'], [
                                    'class' => 'form-control states'
                                ]) }}                        
                            </div>                            
                        </div>               
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('province', 'Province') }}
                                <span class="required">*</span>
                                {{ Form::text("province", @$step->detail['province'], [
                                    'class' => 'form-control province',
                                    'placeholder' => 'Enter Province'
                                ]) }}
                                <div class="form-check mt-2">
                                    {{ Form::checkbox('province_na', true, @$step->detail['province_na'] == true, [
                                        'class' => 'form-check-input doesNotApply',
                                        'data-field' => 'province',
                                        'id' => 'province_na'
                                    ]) }}
                                    {{ Form::label('province_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                                </div>
                            </div>                            
                        </div>               
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('postal_code', 'Postal Code') }}
                                <span class="required">*</span>
                                {{ Form::text("postal_code", @$step->detail['postal_code'], [
                                    'class' => 'form-control postalCode',
                                    'placeholder' => 'Enter Postal Code'
                                ]) }}
                                <div class="form-check mt-2">
                                    {{ Form::checkbox('postal_code_na', true, @$step->detail['postal_code_na'] == true, [
                                        'class' => 'form-check-input doesNotApply',
                                        'data-field' => 'postalCode',
                                        'id' => 'postal_code_na'
                                    ]) }}
                                    {{ Form::label('postal_code_na', "Does Not Apply", ['class' => 'form-check-label']) }}
                                </div>
                            </div>                            
                        </div>               
                    </div>
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('section', 'beneficiary') !!}
        {!! Form::hidden('name', 'contact') !!}
        {!! Form::hidden('next', 'place-of-birth') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey spousePreviousOrContinue',
            'data-form' => 'name',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 spousePreviousOrContinue',
            'data-form' => 'place-of-birth',
            'data-section' => 'beneficiary'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'spouseBeneficiaryContactBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

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

        $(document).on('change', '.diffrentMailingAddress', function(){
            if ($(this).val() == 'yes') {
                $('.diffrentMailingAddressSec').show();
            } else {
                $('.diffrentMailingAddressSec').hide();
            }
        });

        $(document).ready(function(){
            getState(231);
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

        $("#spouseBeneficiaryContact").validate({
            rules: {
                email: { required: true, email: true },
                country_code: { required: true },
                telephone_number: { required: true },
                mob_no_country: { required: true },
                mob_telephone_number: { required: true },
                reg_no: { 
                    required: function() {
                        return !$('#reg_no_na').is(':checked');
                    }
                },
                tax_id: { 
                    required: function() {
                        return !$('#tax_id_na').is(':checked');
                    }
                },
                social_sec_no: { 
                    required: function() {
                        return !$('#social_sec_no_na').is(':checked');
                    }
                },
                uscis_no: { 
                    required: function() {
                        return !$('#uscis_no_na').is(':checked');
                    }
                },
                diffrent_mailing_address: { required: true },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "diffrent_mailing_address") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               email: "Please enter a valid email address",
               country_code: "Please select country code",
               telephone_number: "Please enter telephone number",
               mob_no_country: "Please select mobile country code",
               mob_telephone_number: "Please enter mobile number",
               reg_no: "Please enter registration number or check 'Does Not Apply'",
               tax_id: "Please enter tax ID or check 'Does Not Apply'",
               social_sec_no: "Please enter social security number or check 'Does Not Apply'",
               uscis_no: "Please enter USCIS number or check 'Does Not Apply'",
               diffrent_mailing_address: "Please select an option",
            },
            submitHandler: function(form) {
    $('#spouseBeneficiaryContactBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>')
        .prop('disabled', true);
    
    $.ajax({
        headers: {
            'X-CSRF-Token': $('input[name="_token"]').val()
        },
        type: 'post',
        url: "{{ route('spouseBeneficiaryContact') }}",
        data: $(form).serialize(),
        dataType: 'json',
        success: function(data) {               
            if (data.status) {                                           
                $('.beneficiary-contact').removeClass('active');
                $('.beneficiary-address').addClass('active');
                $('.spouseVisaForm').html(data.data);
                $('html, body').animate({
                    scrollTop: $('.spouseVisaForm').offset().top - 100
                }, 300);
                toastr.success('Contact information saved successfully');
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
            $('#spouseBeneficiaryContactBtn').html('Save & Continue')
                .prop('disabled', false);
        }
    });
    return false;
}
        });
    </script>                    
</div>