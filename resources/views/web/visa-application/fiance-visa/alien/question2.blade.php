<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienQuestion2'), 'id' => 'fianceAlienQuestion2']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>All questions are about the Alien (foreign citizen).</h2>
                        <p class="text-danger">WARNING! Do not write your answers in all capital leters and never use any type of non-English
                            characters. Please use proper capitalization.</p>
                    </div>
                </div>               
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger trafficking_offOsePera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have received informal weapons or other paramilitary training, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever knowingly aided, abetted, assisted or colluded with an individual who has committed, or conspired to commit a severe human trafficking offense in the United States or outside the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('trafficking_offense', 'no', @$step->detail['trafficking_offense'] == 'no' ? true : '', ['class' => 'custom-control-input traffickingOffense']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('trafficking_offense', 'yes', @$step->detail['trafficking_offense'] == 'yes' ? true : '', ['class' => 'custom-control-input traffickingOffense']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="trafficking_offense"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 trafficking_ofOnseSec" style="display: {{ @$step->detail['trafficking_offense'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_trafficking_offense', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_trafficking_offense', @$step->detail['explain_trafficking_offense'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger traffickingActivitiePera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have a communicable disease of public health significance or any other medical condition, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you the spouse, son, or daughter of an individual who has committed or conspired to commit a human trafficking offense in the United States or outside the United States and have you within the last five years, knowingly benefited from trafficking activities?)</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('trafficking_activitie', 'no', @$step->detail['trafficking_activitie'] == 'no' ? true : '', ['class' => 'custom-control-input traffickingActivitie']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('trafficking_activitie', 'yes', @$step->detail['trafficking_activitie'] == 'yes' ? true : '', ['class' => 'custom-control-input traffickingActivitie']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="trafficking_activitie"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 traffickingActivitieSec" style="display: {{ @$step->detail['trafficking_activitie'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_trafficking_activitie', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_trafficking_activitie', @$step->detail['explain_trafficking_activitie'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger significantRolePera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have a communicable disease of public health significance or any other medical condition, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you the spouse, son or daughter of an individual who has been identified by the President of the United States as a person who plays a significant role in a severe form of trafficking in persons and have you, within the last five years, knowingly benefited from the trafficking activities?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('significant_role', 'no', @$step->detail['significant_role'] == 'no' ? true : '', ['class' => 'custom-control-input significantRole']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('significant_role', 'yes', @$step->detail['significant_role'] == 'yes' ? true : '', ['class' => 'custom-control-input significantRole']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="significant_role"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 significantRoleSec" style="display: {{ @$step->detail['significant_role'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_significant_role', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_significant_role', @$step->detail['explain_significant_role'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger violatedControlledPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have a communicable disease of public health significance or any other medical condition, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you the spouse, son or daughter of an individual who has violated any controlled substance trafficking law, and have knowingly benefited from the trafficking activities in the past five years?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('violated_controlled', 'no', @$step->detail['violated_controlled'] == 'no' ? true : '', ['class' => 'custom-control-input violatedControlled']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('violated_controlled', 'yes', @$step->detail['violated_controlled'] == 'yes' ? true : '', ['class' => 'custom-control-input violatedControlled']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="violated_controlled"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 violatedControlledSec" style="display: {{ @$step->detail['violated_controlled'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_violated_controlled', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_violated_controlled', @$step->detail['explain_violated_controlled'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger illegalActivityPera" style="display: none;">The U.S government requires the beneficiary and each derivative applicant (if any) applying for a visa to get the medical examination with an authorized civil surgeon in the country where the beneficiary will be interviewed, to establish that they are not inadmissible to the United States on public heath grounds. Please note that applying for a Waiver may delay processing of your case and that Boundless|RapidVisa does not assist with preparing and filing such waivers.</p> --}}
                        <label>Do you seek to engage in espionage, sabotage, export control violations, or any other illegal activity while in the United States? </label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('illegal_activity', 'no', @$step->detail['illegal_activity'] == 'no' ? true : '', ['class' => 'custom-control-input illegalActivity']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('illegal_activity', 'yes', @$step->detail['illegal_activity'] == 'yes' ? true : '', ['class' => 'custom-control-input illegalActivity']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="illegal_activity"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 illegalActivitySec" style="display: {{ @$step->detail['illegal_activity'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_illegal_activity', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_illegal_activity', @$step->detail['explain_illegal_activity'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger terroristActivitiesPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Do you seek to engage in terrorist activities while in the United States or have you ever engaged in terrorist activities?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('terrorist_activities', 'no', @$step->detail['terrorist_activities'] == 'no' ? true : '', ['class' => 'custom-control-input terroristActivities']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('terrorist_activities', 'yes', @$step->detail['terrorist_activities'] == 'yes' ? true : '', ['class' => 'custom-control-input terroristActivities']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="terrorist_activities"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 terroristActivitiesSec" style="display: {{ @$step->detail['terrorist_activities'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_terrorist_activities', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_terrorist_activities', @$step->detail['explain_terrorist_activities'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger terroristOrgaPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever or do you intend to provide financial assistance or other support to terrorists or terrorist organizations?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('terrorist_orga', 'no', @$step->detail['terrorist_orga'] == 'no' ? true : '', ['class' => 'custom-control-input terroristOrga']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('terrorist_orga', 'yes', @$step->detail['terrorist_orga'] == 'yes' ? true : '', ['class' => 'custom-control-input terroristOrga']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="terrorist_orga"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 terroristOrgaSec" style="display: {{ @$step->detail['terrorist_orga'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_terrorist_orga', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_terrorist_orga', @$step->detail['explain_terrorist_orga'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger memberTerrOrgaPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you a member or representative of a terrorist organization?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('member_terr_orga', 'no', @$step->detail['member_terr_orga'] == 'no' ? true : '', ['class' => 'custom-control-input memberTerrOrga']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('member_terr_orga', 'yes', @$step->detail['member_terr_orga'] == 'yes' ? true : '', ['class' => 'custom-control-input memberTerrOrga']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="member_terr_orga"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 memberTerrOrgaSec" style="display: {{ @$step->detail['member_terr_orga'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_member_terr_orga', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_member_terr_orga', @$step->detail['explain_member_terr_orga'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger participatedGenocidePera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever ordered, incited, committed, assisted, or otherwise participated in genocide?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('participated_genocide', 'no', @$step->detail['participated_genocide'] == 'no' ? true : '', ['class' => 'custom-control-input participatedGenocide']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('participated_genocide', 'yes', @$step->detail['participated_genocide'] == 'yes' ? true : '', ['class' => 'custom-control-input participatedGenocide']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="participated_genocide"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 participatedGenocideSec" style="display: {{ @$step->detail['participated_genocide'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_participated_genocide', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_participated_genocide', @$step->detail['explain_participated_genocide'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger participatedTorturePera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever committed, ordered, incited, assisted, or otherwise participated in torture?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('participated_torture', 'no', @$step->detail['participated_torture'] == 'no' ? true : '', ['class' => 'custom-control-input participatedTorture']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('participated_torture', 'yes', @$step->detail['participated_torture'] == 'yes' ? true : '', ['class' => 'custom-control-input participatedTorture']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="participated_torture"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 participatedTortureSec" style="display: {{ @$step->detail['participated_torture'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_participated_torture', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_participated_torture', @$step->detail['explain_participated_torture'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger withholdingCustodyPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever intentionally assisted another person in withholding custody of a U.S. citizen child outside the United States from a person granted legal custody by a U.S. court?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('withholding_custody', 'no', @$step->detail['withholding_custody'] == 'no' ? true : '', ['class' => 'custom-control-input withholdingCustody']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('withholding_custody', 'yes', @$step->detail['withholding_custody'] == 'yes' ? true : '', ['class' => 'custom-control-input withholdingCustody']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="withholding_custody"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 withholdingCustodySec mb-4" style="display: {{ @$step->detail['withholding_custody'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_withholding_custody', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_withholding_custody', @$step->detail['explain_withholding_custody'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'question2') !!}
        {!! Form::hidden('next', 'question3') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'question1'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'question3'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienQuestion2Btn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $(document).on('click', '.traffickingOffense', function(){
            if ($(this).val() == 'yes') {
                $('.trafficking_ofOnseSec').show();
                $('.trafficking_offOsePera').show();
            } else {
                $('.trafficking_ofOnseSec').hide();
                $('.trafficking_ofOnseSec > textarea').val('');
                $('.trafficking_offOsePera').hide();
            }
        });

        $(document).on('click', '.traffickingActivitie', function(){
            if ($(this).val() == 'yes') {
                $('.traffickingActivitieSec').show();
                $('.traffickingActivitiePera').show();
            } else {
                $('.traffickingActivitieSec').hide();
                $('.traffickingActivitieSec > textarea').val('');
                $('.traffickingActivitiePera').hide();
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

        $(document).on('click', '.violatedControlled', function(){
            if ($(this).val() == 'yes') {
                $('.violatedControlledSec').show();
                $('.violatedControlledPera').show();
            } else {
                $('.violatedControlledSec').hide();
                $('.violatedControlledSec > textarea').val('');
                $('.violatedControlledPera').hide();
            }
        });

        $(document).on('click', '.illegalActivity', function(){
            if ($(this).val() == 'yes') {
                $('.illegalActivitySec').show();
                $('.illegalActivityPera').show();
            } else {
                $('.illegalActivitySec').hide();
                $('.illegalActivitySec > textarea').val('');
                $('.illegalActivityPera').hide();
            }
        });

        $(document).on('click', '.terroristActivities', function(){
            if ($(this).val() == 'yes') {
                $('.terroristActivitiesSec').show();
                $('.terroristActivitiesPera').show();
            } else {
                $('.terroristActivitiesSec').hide();
                $('.terroristActivitiesSec > textarea').val('');
                $('.terroristActivitiesPera').hide();
            }
        });

        $(document).on('click', '.terroristOrga', function(){
            if ($(this).val() == 'yes') {
                $('.terroristOrgaSec').show();
                $('.terroristOrgaPera').show();
            } else {
                $('.terroristOrgaSec').hide();
                $('.terroristOrgaSec > textarea').val('');
                $('.terroristOrgaPera').hide();
            }
        });

        $(document).on('click', '.memberTerrOrga', function(){
            if ($(this).val() == 'yes') {
                $('.memberTerrOrgaSec').show();
                $('.memberTerrOrgaPera').show();
            } else {
                $('.memberTerrOrgaSec').hide();
                $('.memberTerrOrgaSec > textarea').val('');
                $('.memberTerrOrgaPera').hide();
            }
        });

        $(document).on('click', '.participatedGenocide', function(){
            if ($(this).val() == 'yes') {
                $('.participatedGenocideSec').show();
                $('.participatedGenocidePera').show();
            } else {
                $('.participatedGenocideSec').hide();
                $('.participatedGenocideSec > textarea').val('');
                $('.participatedGenocidePera').hide();
            }
        });

        $(document).on('click', '.participatedTorture', function(){
            if ($(this).val() == 'yes') {
                $('.participatedTortureSec').show();
                $('.participatedTorturePera').show();
            } else {
                $('.participatedTortureSec').hide();
                $('.participatedTortureSec > textarea').val('');
                $('.participatedTorturePera').hide();
            }
        });

        $(document).on('click', '.withholdingCustody', function(){
            if ($(this).val() == 'yes') {
                $('.withholdingCustodySec').show();
                $('.withholdingCustodyPera').show();
            } else {
                $('.withholdingCustodySec').hide();
                $('.withholdingCustodySec > textarea').val('');
                $('.withholdingCustodyPera').hide();
            }
        });

        $("#fianceAlienQuestion2").validate({
            rules: {
                trafficking_offense: {
                    required: true,
                },
                explain_trafficking_offense: {
                    required: true,
                },
                trafficking_activitie: {
                    required: true,
                },
                explain_trafficking_activitie: {
                    required: true,
                },
                significant_role: {
                    required: true,
                },
                explain_significant_role: {
                    required: true,
                },
                violated_controlled: {
                    required: true,
                },
                explain_violated_controlled: {
                    required: true,
                },
                illegal_activity: {
                    required: true,
                },
                explain_illegal_activity: {
                    required: true,
                },
                terrorist_activities: {
                    required: true,
                },
                explain_terrorist_activities: {
                    required: true,
                },
                terrorist_orga: {
                    required: true,
                },
                explain_terrorist_orga: {
                    required: true,
                },
                member_terr_orga: {
                    required: true,
                },
                explain_member_terr_orga: {
                    required: true,
                },
                participated_genocide: {
                    required: true,
                },
                explain_participated_genocide: {
                    required: true,
                },
                participated_torture: {
                    required: true,
                },
                explain_participated_torture: {
                    required: true,
                },
                withholding_custody: {
                    required: true,
                },
                explain_withholding_custody: {
                    required: true,
                },
            },
            messages: {
               trafficking_offense: "Please choose option!",
               explain_trafficking_offense: "Please explain!",
               trafficking_activitie: "Please choose option!",
               explain_trafficking_activitie: "Please explain!",
               significant_role: "Please choose option!",
               explain_significant_role: "Please explain!",
               violated_controlled: "Please choose option!",
               explain_violated_controlled: "Please explain!",
               illegal_activity: "Please choose option!",
               explain_illegal_activity: "Please explain!",
               terrorist_activities: "Please choose option!",
               explain_terrorist_activities: "Please explain!",
               terrorist_orga: "Please choose option!",
               explain_terrorist_orga: "Please explain!",
               member_terr_orga: "Please choose option!",
               explain_member_terr_orga: "Please explain!",
               participated_genocide: "Please choose option!",
               explain_participated_genocide: "Please explain!",
               participated_torture: "Please choose option!",
               explain_participated_torture: "Please explain!",
               withholding_custody: "Please choose option!",
               explain_withholding_custody: "Please explain!",
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "trafficking_offense" || element.attr("name") == "trafficking_activitie" || element.attr("name") == "significant_role" || element.attr("name") == "violated_controlled" || element.attr("name") == "illegal_activity" || element.attr("name") == "terrorist_activities" || element.attr("name") == "terrorist_orga" || element.attr("name") == "member_terr_orga" || element.attr("name") == "participated_genocide" || element.attr("name") == "participated_torture" || element.attr("name") == "withholding_custody") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $('#fianceAlienQuestion2Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienQuestion2') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activequestion2').removeClass('active');
                            $('.activequestion3').addClass('active');
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