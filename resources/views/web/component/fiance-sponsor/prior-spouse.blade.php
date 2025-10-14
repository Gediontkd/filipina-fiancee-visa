<!-- resources\views\web\component\fiance-sponsor\prior-spouse.blade.php -->
<div class="priorSpouseForm">
    @if ($index != 1)
        <div class="col-md-6 mb-4">
            <a class="btn btn-tra-grey removePriorSpouse">- Remove {{ $index }} prior spouse</a>
        </div>
    @endif
    <h5>Prior Spouse #{{ $index }}</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label("maiden_lname$index", 'Maiden Last Name') }}
                <span class="required">*</span>
                {{ Form::text("maiden_lname$index", @$data["maiden_lname$index"], [
                    'class' => 'form-control',
                    'placeholder' => 'Enter name'
                ]) }}                                        
            </div>                            
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label("middle_name$index", 'Middle Name') }}
                <span class="required">*</span>
                {{ Form::text("middle_name$index", @$step->detail["middle_name$index"] == 'N/A' ? 'N/A' : @$data["middle_name$index"], [
                    'class' => "form-control middleName$index",
                    'placeholder' => 'Enter name'
                ]) }}
                @include('web.component.does-not-apply', ['field' => "middleName$index", 'value' => @$step->detail["middle_name$index"] == 'N/A'])               
            </div>                            
        </div>
        <div class="col-md-4">
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
                {{ Form::label("dob$index", 'Date of Birth (mm/dd/yyyy, okay to estimate or enter Unknown)') }}
                <span class="required">*</span>
                {{ Form::text("dob$index", @$data["dob$index"], [
                    'class' => 'form-control dateOfBirth',
                    'placeholder' => 'mm/dd/yyyy',
                    'autocomplete' => 'off'
                ]) }}                                        
            </div>                            
        </div>              
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("date_of_marriage$index", "Date of Marriage") }}
                <span class="required">*</span>
                {{ Form::text("date_of_marriage$index", @$data["date_of_marriage$index"], [
                    'class' => 'form-control datePicker', 
                    'placeholder' => 'mm/dd/yyyy',
                    'autocomplete' => 'off'
                ]) }}                        
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("place_of_marriage$index", "City and State of Marriage (city and country if not USA)") }}
                <span class="required">*</span>
                {{ Form::text("place_of_marriage$index", @$data["place_of_marriage$index"], ['class' => 'form-control', 'placeholder' => 'City and State of Marriage']) }}                      
            </div> 
        </div>      
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("date_marriage_ended$index", "Date Marriage Ended (mm/dd/yyyy, must match divorce/annulment/death document)") }}
                <span class="required">*</span>
                {{ Form::text("date_marriage_ended$index", @$data["date_marriage_ended$index"], [
                    'class' => 'form-control datePicker', 
                    'placeholder' => 'mm/dd/yyyy',
                    'autocomplete' => 'off'
                ]) }}                      
            </div> 
        </div>  
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("where_marriage_ended$index", "City and State where marriage ended (city and country if not USA)") }}
                <span class="required">*</span>
                {{ Form::text("where_marriage_ended$index", @$data["where_marriage_ended$index"], ['class' => 'form-control', 'placeholder' => 'City and State where marriage ended']) }}                      
            </div> 
        </div>        
    </div>
</div>