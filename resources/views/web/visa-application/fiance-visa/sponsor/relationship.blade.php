<div class="step-wizard">
    {{ Form::open(['url' => route('fianceSponsorRelationship'), 'id' => 'fianceSponsorRelationship']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>Relationship</h2>                        
                    </div>
                </div>                                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>You must have met your fiance(e) in person during the two years immediately before filing this petition.</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('responsibility', 'no', @$step->detail['responsibility'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input responsibility'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('responsibility', 'yes', @$step->detail['responsibility'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input responsibility'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <span class="responsibility"></span>                        
                    </div>
                </div>
                <div class="col-md-12 responsibilityText1Sec" style="display: {{ @$step->detail['responsibility'] == 'no' ? 'block' : 'none' }};">
                    <div class="form-group">
                        {{ Form::label('res_text_1', 'If you have not yet met your fiancee in person but will meet them soon, then answer yes to this question
                        and write your story, including your travel and return dates as if it has already happened.') }}
                        {{ Form::label('res_text_1', 'If you need to apply for a waiver of the meeting requirement because your medical condition is so serious
                        that it prevents you from flying, then please contact our Customer Success team for more information.') }}
                            {{-- <span class="required">*</span> --}}
                        {{-- {{ Form::textarea('res_text_1', @$step->detail['res_text_1'], ['class' => 'form-control', 'rows' => 4]) }} --}}
                    </div>
                </div>
                <div class="col-md-12 responsibilityText2Sec" style="display: {{ @$step->detail['responsibility'] == 'yes' ? 'block' : 'none' }};">
                    <div class="form-group">
                        <h4>In the box below, describe how you met</h4>
                        {{-- {{ Form::label('res_text_2', 'This story should be written by the U.S. citizen. Submit information regarding the circumstances under which you met to establish the relationship including when, where, and how you met to establish your relationship. If you met through a website online, provide any specific details about this website. If you met through an online website, you must submit a copy of the signed written consent form that the International Marriage Broker obtained from the alien authorizing the release of her/his personal contact information to you, or documentation to establish that the website is not an International Marriage Broker. You must also indicate the city and state where you will get married (Example: We plan to get married in Austin, Texas). It is okay if your plans change later and you get married in a different city or state.') }}
                            <span class="required">*</span> --}}
                        {{ Form::textarea('res_text_2', @$step->detail['res_text_2'], ['class' => 'form-control', 'rows' => 15, 'style' => 'background-color: #DDE4FF !important; color: #000000;']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">                        
                        <label>Were you introduced to your partner by an international marriage broker (IMB)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('marriage_broker', 'no', @$step->detail['marriage_broker'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input marriageBroker'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('marriage_broker', 'yes', @$step->detail['marriage_broker'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input marriageBroker'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                        </div>
                        <span class="marriage_broker"></span>                        
                    </div>
                </div>
                <div class="marriageBrokerSec" style="display: {{ @$step->detail['marriage_broker'] == 'yes' ? 'block' : 'none' }};"> 
                    <p>Provide the IMB's contact information and Website information below. In addition, attach a copy of the signed, written consent form the IMB obtained from your beneficiary authorizing your beneficiary's personal contact information to be released to you.</p>                   
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('number_and_street', 'Number and street.  Example: 123 Main Street') }}
                            <span class="required">*</span>
                            {{ Form::text('number_and_street', @$step->detail['number_and_street'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter number and street'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('apartment_suite_or_floor_no', 'Apartment number.  Example: 43 or 532-B.  Do not add "Apt" or "#"') }}
                            <span class="required">*</span>
                            {{ Form::text('apartment_suite_or_floor_no', @$step->detail['apartment_suite_or_floor_no'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Apartment, Suite or Floor Number'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('town_or_city', 'Town or City') }}
                            <span class="required">*</span>
                            {{ Form::text('town_or_city', @$step->detail['town_or_city'], [
                                'class' => 'form-control',
                                'placeholder' => 'Enter Town or City'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('country', "Country") }}
                            <span class="required">*</span>
                            {{ Form::select('country', getAllCountryForSponsor(), @$step->detail['country'], [
                                'class' => 'form-control countryId'
                            ]) }}                       
                        </div>
                    </div>                    
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('province', 'Province') }}
                            <span class="required">*</span>
                            {{ Form::text('province', @$step->detail['provinceOptional'] ? 'N/A' : @$step->detail['province'], [
                                'class' => 'form-control provinceOptional',
                                'placeholder' => 'Enter Province'
                            ]) }}
                            @include('web.component.does-not-apply', ['field' => 'provinceOptional', 'value' => @$step->detail['provinceOptional']])                            
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('postal_code', 'Postal Code') }}
                            <span class="required">*</span>
                            {{ Form::text('postal_code', @$step->detail['postalCode'] ? 'N/A' : @$step->detail['postal_code'], [
                                'class' => 'form-control postalCode',
                                'placeholder' => 'Enter Postal Code'
                            ]) }}
                            @include('web.component.does-not-apply', ['field' => 'postalCode', 'value' => @$step->detail['postalCode']])                            
                        </div>
                    </div>                    
                </div>
                {{-- <div class="col-md-12">
                    <div class="form-group">
                        <label class="custom-control mb-0 ">
                            {{ Form::checkbox('i_understand', 'no', @$step->detail['i_understand'] == 'no' ? true : '', [
                                'class' => 'custom-control-input'
                            ]) }}
                            <span class="custom-control-label"></span>  I understand that the USCIS must receive my petition in the mail before the expiration date of the two (2) year meeting requirement as described above and that if I elect to have RapidVisa review my petition in their office using their Premium Review service, it is my responsibility to get my petition and all supporting documents and evidence to RapidVisa through uploads or by mail no later than 60 days before the expiration date of the two (2) year meeting requirement, and that RapidVisa will not be responsible for late filing of my petition if they receive my petition less than 60 days before the two (2) year meeting requirement expires, or if it is received by RapidVisa without all necessary supporting documents and evidence.
                        </label>
                        <div class="i_understand"></div>
                    </div>
                </div> --}}
            </div>            
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'relationship') !!}
        {!! Form::hidden('next', 'employment') !!}
        {!! Form::hidden('type', 'sponsor') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'address'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 sponsorPreviousOrContinue',
            'data-form' => 'employment'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceSponsorRelationshipBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('change', '.responsibility', function(){
            if ($(this).val() == 'no') {
                $('.responsibilityText1Sec').show();
                $('.responsibilityText2Sec').hide();
            } else {
                $('.responsibilityText1Sec').hide();
                $('.responsibilityText2Sec').show();
            }
        });

        $(document).on('change', '.marriageBroker', function(){
            if ($(this).val() == 'yes') {
                $('.marriageBrokerSec').show();
            } else {
                $('.marriageBrokerSec').hide();
            }
        });       

        $("#fianceSponsorRelationship").validate({
            rules: {                
                city_only: {
                    required: true,
                },
                last_time: {
                    required: true,
                },
                responsibility: {
                    required: true,
                },
                marriage_broker: {
                    required: true,
                },
                number_and_street: {
                    required: true,
                },             
                apartment_suite_or_floor_no: {
                    required: true,
                },
                town_or_city: {
                    required: true,
                },
                country: {
                    required: true,
                },                
                province: {
                    required: true,
                },
                postal_code: {
                    required: true,
                },
                res_text_1: {
                    required: true,
                },
                res_text_2: {
                    required: true,
                },
                i_understand: {
                    required: true,
                },
            },
             errorPlacement: function (error, element) {
                if (element.attr("name") == "responsibility" || element.attr("name") == "marriage_broker" || element.attr("name") == "i_understand") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               city_only: "Please enter city!",
               last_time: "Please enter date!",
               responsibility: "Please choose option!",
               marriage_broker: "Please choose option!",
               number_and_street: "Please enter number and street!",
               apartment_suite_or_floor_no: "Please enter address!",
               town_or_city: "Please enter town or city!",
               country: "Please choose birth country!",
               province: "Please enter province!",                             
               res_text_1: "Please enter text!",                             
               res_text_2: "Please enter text!",                             
               i_understand: "Please choose option!",                             
            },
            submitHandler: function(form) {
                $('#fianceSponsorRelationshipBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceSponsorRelationship') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activerelationship').removeClass('active');
                            $('.activeemployment').addClass('active');
                            $('.fianceSponsorForm').html(data.data);                    
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