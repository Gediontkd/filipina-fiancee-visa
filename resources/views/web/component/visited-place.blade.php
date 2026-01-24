<!-- resources\views\web\component\visited-place.blade.php -->
<div class="row visitedUSForm">
    @if ($index != 1)
        <div class="col-md-12 mb-4">
            <a class="btn btn-tra-grey removeVisitedUS">- Remove</a>
        </div>
    @endif
    <h4>List your last 3 visits to the United States.</h4>
    <h5>Visit #{{ $index }}</h5>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("stayed_primary_city_state$index", 'Primary city and state where you stayed.') }}
            <span class="required">*</span>
            {{ Form::text("stayed_primary_city_state$index", @$data["stayed_primary_city_state$index"], ['class' => 'form-control', 'placeholder' => 'Enter Primary city and state where you stayed']) }}     
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("what_visa_type$index", "Type of visa you used to enter the United States") }}
            <span class="required">*</span>
            {{ Form::select("what_visa_type$index", getAllVisaType(), @$data["what_visa_type$index"], [
                'class' => 'form-control'
            ]) }}                       
        </div>                                                    
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("registration_number$index", 'Your Alien Registration Number. You would not have one if you were a tourist.') }}
            <span class="required">*</span>
            {{ Form::text("registration_number$index", @$data["registration_number$index"], ['class' => "form-control regNo$index", 'placeholder' => 'Enter Registration Number']) }}
            {{ Form::label('does_not_apply', "None") }}
            {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                'class' => 'custom-control-input doesNotApply',
                'data-field' => "regNo$index"
            ]) }}   
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("visited_start_date$index", "Start date of this visit.  mm/dd/yyyy") }}
            <span class="required">*</span>
            {{ Form::text("visited_start_date$index", @$data["visited_start_date$index"], ['class' => 'form-control dateOfBirth', 'placeholder' => "Enter date"]) }}       
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("visited_end_date$index", "End date of this visit.  mm/dd/yyyy") }}
            <span class="required">*</span>
            {{ Form::text("visited_end_date$index", @$data["visited_end_date$index"], ['class' => 'form-control disablePastDate', 'placeholder' => "Enter date"]) }}       
        </div>
    </div>
</div>