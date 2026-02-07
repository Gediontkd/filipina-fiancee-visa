<div class="family-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-users me-2 text-primary"></i>Family Information
    </h4>

    <!-- Parents Information (Part 4) -->
    <h5 class="mb-3"><i class="fa fa-user-friends me-2"></i>Information About Your Parents</h5>
    @foreach(['parent1' => 'Parent 1', 'parent2' => 'Parent 2'] as $key => $label)
        <div class="{{ $key }}-section border p-3 mb-4 rounded bg-light">
            <h6 class="mb-3">{{ $label }}</h6>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <label class="small">First Name</label>
                    <input type="text" name="{{ $key }}_data[first_name]" class="form-control" value="{{ optional($application)->{$key.'_data'}['first_name'] ?? '' }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="small">Middle Name</label>
                    <input type="text" name="{{ $key }}_data[middle_name]" class="form-control" value="{{ optional($application)->{$key.'_data'}['middle_name'] ?? '' }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="small">Last Name</label>
                    <input type="text" name="{{ $key }}_data[last_name]" class="form-control" value="{{ optional($application)->{$key.'_data'}['last_name'] ?? '' }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="small">Date of Birth</label>
                    <input type="text" name="{{ $key }}_data[dob]" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ optional($application)->{$key.'_data'}['dob'] ?? '' }}">
                </div>
                <div class="col-md-4 mb-2">
                    <label class="small">Gender</label>
                    <select name="{{ $key }}_data[gender]" class="form-control">
                        <option value="">-Select-</option>
                        <option value="Male" {{ (optional($application)->{$key.'_data'}['gender'] ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ (optional($application)->{$key.'_data'}['gender'] ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <label class="small">City/Town of Birth</label>
                    <input type="text" name="{{ $key }}_data[pob_city]" class="form-control" value="{{ optional($application)->{$key.'_data'}['pob_city'] ?? '' }}">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="small">Country of Birth</label>
                    <select name="{{ $key }}_data[pob_country]" class="form-control">
                        <option value="">-Select Country-</option>
                        @foreach(getAllCountry() as $iso => $country)
                            <option value="{{ $country }}" {{ (optional($application)->{$key.'_data'}['pob_country'] ?? '') == $country ? 'selected' : '' }}>{{ $country }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="small">Current Residence (City, Country)</label>
                    <input type="text" name="{{ $key }}_data[residence]" class="form-control" placeholder="e.g., Manila, Philippines" value="{{ optional($application)->{$key.'_data'}['residence'] ?? '' }}">
                </div>
            </div>
        </div>
    @endforeach

    <!-- Marital History (Part 5) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-ring me-2"></i>Marital History</h5>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('marital_status', 'Current Marital Status') }}
                <span class="text-danger">*</span>
                {{ Form::select('marital_status', [
                    '' => '-Select Status-',
                    'Single' => 'Single',
                    'Married' => 'Married',
                    'Divorced' => 'Divorced',
                    'Widowed' => 'Widowed',
                    'Separated' => 'Legally Separated'
                ], optional($application)->marital_status ?? '', [
                    'class' => 'form-control',
                    'required' => true,
                    'id' => 'marital_status_family'
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                {{ Form::label('times_married', 'How many times have you been married?') }}
                {{ Form::number('times_married', optional($application)->times_married ?? 1, ['class' => 'form-control', 'min' => 0]) }}
            </div>
        </div>
    </div>

    <!-- Current Spouse (Only if Married) -->
    <div id="current_spouse_info" style="display: {{ (optional($application)->marital_status ?? '') === 'Married' ? 'block' : 'none' }};">
        <h6 class="mt-3 mb-2">Current Spouse Information</h6>
        <div class="border p-3 mb-4 rounded bg-white shadow-sm">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('spouse_name', 'Spouse Full Name') }}
                        {{ Form::text('spouse_name', optional($application)->spouse_name ?? '', ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group mb-3">
                        {{ Form::label('marriage_date', 'Date of Marriage') }}
                        {{ Form::text('marriage_date', optional($application)->marriage_date ? optional($application)->marriage_date->format('m/d/Y') : '', ['class' => 'form-control datePicker']) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Children Information (Part 6) -->
    <h5 class="mb-3 mt-4"><i class="fa fa-child me-2"></i>Information About Your Children</h5>
    <div class="form-check mb-3">
        {{ Form::checkbox('has_children', 1, optional($application)->has_children ?? false, ['class' => 'form-check-input', 'id' => 'has_children_check']) }}
        {{ Form::label('has_children_check', 'I have children (including biological, adopted, and stepchildren)', ['class' => 'form-check-label']) }}
    </div>

    <div id="children_list_container" style="display: {{ optional($application)->has_children ? 'block' : 'none' }};">
        <div id="children-items">
            @php $children = optional($application)->children_data ?? []; @endphp
            @foreach($children as $index => $child)
                <div class="child-item border p-3 mb-3 rounded bg-light shadow-sm">
                    <div class="d-flex justify-content-between mb-2">
                        <h6>Child #{{ $index + 1 }}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-family-item"><i class="fa fa-trash"></i></button>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label class="small">Full Name</label>
                            <input type="text" name="children_data[{{ $index }}][name]" class="form-control" value="{{ $child['name'] ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="small">Date of Birth</label>
                            <input type="text" name="children_data[{{ $index }}][dob]" class="form-control datePicker" value="{{ $child['dob'] ?? '' }}">
                        </div>
                        <div class="col-md-12">
                            <label class="small">A-Number (if any)</label>
                            <input type="text" name="children_data[{{ $index }}][a_number]" class="form-control" value="{{ $child['a_number'] ?? '' }}">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-sm btn-outline-primary add-family-item" data-type="child">
            <i class="fa fa-plus me-1"></i>Add Child
        </button>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between flex-wrap mt-5 gap-2">
        <button type="button" class="btn btn-primary aos-action-btn" onclick="$('#history-tab').tab('show')">
            <i class="fa fa-arrow-left me-2"></i>Previous
        </button>
        <button type="button" class="btn btn-primary next-step aos-action-btn" data-next-tab="immigration-tab">
            Next <i class="fa fa-arrow-right ms-2"></i>
        </button>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#marital_status_family').on('change', function() {
            if ($(this).val() === 'Married') {
                $('#current_spouse_info').show();
            } else {
                $('#current_spouse_info').hide();
            }
        });

        $('#has_children_check').on('change', function() {
            if ($(this).is(':checked')) {
                $('#children_list_container').show();
            } else {
                $('#children_list_container').hide();
            }
        });
    });
</script>
