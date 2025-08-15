<div class="row skillForm">
    <p>List all Occupational skills.</p>
    @if ($index != 1)
        <div class="col-md-12 mb-4">
            <a class="btn btn-tra-grey removeSkill">- Remove</a>
        </div>
    @endif
    <h4>Occupational #{{$index}}</h4>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("certifi_lice_occu_skill$index", 'Certification/License Type/Occupational Skill') }}
            <span class="required">*</span>
            {{ Form::text("certifi_lice_occu_skill$index", @$step->detail["certifi_lice_occu_skill$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Skills'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("date_obtained$index", 'Date Obtained mm/dd/yyyy') }}
            <span class="required">*</span>
            {{ Form::text("date_obtained$index", @$step->detail["date_obtained$index"], [
                'class' => 'form-control datePicker',
                'placeholder' => 'Enter Date'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("issued_lice_or_certi$index", 'Who Issued Your License or Certification? (if any)') }}
            <span class="required">*</span>
            {{ Form::text("issued_lice_or_certi$index", @$step->detail["issued_lice_or_certi$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Who Issued'
            ]) }}
        </div>
    </div>  
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("license_no$index", 'License Number? (if any)') }}
            <span class="required">*</span>
            {{ Form::text("license_no$index", @$step->detail["license_no$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter number'
            ]) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("exp_renewal_date$index", 'Expiration/Renewal Date  mm/dd/yyyy') }}
            <span class="required">*</span>
            {{ Form::text("exp_renewal_date$index", @$step->detail["exp_renewal_date$index"], [
                'class' => "form-control disablePastDate expRenewalDate$index",
                'placeholder' => 'Enter Date'
            ]) }}
            {{ Form::label('does_not_apply', "Does Not Apply") }}
            {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                'class' => 'custom-control-input doesNotApply',
                'data-field' => "expRenewalDate$index"
            ]) }}
        </div>
    </div>    
</div>