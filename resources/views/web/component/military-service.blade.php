 <!-- resources\views\web\component\military-service.blade.php -->
 <div class="row servedMilitaryForm">
    @if ($index != 1)
        <div class="pb-4">
            <a class="btn btn-tra-grey removeMilitaryBtn">- Remove</a>
        </div>
    @endif
    <h4>Military Service #{{ $index }}</h4>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("country_military_service$index", "Country of military service") }}
            <span class="required">*</span>
            {{ Form::select("country_military_service$index", getAllCountry(), @$data["country_military_service$index"], [
                'class' => 'form-control'
            ]) }}
        </div>                            
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("branch_military_service$index", "Branch of military service") }}
            <span class="required">*</span>
            {{ Form::text("branch_military_service$index", @$data["branch_military_service$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Branch'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("rank_position$index", "Rank or position") }}
            <span class="required">*</span>
            {{ Form::text("rank_position$index", @$data["rank_position$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Rank or position'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("military_specialty$index", "Military specialty") }}
            <span class="required">*</span>
            {{ Form::text("military_specialty$index", @$data["military_specialty$index"], [
                'class' => 'form-control',
                'placeholder' => 'Enter Military specialty'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("start_date$index", "Start Date mm/dd/yyyy ") }}
            <span class="required">*</span>
            {{ Form::text("start_date$index", @$data["start_date$index"], [
                'class' => 'form-control dateOfBirth',
                'placeholder' => 'Enter Date'
            ]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label("end_date$index", "End Date mm/dd/yyyy ") }}
            <span class="required">*</span>
            {{ Form::text("end_date$index", @$data["end_date$index"], [
                'class' => 'form-control disablePastDate',
                'placeholder' => 'Enter Date'
            ]) }}
        </div>
    </div>
</div>