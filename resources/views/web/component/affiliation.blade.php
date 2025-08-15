<div class="row addAffiliationForm">
    @if ($index != 1)
        <div class="col-md-12 mb-4">
            <a class="btn btn-tra-grey removeAffiliation">- Remove Child</a>
        </div>
    @endif    
    <h5>Affiliation {{$index}}</h5>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("org_name$index", "Name of Organization") }}
            <span class="required">*</span>
            {{ Form::text("org_name$index", @$data["org_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Name'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("city_town$index", "City Or Town") }}
            <span class="required">*</span>
            {{ Form::text("city_town$index", @$data["city_town$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter City Or Town'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("state_province$index", "State or Province") }}
            <span class="required">*</span>
            {{ Form::text("state_province$index", @$data["state_province$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter State or Province'
            ]) }}
        </div>
    </div>    
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("country$index", "Country") }}
            <span class="required">*</span>
            {{ Form::select("country", getAllCountry(), @$data["country$index"], [
                'class' => 'form-control',
            ]) }}                       
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("nature_of_group$index", "Nature of Group") }}
            <span class="required">*</span>
            {{ Form::text("nature_of_group$index", @$data["nature_of_group$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Nature of Group'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("membership_start_date$index", "Membership Start Date (mm/dd/yyyy)") }}
            <span class="required">*</span>
            {{ Form::text("membership_start_date$index", @$data["membership_start_date$index"], [
                'class' => 'form-control disablePastDate',
                'placeholder' => 'Enter Date'
            ]) }}
        </div>
    </div> 
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("membership_end_date$index", "Membership End Date (mm/dd/yyyy)") }}
            <span class="required">*</span>
            {{ Form::text("membership_end_date$index", @$data["membership_end_date$index"], [
                'class' => 'form-control dateOfBirth',
                'placeholder' => 'Enter Date'
            ]) }}
        </div>
    </div>
</div>