<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D9DataGovernanceSeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Data Governance');
        })->pluck('id', 'name');
        
        
        $items = [
            // Data Classification & Categorisation - Item 1
            [
                'topic_id' => $topics['Data Classification & Categorisation'] ?? 71,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the PRIMARY purpose of data classification?',
                'options' => [
                    'To comply with regulatory requirements',
                    'To determine appropriate security controls based on data sensitivity',
                    'To reduce storage costs',
                    'To improve data quality'
                ],
                'correct_options' => ['To determine appropriate security controls based on data sensitivity'],
                'justifications' => [
                    'Compliance is a benefit but not the primary purpose',
                    'Correct - Classification helps apply proportionate security controls based on data value and sensitivity',
                    'Storage optimization is not the main goal of classification',
                    'Data quality is separate from classification'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Data Classification & Categorisation - Item 2
            [
                'topic_id' => $topics['Data Classification & Categorisation'] ?? 71,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these data classification levels from LEAST to MOST sensitive:',
                'options' => [
                    'Top Secret',
                    'Public',
                    'Confidential',
                    'Internal Use',
                    'Restricted'
                ],
                'correct_options' => [
                    'Public',
                    'Internal Use',
                    'Confidential',
                    'Restricted',
                    'Top Secret'
                ],
                'justifications' => ['Public data has no sensitivity, internal use is limited to employees, confidential requires protection, restricted has limited access, and top secret requires maximum protection.'],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Data Classification & Categorisation - Item 3
            [
                'topic_id' => $topics['Data Classification & Categorisation'] ?? 71,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the data types that typically require the HIGHEST classification level to the drop zone:',
                'options' => [
                    'Marketing brochures',
                    'Customer credit card numbers',
                    'Employee performance reviews',
                    'Company strategic plans',
                    'Public website content',
                    'Trade secrets'
                ],
                'correct_options' => [
                    'Customer credit card numbers',
                    'Company strategic plans',
                    'Trade secrets'
                ],
                'justifications' => [
                    'Marketing materials are typically public',
                    'Payment card data requires highest protection',
                    'Performance reviews are confidential but not highest level',
                    'Strategic plans are highly confidential',
                    'Public content has no classification',
                    'Trade secrets require maximum protection'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Data Owner / Custodian / Steward - Item 4
            [
                'topic_id' => $topics['Data Owner / Custodian / Steward'] ?? 72,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Who is responsible for determining data classification and access controls?',
                'options' => [
                    'Data custodian',
                    'Data owner',
                    'Data steward',
                    'Database administrator'
                ],
                'correct_options' => ['Data owner'],
                'justifications' => [
                    'Custodians implement controls but don\'t determine them',
                    'Correct - Data owners make decisions about classification and access',
                    'Stewards ensure data quality and proper use',
                    'DBAs are technical custodians, not decision makers'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Data Owner / Custodian / Steward - Item 5
            [
                'topic_id' => $topics['Data Owner / Custodian / Steward'] ?? 72,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each role with their primary responsibility:',
                'options' => [
                    'items' => [
                        'Data Owner',
                        'Data Custodian',
                        'Data Steward',
                        'Data User'
                    ],
                    'responses' => [
                        'Implements technical controls and backups',
                        'Makes classification and access decisions',
                        'Ensures data quality and governance compliance',
                        'Accesses data for business purposes'
                    ]
                ],
                'correct_options' => [
                    'Data Owner' => 'Makes classification and access decisions',
                    'Data Custodian' => 'Implements technical controls and backups',
                    'Data Steward' => 'Ensures data quality and governance compliance',
                    'Data User' => 'Accesses data for business purposes'
                ],
                'justifications' => [
                    'Data Owner' => 'Owners have business responsibility for data decisions',
                    'Data Custodian' => 'Custodians handle technical implementation',
                    'Data Steward' => 'Stewards manage data quality and governance',
                    'Data User' => 'Users consume data per established policies'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Data Owner / Custodian / Steward - Item 6
            [
                'topic_id' => $topics['Data Owner / Custodian / Steward'] ?? 72,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** A data custodian can change data classification levels based on technical considerations.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. Data custodians implement the controls specified by data owners but cannot change classification levels. Classification decisions are business decisions made by data owners based on data sensitivity and value, not technical considerations.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Data Retention - Item 7
            [
                'topic_id' => $topics['Data Retention'] ?? 73,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should be the PRIMARY driver for data retention periods?',
                'options' => [
                    'Storage capacity',
                    'Legal and regulatory requirements',
                    'User preferences',
                    'Technical limitations'
                ],
                'correct_options' => ['Legal and regulatory requirements'],
                'justifications' => [
                    'Storage is a consideration but not primary driver',
                    'Correct - Legal and regulatory requirements dictate minimum retention periods',
                    'User preferences don\'t override legal requirements',
                    'Technical limitations should be solved, not drive policy'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Data Retention - Item 8
            [
                'topic_id' => $topics['Data Retention'] ?? 73,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization wants to keep customer data indefinitely for analytics. Under GDPR, this is:',
                'options' => [
                    'Allowed with customer consent',
                    'Prohibited unless necessary for legal compliance',
                    'Allowed for legitimate business interests',
                    'Only allowed for anonymized data'
                ],
                'correct_options' => ['Only allowed for anonymized data'],
                'justifications' => [
                    'Consent alone doesn\'t justify indefinite retention',
                    'Legal compliance requires specific retention periods',
                    'Legitimate interest must be balanced with data minimization',
                    'Correct - Truly anonymized data is no longer personal data under GDPR'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Data Retention - Item 9
            [
                'topic_id' => $topics['Data Retention'] ?? 73,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the factors that should be considered when setting retention periods to the drop zone:',
                'options' => [
                    'Legal hold requirements',
                    'Storage costs',
                    'Regulatory compliance periods',
                    'Marketing preferences',
                    'Statute of limitations',
                    'Business needs'
                ],
                'correct_options' => [
                    'Legal hold requirements',
                    'Regulatory compliance periods',
                    'Statute of limitations',
                    'Business needs'
                ],
                'justifications' => [
                    'Legal holds override normal retention schedules',
                    'Cost is secondary to compliance requirements',
                    'Regulations often specify minimum retention',
                    'Marketing preferences don\'t drive retention policy',
                    'Legal action timeframes affect retention needs',
                    'Legitimate business needs should be documented'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Data Sanitisation & Destruction - Item 10
            [
                'topic_id' => $topics['Data Sanitisation & Destruction'] ?? 74,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which data sanitization method is MOST appropriate for highly sensitive data on SSDs?',
                'options' => [
                    'Single overwrite with zeros',
                    'Degaussing',
                    'Cryptographic erasure',
                    'File deletion'
                ],
                'correct_options' => ['Cryptographic erasure'],
                'justifications' => [
                    'Single overwrite may not reach all SSD cells due to wear leveling',
                    'Degaussing doesn\'t work on SSDs (only magnetic media)',
                    'Correct - Cryptographic erasure with key destruction ensures data is unrecoverable',
                    'File deletion doesn\'t remove data, only references'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Data Sanitisation & Destruction - Item 11
            [
                'topic_id' => $topics['Data Sanitisation & Destruction'] ?? 74,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Arrange these data destruction methods from LEAST to MOST secure:',
                'options' => [
                    'Physical destruction (shredding)',
                    'File system deletion',
                    'Single overwrite',
                    'Multiple overwrite (DoD standard)',
                    'Degaussing (for magnetic media)'
                ],
                'correct_options' => [
                    'File system deletion',
                    'Single overwrite',
                    'Multiple overwrite (DoD standard)',
                    'Degaussing (for magnetic media)',
                    'Physical destruction (shredding)'
                ],
                'justifications' => ['Deletion only removes pointers, overwriting replaces data, multiple passes ensure complete overwriting, degaussing destroys magnetic patterns, and physical destruction is irreversible.'],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Data Sanitisation & Destruction - Item 12
            [
                'topic_id' => $topics['Data Sanitisation & Destruction'] ?? 74,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Formatting a hard drive is sufficient to prevent data recovery by forensic tools.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. Formatting only removes the file system structure and directory information, not the actual data. Forensic tools can easily recover data from formatted drives. Proper sanitization requires overwriting, degaussing, or physical destruction.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Anonymisation & Pseudonymisation - Item 13
            [
                'topic_id' => $topics['Anonymisation & Pseudonymisation / Tokenisation'] ?? 75,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the KEY difference between anonymization and pseudonymization?',
                'options' => [
                    'Anonymization is cheaper to implement',
                    'Pseudonymization is irreversible',
                    'Anonymization is irreversible while pseudonymization can be reversed',
                    'They are the same concept'
                ],
                'correct_options' => ['Anonymization is irreversible while pseudonymization can be reversed'],
                'justifications' => [
                    'Cost is not the key differentiator',
                    'Pseudonymization is reversible with additional information',
                    'Correct - Anonymization permanently removes identifying information while pseudonymization allows re-identification',
                    'They are distinctly different concepts'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Anonymisation & Pseudonymisation - Item 14
            [
                'topic_id' => $topics['Anonymisation & Pseudonymisation / Tokenisation'] ?? 75,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each technique with its characteristic:',
                'options' => [
                    'items' => [
                        'Anonymization',
                        'Pseudonymization',
                        'Tokenization',
                        'Encryption'
                    ],
                    'responses' => [
                        'Replaces data with non-sensitive tokens',
                        'Irreversibly removes identifying information',
                        'Replaces identifiers with pseudonyms',
                        'Transforms data into ciphertext'
                    ]
                ],
                'correct_options' => [
                    'Anonymization' => 'Irreversibly removes identifying information',
                    'Pseudonymization' => 'Replaces identifiers with pseudonyms',
                    'Tokenization' => 'Replaces data with non-sensitive tokens',
                    'Encryption' => 'Transforms data into ciphertext'
                ],
                'justifications' => [
                    'Anonymization' => 'Permanent removal of identifying elements',
                    'Pseudonymization' => 'Uses artificial identifiers that can be mapped back',
                    'Tokenization' => 'Substitutes sensitive data with non-sensitive tokens',
                    'Encryption' => 'Mathematical transformation requiring keys'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Anonymisation & Pseudonymisation - Item 15
            [
                'topic_id' => $topics['Anonymisation & Pseudonymisation / Tokenisation'] ?? 75,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Under GDPR, which technique removes data from the scope of the regulation?',
                'options' => [
                    'Encryption',
                    'Pseudonymization',
                    'True anonymization',
                    'Tokenization'
                ],
                'correct_options' => ['True anonymization'],
                'justifications' => [
                    'Encrypted data is still personal data under GDPR',
                    'Pseudonymized data remains personal data under GDPR',
                    'Correct - Truly anonymized data is no longer personal data and GDPR doesn\'t apply',
                    'Tokenized data may still be personal data if reversible'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Data Loss Prevention (DLP) - Item 16
            [
                'topic_id' => $topics['Data Loss Prevention (DLP)'] ?? 76,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which DLP implementation point provides the MOST comprehensive coverage?',
                'options' => [
                    'Network DLP only',
                    'Endpoint DLP only',
                    'Cloud DLP only',
                    'Combination of network, endpoint, and cloud DLP'
                ],
                'correct_options' => ['Combination of network, endpoint, and cloud DLP'],
                'justifications' => [
                    'Network DLP misses local transfers and cloud uploads',
                    'Endpoint DLP misses network traffic not from endpoints',
                    'Cloud DLP only covers cloud services',
                    'Correct - Multiple DLP points provide comprehensive coverage across all data movement channels'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Data Loss Prevention (DLP) - Item 17
            [
                'topic_id' => $topics['Data Loss Prevention (DLP)'] ?? 76,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the DLP detection methods to the drop zone:',
                'options' => [
                    'Regular expression patterns',
                    'Antivirus signatures',
                    'Machine learning classification',
                    'Firewall rules',
                    'Data fingerprinting',
                    'Port blocking'
                ],
                'correct_options' => [
                    'Regular expression patterns',
                    'Machine learning classification',
                    'Data fingerprinting'
                ],
                'justifications' => [
                    'Regex patterns detect structured data like credit cards',
                    'Antivirus is for malware, not data loss',
                    'ML can classify sensitive content',
                    'Firewall rules are access control, not DLP',
                    'Fingerprinting identifies specific sensitive documents',
                    'Port blocking is network control, not DLP'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Data Loss Prevention (DLP) - Item 18
            [
                'topic_id' => $topics['Data Loss Prevention (DLP)'] ?? 76,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A DLP system blocks an employee from emailing a legitimate business document. This is an example of:',
                'options' => [
                    'True positive',
                    'False positive',
                    'True negative',
                    'False negative'
                ],
                'correct_options' => ['False positive'],
                'justifications' => [
                    'True positive would be correctly blocking sensitive data',
                    'Correct - False positive: blocking legitimate activity incorrectly identified as data loss',
                    'True negative is correctly allowing legitimate activity',
                    'False negative would be failing to block actual data loss'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Information Rights Management (IRM) - Item 19
            [
                'topic_id' => $topics['Information Rights Management (IRM)'] ?? 77,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the PRIMARY advantage of IRM over traditional access controls?',
                'options' => [
                    'Lower implementation cost',
                    'Easier user experience',
                    'Protection persists after data leaves the organization',
                    'Better performance'
                ],
                'correct_options' => ['Protection persists after data leaves the organization'],
                'justifications' => [
                    'IRM typically costs more than traditional controls',
                    'IRM often adds complexity for users',
                    'Correct - IRM protections travel with the data regardless of location',
                    'IRM usually impacts performance due to encryption'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Information Rights Management (IRM) - Item 20
            [
                'topic_id' => $topics['Information Rights Management (IRM)'] ?? 77,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the capabilities that IRM can enforce to the drop zone:',
                'options' => [
                    'Prevent copying text',
                    'Block network access',
                    'Set document expiration dates',
                    'Scan for malware',
                    'Restrict printing',
                    'Control forwarding'
                ],
                'correct_options' => [
                    'Prevent copying text',
                    'Set document expiration dates',
                    'Restrict printing',
                    'Control forwarding'
                ],
                'justifications' => [
                    'IRM can disable copy/paste functionality',
                    'Network control is not an IRM function',
                    'IRM can make documents expire after set dates',
                    'Malware scanning is separate from IRM',
                    'IRM can prevent or watermark printing',
                    'IRM can restrict email forwarding rights'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Information Rights Management (IRM) - Item 21
            [
                'topic_id' => $topics['Information Rights Management (IRM)'] ?? 77,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** IRM can prevent authorized users from taking photos of documents displayed on their screens.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. While IRM can control digital actions like copying, printing, and forwarding, it cannot prevent analog attacks such as taking photos of the screen with a camera or phone. This is a fundamental limitation of any digital rights management system.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Cross-topic questions
            
            // Item 22 - Classification and Retention
            [
                'topic_id' => $topics['Data Classification & Categorisation'] ?? 71,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How should data classification influence retention periods?',
                'options' => [
                    'Higher classification always means longer retention',
                    'Classification and retention are independent',
                    'Higher classification may require shorter retention due to risk',
                    'Only public data has retention requirements'
                ],
                'correct_options' => ['Higher classification may require shorter retention due to risk'],
                'justifications' => [
                    'High classification doesn\'t automatically mean longer retention',
                    'Classification should influence retention decisions',
                    'Correct - Highly sensitive data may need shorter retention to minimize exposure risk',
                    'All data types may have retention requirements'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 23 - DLP and Classification
            [
                'topic_id' => $topics['Data Loss Prevention (DLP)'] ?? 76,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A DLP system should be configured to be MOST restrictive for which classification level?',
                'options' => [
                    'Public',
                    'Internal Use Only',
                    'Confidential',
                    'All levels equally'
                ],
                'correct_options' => ['Confidential'],
                'justifications' => [
                    'Public data doesn\'t need DLP protection',
                    'Internal use needs some protection but not maximum',
                    'Correct - Highest classification needs most restrictive DLP rules',
                    'DLP should be proportionate to classification level'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 24 - Destruction and Compliance
            [
                'topic_id' => $topics['Data Sanitisation & Destruction'] ?? 74,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An employee finds old backup tapes scheduled for destruction but containing data under legal hold. What should they do?',
                'options' => [
                    'Proceed with destruction as scheduled',
                    'Immediately stop destruction and notify legal team',
                    'Destroy only the non-relevant portions',
                    'Wait for the legal hold to expire'
                ],
                'correct_options' => ['Immediately stop destruction and notify legal team'],
                'justifications' => [
                    'Legal hold overrides destruction schedules',
                    'Correct - Legal holds require immediate preservation of all potentially relevant data',
                    'Partial destruction could be considered spoliation',
                    'Active legal holds don\'t have predictable expiration'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 25 - Privacy and Anonymization
            [
                'topic_id' => $topics['Anonymisation & Pseudonymisation / Tokenisation'] ?? 75,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A healthcare organization wants to share patient data for research. Which approach provides the BEST balance of privacy and utility?',
                'options' => [
                    'Full anonymization removing all useful attributes',
                    'Pseudonymization with restricted access to mapping table',
                    'Encryption of the entire dataset',
                    'Tokenization of all fields'
                ],
                'correct_options' => ['Pseudonymization with restricted access to mapping table'],
                'justifications' => [
                    'Full anonymization may remove too much useful information',
                    'Correct - Pseudonymization preserves data utility while protecting identity',
                    'Encryption doesn\'t allow analysis without decryption',
                    'Tokenizing all fields destroys analytical value'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 26 - Roles and Responsibilities
            [
                'topic_id' => $topics['Data Owner / Custodian / Steward'] ?? 72,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'The IT department implements automatic data deletion after retention periods expire. Who must approve this implementation?',
                'options' => [
                    'Data custodian (IT department)',
                    'Data owners of affected data',
                    'Data stewards only',
                    'No approval needed if following policy'
                ],
                'correct_options' => ['Data owners of affected data'],
                'justifications' => [
                    'Custodians implement but don\'t approve business decisions',
                    'Correct - Data owners must approve any automated processes affecting their data',
                    'Stewards ensure quality but don\'t approve deletion',
                    'Even policy-based automation needs owner approval'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 27 - IRM and DLP Integration
            [
                'topic_id' => $topics['Information Rights Management (IRM)'] ?? 77,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each scenario with the most appropriate technology:',
                'options' => [
                    'items' => [
                        'Prevent email of credit card numbers',
                        'Control document access after sharing',
                        'Block USB file transfers',
                        'Expire document access after 30 days'
                    ],
                    'responses' => [
                        'DLP',
                        'IRM',
                        'Both DLP and IRM',
                        'Neither DLP nor IRM'
                    ]
                ],
                'correct_options' => [
                    'Prevent email of credit card numbers' => 'DLP',
                    'Control document access after sharing' => 'IRM',
                    'Block USB file transfers' => 'DLP',
                    'Expire document access after 30 days' => 'IRM'
                ],
                'justifications' => [
                    'Prevent email of credit card numbers' => 'DLP detects and blocks sensitive data patterns',
                    'Control document access after sharing' => 'IRM controls persist with the document',
                    'Block USB file transfers' => 'DLP monitors and controls data movement',
                    'Expire document access after 30 days' => 'IRM can enforce time-based access controls'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 28 - Data Governance Maturity
            [
                'topic_id' => $topics['Data Classification & Categorisation'] ?? 71,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these data governance practices from LEAST to MOST mature:',
                'options' => [
                    'Automated classification with ML',
                    'No formal classification',
                    'Manual classification by users',
                    'Centralized classification team',
                    'Classification at creation with validation'
                ],
                'correct_options' => [
                    'No formal classification',
                    'Manual classification by users',
                    'Centralized classification team',
                    'Classification at creation with validation',
                    'Automated classification with ML'
                ],
                'justifications' => ['Maturity progresses from no system, to manual user-driven, to centralized control, to embedded processes, and finally to intelligent automation.'],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 29 - Regulatory Compliance
            [
                'topic_id' => $topics['Data Retention'] ?? 73,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Different regulations require different retention periods for the same data type. How should this be handled?',
                'options' => [
                    'Follow the shortest period to minimize risk',
                    'Follow the longest period to ensure compliance',
                    'Average the different periods',
                    'Choose based on primary business location'
                ],
                'correct_options' => ['Follow the longest period to ensure compliance'],
                'justifications' => [
                    'Shortest period would violate some regulations',
                    'Correct - Following the longest period ensures compliance with all applicable regulations',
                    'Averaging has no legal basis',
                    'All applicable regulations must be followed regardless of location'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 30 - Data Lifecycle
            [
                'topic_id' => $topics['Data Sanitisation & Destruction'] ?? 74,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the appropriate destruction methods for CLOUD-STORED data to the drop zone:',
                'options' => [
                    'Physical shredding',
                    'Cryptographic erasure',
                    'Degaussing',
                    'Deletion via API with certificate',
                    'Overwriting',
                    'Account termination'
                ],
                'correct_options' => [
                    'Cryptographic erasure',
                    'Deletion via API with certificate',
                    'Account termination'
                ],
                'justifications' => [
                    'Cannot physically access cloud provider hardware',
                    'Crypto-shredding works if you control the keys',
                    'Cannot degauss cloud provider storage',
                    'API deletion with verification is cloud-appropriate',
                    'Cannot directly overwrite cloud storage',
                    'Account closure triggers provider deletion processes'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 31 - Anonymization Risks
            [
                'topic_id' => $topics['Anonymisation & Pseudonymisation / Tokenisation'] ?? 75,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Properly anonymized data can never be re-identified, even with additional external data sources.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. Even properly anonymized data can sometimes be re-identified through linkage attacks using external data sources, especially with big data analytics. This risk increases as more data becomes publicly available. True anonymization must consider current and future re-identification risks.'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 32 - DLP Strategy
            [
                'topic_id' => $topics['Data Loss Prevention (DLP)'] ?? 76,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the RECOMMENDED approach when initially deploying DLP?',
                'options' => [
                    'Block all suspicious activity immediately',
                    'Start in monitoring mode then gradually enforce',
                    'Focus only on email communications',
                    'Implement all rules at maximum sensitivity'
                ],
                'correct_options' => ['Start in monitoring mode then gradually enforce'],
                'justifications' => [
                    'Immediate blocking causes business disruption',
                    'Correct - Monitor first to understand patterns and reduce false positives before enforcement',
                    'Effective DLP must cover all data channels',
                    'Maximum sensitivity generates excessive false positives'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 33 - Rights Management Limitations
            [
                'topic_id' => $topics['Information Rights Management (IRM)'] ?? 77,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which attack vector is IRM LEAST effective against?',
                'options' => [
                    'Unauthorized forwarding',
                    'Printing sensitive documents',
                    'Malicious insiders with legitimate access',
                    'Copying and pasting content'
                ],
                'correct_options' => ['Malicious insiders with legitimate access'],
                'justifications' => [
                    'IRM can block forwarding functionality',
                    'IRM can disable or watermark printing',
                    'Correct - IRM cannot prevent authorized users from misusing their legitimate access',
                    'IRM can disable copy/paste functions'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 34 - Governance Integration
            [
                'topic_id' => $topics['Data Owner / Custodian / Steward'] ?? 72,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A merger requires combining two companies\' data governance programs. Who should lead this effort?',
                'options' => [
                    'IT departments from both companies',
                    'Joint committee of data owners',
                    'External consultants only',
                    'The acquiring company\'s team'
                ],
                'correct_options' => ['Joint committee of data owners'],
                'justifications' => [
                    'IT implements but doesn\'t own governance decisions',
                    'Correct - Data owners from both companies must align on governance standards',
                    'External consultants can assist but not lead',
                    'Unilateral decisions ignore valuable practices from both companies'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 35 - Retention vs Storage
            [
                'topic_id' => $topics['Data Retention'] ?? 73,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Finance wants to archive old data to cheap storage rather than delete it after retention expires. This approach:',
                'options' => [
                    'Is acceptable if storage is encrypted',
                    'Violates data minimization principles',
                    'Is fine if data is compressed',
                    'Only requires management approval'
                ],
                'correct_options' => ['Violates data minimization principles'],
                'justifications' => [
                    'Encryption doesn\'t address retention requirements',
                    'Correct - Keeping data beyond retention periods violates data minimization and increases risk',
                    'Compression doesn\'t change retention obligations',
                    'Retention requirements can\'t be overridden by management preference'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 36 - Destruction Verification
            [
                'topic_id' => $topics['Data Sanitisation & Destruction'] ?? 74,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each destruction method with its verification approach:',
                'options' => [
                    'items' => [
                        'Physical shredding',
                        'Cryptographic erasure',
                        'Degaussing',
                        'Overwriting'
                    ],
                    'responses' => [
                        'Certificate of destruction with photos',
                        'Key destruction audit logs',
                        'Gaussmeter readings',
                        'Read-back verification'
                    ]
                ],
                'correct_options' => [
                    'Physical shredding' => 'Certificate of destruction with photos',
                    'Cryptographic erasure' => 'Key destruction audit logs',
                    'Degaussing' => 'Gaussmeter readings',
                    'Overwriting' => 'Read-back verification'
                ],
                'justifications' => [
                    'Physical shredding' => 'Physical destruction requires visual evidence',
                    'Cryptographic erasure' => 'Verify keys are destroyed and unrecoverable',
                    'Degaussing' => 'Magnetic field measurements confirm degaussing',
                    'Overwriting' => 'Sample reads verify original data is gone'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 37 - Tokenization Implementation
            [
                'topic_id' => $topics['Anonymisation & Pseudonymisation / Tokenisation'] ?? 75,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'For PCI DSS compliance, which tokenization approach is MOST secure?',
                'options' => [
                    'Format-preserving tokenization',
                    'Random token generation with vault storage',
                    'Reversible encryption',
                    'Hash-based tokenization'
                ],
                'correct_options' => ['Random token generation with vault storage'],
                'justifications' => [
                    'Format-preserving may have cryptographic weaknesses',
                    'Correct - Random tokens with secure vault provide strongest security',
                    'Encryption is not tokenization and keys could be compromised',
                    'Hash collisions could theoretically allow reversal'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 38 - DLP Evasion
            [
                'topic_id' => $topics['Data Loss Prevention (DLP)'] ?? 76,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the methods that could potentially evade DLP detection to the drop zone:',
                'options' => [
                    'Encrypting files before sending',
                    'Using standard email',
                    'Splitting data across multiple messages',
                    'Using company VPN',
                    'Steganography',
                    'Regular file attachments'
                ],
                'correct_options' => [
                    'Encrypting files before sending',
                    'Splitting data across multiple messages',
                    'Steganography'
                ],
                'justifications' => [
                    'DLP cannot inspect encrypted content',
                    'Standard channels are what DLP monitors',
                    'Splitting can bypass pattern detection',
                    'VPN doesn\'t hide data from DLP',
                    'Hidden data in images can evade detection',
                    'Regular attachments are inspected by DLP'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 39 - IRM Business Impact
            [
                'topic_id' => $topics['Information Rights Management (IRM)'] ?? 77,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is typically the BIGGEST challenge when implementing IRM?',
                'options' => [
                    'Technical complexity',
                    'High software costs',
                    'User adoption and workflow disruption',
                    'Storage requirements'
                ],
                'correct_options' => ['User adoption and workflow disruption'],
                'justifications' => [
                    'Technical implementation is well-established',
                    'Costs are predictable and manageable',
                    'Correct - IRM often disrupts established workflows, causing user resistance',
                    'Storage impact is minimal with modern IRM'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 40 - Comprehensive Governance
            [
                'topic_id' => $topics['Data Classification & Categorisation'] ?? 71,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An AI system is trained on anonymized customer data. Under data governance principles, this requires:',
                'options' => [
                    'No special considerations since data is anonymized',
                    'Review to ensure anonymization is sufficient for AI risks',
                    'Complete prohibition of AI use',
                    'Only technical approval'
                ],
                'correct_options' => ['Review to ensure anonymization is sufficient for AI risks'],
                'justifications' => [
                    'AI can sometimes re-identify anonymized data',
                    'Correct - AI poses unique re-identification risks requiring special review',
                    'Prohibition may be excessive if risks are managed',
                    'Business and privacy review needed, not just technical'
                ],
                'difficulty_level' => $difficulties['Very Hard'] ?? 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 41 - Multi-regulation
            [
                'topic_id' => $topics['Data Retention'] ?? 73,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A global company must comply with conflicting data retention laws: EU requires deletion after 2 years, while India requires 7-year retention. The solution is:',
                'options' => [
                    'Keep all data for 7 years globally',
                    'Implement geographic data segregation',
                    'Follow home country law only',
                    'Delete after 2 years globally'
                ],
                'correct_options' => ['Implement geographic data segregation'],
                'justifications' => [
                    'Would violate EU data minimization requirements',
                    'Correct - Segregate data by jurisdiction to comply with local laws',
                    'Must comply with laws where data subjects reside',
                    'Would violate Indian retention requirements'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 42 - Advanced DLP
            [
                'topic_id' => $topics['Data Loss Prevention (DLP)'] ?? 76,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A DLP system must protect intellectual property that lacks consistent patterns. The BEST approach is:',
                'options' => [
                    'Regular expression matching',
                    'Document fingerprinting',
                    'Keyword lists',
                    'Block all external sharing'
                ],
                'correct_options' => ['Document fingerprinting'],
                'justifications' => [
                    'Regex requires consistent patterns',
                    'Correct - Fingerprinting can identify specific documents regardless of format',
                    'Keywords generate too many false positives',
                    'Blocking all sharing prevents business functions'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 43 - Basic Data Classification (L1)
            [
                'topic_id' => $topics['Data Classification & Categorisation'] ?? 71,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which data classification level typically applies to employee phone numbers in company directories?',
                'options' => [
                    'Public',
                    'Internal Use Only',
                    'Confidential',
                    'Restricted'
                ],
                'correct_options' => ['Internal Use Only'],
                'justifications' => [
                    'Phone numbers are not generally public information',
                    'Correct - Employee phone numbers are typically internal use only',
                    'Phone numbers don\'t require confidential level protection',
                    'Phone numbers don\'t need restricted access controls'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 44 - Data Owner Identification (L1)
            [
                'topic_id' => $topics['Data Owner / Custodian / Steward'] ?? 72,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'For customer contact information, who should typically be designated as the data owner?',
                'options' => [
                    'IT Department',
                    'Database Administrator',
                    'Chief Marketing Officer',
                    'Chief Security Officer'
                ],
                'correct_options' => ['Chief Marketing Officer'],
                'justifications' => [
                    'IT manages the technology but doesn\'t own the business data',
                    'DBAs are custodians, not owners',
                    'Correct - Marketing typically owns customer relationship data',
                    'CSO focuses on security, not business data ownership'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 45 - Basic Retention Policy (L1)
            [
                'topic_id' => $topics['Data Retention'] ?? 73,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What information should be included in a basic data retention schedule?',
                'options' => [
                    'Data type and retention period only',
                    'Data type, retention period, and destruction method',
                    'Only the retention period',
                    'Only the destruction method'
                ],
                'correct_options' => ['Data type, retention period, and destruction method'],
                'justifications' => [
                    'Missing destruction method creates compliance gaps',
                    'Correct - Complete retention schedules include data type, period, and destruction method',
                    'Must specify what data the period applies to',
                    'Must specify both retention period and data types'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 46 - Basic Sanitization Knowledge (L1)
            [
                'topic_id' => $topics['Data Sanitisation & Destruction'] ?? 74,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the difference between data deletion and data destruction?',
                'options' => [
                    'They are the same thing',
                    'Deletion removes file pointers, destruction makes data unrecoverable',
                    'Destruction is faster than deletion',
                    'Deletion is more secure than destruction'
                ],
                'correct_options' => ['Deletion removes file pointers, destruction makes data unrecoverable'],
                'justifications' => [
                    'Deletion and destruction serve different security purposes',
                    'Correct - Deletion removes references while destruction ensures data cannot be recovered',
                    'Speed is not the differentiating factor',
                    'Destruction is more secure than simple deletion'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 47 - Advanced Classification Analysis (L4)
            [
                'topic_id' => $topics['Data Classification & Categorisation'] ?? 71,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A dataset contains aggregated sales data by region. Individual transaction details were removed, but the dataset still shows which regions performed poorly. How should this impact classification?',
                'options' => [
                    'Classify as Public since no individual data remains',
                    'Classify as Internal since it contains business performance data',
                    'Classify the same as the original transaction data',
                    'Classification depends only on aggregation level, not content sensitivity'
                ],
                'correct_options' => ['Classify as Internal since it contains business performance data'],
                'justifications' => [
                    'Regional performance data has business sensitivity even if anonymized',
                    'Correct - Business performance information requires internal classification regardless of aggregation',
                    'Aggregation reduces but doesn\'t eliminate business sensitivity',
                    'Content sensitivity must be considered in classification decisions'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 48 - Complex Retention Analysis (L4)
            [
                'topic_id' => $topics['Data Retention'] ?? 73,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization collects biometric data for access control and also uses it for attendance tracking. Employment law requires 7-year retention for attendance, but privacy law suggests biometrics should be deleted when employment ends. What approach best balances these requirements?',
                'options' => [
                    'Delete all biometric data when employment ends',
                    'Keep all biometric data for 7 years',
                    'Separate biometric templates from attendance data and apply different retention',
                    'Ignore privacy law since employment law takes precedence'
                ],
                'correct_options' => ['Separate biometric templates from attendance data and apply different retention'],
                'justifications' => [
                    'Would violate employment law retention requirements',
                    'Would violate privacy principles for biometric data',
                    'Correct - Data separation allows appropriate retention for each purpose',
                    'Both laws must be considered and balanced'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 49 - DLP Effectiveness Analysis (L4)
            [
                'topic_id' => $topics['Data Loss Prevention (DLP)'] ?? 76,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A company discovers that employees are using steganography to hide sensitive data in image files. Which DLP enhancement would be most effective?',
                'options' => [
                    'Increase network bandwidth monitoring',
                    'Implement content inspection with steganography detection',
                    'Block all image file transfers',
                    'Increase email attachment size limits'
                ],
                'correct_options' => ['Implement content inspection with steganography detection'],
                'justifications' => [
                    'Bandwidth monitoring won\'t detect hidden content',
                    'Correct - Specialized steganography detection can identify hidden data in images',
                    'Blocking all images would severely impact business operations',
                    'Size limits don\'t address steganography'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 50 - Comprehensive Privacy Assessment (L5)
            [
                'topic_id' => $topics['Anonymisation & Pseudonymisation / Tokenisation'] ?? 75,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A research organization wants to share medical data with multiple external partners. The data includes rare disease cases that could potentially be re-identified. Which approach provides the best balance of utility and privacy protection?',
                'options' => [
                    'Full anonymization removing all potentially identifying fields',
                    'Differential privacy with carefully calibrated noise injection',
                    'Strong pseudonymization with separate key management',
                    'Data use agreements with contractual protections only'
                ],
                'correct_options' => ['Differential privacy with carefully calibrated noise injection'],
                'justifications' => [
                    'Full anonymization may remove too much utility for rare diseases',
                    'Correct - Differential privacy provides mathematical privacy guarantees while preserving statistical utility',
                    'Pseudonymization still allows potential re-identification of rare cases',
                    'Contractual protections alone don\'t address technical re-identification risks'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 9 (Data Governance) diagnostic items seeded successfully!');
    }
}