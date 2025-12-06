<?php
// database/seeders/DocumentRequirementsSeeder.php - FIXED VERSION

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\DocumentCategory;
use App\Models\DocumentType;

class DocumentRequirementsSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing data
        DocumentType::truncate();
        DocumentCategory::truncate();
        
        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->seedFianceVisa();
        $this->seedSpouseVisa();
        $this->seedChildVisa();
        $this->seedAdjustmentOfStatus();
        $this->seedRemovalOfConditions();
        $this->seedNaturalization();
        
        $this->command->info('✅ Document requirements seeded successfully!');
    }

    private function seedFianceVisa(): void
    {
        // Petitioner Category
        $petitioner = DocumentCategory::create([
            'visa_type' => 'fiance',
            'category_key' => 'petitioner',
            'category_label' => 'U.S. Petitioner Documents',
            'description' => 'Documents required from the U.S. citizen petitioner',
            'sort_order' => 1,
        ]);

        $petitionerDocs = [
            ['type_key' => 'petitioner_citizenship', 'name' => 'U.S. Citizenship Proof', 'description' => 'Birth certificate, passport, or naturalization certificate', 'instructions' => 'Must be a clear, readable copy', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 1],
            ['type_key' => 'petitioner_income', 'name' => 'Income Proof', 'description' => 'Recent pay stubs, tax returns, or employment letter', 'instructions' => 'Must show income above poverty guidelines', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 2],
            ['type_key' => 'petitioner_relationship_evidence', 'name' => 'Relationship Evidence', 'description' => 'Photos together, travel records, communication logs', 'instructions' => 'Photos should span the entire relationship', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 3],
            ['type_key' => 'petitioner_prior_marriage', 'name' => 'Prior Marriage Termination', 'description' => 'Divorce decree or death certificate (if applicable)', 'instructions' => 'Only if previously married', 'is_required' => false, 'allow_multiple' => true, 'sort_order' => 4],
        ];

        foreach ($petitionerDocs as $doc) {
            DocumentType::create(array_merge(['category_id' => $petitioner->id], $doc));
        }

        // Beneficiary Category
        $beneficiary = DocumentCategory::create([
            'visa_type' => 'fiance',
            'category_key' => 'beneficiary',
            'category_label' => 'Beneficiary (Fiancé/Fiancée) Documents',
            'description' => 'Documents required from the foreign fiancé/fiancée',
            'sort_order' => 2,
        ]);

        $beneficiaryDocs = [
            ['type_key' => 'beneficiary_birth_certificate', 'name' => 'Birth Certificate', 'description' => 'Original or certified copy with English translation', 'instructions' => 'PSA-certified if from Philippines', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 1],
            ['type_key' => 'beneficiary_passport_photo', 'name' => 'Passport Photo', 'description' => '2x2 inches, recent photo meeting U.S. visa requirements', 'instructions' => 'White background, recent photo', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 2],
            ['type_key' => 'beneficiary_prior_marriage', 'name' => 'Prior Marriage Termination', 'description' => 'Divorce decree or death certificate (if applicable)', 'instructions' => 'Only if previously married', 'is_required' => false, 'allow_multiple' => true, 'sort_order' => 3],
        ];

        foreach ($beneficiaryDocs as $doc) {
            DocumentType::create(array_merge(['category_id' => $beneficiary->id], $doc));
        }
    }

    private function seedSpouseVisa(): void
    {
        // Petitioner Category
        $petitioner = DocumentCategory::create([
            'visa_type' => 'spouse',
            'category_key' => 'petitioner',
            'category_label' => 'U.S. Petitioner Documents',
            'description' => 'Documents required from the U.S. citizen sponsor',
            'sort_order' => 1,
        ]);

        $petitionerDocs = [
            ['type_key' => 'petitioner_citizenship', 'name' => 'U.S. Citizenship Proof', 'description' => 'Birth certificate, passport, or naturalization certificate', 'instructions' => 'Clear, readable copy required', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 1],
            ['type_key' => 'petitioner_tax_returns', 'name' => 'Tax Returns (Form 1040)', 'description' => 'Last 3 years with W-2 or 1099 forms', 'instructions' => 'Include all schedules and forms', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 2],
            ['type_key' => 'petitioner_prior_marriage', 'name' => 'Prior Marriage Termination', 'description' => 'Divorce decree or death certificate (if applicable)', 'instructions' => 'Final divorce decree required', 'is_required' => false, 'allow_multiple' => true, 'sort_order' => 3],
            ['type_key' => 'petitioner_military_records', 'name' => 'Military Records', 'description' => 'DD-214 or service records (if applicable)', 'instructions' => 'Only if currently or previously served', 'is_required' => false, 'allow_multiple' => false, 'sort_order' => 4],
        ];

        foreach ($petitionerDocs as $doc) {
            DocumentType::create(array_merge(['category_id' => $petitioner->id], $doc));
        }

        // Beneficiary Category
        $beneficiary = DocumentCategory::create([
            'visa_type' => 'spouse',
            'category_key' => 'beneficiary',
            'category_label' => 'Beneficiary (Spouse) Documents',
            'description' => 'Documents required from the foreign spouse',
            'sort_order' => 2,
        ]);

        $beneficiaryDocs = [
            ['type_key' => 'beneficiary_birth_certificate_psa', 'name' => 'Birth Certificate (PSA)', 'description' => 'PSA-certified birth certificate', 'instructions' => 'Original PSA seal required', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 1],
            ['type_key' => 'beneficiary_marriage_certificate_psa', 'name' => 'Marriage Certificate (PSA)', 'description' => 'PSA-certified marriage certificate', 'instructions' => 'Original PSA seal required', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 2],
            ['type_key' => 'beneficiary_passport_bio', 'name' => 'Passport Bio Page', 'description' => 'Copy of passport biographical page', 'instructions' => 'Must be valid for at least 6 months', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 3],
            ['type_key' => 'beneficiary_passport_photo', 'name' => 'Passport Photo', 'description' => '2x2 inches, recent photo meeting U.S. visa requirements', 'instructions' => 'White background, recent (within 6 months)', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 4],
            ['type_key' => 'beneficiary_prior_marriage', 'name' => 'Prior Marriage Termination', 'description' => 'Divorce decree or death certificate (if applicable)', 'instructions' => 'Only if previously married', 'is_required' => false, 'allow_multiple' => true, 'sort_order' => 5],
        ];

        foreach ($beneficiaryDocs as $doc) {
            DocumentType::create(array_merge(['category_id' => $beneficiary->id], $doc));
        }
    }

    private function seedChildVisa(): void
    {
        $petitioner = DocumentCategory::create([
            'visa_type' => 'child',
            'category_key' => 'petitioner',
            'category_label' => 'U.S. Petitioner Documents',
            'description' => 'Documents from U.S. citizen parent',
            'sort_order' => 1,
        ]);

        $petitionerDocs = [
            ['type_key' => 'petitioner_citizenship', 'name' => 'U.S. Citizenship Proof', 'description' => 'Birth certificate, passport, or naturalization certificate', 'instructions' => null, 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 1],
            ['type_key' => 'petitioner_tax_returns', 'name' => 'Tax Returns', 'description' => 'Recent tax returns with W-2 forms', 'instructions' => null, 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 2],
            ['type_key' => 'petitioner_i864a', 'name' => 'Form I-864A', 'description' => 'If using joint sponsor', 'instructions' => 'Only if income is insufficient', 'is_required' => false, 'allow_multiple' => false, 'sort_order' => 3],
        ];

        foreach ($petitionerDocs as $doc) {
            DocumentType::create(array_merge(['category_id' => $petitioner->id], $doc));
        }

        $beneficiary = DocumentCategory::create([
            'visa_type' => 'child',
            'category_key' => 'beneficiary',
            'category_label' => 'Child Beneficiary Documents',
            'description' => 'Documents for the child',
            'sort_order' => 2,
        ]);

        $beneficiaryDocs = [
            ['type_key' => 'child_birth_certificate', 'name' => 'Birth Certificate', 'description' => 'PSA-certified birth certificate', 'instructions' => 'Original PSA seal required', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 1],
            ['type_key' => 'child_passport_bio', 'name' => 'Passport Bio Page', 'description' => 'Copy of passport biographical page', 'instructions' => null, 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 2],
            ['type_key' => 'child_relationship_proof', 'name' => 'Proof of Relationship', 'description' => 'Documents proving relationship to U.S. citizen', 'instructions' => 'May include photos, school records', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 3],
            ['type_key' => 'child_passport_photo', 'name' => 'Passport Photo', 'description' => '2x2 inches, recent photo', 'instructions' => null, 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 4],
        ];

        foreach ($beneficiaryDocs as $doc) {
            DocumentType::create(array_merge(['category_id' => $beneficiary->id], $doc));
        }
    }

    private function seedAdjustmentOfStatus(): void
    {
        $sponsor = DocumentCategory::create([
            'visa_type' => 'adjustment',
            'category_key' => 'petitioner',
            'category_label' => 'U.S. Sponsor Documents',
            'description' => 'Documents from U.S. citizen sponsor',
            'sort_order' => 1,
        ]);

        $sponsorDocs = [
            ['type_key' => 'sponsor_citizenship_proof', 'name' => 'Citizenship Proof', 'description' => 'Birth certificate, passport, or naturalization certificate', 'instructions' => null, 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 1],
            ['type_key' => 'sponsor_tax_returns', 'name' => 'Tax Returns (Form 1040)', 'description' => 'Last 3 years with W-2 forms', 'instructions' => 'Include all schedules', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 2],
            ['type_key' => 'sponsor_pay_stubs', 'name' => 'Recent Pay Stubs', 'description' => 'Last 6 months of pay stubs', 'instructions' => 'Most recent 6 pay stubs', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 3],
            ['type_key' => 'sponsor_employment_letter', 'name' => 'Employment Verification Letter', 'description' => 'Letter from employer verifying employment and salary', 'instructions' => 'On company letterhead', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 4],
        ];

        foreach ($sponsorDocs as $doc) {
            DocumentType::create(array_merge(['category_id' => $sponsor->id], $doc));
        }

        $applicant = DocumentCategory::create([
            'visa_type' => 'adjustment',
            'category_key' => 'beneficiary',
            'category_label' => 'Applicant Documents',
            'description' => 'Documents from adjustment of status applicant',
            'sort_order' => 2,
        ]);

        $applicantDocs = [
            ['type_key' => 'applicant_passport_bio', 'name' => 'Passport Bio Page', 'description' => 'Copy of current passport biographical page', 'instructions' => null, 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 1],
            ['type_key' => 'applicant_visa_entry', 'name' => 'Visa Entry Stamp', 'description' => 'Copy of visa stamp from passport', 'instructions' => 'Entry stamp to United States', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 2],
            ['type_key' => 'applicant_i94', 'name' => 'I-94 Arrival/Departure Record', 'description' => 'Print from CBP website or paper form', 'instructions' => 'Get from cbp.gov/i94', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 3],
            ['type_key' => 'applicant_marriage_certificate', 'name' => 'Marriage Certificate', 'description' => 'PSA-certified marriage certificate', 'instructions' => 'Original PSA seal required', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 4],
            ['type_key' => 'applicant_birth_certificate', 'name' => 'Birth Certificate', 'description' => 'PSA-certified birth certificate', 'instructions' => 'Original PSA seal required', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 5],
            ['type_key' => 'applicant_medical_exam', 'name' => 'Medical Examination (Form I-693)', 'description' => 'Sealed envelope from civil surgeon', 'instructions' => 'Must be sealed - do not open', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 6],
            ['type_key' => 'applicant_passport_photos', 'name' => 'Passport Photos (6 copies)', 'description' => '2x2 inches, recent photos', 'instructions' => 'White background, identical photos', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 7],
        ];

        foreach ($applicantDocs as $doc) {
            DocumentType::create(array_merge(['category_id' => $applicant->id], $doc));
        }
    }

    private function seedRemovalOfConditions(): void
    {
        $jointEvidence = DocumentCategory::create([
            'visa_type' => 'roc',
            'category_key' => 'joint_evidence',
            'category_label' => 'Joint Evidence (Both Spouses)',
            'description' => 'Documents showing joint life together',
            'sort_order' => 1,
        ]);

        $docs = [
            ['type_key' => 'joint_bank_statements', 'name' => 'Joint Bank Statements', 'description' => 'Last 2 years of joint account statements', 'instructions' => 'Highlight both names on statements', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 1],
            ['type_key' => 'joint_lease_mortgage', 'name' => 'Joint Lease/Mortgage', 'description' => 'Current lease or mortgage with both names', 'instructions' => 'Both names must appear', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 2],
            ['type_key' => 'utility_bills', 'name' => 'Utility Bills', 'description' => 'Bills showing both names at same address', 'instructions' => 'Electric, gas, water, etc.', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 3],
            ['type_key' => 'insurance_policies', 'name' => 'Insurance Policies', 'description' => 'Joint health, auto, or life insurance', 'instructions' => 'Showing both as covered', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 4],
            ['type_key' => 'photos_together', 'name' => 'Photos Together', 'description' => 'Recent photos from throughout the marriage', 'instructions' => 'Date and label each photo', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 5],
            ['type_key' => 'joint_tax_returns', 'name' => 'Joint Tax Returns', 'description' => 'Last 2 years of joint tax filings', 'instructions' => 'Filed as married filing jointly', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 6],
            ['type_key' => 'joint_travel_records', 'name' => 'Joint Travel Records', 'description' => 'Tickets, boarding passes, hotel reservations', 'instructions' => 'Shows travel together', 'is_required' => false, 'allow_multiple' => true, 'sort_order' => 7],
            ['type_key' => 'children_birth_certificates', 'name' => 'Children\'s Birth Certificates', 'description' => 'If you have children together', 'instructions' => 'Only if applicable', 'is_required' => false, 'allow_multiple' => true, 'sort_order' => 8],
            ['type_key' => 'affidavits', 'name' => 'Affidavits from Third Parties', 'description' => 'Letters from friends/family attesting to marriage', 'instructions' => 'From people who know you both', 'is_required' => false, 'allow_multiple' => true, 'sort_order' => 9],
        ];

        foreach ($docs as $doc) {
            DocumentType::create(array_merge(['category_id' => $jointEvidence->id], $doc));
        }
    }

    private function seedNaturalization(): void
    {
        $applicant = DocumentCategory::create([
            'visa_type' => 'naturalization',
            'category_key' => 'applicant',
            'category_label' => 'Applicant Documents',
            'description' => 'Documents for naturalization application',
            'sort_order' => 1,
        ]);

        $docs = [
            ['type_key' => 'green_card_copy', 'name' => 'Green Card (Front & Back)', 'description' => 'Clear copy of permanent resident card', 'instructions' => 'Both sides, readable', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 1],
            ['type_key' => 'marriage_documentation', 'name' => 'Marriage Documentation', 'description' => 'Marriage certificate (if applicable)', 'instructions' => 'Only if married', 'is_required' => false, 'allow_multiple' => false, 'sort_order' => 2],
            ['type_key' => 'travel_history', 'name' => 'Travel History', 'description' => 'List of all trips outside U.S. (6+ months)', 'instructions' => 'Include dates and destinations', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 3],
            ['type_key' => 'tax_returns_transcripts', 'name' => 'Tax Returns/Transcripts', 'description' => 'Last 5 years of tax documentation', 'instructions' => 'IRS transcripts preferred', 'is_required' => true, 'allow_multiple' => true, 'sort_order' => 4],
            ['type_key' => 'passport_photos', 'name' => 'Passport Photos (2 copies)', 'description' => '2x2 inches, recent photos', 'instructions' => 'Identical photos', 'is_required' => true, 'allow_multiple' => false, 'sort_order' => 5],
        ];

        foreach ($docs as $doc) {
            DocumentType::create(array_merge(['category_id' => $applicant->id], $doc));
        }
    }
}