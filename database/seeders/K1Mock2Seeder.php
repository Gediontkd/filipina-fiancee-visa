<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\State;
use App\Models\FianceVisaSubmittedStep;
use App\Models\FianceSponsor;
use App\Models\FianceAlien;
use App\Models\UserFianceVisaType;
use App\Models\UserSubmittedApplication;

/**
 * Mock 2 — Clean baseline: single petitioner, no prior filings, no convictions.
 *          Beneficiary previously married (divorced).
 *
 * Petitioner : Robert Dean Carter  (U.S. citizen, single, Houston TX)
 * Beneficiary: Grace Maylene Torres (Filipino national, Davao City; divorced)
 *
 * Run: php artisan db:seed --class=K1Mock2Seeder
 * (User robert.carter@example.com must exist and have chosen K-1 application first)
 */
class K1Mock2Seeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'robert.carter@example.com')->first();

        if (!$user) {
            $this->command->error('User robert.carter@example.com not found.');
            return;
        }

        $submittedApp = UserSubmittedApplication::where('user_id', $user->id)
            ->where('application_id', 1)
            ->whereIn('status', ['pending', 'progress'])
            ->first();

        if (!$submittedApp) {
            $this->command->error('No K-1 application found for this user. Make sure the user has selected K-1 Fiancé(e) Visa first.');
            return;
        }

        $submittedApp->update(['status' => 'pending']);
        $submittedAppId = $submittedApp->id;

        $stateMap = State::where('country_id', 231)->pluck('id', 'name')->toArray();
        $sid = fn($name) => $stateMap[$name] ?? $name;

        FianceVisaSubmittedStep::where('user_id', $user->id)->delete();
        FianceSponsor::where('user_id', $user->id)->delete();
        FianceAlien::where('user_id', $user->id)->delete();
        UserFianceVisaType::where('user_id', $user->id)->delete();

        // ─── SPONSOR STEPS ────────────────────────────────────────────────────────
        //
        // Petitioner: Robert Dean Carter — U.S. citizen, single, Houston TX
        // DOB: 07/19/1978  |  SSN: 333-44-5555  |  Born: Houston, Texas

        $sponsorSteps = [

            'name' => [
                'classification_sought'  => 'K-1',
                'first_name'             => 'Robert',
                'middle_name'            => 'Dean',
                'last_name'              => 'Carter',
                'gender'                 => 'male',
                'prior_name1'            => 'yes',
                'prior_fname1'           => 'Rob',
                'prior_mname1'           => 'D',
                'prior_lname1'           => 'Carter',
                'prior_maiden_name1'     => 'no',
                'prior_name2'            => 'no',
                'name'                   => 'name',
                'next'                   => 'contact',
                'type'                   => 'sponsor',
            ],

            'contact' => [
                'email'                    => 'robert.carter@example.com',
                'daytime_telephone_no'     => '713-555-0211',
                'mobile_telephone_number'  => '832-555-0322',
                'social_sec_no'            => '333-44-5555',
                'uscis_no'                 => '',
                'sponsor_a'                => '',
                'diffrent_mailing_address' => 'no',
                'name'                     => 'contact',
                'next'                     => 'place-of-birth',
                'type'                     => 'sponsor',
            ],

            'place-of-birth' => [
                's_dob'                            => '07/19/1978',
                's_city_of_birth'                  => 'Houston',
                's_state_of_birth'                 => 'Texas',
                's_country_of_birth'               => 'United States',
                // Father: Winston George Carter — alive, Houston TX
                'father_last_name'                 => 'Carter',
                'father_first_name'                => 'Winston',
                'father_middle_name'               => 'George',
                'fatherMiddleName'                 => false,
                'father_dob'                       => '04/05/1950',
                'fatherDob'                        => false,
                'father_city_or_province_of_birth' => 'Houston',
                'father_birth_country'             => 'United States',
                'he_deceased'                      => 'no',
                'father_city_of_res'               => 'Houston',
                'father_country'                   => 'United States',
                // Mother: Evelyn Ruth Brown — alive, Dallas TX
                'mother_maiden_last_name'          => 'Brown',
                'mother_first_name'                => 'Evelyn',
                'mother_middle_name'               => 'Ruth',
                'motherMiddleName'                 => false,
                'mother_dob'                       => '12/14/1953',
                'motherDob'                        => false,
                'mother_city_of_birth'             => 'Dallas',
                'mother_birth_country'             => 'United States',
                'motherBirthCountry'               => false,
                'she_deceased'                     => 'no',
                'mother_city_of_res'               => 'Houston',
                'mother_country'                   => 'United States',
                'name'                             => 'place-of-birth',
                'next'                             => 'status',
                'type'                             => 'sponsor',
            ],

            'status' => [
                'current_status'     => 'USCitizen',
                'height_feet'        => '5',
                'height_inches'      => '11',
                'weight_pound'       => '190',
                'ethnicity'          => 'Not Hispanic or Latino',
                'race'               => 'White',
                'hair_color'         => 'Black',
                'eye_color'          => 'Brown',
                'obtain_citizenship' => 'Born in U.S.A',
                'name'               => 'status',
                'next'               => 'marital-status',
                'type'               => 'sponsor',
            ],

            // Single — never married
            'marital-status' => [
                'current_marital_status' => 'single',
                'previous_marriages'     => 'no',
                'name'                   => 'marital-status',
                'next'                   => 'other-filings',
                'type'                   => 'sponsor',
            ],

            // No prior I-129F or I-130 filings
            'other-filings' => [
                'i_130'                => 'no',
                'i_129F'               => 'no',
                'situation'            => 'situation4',
                'waiver_document_path' => null,
                'previous_filing'      => 'no',
                'approved_i_129F'      => 'no',
                'name'                 => 'other-filings',
                'next'                 => 'military-and-convictions',
                'type'                 => 'sponsor',
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

            // Single address — lived at 5500 Memorial Drive since 01/01/2016
            'address' => [
                'in_care_name'                  => '',
                'inCareName'                    => false,
                'number_and_street'             => '5500 Memorial Drive',
                'apartment_suite_or_floor'      => 'Apartment',
                'apartment_suite_or_floor_no'   => '8D',
                'town_or_city'                  => 'Houston',
                'country'                       => 'United States (+1)',
                'state'                         => $sid('Texas'),
                'province'                      => 'N/A',
                'provinceOption'                => true,
                'postal_code'                   => '77007',
                'postalCode'                    => false,
                'date_from'                     => '01/01/2016',
                'date_to'                       => 'PRESENT',
                'has_prior_address'             => 'no',
                // Residence since 18th birthday
                'foreign_state1'                => 'Texas',
                'foreign_country1'              => 'United States',
                'name'                          => 'address',
                'next'                          => 'relationship',
                'type'                          => 'sponsor',
            ],

            // Met in person; not via IMB
            'relationship' => [
                'responsibility'  => 'yes',
                'res_text_2'      => 'SEE SUPPLEMENT: I-129F Explanation of meeting',
                'marriage_broker' => 'no',
                'name'            => 'relationship',
                'next'            => 'employment',
                'type'            => 'sponsor',
            ],

            // Two employers covering > 5 years with no gaps:
            //   1. Gulf Coast Energy Solutions LLC   03/01/2019 – PRESENT
            //   2. Houston Exploration Company        02/01/2016 – 02/28/2019
            'employment' => [
                'full_name_of_employer1'   => 'Gulf Coast Energy Solutions LLC',
                'street_number_and_name1'  => '1300 Post Oak Boulevard',
                'aptsteflr1'               => '',
                'employerAptSteFlr1'       => true,
                'apt_ste_flr1'             => '',
                'city1'                    => 'Houston',
                'state1'                   => $sid('Texas'),
                'employerState1'           => false,
                'zip_postal_code1'         => '77056',
                'zIPPostalCode1'           => false,
                'province1'                => 'N/A',
                'employerProvince1'        => true,
                'country1'                 => 'United States (+1)',
                'occupation_specify1'      => 'Petroleum Engineer',
                'employement_start_date1'  => '03/01/2019',
                'employement_end_date1'    => 'Present',
                'present_date'             => 'Present',
                'employer1'                => '1',
                'remaingYears1'            => '5',

                'full_name_of_employer2'   => 'Houston Exploration Company',
                'street_number_and_name2'  => '500 Dallas Street',
                'aptsteflr2'               => '',
                'employerAptSteFlr2'       => true,
                'apt_ste_flr2'             => '',
                'city2'                    => 'Houston',
                'state2'                   => $sid('Texas'),
                'employerState2'           => false,
                'zip_postal_code2'         => '77002',
                'zIPPostalCode2'           => false,
                'province2'                => 'N/A',
                'employerProvince2'        => true,
                'country2'                 => 'United States (+1)',
                'occupation_specify2'      => 'Drilling Engineer',
                'employement_start_date2'  => '02/01/2016',
                'employement_end_date2'    => '02/28/2019',
                'employer2'                => '2',
                'remaingYears2'            => '5',

                'full_name_of_employer3'   => '',
                'employement_start_date3'  => '',
                'employement_end_date3'    => '',
                'full_name_of_employer4'   => '',
                'employement_start_date4'  => '',
                'employement_end_date4'    => '',
                'full_name_of_employer5'   => '',
                'employement_start_date5'  => '',
                'employement_end_date5'    => '',

                'has_preparer' => 'no',
                'name'         => 'employment',
                'next'         => 'employment',
                'type'         => 'sponsor',
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
        // Beneficiary: Grace Maylene Torres — Filipino, Davao City
        // DOB: 09/08/1990  |  Divorced, no children  |  Embassy: Manila

        $alienSteps = [

            'name' => [
                'beneficiary_classification_sought' => 'K-1',
                'first_name'                        => 'Grace',
                'middle_name'                       => 'Maylene',
                'last_name'                         => 'Torres',
                'gender'                            => 'female',
                'related_to_you'                    => 'no',
                // Former married surname
                'prior_name1'                       => 'yes',
                'prior_fname1'                      => 'Grace',
                'prior_mname1'                      => 'Maylene',
                'prior_lname1'                      => 'Reyes',
                'prior_name2'                       => 'no',
                'name'                              => 'name',
                'next'                              => 'citizenship',
                'type'                              => 'alien',
            ],

            'citizenship' => [
                'country_of_citizenship' => 'Philippines',
                'country_of_birth'       => 'Philippines',
                'city_of_birth'          => 'Davao City',
                'date_of_birth'          => '09/08/1990',
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
                'email'                         => 'grace.torres@example.com',
                'country_code'                  => 'Philippines (+63)',
                'telephone_number'              => '+63-82-555-0188',
                'reg_no'                        => 'N/A',
                'regNo'                         => true,
                'social_sec_no'                 => 'N/A',
                'socialSecNo'                   => true,
                'diffrent_mailing_address'      => 'no',
                'us_address_same_as_petitioner' => 'yes',
                'name'                          => 'contact',
                'next'                          => 'marital-status',
                'type'                          => 'alien',
            ],

            // Previously married (divorced ≈ 2020), no children
            'marital-status' => [
                'current_marital_status' => 'single',
                'previous_marriages'     => 'yes',
                'prior_spouse_fname1'    => '',
                'prior_spouse_mname1'    => '',
                'prior_spouse_lname1'    => '',
                'prior_marriage_date1'   => '',
                'prior_divorce_date1'    => '04/19/2020',
                'prior_divorce_place1'   => '',
                'name'                   => 'marital-status',
                'next'                   => 'parents',
                'type'                   => 'alien',
            ],

            'parents' => [
                // Father: Renato Villanueva Torres — alive, Philippines
                'father_first_name'           => 'Renato',
                'father_middle_name'          => 'Villanueva',
                'father_last_name'            => 'Torres',
                'father_date_of_birth'        => '03/30/1962',
                'father_city_of_birth'        => 'Davao City',
                'father_country_of_birth'     => 'Philippines',
                'father_alive'                => 'yes',
                'father_country_of_residence' => 'Philippines',
                // Mother: Rosario Dela Torre Gonzales — alive, Philippines
                'mother_first_name'           => 'Rosario',
                'mother_middle_name'          => 'Dela Torre',
                'mother_last_name'            => 'Gonzales',
                'mother_date_of_birth'        => '07/07/1965',
                'mother_city_of_birth'        => 'Davao City',
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

            // Two Philippine addresses (moved after divorce, Apr 2020)
            'address' => [
                'in_care_name'                  => '',
                'inCareName'                    => false,
                'number_and_street'             => '78 San Pedro Street',
                'apartment_suite_or_floor'      => 'Apartment',
                'apartmentSuiteOrFloor'         => false,
                'apartment_suite_or_floor_no'   => '5F',
                'apartmentSuiteOrFloorNo'       => false,
                'town_or_city'                  => 'Davao City',
                'country'                       => 'Philippines',
                'state'                         => 'N/A',
                'dontHasState'                  => true,
                'province'                      => 'Davao del Sur',
                'provinceApply'                 => false,
                'postal_code'                   => '8000',
                'postalCode'                    => false,
                'date_from'                     => '04/20/2020',
                'date_to'                       => 'PRESENT',
                'has_prior_address'             => 'yes',
                'p_number_and_street'           => '22 Obispo Street',
                'p_apartment_suite_or_floor'    => 'Dose Not Apply',
                'p_apartment_suite_or_floor_no' => '',
                'p_town_or_city'                => 'General Santos City',
                'p_province'                    => 'South Cotabato',
                'p_postal_code'                 => '9500',
                'p_country'                     => 'Philippines',
                'p_date_from'                   => '06/10/2015',
                'p_date_to'                     => '04/19/2020',
                'native_alphabet_name'          => 'N/A',
                'native_alphabet_address'       => 'N/A',
                'name'                          => 'address',
                'next'                          => 'employment',
                'type'                          => 'alien',
            ],

            // Two Philippine employers:
            //   1. Davao Medical School Foundation Hospital  07/01/2020 – PRESENT
            //   2. SouthCot Medical Center                   11/15/2012 – 06/30/2020
            'employment' => [
                'full_name_of_employer1'   => 'Davao Medical School Foundation Hospital',
                'street_number_and_name1'  => 'Medical Drive, Bajada',
                'aptsteflr1'               => '',
                'employerAptSteFlr1'       => true,
                'apt_ste_flr1'             => '',
                'city1'                    => 'Davao City',
                'state1'                   => 'N/A',
                'employerState1'           => true,
                'zip_postal_code1'         => '8000',
                'zIPPostalCode1'           => false,
                'province1'               => 'Davao del Sur',
                'employerProvince1'        => false,
                'country1'                 => 'Philippines',
                'occupation_specify1'      => 'Medical Technologist',
                'employement_start_date1'  => '07/01/2020',
                'employement_end_date1'    => 'Present',
                'present_date'             => 'Present',
                'employer1'                => '1',
                'remaingYears1'            => '5',

                'full_name_of_employer2'   => 'SouthCot Medical Center',
                'street_number_and_name2'  => 'National Highway, Lagao',
                'aptsteflr2'               => '',
                'employerAptSteFlr2'       => true,
                'apt_ste_flr2'             => '',
                'city2'                    => 'General Santos City',
                'state2'                   => 'N/A',
                'employerState2'           => true,
                'zip_postal_code2'         => '9500',
                'zIPPostalCode2'           => false,
                'province2'               => 'South Cotabato',
                'employerProvince2'        => false,
                'country2'                 => 'Philippines',
                'occupation_specify2'      => 'Medical Technologist',
                'employement_start_date2'  => '11/15/2012',
                'employement_end_date2'    => '06/30/2020',
                'employer2'                => '2',
                'remaingYears2'            => '5',

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
                'school_name1'    => 'Davao Medical School Foundation',
                'school_city1'    => 'Davao City',
                'school_country1' => 'Philippines',
                'school_from1'    => '06/2008',
                'school_to1'      => '04/2012',
                'school_degree1'  => 'Bachelor of Science in Medical Technology',
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
                'languages_spoken' => 'Filipino, English, Cebuano',
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
                'trafficking_offense'   => 'no',
                'trafficking_activitie' => 'no',
                'significant_role'      => 'no',
                'violated_controlled'   => 'no',
                'illegal_activity'      => 'no',
                'terrorist_activities'  => 'no',
                'terrorist_orga'        => 'no',
                'member_terr_orga'      => 'no',
                'participated_genocide' => 'no',
                'participated_torture'  => 'no',
                'withholding_custody'   => 'no',
                'name'                  => 'question2',
                'next'                  => 'question3',
                'type'                  => 'alien',
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
                'transplantation'       => 'no',
                'civil_penalty'         => 'no',
                'ordered_removed'       => 'no',
                'ordered_removed_2'     => 'no',
                'unlawfully_present'    => 'no',
                'convicted_aggravated'  => 'no',
                'voluntarily_departed'  => 'no',
                'aggregate_at_any_time' => 'no',
                'withheld_custody'      => 'no',
                'removed_deported'      => 'no',
                'deportation_hearing'   => 'no',
                'inadmissibilty'        => 'no',
                'admitted_u_s'          => 'no',
                'immigration_official'  => 'no',
                'name'                  => 'question4',
                'next'                  => 'question5',
                'type'                  => 'alien',
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

        $submittedApp->update(['status' => 'progress']);

        $this->command->info('K-1 Mock 2 seeded successfully.');
        $this->command->info('  Petitioner : Robert Dean Carter (robert.carter@example.com)');
        $this->command->info('  Beneficiary: Grace Maylene Torres (Davao City, Philippines)');
        $this->command->info('  Edge cases : single petitioner, no prior filings, beneficiary previously married');
        $this->command->info('  Sponsor steps : ' . count($sponsorSteps) . '/10');
        $this->command->info('  Alien steps   : ' . count($alienSteps) . '/21');
    }
}
