<div class="history-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-history me-2 text-primary"></i>Address & Employment History
    </h4>
    <p class="text-muted mb-4">Provide details about where you have lived and worked for the last five years.</p>

    <!-- Current Physical Address is now handled in Part 1 -->

    <!-- Address History -->
    <h5 class="mb-3 mt-4"><i class="fa fa-map-marked-alt me-2"></i>Address History (Last 5 Years)</h5>
    <div id="address-history-container">
        @php
            $addressHistory = optional($application)->applicant_address_history ?? [];
        @endphp
        @forelse($addressHistory as $index => $address)
            <div class="address-item border p-3 mb-3 rounded bg-light">
                <div class="d-flex justify-content-between mb-2">
                    <h6>Address #{{ $index + 1 }}</h6>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-history-item"><i class="fa fa-trash"></i></button>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <input type="text" name="applicant_address_history[{{ $index }}][street]" class="form-control" placeholder="Street Address" value="{{ $address['street'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" name="applicant_address_history[{{ $index }}][city]" class="form-control" placeholder="City" value="{{ $address['city'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" name="applicant_address_history[{{ $index }}][state]" class="form-control" placeholder="State/Province" value="{{ $address['state'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <input type="text" name="applicant_address_history[{{ $index }}][zip]" class="form-control" placeholder="ZIP/Postal Code" value="{{ $address['zip'] ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="small">Date From</label>
                        <input type="text" name="applicant_address_history[{{ $index }}][date_from]" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ $address['date_from'] ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="small">Date To</label>
                        <input type="text" name="applicant_address_history[{{ $index }}][date_to]" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ $address['date_to'] ?? '' }}">
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted small">No history added yet.</p>
        @endforelse
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary mb-4 add-history-item" data-type="address">
        <i class="fa fa-plus me-1"></i>Add Previous Address
    </button>

    <!-- Employment History -->
    <h5 class="mb-3 mt-4"><i class="fa fa-briefcase me-2"></i>Employment History (Last 5 Years)</h5>
    <div id="employment-history-container">
        @php
            $employmentHistory = optional($application)->applicant_employment_history ?? [];
        @endphp
        @forelse($employmentHistory as $index => $job)
            <div class="employment-item border p-3 mb-3 rounded bg-light">
                <div class="d-flex justify-content-between mb-2">
                    <h6>Employer #{{ $index + 1 }}</h6>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-history-item"><i class="fa fa-trash"></i></button>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <input type="text" name="applicant_employment_history[{{ $index }}][employer]" class="form-control" placeholder="Employer Name" value="{{ $job['employer'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="applicant_employment_history[{{ $index }}][occupation]" class="form-control" placeholder="Occupation" value="{{ $job['occupation'] ?? '' }}">
                    </div>
                    <div class="col-md-12 mb-2">
                        <input type="text" name="applicant_employment_history[{{ $index }}][address]" class="form-control" placeholder="Employer Address" value="{{ $job['address'] ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="small">Date From</label>
                        <input type="text" name="applicant_employment_history[{{ $index }}][date_from]" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ $job['date_from'] ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="small">Date To</label>
                        <input type="text" name="applicant_employment_history[{{ $index }}][date_to]" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ $job['date_to'] ?? '' }}">
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted small">No history added yet.</p>
        @endforelse
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary add-history-item" data-type="employment">
        <i class="fa fa-plus me-1"></i>Add Previous Employment
    </button>

    <!-- Navigation -->
    <div class="d-flex justify-content-between flex-wrap mt-5 gap-2">
        <button type="button" class="btn btn-primary aos-action-btn" onclick="$('#basis-tab').tab('show')">
            <i class="fa fa-arrow-left me-2"></i>Previous
        </button>
        <button type="button" class="btn btn-primary next-step aos-action-btn" data-next-tab="family-tab">
            Next <i class="fa fa-arrow-right ms-2"></i>
        </button>
    </div>
</div>
