<div class="exemption-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-shield-alt me-2 text-primary"></i>Request for Exemption for Intending Immigrant's Affidavit of Support
    </h4>
    
    <div class="alert alert-info border-0 shadow-sm mb-4">
        <p class="mb-0">
            I am requesting an exemption from submitting an Affidavit of Support Under Section 213A of the INA (Form I-864 or Form I-864EZ) because (select only one):
        </p>
    </div>

    <div class="exemption-options space-y-4">
        <div class="form-check custom-radio-card p-3 border rounded mb-3">
            <input class="form-check-input mt-1" type="radio" name="i864_exemption" id="exemption_1a" value="1a" {{ ($application->i864_exemption ?? '') == '1a' ? 'checked' : '' }}>
            <label class="form-check-label ms-2 d-block cursor-pointer" for="exemption_1a">
                <strong>1.a.</strong> I have earned or can receive credit for 40 qualifying quarters (credits) of work in the United States (as defined by the Social Security Act (SSA)). (Attach your SSA earnings statements. Do not count any quarters during which you received a means tested public benefit.)
            </label>
        </div>

        <div class="form-check custom-radio-card p-3 border rounded mb-3">
            <input class="form-check-input mt-1" type="radio" name="i864_exemption" id="exemption_1b" value="1b" {{ ($application->i864_exemption ?? '') == '1b' ? 'checked' : '' }}>
            <label class="form-check-label ms-2 d-block cursor-pointer" for="exemption_1b">
                <strong>1.b.</strong> I am under 18 years of age, unmarried, the child of a U.S. citizen, am not likely to become a public charge, and will automatically become a U.S. citizen under INA section 320, upon my admission as a lawful permanent resident.
            </label>
        </div>

        <div class="form-check custom-radio-card p-3 border rounded mb-3">
            <input class="form-check-input mt-1" type="radio" name="i864_exemption" id="exemption_1c" value="1c" {{ ($application->i864_exemption ?? '') == '1c' ? 'checked' : '' }}>
            <label class="form-check-label ms-2 d-block cursor-pointer" for="exemption_1c">
                <strong>1.c.</strong> I am applying under the widow or widower of a U.S. citizen (Form I-360) immigrant category.
            </label>
        </div>

        <div class="form-check custom-radio-card p-3 border rounded mb-3">
            <input class="form-check-input mt-1" type="radio" name="i864_exemption" id="exemption_1d" value="1d" {{ ($application->i864_exemption ?? '') == '1d' ? 'checked' : '' }}>
            <label class="form-check-label ms-2 d-block cursor-pointer" for="exemption_1d">
                <strong>1.d.</strong> I am applying as a VAWA self-petitioner.
            </label>
        </div>

        <div class="form-check custom-radio-card p-3 border rounded mb-3">
            <input class="form-check-input mt-1" type="radio" name="i864_exemption" id="exemption_1e" value="1e" {{ ($application->i864_exemption ?? '') == '1e' ? 'checked' : '' }}>
            <label class="form-check-label ms-2 d-block cursor-pointer" for="exemption_1e">
                <strong>1.e.</strong> None of these exemptions apply to me and I am not required by statute to submit an Affidavit of Support Under Section 213A of the INA, nor am I required to request an exemption.
            </label>
        </div>

        <div class="form-check custom-radio-card p-3 border rounded mb-3">
            <input class="form-check-input mt-1" type="radio" name="i864_exemption" id="exemption_1f" value="1f" {{ ($application->i864_exemption ?? '') == '1f' ? 'checked' : '' }}>
            <label class="form-check-label ms-2 d-block cursor-pointer" for="exemption_1f">
                <strong>1.f.</strong> None of these exemptions apply to me and I am not requesting an exemption as I am required to submit an Affidavit of Support Under Section 213A of the INA
            </label>
        </div>
    </div>
</div>

<style>
    .custom-radio-card {
        transition: all 0.2s ease;
        background-color: #f8fafc;
    }
    .custom-radio-card:hover {
        border-color: #3b82f6 !important;
        background-color: #eff6ff;
    }
    .form-check-input:checked + .form-check-label {
        color: #1e40af;
    }
    .cursor-pointer {
        cursor: pointer;
    }
</style>
