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
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("last_name$index", "Last Name") }}
            <span class="required">*</span>
            {{ Form::text("last_name$index", @$data["last_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Name'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("age$index", "Age") }}
            <span class="required">*</span>
            {{ Form::text("age$index", @$data["age$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Age'
            ]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label>Relationship to the Beneficiary</label>
            <div class="radiogroup">                
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
            {{ Form::label("c_dob$index", "Date of Birth (mm/dd/yyyy)") }}
            <span class="required">*</span>
            {{ Form::text("c_dob$index", @$data["c_dob$index"], [
                'class' => 'form-control dateOfBirth',
                'placeholder' => 'Enter Date',
                'readonly' => true
            ]) }}
        </div>
    </div>    
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("country_of_birth$index", "Country of Birth") }}
            <span class="required">*</span>
            {{ Form::select("country_of_birth$index", getAllCountryForSponsor(), @$data["country_of_birth$index"], [
                'class' => 'form-control',
            ]) }}                       
        </div>
    </div>    
</div>