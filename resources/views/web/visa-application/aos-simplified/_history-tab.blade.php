<div class="history-section">
    <h4 class="mb-4 border-bottom pb-2">
        4. Additional Information About You
    </h4>

    <!-- Part 4: Additional Information About You -->
    <div class="additional-info-section mb-4">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="form-group">
                    <label class="d-block mb-2 fw-bold">1. Have you ever applied for an immigrant visa to obtain permanent resident status at a U.S. Embassy or U.S. Consulate abroad?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="applied_for_immigrant_visa_abroad" id="applied_visa_abroad_yes" value="1" {{ ($application->applied_for_immigrant_visa_abroad ?? null) === true ? 'checked' : '' }}>
                        <label class="form-check-label" for="applied_visa_abroad_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="applied_for_immigrant_visa_abroad" id="applied_visa_abroad_no" value="0" {{ ($application->applied_for_immigrant_visa_abroad ?? null) === false ? 'checked' : '' }}>
                        <label class="form-check-label" for="applied_visa_abroad_no">No</label>
                    </div>
                </div>

                <div id="immigrant-visa-details" class="mt-3 p-3 border rounded bg-light" style="display: {{ ($application->applied_for_immigrant_visa_abroad ?? false) ? 'block' : 'none' }};">
                    <p class="text-muted small mb-3">If you answered "Yes," complete Item Numbers 1.A. - 1.D. below.</p>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold">1.A. City or Town</label>
                            <input type="text" name="immigrant_visa_location_city" class="form-control mb-2" placeholder="City or Town" value="{{ $application->immigrant_visa_location_city ?? '' }}">
                            <label class="small fw-bold">1.B. Country</label>
                            <input type="text" name="immigrant_visa_location_country" class="form-control" placeholder="Country" value="{{ $application->immigrant_visa_location_country ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold">1.C. Decision (e.g., approved, refused, denied, withdrawn)</label>
                            <input type="text" name="immigrant_visa_decision" class="form-control" placeholder="Decision" value="{{ $application->immigrant_visa_decision ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold">1.D. Date of Decision</label>
                            <input type="text" name="immigrant_visa_decision_date" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ $application->immigrant_visa_decision_date ? $application->immigrant_visa_decision_date->format('m/d/Y') : '' }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="form-group">
                    <label class="d-block mb-2 fw-bold">2. Have you previously applied for permanent residence while in the United States?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="applied_for_permanent_residence_us" id="applied_pr_us_yes" value="1" {{ ($application->applied_for_permanent_residence_us ?? null) === true ? 'checked' : '' }}>
                        <label class="form-check-label" for="applied_pr_us_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="applied_for_permanent_residence_us" id="applied_pr_us_no" value="0" {{ ($application->applied_for_permanent_residence_us ?? null) === false ? 'checked' : '' }}>
                        <label class="form-check-label" for="applied_pr_us_no">No</label>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <div class="form-group">
                    <label class="d-block mb-2 fw-bold">3. Have you EVER held lawful permanent resident status which was later rescinded under INA section 246?</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rescinded_lpr_status" id="rescinded_lpr_yes" value="1" {{ ($application->rescinded_lpr_status ?? null) === true ? 'checked' : '' }}>
                        <label class="form-check-label" for="rescinded_lpr_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="rescinded_lpr_status" id="rescinded_lpr_no" value="0" {{ ($application->rescinded_lpr_status ?? null) === false ? 'checked' : '' }}>
                        <label class="form-check-label" for="rescinded_lpr_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- History Header -->
    <h4 class="mb-4 border-bottom pb-2 mt-4">
        Employment and Educational History
    </h4>
    <p class="text-muted mb-4">Provide details about where you have worked, or attended school for the last five years.</p>

    <!-- Employment and Educational History -->
    <h5 class="mb-3 mt-4">Employment and Educational History (Last 5 Years)</h5>
    <p class="text-muted small mb-3">Provide ALL of your employment and educational history for the last 5 years. Include periods of self-employment, unemployment, or retirement.</p>
    
    <div id="employment-history-container">
        @php
            $employmentHistory = optional($application)->applicant_employment_history ?? [];
        @endphp
        @forelse($employmentHistory as $index => $job)
            <div class="employment-item border p-3 mb-3 rounded bg-white shadow-sm">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="text-primary fw-bold">Employer or School #{{ $index + 1 }}</h6>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-history-item"><i class="fa fa-trash"></i></button>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="small fw-bold">Name of Employer, Company, or School</label>
                        <input type="text" name="applicant_employment_history[{{ $index }}][employer]" class="form-control" placeholder="Employer or School" value="{{ $job['employer'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="small fw-bold">Your Occupation (if unemployed or retired, so state)</label>
                        <input type="text" name="applicant_employment_history[{{ $index }}][occupation]" class="form-control" placeholder="Occupation" value="{{ $job['occupation'] ?? '' }}">
                    </div>
                    
                    <div class="col-md-12 mb-2">
                        <label class="small fw-bold text-primary">Address of Employer, Company, or School</label>
                        <div class="row">
                            <div class="col-md-8 mb-2">
                                <label class="small fw-bold">Street Number and Name</label>
                                <input type="text" name="applicant_employment_history[{{ $index }}][street]" class="form-control" placeholder="Street Address" value="{{ $job['street'] ?? '' }}">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="small fw-bold">Unit Type</label>
                                <select name="applicant_employment_history[{{ $index }}][unit_type]" class="form-control">
                                    <option value="">-Select-</option>
                                    <option value="Apt" {{ (@$job['unit_type'] == 'Apt') ? 'selected' : '' }}>Apt.</option>
                                    <option value="Ste" {{ (@$job['unit_type'] == 'Ste') ? 'selected' : '' }}>Ste.</option>
                                    <option value="Flr" {{ (@$job['unit_type'] == 'Flr') ? 'selected' : '' }}>Flr.</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="small fw-bold">Number</label>
                                <input type="text" name="applicant_employment_history[{{ $index }}][unit_number]" class="form-control" placeholder="Number" value="{{ $job['unit_number'] ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small fw-bold">City or Town</label>
                                <input type="text" name="applicant_employment_history[{{ $index }}][city]" class="form-control" placeholder="City" value="{{ $job['city'] ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small fw-bold">State (U.S. Only)</label>
                                <input type="text" name="applicant_employment_history[{{ $index }}][state]" class="form-control" placeholder="State" value="{{ $job['state'] ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small fw-bold">ZIP Code (U.S. Only)</label>
                                <input type="text" name="applicant_employment_history[{{ $index }}][zip]" class="form-control" placeholder="ZIP" value="{{ $job['zip'] ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small fw-bold">Province (Foreign Only)</label>
                                <input type="text" name="applicant_employment_history[{{ $index }}][province]" class="form-control" placeholder="Province" value="{{ $job['province'] ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small fw-bold">Postal Code (Foreign Only)</label>
                                <input type="text" name="applicant_employment_history[{{ $index }}][postal_code]" class="form-control" placeholder="Postal Code" value="{{ $job['postal_code'] ?? '' }}">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small fw-bold">Country</label>
                                <input type="text" name="applicant_employment_history[{{ $index }}][country]" class="form-control" placeholder="Country" value="{{ $job['country'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="small fw-bold">Dates of Employment, Unemployment, Retirement, or School Attendance</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="small">From (mm/dd/yyyy)</label>
                                <input type="text" name="applicant_employment_history[{{ $index }}][date_from]" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ $job['date_from'] ?? '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="small">To (mm/dd/yyyy)</label>
                                <input type="text" name="applicant_employment_history[{{ $index }}][date_to]" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ $job['date_to'] ?? '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="small fw-bold">If unemployed or retired, source of financial support:</label>
                        <input type="text" name="applicant_employment_history[{{ $index }}][financial_support]" class="form-control" placeholder="Source of financial support" value="{{ $job['financial_support'] ?? '' }}">
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted small">No history added yet.</p>
        @endforelse
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary add-history-item" data-type="employment">
        <i class="fa fa-plus me-1"></i>Add Previous Employment or School
    </button>

    <!-- Section 8: Most Recent Foreign Employer -->
    <h4 class="mb-4 border-bottom pb-2 mt-5">
        8. Most Recent Employer or School Outside the United States
    </h4>
    <p class="text-muted small mb-3">Provide your most recent employer or school outside of the United States (if not already listed above).</p>
    
    <div class="foreign-employer-section border p-3 mb-3 rounded bg-white shadow-sm">
        @php
            $foreignEmp = optional($application)->most_recent_foreign_employer ?? [];
        @endphp
        <div class="row">
            <div class="col-md-6 mb-2">
                <label class="small fw-bold">Name of Employer, Company, or School</label>
                <input type="text" name="most_recent_foreign_employer[employer]" class="form-control" placeholder="Employer or School" value="{{ $foreignEmp['employer'] ?? '' }}">
            </div>
            <div class="col-md-6 mb-2">
                <label class="small fw-bold">Your Occupation (if unemployed or retired, so state)</label>
                <input type="text" name="most_recent_foreign_employer[occupation]" class="form-control" placeholder="Occupation" value="{{ $foreignEmp['occupation'] ?? '' }}">
            </div>
            
            <div class="col-md-12 mb-2">
                <label class="small fw-bold text-primary">Address of Employer, Company, or School</label>
                <div class="row">
                    <div class="col-md-8 mb-2">
                        <label class="small fw-bold">Street Number and Name</label>
                        <input type="text" name="most_recent_foreign_employer[street]" class="form-control" placeholder="Street Address" value="{{ $foreignEmp['street'] ?? '' }}">
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="small fw-bold">Unit Type</label>
                        <select name="most_recent_foreign_employer[unit_type]" class="form-control">
                            <option value="">-Select-</option>
                            <option value="Apt" {{ (@$foreignEmp['unit_type'] == 'Apt') ? 'selected' : '' }}>Apt.</option>
                            <option value="Ste" {{ (@$foreignEmp['unit_type'] == 'Ste') ? 'selected' : '' }}>Ste.</option>
                            <option value="Flr" {{ (@$foreignEmp['unit_type'] == 'Flr') ? 'selected' : '' }}>Flr.</option>
                        </select>
                    </div>
                    <div class="col-md-2 mb-2">
                        <label class="small fw-bold">Number</label>
                        <input type="text" name="most_recent_foreign_employer[unit_number]" class="form-control" placeholder="Number" value="{{ $foreignEmp['unit_number'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small fw-bold">City or Town</label>
                        <input type="text" name="most_recent_foreign_employer[city]" class="form-control" placeholder="City" value="{{ $foreignEmp['city'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small fw-bold">Province</label>
                        <input type="text" name="most_recent_foreign_employer[province]" class="form-control" placeholder="Province" value="{{ $foreignEmp['province'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small fw-bold">Postal Code</label>
                        <input type="text" name="most_recent_foreign_employer[postal_code]" class="form-control" placeholder="Postal Code" value="{{ $foreignEmp['postal_code'] ?? '' }}">
                    </div>
                    <div class="col-md-12 mb-2">
                        <label class="small fw-bold">Country</label>
                        <input type="text" name="most_recent_foreign_employer[country]" class="form-control" placeholder="Country" value="{{ $foreignEmp['country'] ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-3">
                <label class="small fw-bold">Dates of Employment, Unemployment, Retirement, or School Attendance</label>
                <div class="row">
                    <div class="col-md-6">
                        <label class="small">From (mm/dd/yyyy)</label>
                        <input type="text" name="most_recent_foreign_employer[date_from]" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ $foreignEmp['date_from'] ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="small">To (mm/dd/yyyy)</label>
                        <input type="text" name="most_recent_foreign_employer[date_to]" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ $foreignEmp['date_to'] ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <label class="small fw-bold">If unemployed or retired, source of financial support:</label>
                <input type="text" name="most_recent_foreign_employer[financial_support]" class="form-control" placeholder="Source of financial support" value="{{ $foreignEmp['financial_support'] ?? '' }}">
            </div>
        </div>
    </div>

