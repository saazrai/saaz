<?php

namespace Database\Seeders\Diagnostics;

class D9DataGovernanceSeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Data Governance';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: Data Classification & Handling (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 1 - L1 - Remember
            [
                'topic' => 'Data Classification & Handling',
                'subtopic' => 'Data Classification & Categorization',
                'question' => 'What is the purpose of data classification in information security?',
                'options' => [
                    'To improve data processing speed',
                    'To categorize data based on sensitivity and apply appropriate protection measures',
                    'To organize data alphabetically for easier searching',
                    'To compress data for storage optimization',
                ],
                'correct_options' => ['To categorize data based on sensitivity and apply appropriate protection measures'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - To categorize data based on sensitivity and apply appropriate protection measures',
                    'Incorrect - This overstates the capability or scope',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 2 - L2 - Understand
            [
                'topic' => 'Data Classification & Handling',
                'subtopic' => 'Data Classification & Categorization',
                'question' => 'Why is automated data classification often more effective than manual classification for large organizations?',
                'options' => [
                    'Automated tools are always 100% accurate',
                    'It provides consistency, scalability, and reduces human error',
                    'Manual classification is illegal in most jurisdictions',
                    'Automated classification costs less in all scenarios',
                ],
                'correct_options' => ['It provides consistency, scalability, and reduces human error'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - It provides consistency, scalability, and reduces human error',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 3 - L2 - Understand
            [
                'topic' => 'Data Classification & Handling',
                'subtopic' => 'Data Classification & Categorization',
                'question' => 'How do data handling requirements typically differ between public and confidential data classifications?',
                'options' => [
                    'Public data requires more encryption than confidential data',
                    'Confidential data requires stronger access controls and protection mechanisms',
                    'There are no meaningful differences in handling requirements',
                    'Public data must be stored offline while confidential data can be stored online',
                ],
                'correct_options' => ['Confidential data requires stronger access controls and protection mechanisms'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Confidential data requires stronger access controls and protection mechanisms',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 4 - L3 - Apply
            [
                'topic' => 'Data Classification & Handling',
                'subtopic' => 'Data Classification & Categorization',
                'question' => 'A healthcare organization handles patient records, billing information, and public health statistics. How should they approach data classification?',
                'options' => [
                    'Classify all healthcare data as top secret',
                    'Use different classification levels: patient records as confidential, billing as internal, and statistics as public',
                    'Classify everything as public to simplify management',
                    'Use only two levels: secret and non-secret',
                ],
                'correct_options' => ['Use different classification levels: patient records as confidential, billing as internal, and statistics as public'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - Use different classification levels: patient records as confidential, billing as internal, and statistics as public',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 5 - L3 - Apply
            [
                'topic' => 'Data Classification & Handling',
                'subtopic' => 'Data Classification & Categorization',
                'question' => 'An organization classifies its information into four levels: Public, Internal, Confidential, and Restricted. An employee wants to share an internal training manual with an external vendor. Which action is MOST appropriate?',
                'options' => [
                    'Send the manual without restriction since it\'s not confidential',
                    'Reclassify the manual as Public without formal approval',
                    'Request approval from the data owner before sharing',
                    'Share the manual over an encrypted internal email system',
                ],
                'correct_options' => ['Request approval from the data owner before sharing'],
                'justifications' => [
                    'Incorrect - Internal classification means the data is not intended for external sharing without proper authorization. Simply being "not confidential" doesn\'t make it appropriate for unrestricted external sharing.',
                    'Incorrect - Reclassifying data requires formal approval and assessment. An employee cannot unilaterally change classification levels without following proper governance procedures.',
                    'Correct - Internal data requires approval from the data owner before external sharing. This follows proper data governance procedures and ensures the sharing is authorized and appropriate for business purposes.',
                    'Incorrect - Using encryption doesn\'t address the fundamental issue of sharing internal data externally without authorization. Encryption is a technical control, but governance approval is still required.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 6 - L4 - Analyze
            [
                'topic' => 'Data Classification & Handling',
                'subtopic' => 'Data Classification & Categorization',
                'question' => 'An audit reveals that employees routinely store customer financial records in a shared drive labeled "Internal Use Only." Which classification issue does this MOST likely indicate?',
                'options' => [
                    'Incorrect data categorization',
                    'Excessive retention',
                    'Role-based access control failure',
                    'Unauthorized cloud storage use',
                ],
                'correct_options' => ['Incorrect data categorization'],
                'justifications' => [
                    'Correct - Customer financial records should be classified as Confidential or Restricted, not "Internal Use Only." This represents a fundamental misclassification where highly sensitive financial data is being treated as lower-sensitivity internal information, creating security and compliance risks.',
                    'Incorrect - The issue is not about how long the data is being kept, but rather how it is being classified and where it is being stored. Retention policies are separate from classification problems.',
                    'Incorrect - While access controls may be inadequate, the primary issue is that the data classification is wrong. Even with proper role-based access, financial records shouldn\'t be in a drive labeled for internal use.',
                    'Incorrect - The audit finding doesn\'t indicate cloud storage issues. The problem is the misclassification of sensitive financial data as "Internal Use Only" rather than the appropriate higher security classification.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.6,
                'irt_b' => 0.7,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 7 - L2 - Understand
            [
                'topic' => 'Data Classification & Handling',
                'subtopic' => 'Data Classification & Categorization',
                'question' => 'Which of the following BEST distinguishes data classification from data categorization?',
                'options' => [
                    'Classification determines access levels; categorization relates to data formats',
                    'Classification defines data format; categorization defines location',
                    'Classification is about content type; categorization is about stakeholder needs',
                    'Classification assigns sensitivity; categorization groups by function or regulation',
                ],
                'correct_options' => ['Classification assigns sensitivity; categorization groups by function or regulation'],
                'justifications' => [
                    'Incorrect - While classification can influence access levels, this doesn\'t capture the core distinction. Categorization is not primarily about data formats but about grouping data for different purposes.',
                    'Incorrect - This reverses the concepts. Classification is not about data format, and categorization is not primarily about physical or logical location of data.',
                    'Incorrect - Classification is not about content type (like text, video, etc.), and categorization is broader than just stakeholder needs - it includes regulatory, functional, and operational groupings.',
                    'Correct - Data classification assigns sensitivity levels (Public, Internal, Confidential, Restricted) to determine protection requirements, while data categorization groups data by business function, regulatory requirements, or operational purposes (HR data, financial data, customer data, etc.).',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 8 - L2 - Understand
            [
                'topic' => 'Data Classification & Handling',
                'subtopic' => 'Data Classification & Categorization',
                'question' => 'Who is PRIMARILY responsible for assigning the appropriate classification level to enterprise data?',
                'options' => [
                    'Data custodian',
                    'System administrator',
                    'Data owner',
                    'Data steward',
                ],
                'correct_options' => ['Data owner'],
                'justifications' => [
                    'Incorrect - Data custodians are responsible for implementing and maintaining the technical controls and storage systems for data, but they do not determine the classification level. They execute the data owner\'s classification decisions.',
                    'Incorrect - System administrators manage the technical infrastructure and access controls but are not responsible for determining the business sensitivity and classification of data. They implement the classification requirements set by others.',
                    'Correct - The data owner, typically a business manager or executive, has the authority and responsibility to determine the appropriate classification level based on the business value, sensitivity, and regulatory requirements of the data. They understand the business context and impact.',
                    'Incorrect - Data stewards assist with data quality, compliance, and governance processes, but they typically do not have the authority to assign classification levels. They support the data owner in implementing classification decisions.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 9 - L4 - Analyze
            [
                'topic' => 'Data Classification & Handling',
                'subtopic' => 'Data Classification & Categorization',
                'question' => 'A security analyst finds that sensitive customer records have been stored without any labeling. Which process has MOST LIKELY failed?',
                'options' => [
                    'Data encryption',
                    'Data classification',
                    'Data validation',
                    'Access provisioning',
                ],
                'correct_options' => ['Data classification'],
                'justifications' => [
                    'Incorrect - Data encryption is a technical control that protects data in transit and at rest, but it does not involve labeling data. The absence of labels indicates a classification issue, not an encryption failure.',
                    'Correct - Data classification is the process of identifying and labeling data based on its sensitivity level. The fact that sensitive customer records lack any labeling directly indicates that the data classification process has failed to properly identify and mark this sensitive data.',
                    'Incorrect - Data validation ensures data accuracy, completeness, and integrity during input or processing. It does not involve assigning sensitivity labels to data based on classification levels.',
                    'Incorrect - Access provisioning manages user permissions and access rights to systems and data. While proper classification supports access decisions, the lack of labeling specifically points to a classification process failure.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 10 - L2 - Understand
            [
                'topic' => 'Data Classification & Handling',
                'subtopic' => 'Data Classification & Categorization',
                'question' => 'Which role is responsible for implementing data protection measures according to the classification level?',
                'options' => [
                    'Data owner',
                    'Data user',
                    'Data custodian',
                    'Data steward',
                ],
                'correct_options' => ['Data custodian'],
                'justifications' => [
                    'Incorrect - The data owner determines the classification level and defines protection requirements, but they do not typically implement the technical controls. They delegate implementation responsibilities to custodians.',
                    'Incorrect - Data users consume data according to their authorized access levels and must follow protection policies, but they are not responsible for implementing the underlying technical protection measures.',
                    'Correct - Data custodians are responsible for implementing and maintaining the technical controls and protection measures based on the classification level assigned by the data owner. This includes encryption, access controls, backup procedures, and other security measures.',
                    'Incorrect - Data stewards focus on data quality, compliance monitoring, and governance processes. While they may oversee compliance with protection measures, they typically do not implement the technical controls themselves.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Topic 2: Data Lifecycle Management (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L1 - Remember
            [
                'topic' => 'Data Lifecycle Management',
                'subtopic' => 'Data Lifecycle Management',
                'question' => 'What are the typical phases of the data lifecycle?',
                'options' => [
                    'Creation, Storage, Processing, Sharing, Retention, Destruction',
                    'Input, Output, Processing, Analysis',
                    'Collection, Analysis, Reporting, Archive',
                    'Design, Build, Test, Deploy',
                ],
                'correct_options' => ['Creation, Storage, Processing, Sharing, Retention, Destruction'],
                'justifications' => [
                    'Correct - Creation, Storage, Processing, Sharing, Retention, Destruction',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 12 - L2 - Understand
            [
                'topic' => 'Data Lifecycle Management',
                'subtopic' => 'Data Lifecycle Management',
                'question' => 'Why is data lineage tracking important in data lifecycle management?',
                'options' => [
                    'It improves data processing speed',
                    'It provides visibility into data origins, transformations, and dependencies for governance and compliance',
                    'It reduces data storage costs',
                    'It automatically backs up all data',
                ],
                'correct_options' => ['It provides visibility into data origins, transformations, and dependencies for governance and compliance'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - It provides visibility into data origins, transformations, and dependencies for governance and compliance',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 13 - L2 - Understand
            [
                'topic' => 'Data Lifecycle Management',
                'subtopic' => 'Data Lifecycle Management',
                'question' => 'How does data minimization relate to lifecycle management?',
                'options' => [
                    'Data minimization requires collecting maximum data for analysis',
                    'It involves collecting only necessary data and disposing of it when no longer needed',
                    'Data minimization only applies to personal data',
                    'It focuses solely on reducing storage costs',
                ],
                'correct_options' => ['It involves collecting only necessary data and disposing of it when no longer needed'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - It involves collecting only necessary data and disposing of it when no longer needed',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 14 - L3 - Apply
            [
                'topic' => 'Data Lifecycle Management',
                'subtopic' => 'Data Lifecycle Management',
                'question' => 'A financial services company needs to implement lifecycle management for customer transaction data. What approach should they prioritize?',
                'options' => [
                    'Store all transaction data indefinitely for analysis',
                    'Implement automated retention policies based on regulatory requirements and business needs',
                    'Delete all transaction data after 30 days',
                    'Only manage data lifecycle for high-value customers',
                ],
                'correct_options' => ['Implement automated retention policies based on regulatory requirements and business needs'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - Implement automated retention policies based on regulatory requirements and business needs',
                    'Incorrect - This overstates the capability or scope',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 15 - L3 - Apply
            [
                'topic' => 'Data Lifecycle Management',
                'subtopic' => 'Data Lifecycle Management',
                'question' => 'When implementing data lifecycle management in a cloud environment, what is the most critical consideration?',
                'options' => [
                    'Choosing the cheapest cloud storage option',
                    'Ensuring lifecycle policies work across multi-cloud and hybrid environments',
                    'Only managing data stored in primary regions',
                    'Focusing exclusively on backup data lifecycle',
                ],
                'correct_options' => ['Ensuring lifecycle policies work across multi-cloud and hybrid environments'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Ensuring lifecycle policies work across multi-cloud and hybrid environments',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 16 - L3 - Apply
            [
                'topic' => 'Data Lifecycle Management',
                'subtopic' => 'Data Lifecycle Management',
                'question' => 'How should an organization handle lifecycle management for derived data (analytics results, reports, etc.)?',
                'options' => [
                    'Apply the same lifecycle policies as source data',
                    'Develop separate lifecycle policies based on the value and sensitivity of derived insights',
                    'Never delete derived data regardless of age',
                    'Always delete derived data immediately after creation',
                ],
                'correct_options' => ['Develop separate lifecycle policies based on the value and sensitivity of derived insights'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Develop separate lifecycle policies based on the value and sensitivity of derived insights',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 17 - L4 - Analyze
            [
                'topic' => 'Data Lifecycle Management',
                'subtopic' => 'Data Lifecycle Management',
                'question' => 'Analyze why automated lifecycle management systems may inadvertently violate legal hold requirements.',
                'options' => [
                    'Automated systems are inherently more reliable than manual processes',
                    'Automation may delete data subject to litigation holds without considering legal requirements',
                    'Legal holds only apply to manual data management processes',
                    'Automated systems always comply with legal requirements',
                ],
                'correct_options' => ['Automation may delete data subject to litigation holds without considering legal requirements'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Automation may delete data subject to litigation holds without considering legal requirements',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 18 - L4 - Analyze
            [
                'topic' => 'Data Lifecycle Management',
                'subtopic' => 'Data Lifecycle Management',
                'question' => 'What is the fundamental challenge in managing data lifecycle for machine learning systems?',
                'options' => [
                    'ML systems don\'t generate any data worth managing',
                    'Training data, model artifacts, and prediction results have different lifecycle requirements and dependencies',
                    'ML systems only work with real-time data',
                    'All ML data should be retained permanently',
                ],
                'correct_options' => ['Training data, model artifacts, and prediction results have different lifecycle requirements and dependencies'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Training data, model artifacts, and prediction results have different lifecycle requirements and dependencies',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 19 - L5 - Evaluate
            [
                'topic' => 'Data Lifecycle Management',
                'subtopic' => 'Data Lifecycle Management',
                'question' => 'An organization implements a \"data lake\" strategy where all data is retained indefinitely \"because storage is cheap and we might need it someday.\" Evaluate this approach.',
                'options' => [
                    'Ideal approach ensuring no valuable data is lost',
                    'Creates compliance risks, increased attack surface, and violates data minimization principles',
                    'Standard best practice for modern organizations',
                    'Only appropriate for small organizations with limited data',
                ],
                'correct_options' => ['Creates compliance risks, increased attack surface, and violates data minimization principles'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Creates compliance risks, increased attack surface, and violates data minimization principles',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 20 - L5 - Evaluate
            [
                'topic' => 'Data Lifecycle Management',
                'subtopic' => 'Data Lifecycle Management',
                'question' => 'A company discovers that implementing proper data lifecycle management would require sunsetting several popular analytics dashboards due to underlying data retention policies. How should they proceed?',
                'options' => [
                    'Keep all data to maintain existing dashboards',
                    'Balance business needs with compliance requirements through alternative data sources or anonymization',
                    'Ignore retention policies to preserve business functionality',
                    'Immediately shut down all analytics without alternatives',
                ],
                'correct_options' => ['Balance business needs with compliance requirements through alternative data sources or anonymization'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - Balance business needs with compliance requirements through alternative data sources or anonymization',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Topic 3: Data Retention & Archival (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L2 - Understand
            [
                'topic' => 'Data Retention & Archival',
                'subtopic' => 'Data Retention & Archival',
                'question' => 'Which of the following primarily drives the formulation of a data retention policy in an organization?',
                'options' => [
                    'Volume of data stored over time',
                    'User preferences and convenience',
                    'Compliance and business requirements',
                    'Storage infrastructure limitations',
                ],
                'correct_options' => ['Compliance and business requirements'],
                'justifications' => [
                    'Incorrect - While data volume may influence storage strategies and costs, it does not primarily drive the formulation of retention policies. Retention periods are determined by legal and business needs, not storage capacity.',
                    'Incorrect - User preferences and convenience are secondary considerations. Data retention policies must be based on legal obligations and business needs, not user comfort or ease of access.',
                    'Correct - Data retention policies are primarily driven by regulatory compliance requirements (such as SOX, GDPR, HIPAA) and legitimate business needs (operational requirements, audit trails, legal discovery). These establish the mandatory minimum and maximum retention periods.',
                    'Incorrect - Storage limitations may affect implementation strategies, but they do not drive policy formulation. Organizations must comply with legal requirements regardless of storage constraints and will invest in appropriate infrastructure.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 22 - L3 - Apply
            [
                'topic' => 'Data Retention & Archival',
                'subtopic' => 'Data Retention & Archival',
                'question' => 'How should you apply data retention policies when a financial services company faces conflicting requirements: legal retention mandates require 7-year storage, but privacy regulations allow individuals to request data deletion after 2 years?',
                'options' => [
                    'Always prioritize privacy rights and delete data after 2 years',
                    'Implement a tiered approach: anonymize personal identifiers while retaining business data for compliance',
                    'Ignore privacy requests until the 7-year retention period expires',
                    'Archive all data indefinitely to avoid any compliance risks',
                ],
                'correct_options' => ['Implement a tiered approach: anonymize personal identifiers while retaining business data for compliance'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Implement a tiered approach: anonymize personal identifiers while retaining business data for compliance',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 23 - L2 - Understand
            [
                'topic' => 'Data Retention & Archival',
                'subtopic' => 'Data Retention & Archival',
                'question' => 'A marketing department is developing a new customer segmentation report that combines internal sales data with external demographic information purchased from a third party. This report will be used to target future advertising campaigns. During which phase of the data lifecycle is the marketing department primarily focused on ensuring the accuracy and relevance of the combined datasets for its intended purpose?',
                'options' => [
                    'Store',
                    'Share',
                    'Use',
                    'Create',
                ],
                'correct_options' => ['Use'],
                'justifications' => [
                    'Incorrect - The Store phase focuses on securing and preserving data for future access, not on validating accuracy and relevance for specific business purposes. Storage decisions are made after data validation.',
                    'Incorrect - The Share phase involves distributing data to authorized parties with appropriate controls and access permissions. Data accuracy validation occurs before sharing decisions.',
                    'Correct - During the Use phase, organizations actively employ data for business operations and decision-making. This is when data must be validated for accuracy, relevance, and fitness for its intended purpose. The marketing department is using the combined datasets to make business decisions (customer segmentation and advertising targeting), requiring verification that the data is accurate and suitable.',
                    'Incorrect - The Create phase involves initial data generation, collection, or acquisition. While data quality checks may occur during creation, the question describes combining existing datasets for analysis, which occurs during the Use phase.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 24 - L2 - Understand
            [
                'topic' => 'Data Retention & Archival',
                'subtopic' => 'Data Retention & Archival',
                'question' => 'A DLP system flags an attempt to email a customer list externally. What is the MOST likely goal of the DLP?',
                'options' => [
                    'To encrypt the file before sending',
                    'To ensure network segmentation',
                    'To prevent unauthorized data exfiltration',
                    'To monitor file access permissions',
                ],
                'correct_options' => ['To prevent unauthorized data exfiltration'],
                'justifications' => [
                    'Incorrect - DLP systems are designed to detect and prevent unauthorized data transfers, not to automatically encrypt files. While some DLP solutions may have encryption capabilities, their primary function is to block or quarantine suspicious data transfers rather than encrypt them.',
                    'Incorrect - Network segmentation involves dividing networks into smaller segments to limit access and contain threats. This is not the primary function of DLP systems, which focus on monitoring and controlling data movement rather than network topology.',
                    'Correct - Data Loss Prevention (DLP) systems are specifically designed to identify, monitor, and prevent unauthorized transmission of sensitive data outside an organization. Flagging an external email containing a customer list exemplifies DLP\'s core purpose of preventing data exfiltration.',
                    'Incorrect - While DLP systems may monitor file access as part of their data discovery process, their primary goal when flagging data transfers is to prevent unauthorized exfiltration, not to manage access permissions. Access control is typically handled by other security systems.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 25 - L3 - Apply
            [
                'topic' => 'Data Retention & Archival',
                'subtopic' => 'Data Retention & Archival',
                'question' => 'A pharmaceutical company is establishing a new data retention policy for clinical trial data. They are subject to stringent regulations from the FDA (requiring data retention for 25 years post-approval) and also have internal business needs to analyze trial data for future research for an additional 5 years. When defining the retention period for this specific dataset, which of the following considerations should take precedence?',
                'options' => [
                    'The most cost-effective storage solution available for 25 years',
                    'The longer of the two specified timeframes to ensure all requirements are met',
                    'The internal business need, as it offers a competitive advantage',
                    'The shortest possible retention period to minimize storage burden and risk',
                ],
                'correct_options' => ['The longer of the two specified timeframes to ensure all requirements are met'],
                'justifications' => [
                    'Incorrect - While cost is a practical consideration, it cannot override regulatory compliance requirements. The FDA mandate is legally binding and takes precedence over cost optimization.',
                    'Correct - Organizations must comply with the most stringent requirement among all applicable regulations, legal obligations, and legitimate business needs. In this case, 30 years total (25 years FDA compliance + 5 years business need) ensures both regulatory compliance and business value realization.',
                    'Incorrect - Internal business needs, while important for competitive advantage, cannot supersede mandatory regulatory requirements. The FDA requirement is legally binding and must be met regardless of business preferences.',
                    'Incorrect - Minimizing retention periods may reduce costs and risks, but organizations must meet all applicable legal and regulatory requirements. The shortest period would violate FDA regulations and potentially result in serious legal consequences.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 26 - L3 - Apply
            [
                'topic' => 'Data Retention & Archival',
                'subtopic' => 'Data Retention & Archival',
                'question' => 'An educational institution is revising its data retention policy for student academic records, balancing compliance with FERPA (US law regarding student privacy) and its own operational need to provide transcripts for alumni indefinitely. They currently store all records on active online servers. Which policy adjustment would be most effective in addressing both legal compliance and long-term operational needs while optimizing storage costs?',
                'options' => [
                    'Delete all student records five years after graduation to comply with a hypothetical maximum retention guideline',
                    'Migrate older student academic records to an archival storage solution after a defined period, while maintaining online access for recent graduates',
                    'Keep all records indefinitely on high-performance online storage to ensure immediate access for all alumni',
                    'Implement a system where alumni requests for old records trigger a manual retrieval from physical archives',
                ],
                'correct_options' => ['Migrate older student academic records to an archival storage solution after a defined period, while maintaining online access for recent graduates'],
                'justifications' => [
                    'Incorrect - FERPA does not require deletion of student academic records after any specific timeframe, and educational institutions have legitimate business needs to maintain transcript capabilities indefinitely. Deletion would eliminate operational capability.',
                    'Correct - A tiered storage approach optimizes costs by moving older records (e.g., >5-10 years) to lower-cost archival storage while maintaining accessibility. This satisfies FERPA compliance, supports indefinite transcript services, and reduces storage costs through appropriate technology matching to access patterns.',
                    'Incorrect - While this ensures immediate access, keeping all historical records on high-performance online storage is unnecessarily expensive. Older records are accessed less frequently and can be cost-effectively stored in archival solutions with slightly longer retrieval times.',
                    'Incorrect - Manual physical retrieval systems create operational inefficiencies, potential service delays, and higher administrative costs. This approach also increases risk of record loss or damage and may not meet reasonable alumni expectations for transcript services.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 27 - L3 - Apply
            [
                'topic' => 'Data Retention & Archival',
                'subtopic' => 'Data Retention & Archival',
                'question' => 'A financial services firm is reviewing its data retention policy for audit logs, which are subject to a 7-year regulatory retention period. They notice that the logs are growing rapidly, consuming significant storage. To optimize storage while remaining compliant, which of the following actions should they first consider for logs older than 2 years but less than 7 years?',
                'options' => [
                    'Immediately delete all logs older than 2 years as they are not frequently accessed',
                    'Migrate these older logs from high-performance online storage to a less expensive, lower-performance archival storage tier',
                    'Back up these logs to tape and then delete them from all online systems',
                    'Purchase additional high-performance storage to accommodate the continuous growth',
                ],
                'correct_options' => ['Migrate these older logs from high-performance online storage to a less expensive, lower-performance archival storage tier'],
                'justifications' => [
                    'Incorrect - Deleting logs before the 7-year regulatory retention period expires would violate compliance requirements and expose the firm to regulatory penalties and legal risks during audits or investigations.',
                    'Correct - Implementing tiered storage moves older, less frequently accessed logs to cost-effective archival storage while maintaining compliance and accessibility. This approach optimizes costs by matching storage technology to access patterns without compromising regulatory requirements.',
                    'Incorrect - While tape backup can be cost-effective, completely removing logs from online systems may create accessibility challenges during regulatory audits or compliance reviews, potentially causing operational delays and compliance risks.',
                    'Incorrect - Purchasing additional high-performance storage addresses the immediate capacity issue but does not optimize costs. This approach wastes resources since older logs rarely require high-performance access and can be effectively managed with tiered storage strategies.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 28 - L4 - Analyze
            [
                'topic' => 'Data Retention & Archival',
                'subtopic' => 'Data Retention & Archival',
                'question' => 'An organization is deciding between two encryption methods for its internal file server: (1) File-level encryption (encrypts individual files as they are saved), or (2) Full disk encryption (encrypts the entire physical disk). Which method provides better protection for data-at-rest against an attacker who gains physical access to the server but cannot log into the operating system?',
                'options' => [
                    'File-level encryption, because it encrypts data more granularly',
                    'Full disk encryption, because it encrypts all data on the disk, including system files, rendering it unreadable without the key',
                    'File-level encryption, as it offers better performance',
                    'Full disk encryption, because it also protects data-in-transit',
                ],
                'correct_options' => ['Full disk encryption, because it encrypts all data on the disk, including system files, rendering it unreadable without the key'],
                'justifications' => [
                    'Incorrect - While file-level encryption provides granular protection, an attacker with physical access could potentially boot from external media, access unencrypted system files, or exploit vulnerabilities in the operating system to bypass file-level encryption since the OS and system files remain unencrypted.',
                    'Correct - Full disk encryption provides superior protection against physical access attacks because the entire disk is encrypted, including the operating system, system files, and all data. Without the encryption key, an attacker cannot boot the system or access any data, even if they remove the physical drive or attempt alternative boot methods.',
                    'Incorrect - Performance is not the determining factor for security effectiveness against physical access attacks. While file-level encryption may have performance advantages in some scenarios, this does not address the security question of protecting against physical access.',
                    'Incorrect - Neither file-level nor full disk encryption directly protects data-in-transit. Both are data-at-rest protection mechanisms. Data-in-transit protection requires additional technologies like TLS/SSL or VPNs. This option misrepresents the capabilities of full disk encryption.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.6,
                'irt_b' => 0.7,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 29 - L4 - Analyze
            [
                'topic' => 'Data Retention & Archival',
                'subtopic' => 'Data Retention & Archival',
                'question' => 'A Data Loss Prevention (DLP) solution is deployed to prevent sensitive data exfiltration. An employee attempts to upload a file containing confidential information, but the file is encrypted with a key unknown to the DLP system, and then transmitted over an encrypted channel (e.g., HTTPS). How effectively can the DLP solution typically inspect and act upon this encrypted data to prevent its loss?',
                'options' => [
                    'The DLP solution can automatically decrypt and inspect the data, regardless of the encryption method or key',
                    'The DLP solution will flag and block the transmission based solely on the fact that the data is encrypted',
                    'The DLP\'s ability to inspect the data will be significantly limited or impossible unless it can decrypt the content',
                    'The DLP solution can only inspect encrypted data if it is specifically configured to bypass the encryption and compromise the channel',
                ],
                'correct_options' => ['The DLP\'s ability to inspect the data will be significantly limited or impossible unless it can decrypt the content'],
                'justifications' => [
                    'Incorrect - DLP systems cannot automatically decrypt data with unknown encryption keys. Encryption is specifically designed to prevent unauthorized access to data content, and DLP systems do not have magical decryption capabilities that bypass cryptographic protections.',
                    'Incorrect - Most legitimate business communications use encryption (HTTPS, TLS, encrypted email). DLP systems cannot simply block all encrypted traffic as this would severely impact business operations. The presence of encryption alone is not sufficient grounds for blocking.',
                    'Correct - DLP systems rely on content inspection techniques such as pattern matching, fingerprinting, and contextual analysis to identify sensitive data. When data is encrypted with unknown keys, these inspection methods cannot access the actual content, making it nearly impossible for DLP to determine if the data contains sensitive information.',
                    'Incorrect - While some DLP solutions can be configured with SSL/TLS inspection capabilities (man-in-the-middle proxies), this requires network-level configuration and certificate management. It does not apply to pre-encrypted files with unknown keys, and "compromising the channel" suggests improper security practices.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 30 - L5 - Evaluate
            [
                'topic' => 'Data Retention & Archival',
                'subtopic' => 'Data Retention & Archival',
                'question' => 'An organization implements a \"defensible deletion\" program that automatically deletes data at the minimum legally required retention periods to reduce litigation exposure. Assess this strategy.',
                'options' => [
                    'Perfect approach minimizing all legal and business risks',
                    'May reduce litigation risk but could destroy valuable business intelligence and historical insights',
                    'Illegal approach that violates all retention requirements',
                    'Only appropriate for small organizations',
                ],
                'correct_options' => ['May reduce litigation risk but could destroy valuable business intelligence and historical insights'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - May reduce litigation risk but could destroy valuable business intelligence and historical insights',
                    'Incorrect - This overstates the capability or scope',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Topic 4: Data Loss Prevention (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L1 - Remember
            [
                'topic' => 'Data Loss Prevention',
                'subtopic' => 'Data Security Controls',
                'question' => 'What is the primary purpose of Data Loss Prevention (DLP) systems?',
                'options' => [
                    'To backup data to prevent hardware failures',
                    'To identify, monitor, and protect sensitive data from unauthorized access or exfiltration',
                    'To compress data for storage efficiency',
                    'To encrypt all data at rest',
                ],
                'correct_options' => ['To identify, monitor, and protect sensitive data from unauthorized access or exfiltration'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - To identify, monitor, and protect sensitive data from unauthorized access or exfiltration',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 32 - L1 - Remember
            [
                'topic' => 'Data Loss Prevention',
                'subtopic' => 'Data Security Controls',
                'question' => 'What are the three main DLP deployment modes?',
                'options' => [
                    'Network, Endpoint, and Storage DLP',
                    'Preventive, Detective, and Corrective DLP',
                    'Technical, Administrative, and Physical DLP',
                    'Active, Passive, and Hybrid DLP',
                ],
                'correct_options' => ['Network, Endpoint, and Storage DLP'],
                'justifications' => [
                    'Correct - Network, Endpoint, and Storage DLP',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 33 - L2 - Understand
            [
                'topic' => 'Data Loss Prevention',
                'subtopic' => 'Data Security Controls',
                'question' => 'Crypto-shredding is a technique used for data sanitization. What is the fundamental prerequisite for crypto-shredding to be an effective sanitization method?',
                'options' => [
                    'The data must be stored on Solid State Drives (SSDs)',
                    'The data must have been encrypted prior to sanitization',
                    'The storage media must be physically destroyed immediately after',
                    'The encryption key must be securely backed up for future recovery',
                ],
                'correct_options' => ['The data must have been encrypted prior to sanitization'],
                'justifications' => [
                    'Incorrect - While crypto-shredding is particularly effective for SSDs due to wear-leveling challenges with traditional overwriting, it can be applied to any storage media as long as the fundamental prerequisite (encryption) is met. The storage type is not the prerequisite.',
                    'Correct - Crypto-shredding (cryptographic erasure) works by destroying or making inaccessible the encryption keys used to secure data. For this method to be effective, the data must have been encrypted prior to the sanitization attempt, as unencrypted data cannot be crypto-shredded.',
                    'Incorrect - Physical destruction is a separate sanitization method (destroy category). Crypto-shredding specifically avoids physical destruction while achieving secure data sanitization through key destruction, allowing the media to be reused.',
                    'Incorrect - This contradicts the fundamental principle of crypto-shredding. The technique works by permanently destroying or making encryption keys inaccessible. Backing up keys for future recovery would defeat the entire purpose of the sanitization method.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 34 - L2 - Understand
            [
                'topic' => 'Data Loss Prevention',
                'subtopic' => 'Data Security Controls',
                'question' => 'An organization\'s policy states that "all highly confidential customer data must be encrypted when stored on servers." They are considering using Transport Layer Security (TLS) for data transfer to these servers. While TLS encrypts data-in-transit, what is a critical limitation of relying solely on TLS for data protection on the server, concerning the policy?',
                'options' => [
                    'TLS only encrypts the network connection, not the data once it\'s written to disk',
                    'TLS is too slow for high volumes of confidential data',
                    'TLS is prone to man-in-the-middle attacks, making it unreliable',
                    'TLS only applies to web traffic, not other data transfers',
                ],
                'correct_options' => ['TLS only encrypts the network connection, not the data once it\'s written to disk'],
                'justifications' => [
                    'Correct - TLS (Transport Layer Security) is a data-in-transit protection protocol that encrypts data during network transmission. Once data reaches the server and is written to disk, TLS protection ends and the data is stored in plaintext unless additional data-at-rest encryption is implemented. The policy requires encryption of stored data, which TLS alone cannot provide.',
                    'Incorrect - While TLS has some performance overhead, modern implementations are optimized for high-volume data transfers. Performance is not the fundamental limitation regarding the policy requirement for encrypting stored data.',
                    'Incorrect - While man-in-the-middle attacks are a concern, proper TLS implementation with certificate validation provides strong protection against such attacks. This is not the primary limitation concerning data storage encryption requirements.',
                    'Incorrect - TLS is not limited to web traffic. It can protect various types of data transfers including email (SMTP over TLS), file transfers (FTPS), and other protocols. The limitation is not about traffic types but about data protection scope.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 35 - L3 - Apply
            [
                'topic' => 'Data Loss Prevention',
                'subtopic' => 'Data Security Controls',
                'question' => 'A software development team frequently shares source code files with external contractors. The company\'s policy dictates that only specific, named contractors should be able to view these files, and they should be prevented from printing or copying the code. The files might be accessed on various operating systems and devices. Which technology would be the most suitable to enforce these granular usage restrictions regardless of where the files reside?',
                'options' => [
                    'Endpoint Detection and Response (EDR)',
                    'Hardware Security Modules (HSM)',
                    'Information Rights Management (IRM)',
                    'Virtual Private Network (VPN)',
                ],
                'correct_options' => ['Information Rights Management (IRM)'],
                'justifications' => [
                    'Incorrect - EDR focuses on detecting and responding to security threats on endpoints. While it can monitor file access activities, it cannot enforce granular usage restrictions like preventing printing or copying specific files, nor can it control access for named individuals across different devices and operating systems.',
                    'Incorrect - HSMs provide secure key storage and cryptographic processing, typically used for certificate authorities, code signing, or database encryption. They do not provide document-level access controls or usage restrictions like preventing printing or copying of individual files.',
                    'Correct - IRM embeds access controls and usage restrictions directly into documents, providing persistent protection regardless of where files are stored or accessed. IRM can enforce granular policies such as view-only access for specific named users, prevent printing/copying, set expiration dates, and work across different operating systems and devices.',
                    'Incorrect - VPNs provide secure network connections and can control network access to resources. However, they cannot enforce document-level usage restrictions like preventing printing or copying once files are accessed through the VPN connection. VPNs operate at the network layer, not the document level.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 36 - L3 - Apply
            [
                'topic' => 'Data Loss Prevention',
                'subtopic' => 'Data Security Controls',
                'question' => 'When implementing DLP in a BYOD (Bring Your Own Device) environment, what approach balances security with privacy concerns?',
                'options' => [
                    'Full device monitoring and control for all personal devices',
                    'Containerization or app-based DLP focusing only on corporate data and applications',
                    'No DLP controls on personal devices',
                    'Require employees to use only company-provided devices',
                ],
                'correct_options' => ['Containerization or app-based DLP focusing only on corporate data and applications'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - Containerization or app-based DLP focusing only on corporate data and applications',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 37 - L3 - Apply
            [
                'topic' => 'Data Loss Prevention',
                'subtopic' => 'Data Security Controls',
                'question' => 'A company has an old database server with several hard drives that were used to store marketing leads (non-PII, but commercially sensitive). They need to sanitize these drives before recycling them, prioritizing cost-efficiency and reasonable data protection against non-forensic recovery. Which sanitization approach would be the most balanced for this situation?',
                'options' => [
                    'Send drives to a certified destruction service for degaussing',
                    'Perform a single-pass overwrite with pseudo-random data',
                    'Disconnect and store the drives in a locked cabinet indefinitely',
                    'Physically shred the drives into fine particles',
                ],
                'correct_options' => ['Perform a single-pass overwrite with pseudo-random data'],
                'justifications' => [
                    'Incorrect - While degaussing provides excellent security for magnetic drives, it requires specialized equipment and certified services, making it more expensive than necessary for commercially sensitive but non-PII data that only needs protection against non-forensic recovery.',
                    'Correct - Single-pass overwriting with pseudo-random data provides cost-effective clearing-level sanitization that protects against standard recovery tools and methods. For commercially sensitive marketing data (non-PII) that needs protection against non-forensic recovery, this approach balances reasonable security with cost efficiency while allowing drive recycling.',
                    'Incorrect - Storage does not sanitize the data and creates ongoing security risks, storage costs, and compliance issues. This approach fails to meet the recycling requirement and provides no actual data protection if the drives are eventually accessed.',
                    'Incorrect - Physical shredding provides the highest security level but is unnecessarily expensive and environmentally wasteful for data that only requires protection against non-forensic recovery. This approach exceeds the security requirements while being cost-prohibitive.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 38 - L4 - Analyze
            [
                'topic' => 'Data Loss Prevention',
                'subtopic' => 'Data Security Controls',
                'question' => 'A company stores customer credit card numbers in its database. To comply with PCI DSS, they must protect this data. They are considering two encryption strategies: (1) Encrypting the entire database server\'s disk where the data resides, or (2) Encrypting only the specific database column containing credit card numbers. Which strategy is more effective for protecting the credit card numbers specifically, while allowing the database to function efficiently, and why?',
                'options' => [
                    'Strategy 1, because it provides comprehensive protection for all data on the server',
                    'Strategy 2, because it offers granular protection directly on the sensitive data, minimizing performance impact on less sensitive fields',
                    'Strategy 1, as it is simpler to implement and manage',
                    'Strategy 2, because it encrypts data-in-transit more effectively',
                ],
                'correct_options' => ['Strategy 2, because it offers granular protection directly on the sensitive data, minimizing performance impact on less sensitive fields'],
                'justifications' => [
                    'Incorrect - While full-disk encryption provides broad protection, it doesn\'t offer specific protection for credit card data when the database is running. Once the disk is decrypted for database operations, the credit card numbers are accessible in plaintext to anyone with database access, failing to meet PCI DSS requirements for protecting cardholder data.',
                    'Correct - Column-level encryption (field-level encryption) provides targeted protection specifically for credit card numbers. This approach encrypts the sensitive data at the application level, ensuring credit card numbers remain encrypted even when the database is operational. It minimizes performance impact by only encrypting necessary fields and provides granular access control required by PCI DSS.',
                    'Incorrect - While full-disk encryption may be simpler to implement, simplicity doesn\'t address the specific PCI DSS requirement to protect cardholder data. PCI DSS requires that credit card numbers be encrypted during storage and protected from unauthorized access even by database administrators.',
                    'Incorrect - Column-level encryption primarily protects data-at-rest, not data-in-transit. Data-in-transit protection requires additional measures like TLS/SSL. This option misrepresents the primary benefit of field-level encryption, which is protecting stored sensitive data with granular control.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.6,
                'irt_b' => 0.8,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 39 - L4 - Analyze
            [
                'topic' => 'Data Loss Prevention',
                'subtopic' => 'Data Security Controls',
                'question' => 'You are designing a data protection solution for a highly collaborative engineering firm where sensitive design documents are frequently shared with external partners. The primary goal is to prevent unauthorized viewing or modification of these documents even after they leave the firm\'s network. Which combination of technologies would be most effective in achieving this goal?',
                'options' => [
                    'Network intrusion detection system (IDS) and strong perimeter firewalls',
                    'Full disk encryption on internal servers and secure email gateways',
                    'Data Loss Prevention (DLP) system combined with Information Rights Management (IRM)',
                    'Regular employee security awareness training and multi-factor authentication (MFA)',
                ],
                'correct_options' => ['Data Loss Prevention (DLP) system combined with Information Rights Management (IRM)'],
                'justifications' => [
                    'Incorrect - IDS and firewalls provide network perimeter protection but cannot control document access or modifications once documents leave the network. These technologies focus on preventing unauthorized network access rather than protecting documents in external environments.',
                    'Incorrect - Full disk encryption protects data at rest within the organization, and secure email gateways protect data in transit, but neither provides ongoing control over documents once they reach external partners. These solutions do not address the core requirement of preventing unauthorized viewing or modification outside the network.',
                    'Correct - DLP systems prevent unauthorized data exfiltration and monitor data movement, while IRM provides persistent protection by embedding access controls directly into documents. IRM ensures documents remain protected with granular permissions (view, edit, print, expiry) even when accessed by external partners, meeting the specific requirement for post-network protection.',
                    'Incorrect - While security awareness training and MFA are important security controls, they do not directly protect documents once they leave the network. These are preventive controls that reduce risk but cannot enforce technical restrictions on external document access or modification.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 40 - L5 - Evaluate
            [
                'topic' => 'Data Loss Prevention',
                'subtopic' => 'Data Security Controls',
                'question' => 'An organization implements a DLP solution that blocks 95% of attempted data exfiltration but also blocks 15% of legitimate business activities. Evaluate this configuration.',
                'options' => [
                    'Perfect configuration with excellent security',
                    'Overly restrictive configuration that may impede business operations and encourage workarounds',
                    'Insufficiently restrictive configuration',
                    'Typical configuration that requires no adjustment',
                ],
                'correct_options' => ['Overly restrictive configuration that may impede business operations and encourage workarounds'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Overly restrictive configuration that may impede business operations and encourage workarounds',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Topic 5: Data Privacy Controls (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:4, L4:2, L5:0

            // Item 41 - L1 - Remember
            [
                'topic' => 'Data Privacy Controls',
                'subtopic' => 'Data Sanitization',
                'question' => 'Degaussing is effective only on which type of media?',
                'options' => [
                    'Solid-state drives (SSD)',
                    'Optical disks',
                    'Magnetic storage media',
                    'Flash memory',
                ],
                'correct_options' => ['Magnetic storage media'],
                'justifications' => [
                    'Incorrect - Solid-state drives use NAND flash memory technology that stores data electronically rather than magnetically. Degaussing has no effect on SSDs because they do not rely on magnetic fields for data storage.',
                    'Incorrect - Optical disks (CDs, DVDs, Blu-ray) store data using physical pits and lands on the disk surface that are read by laser light. Since they do not use magnetic storage, degaussing cannot affect optical media.',
                    'Correct - Degaussing works by applying a powerful, alternating magnetic field that disrupts the magnetic domains on magnetic storage devices such as hard disk drives, floppy disks, and magnetic tapes. This process effectively erases the stored data by randomizing the magnetic orientations.',
                    'Incorrect - Flash memory stores data using electrical charges trapped in floating gate transistors. Like SSDs, flash memory devices do not use magnetic storage principles, so degaussing cannot erase data from flash memory devices.',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 42 - L1 - Remember
            [
                'topic' => 'Data Privacy Controls',
                'subtopic' => 'Data Sanitization',
                'question' => 'What is the PRIMARY goal of crypto-shredding?',
                'options' => [
                    'Rewriting data multiple times',
                    'Demagnetizing media',
                    'Destroying encryption keys',
                    'Physically damaging the drive',
                ],
                'correct_options' => ['Destroying encryption keys'],
                'justifications' => [
                    'Incorrect - Rewriting data multiple times is the approach used in overwriting or wiping methods. This technique is less effective for SSDs due to wear-leveling and does not represent the primary goal of crypto-shredding.',
                    'Incorrect - Demagnetizing media describes degaussing, which is effective only on magnetic storage devices. This is not the mechanism or goal of crypto-shredding.',
                    'Correct - Crypto-shredding (cryptographic erasure) works by destroying or making inaccessible the encryption keys used to secure data. Without the keys, the encrypted data becomes permanently unreadable and effectively destroyed, even though the encrypted data may still physically exist on the storage medium.',
                    'Incorrect - Physically damaging the drive describes physical destruction methods like shredding or crushing. While effective, this is not crypto-shredding and renders the device unusable for repurposing.',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 43 - L2 - Understand
            [
                'topic' => 'Data Privacy Controls',
                'subtopic' => 'Data Sanitization',
                'question' => 'What differentiates purging from clearing in media sanitization?',
                'options' => [
                    'Clearing uses physical methods, purging uses logical ones',
                    'Purging protects against laboratory-level recovery',
                    'Clearing is irreversible, purging is not',
                    'Purging is slower than clearing',
                ],
                'correct_options' => ['Purging protects against laboratory-level recovery'],
                'justifications' => [
                    'Incorrect - This reverses the actual relationship. Clearing typically uses logical methods (overwriting, software-based erasure), while purging may use physical or advanced techniques to ensure more thorough data destruction.',
                    'Correct - According to NIST SP 800-88, purging applies physical or logical techniques that render target data recovery infeasible using state-of-the-art laboratory techniques. Clearing only protects against recovery using standard system capabilities and readily available tools.',
                    'Incorrect - Both clearing and purging are intended to be irreversible data sanitization methods. The difference is not in reversibility but in the level of security they provide against different types of recovery attempts.',
                    'Incorrect - Speed is not the primary differentiator between clearing and purging. The key distinction is the level of security provided against data recovery, with purging offering protection against more sophisticated recovery methods.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 44 - L2 - Understand
            [
                'topic' => 'Data Privacy Controls',
                'subtopic' => 'Data Sanitization',
                'question' => 'Match the data sanitization method with its correct definition. Which method "renders target data recovery infeasible using state-of-the-art laboratory techniques while allowing the media to be reused"?',
                'options' => [
                    'Clear - protects against simple non-invasive data recovery techniques',
                    'Purge - protects against state-of-the-art laboratory techniques while preserving media',
                    'Destroy - physically destroys media making it unusable for data storage',
                    'Format - removes file system structure but leaves data recoverable',
                ],
                'correct_options' => ['Purge - protects against state-of-the-art laboratory techniques while preserving media'],
                'justifications' => [
                    'Incorrect - Clear applies logical techniques to sanitize data in user-addressable storage locations but only protects against simple non-invasive data recovery techniques using standard system capabilities and readily available tools. It does not provide protection against advanced laboratory-level recovery methods.',
                    'Correct - According to NIST SP 800-88, purge renders target data recovery infeasible using state-of-the-art laboratory techniques while preserving the media for potential reuse. This includes methods like degaussing for magnetic media and secure erase commands for modern storage devices.',
                    'Incorrect - Destroy applies physical or logical techniques that render data recovery infeasible using laboratory techniques but results in the inability to use the media for future data storage. The key difference is that destroy makes the media unusable, while purge preserves it for reuse.',
                    'Incorrect - Format is not one of the three primary NIST-defined sanitization levels. Formatting only removes file system structure and partition information while leaving the underlying data physically present and easily recoverable using forensic tools.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 45 - L3 - Apply
            [
                'topic' => 'Data Privacy Controls',
                'subtopic' => 'Data Sanitization',
                'question' => 'Which of the following is the MOST effective method to prevent data remanence when repurposing an SSD (solid state drive)?',
                'options' => [
                    'Shredding',
                    'Overwriting',
                    'Degaussing',
                    'Crypto shredding',
                ],
                'correct_options' => ['Crypto shredding'],
                'justifications' => [
                    'Incorrect - Shredding physically destroys the SSD, ensuring data cannot be recovered. However, it renders the drive unusable, which contradicts the goal of repurposing the device.',
                    'Incorrect - Overwriting involves writing random data over existing data. While effective for traditional HDDs, SSDs use wear-leveling techniques that may prevent complete overwriting of all memory cells, leaving some data potentially recoverable.',
                    'Incorrect - Degaussing disrupts magnetic fields to erase data. SSDs store data electronically rather than magnetically, making degaussing completely ineffective for SSDs.',
                    'Correct - Crypto shredding (cryptographic erasure) deletes encryption keys used to secure data, making the encrypted data permanently inaccessible without physically destroying the drive. It is recommended by standards like NIST SP 800-88 and ISO/IEC 27040 and is highly effective for SSDs while allowing the device to be repurposed.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 46 - L3 - Apply
            [
                'topic' => 'Data Privacy Controls',
                'subtopic' => 'Data Sanitization',
                'question' => 'What would be the BEST method to ensure that classified data on a failed hard disk cannot be recovered?',
                'options' => [
                    'Use standard file deletion tools',
                    'Format the drive',
                    'Physical destruction',
                    'Reinstall the OS',
                ],
                'correct_options' => ['Physical destruction'],
                'justifications' => [
                    'Incorrect - Standard file deletion tools only remove file system references to data, leaving the actual data intact on the storage medium. This method provides no protection against data recovery tools and is completely inadequate for classified information.',
                    'Incorrect - Formatting a drive only removes the file system structure and partition information. The underlying data remains physically present on the disk platters and can be easily recovered using forensic tools, making this unsuitable for classified data protection.',
                    'Correct - Physical destruction (shredding, crushing, or disintegration) is the most secure method for classified data, especially on failed drives where other sanitization methods may not function properly. This method ensures complete data destruction regardless of drive condition and meets the highest security standards for classified information.',
                    'Incorrect - Reinstalling the operating system only overwrites system files and leaves user data largely intact. Most classified data would remain recoverable, and this method provides inadequate protection for sensitive information.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 47 - L5 - Evaluate
            [
                'topic' => 'Data Privacy Controls',
                'subtopic' => 'Data Sanitization',
                'question' => 'Evaluate the approach of a multinational corporation that implements a "lowest common denominator" privacy strategy, using the most permissive regulations across all jurisdictions to "simplify operations and reduce costs." What are the implications of this strategy?',
                'options' => [
                    'This approach ensures perfect compliance and operational efficiency across all markets',
                    'Creates significant legal, reputational, and ethical risks while potentially violating stricter regional requirements',
                    'Privacy regulations are essentially identical globally, making this a sound strategy',
                    'Cost reduction should always take priority over privacy compliance complexity',
                ],
                'correct_options' => ['Creates significant legal, reputational, and ethical risks while potentially violating stricter regional requirements'],
                'justifications' => [
                    'Incorrect - This overstates the effectiveness while ignoring significant compliance risks',
                    'Correct - Privacy regulations vary significantly; using the weakest standard violates stricter laws and erodes stakeholder trust',
                    'Incorrect - Major differences exist between regulations like GDPR, CCPA, and other regional frameworks',
                    'Incorrect - Legal compliance and stakeholder trust are fundamental business requirements, not optional considerations',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 48 - L3 - Apply
            [
                'topic' => 'Data Privacy Controls',
                'subtopic' => 'Data Sanitization',
                'question' => 'Which technique BEST prevents data remanence on a magnetic tape to ensure reuse is impossible?',
                'options' => [
                    'Clearing',
                    'Physical destruction',
                    'Data masking',
                    'Secure erase',
                ],
                'correct_options' => ['Physical destruction'],
                'justifications' => [
                    'Incorrect - Clearing uses logical techniques (such as overwriting) to sanitize data. While effective against standard recovery methods, it may not completely eliminate all magnetic traces on tape media, and sophisticated laboratory techniques might still recover some data.',
                    'Correct - Physical destruction (shredding, incineration, or chemical dissolution) completely eliminates the magnetic tape medium, making any data recovery impossible. When the requirement is to ensure reuse is impossible, physical destruction is the most definitive and secure approach.',
                    'Incorrect - Data masking involves replacing sensitive data with fictitious but realistic data. This technique is used for data protection in non-production environments but does not eliminate the original data from the storage medium.',
                    'Incorrect - Secure erase commands may not be available or effective for magnetic tape systems. Even when available, these commands rely on the integrity of the tape drive and controller, which may not provide the same level of assurance as physical destruction for preventing reuse.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 49 - L4 - Analyze
            [
                'topic' => 'Data Privacy Controls',
                'subtopic' => 'Data Sanitization',
                'question' => 'A user performs a "factory reset" on their smartphone before selling it. This action typically deletes user data and restores the device to its original settings. Which data sanitization category does this "factory reset" primarily fall under, from a security perspective?',
                'options' => [
                    'Destroy',
                    'Purge',
                    'Clear',
                    'Crypto-shred',
                ],
                'correct_options' => ['Clear'],
                'justifications' => [
                    'Incorrect - Destroy involves physical destruction of the storage media, making it completely unusable. A factory reset does not physically damage the smartphone and allows the device to be reused, which contradicts the destroy category.',
                    'Incorrect - Purge applies techniques that render data recovery infeasible using state-of-the-art laboratory techniques. Most smartphone factory resets use basic deletion methods that may still leave data recoverable through advanced forensic techniques, falling short of purge-level security.',
                    'Correct - Factory reset typically performs clearing-level sanitization by using logical techniques (deleting file system entries, overwriting some areas) that protect against simple, non-invasive data recovery techniques. However, sophisticated forensic tools may still recover some data, which aligns with the clear category definition per NIST SP 800-88.',
                    'Incorrect - Crypto-shred involves destroying encryption keys to make encrypted data unreadable. While some modern smartphones use encryption, a standard factory reset does not specifically target encryption key destruction and may not be implemented as cryptographic erasure.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 50 - L4 - Analyze
            [
                'topic' => 'Data Privacy Controls',
                'subtopic' => 'Data Sanitization',
                'question' => 'An organization possesses an old tape backup system containing sensitive historical archives. The tapes are no longer readable by modern equipment, rendering the data inaccessible to the organization, yet the data is still present on the tapes. From a data sanitization perspective, what is the most appropriate action to ensure this data cannot be recovered by unauthorized parties?',
                'options' => [
                    'Store the tapes in a secure, off-site location indefinitely',
                    'Perform a software-based overwrite using an old tape drive, if available',
                    'Implement physical destruction of the tapes',
                    'Declare the data "unrecoverable" and take no further action',
                ],
                'correct_options' => ['Implement physical destruction of the tapes'],
                'justifications' => [
                    'Incorrect - While secure storage provides some protection, it does not eliminate the risk of future data recovery. Technology advances or specialized equipment could eventually make the tapes readable again, and secure storage only mitigates but does not eliminate the threat of unauthorized access.',
                    'Incorrect - Software-based overwriting requires functional equipment to read and write to the tapes. If the tapes are no longer readable by modern equipment, attempting overwriting could fail or be incomplete, leaving sensitive data potentially recoverable.',
                    'Correct - Physical destruction (shredding, incineration, or chemical dissolution) completely eliminates any possibility of data recovery, regardless of future technological advances. This approach provides the highest level of assurance that sensitive historical data cannot be accessed by unauthorized parties, even if specialized legacy equipment becomes available.',
                    'Incorrect - Current inaccessibility does not guarantee permanent security. Technology evolution, specialized data recovery services, or discovery of compatible legacy equipment could make the data accessible in the future, creating ongoing security risks for sensitive information.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],
        ];
    }
}
