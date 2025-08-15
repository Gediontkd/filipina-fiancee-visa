@switch(Route::currentRouteName())
    @case('fianceVisaApplication')
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
                            'placeholder' => 'Enter name',
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label("middle_name$index", 'Middle Name') }}
                        <span class="required">*</span>
                        {{ Form::text("middle_name$index", @$data["middle_name$index"], [
                            'class' => "form-control middleName$index",
                            'placeholder' => 'Enter name',
                        ]) }}
                        {{ Form::label('does_not_apply', 'Does Not Apply') }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "middleName$index",
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label("first_name$index", 'First Name') }}
                        <span class="required">*</span>
                        {{ Form::text("first_name$index", @$data["first_name$index"], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter name',
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("dob$index", 'Date of Birth (mm/dd/yyyy, okay to estimate or enter Unknown)') }}
                        <span class="required">*</span>
                        {{ Form::text("dob$index", @$data["dob$index"], [
                            'class' => 'form-control dateOfBirth',
                            'placeholder' => 'Enter Date of Birth',
                            "readonly" => true
                        ]) }}
                    </div>
                </div>
                @if (Route::currentRouteName() != 'fianceVisaApplication')
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label("birth_city$index", 'Birth City') }}
                            <span class="required">*</span>
                            {{ Form::text("birth_city$index", @$data["birth_city$index"], [
                                'class' => "form-control birthCity$index",
                                'placeholder' => 'Enter City of Birth',
                            ]) }}
                            {{ Form::label('does_not_apply', 'Does Not Apply') }}
                            {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                                'class' => 'custom-control-input doesNotApply',
                                'data-field' => "birthCity$index",
                            ]) }}
                        </div>
                    </div>
                @endif
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("birth_province$index", 'Birth Province') }}
                        <span class="required">*</span>
                        {{ Form::text("birth_province$index", @$data["birth_province$index"], [
                            'class' => "form-control birthProvince$index",
                            'placeholder' => 'Enter Birth Province',
                        ]) }}
                        {{ Form::label('does_not_apply', 'Does Not Apply') }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "birthProvince$index",
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("birth_country$index", 'Country of Birth ') }}
                        <span class="required">*</span>
                        {{ Form::select("birth_country$index", getAllCountry(), @$data["birth_country$index"], [
                            'class' => 'form-control',
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("citizenship_country$index", 'Country of Citizenship (Nationality)') }}
                        <span class="required">*</span>
                        {{ Form::select("citizenship_country$index", getAllCountry(), @$data["citizenship_country$index"], [
                            'class' => 'form-control',
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("date_of_marriage$index", 'Date of Marriage') }}
                        <span class="required">*</span>
                        {{ Form::text("date_of_marriage$index", @$data["date_of_marriage$index"], ['class' => 'form-control datePicker', 'placeholder' => 'Enter Date Of Marriage', , "readonly" => true]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("place_of_marriage$index", 'Place of Marriage') }}
                        <span class="required">*</span>
                        {{ Form::text("place_of_marriage$index", @$data["place_of_marriage$index"], ['class' => 'form-control', 'placeholder' => 'Enter Place of Marriage']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("place_marriage_ended$index", 'Place Marriage Ended ') }}
                        <span class="required">*</span>
                        {{ Form::text("place_marriage_ended$index", @$data["place_marriage_ended$index"], ['class' => 'form-control', 'placeholder' => 'Enter Place Marriage Ended']) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("how_marriage_ended$index", 'How Marriage Ended (Legal documentation required)') }}
                        <span class="required">*</span>
                        {{ Form::select(
                            "how_marriage_ended$index",
                            [
                                '' => 'Select',
                                'Annulment' => 'Annulment',
                                'Death' => 'Death',
                                // 'Dissolution' => 'Dissolution',
                                'Divorce' => 'Divorce',
                            ],
                            @$data["how_marriage_ended$index"],
                            [
                                'class' => 'form-control',
                            ],
                        ) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("date_marriage_ended$index", 'Date Marriage Ended') }}
                        <span class="required">*</span>
                        {{ Form::text("date_marriage_ended$index", @$data["date_marriage_ended$index"], ['class' => 'form-control datePicker', 'placeholder' => 'Enter Date Marriage Ended', 'readonly' => true]) }}
                    </div>
                </div>
            </div>
        </div>
    @break

    @case('spouseVisaApplication')
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
                            'placeholder' => 'Enter name',
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label("middle_name$index", 'Middle Name') }}
                        <span class="required">*</span>
                        {{ Form::text("middle_name$index", @$data["middle_name$index"], [
                            'class' => "form-control middleName$index",
                            'placeholder' => 'Enter name',
                        ]) }}
                        {{ Form::label('does_not_apply', 'Does Not Apply') }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "middleName$index",
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label("first_name$index", 'First Name') }}
                        <span class="required">*</span>
                        {{ Form::text("first_name$index", @$data["first_name$index"], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter name',
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("dob$index", 'Date of Birth (mm/dd/yyyy, okay to estimate or enter Unknown)') }}
                        <span class="required">*</span>
                        {{ Form::text("dob$index", @$data["dob$index"], [
                            'class' => 'form-control dateOfBirth',
                            'placeholder' => 'Enter Date of Birth',
                            'readonly' => true
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("birth_city$index", 'Birth City') }}
                        <span class="required">*</span>
                        {{ Form::text("birth_city$index", @$data["birth_city$index"], [
                            'class' => "form-control birthCity$index",
                            'placeholder' => 'Enter City of Birth',
                        ]) }}
                        {{ Form::label('does_not_apply', 'Does Not Apply') }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "birthCity$index",
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("city_state_of_marriage$index", 'City and State of Marriage (city and country if not USA)  ') }}
                        <span class="required">*</span>
                        {{ Form::text("city_state_of_marriage$index", @$data["city_state_of_marriage$index"], ['class' => 'form-control', 'placeholder' => 'Enter City and State of Marriage']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("where_marriage_ended$index", 'City and State where marriage ended (city and country if not USA)') }}
                        <span class="required">*</span>
                        {{ Form::text("where_marriage_ended$index", @$data["where_marriage_ended$index"], ['class' => 'form-control', 'placeholder' => 'City and State where marriage ended']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("date_marriage_ended$index", 'Date Marriage Ended') }}
                        <span class="required">*</span>
                        {{ Form::text("date_marriage_ended$index", @$data["date_marriage_ended$index"], ['class' => 'form-control datePicker', 'placeholder' => 'Enter Date Marriage Ended', 'readonly' => true]) }}
                    </div>
                </div>
            </div>
        </div>
    @break

    @case('adjustmentVisaApplication')
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
                            'placeholder' => 'Enter name',
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label("middle_name$index", 'Middle Name') }}
                        <span class="required">*</span>
                        {{ Form::text("middle_name$index", @$data["middle_name$index"], [
                            'class' => "form-control middleName$index",
                            'placeholder' => 'Enter name',
                        ]) }}
                        {{ Form::label('does_not_apply', 'Does Not Apply') }}
                        {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                            'class' => 'custom-control-input doesNotApply',
                            'data-field' => "middleName$index",
                        ]) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label("first_name$index", 'First Name') }}
                        <span class="required">*</span>
                        {{ Form::text("first_name$index", @$data["first_name$index"], [
                            'class' => 'form-control',
                            'placeholder' => 'Enter name',
                        ]) }}
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label("dob$index", 'Date of Birth (mm/dd/yyyy, okay to estimate or enter Unknown)') }}
                        <span class="required">*</span>
                        {{ Form::text("dob$index", @$data["dob$index"], [
                            'class' => 'form-control dateOfBirth',
                            'placeholder' => 'Enter Date of Birth',
                            'readonly' => true
                        ]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("date_of_marriage$index", 'Date of Marriage') }}
                        <span class="required">*</span>
                        {{ Form::text("date_of_marriage$index", @$data["date_of_marriage$index"], ['class' => 'form-control datePicker', 'placeholder' => 'Enter Date Of Marriage', 'readonly' => true]) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("place_of_marriage$index", 'Place of Marriage') }}
                        <span class="required">*</span>
                        {{ Form::text("place_of_marriage$index", @$data["place_of_marriage$index"], ['class' => 'form-control', 'placeholder' => 'Enter Place of Marriage']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("place_marriage_ended$index", 'Place Marriage Ended ') }}
                        <span class="required">*</span>
                        {{ Form::text("place_marriage_ended$index", @$data["place_marriage_ended$index"], ['class' => 'form-control', 'placeholder' => 'Enter Place Marriage Ended']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label("date_marriage_ended$index", 'Date Marriage Ended') }}
                        <span class="required">*</span>
                        {{ Form::text("date_marriage_ended$index", @$data["date_marriage_ended$index"], ['class' => 'form-control datePicker', 'placeholder' => 'Enter Date Marriage Ended', 'readonly' => true]) }}
                    </div>
                </div>
            </div>
        </div>
    @break

@endswitch
