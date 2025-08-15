<div class="row relativeForm">
    @if ($index != 1)
        <div class="col-md-12 mb-4">
            <a class="btn btn-tra-grey removeRelative">- Remove</a>
        </div>
    @endif
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("fl_name$index", 'Family Name (Last Name)?') }}
            <span class="required">*</span>
            {{ Form::text("fl_name$index", @$step->detail["fl_name$index"], ['class' => 'form-control', 'placeholder' => 'Enter Name']) }}                          
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("gf_name$index", 'Given Name (First Name)') }}
            <span class="required">*</span>
            {{ Form::text("gf_name$index", @$step->detail["gf_name$index"], ['class' => 'form-control', 'placeholder' => 'Enter Name']) }}                          
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("m_name$index", 'Middle Name') }}
            <span class="required">*</span>
            {{ Form::text("m_name$index", @$step->detail["m_name$index"], ['class' => 'form-control', 'placeholder' => 'Enter Name']) }}                          
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("relationship$index", 'Relationship') }}
            <span class="required">*</span>
            {{ Form::select("relationship$index", [
                    '' => '- Select Relationship -',
                    'Brother' => 'Brother',
                    'Daughter' => 'Daughter',
                    'Father' => 'Father',
                    'Mother' => 'Mother',
                    'Sister' => 'Sister',
                    'Son' => 'Son',
                    'Spouse' => 'Spouse',
                    'Step-Daughter' => 'Step-Daughter',
                    'Step-Son' => 'Step-Son',
                ], @$step->detail["relationship$index"], ['class' => 'form-control',]) }}                          
        </div>
    </div>
</div>