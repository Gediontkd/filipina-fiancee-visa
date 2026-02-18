<div class="card border-0 shadow-none">
    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-2">
        <h4 class="fw-bold text-primary mb-0">Part 6. Information About Your Children</h4>
        <button type="button" class="btn btn-outline-primary btn-sm" onclick="addChild()">
            <i class="fa fa-plus me-1"></i>Add Another Child
        </button>
    </div>
    
    <div class="card-body ps-0 pe-0">
        <p class="text-muted small">
            <strong>NOTE:</strong> The term "children" includes all biological or legally adopted children, as well as current stepchildren, of any age, whether born in the United States or other countries, married or unmarried, living with you or elsewhere and includes any missing children and those born to you outside of marriage.
        </p>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="small fw-bold mb-1">1. Indicate the total number of ALL living children anywhere in the world (including adult sons and daughters) that you have.</label>
                    {{ Form::number('total_children_count', $application->total_children_count ?? 0, [
                        'class' => 'form-control',
                        'min' => 0,
                        'id' => 'total_children_count'
                    ]) }}
                </div>
            </div>
        </div>

        <div id="children-full-container">
            @php
                $children = $application->children_data ?? [];
            @endphp
            
            @forelse($children as $index => $child)
                <div class="child-section-item border p-3 mb-4 rounded bg-light shadow-sm position-relative">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 mt-2 me-2 remove-child-section" title="Remove Child">
                        <i class="fa fa-trash"></i>
                    </button>
                    
                    <h6 class="fw-bold text-secondary mb-3 border-bottom pb-2">Child #{{ $index + 1 }}</h6>
                    
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="small fw-bold">{{ 2 + ($index * 6) }}. Current Legal Name</label>
                            <div class="row mt-1">
                                <div class="col-md-4">
                                    <label class="small text-muted">Family Name (Last Name)</label>
                                    {{ Form::text("children_data[$index][last_name]", $child['last_name'] ?? '', ['class' => 'form-control', 'placeholder' => 'Last Name']) }}
                                </div>
                                <div class="col-md-4">
                                    <label class="small text-muted">Given Name (First Name)</label>
                                    {{ Form::text("children_data[$index][first_name]", $child['first_name'] ?? '', ['class' => 'form-control', 'placeholder' => 'First Name']) }}
                                </div>
                                <div class="col-md-4">
                                    <label class="small text-muted">Middle Name (if any)</label>
                                    {{ Form::text("children_data[$index][middle_name]", $child['middle_name'] ?? '', ['class' => 'form-control', 'placeholder' => 'Middle Name']) }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="small fw-bold">{{ 3 + ($index * 6) }}. A-Number (if any)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light">► A-</span>
                                {{ Form::text("children_data[$index][a_number]", $child['a_number'] ?? '', ['class' => 'form-control', 'placeholder' => '123456789', 'maxlength' => '9']) }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="small fw-bold">{{ 4 + ($index * 6) }}. Date of Birth (mm/dd/yyyy)</label>
                            {{ Form::text("children_data[$index][dob]", $child['dob'] ?? '', ['class' => 'form-control datePicker', 'placeholder' => 'MM/DD/YYYY']) }}
                        </div>

                        <div class="col-md-6">
                            <label class="small fw-bold">{{ 5 + ($index * 6) }}. Country of Birth</label>
                            {{ Form::text("children_data[$index][birth_country]", $child['birth_country'] ?? '', ['class' => 'form-control', 'placeholder' => 'Country']) }}
                        </div>

                        <div class="col-md-12">
                            <label class="small fw-bold">{{ 6 + ($index * 6) }}. What is your child's relationship to you? (for example, biological child, stepchild, legally adopted child)</label>
                            {{ Form::text("children_data[$index][relationship]", $child['relationship'] ?? '', ['class' => 'form-control', 'placeholder' => 'Relationship']) }}
                        </div>

                        <div class="col-md-12">
                            <label class="small fw-bold">{{ 7 + ($index * 6) }}. Is this child also applying now on a separate Form I-485?</label>
                            <div class="mt-2 text-center text-md-start">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="children_data[{{ $index }}][is_applying]" id="applying_yes_{{ $index }}" value="yes" {{ (isset($child['is_applying']) && $child['is_applying'] == 'yes') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="applying_yes_{{ $index }}">Yes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="children_data[{{ $index }}][is_applying]" id="applying_no_{{ $index }}" value="no" {{ (!isset($child['is_applying']) || $child['is_applying'] == 'no') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="applying_no_{{ $index }}">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div id="no-children-msg" class="text-center py-4 border rounded bg-light mb-4">
                    <i class="fa fa-info-circle text-muted mb-2 d-block fa-2x"></i>
                    <p class="mb-0 text-muted">No children added. Click the button below to add your children's information.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-3">
            <button type="button" class="btn btn-outline-primary" id="add-child-section">
                <i class="fa fa-plus me-2"></i>Add Child Information
            </button>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Add new child section
    $('#add-child-section').on('click', function() {
        $('#no-children-msg').hide();
        
        let container = $('#children-full-container');
        let index = container.find('.child-section-item').length;
        
        let itemNumBase = 2 + (index * 6);
        
        let html = `
            <div class="child-section-item border p-3 mb-4 rounded bg-light shadow-sm position-relative" style="display:none">
                <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 mt-2 me-2 remove-child-section" title="Remove Child">
                    <i class="fa fa-trash"></i>
                </button>
                
                <h6 class="fw-bold text-secondary mb-3 border-bottom pb-2">Child #${index + 1}</h6>
                
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="small fw-bold">${itemNumBase}. Current Legal Name</label>
                        <div class="row mt-1">
                            <div class="col-md-4">
                                <label class="small text-muted">Family Name (Last Name)</label>
                                <input type="text" name="children_data[${index}][last_name]" class="form-control" placeholder="Last Name">
                            </div>
                            <div class="col-md-4">
                                <label class="small text-muted">Given Name (First Name)</label>
                                <input type="text" name="children_data[${index}][first_name]" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col-md-4">
                                <label class="small text-muted">Middle Name (if any)</label>
                                <input type="text" name="children_data[${index}][middle_name]" class="form-control" placeholder="Middle Name">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="small fw-bold">${itemNumBase + 1}. A-Number (if any)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light">► A-</span>
                            <input type="text" name="children_data[${index}][a_number]" class="form-control" placeholder="123456789" maxlength="9">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="small fw-bold">${itemNumBase + 2}. Date of Birth (mm/dd/yyyy)</label>
                        <input type="text" name="children_data[${index}][dob]" class="form-control datePicker" placeholder="MM/DD/YYYY">
                    </div>

                    <div class="col-md-6">
                        <label class="small fw-bold">${itemNumBase + 3}. Country of Birth</label>
                        <input type="text" name="children_data[${index}][birth_country]" class="form-control" placeholder="Country">
                    </div>

                    <div class="col-md-12">
                        <label class="small fw-bold">${itemNumBase + 4}. What is your child's relationship to you? (for example, biological child, stepchild, legally adopted child)</label>
                        <input type="text" name="children_data[${index}][relationship]" class="form-control" placeholder="Relationship">
                    </div>

                    <div class="col-md-12">
                        <label class="small fw-bold">${itemNumBase + 5}. Is this child also applying now on a separate Form I-485?</label>
                        <div class="mt-2 text-center text-md-start">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="children_data[${index}][is_applying]" id="applying_yes_${index}" value="yes">
                                <label class="form-check-label" for="applying_yes_${index}">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="children_data[${index}][is_applying]" id="applying_no_${index}" value="no" checked>
                                <label class="form-check-label" for="applying_no_${index}">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;

            
        let $newSection = $(html);
        container.append($newSection);
        $newSection.fadeIn(300);
        
        // Initialize datepicker
        if (typeof initNewDatePickers === 'function') {
            initNewDatePickers();
        } else if ($.fn.datepicker) {
            $('.datePicker').datepicker({
                format: 'mm/dd/yyyy',
                autoclose: true,
                todayHighlight: true
            });
        }
    });

    // Remove child section
    $(document).on('click', '.remove-child-section', function() {
        $(this).closest('.child-section-item').fadeOut(300, function() {
            $(this).remove();
            reIndexChildren();
            
            if ($('#children-full-container .child-section-item').length === 0) {
                $('#no-children-msg').fadeIn(300);
            }
        });
    });

    function reIndexChildren() {
        $('#children-full-container .child-section-item').each(function(idx) {
            $(this).find('h6').text('Child #' + (idx + 1));
            
            let itemNumBase = 2 + (idx * 6);
            
            // Update labels
            $(this).find('label.fw-bold').each(function(lIdx) {
                let currentText = $(this).text();
                let newItemNum = itemNumBase + lIdx;
                $(this).text(currentText.replace(/^\d+/, newItemNum));
            });
            
            // Update input names and radio button IDs
            $(this).find('input').each(function() {
                let name = $(this).attr('name');
                if (name) {
                    $(this).attr('name', name.replace(/\[\d+\]/, '[' + idx + ']'));
                }
                
                let id = $(this).attr('id');
                if (id && (id.startsWith('applying_yes_') || id.startsWith('applying_no_'))) {
                    let type = id.startsWith('applying_yes_') ? 'yes' : 'no';
                    let newId = 'applying_' + type + '_' + idx;
                    $(this).attr('id', newId);
                    $(this).next('label').attr('for', newId);
                }
            });
        });
    }
});
</script>
