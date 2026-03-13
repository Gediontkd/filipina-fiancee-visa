<?php

namespace App\Services\Fiance;

use App\Models\FianceVisaSubmittedStep;
use App\Models\User;
use Carbon\Carbon;

class K1FormReviewService
{
    public const REQUIRED_SPONSOR_STEPS = 10;
    public const REQUIRED_ALIEN_STEPS = 21;

    public function getProgressForUser(User|int $user): array
    {
        $userId = $user instanceof User ? $user->id : $user;

        $steps = FianceVisaSubmittedStep::where('user_id', $userId)->get();
        $stepMap = [];

        foreach ($steps as $step) {
            $stepMap[$step->type][$step->step] = is_array($step->detail) ? $step->detail : [];
        }

        $sponsorCount = count($stepMap['sponsor'] ?? []);
        $alienCount = count($stepMap['alien'] ?? []);
        $childrenCount = count($stepMap['alien-children'] ?? []);

        $completedRequiredSteps = min($sponsorCount, self::REQUIRED_SPONSOR_STEPS)
            + min($alienCount, self::REQUIRED_ALIEN_STEPS);
        $requiredSteps = self::REQUIRED_SPONSOR_STEPS + self::REQUIRED_ALIEN_STEPS;

        $blockingIssues = $this->collectBlockingIssues($stepMap);
        $isSponsorComplete = $sponsorCount >= self::REQUIRED_SPONSOR_STEPS;
        $isAlienComplete = $alienCount >= self::REQUIRED_ALIEN_STEPS;
        $canRequestReview = $isSponsorComplete && $isAlienComplete && empty($blockingIssues);

        return [
            'sponsor_count' => $sponsorCount,
            'sponsor_required' => self::REQUIRED_SPONSOR_STEPS,
            'alien_count' => $alienCount,
            'alien_required' => self::REQUIRED_ALIEN_STEPS,
            'children_count' => $childrenCount,
            'completed_required_steps' => $completedRequiredSteps,
            'required_steps' => $requiredSteps,
            'percent_complete' => $requiredSteps > 0
                ? round(($completedRequiredSteps / $requiredSteps) * 100, 1)
                : 0.0,
            'is_sponsor_complete' => $isSponsorComplete,
            'is_alien_complete' => $isAlienComplete,
            'can_request_review' => $canRequestReview,
            'blocking_issues' => $blockingIssues,
        ];
    }

