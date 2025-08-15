<div class="row appendRelativeForm">
    @if ($index != 1)
        <div class="col-md-6 mb-3">
            <a class="btn btn-tra-grey removeRelativeBtn">- Remove</a>
        </div>
    @endif
    <h5>Relative {{ $index }}</h5>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("relative_f_and_name$index", "Relative's First and Middle Name ") }}
            <span class="required">*</span>
            {{ Form::text("relative_f_and_name$index", @$step->detail["relative_f_and_name$index"], ['class' => 'form-control disablePastDate', 'placeholder' => 'Enter Name']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label("relative_l_and_name$index", "Relative's Last Name (family name)") }}
            <span class="required">*</span>
            {{ Form::text("relative_l_and_name$index", @$step->detail["relative_l_and_name$index"], ['class' => 'form-control disablePastDate', 'placeholder' => 'Enter Last Name']) }}
            <span>If there is a suffix after the name such as Jr. or III, put that here after the last name.</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("relationship$index", "Alien's relationship to this person.") }}
            <span class="required">*</span>
            {{ Form::select(
                "relationship$index",
                [
                    '' => 'Select One',
                    'Son' => 'Son',
                    'Daughter' => 'Daughter',
                    'Brother' => 'Brother',
                    'Sister' => 'Sister',
                ],
                @$step->detail["relationship$index"],
                ['class' => 'form-control'],
            ) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("relative_status$index", "Relative's Status") }}
            <span class="required">*</span>
            {{ Form::select(
                "relative_status$index",
                [
                    '' => 'Select One',
                    'U.S. Citizen' => 'U.S. Citizen',
                    'U.S. Legal Permanent Resident (LPR)' => 'U.S. Legal Permanent Resident (LPR)',
                    'NonImmigrant' => 'NonImmigrant',
                    "Other - Don't Know" => "Other - Don't Know",
                ],
                @$step->detail["relative_status$index"],
                ['class' => 'form-control'],
            ) }}
        </div>
    </div>
</div>
