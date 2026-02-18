<div class="eligibility-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-id-card me-2 text-primary"></i>Biographic Information
    </h4>



    <div class="row mb-4">
        <!-- 1. Ethnicity -->
        <div class="col-md-12 mb-3">
            <label class="fw-bold d-block">1. Ethnicity (Select only one box)</label>
            <div class="mt-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ethnicity" id="ethnicity_hispanic" value="Hispanic or Latino" {{ (optional($application)->ethnicity == 'Hispanic or Latino') ? 'checked' : '' }} required>
                    <label class="form-check-label" for="ethnicity_hispanic">Hispanic or Latino</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="ethnicity" id="ethnicity_not_hispanic" value="Not Hispanic or Latino" {{ (optional($application)->ethnicity == 'Not Hispanic or Latino') ? 'checked' : '' }} required>
                    <label class="form-check-label" for="ethnicity_not_hispanic">Not Hispanic or Latino</label>
                </div>
            </div>
        </div>

        <!-- 2. Race -->
        <div class="col-md-12 mb-3">
            <label class="fw-bold d-block">2. Race (Select only one box)</label>
            <div class="mt-2">
                @php
                    $races = [
                        'White' => 'White',
                        'Asian' => 'Asian',
                        'Black or African American' => 'Black or African American',
                        'American Indian or Alaska Native' => 'American Indian or Alaska Native',
                        'Native Hawaiian or Other Pacific Islander' => 'Native Hawaiian or Other Pacific Islander'
                    ];
                    $selectedRace = optional($application)->race;
                    if (is_array($selectedRace)) { $selectedRace = $selectedRace[0] ?? ''; }
                @endphp
                @foreach($races as $value => $label)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="race" id="race_{{ Str::slug($value) }}" value="{{ $value }}" {{ $selectedRace == $value ? 'checked' : '' }}>
                        <label class="form-check-label" for="race_{{ Str::slug($value) }}">{{ $label }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- 3. Height -->
        <div class="col-md-6 mb-3">
            <label class="fw-bold d-block">3. Height</label>
            <div class="row mt-1">
                <div class="col-6">
                    <label class="small text-muted">Feet</label>
                    {{ Form::number('height_feet', optional($application)->height_feet ?? '', ['class' => 'form-control', 'min' => 1, 'max' => 8, 'placeholder' => 'Feet']) }}
                </div>
                <div class="col-6">
                    <label class="small text-muted">Inches</label>
                    {{ Form::number('height_inches', optional($application)->height_inches ?? '', ['class' => 'form-control', 'min' => 0, 'max' => 11, 'placeholder' => 'Inches']) }}
                </div>
            </div>
        </div>

        <!-- 4. Weight -->
        <div class="col-md-6 mb-3">
            <label class="fw-bold d-block">4. Weight</label>
            <div class="mt-1">
                <label class="small text-muted">Pounds</label>
                {{ Form::number('weight_pounds', optional($application)->weight_pounds ?? '', ['class' => 'form-control', 'min' => 50, 'max' => 500, 'placeholder' => 'Pounds']) }}
            </div>
        </div>

        <!-- 5. Eye Color -->
        <div class="col-md-6 mb-3">
            <label class="small fw-bold">5. Eye Color (Select only one box)</label>
            {{ Form::select('eye_color', [
                '' => '-Select-',
                'Blue' => 'Blue',
                'Black' => 'Black',
                'Brown' => 'Brown',
                'Gray' => 'Gray',
                'Green' => 'Green',
                'Hazel' => 'Hazel',
                'Maroon' => 'Maroon',
                'Pink' => 'Pink',
                'Unknown/Other' => 'Unknown/Other'
            ], optional($application)->eye_color ?? '', ['class' => 'form-control', 'required' => true]) }}
        </div>

        <!-- 6. Hair Color -->
        <div class="col-md-6 mb-3">
            <label class="small fw-bold">6. Hair Color (Select only one box)</label>
            {{ Form::select('hair_color', [
                '' => '-Select-',
                'Bald' => 'Bald (No hair)',
                'Black' => 'Black',
                'Blond' => 'Blond',
                'Brown' => 'Brown',
                'Gray' => 'Gray',
                'Red' => 'Red',
                'Sandy' => 'Sandy',
                'White' => 'White',
                'Unknown/Other' => 'Unknown/Other'
            ], optional($application)->hair_color ?? '', ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>

</div>