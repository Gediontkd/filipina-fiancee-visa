<div class="biologicalChildForm mb-4">
    @if ($index == 1)
	   <h4>Provide the details for your children</h4>
	@endif
    @if ($index != 1)
        <div class="col-md-6 mb-4">
            <a class="btn btn-tra-grey removebiologicalChild">- Remove Child</a>
        </div>
    @endif
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("given_first_name$index", "Given Name (First Name)") }}
            <span class="required">*</span>
            {{ Form::text("given_first_name$index", @$step->detail["given_first_name$index"], ['class' => 'form-control', 'placeholder' => 'Enter Name']) }}        
        </div>                        
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("middle_name$index", "Middle Name") }}
            <span class="required">*</span>
            {{ Form::text("middle_name$index", @$step->detail["middle_name$index"], ['class' => 'form-control', 'placeholder' => 'Enter Name']) }}        
        </div>                        
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("last_name$index", "Last Name") }}
            <span class="required">*</span>
            {{ Form::text("last_name$index", @$step->detail["last_name$index"], ['class' => 'form-control', 'placeholder' => 'Enter Name']) }}        
        </div>                        
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Relationship to the beneficiary</label>
            <div class="radiogroup">
                <label class="custom-control custom-radio mb-0 ">
                    {{ Form::radio("relationship$index", 'no', @$step->detail["relationship$index"] == 'no' ? true : '', [
                        'class' => 'custom-control-input'
                    ]) }}
                    <span class="custom-control-label"></span> Stepdaughter
                </label>
                <label class="custom-control custom-radio mb-0 ">
                    {{ Form::radio("relationship$index", 'yes', @$step->detail["relationship$index"] == 'yes' ? true : '', [
                        'class' => 'custom-control-input'
                    ]) }}
                    <span class="custom-control-label"></span> Stepson
                </label>                          
            </div>
            <div class="relationship$index"></div>
        </div>                        
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("child_dob$index", "Date of Birth (mm/dd/yyyy)") }}
            <span class="required">*</span>
            {{ Form::text("child_dob$index", @$step->detail["child_dob$index"], ['class' => 'form-control dateOfBirth', 'placeholder' => 'Enter Date']) }}        
        </div>                        
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("country_of_birth$index", 'Country of Birth') }}
            <span class="required">*</span>
            {{ Form::select("country_of_birth$index", getAllCountry(), @$step->detail["country_of_birth$index"], ['class' => 'form-control',]) }}                          
        </div>
    </div>
</div>