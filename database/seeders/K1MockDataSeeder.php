<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\FianceVisaSubmittedStep;
use App\Models\FianceSponsor;
use App\Models\FianceAlien;
use App\Models\UserFianceVisaType;
use App\Models\UserSubmittedApplication;

/**
 * Mock 1 — Edge cases: Prior K-1 filing, divorced petitioner, 3 physical addresses.
 *
 * Petitioner : James Patrick Sullivan  (U.S. citizen, divorced, Chicago IL)
 *              → previously filed an I-129F that was approved (prior K-1)
 * Beneficiary: Anna Luz Mendoza        (Filipino national, Quezon City)
 */
class K1MockDataSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'james.sullivan@example.com')->first();

        if (!$user) {
            $this->command->error('User james.sullivan@example.com not found.');
            return;
        }

        $submittedApp = UserSubmittedApplication::where('user_id', $user->id)
            ->where('application_id', 1)
            ->where('status', 'pending')
            ->first();

        if (!$submittedApp) {
            $this->command->error('No pending K-1 application found for this user. Make sure the user has selected K-1 Fiancé(e) Visa first.');
            return;
        }

        $submittedAppId = $submittedApp->id;

        // Clean up any existing steps for this user
        FianceVisaSubmittedStep::where('user_id', $user->id)->delete();
        FianceSponsor::where('user_id', $user->id)->delete();
        FianceAlien::where('user_id', $user->id)->delete();
        UserFianceVisaType::where('user_id', $user->id)->delete();

        // ─── SPONSOR STEPS ────────────────────────────────────────────────────────
        //
        // Petitioner: James Patrick Sullivan — U.S. citizen, divorced, Chicago IL
        // DOB: 11/04/1980  |  SSN: 222-33-4444  |  Born: Springfield, Illinois

        $sponsorSteps = [

            'name' => [
                'classification_sought'  => 'K-1',
                // Name order in the web form: first / middle / last
                'first_name'             => 'James',
                'middle_name'            => 'Patrick',
                'last_name'              => 'Sullivan',
                'gender'                 => 'male',
                // Prior name used: Jim P Sullivan
                'prior_name1'            => 'yes',
                'prior_fname1'           => 'Jim',
                'prior_mname1'           => 'P',
                'prior_lname1'           => 'Sullivan',
                'prior_maiden_name1'     => 'no',
                'prior_name2'            => 'no',
                'f_m_l_name'             => null,
                'name'                   => 'name',
                'next'                   => 'contact',
                'type'                   => 'sponsor',
            ],

            'contact' => [
                'email'                    => 'james.sullivan@example.com',
                'daytime_telephone_no'     => '312-555-0189',
                'mobile_telephone_number'  => '312-555-0290',
                'social_sec_no'            => '222-33-4444',
                // U.S. citizen → A-Number must be blank
                'uscis_no'                 => '',
                'sponsor_a'                => '',
                'diffrent_mailing_address' => 'no',
                'name'                     => 'contact',
                'next'                     => 'place-of-birth',
                'type'                     => 'sponsor',
            ],

            'place-of-birth' => [
                'country_of_birth'  => 'United States',
                'city_of_birth'     => 'Springfield',
                'state_of_birth'    => 'Illinois',
                'name'              => 'place-of-birth',
                'next'              => 'status',
                'type'              => 'sponsor',
            ],

            'status' => [
                'current_status' => 'USCitizen',
                'name'           => 'status',
                'next'           => 'marital-status',
                'type'           => 'sponsor',
            ],

            // Edge case: divorced petitioner with one prior marriage
            'marital-status' => [
                'current_marital_status' => 'divorced',
                'previous_marriages'     => 'yes',
                // Prior spouse: Jennifer Walsh — divorced 2021
                'prior_spouse_fname1'    => 'Jennifer',
                'prior_spouse_mname1'    => '',
                'prior_spouse_lname1'    => 'Walsh',
                'prior_marriage_date1'   => '08/15/2010',
                'prior_divorce_date1'    => '06/30/2021',
                'prior_divorce_place1'   => 'Indianapolis, Indiana',
                'name'                   => 'marital-status',
                'next'                   => 'other-filings',
                'type'                   => 'sponsor',
            ],

            // Edge case: prior approved K-1 filing → waiver requested with this petition
            // situation4 does NOT require an uploaded waiver document
            'other-filings' => [
                'i_129F'                => 'yes',
                'situation'             => 'situation4',
                'waiver_document_path'  => null,
                'name'                  => 'other-filings',
                'next'                  => 'military-and-convictions',
                'type'                  => 'sponsor',
            ],

            'military-and-convictions' => [
                'member_of_us'         => 'no',
                'protection'           => 'no',
                'violence'             => 'no',
                'manslaughter'         => 'no',
                'convictions'          => 'no',
                'drug_related'         => 'no',
                'specified_offense'    => 'no',
                'provide_information'  => '',
                'provide_information1' => '',
                'name'                 => 'military-and-convictions',
                'next'                 => 'address',
                'type'                 => 'sponsor',
            ],

            // Three physical addresses over the last 5 years:
            //   1. 740 N Wabash Ave, Apt 12C, Chicago IL 60611  (03/01/2023 – present)
            //   2. 301 E Market St, Indianapolis IN 46204         (07/01/2021 – 02/28/2023)
            //   3. Prior marital home — captured in additional info
            'address' => [
                'number_and_street'        => '740 N Wabash Avenue',
                'apartment_suite_or_floor' => 'Apt 12C',
                'town_or_city'             => 'Chicago',
                'state'                    => 'Illinois',
                'country'                  => 'United States',
                'postal_code'              => '60611',
                // Address 1 dates
                'address_from1'            => '03/01/2023',
                'address_to1'              => 'PRESENT',
                // Address 2 (Indianapolis — post-divorce)
                'number_and_street2'       => '301 E Market Street',
                'apartment_suite_or_floor2'=> '',
                'town_or_city2'            => 'Indianapolis',
                'state2'                   => 'Indiana',
                'country2'                 => 'United States',
                'postal_code2'             => '46204',
                'address_from2'            => '07/01/2021',
                'address_to2'              => '02/28/2023',
                // Address 3 (prior marital home)
                'number_and_street3'       => '817 Meridian Street',
                'apartment_suite_or_floor3'=> '',
                'town_or_city3'            => 'Indianapolis',
                'state3'                   => 'Indiana',
                'country3'                 => 'United States',
                'postal_code3'             => '46206',
                'address_from3'            => '08/15/2010',
                'address_to3'              => '06/30/2021',
                'name'                     => 'address',
                'next'                     => 'relationship',
                'type'                     => 'sponsor',
            ],

            'relationship' => [
                'met_in_person'      => 'yes',
                'met_date'           => '04/01/2022',
                'met_description'    =>
                    'We met in person in Quezon City, Philippines in April 2022 while ' .
                    'petitioner was attending a legal conference. We have met in person ' .
                    'on three subsequent occasions in Manila (July 2022, January 2023, ' .
                    'and September 2023).',
                'relationship_start' => '04/01/2022',
                'intend_to_marry'    => 'yes',
                'marriage_location'  => 'Philippines',
                'name'               => 'relationship',
                'next'               => 'employment',
                'type'               => 'sponsor',
            ],

            // Two employers covering > 5 years with no gaps:
            //   1. Sullivan & Associates Law Group   09/01/2022 – PRESENT
            //   2. Midwest Legal Partners LLC        05/15/2018 – 08/31/2022
            //      Gap check: 08/31/2022 + 1 day = 09/01/2022 = start of employer 1 ✓
            //      Coverage : 05/15/2018 < 2021-03-17 (5 yrs ago) ✓
            'employment' => [
                'full_name_of_employer1'   => 'Sullivan & Associates Law Group',
                'employement_start_date1'  => '09/01/2022',
                'employement_end_date1'    => '',
                'present_date'             => '1',

                'full_name_of_employer2'   => 'Midwest Legal Partners LLC',
                'employement_start_date2'  => '05/15/2018',
                'employement_end_date2'    => '08/31/2022',

                'full_name_of_employer3'   => '',
                'employement_start_date3'  => '',
                'employement_end_date3'    => '',

                'full_name_of_employer4'   => '',
                'employement_start_date4'  => '',
                'employement_end_date4'    => '',

                'full_name_of_employer5'   => '',
                'employement_start_date5'  => '',
                'employement_end_date5'    => '',

                'name' => 'employment',
                'next' => 'employment',
                'type' => 'sponsor',
            ],
        ];

        $sponsorStepIds = [];
        foreach ($sponsorSteps as $stepName => $detail) {
            $record = FianceVisaSubmittedStep::create([
                'user_id'          => $user->id,
                'submitted_app_id' => $submittedAppId,
                'step'             => $stepName,
                'detail'           => serialize($detail),
                'type'             => 'sponsor',
            ]);
            $sponsorStepIds[$stepName] = $record->id;
        }

        foreach ($sponsorStepIds as $stepName => $stepId) {
            FianceSponsor::updateOrInsert(
                ['user_id' => $user->id, 'name' => $stepName],
                ['step_id' => $stepId]
            );
        }

        UserFianceVisaType::create([
            'user_id' => $user->id,
            'type'    => 'sponsor',
            'status'  => 'completed',
        ]);

        // ─── ALIEN / BENEFICIARY STEPS ────────────────────────────────────────────
        //
        // Beneficiary: Anna Luz Mendoza — Filipino, Quezon City
        // DOB: 06/14/1997  |  Single, never married  |  Embassy: Manila

        $alienSteps = [

            'name' => [
                'beneficiary_classification_sought' => 'K-1',
                'first_name'                        => 'Anna',
                'middle_name'                       => 'Luz',
                'last_name'                         => 'Mendoza',
                'gender'                            => 'female',
                'related_to_you'                    => 'no',
                // Prior name used: Ana Mendoza
                'prior_name1'                       => 'yes',
                'prior_fname1'                      => 'Ana',
                'prior_mname1'                      => '',
                'prior_lname1'                      => 'Mendoza',
                'prior_name2'                       => 'no',
                'fMLName'                           => null,
                'name'                              => 'name',
                'next'                              => 'citizenship',
                'type'                              => 'alien',
            ],

            'citizenship' => [
                'country_of_citizenship' => 'Philippines',
                'country_of_birth'       => 'Philippines',
                'city_of_birth'          => 'Quezon City',
                'date_of_birth'          => '06/14/1997',
                'name'                   => 'citizenship',
                'next'                   => 'embassy',
                'type'                   => 'alien',
            ],

            'embassy' => [
                'embassy_country' => 'Philippines',
                'embassy_city'    => 'Manila',
                'name'            => 'embassy',
                'next'            => 'contact',
                'type'            => 'alien',
            ],

            'contact' => [
                'email'                   => 'anna.mendoza@example.com',
                'daytime_telephone_no'    => '+63-2-8888-0147',
                'mobile_telephone_number' => '+63-917-555-0147',
                // US address (sponsor's address where she will live)
                'us_daytime_phone'        => '312-555-0145',
                'name'                    => 'contact',
                'next'                    => 'marital-status',
                'type'                    => 'alien',
            ],

            'marital-status' => [
                'current_marital_status' => 'single',
                'previous_marriages'     => 'no',
                'name'                   => 'marital-status',
                'next'                   => 'parents',
                'type'                   => 'alien',
            ],

            'parents' => [
                // Father: Ricardo Santos Mendoza
                'father_first_name'           => 'Ricardo',
                'father_middle_name'          => 'Santos',
                'father_last_name'            => 'Mendoza',
                'father_date_of_birth'        => '02/11/1965',
                'father_city_of_birth'        => 'Baguio City',
                'father_country_of_birth'     => 'Philippines',
                'father_alive'                => 'yes',
                'father_country_of_residence' => 'Philippines',
                // Mother: Marites Oliveros Cruz
                'mother_first_name'           => 'Marites',
                'mother_middle_name'          => 'Oliveros',
                'mother_last_name'            => 'Cruz',
                'mother_date_of_birth'        => '09/22/1968',
                'mother_city_of_birth'        => 'Quezon City',
                'mother_country_of_birth'     => 'Philippines',
                'mother_alive'                => 'yes',
                'mother_country_of_residence' => 'Philippines',
                'name'                        => 'parents',
                'next'                        => 'visited-us',
                'type'                        => 'alien',
            ],

            'visited-us' => [
                'visited_us' => 'no',
                'name'       => 'visited-us',
                'next'       => 'address',
                'type'       => 'alien',
            ],

            // Philippine case → native_alphabet_name & native_alphabet_address must be 'N/A'
            'address' => [
                'number_and_street'        => '14 Katipunan Avenue',
                'apartment_suite_or_floor' => 'Apt 2A',
                'town_or_city'             => 'Quezon City',
                'state'                    => 'Metro Manila',
                'country'                  => 'Philippines',
                'postal_code'              => '1108',
                'address_from1'            => '01/10/2021',
                'address_to1'              => 'PRESENT',
                // Previous address (Baguio City)
                'number_and_street2'       => '56 Session Road',
                'apartment_suite_or_floor2'=> '',
                'town_or_city2'            => 'Baguio City',
                'state2'                   => 'Benguet',
                'country2'                 => 'Philippines',
                'postal_code2'             => '2600',
                'address_from2'            => '05/01/2017',
                'address_to2'              => '01/09/2021',
                // Philippine case: native alphabet fields → N/A
                'native_alphabet_name'     => 'N/A',
                'native_alphabet_address'  => 'N/A',
                'name'                     => 'address',
                'next'                     => 'employment',
                'type'                     => 'alien',
            ],

            // Two employers covering > 5 years with no gaps:
            //   1. BDO Unibank Inc                        03/15/2021 – PRESENT
            //   2. Mountain Province Credit Cooperative   08/01/2018 – 03/14/2021
            //      Gap check: 03/14/2021 + 1 day = 03/15/2021 = start of employer 1 ✓
            //      Coverage : 08/01/2018 < 2021-03-17 (5 yrs ago) ✓
            //      NOTE: Python mock ends employer 2 on 02/28/2021 which creates a
            //      14-day gap; end date adjusted to 03/14/2021 to satisfy validation.
            'employment' => [
                'full_name_of_employer1'   => 'BDO Unibank Inc',
                'employement_start_date1'  => '03/15/2021',
                'employement_end_date1'    => '',
                'present_date'             => '1',

                'full_name_of_employer2'   => 'Mountain Province Credit Cooperative',
                'employement_start_date2'  => '08/01/2018',
                'employement_end_date2'    => '03/14/2021',

                'full_name_of_employer3'   => '',
                'employement_start_date3'  => '',
                'employement_end_date3'    => '',

                'full_name_of_employer4'   => '',
                'employement_start_date4'  => '',
                'employement_end_date4'    => '',

                'full_name_of_employer5'   => '',
                'employement_start_date5'  => '',
                'employement_end_date5'    => '',

                'name' => 'employment',
                'next' => 'schools',
                'type' => 'alien',
            ],

            'schools' => [
                'school_name1'    => 'University of the Philippines Diliman',
                'school_city1'    => 'Quezon City',
                'school_country1' => 'Philippines',
                'school_from1'    => '06/2015',
                'school_to1'      => '04/2018',
                'school_degree1'  => 'Bachelor of Science in Business Administration',
                'name'            => 'schools',
                'next'            => 'travel',
                'type'            => 'alien',
            ],

            'travel' => [
                'traveled_outside' => 'no',
                'name'             => 'travel',
                'next'             => 'military',
                'type'             => 'alien',
            ],

            'military' => [
                'military_service' => 'no',
                'name'             => 'military',
                'next'             => 'activity',
                'type'             => 'alien',
            ],

            'activity' => [
                'arrested_convicted'      => 'no',
                'organizations'           => 'no',
                'clan_tribe_affiliations' => 'no',
                'name'                    => 'activity',
                'next'                    => 'immigration',
                'type'                    => 'alien',
            ],

            'immigration' => [
                'previous_immigration_filing' => 'no',
                'previous_visa'               => 'no',
                'name'                        => 'immigration',
                'next'                        => 'languages',
                'type'                        => 'alien',
            ],

            'languages' => [
                'languages_spoken' => 'Filipino, English',
                'english_ability'  => 'yes',
                'name'             => 'languages',
                'next'             => 'relatives',
                'type'             => 'alien',
            ],

            'relatives' => [
                'relatives_in_us' => 'no',
                'name'            => 'relatives',
                'next'            => 'question1',
                'type'            => 'alien',
            ],

            'question1' => [
                'insurgent_orga'        => 'no',
                'human_service'         => 'no',
                'physical_disorder'     => 'no',
                'drug_abuser'           => 'no',
                'medical_examination'   => 'no',
                'arrested_or_convicted' => 'no',
                'violated_or_engaged'   => 'no',
                'prostitution'          => 'no',
                'money_laundering'      => 'no',
                'trafficking_offense'   => 'no',
                'knowingly_aided'       => 'no',
                'name'                  => 'question1',
                'next'                  => 'question2',
                'type'                  => 'alien',
            ],

            'question2' => [
                'trafficking_offense'    => 'no',
                'trafficking_activitie'  => 'no',
                'significant_role'       => 'no',
                'violated_controlled'    => 'no',
                'illegal_activity'       => 'no',
                'terrorist_activities'   => 'no',
                'terrorist_orga'         => 'no',
                'member_terr_orga'       => 'no',
                'participated_genocide'  => 'no',
                'participated_torture'   => 'no',
                'withholding_custody'    => 'no',
                'name'                   => 'question2',
                'next'                   => 'question3',
                'type'                   => 'alien',
            ],

            'question3' => [
                'acts_of_violence'        => 'no',
                'child_soldier'           => 'no',
                'religious_freedom'       => 'no',
                'member_of_affiliated'    => 'no',
                'colombia_group'          => 'no',
                'governmental_abuse'      => 'no',
                'expropriated_property'   => 'no',
                'chemical_weapon'         => 'no',
                'trafficked_confidential' => 'no',
                'establishment'           => 'no',
                'name'                    => 'question3',
                'next'                    => 'question4',
                'type'                    => 'alien',
            ],

            'question4' => [
                'transplantation'      => 'no',
                'civil_penalty'        => 'no',
                'ordered_removed'      => 'no',
                'ordered_removed_2'    => 'no',
                'unlawfully_present'   => 'no',
                'convicted_aggravated' => 'no',
                'voluntarily_departed' => 'no',
                'aggregate_at_any_time'=> 'no',
                'withheld_custody'     => 'no',
                'removed_deported'     => 'no',
                'deportation_hearing'  => 'no',
                'inadmissibilty'       => 'no',
                'admitted_u_s'         => 'no',
                'immigration_official' => 'no',
                'name'                 => 'question4',
                'next'                 => 'question5',
                'type'                 => 'alien',
            ],

            'question5' => [
                'avoiding_taxation'       => 'no',
                'former_exchange_visitor' => 'no',
                'secretary_of_labor'      => 'no',
                'foreign_medical_school'  => 'no',
                'credentialing_org'       => 'no',
                'permanently_ineligible'  => 'no',
                'departed_us'             => 'no',
                'practice_polygamy'       => 'no',
                'frivolous_application'   => 'no',
                'misrepresentation'       => 'no',
                'name'                    => 'question5',
                'next'                    => 'question5',
                'type'                    => 'alien',
            ],
        ];

        $alienStepIds = [];
        foreach ($alienSteps as $stepName => $detail) {
            $record = FianceVisaSubmittedStep::create([
                'user_id'          => $user->id,
                'submitted_app_id' => $submittedAppId,
                'step'             => $stepName,
                'detail'           => serialize($detail),
                'type'             => 'alien',
            ]);
            $alienStepIds[$stepName] = $record->id;
        }

        foreach ($alienStepIds as $stepName => $stepId) {
            FianceAlien::updateOrInsert(
                ['user_id' => $user->id, 'name' => $stepName],
                ['step_id' => $stepId]
            );
        }

        UserFianceVisaType::create([
            'user_id' => $user->id,
            'type'    => 'alien',
            'status'  => 'completed',
        ]);

        // Mark application as in-progress (all 10 sponsor + 21 alien steps complete)
        $submittedApp->update(['status' => 'progress']);

        $this->command->info("K-1 mock data seeded successfully.");
        $this->command->info("  Petitioner : James Patrick Sullivan (james.sullivan@example.com)");
        $this->command->info("  Beneficiary: Anna Luz Mendoza (Quezon City, Philippines)");
        $this->command->info("  Sponsor steps : " . count($sponsorSteps) . "/10");
        $this->command->info("  Alien steps   : " . count($alienSteps) . "/21");
        $this->command->info("  Edge cases    : prior K-1 filing, divorced petitioner, 3 addresses");
    }
}
