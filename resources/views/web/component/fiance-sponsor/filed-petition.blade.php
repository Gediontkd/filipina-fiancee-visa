<div class="row filedPetitionForm">
    @if ($index != 1)
        <div class="col-md-6 mb-4">
            <a class="btn btn-tra-grey removefiledPetition">- Remove {{ $index }} prior spouse</a>
        </div>
    @endif
     <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("alien_fname$index", "Alien's First Name") }}
            <span class="required">*</span>
            {{ Form::text("alien_fname$index", @$step->detail["alien_fname$index"], ['class' => 'form-control', 'placeholder' => 'Enter Name']) }}        
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("alien_mname$index", "Alien's Middle Name") }}
            <span class="required">*</span>
            {{ Form::text("alien_mname$index", @$step->detail["alienMName$index"] ? 'N/A' : @$step->detail["alien_mname$index"], ['class' => "form-control alienMName$index", 'placeholder' => 'Enter Name']) }}        
            @include('web.component.does-not-apply', ['field' => "alienMName$index", 'value' => @$step->detail["alienMName$index"]])
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("alien_mlname$index", "Alien's Maiden Last Name (family name)") }}
            <span class="required">*</span>
            {{ Form::text("alien_mlname$index", @$step->detail["alien_mlname$index"], ['class' => 'form-control', 'placeholder' => 'Enter Name']) }}        
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("alien_reg_no$index", 'Alien Registration Number or A#. Do not include the "A" or #.') }}
            <span class="required">*</span>
            {{ Form::text("alien_reg_no$index", @$step->detail["alienRegNo$index"] ? 'Unkown' : @$step->detail["alien_reg_no$index"], ['class' => "form-control alienRegNo$index", 'placeholder' => 'Enter Number']) }}        
            @include('web.component.unknown', ['field' => "alienRegNo$index", 'value' => @$step->detail["alienRegNo$index"]])
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("alien_city_filing$index", "City of Filing") }}
            <span class="required">*</span>
            {{ Form::text("alien_city_filing$index", @$step->detail["alien_city_filing$index"], ['class' => 'form-control', 'placeholder' => 'Enter City']) }}        
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("us_State$index", "U.S. State (Select Does Not Apply if not USA)") }}
            <span class="required">*</span>
            {{ Form::select("us_State$index", [], @$step->detail["us_State$index"], [
                'class' => 'form-control states',
                'data-state' => @$step->detail["us_State$index"],
                'readonly' => @$step->detail['contactUsState'] ? true : false
            ]) }}       
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("date_of_filing$index", "Date of Filing (mm/dd/yyyy, okay to estimate)") }}
            <span class="required">*</span>
            {{ Form::text("date_of_filing$index", @$step->detail["date_of_filing$index"], ['class' => 'form-control datePicker', 'placeholder' => 'Enter Date']) }}        
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("results_of_App$index", "Results of Application") }}
            <span class="required">*</span>
            {{ Form::select("results_of_App$index", [
                '' => 'Select', 
                'Approved, divorced and still in USA.' => 'Approved, divorced and still in USA.',
                'Approved, divorced left USA.' => 'Approved, divorced left USA.',
                'Approved, divorced location unknown.' => 'Approved, divorced location unknown.',
                'Approved but now deceased.' => 'Approved but now deceased.',
                'Approved but now deceased.' => 'Approved but now deceased.',
                'Approved, never came to USA.' => 'Approved, never came to USA.',
                'Approved, waiting for a Visa.' => 'Approved, waiting for a Visa.',
                'Approved, still in USA.' => 'Approved, still in USA.',
                'Approved, no longer in USA.' => 'Approved, no longer in USA.',
                'Denied, still in USA.' => 'Denied, still in USA.',
                'Denied, no longer in USA.' => 'Denied, no longer in USA.',
                'Denied, never came to USA' => 'Denied, never came to USA',
                'Denied, location unknown.' => 'Denied, location unknown.',
                'Denied and now deceased.' => 'Denied and now deceased.',
                'Withdrawn before approval.' => 'Withdrawn before approval.',
                'Withdrawn due to death.' => 'Withdrawn due to death.',
                'Status Unknown. Location Unknown.' => 'Status Unknown. Location Unknown.',
            ], @$data["results_of_App$index"], [
                'class' => 'form-control'
            ]) }}                     
        </div>    
    </div>
</div>