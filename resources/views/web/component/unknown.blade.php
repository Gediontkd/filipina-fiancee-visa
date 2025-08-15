{{ Form::label("$field", 'Unkown') }}
{{ Form::checkbox("$field", @$value, @$value == true ? true : '', [
    'class' => 'custom-control-input applyUnkown',
    'data-field' => $field,
]) }}
