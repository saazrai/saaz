<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D3LegalRegulatoryComplianceSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing items for this domain to prevent duplicates
        $domain = \App\Models\DiagnosticDomain::where('name', 'Legal, Regulatory & Compliance')->first();
        if ($domain) {
            \App\Models\DiagnosticItem::whereHas('topic', function($query) use ($domain) {
                $query->where('domain_id', $domain->id);
            })->forceDelete();
        }

        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Legal, Regulatory & Compliance');
        })->pluck('id', 'name');
        
        
        $items = [
            // Compliance Requirements - Item 1
            [
                'topic_id' => $topics['Compliance Requirements'] ?? 21,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the PRIMARY difference between laws and regulations?',
                'options' => [
                    'Laws are optional, regulations are mandatory',
                    'Laws are created by legislatures, regulations by government agencies',
                    'Laws apply internationally, regulations are local',
                    'Laws are for businesses, regulations for individuals'
                ],
                'correct_options' => ['Laws are created by legislatures, regulations by government agencies'],
                'justifications' => [
                    'Both laws and regulations are mandatory',
                    'Correct - Laws are enacted by legislative bodies while regulations are created by authorized agencies to implement laws',
                    'Both can have local, national, or international scope',
                    'Both apply to businesses and individuals as relevant'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Compliance Requirements - Item 2
            [
                'topic_id' => $topics['Compliance Requirements'] ?? 21,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Compliance with industry standards like ISO 27001 is legally mandatory for all organizations.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. Industry standards like ISO 27001 are voluntary unless specifically required by law, regulation, or contract. However, they may become mandatory through contractual obligations or when referenced by regulations.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Compliance Requirements - Item 3
            [
                'topic_id' => $topics['Compliance Requirements'] ?? 21,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each compliance driver with its source:',
                'options' => [
                    'items' => [
                        'GDPR requirement to appoint a DPO',
                        'Contractual SLA for 99.9% uptime',
                        'Industry best practice for encryption',
                        'Court order for data preservation'
                    ],
                    'responses' => [
                        'Regulatory requirement',
                        'Contractual obligation',
                        'Standard/Framework',
                        'Legal requirement'
                    ]
                ],
                'correct_options' => [
                    'GDPR requirement to appoint a DPO' => 'Regulatory requirement',
                    'Contractual SLA for 99.9% uptime' => 'Contractual obligation',
                    'Industry best practice for encryption' => 'Standard/Framework',
                    'Court order for data preservation' => 'Legal requirement'
                ],
                'justifications' => [
                    'GDPR requirement to appoint a DPO' => 'GDPR is a regulation that mandates DPO appointment for certain organizations',
                    'Contractual SLA for 99.9% uptime' => 'SLAs are contractual commitments between parties',
                    'Industry best practice for encryption' => 'Best practices come from standards and frameworks',
                    'Court order for data preservation' => 'Court orders are legal requirements that must be followed'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Compliance Requirements - Item 4
            [
                'topic_id' => $topics['Compliance Requirements'] ?? 21,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these compliance activities in the order they should be performed:',
                'options' => [
                    'Conduct gap analysis',
                    'Identify applicable requirements',
                    'Implement controls',
                    'Monitor compliance',
                    'Document compliance evidence'
                ],
                'correct_options' => [
                    'Identify applicable requirements',
                    'Conduct gap analysis',
                    'Implement controls',
                    'Document compliance evidence',
                    'Monitor compliance'
                ],
                'justifications' => ['First identify what applies, assess gaps, implement controls to close gaps, document the implementation, then continuously monitor compliance.'],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // GDPR - Item 5
            [
                'topic_id' => $topics['General Data Protection Regulation (GDPR)'] ?? 22,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Under GDPR, what is the maximum fine for the most serious violations?',
                'options' => [
                    '€10 million or 2% of global annual turnover',
                    '€20 million or 4% of global annual turnover',
                    '€50 million or 10% of global annual turnover',
                    '€100 million flat rate'
                ],
                'correct_options' => ['€20 million or 4% of global annual turnover'],
                'justifications' => [
                    'This is the lower tier fine for less serious violations',
                    'Correct - The maximum fine is €20 million or 4% of global annual turnover, whichever is higher',
                    'This exceeds the actual GDPR maximum fines',
                    'GDPR fines are not flat rates but based on turnover'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // GDPR - Item 6
            [
                'topic_id' => $topics['General Data Protection Regulation (GDPR)'] ?? 22,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which of the following is NOT a lawful basis for processing personal data under GDPR?',
                'options' => [
                    'Consent',
                    'Legitimate interest',
                    'Financial benefit',
                    'Legal obligation'
                ],
                'correct_options' => ['Financial benefit'],
                'justifications' => [
                    'Consent is one of the six lawful bases under GDPR',
                    'Legitimate interest is a recognized lawful basis',
                    'Correct - Financial benefit alone is not a lawful basis under GDPR',
                    'Legal obligation is one of the six lawful bases'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // GDPR - Item 7
            [
                'topic_id' => $topics['General Data Protection Regulation (GDPR)'] ?? 22,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the rights that data subjects have under GDPR to the drop zone:',
                'options' => [
                    'Right to be forgotten',
                    'Right to free services',
                    'Right to data portability',
                    'Right to financial compensation',
                    'Right to rectification',
                    'Right to restrict processing'
                ],
                'correct_options' => [
                    'Right to be forgotten',
                    'Right to data portability',
                    'Right to rectification',
                    'Right to restrict processing'
                ],
                'justifications' => [
                    'Also known as right to erasure under GDPR',
                    'GDPR does not guarantee free services',
                    'Allows data subjects to receive their data in portable format',
                    'Compensation requires demonstrating damage',
                    'Right to correct inaccurate personal data',
                    'Right to limit how data is processed'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // GDPR - Item 8
            [
                'topic_id' => $topics['General Data Protection Regulation (GDPR)'] ?? 22,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Within what timeframe must a data breach be reported to the supervisory authority under GDPR?',
                'options' => [
                    '24 hours',
                    '48 hours',
                    '72 hours',
                    '7 days'
                ],
                'correct_options' => ['72 hours'],
                'justifications' => [
                    '24 hours is too short under GDPR requirements',
                    '48 hours is shorter than required',
                    'Correct - GDPR requires notification within 72 hours where feasible',
                    '7 days exceeds the GDPR requirement'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // HIPAA - Item 9
            [
                'topic_id' => $topics['Health Insurance Portability & Accountability Act (HIPAA)'] ?? 23,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which entities are directly subject to HIPAA regulations?',
                'options' => [
                    'Only hospitals and doctors',
                    'Covered entities and business associates',
                    'All businesses that handle any health information',
                    'Only health insurance companies'
                ],
                'correct_options' => ['Covered entities and business associates'],
                'justifications' => [
                    'HIPAA covers more than just hospitals and doctors',
                    'Correct - HIPAA applies to covered entities (providers, plans, clearinghouses) and their business associates',
                    'Not all businesses handling health info are subject to HIPAA',
                    'Health plans are just one type of covered entity'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // HIPAA - Item 10
            [
                'topic_id' => $topics['Health Insurance Portability & Accountability Act (HIPAA)'] ?? 23,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Under HIPAA, patient consent is always required before sharing Protected Health Information (PHI) for treatment purposes.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. HIPAA permits sharing PHI without patient consent for treatment, payment, and healthcare operations (TPO). Consent is generally required for uses beyond TPO, with specific exceptions for public health, law enforcement, and other specified purposes.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // HIPAA - Item 11
            [
                'topic_id' => $topics['Health Insurance Portability & Accountability Act (HIPAA)'] ?? 23,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each HIPAA rule with its primary purpose:',
                'options' => [
                    'items' => [
                        'Privacy Rule',
                        'Security Rule',
                        'Breach Notification Rule',
                        'Enforcement Rule'
                    ],
                    'responses' => [
                        'Protects electronic PHI through administrative, physical, and technical safeguards',
                        'Establishes standards for use and disclosure of PHI',
                        'Requires notification of unsecured PHI breaches',
                        'Sets civil and criminal penalties for violations'
                    ]
                ],
                'correct_options' => [
                    'Privacy Rule' => 'Establishes standards for use and disclosure of PHI',
                    'Security Rule' => 'Protects electronic PHI through administrative, physical, and technical safeguards',
                    'Breach Notification Rule' => 'Requires notification of unsecured PHI breaches',
                    'Enforcement Rule' => 'Sets civil and criminal penalties for violations'
                ],
                'justifications' => [
                    'Privacy Rule' => 'The Privacy Rule governs all forms of PHI and its use/disclosure',
                    'Security Rule' => 'The Security Rule specifically addresses electronic PHI protection',
                    'Breach Notification Rule' => 'This rule mandates breach notifications to affected individuals',
                    'Enforcement Rule' => 'Establishes investigation procedures and penalty structures'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // PCI DSS - Item 12
            [
                'topic_id' => $topics['Payment Card Industry Data Security Standard (PCI DSS)'] ?? 24,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What determines a merchant\'s PCI DSS compliance level?',
                'options' => [
                    'The type of business they operate',
                    'Annual transaction volume',
                    'Geographic location',
                    'Number of employees'
                ],
                'correct_options' => ['Annual transaction volume'],
                'justifications' => [
                    'Business type doesn\'t determine compliance level',
                    'Correct - PCI DSS levels (1-4) are based on annual transaction volume',
                    'Location doesn\'t affect compliance level requirements',
                    'Employee count is not a factor in PCI DSS levels'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // PCI DSS - Item 13
            [
                'topic_id' => $topics['Payment Card Industry Data Security Standard (PCI DSS)'] ?? 24,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the PCI DSS requirements to the drop zone:',
                'options' => [
                    'Install and maintain firewall configuration',
                    'Implement biometric authentication for all users',
                    'Encrypt transmission of cardholder data',
                    'Maintain 10-year audit logs',
                    'Regularly test security systems',
                    'Assign unique ID to each person with computer access'
                ],
                'correct_options' => [
                    'Install and maintain firewall configuration',
                    'Encrypt transmission of cardholder data',
                    'Regularly test security systems',
                    'Assign unique ID to each person with computer access'
                ],
                'justifications' => [
                    'Requirement 1 of PCI DSS',
                    'Biometrics are not mandated by PCI DSS',
                    'Requirement 4 addresses encryption in transit',
                    'PCI DSS requires 1 year minimum, not 10 years',
                    'Requirement 11 covers security testing',
                    'Requirement 8 mandates unique user IDs'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // PCI DSS - Item 14
            [
                'topic_id' => $topics['Payment Card Industry Data Security Standard (PCI DSS)'] ?? 24,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which data elements are considered "sensitive authentication data" that must NEVER be stored after authorization?',
                'options' => [
                    'Cardholder name and expiration date',
                    'Full magnetic stripe data, CVV, and PIN',
                    'Primary account number (PAN) and zip code',
                    'Transaction amount and merchant ID'
                ],
                'correct_options' => ['Full magnetic stripe data, CVV, and PIN'],
                'justifications' => [
                    'These can be stored with proper protection',
                    'Correct - These sensitive authentication data elements must never be stored post-authorization',
                    'PAN can be stored with proper protection; zip code is not sensitive',
                    'Transaction details are not authentication data'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Criminal Law & Civil Law - Item 15
            [
                'topic_id' => $topics['Criminal Law & Civil Law'] ?? 25,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the PRIMARY difference between criminal and civil law proceedings?',
                'options' => [
                    'Criminal law is federal, civil law is state-based',
                    'Criminal law involves prosecution by government, civil law involves disputes between parties',
                    'Criminal law has lower burden of proof than civil law',
                    'Criminal law only applies to businesses, civil to individuals'
                ],
                'correct_options' => ['Criminal law involves prosecution by government, civil law involves disputes between parties'],
                'justifications' => [
                    'Both criminal and civil law exist at federal and state levels',
                    'Correct - Criminal cases are prosecuted by government; civil cases are between private parties',
                    'Criminal law has higher burden of proof (beyond reasonable doubt) than civil (preponderance)',
                    'Both apply to businesses and individuals'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Criminal Law & Civil Law - Item 16
            [
                'topic_id' => $topics['Criminal Law & Civil Law'] ?? 25,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each scenario with the type of legal action:',
                'options' => [
                    'items' => [
                        'Company sued for data breach damages',
                        'Individual prosecuted for hacking',
                        'Contract dispute over SLA violation',
                        'Insider trading prosecution'
                    ],
                    'responses' => [
                        'Civil law',
                        'Criminal law',
                        'Civil law',
                        'Criminal law'
                    ]
                ],
                'correct_options' => [
                    'Company sued for data breach damages' => 'Civil law',
                    'Individual prosecuted for hacking' => 'Criminal law',
                    'Contract dispute over SLA violation' => 'Civil law',
                    'Insider trading prosecution' => 'Criminal law'
                ],
                'justifications' => [
                    'Company sued for data breach damages' => 'Lawsuits for damages are civil matters',
                    'Individual prosecuted for hacking' => 'Prosecution for crimes is criminal law',
                    'Contract dispute over SLA violation' => 'Contract disputes are civil matters',
                    'Insider trading prosecution' => 'Securities fraud prosecution is criminal law'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Criminal Law & Civil Law - Item 17
            [
                'topic_id' => $topics['Criminal Law & Civil Law'] ?? 25,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** A single security incident can result in both criminal prosecution and civil lawsuits.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'True. The same incident can lead to criminal prosecution by the government for law violations AND civil lawsuits by affected parties for damages. For example, a data breach could result in criminal charges for negligence and civil suits from affected customers.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Contractual Obligations & Liability Clauses - Item 18
            [
                'topic_id' => $topics['Contractual Obligations & Liability Clauses'] ?? 26,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What type of clause limits the maximum amount one party must pay for damages?',
                'options' => [
                    'Indemnification clause',
                    'Force majeure clause',
                    'Limitation of liability clause',
                    'Non-disclosure clause'
                ],
                'correct_options' => ['Limitation of liability clause'],
                'justifications' => [
                    'Indemnification shifts liability to another party',
                    'Force majeure excuses performance during extraordinary events',
                    'Correct - Limitation of liability clauses cap the maximum damages payable',
                    'NDAs protect confidential information'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Contractual Obligations & Liability Clauses - Item 19
            [
                'topic_id' => $topics['Contractual Obligations & Liability Clauses'] ?? 26,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the contractual provisions that PROTECT the service provider to the drop zone:',
                'options' => [
                    'Limitation of liability',
                    'Service level agreements',
                    'Force majeure clause',
                    'Penalty clauses',
                    'Disclaimer of warranties',
                    'Right to audit'
                ],
                'correct_options' => [
                    'Limitation of liability',
                    'Force majeure clause',
                    'Disclaimer of warranties'
                ],
                'justifications' => [
                    'Limits financial exposure of service provider',
                    'SLAs typically create obligations for providers',
                    'Excuses performance during unforeseeable events',
                    'Penalties are obligations, not protections',
                    'Limits warranty obligations of provider',
                    'Audit rights benefit the customer, not provider'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Contractual Obligations & Liability Clauses - Item 20
            [
                'topic_id' => $topics['Contractual Obligations & Liability Clauses'] ?? 26,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An MSP\'s contract states they are not liable for "consequential damages." A breach causes a client to lose a major customer. Can the client recover these losses?',
                'options' => [
                    'Yes, because the damage was foreseeable',
                    'No, because loss of business is consequential damage',
                    'Yes, if they can prove gross negligence',
                    'No, unless criminal activity is involved'
                ],
                'correct_options' => ['No, because loss of business is consequential damage'],
                'justifications' => [
                    'Foreseeability doesn\'t override consequential damage exclusions',
                    'Correct - Loss of business/customers is typically considered consequential damage',
                    'Gross negligence might override some limitations but not always',
                    'Criminal activity is separate from contractual limitations'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Intellectual Property - Item 21
            [
                'topic_id' => $topics['Intellectual Property'] ?? 27,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which type of intellectual property protection is automatic upon creation of an original work?',
                'options' => [
                    'Patent',
                    'Trademark',
                    'Copyright',
                    'Trade secret'
                ],
                'correct_options' => ['Copyright'],
                'justifications' => [
                    'Patents require application and approval',
                    'Trademarks require use in commerce or registration',
                    'Correct - Copyright protection is automatic upon creation of original work in tangible form',
                    'Trade secrets require active measures to maintain secrecy'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Intellectual Property - Item 22
            [
                'topic_id' => $topics['Intellectual Property'] ?? 27,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each intellectual property type with what it protects:',
                'options' => [
                    'items' => [
                        'Patent',
                        'Copyright',
                        'Trademark',
                        'Trade Secret'
                    ],
                    'responses' => [
                        'Inventions and processes',
                        'Original works of authorship',
                        'Brand identifiers and logos',
                        'Confidential business information'
                    ]
                ],
                'correct_options' => [
                    'Patent' => 'Inventions and processes',
                    'Copyright' => 'Original works of authorship',
                    'Trademark' => 'Brand identifiers and logos',
                    'Trade Secret' => 'Confidential business information'
                ],
                'justifications' => [
                    'Patent' => 'Patents protect inventions, processes, and methods',
                    'Copyright' => 'Copyright protects original creative works',
                    'Trademark' => 'Trademarks protect brand identity elements',
                    'Trade Secret' => 'Trade secrets protect confidential business information'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Intellectual Property - Item 23
            [
                'topic_id' => $topics['Intellectual Property'] ?? 27,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Open source software cannot be protected by copyright.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. Open source software IS protected by copyright. The copyright holder chooses to license it under open source terms, which grants certain usage rights while retaining copyright ownership. The license terms are enforceable because of copyright protection.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Advanced Integration Questions
            
            // Item 24 - GDPR and Contracts
            [
                'topic_id' => $topics['General Data Protection Regulation (GDPR)'] ?? 22,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A US company processing EU citizen data must include which provisions in vendor contracts under GDPR?',
                'options' => [
                    'Standard contractual clauses or other transfer mechanism',
                    'Unlimited liability for data breaches',
                    'Requirement to store all data in the EU',
                    'Mandatory cyber insurance coverage'
                ],
                'correct_options' => ['Standard contractual clauses or other transfer mechanism'],
                'justifications' => [
                    'Correct - GDPR requires appropriate safeguards like SCCs for international data transfers',
                    'GDPR doesn\'t mandate unlimited liability',
                    'Data can be transferred outside EU with proper safeguards',
                    'Insurance is not a GDPR requirement'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 25 - Multiple Regulations
            [
                'topic_id' => $topics['Compliance Requirements'] ?? 21,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A healthcare payment processor must comply with multiple regulations. Which combination is MOST likely to apply?',
                'options' => [
                    'HIPAA and PCI DSS',
                    'GDPR and SOX',
                    'FERPA and GLBA',
                    'COPPA and CAN-SPAM'
                ],
                'correct_options' => ['HIPAA and PCI DSS'],
                'justifications' => [
                    'Correct - Healthcare (HIPAA) plus payment processing (PCI DSS) both apply',
                    'SOX is for public companies, not specifically healthcare payments',
                    'FERPA is education; GLBA is financial but not healthcare-specific',
                    'COPPA is children\'s privacy; CAN-SPAM is email marketing'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 26 - Breach Notification
            [
                'topic_id' => $topics['General Data Protection Regulation (GDPR)'] ?? 22,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these breach notification requirements from SHORTEST to LONGEST timeframe:',
                'options' => [
                    'GDPR to supervisory authority',
                    'PCI DSS to card brands',
                    'HIPAA to affected individuals',
                    'State breach laws (typical)',
                    'SEC disclosure for material breaches'
                ],
                'correct_options' => [
                    'PCI DSS to card brands',
                    'GDPR to supervisory authority',
                    'HIPAA to affected individuals',
                    'State breach laws (typical)',
                    'SEC disclosure for material breaches'
                ],
                'justifications' => ['PCI DSS requires immediate notification, GDPR within 72 hours, HIPAA within 60 days, state laws vary but often 30-90 days, SEC in quarterly/annual reports.'],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 27 - Regulatory Investigation
            [
                'topic_id' => $topics['Criminal Law & Civil Law'] ?? 25,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During a regulatory investigation, an employee takes the Fifth Amendment. What can the organization do?',
                'options' => [
                    'Fire the employee for non-cooperation',
                    'Force the employee to testify internally',
                    'Continue investigation without that testimony',
                    'Stop all investigation activities'
                ],
                'correct_options' => ['Continue investigation without that testimony'],
                'justifications' => [
                    'Fifth Amendment protects against self-incrimination in criminal matters',
                    'Cannot force testimony that might self-incriminate',
                    'Correct - Organization can and should continue investigating through other means',
                    'No requirement to stop investigation due to one person\'s silence'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 28 - Liability and Insurance
            [
                'topic_id' => $topics['Contractual Obligations & Liability Clauses'] ?? 26,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A cloud provider\'s terms exclude liability for data breaches. Your cyber insurance denies coverage because you didn\'t ensure adequate vendor security. Who bears the loss?',
                'options' => [
                    'Cloud provider due to negligence',
                    'Insurance company must cover',
                    'Your organization bears the loss',
                    'Losses are shared equally'
                ],
                'correct_options' => ['Your organization bears the loss'],
                'justifications' => [
                    'Liability exclusions in contracts are often enforceable',
                    'Insurance can deny claims for failure to meet policy conditions',
                    'Correct - With vendor exclusions and insurance denial, organization bears risk',
                    'No automatic sharing without agreement'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 29 - Privacy Rights
            [
                'topic_id' => $topics['General Data Protection Regulation (GDPR)'] ?? 22,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'A customer requests data deletion under GDPR. Drag the reasons that would allow you to REFUSE deletion to the drop zone:',
                'options' => [
                    'Data needed for legal claims',
                    'Deletion is technically difficult',
                    'Legal obligation to retain',
                    'Customer owes money',
                    'Freedom of expression',
                    'Backup restoration costs'
                ],
                'correct_options' => [
                    'Data needed for legal claims',
                    'Legal obligation to retain',
                    'Freedom of expression'
                ],
                'justifications' => [
                    'Legal claims defense is a valid GDPR exception',
                    'Technical difficulty is not a valid exception',
                    'Legal retention requirements override deletion rights',
                    'Financial disputes don\'t override privacy rights',
                    'Freedom of expression is a recognized exception',
                    'Cost is not a valid reason to refuse'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 30 - Compliance Program
            [
                'topic_id' => $topics['Compliance Requirements'] ?? 21,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the MOST important factor in determining penalties for regulatory violations?',
                'options' => [
                    'Size of the organization',
                    'Whether self-reported and cooperation level',
                    'Industry sector',
                    'Geographic location'
                ],
                'correct_options' => ['Whether self-reported and cooperation level'],
                'justifications' => [
                    'Size may affect fine amounts but not as much as cooperation',
                    'Correct - Self-reporting and cooperation typically result in reduced penalties',
                    'Industry sector affects which regulations apply, not penalty severity',
                    'Location determines jurisdiction but not penalty factors'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 31 - HIPAA Specific
            [
                'topic_id' => $topics['Health Insurance Portability & Accountability Act (HIPAA)'] ?? 23,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A hospital employee views their own medical record in the system. Under HIPAA, this is:',
                'options' => [
                    'Always permitted as patient right of access',
                    'Potentially a violation if not for job duties',
                    'Allowed if they have system access',
                    'Only permitted with supervisor approval'
                ],
                'correct_options' => ['Potentially a violation if not for job duties'],
                'justifications' => [
                    'Patient rights don\'t extend to bypassing access controls',
                    'Correct - Accessing PHI outside of job duties violates minimum necessary rule',
                    'System access doesn\'t authorize all uses',
                    'Employees should use patient portals, not work access'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 32 - PCI DSS Scope
            [
                'topic_id' => $topics['Payment Card Industry Data Security Standard (PCI DSS)'] ?? 24,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A company uses a payment iframe from a PCI-compliant provider. What is their PCI DSS obligation?',
                'options' => [
                    'No PCI requirements apply',
                    'Must complete SAQ A',
                    'Full PCI DSS compliance required',
                    'Only network security requirements apply'
                ],
                'correct_options' => ['Must complete SAQ A'],
                'justifications' => [
                    'Even with outsourcing, some PCI obligations remain',
                    'Correct - SAQ A applies when using compliant third-party payment pages',
                    'Full compliance not needed with proper outsourcing',
                    'SAQ A covers more than just network security'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 33 - Legal Privilege
            [
                'topic_id' => $topics['Criminal Law & Civil Law'] ?? 25,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Attorney-client privilege protects all communications with lawyers from disclosure in legal proceedings.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. Attorney-client privilege has limitations: it doesn\'t cover communications made to further a crime, doesn\'t apply if shared with third parties, and can be waived. It only protects confidential communications seeking legal advice.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 34 - Contract Negotiation
            [
                'topic_id' => $topics['Contractual Obligations & Liability Clauses'] ?? 26,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these contract negotiation priorities for a CUSTOMER from MOST to LEAST important:',
                'options' => [
                    'Unlimited vendor liability',
                    'Right to audit',
                    'Service level agreements',
                    'Termination rights',
                    'Price guarantees'
                ],
                'correct_options' => [
                    'Service level agreements',
                    'Termination rights',
                    'Right to audit',
                    'Price guarantees',
                    'Unlimited vendor liability'
                ],
                'justifications' => ['SLAs ensure service quality, termination rights provide exit options, audit rights verify compliance, price guarantees control costs, unlimited liability is rarely achievable.'],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 35 - IP in Employment
            [
                'topic_id' => $topics['Intellectual Property'] ?? 27,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An employee develops a security tool at home using personal equipment but based on work knowledge. Who likely owns the IP?',
                'options' => [
                    'Employee owns it completely',
                    'Employer likely has rights to it',
                    'Joint ownership automatically',
                    'Public domain since unclear'
                ],
                'correct_options' => ['Employer likely has rights to it'],
                'justifications' => [
                    'Personal time/equipment doesn\'t override employment agreements',
                    'Correct - Work-related inventions often belong to employer per contracts',
                    'Joint ownership requires specific agreement',
                    'Ownership disputes don\'t create public domain'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 36 - Data Localization
            [
                'topic_id' => $topics['Compliance Requirements'] ?? 21,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which country has the MOST comprehensive data localization requirements for personal data?',
                'options' => [
                    'United States',
                    'United Kingdom',
                    'Russia',
                    'Japan'
                ],
                'correct_options' => ['Russia'],
                'justifications' => [
                    'The US has sector-specific requirements but no comprehensive national data localization law',
                    'The UK focuses on data protection rather than localization requirements',
                    'Correct - Russia has comprehensive data localization laws requiring personal data of Russian citizens to be stored within Russia',
                    'Japan has data protection laws but limited localization requirements'
                ],
                'justifications' => [
                    'Russia requires personal data of citizens stored domestically',
                    'US has sectoral requirements but no general localization law',
                    'China has strict data localization requirements',
                    'UK follows GDPR-style rules without localization mandate',
                    'India has data localization requirements for certain sectors',
                    'Japan allows transfers with appropriate safeguards'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 37 - Forensics and Legal Hold
            [
                'topic_id' => $topics['Criminal Law & Civil Law'] ?? 25,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your company receives a litigation hold notice. An automated system is about to delete old backups per retention policy. You should:',
                'options' => [
                    'Let the deletion proceed as scheduled',
                    'Immediately preserve all identified data',
                    'Delete data to avoid discovery',
                    'Wait for court order before acting'
                ],
                'correct_options' => ['Immediately preserve all identified data'],
                'justifications' => [
                    'Scheduled deletion must stop for data under legal hold',
                    'Correct - Legal hold requires immediate preservation of relevant data',
                    'Intentional deletion after hold notice is spoliation',
                    'Hold notices require immediate action, not court orders'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 38 - Regulatory Overlap
            [
                'topic_id' => $topics['Health Insurance Portability & Accountability Act (HIPAA)'] ?? 23,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A healthcare app for EU citizens must comply with both HIPAA and GDPR. When requirements conflict, you should:',
                'options' => [
                    'Follow the stricter requirement',
                    'Choose which one to follow',
                    'Request exemption from one',
                    'Only follow local country law'
                ],
                'correct_options' => ['Follow the stricter requirement'],
                'justifications' => [
                    'Correct - When regulations overlap, meeting the stricter requirement ensures compliance with both',
                    'Must comply with all applicable regulations',
                    'Exemptions are rarely granted for conflicts',
                    'Both regulations may apply regardless of location'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 39 - Whistleblower Protections
            [
                'topic_id' => $topics['Criminal Law & Civil Law'] ?? 25,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Whistleblower protections allow employees to publicly disclose any suspected wrongdoing without consequence.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. Whistleblower protections have specific requirements and channels. Employees typically must report through proper channels (internal reporting, regulatory agencies) and the disclosure must relate to specific violations. Public disclosure without following procedures may not be protected.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 40 - Compliance Technology
            [
                'topic_id' => $topics['Compliance Requirements'] ?? 21,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which technology solution BEST supports multi-regulatory compliance management?',
                'options' => [
                    'Separate tools for each regulation',
                    'Integrated GRC (Governance, Risk, Compliance) platform',
                    'Spreadsheet tracking system',
                    'Email-based workflow system'
                ],
                'correct_options' => ['Integrated GRC (Governance, Risk, Compliance) platform'],
                'justifications' => [
                    'Separate tools create silos and miss overlaps',
                    'Correct - GRC platforms provide unified compliance management across regulations',
                    'Spreadsheets don\'t scale for complex compliance',
                    'Email lacks audit trails and control features'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 41 - Extraterritorial Application
            [
                'topic_id' => $topics['General Data Protection Regulation (GDPR)'] ?? 22,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A US-only company with no EU presence collects data from EU visitors to its website. Does GDPR apply?',
                'options' => [
                    'No, company has no EU establishment',
                    'Yes, if targeting EU residents or monitoring behavior',
                    'Only if processing large amounts of data',
                    'Only if explicitly offering services to EU'
                ],
                'correct_options' => ['Yes, if targeting EU residents or monitoring behavior'],
                'justifications' => [
                    'GDPR has extraterritorial reach beyond physical presence',
                    'Correct - GDPR Article 3 applies to non-EU entities targeting or monitoring EU residents',
                    'Volume doesn\'t determine GDPR applicability',
                    'Even passive collection can trigger GDPR if monitoring behavior'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 42 - Regulatory Audit
            [
                'topic_id' => $topics['Payment Card Industry Data Security Standard (PCI DSS)'] ?? 24,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which validation method is required for PCI DSS Level 1 merchants?',
                'options' => [
                    'Annual self-assessment questionnaire (SAQ)',
                    'Annual onsite assessment by Qualified Security Assessor (QSA)',
                    'Quarterly network scan by Approved Scanning Vendor (ASV)',
                    'Internal vulnerability assessment'
                ],
                'correct_options' => ['Annual onsite assessment by Qualified Security Assessor (QSA)'],
                'justifications' => [
                    'SAQ is used for lower-level merchants with simpler requirements',
                    'Correct - Level 1 merchants require the most rigorous validation through annual onsite QSA assessment',
                    'ASV scans are required for all levels but are not the primary validation method for Level 1',
                    'Internal assessments are not sufficient for Level 1 validation'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 43 - Privacy vs Security
            [
                'topic_id' => $topics['General Data Protection Regulation (GDPR)'] ?? 22,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Security monitoring detects an employee accessing personal data unnecessarily. Under GDPR, this is primarily a violation of:',
                'options' => [
                    'Data security principle',
                    'Purpose limitation principle',
                    'Transparency requirement',
                    'Accountability principle'
                ],
                'correct_options' => ['Purpose limitation principle'],
                'justifications' => [
                    'Security was working (it detected the access)',
                    'Correct - Accessing data beyond the specified purpose violates purpose limitation',
                    'Transparency relates to informing data subjects',
                    'Accountability is about demonstrating compliance'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 44 - Incident Response Legal
            [
                'topic_id' => $topics['Criminal Law & Civil Law'] ?? 25,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During incident response, your team finds evidence of criminal activity. The FIRST action should be:',
                'options' => [
                    'Immediately call law enforcement',
                    'Preserve evidence and consult legal counsel',
                    'Continue normal incident response',
                    'Delete evidence to avoid liability'
                ],
                'correct_options' => ['Preserve evidence and consult legal counsel'],
                'justifications' => [
                    'Premature law enforcement contact may complicate response',
                    'Correct - Preserve evidence properly and get legal guidance on obligations',
                    'Criminal evidence requires special handling',
                    'Destroying evidence is obstruction of justice'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 45 - Compliance Metrics
            [
                'topic_id' => $topics['Compliance Requirements'] ?? 21,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the metrics that BEST demonstrate compliance program effectiveness to the drop zone:',
                'options' => [
                    'Number of policies written',
                    'Reduction in compliance violations',
                    'Training attendance records',
                    'Self-identified issues reported',
                    'Audit finding closure rate',
                    'Size of compliance team'
                ],
                'correct_options' => [
                    'Reduction in compliance violations',
                    'Self-identified issues reported',
                    'Audit finding closure rate'
                ],
                'justifications' => [
                    'Policy count doesn\'t indicate effectiveness',
                    'Fewer violations shows program works',
                    'Attendance doesn\'t ensure understanding',
                    'Self-reporting indicates healthy compliance culture',
                    'Closing findings demonstrates remediation',
                    'Team size doesn\'t correlate with effectiveness'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 46 - Cross-Border Data Transfer Assessment (Level 3)
            [
                'topic_id' => $topics['General Data Protection Regulation (GDPR)'] ?? 22,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A European subsidiary wants to transfer employee data to its US parent company. Which transfer mechanism provides the strongest legal protection?',
                'options' => [
                    'Binding Corporate Rules (BCRs)',
                    'Standard Contractual Clauses (SCCs)',
                    'Adequacy decision',
                    'Legitimate interest assessment'
                ],
                'correct_options' => ['Adequacy decision'],
                'justifications' => [
                    'BCRs are strong but require EU approval and only apply within corporate groups',
                    'SCCs are widely used but require additional safeguards and risk assessments',
                    'Correct - Adequacy decisions provide the strongest protection as they recognize equivalent data protection',
                    'Legitimate interest alone is insufficient for international transfers without additional safeguards'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 47 - Multi-Jurisdictional Compliance Strategy (Level 4)
            [
                'topic_id' => $topics['Compliance Requirements'] ?? 21,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your organization operates in multiple countries with conflicting data localization laws. Which approach BEST balances compliance and operational efficiency?',
                'options' => [
                    'Implement the strictest requirements globally',
                    'Use regional data architectures with local compliance',
                    'Choose one jurisdiction and exit others',
                    'Implement minimum requirements everywhere'
                ],
                'correct_options' => ['Use regional data architectures with local compliance'],
                'justifications' => [
                    'Global strict requirements may be unnecessarily costly and operationally complex',
                    'Correct - Regional architectures allow tailored compliance while maintaining operational efficiency',
                    'Exiting markets limits business opportunities unnecessarily',
                    'Minimum requirements risk non-compliance in strict jurisdictions'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 48 - Regulatory Change Management (Level 5)
            [
                'topic_id' => $topics['Compliance Requirements'] ?? 21,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A new privacy regulation will take effect in 18 months with significant penalties. Your compliance budget is limited. Which strategy should you prioritize?',
                'options' => [
                    'Wait until 6 months before to start implementation',
                    'Immediately hire external consultants for full implementation',
                    'Conduct gap analysis and implement high-risk areas first',
                    'Request regulatory extension due to budget constraints'
                ],
                'correct_options' => ['Conduct gap analysis and implement high-risk areas first'],
                'justifications' => [
                    'Waiting increases risk and reduces time for proper implementation',
                    'External consultants may be expensive and not necessary for all aspects',
                    'Correct - Risk-based prioritization maximizes compliance impact within budget constraints',
                    'Regulatory extensions are rarely granted for budget reasons'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 49 - Security vs. Privacy Compliance Trade-offs (Level 3)
            [
                'topic_id' => $topics['General Data Protection Regulation (GDPR)'] ?? 22,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A data subject requests deletion of their account data, but security logs containing their information are needed for ongoing fraud investigation. You should:',
                'options' => [
                    'Delete all data immediately to comply with GDPR',
                    'Retain data for investigation and explain legal basis to data subject',
                    'Anonymize the data in security logs',
                    'Transfer the case to law enforcement first'
                ],
                'correct_options' => ['Retain data for investigation and explain legal basis to data subject'],
                'justifications' => [
                    'Immediate deletion ignores legitimate interests in fraud prevention',
                    'Correct - GDPR allows retention for legitimate interests like fraud prevention with proper communication',
                    'Anonymization may not preserve necessary investigative value',
                    'Law enforcement transfer is not required for private fraud investigations'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 50 - Compliance Program Effectiveness Evaluation (Level 4)
            [
                'topic_id' => $topics['Compliance Requirements'] ?? 21,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your organization has had zero regulatory violations in 3 years but compliance costs are increasing. Management questions the program value. Which metric BEST demonstrates ROI?',
                'options' => [
                    'Number of compliance training hours completed',
                    'Comparison of potential fines avoided vs. program costs',
                    'Number of policies and procedures documented',
                    'Percentage of audit findings closed on time'
                ],
                'correct_options' => ['Comparison of potential fines avoided vs. program costs'],
                'justifications' => [
                    'Training hours show activity but not business value',
                    'Correct - ROI calculation comparing avoided penalties to program investment demonstrates financial value',
                    'Policy documentation shows process but not outcomes',
                    'Finding closure shows efficiency but not business impact'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 3 (Legal, Regulatory & Compliance) diagnostic items seeded successfully!');
    }
}