<!-- resources\views\web\component\does-not-apply.blade.php -->
{{ Form::label("does_not_apply_$field", 'Does Not Apply') }}
{{ Form::checkbox("does_not_apply_$field", true, @$value == true ? true : false, [
    'class' => 'custom-control-input doesNotApply',
    'data-field' => $field,
]) }}