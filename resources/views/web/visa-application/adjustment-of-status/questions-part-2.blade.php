<div class="step-wizard">    
    {{ Form::open(['url' => route('adjustmentQusPart2'), 'id' => 'adjustmentQusPart2']) }}
        <div class="form-card">
            <div class="heading mb-30">
                <h2>All questions are about the Alien (foreign citizen).</h2>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you the spouse, son, or daughter of a foreign national who illicitly trafficked or aided (or otherwise abetted, assisted, conspired, or colluded) in the illicit trafficking of a controlled substance, such as chemicals, illegal drugs, or narcotics and you obtained, within the last five years, any financial or other benefit from the illegal activity of your spouse or parent, although you knew or reasonably should have known that the financial or other benefit resulted from the illicit activity of your spouse or parent?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('foreign_nat', 'no', @$step->detail['foreign_nat'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'foreignNatSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('foreign_nat', 'yes', @$step->detail['foreign_nat'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'foreignNatSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="foreign_nat"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 foreignNatSec" style="display: {{ @$step->detail['foreign_nat'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('foreign_nat_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('foreign_nat_text', @$step->detail['foreign_nat_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever engaged in prostitution or are you coming to the United States to engage in prostitution?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('prostitution', 'no', @$step->detail['prostitution'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'prostitutionSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('prostitution', 'yes', @$step->detail['prostitution'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'prostitutionSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="prostitution"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 prostitutionSec" style="display: {{ @$step->detail['prostitution'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('prostitution_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('prostitution_text', @$step->detail['prostitution_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>       
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever directly or indirectly procured (or attempted to procure) or imported prostitutes or persons for the purpose of prostitution?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('prostitutes', 'no', @$step->detail['prostitutes'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'prostitutesSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('prostitutes', 'yes', @$step->detail['prostitutes'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'prostitutesSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="prostitutes"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 prostitutesSec" style="display: {{ @$step->detail['prostitutes'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('prostitutes_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('prostitutes_text', @$step->detail['prostitutes_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever received any proceeds or money from prostitution?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('proceeds', 'no', @$step->detail['proceeds'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'proceedsSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('proceeds', 'yes', @$step->detail['proceeds'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'proceedsSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="proceeds"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 proceedsSec" style="display: {{ @$step->detail['proceeds'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('proceeds_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('proceeds_text', @$step->detail['proceeds_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you intend to engage in illegal gambling or any other form of commercialized vice, such as prostitution, bootlegging, or the sale of child pornography, while in the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('bootlegging', 'no', @$step->detail['bootlegging'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'bootleggingSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('bootlegging', 'yes', @$step->detail['bootlegging'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'bootleggingSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="bootlegging"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 bootleggingSec" style="display: {{ @$step->detail['bootlegging'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('bootlegging_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('bootlegging_text', @$step->detail['bootlegging_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever exercised immunity (diplomatic or otherwise) to avoid being prosecuted for a criminal offense in the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('exercised', 'no', @$step->detail['exercised'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'exercisedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('exercised', 'yes', @$step->detail['exercised'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'exercisedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="exercised"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 exercisedSec" style="display: {{ @$step->detail['exercised'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('exercised_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('exercised_text', @$step->detail['exercised_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever, while serving as a foreign government official, been responsible for or directly carried out violations of religious freedoms?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('carried', 'no', @$step->detail['carried'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'carriedSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('carried', 'yes', @$step->detail['carried'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'carriedSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="carried"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 carriedSec" style="display: {{ @$step->detail['carried'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('carried_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('carried_text', @$step->detail['carried_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>  
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever induced by force, fraud, or coercion (or otherwise been involved in) the trafficking of persons for commercial sex acts?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('coercion', 'no', @$step->detail['coercion'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'coercionSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('coercion', 'yes', @$step->detail['coercion'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'coercionSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="coercion"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 coercionSec" style="display: {{ @$step->detail['coercion'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('coercion_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('coercion_text', @$step->detail['coercion_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever trafficked a person into involuntary servitude, peonage, debt bondage, or slavery? Trafficking includes recruiting, harboring, transporting, providing, or obtaining a person for labor or services through the use of force, fraud, or coercion.</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('slavery', 'no', @$step->detail['slavery'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'slaverySec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('slavery', 'yes', @$step->detail['slavery'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'slaverySec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="slavery"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 slaverySec" style="display: {{ @$step->detail['slavery'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('slavery_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('slavery_text', @$step->detail['slavery_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever knowingly aided, abetted, assisted, conspired, or colluded with other in trafficking persons for commercial sex acts or involuntary servitude, peonage, debt bondage, or slavery?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('conspired', 'no', @$step->detail['conspired'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'conspiredSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('conspired', 'yes', @$step->detail['conspired'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'conspiredSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="conspired"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 conspiredSec" style="display: {{ @$step->detail['conspired'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('conspired_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('conspired_text', @$step->detail['conspired_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you the spouse, son or daughter of a foreign national who engaged in the trafficking of persons and have received or obtained, within the last five years, any financial or other benefits from the illicit activity of your spouse or your parent, although you knew or reasonably should have known that this benefit resulted from the illicit activity of your spouse or parent?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('financial', 'no', @$step->detail['financial'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'financialSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('financial', 'yes', @$step->detail['financial'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'financialSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="financial"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 financialSec" style="display: {{ @$step->detail['financial'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('financial_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('financial_text', @$step->detail['financial_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever engaged in money laundering or have you ever knowingly aided, assisted, conspired, or colluded with others in money laundering or do you seek to enter the United States to engage in such activity?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('laundering', 'no', @$step->detail['laundering'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'launderingSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('laundering', 'yes', @$step->detail['laundering'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'launderingSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="laundering"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 launderingSec" style="display: {{ @$step->detail['laundering'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('laundering_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('laundering_text', @$step->detail['laundering_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div> 
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you intend to engage in any activity that violates or evades any law relating to espionage (including spying) or sabotage in the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('evades', 'no', @$step->detail['evades'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'evadesSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('evades', 'yes', @$step->detail['evades'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'evadesSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="evades"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 evadesSec" style="display: {{ @$step->detail['evades'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('evades_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('evades_text', @$step->detail['evades_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you intend to engage in any activity in the United States that violates or evades any law prohibiting the export from the United States of goods, technology, or sensitive information?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('violates', 'no', @$step->detail['violates'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'violatesSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('violates', 'yes', @$step->detail['violates'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'violatesSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="violates"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 violatesSec" style="display: {{ @$step->detail['violates'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('violates_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('violates_text', @$step->detail['violates_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you intend to engage in any activity whose purpose includes opposing, controlling, or overthrowing the U.S. Government by force, violence, or other unlawful means while in the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('unlawful', 'no', @$step->detail['unlawful'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'unlawfulSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('unlawful', 'yes', @$step->detail['unlawful'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'unlawfulSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="unlawful"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 unlawfulSec" style="display: {{ @$step->detail['unlawful'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('unlawful_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('unlawful_text', @$step->detail['unlawful_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you intend to engage in any activity that could endanger the welfare, safety or security of the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('welfare', 'no', @$step->detail['welfare'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'welfareSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('welfare', 'yes', @$step->detail['welfare'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'welfareSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="welfare"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 welfareSec" style="display: {{ @$step->detail['welfare'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('welfare_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('welfare_text', @$step->detail['welfare_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Do you intend to engage in any other unlawful activity?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('intend', 'no', @$step->detail['intend'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'intendSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('intend', 'yes', @$step->detail['intend'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'intendSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="intend"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 intendSec" style="display: {{ @$step->detail['intend'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('intend_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('intend_text', @$step->detail['intend_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Are you engaged in or, upon your entry into the United States, do you intend to engage in any activity that could have potentially serious adverse foreign policy consequences for the United States?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('consequences', 'no', @$step->detail['consequences'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'consequencesSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('consequences', 'yes', @$step->detail['consequences'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'consequencesSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="consequences"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 consequencesSec" style="display: {{ @$step->detail['consequences'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('consequences_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('consequences_text', @$step->detail['consequences_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Have you ever committed, threatened to commit, attempted to commit, conspired to commit, incited, endorsed, advocated, planned, or prepared any of the following: hijacking, sabotage, kidnapping, political assassination, or use of a weapon or explosive to harm another individual or cause substantial damage to property?</label>
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
                        <label>Have you ever Participated in, or been a member of, a group or organization that did any of the activities(Committed, threatened to commit, attempted to commit,conspired to commit, incited, endorsed, advocated, planned, or prepared any of the following: hijacking, sabotage, kidnapping, political assassination, or use of a weapon or explosive to harm another individual or cause substantial damage to property)?</label>
                        <div class="radiogroup">
                            <label class="custom-control custom-radio mb-0 ">
                                {{ Form::radio('kidnapping', 'no', @$step->detail['kidnapping'] == 'no' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'kidnappingSec'
                                    ])
                                }}
                                <span class="custom-control-label"></span> No
                            </label>
                            <label class="custom-control custom-radio mb-0 ms-3">
                                {{ Form::radio('kidnapping', 'yes', @$step->detail['kidnapping'] == 'yes' ? true : '', [
                                        'class' => 'custom-control-input showTextArea',
                                        'data-text' => 'kidnappingSec'
                                    ]) 
                                }}
                                <span class="custom-control-label"></span> Yes
                            </label>
                            <div class="kidnapping"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-4 kidnappingSec" style="display: {{ @$step->detail['kidnapping'] == 'yes' ? 'block' : 'none' }};">
                    {{ Form::label('kidnapping_text', 'Explain why you answered Yes to this question and provide details.') }}
                    <span class="required">*</span>
                    {{ Form::textarea('kidnapping_text', @$step->detail['kidnapping_text'], ['class' => 'form-control', 'rows' => 4]) }}
                </div>                                 
            </div>
        </div>       
        {!! Form::hidden("id", @$step->id) !!}
        {!! Form::hidden('name', 'questions-part-2') !!}
        {!! Form::hidden('application', "adjustment$type") !!}
        {!! Form::hidden('next', 'questions-part-3') !!}
        {{ Form::button('Back To Start', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'name'
        ]) }}
        {{ Form::button('Previous Step', [
            'class' => 'btn btn-tra-grey adjustmentPreviousOrContinue',
            'data-form' => 'questions-part-1'
        ]) }}
        {{ Form::button('Skip & Continue', [
            'class' => 'btn btn-tra-grey ms-2 adjustmentPreviousOrContinue',
            'data-form' => 'questions-part-3'
        ]) }}
        {{ Form::button('Save & Continue', [
            'class' => 'btn btn-tra-primary ms-2',
            'id' => 'adjustmentQusPart2Btn',
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
        
        $("#adjustmentQusPart2").validate({
            rules: {
                foreign_nat: {
                    required: true,
                },
                foreign_nat_text: {
                    required: true,
                },
                prostitution: {
                    required: true,
                },
                prostitution_text: {
                    required: true,
                },
                prostitutes: {
                    required: true,
                },
                prostitutes_text: {
                    required: true,
                },
                proceeds: {
                    required: true,
                },
                proceeds_text: {
                    required: true,
                },
                bootlegging: {
                    required: true,
                },
                bootlegging_text: {
                    required: true,
                },
                exercised: {
                    required: true,
                },
                exercised_text: {
                    required: true,
                },
                carried: {
                    required: true,
                },
                carried_text: {
                    required: true,
                },
                coercion: {
                    required: true,
                },
                coercion_text: {
                    required: true,
                },
                slavery: {
                    required: true,
                },
                slavery_text: {
                    required: true,
                },
                conspired: {
                    required: true,
                },
                conspired_text: {
                    required: true,
                },
                financial: {
                    required: true,
                },
                financial_text: {
                    required: true,
                },
                laundering: {
                    required: true,
                },
                laundering_text: {
                    required: true,
                },
                evades: {
                    required: true,
                },
                evades_text: {
                    required: true,
                },
                violates: {
                    required: true,
                },
                violates_text: {
                    required: true,
                },
                unlawful: {
                    required: true,
                },
                unlawful_text: {
                    required: true,
                },
                welfare: {
                    required: true,
                },
                welfare_text: {
                    required: true,
                },
                intend: {
                    required: true,
                },
                intend_text: {
                    required: true,
                },
                consequences: {
                    required: true,
                },
                consequences_text: {
                    required: true,
                },
                threatened: {
                    required: true,
                },
                threatened_text: {
                    required: true,
                },
                kidnapping: {
                    required: true,
                },
                kidnapping_text: {
                    required: true,
                },
            },
            errorPlacement: function (error, element) {
                var name = element.attr("name");
                if (name == "foreign_nat" || name == "prostitution" || name == "prostitutes" || name == "proceeds" || name == "bootlegging" || name == "exercised" || name == "carried" || name == "coercion" || name == "slavery" || name == "conspired" || name == "financial" || name == "laundering" || name == "evades" || name == "violates" || name == "unlawful" || name == "welfare" || name == "intend" || name == "consequences" || name == "threatened" || name == "kidnapping") {
                    error.appendTo($("."+element.attr("name")));
                } else {
                    error.insertAfter(element);
                }
            },
            messages: {
               foreign_nat: "Please choose option!",               
               foreign_nat_text: "Please enter detail!",
               prostitution: "Please choose option!",               
               prostitution_text: "Please enter detail!",
               prostitutes: "Please choose option!",               
               prostitutes_text: "Please enter detail!", 
               proceeds: "Please choose option!",               
               proceeds_text: "Please enter detail!",
               bootlegging: "Please choose option!",               
               bootlegging_text: "Please enter detail!",
               exercised: "Please choose option!",               
               exercised_text: "Please enter detail!", 
               carried: "Please choose option!",               
               carried_text: "Please enter detail!", 
               coercion: "Please choose option!",               
               coercion_text: "Please enter detail!",
               slavery: "Please choose option!",               
               slavery_text: "Please enter detail!",
               conspired: "Please choose option!",               
               conspired_text: "Please enter detail!",
               financial: "Please choose option!",               
               financial_text: "Please enter detail!", 
               laundering: "Please choose option!",               
               laundering_text: "Please enter detail!",
               evades: "Please choose option!",               
               evades_text: "Please enter detail!",
               violates: "Please choose option!",               
               violates_text: "Please enter detail!", 
               unlawful: "Please choose option!",               
               unlawful_text: "Please enter detail!",
               welfare: "Please choose option!",               
               welfare_text: "Please enter detail!", 
               intend: "Please choose option!",               
               intend_text: "Please enter detail!", 
               consequences: "Please choose option!",               
               consequences_text: "Please enter detail!",
               threatened: "Please choose option!",               
               threatened_text: "Please enter detail!", 
               kidnapping: "Please choose option!",               
               kidnapping_text: "Please enter detail!",               
            },
            submitHandler: function(form) {
                $('#adjustmentQusPart2Btn').html('Processing <i class="fa fa-spinner fa-spin"></i>');
                var serializedData = $(form).serialize();
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ route('adjustmentQusPart2') }}",
                    data: serializedData,
                    dataType: 'json',
                    success: function(data) {               
                        if (data.status == true) {                                           
                            $('.questions-part-2').removeClass('active');
                            $('.questions-part-3').addClass('active');
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