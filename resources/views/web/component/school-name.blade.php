<div class="row schoolForm">
    @if ($index != 1)
        <div class="col-md-12 mb-4">
            <a class="btn btn-tra-grey removeSchoolSec">- Remove</a>
        </div>
    @endif
    @if ($index == 1)
        <p>List all educational institutions attended by the alien after Elementary school (do not include Elementary
            school) You will list middle schools, high schools, vocational schools and college. Start with the most
            recent school. Schools before High School don't need to be listed if you run out of room. If you don't have
            exact details list your best estimate.</p>
    @endif
    <h4>School #{{ $index }}</h4>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("school_name$index", 'School name') }}
            <span class="required">*</span>
            {{ Form::text("school_name$index", @$data["school_name$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter School name ',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("street$index", 'Street') }}
            <span class="required">*</span>
            {{ Form::text("street$index", @$data["street$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Street',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("city$index", 'City') }}
            <span class="required">*</span>
            {{ Form::text("city$index", @$data["city$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter city',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("state_or_province$index", 'State or Province') }}
            <span class="required">*</span>
            {{ Form::text("state_or_province$index", @$data["state_or_province$index"], [
                'class' => "form-control stateProvince$index",
                'placeholder' => 'Enter State or Province.',
            ]) }}
            {{ Form::label('does_not_apply', 'Does Not Apply') }}
            {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                'class' => 'custom-control-input doesNotApply',
                'data-field' => "stateProvince$index",
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("postal_code$index", 'Postal Code') }}
            <span class="required">*</span>
            {{ Form::text("postal_code$index", @$data["postal_code$index"], [
                'class' => "form-control postalCode$index",
                'placeholder' => 'Enter Postal Code.',
            ]) }}
            {{ Form::label('does_not_apply', 'Does Not Apply') }}
            {{ Form::checkbox('does_not_apply', true, @$step->detail['does_not_apply'] == true ? true : '', [
                'class' => 'custom-control-input doesNotApply',
                'data-field' => "postalCode$index",
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("country$index", 'Country') }}
            <span class="required">*</span>
            {{ Form::select("country$index", getAllCountry(), @$data["country$index"], [
                'class' => 'form-control countryId',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("course_of_study$index", 'Course of study') }}
            <span class="required">*</span>
            {{ Form::text("course_of_study$index", @$data["course_of_study$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Course of study.',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("degree_or_diploma$index", 'Degree or Diploma') }}
            <span class="required">*</span>
            {{ Form::text("degree_or_diploma$index", @$data["degree_or_diploma$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Degree or Diploma.',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("start_date$index", 'Start Date  mm/dd/yyyy') }}
            <span class="required">*</span>
            {{ Form::text("start_date$index", @$data["start_date$index"], [
                'class' => 'form-control datePicker',
                'placeholder' => 'Enter Start Date',
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("end_date$index", 'End Date  mm/dd/yyyy') }}
            <span class="required">*</span>
            {{ Form::text("end_date$index", @$data["end_date$index"], [
                'class' => 'form-control datePicker',
                'placeholder' => 'Enter End Date',
            ]) }}
        </div>
    </div>
</div>
