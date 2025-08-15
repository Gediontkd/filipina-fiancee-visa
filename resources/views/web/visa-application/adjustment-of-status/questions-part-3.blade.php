<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentQusPart3'), 'id' => 'adjustmentQusPart3']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>All questions are about the Alien (foreign citizen).</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever recruited members or asked for money or things of value for a group or organization that did any of the activities (Committed, threatened to commit, attempted to commit,conspired to commit, incited, endorsed, advocated, planned, or prepared any of the following: hijacking, sabotage, kidnapping, political assassination, or use of a weapon or explosive to harm another individual or cause substantial damage to property)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('substantial', 'no', @$step->detail['substantial'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'foreignNatSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('substantial', 'yes', @$step->detail['substantial'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'foreignNatSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="substantial"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 foreignNatSec" style="display: {{ @$step->detail['substantial'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('substantial_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('substantial_text', @$step->detail['substantial_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever provided money, a thing of value, services or labor, of any other assistance or support for any of the activities (Committed, threatened to commit, attempted to commit,conspired to commit, incited, endorsed, advocated, planned, or prepared any of the following: hijacking, sabotage, kidnapping, political assassination, or use of a weapon or explosive to harm another individual or cause substantial damage to property)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('harm', 'no', @$step->detail['harm'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'harmSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('harm', 'yes', @$step->detail['harm'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'harmSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="prostitution"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 harmSec" style="display: {{ @$step->detail['harm'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('harm_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('harm_text', @$step->detail['harm_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>       
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever provided money, a thing of value, services or labor, or any other assistance or support for an individual, group, or organization who did any of the activities(Committed, threatened to commit, attempted to commit,conspired to commit, incited, endorsed, advocated, planned, or prepared any of the following: hijacking, sabotage, kidnapping, political assassination, or use of a weapon or explosive to harm another individual or cause substantial damage to property)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('organization', 'no', @$step->detail['organization'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'organizationSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('organization', 'yes', @$step->detail['organization'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'organizationSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="organization"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 organizationSec" style="display: {{ @$step->detail['organization'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('organization_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('organization_text', @$step->detail['organization_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever received any type of military, paramilitary, or weapons training?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('paramilitary', 'no', @$step->detail['paramilitary'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'paramilitarySec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('paramilitary', 'yes', @$step->detail['paramilitary'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'paramilitarySec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="paramilitary"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 paramilitarySec" style="display: {{ @$step->detail['paramilitary'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('paramilitary_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('paramilitary_text', @$step->detail['paramilitary_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you intend to engage in any of the activities listed in any part of the above questions?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('engage', 'no', @$step->detail['engage'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'engageSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('engage', 'yes', @$step->detail['engage'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'engageSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="engage"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 engageSec" style="display: {{ @$step->detail['engage'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('engage_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('engage_text', @$step->detail['engage_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you the spouse or child of an individual who ever committed, threatened to commit, attempted to commit, conspired to commit, incited, endorsed, advocated, planned, or prepared any of the following: hijacking, sabotage, kidnapping, political assassination, or use of a weapon or explosive to harm another individual or cause substantial damage to property?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('incited', 'no', @$step->detail['incited'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'incitedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('incited', 'yes', @$step->detail['incited'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'incitedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="incited"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 incitedSec" style="display: {{ @$step->detail['incited'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('incited_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('incited_text', @$step->detail['incited_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you the spouse or child of an individual who ever participated in, or been a member or a representative of a group or organization that did any of the activities (committed, threatened to commit, attempted to commit, conspired to commit, incited, endorsed, advocated, planned, or prepared any of the following: hijacking, sabotage, kidnapping, political assassination, or use of a weapon or explosive to harm another individual or cause substantial damage to property)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('weapon', 'no', @$step->detail['weapon'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'weaponSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('weapon', 'yes', @$step->detail['weapon'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'weaponSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="weapon"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 weaponSec" style="display: {{ @$step->detail['weapon'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('weapon_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('weapon_text', @$step->detail['weapon_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you the spouse or child of an individual who ever recruited members, or asked for money or things of value for a group or organization that did any of the activities (committed, threatened to commit, attempted to commit, conspired to commit, incited, endorsed, advocated, planned, or prepared any of the following: hijacking, sabotage, kidnapping, political assassination, or use of a weapon or explosive to harm another individual or cause substantial damage to property)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('hijacking', 'no', @$step->detail['hijacking'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'hijackingSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('hijacking', 'yes', @$step->detail['hijacking'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'hijackingSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="hijacking"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 hijackingSec" style="display: {{ @$step->detail['hijacking'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('hijacking_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('hijacking_text', @$step->detail['hijacking_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you the spouse or child of an individual who ever provided money, a thing of value, services or labor, or any other assistance or support for any of the activities (committed, threatened to commit, attempted to commit, conspired to commit, incited, endorsed, advocated, planned, or prepared any of the following: hijacking, sabotage, kidnapping, political assassination, or use of a weapon or explosive to harm another individual or cause substantial damage to property)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('threatened', 'no', @$step->detail['threatened'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'threatenedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('threatened', 'yes', @$step->detail['threatened'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'threatenedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="threatened"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 threatenedSec" style="display: {{ @$step->detail['threatened'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('threatened_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('threatened_text', @$step->detail['threatened_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you the spouse or child of an individual who ever provided money, a thing of value, services or labor, or any other assistance or support to an individual, group, or organization who did any of the activities (committed, threatened to commit, attempted to commit, conspired to commit, incited, endorsed, advocated, planned, or prepared any of the following: hijacking, sabotage, kidnapping, political assassination, or use of a weapon or explosive to harm another individual or cause substantial damage to property)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('sabotage', 'no', @$step->detail['sabotage'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'sabotageSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('sabotage', 'yes', @$step->detail['sabotage'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'sabotageSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="sabotage"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 sabotageSec" style="display: {{ @$step->detail['sabotage'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('sabotage_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('sabotage_text', @$step->detail['sabotage_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you the spouse or child of an individual who ever received any type of military, paramilitary, or weapons training from a group or organization that did any of the activities(committed, threatened to commit, attempted to commit, conspired to commit, incited, endorsed, advocated, planned, or prepared any of the following: hijacking, sabotage, kidnapping, political assassination, or use of a weapon or explosive to harm another individual or cause substantial damage to property)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('explosive', 'no', @$step->detail['explosive'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'explosiveSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('explosive', 'yes', @$step->detail['explosive'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'explosiveSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="explosive"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 explosiveSec" style="display: {{ @$step->detail['explosive'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('explosive_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('explosive_text', @$step->detail['explosive_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever assisted or participated in selling, providing, or transporting weapons to any person who, to your knowledge, used them against another person?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('transporting', 'no', @$step->detail['transporting'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'transportingSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('transporting', 'yes', @$step->detail['transporting'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'transportingSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="transporting"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 transportingSec" style="display: {{ @$step->detail['transporting'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('transporting_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('transporting_text', @$step->detail['transporting_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever worked, volunteered, or otherwise served in any prison, jail, prison camp, detention facility, labor camp, or any other situation that involved detaining persons?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('volunteered', 'no', @$step->detail['volunteered'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'volunteeredSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('volunteered', 'yes', @$step->detail['volunteered'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'volunteeredSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="volunteered"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 volunteeredSec" style="display: {{ @$step->detail['volunteered'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('volunteered_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('volunteered_text', @$step->detail['volunteered_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been a member of, assisted, or participated in any group, unit, or organization of any kind in which you or other persons used any type of weapon against any person or threatened to do so?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('kind', 'no', @$step->detail['kind'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'kindSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('kind', 'yes', @$step->detail['kind'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'kindSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="kind"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 kindSec" style="display: {{ @$step->detail['kind'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('kind_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('kind_text', @$step->detail['kind_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever served in, been a member of, assisted, or participated in any military unit, paramilitary unit, police unit, self-defense unit, vigilante unit, rebel group, guerrilla group, militia, insurgent organization, or any other armed group?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('guerrilla', 'no', @$step->detail['guerrilla'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'guerrillaSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('guerrilla', 'yes', @$step->detail['guerrilla'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'guerrillaSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="guerrilla"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 guerrillaSec" style="display: {{ @$step->detail['guerrilla'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('guerrilla_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('guerrilla_text', @$step->detail['guerrilla_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever been a member of, or in any way affiliated with, the Communist party or any other totalitarian party (in the United States or abroad)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('affiliated', 'no', @$step->detail['affiliated'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'affiliatedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('affiliated', 'yes', @$step->detail['affiliated'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'affiliatedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="affiliated"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 affiliatedSec" style="display: {{ @$step->detail['affiliated'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('affiliated_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('affiliated_text', @$step->detail['affiliated_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>During the period from March 23, 1933 to May 8, 1945, did you ever order, incite, assist, or otherwise participate in the persecution of any person because of race, religion, national origin, or political opinion, in association with either the Nazi government of Germany or any organization or government associated or allied with the Nazi government of Germany?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('period', 'no', @$step->detail['period'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'periodSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('period', 'yes', @$step->detail['period'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'periodSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="period"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 periodSec" style="display: {{ @$step->detail['period'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('period_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('period_text', @$step->detail['period_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever ordered, incited, called for, committed, assisted, helped with, or otherwise participated in any acts involving torture or genocide?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('genocide', 'no', @$step->detail['genocide'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'genocideSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('genocide', 'yes', @$step->detail['genocide'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'genocideSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="genocide"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 genocideSec" style="display: {{ @$step->detail['genocide'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('genocide_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('genocide_text', @$step->detail['genocide_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever ordered, incited, called for, committed, assisted, helped with, or otherwise participated in killing any person?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('killing', 'no', @$step->detail['killing'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'killingSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('killing', 'yes', @$step->detail['killing'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'killingSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="killing"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 killingSec" style="display: {{ @$step->detail['killing'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('killing_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('killing_text', @$step->detail['killing_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever ordered, incited, called for, committed, assisted, helped with, or otherwise participated in intentionally and severely injuring any person?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('intentionally', 'no', @$step->detail['intentionally'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'intentionallySec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('intentionally', 'yes', @$step->detail['intentionally'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'intentionallySec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="intentionally"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 intentionallySec" style="display: {{ @$step->detail['intentionally'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('intentionally_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('intentionally_text', @$step->detail['intentionally_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>                                 
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'questions-part-3') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'questions-part-4') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'questions-part-2'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'questions-part-4'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentQusPart3Btn',
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
        
        $("#adjustmentQusPart3").validate({
            rules: {
                substantial: {
                    required: true,
                },
                substantial_text: {
                    required: true,
                },
                harm: {
                    required: true,
                },
                harm_text: {
                    required: true,
                },
                organization: {
                    required: true,
                },
                organization_text: {
                    required: true,
                },
                paramilitary: {
                    required: true,
                },
                paramilitary_text: {
                    required: true,
                },
                engage: {
                    required: true,
                },
                engage_text: {
                    required: true,
                },
                incited: {
                    required: true,
                },
                incited_text: {
                    required: true,
                },
                weapon: {
                    required: true,
                },
                weapon_text: {
                    required: true,
                },
                hijacking: {
                    required: true,
                },
                hijacking_text: {
                    required: true,
                },
                threatened: {
                    required: true,
                },
                threatened_text: {
                    required: true,
                },
                sabotage: {
                    required: true,
                },
                sabotage_text: {
                    required: true,
                },
                explosive: {
                    required: true,
                },
                explosive_text: {
                    required: true,
                },
                transporting: {
                    required: true,
                },
                transporting_text: {
                    required: true,
                },
                volunteered: {
                    required: true,
                },
                volunteered_text: {
                    required: true,
                },
                kind: {
                    required: true,
                },
                kind_text: {
                    required: true,
                },
                guerrilla: {
                    required: true,
                },
                guerrilla_text: {
                    required: true,
                },
                affiliated: {
                    required: true,
                },
                affiliated_text: {
                    required: true,
                },
                period: {
                    required: true,
                },
                period_text: {
                    required: true,
                },
                genocide: {
                    required: true,
                },
                genocide_text: {
                    required: true,
                },
                killing: {
                    required: true,
                },
                killing_text: {
                    required: true,
                },
                intentionally: {
                    required: true,
                },
                intentionally_text: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                var name = element.attr("name");
                if (name == "substantial" || name == "harm" || name == "organization" || name == "paramilitary" || name == "engage" || name == "incited" || name == "weapon" || name == "hijacking" || name == "threatened" || name == "sabotage" || name == "explosive" || name == "transporting" || name == "volunteered" || name == "kind" || name == "guerrilla" || name == "affiliated" || name == "period" || name == "genocide" || name == "killing" || name == "intentionally") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               substantial: "Please choose option!",               
               substantial_text: "Please enter detail!",
               harm: "Please choose option!",               
               harm_text: "Please enter detail!",
               organization: "Please choose option!",               
               organization_text: "Please enter detail!", 
               paramilitary: "Please choose option!",               
               paramilitary_text: "Please enter detail!",
               engage: "Please choose option!",               
               engage_text: "Please enter detail!",
               incited: "Please choose option!",               
               incited_text: "Please enter detail!", 
               weapon: "Please choose option!",               
               weapon_text: "Please enter detail!", 
               hijacking: "Please choose option!",               
               hijacking_text: "Please enter detail!",
               killing: "Please choose option!",               
               killing_text: "Please enter detail!",
               sabotage: "Please choose option!",               
               sabotage_text: "Please enter detail!",
               explosive: "Please choose option!",               
               explosive_text: "Please enter detail!", 
               transporting: "Please choose option!",               
               transporting_text: "Please enter detail!",
               volunteered: "Please choose option!",               
               volunteered_text: "Please enter detail!",
               kind: "Please choose option!",               
               kind_text: "Please enter detail!", 
               guerrilla: "Please choose option!",               
               guerrilla_text: "Please enter detail!",
               affiliated: "Please choose option!",               
               affiliated_text: "Please enter detail!", 
               period: "Please choose option!",               
               period_text: "Please enter detail!", 
               genocide: "Please choose option!",               
               genocide_text: "Please enter detail!",
               threatened: "Please choose option!",               
               threatened_text: "Please enter detail!", 
               intentionally: "Please choose option!",               
               intentionally_text: "Please enter detail!",               
            },
            submitHandler: function(form) {
                $('#adjustmentQusPart3Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentQusPart3') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.questions-part-3').removeClass('active');
                            $('.questions-part-4').addClass('active');
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