<!-- resources\views\web\visa-application\adjustment-of-status\questions-part-4.blade.php -->
<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentQusPart4'), 'id' => 'adjustmentQusPart4']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>All questions are about the Alien (foreign citizen).</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever ordered, assistance, called for, committed, assisted, helped with, or otherwise participated in engaging in any kind of sexual contact or relations with any person who did not consent or was unable to consent, or was being forced or threatened?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('sexual', 'no', @$step->detail['sexual'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'foreignNatSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('sexual', 'yes', @$step->detail['sexual'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'foreignNatSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="sexual"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 foreignNatSec" style="display: {{ @$step->detail['sexual'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('sexual_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('sexual_text', @$step->detail['sexual_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever ordered, incited, called for, committed, assisted, helped with, or otherwise participated in limiting or denying any person's ability to exercise religious beliefs?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('denying', 'no', @$step->detail['denying'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'denyingSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('denying', 'yes', @$step->detail['denying'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'denyingSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="prostitution"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 denyingSec" style="display: {{ @$step->detail['denying'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('denying_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('denying_text', @$step->detail['denying_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>       
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever recruited, enlisted, or conscripted, or used any person under 15 years of age to serve in or help an armed force or group?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('armed', 'no', @$step->detail['armed'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'armedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('armed', 'yes', @$step->detail['armed'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'armedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="armed"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 armedSec" style="display: {{ @$step->detail['armed'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('armed_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('armed_text', @$step->detail['armed_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever used any person under 15 years of age to take part in hostilities, or to help or provide services to people in combat?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('hostilities', 'no', @$step->detail['hostilities'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'hostilitiesSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('hostilities', 'yes', @$step->detail['hostilities'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'hostilitiesSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="hostilities"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 hostilitiesSec" style="display: {{ @$step->detail['hostilities'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('hostilities_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('hostilities_text', @$step->detail['hostilities_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you received public assistance in the United States from any source, including the U.S. Government or any state, county, city, or municipality (other than emergency medical treatment)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('municipality', 'no', @$step->detail['municipality'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input',
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('municipality', 'yes', @$step->detail['municipality'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input',
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="municipality"></div>
                        </div>
                    </div>
                </div>               
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you likely to receive public assistance in the future in the United States from any source, including the U.S. Government or any state, county, city, or municipality (other than emergency medical treatment)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('assistance', 'no', @$step->detail['assistance'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'assistanceSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('assistance', 'yes', @$step->detail['assistance'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'assistanceSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="assistance"></div>
                        </div>
                    </div>
                </div>                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever failed or refused to attend or to remain in attendance at any removal proceeding filed against you on or after April 1, 1997?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('proceeding', 'no', @$step->detail['proceeding'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'proceedingSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('proceeding', 'yes', @$step->detail['proceeding'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'proceedingSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="proceeding"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 proceedingSec" style="display: {{ @$step->detail['proceeding'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('proceeding_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('proceeding_text', @$step->detail['proceeding_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>If your answer to the previous question is YES. Do you believe you had reasonable cause?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('reasonable', 'no', @$step->detail['reasonable'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'reasonableSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('reasonable', 'yes', @$step->detail['reasonable'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'reasonableSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="reasonable"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 reasonableSec" style="display: {{ @$step->detail['reasonable'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('reasonable_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('reasonable_text', @$step->detail['reasonable_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever submitted fraudulent or counterfeit documentation to any U.S. Government official to obtain or attempt to obtain any immigration benefit, including a visa or entry into the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('counterfeit', 'no', @$step->detail['counterfeit'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'counterfeitSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('counterfeit', 'yes', @$step->detail['counterfeit'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'counterfeitSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="counterfeit"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 counterfeitSec" style="display: {{ @$step->detail['counterfeit'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('counterfeit_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('counterfeit_text', @$step->detail['counterfeit_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever lied about, concealed, or misrepresented any information on an application or petition to obtain a visa, other documentation required for entry into the United States, admission to the United States, or any other kind of immigration benefit?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('misrepresented', 'no', @$step->detail['misrepresented'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'misrepresentedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('misrepresented', 'yes', @$step->detail['misrepresented'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'misrepresentedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="misrepresented"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 misrepresentedSec" style="display: {{ @$step->detail['misrepresented'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('misrepresented_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('misrepresented_text', @$step->detail['misrepresented_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever falsely claimed to be a U.S. citizen(in writing or any other way)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('claimed', 'no', @$step->detail['claimed'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'claimedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('claimed', 'yes', @$step->detail['claimed'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'claimedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="claimed"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 claimedSec" style="display: {{ @$step->detail['claimed'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('claimed_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('claimed_text', @$step->detail['claimed_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been a stowaway on a vessel or aircraft arriving in the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('stowaway', 'no', @$step->detail['stowaway'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'stowawaySec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('stowaway', 'yes', @$step->detail['stowaway'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'stowawaySec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="stowaway"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 stowawaySec" style="display: {{ @$step->detail['stowaway'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('stowaway_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('stowaway_text', @$step->detail['stowaway_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever knowingly encouraged, induced, assisted, abetted, or aided any foreign national to enter or to try to enter the United States illegally (alien smuggling)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('smuggling', 'no', @$step->detail['smuggling'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'smugglingSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('smuggling', 'yes', @$step->detail['smuggling'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'smugglingSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="smuggling"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 smugglingSec" style="display: {{ @$step->detail['smuggling'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('smuggling_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('smuggling_text', @$step->detail['smuggling_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you under a final order of civil penalty for violating INA section 274C for use of fraudulent documents?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('fraudulent', 'no', @$step->detail['fraudulent'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'fraudulentSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('fraudulent', 'yes', @$step->detail['fraudulent'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'fraudulentSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="fraudulent"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 fraudulentSec" style="display: {{ @$step->detail['fraudulent'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('fraudulent_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('fraudulent_text', @$step->detail['fraudulent_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been excluded, deported, or removed from the United States or have you ever departed the United States on your own after having been ordered excluded, deported, or removed from the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('excluded', 'no', @$step->detail['excluded'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'excludedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('excluded', 'yes', @$step->detail['excluded'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'excludedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="excluded"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 excludedSec" style="display: {{ @$step->detail['excluded'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('excluded_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('excluded_text', @$step->detail['excluded_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever entered the United States without being inspected and admitted or paroled?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('paroled', 'no', @$step->detail['paroled'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'paroledSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('paroled', 'yes', @$step->detail['paroled'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'paroledSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="paroled"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 paroledSec" style="display: {{ @$step->detail['paroled'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('paroled_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('paroled_text', @$step->detail['paroled_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Since April 1, 1997, have you been unlawfully present in the United States for more than 180 days but less than a year, and then departed the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('unlawfully', 'no', @$step->detail['unlawfully'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'unlawfullySec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('unlawfully', 'yes', @$step->detail['unlawfully'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'unlawfullySec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="unlawfully"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 unlawfullySec" style="display: {{ @$step->detail['unlawfully'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('unlawfully_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('unlawfully_text', @$step->detail['unlawfully_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Since April 1, 1997, have you been unlawfully present in the United States for one year or more and then departed the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('departed_us', 'no', @$step->detail['departed_us'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'departed_usSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('departed_us', 'yes', @$step->detail['departed_us'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'departed_usSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="departed_us"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 departed_usSec" style="display: {{ @$step->detail['departed_us'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('departed_us_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('departed_us_text', @$step->detail['departed_us_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Since April 1, 1997, have you ever reentered or attempted to reenter the United States without being inspected and admitted or paroled after having been unlawfully present in the United States for more than one year in the aggregate?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('reentered', 'no', @$step->detail['reentered'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'reenteredSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('reentered', 'yes', @$step->detail['reentered'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'reenteredSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="reentered"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 reenteredSec" style="display: {{ @$step->detail['reentered'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('reentered_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('reentered_text', @$step->detail['reentered_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Since April 1, 1997, have you ever reentered or attempted to reenter the United States without being inspected and admitted or paroled after having been deported, excluded, or removed from the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('inspected', 'no', @$step->detail['inspected'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'inspectedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('inspected', 'yes', @$step->detail['inspected'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'inspectedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="inspected"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 inspectedSec" style="display: {{ @$step->detail['inspected'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('inspected_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('inspected_text', @$step->detail['inspected_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>                                 
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'questions-part-4') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'questions-part-5') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'questions-part-3'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'questions-part-5'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentQusPart4Btn',
            'type' => 'submit',
        ]) }}
    {{ Form::close() }}
    <script type="text/javascript" src="{{asset('assets/js/date-range.js')}}"></script>
    <script type="text/javascript">        
        $(document).on('change', '.showTextArea', function(){
            var textArea = $(this).data('text');
            switch ($(this).val()) {
                case 'yes':
                    $('.'+textArea).show();                  
                break;         
                case 'no':
                    $('.'+textArea).hide();
                break;
            }
        });
        
        $("#adjustmentQusPart4").validate({
            rules: {
                sexual: {
                    required: true,
                },
                sexual_text: {
                    required: true,
                },
                denying: {
                    required: true,
                },
                denying_text: {
                    required: true,
                },
                armed: {
                    required: true,
                },
                armed_text: {
                    required: true,
                },
                hostilities: {
                    required: true,
                },
                hostilities_text: {
                    required: true,
                },
                municipality: {
                    required: true,
                },
                assistance: {
                    required: true,
                },
                proceeding: {
                    required: true,
                },
                proceeding_text: {
                    required: true,
                },
                reasonable: {
                    required: true,
                },
                reasonable_text: {
                    required: true,
                },
                counterfeit: {
                    required: true,
                },
                counterfeit_text: {
                    required: true,
                },
                misrepresented: {
                    required: true,
                },
                misrepresented_text: {
                    required: true,
                },
                claimed: {
                    required: true,
                },
                claimed_text: {
                    required: true,
                },
                stowaway: {
                    required: true,
                },
                stowaway_text: {
                    required: true,
                },
                smuggling: {
                    required: true,
                },
                smuggling_text: {
                    required: true,
                },
                fraudulent: {
                    required: true,
                },
                fraudulent_text: {
                    required: true,
                },
                excluded: {
                    required: true,
                },
                excluded_text: {
                    required: true,
                },
                paroled: {
                    required: true,
                },
                paroled_text: {
                    required: true,
                },
                unlawfully: {
                    required: true,
                },
                unlawfully_text: {
                    required: true,
                },
                departed_us: {
                    required: true,
                },
                departed_us_text: {
                    required: true,
                },
                reentered: {
                    required: true,
                },
                reentered_text: {
                    required: true,
                },
                inspected: {
                    required: true,
                },
                inspected_text: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                var name = element.attr("name");
                if (name == "sexual" || name == "denying" || name == "armed" || name == "hostilities" || name == "municipality" || name == "assistance" || name == "proceeding" || name == "reasonable" || name == "counterfeit" || name == "misrepresented" || name == "claimed" || name == "stowaway" || name == "smuggling" || name == "fraudulent" || name == "excluded" || name == "paroled" || name == "unlawfully" || name == "departed_us" || name == "reentered" || name == "inspected") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               sexual: "Please choose option!",               
               sexual_text: "Please enter detail!",
               denying: "Please choose option!",               
               denying_text: "Please enter detail!",
               armed: "Please choose option!",               
               armed_text: "Please enter detail!", 
               hostilities: "Please choose option!",               
               hostilities_text: "Please enter detail!",
               municipality: "Please choose option!",               
               assistance: "Please choose option!",               
               proceeding: "Please choose option!",               
               proceeding_text: "Please enter detail!", 
               reasonable: "Please choose option!",               
               reasonable_text: "Please enter detail!",
               reentered: "Please choose option!",               
               reentered_text: "Please enter detail!",
               misrepresented: "Please choose option!",               
               misrepresented_text: "Please enter detail!",
               claimed: "Please choose option!",               
               claimed_text: "Please enter detail!", 
               stowaway: "Please choose option!",               
               stowaway_text: "Please enter detail!",
               smuggling: "Please choose option!",               
               smuggling_text: "Please enter detail!",
               fraudulent: "Please choose option!",               
               fraudulent_text: "Please enter detail!", 
               excluded: "Please choose option!",               
               excluded_text: "Please enter detail!",
               paroled: "Please choose option!",               
               paroled_text: "Please enter detail!", 
               unlawfully: "Please choose option!",               
               unlawfully_text: "Please enter detail!", 
               departed_us: "Please choose option!",               
               departed_us_text: "Please enter detail!",
               counterfeit: "Please choose option!",               
               counterfeit_text: "Please enter detail!", 
               inspected: "Please choose option!",               
               inspected_text: "Please enter detail!",               
            },
            submitHandler: function(form) {
                $('#adjustmentQusPart4Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentQusPart4') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.questions-part-4').removeClass('active');
                            $('.questions-part-5').addClass('active');
                            $('.adjustmentStatusForm').html(data.data);                    
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