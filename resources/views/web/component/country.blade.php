<!-- resources\views\web\component\country.blade.php -->
<div class="countryForm">
    @if ($index != 1)
        <div class="col-md-12 mb-4 {{@$data["country$index"] ? '' : 'd-none'}}">
            <a class="btn btn-tra-grey removeCountry">- Remove</a>
        </div>
    @endif
    <div class="form-group">
        {{ Form::select("country$index", getAllCountry(), @$data["country$index"], [
            'class' => 'form-control countryId'
        ]) }}
    </div>  
</div>