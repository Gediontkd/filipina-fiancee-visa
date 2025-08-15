<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienQuestion4'), 'id' => 'fianceAlienQuestion4']) }}
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
                        {{-- <p class="text-danger transplantationPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have received informal weapons or other paramilitary training, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever been directly involved in the coercive transplantation of human organs or bodily tissue?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('transplantation', 'no', @$step->detail['transplantation'] == 'no' ? true : '', ['class' => 'custom-control-input transplantation']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('transplantation', 'yes', @$step->detail['transplantation'] == 'yes' ? true : '', ['class' => 'custom-control-input transplantation']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="transplantation"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 transplantationSec" style="display: {{ @$step->detail['transplantation'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_transplantation', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_transplantation', @$step->detail['explain_transplantation'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger civilPenaltyPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have a communicable disease of public health significance or any other medical condition, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you subject to a civil penalty under INA 274C</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('civil_penalty', 'no', @$step->detail['civil_penalty'] == 'no' ? true : '', ['class' => 'custom-control-input civilPenalty']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('civil_penalty', 'yes', @$step->detail['civil_penalty'] == 'yes' ? true : '', ['class' => 'custom-control-input civilPenalty']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="civil_penalty"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 civilPenaltySec" style="display: {{ @$step->detail['civil_penalty'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_civil_penalty', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_civil_penalty', @$step->detail['explain_civil_penalty'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>                
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger orderedRemovedPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have a communicable disease of public health significance or any other medical condition, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you been ordered removed from the U.S. during the last five years?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('ordered_removed', 'no', @$step->detail['ordered_removed'] == 'no' ? true : '', ['class' => 'custom-control-input orderedRemoved']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('ordered_removed', 'yes', @$step->detail['ordered_removed'] == 'yes' ? true : '', ['class' => 'custom-control-input orderedRemoved']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="ordered_removed"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 orderedRemovedSec" style="display: {{ @$step->detail['ordered_removed'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_ordered_removed', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_ordered_removed', @$step->detail['explain_ordered_removed'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger orderedRemoved2Pera" style="display: none;">The U.S government requires the beneficiary and each derivative applicant (if any) applying for a visa to get the medical examination with an authorized civil surgeon in the country where the beneficiary will be interviewed, to establish that they are not inadmissible to the United States on public heath grounds. Please note that applying for a Waiver may delay processing of your case and that Boundless|RapidVisa does not assist with preparing and filing such waivers.</p> --}}
                        <label>Have you been ordered removed from the U.S. for a second time within the last 20 years?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('ordered_removed_2', 'no', @$step->detail['ordered_removed_2'] == 'no' ? true : '', ['class' => 'custom-control-input orderedRemoved2']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('ordered_removed_2', 'yes', @$step->detail['ordered_removed_2'] == 'yes' ? true : '', ['class' => 'custom-control-input orderedRemoved2']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="ordered_removed_2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 orderedRemoved2Sec" style="display: {{ @$step->detail['ordered_removed_2'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_ordered_removed_2', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_ordered_removed_2', @$step->detail['explain_ordered_removed_2'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger unlawfullyPresentPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever been unlawfully present and ordered removed from the U.S. during the last ten years?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('unlawfully_present', 'no', @$step->detail['unlawfully_present'] == 'no' ? true : '', ['class' => 'custom-control-input unlawfullyPresent']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('unlawfully_present', 'yes', @$step->detail['unlawfully_present'] == 'yes' ? true : '', ['class' => 'custom-control-input unlawfullyPresent']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="unlawfully_present"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 unlawfullyPresentSec" style="display: {{ @$step->detail['unlawfully_present'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_unlawfully_present', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_unlawfully_present', @$step->detail['explain_unlawfully_present'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger convictedAggravatedPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever been convicted of an aggravated felony and been ordered removed from the U.S.?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('convicted_aggravated', 'no', @$step->detail['convicted_aggravated'] == 'no' ? true : '', ['class' => 'custom-control-input convictedAggravated']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('convicted_aggravated', 'yes', @$step->detail['convicted_aggravated'] == 'yes' ? true : '', ['class' => 'custom-control-input convictedAggravated']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="convicted_aggravated"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 convictedAggravatedSec" style="display: {{ @$step->detail['convicted_aggravated'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_convicted_aggravated', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_convicted_aggravated', @$step->detail['explain_convicted_aggravated'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger voluntarilyDepartedPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever been unlawfully present in the U.S. for more than 180 days (but no more than one year) and have voluntarily departed the U.S. within the last three years?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('voluntarily_departed', 'no', @$step->detail['voluntarily_departed'] == 'no' ? true : '', ['class' => 'custom-control-input voluntarilyDeparted']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('voluntarily_departed', 'yes', @$step->detail['voluntarily_departed'] == 'yes' ? true : '', ['class' => 'custom-control-input voluntarilyDeparted']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="voluntarily_departed"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 voluntarilyDepartedSec" style="display: {{ @$step->detail['voluntarily_departed'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_voluntarily_departed', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_voluntarily_departed', @$step->detail['explain_voluntarily_departed'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger aggregateAtAnyTimePera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever been unlawfully present in the U.S. for more than one year in the aggregate at any time during the past ten years?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('aggregate_at_any_time', 'no', @$step->detail['aggregate_at_any_time'] == 'no' ? true : '', ['class' => 'custom-control-input aggregateAtAnyTime']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('aggregate_at_any_time', 'yes', @$step->detail['aggregate_at_any_time'] == 'yes' ? true : '', ['class' => 'custom-control-input aggregateAtAnyTime']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="aggregate_at_any_time"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 aggregateAtAnyTimeSec" style="display: {{ @$step->detail['aggregate_at_any_time'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('cxplain_aggregate_at_any_time', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('cxplain_aggregate_at_any_time', @$step->detail['cxplain_aggregate_at_any_time'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger withheldCustodyPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever withheld custody of a U.S. citizen child outside the United States from a person granted legal custody by a U.S. court?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('withheld_custody', 'no', @$step->detail['withheld_custody'] == 'no' ? true : '', ['class' => 'custom-control-input withheldCustody']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('withheld_custody', 'yes', @$step->detail['withheld_custody'] == 'yes' ? true : '', ['class' => 'custom-control-input withheldCustody']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="withheld_custody"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 withheldCustodySec" style="display: {{ @$step->detail['withheld_custody'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_withheld_custody', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_withheld_custody', @$step->detail['explain_withheld_custody'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger votedTheUSPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you voted in the United States in violation of any law or regulation?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('voted_the_us', 'no', @$step->detail['voted_the_us'] == 'no' ? true : '', ['class' => 'custom-control-input votedTheUS']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('voted_the_us', 'yes', @$step->detail['voted_the_us'] == 'yes' ? true : '', ['class' => 'custom-control-input votedTheUS']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="voted_the_us"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 votedTheUSSec mb-4" style="display: {{ @$step->detail['voted_the_us'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_voted_the_us', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_voted_the_us', @$step->detail['explain_voted_the_us'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger removedDeportedPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever been removed or deported from any country?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('removed_deported', 'no', @$step->detail['removed_deported'] == 'no' ? true : '', ['class' => 'custom-control-input removedDeported']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('removed_deported', 'yes', @$step->detail['removed_deported'] == 'yes' ? true : '', ['class' => 'custom-control-input removedDeported']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="removed_deported"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 removedDeportedSec mb-4" style="display: {{ @$step->detail['removed_deported'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_removed_deported', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_removed_deported', @$step->detail['explain_removed_deported'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger deportationHearingPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever been the subject of a removal or deportation hearing?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('deportation_hearing', 'no', @$step->detail['deportation_hearing'] == 'no' ? true : '', ['class' => 'custom-control-input deportationHearing']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('deportation_hearing', 'yes', @$step->detail['deportation_hearing'] == 'yes' ? true : '', ['class' => 'custom-control-input deportationHearing']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="deportation_hearing"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 deportationHearingSec mb-4" style="display: {{ @$step->detail['deportation_hearing'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_deportation_hearing', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_deportation_hearing', @$step->detail['explain_deportation_hearing'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger inadmissibiltyPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever failed to attend a hearing on removability or inadmissibilty within the last five years?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('inadmissibilty', 'no', @$step->detail['inadmissibilty'] == 'no' ? true : '', ['class' => 'custom-control-input inadmissibilty']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('inadmissibilty', 'yes', @$step->detail['inadmissibilty'] == 'yes' ? true : '', ['class' => 'custom-control-input inadmissibilty']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="inadmissibilty"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 inadmissibiltySec mb-4" style="display: {{ @$step->detail['inadmissibilty'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_inadmissibilty', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_inadmissibilty', @$step->detail['explain_inadmissibilty'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger admittedUSPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever been barred from being admitted to the United States for any period of time (INA section 212(a)(9)(B)(i)(I) and (II))?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('admitted_u_s', 'no', @$step->detail['admitted_u_s'] == 'no' ? true : '', ['class' => 'custom-control-input admittedUS']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('admitted_u_s', 'yes', @$step->detail['admitted_u_s'] == 'yes' ? true : '', ['class' => 'custom-control-input admittedUS']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="admitted_u_s"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 admittedUSSec mb-4" style="display: {{ @$step->detail['admitted_u_s'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_admitted_u_s', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_admitted_u_s', @$step->detail['explain_admitted_u_s'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger immigrationOfficialPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever been unlawfully present, overstayed the amount of time granted by an immigration official or otherise violated the terms of a U.S. visa?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('immigration_official', 'no', @$step->detail['immigration_official'] == 'no' ? true : '', ['class' => 'custom-control-input immigrationOfficial']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('immigration_official', 'yes', @$step->detail['immigration_official'] == 'yes' ? true : '', ['class' => 'custom-control-input immigrationOfficial']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="immigration_official"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 immigrationOfficialSec mb-4" style="display: {{ @$step->detail['immigration_official'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_immigration_official', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_immigration_official', @$step->detail['explain_immigration_official'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'question4') !!}
        {!! Form::hidden('next', 'question5') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'question3'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 previousOrContinue',
            'data-form' => 'question5'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceAlienQuestion4Btn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $(document).on('click', '.transplantation', function(){
            if ($(this).val() == 'yes') {
                $('.transplantationSec').show();
                $('.transplantationPera').show();
            } else {
                $('.transplantationSec').hide();
                $('.transplantationSec > textarea').val('');
                $('.transplantationPera').hide();
            }
        });

        $(document).on('click', '.civilPenalty', function(){
            if ($(this).val() == 'yes') {
                $('.civilPenaltySec').show();
                $('.civilPenaltyPera').show();
            } else {
                $('.civilPenaltySec').hide();
                $('.civilPenaltySec > textarea').val('');
                $('.civilPenaltyPera').hide();
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

        $(document).on('click', '.orderedRemoved', function(){
            if ($(this).val() == 'yes') {
                $('.orderedRemovedSec').show();
                $('.orderedRemovedPera').show();
            } else {
                $('.orderedRemovedSec').hide();
                $('.orderedRemovedSec > textarea').val('');
                $('.orderedRemovedPera').hide();
            }
        });

        $(document).on('click', '.orderedRemoved2', function(){
            if ($(this).val() == 'yes') {
                $('.orderedRemoved2Sec').show();
                $('.orderedRemoved2Pera').show();
            } else {
                $('.orderedRemoved2Sec').hide();
                $('.orderedRemoved2Sec > textarea').val('');
                $('.orderedRemoved2Pera').hide();
            }
        });

        $(document).on('click', '.unlawfullyPresent', function(){
            if ($(this).val() == 'yes') {
                $('.unlawfullyPresentSec').show();
                $('.unlawfullyPresentPera').show();
            } else {
                $('.unlawfullyPresentSec').hide();
                $('.unlawfullyPresentSec > textarea').val('');
                $('.unlawfullyPresentPera').hide();
            }
        });

        $(document).on('click', '.convictedAggravated', function(){
            if ($(this).val() == 'yes') {
                $('.convictedAggravatedSec').show();
                $('.convictedAggravatedPera').show();
            } else {
                $('.convictedAggravatedSec').hide();
                $('.convictedAggravatedSec > textarea').val('');
                $('.convictedAggravatedPera').hide();
            }
        });

        $(document).on('click', '.voluntarilyDeparted', function(){
            if ($(this).val() == 'yes') {
                $('.voluntarilyDepartedSec').show();
                $('.voluntarilyDepartedPera').show();
            } else {
                $('.voluntarilyDepartedSec').hide();
                $('.voluntarilyDepartedSec > textarea').val('');
                $('.voluntarilyDepartedPera').hide();
            }
        });

        $(document).on('click', '.aggregateAtAnyTime', function(){
            if ($(this).val() == 'yes') {
                $('.aggregateAtAnyTimeSec').show();
                $('.aggregateAtAnyTimePera').show();
            } else {
                $('.aggregateAtAnyTimeSec').hide();
                $('.aggregateAtAnyTimeSec > textarea').val('');
                $('.aggregateAtAnyTimePera').hide();
            }
        });

        $(document).on('click', '.withheldCustody', function(){
            if ($(this).val() == 'yes') {
                $('.withheldCustodySec').show();
                $('.withheldCustodyPera').show();
            } else {
                $('.withheldCustodySec').hide();
                $('.withheldCustodySec > textarea').val('');
                $('.withheldCustodyPera').hide();
            }
        });

        $(document).on('click', '.votedTheUS', function(){
            if ($(this).val() == 'yes') {
                $('.votedTheUSSec').show();
                $('.votedTheUSPera').show();
            } else {
                $('.votedTheUSSec').hide();
                $('.votedTheUSSec > textarea').val('');
                $('.votedTheUSPera').hide();
            }
        });

        $(document).on('click', '.removedDeported', function(){
            if ($(this).val() == 'yes') {
                $('.removedDeportedSec').show();
                $('.removedDeportedPera').show();
            } else {
                $('.removedDeportedSec').hide();
                $('.removedDeportedSec > textarea').val('');
                $('.removedDeportedPera').hide();
            }
        });

        $(document).on('click', '.deportationHearing', function(){
            if ($(this).val() == 'yes') {
                $('.deportationHearingSec').show();
                $('.deportationHearingPera').show();
            } else {
                $('.deportationHearingSec').hide();
                $('.deportationHearingSec > textarea').val('');
                $('.deportationHearingPera').hide();
            }
        });

        $(document).on('click', '.inadmissibilty', function(){
            if ($(this).val() == 'yes') {
                $('.inadmissibiltySec').show();
                $('.inadmissibiltyPera').show();
            } else {
                $('.inadmissibiltySec').hide();
                $('.inadmissibiltySec > textarea').val('');
                $('.inadmissibiltyPera').hide();
            }
        });

        $(document).on('click', '.admittedUS', function(){
            if ($(this).val() == 'yes') {
                $('.admittedUSSec').show();
                $('.admittedUSPera').show();
            } else {
                $('.admittedUSSec').hide();
                $('.admittedUSSec > textarea').val('');
                $('.admittedUSPera').hide();
            }
        });

        $(document).on('click', '.immigrationOfficial', function(){
            if ($(this).val() == 'yes') {
                $('.immigrationOfficialSec').show();
                $('.immigrationOfficialPera').show();
            } else {
                $('.immigrationOfficialSec').hide();
                $('.immigrationOfficialSec > textarea').val('');
                $('.immigrationOfficialPera').hide();
            }
        });

        $("#fianceAlienQuestion4").validate({
            rules: {
                transplantation: {
                    required: true,
                },
                explain_transplantation: {
                    required: true,
                },
                civil_penalty: {
                    required: true,
                },
                explain_civil_penalty: {
                    required: true,
                },
                ordered_removed: {
                    required: true,
                },
                explain_ordered_removed: {
                    required: true,
                },
                ordered_removed_2: {
                    required: true,
                },
                explain_ordered_removed_2: {
                    required: true,
                },
                unlawfully_present: {
                    required: true,
                },
                explain_unlawfully_present: {
                    required: true,
                },
                convicted_aggravated: {
                    required: true,
                },
                explain_convicted_aggravated: {
                    required: true,
                },
                voluntarily_departed: {
                    required: true,
                },
                explain_voluntarily_departed: {
                    required: true,
                },
                aggregate_at_any_time: {
                    required: true,
                },
                cxplain_aggregate_at_any_time: {
                    required: true,
                },
                withheld_custody: {
                    required: true,
                },
                explain_withheld_custody: {
                    required: true,
                },
                removed_deported: {
                    required: true,
                },
                explain_removed_deported: {
                    required: true,
                },
                deportation_hearing: {
                    required: true,
                },
                explain_deportation_hearing: {
                    required: true,
                },
                inadmissibilty: {
                    required: true,
                },
                explain_inadmissibilty: {
                    required: true,
                },
                admitted_u_s: {
                    required: true,
                },
                explain_admitted_u_s: {
                    required: true,
                },
                immigration_official: {
                    required: true,
                },
                explain_immigration_official: {
                    required: true,
                },
            },
            messages: {
               transplantation: "Please choose option!",
               explain_transplantation: "Please explain!",
               civil_penalty: "Please choose option!",
               explain_civil_penalty: "Please explain!",
               ordered_removed: "Please choose option!",
               explain_ordered_removed: "Please explain!",
               ordered_removed_2: "Please choose option!",
               explain_ordered_removed_2: "Please explain!",
               unlawfully_present: "Please choose option!",
               explain_unlawfully_present: "Please explain!",
               convicted_aggravated: "Please choose option!",
               explain_convicted_aggravated: "Please explain!",
               voluntarily_departed: "Please choose option!",
               explain_voluntarily_departed: "Please explain!",
               aggregate_at_any_time: "Please choose option!",
               cxplain_aggregate_at_any_time: "Please explain!",
               withheld_custody: "Please choose option!",
               explain_withheld_custody: "Please explain!",
               removed_deported: "Please choose option!",
               explain_removed_deported: "Please explain!",
               deportation_hearing: "Please choose option!",
               explain_deportation_hearing: "Please explain!",
               inadmissibilty: "Please choose option!",
               explain_inadmissibilty: "Please explain!",
               admitted_u_s: "Please choose option!",
               explain_admitted_u_s: "Please explain!",
               immigration_official: "Please choose option!",
               explain_immigration_official: "Please explain!",
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "transplantation" || element.attr("name") == "civil_penalty" || element.attr("name") == "significant_role" || element.attr("name") == "ordered_removed" || element.attr("name") == "ordered_removed_2" || element.attr("name") == "unlawfully_present" || element.attr("name") == "convicted_aggravated" || element.attr("name") == "voluntarily_departed" || element.attr("name") == "aggregate_at_any_time" || element.attr("name") == "withheld_custody" || element.attr("name") == "removed_deported" || element.attr("name") == "deportation_hearing" || element.attr("name") == "inadmissibilty" || element.attr("name") == "admitted_u_s" || element.attr("name") == "immigration_official") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $('#fianceAlienQuestion4Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienQuestion4') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.activequestion4').removeClass('active');
                            $('.activequestion5').addClass('active');
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