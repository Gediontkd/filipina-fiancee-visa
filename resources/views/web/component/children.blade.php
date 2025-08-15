<div class="row addChildernForm">
    @if ($index != 1)
        <div class="col-md-12 mb-4">
            <a class="btn btn-tra-grey removeChildern">- Remove Child</a>
        </div>
    @endif    
    <h5>Child {{$index}}</h5>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("first_name$index", "First Name") }}
            <span class="required">*</span>
            {{ Form::text("first_name$index", @$data["first_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Name'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("middle_name$index", "Middle Name") }}
            <span class="required">*</span>
            {{ Form::text("middle_name$index", @$data["middle_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Name'
            ]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("last_name$index", "Last Name") }}
            <span class="required">*</span>
            {{ Form::text("last_name$index", @$data["last_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Name'
            ]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Is the address for this child the same as the alien parent?</label>
            <div class="radiogroup">
                <label class="custom-control custom-radio mb-0 ">
                    {{ Form::radio("child_address$index", 'no', @$data["child_address$index"] == 'no' ? true : '', [
                            'class' => 'custom-control-input',
                        ])
                    }}
                    <span class="custom-control-label"></span> No
                </label>
                <label class="custom-control custom-radio mb-0 ms-3">
                    {{ Form::radio("child_address$index", 'yes', @$data["child_address$index"] == 'yes' ? true : '', [
                            'class' => 'custom-control-input',
                        ]) 
                    }}
                    <span class="custom-control-label"></span> Yes
                </label>
                <div class="child_address"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("dob$index", "Date of Birth (mm/dd/yyyy)") }}
            <span class="required">*</span>
            {{ Form::text("dob$index", @$data["dob$index"], [
                'class' => 'form-control dateOfBirth',
                'placeholder' => 'Enter Date of Birth'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("cob$index", "City of Birth") }}
            <span class="required">*</span>
            {{ Form::text("cob$index", @$data["cob$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter City of Birth'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("state_province$index", "State or Province of Birth") }}
            <span class="required">*</span>
            {{ Form::text("state_province$index", @$data["state_province$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter State or Province of Birth'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("country_of_birth$index", "Country of Birth") }}
            <span class="required">*</span>
            {{ Form::select("country_of_birth$index", getAllCountry(), @$data["country_of_birth$index"], [
                'class' => 'form-control',
            ]) }}                       
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("country_of_citizenship$index", "Country of Citizenship") }}
            <span class="required">*</span>
            {{ Form::select("country_of_citizenship$index", getAllCountry(), @$data["country_of_citizenship$index"], [
                'class' => 'form-control',
            ]) }}                       
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Does this child have citizenship in another country?</label>
            <div class="radiogroup">
                <label class="custom-control custom-radio mb-0 ">
                    {{ Form::radio("child_citizenship$index", 'no', @$data["child_citizenship$index"] == 'no' ? true : '', [
                            'class' => 'custom-control-input showTextArea',
                            'data-text' => 'childCitizenshipSec'
                        ])
                    }}
                    <span class="custom-control-label"></span> No
                </label>
                <label class="custom-control custom-radio mb-0 ms-3">
                    {{ Form::radio("child_citizenship$index", 'yes', @$data["child_citizenship$index"] == 'yes' ? true : '', [
                            'class' => 'custom-control-input showTextArea',
                            'data-text' => 'childCitizenshipSec'
                        ]) 
                    }}
                    <span class="custom-control-label"></span> Yes
                </label>
                <div class="child_citizenship"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 childCitizenshipSec" style="display: none;">
        <div class="form-group">
            {{ Form::label("child_reg_no$index", "Child's A# (Alien Registration Number).") }}
            <span class="required">*</span>
            {{ Form::text("child_reg_no$index", @$data["child_reg_no$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Number'
            ]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Has the Social Security Administration (SSA) ever officially issued a Social Security card to you? </label>
            <div class="radiogroup">
                <label class="custom-control custom-radio mb-0 ">
                    {{ Form::radio("ssa$index", 'no', @$data["ssa$index"] == 'no' ? true : '', [
                            'class' => 'custom-control-input showTextArea',
                            'data-text' => 'ssaSec'
                        ])
                    }}
                    <span class="custom-control-label"></span> No
                </label>
                <label class="custom-control custom-radio mb-0 ms-3">
                    {{ Form::radio("ssa$index", 'yes', @$data["ssa$index"] == 'yes' ? true : '', [
                            'class' => 'custom-control-input showTextArea',
                            'data-text' => 'ssaSec'
                        ]) 
                    }}
                    <span class="custom-control-label"></span> Yes
                </label>
                <div class="ssa"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 ssaSec" style="display: none;">
        <div class="form-group">
            {{ Form::label("ssn$index", "Social Security Number  Format: 123-45-6789 Uncommon") }}
            <span class="required">*</span>
            {{ Form::text("ssn$index", @$data["ssn$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Number'
            ]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Do you want the SSA to issue you a Social Security card?</label>
            <div class="radiogroup">
                <label class="custom-control custom-radio mb-0 ">
                    {{ Form::radio("ssc$index", 'no', @$data["ssc$index"] == 'no' ? true : '', [
                            'class' => 'custom-control-input showTextArea',
                            'data-text' => 'sscSec'
                        ])
                    }}
                    <span class="custom-control-label"></span> No
                </label>
                <label class="custom-control custom-radio mb-0 ms-3">
                    {{ Form::radio("ssc$index", 'yes', @$data["ssc$index"] == 'yes' ? true : '', [
                            'class' => 'custom-control-input showTextArea',
                            'data-text' => 'sscSec'
                        ]) 
                    }}
                    <span class="custom-control-label"></span> Yes
                </label>
                <div class="ssc"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 sscSec" style="display: none;">
        <p class="text-danger">Note: By answering "Yes", you authorize the disclosure of information from this application to the SSA as required for the purpose of assigning you(beneficiary) an SSN and issuing you(beneficiary) a Social Security card.</p>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Relationship to Alien Beneficiary</label>
            <div class="radiogroup">
                <label class="custom-control custom-radio mb-0 ">
                    {{ Form::radio("relationship$index", 'sun', @$data["relationship$index"] == 'sun' ? true : '', [
                            'class' => 'custom-control-input',
                        ])
                    }}
                    <span class="custom-control-label"></span> Sun
                </label>
                <label class="custom-control custom-radio mb-0 ms-3">
                    {{ Form::radio("relationship$index", 'daughter', @$data["relationship$index"] == 'daughter' ? true : '', [
                            'class' => 'custom-control-input',
                        ]) 
                    }}
                    <span class="custom-control-label"></span> Daughter
                </label>
                <label class="custom-control custom-radio mb-0 ms-3">
                    {{ Form::radio("relationship$index", 'step-son', @$data["relationship$index"] == 'step-son' ? true : '', [
                            'class' => 'custom-control-input',
                        ]) 
                    }}
                    <span class="custom-control-label"></span> Step-Son
                </label>
                <label class="custom-control custom-radio mb-0 ms-3">
                    {{ Form::radio("relationship$index", ' step-daughter', @$data["relationship$index"] == ' step-daughter' ? true : '', [
                            'class' => 'custom-control-input',
                        ]) 
                    }}
                    <span class="custom-control-label"></span>  Step-Daughter
                </label>
                <div class="relationship"></div>
            </div>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="form-group">
            <label>Has the child mentioned above been arrested for and/or convicted of any crime?</label>
            <div class="radiogroup">
                <label class="custom-control custom-radio mb-0 ">
                    {{ Form::radio("arrested$index", 'no', @$data["arrested$index"] == 'no' ? true : '', [
                            'class' => 'custom-control-input',
                        ])
                    }}
                    <span class="custom-control-label"></span> No
                </label>
                <label class="custom-control custom-radio mb-0 ms-3">
                    {{ Form::radio("arrested$index", 'yes', @$data["arrested$index"] == 'yes' ? true : '', [
                            'class' => 'custom-control-input',
                        ]) 
                    }}
                    <span class="custom-control-label"></span> Yes
                </label>                              
                <div class="arrested"></div>
            </div>
        </div>
    </div> 
    <div class="col-md-12">
        <div class="form-group">
            <label>Will this child be joining you in your Adjustment of Status? You must have married the U.S. citizen (sponsor) before the child became 18 years of age.</label>
            <div class="radiogroup">
                <label class="custom-control custom-radio mb-0 ">
                    {{ Form::radio("joining$index", 'no', @$data["joining$index"] == 'no' ? true : '', [
                            'class' => 'custom-control-input',
                        ])
                    }}
                    <span class="custom-control-label"></span> No
                </label>
                <label class="custom-control custom-radio mb-0 ms-3">
                    {{ Form::radio("joining$index", 'yes', @$data["joining$index"] == 'yes' ? true : '', [
                            'class' => 'custom-control-input',
                        ]) 
                    }}
                    <span class="custom-control-label"></span> Yes
                </label>                              
                <div class="joining"></div>
            </div>
        </div>
    </div>
    <p>Parent 2's Information</p>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("pl_name$index", "Parent 2's Last Name of Birth") }}
            <span class="required">*</span>
            {{ Form::text("pl_name$index", @$data["pl_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Name'
            ]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("pf_name$index", "Parent 2's First Name of Birth") }}
            <span class="required">*</span>
            {{ Form::text("pf_name$index", @$data["pf_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Name'
            ]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("pm_name$index", "Parent 2's Middle Name of Birth") }}
            <span class="required">*</span>
            {{ Form::text("pm_name$index", @$data["pm_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Name'
            ]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Has your Parent 2 used any other names?</label>
            <div class="radiogroup">
                <label class="custom-control custom-radio mb-0 ">
                    {{ Form::radio("p_other_name$index", 'no', @$data["p_other_name$index"] == 'no' ? true : '', [
                            'class' => 'custom-control-input showTextArea',
                            'data-text' => 'pOtherNameSec'
                        ])
                    }}
                    <span class="custom-control-label"></span> No
                </label>
                <label class="custom-control custom-radio mb-0 ms-3">
                    {{ Form::radio("p_other_name$index", 'yes', @$data["p_other_name$index"] == 'yes' ? true : '', [
                            'class' => 'custom-control-input showTextArea',
                            'data-text' => 'pOtherNameSec'
                        ]) 
                    }}
                    <span class="custom-control-label"></span> Yes
                </label>                              
                <div class="p_other_name"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12 pOtherNameSec" style="display: none;">
        <div class="form-group">
            {{ Form::label("pol_name$index", "Parent 2's Other Last Name") }}
            <span class="required">*</span>
            {{ Form::text("pol_name$index", @$data["pol_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Name'
            ]) }}
        </div>
        <div class="form-group">
            {{ Form::label("pof_name$index", "Parent 2's Other First Name") }}
            <span class="required">*</span>
            {{ Form::text("pof_name$index", @$data["pof_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Name'
            ]) }}
        </div>
        <div class="form-group">
            {{ Form::label("pom_name$index", "Parent 2's Other Middle Name") }}
            <span class="required">*</span>
            {{ Form::text("pom_name$index", @$data["pom_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Name'
            ]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("p_dob$index", "Parent 2's Date of Birth (mm/dd/yyyy)") }}
            <span class="required">*</span>
            {{ Form::text("p_dob$index", @$data["p_dob$index"], [
                'class' => 'form-control dateOfBirth',
                'placeholder' => 'Enter Date'
            ]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Parent 2's Gender</label>
            <div class="radiogroup">
                <label class="custom-control custom-radio mb-0 ">
                    {{ Form::radio("p_gender$index", 'no', @$data["p_gender$index"] == 'no' ? true : '', [
                            'class' => 'custom-control-input showTextArea',
                            'data-text' => 'pOtherNameSec'
                        ])
                    }}
                    <span class="custom-control-label"></span> No
                </label>
                <label class="custom-control custom-radio mb-0 ms-3">
                    {{ Form::radio("p_gender$index", 'yes', @$data["p_gender$index"] == 'yes' ? true : '', [
                            'class' => 'custom-control-input showTextArea',
                            'data-text' => 'pOtherNameSec'
                        ]) 
                    }}
                    <span class="custom-control-label"></span> Yes
                </label>                              
                <div class="p_gender"></div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("p_town_vilage$index", "Parent 2's City/Town/Village of Birth") }}
            <span class="required">*</span>
            {{ Form::text("p_town_vilage$index", @$data["p_town_vilage$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Address'
            ]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("p_country_of_birth$index", "Parent 2's Country of Birth") }}
            <span class="required">*</span>
            {{ Form::select("p_country_of_birth$index", getAllCountry(), @$data["p_country_of_birth$index"], [
                'class' => 'form-control',
            ]) }}                       
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("city_residence$index", "Parent 2's Current City of Residence. Enter Deceased if appropriate.") }}
            <span class="required">*</span>
            {{ Form::text("city_residence$index", @$data["city_residence$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter City'
            ]) }}
        </div>
    </div>
</div>