<!-- resources\views\web\visa-application\fiance-visa\sponsor\military-and-convictions.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceSponsorMilitaryAndConvictions'), 'id' => 'fianceSponsorMilitaryAndConvictions']) }}
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
                            <div class="member_of_us"></div>
                        </div>
                    </div>
                </div>                
                <div class="col-md-12">
                    <h4>Court Convictions</h4>
                    <div class="form-group">
                        <label>Have you ever been subject to a temporary or permanent protection or restraining order (either civil or criminal)?</label>
                        <div class="radiogroup mb-4">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('protection', 'no', @$step->detail['protection'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('protection', 'yes', @$step->detail['protection'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                            <div class="protection"></div>
                        </div>
                        <p>Have you ever been arrested or convicted by a court of law (civil or criminal) or court martialed by a military tribunal for any of the following. Don't worry, most convictions will not disqualify you. </p>
                    </div>
                </div>      
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Domestic violence, sexual assault, child abuse and neglect, dating violence, elder abuse or stalking?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('violence', 'no', @$step->detail['violence'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input domesticViolence'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('violence', 'yes', @$step->detail['violence'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input domesticViolence'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                            <div class="violence"></div>
                        </div>                        
                    </div>
                </div>      
                <div class="col-md-12 domesticViolenceSec" style="display: {{ @$step->detail['violence'] == 'yes' ? 'block' : 'none' }};">
                    <div class="">
                        <label>If you were being battered or subjected to extreme cruelty by your spouse, parent, or adult child at the time of your conviction, check all of the following that apply to you:</label>
                        <div class="radiogroup mt-3">
                            <label class="custom-control mb-0 ">
                                {{ Form::checkbox('battered', 'self-defense', @$step->detail['battered'] == 'self-defense' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> I was acting in self-defense
                            </label> <br>
                            <label class="custom-control mb-0 ">
                                {{ Form::checkbox('battered', 'own-protection', @$step->detail['battered'] == 'own-protection' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> I violated a protection order issued for my own protection.
                            </label> <br>
                            <label class="custom-control mb-0 ">
                                {{ Form::checkbox('battered', 'extreme-cruelty', @$step->detail['battered'] == 'extreme-cruelty' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> I committed, was arrested for, was convicted of, or plead guilty to committing a crime that did not result in serious bodily injury, and there was a connection between the crime committed and my having been battered or subjected to extreme cruelty.
                            </label> 
                            <div class="battered"></div>                         
                        </div>                        
                    </div>
                </div>      
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <label>Homicide, murder, manslaughter, rape, abusive sexual contact, sexual exploitation, incest, torture, trafficking, peonage, holding hostage, involuntary servitude, slave trade, kidnapping, abduction, unlawful criminal restraint, false imprisonment or an attempt to commit any of these crimes?</label>
                        <div class="radiogroup mt-3">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('manslaughter', 'no', @$step->detail['manslaughter'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('manslaughter', 'yes', @$step->detail['manslaughter'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                            <div class="manslaughter"></div>
                        </div>                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Three or more arrests or convictions, not from a single act, for crimes relating to a controlled substance or alcohol?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('convictions', 'no', @$step->detail['convictions'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('convictions', 'yes', @$step->detail['convictions'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                            <div class="convictions"></div>
                        </div>                        
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been arrested, cited, charged, indicted, convicted, fined, or imprisoned for breaking or violating any law or ordinance in any country, excluding traffic violations (unless a traffic violation was alcohol- or drug-related or involved a fine of $500 or more)?</label>
                        <div class="radiogroup mt-2">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('drug_related', 'no', @$step->detail['drug_related'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input drugRelated'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('drug_related', 'yes', @$step->detail['drug_related'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input drugRelated'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                            <div class="drug_related"></div>
                        </div>                        
                    </div>
                </div>
                <div class="col-md-12 drugRelatedSec" style="display: {{ @$step->detail['drug_related'] == 'yes' ? 'block' : 'none' }};">
                    <div class="form-group">
                        {{ Form::label('provide_information', 'Provide information about each of those arrests, citations, charges, indictments, convictions, fines, or imprisonments in the space below. If you were the subject of an order of protection or restraining order and believe you are the victim, please explain those circumstances and provide any evidence to support your claims. Include the dates and outcomes.') }}
                            <span class="required">*</span>
                        {{ Form::textarea('provide_information', @$step->detail['provide_information'], ['class' => 'form-control', 'rows' => 4]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <p class="text-danger specifiedOffenseP" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who are convicted of any of the specified offense against a minor, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p>                        
                        <label>Have you ever been convicted by a court of law on any of the specified offense against a minor under Adam Walsh Act? The term ‘‘specified offense against a minor’’ means an offense against a minor that involves any of the following: <br>
                        <br> 
                        (A) An offense (unless committed by a parent or guardian) involving kidnapping.<br>
                        (B) An offense (unless committed by a parent or guardian) involving false imprisonment.<br>
                        (C) Solicitation to engage in sexual conduct.<br>
                        (D) Use in a sexual performance.<br>
                        (E) Solicitation to practice prostitution.<br>
                        (F) Video voyeurism as described in section 1801 of title 18, United States Code.<br>
                        (G) Possession, production, or distribution of child pornography.<br>
                        (H) Criminal sexual conduct involving a minor, or the use of the Internet to facilitate<br> or attempt such conduct.<br>
                        (I) Any conduct that by its nature is a sex offense against a minor.</label>
                        <div class="radiogroup mt-3">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('specified_offense', 'no', @$step->detail['specified_offense'] == 'no' ? true : '', [
                                    'class' => 'custom-control-input specifiedOffense'
                                ]) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('specified_offense', 'yes', @$step->detail['specified_offense'] == 'yes' ? true : '', [
                                    'class' => 'custom-control-input specifiedOffense'
                                ]) }}
                                <span class="custom-control-label"></span> Yes
                            </label>                          
                            <div class="specified_offense"></div>
                        </div>                        
                    </div>
                </div>      
                <div class="col-md-12 specifiedOffenseSec" style="display: {{ @$step->detail['specified_offense'] == 'yes' ? 'block' : 'none' }};">
                    <div class="form-group">
                        {{ Form::label('provide_information1', 'Provide information about each of those arrests, citations, charges, indictments, convictions, fines, or imprisonments in the space below. If you were the subject of an order of protection or restraining order and believe you are the victim, please explain those circumstances and provide any evidence to support your claims. Include the dates and outcomes. ') }}
                            <span class="required">*</span>
                        {{ Form::textarea('provide_information1', @$step->detail['provide_information1'], ['class' => 'form-control', 'rows' => 4]) }}
                    </div>
                </div>  
            </div>            
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'military-and-convictions') !!}
        {!! Form::hidden('next', 'address') !!}
        {!! Form::hidden('type', 'sponsor') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey sponsorPreviousOrContinue',
            'data-form' => 'other-filings'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 sponsorPreviousOrContinue',
            'data-form' => 'address'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceSponsorMilitaryAndConvictionsBtn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">
        $(document).on('change', '.drugRelated', function(){
            if ($(this).val() == 'yes') {
                $('.drugRelatedSec').show();
            } else {
                $('.drugRelatedSec').hide();
            }
        });

        $(document).on('change', '.domesticViolence', function(){
            if ($(this).val() == 'yes') {
                $('.domesticViolenceSec').show();
            } else {
                $('.domesticViolenceSec input[type="checkbox"]').attr('checked', false);
                $('.domesticViolenceSec').hide();
            }
        });    
        
        $(document).on('change', '.specifiedOffense', function(){
            if ($(this).val() == 'yes') {
                $('.specifiedOffenseSec').show();
                $('.specifiedOffenseP').show();
            } else {
                $('.specifiedOffenseSec').hide();
                $('.specifiedOffenseP').hide();
            }
        });     

        $("#fianceSponsorMilitaryAndConvictions").validate({
            rules: {
                member_of_us: {
                    required: true,
                },
                protection: {
                    required: true,
                },
                violence: {
                    required: true,
                },
                battered: {
                    required: true,
                },
                // battered2: {
                //     required: true,
                // },
                // battered3: {
                //     required: true,
                // },
                manslaughter: {
                    required: true,
                },
                convictions: {
                    required: true,
                },
                drug_related: {
                    required: true,
                },
                provide_information: {
                    required: true,
                },
                specified_offense: {
                    required: true,
                },
                provide_information1: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "protection" || element.attr("name") == "violence" || element.attr("name") == "battered" || element.attr("name") == "battered2" || element.attr("name") == "battered3" || element.attr("name") == "manslaughter" || element.attr("name") == "convictions" || element.attr("name") == "drug_related" || element.attr("name") == "specified_offense" || element.attr("name") == "member_of_us") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }               
            },
            messages: {
               member_of_us: "Please choose option!",                                        
               protection: "Please choose option!",                                        
               violence: "Please choose option!",                                        
               battered: "Please choose option!",                                        
            //    battered2: "Please choose option!",                                        
            //    battered3: "Please choose option!",                                        
               manslaughter: "Please choose option!",                                        
               convictions: "Please choose option!",                                        
               drug_related: "Please choose option!",                                        
               provide_information: "Please enter information!",                                        
               specified_offense: "Please choose option!",                                        
               provide_information1: "Please enter information!",                                        
            },
            submitHandler: function(form) {
                $('#fianceSponsorMilitaryAndConvictionsBtn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceSponsorMilitaryAndConvictions') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activemilitary-and-convictions').removeClass('active');
                            $('.activeaddress').addClass('active');
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