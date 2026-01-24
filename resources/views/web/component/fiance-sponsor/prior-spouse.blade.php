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
                {{ Form::label("ps_maiden_lname$index", 'Maiden Last Name') }}
                <span class="required">*</span>
                {{ Form::text("ps_maiden_lname$index", @$data["ps_maiden_lname$index"], [
                    'class' => 'form-control',
                    'placeholder' => 'Enter name'
                ]) }}                                        
            </div>                            
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label("ps_middle_name$index", 'Middle Name') }}
                <span class="required">*</span>
                {{ Form::text("ps_middle_name$index", @$data["ps_middle_name$index"] == 'N/A' ? 'N/A' : @$data["ps_middle_name$index"], [
                    'class' => "form-control psMiddleName$index",
                    'placeholder' => 'Enter name'
                ]) }}
                @include('web.component.does-not-apply', ['field' => "psMiddleName$index", 'value' => @$data["ps_middle_name$index"] == 'N/A'])               
            </div>                            
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label("ps_first_name$index", 'First Name') }}
                <span class="required">*</span>
                {{ Form::text("ps_first_name$index", @$data["ps_first_name$index"], [
                    'class' => 'form-control',
                    'placeholder' => 'Enter name'
                ]) }}                                        
            </div>                            
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("ps_dob$index", 'Date of Birth (mm/dd/yyyy, okay to estimate or enter Unknown)') }}
                <span class="required">*</span>
                {{ Form::text("ps_dob$index", @$data["ps_dob$index"], [
                    'class' => 'form-control dateOfBirth',
                    'placeholder' => 'mm/dd/yyyy',
                    'autocomplete' => 'off'
                ]) }}                                        
            </div>                            
        </div>              
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("ps_date_of_marriage$index", "Date of Marriage") }}
                <span class="required">*</span>
                {{ Form::text("ps_date_of_marriage$index", @$data["ps_date_of_marriage$index"], [
                    'class' => 'form-control datePicker', 
                    'placeholder' => 'mm/dd/yyyy',
                    'autocomplete' => 'off'
                ]) }}                        
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("ps_place_of_marriage$index", "City and State of Marriage (city and country if not USA)") }}
                <span class="required">*</span>
                {{ Form::text("ps_place_of_marriage$index", @$data["ps_place_of_marriage$index"], ['class' => 'form-control', 'placeholder' => 'City and State of Marriage']) }}                      
            </div> 
        </div>      
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("ps_date_marriage_ended$index", "Date Marriage Ended (mm/dd/yyyy, must match divorce/annulment/death document)") }}
                <span class="required">*</span>
                {{ Form::text("ps_date_marriage_ended$index", @$data["ps_date_marriage_ended$index"], [
                    'class' => 'form-control datePicker', 
                    'placeholder' => 'mm/dd/yyyy',
                    'autocomplete' => 'off'
                ]) }}                      
            </div> 
        </div>  
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label("ps_where_marriage_ended$index", "City and State where marriage ended (city and country if not USA)") }}
                <span class="required">*</span>
                {{ Form::text("ps_where_marriage_ended$index", @$data["ps_where_marriage_ended$index"], ['class' => 'form-control', 'placeholder' => 'City and State where marriage ended']) }}                      
            </div> 
        </div>        
    </div>
</div>