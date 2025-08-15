<div class="countryForm">
    @if ($index != 1)
        <div class="col-md-12 mb-4">
            <a class="btn btn-tra-grey removeCountry">- Remove</a>
        </div>
    @endif
    <h6>Residence {{ $index }}</h6>
    <div class="form-group">
        {{ Form::label("foreign_state$index", 'State') }}
        <span class="required">*</span>
        {{ Form::select("foreign_state$index", getAllUsStates(@$step->detail["foreignState$index"]), @$step->detail["foreign_state$index"], [
            'class' => "form-control foreignState$index",
        ]) }}
        @include('web.component.does-not-apply', ['field' => "foreignState$index", 'value' => @$step->detail["foreignState$index"]])
</div>
    <div class="form-group">
        {{ Form::label("foreign_country$index", 'Country') }}
        <span class="required">*</span>
        {{ Form::text("foreign_country$index", @$step->detail["foreign_country$index"], [
            'class' => 'form-control',
            'placeholder' => 'Enter Country',
        ]) }}
    </div>
</div>
