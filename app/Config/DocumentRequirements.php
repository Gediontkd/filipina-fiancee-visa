<?php
// app/Config/DocumentRequirements.php

namespace App\Config;

class DocumentRequirements
{
    /**
     * Get document requirements for specific visa type
     *
     * @param string $visaType
     * @return array
     */
    public static function getRequirements(string $visaType): array
    {
        $requirements = [
            'fiance' => self::getFianceVisaRequirements(),
            'spouse' => self::getSpouseVisaRequirements(),
            'child' => self::getChildVisaRequirements(),
            'adjustment' => self::getAdjustmentOfStatusRequirements(),
            'roc' => self::getRemovalOfConditionsRequirements(),
            'naturalization' => self::getNaturalizationRequirements(),
        ];

        return $requirements[strtolower($visaType)] ?? [];
    }

    /**
     * K-1 Fiancé(e) Visa Requirements
     */
    private static function getFianceVisaRequirements(): array
    {
        return [
            'petitioner' => [
                'label' => 'U.S. Petitioner Documents',
                'documents' => [
                    [
                        'id' => 'petitioner_citizenship',
                        'name' => 'U.S. Citizenship Proof',
                        'description' => 'Birth certificate, passport, or naturalization certificate',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'petitioner_income',
                        'name' => 'Income Proof',
                        'description' => 'Recent pay stubs, tax returns, or employment letter',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'petitioner_relationship_evidence',
                        'name' => 'Relationship Evidence',
                        'description' => 'Photos together, travel records, communication logs',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'petitioner_prior_marriage',
                        'name' => 'Prior Marriage Termination',
                        'description' => 'Divorce decree or death certificate (if applicable)',
                        'required' => false,
                        'multiple' => true,
                    ],
                ],
            ],
            'beneficiary' => [
                'label' => 'Beneficiary (Fiancé/Fiancée) Documents',
                'documents' => [
                    [
                        'id' => 'beneficiary_birth_certificate',
                        'name' => 'Birth Certificate',
                        'description' => 'Original or certified copy with English translation',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'beneficiary_passport_photo',
                        'name' => 'Passport Photo',
                        'description' => '2x2 inches, recent photo meeting U.S. visa requirements',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'beneficiary_prior_marriage',
                        'name' => 'Prior Marriage Termination',
                        'description' => 'Divorce decree or death certificate (if applicable)',
                        'required' => false,
                        'multiple' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * CR-1 / IR-1 Spousal Visa Requirements
     */
    private static function getSpouseVisaRequirements(): array
    {
        return [
            'petitioner' => [
                'label' => 'U.S. Petitioner Documents',
                'documents' => [
                    [
                        'id' => 'petitioner_citizenship',
                        'name' => 'U.S. Citizenship Proof',
                        'description' => 'Birth certificate, passport, or naturalization certificate',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'petitioner_tax_returns',
                        'name' => 'Tax Returns (Form 1040)',
                        'description' => 'Last 3 years with W-2 or 1099 forms',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'petitioner_prior_marriage',
                        'name' => 'Prior Marriage Termination',
                        'description' => 'Divorce decree or death certificate (if applicable)',
                        'required' => false,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'petitioner_military_records',
                        'name' => 'Military Records',
                        'description' => 'DD-214 or service records (if applicable)',
                        'required' => false,
                        'multiple' => false,
                    ],
                ],
            ],
            'beneficiary' => [
                'label' => 'Beneficiary (Spouse) Documents',
                'documents' => [
                    [
                        'id' => 'beneficiary_birth_certificate_psa',
                        'name' => 'Birth Certificate (PSA)',
                        'description' => 'PSA-certified birth certificate',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'beneficiary_marriage_certificate_psa',
                        'name' => 'Marriage Certificate (PSA)',
                        'description' => 'PSA-certified marriage certificate',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'beneficiary_passport_bio',
                        'name' => 'Passport Bio Page',
                        'description' => 'Copy of passport biographical page',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'beneficiary_passport_photo',
                        'name' => 'Passport Photo',
                        'description' => '2x2 inches, recent photo meeting U.S. visa requirements',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'beneficiary_prior_marriage',
                        'name' => 'Prior Marriage Termination',
                        'description' => 'Divorce decree or death certificate (if applicable)',
                        'required' => false,
                        'multiple' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * CR-2 / IR-2 Child Visa Requirements
     */
    private static function getChildVisaRequirements(): array
    {
        return [
            'petitioner' => [
                'label' => 'U.S. Petitioner Documents',
                'documents' => [
                    [
                        'id' => 'petitioner_citizenship',
                        'name' => 'U.S. Citizenship Proof',
                        'description' => 'Birth certificate, passport, or naturalization certificate',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'petitioner_tax_returns',
                        'name' => 'Tax Returns',
                        'description' => 'Recent tax returns with W-2 forms',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'petitioner_i864a',
                        'name' => 'Form I-864A',
                        'description' => 'If using joint sponsor',
                        'required' => false,
                        'multiple' => false,
                    ],
                ],
            ],
            'beneficiary' => [
                'label' => 'Child Beneficiary Documents',
                'documents' => [
                    [
                        'id' => 'child_birth_certificate',
                        'name' => 'Birth Certificate',
                        'description' => 'PSA-certified birth certificate',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'child_passport_bio',
                        'name' => 'Passport Bio Page',
                        'description' => 'Copy of passport biographical page',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'child_relationship_proof',
                        'name' => 'Proof of Relationship',
                        'description' => 'Documents proving relationship to U.S. citizen',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'child_passport_photo',
                        'name' => 'Passport Photo',
                        'description' => '2x2 inches, recent photo',
                        'required' => true,
                        'multiple' => false,
                    ],
                ],
            ],
        ];
    }

    /**
     * AOS (Adjustment of Status) Requirements
     */
    private static function getAdjustmentOfStatusRequirements(): array
    {
        return [
            'petitioner' => [
                'label' => 'U.S. Sponsor Documents',
                'documents' => [
                    [
                        'id' => 'sponsor_citizenship_proof',
                        'name' => 'Citizenship Proof',
                        'description' => 'Birth certificate, passport, or naturalization certificate',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'sponsor_tax_returns',
                        'name' => 'Tax Returns (Form 1040)',
                        'description' => 'Last 3 years with W-2 forms',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'sponsor_pay_stubs',
                        'name' => 'Recent Pay Stubs',
                        'description' => 'Last 6 months of pay stubs',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'sponsor_employment_letter',
                        'name' => 'Employment Verification Letter',
                        'description' => 'Letter from employer verifying employment and salary',
                        'required' => true,
                        'multiple' => false,
                    ],
                ],
            ],
            'beneficiary' => [
                'label' => 'Applicant Documents',
                'documents' => [
                    [
                        'id' => 'applicant_passport_bio',
                        'name' => 'Passport Bio Page',
                        'description' => 'Copy of current passport biographical page',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'applicant_visa_entry',
                        'name' => 'Visa Entry Stamp',
                        'description' => 'Copy of visa stamp from passport',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'applicant_i94',
                        'name' => 'I-94 Arrival/Departure Record',
                        'description' => 'Print from CBP website or paper form',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'applicant_marriage_certificate',
                        'name' => 'Marriage Certificate',
                        'description' => 'PSA-certified marriage certificate',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'applicant_birth_certificate',
                        'name' => 'Birth Certificate',
                        'description' => 'PSA-certified birth certificate',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'applicant_medical_exam',
                        'name' => 'Medical Examination (Form I-693)',
                        'description' => 'Sealed envelope from civil surgeon',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'applicant_passport_photos',
                        'name' => 'Passport Photos (6 copies)',
                        'description' => '2x2 inches, recent photos',
                        'required' => true,
                        'multiple' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * ROC (Removal of Conditions) Requirements
     */
    private static function getRemovalOfConditionsRequirements(): array
    {
        return [
            'joint_evidence' => [
                'label' => 'Joint Evidence (Both Spouses)',
                'documents' => [
                    [
                        'id' => 'joint_bank_statements',
                        'name' => 'Joint Bank Statements',
                        'description' => 'Last 2 years of joint account statements',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'joint_lease_mortgage',
                        'name' => 'Joint Lease/Mortgage',
                        'description' => 'Current lease or mortgage with both names',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'utility_bills',
                        'name' => 'Utility Bills',
                        'description' => 'Bills showing both names at same address',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'insurance_policies',
                        'name' => 'Insurance Policies',
                        'description' => 'Joint health, auto, or life insurance',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'photos_together',
                        'name' => 'Photos Together',
                        'description' => 'Recent photos from throughout the marriage',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'joint_tax_returns',
                        'name' => 'Joint Tax Returns',
                        'description' => 'Last 2 years of joint tax filings',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'joint_travel_records',
                        'name' => 'Joint Travel Records',
                        'description' => 'Tickets, boarding passes, hotel reservations',
                        'required' => false,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'children_birth_certificates',
                        'name' => 'Children\'s Birth Certificates',
                        'description' => 'If you have children together',
                        'required' => false,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'affidavits',
                        'name' => 'Affidavits from Third Parties',
                        'description' => 'Letters from friends/family attesting to marriage',
                        'required' => false,
                        'multiple' => true,
                    ],
                ],
            ],
        ];
    }

    /**
     * N-400 Naturalization Requirements
     */
    private static function getNaturalizationRequirements(): array
    {
        return [
            'applicant' => [
                'label' => 'Applicant Documents',
                'documents' => [
                    [
                        'id' => 'green_card_copy',
                        'name' => 'Green Card (Front & Back)',
                        'description' => 'Clear copy of permanent resident card',
                        'required' => true,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'marriage_documentation',
                        'name' => 'Marriage Documentation',
                        'description' => 'Marriage certificate (if applicable)',
                        'required' => false,
                        'multiple' => false,
                    ],
                    [
                        'id' => 'travel_history',
                        'name' => 'Travel History',
                        'description' => 'List of all trips outside U.S. (6+ months)',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'tax_returns_transcripts',
                        'name' => 'Tax Returns/Transcripts',
                        'description' => 'Last 5 years of tax documentation',
                        'required' => true,
                        'multiple' => true,
                    ],
                    [
                        'id' => 'passport_photos',
                        'name' => 'Passport Photos (2 copies)',
                        'description' => '2x2 inches, recent photos',
                        'required' => true,
                        'multiple' => false,
                    ],
                ],
            ],
        ];
    }

    /**
     * Get all available visa types
     *
     * @return array
     */
    public static function getAvailableVisaTypes(): array
    {
        return [
            'fiance' => 'K-1 Fiancé(e) Visa',
            'spouse' => 'CR-1/IR-1 Spousal Visa',
            'child' => 'CR-2/IR-2 Child Visa',
            'adjustment' => 'Adjustment of Status (I-485)',
            'roc' => 'Removal of Conditions (I-751)',
            'naturalization' => 'Naturalization (N-400)',
        ];
    }

    /**
     * Get document category label
     *
     * @param string $category
     * @return string
     */
    public static function getCategoryLabel(string $category): string
    {
        $labels = [
            'petitioner' => 'U.S. Petitioner/Sponsor',
            'beneficiary' => 'Beneficiary/Applicant',
            'joint_evidence' => 'Joint Evidence',
            'applicant' => 'Applicant',
        ];

        return $labels[$category] ?? ucfirst($category);
    }
}