    private function collectBlockingIssues(array $stepMap): array
    {
        $issues = [];

        $sponsorName = $stepMap['sponsor']['name'] ?? [];
        if (($sponsorName['classification_sought'] ?? null) !== 'K-1') {
            $issues[] = 'Part 1 classification must be recorded as K-1 fiance(e).';
        }

        $alienName = $stepMap['alien']['name'] ?? [];
        if (($alienName['beneficiary_classification_sought'] ?? null) !== 'K-1') {
            $issues[] = 'Part 2 classification sought for the beneficiary must be recorded as K-1 fiance(e).';
        }

        $sponsorStatus = $stepMap['sponsor']['status'] ?? [];
        $sponsorContact = $stepMap['sponsor']['contact'] ?? [];
        $sponsorContactA = trim((string) ($sponsorContact['sponsor_a'] ?? ''));
        if (($sponsorStatus['current_status'] ?? null) === 'USCitizen' && $sponsorContactA !== '' && strtoupper($sponsorContactA) !== 'N/A') {
            $issues[] = 'A U.S. citizen petitioner must not have an A-Number in the contact section.';
        }

        $sponsorUscisAccount = trim((string) ($sponsorContact['uscis_no'] ?? ''));
        if (strtoupper($sponsorUscisAccount) === 'N/A') {
            $issues[] = 'USCIS Online Account Number must be left blank unless USCIS explicitly issued one.';
        }

        $issues = array_merge(
            $issues,
            $this->validateEmploymentHistory($stepMap['sponsor']['employment'] ?? [], 'Petitioner'),
            $this->validateEmploymentHistory($stepMap['alien']['employment'] ?? [], 'Beneficiary')
        );

        $alienCitizenship = $stepMap['alien']['citizenship'] ?? [];
        $alienAddress = $stepMap['alien']['address'] ?? [];
        $isPhilippineCase = ($alienCitizenship['country_of_citizenship'] ?? null) === 'Philippines'
            || ($alienAddress['country'] ?? null) === 'Philippines';

        if ($isPhilippineCase) {
            $nativeName = strtoupper(trim((string) ($alienAddress['native_alphabet_name'] ?? '')));
            $nativeAddress = strtoupper(trim((string) ($alienAddress['native_alphabet_address'] ?? '')));

            if ($nativeName !== 'N/A' || $nativeAddress !== 'N/A') {
                $issues[] = 'For Philippine cases, the native alphabet section must be completed as N/A.';
            }
        }

        $sponsorMilitary = $stepMap['sponsor']['military-and-convictions'] ?? [];
        $issues = array_merge(
            $issues,
            $this->validateRequiredAnswers(
                $sponsorMilitary,
                ['protection', 'violence', 'manslaughter', 'convictions', 'drug_related', 'specified_offense'],
                'Petitioner criminal-history yes/no questions cannot be left blank.'
            )
        );

        if ($this->hasSponsorLegalInfractionYesAnswer($sponsorMilitary)
        ) {
            $issues = array_merge(
                $issues,
                $this->validateStructuredLegalInfractions($sponsorMilitary, 'Petitioner')
            );
        }

        $alienActivity = $stepMap['alien']['activity'] ?? [];
        $alienQuestionOne = $stepMap['alien']['question1'] ?? [];
        $alienQuestionTwo = $stepMap['alien']['question2'] ?? [];
        $alienQuestionThree = $stepMap['alien']['question3'] ?? [];
        $alienQuestionFour = $stepMap['alien']['question4'] ?? [];
        $alienQuestionFive = $stepMap['alien']['question5'] ?? [];

        $issues = array_merge(
            $issues,
            $this->validateRequiredAnswers(
                $alienActivity,
                ['arrested_convicted'],
                'Beneficiary criminal-history yes/no questions cannot be left blank.'
            ),
            $this->validateRequiredAnswers(
                $alienQuestionOne,
                [
                    'insurgent_orga',
                    'human_service',
                    'physical_disorder',
                    'drug_abuser',
                    'medical_examination',
                    'arrested_or_convicted',
                    'violated_or_engaged',
                    'prostitution',
                    'money_laundering',
                    'trafficking_offense',
                    'knowingly_aided',
                ],
                'Beneficiary admissibility yes/no questions cannot be left blank.'
            ),
            $this->validateRequiredAnswers(
                $alienQuestionTwo,
                [
                    'trafficking_offense',
                    'trafficking_activitie',
                    'significant_role',
                    'violated_controlled',
                    'illegal_activity',
                    'terrorist_activities',
                    'terrorist_orga',
                    'member_terr_orga',
                    'participated_genocide',
                    'participated_torture',
                    'withholding_custody',
                ],
                'Beneficiary admissibility yes/no questions cannot be left blank.'
            ),
            $this->validateRequiredAnswers(
                $alienQuestionThree,
                [
                    'acts_of_violence',
                    'child_soldier',
                    'religious_freedom',
                    'member_of_affiliated',
                    'colombia_group',
                    'governmental_abuse',
                    'expropriated_property',
                    'chemical_weapon',
                    'trafficked_confidential',
                    'establishment',
                ],
                'Beneficiary admissibility yes/no questions cannot be left blank.'
            ),
            $this->validateRequiredAnswers(
                $alienQuestionFour,
                [
                    'transplantation',
                    'civil_penalty',
                    'ordered_removed',
                    'ordered_removed_2',
                    'unlawfully_present',
                    'convicted_aggravated',
                    'voluntarily_departed',
                    'aggregate_at_any_time',
                    'withheld_custody',
                    'removed_deported',
                    'deportation_hearing',
                    'inadmissibilty',
                    'admitted_u_s',
                    'immigration_official',
                ],
                'Beneficiary admissibility yes/no questions cannot be left blank.'
            ),
            $this->validateRequiredAnswers(
                $alienQuestionFive,
                [
                    'avoiding_taxation',
                    'former_exchange_visitor',
                    'secretary_of_labor',
                    'foreign_medical_school',
                    'credentialing_org',
                    'permanently_ineligible',
                    'departed_us',
                    'practice_polygamy',
                    'frivolous_application',
                    'misrepresentation',
                ],
                'Beneficiary admissibility yes/no questions cannot be left blank.'
            )
        );

        if ((($alienActivity['arrested_convicted'] ?? null) === 'yes' || ($alienQuestionOne['arrested_or_convicted'] ?? null) === 'yes')
        ) {
            $issues = array_merge(
                $issues,
                $this->validateStructuredLegalInfractions($alienActivity, 'Beneficiary')
            );
        }

        return array_values(array_unique($issues));
    }

