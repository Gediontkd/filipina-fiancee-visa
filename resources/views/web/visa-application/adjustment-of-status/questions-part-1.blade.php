<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentQusPart1'), 'id' => 'adjustmentQusPart1']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>All questions are about the Alien (foreign citizen).</h2>
                <p>Do not write your answers in all capital letters and never use any type of non-English characters.</p>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been denied admission to the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('admission', 'no', @$step->detail['admission'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'admissionSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('admission', 'yes', @$step->detail['admission'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'admissionSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="admission"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 admissionSec" style="display: {{ @$step->detail['admission'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('admission_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('admission_text', @$step->detail['admission_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>   
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been denied a visa to the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('denied_us', 'no', @$step->detail['denied_us'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'deniedUS'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('denied_us', 'yes', @$step->detail['denied_us'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'deniedUS'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="denied_us"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 deniedUS" style="display: {{ @$step->detail['denied_us'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('denied_us_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('denied_us_text', @$step->detail['denied_us_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever worked in the United States without authorization?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('worked_in_us', 'no', @$step->detail['worked_in_us'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'workedInUS'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('worked_in_us', 'yes', @$step->detail['worked_in_us'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'workedInUS'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="worked_in_us"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 workedInUS" style="display: {{ @$step->detail['worked_in_us'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('worked_in_us_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('worked_in_us_text', @$step->detail['worked_in_us_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever violated the terms or conditions of your nonimmigrant status?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('violated', 'no', @$step->detail['violated'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'violated'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('violated', 'yes', @$step->detail['violated'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'violated'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="violated"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 violated" style="display: {{ @$step->detail['violated'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('violated_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('violated_text', @$step->detail['violated_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you presently or have you ever been in removal, exclusion, rescission, or deportation proceedings?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('presently', 'no', @$step->detail['presently'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'presently'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('presently', 'yes', @$step->detail['presently'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'presently'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="presently"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 presently" style="display: {{ @$step->detail['presently'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('presently_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('presently_text', @$step->detail['presently_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever held a visa for diplomats or foreign government officials, such as an A, G, or NATO visa?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('diplomats', 'no', @$step->detail['diplomats'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'diplomats'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('diplomats', 'yes', @$step->detail['diplomats'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'diplomats'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="diplomats"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 diplomats" style="display: {{ @$step->detail['diplomats'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('diplomats_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('diplomats_text', @$step->detail['diplomats_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever held a crewmember or transit visa, such as a C, D, or C1/D visa?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('crewmember', 'no', @$step->detail['crewmember'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'crewmember'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('crewmember', 'yes', @$step->detail['crewmember'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'crewmember'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="crewmember"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 crewmember" style="display: {{ @$step->detail['crewmember'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('crewmember_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('crewmember_text', @$step->detail['crewmember_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>   
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been issued a final order of exclusion, deportation, or removal?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('deportation', 'no', @$step->detail['deportation'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'deportation'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('deportation', 'yes', @$step->detail['deportation'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'deportation'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="deportation"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 deportation" style="display: {{ @$step->detail['deportation'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('deportation_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('deportation_text', @$step->detail['deportation_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>   
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever had a prior final order of exclusion, deportation, or removal reinstated?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('reinstated', 'no', @$step->detail['reinstated'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'reinstated'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('reinstated', 'yes', @$step->detail['reinstated'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'reinstated'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="reinstated"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 reinstated" style="display: {{ @$step->detail['reinstated'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('reinstated_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('reinstated_text', @$step->detail['reinstated_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever held lawful permanent resident status which was later rescinded?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('rescinded', 'no', @$step->detail['rescinded'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'rescinded'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('rescinded', 'yes', @$step->detail['rescinded'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'rescinded'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="rescinded"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 rescinded" style="display: {{ @$step->detail['rescinded'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('rescinded_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('rescinded_text', @$step->detail['rescinded_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>   
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been granted voluntary departure by an immigration officer or an immigration judge but failed to depart within the allotted time?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('allotted', 'no', @$step->detail['allotted'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'allotted'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('allotted', 'yes', @$step->detail['allotted'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'allotted'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="allotted"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 allotted" style="display: {{ @$step->detail['allotted'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('allotted_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('allotted_text', @$step->detail['allotted_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>     
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever applied for any kind of relief or protection from removal, exclusion, or deportation?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('relief', 'no', @$step->detail['relief'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'relief'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('relief', 'yes', @$step->detail['relief'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'relief'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="relief"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 relief" style="display: {{ @$step->detail['relief'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('relief_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('relief_text', @$step->detail['relief_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been a J nonimmigrant exchange visitor who was subject to the two-year foreign residence requirement?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('nonimmigrant', 'no', @$step->detail['nonimmigrant'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'nonimmigrant'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('nonimmigrant', 'yes', @$step->detail['nonimmigrant'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'nonimmigrant'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="nonimmigrant"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 nonimmigrant" style="display: {{ @$step->detail['nonimmigrant'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('nonimmigrant_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('nonimmigrant_text', @$step->detail['nonimmigrant_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>   
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you complied with the foreign residence requirement?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('complied', 'no', @$step->detail['complied'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'complied'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('complied', 'yes', @$step->detail['complied'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'complied'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="complied"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 complied" style="display: {{ @$step->detail['complied'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('complied_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('complied_text', @$step->detail['complied_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>    
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you been granted a waiver or has Department of State issued a favorable waiver recommendation letter for you?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('recommendation', 'no', @$step->detail['recommendation'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'recommendation'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('recommendation', 'yes', @$step->detail['recommendation'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'recommendation'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="recommendation"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 recommendation" style="display: {{ @$step->detail['recommendation'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('recommendation_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('recommendation_text', @$step->detail['recommendation_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been arrested, cited, charged, or detained for any reason by any law enforcement official(including but not limited to any U.S. immigration official or any official of the U.S armed forces or U.S. Coast Guard)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('arrested', 'no', @$step->detail['arrested'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'arrested'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('arrested', 'yes', @$step->detail['arrested'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'arrested'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="arrested"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 arrested" style="display: {{ @$step->detail['arrested'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('arrested_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('arrested_text', @$step->detail['arrested_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Did you enter the United States lawfully through a U.S. port of entry and were you inspected and admitted or paroled after inspection by an immigration officer?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('lawfully', 'no', @$step->detail['lawfully'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input lawfully',
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('lawfully', 'yes', @$step->detail['lawfully'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input lawfully',
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="lawfully"></div>
                        </div>
                    </div>
                </div>
                <span class="lawfullyYes text-danger" style="display:{{ @$step->detail['lawfully'] == 'yes' ? 'block' : 'none' }};">Note: If you answered “Yes,” you MUST provide evidence of your lawful entry.</span>
                <div class="col-md-12 mb-4 lawfullyNo" style="display: {{ @$step->detail['lawfully'] == 'no' ? 'block' : 'none' }};">
                    {{ Form::label('lawfully_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('lawfully_text', @$step->detail['lawfully_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>     
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever committed a crime of any kind(even if you were not arrested, cited, charged with, or tried for that crime)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('committed', 'no', @$step->detail['committed'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'committed'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('committed', 'yes', @$step->detail['committed'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'committed'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="committed"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 committed" style="display: {{ @$step->detail['committed'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('committed_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('committed_text', @$step->detail['committed_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever plead guilty to or been convicted of a crime or offence(even if the violation was subsequently expunged or sealed by a court, or if you were granted a pardon, amnesty, a rehabilitation decree, or other act of clemency)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('subsequently', 'no', @$step->detail['subsequently'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'subsequently'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('subsequently', 'yes', @$step->detail['subsequently'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'subsequently'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="subsequently"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 subsequently" style="display: {{ @$step->detail['subsequently'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('subsequently_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('subsequently_text', @$step->detail['subsequently_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been ordered punished by a judge or had conditions imposed on you that restrained your liberty (such as a prison sentence, suspended sentence, house arrest, parole, alternative sentencing, drug or alcohol treatment, rehabilitative programs or classes, probation, or community service)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('punished', 'no', @$step->detail['punished'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'punished'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('punished', 'yes', @$step->detail['punished'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'punished'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="punished"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 punished" style="display: {{ @$step->detail['punished'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('punished_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('punished_text', @$step->detail['punished_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been a defendant or the accused in a criminal proceeding (including pre-trial diversion, deferred prosecution, deferred adjudication, or any withheld adjudication)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('defendant', 'no', @$step->detail['defendant'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'defendant'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('defendant', 'yes', @$step->detail['defendant'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'defendant'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="defendant"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 defendant" style="display: {{ @$step->detail['defendant'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('defendant_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('defendant_text', @$step->detail['defendant_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever violated(or attempted or conspired to violate) any controlled substance law or regulation of a state, the United States, or a foreign country?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('regulation', 'no', @$step->detail['regulation'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'regulation'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('regulation', 'yes', @$step->detail['regulation'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'regulation'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="regulation"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 regulation" style="display: {{ @$step->detail['regulation'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('regulation_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('regulation_text', @$step->detail['regulation_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been convicted of two or more offences(other than purely political offenses) for which the combined sentences to confinement were five years or more?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('offences', 'no', @$step->detail['offences'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'offences'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('offences', 'yes', @$step->detail['offences'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'offences'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="offences"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 offences" style="display: {{ @$step->detail['offences'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('offences_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('offences_text', @$step->detail['offences_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever illicitly(illegally) trafficked or benefited from the trafficking of any controlled substances, such as chemicals, illegal drugs, or narcotics?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('illicitly', 'no', @$step->detail['illicitly'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'illicitly'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('illicitly', 'yes', @$step->detail['illicitly'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'illicitly'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="illicitly"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 illicitly" style="display: {{ @$step->detail['illicitly'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('illicitly_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('illicitly_text', @$step->detail['illicitly_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever knowingly aided, abetted, assisted, conspired, or colluded in the illicit trafficking of any illegal narcotic or other controlled substances?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('knowingly', 'no', @$step->detail['knowingly'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'knowingly'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('knowingly', 'yes', @$step->detail['knowingly'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'knowingly'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="knowingly"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 knowingly" style="display: {{ @$step->detail['knowingly'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('knowingly_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('knowingly_text', @$step->detail['knowingly_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you hold VAWA self-petitioner status?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('vama', 'no', @$step->detail['vama'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input',
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('vama', 'yes', @$step->detail['vama'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input',
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="vama"></div>
                        </div>
                    </div>
                </div>                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you hold Victim of Qualifiying Criminal Activity(U nonimmigrant) status?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('victim', 'no', @$step->detail['victim'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input',
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('victim', 'yes', @$step->detail['victim'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input',
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="victim"></div>
                        </div>
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you hold Human trafficking victim(T nonimmigrant) status?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('trafficking', 'no', @$step->detail['trafficking'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input',
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('trafficking', 'yes', @$step->detail['trafficking'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input',
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="trafficking"></div>
                        </div>
                    </div>
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>I am filing this Form I-485 as a (select only one box):</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('i_485', 'principal', @$step->detail['i_485'] == 'principal' ? true : '', [
                                        'class' => 'custom-control-input',
                                    ])
                                }}
                                <span class="custom-control-label"></span> Principal applicant
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('i_485', 'derivative', @$step->detail['i_485'] == 'derivative' ? true : '', [
                                        'class' => 'custom-control-input',
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Derivative applicant
                            </label>
                            <div class="i_485"></div>
                        </div>
                    </div>
                </div>                   
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'questions-part-1') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'questions-part-2') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'sponsor-part-2'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'questions-part-3'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentQusPart1Btn',
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

        $(document).on('change', '.lawfully', function(){
            switch ($(this).val()) {
                case 'yes':
                    $('.lawfullyNo').hide();
                    $('.lawfullyYes').show();
                break;         
                case 'no':
                    $('.lawfullyYes').hide();                  
                    $('.lawfullyNo').show();                  
                break;
            }
        });

        $("#adjustmentQusPart1").validate({
            rules: {
                admission: {
                    required: true,
                },
                admission_text: {
                    required: true,
                },
                denied_us: {
                    required: true,
                },
                denied_us_text: {
                    required: true,
                }, 
                worked_in_us: {
                    required: true,
                },
                worked_in_us_text: {
                    required: true,
                }, 
                violated: {
                    required: true,
                },
                violated_text: {
                    required: true,
                },  
                presently: {
                    required: true,
                },
                presently_text: {
                    required: true,
                },
                diplomats: {
                    required: true,
                },
                diplomats_text: {
                    required: true,
                }, 
                crewmember: {
                    required: true,
                },
                crewmember_text: {
                    required: true,
                },  
                deportation: {
                    required: true,
                },
                deportation_text: {
                    required: true,
                },
                reinstated: {
                    required: true,
                },
                reinstated_text: {
                    required: true,
                },
                rescinded: {
                    required: true,
                },
                rescinded_text: {
                    required: true,
                },  
                allotted: {
                    required: true,
                },
                allotted_text: {
                    required: true,
                }, 
                relief: {
                    required: true,
                },
                relief_text: {
                    required: true,
                },
                nonimmigrant: {
                    required: true,
                },
                nonimmigrant_text: {
                    required: true,
                },
                complied: {
                    required: true,
                },
                complied_text: {
                    required: true,
                }, 
                recommendation: {
                    required: true,
                },
                recommendation_text: {
                    required: true,
                },
                arrested: {
                    required: true,
                },
                arrested_text: {
                    required: true,
                }, 
                lawfully: {
                    required: true,
                },
                lawfully_text: {
                    required: true,
                }, 
                committed: {
                    required: true,
                },
                committed_text: {
                    required: true,
                },  
                subsequently: {
                    required: true,
                },
                subsequently_text: {
                    required: true,
                }, 
                punished: {
                    required: true,
                },
                punished_text: {
                    required: true,
                }, 
                defendant: {
                    required: true,
                },
                defendant_text: {
                    required: true,
                }, 
                regulation: {
                    required: true,
                },
                regulation_text: {
                    required: true,
                }, 
                offences: {
                    required: true,
                },
                offences_text: {
                    required: true,
                }, 
                illicitly: {
                    required: true,
                },
                illicitly_text: {
                    required: true,
                }, 
                knowingly: {
                    required: true,
                },
                knowingly_text: {
                    required: true,
                }, 
                vama: {
                    required: true,
                },
                victim: {
                    required: true,
                },
                trafficking: {
                    required: true,
                },
                i_485: {
                    required: true,
                },                
            },
            errorPlacement: function (error, element) {
                if (element.attr("name") == "admission" || element.attr("name") == "denied_us" || element.attr("name") == "worked_in_us" || element.attr("name") == "violated" || element.attr("name") == "presently" || element.attr("name") == "diplomats" || element.attr("name") == "crewmember" || element.attr("name") == "deportation" || element.attr("name") == "reinstated" || element.attr("name") == "rescinded" || element.attr("name") == "allotted" || element.attr("name") == "relief" || element.attr("name") == "nonimmigrant" || element.attr("name") == "complied" || element.attr("name") == "recommendation" || element.attr("name") == "arrested" || element.attr("name") == "lawfully" || element.attr("name") == "committed" || element.attr("name") == "subsequently" || element.attr("name") == "punished" || element.attr("name") == "defendant" || element.attr("name") == "regulation" || element.attr("name") == "offences" || element.attr("name") == "illicitly" || element.attr("name") == "knowingly" || element.attr("name") == "vama" || element.attr("name") == "victim" || element.attr("name") == "trafficking" || element.attr("name") == "i_485") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               admission: "Please choose option!",
               admission_text: "Please enter detail!",
               denied_us: "Please choose option!",
               denied_us_text: "Please enter detail!",
               worked_in_us: "Please choose option!",
               worked_in_us_text: "Please enter detail!",
               violated: "Please choose option!",
               violated_text: "Please enter detail!",
               presently: "Please choose option!",
               presently_text: "Please enter detail!",
               diplomats: "Please choose option!",
               diplomats_text: "Please enter detail!",
               crewmember: "Please choose option!",
               crewmember_text: "Please enter detail!",
               deportation: "Please choose option!",
               deportation_text: "Please enter detail!",
               reinstated: "Please choose option!",
               reinstated_text: "Please enter detail!",
               rescinded: "Please choose option!",
               rescinded_text: "Please enter detail!",
               allotted: "Please choose option!",
               allotted_text: "Please enter detail!",
               relief: "Please choose option!",
               relief_text: "Please enter detail!",
               nonimmigrant: "Please choose option!",
               nonimmigrant_text: "Please enter detail!",
               complied: "Please choose option!",
               complied_text: "Please enter detail!",
               recommendation: "Please choose option!",
               recommendation_text: "Please enter detail!",
               arrested: "Please choose option!",
               arrested_text: "Please enter detail!",
               lawfully: "Please choose option!",
               lawfully_text: "Please enter detail!",
               committed: "Please choose option!",
               committed_text: "Please enter detail!",
               subsequently: "Please choose option!",
               subsequently_text: "Please enter detail!",
               punished: "Please choose option!",
               punished_text: "Please enter detail!",
               defendant: "Please choose option!",
               defendant_text: "Please enter detail!",
               regulation: "Please choose option!",
               regulation_text: "Please enter detail!",
               offences: "Please choose option!",
               offences_text: "Please enter detail!",
               illicitly: "Please choose option!",
               illicitly_text: "Please enter detail!",
               knowingly: "Please choose option!",
               knowingly_text: "Please enter detail!",
               vama: "Please choose option!",
               victim: "Please choose option!",
               trafficking: "Please choose option!",
               i_485: "Please choose option!",
            },
            submitHandler: function(form) {
                $('#adjustmentQusPart1Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentQusPart1') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.questions-part-1').removeClass('active');
                            $('.questions-part-2').addClass('active');
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