<div class="immigration-section">
    <h4 class="mb-4 border-bottom pb-2">
        Part 9. General Eligibility and Inadmissibility Grounds
    </h4>

    <div class="alert alert-info mb-4">
        <i class="fa fa-info-circle me-2"></i>
        Choose the answer that you think is correct in Part 9. If you answer "Yes" to any questions (or if you answer "No," but are unsure of your answer), provide an explanation of the events and circumstances in the space provided in Part 14. Additional Information.
    </div>

    {{-- ===================== SECTION A: Organization Membership ===================== --}}
    <div class="card mb-4 border shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Organization Membership</h5>
        </div>
        <div class="card-body">
            @php $p9 = optional($application)->part9_data ?? []; @endphp

            {{-- Q1 --}}
            <div class="question-row border-bottom py-3">
                <div class="row align-items-center">
                    <div class="col-md-9">
                        <label class="mb-0"><strong>1.</strong> Have you EVER been a member of, involved in, or in any way associated with any organization, association, fund, foundation, party, club, society, or similar group in the United States or in any other location in the world?</label>
                    </div>
                    <div class="col-md-3 mt-2 mt-md-0">
                        <div class="d-flex gap-3 justify-content-md-end">
                            <div class="form-check">
                                <input class="form-check-input p9-org-trigger" type="radio" name="part9_data[q1]" id="q1_yes" value="yes" {{ ($p9['q1'] ?? '') === 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="q1_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input p9-org-trigger" type="radio" name="part9_data[q1]" id="q1_no" value="no" {{ ($p9['q1'] ?? '') === 'no' ? 'checked' : '' }}>
                                <label class="form-check-label" for="q1_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Organization details (shown if Q1 = Yes) --}}
            <div id="org_details_section" style="{{ ($p9['q1'] ?? '') === 'yes' ? '' : 'display:none;' }}">
                <p class="text-muted mt-3 mb-3"><em>If you answered "Yes" to Item Number 1., complete Items 2–9. If you were a member of more than two organizations, use Part 14. Additional Information.</em></p>

                {{-- Organization 1 --}}
                @php $orgNum = 1; $orgKey = "org{$orgNum}"; @endphp
                <div class="border rounded p-3 mb-4 bg-light">
                    <h6 class="fw-bold mb-3">Organization {{ $orgNum }}</h6>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="small fw-bold">Name of Organization</label>
                            <input type="text" name="part9_data[{{ $orgKey }}][name]" class="form-control" value="{{ $p9[$orgKey]['name'] ?? '' }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="small fw-bold">City or Town</label>
                            <input type="text" name="part9_data[{{ $orgKey }}][city]" class="form-control" value="{{ $p9[$orgKey]['city'] ?? '' }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="small fw-bold">State or Province</label>
                            <input type="text" name="part9_data[{{ $orgKey }}][state]" class="form-control" value="{{ $p9[$orgKey]['state'] ?? '' }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="small fw-bold">Country</label>
                            <select name="part9_data[{{ $orgKey }}][country]" class="form-control">
                                <option value="">-Select Country-</option>
                                @foreach(getCountries() as $iso => $country)
                                    <option value="{{ $country }}" {{ ($p9[$orgKey]['country'] ?? '') == $country ? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="small fw-bold">Nature of Organization (purposes, activities, whether illicit or legitimate)</label>
                            <textarea name="part9_data[{{ $orgKey }}][nature]" class="form-control" rows="2">{{ $p9[$orgKey]['nature'] ?? '' }}</textarea>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="small fw-bold">Nature of involvement (role/positions held, whether illicit or legitimate)</label>
                            <textarea name="part9_data[{{ $orgKey }}][involvement]" class="form-control" rows="2">{{ $p9[$orgKey]['involvement'] ?? '' }}</textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="small fw-bold">Dates of Membership — From (mm/dd/yyyy)</label>
                            <input type="text" name="part9_data[{{ $orgKey }}][from]" class="form-control date-picker" placeholder="mm/dd/yyyy" value="{{ $p9[$orgKey]['from'] ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="small fw-bold">To (mm/dd/yyyy)</label>
                            <input type="text" name="part9_data[{{ $orgKey }}][to]" class="form-control date-picker" placeholder="mm/dd/yyyy" value="{{ $p9[$orgKey]['to'] ?? '' }}">
                        </div>
                    </div>
                </div>

                {{-- Add Org Button (hidden if Org 2 is visible) --}}
                <div id="add_org_btn_container" class="mb-4" style="{{ !empty($p9['org2']['name']) ? 'display:none;' : '' }}">
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="showOrg2()">
                        <i class="fa fa-plus me-1"></i>Add Another Organization
                    </button>
                </div>

                {{-- Organization 2 (Hidden by default unless data exists) --}}
                @php $orgNum = 2; $orgKey = "org{$orgNum}"; @endphp
                <div id="org2_container" class="border rounded p-3 mb-4 bg-light" style="{{ !empty($p9['org2']['name']) ? '' : 'display:none;' }}">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">Organization {{ $orgNum }}</h6>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="hideOrg2()"><i class="fa fa-trash me-1"></i>Remove</button>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <label class="small fw-bold">Name of Organization</label>
                            <input type="text" name="part9_data[{{ $orgKey }}][name]" class="form-control" value="{{ $p9[$orgKey]['name'] ?? '' }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="small fw-bold">City or Town</label>
                            <input type="text" name="part9_data[{{ $orgKey }}][city]" class="form-control" value="{{ $p9[$orgKey]['city'] ?? '' }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="small fw-bold">State or Province</label>
                            <input type="text" name="part9_data[{{ $orgKey }}][state]" class="form-control" value="{{ $p9[$orgKey]['state'] ?? '' }}">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="small fw-bold">Country</label>
                            <select name="part9_data[{{ $orgKey }}][country]" class="form-control">
                                <option value="">-Select Country-</option>
                                @foreach(getCountries() as $iso => $country)
                                    <option value="{{ $country }}" {{ ($p9[$orgKey]['country'] ?? '') == $country ? 'selected' : '' }}>{{ $country }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="small fw-bold">Nature of Organization (purposes, activities, whether illicit or legitimate)</label>
                            <textarea name="part9_data[{{ $orgKey }}][nature]" class="form-control" rows="2">{{ $p9[$orgKey]['nature'] ?? '' }}</textarea>
                        </div>
                        <div class="col-md-12 mb-2">
                            <label class="small fw-bold">Nature of involvement (role/positions held, whether illicit or legitimate)</label>
                            <textarea name="part9_data[{{ $orgKey }}][involvement]" class="form-control" rows="2">{{ $p9[$orgKey]['involvement'] ?? '' }}</textarea>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="small fw-bold">Dates of Membership — From (mm/dd/yyyy)</label>
                            <input type="text" name="part9_data[{{ $orgKey }}][from]" class="form-control date-picker" placeholder="mm/dd/yyyy" value="{{ $p9[$orgKey]['from'] ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="small fw-bold">To (mm/dd/yyyy)</label>
                            <input type="text" name="part9_data[{{ $orgKey }}][to]" class="form-control date-picker" placeholder="mm/dd/yyyy" value="{{ $p9[$orgKey]['to'] ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php $qIndex = 1; @endphp

    {{-- ===================== SECTION B: Immigration Violations ===================== --}}
    <div class="card mb-4 border shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Immigration Violations</h5>
        </div>
        <div class="card-body">
            @php
                $immigrationQs = [
                    'q10' => 'Have you EVER been denied admission to the United States?',
                    'q12' => 'Have you EVER been denied a visa to the United States?',
                    'q11' => 'Have you EVER worked in the United States without authorization?',
                    'q13' => 'Have you EVER violated the terms or conditions of your nonimmigrant status?',
                    'q14' => 'Are you presently or have you EVER been in removal, exclusion, rescission, or deportation proceedings, including expedited removal proceedings?',
                    'q15' => 'Have you EVER been issued a final order of exclusion, deportation, or removal?',
                    'q16' => 'Have you EVER had a prior final order of exclusion, deportation, or removal reinstated?',
                    'q17' => 'Have you EVER been granted voluntary departure by an immigration officer or an immigration judge but failed to depart within the allotted time?',
                    'q18' => 'Have you EVER applied for any kind of relief or protection from removal, exclusion, or deportation?',
                    'q19' => 'Have you EVER been a J nonimmigrant exchange visitor who was subject to the two-year foreign residence requirement?',
                    'q20' => 'If you answered "Yes" to the previous question, have you complied with the foreign residence requirement?',
                    'q21' => 'If you answered "Yes" to the J-visa question and "No" to the previous question, have you been granted a waiver or has Department of State issued a favorable waiver recommendation letter for you?',
                ];
            @endphp
            @foreach($immigrationQs as $key => $text)
            <div class="question-row border-bottom py-3 {{ $loop->last ? 'border-0' : '' }}">
                <div class="row align-items-center">
                    <div class="col-md-9"><label class="mb-0"><strong>{{ ++$qIndex }}.</strong> {{ $text }}</label></div>
                    <div class="col-md-3 mt-2 mt-md-0">
                        <div class="d-flex gap-3 justify-content-md-end">
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_yes" value="yes" {{ ($p9[$key] ?? '') === 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_no" value="no" {{ ($p9[$key] ?? '') === 'no' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @php $qIndex = $qIndex; @endphp {{-- preserve counter across sections --}}
        </div>
    </div>

    {{-- ===================== SECTION C: Criminal Acts ===================== --}}
    <div class="card mb-4 border shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Criminal Acts and Violations</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-warning py-2 mb-3">
                <small>You must answer "Yes" to any question in this section that applies to you, even if your records were sealed or otherwise cleared, or even if anyone, including a judge, law enforcement officer, or attorney, told you that you no longer have a record. You must also answer "Yes" whether the action or offense occurred in the United States or anywhere else in the world.</small>
            </div>
            @php
                $criminalQs = [
                    'q22' => 'Have you EVER been arrested, cited, charged, or permitted to participate in a diversion program (including 
pre-trial diversion, deferred prosecution, deferred adjudication, or any withheld adjudication), or detained 
for any reason by any law enforcement official in any country including but not limited to any U.S. 
immigration official or any official of the U.S. armed forces or U.S. Coast Guard or by a similar official of 
a country other than the United States?',
                    'q23' => 'Have you EVER committed a crime of any kind (even if you were not arrested, cited, charged with, or tried for that crime, or convicted)?',
                    'q24' => 'Have you EVER pled guilty to or been convicted of a crime or offense (even if the violation was subsequently expunged or sealed by a court, or if you were granted a pardon, amnesty, a rehabilitation decree, or other act of clemency)?',
                    'q25' => 'Have you EVER been ordered punished by a judge or had conditions imposed on you that restrained your liberty (such as a prison sentence, suspended sentence, house arrest, parole, alternative sentencing, drug or alcohol treatment, rehabilitative programs or classes, probation, or community service)?',
                    'q26' => 'Have you EVER violated (or attempted or conspired to violate) any controlled substance law or regulation of a state, the United States, or a foreign country?',
                    'q27' => 'Have you EVER trafficked in or benefited from, or knowingly aided, abetted, assisted, conspired or colluded in the illegal trafficking of any controlled substances, such as chemicals, illegal drugs, or narcotics?',
                    'q28' => 'Are you the spouse, son, or daughter of an alien who illicitly trafficked or aided (or otherwise abetted, 
assisted, conspired, or colluded) in the illicit trafficking of a controlled substance, such as chemicals, illegal 
drugs, or narcotics and you obtained, within the last 5 years, any financial or other benefit from this activity 
of your spouse or parent??',
                    'q29' => 'If you answered "Yes" to the previous question, did you know or should you have reasonably known that the financial or other benefit you obtained resulted from this activity of your spouse or parent?',
                    'q30' => 'Have you EVER engaged in prostitution or are you coming to the United States to engage in prostitution?',
                    'q31' => 'Have you EVER directly or indirectly procured or attempted to procure, or imported prostitutes or persons for the purpose of prostitution?',
                    'q32' => 'Have you EVER received any proceeds or money from prostitution?',
                    'q33' => 'Do you intend to engage in illegal gambling or any other form of commercialized vice, such as prostitution, bootlegging, or the sale of child pornography, while in the United States?',
                    'q34' => 'Have you EVER exercised immunity (diplomatic or otherwise) to avoid being prosecuted for a criminal offense in the United States?',
                    'q35a' => 'Have you EVER served as a foreign government official?',
                    'q35b' => 'If you answered "Yes" to the previous question, have you EVER been responsible for, enforced, or directly carried out violations of religious freedoms?',
                    'q36' => 'Have you EVER induced by force, fraud, or coercion (or otherwise been involved in) the trafficking of another person for commercial sex acts (sex trafficking)?',
                    'q37' => 'Have you EVER trafficked a person into involuntary servitude, peonage, debt bondage, or slavery?',
                    'q38' => 'Have you EVER knowingly aided, abetted, assisted, conspired, or colluded with others in trafficking in persons for commercial sex acts or involuntary servitude, peonage, debt bondage, or slavery?',
                    'q39' => 'Are you the spouse, son, or daughter of an alien who engaged in the trafficking in persons and have received or obtained, within the last 5 years, any financial or other benefits from this activity?',
                    'q40' => 'If you answered "Yes" to the previous question, did you know or reasonably should have known that this benefit resulted from this activity of your spouse or parent?',
                    'q41' => 'Have you EVER engaged in money laundering or have you EVER knowingly aided, assisted, abetted, conspired, or colluded with others in money laundering or do you seek to enter the United States to engage in such activity?',
                ];
            @endphp
            @foreach($criminalQs as $key => $text)
            @if($key === 'q24')
            <div class="alert alert-warning py-2 my-2">
                <small class="fw-bold">NOTE: If you were the beneficiary of a pardon, amnesty, a rehabilitation decree, or other act of clemency, provide documentation of that post-conviction action.</small>
            </div>
            @endif
            <div class="question-row border-bottom py-3 {{ $loop->last ? 'border-0' : '' }}">
                <div class="row align-items-center">
                    <div class="col-md-9"><label class="mb-0"><strong>{{ ++$qIndex }}.</strong> {{ $text }}</label></div>
                    <div class="col-md-3 mt-2 mt-md-0">
                        <div class="d-flex gap-3 justify-content-md-end">
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_yes" value="yes" {{ ($p9[$key] ?? '') === 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_no" value="no" {{ ($p9[$key] ?? '') === 'no' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    {{-- ===================== SECTION D: Security and Related ===================== --}}
    <div class="card mb-4 border shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Security and Related Grounds</h5>
        </div>
        <div class="card-body">
            @php
                $securityQs = [
                    'q42a' => 'Do you intend to engage in any activity that violates or evades any law relating to espionage (including spying) or sabotage in the United States?',
                    'q42b' => 'Do you intend to engage in any activity in the United States that violates or evades any law prohibiting the export from the United States of goods, technology, or sensitive information?',
                    'q42c' => 'Do you intend to engage in any activity whose purpose includes opposing, controlling, or overthrowing the U.S. Government by force, violence, or other unlawful means while in the United States?',
                    'q42d' => 'Do you intend to engage in any other unlawful activity?',
                    'q43a' => 'Have you EVER received any weapons training, paramilitary training, or other military-type training?',
                    'q43b' => 'Have you EVER committed kidnapping, assassination, or hijacking or sabotage of a conveyance (including an aircraft, vessel, vehicle, or train)?',
                    'q43c' => 'Have you EVER used a weapon or explosive or any dangerous device with the intent to endanger the safety of another person or people or cause damage to property?',
                    'q43d' => 'Have you EVER threatened, attempted, or conspired to do any of the activities described in the previous two questions?',
                    'q43e' => 'Have you EVER incited, under circumstances indicating an intention to cause death or serious bodily harm/injury, any of the activities described in the previous two questions?',
                    'q43f' => 'Have you EVER participated in, or been a member of, a group or organization that did any of the activities described in the previous questions?',
                    'q43g' => 'Have you EVER recruited members or asked for money or things of value for a group or organization that did any of the activities described in the previous questions?',
                    'q43h' => 'Have you EVER provided money, a thing of value, services or labor, or any other assistance or support for any of the activities described in the previous questions?',
                    'q43i' => 'Have you EVER provided money, a thing of value, services or labor, or any other assistance or support for an individual, group, or organization who did any of the activities described in the previous questions?',
                    'q44' => 'Do you intend to engage in any of the activities listed in any part of the previous questions?',
                    'q45' => 'Do you intend to engage in any activity that could endanger the welfare, safety, or security of the United States?',
                    'q46' => 'Are you the spouse or child of an individual who EVER engaged in any of the activities listed in the previous questions?',
                    'q47' => 'Have you EVER sold, provided, or transported weapons, or assisted any person in selling, providing, or transporting weapons, which you knew or believed would be used against another person?',
                    'q48' => 'Have you EVER worked, volunteered, or otherwise served in any prison, jail, prison camp, detention facility, labor camp, or any other place where people were detained, or have you EVER directed or participated in any other activity that involved detaining people?',
                    'q49' => 'Have you EVER been a member of, assisted, or participated in any group, unit, or organization of any kind in which you or other persons used any type of weapon against any person or threatened to do so?',
                    'q50' => 'Have you EVER served in, been a member of, assisted (helped), or participated in any military or police unit?',
                    'q51' => 'Have you EVER served in, been a member of, assisted (helped), or participated in any armed group (a group that carries weapons), for example: paramilitary unit, self-defense unit, vigilante unit, rebel group, or guerrilla group?',
                    'q52' => 'Have you EVER been a member of, or in any way affiliated with, the Communist Party or any totalitarian party (in the United States or abroad)?',
                    'q53a' => 'Have you EVER ordered, incited, called for, committed, assisted, helped with, or otherwise participated in: Torture?',
                    'q53b' => 'Have you EVER ordered, incited, called for, committed, assisted, helped with, or otherwise participated in: Genocide?',
                    'q53c' => 'Have you EVER ordered, incited, called for, committed, assisted, helped with, or otherwise participated in: Killing, or trying to kill, any person?',
                    'q53d' => 'Have you EVER ordered, incited, called for, committed, assisted, helped with, or otherwise participated in: Intentionally and severely injuring or trying to injure any person?',
                    'q54' => 'Have you EVER recruited, enlisted, conscripted, or used any person under 15 years of age to take part in hostilities or to serve in or help an armed force or group, or attempted or worked with others to do so?',
                    'q55' => 'Have you EVER used any person under 15 years of age to take part in hostilities, for instance, participating in combat or providing services related to combat (such as sabotage or serving as a courier) or providing support services (such as transporting supplies), or attempted or worked with others to do so?',
                ];
            @endphp
            @foreach($securityQs as $key => $text)
            <div class="question-row border-bottom py-3 {{ $loop->last ? 'border-0' : '' }}">
                <div class="row align-items-center">
                    <div class="col-md-9"><label class="mb-0"><strong>{{ ++$qIndex }}.</strong> {{ $text }}</label></div>
                    <div class="col-md-3 mt-2 mt-md-0">
                        <div class="d-flex gap-3 justify-content-md-end">
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_yes" value="yes" {{ ($p9[$key] ?? '') === 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_no" value="no" {{ ($p9[$key] ?? '') === 'no' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>



    {{-- ===================== SECTION E: Public Charge ===================== --}}
    <div class="card mb-4 border shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Public Charge</h5>
        </div>
        <div class="card-body">
            <div class="alert alert-info py-2 mb-3">
                <small>Each alien who is subject to the public charge ground of inadmissibility must complete the household and income questions below. If you fall under one of the exempt categories listed, select the exempt category and skip those questions.</small>
            </div>

            {{-- Item 56: Exemption --}}
            <div class="mb-4">
                <label class="fw-bold d-block mb-2">{{ ++$qIndex }}. I am exempt from the public charge ground of inadmissibility because I am a/an (select only one box):</label>
                @php
                    $exemptions = [
                        'vawa' => 'VAWA Self-Petitioner (Form I-360)',
                        'sij' => 'Special Immigrant Juvenile (Form I-360)',
                        'afghan_iraqi' => 'Certain Afghan or Iraqi National (Form I-360 or Form DS-157)',
                        'asylee' => 'Asylee (Form I-589 or Form I-730)',
                        'refugee' => 'Refugee (Form I-590 or Form I-730)',
                        'u_nonimmigrant_245m' => 'Victim of Qualifying Criminal Activity (U Nonimmigrant) under INA section 245(m)',
                        'u_nonimmigrant_other' => 'Any category other than INA section 245(m), but in valid U nonimmigrant status at time of filing',
                        't_nonimmigrant_245l' => 'Human Trafficking Victim (T nonimmigrant) under INA section 245(l)',
                        't_nonimmigrant_other' => 'Any category other than INA section 245(l), but with pending or valid T nonimmigrant status',
                        'cuban_adjustment' => 'Cuban Adjustment Act',
                        'cuban_battered' => 'Cuban Adjustment Act for Battered Spouses and Children',
                        'haitian_dependent' => 'Dependent Status under the Haitian Refugee Immigrant Fairness Act',
                        'haitian_battered' => 'Dependent Status under the Haitian Refugee Immigrant Fairness Act for Battered Spouses and Children',
                        'cuban_haitian_entrant' => 'Cuban and Haitian Entrants Applying for Adjustment of Status under section 202 of IRCA 1986',
                        'lautenberg' => 'A Lautenberg Parolee',
                        'vietnam_cambodia_laos' => 'National of Vietnam, Cambodia, or Laos Applying under the Foreign Operations Act',
                        'registry' => 'Continuous Residence in the United States Since Before January 1, 1972 ("Registry")',
                        'amerasian' => 'Amerasian Homecoming Act',
                        'polish_hungarian' => 'Polish or Hungarian Parolee',
                        'nacara' => 'Nicaraguans and Other Central Americans under NACARA',
                        'american_indian' => 'American Indian Born in Canada (INA section 289) or the Texas Band of Kickapoo Indians',
                        'liberian' => 'Section 7611 of the NDAA for Fiscal Year 2020 (Liberian Refugee Immigration Fairness)',
                        'syrian' => 'Syrian National Adjusting Status under Public Law 106-378',
                        'military_spouse' => 'Spouse, Child, or Parent of a U.S. Active-Duty Service Member under NDAA',
                        'none' => 'I do not fall under any of the exempt categories listed above and will complete Items A. - J.',
                    ];
                @endphp
                @foreach($exemptions as $val => $label)
                <div class="form-check mb-1">
                    <input class="form-check-input p9-exemption" type="radio" name="part9_data[q56]" id="q56_{{ $val }}" value="{{ $val }}" {{ ($p9['q56'] ?? '') === $val ? 'checked' : '' }}>
                    <label class="form-check-label small" for="q56_{{ $val }}">{{ $label }}</label>
                </div>
                @endforeach
            </div>

            {{-- Instruction Paragraph --}}
            <div id="public_charge_instruction" class="alert alert-info py-2 small mb-4" style="{{ ($p9['q56'] ?? '') === 'none' ? '' : 'display:none;' }}">
                If you selected "I do not fall under any of the exempt categories listed above and will complete Items A. - J." in Item Number 63., complete Items A. - J. below. If you selected an exempt category in Item Number 63., go to Item Number 64. If you need extra space to complete this section, use the space provided in Part 14. Additional Information.
            </div>

            {{-- Items 57–66 (shown only if "none" selected) --}}
            <div id="public_charge_details" style="{{ ($p9['q56'] ?? '') === 'none' ? '' : 'display:none;' }}">
                <hr>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold small">A. What is the size of your household?</label>
                        <input type="number" name="part9_data[q57]" class="form-control" min="1" value="{{ $p9['q57'] ?? '' }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold small">B. Indicate your annual household income.</label>
                        <select name="part9_data[q58]" class="form-control">
                            <option value="">-Select-</option>
                            @foreach(['$0-27,000', '$27,001-52,000', '$52,001-85,000', '$85,001-141,000', 'Over $141,000'] as $range)
                                <option value="{{ $range }}" {{ ($p9['q58'] ?? '') === $range ? 'selected' : '' }}>{{ $range }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold small">C. Total value of household assets.</label>
                        <select name="part9_data[q59]" class="form-control">
                            <option value="">-Select-</option>
                            @foreach(['$0-18,400', '$18,401-136,000', '$136,001-321,400', '$321,401-707,100', 'Over $707,100'] as $range)
                                <option value="{{ $range }}" {{ ($p9['q59'] ?? '') === $range ? 'selected' : '' }}>{{ $range }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="fw-bold small">D. Total value of household liabilities.</label>
                        <select name="part9_data[q60]" class="form-control">
                            <option value="">-Select-</option>
                            @foreach(['$0', '$1-10,100', '$10,101-57,700', '$57,701-186,800', 'Over $186,800'] as $range)
                                <option value="{{ $range }}" {{ ($p9['q60'] ?? '') === $range ? 'selected' : '' }}>{{ $range }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="fw-bold small">E. What is the highest degree or grade of school you have completed?</label>
                        <select name="part9_data[q61]" id="q61_select" class="form-control mb-2">
                            <option value="">-Select-</option>
                            @foreach([
                                'Less than a high school diploma',
                                'High school diploma, GED, or alternative credential',
                                '1 or more years of college credit, no degree',
                                "Associate's degree",
                                "Bachelor's degree",
                                "Master's degree",
                                'Professional degree (JD, MD, DMD, etc.)',
                                'Doctorate degree',
                            ] as $edu)
                                <option value="{{ $edu }}" {{ ($p9['q61'] ?? '') === $edu ? 'selected' : '' }}>{{ $edu }}</option>
                            @endforeach
                        </select>
                        <div id="q61_grade_detail" style="{{ ($p9['q61'] ?? '') === 'Less than a high school diploma' ? '' : 'display:none;' }}">
                            <label class="small text-muted">If you select this option, indicate the highest grade of school you have completed:</label>
                            <input type="text" name="part9_data[q61_grade]" class="form-control" value="{{ $p9['q61_grade'] ?? '' }}" placeholder="Highest grade completed">
                        </div>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="fw-bold small">F. List your certifications, licenses, skills obtained through work experience, and educational certificates.</label>
                        <textarea name="part9_data[q62]" class="form-control" rows="3" placeholder="List of Certifications">{{ $p9['q62'] ?? '' }}</textarea>
                    </div>
                </div>

                @php
                    $publicChargeQs = [
                        'q63' => 'Have you ever received Supplemental Security Income (SSI), Temporary Assistance for Needy Families (TANF), or state, Tribal, territorial, or local cash benefit programs for income maintenance (often called “General Assistance” in the state context, but which also exist under other names)?',
                        'q64' => 'Have you ever received long-term institutionalization at government expense?',
                    ];
                @endphp
                @foreach($publicChargeQs as $key => $text)
                <div class="question-row border-bottom py-3 {{ $loop->last ? 'border-0' : '' }}">
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <label class="mb-0"><strong>{{ $key === 'q63' ? 'G.' : 'I.' }}</strong> {{ $text }}</label>
                        </div>
                        <div class="col-md-3 mt-2 mt-md-0">
                            <div class="d-flex gap-3 justify-content-md-end">
                                <div class="form-check">
                                    <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_yes" value="yes" {{ ($p9[$key] ?? '') === 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $key }}_yes">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_no" value="no" {{ ($p9[$key] ?? '') === 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $key }}_no">No</label>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Conditional Details for Q63 (G) -> H --}}
                        @if($key === 'q63')
                        <div class="col-md-12 mt-3" id="{{ $key }}_details" style="{{ ($p9[$key] ?? '') === 'yes' ? '' : 'display:none;' }}">
                            <div class="fw-bold small mb-2"><strong>H.</strong> If your answer to Item G. is "Yes," list the specific benefit(s) you received, the start and end dates of each period of receipt, the dollar amount of benefits received, and whether you received the benefits while you were in an immigration category exempt from the public charge ground of inadmissibility.</div>
                            <div class="alert alert-secondary py-1 small mb-2">
                                Benefit Received | Start Date | End Date | Dollar Amount
                            </div>
                            <textarea name="part9_data[{{ $key }}_details]" class="form-control" rows="3" placeholder="Benefit Received, Start Date, End Date, Dollar Amount, Exempt Status">{{ $p9[$key . '_details'] ?? '' }}</textarea>
                        </div>
                        @endif

                        {{-- Conditional Details for Q64 (I) -> J --}}
                        @if($key === 'q64')
                        <div class="col-md-12 mt-3" id="{{ $key }}_details" style="{{ ($p9[$key] ?? '') === 'yes' ? '' : 'display:none;' }}">
                            <div class="fw-bold small mb-2"><strong>J.</strong> If your answer to Item I. is "Yes," list the name, city, and state for each institution, the start and end dates of each period of institutionalization, the reason you were institutionalized, and whether you were institutionalized while you were in an immigration category exempt from the public charge ground of inadmissibility.</div>
                            <div class="alert alert-secondary py-1 small mb-2">
                                Institution Name/City/State | Date From | Date To | Reason
                            </div>
                            <textarea name="part9_data[{{ $key }}_details]" class="form-control" rows="3" placeholder="Institution Name/City/State, Dates (From-To), Reason, Exempt Status">{{ $p9[$key . '_details'] ?? '' }}</textarea>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ===================== SECTION F: Illegal Entries and Other Immigration Violations ===================== --}}
    <div class="card mb-4 border shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Illegal Entries and Other Immigration Violations</h5>
        </div>
        <div class="card-body">
            @php
                $illegalEntriesQs = [
                    'q67' => 'Have you EVER failed or refused to attend or to remain in attendance at any removal proceeding filed against you on or after April 1, 1997?',
                    'q68' => 'Have you EVER submitted altered, fraudulent, or counterfeit documentation to any U.S. Government official to obtain or attempt to obtain any immigration benefit, including a visa or entry into the United States?',
                    'q69' => 'Have you EVER lied about, concealed, or misrepresented any information on an application or petition to obtain a visa, other documentation required for entry into the United States, admission to the United States, or any other kind of immigration benefit?',
                    'q70' => 'Have you EVER falsely claimed to be a U.S. citizen (in writing or any other way)?',
                    'q71' => 'Have you EVER been a stowaway on a vessel or aircraft arriving in the United States?',
                    'q72' => 'Have you EVER knowingly encouraged, induced, assisted, abetted, or aided any alien to enter or to try to enter the United States illegally (alien smuggling)?',
                    'q73' => 'Are you under a final order of civil penalty for violating INA section 274C for use of fraudulent documents?',
                ];
            @endphp
            @foreach($illegalEntriesQs as $key => $text)
            @if($key === 'q67')
            <div class="mt-3 mb-2">
                <small class="fw-bold text-muted">NOTE: If your answer to this question is "Yes," attach a written statement explaining why you failed or refused to attend or remain in attendance at the removal proceeding, including any explanation of a reasonable cause for that failure or refusal.</small>
            </div>
            @endif
            <div class="question-row border-bottom py-3 {{ $loop->last ? 'border-0' : '' }}">
                <div class="row align-items-center">
                    <div class="col-md-9"><label class="mb-0"><strong>{{ ++$qIndex }}.</strong> {{ $text }}</label></div>
                    <div class="col-md-3 mt-2 mt-md-0">
                        <div class="d-flex gap-3 justify-content-md-end">
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_yes" value="yes" {{ ($p9[$key] ?? '') === 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_no" value="no" {{ ($p9[$key] ?? '') === 'no' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>



    {{-- ===================== SECTION G: Removal, Unlawful Presence, or Illegal Reentry ===================== --}}
    <div class="card mb-4 border shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Removal, Unlawful Presence, or Illegal Reentry</h5>
        </div>
        <div class="card-body">
            @php
                $removalQs = [
                    'q74' => 'Have you EVER been excluded, deported, or removed from the United States or have you ever departed the United States on your own after having been ordered excluded, deported, or removed from the United States?',
                    'q75' => 'Have you EVER entered the United States without being inspected and admitted or paroled?',
                    'q76' => 'Since April 1, 1997, have you been unlawfully present in the United States? You were unlawfully present in the United States if you were present in the United States after the expiration of the period of stay authorized by the Department of Homeland Security (DHS) Secretary or were present in the United States without being admitted or paroled.',
                ];
            @endphp
            @foreach($removalQs as $key => $text)
            <div class="question-row border-bottom py-3">
                <div class="row align-items-center">
                    <div class="col-md-9"><label class="mb-0"><strong>{{ ++$qIndex }}.</strong> {{ $text }}</label></div>
                    <div class="col-md-3 mt-2 mt-md-0">
                        <div class="d-flex gap-3 justify-content-md-end">
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_yes" value="yes" {{ ($p9[$key] ?? '') === 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_no" value="no" {{ ($p9[$key] ?? '') === 'no' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}_no">No</label>
                            </div>
                        </div>
                    </div>
                    {{-- Logic for Q76 details --}}
                    @if($key === 'q76')
                    <div class="col-md-12 mt-3" id="{{ $key }}_details" style="{{ ($p9[$key] ?? '') === 'yes' ? '' : 'display:none;' }}">
                         <div class="alert alert-warning py-2 small fw-bold mb-3">
                            <p class="mb-1">NOTE: If you answered "Yes" to this question, give the dates of unlawful presence in the space provided in Part 14. Additional Information.</p>
                        </div>
                        <div class="ps-4 border-start border-3 border-secondary mb-3">
                            <label class="mb-2 fw-bold small">Was a severe form of trafficking in persons at least one central reason for your unlawful presence in the United States?</label>
                            <div class="alert alert-secondary py-2 small mb-2">
                                NOTE: Severe trafficking in persons involves sex trafficking (induced by force, fraud, coercion, or involving a minor) or labor trafficking (involuntary servitude, peonage, debt bondage, or slavery).
                            </div>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="part9_data[q76_trafficking]" id="q76_trafficking_yes" value="yes" {{ ($p9['q76_trafficking'] ?? '') === 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="q76_trafficking_yes">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="part9_data[q76_trafficking]" id="q76_trafficking_no" value="no" {{ ($p9['q76_trafficking'] ?? '') === 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="q76_trafficking_no">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach

            {{-- Q77/78 logic --}}
            <div class="question-row border-bottom py-3 border-0">
                <label class="mb-3 d-block"><strong>{{ ++$qIndex }}.</strong> Since April 1, 1997, have you EVER reentered or attempted to reenter the United States without being inspected and admitted or paroled after:</label>
                
                <div class="ps-4 mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <label class="mb-0"><strong>a.</strong> Having been unlawfully present in the United States for more than one year in the aggregate on or after April 1, 1997?</label>
                            <small class="text-muted d-block mt-1">You were unlawfully present in the United States for more than one year in the aggregate if you count all of the days during all of your stays that you were present in the United States after the expiration of the period of stay authorized by the DHS Secretary or were present in the United States without being admitted or paroled.</small>
                        </div>
                        <div class="col-md-3 mt-2 mt-md-0">
                             <div class="d-flex gap-3 justify-content-md-end">
                                <div class="form-check">
                                    <input class="form-check-input p9-check" type="radio" name="part9_data[q77a]" id="q77a_yes" value="yes" {{ ($p9['q77a'] ?? '') === 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="q77a_yes">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input p9-check" type="radio" name="part9_data[q77a]" id="q77a_no" value="no" {{ ($p9['q77a'] ?? '') === 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="q77a_no">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ps-4">
                    <div class="row align-items-center">
                        <div class="col-md-9">
                            <label class="mb-0"><strong>b.</strong> Having been deported, excluded, or removed from the United States?</label>
                        </div>
                         <div class="col-md-3 mt-2 mt-md-0">
                             <div class="d-flex gap-3 justify-content-md-end">
                                <div class="form-check">
                                    <input class="form-check-input p9-check" type="radio" name="part9_data[q77b]" id="q77b_yes" value="yes" {{ ($p9['q77b'] ?? '') === 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="q77b_yes">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input p9-check" type="radio" name="part9_data[q77b]" id="q77b_no" value="no" {{ ($p9['q77b'] ?? '') === 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="q77b_no">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===================== SECTION H: Miscellaneous Conduct ===================== --}}
    <div class="card mb-4 border shadow-sm">
        <div class="card-header bg-light">
            <h5 class="mb-0">Miscellaneous Conduct</h5>
        </div>
        <div class="card-body">
            @php
                $miscQs = [
                    'q79' => 'Do you plan to practice polygamy in the United States?',
                    'q80' => 'Are you accompanying an alien who is inadmissible and who has been certified by a medical officer as helpless from sickness, mental or physical disability, or infancy, and who requires your protection or guardianship, as described in INA section 232(c)?',
                    'q81' => 'Have you EVER assisted in detaining, retaining, or withholding custody of a U.S. citizen child outside the United States from a person who has been granted custody of the child?',
                    'q82' => 'Have you EVER voted in violation of any Federal, state, or local constitutional provision, statute, ordinance, or regulation in the United States?',
                    'q83' => 'Have you EVER renounced U.S. citizenship to avoid being taxed by the United States?',
                ];
            @endphp
             @foreach($miscQs as $key => $text)
            <div class="question-row border-bottom py-3">
                <div class="row align-items-center">
                    <div class="col-md-9"><label class="mb-0"><strong>{{ ++$qIndex }}.</strong> {{ $text }}</label></div>
                    <div class="col-md-3 mt-2 mt-md-0">
                        <div class="d-flex gap-3 justify-content-md-end">
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_yes" value="yes" {{ ($p9[$key] ?? '') === 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_no" value="no" {{ ($p9[$key] ?? '') === 'no' ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $key }}_no">No</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Q84 --}}
             <div class="question-row border-bottom py-3">
                <label class="mb-3 d-block"><strong>{{ ++$qIndex }}.</strong> Have you EVER:</label>
                @php
                    $q84s = [
                        'q84a' => 'Applied for exemption or discharge from training or service in the U.S. armed forces or in the U.S. National Security Training Corps on the ground that you are an alien?',
                        'q84b' => 'Been relieved or discharged from such training or service on the ground that you are an alien?',
                        'q84c' => 'Been convicted of desertion from the U.S. armed forces?',
                    ];
                    $subLabels = ['a', 'b', 'c'];
                    $i = 0;
                @endphp
                @foreach($q84s as $key => $text)
                <div class="ps-4 mb-3">
                     <div class="row align-items-center">
                        <div class="col-md-9">
                            <label class="mb-0"><strong>{{ $subLabels[$i++] }}.</strong> {{ $text }}</label>
                        </div>
                         <div class="col-md-3 mt-2 mt-md-0">
                             <div class="d-flex gap-3 justify-content-md-end">
                                <div class="form-check">
                                    <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_yes" value="yes" {{ ($p9[$key] ?? '') === 'yes' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $key }}_yes">Yes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input p9-check" type="radio" name="part9_data[{{ $key }}]" id="{{ $key }}_no" value="no" {{ ($p9[$key] ?? '') === 'no' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $key }}_no">No</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Q85 --}}
            <div class="question-row border-bottom py-3 border-0">
                 <div class="row align-items-center">
                    <div class="col-md-9"><label class="mb-0"><strong>{{ ++$qIndex }}.</strong> Have you EVER left or remained outside the United States to avoid or evade training or service in the U.S. armed forces in time of war or a period declared by the President to be a national emergency?</label></div>
                    <div class="col-md-3 mt-2 mt-md-0">
                        <div class="d-flex gap-3 justify-content-md-end">
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[q85]" id="q85_yes" value="yes" {{ ($p9['q85'] ?? '') === 'yes' ? 'checked' : '' }}>
                                <label class="form-check-label" for="q85_yes">Yes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input p9-check" type="radio" name="part9_data[q85]" id="q85_no" value="no" {{ ($p9['q85'] ?? '') === 'no' ? 'checked' : '' }}>
                                <label class="form-check-label" for="q85_no">No</label>
                            </div>
                        </div>
                    </div>
                    {{-- Q86 Logic --}}
                    @if(true) 
                    <div class="col-md-12 mt-3" id="q85_details" style="{{ ($p9['q85'] ?? '') === 'yes' ? '' : 'display:none;' }}">
                         <label class="fw-bold small mb-2">{{ ++$qIndex }}. If you answered "Yes" to Item Number 85 (above question), what was your nationality or immigration status immediately before you left (for example, U.S. citizen or national, lawful permanent resident, nonimmigrant, parolee, present without admission or parole, or any other status)?</label>
                         <input type="text" name="part9_data[q86]" class="form-control" value="{{ $p9['q86'] ?? '' }}">
                    </div>
                    @endif
                </div>
            </div>
            


    <div id="p9_explanation_section" class="mt-4">
        <h5 class="mb-3">Required Explanation (Additional Information)</h5>
        <div class="alert alert-danger py-2">
            You have answered "Yes" to one or more questions. You MUST provide a detailed explanation below, including dates, locations, and full details for each "Yes" answer.
        </div>
        {{ Form::textarea('part9_explanation', optional($application)->part9_explanation ?? '', [
            'class' => 'form-control',
            'rows' => 8,
            'placeholder' => 'Provide dates, locations, and full details for each "Yes" answer.'
        ]) }}
    </div>

</div>

<script>
    function showOrg2() {
        $('#org2_container').show();
        $('#add_org_btn_container').hide();
    }
    
    function hideOrg2() {
        $('#org2_container').hide();
        // Clear inputs
        $('#org2_container input, #org2_container textarea, #org2_container select').val('');
        $('#add_org_btn_container').show();
    }

$(document).ready(function() {
    // Show/hide organization details based on Q1
    function toggleOrgDetails() {
        if ($('input[name="part9_data[q1]"]:checked').val() === 'yes') {
            $('#org_details_section').show();
        } else {
            $('#org_details_section').hide();
        }
    }
    $(document).on('change', '.p9-org-trigger', toggleOrgDetails);
    toggleOrgDetails();

    // Show/hide public charge details based on Q56
    function togglePublicCharge() {
        if ($('input[name="part9_data[q56]"]:checked').val() === 'none') {
            $('#public_charge_details').show();
            $('#public_charge_instruction').show();
        } else {
            $('#public_charge_details').hide();
            $('#public_charge_instruction').hide();
        }
    }
    $(document).on('change', '.p9-exemption', togglePublicCharge);
    togglePublicCharge();

    // Toggle grade detail for Q61
    $('#q61_select').on('change', function() {
        if ($(this).val() === 'Less than a high school diploma') {
            $('#q61_grade_detail').show();
        } else {
            $('#q61_grade_detail').hide();
        }
    });

    });
});
</script>