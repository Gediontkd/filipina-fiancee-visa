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
 * Mock 3 — Edge cases: widowed petitioner, criminal record (DUI→Reckless Driving),
 *          met via IMB, beneficiary previously married with a minor child.
 *
 * Petitioner : Thomas William Brady  (U.S. citizen, widowed, Seattle WA)
 *              → arrested 08/14/2015 DUI, reduced to Reckless Driving; case closed 11/02/2015
 * Beneficiary: Isabel Joy Dela Cruz  (Filipino national, Cebu City; divorced; 1 child)
 *              → former surname: Navarro; child: Sofia Navarro Dela Cruz, born 2016
 *
 * Run: php artisan db:seed --class=K1Mock3Seeder
 * (User thomas.brady@example.com must exist and have chosen K-1 application first)
 */
class K1Mock3Seeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'thomas.brady@example.com')->first();

        if (!$user) {
            $this->command->error('User thomas.brady@example.com not found.');
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
        // Petitioner: Thomas William Brady — U.S. citizen, widowed, Seattle WA
        // DOB: 02/28/1975  |  SSN: 444-55-6666  |  Born: Portland, Oregon

        $sponsorSteps = [

            'name' => [
                'classification_sought'  => 'K-1',
                'first_name'             => 'Thomas',
                'middle_name'            => 'William',
                'last_name'              => 'Brady',
                'gender'                 => 'male',
                'prior_name1'            => 'no',  // no other names used
                'prior_maiden_name1'     => 'no',
                'prior_name2'            => 'no',
                'name'                   => 'name',
                'next'                   => 'contact',
                'type'                   => 'sponsor',
            ],

            'contact' => [
                'email'                    => 'thomas.brady@example.com',
                'daytime_telephone_no'     => '206-555-0133',
                'mobile_telephone_number'  => '425-555-0244',
                'social_sec_no'            => '444-55-6666',
                'uscis_no'                 => '',
                'sponsor_a'                => '',
                'diffrent_mailing_address' => 'no',
                'name'                     => 'contact',
                'next'                     => 'place-of-birth',
                'type'                     => 'sponsor',
            ],

            'place-of-birth' => [
                's_dob'                            => '02/28/1975',
                's_city_of_birth'                  => 'Portland',
                's_state_of_birth'                 => 'Oregon',
                's_country_of_birth'               => 'United States',
                // Father: Gerald Alan Brady — alive, Portland OR
                'father_last_name'                 => 'Brady',
                'father_first_name'                => 'Gerald',
                'father_middle_name'               => 'Alan',
                'fatherMiddleName'                 => false,
                'father_dob'                       => '10/20/1948',
                'fatherDob'                        => false,
                'father_city_or_province_of_birth' => 'Portland',
                'father_birth_country'             => 'United States',
                'he_deceased'                      => 'no',
                'father_city_of_res'               => 'Portland',
                'father_country'                   => 'United States',
                // Mother: Sandra Louise Murphy — alive, Eugene OR
                'mother_maiden_last_name'          => 'Murphy',
                'mother_first_name'                => 'Sandra',
                'mother_middle_name'               => 'Louise',
                'motherMiddleName'                 => false,
                'mother_dob'                       => '06/01/1951',
                'motherDob'                        => false,
                'mother_city_of_birth'             => 'Eugene',
                'mother_birth_country'             => 'United States',
                'motherBirthCountry'               => false,
                'she_deceased'                     => 'no',
                'mother_city_of_res'               => 'Eugene',
                'mother_country'                   => 'United States',
                'name'                             => 'place-of-birth',
                'next'                             => 'status',
                'type'                             => 'sponsor',
            ],

            'status' => [
                'current_status'     => 'USCitizen',
                'height_feet'        => '5',
                'height_inches'      => '10',
                'weight_pound'       => '185',
                'ethnicity'          => 'Not Hispanic or Latino',
                'race'               => 'White',
                'hair_color'         => 'Blond',
                'eye_color'          => 'Hazel',
                'obtain_citizenship' => 'Born in U.S.A',
                'name'               => 'status',
                'next'               => 'marital-status',
                'type'               => 'sponsor',
            ],

            // Edge case: widowed petitioner (wife Karen Brady, died Oct 2018)
            'marital-status' => [
                'current_marital_status' => 'widowed',
                'previous_marriages'     => 'yes',
                'prior_spouse_fname1'    => 'Karen',
                'prior_spouse_mname1'    => '',
                'prior_spouse_lname1'    => 'Brady',
                'prior_marriage_date1'   => '',          // not captured in form
                'prior_divorce_date1'    => '10/2018',   // date of spouse's death
                'prior_divorce_place1'   => '',          // not captured in form
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

            // Edge case: conviction = yes (DUI arrest 08/14/2015; reduced to Reckless Driving)
            'military-and-convictions' => [
                'member_of_us'         => 'no',
                'protection'           => 'no',
                'violence'             => 'no',
                'manslaughter'         => 'no',
                'convictions'          => 'yes',
                'drug_related'         => 'no',
                'specified_offense'    => 'no',
                'provide_information'  => 'SEE SUPPLEMENT: I-129F Explanation of Legal Infractions',
                'provide_information1' => '',
                'name'                 => 'military-and-convictions',
                'next'                 => 'address',
                'type'                 => 'sponsor',
            ],

            // Two physical addresses (moved after wife died, Nov 2018):
            //   1. 3401 Fremont Ave N, Apt 201, Seattle WA 98103  (11/01/2018 – PRESENT)
            //   2. 820 Queen Anne Ave N, Seattle WA 98109          (06/12/2010 – 10/31/2018)
            'address' => [
                'in_care_name'                  => '',
                'inCareName'                    => false,
                'number_and_street'             => '3401 Fremont Avenue North',
                'apartment_suite_or_floor'      => 'Apartment',
                'apartment_suite_or_floor_no'   => '201',
                'town_or_city'                  => 'Seattle',
                'country'                       => 'United States (+1)',
                'state'                         => $sid('Washington'),
                'province'                      => 'N/A',
                'provinceOption'                => true,
                'postal_code'                   => '98103',
                'postalCode'                    => false,
                'date_from'                     => '11/01/2018',
                'date_to'                       => 'PRESENT',
                'has_prior_address'             => 'yes',
                'p_number_and_street'           => '820 Queen Anne Avenue North',
                'p_apartment_suite_or_floor'    => 'Dose Not Apply',
                'p_apartment_suite_or_floor_no' => '',
                'p_town_or_city'                => 'Seattle',
                'p_country'                     => 'United States (+1)',
                'p_state'                       => $sid('Washington'),
                'p_zip_code'                    => '98109',
                'p_date_from'                   => '06/12/2010',
                'p_date_to'                     => '10/31/2018',
                // Residence since 18th birthday
                'foreign_state1'                => 'Washington',
                'foreign_country1'              => 'United States',
                'name'                          => 'address',
                'next'                          => 'relationship',
                'type'                          => 'sponsor',
            ],

            // Edge case: met via IMB (online dating site) — marriage_broker = yes
            // IMB: FilipinoCupid Online Services (mock address)
            'relationship' => [
                'responsibility'           => 'yes',
                'res_text_2'               => 'SEE SUPPLEMENT: I-129F Explanation of meeting',
                'marriage_broker'          => 'yes',
                // IMB contact information (required when marriage_broker = yes)
                'number_and_street'        => '123 Cupid Avenue',
                'apartment_suite_or_floor_no' => 'N/A',
                'town_or_city'             => 'Cebu City',
                'country'                  => 'Philippines',
                'province'                 => 'Cebu',
                'provinceOptional'         => false,
                'postal_code'              => '6000',
                'postalCode'               => false,
                'name'                     => 'relationship',
                'next'                     => 'employment',
                'type'                     => 'sponsor',
            ],

            // Two employers covering > 5 years with no gaps:
            //   1. Pacific Northwest Software Inc   04/01/2015 – PRESENT
            //   2. Boeing Company                   09/01/2008 – 03/31/2015
            'employment' => [
                'full_name_of_employer1'   => 'Pacific Northwest Software Inc',
                'street_number_and_name1'  => '2001 Westlake Avenue',
                'aptsteflr1'               => '',
                'employerAptSteFlr1'       => true,
                'apt_ste_flr1'             => '',
                'city1'                    => 'Seattle',
                'state1'                   => $sid('Washington'),
                'employerState1'           => false,
                'zip_postal_code1'         => '98121',
                'zIPPostalCode1'           => false,
                'province1'                => 'N/A',
                'employerProvince1'        => true,
                'country1'                 => 'United States (+1)',
                'occupation_specify1'      => 'Senior Systems Analyst',
                'employement_start_date1'  => '04/01/2015',
                'employement_end_date1'    => 'Present',
                'present_date'             => 'Present',
                'employer1'                => '1',
                'remaingYears1'            => '5',

                'full_name_of_employer2'   => 'Boeing Company',
                'street_number_and_name2'  => '100 N Riverside',
                'aptsteflr2'               => '',
                'employerAptSteFlr2'       => true,
                'apt_ste_flr2'             => '',
                'city2'                    => 'Renton',
                'state2'                   => $sid('Washington'),
                'employerState2'           => false,
                'zip_postal_code2'         => '98057',
                'zIPPostalCode2'           => false,
                'province2'                => 'N/A',
                'employerProvince2'        => true,
                'country2'                 => 'United States (+1)',
                'occupation_specify2'      => 'Systems Engineer',
                'employement_start_date2'  => '09/01/2008',
                'employement_end_date2'    => '03/31/2015',
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
        // Beneficiary: Isabel Joy Dela Cruz — Filipino, Cebu City
        // DOB: 11/25/1988  |  Divorced; 1 child (Sofia, born 2016)  |  Embassy: Manila
        // Former surname: Navarro

        $alienSteps = [

            'name' => [
                'beneficiary_classification_sought' => 'K-1',
                'first_name'                        => 'Isabel',
                'middle_name'                       => 'Joy',
                'last_name'                         => 'Dela Cruz',
                'gender'                            => 'female',
                'related_to_you'                    => 'no',
                // Former married surname
                'prior_name1'                       => 'yes',
                'prior_fname1'                      => 'Isabel',
                'prior_mname1'                      => 'Joy',
                'prior_lname1'                      => 'Navarro',
                'prior_name2'                       => 'no',
                'name'                              => 'name',
                'next'                              => 'citizenship',
                'type'                              => 'alien',
            ],

            'citizenship' => [
                'country_of_citizenship' => 'Philippines',
                'country_of_birth'       => 'Philippines',
                'city_of_birth'          => 'Cebu City',
                'date_of_birth'          => '11/25/1988',
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
                'email'                         => 'isabel.delacruz@example.com',
                'country_code'                  => 'Philippines (+63)',
                'telephone_number'              => '+63-32-555-0147',
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

            // Edge case: previously married (divorced ≈ 2019), 1 minor child
            'marital-status' => [
                'current_marital_status' => 'single',
                'previous_marriages'     => 'yes',
                'prior_spouse_fname1'    => 'Eduardo',
                'prior_spouse_mname1'    => '',
                'prior_spouse_lname1'    => 'Navarro',
                'prior_marriage_date1'   => '',
                'prior_divorce_date1'    => '09/14/2019',
                'prior_divorce_place1'   => '',
                'name'                   => 'marital-status',
                'next'                   => 'parents',
                'type'                   => 'alien',
            ],

            'parents' => [
                // Father: Fernando Arcega Dela Cruz — alive, Philippines
                'father_first_name'           => 'Fernando',
                'father_middle_name'          => 'Arcega',
                'father_last_name'            => 'Dela Cruz',
                'father_date_of_birth'        => '08/12/1958',
                'father_city_of_birth'        => 'Cebu City',
                'father_country_of_birth'     => 'Philippines',
                'father_alive'                => 'yes',
                'father_country_of_residence' => 'Philippines',
                // Mother: Carmela Dagohoy Ybañez — alive, Philippines
                'mother_first_name'           => 'Carmela',
                'mother_middle_name'          => 'Dagohoy',
                'mother_last_name'            => "Yba\u{00F1}ez",
                'mother_date_of_birth'        => '03/19/1962',
                'mother_city_of_birth'        => 'Cebu City',
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

            // Two Cebu City addresses:
            //   1. 33 Osmena Boulevard, Apt 7C  (09/15/2019 – PRESENT)
            //   2. 15 Jakosalem Street            (03/10/2013 – 09/14/2019)
            'address' => [
                'in_care_name'                  => '',
                'inCareName'                    => false,
                'number_and_street'             => '33 Osmena Boulevard',
                'apartment_suite_or_floor'      => 'Apartment',
                'apartmentSuiteOrFloor'         => false,
                'apartment_suite_or_floor_no'   => '7C',
                'apartmentSuiteOrFloorNo'       => false,
                'town_or_city'                  => 'Cebu City',
                'country'                       => 'Philippines',
                'state'                         => 'N/A',
                'dontHasState'                  => true,
                'province'                      => 'Cebu',
                'provinceApply'                 => false,
                'postal_code'                   => '6000',
                'postalCode'                    => false,
                'date_from'                     => '09/15/2019',
                'date_to'                       => 'PRESENT',
                'has_prior_address'             => 'yes',
                'p_number_and_street'           => '15 Jakosalem Street',
                'p_apartment_suite_or_floor'    => 'Dose Not Apply',
                'p_apartment_suite_or_floor_no' => '',
                'p_town_or_city'                => 'Cebu City',
                'p_province'                    => 'Cebu',
                'p_postal_code'                 => '6000',
                'p_country'                     => 'Philippines',
                'p_date_from'                   => '03/10/2013',
                'p_date_to'                     => '09/14/2019',
                'native_alphabet_name'          => 'N/A',
                'native_alphabet_address'       => 'N/A',
                'name'                          => 'address',
                'next'                          => 'employment',
                'type'                          => 'alien',
            ],

            // Two Cebu employers:
            //   1. Chong Hua Hospital                       10/01/2019 – PRESENT
            //   2. Vicente Sotto Memorial Medical Center    06/01/2012 – 09/30/2019
            'employment' => [
                'full_name_of_employer1'   => 'Chong Hua Hospital',
                'street_number_and_name1'  => 'Don Marcelino Street',
                'aptsteflr1'               => '',
                'employerAptSteFlr1'       => true,
                'apt_ste_flr1'             => '',
                'city1'                    => 'Cebu City',
                'state1'                   => 'N/A',
                'employerState1'           => true,
                'zip_postal_code1'         => '6000',
                'zIPPostalCode1'           => false,
                'province1'               => 'Cebu',
                'employerProvince1'        => false,
                'country1'                 => 'Philippines',
                'occupation_specify1'      => 'Physical Therapist',
                'employement_start_date1'  => '10/01/2019',
                'employement_end_date1'    => 'Present',
                'present_date'             => 'Present',
                'employer1'                => '1',
                'remaingYears1'            => '5',

                'full_name_of_employer2'   => 'Vicente Sotto Memorial Medical Center',
                'street_number_and_name2'  => 'B. Rodriguez Street',
                'aptsteflr2'               => '',
                'employerAptSteFlr2'       => true,
                'apt_ste_flr2'             => '',
                'city2'                    => 'Cebu City',
                'state2'                   => 'N/A',
                'employerState2'           => true,
                'zip_postal_code2'         => '6000',
                'zIPPostalCode2'           => false,
                'province2'               => 'Cebu',
                'employerProvince2'        => false,
                'country2'                 => 'Philippines',
                'occupation_specify2'      => 'Junior Physical Therapist',
                'employement_start_date2'  => '06/01/2012',
                'employement_end_date2'    => '09/30/2019',
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
                'school_name1'    => 'University of the Visayas',
                'school_city1'    => 'Cebu City',
                'school_country1' => 'Philippines',
                'school_from1'    => '06/2006',
                'school_to1'      => '04/2011',
                'school_degree1'  => 'Bachelor of Science in Physical Therapy',
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

        $this->command->info('K-1 Mock 3 seeded successfully.');
        $this->command->info('  Petitioner : Thomas William Brady (thomas.brady@example.com)');
        $this->command->info('  Beneficiary: Isabel Joy Dela Cruz (Cebu City, Philippines)');
        $this->command->info('  Edge cases : widowed petitioner, DUI conviction, IMB, beneficiary divorced with child');
        $this->command->info('  Sponsor steps : ' . count($sponsorSteps) . '/10');
        $this->command->info('  Alien steps   : ' . count($alienSteps) . '/21');
    }
}
