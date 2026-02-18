<?php

namespace App\Http\Services\AdjustmentOfStatus;

use App\Models\SimplifiedAosApplication;
use App\Models\UserSubmittedApplication;
use Illuminate\Http\Request;
use Auth;
use DB;
use Log;

/**
 * Simplified AOS Service
 * Handles business logic for Adjustment of Status applications
 */
class SimplifiedAosService
{
    /**
     * Save or update AOS application
     */
    public function saveApplication(Request $request)
    {
        DB::beginTransaction();

        try {
            $applicationData = [
                'user_id' => Auth::id(),
                'submitted_app_id' => $request->submitted_app_id,
                
                // Applicant Information
                'applicant_first_name' => $request->applicant_first_name,
                'applicant_middle_name' => $request->applicant_middle_name,
                'applicant_last_name' => $request->applicant_last_name,
                'has_other_names' => $request->has('has_other_names') ? ($request->has_other_names == 1 ? 1 : 0) : null,
                'applicant_other_names' => $request->applicant_other_names,
                'applicant_email' => $request->applicant_email,
                'applicant_phone' => $request->applicant_phone,
                'applicant_mobile_phone' => $request->applicant_mobile_phone,
                'applicant_address' => $request->applicant_address,
                'applicant_city' => $request->applicant_city,
                'applicant_state' => $request->applicant_state,
                'applicant_zip' => $request->applicant_zip,
                'applicant_in_care_of' => $request->applicant_in_care_of,
                'applicant_apt_ste_flr' => $request->applicant_apt_ste_flr,
                'applicant_date_resided_from' => $request->applicant_date_resided_from,
                'use_mailing_address' => $request->has('use_mailing_address') ? 1 : 0,
                'mailing_street' => $request->mailing_street,
                'mailing_city' => $request->mailing_city,
                'mailing_state' => $request->mailing_state,
                'mailing_zip' => $request->mailing_zip,
                'mailing_in_care_of' => $request->mailing_in_care_of,
                'mailing_apt_ste_flr' => $request->mailing_apt_ste_flr,
                'resided_at_current_address_5_years' => $request->has('resided_at_current_address_5_years') ? ($request->resided_at_current_address_5_years == 1 ? 1 : 0) : null,
                'foreign_address_data' => $request->foreign_address_data,
                'prior_addresses_data' => $request->prior_addresses_data,
                'most_recent_foreign_address' => $request->most_recent_foreign_address,
                'applicant_address_history' => $request->applicant_address_history,
                'applicant_dob' => $request->applicant_dob,
                'has_other_dob' => $request->has('has_other_dob') ? 1 : 0,
                'other_dobs' => $request->other_dobs,
                'applicant_place_of_birth' => $request->applicant_place_of_birth,
                'applicant_birth_country' => $request->applicant_birth_country,
                'applicant_citizenship' => $request->applicant_citizenship,
                'applicant_alien_number' => $request->applicant_alien_number,
                'uscis_account_number' => $request->uscis_account_number,
                'applicant_ssn' => $request->applicant_ssn,
                'immigration_entry_status' => match($request->immigration_entry_type) {
                    'admitted' => $request->immigration_entry_status_admitted,
                    'paroled' => $request->immigration_entry_status_paroled,
                    'other' => $request->immigration_entry_status_other,
                    default => $request->immigration_entry_status,
                },
                'ssa_ever_issued_card' => $request->has('ssa_ever_issued_card') ? ($request->ssa_ever_issued_card == 1 ? 1 : 0) : null,
                'ssa_issue_card_request' => $request->has('ssa_issue_card_request') ? ($request->ssa_issue_card_request == 1 ? 1 : 0) : null,
                'ssa_consent_disclosure' => $request->has('ssa_consent_disclosure') ? 1 : 0,
                'applicant_gender' => $request->applicant_gender,
                'applicant_employment_status' => $request->applicant_employment_status,
                'applicant_employer_name' => $request->applicant_employer_name,
                'applicant_occupation' => $request->applicant_occupation,
                'applicant_employment_history' => $request->applicant_employment_history,

                // Biographic Information
                'ethnicity' => $request->ethnicity,
                'race' => $request->race,
                'height_feet' => $request->height_feet,
                'height_inches' => $request->height_inches,
                'weight_pounds' => $request->weight_pounds,
                'eye_color' => $request->eye_color,
                'hair_color' => $request->hair_color,

                // Family Information
                'parent1_data' => $request->parent1_data,
                'parent2_data' => $request->parent2_data,
                'times_married' => $request->times_married,
                'marital_history' => $request->marital_history,
                'has_children' => $request->has('has_children') ? 1 : 0,
                'children_data' => $request->children_data,
                
                // Immigration Status
                'current_visa_type' => $request->current_visa_type,
                'visa_expiration_date' => $request->visa_expiration_date,
                'i94_number' => $request->i94_number,
                'passport_number' => $request->passport_number,
                'passport_country' => $request->passport_country,
                'passport_expiration' => $request->passport_expiration,
                'entry_date' => $request->entry_date,
                'entry_location' => $request->entry_location,
                'status_at_last_entry' => $request->status_at_last_entry,
                'i94_expiration_date' => $request->i94_expiration_date,
                'i94_last_name' => $request->i94_last_name,
                'i94_first_name' => $request->i94_first_name,
                'i94_expiration_date_ds' => $request->has('i94_expiration_date_ds') ? 1 : 0,
                'i94_status' => $request->i94_status,
                'was_last_arrival_first_time' => $request->has('was_last_arrival_first_time') ? ($request->was_last_arrival_first_time == 1 ? 1 : 0) : null,
                'current_immigration_status' => $request->current_immigration_status,
                'current_immigration_status_expiration_date' => $request->current_immigration_status_expiration_date,
                'current_immigration_status_ds' => $request->has('current_immigration_status_ds') ? 1 : 0,
                'ever_issued_alien_crewman_visa' => $request->has('ever_issued_alien_crewman_visa') ? ($request->ever_issued_alien_crewman_visa == 1 ? 1 : 0) : null,
                'last_arrival_as_crewman' => $request->has('last_arrival_as_crewman') ? ($request->last_arrival_as_crewman == 1 ? 1 : 0) : null,
                
                // Part 2: Application Type or Filing Category
                'filing_category' => $request->filing_category,
                'immigrant_category' => $request->immigrant_category,
                'immigrant_category_detail' => $request->immigrant_category_detail,
                'receipt_number_underlying_petition' => $request->receipt_number_underlying_petition,
                'priority_date' => $request->priority_date,
                'is_principal_applicant' => $request->has('is_principal_applicant') ? 1 : 0,
                'filing_with_eoir' => $request->has('filing_with_eoir') ? ($request->filing_with_eoir == 1 ? 1 : 0) : null,
                'derivative_principal_first_name' => $request->derivative_principal_first_name,
                'derivative_principal_last_name' => $request->derivative_principal_last_name,
                'derivative_principal_middle_name' => $request->derivative_principal_middle_name,
                'derivative_principal_a_number' => $request->derivative_principal_a_number,
                'derivative_principal_dob' => $request->derivative_principal_dob,
                
                // Sponsor Information
                'sponsor_first_name' => $request->sponsor_first_name,
                'sponsor_middle_name' => $request->sponsor_middle_name,
                'sponsor_last_name' => $request->sponsor_last_name,
                'sponsor_email' => $request->sponsor_email,
                'sponsor_phone' => $request->sponsor_phone,
                'sponsor_address' => $request->sponsor_address,
                'sponsor_city' => $request->sponsor_city,
                'sponsor_state' => $request->sponsor_state,
                'sponsor_zip' => $request->sponsor_zip,
                'sponsor_relationship' => $request->sponsor_relationship,
                'sponsor_citizenship_status' => $request->sponsor_citizenship_status,
                'sponsor_ssn' => $request->sponsor_ssn,
                
                // Marital Information
                'marital_status' => $request->marital_status,
                'marriage_date' => $request->marriage_date,
                'spouse_name' => $request->spouse_name,
                
                // Background & Complex Questions
                'arrested_or_convicted' => $request->arrested_or_convicted,
                'immigration_violations' => $request->immigration_violations,
                'public_assistance' => $request->public_assistance,
                'background_explanation' => $request->background_explanation,
                'eligibility_questions' => $request->eligibility_questions,
                'part9_data' => $request->part9_data,
                'part9_explanation' => $request->part9_explanation,
                'accommodation_details' => $request->accommodation_details,
                'applicant_statement_data' => $request->applicant_statement_data,
                'interpreter_data' => $request->interpreter_data,
                'preparer_data' => $request->preparer_data,
                
                // Part 2 Detail Data
                'employment_categories_data' => $request->employment_categories_data,
                'special_immigrant_categories_data' => $request->special_immigrant_categories_data,
                'asylee_refugee_data' => $request->asylee_refugee_data,
                'trafficking_crime_victim_data' => $request->trafficking_crime_victim_data,
                'special_program_categories_data' => $request->special_program_categories_data,
                'additional_options_data' => $request->additional_options_data,
                'applying_under_245i' => $request->has('applying_under_245i') ? ($request->applying_under_245i == 1 ? 1 : 0) : null,
                'applying_under_cspa' => $request->has('applying_under_cspa') ? ($request->applying_under_cspa == 1 ? 1 : 0) : null,
                'i864_exemption' => $request->i864_exemption,
                'applied_for_immigrant_visa_abroad' => $request->has('applied_for_immigrant_visa_abroad') ? ($request->applied_for_immigrant_visa_abroad == 1 ? 1 : 0) : null,
                'immigrant_visa_location_city' => $request->immigrant_visa_location_city,
                'immigrant_visa_location_country' => $request->immigrant_visa_location_country,
                'immigrant_visa_decision' => $request->immigrant_visa_decision,
                'immigrant_visa_decision_date' => $request->immigrant_visa_decision_date,
                'applied_for_permanent_residence_us' => $request->has('applied_for_permanent_residence_us') ? ($request->applied_for_permanent_residence_us == 1 ? 1 : 0) : null,
                'rescinded_lpr_status' => $request->has('rescinded_lpr_status') ? ($request->rescinded_lpr_status == 1 ? 1 : 0) : null,
                
                'status' => 'draft'
            ];

            $application = SimplifiedAosApplication::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'submitted_app_id' => $request->submitted_app_id
                ],
                $applicationData
            );

