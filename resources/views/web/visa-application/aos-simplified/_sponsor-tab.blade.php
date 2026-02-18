<div class="marital-history-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-ring me-2 text-primary"></i>Part 5. Information About Your Marital History
    </h4>

    <div class="row">
        <div class="col-md-12 mb-4">
            <label class="small fw-bold">1. What is your current marital status?</label>
            <div class="mt-2">
                @foreach(['Single, Never Married', 'Married', 'Divorced', 'Widowed', 'Marriage Annulled', 'Legally Separated'] as $status)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="marital_status" id="status_{{ Str::slug($status) }}" value="{{ $status }}" {{ (optional($application)->marital_status ?? 'Single, Never Married') == $status ? 'checked' : '' }}>
                        <label class="form-check-label small" for="status_{{ Str::slug($status) }}">{{ $status }}</label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="col-md-12 mb-4">
            <label class="small fw-bold">2. If you are married, is your spouse a current member of the U.S. armed forces or U.S. Coast Guard?</label>
            <div class="mt-2">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="spouse_is_military" id="military_yes" value="1" {{ optional($application)->spouse_is_military ? 'checked' : '' }}>
                    <label class="form-check-label small" for="military_yes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="spouse_is_military" id="military_no" value="0" {{ !optional($application)->spouse_is_military ? 'checked' : '' }}>
                    <label class="form-check-label small" for="military_no">No</label>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <label class="small fw-bold">3. How many times have you been married (including your current marriage, marriages abroad, annulled marriages, and marriages to the same person)?</label>
            <input type="number" name="times_married" class="form-control mt-2" min="0" value="{{ optional($application)->times_married ?? 1 }}">
        </div>
    </div>

    <!-- Information About Your Current Marriage -->
    <div id="current_marriage_section" class="mt-3 {{ (optional($application)->marital_status == 'Married' || optional($application)->marital_status == 'Legally Separated') ? '' : 'd-none' }}">
        <h5 class="mb-3 border-bottom pb-2 text-primary">Information About Your Current Marriage (including if you are legally separated)</h5>
        
        <div class="row">
            <div class="col-md-12 mb-3">
                <label class="small fw-bold">4. Current Spouse's Legal Name</label>
                <div class="row mt-2">
                    <div class="col-md-4 mb-2">
                        <label class="small">Family Name (Last Name)</label>
                        <input type="text" name="spouse_name_data[last_name]" class="form-control" value="{{ optional($application)->spouse_name_data['last_name'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Given Name (First Name)</label>
                        <input type="text" name="spouse_name_data[first_name]" class="form-control" value="{{ optional($application)->spouse_name_data['first_name'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Middle Name (if applicable)</label>
                        <input type="text" name="spouse_name_data[middle_name]" class="form-control" value="{{ optional($application)->spouse_name_data['middle_name'] ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="small fw-bold">5. Current Spouse's A-Number (if any)</label>
                <div class="input-group">
                    <span class="input-group-text small">► A-</span>
                    <input type="text" name="spouse_a_number" class="form-control" placeholder="000-000-000" value="{{ optional($application)->spouse_a_number ?? '' }}">
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="small fw-bold">6. Current Spouse's Date of Birth (mm/dd/yyyy)</label>
                <input type="text" name="spouse_dob" class="form-control datePicker" placeholder="MM/DD/YYYY" value="{{ optional($application)->spouse_dob ? optional($application)->spouse_dob->format('m/d/Y') : '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="small fw-bold">7. Current Spouse's Country of Birth</label>
                <select name="spouse_birth_country" class="form-control mt-1">
                    <option value="">-Select Country-</option>
                    @foreach(getCountries() as $iso => $country)
                        <option value="{{ $country }}" {{ (optional($application)->spouse_birth_country ?? '') == $country ? 'selected' : '' }}>{{ $country }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12 mb-3">
                <label class="small fw-bold">8. Current Spouse's Current Physical Address</label>
                <div class="row mt-2">
                    <div class="col-md-8 mb-2">
                        <label class="small">Street Number and Name</label>
                        <input type="text" name="spouse_address_data[street]" class="form-control" value="{{ optional($application)->spouse_address_data['street'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Apt. Ste. Flr. Number</label>
                        <input type="text" name="spouse_address_data[unit]" class="form-control" placeholder="Apt 1" value="{{ optional($application)->spouse_address_data['unit'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">City or Town</label>
                        <input type="text" name="spouse_address_data[city]" class="form-control" value="{{ optional($application)->spouse_address_data['city'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">State</label>
                        <select name="spouse_address_data[state]" class="form-control">
                            <option value="">-Select State-</option>
                            @foreach(getUsStates() as $code => $name)
                                <option value="{{ $code }}" {{ (optional($application)->spouse_address_data['state'] ?? '') == $code ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">ZIP Code</label>
                        <input type="text" name="spouse_address_data[zip]" class="form-control" value="{{ optional($application)->spouse_address_data['zip'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Province</label>
                        <input type="text" name="spouse_address_data[province]" class="form-control" value="{{ optional($application)->spouse_address_data['province'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Postal Code</label>
                        <input type="text" name="spouse_address_data[postal_code]" class="form-control" value="{{ optional($application)->spouse_address_data['postal_code'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Country</label>
                        <input type="text" name="spouse_address_data[country]" class="form-control" value="{{ optional($application)->spouse_address_data['country'] ?? '' }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-12 mb-3">
                <label class="small fw-bold">9. Place of Marriage to Current Spouse</label>
                <div class="row mt-2">
                    <div class="col-md-4 mb-2">
                        <label class="small">City or Town</label>
                        <input type="text" name="spouse_marriage_place_data[city]" class="form-control" value="{{ optional($application)->spouse_marriage_place_data['city'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">State or Province</label>
                        <input type="text" name="spouse_marriage_place_data[state_province]" class="form-control" value="{{ optional($application)->spouse_marriage_place_data['state_province'] ?? '' }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label class="small">Country</label>
                        <input type="text" name="spouse_marriage_place_data[country]" class="form-control" value="{{ optional($application)->spouse_marriage_place_data['country'] ?? '' }}">
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="small fw-bold">Date of Marriage to Current Spouse (mm/dd/yyyy)</label>
                <input type="text" name="marriage_date" class="form-control datePicker" value="{{ optional($application)->marriage_date ? optional($application)->marriage_date->format('m/d/Y') : '' }}">
            </div>

            <div class="col-md-6 mb-3">
                <label class="small fw-bold">10. Is your current spouse applying with you?</label>
                <div class="mt-2">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="spouse_applying_with_you" id="applying_yes" value="1" {{ optional($application)->spouse_applying_with_you ? 'checked' : '' }}>
                        <label class="form-check-label small" for="applying_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="spouse_applying_with_you" id="applying_no" value="0" {{ !optional($application)->spouse_applying_with_you ? 'checked' : '' }}>
                        <label class="form-check-label small" for="applying_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Information About Prior Marriages -->
    <div id="prior_marriages_full_section" class="mt-4 {{ (optional($application)->times_married > 1) ? '' : 'd-none' }}">
        <h5 class="mb-3 border-bottom pb-2 text-primary">Information About Prior Marriages (if any)</h5>
        
        <div id="prior-marriages-full-container">
            @php $priorMarriages = optional($application)->prior_marriages_full_data ?? []; @endphp
            @foreach($priorMarriages as $index => $prior)
                <div class="prior-marriage-item border p-3 mb-4 rounded bg-light">
                    <div class="d-flex justify-content-between mb-2">
                        <h6 class="fw-bold">Prior Spouse #{{ $index + 1 }}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger remove-full-marriage"><i class="fa fa-trash"></i></button>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="small fw-bold">{{ 11 + ($index * 8) }}. Prior Spouse's Legal Name (provide family name before marriage)</label>
                            <div class="row mt-2">
                                <div class="col-md-4 mb-2">
                                    <label class="small">Family Name (Last Name)</label>
                                    <input type="text" name="prior_marriages_full_data[{{ $index }}][last_name]" class="form-control" value="{{ $prior['last_name'] ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="small">Given Name (First Name)</label>
                                    <input type="text" name="prior_marriages_full_data[{{ $index }}][first_name]" class="form-control" value="{{ $prior['first_name'] ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="small">Middle Name (if applicable)</label>
                                    <input type="text" name="prior_marriages_full_data[{{ $index }}][middle_name]" class="form-control" value="{{ $prior['middle_name'] ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold">{{ 12 + ($index * 8) }}. Prior Spouse's Date of Birth (mm/dd/yyyy)</label>
                            <input type="text" name="prior_marriages_full_data[{{ $index }}][dob]" class="form-control datePicker" value="{{ $prior['dob'] ?? '' }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold">{{ 13 + ($index * 8) }}. Prior Spouse's Country of Birth</label>
                            <input type="text" name="prior_marriages_full_data[{{ $index }}][birth_country]" class="form-control" value="{{ $prior['birth_country'] ?? '' }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold">{{ 14 + ($index * 8) }}. Prior Spouse's Country of Citizenship or Nationality</label>
                            <input type="text" name="prior_marriages_full_data[{{ $index }}][citizenship]" class="form-control" value="{{ $prior['citizenship'] ?? '' }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold">{{ 15 + ($index * 8) }}. Date of Marriage to Prior Spouse (mm/dd/yyyy)</label>
                            <input type="text" name="prior_marriages_full_data[{{ $index }}][marriage_date]" class="form-control datePicker" value="{{ $prior['marriage_date'] ?? '' }}">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="small fw-bold">{{ 16 + ($index * 8) }}. Place of Marriage to Prior Spouse</label>
                            <div class="row mt-2">
                                <div class="col-md-4 mb-2">
                                    <label class="small">City or Town</label>
                                    <input type="text" name="prior_marriages_full_data[{{ $index }}][marriage_city]" class="form-control" value="{{ $prior['marriage_city'] ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="small">State or Province</label>
                                    <input type="text" name="prior_marriages_full_data[{{ $index }}][marriage_state_province]" class="form-control" value="{{ $prior['marriage_state_province'] ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="small">Country</label>
                                    <input type="text" name="prior_marriages_full_data[{{ $index }}][marriage_country]" class="form-control" value="{{ $prior['marriage_country'] ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="small fw-bold">{{ 17 + ($index * 8) }}. Place Where Marriage with Prior Spouse Legally Ended</label>
                            <div class="row mt-2">
                                <div class="col-md-4 mb-2">
                                    <label class="small">City or Town</label>
                                    <input type="text" name="prior_marriages_full_data[{{ $index }}][end_city]" class="form-control" value="{{ $prior['end_city'] ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="small">State or Province</label>
                                    <input type="text" name="prior_marriages_full_data[{{ $index }}][end_state_province]" class="form-control" value="{{ $prior['end_state_province'] ?? '' }}">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label class="small">Country</label>
                                    <input type="text" name="prior_marriages_full_data[{{ $index }}][end_country]" class="form-control" value="{{ $prior['end_country'] ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold">Date Marriage with Prior Spouse Legally Ended (mm/dd/yyyy)</label>
                            <input type="text" name="prior_marriages_full_data[{{ $index }}][end_date]" class="form-control datePicker" value="{{ $prior['end_date'] ?? '' }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="small fw-bold">{{ 18 + ($index * 8) }}. How Marriage Ended with Prior Spouse (select one):</label>
                            <div class="mt-2">
                                @foreach(['Spouse Deceased', 'Divorced', 'Annulled', 'Other (Explain)'] as $how_ended)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="prior_marriages_full_data[{{ $index }}][how_ended]" id="how_ended_{{ $index }}_{{ Str::slug($how_ended) }}" value="{{ $how_ended }}" {{ ($prior['how_ended'] ?? '') == $how_ended ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="how_ended_{{ $index }}_{{ Str::slug($how_ended) }}">{{ $how_ended }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-prior-marriage-full">
            <i class="fa fa-plus me-1"></i>Add Prior Marriage
        </button>
    </div>
</div>

<script>
$(document).ready(function() {
    // Toggle current marriage section
    $('input[name="marital_status"]').on('change', function() {
        if ($(this).val() === 'Married' || $(this).val() === 'Legally Separated') {
            $('#current_marriage_section').removeClass('d-none');
        } else {
            $('#current_marriage_section').addClass('d-none');
        }
    });

    // Toggle prior marriages section
    $('input[name="times_married"]').on('change keyup', function() {
        if (parseInt($(this).val()) > 1) {
            $('#prior_marriages_full_section').removeClass('d-none');
        } else {
            $('#prior_marriages_full_section').addClass('d-none');
        }
    });

    // Add prior marriage
    $('#add-prior-marriage-full').on('click', function() {
        let index = $('#prior-marriages-full-container .prior-marriage-item').length;
        let html = `
            <div class="prior-marriage-item border p-3 mb-4 rounded bg-light">
                <div class="d-flex justify-content-between mb-2">
                    <h6 class="fw-bold">Prior Spouse #${index + 1}</h6>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-full-marriage"><i class="fa fa-trash"></i></button>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="small fw-bold">${11 + (index * 8)}. Prior Spouse's Legal Name (provide family name before marriage)</label>
                        <div class="row mt-2">
                            <div class="col-md-4 mb-2">
                                <label class="small">Family Name (Last Name)</label>
                                <input type="text" name="prior_marriages_full_data[${index}][last_name]" class="form-control">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">Given Name (First Name)</label>
                                <input type="text" name="prior_marriages_full_data[${index}][first_name]" class="form-control">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">Middle Name (if applicable)</label>
                                <input type="text" name="prior_marriages_full_data[${index}][middle_name]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="small fw-bold">${12 + (index * 8)}. Prior Spouse's Date of Birth (mm/dd/yyyy)</label>
                        <input type="text" name="prior_marriages_full_data[${index}][dob]" class="form-control datePicker">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="small fw-bold">${13 + (index * 8)}. Prior Spouse's Country of Birth</label>
                        <input type="text" name="prior_marriages_full_data[${index}][birth_country]" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="small fw-bold">${14 + (index * 8)}. Prior Spouse's Country of Citizenship or Nationality</label>
                        <input type="text" name="prior_marriages_full_data[${index}][citizenship]" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="small fw-bold">${15 + (index * 8)}. Date of Marriage to Prior Spouse (mm/dd/yyyy)</label>
                        <input type="text" name="prior_marriages_full_data[${index}][marriage_date]" class="form-control datePicker">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="small fw-bold">${16 + (index * 8)}. Place of Marriage to Prior Spouse</label>
                        <div class="row mt-2">
                            <div class="col-md-4 mb-2">
                                <label class="small">City or Town</label>
                                <input type="text" name="prior_marriages_full_data[${index}][marriage_city]" class="form-control">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">State or Province</label>
                                <input type="text" name="prior_marriages_full_data[${index}][marriage_state_province]" class="form-control">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">Country</label>
                                <input type="text" name="prior_marriages_full_data[${index}][marriage_country]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="small fw-bold">${17 + (index * 8)}. Place Where Marriage with Prior Spouse Legally Ended</label>
                        <div class="row mt-2">
                            <div class="col-md-4 mb-2">
                                <label class="small">City or Town</label>
                                <input type="text" name="prior_marriages_full_data[${index}][end_city]" class="form-control">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">State or Province</label>
                                <input type="text" name="prior_marriages_full_data[${index}][end_state_province]" class="form-control">
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="small">Country</label>
                                <input type="text" name="prior_marriages_full_data[${index}][end_country]" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="small fw-bold">Date Marriage with Prior Spouse Legally Ended (mm/dd/yyyy)</label>
                        <input type="text" name="prior_marriages_full_data[${index}][end_date]" class="form-control datePicker">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="small fw-bold">${18 + (index * 8)}. How Marriage Ended with Prior Spouse (select one):</label>
                        <div class="mt-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="prior_marriages_full_data[${index}][how_ended]" id="how_ended_${index}_deceased" value="Spouse Deceased">
                                <label class="form-check-label small" for="how_ended_${index}_deceased">Spouse Deceased</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="prior_marriages_full_data[${index}][how_ended]" id="how_ended_${index}_divorced" value="Divorced">
                                <label class="form-check-label small" for="how_ended_${index}_divorced">Divorced</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="prior_marriages_full_data[${index}][how_ended]" id="how_ended_${index}_annulled" value="Annulled">
                                <label class="form-check-label small" for="how_ended_${index}_annulled">Annulled</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="prior_marriages_full_data[${index}][how_ended]" id="how_ended_${index}_other" value="Other (Explain)">
                                <label class="form-check-label small" for="how_ended_${index}_other">Other (Explain)</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('#prior-marriages-full-container').append(html);
        $('.datePicker').datepicker({
            format: 'mm/dd/yyyy',
            autoclose: true,
            todayHighlight: true
        });
    });

    // Remove prior marriage
    $(document).on('click', '.remove-full-marriage', function() {
        $(this).closest('.prior-marriage-item').remove();
        // Re-index
        $('#prior-marriages-full-container .prior-marriage-item').each(function(idx) {
            $(this).find('h6.fw-bold').text('Prior Spouse #' + (idx + 1));
            
            // Re-number labels continuously
            let spouseBase = 11 + (idx * 8);
            $(this).find('label.fw-bold').each(function(lIdx) {
                let currentText = $(this).text();
                let newItemNum = spouseBase + lIdx;
                $(this).text(currentText.replace(/^\d+/, newItemNum));
            });

            // Update input names for indexing
            $(this).find('input, select').each(function() {
                let name = $(this).attr('name');
                if (name) {
                    $(this).attr('name', name.replace(/\[\d+\]/, '[' + idx + ']'));
                }
                
                // Update IDs and labels for radio buttons
                let id = $(this).attr('id');
                if (id && id.includes('_' + (idx + 1) + '_')) { // If it was shifted from a previous index or is old
                     // This regex is a bit generic, let's be more specific or just replace the middle number
                }
                // Simpler: just rebuild the ID if it matches our pattern
                if (id && id.startsWith('how_ended_')) {
                    let newId = id.replace(/how_ended_\d+_/, 'how_ended_' + idx + '_');
                    $(this).attr('id', newId);
                    $(this).next('label').attr('for', newId);
                }
            });
        });
    });
});
</script>