<div class="modal fade modal_popup_design" id="chooseApplicationModal" tabindex="-1" aria-labelledby="chooseApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">What type of service are you interested in? </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="cbox-3-txt">                    
                    {{ Form::open(['url' => route('chooseApplication'), 'id' => 'chooseApplicationForm']) }}
                        <div class="form-group p-3">
                            <label for="">We offer them 3 options :</label>
                            <div class="form_radio_group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="fiancee" name="chosen_application" id="FianceeVisaRadio">
                                    <label class="form-check-label" for="FianceeVisaRadio">
                                        Fiancee Visa
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" value="spouse" name="chosen_application" id="SpouseVisaRadio">
                                    <label class="form-check-label" for="SpouseVisaRadio">
                                        Spouse Visa
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" value="adjustment" name="chosen_application" id="FGreenCardRadio">
                                    <label class="form-check-label" for="FGreenCardRadio">
                                        Adjustment of Status (Green Card)
                                    </label>
                                  </div>
                            </div>
                            <span class="chosen_application"></span>
                        </div>
                        <div class="modal-footer">
                        {{ Form::submit('Submit', ['class' => 'btn btn-tra-primary', 'id' => 'chooseApplicationFormBtn']) }}
                        </div>
                    {{ Form::close() }}                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal_popup_design" id="fianceeModal" tabindex="-1" aria-labelledby="chooseApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">What type of service are you interested in? </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="cbox-3-txt">                    
                    {{ Form::open(['url' => route('chooseApplication'), 'id' => 'chooseApplicationForm']) }}
                        <div class="form-group p-3">
                            <label for="">We offer them 3 options :</label>
                            <div class="form_radio_group">
                                <div class="form-check">
                                    <label class="form-check-label" for="FianceeVisaRadio">
                                        Fiancee Visa
                                    </label>
                                  </div>                                  
                            </div>
                            <span class="chosen_application"></span>
                        </div>
                        <div class="modal-footer">
                        {{ Form::submit('Submit', ['class' => 'btn btn-tra-primary', 'id' => 'chooseApplicationFormBtn']) }}
                        </div>
                    {{ Form::close() }}                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal_popup_design" id="spouseModal" tabindex="-1" aria-labelledby="chooseApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">What type of service are you interested in? </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="cbox-3-txt">                    
                    {{ Form::open(['url' => route('chooseApplication'), 'id' => 'chooseApplicationForm']) }}
                        <div class="form-group p-3">
                            <label for="">We offer them 3 options :</label>
                            <div class="form_radio_group">
                                <div class="form-check">
                                    <label class="form-check-label" for="FianceeVisaRadio">
                                        Spouse Visa
                                    </label>
                                  </div>                                  
                            </div>
                            <span class="chosen_application"></span>
                        </div>
                        <div class="modal-footer">
                        {{ Form::submit('Submit', ['class' => 'btn btn-tra-primary', 'id' => 'chooseApplicationFormBtn']) }}
                        </div>
                    {{ Form::close() }}                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade modal_popup_design" id="adjustmentModal" tabindex="-1" aria-labelledby="chooseApplicationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">What type of service are you interested in? </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <div class="cbox-3-txt">                    
                    {{ Form::open(['url' => route('chooseApplication'), 'id' => 'chooseApplicationForm']) }}
                        <div class="form-group p-3">
                            <label for="">We offer them 3 options :</label>
                            <div class="form_radio_group">
                                <div class="form-check">
                                    <label class="form-check-label" for="FianceeVisaRadio">
                                        Adjustment Visa
                                    </label>
                                  </div>                                  
                            </div>
                            <span class="chosen_application"></span>
                        </div>
                        <div class="modal-footer">
                        {{ Form::submit('Submit', ['class' => 'btn btn-tra-primary', 'id' => 'chooseApplicationFormBtn']) }}
                        </div>
                    {{ Form::close() }}                    
                </div>
            </div>
        </div>
    </div>
</div>