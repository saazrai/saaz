<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D4PrivacySeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing items for this domain to prevent duplicates
        DiagnosticItem::whereHas('topic.domain', function($query) {
            $query->where('name', 'Privacy');
        })->forceDelete();
        
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Privacy');
        })->pluck('id', 'name');
        
        
        $items = [
            // PII - Item 1
            [
                'topic_id' => $topics['Personally Identifiable Information (PII)'] ?? 88,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which of the following is considered Personally Identifiable Information (PII)?',
                'options' => [
                    'Company revenue figures',
                    'Employee social security number',
                    'Building floor plans',
                    'Software version numbers'
                ],
                'correct_options' => ['Employee social security number'],
                'justifications' => [
                    'Company revenue is business information, not personal',
                    'Correct - SSN uniquely identifies an individual',
                    'Floor plans are facility information, not personal',
                    'Software versions are technical information, not personal'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // PII - Item 2
            [
                'topic_id' => $topics['Personally Identifiable Information (PII)'] ?? 88,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the items that are considered PII to the drop zone:',
                'options' => [
                    'Email address',
                    'Server IP address',
                    'Date of birth',
                    'Application logs',
                    'Passport number',
                    'Company policy document'
                ],
                'correct_options' => ['Email address', 'Date of birth', 'Passport number'],
                'justifications' => [
                    'Email addresses can identify individuals',
                    'Server IPs identify machines, not people',
                    'Date of birth combined with other data identifies individuals',
                    'Application logs typically contain system data',
                    'Passport numbers uniquely identify individuals',
                    'Policy documents are organizational information'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // ePHI - Item 3
            [
                'topic_id' => $topics['Electronic Protected Health Information (ePHI)'] ?? 89,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Under HIPAA, which of the following would be classified as ePHI?',
                'options' => [
                    'Patient medical record number',
                    'Hospital cafeteria menu',
                    'Doctor\'s vacation schedule',
                    'Medical equipment inventory'
                ],
                'correct_options' => ['Patient medical record number'],
                'justifications' => [
                    'Correct - Medical record numbers identify patients and their health information',
                    'Cafeteria menus are not health information',
                    'Staff schedules are operational data, not patient health data',
                    'Equipment inventory is facility management data'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Collection Limitation - Item 4
            [
                'topic_id' => $topics['Collection Limitation'] ?? 90,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Under the principle of Collection Limitation, organizations can collect any personal data they might find useful in the future.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Collection Limitation requires that personal data collection be limited to what is necessary for specified, explicit, and legitimate purposes. Organizations cannot collect data "just in case" it might be useful later.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Purpose Limitation - Item 5
            [
                'topic_id' => $topics['Purpose Limitation'] ?? 91,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A company collects customer email addresses for order confirmations. The marketing department wants to use these emails for promotional campaigns. What privacy principle does this violate?',
                'options' => [
                    'Data Minimisation',
                    'Purpose Limitation',
                    'Storage Limitation',
                    'Security Safeguards'
                ],
                'correct_options' => ['Purpose Limitation'],
                'justifications' => [
                    'Data Minimisation relates to amount of data collected',
                    'Correct - Using data for marketing when collected for order confirmations violates Purpose Limitation',
                    'Storage Limitation relates to retention periods',
                    'Security Safeguards relate to protection measures'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Data Minimisation - Item 6
            [
                'topic_id' => $topics['Data Minimisation'] ?? 92,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An online retailer requires customers to provide their date of birth, mother\'s maiden name, and social security number to create an account for purchasing books. This practice violates which principle?',
                'options' => [
                    'Data Minimisation',
                    'Storage Limitation',
                    'Data Portability',
                    'Security Safeguards'
                ],
                'correct_options' => ['Data Minimisation'],
                'justifications' => [
                    'Correct - Collecting excessive personal data beyond what\'s necessary for book purchases violates Data Minimisation',
                    'Storage Limitation relates to how long data is kept',
                    'Data Portability relates to transferring data between services',
                    'Security Safeguards relate to protecting collected data'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Storage Limitation - Item 7
            [
                'topic_id' => $topics['Storage Limitation'] ?? 93,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Under GDPR\'s Storage Limitation principle, personal data should be kept:',
                'options' => [
                    'Indefinitely for historical purposes',
                    'For 7 years as standard practice',
                    'No longer than necessary for the specified purpose',
                    'Until the data subject requests deletion'
                ],
                'correct_options' => ['No longer than necessary for the specified purpose'],
                'justifications' => [
                    'Indefinite storage violates Storage Limitation',
                    'Fixed periods without justification violate the principle',
                    'Correct - Data must be deleted when no longer needed for its original purpose',
                    'While deletion rights exist, Storage Limitation requires proactive deletion'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Security Safeguards - Item 8
            [
                'topic_id' => $topics['Security Safeguards'] ?? 94,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Select appropriate security safeguards for protecting personal data:',
                'options' => [
                    'Encryption at rest and in transit',
                    'Public disclosure for transparency',
                    'Access controls and authentication',
                    'Sharing with all departments',
                    'Regular security assessments',
                    'Storing in plain text for easy access'
                ],
                'correct_options' => ['Encryption at rest and in transit', 'Access controls and authentication', 'Regular security assessments'],
                'justifications' => [
                    'Encryption protects data confidentiality',
                    'Public disclosure violates privacy',
                    'Access controls limit data to authorized users',
                    'Unrestricted sharing violates need-to-know',
                    'Assessments identify security gaps',
                    'Plain text storage is a security vulnerability'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Data Subject Rights - Item 9
            [
                'topic_id' => $topics['Data Subject Rights & Data Portability'] ?? 95,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Under GDPR, which of the following is NOT a data subject right?',
                'options' => [
                    'Right to be informed',
                    'Right to sell personal data',
                    'Right to rectification',
                    'Right to erasure'
                ],
                'correct_options' => ['Right to sell personal data'],
                'justifications' => [
                    'Right to be informed is a fundamental GDPR right',
                    'Correct - GDPR does not grant individuals the right to sell their personal data',
                    'Right to rectification allows correction of inaccurate data',
                    'Right to erasure (right to be forgotten) is a key GDPR right'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Data Portability - Item 10
            [
                'topic_id' => $topics['Data Subject Rights & Data Portability'] ?? 95,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'The right to data portability allows individuals to:',
                'options' => [
                    'Delete their data from all systems',
                    'Receive their data in a structured, machine-readable format',
                    'Prevent processing of their data',
                    'Access company source code'
                ],
                'correct_options' => ['Receive their data in a structured, machine-readable format'],
                'justifications' => [
                    'Deletion is covered by the right to erasure',
                    'Correct - Data portability enables transfer of personal data between services',
                    'Prevention of processing relates to consent withdrawal',
                    'Source code access is not a privacy right'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Privacy by Design - Item 11
            [
                'topic_id' => $topics['Privacy by Design & by Default'] ?? 96,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which of the following best demonstrates "Privacy by Default"?',
                'options' => [
                    'Adding privacy features after product launch',
                    'Social media profiles set to private unless users change them',
                    'Collecting all available data by default',
                    'Requiring users to read privacy policies'
                ],
                'correct_options' => ['Social media profiles set to private unless users change them'],
                'justifications' => [
                    'Privacy by Design requires building in privacy from the start',
                    'Correct - Privacy by Default means the strictest privacy settings are applied automatically',
                    'Maximum data collection violates privacy principles',
                    'Reading policies doesn\'t implement privacy controls'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Data Sovereignty - Item 12
            [
                'topic_id' => $topics['Data Sovereignty & Cross-Border Transfer (SCC, BCR, DPF)'] ?? 97,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A European company wants to transfer personal data to a US-based cloud provider. Which mechanism would NOT be appropriate under GDPR?',
                'options' => [
                    'Standard Contractual Clauses (SCCs)',
                    'Binding Corporate Rules (BCRs)',
                    'Informal email agreement',
                    'EU-US Data Privacy Framework'
                ],
                'correct_options' => ['Informal email agreement'],
                'justifications' => [
                    'SCCs are approved transfer mechanisms',
                    'BCRs are valid for intra-group transfers',
                    'Correct - Informal agreements don\'t meet GDPR requirements for international transfers',
                    'The Data Privacy Framework is a recognized adequacy mechanism'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Data Controller vs Processor - Item 13
            [
                'topic_id' => $topics['Roles: Data Controller & Data Processor'] ?? 98,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each scenario with the appropriate role:',
                'options' => [
                    'items' => [
                        'Hospital determining patient data retention periods',
                        'Cloud provider storing data on behalf of clients',
                        'Marketing company deciding what customer data to collect',
                        'Payroll service processing employee salaries'
                    ],
                    'responses' => [
                        'Data Controller',
                        'Data Processor',
                        'Data Controller',
                        'Data Processor'
                    ]
                ],
                'correct_options' => [
                    'Data Controller',
                    'Data Processor',
                    'Data Controller',
                    'Data Processor'
                ],
                'justifications' => [
                    'Hospital determining patient data retention periods' => 'Controllers determine purposes and means of processing',
                    'Cloud provider storing data on behalf of clients' => 'Processors act on controller instructions',
                    'Marketing company deciding what customer data to collect' => 'Controllers make decisions about data use',
                    'Payroll service processing employee salaries' => 'Processors handle data for controllers'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Privacy Impact Assessment - Item 14
            [
                'topic_id' => $topics['Privacy Impact Assessment (PIA) / DPIA'] ?? 99,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When is a Data Protection Impact Assessment (DPIA) mandatory under GDPR?',
                'options' => [
                    'For any processing of personal data',
                    'Only when requested by data subjects',
                    'For high-risk processing activities',
                    'Only for government organizations'
                ],
                'correct_options' => ['For high-risk processing activities'],
                'justifications' => [
                    'Not all processing requires a DPIA',
                    'DPIAs are not triggered by data subject requests',
                    'Correct - DPIAs are required when processing likely results in high risk to individuals',
                    'Both private and public organizations may need DPIAs'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Advanced Privacy Scenario - Item 15
            [
                'topic_id' => $topics['Privacy by Design & by Default'] ?? 96,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A healthcare app developer is designing a new patient monitoring system. Which Privacy by Design principle would be violated if the app continuously uploads all sensor data to the cloud when only abnormal readings need to be transmitted?',
                'options' => [
                    'Proactive not reactive',
                    'Privacy embedded into design',
                    'Positive-sum, not zero-sum',
                    'Privacy as the default setting'
                ],
                'correct_options' => ['Privacy embedded into design'],
                'justifications' => [
                    'This relates to being preventative, not the issue here',
                    'Correct - Unnecessary data transmission violates the principle of embedding privacy into the system design through data minimization',
                    'This principle is about win-win scenarios',
                    'While related, the core issue is the design choice, not default settings'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Complex Cross-Border Transfer - Item 16
            [
                'topic_id' => $topics['Data Sovereignty & Cross-Border Transfer (SCC, BCR, DPF)'] ?? 97,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A multinational corporation with subsidiaries in the EU, US, and Asia needs to share employee data globally for HR management. They implemented Binding Corporate Rules (BCRs) but a new subsidiary in Brazil needs access. What additional measures are required?',
                'options' => [
                    'BCRs automatically cover all new subsidiaries globally',
                    'The Brazilian subsidiary must be added to the BCR scope through an update process',
                    'Separate Standard Contractual Clauses are required for Brazil',
                    'No additional measures needed if Brazil has adequacy decision'
                ],
                'correct_options' => ['The Brazilian subsidiary must be added to the BCR scope through an update process'],
                'justifications' => [
                    'BCRs must explicitly include entities to be covered',
                    'Correct - New entities must be formally incorporated into existing BCRs through the proper update and approval process',
                    'SCCs are for third parties, not intra-group transfers covered by BCRs',
                    'Brazil doesn\'t have EU adequacy decision, and BCRs still need updating'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // PII in Different Contexts - Item 17
            [
                'topic_id' => $topics['Personally Identifiable Information (PII)'] ?? 88,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization publishes a dataset with ZIP codes, birth dates, and gender. Research shows this combination can identify 87% of the US population. What type of PII is this?',
                'options' => [
                    'Direct identifiers',
                    'Quasi-identifiers',
                    'Non-identifiable information',
                    'Sensitive personal data'
                ],
                'correct_options' => ['Quasi-identifiers'],
                'justifications' => [
                    'Direct identifiers like names explicitly identify individuals',
                    'Correct - Quasi-identifiers can identify individuals when combined, even without direct identifiers',
                    'This combination has been proven to be identifiable',
                    'While potentially sensitive, the term describes the identification risk'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // DPIA Requirements - Item 18
            [
                'topic_id' => $topics['Privacy Impact Assessment (PIA) / DPIA'] ?? 99,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Select the scenarios that would require a mandatory DPIA under GDPR:',
                'options' => [
                    'Large-scale processing of biometric data',
                    'Employee email system for 50 staff',
                    'Public area CCTV surveillance',
                    'Online contact form',
                    'Automated credit scoring system',
                    'Company phone directory'
                ],
                'correct_options' => ['Large-scale processing of biometric data', 'Public area CCTV surveillance', 'Automated credit scoring system'],
                'justifications' => [
                    'Biometric data is special category data requiring DPIA at scale',
                    'Small-scale routine employee data doesn\'t require DPIA',
                    'Systematic monitoring of public areas requires DPIA',
                    'Simple contact forms are low risk',
                    'Automated decision-making with legal effects requires DPIA',
                    'Internal directories are routine, low-risk processing'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Privacy Engineering - Item 19
            [
                'topic_id' => $topics['Security Safeguards'] ?? 94,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which privacy-enhancing technology (PET) would be most appropriate for analyzing customer purchase patterns without exposing individual transactions?',
                'options' => [
                    'Differential privacy',
                    'Full disk encryption',
                    'Multi-factor authentication',
                    'Firewall rules'
                ],
                'correct_options' => ['Differential privacy'],
                'justifications' => [
                    'Correct - Differential privacy adds noise to protect individual data while preserving statistical utility',
                    'Disk encryption protects data at rest but doesn\'t help with analysis',
                    'MFA is for access control, not privacy-preserving analysis',
                    'Firewalls control network traffic, not data analysis privacy'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Data Anonymization - Item 20
            [
                'topic_id' => $topics['Security Safeguards'] ?? 94,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of applying k-anonymity to a dataset containing personal information?',
                'options' => [
                    'To completely remove all personal identifiers',
                    'To ensure each record is indistinguishable from at least k-1 other records',
                    'To encrypt all sensitive data fields',
                    'To comply with data retention requirements'
                ],
                'correct_options' => ['To ensure each record is indistinguishable from at least k-1 other records'],
                'justifications' => [
                    'K-anonymity generalizes quasi-identifiers but doesn\'t remove all personal data',
                    'Correct - K-anonymity creates groups where each individual cannot be distinguished from k-1 others',
                    'K-anonymity is a privacy technique, not an encryption method',
                    'K-anonymity addresses privacy protection, not data retention compliance'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Consent Management - Item 21
            [
                'topic_id' => $topics['Data Subject Rights & Data Portability'] ?? 95,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Under GDPR, pre-ticked boxes can be used to obtain valid consent for marketing communications.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'GDPR requires clear affirmative action for valid consent. Pre-ticked boxes do not demonstrate active consent and are explicitly prohibited. Users must actively opt-in.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Children's Privacy - Item 22
            [
                'topic_id' => $topics['Collection Limitation'] ?? 90,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Under GDPR, what is the default minimum age for a child to consent to information society services without parental approval?',
                'options' => [
                    '13 years',
                    '16 years',
                    '18 years',
                    '21 years'
                ],
                'correct_options' => ['16 years'],
                'justifications' => [
                    'Some countries lower it to 13, but this isn\'t the default',
                    'Correct - GDPR sets 16 as the default, though member states can lower to 13',
                    '18 is adult age, not the child consent threshold',
                    '21 is not relevant to GDPR consent ages'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Privacy Notice Requirements - Item 23
            [
                'topic_id' => $topics['Data Subject Rights & Data Portability'] ?? 95,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Select the mandatory elements that must be included in a GDPR privacy notice:',
                'options' => [
                    'Identity of the data controller',
                    'Company financial statements',
                    'Legal basis for processing',
                    'Employee salaries',
                    'Data retention periods',
                    'Marketing strategies'
                ],
                'correct_options' => ['Identity of the data controller', 'Legal basis for processing', 'Data retention periods'],
                'justifications' => [
                    'Controller identity is mandatory for transparency',
                    'Financial statements aren\'t privacy-related',
                    'Legal basis must be specified for each processing purpose',
                    'Employee salaries aren\'t required in privacy notices',
                    'Retention periods inform data subjects how long data is kept',
                    'Marketing strategies aren\'t privacy notice requirements'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Legitimate Interest Assessment - Item 24
            [
                'topic_id' => $topics['Purpose Limitation'] ?? 91,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A company wants to use legitimate interest as the legal basis for direct marketing. What must they conduct first?',
                'options' => [
                    'Data Protection Impact Assessment',
                    'Legitimate Interest Assessment',
                    'Privacy Impact Assessment',
                    'Security Risk Assessment'
                ],
                'correct_options' => ['Legitimate Interest Assessment'],
                'justifications' => [
                    'DPIA is for high-risk processing',
                    'Correct - LIA balances controller interests against data subject rights and freedoms',
                    'PIA is a general privacy review, not specific to legitimate interest',
                    'Security assessments don\'t address legal basis'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Right to Erasure Exceptions - Item 25
            [
                'topic_id' => $topics['Data Subject Rights & Data Portability'] ?? 95,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A customer requests deletion of their data under GDPR\'s right to erasure. In which situation can the company refuse?',
                'options' => [
                    'The data is stored in backup systems',
                    'The data is needed for compliance with legal obligations',
                    'The company finds the data useful for analytics',
                    'Deletion would be technically difficult'
                ],
                'correct_options' => ['The data is needed for compliance with legal obligations'],
                'justifications' => [
                    'Backups must be addressed in erasure procedures',
                    'Correct - Legal obligations override erasure rights',
                    'Business usefulness doesn\'t override erasure rights',
                    'Technical difficulty doesn\'t exempt from GDPR requirements'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Privacy Breach Notification - Item 26
            [
                'topic_id' => $topics['Security Safeguards'] ?? 94,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Under GDPR, within what timeframe must a data controller notify the supervisory authority of a personal data breach?',
                'options' => [
                    '24 hours',
                    '72 hours',
                    '7 days',
                    '30 days'
                ],
                'correct_options' => ['72 hours'],
                'justifications' => [
                    '24 hours is too short for GDPR requirements',
                    'Correct - GDPR requires notification within 72 hours of becoming aware',
                    '7 days exceeds the GDPR deadline',
                    '30 days is far too long under GDPR'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Special Category Data - Item 27
            [
                'topic_id' => $topics['Personally Identifiable Information (PII)'] ?? 88,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Identify which types of data are considered "special category" data under GDPR:',
                'options' => [
                    'Racial or ethnic origin',
                    'Email addresses',
                    'Religious beliefs',
                    'Purchase history',
                    'Sexual orientation',
                    'Job title'
                ],
                'correct_options' => ['Racial or ethnic origin', 'Religious beliefs', 'Sexual orientation'],
                'justifications' => [
                    'Race/ethnicity is explicitly special category',
                    'Email addresses are regular personal data',
                    'Religious beliefs are special category requiring extra protection',
                    'Purchase history is regular personal data',
                    'Sexual orientation is special category data',
                    'Job titles are regular personal data'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Privacy Program Maturity - Item 28
            [
                'topic_id' => $topics['Privacy by Design & by Default'] ?? 96,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization has documented privacy policies but only conducts privacy reviews when problems arise. At what maturity level is their privacy program?',
                'options' => [
                    'Ad hoc',
                    'Reactive',
                    'Proactive',
                    'Optimized'
                ],
                'correct_options' => ['Reactive'],
                'justifications' => [
                    'Ad hoc implies no formal processes',
                    'Correct - Having policies but only acting on problems indicates reactive maturity',
                    'Proactive would involve regular reviews before issues occur',
                    'Optimized involves continuous improvement and innovation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Data Processor Obligations - Item 29
            [
                'topic_id' => $topics['Roles: Data Controller & Data Processor'] ?? 98,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A data processor discovers a security vulnerability in their systems. Under GDPR, what is their primary obligation?',
                'options' => [
                    'Fix the vulnerability and document the fix',
                    'Notify the data controller without undue delay',
                    'Notify the supervisory authority within 72 hours',
                    'Inform all affected data subjects immediately'
                ],
                'correct_options' => ['Notify the data controller without undue delay'],
                'justifications' => [
                    'Fixing is important but notification is the primary obligation',
                    'Correct - Processors must notify controllers who then assess notification requirements',
                    'Controllers, not processors, notify supervisory authorities',
                    'Controllers, not processors, determine data subject notification'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // International Transfer Scenario - Item 30
            [
                'topic_id' => $topics['Data Sovereignty & Cross-Border Transfer (SCC, BCR, DPF)'] ?? 97,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An EU company uses a US cloud provider that is certified under the EU-US Data Privacy Framework. The provider wants to use servers in India for backup. What additional measures are needed?',
                'options' => [
                    'No additional measures - DPF covers all provider operations',
                    'New assessment for India transfer with appropriate safeguards',
                    'India automatically inherits US adequacy status',
                    'Only notification to data subjects is required'
                ],
                'correct_options' => ['New assessment for India transfer with appropriate safeguards'],
                'justifications' => [
                    'DPF only covers US operations, not third countries',
                    'Correct - Onward transfers to India require separate assessment and safeguards like SCCs',
                    'Adequacy decisions don\'t transfer between countries',
                    'Notification alone doesn\'t satisfy transfer requirements'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Privacy Technology Implementation - Item 31
            [
                'topic_id' => $topics['Security Safeguards'] ?? 94,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A company wants to perform analytics on customer data while preserving privacy. They need to ensure that removing a single customer\'s data doesn\'t significantly change the analysis results. Which technique is most appropriate?',
                'options' => [
                    'Tokenization',
                    'Format-preserving encryption',
                    'Differential privacy',
                    'Data masking'
                ],
                'correct_options' => ['Differential privacy'],
                'justifications' => [
                    'Tokenization replaces values but doesn\'t address analysis impact',
                    'FPE maintains format but doesn\'t address statistical privacy',
                    'Correct - Differential privacy specifically limits the impact of individual records on results',
                    'Masking obscures data but doesn\'t provide mathematical privacy guarantees'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Consent Withdrawal - Item 32
            [
                'topic_id' => $topics['Data Subject Rights & Data Portability'] ?? 95,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Under GDPR, withdrawing consent must be as easy as giving consent.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'GDPR Article 7(3) explicitly states that it must be as easy to withdraw consent as to give it. This means if consent was given with one click, withdrawal should also be possible with one click.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Privacy vs Security - Item 33
            [
                'topic_id' => $topics['Personally Identifiable Information (PII)'] ?? 88,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A security team wants to implement employee monitoring software that captures all keystrokes to detect insider threats. The privacy team objects. This represents a conflict between:',
                'options' => [
                    'Confidentiality and integrity',
                    'Security and privacy',
                    'Availability and confidentiality',
                    'Compliance and operations'
                ],
                'correct_options' => ['Security and privacy'],
                'justifications' => [
                    'Both are aspects of information protection, not in conflict here',
                    'Correct - Security goals (threat detection) conflict with privacy rights (employee privacy)',
                    'Availability isn\'t the issue in this scenario',
                    'While related, the core conflict is security vs privacy'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Privacy Budget - Item 34
            [
                'topic_id' => $topics['Security Safeguards'] ?? 94,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the fundamental goal of differential privacy in data protection?',
                'options' => [
                    'To encrypt all personal data in databases',
                    'To ensure individual privacy while allowing statistical analysis',
                    'To prevent any mathematical analysis of datasets',
                    'To remove all identifying information from data'
                ],
                'correct_options' => ['To ensure individual privacy while allowing statistical analysis'],
                'justifications' => [
                    'Differential privacy uses statistical noise, not encryption',
                    'Correct - Differential privacy allows useful statistical insights while protecting individual privacy',
                    'The goal is to enable analysis while protecting privacy, not prevent it',
                    'Differential privacy uses mathematical techniques beyond simple de-identification'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // DPIA Consultation - Item 35
            [
                'topic_id' => $topics['Privacy Impact Assessment (PIA) / DPIA'] ?? 99,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'After conducting a DPIA, an organization cannot mitigate the identified high risks. What must they do under GDPR?',
                'options' => [
                    'Proceed with enhanced monitoring',
                    'Abandon the processing activity',
                    'Consult the supervisory authority',
                    'Accept the risk and document it'
                ],
                'correct_options' => ['Consult the supervisory authority'],
                'justifications' => [
                    'Monitoring doesn\'t address unmitigated high risks',
                    'While an option, GDPR requires consultation first',
                    'Correct - Prior consultation with supervisory authority is mandatory for unmitigated high risks',
                    'High risks cannot simply be accepted without consultation'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Privacy-Preserving Analytics - Item 36
            [
                'topic_id' => $topics['Data Minimisation'] ?? 92,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A healthcare organization wants to share patient data with researchers while preserving privacy. They apply k-anonymity (k=10) and l-diversity (l=3). What additional protection does l-diversity provide?',
                'options' => [
                    'Ensures 10 identical records exist',
                    'Protects against homogeneity attacks on sensitive attributes',
                    'Adds random noise to the data',
                    'Encrypts sensitive fields'
                ],
                'correct_options' => ['Protects against homogeneity attacks on sensitive attributes'],
                'justifications' => [
                    'K-anonymity already ensures this',
                    'Correct - L-diversity ensures each k-anonymous group has at least l different sensitive values',
                    'L-diversity doesn\'t add noise, it ensures diversity',
                    'It\'s about diversity, not encryption'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Automated Decision Making - Item 37
            [
                'topic_id' => $topics['Data Subject Rights & Data Portability'] ?? 95,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A bank uses fully automated credit scoring to approve or deny loan applications. Under GDPR, what right do applicants have?',
                'options' => [
                    'Right to know the exact algorithm used',
                    'Right to human intervention and to contest the decision',
                    'Right to have their application automatically approved',
                    'Right to see other applicants\' scores'
                ],
                'correct_options' => ['Right to human intervention and to contest the decision'],
                'justifications' => [
                    'GDPR requires meaningful information, not exact algorithms',
                    'Correct - Article 22 provides rights regarding automated decision-making including human review',
                    'There\'s no right to approval',
                    'This would violate other applicants\' privacy'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Privacy Incident Response - Item 38
            [
                'topic_id' => $topics['Security Safeguards'] ?? 94,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A company discovers that customer passwords were stored in plaintext logs accessible to all employees for the past year. No evidence of misuse exists. What are their obligations?',
                'options' => [
                    'No action needed since no misuse occurred',
                    'Fix the issue and monitor for misuse',
                    'Notify supervisory authority and affected individuals',
                    'Only notify if customers ask about it'
                ],
                'correct_options' => ['Notify supervisory authority and affected individuals'],
                'justifications' => [
                    'Breach notification isn\'t dependent on proven misuse',
                    'Fixing is required but notification obligations exist',
                    'Correct - High risk to individuals (plaintext passwords) requires both authority and individual notification',
                    'Proactive notification is required for high-risk breaches'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Cross-Functional Privacy - Item 39
            [
                'topic_id' => $topics['Privacy by Design & by Default'] ?? 96,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each Privacy by Design principle with its implementation example:',
                'options' => [
                    'items' => [
                        'End-to-end encryption for messaging app',
                        'Privacy settings defaulted to most restrictive',
                        'Regular privacy training for all developers',
                        'Privacy features that enhance user experience'
                    ],
                    'responses' => [
                        'Full functionality',
                        'Privacy as default',
                        'Visibility and transparency',
                        'Positive-sum approach'
                    ]
                ],
                'correct_options' => [
                    'Full functionality',
                    'Privacy as default',
                    'Visibility and transparency',
                    'Positive-sum approach'
                ],
                'justifications' => [
                    'End-to-end encryption for messaging app' => 'Full lifecycle protection demonstrates full functionality',
                    'Privacy settings defaulted to most restrictive' => 'Automatic maximum privacy exemplifies privacy as default',
                    'Regular privacy training for all developers' => 'Training ensures transparent privacy practices',
                    'Privacy features that enhance user experience' => 'Win-win shows positive-sum thinking'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Modern Privacy Challenge - Item 40
            [
                'topic_id' => $topics['Data Sovereignty & Cross-Border Transfer (SCC, BCR, DPF)'] ?? 97,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Following the Schrems II decision, what is the primary concern with using Standard Contractual Clauses (SCCs) for EU-US data transfers?',
                'options' => [
                    'SCCs are no longer valid for any transfers',
                    'US surveillance laws may override SCC protections',
                    'SCCs are too expensive to implement',
                    'The EU no longer recognizes SCCs'
                ],
                'correct_options' => ['US surveillance laws may override SCC protections'],
                'justifications' => [
                    'SCCs remain valid but require additional assessment',
                    'Correct - The court found US surveillance laws could prevent companies from meeting SCC obligations',
                    'Cost wasn\'t a factor in the decision',
                    'The EU still recognizes SCCs with supplementary measures'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Privacy Metrics - Item 41
            [
                'topic_id' => $topics['Privacy by Design & by Default'] ?? 96,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which metric would best indicate the effectiveness of a privacy awareness program?',
                'options' => [
                    'Number of privacy policies published',
                    'Reduction in privacy-related incidents',
                    'Count of privacy training hours delivered',
                    'Number of privacy officers hired'
                ],
                'correct_options' => ['Reduction in privacy-related incidents'],
                'justifications' => [
                    'Policy count doesn\'t measure effectiveness',
                    'Correct - Fewer incidents indicate better privacy practices and awareness',
                    'Training hours measure activity, not effectiveness',
                    'Staffing levels don\'t directly indicate program success'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Pseudonymization vs Anonymization - Item 42
            [
                'topic_id' => $topics['Security Safeguards'] ?? 94,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A dataset has all direct identifiers replaced with random codes, with a separate key file linking codes to identities. Under GDPR, this data is:',
                'options' => [
                    'Anonymous and outside GDPR scope',
                    'Pseudonymous and still personal data',
                    'Encrypted and requires notification',
                    'Public data with no restrictions'
                ],
                'correct_options' => ['Pseudonymous and still personal data'],
                'justifications' => [
                    'Re-identification is possible with the key, so not anonymous',
                    'Correct - Pseudonymization is a security measure but data remains personal under GDPR',
                    'It\'s pseudonymization, not encryption',
                    'Still personal data subject to GDPR'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Purpose Limitation - Item 43 (L2)
            [
                'topic_id' => $topics['Purpose Limitation'] ?? 91,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Under Purpose Limitation, customer data collected for warranty registration can be used for product improvement research without additional consent.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Purpose Limitation requires that personal data be processed only for the specific, explicit, and legitimate purposes for which it was originally collected. Using warranty data for research requires additional consent or a compatible purpose assessment.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Data Minimisation - Item 44 (L2)
            [
                'topic_id' => $topics['Data Minimisation'] ?? 92,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A mobile app collects location data every second for fitness tracking. Users only need daily step counts. This violates Data Minimisation because:',
                'options' => [
                    'Location data is sensitive personal data',
                    'The frequency of collection exceeds what is necessary',
                    'Fitness tracking requires explicit consent',
                    'Mobile apps cannot collect location data'
                ],
                'correct_options' => ['The frequency of collection exceeds what is necessary'],
                'justifications' => [
                    'While location can be sensitive, the specific issue is frequency',
                    'Correct - Collecting data every second when daily summaries suffice violates minimisation',
                    'Consent is separate from the minimisation principle',
                    'Mobile apps can collect location with proper basis'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Collection Limitation - Item 45 (L2)
            [
                'topic_id' => $topics['Collection Limitation'] ?? 90,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which scenario best demonstrates proper application of Collection Limitation?',
                'options' => [
                    'Collecting all available social media data for future analysis',
                    'Gathering only delivery address and contact info for shipping',
                    'Requesting extensive personal history for a simple newsletter signup',
                    'Collecting biometric data for all employees regardless of role'
                ],
                'correct_options' => ['Gathering only delivery address and contact info for shipping'],
                'justifications' => [
                    'Collecting data for unspecified future use violates Collection Limitation',
                    'Correct - Only collecting necessary data for the specific shipping purpose',
                    'Extensive data for simple services violates the principle',
                    'Biometric collection must be justified for specific roles'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Security Safeguards - Item 46 (L3)
            [
                'topic_id' => $topics['Security Safeguards'] ?? 94,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'An organization implements role-based access controls for personal data. Employees can access data for multiple departments. How should they apply the principle of least privilege?',
                'options' => [
                    'Grant access to all department data for efficiency',
                    'Limit access to data needed for specific job functions',
                    'Allow temporary elevated access when requested',
                    'Provide read-only access to all personal data'
                ],
                'correct_options' => ['Limit access to data needed for specific job functions'],
                'justifications' => [
                    'Broad department access exceeds necessity',
                    'Correct - Least privilege means minimum access required for job duties',
                    'Temporary elevation should be rare and controlled',
                    'Read-only to all data still violates least privilege'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Privacy by Design - Item 47 (L3)
            [
                'topic_id' => $topics['Privacy by Design & by Default'] ?? 96,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A developer is designing a contact tracing app. How should they implement Privacy by Design to minimize personal data collection?',
                'options' => [
                    'Store all contact interactions in a central database',
                    'Use decentralized storage with cryptographic identifiers',
                    'Collect full identity information for contact accuracy',
                    'Share data with multiple health authorities automatically'
                ],
                'correct_options' => ['Use decentralized storage with cryptographic identifiers'],
                'justifications' => [
                    'Central storage creates privacy risks and single points of failure',
                    'Correct - Decentralized approach with crypto IDs minimizes data exposure',
                    'Full identity collection violates data minimisation',
                    'Automatic sharing without consent violates privacy principles'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Data Subject Rights - Item 48 (L3)
            [
                'topic_id' => $topics['Data Subject Rights & Data Portability'] ?? 95,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A data subject requests rectification of their personal data. The organization discovers the incorrect data has already been shared with third parties. What must they do?',
                'options' => [
                    'Only correct the data in their own systems',
                    'Notify the data subject that correction is impossible',
                    'Inform third parties about the correction where feasible',
                    'Wait for third parties to discover the error themselves'
                ],
                'correct_options' => ['Inform third parties about the correction where feasible'],
                'justifications' => [
                    'Correcting only own systems leaves incorrect data elsewhere',
                    'GDPR requires reasonable efforts to inform third parties',
                    'Correct - Organizations must inform recipients where feasible and proportionate',
                    'Passive waiting doesn\'t fulfill GDPR obligations'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // PII Handling - Item 49 (L3)
            [
                'topic_id' => $topics['Personally Identifiable Information (PII)'] ?? 88,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'An analytics system needs to track user behavior without storing PII. Which approach best achieves this goal?',
                'options' => [
                    'Hash email addresses with a random salt',
                    'Use session-based temporary identifiers',
                    'Store only the last 4 digits of phone numbers',
                    'Encrypt all personal data with reversible encryption'
                ],
                'correct_options' => ['Use session-based temporary identifiers'],
                'justifications' => [
                    'Hashed emails can still be considered personal data under GDPR',
                    'Correct - Temporary session IDs avoid storing PII while enabling analytics',
                    'Partial phone numbers may still identify individuals',
                    'Reversible encryption still constitutes PII storage'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Data Sovereignty - Item 50 (L3)
            [
                'topic_id' => $topics['Data Sovereignty & Cross-Border Transfer (SCC, BCR, DPF)'] ?? 97,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A European SaaS company wants to implement disaster recovery using cloud services in Japan. What is the most appropriate approach for GDPR compliance?',
                'options' => [
                    'Proceed without restrictions as disaster recovery is essential',
                    'Implement Standard Contractual Clauses with additional safeguards',
                    'Only use anonymized data for disaster recovery',
                    'Wait for Japan to receive an adequacy decision'
                ],
                'correct_options' => ['Implement Standard Contractual Clauses with additional safeguards'],
                'justifications' => [
                    'Essential services still require GDPR compliance for transfers',
                    'Correct - SCCs with supplementary measures enable compliant disaster recovery',
                    'Anonymization may not preserve system functionality',
                    'Adequacy decisions are unpredictable and may never occur'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Additional Level 4 question to reach perfect 7-10-16-10-7 distribution
            [
                'topic_id' => $topics['Privacy by Design & by Default'] ?? 96,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A company designs a new mobile app that requires location data for core functionality but also collects browsing history for advertising. Analyzing this against privacy by design principles, what is the PRIMARY concern?',
                'options' => [
                    'Insufficient encryption of location data',
                    'Lack of user consent for location tracking',
                    'Violation of data minimization principle',
                    'Inadequate data retention policies'
                ],
                'correct_options' => ['Violation of data minimization principle'],
                'justifications' => [
                    'Encryption is important but not the primary design principle violation',
                    'Consent is required but the fundamental issue is unnecessary data collection',
                    'Correct - Collecting browsing history for advertising violates data minimization when only location is needed for core functionality',
                    'Retention policies are important but secondary to collection limitation'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Additional Level 4 question to reach exactly 50 with 7-10-16-10-7
            [
                'topic_id' => $topics['Data Subject Rights & Data Portability'] ?? 95,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A data subject requests deletion of their personal data, but your organization needs to retain some data for legal compliance. How should you analyze this conflicting requirement?',
                'options' => [
                    'Deny the deletion request entirely',
                    'Delete all data regardless of legal requirements',
                    'Assess whether legal basis for retention overrides right to erasure',
                    'Delay response until legal requirements expire'
                ],
                'correct_options' => ['Assess whether legal basis for retention overrides right to erasure'],
                'justifications' => [
                    'Outright denial may violate data subject rights',
                    'Ignoring legal requirements creates compliance risks',
                    'Correct - Must analyze and balance legal obligations against data subject rights',
                    'Delays may violate response timeframes'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 4 (Privacy) diagnostic items seeded successfully!');
    }
}