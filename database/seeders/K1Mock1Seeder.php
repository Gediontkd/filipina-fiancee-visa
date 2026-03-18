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
 * Mock 1 — Edge cases: Prior K-1 filing, divorced petitioner, prior physical address.
 *
 * Petitioner : James Patrick Sullivan  (U.S. citizen, divorced, Chicago IL)
 *              → previously filed an I-129F that was approved (prior K-1)
 * Beneficiary: Anna Luz Mendoza        (Filipino national, Quezon City)
 *
 * ═══════════════════════════════════════════════════════════════════════════
 * STANDARD FIELD MAPPING — use this as the reference for all K-1 seeders
 * ═══════════════════════════════════════════════════════════════════════════
 *
 * SPONSOR STEPS (10 steps → type = 'sponsor')
 * ─────────────────────────────────────────────
 * name          : first_name, middle_name, last_name, gender (male|female),
 *                 prior_name1 (yes|no), prior_fname1, prior_mname1, prior_lname1,
 *                 prior_maiden_name1 (yes|no), prior_name2 (yes|no)
 *
 * contact       : email, daytime_telephone_no, mobile_telephone_number,
 *                 social_sec_no (or 'N/A' + socialSecNo:true),
 *                 uscis_no (''), sponsor_a (''),
 *                 diffrent_mailing_address (yes|no)
 *                 [if yes → in_care_name, number_and_street, apartment_suite_or_floor,
 *                  apartment_suite_or_floor_no, town_or_city, country, state, province,
 *                  postal_code (or 'N/A' + postalCode:true)]
 *
 * place-of-birth: country_of_birth, city_of_birth, state_of_birth, date_of_birth
 *                 father_first_name, father_middle_name, father_last_name,
 *                 father_date_of_birth, father_city_of_birth, father_country_of_birth,
 *                 father_alive (yes|no)
 *                 mother_first_name, mother_middle_name, mother_last_name,
 *                 mother_date_of_birth, mother_city_of_birth, mother_country_of_birth,
 *                 mother_alive (yes|no)
 *
 * status        : current_status (USCitizen|PermanentResident|USNational)
 *                 height_feet, height_inches, weight_lbs, ethnicity, race[],
 *                 hair_color, eye_color, citizenship_basis
 *
 * marital-status: current_marital_status (single|married|divorced|widowed)
 *                 previous_marriages (yes|no)
 *                 [if divorced/widowed → prior_spouse_fname1, prior_spouse_lname1,
 *                  prior_marriage_date1, prior_divorce_date1, prior_divorce_place1]
 *
 * other-filings : i_130 (yes|no) ← "Have you filed I-130 for this beneficiary?"
 *                 i_129F (yes|no), situation (situation1–4),
 *                 waiver_document_path (null or path)
 *                 [if yes → alien_fname1, alien_mname1, alien_mlname1,
 *                  alien_reg_no1, alien_city_filing1, us_State1,
 *                  date_of_filing1, results_of_App1]
 *                 previous_filing (yes|no), approved_i_129F (yes|no)
 *
 * military-and-convictions: member_of_us (yes|no), protection (yes|no),
 *                 violence (yes|no), manslaughter (yes|no), convictions (yes|no),
 *                 drug_related (yes|no), specified_offense (yes|no)
 *
 * address       : in_care_name ('N/A' + inCareName:true if N/A),
 *                 number_and_street, apartment_suite_or_floor (Apartment|Suite|Floor|Dose Not Apply),
 *                 apartment_suite_or_floor_no, town_or_city,
 *                 country (e.g. 'United States (+1)'), state, province, postal_code,
 *                 date_from (mm/dd/yyyy), date_to (mm/dd/yyyy or 'PRESENT'),
 *                 has_prior_address (yes|no)
 *                 [if yes → p_number_and_street, p_apartment_suite_or_floor,
 *                  p_apartment_suite_or_floor_no, p_town_or_city, p_country,
 *                  p_state, p_zip_code, p_date_from, p_date_to]
 *                 foreign_state1, foreign_country1 (residence since 18th birthday)
 *
 * relationship  : met_in_person (yes|no), met_date, met_description,
 *                 intend_to_marry (yes|no), marriage_location
 *
 * employment    : per employer {i} (component field names from employer.blade.php):
 *                   full_name_of_employer{i}, street_number_and_name{i},
 *                   aptsteflr{i} (select: Apt|Ste|Flr|''), employerAptSteFlr{i} (bool),
 *                   apt_ste_flr{i} (number), city{i}, state{i}, employerState{i} (bool),
 *                   zip_postal_code{i}, zIPPostalCode{i} (bool), province{i},
 *                   employerProvince{i} (bool), country{i}, occupation_specify{i},
 *                   employement_start_date{i}, employement_end_date{i},
 *                   employer{i} (hidden = index), remaingYears{i} (hidden = '5')
 *                 present_date ('Present' for current employer)
 *                 [employer2–5 same pattern, leave blank name/dates if unused]
 *                 has_preparer (yes|no)
 *                 [if yes → preparer_family_name, preparer_given_name,
 *                  preparer_business_name, preparer_daytime_phone, preparer_email,
 *                  has_interpreter (yes|no)]
 *
 * ─────────────────────────────────────────────
 * ALIEN STEPS (21 steps → type = 'alien')
 * ─────────────────────────────────────────────
 * name          : first_name, middle_name, last_name, gender (male|female),
 *                 prior_name1 (yes|no), prior_fname1, prior_mname1, prior_lname1
 *
 * citizenship   : country_of_citizenship, country_of_birth, city_of_birth, date_of_birth
 *
 * embassy       : embassy_country, embassy_city
 *
 * contact       : email,
 *                 country_code (e.g. 'Philippines (+63)'), telephone_number,
 *                 mob_no_country, mob_telephone_number,
 *                 reg_no ('N/A' + regNo:true if N/A),
 *                 social_sec_no ('N/A' + socialSecNo:true if N/A),
 *                 diffrent_mailing_address (yes|no),
 *                 us_address_same_as_petitioner (yes|no)
 *                 [if no → us_dest_number_and_street, us_dest_apartment_suite_or_floor,
 *                  us_dest_apartment_suite_or_floor_no, us_dest_town_or_city,
 *                  us_dest_state, us_dest_zip_code]
 *
 * address       : in_care_name, number_and_street,
 *                 apartment_suite_or_floor (Apartment|Suite|Floor|Does Not Apply),
 *                 apartment_suite_or_floor_no, town_or_city, country,
 *                 state ('N/A' + dontHasState:true if no US state), province, postal_code,
 *                 date_from (mm/dd/yyyy), date_to (mm/dd/yyyy or 'PRESENT'),
 *                 has_prior_address (yes|no)
 *                 [if yes → p_number_and_street, p_apartment_suite_or_floor,
 *                  p_apartment_suite_or_floor_no, p_town_or_city, p_province,
 *                  p_postal_code, p_country, p_date_from, p_date_to]
 *                 native_alphabet_name ('N/A' for Philippines),
 *                 native_alphabet_address ('N/A' for Philippines)
 * ═══════════════════════════════════════════════════════════════════════════
 */