            DB::commit();
            
            Log::info('AOS application saved', [
                'user_id' => Auth::id(),
                'application_id' => $application->id
            ]);

            return $application;
            
        } catch (\Exception $e) {
            DB::rollback();
            
            Log::error('Error in saveApplication', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            throw $e;
        }
    }

    public function calculateCompletion($application)
    {
        if (!$application) {
            return 0;
        }

        $fields = [
            // Part 1: Applicant (Personal & Biographics)
            'applicant_first_name', 'applicant_last_name', 'applicant_email',
            'applicant_phone', 'applicant_mobile_phone', 'applicant_address', 
            'applicant_city', 'applicant_state', 'applicant_zip', 'applicant_dob',
            'applicant_place_of_birth', 'applicant_birth_country', 'applicant_citizenship', 'applicant_gender',
            
            // Part 2: Filing Category
            'immigrant_category',
            
            // Part 3: Exemption (Affidavit of Support)
            'i864_exemption',
            
            // Part 4: History (Address & Employment)
            'applicant_employment_history',
            
            // Part 5 & 6: Family
            'parent1_data', 'parent2_data',
            
            // Part 7: Marital History
            'marital_status',
            
            // Information About Your Children
            'has_children',
            
            // Biographic Information
            'ethnicity', 'race', 'height_feet', 'height_inches', 'weight_pounds',
            
            // Part 9: General Eligibility
            'part9_data',
            
            // Immigration Status detail fields (Passport/I-94)
            'passport_number', 'passport_issuing_country', 'passport_expiration_date', 
            'last_arrival_date', 'last_arrival_city', 'immigration_entry_type', 
            'i94_number', 'i94_expiration_date', 'current_immigration_status',
            
            // Sponsor Information
            'sponsor_first_name', 'sponsor_last_name', 'sponsor_relationship',
            'sponsor_citizenship_status',
        ];

        $completedCount = 0;
        $missingFields = [];

        foreach ($fields as $field) {
            $value = $application->$field;
            // Count as complete if not empty (including 'N/A' which means it's addressed)
            if ($value !== null && $value !== '') {
                $completedCount++;
            } else {
                $missingFields[] = $field;
            }
        }

        // Add check for interpreter and preparer data (which are arrays)
        if (!empty($application->interpreter_data['used_interpreter'])) {
            $completedCount++;
        }
        if (!empty($application->preparer_data['used_preparer'])) {
            $completedCount++;
        }

        $totalCount = count($fields) + 2; // + interpreter + preparer toggles
        $percentage = round(($completedCount / $totalCount) * 100);

        return $percentage;
    }

    /**
     * Submit the application
     */
    public function submitApplication($application)
    {
        DB::beginTransaction();

        try {
            $application->update([
                'status' => 'submitted',
                'submitted_at' => now()
            ]);

            UserSubmittedApplication::where('id', $application->submitted_app_id)
                ->update([
                    'status' => 'submitted',
                    'submitted_at' => now()
                ]);

            DB::commit();
            
            Log::info('AOS application submitted', [
                'user_id' => $application->user_id,
                'application_id' => $application->id
            ]);
            
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}