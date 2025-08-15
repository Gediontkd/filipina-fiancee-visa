{{ Form::label("$field", 'Does Not Apply') }}
{{ Form::checkbox("$field", @$value, @$value == true ? true : '', [
    'class' => 'custom-control-input doesNotApply',
    'data-field' => $field,
]) }}
