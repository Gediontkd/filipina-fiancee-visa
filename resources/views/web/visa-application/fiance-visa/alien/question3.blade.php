<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienQuestion3'), 'id' => 'fianceAlienQuestion3']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>All questions are about the Alien (foreign citizen)</h2>
                        <p class="text-danger">WARNING! Do not write your answers in all capital leters and never use any type of non-English
                            characters. Please use proper capitalization.</p>
                    </div>
                </div>               
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger actsOfViolencePera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have received informal weapons or other paramilitary training, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you committed, ordered, incited, assisted, or otherwise participated in extra-judicial killings, political killings, or other acts of violence?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('acts_of_violence', 'no', @$step->detail['acts_of_violence'] == 'no' ? true : '', ['class' => 'custom-control-input actsOfViolence']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('acts_of_violence', 'yes', @$step->detail['acts_of_violence'] == 'yes' ? true : '', ['class' => 'custom-control-input actsOfViolence']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="acts_of_violence"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 actsOfViolenceSec" style="display: {{ @$step->detail['acts_of_violence'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_acts_of_violence', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_acts_of_violence', @$step->detail['explain_acts_of_violence'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger childSoldierPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have a communicable disease of public health significance or any other medical condition, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever engaged in the recruitment or the use of child soldiers?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('child_soldier', 'no', @$step->detail['child_soldier'] == 'no' ? true : '', ['class' => 'custom-control-input childSoldier']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('child_soldier', 'yes', @$step->detail['child_soldier'] == 'yes' ? true : '', ['class' => 'custom-control-input childSoldier']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="child_soldier"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 childSoldierSec" style="display: {{ @$step->detail['child_soldier'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_child_soldier', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_child_soldier', @$step->detail['explain_child_soldier'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>                
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger religiousFreedomPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have a communicable disease of public health significance or any other medical condition, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you, while serving as a government official, been responsible for or directly carried out, at any time, particularly severe violations of religious freedom?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('religious_freedom', 'no', @$step->detail['religious_freedom'] == 'no' ? true : '', ['class' => 'custom-control-input religiousFreedom']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('religious_freedom', 'yes', @$step->detail['religious_freedom'] == 'yes' ? true : '', ['class' => 'custom-control-input religiousFreedom']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="religious_freedom"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 religiousFreedomSec" style="display: {{ @$step->detail['religious_freedom'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_religious_freedom', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_religious_freedom', @$step->detail['explain_religious_freedom'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger memberOfAffiliatedPera" style="display: none;">The U.S government requires the beneficiary and each derivative applicant (if any) applying for a visa to get the medical examination with an authorized civil surgeon in the country where the beneficiary will be interviewed, to establish that they are not inadmissible to the United States on public heath grounds. Please note that applying for a Waiver may delay processing of your case and that Boundless|RapidVisa does not assist with preparing and filing such waivers.</p> --}}
                        <label>Are you a member of or affiliated with the Communist or other totalitarian party?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('member_of_affiliated', 'no', @$step->detail['member_of_affiliated'] == 'no' ? true : '', ['class' => 'custom-control-input memberOfAffiliated']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('member_of_affiliated', 'yes', @$step->detail['member_of_affiliated'] == 'yes' ? true : '', ['class' => 'custom-control-input memberOfAffiliated']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="member_of_affiliated"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 memberOfAffiliatedSec" style="display: {{ @$step->detail['member_of_affiliated'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_member_of_affiliated', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_member_of_affiliated', @$step->detail['explain_member_of_affiliated'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger colombiaGroupPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever directly or indirectly assisted or supported any of the groups in Colombia known as the Revolutionary Armed Forces of Colombia (FARC), National Liberation Army (ELN), or United Self-Defense Forces of Colombia (AUC)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('colombia_group', 'no', @$step->detail['colombia_group'] == 'no' ? true : '', ['class' => 'custom-control-input colombiaGroup']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('colombia_group', 'yes', @$step->detail['colombia_group'] == 'yes' ? true : '', ['class' => 'custom-control-input colombiaGroup']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="colombia_group"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 colombiaGroupSec" style="display: {{ @$step->detail['colombia_group'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_colombia_group', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_colombia_group', @$step->detail['explain_colombia_group'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger governmentalAbusePera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever through abuse of governmental or political position converted for personal gain, confiscated or expropriated property in a foreign nation to which a United States national had claim of ownership?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('governmental_abuse', 'no', @$step->detail['governmental_abuse'] == 'no' ? true : '', ['class' => 'custom-control-input governmentalAbuse']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('governmental_abuse', 'yes', @$step->detail['governmental_abuse'] == 'yes' ? true : '', ['class' => 'custom-control-input governmentalAbuse']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="governmental_abuse"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 governmentalAbuseSec" style="display: {{ @$step->detail['governmental_abuse'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_governmental_abuse', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_governmental_abuse', @$step->detail['explain_governmental_abuse'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger expropriatedPropertyPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you the spouse, minor child, or agent of an individual who has through abuse of governmental or political position converted for personal gain, confiscated, or expropriated property in a foreign nation to which a United States national had claim of ownership?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('expropriated_property', 'no', @$step->detail['expropriated_property'] == 'no' ? true : '', ['class' => 'custom-control-input expropriatedProperty']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('expropriated_property', 'yes', @$step->detail['expropriated_property'] == 'yes' ? true : '', ['class' => 'custom-control-input expropriatedProperty']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="expropriated_property"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 expropriatedPropertySec" style="display: {{ @$step->detail['expropriated_property'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_expropriated_property', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_expropriated_property', @$step->detail['explain_expropriated_property'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger chemicalWeaponsPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever disclosed or trafficked in confidential U.S. business information obtained in connection with U.S. participation in the Chemical Weapons Convention?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('chemical_weapon', 'no', @$step->detail['chemical_weapon'] == 'no' ? true : '', ['class' => 'custom-control-input chemicalWeapons']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('chemical_weapon', 'yes', @$step->detail['chemical_weapon'] == 'yes' ? true : '', ['class' => 'custom-control-input chemicalWeapons']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="chemical_weapon"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 chemicalWeaponsSec" style="display: {{ @$step->detail['chemical_weapon'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('cxplain_Chemical_weapon', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('cxplain_Chemical_weapon', @$step->detail['cxplain_Chemical_weapon'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger traffickedConfidentialPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you the spouse, minor child, or agent of an individual who has disclosed or trafficked in confidential U.S. business information obtained in connection with U.S. participation in the Chemical Weapons Convention?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('trafficked_confidential', 'no', @$step->detail['trafficked_confidential'] == 'no' ? true : '', ['class' => 'custom-control-input traffickedConfidential']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('trafficked_confidential', 'yes', @$step->detail['trafficked_confidential'] == 'yes' ? true : '', ['class' => 'custom-control-input traffickedConfidential']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="trafficked_confidential"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 traffickedConfidentialSec" style="display: {{ @$step->detail['trafficked_confidential'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_trafficked_confidential', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_trafficked_confidential', @$step->detail['explain_trafficked_confidential'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger establishmentPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever been directly involved in the establishment or enforcement of population controls forcing a woman to undergo an abortion against her free choice or a man or a woman to undergo sterilization against his or her free will?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('establishment', 'no', @$step->detail['establishment'] == 'no' ? true : '', ['class' => 'custom-control-input establishment']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('establishment', 'yes', @$step->detail['establishment'] == 'yes' ? true : '', ['class' => 'custom-control-input establishment']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="establishment"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 establishmentSec mb-4" style="display: {{ @$step->detail['establishment'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_establishment', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_establishment', @$step->detail['explain_establishment'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'question3') !!}
        {!! Form::hidden('next', 'question4') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'question2'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'question4'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienQuestion3Btn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $(document).on('click', '.actsOfViolence', function(){
            if ($(this).val() == 'yes') {
                $('.actsOfViolenceSec').show();
                $('.actsOfViolencePera').show();
            } else {
                $('.actsOfViolenceSec').hide();
                $('.actsOfViolenceSec > textarea').val('');
                $('.actsOfViolencePera').hide();
            }
        });

        $(document).on('click', '.childSoldier', function(){
            if ($(this).val() == 'yes') {
                $('.childSoldierSec').show();
                $('.childSoldierPera').show();
            } else {
                $('.childSoldierSec').hide();
                $('.childSoldierSec > textarea').val('');
                $('.childSoldierPera').hide();
            }
        });

        $(document).on('click', '.significantRole', function(){
            if ($(this).val() == 'yes') {
                $('.significantRoleSec').show();
                $('.significantRolePera').show();
            } else {
                $('.significantRoleSec').hide();
                $('.significantRoleSec > textarea').val('');
                $('.significantRolePera').hide();
            }
        });

        $(document).on('click', '.religiousFreedom', function(){
            if ($(this).val() == 'yes') {
                $('.religiousFreedomSec').show();
                $('.religiousFreedomPera').show();
            } else {
                $('.religiousFreedomSec').hide();
                $('.religiousFreedomSec > textarea').val('');
                $('.religiousFreedomPera').hide();
            }
        });

        $(document).on('click', '.memberOfAffiliated', function(){
            if ($(this).val() == 'yes') {
                $('.memberOfAffiliatedSec').show();
                $('.memberOfAffiliatedPera').show();
            } else {
                $('.memberOfAffiliatedSec').hide();
                $('.memberOfAffiliatedSec > textarea').val('');
                $('.memberOfAffiliatedPera').hide();
            }
        });

        $(document).on('click', '.colombiaGroup', function(){
            if ($(this).val() == 'yes') {
                $('.colombiaGroupSec').show();
                $('.colombiaGroupPera').show();
            } else {
                $('.colombiaGroupSec').hide();
                $('.colombiaGroupSec > textarea').val('');
                $('.colombiaGroupPera').hide();
            }
        });

        $(document).on('click', '.governmentalAbuse', function(){
            if ($(this).val() == 'yes') {
                $('.governmentalAbuseSec').show();
                $('.governmentalAbusePera').show();
            } else {
                $('.governmentalAbuseSec').hide();
                $('.governmentalAbuseSec > textarea').val('');
                $('.governmentalAbusePera').hide();
            }
        });

        $(document).on('click', '.expropriatedProperty', function(){
            if ($(this).val() == 'yes') {
                $('.expropriatedPropertySec').show();
                $('.expropriatedPropertyPera').show();
            } else {
                $('.expropriatedPropertySec').hide();
                $('.expropriatedPropertySec > textarea').val('');
                $('.expropriatedPropertyPera').hide();
            }
        });

        $(document).on('click', '.chemicalWeapons', function(){
            if ($(this).val() == 'yes') {
                $('.chemicalWeaponsSec').show();
                $('.chemicalWeaponsPera').show();
            } else {
                $('.chemicalWeaponsSec').hide();
                $('.chemicalWeaponsSec > textarea').val('');
                $('.chemicalWeaponsPera').hide();
            }
        });

        $(document).on('click', '.traffickedConfidential', function(){
            if ($(this).val() == 'yes') {
                $('.traffickedConfidentialSec').show();
                $('.traffickedConfidentialPera').show();
            } else {
                $('.traffickedConfidentialSec').hide();
                $('.traffickedConfidentialSec > textarea').val('');
                $('.traffickedConfidentialPera').hide();
            }
        });

        $(document).on('click', '.establishment', function(){
            if ($(this).val() == 'yes') {
                $('.establishmentSec').show();
                $('.establishmentPera').show();
            } else {
                $('.establishmentSec').hide();
                $('.establishmentSec > textarea').val('');
                $('.establishmentPera').hide();
            }
        });

        $("#fianceAlienQuestion3").validate({
            rules: {
                acts_of_violence: {
                    required: true,
                },
                explain_acts_of_violence: {
                    required: true,
                },
                child_soldier: {
                    required: true,
                },
                explain_child_soldier: {
                    required: true,
                },
                religious_freedom: {
                    required: true,
                },
                explain_religious_freedom: {
                    required: true,
                },
                member_of_affiliated: {
                    required: true,
                },
                explain_member_of_affiliated: {
                    required: true,
                },
                colombia_group: {
                    required: true,
                },
                explain_colombia_group: {
                    required: true,
                },
                governmental_abuse: {
                    required: true,
                },
                explain_governmental_abuse: {
                    required: true,
                },
                expropriated_property: {
                    required: true,
                },
                explain_expropriated_property: {
                    required: true,
                },
                chemical_weapon: {
                    required: true,
                },
                cxplain_Chemical_weapon: {
                    required: true,
                },
                trafficked_confidential: {
                    required: true,
                },
                explain_trafficked_confidential: {
                    required: true,
                },
                establishment: {
                    required: true,
                },
                explain_establishment: {
                    required: true,
                },
            },
            messages: {
               acts_of_violence: "Please choose option!",
               explain_acts_of_violence: "Please explain!",
               child_soldier: "Please choose option!",
               explain_child_soldier: "Please explain!",
               significant_role: "Please choose option!",
               explain_significant_role: "Please explain!",
               religious_freedom: "Please choose option!",
               explain_religious_freedom: "Please explain!",
               member_of_affiliated: "Please choose option!",
               explain_member_of_affiliated: "Please explain!",
               colombia_group: "Please choose option!",
               explain_colombia_group: "Please explain!",
               governmental_abuse: "Please choose option!",
               explain_governmental_abuse: "Please explain!",
               expropriated_property: "Please choose option!",
               explain_expropriated_property: "Please explain!",
               chemical_weapon: "Please choose option!",
               cxplain_Chemical_weapon: "Please explain!",
               trafficked_confidential: "Please choose option!",
               explain_trafficked_confidential: "Please explain!",
               establishment: "Please choose option!",
               explain_establishment: "Please explain!",
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "acts_of_violence" || element.attr("name") == "child_soldier" || element.attr("name") == "religious_freedom" || element.attr("name") == "member_of_affiliated" || element.attr("name") == "colombia_group" || element.attr("name") == "governmental_abuse" || element.attr("name") == "expropriated_property" || element.attr("name") == "chemical_weapon" || element.attr("name") == "trafficked_confidential" || element.attr("name") == "establishment") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $('#fianceAlienQuestion3Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienQuestion3') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activequestion3').removeClass('active');
                            $('.activequestion4').addClass('active');
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
    </script>
</div>