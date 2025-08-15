<div class="priorSpouseForm">
    @if ($index != 1)
        <div class="col-md-12 mb-4">
            <a class="btn btn-tra-grey removePriorSpouse">- Remove {{ $index }} prior spouse</a>
        </div>
    @endif
    <h5>Enter Prior Spouse Information. Space is limited to match USCIS forms. Abbreviate as necessary.</h5>
    <h5>Prior Spouse #{{ $index }}</h5>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("last_name$index", 'Last Name (maiden name for wife)') }}
                <span class="required">*</span>
                {{ Form::text("last_name$index", @$data["last_name$index"], [
                    'class' => 'form-control',
                    'placeholder' => 'Enter name'
                ]) }}                                        
            </div>                            
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("first_name$index", 'First Name') }}
                <span class="required">*</span>
                {{ Form::text("first_name$index", @$data["first_name$index"], [
                    'class' => 'form-control',
                    'placeholder' => 'Enter name'
                ]) }}                                        
            </div>                            
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("middle_name$index", 'Middle Name') }}
                <span class="required">*</span>
                {{ Form::text("middle_name$index", @$data["middle_name$index"], [
                    'class' => "form-control middleName$index",
                    'placeholder' => 'Enter name'
                ]) }}
                {{ Form::label('does_not_apply', "Does Not Apply") }}
                {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                    'class' => 'custom-control-input doesNotApply',
                    'data-field' => "middleName$index"
                ]) }}                 
            </div>                            
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("dob$index", 'Date of Birth') }}
                <span class="required">*</span>
                {{ Form::text("dob$index", @$data["dob$index"], [
                    'class' => 'form-control dateOfBirth',
                    'placeholder' => 'Enter Date of Birth'
                ]) }}                                        
            </div>                            
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("date_of_marriage$index", "Date of Marriage") }}
                <span class="required">*</span>
                {{ Form::text("date_of_marriage$index", @$data["date_of_marriage$index"], ['class' => 'form-control datePicker', 'placeholder' => 'Enter Date Of Marriage']) }}                        
            </div>
        </div>
        <h5>Place of Marriage to Prior Spouse</h5>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("first_city_town$index", 'City Or Town') }}
                <span class="required">*</span>
                {{ Form::text("first_city_town$index", @$data["first_city_town$index"], [
                    'class' => "form-control",
                    'placeholder' => 'Enter City Or Town'
                ]) }}                                 
            </div>                            
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("first_state_province$index", 'State or Province') }}
                <span class="required">*</span>
                {{ Form::text("first_state_province$index", @$data["first_state_province$index"], [
                    'class' => "form-control",
                    'placeholder' => 'Enter State or Province'
                ]) }}                         
            </div>                            
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("first_country$index", "Country") }}
                <span class="required">*</span>
                {{ Form::select("first_country$index", getAllCountry(), @$data["first_country$index"], [
                    'class' => 'form-control'
                ]) }}                       
            </div>                            
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("first_date_marriage_ended$index", "Date Marriage Ended") }}
                <span class="required">*</span>
                {{ Form::text("first_date_marriage_ended$index", @$data["first_date_marriage_ended$index"], ['class' => 'form-control datePicker', 'placeholder' => 'Enter Date Marriage Ended']) }}                      
            </div> 
        </div>
        <h5>Place Where Marriage with Prior Spouse Legally Ended</h5>       
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("second_city_town$index", 'City Or Town') }}
                <span class="required">*</span>
                {{ Form::text("second_city_town$index", @$data["second_city_town$index"], [
                    'class' => "form-control",
                    'placeholder' => 'Enter City Or Town'
                ]) }}                                 
            </div>                            
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("second_state_province$index", 'State or Province') }}
                <span class="required">*</span>
                {{ Form::text("second_state_province$index", @$data["second_state_province$index"], [
                    'class' => "form-control",
                    'placeholder' => 'Enter State or Province'
                ]) }}                         
            </div>                            
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("second_country$index", "Country") }}
                <span class="required">*</span>
                {{ Form::select("second_country$index", getAllCountry(), @$data["second_country$index"], [
                    'class' => 'form-control'
                ]) }}                       
            </div>                            
        </div>
    </div>
</div>