<div class="step-wizard">
    {{ Form::open(['url' => route('fianceAlienQuestion5'), 'id' => 'fianceAlienQuestion5']) }}
        <div class="form-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading mb-30">
                        <h2>All questions are about the Alien (foreign citizen).5</h2>
                        <p class="text-danger">WARNING! Do not write your answers in all capital leters and never use any type of non-English
                            characters. Please use proper capitalization.</p>
                    </div>
                </div>               
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger avoidingTaxationPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have received informal weapons or other paramilitary training, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever renounced United States citizenship for the purposes of avoiding taxation?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('avoiding_taxation', 'no', @$step->detail['avoiding_taxation'] == 'no' ? true : '', ['class' => 'custom-control-input avoidingTaxation']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('avoiding_taxation', 'yes', @$step->detail['avoiding_taxation'] == 'yes' ? true : '', ['class' => 'custom-control-input avoidingTaxation']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="avoiding_taxation"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 avoidingTaxationSec" style="display: {{ @$step->detail['avoiding_taxation'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_avoiding_taxation', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_avoiding_taxation', @$step->detail['explain_avoiding_taxation'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger formerExchangeVisitorPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have a communicable disease of public health significance or any other medical condition, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you a former exchange visitor (J) who has not yet fulfilled the two-year foreign residence requirement?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('former_exchange_visitor', 'no', @$step->detail['former_exchange_visitor'] == 'no' ? true : '', ['class' => 'custom-control-input formerExchangeVisitor']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('former_exchange_visitor', 'yes', @$step->detail['former_exchange_visitor'] == 'yes' ? true : '', ['class' => 'custom-control-input formerExchangeVisitor']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="former_exchange_visitor"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 formerExchangeVisitorSec" style="display: {{ @$step->detail['former_exchange_visitor'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_former_exchange_visitor', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_former_exchange_visitor', @$step->detail['explain_former_exchange_visitor'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>                
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger secretaryOfLaborPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have a communicable disease of public health significance or any other medical condition, as these applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Do you seek to enter the United States for purpose of performing skilled or unskilled labor but have not yet been certified by the Secretary of Labor?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('secretary_of_labor', 'no', @$step->detail['secretary_of_labor'] == 'no' ? true : '', ['class' => 'custom-control-input secretaryOfLabor']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('secretary_of_labor', 'yes', @$step->detail['secretary_of_labor'] == 'yes' ? true : '', ['class' => 'custom-control-input secretaryOfLabor']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="secretary_of_labor"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 secretaryOfLaborSec" style="display: {{ @$step->detail['secretary_of_labor'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_secretary_of_labor', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_secretary_of_labor', @$step->detail['explain_secretary_of_labor'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger foreignMedicalSchoolPera" style="display: none;">The U.S government requires the beneficiary and each derivative applicant (if any) applying for a visa to get the medical examination with an authorized civil surgeon in the country where the beneficiary will be interviewed, to establish that they are not inadmissible to the United States on public heath grounds. Please note that applying for a Waiver may delay processing of your case and that Boundless|RapidVisa does not assist with preparing and filing such waivers.</p> --}}
                        <label>Are you a graduate of a foreign medical school seeking to perform medical services in the United States but have not yet passed the National Board of Medical Examiners examination or its equivalent?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('foreign_medical_school', 'no', @$step->detail['foreign_medical_school'] == 'no' ? true : '', ['class' => 'custom-control-input foreignMedicalSchool']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('foreign_medical_school', 'yes', @$step->detail['foreign_medical_school'] == 'yes' ? true : '', ['class' => 'custom-control-input foreignMedicalSchool']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="foreign_medical_school"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 foreignMedicalSchoolSec" style="display: {{ @$step->detail['foreign_medical_school'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_foreign_medical_school', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_foreign_medical_school', @$step->detail['explain_foreign_medical_school'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger credentialingOrgPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you a health care worker seeking to perform such work in the United States but have not yet received certification from the Commission on Graduates of Foreign Nursing Schools or from an equivalent approved independent credentialing organization? </label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('credentialing_org', 'no', @$step->detail['credentialing_org'] == 'no' ? true : '', ['class' => 'custom-control-input credentialingOrg']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('credentialing_org', 'yes', @$step->detail['credentialing_org'] == 'yes' ? true : '', ['class' => 'custom-control-input credentialingOrg']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="credentialing_org"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 credentialingOrgSec" style="display: {{ @$step->detail['credentialing_org'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_credentialing_org', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_credentialing_org', @$step->detail['explain_credentialing_org'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger permanentlyIneligiblePera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you permanently ineligible for U.S. citizenship?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('permanently_ineligible', 'no', @$step->detail['permanently_ineligible'] == 'no' ? true : '', ['class' => 'custom-control-input permanentlyIneligible']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('permanently_ineligible', 'yes', @$step->detail['permanently_ineligible'] == 'yes' ? true : '', ['class' => 'custom-control-input permanentlyIneligible']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="permanently_ineligible"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 permanentlyIneligibleSec" style="display: {{ @$step->detail['permanently_ineligible'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_permanently_ineligible', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_permanently_ineligible', @$step->detail['explain_permanently_ineligible'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger departedUSPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever departed the United States in order to evade military service during a time of war?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('departed_us', 'no', @$step->detail['departed_us'] == 'no' ? true : '', ['class' => 'custom-control-input departedUS']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('departed_us', 'yes', @$step->detail['departed_us'] == 'yes' ? true : '', ['class' => 'custom-control-input departedUS']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="departed_us"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 departedUSSec" style="display: {{ @$step->detail['departed_us'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_departed_us', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_departed_us', @$step->detail['explain_departed_us'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger practicePolygamyPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Are you coming to the U.S. to practice polygamy?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('practice_polygamy', 'no', @$step->detail['practice_polygamy'] == 'no' ? true : '', ['class' => 'custom-control-input practicePolygamy']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('practice_polygamy', 'yes', @$step->detail['practice_polygamy'] == 'yes' ? true : '', ['class' => 'custom-control-input practicePolygamy']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="practice_polygamy"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 practicePolygamySec" style="display: {{ @$step->detail['practice_polygamy'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('cxplain_practice_polygamy', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('cxplain_practice_polygamy', @$step->detail['cxplain_practice_polygamy'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger frivolousApplicationPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Has the Secretary of Homeland Security of the United States ever determined that you knowingly made a frivolous application for asylum?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('frivolous_application', 'no', @$step->detail['frivolous_application'] == 'no' ? true : '', ['class' => 'custom-control-input frivolousApplication']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('frivolous_application', 'yes', @$step->detail['frivolous_application'] == 'yes' ? true : '', ['class' => 'custom-control-input frivolousApplication']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="frivolous_application"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 frivolousApplicationSec" style="display: {{ @$step->detail['frivolous_application'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_frivolous_application', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_frivolous_application', @$step->detail['explain_frivolous_application'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{-- <p class="text-danger misrepresentationPera" style="display: none;">At this time, Boundless|RapidVisa is not able to help applicants who have any previous criminal history or contact with the criminal justice system, including simple arrests or cases where the charges were dropped. These applications require additional documentation and legal support outside the scope of the Boundless process. If you have already paid RapidVisa, please contact the Customer Success team so they can initiate a refund.</p> --}}
                        <label>Have you ever sought to obtain or assist others to obtain a visa, entry into the United States, or any other United States immigration benefit by fraud or willful misrepresentation or other unlawful means?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('misrepresentation', 'no', @$step->detail['misrepresentation'] == 'no' ? true : '', ['class' => 'custom-control-input misrepresentation']) }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('misrepresentation', 'yes', @$step->detail['misrepresentation'] == 'yes' ? true : '', ['class' => 'custom-control-input misrepresentation']) }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="misrepresentation"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 misrepresentationSec mb-4" style="display: {{ @$step->detail['misrepresentation'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explain_misrepresentation', 'Explain why you answered "Yes" to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explain_misrepresentation', @$step->detail['explain_misrepresentation'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>                
            </div>
        </div>
        {!! Form::hidden('id', @$step->id) !!}
        {!! Form::hidden('name', 'question5') !!}
        {!! Form::hidden('next', 'name') !!}
        {!! Form::hidden('type', 'alien') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey previousOrContinue',
            'data-form' => 'question4'
        ]) }}        
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'fianceQuestion4B5n',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}

    <script type="text/javascript">
        $(document).on('click', '.avoidingTaxation', function(){
            if ($(this).val() == 'yes') {
                $('.avoidingTaxationSec').show();
                $('.avoidingTaxationPera').show();
            } else {
                $('.avoidingTaxationSec').hide();
                $('.avoidingTaxationSec > textarea').val('');
                $('.avoidingTaxationPera').hide();
            }
        });

        $(document).on('click', '.formerExchangeVisitor', function(){
            if ($(this).val() == 'yes') {
                $('.formerExchangeVisitorSec').show();
                $('.formerExchangeVisitorPera').show();
            } else {
                $('.formerExchangeVisitorSec').hide();
                $('.formerExchangeVisitorSec > textarea').val('');
                $('.formerExchangeVisitorPera').hide();
            }
        });        

        $(document).on('click', '.secretaryOfLabor', function(){
            if ($(this).val() == 'yes') {
                $('.secretaryOfLaborSec').show();
                $('.secretaryOfLaborPera').show();
            } else {
                $('.secretaryOfLaborSec').hide();
                $('.secretaryOfLaborSec > textarea').val('');
                $('.secretaryOfLaborPera').hide();
            }
        });

        $(document).on('click', '.foreignMedicalSchool', function(){
            if ($(this).val() == 'yes') {
                $('.foreignMedicalSchoolSec').show();
                $('.foreignMedicalSchoolPera').show();
            } else {
                $('.foreignMedicalSchoolSec').hide();
                $('.foreignMedicalSchoolSec > textarea').val('');
                $('.foreignMedicalSchoolPera').hide();
            }
        });

        $(document).on('click', '.credentialingOrg', function(){
            if ($(this).val() == 'yes') {
                $('.credentialingOrgSec').show();
                $('.credentialingOrgPera').show();
            } else {
                $('.credentialingOrgSec').hide();
                $('.credentialingOrgSec > textarea').val('');
                $('.credentialingOrgPera').hide();
            }
        });

        $(document).on('click', '.permanentlyIneligible', function(){
            if ($(this).val() == 'yes') {
                $('.permanentlyIneligibleSec').show();
                $('.permanentlyIneligiblePera').show();
            } else {
                $('.permanentlyIneligibleSec').hide();
                $('.permanentlyIneligibleSec > textarea').val('');
                $('.permanentlyIneligiblePera').hide();
            }
        });

        $(document).on('click', '.departedUS', function(){
            if ($(this).val() == 'yes') {
                $('.departedUSSec').show();
                $('.departedUSPera').show();
            } else {
                $('.departedUSSec').hide();
                $('.departedUSSec > textarea').val('');
                $('.departedUSPera').hide();
            }
        });

        $(document).on('click', '.practicePolygamy', function(){
            if ($(this).val() == 'yes') {
                $('.practicePolygamySec').show();
                $('.practicePolygamyPera').show();
            } else {
                $('.practicePolygamySec').hide();
                $('.practicePolygamySec > textarea').val('');
                $('.practicePolygamyPera').hide();
            }
        });

        $(document).on('click', '.frivolousApplication', function(){
            if ($(this).val() == 'yes') {
                $('.frivolousApplicationSec').show();
                $('.frivolousApplicationPera').show();
            } else {
                $('.frivolousApplicationSec').hide();
                $('.frivolousApplicationSec > textarea').val('');
                $('.frivolousApplicationPera').hide();
            }
        });

        $(document).on('click', '.misrepresentation', function(){
            if ($(this).val() == 'yes') {
                $('.misrepresentationSec').show();
                $('.misrepresentationPera').show();
            } else {
                $('.misrepresentationSec').hide();
                $('.misrepresentationSec > textarea').val('');
                $('.misrepresentationPera').hide();
            }
        });        

        $("#fianceAlienQuestion5").validate({
            rules: {
                avoiding_taxation: {
                    required: true,
                },
                explain_avoiding_taxation: {
                    required: true,
                },
                former_exchange_visitor: {
                    required: true,
                },
                explain_former_exchange_visitor: {
                    required: true,
                },                
                secretary_of_labor: {
                    required: true,
                },
                explain_secretary_of_labor: {
                    required: true,
                },
                foreign_medical_school: {
                    required: true,
                },
                explain_foreign_medical_school: {
                    required: true,
                },
                credentialing_org: {
                    required: true,
                },
                explain_credentialing_org: {
                    required: true,
                },
                permanently_ineligible: {
                    required: true,
                },
                explain_permanently_ineligible: {
                    required: true,
                },
                departed_us: {
                    required: true,
                },
                explain_departed_us: {
                    required: true,
                },
                practice_polygamy: {
                    required: true,
                },
                cxplain_practice_polygamy: {
                    required: true,
                },
                frivolous_application: {
                    required: true,
                },
                explain_frivolous_application: {
                    required: true,
                },
                misrepresentation: {
                    required: true,
                },
                explain_misrepresentation: {
                    required: true,
                },                
            },
            messages: {
               avoiding_taxation: "Please choose option!",
               explain_avoiding_taxation: "Please explain!",
               former_exchange_visitor: "Please choose option!",
               explain_former_exchange_visitor: "Please explain!",
               significant_role: "Please choose option!",
               explain_significant_role: "Please explain!",
               secretary_of_labor: "Please choose option!",
               explain_secretary_of_labor: "Please explain!",
               foreign_medical_school: "Please choose option!",
               explain_foreign_medical_school: "Please explain!",
               credentialing_org: "Please choose option!",
               explain_credentialing_org: "Please explain!",
               permanently_ineligible: "Please choose option!",
               explain_permanently_ineligible: "Please explain!",
               departed_us: "Please choose option!",
               explain_departed_us: "Please explain!",
               practice_polygamy: "Please choose option!",
               cxplain_practice_polygamy: "Please explain!",
               frivolous_application: "Please choose option!",
               explain_frivolous_application: "Please explain!",
               misrepresentation: "Please choose option!",
               explain_misrepresentation: "Please explain!",              
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "avoiding_taxation" || element.attr("name") == "former_exchange_visitor" || element.attr("name") == "significant_role" || element.attr("name") == "secretary_of_labor" || element.attr("name") == "foreign_medical_school" || element.attr("name") == "credentialing_org" || element.attr("name") == "permanently_ineligible" || element.attr("name") == "departed_us" || element.attr("name") == "practice_polygamy" || element.attr("name") == "frivolous_application" || element.attr("name") == "misrepresentation") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                $('#fianceQuestion4B5n').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('fianceAlienQuestion5') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            window.location.href = "{{ route('user.page', 'progress') }}";  
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