    private function validateEmploymentHistory(array $detail, string $label): array
    {
        if (empty($detail)) {
            return ["{$label} employment history is still incomplete."];
        }

        $entries = [];
        for ($i = 1; $i <= 5; $i++) {
            $name = trim((string) ($detail["full_name_of_employer{$i}"] ?? ''));
            $start = trim((string) ($detail["employement_start_date{$i}"] ?? ''));
            $end = trim((string) ($detail["employement_end_date{$i}"] ?? ''));

            if ($i === 1 && !empty($detail['present_date'])) {
                $end = 'Present';
            }

            if ($name === '' && $start === '' && $end === '') {
                continue;
            }

            $entries[] = [
                'index' => $i,
                'name' => $name,
                'start' => $this->parseDate($start),
                'end' => strtoupper($end) === 'PRESENT' ? Carbon::today() : $this->parseDate($end),
                'end_is_present' => strtoupper($end) === 'PRESENT',
            ];
        }

        if (empty($entries)) {
            return ["{$label} employment history is still incomplete."];
        }

        $issues = [];

        if (!$entries[0]['end_is_present']) {
            $issues[] = "{$label} Employer 1 must always be the current or present status and end with PRESENT.";
        }

        if ($entries[0]['name'] === '') {
            $issues[] = "{$label} Employer 1 is missing. If currently unemployed, enter Unemployed with the start date and PRESENT.";
        }

        foreach ($entries as $entry) {
            if (!$entry['start'] || !$entry['end']) {
                $issues[] = "{$label} employment dates must be entered in mm/dd/yyyy format for every timeline entry.";
                return array_values(array_unique($issues));
            }
        }

        foreach ($entries as $index => $entry) {
            if (!isset($entries[$index + 1])) {
                continue;
            }

            $newerStart = $entry['start'];
            $olderEnd = $entries[$index + 1]['end'];

            if ($olderEnd->copy()->addDay()->lt($newerStart)) {
                $issues[] = "{$label} employment must preserve a continuous 5-year timeline with no gaps. Add Unemployed where needed.";
                break;
            }
        }

        $oldestEntry = end($entries);
        $fiveYearsAgo = Carbon::today()->subYears(5);
        if ($oldestEntry['start']->gt($fiveYearsAgo)) {
            $issues[] = "{$label} employment does not yet cover a full continuous 5-year history.";
        }

        return array_values(array_unique($issues));
    }

    private function hasSponsorLegalInfractionYesAnswer(array $detail): bool
    {
        foreach (['protection', 'violence', 'manslaughter', 'convictions', 'drug_related', 'specified_offense'] as $field) {
            if (($detail[$field] ?? null) === 'yes') {
                return true;
            }
        }

        return false;
    }

    private function validateRequiredAnswers(array $detail, array $fields, string $message): array
    {
        foreach ($fields as $field) {
            if (!isset($detail[$field]) || !in_array($detail[$field], ['yes', 'no'], true)) {
                return [$message];
            }
        }

        return [];
    }

    private function validateStructuredLegalInfractions(array $detail, string $label): array
    {
        $completedRows = 0;
        $issues = [];

        for ($i = 1; $i <= 5; $i++) {
            $charge = trim((string) ($detail["legal_infraction_charge_name{$i}"] ?? ''));
            $date = trim((string) ($detail["legal_infraction_charge_date{$i}"] ?? ''));
            $outcome = trim((string) ($detail["legal_infraction_outcome{$i}"] ?? ''));

            if ($charge === '' && $date === '' && $outcome === '') {
                continue;
            }

            if ($charge === '' || $date === '' || $outcome === '') {
                $issues[] = "{$label} legal infractions must include charge name, mm/dd/yyyy date, and final outcome for every row used.";
                continue;
            }

            if (!$this->parseDate($date)) {
                $issues[] = "{$label} legal infraction dates must be entered in mm/dd/yyyy format.";
                continue;
            }

            $completedRows++;
        }

        if ($completedRows === 0) {
            $issues[] = "{$label} legal infractions must be entered one charge at a time with exact charge name, mm/dd/yyyy date, and final outcome.";
        }

        return array_values(array_unique($issues));
    }

    private function parseDate(?string $value): ?Carbon
    {
        $value = trim((string) $value);
        if ($value === '') {
            return null;
        }

        try {
            return Carbon::createFromFormat('m/d/Y', $value)->startOfDay();
        } catch (\Throwable) {
            return null;
        }
    }
}
