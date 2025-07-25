<?php

namespace Database\Seeders\Diagnostics;

class D4PrivacySeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Privacy';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: Personal Information (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 1 - L1 - Remember
            [
                'topic' => 'Personal Information',
                'subtopic' => 'Personal Information',
                'type_id' => 1,
                'question' => 'Which of the following BEST defines Personally Identifiable Information (PII)?',
                'options' => [
                    'Information used to track user behavior on a website',
                    'Any information that can directly or indirectly identify an individual',
                    'Any government-issued identification number',
                    'Only information that can uniquely identify an individual on its own',
                ],
                'correct_options' => ['Any information that can directly or indirectly identify an individual'],
                'justifications' => [
                    'Tracking data may or may not be PII depending on whether it can be linked to an individual. Anonymous behavioral data alone is not PII.',
                    'Correct - PII includes any information that can be used alone or in combination with other data to identify an individual, whether directly (like a name) or indirectly (like a combination of zip code, birth date, and gender).',
                    'Government-issued IDs are examples of PII, but PII encompasses much more than just government identifiers.',
                    'This definition is too narrow. PII includes indirect identifiers that may need to be combined with other information to identify someone, not just standalone unique identifiers.',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
            ],

            // Item 2 - L1 - Remember
            [
                'topic' => 'Personal Information',
                'subtopic' => 'Personal Information',
                'type_id' => 1,
                'question' => 'Which of the following is a direct identifier?',
                'options' => [
                    'Gender',
                    'ZIP Code',
                    'Email address',
                    'Date of birth',
                ],
                'correct_options' => ['Email address'],
                'justifications' => [
                    'Gender is an indirect identifier',
                    'ZIP Code is an indirect identifier',
                    'Correct - Email address is a direct identifier',
                    'Date of birth is an indirect identifier',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.7,
                'irt_c' => 0.25,
            ],

            // Item 3 - L1 - Remember
            [
                'topic' => 'Personal Information',
                'subtopic' => 'Personal Information',
                'type_id' => 1,
                'question' => 'Is an IP address considered personal information under GDPR?',
                'options' => [
                    'No, IP addresses only identify devices',
                    'Only static IP addresses are personal information',
                    'Yes, IP addresses are personal information',
                    'Only dynamic IP addresses are personal information',
                ],
                'correct_options' => ['Yes, IP addresses are personal information'],
                'justifications' => [
                    'IP addresses can be linked to individuals',
                    'Both static and dynamic IP addresses are personal information',
                    'Correct - GDPR considers IP addresses as personal information',
                    'Both types of IP addresses are considered personal information',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
            ],

            // Item 4 - L3 - Apply
            [
                'topic' => 'Personal Information',
                'subtopic' => 'Personal Information',
                'type_id' => 1,
                'question' => 'A fitness app collects step count, heart rate, and GPS location. How should this data be classified under privacy frameworks?',
                'options' => [
                    'Non-personal data since it\'s just device measurements',
                    'Personal data requiring standard privacy protections',
                    'Sensitive personal data requiring heightened protection due to health information',
                    'Public data since users voluntarily share it',
                ],
                'correct_options' => ['Sensitive personal data requiring heightened protection due to health information'],
                'justifications' => [
                    'Device measurements linked to individuals constitute personal data',
                    'While personal, health-related data typically requires higher protection',
                    'Correct - Heart rate and health metrics are sensitive personal data under most privacy frameworks',
                    'Voluntary sharing doesn\'t make data public or exempt from privacy protections',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
            ],

            // Item 5 - L3 - Apply
            [
                'topic' => 'Personal Information',
                'subtopic' => 'Personal Information',
                'type_id' => 1,
                'question' => 'Which of the following is MOST likely to be considered indirect personal information?',
                'options' => [
                    'Passport number',
                    'Retina scan',
                    'IP address',
                    'Social Security Number',
                ],
                'correct_options' => ['IP address'],
                'justifications' => [
                    'A passport number is a direct identifier as it uniquely identifies an individual and is officially issued for that specific person.',
                    'A retina scan is biometric data that directly and uniquely identifies an individual. It is considered a direct identifier and often classified as sensitive personal data.',
                    'Correct - An IP address is typically considered indirect personal information because while it can help identify an individual, it usually requires additional information (like ISP records or other data points) to definitively link it to a specific person.',
                    'A Social Security Number is a direct identifier as it is uniquely assigned to an individual and can directly identify them without additional information.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 6
            [
                'topic' => 'Personal Information',
                'subtopic' => 'Personal Information',
                'type_id' => 1,
                'question' => 'How should you handle a request for data portability when the individual\'s data is intermingled with other individuals\' data?',
                'options' => [
                    'Deny the request since the data cannot be separated',
                    'Provide all data including other individuals\' information',
                    'Extract and provide only the requesting individual\'s data',
                    'Provide a summary report instead of raw data',
                ],
                'correct_options' => ['Extract and provide only the requesting individual\'s data'],
                'justifications' => [
                    'Technical complexity doesn\'t override data portability rights',
                    'Providing others\' data would violate their privacy rights',
                    'Correct - Extract only the requester\'s data while protecting others\' information',
                    'Data portability requires machine-readable data, not just summaries',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
            ],

            // Item 7 - L3 - Apply
            [
                'topic' => 'Personal Information',
                'subtopic' => 'Personal Information',
                'type_id' => 1,
                'question' => 'An organization wants to retain purchase history and demographics for future analytics. Which factor MOST influences whether the dataset qualifies as personal data?',
                'options' => [
                    'Whether users have given consent',
                    'Whether any record can be linked to a living individual',
                    'Whether the data is encrypted at rest',
                    'Whether it was collected via a website or app',
                ],
                'correct_options' => ['Whether any record can be linked to a living individual'],
                'justifications' => [
                    'Consent relates to the lawfulness of processing but does not determine whether data is personal data. Data remains personal data regardless of consent status.',
                    'Correct - The fundamental test for personal data is whether it relates to an identified or identifiable living individual. If purchase history and demographics can be linked to specific individuals, it constitutes personal data.',
                    'Encryption is a security measure that protects data but does not change its classification as personal data. Encrypted personal data is still personal data.',
                    'The collection method does not determine whether data is personal. Personal data collected through any channel (website, app, phone, in-person) remains personal data.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.20,
            ],

            // Item 8
            [
                'topic' => 'Personal Information',
                'subtopic' => 'Personal Information',
                'type_id' => 1,
                'question' => 'What is the fundamental challenge in defining personal information in IoT and smart device ecosystems?',
                'options' => [
                    'IoT devices are too small to store meaningful data',
                    'Sensor data patterns can reveal personal behaviors even without direct identifiers',
                    'IoT devices only collect technical performance metrics',
                    'Privacy laws don\'t apply to IoT devices',
                ],
                'correct_options' => ['Sensor data patterns can reveal personal behaviors even without direct identifiers'],
                'justifications' => [
                    'Modern IoT devices have significant storage and processing capabilities',
                    'Correct - Behavioral patterns from sensors can identify individuals without traditional identifiers',
                    'IoT devices collect extensive personal and behavioral data beyond technical metrics',
                    'Privacy laws increasingly address IoT data collection',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
            ],

            // Item 9 - L5 - Evaluate
            [
                'topic' => 'Personal Information',
                'subtopic' => 'Personal Information',
                'type_id' => 1,
                'question' => 'A social media company argues that "public posts" are not personal data since users made them public. Evaluate this position.',
                'options' => [
                    'Correct - public information loses personal data protections',
                    'Incorrect - the data subject relationship makes it personal data regardless of visibility',
                    'Correct only if users explicitly waived privacy rights',
                    'Incorrect only for sensitive categories like health information',
                ],
                'correct_options' => ['Incorrect - the data subject relationship makes it personal data regardless of visibility'],
                'justifications' => [
                    'Public visibility doesn\'t remove personal data status under privacy laws',
                    'Correct - Data remains personal if it relates to an identifiable individual, regardless of public visibility',
                    'Public posting doesn\'t constitute a blanket privacy waiver',
                    'All personal data retains protection, not just sensitive categories',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
            ],

            // Item 10
            [
                'topic' => 'Personal Information',
                'subtopic' => 'Personal Information',
                'type_id' => 1,
                'question' => 'Evaluate the privacy implications of using "synthetic data" generated from real personal data for AI training.',
                'options' => [
                    'Synthetic data eliminates all privacy concerns since it\'s artificially generated',
                    'Privacy risks remain if synthetic data can be reverse-engineered to original data',
                    'Synthetic data is only problematic if it contains direct identifiers',
                    'Privacy laws don\'t apply to synthetic data regardless of source',
                ],
                'correct_options' => ['Privacy risks remain if synthetic data can be reverse-engineered to original data'],
                'justifications' => [
                    'Synthetic data may still contain patterns that reveal original data',
                    'Correct - Re-identification risks exist if synthetic data preserves too many original data characteristics',
                    'Privacy risks can exist without direct identifiers through pattern analysis',
                    'Legal applicability depends on re-identification risk and data generation methods',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
            ],

            // Topic 2: Privacy Principles (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L1 - Remember
            [
                'topic' => 'Privacy Principles',
                'subtopic' => 'Privacy Principles',
                'type_id' => 1,
                'question' => 'Which of the following is NOT a core GDPR principle regarding the use of personal data?',
                'options' => [
                    'Lawfulness, Fairness, and Transparency',
                    'Data Minimization',
                    'Purpose Limitation',
                    'Data Portability',
                ],
                'correct_options' => ['Data Portability'],
                'justifications' => [
                    'This is a core GDPR principle that ensures personal data is processed lawfully, fairly, and in a transparent manner in relation to the data subject.',
                    'This is a core GDPR principle that ensures personal data is adequate, relevant, and limited to what is necessary in relation to the purposes for which they are processed.',
                    'This is a core GDPR principle that ensures personal data is collected for specified, explicit, and legitimate purposes and not further processed in a manner that is incompatible with those purposes.',
                    'While data portability is a right under the GDPR, it is not considered a core principle. The core principles focus on the broader guidelines and restrictions on the processing of personal data, whereas data portability is a specific right provided to data subjects.',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
            ],

            // Item 12 - L2 - Understand
            [
                'topic' => 'Privacy Principles',
                'subtopic' => 'Privacy Principles',
                'type_id' => 1,
                'question' => 'An organization determines that processing certain personal data is necessary to comply with an anti-money laundering law. What is the most appropriate legal basis for this processing?',
                'options' => [
                    'Consent, as individuals should agree to financial monitoring',
                    'Contract, as it\'s part of doing business',
                    'Legal obligation, as it\'s mandated by law',
                    'Legitimate interest, for business security',
                ],
                'correct_options' => ['Legal obligation, as it\'s mandated by law'],
                'justifications' => [
                    'Consent is inappropriate for legally mandated processing. Organizations cannot make compliance with legal obligations dependent on consent, which can be withdrawn.',
                    'While financial services involve contracts, anti-money laundering compliance is a legal requirement independent of contractual relationships.',
                    'Correct - When processing is necessary to comply with a legal obligation (such as anti-money laundering laws), Article 6(1)(c) provides the appropriate legal basis. The organization has no choice but to process the data.',
                    'Legitimate interest is not appropriate when there is a specific legal obligation. The processing is mandatory, not based on a balance of interests.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
            ],

            // Item 13 - L1 - Remember
            [
                'topic' => 'Privacy Principles',
                'subtopic' => 'Privacy Principles',
                'type_id' => 1,
                'question' => 'Which GDPR principle requires organizations to demonstrate compliance?',
                'options' => [
                    'Transparency',
                    'Fairness',
                    'Accountability',
                    'Lawfulness',
                ],
                'correct_options' => ['Accountability'],
                'justifications' => [
                    'Transparency relates to informing data subjects',
                    'Fairness relates to how data is processed',
                    'Correct - Accountability requires demonstrating compliance',
                    'Lawfulness relates to having legal basis for processing',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
            ],

            // Item 14 - L3 - Apply
            [
                'topic' => 'Privacy Principles',
                'subtopic' => 'Privacy Principles',
                'type_id' => 1,
                'question' => 'A data controller processes personal data for a task carried out in the public interest. To determine if this processing is lawful, which of the following is most crucial?',
                'options' => [
                    'Obtaining explicit consent from all data subjects',
                    'Ensuring the processing is based on a specific provision in law',
                    'Conducting a comprehensive Data Protection Impact Assessment (DPIA) only',
                    'Demonstrating a clear commercial benefit for the controller',
                ],
                'correct_options' => ['Ensuring the processing is based on a specific provision in law'],
                'justifications' => [
                    'Public interest processing does not require consent. In fact, relying on consent when processing is necessary for public interest tasks can be problematic.',
                    'Correct - Under GDPR Article 6(1)(e), processing for public interest tasks must be based on Union or Member State law. The public interest task must have a clear legal basis.',
                    'While a DPIA may be required for high-risk processing, it alone does not establish the lawfulness of public interest processing. The legal basis must exist independently.',
                    'Public interest processing is not about commercial benefits. It relates to tasks that serve the public good and must be grounded in law, not commercial interests.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.5,
                'irt_c' => 0.20,
            ],

            // Item 15 - L3 - Apply
            [
                'topic' => 'Privacy Principles',
                'subtopic' => 'Privacy Principles',
                'type_id' => 1,
                'question' => 'A tech startup is developing a new social networking app. To enhance user experience, the app automatically collects users\' precise location data even when the app is in the background, without a clear, specific, and easily understandable notice. Which GDPR principle is MOST likely to be violated by this practice?',
                'options' => [
                    'Data minimization',
                    'Storage limitation',
                    'Transparency',
                    'Accuracy',
                ],
                'correct_options' => ['Transparency'],
                'justifications' => [
                    'While collecting precise location data continuously might raise data minimization concerns, the primary violation here is the lack of clear notice about this collection.',
                    'Storage limitation relates to how long data is kept, not how it\'s collected or whether users are informed about the collection.',
                    'Correct - The transparency principle requires that data subjects be informed about data collection in a clear, specific, and easily understandable manner. Collecting location data without proper notice directly violates this principle.',
                    'The accuracy principle relates to keeping personal data correct and up to date, which is not the issue in this scenario.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 16 - L3 - Apply
            [
                'topic' => 'Privacy Principles',
                'subtopic' => 'Privacy Principles',
                'type_id' => 1,
                'question' => 'An EU citizen is traveling in the United States and requires medical attention. During the visit, a U.S.-based hospital collects the individual\'s personal and medical data for treatment purposes. Which of the following statements is TRUE regarding the hospital\'s data protection obligations?',
                'options' => [
                    'The U.S. hospital must comply with the EU GDPR because the patient is an EU citizen',
                    'The U.S. hospital must adhere to both GDPR and HIPAA due to the dual nature of the data (EU citizenship and medical information)',
                    'The U.S. hospital must comply with HIPAA, not GDPR, as the data processing occurs in the U.S. for domestic healthcare purposes',
                    'The U.S. hospital can share the data with third parties without consent since the patient is a foreign national',
                ],
                'correct_options' => ['The U.S. hospital must comply with HIPAA, not GDPR, as the data processing occurs in the U.S. for domestic healthcare purposes'],
                'justifications' => [
                    'GDPR does not automatically apply to U.S.-based organizations solely because the data belongs to an EU citizen. GDPR applies when data is processed within the EU or by entities targeting EU residents, which is not the case here.',
                    'While HIPAA governs medical data in the U.S., GDPR does not apply to data processed domestically in the U.S., even if the individual is an EU citizen.',
                    'Correct - HIPAA governs healthcare data protection within the U.S., and since the data processing occurs locally for healthcare purposes, GDPR does not apply.',
                    'HIPAA strictly prohibits sharing patient data without consent or legal justification, regardless of nationality.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
            ],

            // Item 17 - L5 - Evaluate
            [
                'topic' => 'Privacy Principles',
                'subtopic' => 'Privacy Principles',
                'type_id' => 1,
                'question' => 'Evaluate the optimal balance between transparency and security when implementing privacy programs in high-risk environments.',
                'options' => [
                    'Always prioritize transparency over security concerns',
                    'Security should always override transparency requirements',
                    'Risk-based approach balancing transparency obligations with security needs',
                    'Separate systems eliminate any conflicts between these principles',
                ],
                'correct_options' => ['Risk-based approach balancing transparency obligations with security needs'],
                'justifications' => [
                    'Absolute transparency can create security vulnerabilities',
                    'Security cannot completely override legal transparency requirements',
                    'Correct - Risk-based approaches balance legal obligations with security imperatives',
                    'System separation does not resolve the fundamental tension between these principles',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
            ],

            // Item 18
            [
                'topic' => 'Privacy Principles',
                'subtopic' => 'Privacy Principles',
                'type_id' => 1,
                'question' => 'What is the fundamental challenge in applying "purpose limitation" to machine learning systems?',
                'options' => [
                    'Machine learning models are too complex to audit',
                    'ML systems can discover purposes not originally intended or foreseeable',
                    'Purpose limitation doesn\'t apply to automated decision-making',
                    'Machine learning only uses public datasets',
                ],
                'correct_options' => ['ML systems can discover purposes not originally intended or foreseeable'],
                'justifications' => [
                    'Complexity is a challenge but not the fundamental issue with purpose limitation',
                    'Correct - ML can reveal insights and enable uses beyond original collection purposes',
                    'Purpose limitation applies to all processing including automated decisions',
                    'ML systems use various data types, not just public datasets',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
            ],

            // Item 19 - L5 - Evaluate
            [
                'topic' => 'Privacy Principles',
                'subtopic' => 'Privacy Principles',
                'type_id' => 1,
                'question' => 'A medical research institute collects genetic data from volunteers for a specific study on cancer. After the study concludes, they de-identify the data but decide to retain the raw genetic samples indefinitely, citing "potential future research." As a privacy professional, what is the MOST appropriate recommendation?',
                'options' => [
                    'Allow retention of raw samples since they are de-identified and pose no privacy risks',
                    'Require explicit re-consent from participants for future research uses',
                    'Limit retention and dispose of raw genetic samples unless a new, specific purpose is identified and approved',
                    'Store the samples indefinitely under the basis of legitimate interest in medical innovation',
                ],
                'correct_options' => ['Limit retention and dispose of raw genetic samples unless a new, specific purpose is identified and approved'],
                'justifications' => [
                    'De-identification of genetic data is extremely difficult if not impossible, and raw genetic samples can always be re-identified. They pose significant privacy risks.',
                    'While re-consent is good practice, the fundamental issue is indefinite retention without a specific purpose, which violates data minimization and storage limitation principles.',
                    'Correct - This approach aligns with purpose limitation and storage limitation principles. Genetic data should only be retained as long as necessary for the specified purpose, and new research purposes require proper justification and approval.',
                    'Legitimate interest is rarely if ever appropriate for processing genetic data, which is special category data requiring explicit consent. Indefinite retention for vague future purposes violates core privacy principles.',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
            ],

            // Item 20 - L3 - Apply
            [
                'topic' => 'Privacy Principles',
                'subtopic' => 'Privacy Principles',
                'type_id' => 1,
                'question' => 'A popular fitness app collects users\' precise location data, heart rate, and sleep patterns. Initially, the app\'s privacy policy states this data is for "personalized fitness recommendations." Later, the company considers selling aggregated, but still linkable, activity data to insurance providers to inform health policy premiums. This shift in usage directly challenges which GDPR principle?',
                'options' => [
                    'Data Minimization',
                    'Accuracy',
                    'Purpose Limitation',
                    'Storage Limitation',
                ],
                'correct_options' => ['Purpose Limitation'],
                'justifications' => [
                    'Incorrect. Data minimization relates to collecting only necessary data, not changing how it\'s used after collection.',
                    'Incorrect. Accuracy principle ensures data is correct and up-to-date, which is not the issue here.',
                    'Correct. Purpose limitation principle requires that personal data collected for specified purposes should not be further processed in a manner incompatible with those purposes. Using fitness data for insurance assessment is incompatible with the original purpose.',
                    'Incorrect. Storage limitation relates to how long data is kept, not how it\'s used.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.20,
            ],

            // Topic 3: Data Subject Rights (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L2 - Understand
            [
                'topic' => 'Data Subject Rights',
                'subtopic' => 'Data Subject Rights',
                'type_id' => 1,
                'question' => 'Which of the following statements accurately describes the Right to be Forgotten under the GDPR?',
                'options' => [
                    'The data subject can demand the immediate deletion of their personal data by the data controller without any conditions',
                    'The data subject has the right to obtain from the data controller the erasure of personal data concerning them without undue delay, under certain conditions',
                    'The data subject can request the deletion of their personal data, and the data controller must comply only if the data is inaccurate',
                    'The data subject\'s request for erasure of their personal data must always be approved by a supervisory authority before the data controller can act on it',
                ],
                'correct_options' => ['The data subject has the right to obtain from the data controller the erasure of personal data concerning them without undue delay, under certain conditions'],
                'justifications' => [
                    'This statement is not accurate. The Right to be Forgotten under GDPR is not unconditional and is subject to specific conditions.',
                    'This statement accurately describes the Right to be Forgotten. The right allows data subjects to request the erasure of their personal data under specific conditions, such as when the data is no longer necessary for the purpose it was collected, if the data subject withdraws consent, or if the data has been unlawfully processed.',
                    'This statement is incorrect because the Right to be Forgotten encompasses more conditions than just the inaccuracy of data. Other conditions include the data no longer being necessary for the purposes for which it was collected, the data subject withdrawing consent, and the data being processed unlawfully.',
                    'This statement is incorrect. The data controller does not require the approval of a supervisory authority to act on a data subject\'s request for erasure. The data controller must comply with the request under the specified conditions without needing external approval.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
            ],

            // Item 22
            [
                'topic' => 'Data Subject Rights',
                'subtopic' => 'Data Subject Rights',
                'type_id' => 1,
                'question' => 'What information must be provided in response to a data subject access request?',
                'options' => [
                    'Only the raw data stored about the individual',
                    'Data categories, processing purposes, recipients, and retention periods',
                    'Just a summary of data processing activities',
                    'Only data that was explicitly consented to',
                ],
                'correct_options' => ['Data categories, processing purposes, recipients, and retention periods'],
                'justifications' => [
                    'Access requests require comprehensive information beyond just raw data',
                    'Correct - Full transparency about data processing activities must be provided',
                    'Summaries alone don\'t fulfill access request requirements',
                    'All personal data must be disclosed regardless of legal basis',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.1,
                'irt_c' => 0.25,
            ],

            // Item 23 - L3 - Apply
            [
                'topic' => 'Data Subject Rights',
                'subtopic' => 'Data Subject Rights',
                'type_id' => 1,
                'question' => 'If an individual withdraws their specific permission (consent) for particular data processing, what is the immediate implication for the organization?',
                'options' => [
                    'The organization must immediately delete all personal data of the individual',
                    'The organization must stop processing based on that specific consent going forward',
                    'The withdrawal of consent has retroactive effect and makes all prior processing unlawful',
                    'The organization can continue processing for 30 days while seeking alternative legal basis',
                ],
                'correct_options' => ['The organization must stop processing based on that specific consent going forward'],
                'justifications' => [
                    'Incorrect. Withdrawal of consent for specific processing does not automatically require deletion of all data; other legal bases may exist.',
                    'Correct. Organizations must stop processing activities that relied on the withdrawn consent, but this does not affect the lawfulness of prior processing.',
                    'Incorrect. Under GDPR Article 7(3), withdrawal of consent does not affect the lawfulness of processing based on consent before its withdrawal.',
                    'Incorrect. Processing must stop immediately upon consent withdrawal; there is no grace period to find alternative legal bases.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.1,
                'irt_c' => 0.2,
            ],

            // Item 24 - L2 - Understand
            [
                'topic' => 'Data Subject Rights',
                'subtopic' => 'Data Subject Rights',
                'type_id' => 1,
                'question' => 'A cloud storage provider holds a user\'s personal files. The user decides to switch to a different provider and wants to smoothly transfer their data directly to the new service. Which right facilitates this direct transfer where technically feasible?',
                'options' => [
                    'Right to Access',
                    'Right to Move Data',
                    'Right to Data Portability',
                    'Right to Transfer Data',
                ],
                'correct_options' => ['Right to Data Portability'],
                'justifications' => [
                    'Incorrect. The Right to Access allows individuals to obtain a copy of their data but doesn\'t specifically address direct transfer between controllers.',
                    'Incorrect. "Right to Move Data" is not a formally recognized right under GDPR or other major privacy regulations.',
                    'Correct. The Right to Data Portability specifically enables individuals to receive their personal data and transmit it directly from one controller to another where technically feasible.',
                    'Incorrect. "Right to Transfer Data" is not the formal name of this right under privacy regulations.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
            ],

            // Item 25 - L3 - Apply
            [
                'topic' => 'Data Subject Rights',
                'subtopic' => 'Data Subject Rights',
                'type_id' => 1,
                'question' => 'An organization receives a request to correct inaccuracies in personal data. Upon review, they confirm the data is indeed incorrect. What is their primary obligation, beyond just updating the data in their own system?',
                'options' => [
                    'To inform all third parties to whom the incorrect data was previously shared',
                    'To immediately delete all other personal data related to the individual',
                    'To provide the individual with financial compensation for the inaccuracy',
                    'To anonymize the inaccurate data rather than correcting it',
                ],
                'correct_options' => ['To inform all third parties to whom the incorrect data was previously shared'],
                'justifications' => [
                    'Correct - Under GDPR Article 19, data controllers must communicate any rectification of personal data to each recipient to whom the data has been disclosed, unless this proves impossible or involves disproportionate effort.',
                    'The right to rectification is separate from the right to erasure. Correcting inaccurate data does not require deleting all other data.',
                    'Data protection laws do not generally require financial compensation for data inaccuracies unless specific damages can be proven through legal proceedings.',
                    'Anonymizing incorrect data does not fulfill the rectification right. The individual has the right to have inaccurate data corrected, not anonymized.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.5,
                'irt_c' => 0.20,
            ],

            // Item 26
            [
                'topic' => 'Data Subject Rights',
                'subtopic' => 'Data Subject Rights',
                'type_id' => 1,
                'question' => 'How should you handle a data portability request when it involves proprietary algorithms or trade secrets?',
                'options' => [
                    'Refuse the request to protect intellectual property',
                    'Provide the personal data while protecting proprietary methods',
                    'Require a court order before providing any information',
                    'Only provide data if the individual signs an NDA',
                ],
                'correct_options' => ['Provide the personal data while protecting proprietary methods'],
                'justifications' => [
                    'IP protection doesn\'t override data portability rights',
                    'Correct - Provide personal data without revealing proprietary processing methods',
                    'Court orders aren\'t required for standard portability requests',
                    'NDAs cannot be a condition for exercising privacy rights',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
            ],

            // Item 27 - L4 - Analyze
            [
                'topic' => 'Data Subject Rights',
                'subtopic' => 'Data Subject Rights',
                'type_id' => 1,
                'question' => 'A research institution processes personal health data for a public health study, citing a legal basis related to public interest. An individual participating in the research objects to this processing. Under privacy regulations, the institution might still be able to continue processing the data if:',
                'options' => [
                    'They obtain explicit permission after the objection.',
                    'They can demonstrate compelling legitimate grounds for the processing that override the individual\'s interests or rights.',
                    'The data has been made anonymous.',
                    'The individual cannot prove significant personal harm.',
                ],
                'correct_options' => ['They can demonstrate compelling legitimate grounds for the processing that override the individual\'s interests or rights.'],
                'justifications' => [
                    'Incorrect. Obtaining permission after an objection would essentially be seeking new consent, which is a different legal basis than public interest.',
                    'Correct. Under GDPR Article 21, when processing is based on public interest, the controller can continue if they demonstrate compelling legitimate grounds that override the interests, rights, and freedoms of the data subject.',
                    'Incorrect. If data is truly anonymous, it no longer constitutes personal data and privacy regulations wouldn\'t apply. However, health data is difficult to fully anonymize.',
                    'Incorrect. The burden is on the controller to demonstrate compelling grounds, not on the individual to prove harm.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.5,
                'irt_c' => 0.2,
            ],

            // Item 28 - L4 - Analyze
            [
                'topic' => 'Data Subject Rights',
                'subtopic' => 'Data Subject Rights',
                'type_id' => 1,
                'question' => 'Analyze the challenge of implementing data subject rights in distributed microservices architectures.',
                'options' => [
                    'Microservices make individual rights easier to implement',
                    'Data fragmentation across services complicates rights fulfillment',
                    'Individual rights only apply to user-facing services',
                    'Microservices automatically handle privacy rights',
                ],
                'correct_options' => ['Data fragmentation across services complicates rights fulfillment'],
                'justifications' => [
                    'Distributed architectures typically increase complexity for rights implementation',
                    'Correct - Fragmented data across services requires coordination for complete rights fulfillment',
                    'Rights apply to all personal data regardless of service architecture',
                    'Microservices require explicit privacy rights implementation',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
            ],

            // Item 29
            [
                'topic' => 'Data Subject Rights',
                'subtopic' => 'Data Subject Rights',
                'type_id' => 1,
                'question' => 'What is the fundamental tension between the right to rectification and data integrity in shared databases?',
                'options' => [
                    'Rectification always improves data quality',
                    'Individual corrections might conflict with system-wide data consistency',
                    'Data integrity is more important than individual rights',
                    'Shared databases are exempt from rectification requirements',
                ],
                'correct_options' => ['Individual corrections might conflict with system-wide data consistency'],
                'justifications' => [
                    'Rectification can introduce inconsistencies if not properly managed',
                    'Correct - Individual changes may create conflicts with interconnected data systems',
                    'Individual rights must be balanced with, not subordinated to, system integrity',
                    'Shared databases must still comply with rectification rights',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
            ],

            // Item 30 - L5 - Evaluate
            [
                'topic' => 'Data Subject Rights',
                'subtopic' => 'Data Subject Rights',
                'type_id' => 1,
                'question' => 'A social media platform argues that providing data portability would enable spam and harassment by making user data easily transferable. Evaluate this position.',
                'options' => [
                    'Valid concern that justifies refusing portability requests',
                    'Invalid - technical measures should address abuse while preserving rights',
                    'Valid only for high-risk user categories',
                    'Invalid - security concerns never override individual rights',
                ],
                'correct_options' => ['Invalid - technical measures should address abuse while preserving rights'],
                'justifications' => [
                    'Abuse risks don\'t eliminate portability obligations',
                    'Correct - Platforms should implement safeguards without denying fundamental rights',
                    'Rights apply equally to all users regardless of risk categories',
                    'Some security considerations can limit rights, but not eliminate them entirely',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
            ],

            // Topic 4: Privacy Governance (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L2 - Understand
            [
                'topic' => 'Privacy Governance',
                'subtopic' => 'Privacy Governance',
                'type_id' => 1,
                'question' => 'An organization has appointed a Data Protection Officer (DPO). The DPO reports directly to the highest management level, has adequate resources, and is protected from dismissal or penalty for performing their tasks. These provisions primarily ensure the DPO\'s:',
                'options' => [
                    'Technical expertise.',
                    'Independent functioning.',
                    'Ability to act as a data controller.',
                    'Involvement in marketing decisions.',
                ],
                'correct_options' => ['Independent functioning.'],
                'justifications' => [
                    'Incorrect. While DPOs need expertise, these specific provisions relate to organizational positioning, not technical skills.',
                    'Correct. GDPR Articles 38-39 require these safeguards specifically to ensure DPOs can perform their duties independently without conflicts of interest or undue influence.',
                    'Incorrect. DPOs advise and monitor compliance; they do not act as data controllers who determine processing purposes and means.',
                    'Incorrect. DPO involvement in processing activities is about privacy compliance oversight, not specific business functions like marketing.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
            ],

            // Item 32 - L2 - Understand
            [
                'topic' => 'Privacy Governance',
                'subtopic' => 'Privacy Governance',
                'type_id' => 1,
                'question' => 'What is the PRIMARY purpose of a Privacy Impact Assessment (DPIA)?',
                'options' => [
                    'To prevent all future data breaches',
                    'To assess and mitigate privacy risks of processing activities',
                    'To establish data retention timelines',
                    'To enforce encryption and pseudonymization',
                ],
                'correct_options' => ['To assess and mitigate privacy risks of processing activities'],
                'justifications' => [
                    'Incorrect. While DPIAs help reduce breach risks, they cannot prevent all future breaches and that\'s not their primary purpose.',
                    'Correct. DPIAs are designed to identify and minimize privacy risks before processing begins, helping organizations meet compliance requirements and protect individual privacy.',
                    'Incorrect. Data retention timelines are established through retention policies, not primarily through DPIAs.',
                    'Incorrect. While DPIAs may recommend security measures, their primary purpose is risk assessment, not enforcement of specific technical controls.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
            ],

            // Item 33 - L2 - Understand
            [
                'topic' => 'Privacy Governance',
                'subtopic' => 'Privacy Governance',
                'type_id' => 1,
                'question' => 'Why is privacy governance important beyond just legal compliance?',
                'options' => [
                    'It\'s only important for legal compliance purposes',
                    'Privacy governance builds consumer trust and competitive advantage',
                    'Privacy governance is required by all security frameworks',
                    'It\'s only necessary for companies that process payment data',
                ],
                'correct_options' => ['Privacy governance builds consumer trust and competitive advantage'],
                'justifications' => [
                    'Privacy governance extends beyond mere compliance',
                    'Correct - Good privacy practices build trust and can differentiate organizations',
                    'Not all security frameworks mandate privacy governance',
                    'Privacy governance applies to all personal data, not just payment information',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
            ],

            // Item 34 - L2 - Understand
            [
                'topic' => 'Privacy Governance',
                'subtopic' => 'Privacy Governance',
                'type_id' => 1,
                'question' => 'A third-party vendor is contracted to manage payroll data on behalf of a company. Based on GDPR roles, which is TRUE?',
                'options' => [
                    'The vendor is the data controller',
                    'The vendor becomes a joint controller',
                    'The vendor is the processor; the company is the controller',
                    'Both are processors',
                ],
                'correct_options' => ['The vendor is the processor; the company is the controller'],
                'justifications' => [
                    'Incorrect. The vendor processes data on behalf of the company but doesn\'t determine the purposes and means of processing.',
                    'Incorrect. Joint controllership requires both parties to jointly determine purposes and means, which isn\'t the case in typical vendor relationships.',
                    'Correct. The company determines why and how employee data is processed (controller), while the vendor processes data according to the company\'s instructions (processor).',
                    'Incorrect. There must be a controller who determines the purposes and means of processing; both cannot be only processors.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
            ],

            // Item 35 - L3 - Apply
            [
                'topic' => 'Privacy Governance',
                'subtopic' => 'Privacy Governance',
                'type_id' => 1,
                'question' => 'An organization is undertaking a new project that involves extensive profiling of individuals based on their online behavior to target advertising. This activity carries a high risk to individuals\' rights and freedoms. Which privacy governance requirement is mandatory for this project before processing begins?',
                'options' => [
                    'Obtaining explicit consent from all data subjects.',
                    'Appointing a Data Protection Officer.',
                    'Conducting a Data Protection Impact Assessment (DPIA).',
                    'Establishing a new legal basis for processing.',
                ],
                'correct_options' => ['Conducting a Data Protection Impact Assessment (DPIA).'],
                'justifications' => [
                    'Incorrect. While consent may be needed as a legal basis, it\'s not the mandatory governance requirement for high-risk processing.',
                    'Incorrect. DPO appointment depends on the organization\'s overall activities, not individual projects.',
                    'Correct. Under GDPR Article 35, a DPIA is mandatory when processing is likely to result in high risk to rights and freedoms, especially for systematic profiling.',
                    'Incorrect. A legal basis is needed for any processing, but the question asks about the specific mandatory governance requirement for high-risk activities.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 36
            [
                'topic' => 'Privacy Governance',
                'subtopic' => 'Privacy Governance',
                'type_id' => 1,
                'question' => 'How should privacy responsibilities be integrated into different organizational roles?',
                'options' => [
                    'Only the DPO should have privacy responsibilities',
                    'Embed privacy responsibilities throughout relevant job descriptions and KPIs',
                    'Privacy should be handled entirely by legal department',
                    'Only senior executives need to worry about privacy',
                ],
                'correct_options' => ['Embed privacy responsibilities throughout relevant job descriptions and KPIs'],
                'justifications' => [
                    'Privacy requires organization-wide involvement beyond the DPO',
                    'Correct - Privacy accountability should be distributed across relevant roles',
                    'Legal departments support but don\'t own all privacy responsibilities',
                    'Privacy responsibilities extend throughout the organization',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
            ],

            // Item 37
            [
                'topic' => 'Privacy Governance',
                'subtopic' => 'Privacy Governance',
                'type_id' => 1,
                'question' => 'What is the most effective approach for privacy training in a large organization?',
                'options' => [
                    'One-time training for all employees using the same content',
                    'Role-based training with relevant scenarios and regular updates',
                    'Only train employees who directly handle customer data',
                    'Provide training materials but don\'t require completion',
                ],
                'correct_options' => ['Role-based training with relevant scenarios and regular updates'],
                'justifications' => [
                    'One-size-fits-all training lacks relevance for different roles',
                    'Correct - Tailored training with role-specific scenarios improves effectiveness',
                    'All employees need privacy awareness appropriate to their roles',
                    'Mandatory completion ensures organization-wide privacy awareness',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
            ],

            // Item 38 - L4 - Analyze
            [
                'topic' => 'Privacy Governance',
                'subtopic' => 'Privacy Governance',
                'type_id' => 1,
                'question' => 'A facial recognition AI model is deployed in public spaces. A citizen requests that their image data be permanently removed from the system\'s training and operational databases. Which data subject right would be the most applicable, and what is a key challenge for the organization in fulfilling it for an active AI model?',
                'options' => [
                    'Right to Data Portability; Challenge of data format conversion.',
                    'Right to Erasure; Challenge of "unlearning" data from complex, deployed models.',
                    'Right to Object; Challenge of proving legitimate interest overrides.',
                    'Right of Access; Challenge of providing all copies of images.',
                ],
                'correct_options' => ['Right to Erasure; Challenge of "unlearning" data from complex, deployed models.'],
                'justifications' => [
                    'Incorrect. Data portability relates to receiving personal data in a transferable format, not removal from systems.',
                    'Correct. The Right to Erasure (Right to be Forgotten) applies to deletion requests. The key challenge is that AI models learn patterns from training data, making it technically difficult to "unlearn" specific individuals\' data from already-trained models.',
                    'Incorrect. While the right to object could apply, the citizen is specifically requesting data removal, not objecting to processing.',
                    'Incorrect. Right of access is about obtaining information about data processing, not removal of data.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
            ],

            // Item 39 - L4 - Analyze
            [
                'topic' => 'Privacy Governance',
                'subtopic' => 'Privacy Governance',
                'type_id' => 1,
                'question' => 'An AI system used for hiring analyzes video interviews to infer candidates\' emotions and personality traits. This processing of potentially sensitive biometric and inferred data, without explicit and specific consent, primarily raises concerns related to which privacy principle?',
                'options' => [
                    'Storage Limitation',
                    'Data Minimization',
                    'Purpose Limitation',
                    'Fairness and Transparency',
                ],
                'correct_options' => ['Fairness and Transparency'],
                'justifications' => [
                    'Incorrect. Storage limitation relates to retention periods, not the nature of processing or consent requirements.',
                    'Incorrect. While collecting biometric data for hiring may exceed what\'s necessary, the primary issue is the lack of transparency about AI inference.',
                    'Incorrect. The purpose (hiring) is clear; the issue is the undisclosed methods and lack of consent for sensitive processing.',
                    'Correct. Using AI to infer emotions and personality traits without clear disclosure violates transparency (individuals don\'t know how they\'re being assessed) and fairness (automated decisions based on inferred traits without consent).',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
            ],

            // Item 40 - L5 - Evaluate
            [
                'topic' => 'Privacy Governance',
                'subtopic' => 'Privacy Governance',
                'type_id' => 1,
                'question' => 'A company\'s board argues that privacy governance should be "outsourced" to external legal counsel to avoid internal resource costs. Evaluate this approach.',
                'options' => [
                    'Effective since external lawyers have specialized expertise',
                    'Ineffective - privacy governance requires internal integration and ongoing management',
                    'Effective only for small companies without internal resources',
                    'Effective if combined with privacy insurance coverage',
                ],
                'correct_options' => ['Ineffective - privacy governance requires internal integration and ongoing management'],
                'justifications' => [
                    'External expertise helps but cannot replace internal governance',
                    'Correct - Privacy governance must be embedded in daily operations, not outsourced',
                    'Even small companies need internal privacy accountability',
                    'Insurance doesn\'t replace the need for active governance',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
            ],

            // Topic 5: Privacy Protection (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 41 - L1 - Remember
            [
                'topic' => 'Privacy Protection',
                'subtopic' => 'Privacy Protection',
                'type_id' => 1,
                'question' => 'Under GDPR, who is responsible for determining the purpose and means of personal data processing?',
                'options' => [
                    'Data Subject',
                    'Data Processor',
                    'Data Controller',
                    'Supervisory Authority',
                ],
                'correct_options' => ['Data Controller'],
                'justifications' => [
                    'Incorrect. The data subject is the individual whose personal data is being processed, not the entity determining how it\'s processed.',
                    'Incorrect. The data processor processes data on behalf of the controller but doesn\'t determine the purpose and means.',
                    'Correct. Under GDPR Article 4(7), the data controller is the entity that determines the purposes and means of processing personal data.',
                    'Incorrect. Supervisory authorities oversee compliance but don\'t determine processing purposes and means.',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.0,
                'irt_c' => 0.25,
            ],

            // Item 42 - L2 - Understand
            [
                'topic' => 'Privacy Protection',
                'subtopic' => 'Privacy Protection',
                'type_id' => 1,
                'question' => 'A company decides to encrypt all personal data stored in its cloud databases. What is the primary benefit of encryption as a technical safeguard in the event of a data breach?',
                'options' => [
                    'It prevents unauthorized access to the data.',
                    'It renders the data unintelligible and unusable to unauthorized parties.',
                    'It eliminates the need for any other security controls.',
                    'It ensures data accuracy and integrity.',
                ],
                'correct_options' => ['It renders the data unintelligible and unusable to unauthorized parties.'],
                'justifications' => [
                    'Incorrect. Encryption doesn\'t prevent access to encrypted data; it prevents understanding of the data content.',
                    'Correct. The primary benefit of encryption is that even if unauthorized parties gain access to the data, they cannot read or use it without the decryption key.',
                    'Incorrect. Encryption is one layer of defense; other controls like access management and monitoring are still necessary.',
                    'Incorrect. While some encryption methods include integrity checks, the primary purpose is confidentiality, not accuracy.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -0.7,
                'irt_c' => 0.25,
            ],

            // Item 43 - L2 - Understand
            [
                'topic' => 'Privacy Protection',
                'subtopic' => 'Privacy Protection',
                'type_id' => 1,
                'question' => 'An e-commerce platform stores customer payment card numbers. To minimize risk, they replace the actual card numbers with randomly generated non-sensitive equivalents in their main database, keeping the real numbers in a separate, highly secured vault. When processing payments, the non-sensitive equivalents are exchanged for real numbers. This approach is an example of:',
                'options' => [
                    'Encryption',
                    'Hashing',
                    'Tokenization',
                    'Anonymization',
                ],
                'correct_options' => ['Tokenization'],
                'justifications' => [
                    'Incorrect. Encryption transforms data using cryptographic algorithms but maintains a mathematical relationship between original and encrypted data.',
                    'Incorrect. Hashing is a one-way transformation that cannot be reversed to retrieve the original data.',
                    'Correct. Tokenization replaces sensitive data with non-sensitive tokens that have no mathematical relationship to the original data, with the mapping stored separately.',
                    'Incorrect. Anonymization removes the ability to identify individuals and is typically irreversible, unlike this token-based system.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
            ],

            // Item 44
            [
                'topic' => 'Privacy Protection',
                'subtopic' => 'Privacy Protection',
                'type_id' => 1,
                'question' => 'Why might homomorphic encryption be valuable for privacy protection?',
                'options' => [
                    'It\'s faster than traditional encryption methods',
                    'It allows computation on encrypted data without decryption',
                    'It\'s required by privacy regulations',
                    'It\'s easier to implement than other encryption',
                ],
                'correct_options' => ['It allows computation on encrypted data without decryption'],
                'justifications' => [
                    'Homomorphic encryption is typically slower than traditional methods',
                    'Correct - Enables processing without exposing plaintext data',
                    'No regulations specifically require homomorphic encryption',
                    'Homomorphic encryption is complex to implement',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
            ],

            // Item 45 - L3 - Apply
            [
                'topic' => 'Privacy Protection',
                'subtopic' => 'Privacy Protection',
                'type_id' => 1,
                'question' => 'An organization is designing a new customer analytics platform. To comply with Privacy by Design, they prioritize a technique where unique identifiers (e.g., customer IDs) are replaced with reversible, random values at the database level, allowing analysts to work with the data without directly seeing personal identifiers, but still permitting re-linkage for specific purposes. This approach aligns with which technique?',
                'options' => [
                    'Anonymization',
                    'Encryption at rest',
                    'Pseudonymization',
                    'Data Masking',
                ],
                'correct_options' => ['Pseudonymization'],
                'justifications' => [
                    'Incorrect. Anonymization is irreversible and would not allow re-linkage for specific purposes.',
                    'Incorrect. Encryption at rest protects stored data but doesn\'t specifically replace identifiers with random values for analytics.',
                    'Correct. Pseudonymization replaces identifying information with pseudonyms (random values) that can be reversed using additional information kept separately, exactly as described.',
                    'Incorrect. Data masking typically obscures data for display purposes but isn\'t necessarily reversible or designed for analytics workflows.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
            ],

            // Item 46 - L4 - Analyze
            [
                'topic' => 'Privacy Protection',
                'subtopic' => 'Privacy Protection',
                'type_id' => 1,
                'question' => 'A healthcare provider wants to share patient treatment data with a research institute for statistical analysis, ensuring individual patients cannot be identified. They remove direct identifiers like names and addresses, but retain dates of birth and postal codes. What data protection technique has been applied, and what is a primary residual risk?',
                'options' => [
                    'Anonymization; Risk of re-identification through unique combinations of remaining data.',
                    'Pseudonymization; Risk of re-identification through the remaining identifiers.',
                    'Data Masking; Risk of original data being restored easily.',
                    'Encryption; Risk of encryption keys being compromised.',
                ],
                'correct_options' => ['Anonymization; Risk of re-identification through unique combinations of remaining data.'],
                'justifications' => [
                    'Correct. The removal of direct identifiers without replacing them with pseudonyms is anonymization. However, quasi-identifiers like birth dates and postal codes can create unique combinations that allow re-identification.',
                    'Incorrect. Pseudonymization involves replacing identifiers with pseudonyms, not removing them entirely.',
                    'Incorrect. Data masking is typically used for non-production environments and doesn\'t fit this research sharing scenario.',
                    'Incorrect. Encryption protects data in transit/storage but doesn\'t remove identifiers for analysis purposes.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.20,
            ],

            // Item 47 - L3 - Apply
            [
                'topic' => 'Privacy Protection',
                'subtopic' => 'Privacy Protection',
                'type_id' => 1,
                'question' => 'A company has highly sensitive personal data. They implement a process where the data is first encrypted, then certain fields are pseudonymized, and finally, direct identifiers are removed to create aggregated reports. This layered approach best exemplifies adherence to which privacy principle?',
                'options' => [
                    'Transparency',
                    'Data Minimization',
                    'Storage Limitation',
                    'Accountability',
                ],
                'correct_options' => ['Data Minimization'],
                'justifications' => [
                    'Incorrect. Transparency relates to informing data subjects about processing, not the technical protection measures.',
                    'Correct. Data minimization principle includes processing data in ways that reduce privacy risks. The layered approach progressively reduces data identifiability, ensuring only necessary data is available for each purpose.',
                    'Incorrect. Storage limitation relates to retention periods, not processing techniques.',
                    'Incorrect. While this approach may demonstrate accountability, it primarily exemplifies data minimization through progressive de-identification.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
            ],

            // Item 48 - L4 - Analyze
            [
                'topic' => 'Privacy Protection',
                'subtopic' => 'Privacy Protection',
                'type_id' => 1,
                'question' => 'A security architect proposes using tokenization for payment card data and pseudonymization for customer demographic data in an application. What is the key distinction in how these two techniques primarily protect the original sensitive data?',
                'options' => [
                    'Tokenization typically replaces data with a non-sensitive equivalent, while pseudonymization only hides direct identifiers.',
                    'Tokenization is reversible, while pseudonymization is irreversible.',
                    'Tokenization requires encryption, while pseudonymization does not.',
                    'Tokenization is for data at rest, while pseudonymization is for data in transit.',
                ],
                'correct_options' => ['Tokenization typically replaces data with a non-sensitive equivalent, while pseudonymization only hides direct identifiers.'],
                'justifications' => [
                    'Correct. Tokenization replaces sensitive data with non-sensitive tokens that have no mathematical relationship to the original data. Pseudonymization replaces identifying fields but the data remains personal data under GDPR.',
                    'Incorrect. Both techniques are reversible - tokenization through the token vault, pseudonymization through the mapping table.',
                    'Incorrect. Tokenization doesn\'t necessarily require encryption; it uses random value substitution. Pseudonymization may or may not use encryption.',
                    'Incorrect. Both techniques can be applied to data at rest or in transit; this is not their distinguishing characteristic.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.7,
                'irt_c' => 0.20,
            ],

            // Item 49
            [
                'topic' => 'Privacy Protection',
                'subtopic' => 'Privacy Protection',
                'type_id' => 1,
                'question' => 'What is the fundamental challenge in applying privacy protection techniques to real-time data streams?',
                'options' => [
                    'Real-time systems are too fast for privacy protection',
                    'Balancing privacy protection with system performance and utility',
                    'Privacy protection doesn\'t apply to streaming data',
                    'Real-time data is automatically anonymous',
                ],
                'correct_options' => ['Balancing privacy protection with system performance and utility'],
                'justifications' => [
                    'Speed is a challenge but not insurmountable',
                    'Correct - The key challenge is maintaining utility while applying protection in real-time',
                    'Privacy requirements apply equally to streaming data',
                    'Real-time data often contains highly identifiable information',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
            ],

            // Item 50 - L5 - Evaluate
            [
                'topic' => 'Privacy Protection',
                'subtopic' => 'Privacy Protection',
                'type_id' => 1,
                'question' => 'A cloud service provider offers "zero-knowledge" encryption but requires plaintext access for search functionality. Evaluate this contradiction.',
                'options' => [
                    'This is standard practice and poses no privacy concerns',
                    'This undermines the zero-knowledge claim and creates privacy risks',
                    'Zero-knowledge only applies to data storage, not processing',
                    'Search functionality always requires plaintext access',
                ],
                'correct_options' => ['This undermines the zero-knowledge claim and creates privacy risks'],
                'justifications' => [
                    'Plaintext access contradicts zero-knowledge principles',
                    'Correct - True zero-knowledge means the provider never has plaintext access',
                    'Zero-knowledge should apply to all aspects of data handling',
                    'Encrypted search technologies exist that don\'t require plaintext',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
            ],
        ];
    }
}
