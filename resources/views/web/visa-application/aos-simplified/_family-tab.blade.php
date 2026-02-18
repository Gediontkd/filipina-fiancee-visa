<div class="family-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-users me-2 text-primary"></i>Family Information
    </h4>

    <!-- Information About Your Parents (Part 4) -->
    <h5 class="mb-3"><i class="fa fa-user-friends me-2"></i>Part 4. Information About Your Parents</h5>
    
    <!-- Parent 1 -->
    <div class="parent1-section border p-3 mb-4 rounded bg-light">
        <h6 class="mb-3 text-primary fw-bold">Information About Your Parent 1</h6>
        <div class="row">
            <div class="col-md-12 mb-2">
                <label class="small fw-bold">1. Parent 1's Legal Name</label>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label class="small">Family Name (Last Name)</label>
                        <input type="text" name="parent1_data[last_name]" class="form-control" value="{{ optional($application)->parent1_data['last_name'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Given Name (First Name)</label>
                        <input type="text" name="parent1_data[first_name]" class="form-control" value="{{ optional($application)->parent1_data['first_name'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Middle Name (if applicable)</label>
                        <input type="text" name="parent1_data[middle_name]" class="form-control" value="{{ optional($application)->parent1_data['middle_name'] ?? '' }}">
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 mb-3">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="small fw-bold">Date of Birth (mm/dd/yyyy)</label>
                        <input type="text" name="parent1_data[dob]" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ optional($application)->parent1_data['dob'] ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <label class="small fw-bold">2. Parent 1's Name at Birth (if different than above)</label>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label class="small">Family Name (Last Name)</label>
                        <input type="text" name="parent1_data[birth_last_name]" class="form-control" value="{{ optional($application)->parent1_data['birth_last_name'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Given Name (First Name)</label>
                        <input type="text" name="parent1_data[birth_first_name]" class="form-control" value="{{ optional($application)->parent1_data['birth_first_name'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Middle Name (if applicable)</label>
                        <input type="text" name="parent1_data[birth_middle_name]" class="form-control" value="{{ optional($application)->parent1_data['birth_middle_name'] ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <label class="small fw-bold">Country of Birth</label>
                <select name="parent1_data[pob_country]" class="form-control">
                    <option value="">-Select Country-</option>
                    @foreach(getCountries() as $iso => $country)
                        <option value="{{ $country }}" {{ (optional($application)->parent1_data['pob_country'] ?? '') == $country ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Parent 2 -->
    <div class="parent2-section border p-3 mb-4 rounded bg-light">
        <h6 class="mb-3 text-primary fw-bold">Information About Your Parent 2</h6>
        <div class="row">
            <div class="col-md-12 mb-2">
                <label class="small fw-bold">1. Parent 2's Legal Name</label>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label class="small">Family Name (Last Name)</label>
                        <input type="text" name="parent2_data[last_name]" class="form-control" value="{{ optional($application)->parent2_data['last_name'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Given Name (First Name)</label>
                        <input type="text" name="parent2_data[first_name]" class="form-control" value="{{ optional($application)->parent2_data['first_name'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Middle Name (if applicable)</label>
                        <input type="text" name="parent2_data[middle_name]" class="form-control" value="{{ optional($application)->parent2_data['middle_name'] ?? '' }}">
                    </div>
                </div>
            </div>
            
            <div class="col-md-12 mb-3">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="small fw-bold">Date of Birth (mm/dd/yyyy)</label>
                        <input type="text" name="parent2_data[dob]" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ optional($application)->parent2_data['dob'] ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <label class="small fw-bold">2. Parent 2's Name at Birth (if different than above)</label>
                <div class="row">
                    <div class="col-md-4 mb-2">
                        <label class="small">Family Name (Last Name)</label>
                        <input type="text" name="parent2_data[birth_last_name]" class="form-control" value="{{ optional($application)->parent2_data['birth_last_name'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Given Name (First Name)</label>
                        <input type="text" name="parent2_data[birth_first_name]" class="form-control" value="{{ optional($application)->parent2_data['birth_first_name'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Middle Name (if applicable)</label>
                        <input type="text" name="parent2_data[birth_middle_name]" class="form-control" value="{{ optional($application)->parent2_data['birth_middle_name'] ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-2">
                <label class="small fw-bold">Country of Birth</label>
                <select name="parent2_data[pob_country]" class="form-control">
                    <option value="">-Select Country-</option>
                    @foreach(getCountries() as $iso => $country)
                        <option value="{{ $country }}" {{ (optional($application)->parent2_data['pob_country'] ?? '') == $country ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>





</div>

<script>
    $(document).ready(function() {



    });
</script>
