<div class="basis-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-list-check me-2 text-primary"></i>Part 2. Application Type or Filing Category
    </h4>
    <p class="text-muted mb-4">Select the basis for your Adjustment of Status application</p>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group mb-4">
                {{ Form::label('filing_category', 'I am applying for adjustment of status to lawful permanent resident because:') }}
                <span class="text-danger">*</span>
                {{ Form::select('filing_category', [
                    '' => '-Select Category-',
                    'Family-based' => 'Family-based (e.g., Immediate relative of a U.S. citizen, Spouse of a LPR)',
                    'Employment-based' => 'Employment-based',
                    'Special Immigrant' => 'Special Immigrant (e.g., Religious worker)',
                    'Asylee or Refugee' => 'Asylee or Refugee',
                    'Human Trafficking Victim' => 'Human Trafficking Victim (T Nonimmigrant)',
                    'Victim of Abuse' => 'Victim of Abuse (VAWA)',
                    'Other' => 'Other basis'
                ], optional($application)->filing_category ?? '', [
                    'class' => 'form-control',
                    'required' => true
                ]) }}
            </div>
        </div>
    </div>

    <div class="row items-principal-check">
        <div class="col-md-12">
            <div class="form-check mb-4 p-3 border rounded bg-light">
                {{ Form::checkbox('is_principal_applicant', 1, optional($application)->is_principal_applicant ?? true, [
                    'class' => 'form-check-input ms-0 me-2',
                    'id' => 'is_principal_applicant'
                ]) }}
                {{ Form::label('is_principal_applicant', 'Are you the principal applicant (the person for whom the immigrant petition was filed)?', ['class' => 'form-check-label fw-bold']) }}
            </div>
        </div>
    </div>

    <div class="underlying-petition-info {{ (optional($application)->is_principal_applicant ?? true) ? '' : 'd-none' }}">
        <h5 class="mb-3 mt-2"><i class="fa fa-file-contract me-2"></i>Underlying Petition Information</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    {{ Form::label('receipt_number_underlying_petition', 'Receipt Number of Underlying Petition (if any)') }}
                    {{ Form::text('receipt_number_underlying_petition', optional($application)->receipt_number_underlying_petition ?? '', [
                        'class' => 'form-control',
                        'placeholder' => 'e.g., MSC1234567890'
                    ]) }}
                    <small class="text-muted">Enter the 13-character receipt number from your Form I-130, I-140, I-360, etc.</small>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    {{ Form::label('priority_date', 'Priority Date from Underlying Petition') }}
                    {{ Form::text('priority_date', optional($application)->priority_date ? optional($application)->priority_date->format('m/d/Y') : '', [
                        'class' => 'form-control datePicker',
                        'placeholder' => 'MM/DD/YYYY'
                    ]) }}
                </div>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between flex-wrap mt-4 pb-4 gap-2">
        <button type="button" class="btn btn-primary aos-action-btn" onclick="$('#applicant-tab').tab('show')">
            <i class="fa fa-arrow-left me-2"></i>Previous
        </button>
        <button type="button" class="btn btn-primary next-step aos-action-btn" data-next-tab="history-tab">
            Next <i class="fa fa-arrow-right ms-2"></i>
        </button>
    </div>
</div>
