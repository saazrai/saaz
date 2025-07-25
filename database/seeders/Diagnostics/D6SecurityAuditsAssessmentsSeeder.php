<?php

namespace Database\Seeders\Diagnostics;

class D6SecurityAuditsAssessmentsSeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Security Audits & Assessments';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: Audit Fundamentals (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 1 - L1 - Remember
            [
                'topic' => 'Audit Fundamentals',
                'subtopic' => 'Audit Lifecycle',
                'question' => 'During which phase of the audit lifecycle are audit objectives defined, scope determined, and resources allocated?',
                'options' => [
                    'Fieldwork',
                    'Reporting',
                    'Planning',
                    'Follow-up',
                ],
                'correct_options' => ['Planning'],
                'justifications' => [
                    'Incorrect - Fieldwork is the execution phase where evidence is gathered',
                    'Incorrect - Reporting phase communicates findings after fieldwork is complete',
                    'Correct - Planning phase establishes objectives, determines scope, and allocates resources before audit execution',
                    'Incorrect - Follow-up phase occurs after reporting to verify remediation',
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
                'topic' => 'Audit Fundamentals',
                'subtopic' => 'Audit Lifecycle',
                'question' => 'The security audit lifecycle follows a systematic approach to ensure comprehensive assessment. Drag & drop the audit phases in the correct chronological order from start to finish.',
                'type_id' => 4, // DDO - Drag & Drop Order
                'options' => ['Reporting', 'Follow-up', 'Planning', 'Fieldwork'], // Shuffled
                'correct_options' => ['Planning', 'Fieldwork', 'Reporting', 'Follow-up'],
                'justifications' => [
                    'Planning establishes audit objectives, scope, and methodology',
                    'Fieldwork involves evidence gathering and control testing',
                    'Reporting communicates findings and recommendations to stakeholders',
                    'Follow-up verifies remediation of identified issues',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 3 - L2 - Understand
            [
                'topic' => 'Audit Fundamentals',
                'subtopic' => 'Audit Types',
                'question' => 'When conducting a security audit, what is the most significant advantage of using internal auditors instead of external auditors?',
                'options' => [
                    'Internal auditors provide a more cost-effective auditing solution.',
                    'Internal auditors are more likely to align with management\'s objectives.',
                    'Internal auditors can conduct audits more frequently with fewer restrictions.',
                    'Internal auditors have a deeper understanding of the organization\'s processes and risks.',
                ],
                'correct_options' => ['Internal auditors have a deeper understanding of the organization\'s processes and risks.'],
                'justifications' => [
                    'Incorrect - While cost may be lower, this is not the most significant advantage for audit quality',
                    'Incorrect - Alignment with management objectives can compromise independence and objectivity',
                    'Incorrect - Frequency and fewer restrictions are operational benefits but not the most significant advantage',
                    'Correct - Deep organizational knowledge enables more targeted and effective risk assessment and control evaluation',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 4 - L3 - Apply
            [
                'topic' => 'Audit Fundamentals',
                'subtopic' => 'Audit Planning',
                'question' => 'When developing an audit scope, which of the following is a primary consideration for an auditor?',
                'options' => [
                    'The personal preferences of the audit team',
                    'The availability of advanced audit software',
                    'The risks associated with the areas to be audited',
                    'The amount of time spent on previous audits',
                ],
                'correct_options' => ['The risks associated with the areas to be audited'],
                'justifications' => [
                    'Incorrect - Personal preferences should not drive audit scope determination',
                    'Incorrect - While tools are helpful, they should not be the primary driver of scope',
                    'Correct - Risk assessment is fundamental to determining what areas require audit attention and resources',
                    'Incorrect - Previous time spent is historical data but not a primary consideration for current scope',
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
                'topic' => 'Audit Fundamentals',
                'subtopic' => 'Risk-Based Audit Approaches',
                'question' => 'What is the primary purpose of a risk-based audit approach?',
                'options' => [
                    'To guarantee that no fraud will occur within the organization',
                    'To allocate audit resources to areas with the highest potential risks',
                    'To minimize the time spent on the audit fieldwork',
                    'To eliminate the need for follow-up activities',
                ],
                'correct_options' => ['To allocate audit resources to areas with the highest potential risks'],
                'justifications' => [
                    'Incorrect - No audit approach can guarantee prevention of all fraud',
                    'Correct - Risk-based auditing focuses resources on areas of highest risk to maximize audit effectiveness',
                    'Incorrect - Time reduction is a potential benefit but not the primary purpose',
                    'Incorrect - Follow-up activities remain necessary regardless of audit approach',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 6 - L3 - Apply
            [
                'topic' => 'Audit Fundamentals',
                'subtopic' => 'Audit Lifecycle',
                'question' => 'During which audit lifecycle phase is the auditor most likely to encounter significant scope creep if unforeseen complexities arise?',
                'options' => [
                    'Reporting',
                    'Follow-up',
                    'Fieldwork',
                    'Planning',
                ],
                'correct_options' => ['Fieldwork'],
                'justifications' => [
                    'Incorrect - Reporting phase has defined scope based on completed fieldwork',
                    'Incorrect - Follow-up phase focuses on remediation verification of known issues',
                    'Correct - Fieldwork phase is when auditors discover actual conditions and may uncover unexpected issues requiring expanded testing',
                    'Incorrect - Planning phase sets initial scope but actual discoveries happen during fieldwork',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 7 - L4 - Analyze
            [
                'topic' => 'Audit Fundamentals',
                'subtopic' => 'Professional Standards',
                'question' => 'When selecting an assessor for a critical evaluation (e.g., a high-stakes compliance audit or a comprehensive security assessment), which criterion, if compromised, would pose the greatest fundamental threat to the credibility and trustworthiness of the evaluation\'s findings?',
                'options' => [
                    'The assessor holds relevant industry certifications.',
                    'The assessor has extensive knowledge of the organization\'s business.',
                    'The assessor maintains independence and objectivity.',
                    'The assessor has prior experience with similar assessments.',
                ],
                'correct_options' => ['The assessor maintains independence and objectivity.'],
                'justifications' => [
                    'Incorrect - While certifications demonstrate competency, they can be supplemented by other qualifications',
                    'Incorrect - Business knowledge is valuable but can be acquired during the assessment process',
                    'Correct - Independence and objectivity are fundamental to audit credibility; without them, findings may be biased or influenced by conflicts of interest',
                    'Incorrect - Experience is important but can be gained, and independence remains the critical foundation',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 10 - L4 - Analyze
            [
                'topic' => 'Audit Fundamentals',
                'subtopic' => 'Audit Fundamentals',
                'question' => 'What is the fundamental challenge in auditing DevOps and continuous deployment environments?',
                'options' => [
                    'DevOps environments are inherently more secure',
                    'Rapid change cycles make traditional point-in-time assessments less relevant',
                    'DevOps tools are too complex for auditors to understand',
                    'DevOps environments don\'t require security controls',
                ],
                'correct_options' => ['Rapid change cycles make traditional point-in-time assessments less relevant'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Rapid change cycles make traditional point-in-time assessments less relevant',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 8 - L5 - Evaluate
            [
                'topic' => 'Audit Fundamentals',
                'subtopic' => 'Audit Fundamentals',
                'question' => 'An organization conducts annual compliance audits but experiences frequent security incidents. Evaluate the effectiveness of their audit approach.',
                'options' => [
                    'Annual audits are sufficient for all organizations',
                    'Audit approach may be too infrequent and compliance-focused rather than risk-based',
                    'More audits would not prevent security incidents',
                    'The organization should eliminate audits and focus on monitoring',
                ],
                'correct_options' => ['Audit approach may be too infrequent and compliance-focused rather than risk-based'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - Audit approach may be too infrequent and compliance-focused rather than risk-based',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 9 - L5 - Evaluate
            [
                'topic' => 'Audit Fundamentals',
                'subtopic' => 'Audit Fundamentals',
                'question' => 'Evaluate the practice of using the same auditors for multiple consecutive years without rotation.',
                'options' => [
                    'Continuity improves audit quality and efficiency',
                    'May lead to familiarity threats and reduced independence over time',
                    'Same auditors always provide better insights',
                    'Auditor rotation is unnecessary for internal audits',
                ],
                'correct_options' => ['May lead to familiarity threats and reduced independence over time'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - May lead to familiarity threats and reduced independence over time',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Topic 2: Evidence Gathering (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L3 - Apply
            [
                'topic' => 'Evidence Gathering',
                'subtopic' => 'Evidence Gathering',
                'question' => 'An internal auditor is conducting an audit of the organization\'s physical security controls for its data center. During fieldwork, the auditor notices that several critical entry points are not consistently monitored by security personnel, despite documented procedures requiring continuous surveillance. The most persuasive and direct form of audit evidence for this observation would be:',
                'options' => [
                    'Management\'s written assertion that security procedures are followed.',
                    'A walk-through of the data center while explicitly observing the security personnel\'s actions (or inactions) over a period.',
                    'An interview with the Head of Security confirming the monitoring schedule.',
                    'A review of the access logs which show regular entry and exit without correlating to personnel shifts.',
                ],
                'correct_options' => ['A walk-through of the data center while explicitly observing the security personnel\'s actions (or inactions) over a period.'],
                'justifications' => [
                    'Incorrect - Management assertions are less reliable than direct observation',
                    'Correct - Direct observation provides the most persuasive evidence of actual control operation',
                    'Incorrect - Interviews provide less reliable evidence than direct observation',
                    'Incorrect - Access logs alone don\'t confirm personnel monitoring activities',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 12 - L1 - Remember
            [
                'topic' => 'Evidence Gathering',
                'subtopic' => 'Evidence Gathering',
                'question' => 'Why is corroborating evidence important in security audits?',
                'options' => [
                    'Corroboration is only required for external audits',
                    'Multiple sources of evidence increase reliability and reduce bias',
                    'Corroborating evidence is always more expensive to obtain',
                    'Single sources of evidence are always sufficient',
                ],
                'correct_options' => ['Multiple sources of evidence increase reliability and reduce bias'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Multiple sources of evidence increase reliability and reduce bias',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 13 - L2 - Understand
            [
                'topic' => 'Evidence Gathering',
                'subtopic' => 'Evidence Gathering',
                'question' => 'How does the relevance of evidence differ from its reliability?',
                'options' => [
                    'Relevance and reliability are identical concepts',
                    'Relevance relates to audit objectives while reliability relates to evidence quality',
                    'Reliability is more important than relevance in all cases',
                    'Relevance only applies to compliance audits',
                ],
                'correct_options' => ['Relevance relates to audit objectives while reliability relates to evidence quality'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Relevance relates to audit objectives while reliability relates to evidence quality',
                    'Incorrect - This overstates the capability or scope',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 14 - L3 - Apply
            [
                'topic' => 'Evidence Gathering',
                'subtopic' => 'Evidence Gathering',
                'question' => 'Which of the following scenarios best illustrates the application of "re-performance" as an evidence-gathering technique?',
                'options' => [
                    'An auditor asking an accounts payable clerk to describe the invoice processing procedure.',
                    'An auditor visually inspecting fixed assets on the factory floor to confirm their existence.',
                    'An auditor recalculating the depreciation expense on a sample of assets using the company\'s stated depreciation method and asset records.',
                    'An auditor using data analytics to identify unusual patterns in expense reports.',
                ],
                'correct_options' => ['An auditor recalculating the depreciation expense on a sample of assets using the company\'s stated depreciation method and asset records.'],
                'justifications' => [
                    'Incorrect - This is inquiry, not re-performance',
                    'Incorrect - This is observation, not re-performance',
                    'Correct - Re-performance involves independently executing procedures or controls to verify results',
                    'Incorrect - This is analytical procedures, not re-performance',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 15 - L3 - Apply
            [
                'topic' => 'Evidence Gathering',
                'subtopic' => 'Evidence Gathering',
                'question' => 'How should you handle situations where key audit evidence is stored in a cloud service controlled by a third party?',
                'options' => [
                    'Skip testing if evidence is not directly accessible',
                    'Work with the organization to obtain evidence through proper channels and attestations',
                    'Only accept third-party auditor reports without additional validation',
                    'Assume controls are ineffective if evidence cannot be accessed',
                ],
                'correct_options' => ['Work with the organization to obtain evidence through proper channels and attestations'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Work with the organization to obtain evidence through proper channels and attestations',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 16 - L3 - Apply
            [
                'topic' => 'Evidence Gathering',
                'subtopic' => 'Evidence Gathering',
                'question' => 'What is the most appropriate approach when audit evidence contradicts management assertions?',
                'options' => [
                    'Always accept management explanations without question',
                    'Investigate further and gather additional evidence to resolve discrepancies',
                    'Ignore contradictory evidence if management objects',
                    'Report findings without additional investigation',
                ],
                'correct_options' => ['Investigate further and gather additional evidence to resolve discrepancies'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Investigate further and gather additional evidence to resolve discrepancies',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
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
                'topic' => 'Evidence Gathering',
                'subtopic' => 'Evidence Gathering',
                'question' => 'Analyze why automated evidence collection may be both more reliable and more risky than manual collection.',
                'options' => [
                    'Automated collection is always superior to manual methods',
                    'Automation reduces human bias but may miss context or have configuration errors',
                    'Manual collection is always more accurate than automation',
                    'There are no significant differences between automated and manual collection',
                ],
                'correct_options' => ['Automation reduces human bias but may miss context or have configuration errors'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Automation reduces human bias but may miss context or have configuration errors',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This option does not accurately describe the concept',
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
                'topic' => 'Evidence Gathering',
                'subtopic' => 'Evidence Gathering',
                'question' => 'What is the fundamental challenge in gathering evidence for "security by design" practices?',
                'options' => [
                    'Security by design practices are always well-documented',
                    'Design decisions and rationale may not be captured in traditional audit trails',
                    'Security by design evidence is too technical for auditors',
                    'Security by design practices don\'t require evidence',
                ],
                'correct_options' => ['Design decisions and rationale may not be captured in traditional audit trails'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Design decisions and rationale may not be captured in traditional audit trails',
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
                'topic' => 'Evidence Gathering',
                'subtopic' => 'Evidence Gathering',
                'question' => 'An auditor relies primarily on screenshots and PDF reports provided by the client instead of direct system access. Evaluate this evidence gathering approach.',
                'options' => [
                    'Screenshots and reports provide sufficient evidence for all audit purposes',
                    'This approach may lack independence and verifiability compared to direct observation',
                    'Client-provided evidence is always more reliable than direct access',
                    'The format of evidence doesn\'t impact audit quality',
                ],
                'correct_options' => ['This approach may lack independence and verifiability compared to direct observation'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - This approach may lack independence and verifiability compared to direct observation',
                    'Incorrect - This is too absolute or limiting',
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

            // Item 20 - L5 - Evaluate
            [
                'topic' => 'Evidence Gathering',
                'subtopic' => 'Evidence Gathering',
                'question' => 'Evaluate the practice of accepting SOC 2 reports as primary evidence for all cloud service security controls without additional testing.',
                'options' => [
                    'SOC 2 reports provide complete coverage for all security requirements',
                    'SOC 2 reports are valuable but may not cover all relevant controls or provide current status',
                    'Third-party reports eliminate the need for any additional audit procedures',
                    'SOC 2 reports are not relevant for security audits',
                ],
                'correct_options' => ['SOC 2 reports are valuable but may not cover all relevant controls or provide current status'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - SOC 2 reports are valuable but may not cover all relevant controls or provide current status',
                    'Incorrect - This overstates the capability or scope',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Topic 3: Control Assessment (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L1 - Remember
            [
                'topic' => 'Control Assessment',
                'subtopic' => 'Control Assessment',
                'question' => 'What are the three main categories of security controls?',
                'options' => [
                    'Administrative, technical, and physical controls',
                    'Preventive, detective, and corrective controls',
                    'Manual, automated, and hybrid controls',
                    'Both A and B are correct classification systems',
                ],
                'correct_options' => ['Both A and B are correct classification systems'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Both A and B are correct classification systems',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 22 - L1 - Remember
            [
                'topic' => 'Control Assessment',
                'subtopic' => 'Control Assessment',
                'question' => 'What is a compensating control?',
                'options' => [
                    'A control that replaces all other security measures',
                    'An alternative control that provides equivalent protection when primary controls cannot be implemented',
                    'A control that only works during business hours',
                    'A control that costs less than standard implementations',
                ],
                'correct_options' => ['An alternative control that provides equivalent protection when primary controls cannot be implemented'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - An alternative control that provides equivalent protection when primary controls cannot be implemented',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 23 - L2 - Understand
            [
                'topic' => 'Control Assessment',
                'subtopic' => 'Control Assessment',
                'question' => 'One way to determine control effectiveness is by evaluating:',
                'options' => [
                    'The number of controls implemented across business units',
                    'How well the control meets its intended objective',
                    'Whether the control is automated or manual',
                    'The financial cost of implementing the control',
                ],
                'correct_options' => ['How well the control meets its intended objective'],
                'justifications' => [
                    'Incorrect - Quantity of controls does not indicate effectiveness of individual controls',
                    'Correct - Control effectiveness is measured by how well it achieves its intended security objective',
                    'Incorrect - Implementation method (automated vs manual) does not determine effectiveness',
                    'Incorrect - Cost is a business consideration but not a measure of control effectiveness',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 24 - L2 - Understand
            [
                'topic' => 'Control Assessment',
                'subtopic' => 'Control Assessment',
                'question' => 'What is the MOST important reason for periodically testing controls?',
                'options' => [
                    'To meet regulatory requirements',
                    'To meet due care requirements',
                    'To ensure that control objectives are met',
                    'To achieve compliance with standard policy',
                ],
                'correct_options' => ['To ensure that control objectives are met'],
                'justifications' => [
                    'Incorrect - Regulatory compliance is important but secondary to ensuring actual control effectiveness',
                    'Incorrect - Due care is a legal concept but the primary purpose is verifying control performance',
                    'Correct - The fundamental purpose of control testing is to verify that controls are achieving their intended security objectives',
                    'Incorrect - Policy compliance is important but subordinate to ensuring controls actually work as intended',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 25 - L3 - Apply
            [
                'topic' => 'Control Assessment',
                'subtopic' => 'Control Assessment',
                'question' => 'How should you test the effectiveness of automated security monitoring controls?',
                'options' => [
                    'Review configuration settings only',
                    'Test detection capabilities using controlled scenarios and review alert handling',
                    'Interview the monitoring team about their procedures',
                    'Check that monitoring software is installed and running',
                ],
                'correct_options' => ['Test detection capabilities using controlled scenarios and review alert handling'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Test detection capabilities using controlled scenarios and review alert handling',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 26 - L3 - Apply
            [
                'topic' => 'Control Assessment',
                'subtopic' => 'Control Assessment',
                'question' => 'When assessing data loss prevention (DLP) controls, what testing approach would provide the most comprehensive evaluation?',
                'options' => [
                    'Review DLP policy configurations only',
                    'Test detection accuracy with various data types and transmission methods',
                    'Verify DLP software installation across endpoints',
                    'Interview users about DLP training received',
                ],
                'correct_options' => ['Test detection accuracy with various data types and transmission methods'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Test detection accuracy with various data types and transmission methods',
                    'Incorrect - This overstates the capability or scope',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 27 - L3 - Apply
            [
                'topic' => 'Control Assessment',
                'subtopic' => 'Control Assessment',
                'question' => 'What is the most appropriate approach for assessing controls in a shared cloud environment?',
                'options' => [
                    'Only assess customer-controlled configurations',
                    'Evaluate both customer responsibilities and cloud provider attestations',
                    'Assume cloud provider controls are always effective',
                    'Only rely on cloud provider security documentation',
                ],
                'correct_options' => ['Evaluate both customer responsibilities and cloud provider attestations'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Evaluate both customer responsibilities and cloud provider attestations',
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

            // Item 28 - L4 - Analyze
            [
                'topic' => 'Control Assessment',
                'subtopic' => 'Control Assessment',
                'question' => 'When assessing security controls, which of the following is the MOST important consideration? The controls are:',
                'options' => [
                    'designed to minimize risks',
                    'implemented as designed',
                    'operating as intended',
                    'producing the desired results',
                ],
                'correct_options' => ['producing the desired results'],
                'justifications' => [
                    'Incorrect - Good design is important but meaningless if it doesn\'t achieve security objectives',
                    'Incorrect - Proper implementation is necessary but insufficient if the results are ineffective',
                    'Incorrect - Operating as intended is valuable but the ultimate measure is actual effectiveness',
                    'Correct - The most important consideration is whether controls actually achieve their security objectives and produce desired risk reduction',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 29 - L4 - Analyze
            [
                'topic' => 'Control Assessment',
                'subtopic' => 'Control Assessment',
                'question' => 'What is the fundamental challenge in assessing the effectiveness of "defense in depth" security strategies?',
                'options' => [
                    'Defense in depth strategies are always perfectly effective',
                    'Complex interdependencies make it difficult to assess overall effectiveness and identify single points of failure',
                    'Defense in depth strategies are easier to assess than single controls',
                    'All controls in defense in depth must fail simultaneously',
                ],
                'correct_options' => ['Complex interdependencies make it difficult to assess overall effectiveness and identify single points of failure'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Complex interdependencies make it difficult to assess overall effectiveness and identify single points of failure',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 30 - L5 - Evaluate
            [
                'topic' => 'Control Assessment',
                'subtopic' => 'Control Assessment',
                'question' => 'An organization implements extensive logging controls but rarely reviews logs due to volume. How should you evaluate the effectiveness of this control approach?',
                'options' => [
                    'Logging controls are effective if logs are properly collected',
                    'Control effectiveness requires both proper collection and analysis; unused logs provide limited security value',
                    'Log volume always indicates better security',
                    'Manual log review is the only valid assessment approach',
                ],
                'correct_options' => ['Control effectiveness requires both proper collection and analysis; unused logs provide limited security value'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Control effectiveness requires both proper collection and analysis; unused logs provide limited security value',
                    'Incorrect - This is too absolute or limiting',
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

            // Topic 4: Testing Methodologies & Approaches (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L2 - Understand
            [
                'topic' => 'Testing Methodologies & Approaches',
                'subtopic' => 'Testing Methodologies & Approaches',
                'question' => 'An organization is deciding between black-box and white-box testing for a new application. Which of the following BEST explains a key advantage of white-box testing over black-box testing?',
                'options' => [
                    'It better simulates a real-world attacker',
                    'It requires no knowledge of the system',
                    'It helps detect logic flaws and insecure code paths early in development',
                    'It reduces bias by hiding system details from testers',
                ],
                'correct_options' => ['It helps detect logic flaws and insecure code paths early in development'],
                'justifications' => [
                    'Incorrect - Black-box testing better simulates real-world attackers with no internal knowledge',
                    'Incorrect - White-box testing requires extensive system knowledge, not no knowledge',
                    'Correct - White-box testing\'s access to source code and system internals enables early detection of logic flaws and insecure code paths',
                    'Incorrect - White-box testing exposes system details to testers, which can introduce bias',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 32 - L1 - Remember
            [
                'topic' => 'Testing Methodologies & Approaches',
                'subtopic' => 'Testing Methodologies & Approaches',
                'question' => 'What is sampling in audit testing?',
                'options' => [
                    'Testing every transaction or item in a population',
                    'Selecting a representative subset of items for testing',
                    'Only testing items that appear suspicious',
                    'Testing items randomly without any methodology',
                ],
                'correct_options' => ['Selecting a representative subset of items for testing'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Selecting a representative subset of items for testing',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 33 - L2 - Understand
            [
                'topic' => 'Testing Methodologies & Approaches',
                'subtopic' => 'Testing Methodologies & Approaches',
                'question' => 'An internal auditor performs attribute sampling to test the effectiveness of a control designed to ensure that all expense reports over a certain threshold are approved by two managers. If the auditor concludes that the control is effective based on the sample, but in reality, the deviation rate in the population is unacceptably high, the auditor has incurred:',
                'options' => [
                    'Non-sampling risk',
                    'Risk of incorrect acceptance (Type II error)',
                    'Risk of incorrect rejection (Type I error)',
                    'Detection risk',
                ],
                'correct_options' => ['Risk of incorrect acceptance (Type II error)'],
                'justifications' => [
                    'Incorrect - Non-sampling risk relates to factors other than sampling',
                    'Correct - Type II error occurs when the auditor concludes controls are effective when they are not',
                    'Incorrect - Type I error is rejecting effective controls',
                    'Incorrect - Detection risk is broader and includes both sampling and non-sampling risks',
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
                'topic' => 'Testing Methodologies & Approaches',
                'subtopic' => 'Testing Methodologies & Approaches',
                'question' => 'Which sampling method is most appropriate when an auditor is trying to identify the existence of at least one instance of a critical exception (e.g., fraud or an unauthorized transaction) within a very large population?',
                'options' => [
                    'Attribute Sampling',
                    'Stratified Sampling',
                    'Stop-or-Go Sampling',
                    'Discovery Sampling',
                ],
                'correct_options' => ['Discovery Sampling'],
                'justifications' => [
                    'Incorrect - Attribute sampling estimates deviation rates, not exception discovery',
                    'Incorrect - Stratified sampling divides populations but doesn\'t focus on exception discovery',
                    'Incorrect - Stop-or-Go sampling adjusts sample sizes but isn\'t designed for exception discovery',
                    'Correct - Discovery sampling is specifically designed to detect at least one occurrence of a critical exception',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 35 - L3 - Apply
            [
                'topic' => 'Testing Methodologies & Approaches',
                'subtopic' => 'Testing Methodologies & Approaches',
                'question' => 'An auditor uses "Stop-or-Go" (Sequential) sampling to test invoice approvals. The tolerable deviation rate is 5%. After testing a small initial sample, no deviations are found. Based on this, the auditor decides to significantly reduce the remaining sample size originally planned. This decision is permissible under Stop-or-Go sampling only if:',
                'options' => [
                    'The auditor is willing to accept a higher risk of incorrect acceptance.',
                    'The inherent risk of the process is reassessed as very low.',
                    'The results of the initial sample provide strong evidence that the actual deviation rate is significantly lower than the tolerable rate.',
                    'The audit budget for that area has been exhausted.',
                ],
                'correct_options' => ['The results of the initial sample provide strong evidence that the actual deviation rate is significantly lower than the tolerable rate.'],
                'justifications' => [
                    'Incorrect - Risk tolerance should not change mid-sampling',
                    'Incorrect - Inherent risk assessment is separate from sampling methodology',
                    'Correct - Stop-or-Go sampling allows early termination when results strongly suggest low deviation rates',
                    'Incorrect - Budget constraints should not drive sampling decisions',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 36 - L3 - Apply
            [
                'topic' => 'Testing Methodologies & Approaches',
                'subtopic' => 'Testing Methodologies & Approaches',
                'question' => 'How should you approach testing in an environment where making configuration changes could disrupt business operations?',
                'options' => [
                    'Proceed with all planned tests regardless of business impact',
                    'Use read-only testing methods and coordinate disruptive tests during maintenance windows',
                    'Skip all testing to avoid any risk of disruption',
                    'Only test during peak business hours for realistic results',
                ],
                'correct_options' => ['Use read-only testing methods and coordinate disruptive tests during maintenance windows'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - Use read-only testing methods and coordinate disruptive tests during maintenance windows',
                    'Incorrect - This overstates the capability or scope',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 37 - L3 - Apply
            [
                'topic' => 'Testing Methodologies & Approaches',
                'subtopic' => 'Testing Methodologies & Approaches',
                'question' => 'What is the most effective approach for testing incident response procedures?',
                'options' => [
                    'Review written procedures and interview staff only',
                    'Conduct tabletop exercises and simulated incident scenarios',
                    'Wait for actual incidents to test response effectiveness',
                    'Only test technical detection capabilities',
                ],
                'correct_options' => ['Conduct tabletop exercises and simulated incident scenarios'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Conduct tabletop exercises and simulated incident scenarios',
                    'Incorrect - This option does not accurately describe the concept',
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

            // Item 38 - L4 - Analyze
            [
                'topic' => 'Testing Methodologies & Approaches',
                'subtopic' => 'Testing Methodologies & Approaches',
                'question' => 'You are leading a cybersecurity audit and must allocate limited testing resources. How would you design a risk-based testing strategy?',
                'options' => [
                    'Test components based on how recently they were developed',
                    'Focus on components with the highest business value and known vulnerabilities',
                    'Test all modules equally regardless of their exposure or importance',
                    'Randomly select components to avoid bias',
                ],
                'correct_options' => ['Focus on components with the highest business value and known vulnerabilities'],
                'justifications' => [
                    'Incorrect - Development timeline alone does not indicate risk level',
                    'Correct - Risk-based testing prioritizes resources on high-value assets with known vulnerabilities to maximize impact',
                    'Incorrect - Equal testing ignores risk levels and wastes limited resources',
                    'Incorrect - Random selection does not consider risk factors or business impact',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 39 - L4 - Analyze
            [
                'topic' => 'Testing Methodologies & Approaches',
                'subtopic' => 'Testing Methodologies & Approaches',
                'question' => 'What is the fundamental limitation of point-in-time testing in dynamic IT environments?',
                'options' => [
                    'Point-in-time testing is always sufficient for all environments',
                    'Rapid changes may render test results obsolete quickly, missing emerging vulnerabilities',
                    'Point-in-time testing is more expensive than continuous testing',
                    'Dynamic environments don\'t require security testing',
                ],
                'correct_options' => ['Rapid changes may render test results obsolete quickly, missing emerging vulnerabilities'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Rapid changes may render test results obsolete quickly, missing emerging vulnerabilities',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 40 - L5 - Evaluate
            [
                'topic' => 'Testing Methodologies & Approaches',
                'subtopic' => 'Testing Methodologies & Approaches',
                'question' => 'An auditor uses only vendor-provided security scanning tools and accepts their default configurations. Evaluate this testing approach.',
                'options' => [
                    'Vendor tools with default settings provide comprehensive coverage',
                    'May miss organization-specific risks and produce false negatives due to lack of customization',
                    'Default configurations are always optimal for all environments',
                    'Vendor tools eliminate the need for manual testing',
                ],
                'correct_options' => ['May miss organization-specific risks and produce false negatives due to lack of customization'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - May miss organization-specific risks and produce false negatives due to lack of customization',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Topic 5: Security Testing (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 41 - L1 - Remember
            [
                'topic' => 'Security Testing',
                'subtopic' => 'Security Testing',
                'question' => 'What is penetration testing?',
                'options' => [
                    'A compliance audit of security policies',
                    'Simulated cyber attacks to identify vulnerabilities',
                    'Installation of security monitoring tools',
                    'Training employees about security threats',
                ],
                'correct_options' => ['Simulated cyber attacks to identify vulnerabilities'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Simulated cyber attacks to identify vulnerabilities',
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

            // Item 42 - L1 - Remember
            [
                'topic' => 'Security Testing',
                'subtopic' => 'Security Testing',
                'question' => 'What does vulnerability scanning identify?',
                'options' => [
                    'Only network topology information',
                    'Known security weaknesses in systems and applications',
                    'Employee security awareness levels',
                    'Physical security camera locations',
                ],
                'correct_options' => ['Known security weaknesses in systems and applications'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Known security weaknesses in systems and applications',
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

            // Item 43 - L2 - Understand
            [
                'topic' => 'Security Testing',
                'subtopic' => 'Security Testing',
                'question' => 'A penetration tester is engaged to assess the security of an e-commerce platform. The tester is given a standard customer account login and access to documentation describing the system\'s public APIs. However, they do not have access to the underlying server infrastructure or source code. This approach is known as:',
                'options' => [
                    'Black-box testing',
                    'White-box testing',
                    'Gray-box testing',
                    'Acceptance testing',
                ],
                'correct_options' => ['Gray-box testing'],
                'justifications' => [
                    'Incorrect - Black-box testing provides no internal knowledge or access',
                    'Incorrect - White-box testing provides full internal access including source code',
                    'Correct - Gray-box testing provides limited internal knowledge (account access and API documentation) without full system access',
                    'Incorrect - Acceptance testing validates business requirements, not security methodology',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 44 - L2 - Understand
            [
                'topic' => 'Security Testing',
                'subtopic' => 'Security Testing',
                'question' => 'What is the MOST important reason for periodically testing controls?',
                'options' => [
                    'To meet regulatory requirements',
                    'To meet due care requirements',
                    'To ensure that control objectives are met',
                    'To achieve compliance with standard policy',
                ],
                'correct_options' => ['To ensure that control objectives are met'],
                'justifications' => [
                    'Incorrect - Regulatory compliance is important but secondary to ensuring actual control effectiveness',
                    'Incorrect - Due care is a legal concept but the primary purpose is verifying control performance',
                    'Correct - The fundamental purpose of control testing is to verify that controls are achieving their intended security objectives',
                    'Incorrect - Policy compliance is important but subordinate to ensuring controls actually work as intended',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 45 - L3 - Apply
            [
                'topic' => 'Security Testing',
                'subtopic' => 'Security Testing',
                'question' => 'Prior to initiating any technical activities during a penetration test, which of the following prerequisites is most critical to establish legally permissible and ethically sound boundaries for the engagement?',
                'options' => [
                    'Clearly defined scope of the test',
                    'Management\'s formal authorization for the test',
                    'Signed Non-Disclosure Agreement (NDA)',
                    'Documented rules of engagement',
                ],
                'correct_options' => ['Management\'s formal authorization for the test'],
                'justifications' => [
                    'Incorrect - Scope definition is important but meaningless without proper authorization',
                    'Correct - Formal authorization is the foundational legal requirement that legitimizes all penetration testing activities',
                    'Incorrect - NDAs protect confidentiality but don\'t authorize testing activities',
                    'Incorrect - Rules of engagement are crucial but follow from and depend on proper authorization',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 46 - L3 - Apply
            [
                'topic' => 'Security Testing',
                'subtopic' => 'Security Testing',
                'question' => 'How should you handle discovered vulnerabilities during a security assessment?',
                'options' => [
                    'Publicly disclose all findings immediately',
                    'Follow responsible disclosure practices and work with the organization on remediation',
                    'Exploit vulnerabilities to demonstrate business impact',
                    'Only report vulnerabilities that can be easily fixed',
                ],
                'correct_options' => ['Follow responsible disclosure practices and work with the organization on remediation'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - Follow responsible disclosure practices and work with the organization on remediation',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 47 - L3 - Apply
            [
                'topic' => 'Security Testing',
                'subtopic' => 'Security Testing',
                'question' => 'An enterprise implemented a new control to mitigate a recurring risk event. Which of the following would BEST measure the effectiveness of the implemented control?',
                'options' => [
                    'Reduction in financial impact on the annual report',
                    'Measurable reduction in likelihood, impact or both',
                    'Readjustment of risk appetite to meet residual risk',
                    'Increased efficiency over the appropriate processes',
                ],
                'correct_options' => ['Measurable reduction in likelihood, impact or both'],
                'justifications' => [
                    'Incorrect - Financial impact reduction is an outcome but not the direct measure of control effectiveness',
                    'Correct - Control effectiveness is best measured by quantifiable reduction in risk likelihood, impact, or both',
                    'Incorrect - Risk appetite adjustment is a management decision, not a measure of control effectiveness',
                    'Incorrect - Process efficiency is a benefit but not the primary measure of risk control effectiveness',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 48 - L4 - Analyze
            [
                'topic' => 'Security Testing',
                'subtopic' => 'Security Testing',
                'question' => 'Analyze why red team exercises may provide different insights than traditional penetration testing.',
                'options' => [
                    'Red team exercises and penetration tests are identical',
                    'Red team exercises simulate persistent attackers and test detection/response capabilities over time',
                    'Red team exercises are always less thorough than penetration tests',
                    'Red team exercises only focus on physical security',
                ],
                'correct_options' => ['Red team exercises simulate persistent attackers and test detection/response capabilities over time'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Red team exercises simulate persistent attackers and test detection/response capabilities over time',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 49 - L4 - Analyze
            [
                'topic' => 'Security Testing',
                'subtopic' => 'Security Testing',
                'question' => 'What is the fundamental limitation of signature-based vulnerability scanners in modern environments?',
                'options' => [
                    'Signature-based scanners are always completely accurate',
                    'They may miss zero-day vulnerabilities and custom applications not in signature databases',
                    'Signature-based scanning is too expensive for most organizations',
                    'They only work on legacy systems',
                ],
                'correct_options' => ['They may miss zero-day vulnerabilities and custom applications not in signature databases'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - They may miss zero-day vulnerabilities and custom applications not in signature databases',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',
                'type_id' => 1,

            ],

            // Item 50 - L5 - Evaluate
            [
                'topic' => 'Security Testing',
                'subtopic' => 'Security Testing',
                'question' => 'An organization conducts quarterly vulnerability scans but argues that penetration testing is unnecessary because "we fix all the vulnerabilities found." Evaluate this position.',
                'options' => [
                    'Vulnerability scanning is always sufficient for security assurance',
                    'Penetration testing validates actual exploitability and identifies business logic flaws not found by scanning',
                    'Penetration testing is only necessary for compliance requirements',
                    'Fixing scan results eliminates all security risks',
                ],
                'correct_options' => ['Penetration testing validates actual exploitability and identifies business logic flaws not found by scanning'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Penetration testing validates actual exploitability and identifies business logic flaws not found by scanning',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',
                'type_id' => 1,

            ],
        ];
    }
}