</div>

<script>
$(document).ready(function() {
    // Immigrant Visa details toggle
    $('input[name="applied_for_immigrant_visa_abroad"]').change(function() {
        if ($(this).val() == '1') {
            $('#immigrant-visa-details').slideDown();
        } else {
            $('#immigrant-visa-details').slideUp();
        }
    });

    // History items logic (Add/Remove)
    $('.add-history-item').click(function() {
        const type = $(this).data('type');
        let container, template, index;

        container = $('#employment-history-container');
        index = container.find('.employment-item').length;
        template = `
            <div class="employment-item border p-3 mb-3 rounded bg-white shadow-sm">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="text-primary fw-bold">Employer or School #\${index + 1}</h6>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-history-item"><i class="fa fa-trash"></i></button>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="small fw-bold">Name of Employer, Company, or School</label>
                        <input type="text" name="applicant_employment_history[\${index}][employer]" class="form-control" placeholder="Employer or School">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="small fw-bold">Your Occupation (if unemployed or retired, so state)</label>
                        <input type="text" name="applicant_employment_history[\${index}][occupation]" class="form-control" placeholder="Occupation">
                    </div>
                    
                    <div class="col-md-12 mb-2">
                        <label class="small fw-bold text-primary">Address of Employer, Company, or School</label>
                        <div class="row">
                            <div class="col-md-8 mb-2">
                                <label class="small fw-bold">Street Number and Name</label>
                                <input type="text" name="applicant_employment_history[\${index}][street]" class="form-control" placeholder="Street Address">
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="small fw-bold">Unit Type</label>
                                <select name="applicant_employment_history[\${index}][unit_type]" class="form-control">
                                    <option value="">-Select-</option>
                                    <option value="Apt">Apt.</option>
                                    <option value="Ste">Ste.</option>
                                    <option value="Flr">Flr.</option>
                                </select>
                            </div>
                            <div class="col-md-2 mb-2">
                                <label class="small fw-bold">Number</label>
                                <input type="text" name="applicant_employment_history[\${index}][unit_number]" class="form-control" placeholder="Number">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small fw-bold">City or Town</label>
                                <input type="text" name="applicant_employment_history[\${index}][city]" class="form-control" placeholder="City">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small fw-bold">State (U.S. Only)</label>
                                <input type="text" name="applicant_employment_history[\${index}][state]" class="form-control" placeholder="State">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small fw-bold">ZIP Code (U.S. Only)</label>
                                <input type="text" name="applicant_employment_history[\${index}][zip]" class="form-control" placeholder="ZIP">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small fw-bold">Province (Foreign Only)</label>
                                <input type="text" name="applicant_employment_history[\${index}][province]" class="form-control" placeholder="Province">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small fw-bold">Postal Code (Foreign Only)</label>
                                <input type="text" name="applicant_employment_history[\${index}][postal_code]" class="form-control" placeholder="Postal Code">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small fw-bold">Country</label>
                                <input type="text" name="applicant_employment_history[\${index}][country]" class="form-control" placeholder="Country">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="small fw-bold">Dates of Employment, Unemployment, Retirement, or School Attendance</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="small">From (mm/dd/yyyy)</label>
                                <input type="text" name="applicant_employment_history[\${index}][date_from]" class="form-control datePicker" placeholder="MM/DD/YYYY">
                            </div>
                            <div class="col-md-6">
                                <label class="small">To (mm/dd/yyyy)</label>
                                <input type="text" name="applicant_employment_history[\${index}][date_to]" class="form-control datePicker" placeholder="MM/DD/YYYY">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label class="small fw-bold">If unemployed or retired, source of financial support:</label>
                        <input type="text" name="applicant_employment_history[\${index}][financial_support]" class="form-control" placeholder="Source of financial support">
                    </div>
                </div>
            </div>`;

        container.find('p.text-muted.small').remove(); // remove "No history" text
        container.append(template);
        
        // Re-initialize datePickers if any
        if (typeof initDatePickers === 'function') initDatePickers();
    });

    $(document).on('click', '.remove-history-item', function() {
        $(this).closest('div[class*="-item"]').remove();
    });
});
</script>
