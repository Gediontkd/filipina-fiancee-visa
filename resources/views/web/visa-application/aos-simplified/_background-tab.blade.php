<div class="eligibility-section">
    <h4 class="mb-4 border-bottom pb-2">
        <i class="fa fa-shield-alt me-2 text-primary"></i>Part 8. Eligibility and Inadmissibility Grounds
    </h4>
    
    <div class="alert alert-warning mb-4">
        <i class="fa fa-exclamation-triangle me-2"></i>
        <strong>Mandatory Disclosure:</strong> You must answer every question. If you answer "Yes" to any question, you must provide a detailed explanation in the field at the bottom of the page.
    </div>

    @php
        $questions = [
            'general' => [
                'title' => 'General Information',
                'icon' => 'fa-info-circle',
                'items' => [
                    ['id' => 'q1', 'text' => 'Have you EVER been a member of, or in any way affiliated with, the Communist Party or any other totalitarian party?'],
                    ['id' => 'q2', 'text' => 'Have you EVER advocated the overthrow of any government by force or violence?'],
                    ['id' => 'q3', 'text' => 'Have you EVER been a member of, or in any way affiliated with, a terrorist organization?'],
                    ['id' => 'q13a', 'text' => 'Have you EVER served in, been a member of, assisted, or participated in any military unit, paramilitary unit, police unit, self-defense unit, vigilante unit, rebel group, guerrilla group, militia, insurgent organization, or any other armed group?'],
                ]
            ],
            'criminal' => [
                'title' => 'Criminal History',
                'icon' => 'fa-gavel',
                'items' => [
                    ['id' => 'q14', 'text' => 'Have you EVER been arrested, cited, charged, or detained by any law enforcement officer (including DHS, USCIS, and military officers) for any reason?'],
                    ['id' => 'q15', 'text' => 'Have you EVER committed a crime of any kind, even if you were not arrested?'],
                    ['id' => 'q16', 'text' => 'Have you EVER pled guilty to or been convicted of a crime or offense?'],
                    ['id' => 'q17', 'text' => 'Have you EVER been placed in a community-based alternative to punishment (e.g., diversion, deferred prosecution, withheld adjudication)?'],
                    ['id' => 'q25', 'text' => 'Have you EVER been involved in illicit drug trafficking?'],
                    ['id' => 'q26', 'text' => 'Have you EVER been involved in prostitution or procured anyone for prostitution?'],
                    ['id' => 'q27', 'text' => 'Have you EVER received any income or derived any benefit from prostitution?'],
                ]
            ],
            'security' => [
                'title' => 'Security and Related Grounds',
                'icon' => 'fa-user-shield',
                'items' => [
                    ['id' => 'q46', 'text' => 'Do you plan to engage in espionage or sabotage while in the United States?'],
                    ['id' => 'q48', 'text' => 'Have you EVER engaged in, or do you intend to engage in, terrorist activities?'],
                    ['id' => 'q51', 'text' => 'Have you EVER assisted in any way with torture or extrajudicial killing?'],
                    ['id' => 'q53', 'text' => 'Have you EVER been involved in human rights violations, such as genocide or severe violations of religious freedom?'],
                ]
            ],
            'violations' => [
                'title' => 'Removal, Deportation, and Illegal Entry',
                'icon' => 'fa-ban',
                'items' => [
                    ['id' => 'q61', 'text' => 'Have you EVER been deported or removed from the United States?'],
                    ['id' => 'q62', 'text' => 'Have you EVER been ordered deported, excluded, or removed from the United States?'],
                    ['id' => 'q67', 'text' => 'Have you EVER failed or refused to attend or remain in attendance at any removal proceeding?'],
                    ['id' => 'q68', 'text' => 'Have you EVER falsely represented yourself to be a U.S. citizen?'],
                    ['id' => 'q69', 'text' => 'Have you EVER made a fraudulent statement or misrepresented a material fact to obtain any immigration benefit?'],
                    ['id' => 'q71', 'text' => 'Have you EVER assisted anyone to enter or try to enter the United States in violation of law?'],
                ]
            ],
            'public_charge' => [
                'title' => 'Public Charge and Other Grounds',
                'icon' => 'fa-hand-holding-usd',
                'items' => [
                    ['id' => 'q61_pc', 'text' => 'Are you likely at any time to become a public charge?'],
                    ['id' => 'q62_pc', 'text' => 'Have you EVER received public assistance in the United States?'],
                    ['id' => 'q77', 'text' => 'Have you EVER been a J nonimmigrant exchange visitor who is subject to the 2-year foreign residence requirement and not yet complied or waived it?'],
                ]
            ]
        ];
        $storedAnswers = optional($application)->eligibility_questions ?? [];
    @endphp

    @foreach($questions as $categoryKey => $category)
        <div class="card mb-4 border shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0"><i class="fa {{ $category['icon'] }} me-2"></i>{{ $category['title'] }}</h5>
            </div>
            <div class="card-body">
                @foreach($category['items'] as $item)
                    <div class="question-row border-bottom py-3 {{ $loop->last ? 'border-0' : '' }}">
                        <div class="row align-items-center">
                            <div class="col-md-9">
                                <label class="mb-0"><strong>{{ $item['id'] }}.</strong> {{ $item['text'] }}</label>
                            </div>
                            <div class="col-md-3 mt-2 mt-md-0">
                                <div class="d-flex gap-3 justify-content-md-end">
                                    <div class="form-check">
                                        <input class="form-check-input eligibility-check" type="radio" 
                                            name="eligibility_questions[{{ $item['id'] }}]" 
                                            id="{{ $item['id'] }}_yes" 
                                            value="yes"
                                            {{ ($storedAnswers[$item['id']] ?? '') === 'yes' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $item['id'] }}_yes">Yes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input eligibility-check" type="radio" 
                                            name="eligibility_questions[{{ $item['id'] }}]" 
                                            id="{{ $item['id'] }}_no" 
                                            value="no"
                                            {{ ($storedAnswers[$item['id']] ?? '') === 'no' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ $item['id'] }}_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

    <!-- Explanation Section -->
    <div id="eligibility_explanation_section" class="mt-4" style="display: none;">
        <h5 class="mb-3"><i class="fa fa-comment-alt me-2 text-danger"></i>Required Explanation</h5>
        <div class="alert alert-danger py-2">
            You have answered "Yes" to one or more eligibility questions. You MUST provide a detailed explanation below.
        </div>
        {{ Form::textarea('background_explanation', optional($application)->background_explanation ?? '', [
            'class' => 'form-control',
            'rows' => 6,
            'placeholder' => 'Provide dates, locations, and full details for each "Yes" answer.'
        ]) }}
    </div>

    <!-- Navigation -->
    <div class="d-flex justify-content-between flex-wrap mt-5 pt-4 border-top gap-2">
        <button type="button" class="btn btn-primary aos-action-btn" onclick="$('#sponsor-tab').tab('show')">
            <i class="fa fa-arrow-left me-2"></i>Previous
        </button>
        <div class="ms-md-auto text-end">
            <p class="small text-muted mb-0"><i class="fa fa-info-circle me-1"></i>Ensure all sections are 100% complete.</p>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function checkExplanations() {
            let hasYes = false;
            $('.eligibility-check:checked').each(function() {
                if ($(this).val() === 'yes') {
                    hasYes = true;
                    return false;
                }
            });
            
            if (hasYes) {
                $('#eligibility_explanation_section').show();
            } else {
                $('#eligibility_explanation_section').hide();
            }
        }

        $(document).on('change', '.eligibility-check', function() {
            checkExplanations();
        });

        // Run on load
        checkExplanations();
    });
</script>