class K1Mock1Seeder extends Seeder
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
            ->whereIn('status', ['pending', 'progress'])
            ->first();

        if (!$submittedApp) {
            $this->command->error('No K-1 application found for this user. Make sure the user has selected K-1 Fiancé(e) Visa first.');
            return;
        }

        // Reset to pending so we can re-seed cleanly
        $submittedApp->update(['status' => 'pending']);

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
                // NEW: I-130 question (Have you ever filed I-130 for this beneficiary?)
                'i_130'                 => 'no',
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

            // Two physical addresses:
            //   1. 740 N Wabash Ave, Apt 12C, Chicago IL 60611  (03/01/2023 – PRESENT) ← current
            //   2. 301 E Market St, Indianapolis IN 46204         (07/01/2021 – 02/28/2023) ← prior
            'address' => [
                // Current physical address fields (match form field names exactly)
                'in_care_name'             => 'N/A',
                'inCareName'               => true,
                'number_and_street'        => '740 N Wabash Avenue',
                'apartment_suite_or_floor' => 'Apartment',   // SELECT: Apartment|Suite|Floor|Dose Not Apply
                'apartment_suite_or_floor_no' => '12C',
                'town_or_city'             => 'Chicago',
                'country'                  => 'United States (+1)',
                'state'                    => 'Illinois',
                'province'                 => 'N/A',
                'provinceOption'           => true,
                'postal_code'              => '60611',
                'postalCode'               => false,
                // Address 1 dates (date_from / date_to — the form field names)
                'date_from'                => '03/01/2023',
                'date_to'                  => 'PRESENT',
                // Prior address toggle + Address 2 fields (p_ prefix matches form field names)
                'has_prior_address'        => 'yes',
                'p_number_and_street'      => '301 E Market Street',
                'p_apartment_suite_or_floor'    => 'Does Not Apply',
                'p_apartment_suite_or_floor_no' => '',
                'p_town_or_city'           => 'Indianapolis',
                'p_country'                => 'United States (+1)',
                'p_state'                  => 'Indiana',
                'p_zip_code'               => '46204',
                'p_date_from'              => '07/01/2021',
                'p_date_to'                => '02/28/2023',
                // Residence history since 18th birthday (foreign_state / foreign_country)
                'foreign_state1'           => 'Illinois',
                'foreign_country1'         => 'United States',
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
                // Employer 1 — current (all fields match employer.blade.php component)
                'full_name_of_employer1'   => 'Sullivan & Associates Law Group',
                'street_number_and_name1'  => '321 N Clark Street',
                'aptsteflr1'               => 'Ste',       // select: Apt|Ste|Flr|''
                'employerAptSteFlr1'       => false,       // does-not-apply checkbox
                'apt_ste_flr1'             => '1800',      // suite/floor number
                'city1'                    => 'Chicago',
                'state1'                   => 'Illinois',
                'employerState1'           => false,
                'zip_postal_code1'         => '60654',
                'zIPPostalCode1'           => false,
                'province1'                => 'N/A',
                'employerProvince1'        => true,        // does-not-apply
                'country1'                 => 'United States (+1)',
                'occupation_specify1'      => 'Attorney',
                'employement_start_date1'  => '09/01/2022',
                'employement_end_date1'    => 'Present',   // set by JS when Present? checked
                'present_date'             => 'Present',   // component checks == 'Present'
                'employer1'                => '1',         // hidden field
                'remaingYears1'            => '5',

                // Employer 2 — prior
                'full_name_of_employer2'   => 'Midwest Legal Partners LLC',
                'street_number_and_name2'  => '111 Monument Circle',
                'aptsteflr2'               => 'Ste',
                'employerAptSteFlr2'       => false,
                'apt_ste_flr2'             => '400',
                'city2'                    => 'Indianapolis',
                'state2'                   => 'Indiana',
                'employerState2'           => false,
                'zip_postal_code2'         => '46204',
                'zIPPostalCode2'           => false,
                'province2'                => 'N/A',
                'employerProvince2'        => true,
                'country2'                 => 'United States (+1)',
                'occupation_specify2'      => 'Associate Attorney',
                'employement_start_date2'  => '05/15/2018',
                'employement_end_date2'    => '08/31/2022',
                'employer2'                => '2',
                'remaingYears2'            => '5',

                // Employers 3–5 unused
                'full_name_of_employer3'   => '',
                'employement_start_date3'  => '',
                'employement_end_date3'    => '',

                'full_name_of_employer4'   => '',
                'employement_start_date4'  => '',
                'employement_end_date4'    => '',

                'full_name_of_employer5'   => '',
                'employement_start_date5'  => '',
                'employement_end_date5'    => '',

                // Part 7: Preparer (none in this case)
                'has_preparer' => 'no',

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
                'email'                        => 'anna.mendoza@example.com',
                // Daytime phone — form field name is 'telephone_number' (with country_code select)
                'country_code'                 => 'Philippines (+63)',
                'telephone_number'             => '2-8888-0147',
                // Mobile phone — form field name is 'mob_telephone_number'
                'mob_no_country'               => 'Philippines (+63)',
                'mob_telephone_number'         => '917-555-0147',
                // Alien Registration Number (does not apply for new applicant)
                'reg_no'                       => 'N/A',
                'regNo'                        => true,
                // US Social Security Number (does not apply)
                'social_sec_no'                => 'N/A',
                'socialSecNo'                  => true,
                // Mailing address same as physical
                'diffrent_mailing_address'     => 'no',
                // Beneficiary's intended U.S. address (same as petitioner's)
                'us_address_same_as_petitioner' => 'yes',
                'name'                         => 'contact',
                'next'                         => 'marital-status',
                'type'                         => 'alien',
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
                // Current physical address (field names match alien/address.blade.php exactly)
                'in_care_name'                  => 'N/A',
                'inCareName'                    => true,
                'number_and_street'             => '14 Katipunan Avenue',
                'apartment_suite_or_floor'      => 'Apartment',   // SELECT value
                'apartmentSuiteOrFloor'         => false,
                'apartment_suite_or_floor_no'   => '2A',
                'apartmentSuiteOrFloorNo'       => false,
                'town_or_city'                  => 'Quezon City',
                'country'                       => 'Philippines',
                'state'                         => 'N/A',
                'dontHasState'                  => true,          // "Does Not Apply" for US state
                'province'                      => 'Metro Manila',
                'provinceApply'                 => false,
                'postal_code'                   => '1108',
                'postalCode'                    => false,
                // Date fields (form field names: date_from / date_to)
                'date_from'                     => '01/10/2021',
                'date_to'                       => 'PRESENT',
                // Prior address toggle + prior address fields (p_ prefix)
                'has_prior_address'             => 'yes',
                'p_number_and_street'           => '56 Session Road',
                'p_apartment_suite_or_floor'    => 'Does Not Apply',
                'p_apartment_suite_or_floor_no' => '',
                'p_town_or_city'                => 'Baguio City',
                'p_province'                    => 'Benguet',
                'p_postal_code'                 => '2600',
                'p_country'                     => 'Philippines',
                'p_date_from'                   => '05/01/2017',
                'p_date_to'                     => '01/09/2021',
                // Philippine case: native alphabet fields → N/A
                'native_alphabet_name'          => 'N/A',
                'native_alphabet_address'       => 'N/A',
                'name'                          => 'address',
                'next'                          => 'employment',
                'type'                          => 'alien',
            ],

            // Two employers covering > 5 years with no gaps:
            //   1. BDO Unibank Inc                        03/15/2021 – PRESENT
            //   2. Mountain Province Credit Cooperative   08/01/2018 – 03/14/2021
            //      Gap check: 03/14/2021 + 1 day = 03/15/2021 = start of employer 1 ✓
            //      Coverage : 08/01/2018 < 2021-03-17 (5 yrs ago) ✓
            //      NOTE: Python mock ends employer 2 on 02/28/2021 which creates a
            //      14-day gap; end date adjusted to 03/14/2021 to satisfy validation.
            'employment' => [
                // Employer 1 — current (Philippine employer, no US state)
                'full_name_of_employer1'   => 'BDO Unibank Inc',
                'street_number_and_name1'  => '8737 Paseo de Roxas',
                'aptsteflr1'               => '',           // no apt/ste/flr
                'employerAptSteFlr1'       => true,         // does-not-apply
                'apt_ste_flr1'             => '',
                'city1'                    => 'Makati City',
                'state1'                   => 'N/A',
                'employerState1'           => true,         // does-not-apply (non-US)
                'zip_postal_code1'         => '1226',
                'zIPPostalCode1'           => false,
                'province1'                => 'Metro Manila',
                'employerProvince1'        => false,
                'country1'                 => 'Philippines',
                'occupation_specify1'      => 'Bank Teller',
                'employement_start_date1'  => '03/15/2021',
                'employement_end_date1'    => 'Present',
                'present_date'             => 'Present',
                'employer1'                => '1',
                'remaingYears1'            => '5',

                // Employer 2 — prior
                'full_name_of_employer2'   => 'Mountain Province Credit Cooperative',
                'street_number_and_name2'  => '12 Session Road',
                'aptsteflr2'               => '',
                'employerAptSteFlr2'       => true,
                'apt_ste_flr2'             => '',
                'city2'                    => 'Baguio City',
                'state2'                   => 'N/A',
                'employerState2'           => true,
                'zip_postal_code2'         => '2600',
                'zIPPostalCode2'           => false,
                'province2'                => 'Benguet',
                'employerProvince2'        => false,
                'country2'                 => 'Philippines',
                'occupation_specify2'      => 'Loan Officer',
                'employement_start_date2'  => '08/01/2018',
                'employement_end_date2'    => '03/14/2021',
                'employer2'                => '2',
                'remaingYears2'            => '5',

                // Employers 3–5 unused
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
