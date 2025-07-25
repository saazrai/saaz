<?php

namespace Database\Seeders\Diagnostics;

class D5RiskManagementSeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Risk Management';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: Risk Management Fundamentals (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 1 - L1 - Remember
            [
                'topic' => 'Risk Management Fundamentals',
                'subtopic' => 'Risk management lifecycle (Identify → Assess → Treat → Monitor)',
                'type_id' => 1,
                'question' => 'What is the definition of risk in information security?',
                'options' => [
                    'The potential for loss or damage when threats exploit vulnerabilities',
                    'Any security control that fails to function properly',
                    'The cost of implementing security measures',
                    'The probability that a system will never fail',
                ],
                'correct_options' => ['The potential for loss or damage when threats exploit vulnerabilities'],
                'justifications' => [
                    'Correct - The potential for loss or damage when threats exploit vulnerabilities',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 2 - L2 - Understand
            [
                'topic' => 'Risk Management Fundamentals',
                'subtopic' => 'Vulnerability',
                'type_id' => 1,
                'question' => 'An unpatched software flaw in a widely used operating system that allows remote code execution is best categorized as a:',
                'options' => [
                    'Threat',
                    'Vulnerability',
                    'Risk',
                    'Attack',
                ],
                'correct_options' => ['Vulnerability'],
                'justifications' => [
                    'Incorrect - A threat is an actor or event that could exploit a weakness, not the weakness itself',
                    'Correct - A vulnerability is a weakness or flaw that can be exploited, which accurately describes an unpatched software flaw',
                    'Incorrect - Risk is the potential for loss when a threat exploits a vulnerability, not the flaw itself',
                    'Incorrect - An attack is the actual exploitation attempt, not the underlying flaw',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 3 - L2 - Understand
            [
                'topic' => 'Risk Management Fundamentals',
                'subtopic' => 'Risk governance structure and committees',
                'type_id' => 1,
                'question' => 'Who is ultimately accountable for approving the organization\'s risk appetite?',
                'options' => [
                    'Chief Risk Officer (CRO)',
                    'Chief Information Security Officer (CISO)',
                    'Executive Management',
                    'Board of Directors',
                ],
                'correct_options' => ['Board of Directors'],
                'justifications' => [
                    'Incorrect - The CRO advises and implements but doesn\'t have final approval authority',
                    'Incorrect - The CISO manages security risks but doesn\'t approve overall organizational risk appetite',
                    'Incorrect - Executive Management recommends and implements but final accountability rests higher',
                    'Correct - The Board of Directors has ultimate fiduciary responsibility and accountability for approving organizational risk appetite',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 4 - L3 - Apply
            [
                'topic' => 'Risk Management Fundamentals',
                'subtopic' => 'Threat',
                'type_id' => 1,
                'question' => 'A disgruntled former employee with valid system credentials, who intends to sabotage company data, represents which of the following?',
                'options' => [
                    'Vulnerability',
                    'Opportunity',
                    'Threat Agent',
                    'Control Failure',
                ],
                'correct_options' => ['Threat Agent'],
                'justifications' => [
                    'Incorrect - A vulnerability is a weakness that can be exploited, not the actor who exploits it',
                    'Incorrect - Opportunity refers to a circumstance that makes exploitation possible, not the actor',
                    'Correct - A threat agent is an entity (person, group, or system) with the capability and intent to exploit vulnerabilities',
                    'Incorrect - Control failure is when security measures don\'t work as intended, not the malicious actor',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 5 - L3 - Apply
            [
                'topic' => 'Risk Management Fundamentals',
                'subtopic' => 'Threat',
                'type_id' => 1,
                'question' => 'Which of the following scenarios primarily describes a threat?',
                'options' => [
                    'A default password on a network router.',
                    'An unencrypted database storing sensitive customer information.',
                    'A natural disaster like an earthquake occurring in a data center region.',
                    'Lack of regular security awareness training for employees.',
                ],
                'correct_options' => ['A natural disaster like an earthquake occurring in a data center region.'],
                'justifications' => [
                    'Incorrect - Default passwords are vulnerabilities (weaknesses) that can be exploited',
                    'Incorrect - Unencrypted databases are vulnerabilities that expose data to potential compromise',
                    'Correct - A natural disaster is a threat - an external event or circumstance that could cause harm by exploiting vulnerabilities',
                    'Incorrect - Lack of training is a vulnerability that increases susceptibility to threats like phishing',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 6 - L3 - Apply
            [
                'topic' => 'Risk Management Fundamentals',
                'subtopic' => 'Risk owner assignment',
                'type_id' => 1,
                'question' => 'A business unit head is reluctant to accept risk ownership for a legacy system. Which of the following BEST addresses this situation?',
                'options' => [
                    'Assign the risk to IT',
                    'Escalate the issue to the compliance officer',
                    'Conduct a risk communication session to clarify roles',
                    'Transfer the risk to insurance',
                ],
                'correct_options' => ['Conduct a risk communication session to clarify roles'],
                'justifications' => [
                    'Incorrect - IT may manage the system but business units own the business risks',
                    'Incorrect - Compliance officers enforce policies but don\'t resolve ownership disputes',
                    'Correct - Clear communication about risk ownership responsibilities and the business impact helps stakeholders understand their role',
                    'Incorrect - Insurance transfers financial impact but doesn\'t address the ownership responsibility',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 7 - L4 - Analyze
            [
                'topic' => 'Risk Management Fundamentals',
                'subtopic' => 'Risk appetite, tolerance, and capacity definitions',
                'type_id' => 1,
                'question' => 'Which of the following is the MOST important factor when defining the risk appetite of an enterprise?',
                'options' => [
                    'The culture and predisposition of the organization toward risk taking',
                    'The organization\'s capacity to absorb financial loss',
                    'The level of risk remaining after existing controls',
                    'The legal jurisdiction and type of business operations',
                ],
                'correct_options' => ['The culture and predisposition of the organization toward risk taking'],
                'justifications' => [
                    'Correct - Organizational culture fundamentally drives how much risk leadership and stakeholders are willing to accept',
                    'Incorrect - Financial capacity is important but secondary to cultural willingness to take risks',
                    'Incorrect - This describes residual risk, not a factor in defining appetite',
                    'Incorrect - While compliance requirements influence decisions, culture determines the fundamental risk stance',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',

            ],

            // Item 8 - L4 - Analyze
            [
                'topic' => 'Risk Management Fundamentals',
                'subtopic' => 'Risk management lifecycle (Identify → Assess → Treat → Monitor)',
                'type_id' => 1,
                'question' => 'What is the fundamental problem with risk assessments that focus only on known threats?',
                'options' => [
                    'Known threats are not dangerous',
                    'Organizations face emerging and unknown threats that may not be identified',
                    'Known threat assessments are too expensive',
                    'Known threats change too frequently to assess',
                ],
                'correct_options' => ['Organizations face emerging and unknown threats that may not be identified'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Organizations face emerging and unknown threats that may not be identified',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',

            ],

            // Item 9 - L5 - Evaluate
            [
                'topic' => 'Risk Management Fundamentals',
                'subtopic' => 'Residual risk calculation (risk after controls)',
                'type_id' => 1,
                'question' => 'An inherent risk has a likelihood rating of 5 and an impact rating of 4 (on a scale of 1–5). A control is implemented that is expected to reduce the likelihood by 60% and the impact by 25%. Using a simple multiplicative model (Residual Risk = Likelihood × Impact), what is the approximate residual risk rating after applying the control?',
                'options' => [
                    'Likelihood: 2, Impact: 4 → Residual Risk: 8',
                    'Likelihood: 2, Impact: 3 → Residual Risk: 6',
                    'Likelihood: 3, Impact: 3 → Residual Risk: 9',
                    'Likelihood: 3, Impact: 4 → Residual Risk: 12',
                ],
                'correct_options' => ['Likelihood: 2, Impact: 3 → Residual Risk: 6'],
                'justifications' => [
                    'Incorrect - Impact reduction not calculated (should be 4 × 0.75 = 3, not 4)',
                    'Correct - Likelihood: 5 × 0.4 = 2; Impact: 4 × 0.75 = 3; Residual Risk: 2 × 3 = 6',
                    'Incorrect - Likelihood reduction not calculated correctly (5 × 0.4 = 2, not 3)',
                    'Incorrect - Neither reduction calculated correctly',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',

            ],

            // Item 10 - L5 - Evaluate
            [
                'topic' => 'Risk Management Fundamentals',
                'subtopic' => 'Risk management program establishment',
                'type_id' => 1,
                'question' => 'Evaluate the approach of using industry average breach costs for risk calculations in a specialized industry with unique data assets.',
                'options' => [
                    'Industry averages provide the most accurate estimates',
                    'May significantly underestimate or overestimate actual risk exposure',
                    'Industry averages are always conservative and safe to use',
                    'Industry averages eliminate the need for custom assessment',
                ],
                'correct_options' => ['May significantly underestimate or overestimate actual risk exposure'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - May significantly underestimate or overestimate actual risk exposure',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',

            ],

            // Topic 2: Risk Identification (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L1 - Remember
            [
                'topic' => 'Risk Identification',
                'subtopic' => 'Risk management frameworks (NIST RMF, ISO 31000, COSO ERM)',
                'type_id' => 1,
                'question' => 'An organization aims to adopt a globally recognized standard for risk management that provides a set of principles and guidelines for managing any type of risk effectively, adaptable to various contexts. Which framework is designed for this broad, non-sector-specific application?',
                'options' => [
                    'NIST SP 800-37',
                    'ISO 31000',
                    'PCI DSS',
                    'COBIT 2019',
                ],
                'correct_options' => ['ISO 31000'],
                'justifications' => [
                    'Incorrect - NIST SP 800-37 is specifically focused on information security risk management for federal systems',
                    'Correct - ISO 31000 provides universal risk management principles and guidelines applicable to any organization, sector, or risk type',
                    'Incorrect - PCI DSS is specifically for payment card industry data security, not general risk management',
                    'Incorrect - COBIT 2019 is focused on IT governance and management, not general risk management',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 12 - L2 - Understand
            [
                'topic' => 'Risk Identification',
                'subtopic' => 'Risk management frameworks (NIST RMF, ISO 31000, COSO ERM)',
                'type_id' => 1,
                'question' => 'When evaluating the primary differences between NIST RMF and ISO 31000, which of the following is the most accurate distinction?',
                'options' => [
                    'NIST RMF is purely quantitative, while ISO 31000 is qualitative.',
                    'NIST RMF is highly prescriptive for information systems, while ISO 31000 is a generic, principles-based guideline.',
                    'NIST RMF focuses only on cybersecurity, while ISO 31000 covers all types of risk.',
                    'NIST RMF is for private sector only, while ISO 31000 is for public sector only.',
                ],
                'correct_options' => ['NIST RMF is highly prescriptive for information systems, while ISO 31000 is a generic, principles-based guideline.'],
                'justifications' => [
                    'Incorrect - Both frameworks support both quantitative and qualitative approaches',
                    'Correct - NIST RMF provides detailed, prescriptive steps for federal information systems, while ISO 31000 offers flexible principles applicable to any risk type',
                    'Incorrect - NIST RMF covers broader information security risks, not just cybersecurity',
                    'Incorrect - Both frameworks are used across public and private sectors',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 13 - L2 - Understand
            [
                'topic' => 'Risk Identification',
                'subtopic' => 'Threat modeling (STRIDE)',
                'type_id' => 5,
                'question' => 'Match each STRIDE threat category with the security property it violates.',
                'options' => [
                    'items' => ['Spoofing', 'Tampering', 'Repudiation', 'Information Disclosure', 'Denial of Service', 'Elevation of Privilege'],
                    'responses' => ['Authentication', 'Integrity', 'Non-repudiation', 'Confidentiality', 'Availability', 'Authorization'],
                ],
                'correct_options' => [
                    'Spoofing' => 'Authentication',
                    'Tampering' => 'Integrity',
                    'Repudiation' => 'Non-repudiation',
                    'Information Disclosure' => 'Confidentiality',
                    'Denial of Service' => 'Availability',
                    'Elevation of Privilege' => 'Authorization',
                ],
                'justifications' => [
                    'Spoofing' => 'Spoofing attacks involve impersonating another entity, directly violating authentication mechanisms. Examples include forging email addresses, IP spoofing, or using stolen credentials.',
                    'Tampering' => 'Tampering involves modifying data in transit or at rest without authorization, compromising data integrity. This includes altering files, modifying database records, or changing network packets.',
                    'Repudiation' => 'Repudiation threats allow users to deny their actions, violating non-repudiation controls. Without proper logging and digital signatures, users can claim they didn\'t perform certain actions.',
                    'Information Disclosure' => 'Information disclosure exposes sensitive data to unauthorized parties, violating confidentiality. This includes data breaches, inadvertent exposure of error messages, or side-channel attacks.',
                    'Denial of Service' => 'DoS attacks make resources unavailable to legitimate users, violating availability. This includes flooding services, exhausting resources, or crashing systems.',
                    'Elevation of Privilege' => 'Elevation of privilege allows users to perform unauthorized actions, violating authorization controls. This includes exploiting vulnerabilities to gain admin rights or bypassing access controls.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 14 - L3 - Apply
            [
                'topic' => 'Risk Identification',
                'subtopic' => 'Threat modeling (STRIDE)',
                'type_id' => 1,
                'question' => 'The STRIDE threat modeling framework provides a systematic way to identify threats against a system. Which of the following activities is a key benefit of using a structured framework like STRIDE?',
                'options' => [
                    'It automates the implementation of security controls.',
                    'It ensures all identified threats are immediately mitigated.',
                    'It provides a comprehensive checklist to ensure a broad range of potential threats are considered.',
                    'It replaces the need for human security expertise.',
                ],
                'correct_options' => ['It provides a comprehensive checklist to ensure a broad range of potential threats are considered.'],
                'justifications' => [
                    'Incorrect - STRIDE helps identify threats but doesn\'t automate control implementation',
                    'Incorrect - STRIDE identifies threats but doesn\'t guarantee immediate mitigation',
                    'Correct - STRIDE provides a systematic approach with categories (Spoofing, Tampering, etc.) that act as a comprehensive checklist to avoid overlooking threat types',
                    'Incorrect - STRIDE enhances but doesn\'t replace human expertise and judgment',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 15 - L3 - Apply
            [
                'topic' => 'Risk Identification',
                'subtopic' => 'Risk Identification',
                'type_id' => 1,
                'question' => 'How should you adapt a standard risk assessment methodology for a small organization with limited resources?',
                'options' => [
                    'Use the full methodology without changes',
                    'Focus on high-impact areas and simplify documentation requirements',
                    'Skip risk assessment entirely due to resource constraints',
                    'Only assess risks that competitors have experienced',
                ],
                'correct_options' => ['Focus on high-impact areas and simplify documentation requirements'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Focus on high-impact areas and simplify documentation requirements',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This is too absolute or limiting',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 16 - L3 - Apply
            [
                'topic' => 'Risk Identification',
                'subtopic' => 'Risk management lifecycle (Identify → Assess → Treat → Monitor)',
                'type_id' => 1,
                'question' => 'A new software development project is in its early stages. To proactively manage security risks, the project manager initiates a threat modeling session. The findings of this session will most directly inform which subsequent step in the risk management lifecycle?',
                'options' => [
                    'Monitoring existing controls',
                    'Assessing the identified risks\' likelihood and impact',
                    'Defining the organization\'s overall risk appetite',
                    'Assigning ultimate risk capacity',
                ],
                'correct_options' => ['Assessing the identified risks\' likelihood and impact'],
                'justifications' => [
                    'Incorrect - Monitoring comes after controls are implemented, not after initial threat identification',
                    'Correct - Threat modeling identifies potential threats, which then need to be assessed for likelihood and impact to prioritize risk treatment',
                    'Incorrect - Risk appetite is typically defined at the organizational level before individual projects begin',
                    'Incorrect - Risk capacity is an organizational concept, not a project-level activity following threat modeling',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 17 - L4 - Analyze
            [
                'topic' => 'Risk Identification',
                'subtopic' => 'Risk analysis methodologies',
                'type_id' => 1,
                'question' => 'Which of the following is the PRIMARY factor in deciding whether to perform a qualitative or quantitative risk analysis?',
                'options' => [
                    'Availability of accurate data',
                    'Available budget for the analysis',
                    'Time constraints assigned to the analysis',
                    'Availability of risk analysis experts',
                ],
                'correct_options' => ['Availability of accurate data'],
                'justifications' => [
                    'Correct - Quantitative analysis relies heavily on numerical inputs such as asset value, incident frequency, and loss expectancy. Without accurate data, qualitative methods become the default',
                    'Incorrect - Budget may influence scope, but method selection depends more on data availability',
                    'Incorrect - Time constraints might influence depth, but qualitative methods can still be used when time is short only if data is unavailable',
                    'Incorrect - While expertise is needed for both types, the deciding factor is the availability of reliable, quantifiable risk data',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published',

            ],

            // Item 18 - L4 - Analyze
            [
                'topic' => 'Risk Identification',
                'subtopic' => 'Risk Identification',
                'type_id' => 1,
                'question' => 'What is the fundamental challenge in applying traditional risk methodologies to artificial intelligence and machine learning systems?',
                'options' => [
                    'AI systems are immune to traditional security risks',
                    'Traditional methods may not account for algorithmic bias and model poisoning risks',
                    'AI systems are too complex to assess',
                    'Traditional methodologies work perfectly for AI systems',
                ],
                'correct_options' => ['Traditional methods may not account for algorithmic bias and model poisoning risks'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Traditional methods may not account for algorithmic bias and model poisoning risks',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'status' => 'published',

            ],

            // Item 19 - L5 - Evaluate
            [
                'topic' => 'Risk Identification',
                'subtopic' => 'Risk Identification',
                'type_id' => 1,
                'question' => 'An organization wants to use crowdsourced threat intelligence to enhance their risk assessment methodology. Evaluate this approach.',
                'options' => [
                    'Crowdsourced intelligence is always more accurate than internal assessment',
                    'Can provide broader threat visibility but requires validation and contextualization',
                    'Crowdsourced intelligence eliminates the need for internal risk assessment',
                    'Crowdsourced intelligence is too unreliable to be useful',
                ],
                'correct_options' => ['Can provide broader threat visibility but requires validation and contextualization'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Can provide broader threat visibility but requires validation and contextualization',
                    'Incorrect - This overstates the capability or scope',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',

            ],

            // Item 20 - L5 - Evaluate
            [
                'topic' => 'Risk Identification',
                'subtopic' => 'Risk Identification',
                'type_id' => 1,
                'question' => 'Evaluate the effectiveness of conducting annual risk assessments in rapidly changing technology environments.',
                'options' => [
                    'Annual assessments provide optimal coverage',
                    'May be insufficient; continuous or more frequent assessments needed',
                    'Annual assessments are too frequent for most organizations',
                    'Assessment frequency has no impact on risk management effectiveness',
                ],
                'correct_options' => ['May be insufficient; continuous or more frequent assessments needed'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - May be insufficient; continuous or more frequent assessments needed',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',

            ],

            // Topic 3: Risk Assessment (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L1 - Remember
            [
                'topic' => 'Risk Assessment',
                'subtopic' => 'Risk response strategies (Avoid, Accept, Transfer, Mitigate)',
                'type_id' => 1,
                'question' => 'A software development team identifies a critical bug in a new feature just before release. Releasing with the bug could lead to significant financial losses and reputational damage. The team decides to delay the release and dedicate all resources to fixing the bug. Which risk response strategy is primarily being employed?',
                'options' => [
                    'Risk Transfer',
                    'Risk Acceptance',
                    'Risk Mitigation',
                    'Risk Avoidance',
                ],
                'correct_options' => ['Risk Mitigation'],
                'justifications' => [
                    'Incorrect - Risk transfer involves shifting the risk to another party via insurance or outsourcing, which is not happening here',
                    'Incorrect - Risk acceptance would mean releasing the feature despite the bug, accepting the consequences',
                    'Correct - Risk mitigation fits perfectly: the team is reducing the risk by addressing the root cause (the bug) to lessen its potential impact',
                    'Incorrect - Risk avoidance would imply canceling the feature entirely to eliminate the risk, not merely delaying release',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 22 - L3 - Apply
            [
                'topic' => 'Risk Assessment',
                'subtopic' => 'Risk owner assignment',
                'type_id' => 1,
                'question' => 'Your organization is implementing a new payroll system. How should you determine the appropriate risk owner assignment strategy?',
                'options' => [
                    'Assign the Chief Security Officer as owner for all IT risks',
                    'Assign the Application Developer who built the system',
                    'Assign the HR Department Head who owns the business process',
                    'Rotate ownership among all stakeholders quarterly',
                ],
                'correct_options' => ['Assign the HR Department Head who owns the business process'],
                'justifications' => [
                    'Security officers advise but business owners make risk decisions',
                    'Developers build systems but don\'t own business processes',
                    'Correct - Business process owners are best positioned to make risk decisions about their processes',
                    'Risk ownership should be stable and based on business accountability',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 23 - L2 - Understand
            [
                'topic' => 'Risk Assessment',
                'subtopic' => 'Inherent risk (risk before controls)',
                'type_id' => 1,
                'question' => 'An organization assesses a potential threat and chooses not to implement any controls, deciding the risk level is acceptable as-is. Which type of risk is being accepted?',
                'options' => [
                    'Inherent risk',
                    'Residual risk',
                    'Control risk',
                    'Accepted risk',
                ],
                'correct_options' => ['Inherent risk'],
                'justifications' => [
                    'Correct - Inherent risk is the risk that exists before any controls are implemented, which is what the organization is accepting',
                    'Incorrect - Residual risk is the risk remaining after controls are implemented, but no controls were applied here',
                    'Incorrect - Control risk refers to the risk that controls may fail, not applicable when no controls are implemented',
                    'Incorrect - While the risk is being accepted, "accepted risk" is not a formal risk type but rather a treatment decision',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 24 - L2 - Understand
            [
                'topic' => 'Risk Assessment',
                'subtopic' => 'Risk response strategies (Avoid, Accept, Transfer, Mitigate)',
                'type_id' => 1,
                'question' => 'Which of the following BEST demonstrates a risk avoidance strategy in an enterprise security context?',
                'options' => [
                    'Proceeding with a mobile app launch despite identified privacy weaknesses.',
                    'Purchasing liability insurance to address possible customer data breaches.',
                    'Deciding not to adopt a new AI feature due to unresolved ethical and regulatory concerns.',
                    'Adding logging and alerting to monitor unauthorized system access.',
                ],
                'correct_options' => ['Deciding not to adopt a new AI feature due to unresolved ethical and regulatory concerns.'],
                'justifications' => [
                    'Incorrect - This represents risk acceptance, not avoidance, as the organization proceeds despite known risks',
                    'Incorrect - This represents risk transfer through insurance, not avoidance',
                    'Correct - This demonstrates risk avoidance by eliminating the activity entirely due to unacceptable risks',
                    'Incorrect - This represents risk mitigation through monitoring controls, not avoidance',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 25 - L3 - Apply
            [
                'topic' => 'Risk Assessment',
                'subtopic' => 'Risk Assessment',
                'type_id' => 1,
                'question' => 'A security analyst identifies a potential data breach risk stemming from employees\' lack of security awareness training. In which of the following should this be recorded FIRST?',
                'options' => [
                    'Incident log',
                    'Risk register',
                    'Problem log',
                    'Disaster log',
                ],
                'correct_options' => ['Risk register'],
                'justifications' => [
                    'Incorrect - Incident logs record actual security events that have occurred, not potential risks',
                    'Correct - Risk register is the primary repository for documenting identified risks for tracking and management',
                    'Incorrect - Problem logs typically track technical issues requiring resolution, not security risks',
                    'Incorrect - Disaster logs document major incidents or disasters that have occurred, not potential risks',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 26 - L3 - Apply
            [
                'topic' => 'Risk Assessment',
                'subtopic' => 'Impact and likelihood determination',
                'type_id' => 1,
                'question' => 'A vulnerability scan reveals an unpatched web server with open ports. What is the MOST appropriate next step for analysis?',
                'options' => [
                    'Log the finding for future reference',
                    'Accept the risk',
                    'Determine exposure and exploitability',
                    'Report the threat to management',
                ],
                'correct_options' => ['Determine exposure and exploitability'],
                'justifications' => [
                    'Incorrect - Logging without analysis fails to assess the actual risk level',
                    'Incorrect - Accepting risk before understanding its severity is premature',
                    'Correct - Assessing exposure (who can reach it) and exploitability (how easily it can be compromised) is essential for proper risk evaluation',
                    'Incorrect - This is a vulnerability, not a threat, and reporting should come after risk analysis',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 27 - L3 - Apply
            [
                'topic' => 'Risk Assessment',
                'subtopic' => 'Risk response strategies (Avoid, Accept, Transfer, Mitigate)',
                'type_id' => 1,
                'question' => 'A company identifies a critical cyber risk related to a legacy system. Upgrading the system is extremely costly and disruptive. Maintaining the status quo is unacceptable due to potential data breaches. What would be the most strategic risk response, considering the options of Avoid, Accept, Transfer, and Mitigate, if the company decides to outsource the vulnerable function to a third-party provider who specializes in secure operations?',
                'options' => [
                    'Transfer, as the responsibility and potentially the financial impact of the risk are shifted to a third party.',
                    'Avoidance, as the function is no longer performed internally.',
                    'Acceptance, as the company acknowledges the risk but chooses not to act directly.',
                    'Mitigation, as the third party\'s expertise reduces the likelihood and impact of the breach.',
                ],
                'correct_options' => ['Transfer, as the responsibility and potentially the financial impact of the risk are shifted to a third party.'],
                'justifications' => [
                    'Correct - Transferring risk involves shifting the burden of the risk to another party through outsourcing, making them responsible for its management and consequences',
                    'Incorrect - The function is still being performed, just by a different party, so this is not avoidance',
                    'Incorrect - The company is taking action by outsourcing, not accepting the risk as-is',
                    'Incorrect - While the third party may provide better security, the primary strategy is transferring ownership and liability',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 28 - L4 - Analyze
            [
                'topic' => 'Risk Assessment',
                'subtopic' => 'Risk appetite, tolerance, and capacity definitions',
                'type_id' => 1,
                'question' => 'A risk manager proposes three options to treat a critical application vulnerability: patch immediately, monitor closely, or shift operations to a backup system. What is the MOST important factor when selecting a treatment option?',
                'options' => [
                    'The opinion of the application developer',
                    'The cost of implementing the control',
                    'The alignment of the option with risk appetite',
                    'The popularity of the method in industry benchmarks',
                ],
                'correct_options' => ['The alignment of the option with risk appetite'],
                'justifications' => [
                    'Incorrect - While technical input is valuable, it should not be the primary decision factor',
                    'Incorrect - Cost is important but secondary to whether the treatment aligns with acceptable risk levels',
                    'Correct - Risk treatment decisions must align with the organization\'s defined risk appetite to ensure consistent risk management',
                    'Incorrect - Industry practices may inform but should not drive treatment selection',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',

            ],

            // Item 29 - L4 - Analyze
            [
                'topic' => 'Risk Assessment',
                'subtopic' => 'Risk response strategies (Avoid, Accept, Transfer, Mitigate)',
                'type_id' => 1,
                'question' => 'Which type of risk is most likely to be addressed through insurance as a risk response strategy?',
                'options' => [
                    'High likelihood and high impact',
                    'Low likelihood and low impact',
                    'High likelihood and low impact',
                    'Low likelihood and high impact',
                ],
                'correct_options' => ['Low likelihood and high impact'],
                'justifications' => [
                    'Incorrect - High frequency, high impact risks are typically too expensive to insure and require mitigation',
                    'Incorrect - Low frequency, low impact risks are typically accepted or managed operationally',
                    'Incorrect - High frequency, low impact risks are better handled through operational controls',
                    'Correct - Insurance is most cost-effective for catastrophic but rare events (low probability, high impact)',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',

            ],

            // Item 30 - L5 - Evaluate
            [
                'topic' => 'Risk Assessment',
                'subtopic' => 'Cost-benefit analysis for controls',
                'type_id' => 1,
                'question' => 'A company decides to self-insure against cyber risks rather than purchase cyber liability insurance, citing "better control over resources." Evaluate this decision.',
                'options' => [
                    'Always preferable since self-insurance provides better control',
                    'Risky approach that may expose organization to catastrophic losses',
                    'Self-insurance is identical to risk acceptance',
                    'Self-insurance eliminates all cyber risks',
                ],
                'correct_options' => ['Risky approach that may expose organization to catastrophic losses'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Risky approach that may expose organization to catastrophic losses',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',

            ],

            // Topic 4: Risk Response & Treatment (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L1 - Remember
            [
                'topic' => 'Risk Response & Treatment',
                'subtopic' => 'Key Risk Indicators (KRIs) and metrics',
                'type_id' => 1,
                'question' => 'An organization tracks the number of unsuccessful login attempts per user per day and the percentage of outdated endpoint antivirus signatures. These are BEST categorized as:',
                'options' => [
                    'Key Performance Indicators (KPIs)',
                    'Operational benchmarks',
                    'Key Risk Indicators (KRIs)',
                    'Control objectives',
                ],
                'correct_options' => ['Key Risk Indicators (KRIs)'],
                'justifications' => [
                    'Incorrect - KPIs measure performance against goals, not risk exposure',
                    'Incorrect - Benchmarks are reference points for comparison, not risk metrics',
                    'Correct - KRIs are metrics that provide early warning of increasing risk exposure, which both examples demonstrate',
                    'Incorrect - Control objectives define what controls should achieve, not metrics',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 32 - L1 - Remember
            [
                'topic' => 'Risk Response & Treatment',
                'subtopic' => 'Continuous risk monitoring processes',
                'type_id' => 1,
                'question' => 'Which of the following BEST describes the purpose of continuous risk monitoring in an enterprise risk management program?',
                'options' => [
                    'To replace periodic risk assessments with real-time audits',
                    'To ensure automatic incident response is always triggered',
                    'To detect and evaluate changes in risk posture over time',
                    'To update regulatory compliance documentation quarterly',
                ],
                'correct_options' => ['To detect and evaluate changes in risk posture over time'],
                'justifications' => [
                    'Incorrect - Continuous monitoring complements rather than replaces periodic assessments',
                    'Incorrect - Monitoring detects changes but doesn\'t automatically trigger responses',
                    'Correct - The primary purpose is to identify how risks evolve and change over time to inform decision-making',
                    'Incorrect - Compliance documentation is a byproduct, not the primary purpose',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 33 - L2 - Understand
            [
                'topic' => 'Risk Response & Treatment',
                'subtopic' => 'Risk Response & Treatment',
                'type_id' => 1,
                'question' => 'Why are leading indicators more valuable than lagging indicators for risk monitoring?',
                'options' => [
                    'Leading indicators are easier to measure',
                    'Leading indicators provide early warning before problems occur',
                    'Lagging indicators are always inaccurate',
                    'Leading indicators eliminate the need for incident response',
                ],
                'correct_options' => ['Leading indicators provide early warning before problems occur'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Leading indicators provide early warning before problems occur',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 34 - L2 - Understand
            [
                'topic' => 'Risk Response & Treatment',
                'subtopic' => 'Key Risk Indicators (KRIs) and metrics',
                'type_id' => 1,
                'question' => 'An organization wants to monitor the risk of data breaches. Which of the following would be the MOST effective Key Risk Indicator (KRI) to provide an early warning of increasing cyber risk exposure?',
                'options' => [
                    'Total number of successful data breaches in the past year.',
                    'Employee satisfaction scores with IT security policies.',
                    'Number of unpatched critical vulnerabilities detected across systems.',
                    'Average time to recover from a data breach.',
                ],
                'correct_options' => ['Number of unpatched critical vulnerabilities detected across systems.'],
                'justifications' => [
                    'Incorrect - This is a lagging indicator showing past incidents, not early warning',
                    'Incorrect - While relevant to security culture, this is too indirect for cyber risk',
                    'Correct - Unpatched vulnerabilities are a leading indicator showing current exposure before breaches occur',
                    'Incorrect - This measures response capability after incidents, not predictive risk',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 35 - L3 - Apply
            [
                'topic' => 'Risk Response & Treatment',
                'subtopic' => 'Continuous risk monitoring processes',
                'type_id' => 1,
                'question' => 'A project team implements daily stand-up meetings where team members briefly discuss potential blockers or emerging issues. Which aspect of continuous risk monitoring is this practice primarily addressing?',
                'options' => [
                    'Post-mortem analysis.',
                    'Early warning signal identification.',
                    'Formal risk documentation.',
                    'Risk assessment frequency.',
                ],
                'correct_options' => ['Early warning signal identification.'],
                'justifications' => [
                    'Incorrect - Post-mortem analysis occurs after incidents, not during daily proactive discussions',
                    'Correct - Daily stand-ups facilitate prompt identification of new or changing risks and potential issues, acting as early warning signals',
                    'Incorrect - Stand-ups are informal communication mechanisms, not formal documentation processes',
                    'Incorrect - This describes timing of assessments, not the identification mechanism',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 36 - L3 - Apply
            [
                'topic' => 'Risk Response & Treatment',
                'subtopic' => 'Key Risk Indicators (KRIs) and metrics',
                'type_id' => 1,
                'question' => 'A KRI for operational risk is defined as "Number of failed software deployments per month." If the threshold for this KRI is set at 3, and in the last three months, the numbers were 2, 4, and 5 respectively, what does this trend primarily indicate?',
                'options' => [
                    'A potential increase in operational risk related to software deployment stability, requiring investigation.',
                    'The KRI is ineffective and should be replaced.',
                    'The KRI threshold is too low and needs to be increased.',
                    'The operational risk level is decreasing.',
                ],
                'correct_options' => ['A potential increase in operational risk related to software deployment stability, requiring investigation.'],
                'justifications' => [
                    'Correct - Consistently exceeding the KRI threshold indicates a negative trend in the monitored risk area, warranting immediate investigation and potential action',
                    'Incorrect - The KRI is working as designed by detecting concerning trends',
                    'Incorrect - Adjusting thresholds to avoid alerts defeats the purpose of early warning',
                    'Incorrect - The increasing numbers clearly show rising, not decreasing, risk',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 37 - L3 - Apply
            [
                'topic' => 'Risk Response & Treatment',
                'subtopic' => 'Risk appetite, tolerance, and capacity definitions',
                'type_id' => 1,
                'question' => 'Which of the following best describes the primary advantage of establishing clear risk tolerance levels within a continuous risk monitoring process?',
                'options' => [
                    'It shifts all risk accountability from the risk owner to the monitoring team.',
                    'It eliminates the need for any manual intervention in risk monitoring.',
                    'It provides objective criteria for triggering alerts and prioritizing risk response actions.',
                    'It automatically mitigates all risks that exceed the set thresholds.',
                ],
                'correct_options' => ['It provides objective criteria for triggering alerts and prioritizing risk response actions.'],
                'justifications' => [
                    'Incorrect - Risk ownership and accountability remain with designated owners regardless of monitoring',
                    'Incorrect - Manual intervention is still required for analysis and response decisions',
                    'Correct - Clear tolerance levels establish objective thresholds that guide when alerts should trigger and how to prioritize responses',
                    'Incorrect - Monitoring detects threshold breaches but doesn\'t automatically implement mitigation',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.7,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 38 - L4 - Analyze
            [
                'topic' => 'Risk Response & Treatment',
                'subtopic' => 'Key Risk Indicators (KRIs) and metrics',
                'type_id' => 1,
                'question' => 'To measure the effectiveness of a new patch management control, which KRI would be most suitable for assessing the reduction in vulnerability exposure?',
                'options' => [
                    'Number of employee training sessions on cybersecurity best practices.',
                    'Total number of security incidents reported in the past quarter.',
                    'Cost of security software licenses purchased annually.',
                    'Percentage of critical systems with overdue security patches.',
                ],
                'correct_options' => ['Percentage of critical systems with overdue security patches.'],
                'justifications' => [
                    'Incorrect - Training frequency doesn\'t directly measure patch management effectiveness',
                    'Incorrect - Incident count is a lagging indicator that may have multiple causes beyond patching',
                    'Incorrect - Software costs don\'t indicate control effectiveness',
                    'Correct - This directly measures the control\'s objective: reducing exposure by minimizing unpatched systems',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published',

            ],

            // Item 39 - L4 - Analyze
            [
                'topic' => 'Risk Response & Treatment',
                'subtopic' => 'Continuous risk monitoring processes',
                'type_id' => 1,
                'question' => 'During a review of the continuous risk monitoring process, it\'s identified that alerts are frequently triggered for minor, non-critical issues. What is the most effective action to improve the process\'s efficiency and focus?',
                'options' => [
                    'Adjusting KRI thresholds and alert logic to focus on material risks and reduce false positives.',
                    'Assign more staff to manually review every single alert.',
                    'Increase the number of monitoring tools used to capture more data.',
                    'Disable all automated alerts to reduce false positives.',
                ],
                'correct_options' => ['Adjusting KRI thresholds and alert logic to focus on material risks and reduce false positives.'],
                'justifications' => [
                    'Correct - Refining thresholds and logic ensures that alerts are only triggered for truly significant events, improving the signal-to-noise ratio and efficiency',
                    'Incorrect - Adding staff doesn\'t address the root cause of excessive non-critical alerts',
                    'Incorrect - More tools and data would worsen the problem of excessive alerts',
                    'Incorrect - Disabling alerts eliminates early warning capability entirely',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'status' => 'published',

            ],

            // Item 40 - L5 - Evaluate
            [
                'topic' => 'Risk Response & Treatment',
                'subtopic' => 'Risk Response & Treatment',
                'type_id' => 1,
                'question' => 'An organization implements AI-powered risk monitoring that provides excellent technical metrics but struggles with business context. Evaluate this approach.',
                'options' => [
                    'Technical metrics are sufficient for effective risk monitoring',
                    'Requires integration of business context to make metrics actionable for decision-making',
                    'AI-powered monitoring eliminates the need for human interpretation',
                    'Business context is irrelevant to technical risk monitoring',
                ],
                'correct_options' => ['Requires integration of business context to make metrics actionable for decision-making'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Requires integration of business context to make metrics actionable for decision-making',
                    'Incorrect - This overstates the capability or scope',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',

            ],

            // Topic 5: Risk Monitoring & Reporting (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 41 - L1 - Remember
            [
                'topic' => 'Risk Monitoring & Reporting',
                'subtopic' => 'Risk reporting to stakeholders',
                'type_id' => 1,
                'question' => 'What is the primary purpose of risk reporting?',
                'options' => [
                    'To document all security activities',
                    'To communicate risk status to support decision-making',
                    'To satisfy audit requirements only',
                    'To justify security budget increases',
                ],
                'correct_options' => ['To communicate risk status to support decision-making'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - To communicate risk status to support decision-making',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 42 - L1 - Remember
            [
                'topic' => 'Risk Monitoring & Reporting',
                'subtopic' => 'Risk reporting to stakeholders',
                'type_id' => 1,
                'question' => 'What information should be included in executive risk reports?',
                'options' => [
                    'Detailed technical vulnerability scans',
                    'Business impact summaries and key risk trends',
                    'Complete audit logs and system outputs',
                    'Raw security metrics without interpretation',
                ],
                'correct_options' => ['Business impact summaries and key risk trends'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - Business impact summaries and key risk trends',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.1,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 43 - L2 - Understand
            [
                'topic' => 'Risk Monitoring & Reporting',
                'subtopic' => 'Risk reporting to stakeholders',
                'type_id' => 1,
                'question' => 'Why should risk reports be tailored to different audience levels?',
                'options' => [
                    'Different audiences have varying information needs and decision authority',
                    'Tailoring reduces report preparation effort',
                    'Technical audiences prefer business summaries',
                    'All audiences need identical information',
                ],
                'correct_options' => ['Different audiences have varying information needs and decision authority'],
                'justifications' => [
                    'Correct - Different audiences have varying information needs and decision authority',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This option does not accurately describe the concept',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 44 - L2 - Understand
            [
                'topic' => 'Risk Monitoring & Reporting',
                'subtopic' => 'Continuous risk monitoring processes',
                'type_id' => 1,
                'question' => 'How do risk dashboards enhance traditional risk reporting?',
                'options' => [
                    'Dashboards replace the need for detailed reports',
                    'They provide real-time visibility and trend analysis',
                    'Dashboards are only useful for technical audiences',
                    'They eliminate the need for risk assessment',
                ],
                'correct_options' => ['They provide real-time visibility and trend analysis'],
                'justifications' => [
                    'Incorrect - This option does not accurately describe the concept',
                    'Correct - They provide real-time visibility and trend analysis',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This overstates the capability or scope',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 45 - L3 - Apply
            [
                'topic' => 'Risk Monitoring & Reporting',
                'subtopic' => 'Risk reporting to stakeholders',
                'type_id' => 1,
                'question' => 'When reporting significant enterprise-level risks to the Board of Directors, which characteristic is paramount for the report\'s effectiveness?',
                'options' => [
                    'Including highly detailed technical specifications of all implemented controls.',
                    'Listing every single identified risk, regardless of its significance.',
                    'Focusing solely on past incidents and their financial impact.',
                    'Providing clear, concise, and strategic insights on potential impact and proposed actions.',
                ],
                'correct_options' => ['Providing clear, concise, and strategic insights on potential impact and proposed actions.'],
                'justifications' => [
                    'Incorrect - Board members need strategic insights, not technical minutiae',
                    'Incorrect - Information overload dilutes focus from significant risks',
                    'Incorrect - Forward-looking risk perspective is more valuable than historical analysis alone',
                    'Correct - Board effectiveness requires clear strategic insights that enable informed decision-making',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 46 - L3 - Apply
            [
                'topic' => 'Risk Monitoring & Reporting',
                'subtopic' => 'Risk reporting to stakeholders',
                'type_id' => 1,
                'question' => 'What is the most effective frequency for executive risk reporting?',
                'options' => [
                    'Daily for all risk updates',
                    'Regular scheduled reports with exception-based urgent updates',
                    'Only annual comprehensive reports',
                    'Ad-hoc reporting when requested',
                ],
                'correct_options' => ['Regular scheduled reports with exception-based urgent updates'],
                'justifications' => [
                    'Incorrect - This overstates the capability or scope',
                    'Correct - Regular scheduled reports with exception-based urgent updates',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 47 - L3 - Apply
            [
                'topic' => 'Risk Monitoring & Reporting',
                'subtopic' => 'Continuous risk monitoring processes',
                'type_id' => 1,
                'question' => 'How should you incorporate risk trend analysis in reporting?',
                'options' => [
                    'Only report current risk levels without trends',
                    'Show risk changes over time with context for variations',
                    'Report trends only when risks are decreasing',
                    'Focus exclusively on historical trends',
                ],
                'correct_options' => ['Show risk changes over time with context for variations'],
                'justifications' => [
                    'Incorrect - This is too absolute or limiting',
                    'Correct - Show risk changes over time with context for variations',
                    'Incorrect - This is too absolute or limiting',
                    'Incorrect - This option does not accurately describe the concept',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',

            ],

            // Item 48 - L4 - Analyze
            [
                'topic' => 'Risk Monitoring & Reporting',
                'subtopic' => 'Risk reporting to stakeholders',
                'type_id' => 1,
                'question' => 'A risk manager submits a report indicating an Annualized Loss Expectancy (ALE) of $50,000 for a cyber risk but fails to disclose the assumptions behind asset valuation, threat frequency, and control effectiveness. What is the primary implication of this omission for stakeholders?',
                'options' => [
                    'The report provides a precise and reliable risk figure for immediate decision-making',
                    'Stakeholders can easily verify the accuracy of the ALE without further information',
                    'The quantitative figure may be misinterpreted or seen as absolute, hiding significant uncertainties and biases in the underlying model',
                    'Omitting assumptions simplifies the report and makes it more accessible to non-technical stakeholders',
                ],
                'correct_options' => ['The quantitative figure may be misinterpreted or seen as absolute, hiding significant uncertainties and biases in the underlying model'],
                'justifications' => [
                    'Incorrect - Misleading precision; ALE without context is not reliable',
                    'Incorrect - Assumptions are necessary for verification',
                    'Correct - The quantitative figure may be misinterpreted or seen as absolute, hiding significant uncertainties and biases in the underlying model',
                    'Incorrect - Accessibility should not come at the cost of clarity or transparency',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',

            ],

            // Item 49 - L4 - Analyze
            [
                'topic' => 'Risk Monitoring & Reporting',
                'subtopic' => 'Risk reporting to stakeholders',
                'type_id' => 1,
                'question' => 'An IT security team reports cyber risks to the executive committee using technical terms such as \'CVE-2023-XXXX\' and \'advanced persistent threats\' without connecting them to business impact. What is the likely consequence of this communication approach?',
                'options' => [
                    'Executives will gain a deep technical understanding of the risks, enabling informed security investments',
                    'The executive committee will likely struggle to grasp the business implications, leading to ineffective decision-making or apathy towards cybersecurity initiatives',
                    'This approach demonstrates the security team\'s technical expertise, thereby building confidence in their abilities',
                    'The report will be highly actionable for strategic planning, as it contains all technical details',
                ],
                'correct_options' => ['The executive committee will likely struggle to grasp the business implications, leading to ineffective decision-making or apathy towards cybersecurity initiatives'],
                'justifications' => [
                    'Incorrect - Assumes technical fluency and fails to acknowledge the communication gap',
                    'Correct - This clearly outlines the impact of poor translation from technical to business language',
                    'Incorrect - Technical accuracy does not equal effective executive communication. May build confusion instead',
                    'Incorrect - Actionability at the executive level comes from contextualization, not raw technical data',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',

            ],

            // Item 50 - L5 - Evaluate
            [
                'topic' => 'Risk Monitoring & Reporting',
                'subtopic' => 'Key Risk Indicators (KRIs) and metrics',
                'type_id' => 1,
                'question' => 'A critical KRI for employee cybersecurity awareness shows a "100% completion rate for mandatory annual training." However, internal audits reveal significant non-compliance with security policies and high phishing susceptibility. Evaluate the effectiveness of this KRI as a measure of actual risk reduction.',
                'options' => [
                    'The KRI accurately reflects high employee security awareness, and the audit findings are likely outliers',
                    'The KRI is flawed because it measures activity (training completion) rather than actual behavioral change, understanding, or risk reduction',
                    'The KRI is useful for compliance tracking, but its purpose is not to measure risk reduction',
                    'A 100% completion rate means there is no remaining risk from employee behavior, so the KRI is highly effective',
                ],
                'correct_options' => ['The KRI is flawed because it measures activity (training completion) rather than actual behavioral change, understanding, or risk reduction'],
                'justifications' => [
                    'Incorrect - Contradicts the audit evidence showing poor security behavior despite training completion',
                    'Correct - The KRI measures a process metric (training completion) not an outcome metric (actual security behavior), making it ineffective for risk reduction measurement',
                    'Incorrect - While partially true about compliance, it misses the core issue that the KRI is intended but failing to measure risk',
                    'Incorrect - Completion of training does not guarantee elimination of human risk factors',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',

            ],
        ];
    }
}
