<!-- resources\views\web\visa-application\fiance-visa\alien\question1.blade.php -->
<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienQuestion1'), 'id' => 'fianceAlienQuestion1']) }}
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
                        {{-- <p class="text-danger insurgentOrgaPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have received informal weapons or other paramilitary training, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever served in, been a member of, or been involved with a paramilitary unit, vigilante unit, rebel group, guerrilla group, or insurgent organization?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('insurgent_orga', 'no', @$step->detail['insurgent_orga'] == 'no' ? true : '', ['class' => 'custom-control-input insurgentOrga']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('insurgent_orga', 'yes', @$step->detail['insurgent_orga'] == 'yes' ? true : '', ['class' => 'custom-control-input insurgentOrga']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="insurgent_orga"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 insurgentOrgaSec" style="display: {{ @$step->detail['insurgent_orga'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_insurgent', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_insurgent', @$step->detail['explain_insurgent'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger humanServicePera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have a communicable disease of public health significance or any other medical condition, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Do you have a communicable disease of public health significance? (Communicable diseases of public significance include chancroid, gonorrhea, granuloma inguinale, infections leprosy, lymphogranuloma venereum, infections stage syphilis, active tuberculosis, and other diseases as determined by the Department of Health and Human Services.)</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('human_service', 'no', @$step->detail['human_service'] == 'no' ? true : '', ['class' => 'custom-control-input humanService']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('human_service', 'yes', @$step->detail['human_service'] == 'yes' ? true : '', ['class' => 'custom-control-input humanService']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="human_service"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 humanServiceSec" style="display: {{ @$step->detail['human_service'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_human_service', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_human_service', @$step->detail['explain_human_service'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger physicalDisorderPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have a communicable disease of public health significance or any other medical condition, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Do you have a mental or physical disorder that poses or is likely to pose a threat to the safety or welfare of yourself or others?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('physical_disorder', 'no', @$step->detail['physical_disorder'] == 'no' ? true : '', ['class' => 'custom-control-input physicalDisorder']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('physical_disorder', 'yes', @$step->detail['physical_disorder'] == 'yes' ? true : '', ['class' => 'custom-control-input physicalDisorder']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="physical_disorder"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 physicalDisorderSec" style="display: {{ @$step->detail['physical_disorder'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_physical_disorder', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_physical_disorder', @$step->detail['explain_physical_disorder'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger drugAbuserPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have a communicable disease of public health significance or any other medical condition, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you or have you ever been a drug abuser or addict?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('drug_abuser', 'no', @$step->detail['drug_abuser'] == 'no' ? true : '', ['class' => 'custom-control-input drugAbuser']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('drug_abuser', 'yes', @$step->detail['drug_abuser'] == 'yes' ? true : '', ['class' => 'custom-control-input drugAbuser']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="drug_abuser"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 drugAbuserSec" style="display: {{ @$step->detail['drug_abuser'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_drug_abuser', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_drug_abuser', @$step->detail['explain_drug_abuser'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger medicalExaminationPera" style="display: none;">The U.S government requires the beneficiary and each derivative applicant (if any) applying for a visa to get the medical examination with an authorized civil surgeon in the country where the beneficiary will be interviewed, to establish that they are not inadmissible to the United States on public heath grounds. Please note that applying for a Waiver may delay processing of your case and that Boundless|RapidVisa does not assist with preparing and filing such waivers.</p> --}}
                        <label>Are you planning to get the required medical examination in accordance with U.S. law?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('medical_examination', 'no', @$step->detail['medical_examination'] == 'no' ? true : '', ['class' => 'custom-control-input medicalExamination']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('medical_examination', 'yes', @$step->detail['medical_examination'] == 'yes' ? true : '', ['class' => 'custom-control-input medicalExamination']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="medical_examination"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 medicalExaminationSec" style="display: {{ @$step->detail['medical_examination'] == 'no' ? 'block' : 'none' }};">
                    {{ Form::label('explain_medical_examination', 'Explain why you answered "No" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_medical_examination', @$step->detail['explain_medical_examination'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger arrestedOrConvictedPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever been arrested or convicted for any offense or crime, even though subject of a pardon, amnesty, or other similar action?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('arrested_or_convicted', 'no', @$step->detail['arrested_or_convicted'] == 'no' ? true : '', ['class' => 'custom-control-input arrestedOrConvicted']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('arrested_or_convicted', 'yes', @$step->detail['arrested_or_convicted'] == 'yes' ? true : '', ['class' => 'custom-control-input arrestedOrConvicted']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="arrested_or_convicted"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 arrestedOrConvictedSec" style="display: {{ @$step->detail['arrested_or_convicted'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_arrested_or_convicted', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_arrested_or_convicted', @$step->detail['explain_arrested_or_convicted'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger violatedOrEngagedPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever violated, or engaged in a conspiracy to violate, any law relating to controlled substances?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('violated_or_engaged', 'no', @$step->detail['violated_or_engaged'] == 'no' ? true : '', ['class' => 'custom-control-input violatedOrEngaged']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('violated_or_engaged', 'yes', @$step->detail['violated_or_engaged'] == 'yes' ? true : '', ['class' => 'custom-control-input violatedOrEngaged']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="violated_or_engaged"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 violatedOrEngagedSec" style="display: {{ @$step->detail['violated_or_engaged'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_violated_or_engaged', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_violated_or_engaged', @$step->detail['explain_violated_or_engaged'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger prostitutionPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you coming to the United States to engage in prostitution or unlawful commercialized vice or have you been engaged in prostitution or procuring prostitutes within the past 10 years? </label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('prostitution', 'no', @$step->detail['prostitution'] == 'no' ? true : '', ['class' => 'custom-control-input prostitution']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('prostitution', 'yes', @$step->detail['prostitution'] == 'yes' ? true : '', ['class' => 'custom-control-input prostitution']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="prostitution"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 prostitutionSec" style="display: {{ @$step->detail['prostitution'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_prostitution', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_prostitution', @$step->detail['explain_prostitution'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger moneyLaunderingPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever been involved in, or do you seek to engage in, money laundering?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('money_laundering', 'no', @$step->detail['money_laundering'] == 'no' ? true : '', ['class' => 'custom-control-input moneyLaundering']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('money_laundering', 'yes', @$step->detail['money_laundering'] == 'yes' ? true : '', ['class' => 'custom-control-input moneyLaundering']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="money_laundering"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 moneyLaunderingSec" style="display: {{ @$step->detail['money_laundering'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_money_laundering', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_money_laundering', @$step->detail['explain_money_laundering'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger traffickingOffensePera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever committed or conspired to commit a human trafficking offense in the United States or outside the United States?</label>
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
                <div class="col-md-12 traffickingOffenseSec" style="display: {{ @$step->detail['trafficking_offense'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_trafficking_offense', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_trafficking_offense', @$step->detail['explain_trafficking_offense'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger knowinglyAidedPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever knowingly aided, abetted, assisted, or colluded with an individual who has been identified by the President of the United States as a person who plays a significant role in a severe form of trafficking in persons?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('knowingly_aided', 'no', @$step->detail['knowingly_aided'] == 'no' ? true : '', ['class' => 'custom-control-input knowinglyAided']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('knowingly_aided', 'yes', @$step->detail['knowingly_aided'] == 'yes' ? true : '', ['class' => 'custom-control-input knowinglyAided']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="knowingly_aided"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 knowinglyAidedSec mb-4" style="display: {{ @$step->detail['knowingly_aided'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_knowingly_aided', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_knowingly_aided', @$step->detail['explain_knowingly_aided'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'question1') !!}
        {!! Form::hidden('next', 'question2') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'relatives'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'question2'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienQuestion1Btn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $(document).on('click', '.insurgentOrga', function(){
            if ($(this).val() == 'yes') {
                $('.insurgentOrgaSec').show();
                $('.insurgentOrgaPera').show();
            } else {
                $('.insurgentOrgaSec').hide();
                $('.insurgentOrgaSec > textarea').val('');
                $('.insurgentOrgaPera').hide();
            }
        });

        $(document).on('click', '.humanService', function(){
            if ($(this).val() == 'yes') {
                $('.humanServiceSec').show();
                $('.humanServicePera').show();
            } else {
                $('.humanServiceSec').hide();
                $('.humanServiceSec > textarea').val('');
                $('.humanServicePera').hide();
            }
        });

        $(document).on('click', '.physicalDisorder', function(){
            if ($(this).val() == 'yes') {
                $('.physicalDisorderSec').show();
                $('.physicalDisorderPera').show();
            } else {
                $('.physicalDisorderSec').hide();
                $('.physicalDisorderSec > textarea').val('');
                $('.physicalDisorderPera').hide();
            }
        });

        $(document).on('click', '.drugAbuser', function(){
            if ($(this).val() == 'yes') {
                $('.drugAbuserSec').show();
                $('.drugAbuserPera').show();
            } else {
                $('.drugAbuserSec').hide();
                $('.drugAbuserSec > textarea').val('');
                $('.drugAbuserPera').hide();
            }
        });

        $(document).on('click', '.medicalExamination', function(){
            if ($(this).val() == 'no') {
                $('.medicalExaminationSec').show();
                $('.medicalExaminationPera').show();
            } else {
                $('.medicalExaminationSec').hide();
                $('.medicalExaminationSec > textarea').val('');
                $('.medicalExaminationPera').hide();
            }
        });

        $(document).on('click', '.arrestedOrConvicted', function(){
            if ($(this).val() == 'yes') {
                $('.arrestedOrConvictedSec').show();
                $('.arrestedOrConvictedPera').show();
            } else {
                $('.arrestedOrConvictedSec').hide();
                $('.arrestedOrConvictedSec > textarea').val('');
                $('.arrestedOrConvictedPera').hide();
            }
        });

        $(document).on('click', '.violatedOrEngaged', function(){
            if ($(this).val() == 'yes') {
                $('.violatedOrEngagedSec').show();
                $('.violatedOrEngagedPera').show();
            } else {
                $('.violatedOrEngagedSec').hide();
                $('.violatedOrEngagedSec > textarea').val('');
                $('.violatedOrEngagedPera').hide();
            }
        });

        $(document).on('click', '.prostitution', function(){
            if ($(this).val() == 'yes') {
                $('.prostitutionSec').show();
                $('.prostitutionPera').show();
            } else {
                $('.prostitutionSec').hide();
                $('.prostitutionSec > textarea').val('');
                $('.prostitutionPera').hide();
            }
        });

        $(document).on('click', '.moneyLaundering', function(){
            if ($(this).val() == 'yes') {
                $('.moneyLaunderingSec').show();
                $('.moneyLaunderingPera').show();
            } else {
                $('.moneyLaunderingSec').hide();
                $('.moneyLaunderingSec > textarea').val('');
                $('.moneyLaunderingPera').hide();
            }
        });

        $(document).on('click', '.traffickingOffense', function(){
            if ($(this).val() == 'yes') {
                $('.traffickingOffenseSec').show();
                $('.traffickingOffensePera').show();
            } else {
                $('.traffickingOffenseSec').hide();
                $('.traffickingOffenseSec > textarea').val('');
                $('.traffickingOffensePera').hide();
            }
        });

        $(document).on('click', '.knowinglyAided', function(){
            if ($(this).val() == 'yes') {
                $('.knowinglyAidedSec').show();
                $('.knowinglyAidedPera').show();
            } else {
                $('.knowinglyAidedSec').hide();
                $('.knowinglyAidedSec > textarea').val('');
                $('.knowinglyAidedPera').hide();
            }
        });

        $("#fianceAlienQuestion1").validate({
            rules: {
                insurgent_orga: {
                    required: true,
                },
                explain_insurgent: {
                    required: true,
                },
                human_service: {
                    required: true,
                },
                explain_human_service: {
                    required: true,
                },
                physical_disorder: {
                    required: true,
                },
                explain_physical_disorder: {
                    required: true,
                },
                drug_abuser: {
                    required: true,
                },
                explain_drug_abuser: {
                    required: true,
                },
                medical_examination: {
                    required: true,
                },
                explain_medical_examination: {
                    required: true,
                },
                arrested_or_convicted: {
                    required: true,
                },
                explain_arrested_or_convicted: {
                    required: true,
                },
                violated_or_engaged: {
                    required: true,
                },
                explain_violated_or_engaged: {
                    required: true,
                },
                prostitution: {
                    required: true,
                },
                explain_prostitution: {
                    required: true,
                },
                money_laundering: {
                    required: true,
                },
                explain_money_laundering: {
                    required: true,
                },
                trafficking_offense: {
                    required: true,
                },
                explain_trafficking_offense: {
                    required: true,
                },
                knowingly_aided: {
                    required: true,
                },
                explain_knowingly_aided: {
                    required: true,
                },
            },
            messages: {
               insurgent_orga: "Please choose option!",
               explain_insurgent: "Please explain!",
               human_service: "Please choose option!",
               explain_human_service: "Please explain!",
               physical_disorder: "Please choose option!",
               explain_physical_disorder: "Please explain!",
               drug_abuser: "Please choose option!",
               explain_drug_abuser: "Please explain!",
               medical_examination: "Please choose option!",
               explain_medical_examination: "Please explain!",
               arrested_or_convicted: "Please choose option!",
               explain_arrested_or_convicted: "Please explain!",
               violated_or_engaged: "Please choose option!",
               explain_violated_or_engaged: "Please explain!",
               prostitution: "Please choose option!",
               explain_prostitution: "Please explain!",
               money_laundering: "Please choose option!",
               explain_money_laundering: "Please explain!",
               trafficking_offense: "Please choose option!",
               explain_trafficking_offense: "Please explain!",
               knowingly_aided: "Please choose option!",
               explain_knowingly_aided: "Please explain!",
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "insurgent_orga" || element.attr("name") == "human_service" || element.attr("name") == "physical_disorder" || element.attr("name") == "drug_abuser" || element.attr("name") == "medical_examination" || element.attr("name") == "arrested_or_convicted" || element.attr("name") == "violated_or_engaged" || element.attr("name") == "prostitution" || element.attr("name") == "money_laundering" || element.attr("name") == "trafficking_offense" || element.attr("name") == "knowingly_aided") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $('#fianceAlienQuestion1Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienQuestion1') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activequestion1').removeClass('active');
                            $('.activequestion2').addClass('active');
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