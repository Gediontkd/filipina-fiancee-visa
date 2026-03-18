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
 * Mock 1 — Edge cases: multiple I-129F filings (waiver needed), divorced petitioner, prior addresses.
 *
 * Petitioner : James Patrick Sullivan  (U.S. citizen, divorced, Chicago IL)
 *              → previously filed two I-129F petitions; waiver required (situation3)
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
 *
 * place-of-birth: s_dob (mm/dd/yyyy), s_city_of_birth, s_state_of_birth,
 *                 s_country_of_birth (from getAllCountryForSponsor dropdown)
 *                 father_last_name, father_first_name,
 *                 father_middle_name (+ fatherMiddleName:bool for does-not-apply),
 *                 father_dob (+ fatherDob:bool), father_city_or_province_of_birth,
 *                 father_birth_country, he_deceased (yes|no),
 *                 father_city_of_res (if alive), father_country (if alive)
 *                 mother_maiden_last_name, mother_first_name,
 *                 mother_middle_name (+ motherMiddleName:bool),
 *                 mother_dob (+ motherDob:bool), mother_city_of_birth,
 *                 mother_birth_country (+ motherBirthCountry:bool),
 *                 she_deceased (yes|no),
 *                 mother_city_of_res (if alive), mother_country (if alive)
 *
 * status        : current_status (USCitizen|PermanentResident|Nationalborn)
 *                 height_feet, height_inches, weight_pound,
 *                 ethnicity (Not Hispanic or Latino|Hispanic or Latino),
 *                 race (White|Asian|Black or African American|
 *                       American Indian or Alaska Native|
 *                       Native Hawaiian or Other Pacific Islander),
 *                 hair_color (Black|Brown|Blond|Gray|White|Red|Sandy|Bald (No Hair)|Other),
 *                 eye_color (Black|Blue|Brown|Gray|Green|Hazel|Maroon|Other|Pink),
 *                 obtain_citizenship (Born in U.S.A|Naturalized|From Parents)
 *                 [if Naturalized → certificate_citizenship (yes|no),
 *                  if yes → naturalization_certificate, place_of_issue, dob]
 *
 * marital-status: current_marital_status (single|married|divorced|widowed)
 *                 previous_marriages (yes|no)
 *                 [if divorced/widowed → prior_spouse_fname1, prior_spouse_mname1,
 *                  prior_spouse_lname1, prior_marriage_date1 (''),
 *                  prior_divorce_date1, prior_divorce_place1 ('')]
 *
 * other-filings : i_130 (yes|no) ← "Have you filed I-130 for this beneficiary?"
 *                 i_129F (yes|no), situation (situation1–4),
 *                 waiver_document_path (null or path)
 *                 [if i_129F=yes → alien_fname1, alien_mname1, alien_mlname1,
 *                  alien_reg_no1, alien_city_filing1, us_State1 (state ID),
 *                  date_of_filing1, results_of_App1]
 *                 previous_filing (yes|no), approved_i_129F (yes|no)
 *
 * military-and-convictions: member_of_us (yes|no), protection (yes|no),
 *                 violence (yes|no), manslaughter (yes|no), convictions (yes|no),
 *                 drug_related (yes|no), specified_offense (yes|no)
 *                 [if any yes → provide_information, provide_information1]
 *
 * address       : in_care_name ('' or 'N/A' + inCareName:true),
 *                 number_and_street,
 *                 apartment_suite_or_floor (Apartment|Suite|Floor|Dose Not Apply),
 *                 apartment_suite_or_floor_no, town_or_city,
 *                 country (e.g. 'United States (+1)'), state (DB id via State model),
 *                 province (+ provinceOption:bool), postal_code (+ postalCode:bool),
 *                 date_from (mm/dd/yyyy), date_to (mm/dd/yyyy or 'PRESENT'),
 *                 has_prior_address (yes|no)
 *                 [if yes → p_number_and_street, p_apartment_suite_or_floor,
 *                  p_apartment_suite_or_floor_no, p_town_or_city, p_country,
 *                  p_state (DB id), p_zip_code, p_date_from, p_date_to]
 *                 foreign_state1, foreign_country1 (residence since 18th birthday)
 *
 * relationship  : responsibility (yes|no) ← "Have you met in person?"
 *                 res_text_2 (meeting story textarea)
 *                 marriage_broker (yes|no) ← "Introduced by IMB?"
 *                 [if yes → number_and_street, apartment_suite_or_floor_no,
 *                  town_or_city, country, province (+ provinceOptional:bool),
 *                  postal_code (+ postalCode:bool)]
 *
 * employment    : per employer {i} (employer.blade.php component field names):
 *                   full_name_of_employer{i}, street_number_and_name{i},
 *                   aptsteflr{i} (select: Apt|Ste|Flr|''), employerAptSteFlr{i} (bool),
 *                   apt_ste_flr{i} (number), city{i}, state{i} (DB id),
 *                   employerState{i} (bool), zip_postal_code{i},
 *                   zIPPostalCode{i} (bool), province{i}, employerProvince{i} (bool),
 *                   country{i}, occupation_specify{i},
 *                   employement_start_date{i}, employement_end_date{i},
 *                   employer{i} (hidden = index), remaingYears{i} (hidden = '5')
 *                 present_date ('Present' for current employer)
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
 *
 * address       : in_care_name, number_and_street,
 *                 apartment_suite_or_floor (Apartment|Suite|Floor|Does Not Apply),
 *                 apartment_suite_or_floor_no, town_or_city, country,
 *                 state ('' + dontHasState:true if non-US), province, postal_code,
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

        // Resolve US state IDs (state dropdown uses DB id as option value)
        $stateMap = State::where('country_id', 231)->pluck('id', 'name')->toArray();
        $sid = fn($name) => $stateMap[$name] ?? $name;

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
                'first_name'             => 'James',
                'middle_name'            => 'Patrick',
                'last_name'              => 'Sullivan',
                'gender'                 => 'male',
                'prior_name1'            => 'yes',
                'prior_fname1'           => 'Jim',
                'prior_mname1'           => 'P',
                'prior_lname1'           => 'Sullivan',
                'prior_maiden_name1'     => 'no',
                'prior_name2'            => 'no',
                'name'                   => 'name',
                'next'                   => 'contact',
                'type'                   => 'sponsor',
            ],

            'contact' => [
                'email'                    => 'james.sullivan@example.com',
                'daytime_telephone_no'     => '312-555-0189',
                'mobile_telephone_number'  => '312-555-0290',
                'social_sec_no'            => '222-33-4444',
                'uscis_no'                 => '',
                'sponsor_a'                => '',
                'diffrent_mailing_address' => 'no',
                'name'                     => 'contact',
                'next'                     => 'place-of-birth',
                'type'                     => 'sponsor',
            ],

            'place-of-birth' => [
                // Sponsor birth fields (s_ prefix — blade uses s_dob, s_city_of_birth etc.)
                's_dob'                          => '11/04/1980',
                's_city_of_birth'                => 'Springfield',
                's_state_of_birth'               => 'Illinois',
                's_country_of_birth'             => 'United States',
                // Father: Patrick Joseph Sullivan — alive, Springfield IL
                'father_last_name'               => 'Sullivan',
                'father_first_name'              => 'Patrick',
                'father_middle_name'             => 'Joseph',
                'fatherMiddleName'               => false,
                'father_dob'                     => '03/15/1952',
                'fatherDob'                      => false,
                'father_city_or_province_of_birth' => 'Springfield',
                'father_birth_country'           => 'United States',
                'he_deceased'                    => 'no',
                'father_city_of_res'             => 'Springfield',
                'father_country'                 => 'United States',
                // Mother: Catherine Marie O'Brien — alive, Peoria IL
                'mother_maiden_last_name'        => "O'Brien",
                'mother_first_name'              => 'Catherine',
                'mother_middle_name'             => 'Marie',
                'motherMiddleName'               => false,
                'mother_dob'                     => '08/27/1955',
                'motherDob'                      => false,
                'mother_city_of_birth'           => 'Peoria',
                'mother_birth_country'           => 'United States',
                'motherBirthCountry'             => false,
                'she_deceased'                   => 'no',
                'mother_city_of_res'             => 'Peoria',
                'mother_country'                 => 'United States',
                'name'                           => 'place-of-birth',
                'next'                           => 'status',
                'type'                           => 'sponsor',
            ],

            'status' => [
                'current_status'     => 'USCitizen',
                'height_feet'        => '6',
                'height_inches'      => '0',
                'weight_pound'       => '175',
                'ethnicity'          => 'Not Hispanic or Latino',
                'race'               => 'White',
                'hair_color'         => 'Brown',
                'eye_color'          => 'Green',
                'obtain_citizenship' => 'Born in U.S.A',
                'name'               => 'status',
                'next'               => 'marital-status',
                'type'               => 'sponsor',
            ],

            // Edge case: divorced petitioner with one prior marriage (Jennifer Walsh)
            'marital-status' => [
                'current_marital_status' => 'divorced',
                'previous_marriages'     => 'yes',
                'prior_spouse_fname1'    => 'Jennifer',
                'prior_spouse_mname1'    => '',          // NMI — not captured in form
                'prior_spouse_lname1'    => 'Walsh',
                'prior_marriage_date1'   => '',          // not captured in form
                'prior_divorce_date1'    => '06/15/2021',
                'prior_divorce_place1'   => '',          // not captured in form
                'name'                   => 'marital-status',
                'next'                   => 'other-filings',
                'type'                   => 'sponsor',
            ],

            // Edge case: two prior I-129F filings → situation3 (request waiver with petition)
            // Most recent: Sofia Reyes Vargas — filed 06/01/2025 — Withdrawn
            // Older:       Maria Elena Santos  — filed 03/15/2019 — Approved (no travel)
            'other-filings' => [
                'i_130'                 => 'no',
                'i_129F'                => 'yes',
                'situation'             => 'situation3',
                'waiver_document_path'  => null,
                // Most recent I-129F filing details
                'alien_fname1'          => 'Sofia',
                'alien_mname1'          => 'Reyes',
                'alien_mlname1'         => 'Vargas',
                'alien_reg_no1'         => '',
                'alien_city_filing1'    => '',
                'us_State1'             => $sid('Illinois'),
                'date_of_filing1'       => '06/01/2025',
                'results_of_App1'       => 'Petition Withdrawn',
                // Older filing (Part 8 — answered via previous_filing)
                'previous_filing'       => 'yes',
                'approved_i_129F'       => 'no',
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
            //   1. 740 N Wabash Ave, Apt 12C, Chicago IL 60611  (03/01/2023 – PRESENT)
            //   2. 301 E Market St, Indianapolis IN 46204         (07/01/2021 – 02/28/2023)
            'address' => [
                'in_care_name'                  => '',
                'inCareName'                    => false,
                'number_and_street'             => '740 N Wabash Avenue',
                'apartment_suite_or_floor'      => 'Apartment',
                'apartment_suite_or_floor_no'   => '12C',
                'town_or_city'                  => 'Chicago',
                'country'                       => 'United States (+1)',
                'state'                         => $sid('Illinois'),
                'province'                      => 'N/A',
                'provinceOption'                => true,
                'postal_code'                   => '60611',
                'postalCode'                    => false,
                'date_from'                     => '03/01/2023',
                'date_to'                       => 'PRESENT',
                'has_prior_address'             => 'yes',
                'p_number_and_street'           => '301 E Market Street',
                'p_apartment_suite_or_floor'    => 'Dose Not Apply',
                'p_apartment_suite_or_floor_no' => '',
                'p_town_or_city'                => 'Indianapolis',
                'p_country'                     => 'United States (+1)',
                'p_state'                       => $sid('Indiana'),
                'p_zip_code'                    => '46204',
                'p_date_from'                   => '07/01/2021',
                'p_date_to'                     => '02/28/2023',
                // Residence since 18th birthday (text fields)
                'foreign_state1'                => 'Illinois',
                'foreign_country1'              => 'United States',
                'name'                          => 'address',
                'next'                          => 'relationship',
                'type'                          => 'sponsor',
            ],

            // Met in person in Quezon City, April 2022; not via IMB
            'relationship' => [
                'responsibility'     => 'yes',   // "Have you met your fiancée in person?"
                'res_text_2'         => 'SEE SUPPLEMENT: I-129F Explanation of meeting',
                'marriage_broker'    => 'no',
                'name'               => 'relationship',
                'next'               => 'employment',
                'type'               => 'sponsor',
            ],

            // Two employers covering > 5 years with no gaps:
            //   1. Sullivan & Associates Law Group   09/01/2022 – PRESENT
            //   2. Midwest Legal Partners LLC        05/15/2018 – 08/31/2022
            'employment' => [
                // Employer 1 — current (US employer)
                'full_name_of_employer1'   => 'Sullivan & Associates Law Group',
                'street_number_and_name1'  => '233 S Wacker Drive',
                'aptsteflr1'               => '',
                'employerAptSteFlr1'       => true,
                'apt_ste_flr1'             => '',
                'city1'                    => 'Chicago',
                'state1'                   => $sid('Illinois'),
                'employerState1'           => false,
                'zip_postal_code1'         => '60606',
                'zIPPostalCode1'           => false,
                'province1'                => 'N/A',
                'employerProvince1'        => true,
                'country1'                 => 'United States (+1)',
                'occupation_specify1'      => 'Attorney',
                'employement_start_date1'  => '09/01/2022',
                'employement_end_date1'    => 'Present',
                'present_date'             => 'Present',
                'employer1'                => '1',
                'remaingYears1'            => '5',
                // Employer 2 — prior (US employer)
                'full_name_of_employer2'   => 'Midwest Legal Partners LLC',
                'street_number_and_name2'  => '111 Monument Circle',
                'aptsteflr2'               => '',
                'employerAptSteFlr2'       => true,
                'apt_ste_flr2'             => '',
                'city2'                    => 'Indianapolis',
                'state2'                   => $sid('Indiana'),
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
                // Part 7: Preparer (none)
                'has_preparer'             => 'no',
                'name'                     => 'employment',
                'next'                     => 'employment',
                'type'                     => 'sponsor',
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
                'prior_name1'                       => 'yes',
                'prior_fname1'                      => 'Ana',
                'prior_mname1'                      => '',
                'prior_lname1'                      => 'Mendoza',
                'prior_name2'                       => 'no',
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
                'email'                         => 'anna.mendoza@example.com',
                'country_code'                  => 'Philippines (+63)',
                'telephone_number'              => '+63-2-8888-0147',
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

            'marital-status' => [
                'current_marital_status' => 'single',
                'previous_marriages'     => 'no',
                'name'                   => 'marital-status',
                'next'                   => 'parents',
                'type'                   => 'alien',
            ],

            'parents' => [
                // Father: Ricardo Santos Mendoza — alive, Philippines
                'father_first_name'           => 'Ricardo',
                'father_middle_name'          => 'Santos',
                'father_last_name'            => 'Mendoza',
                'father_date_of_birth'        => '02/11/1965',
                'father_city_of_birth'        => 'Baguio City',
                'father_country_of_birth'     => 'Philippines',
                'father_alive'                => 'yes',
                'father_country_of_residence' => 'Philippines',
                // Mother: Marites Oliveros Cruz — alive, Philippines
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

            // Philippine case: state = N/A (dontHasState:true), native alphabet = N/A
            'address' => [
                'in_care_name'                  => '',
                'inCareName'                    => false,
                'number_and_street'             => '14 Katipunan Avenue',
                'apartment_suite_or_floor'      => 'Apartment',
                'apartmentSuiteOrFloor'         => false,
                'apartment_suite_or_floor_no'   => '2A',
                'apartmentSuiteOrFloorNo'       => false,
                'town_or_city'                  => 'Quezon City',
                'country'                       => 'Philippines',
                'state'                         => 'N/A',
                'dontHasState'                  => true,
                'province'                      => 'Metro Manila',
                'provinceApply'                 => false,
                'postal_code'                   => '1108',
                'postalCode'                    => false,
                'date_from'                     => '01/10/2021',
                'date_to'                       => 'PRESENT',
                'has_prior_address'             => 'yes',
                'p_number_and_street'           => '56 Session Road',
                'p_apartment_suite_or_floor'    => 'Dose Not Apply',
                'p_apartment_suite_or_floor_no' => '',
                'p_town_or_city'                => 'Baguio City',
                'p_province'                    => 'Benguet',
                'p_postal_code'                 => '2600',
                'p_country'                     => 'Philippines',
                'p_date_from'                   => '05/01/2017',
                'p_date_to'                     => '01/09/2021',
                'native_alphabet_name'          => 'N/A',
                'native_alphabet_address'       => 'N/A',
                'name'                          => 'address',
                'next'                          => 'employment',
                'type'                          => 'alien',
            ],

            // Two Philippine employers — no US state (employerState:true = does-not-apply)
            //   1. BDO Unibank Inc                        03/15/2021 – PRESENT
            //   2. Mountain Province Credit Cooperative   08/01/2018 – 03/14/2021
            'employment' => [
                'full_name_of_employer1'   => 'BDO Unibank Inc',
                'street_number_and_name1'  => '8755 Paseo de Roxas',
                'aptsteflr1'               => '',
                'employerAptSteFlr1'       => true,
                'apt_ste_flr1'             => '',
                'city1'                    => 'Makati City',
                'state1'                   => 'N/A',
                'employerState1'           => true,
                'zip_postal_code1'         => '1226',
                'zIPPostalCode1'           => false,
                'province1'               => 'Metro Manila',
                'employerProvince1'        => false,
                'country1'                 => 'Philippines',
                'occupation_specify1'      => 'Bank Teller',
                'employement_start_date1'  => '03/15/2021',
                'employement_end_date1'    => 'Present',
                'present_date'             => 'Present',
                'employer1'                => '1',
                'remaingYears1'            => '5',

                'full_name_of_employer2'   => 'Mountain Province Credit Cooperative',
                'street_number_and_name2'  => '10 Bokod Road',
                'aptsteflr2'               => '',
                'employerAptSteFlr2'       => true,
                'apt_ste_flr2'             => '',
                'city2'                    => 'Baguio City',
                'state2'                   => 'N/A',
                'employerState2'           => true,
                'zip_postal_code2'         => '2600',
                'zIPPostalCode2'           => false,
                'province2'               => 'Benguet',
                'employerProvince2'        => false,
                'country2'                 => 'Philippines',
                'occupation_specify2'      => 'Accounts Clerk',
                'employement_start_date2'  => '08/01/2018',
                'employement_end_date2'    => '03/14/2021',
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

        // Mark application as in-progress
        $submittedApp->update(['status' => 'progress']);

        $this->command->info('K-1 Mock 1 seeded successfully.');
        $this->command->info('  Petitioner : James Patrick Sullivan (james.sullivan@example.com)');
        $this->command->info('  Beneficiary: Anna Luz Mendoza (Quezon City, Philippines)');
        $this->command->info('  Edge cases : multiple I-129F filings (waiver), divorced petitioner, prior addresses');
        $this->command->info('  Sponsor steps : ' . count($sponsorSteps) . '/10');
        $this->command->info('  Alien steps   : ' . count($alienSteps) . '/21');
    }
}
