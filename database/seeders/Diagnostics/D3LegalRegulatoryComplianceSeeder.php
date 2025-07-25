<?php

namespace Database\Seeders\Diagnostics;

class D3LegalRegulatoryComplianceSeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Legal, Regulatory & Compliance';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: Compliance Requirements (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 1 - L1 - Remember
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Compliance Framework',
                'type_id' => 1,
                'question' => 'What does GDPR stand for?',
                'options' => [
                    'General Data Protection Regulation',
                    'Global Data Privacy Requirements',
                    'Government Data Protection Rules',
                    'General Database Protection Requirements',
                ],
                'correct_options' => ['General Data Protection Regulation'],
                'justifications' => [
                    'Correct - GDPR stands for General Data Protection Regulation, which is the comprehensive data protection law enacted by the European Union.',
                    'This is not an actual legal framework or regulation.',
                    'While governments do have data protection rules, this is not what GDPR stands for',
                    'GDPR is about personal data protection, not database protection requirements.',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
            ],

            // Item 2 - L2 - Understand
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Requirements Hierarchy',
                'type_id' => 1,
                'question' => 'What is the primary difference between laws and regulations?',
                'options' => [
                    'Laws are voluntary while regulations are mandatory',
                    'Laws are created by legislatures while regulations are created by agencies',
                    'Laws apply globally while regulations are local only',
                    'Laws are temporary while regulations are permanent',
                ],
                'correct_options' => ['Laws are created by legislatures while regulations are created by agencies'],
                'justifications' => [
                    'Both laws and regulations are mandatory and enforceable',
                    'Correct - Laws are created by legislatures while regulations are created by agencies to implement and enforce laws',
                    'Both laws and regulations can have local, national, or international scope',
                    'Both laws and regulations can be permanent or temporary',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -1.0,
                'irt_c' => 0.25,
            ],

            // Item 3 - L2 - Understand
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Compliance Framework',
                'type_id' => 1,
                'question' => 'Why do organizations need to maintain compliance with multiple regulatory frameworks simultaneously?',
                'options' => [
                    'Different regulations cover different aspects of business operations',
                    'Regulations are always conflicting and require balance',
                    'Only large organizations need multiple compliance frameworks',
                    'Compliance requirements are recommendations, not requirements',
                ],
                'correct_options' => ['Different regulations cover different aspects of business operations'],
                'justifications' => [
                    'Correct - Organizations operate across multiple jurisdictions and industries, each with specific regulatory requirements',
                    'Regulations may overlap but are not necessarily conflicting',
                    'Organizations of all sizes must comply with applicable regulations',
                    'Compliance requirements are mandatory, not recommendations',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
            ],

            // Item 4 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Cross-Border Considerations',
                'type_id' => 1,
                'question' => 'A healthcare organization processes patient data in the EU and US. Which compliance frameworks must they consider?',
                'options' => [
                    'Only HIPAA since healthcare is involved',
                    'Only GDPR since EU data is processed',
                    'Both HIPAA and GDPR due to jurisdictional requirements',
                    'Neither applies to international healthcare organizations',
                ],
                'correct_options' => ['Both HIPAA and GDPR due to jurisdictional requirements'],
                'justifications' => [
                    'HIPAA applies to healthcare data in the US, but EU data processing requires GDPR compliance',
                    'GDPR applies to EU data, but US healthcare data requires HIPAA compliance',
                    'Correct - Both HIPAA and GDPR apply due to processing healthcare data in both jurisdictions',
                    'International healthcare organizations must comply with applicable regulations in each jurisdiction',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
            ],

            // Item 5 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Requirements Hierarchy',
                'type_id' => 1,
                'question' => 'How should an organization prioritize compliance requirements when resources are limited?',
                'options' => [
                    'Focus only on requirements with the highest penalties',
                    'Prioritize based on business impact, legal risk, and regulatory enforcement',
                    'Implement all requirements equally regardless of impact',
                    'Choose requirements based on implementation ease',
                ],
                'correct_options' => ['Prioritize based on business impact, legal risk, and regulatory enforcement'],
                'justifications' => [
                    'Focusing only on penalties ignores business impact and enforcement likelihood',
                    'Correct - Risk-based prioritization considers business impact, legal consequences, and regulatory enforcement patterns',
                    'Equal implementation ignores resource constraints and varying risk levels',
                    'Ease of implementation should not override risk considerations',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
            ],

            // Item 6 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Compliance Program Establishment',
                'type_id' => 1,
                'question' => 'What is the most effective approach for tracking regulatory changes that affect your organization?',
                'options' => [
                    'Manually review all regulations quarterly',
                    'Implement automated monitoring with expert validation',
                    'Rely on industry peers to notify about changes',
                    'Wait for regulators to contact the organization directly',
                ],
                'correct_options' => ['Implement automated monitoring with expert validation'],
                'justifications' => [
                    'Manual quarterly reviews may miss critical updates between reviews',
                    'Correct - Automated monitoring ensures timely awareness while expert validation ensures relevance',
                    'Relying on peers creates gaps and delays in awareness',
                    'Waiting for regulators is reactive and may result in non-compliance',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
            ],

            // Item 7 - L4 - Analyze
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Compliance Framework',
                'type_id' => 1,
                'question' => 'Analyze why prescriptive regulations (specific rules) might be less effective than principle-based regulations (broad goals) in rapidly evolving technology sectors.',
                'options' => [
                    'Prescriptive regulations are easier to implement and audit',
                    'Principle-based regulations allow innovation while maintaining outcomes',
                    'Technology companies prefer detailed specifications',
                    'Prescriptive regulations provide better legal certainty',
                ],
                'correct_options' => ['Principle-based regulations allow innovation while maintaining outcomes'],
                'justifications' => [
                    'While easier to audit, prescriptive rules become outdated quickly in technology sectors',
                    'Correct - Principle-based regulations focus on outcomes, allowing innovative approaches while maintaining security objectives',
                    'Technology companies often struggle with rigid prescriptive requirements',
                    'Prescriptive regulations can provide certainty but limit adaptation to new technologies',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
            ],

            // Item 8 - L4 - Analyze
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Compliance Framework',
                'type_id' => 1,
                'question' => 'What are the primary drivers for regulatory compliance requirements in an organization?',
                'options' => [
                    'Ethical and financial requirements',
                    'Geographic location and industry sector',
                    'Geographic location and market share',
                    'Customer expectations and contractual obligations',
                ],
                'correct_options' => ['Geographic location and industry sector'],
                'justifications' => [
                    'While ethical and financial considerations are important, they are not the primary drivers for regulatory compliance. Regulatory requirements are often imposed by external authorities based on specific criteria.',
                    'Correct - The primary drivers for regulatory compliance are the geographic location of the organization and the industry sector in which it operates. Different regions have different laws and regulations, and various industry sectors have specific regulatory requirements that organizations must comply with to operate legally and ethically.',
                    'Market share does not typically drive regulatory compliance. Regulatory requirements are based on geographic location and industry sector, regardless of the organization\'s market share.',
                    'While customer expectations and contractual obligations can influence an organization\'s practices, they are not the primary drivers for regulatory compliance. Compliance requirements are typically mandated by external regulatory bodies based on location and industry.',
                ],
                'bloom_level' => 4, // Analyze
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.5,
                'irt_c' => 0.20,
            ],

            // Item 9 - L1 - Remember
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Compliance Framework',
                'type_id' => 1,
                'question' => 'What is the primary consequence of lacking due care in information security?',
                'options' => [
                    'Reduced system performance',
                    'Increased risk of legal liability',
                    'Reduced user satisfaction',
                    'Enhanced need for security audits',
                ],
                'correct_options' => ['Increased risk of legal liability'],
                'justifications' => [
                    'Performance reduction is not the primary legal consequence',
                    'Correct - Lack of due care creates legal liability and potential penalties',
                    'User satisfaction is secondary to legal consequences',
                    'Audit needs are reactive, not the primary consequence',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
            ],

            // Item 10 - L5 - Evaluate
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Cross-Border Considerations',
                'type_id' => 1,
                'question' => 'A multinational corporation faces conflicting privacy requirements between EU GDPR and US state laws. What is the most strategic approach to resolve this?',
                'options' => [
                    'Implement the strictest requirements globally',
                    'Maintain separate systems for each jurisdiction',
                    'Choose the approach with lowest implementation cost',
                    'Wait for regulatory harmonization before deciding',
                ],
                'correct_options' => ['Implement the strictest requirements globally'],
                'justifications' => [
                    'Correct - Implementing the strictest requirements globally ensures compliance across all jurisdictions and simplifies operations',
                    'Separate systems increase complexity, cost, and risk of errors',
                    'Lowest cost approach may result in non-compliance and penalties',
                    'Waiting for harmonization is impractical and leaves the organization at risk',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
            ],

            // Topic 2: Contracts (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L1 - Remember
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Service Level Agreements',
                'type_id' => 1,
                'question' => 'What is a Service Level Agreement (SLA)?',
                'options' => [
                    'A contract defining performance standards and remedies',
                    'A software license agreement',
                    'A data processing agreement',
                    'A network service configuration',
                ],
                'correct_options' => ['A contract defining performance standards and remedies'],
                'justifications' => [
                    'Correct - An SLA is a contract that defines specific performance standards, metrics, and remedies for service failures',
                    'Software licenses govern usage rights, not service performance',
                    'Data processing agreements govern data handling, not service levels',
                    'Network configurations are technical specifications, not contractual agreements',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
            ],

            // Item 12 - L2 - Understand
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Liability & Indemnification',
                'type_id' => 1,
                'question' => 'Why are indemnification clauses important in security service contracts?',
                'options' => [
                    'They define service performance metrics',
                    'They allocate responsibility for losses from security failures',
                    'They specify payment terms and conditions',
                    'They outline technical implementation requirements',
                ],
                'correct_options' => ['They allocate responsibility for losses from security failures'],
                'justifications' => [
                    'Performance metrics are defined in SLAs, not indemnification clauses',
                    'Correct - Indemnification clauses allocate financial responsibility and liability for security breaches and failures',
                    'Payment terms are separate contractual provisions',
                    'Technical requirements are specified in statements of work or technical specifications',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
            ],

            // Item 13 - L2 - Understand
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Data Processing Agreements',
                'type_id' => 1,
                'question' => 'What is the difference between a Data Processing Agreement (DPA) and a Data Sharing Agreement (DSA)?',
                'options' => [
                    'DPAs are for EU organizations, DSAs are for US organizations',
                    'DPAs govern processing on behalf of another, DSAs govern joint use',
                    'DPAs are temporary, DSAs are permanent arrangements',
                    'DPAs are for personal data, DSAs are for business data',
                ],
                'correct_options' => ['DPAs govern processing on behalf of another, DSAs govern joint use'],
                'justifications' => [
                    'Both agreement types are used globally, not limited by geography',
                    'Correct - DPAs are for processors acting on behalf of controllers, while DSAs are for independent parties sharing data',
                    'Both can be temporary or permanent based on business needs',
                    'Both can cover personal and business data depending on the context',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
            ],

            // Item 14 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Vendor Security Requirements',
                'type_id' => 1,
                'question' => 'Your organization is outsourcing email hosting to a cloud provider. What contractual security requirements should you prioritize?',
                'options' => [
                    'Only encryption requirements for data transmission',
                    'Comprehensive security controls, incident response, and audit rights',
                    'Basic availability guarantees and support response times',
                    'Cost minimization with standard vendor terms',
                ],
                'correct_options' => ['Comprehensive security controls, incident response, and audit rights'],
                'justifications' => [
                    'Encryption alone is insufficient for email hosting security',
                    'Correct - Email hosting requires comprehensive security controls, incident response procedures, and audit rights to ensure data protection',
                    'Availability alone ignores critical security requirements',
                    'Cost minimization should not compromise security requirements',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 15 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Termination & Data Return',
                'type_id' => 1,
                'question' => 'How should you structure termination clauses in a contract with a critical security service provider?',
                'options' => [
                    'Immediate termination with no notice period',
                    'Standard 30-day notice with transition assistance',
                    'Risk-based approach with data return and security continuity',
                    'Extended notice period to minimize vendor costs',
                ],
                'correct_options' => ['Risk-based approach with data return and security continuity'],
                'justifications' => [
                    'Immediate termination risks business disruption without proper transition',
                    'Standard notice may be insufficient for critical security services',
                    'Correct - Risk-based approach ensures secure transition, data return, and continuity of security controls',
                    'Extended notice should not prioritize vendor costs over security needs',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
            ],

            // Item 16 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Source Code Escrow',
                'type_id' => 1,
                'question' => 'When negotiating a software license agreement, what security-related terms are most critical to include?',
                'options' => [
                    'Source code escrow and security update guarantees',
                    'Only standard warranty and support terms',
                    'Pricing and payment schedule requirements',
                    'User training and documentation requirements',
                ],
                'correct_options' => ['Source code escrow and security update guarantees'],
                'justifications' => [
                    'Correct - Source code escrow ensures business continuity and security update guarantees maintain protection',
                    'Standard terms often lack specific security provisions',
                    'Financial terms do not address security requirements',
                    'Training and documentation do not address ongoing security needs',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
            ],

            // Item 17 - L4 - Analyze
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Liability & Indemnification',
                'type_id' => 1,
                'question' => 'Analyze why mutual indemnification clauses in security contracts can create perverse incentives. What is the core problem?',
                'options' => [
                    'They increase contract negotiation time unnecessarily',
                    'They can reduce incentives for proper security investment',
                    'They favor large vendors over small security companies',
                    'They complicate insurance coverage and claims',
                ],
                'correct_options' => ['They can reduce incentives for proper security investment'],
                'justifications' => [
                    'Negotiation time is not the core problem with mutual indemnification',
                    'Correct - When both parties indemnify each other equally, neither has strong incentive to invest in security improvements',
                    'Company size is not the fundamental issue',
                    'Insurance complications are a symptom, not the core problem',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
            ],

            // Item 18 - L4 - Analyze
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Audit Clauses',
                'type_id' => 1,
                'question' => 'What is the fundamental tension between "right to audit" clauses and vendor intellectual property protection?',
                'options' => [
                    'Audits are too expensive for vendors to support',
                    'Customers need security visibility while vendors need IP protection',
                    'Audit requirements violate vendor employee privacy',
                    'International audits face jurisdictional complications',
                ],
                'correct_options' => ['Customers need security visibility while vendors need IP protection'],
                'justifications' => [
                    'Cost is not the fundamental tension',
                    'Correct - Customers require audit rights to verify security while vendors must protect proprietary methods and intellectual property',
                    'Employee privacy is typically not the primary concern in security audits',
                    'Jurisdictional issues can be addressed through contract terms',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
            ],

            // Item 19 - L5 - Evaluate
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Audit Clauses',
                'type_id' => 1,
                'question' => 'Evaluate this scenario: A vendor offers the lowest price but refuses security audit rights and limits liability to contract value. What should guide your decision?',
                'options' => [
                    'Accept the proposal since cost savings offset security risks',
                    'Reject based on inadequate risk transfer and visibility',
                    'Negotiate only liability terms while accepting audit limitations',
                    'Accept if the vendor has industry security certifications',
                ],
                'correct_options' => ['Reject based on inadequate risk transfer and visibility'],
                'justifications' => [
                    'Cost savings rarely offset the risks of no audit rights and limited liability',
                    'Correct - Without audit rights and with limited liability, the organization cannot verify security or recover losses',
                    'Both audit rights and liability terms are critical for risk management',
                    'Certifications alone without audit rights provide insufficient assurance',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 1.9,
                'irt_b' => 1.2,
                'irt_c' => 0.15,
            ],

            // Item 20 - L5 - Evaluate
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Liability & Indemnification',
                'type_id' => 1,
                'question' => 'A cloud provider contract includes a force majeure clause covering "cyber attacks." How does this fundamentally change your risk assessment?',
                'options' => [
                    'It has no impact on security risk calculations',
                    'It shifts cyber attack liability back to you, requiring additional controls',
                    'It provides better protection against cyber incidents',
                    'It only affects insurance coverage requirements',
                ],
                'correct_options' => ['It shifts cyber attack liability back to you, requiring additional controls'],
                'justifications' => [
                    'Force majeure clauses significantly impact risk allocation',
                    'Correct - Including cyber attacks in force majeure shifts liability from provider to customer, requiring additional security controls and insurance',
                    'Force majeure relieves the provider of liability, not provides protection',
                    'The impact extends beyond insurance to overall risk management',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 2.0,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
            ],

            // Topic 3: Industry Specific Regulations (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L1 - Remember
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Financial Regulations',
                'type_id' => 1,
                'question' => 'What does PCI DSS stand for?',
                'options' => [
                    'Payment Card Industry Data Security Standard',
                    'Personal Credit Information Data Security System',
                    'Private Card Industry Data Security Standard',
                    'Payment Credit Information Data Safety Standard',
                ],
                'correct_options' => ['Payment Card Industry Data Security Standard'],
                'justifications' => [
                    'Correct - PCI DSS stands for Payment Card Industry Data Security Standard',
                    'This is not the correct acronym for PCI DSS',
                    'This is not the correct acronym for PCI DSS',
                    'This is not the correct acronym for PCI DSS',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
            ],

            // Item 22 - L1 - Remember
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Healthcare Regulations',
                'type_id' => 1,
                'question' => 'What does HIPAA primarily regulate?',
                'options' => [
                    'Healthcare information privacy and security',
                    'Financial transaction processing',
                    'Educational record management',
                    'Government data classification',
                ],
                'correct_options' => ['Healthcare information privacy and security'],
                'justifications' => [
                    'Correct - HIPAA (Health Insurance Portability and Accountability Act) primarily regulates healthcare information privacy and security',
                    'Financial transactions are regulated by laws like PCI DSS and SOX',
                    'Educational records are governed by FERPA',
                    'Government data classification is covered by various regulations like FISMA',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.8,
                'irt_b' => -1.6,
                'irt_c' => 0.25,
            ],

            // Item 23 - L2 - Understand
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Financial Regulations',
                'type_id' => 1,
                'question' => 'Why do financial institutions face more stringent regulatory requirements than other industries?',
                'options' => [
                    'Financial institutions process more valuable data',
                    'They are critical infrastructure with systemic risk implications',
                    'Government owns shares in financial institutions',
                    'Financial regulations are easier to enforce',
                ],
                'correct_options' => ['They are critical infrastructure with systemic risk implications'],
                'justifications' => [
                    'Data value alone does not determine regulatory stringency',
                    'Correct - Financial institutions are critical infrastructure whose failures can have systemic economic impacts',
                    'Government ownership is not the basis for regulatory requirements',
                    'Enforcement difficulty does not determine regulatory stringency',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
            ],

            // Item 24 - L2 - Understand
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Industry-Specific Obligations',
                'type_id' => 1,
                'question' => 'How do industry-specific regulations typically differ from general privacy laws like GDPR?',
                'options' => [
                    'Industry regulations are voluntary while privacy laws are mandatory',
                    'Industry regulations provide sector-specific controls and requirements',
                    'Privacy laws only apply to European organizations',
                    'Industry regulations have lower penalty structures',
                ],
                'correct_options' => ['Industry regulations provide sector-specific controls and requirements'],
                'justifications' => [
                    'Both industry regulations and privacy laws are typically mandatory',
                    'Correct - Industry regulations address sector-specific risks and requirements beyond general privacy protections',
                    'Privacy laws like GDPR have global reach through extraterritorial provisions',
                    'Penalty structures vary by regulation, not by category',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
            ],

            // Item 25 - L5 - Evaluate
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Healthcare Regulations',
                'type_id' => 1,
                'question' => 'Evaluate the regulatory compliance strategy for a telemedicine company expanding globally while processing patient data and payments.',
                'options' => [
                    'Apply only US regulations since the company is US-based',
                    'Implement a layered compliance approach addressing healthcare, payment, and privacy regulations',
                    'Focus only on the strictest single regulation to minimize complexity',
                    'Wait for international regulatory harmonization before expanding',
                ],
                'correct_options' => ['Implement a layered compliance approach addressing healthcare, payment, and privacy regulations'],
                'justifications' => [
                    'US-only approach ignores international requirements and risks non-compliance',
                    'Correct - Global telemedicine requires comprehensive compliance addressing HIPAA, PCI DSS, GDPR, and local healthcare regulations',
                    'Single regulation focus leaves gaps in compliance coverage',
                    'Regulatory harmonization is unlikely; companies must comply with current requirements',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 2.0,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
            ],

            // Item 26 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Financial Regulations',
                'type_id' => 1,
                'question' => 'How should a fintech startup approach regulatory compliance when expanding internationally?',
                'options' => [
                    'Wait until established in each market before addressing compliance',
                    'Apply home country regulations globally for consistency',
                    'Design systems to meet the most stringent requirements expected',
                    'Obtain legal opinions for each jurisdiction individually',
                ],
                'correct_options' => ['Design systems to meet the most stringent requirements expected'],
                'justifications' => [
                    'Waiting until established risks non-compliance penalties and retrofitting costs',
                    'Home country regulations may not meet all international requirements',
                    'Correct - Designing for the most stringent requirements ensures compliance across jurisdictions and avoids costly redesigns',
                    'Individual legal opinions are necessary but insufficient without system design',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
            ],

            // Item 27 - L5 - Evaluate
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Healthcare Regulations',
                'type_id' => 1,
                'question' => 'Assess the long-term viability of maintaining HIPAA compliance through on-premises infrastructure versus cloud adoption.',
                'options' => [
                    'On-premises is always more secure and compliant',
                    'Cloud adoption is incompatible with HIPAA requirements',
                    'Hybrid approach balancing control, cost, and compliance is most viable',
                    'Full cloud migration eliminates all compliance concerns',
                ],
                'correct_options' => ['Hybrid approach balancing control, cost, and compliance is most viable'],
                'justifications' => [
                    'On-premises has security advantages but higher costs and limited scalability',
                    'Cloud can be HIPAA compliant with proper BAAs and controls',
                    'Correct - Hybrid approaches leverage cloud benefits while maintaining control over sensitive data and processes',
                    'Cloud migration requires careful compliance planning and ongoing management',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 1.9,
                'irt_b' => 1.2,
                'irt_c' => 0.15,
            ],

            // Item 28 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Industry-Specific Obligations',
                'type_id' => 1,
                'question' => 'How should a financial services company handle personal data that is subject to both GDPR and local banking regulations?',
                'options' => [
                    'Follow only the local banking regulations',
                    'Choose the regulation with the lowest compliance cost',
                    'Implement controls that satisfy both regulatory frameworks',
                    'Seek exemption from one of the regulations',
                ],
                'correct_options' => ['Implement controls that satisfy both regulatory frameworks'],
                'justifications' => [
                    'Ignoring GDPR when it applies creates compliance gaps and penalties',
                    'Cost should not determine regulatory compliance strategy',
                    'Correct - Organizations must comply with all applicable regulations by implementing comprehensive controls',
                    'Regulatory exemptions are rare and typically not available for overlapping requirements',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
            ],

            // Item 29 - L4 - Analyze
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Industry-Specific Obligations',
                'type_id' => 1,
                'question' => 'What creates the fundamental tension between innovation and regulatory compliance in emerging technologies?',
                'options' => [
                    'Regulations are always written by non-technical people',
                    'Regulations lag behind technology while requiring specific controls',
                    'Innovation requires breaking existing security models',
                    'Technology companies prefer self-regulation approaches',
                ],
                'correct_options' => ['Regulations lag behind technology while requiring specific controls'],
                'justifications' => [
                    'Technical expertise exists among regulators but is not the core issue',
                    'Correct - Regulations are developed slowly while technology evolves rapidly, creating gaps between requirements and capabilities',
                    'Innovation can work within security models',
                    'Self-regulation preference is a result, not a cause of the tension',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
            ],

            // Item 30 - L5 - Evaluate
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Healthcare Regulations',
                'type_id' => 1,
                'question' => 'A healthcare AI company argues that HIPAA doesn\'t apply because they only process "de-identified" data. Evaluate this position.',
                'options' => [
                    'Correct - de-identified data is exempt from HIPAA',
                    'Incorrect - AI systems can re-identify data, creating HIPAA obligations',
                    'Partially correct - depends on the specific AI algorithms used',
                    'Irrelevant - HIPAA applies to all healthcare technology companies',
                ],
                'correct_options' => ['Incorrect - AI systems can re-identify data, creating HIPAA obligations'],
                'justifications' => [
                    'De-identified data may still be subject to HIPAA if re-identification is possible',
                    'Correct - AI\'s ability to re-identify supposedly de-identified data creates HIPAA obligations and compliance requirements',
                    'The specific algorithms don\'t change the re-identification risk',
                    'HIPAA applies based on the nature of data and business, not all healthcare tech',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'status' => 'published',
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
            ],

            // Topic 4: Intellectual Property (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L1 - Remember
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Trade Secrets',
                'type_id' => 1,
                'question' => 'What is a trade secret?',
                'options' => [
                    'Information that provides competitive advantage and is kept confidential',
                    'A type of patent that expires after 5 years',
                    'Public information that is trademarked',
                    'Copyright-protected business documents',
                ],
                'correct_options' => ['Information that provides competitive advantage and is kept confidential'],
                'justifications' => [
                    'Correct - Trade secrets are confidential information that provides competitive advantage and is actively protected',
                    'Trade secrets have no expiration if properly maintained',
                    'Trade secrets must be kept confidential, not made public',
                    'Trade secrets are protected by confidentiality, not copyright',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'status' => 'published',
                'irt_a' => 0.9,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
            ],

            // Item 32 - L1 - Remember
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Trade Secrets',
                'type_id' => 1,
                'question' => 'For how long can an organization claim ownership of a trade secret?',
                'options' => [
                    'As long as the trade secret remains confidential',
                    '20 years, renewable indefinitely',
                    '20 years, with no option for renewal',
                    'Forever after one-time registration',
                ],
                'correct_options' => ['As long as the trade secret remains confidential'],
                'justifications' => [
                    'Correct - Trade secrets are protected for as long as they remain confidential and provide a competitive advantage. There is no time limit on this protection, but it requires the organization to take reasonable steps to maintain the secrecy of the information.',
                    'This is incorrect as it pertains to patents. Trade secrets do not have a fixed term and are not renewable.',
                    'This is incorrect as it pertains to patents. Trade secrets are not limited to a 20-year period and do not follow this model.',
                    'Trade secrets do not require registration and are not protected through registration. Their protection depends on maintaining their confidentiality.',
                ],
                'bloom_level' => 1, // Remember
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.0,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
            ],

            // Item 33 - L2 - Understand
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Trademarks',
                'type_id' => 1,
                'question' => 'For how long can an organization claim ownership of a trademark?',
                'options' => [
                    'As long as the trademark remains in use',
                    '20 years, renewable indefinitely',
                    '20 years, with no option for renewal',
                    'Forever after one-time registration',
                ],
                'correct_options' => ['As long as the trademark remains in use'],
                'justifications' => [
                    'Correct - Trademarks can be maintained indefinitely as long as they are actively used in commerce and the necessary renewal fees and documentation are submitted within required intervals.',
                    'This statement is incorrect as it pertains to patents, not trademarks. Patents typically last for 20 years and can be subject to specific renewal processes, but trademarks are not governed by this rule.',
                    'This is incorrect. Trademarks are not limited to a 20-year period and can be renewed indefinitely as long as they are in use.',
                    'This statement is incorrect. While trademarks can last indefinitely, they require regular renewal and must continue to be used in commerce to retain protection.',
                ],
                'bloom_level' => 2, // Understand
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.1,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
            ],

            // Item 34 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Trade Secrets',
                'type_id' => 1,
                'question' => 'Which of the following is NOT an appropriate control to protect trade secrets?',
                'options' => [
                    'Non-disclosure agreements (NDAs)',
                    'Registration',
                    'Need to know',
                    'Encryption',
                ],
                'correct_options' => ['Registration'],
                'justifications' => [
                    'NDAs are commonly used to protect trade secrets by legally binding individuals to confidentiality regarding proprietary information.',
                    'Trade secrets are not protected through registration. Registration is typically used for intellectual property protection like patents or trademarks. Trade secrets rely on confidentiality and do not require formal registration.',
                    'Implementing a need-to-know policy is an effective way to protect trade secrets by ensuring that only authorized individuals have access to sensitive information.',
                    'Encryption is an appropriate control to protect trade secrets by securing the data and making it unreadable to unauthorized users.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
            ],

            // Item 35 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Trademarks',
                'type_id' => 1,
                'question' => 'Mike Rowe, a Canadian teenager, started a small web design business and registered the domain name MikeRoweSoft.com. The name was a pun on his own name, making it sound similar to Microsoft. In response, Microsoft sent a cease-and-desist letter to Mike Rowe, demanding that he give up the domain name. Microsoft is concerned about a potential violation of which type of intellectual property right?',
                'options' => [
                    'Patent infringement',
                    'Copyright infringement',
                    'Trademark infringement',
                    'Trade secret violation',
                ],
                'correct_options' => ['Trademark infringement'],
                'justifications' => [
                    'Patents protect inventions and technological processes, not names or branding. The dispute was over the domain name "MikeRoweSoft.com," which Microsoft argued resembled their trademarked name "Microsoft".',
                    'Copyright protects original works of authorship like books, music, or software code. The issue here was not about copyrighted content but the use of a name resembling Microsoft\'s trademark.',
                    'Correct - Microsoft claimed that the domain name "MikeRoweSoft.com" infringed on their trademark because of its phonetic similarity to "Microsoft." Trademarks protect brand names and logos to prevent consumer confusion, which was Microsoft\'s concern in this case.',
                    'Trade secrets involve confidential business information and are unrelated to domain names or branding. Hence, this option is incorrect.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
            ],

            // Item 36 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Trade Secrets',
                'type_id' => 1,
                'question' => 'How should you protect proprietary security algorithms developed by your organization?',
                'options' => [
                    'Always publish to demonstrate technical capability',
                    'Use trade secret protection with strong access controls',
                    'Apply for patents in all jurisdictions immediately',
                    'Release under permissive open source licenses',
                ],
                'correct_options' => ['Use trade secret protection with strong access controls'],
                'justifications' => [
                    'Publishing proprietary algorithms eliminates competitive advantage',
                    'Correct - Trade secret protection maintains competitive advantage while strong access controls prevent unauthorized disclosure',
                    'Patents require public disclosure and are expensive to obtain globally',
                    'Open source release forfeits proprietary advantage',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
            ],

            // Item 37 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Copyrights',
                'type_id' => 1,
                'question' => 'What is the most effective approach for managing intellectual property risks when outsourcing software development?',
                'options' => [
                    'Avoid outsourcing any development involving IP',
                    'Use comprehensive IP assignment and confidentiality agreements',
                    'Only outsource to vendors in your home country',
                    'Require vendors to obtain insurance for IP violations',
                ],
                'correct_options' => ['Use comprehensive IP assignment and confidentiality agreements'],
                'justifications' => [
                    'Avoiding outsourcing entirely is often impractical for business needs',
                    'Correct - Comprehensive agreements ensure IP ownership transfers and confidentiality is maintained',
                    'Geographical location doesn\'t eliminate IP risks',
                    'Insurance helps but doesn\'t prevent IP disputes',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.7,
                'irt_c' => 0.25,
            ],

            // Item 38 - L4 - Analyze
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Copyrights',
                'type_id' => 1,
                'question' => 'Jennifer has written a book on environmental sustainability. Her lawyer informed her that copyright is granted automatically upon creation. However, her lawyer advises her to register the copyright for additional legal benefits. Copyright protection is designed to safeguard which of the following?',
                'options' => [
                    'The expression of the ideas in the book',
                    'The physical copy of the book',
                    'The digital copy of the book',
                    'The accuracy of the book content',
                ],
                'correct_options' => ['The expression of the ideas in the book'],
                'justifications' => [
                    'Correct - Copyright protection is designed to safeguard the specific expression of ideas. This includes the way the ideas are articulated and presented in the book, protecting Jennifer\'s original written content from unauthorized copying or use.',
                    'While the physical book can be protected as a physical asset, copyright itself protects the content rather than the physical manifestation. The physical copy can be protected through other means, such as physical security or insurance.',
                    'Similar to the physical copy, copyright protection extends to the content of the digital copy, not the digital file itself. The digital file can be protected through digital rights management (DRM) and other technical measures.',
                    'Copyright does not protect the accuracy or truthfulness of the content. It only protects the original expression of the content.',
                ],
                'bloom_level' => 4, // Analyze - understanding the concept and application
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.5,
                'irt_c' => 0.20,
            ],

            // Item 39 - L4 - Analyze
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Patents',
                'question' => 'Match the following types of intellectual property (IP) with their definitions:',
                'type_id' => 5, // Matching question
                'options' => [
                    'items' => ['Patent', 'Trademark', 'Copyright', 'Trade Secret'],
                    'responses' => [
                        'Protection for confidential business information that provides a competitive edge.',
                        'Protection for original works of authorship like books, music, and software.',
                        'Protection for inventions, granting exclusive rights to the inventor.',
                        'Protection for symbols, names, and slogans used to identify goods or services.',
                    ],
                ],
                'correct_options' => [
                    'Protection for inventions, granting exclusive rights to the inventor.',
                    'Protection for symbols, names, and slogans used to identify goods or services.',
                    'Protection for original works of authorship like books, music, and software.',
                    'Protection for confidential business information that provides a competitive edge.',
                ],
                'justifications' => [
                    'Patent: Legal protection for inventions, granting exclusive rights to the inventor to make, use, and sell the invention for a certain period.',
                    'Trademark: Protection for symbols, names, and slogans used in commerce to identify and distinguish goods or services.',
                    'Copyright: Exclusive rights granted to creators of original works of authorship, such as literary, musical, and artistic works, to reproduce, distribute, perform, and display the work.',
                    'Trade Secret: Legal protection for a company\'s confidential business information, which provides a competitive edge, such as formulas, practices, processes, designs, instruments, or patterns.',
                ],
                'bloom_level' => 4, // Analyze - requires understanding relationships
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.5,
                'irt_c' => 0.20,
            ],

            // Item 40 - L5 - Evaluate
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Copyrights',
                'question' => 'Which of the following intellectual property protections can be considered as perpetual? Drag and drop the correct answers from left to right.',
                'type_id' => 5, // Matching question
                'options' => [
                    'Patent',
                    'Trademark',
                    'Copyright',
                    'Trade secret',
                ],
                'correct_options' => ['Trademark', 'Trade secret'],
                'justifications' => [
                    'Patent: Legal protection for inventions that expires after 20 years. NOT perpetual - patents have a fixed term to encourage innovation and eventual public access.',
                    'Trademark: Can be renewed indefinitely every 10 years as long as the mark is used in commerce. PERPETUAL - trademarks can last forever with proper maintenance and renewal.',
                    'Copyright: Exclusive rights that expire (typically life of author plus 50-70 years). NOT perpetual - copyrights eventually expire to allow works to enter the public domain.',
                    'Trade Secret: Protection lasts as long as the information remains confidential. PERPETUAL - trade secrets like the Coca-Cola formula can be protected indefinitely if secrecy is maintained.',
                ],
                'bloom_level' => 5, // Evaluate
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
            ],

            // Topic 5: Investigation Types (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 41 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Evidence Standards',
                'type_id' => 1,
                'question' => 'Which of the following tools would be MOST appropriate for reconstructing deleted partitions and recovering file system metadata in a forensic investigation?',
                'options' => [
                    'Autopsy',
                    'FTK Imager',
                    'Sleuth Kit',
                    'Volatility',
                ],
                'correct_options' => ['Sleuth Kit'],
                'justifications' => [
                    'Autopsy is a GUI-based forensic platform that uses Sleuth Kit as its backend, but is more focused on case management and analysis rather than low-level file system reconstruction.',
                    'FTK Imager is primarily used for creating forensic images and basic data preview, not for advanced file system reconstruction or partition recovery.',
                    'Sleuth Kit is specifically designed for file system forensics and includes tools like mmls for partition analysis and fsstat for file system metadata examination, making it the most appropriate for reconstructing deleted partitions and recovering file system metadata.',
                    'Volatility is a memory forensics framework designed for analyzing RAM dumps, not for file system or partition recovery.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
            ],

            // Item 42 - L2 - Understand
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Evidence Standards',
                'type_id' => 1,
                'question' => 'Which of the following forensic principles is MOST critical to preserve the admissibility of digital evidence in court?',
                'options' => [
                    'Documenting all tools used in the investigation',
                    'Following ISO/IEC 27037 for evidence handling',
                    'Maintaining an unbroken chain of custody',
                    'Conducting the investigation in a certified lab',
                ],
                'correct_options' => ['Maintaining an unbroken chain of custody'],
                'justifications' => [
                    'While documenting tools is important for transparency and reproducibility, it is not the most critical factor for admissibility.',
                    'ISO/IEC 27037 provides good practices but following it is not the most critical requirement for court admissibility.',
                    'Maintaining an unbroken chain of custody is the most critical principle as it demonstrates the evidence has not been tampered with or altered from collection through presentation in court. Without this, evidence may be deemed inadmissible.',
                    'While certified labs may enhance credibility, investigations can be legally admissible without being conducted in certified facilities if proper procedures are followed.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
            ],

            // Item 43 - L2 - Understand
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Administrative Investigations',
                'type_id' => 1,
                'question' => 'An employee at ABC Corporation has been reported for violating the company\'s internal policies. The management needs to conduct an investigation to examine these violations and determine the appropriate course of action. Which type of investigation is specifically designed to examine violations of an organization\'s policies?',
                'options' => [
                    'Criminal Investigation',
                    'Civil Investigation',
                    'Regulatory Investigation',
                    'Administrative Investigation',
                ],
                'correct_options' => ['Administrative Investigation'],
                'justifications' => [
                    'A criminal investigation involves probing into potential violations of criminal law. This is not suitable for internal policy violations unless the actions are illegal.',
                    'A civil investigation typically pertains to disputes between individuals or organizations regarding legal rights and obligations, often involving lawsuits. This is not directly related to internal policy violations.',
                    'A regulatory investigation is conducted to ensure compliance with laws and regulations imposed by government bodies. Internal policy violations do not generally fall under this category unless they also violate regulatory requirements.',
                    'An administrative investigation is specifically designed to examine violations of an organization\'s internal policies and procedures. It involves reviewing the conduct of employees and determining if there has been a breach of company policies, making it the most appropriate type for this situation.',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'status' => 'published',
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
            ],

            // Item 44 - L2 - Understand
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Regulatory Investigations',
                'type_id' => 1,
                'question' => 'How do regulatory investigations differ from internal security investigations?',
                'options' => [
                    'Regulatory investigations focus on compliance violations vs security incidents',
                    'Internal investigations are always confidential',
                    'Regulatory investigations only examine financial data',
                    'There are no significant differences between investigation types',
                ],
                'correct_options' => ['Regulatory investigations focus on compliance violations vs security incidents'],
                'justifications' => [
                    'Correct - Regulatory investigations examine compliance with specific regulations while internal investigations focus on security incidents',
                    'Internal investigations may become public through various means',
                    'Regulatory investigations examine all relevant data, not just financial',
                    'Significant differences exist in scope, authority, and consequences',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
            ],

            // Item 45 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Criminal Investigations',
                'type_id' => 1,
                'question' => 'Your organization discovers potential insider trading based on security system access logs. What type of investigation is most appropriate?',
                'options' => [
                    'Internal HR investigation only',
                    'Forensic investigation with legal counsel involvement',
                    'Routine security audit procedures',
                    'External consultant review',
                ],
                'correct_options' => ['Forensic investigation with legal counsel involvement'],
                'justifications' => [
                    'HR investigation alone is insufficient for potential criminal activity',
                    'Correct - Insider trading requires forensic investigation to preserve evidence and legal counsel for regulatory reporting',
                    'Routine audits lack the rigor needed for potential criminal investigations',
                    'External consultants may be involved but legal counsel is essential',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
            ],

            // Item 46 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Regulatory Investigations',
                'type_id' => 1,
                'question' => 'An investigation into violations of PCI DSS (Payment Card Industry Data Security Standard) is MOST likely to be performed as:',
                'options' => [
                    'Regulatory Investigation',
                    'Criminal Investigation',
                    'Civil Investigation',
                    'Industry-standard Investigation',
                ],
                'correct_options' => ['Industry-standard Investigation'],
                'justifications' => [
                    'Although PCI DSS is not a law, investigations into its violations are often treated similarly to regulatory investigations because they are based on contractual obligations. These investigations can lead to fines or sanctions if non-compliance is found.',
                    'PCI DSS violations are typically not handled as criminal investigations unless there is evidence of illegal activities such as fraud or theft involved.',
                    'Civil investigations usually involve disputes between parties over rights and obligations, which is not the primary focus of PCI DSS compliance checks.',
                    'PCI DSS is an industry standard that mandates compliance through contractual obligations. Investigations are conducted by independent third parties to ensure adherence to these standards, similar to how regulatory investigations are performed.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.5,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
            ],

            // Item 47 - L3 - Apply
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Regulatory Investigations',
                'type_id' => 1,
                'question' => 'A company has been accused of failing to obtain proper consent for data collection and processing from its customers. What type of investigation is MOST appropriate for this situation, who will initiate it, and what is the potential punishment?',
                'options' => [
                    'Criminal Investigation, initiated by law enforcement agencies, with potential imprisonment',
                    'Civil Investigation, initiated by affected individuals or groups, with potential financial compensation',
                    'Regulatory Investigation, initiated by regulatory agencies, with potential fines and sanctions',
                    'Administrative Investigation, initiated by the company\'s leadership, with potential internal disciplinary actions',
                ],
                'correct_options' => ['Regulatory Investigation, initiated by regulatory agencies, with potential fines and sanctions'],
                'justifications' => [
                    'While data protection violations can sometimes lead to criminal charges, the primary response to failing to obtain proper consent for data collection is usually handled through regulatory or civil channels rather than criminal prosecution.',
                    'Affected individuals or groups may initiate civil lawsuits for compensation if their data privacy rights have been violated. However, this type of investigation focuses more on seeking damages rather than enforcing regulatory compliance.',
                    'Regulatory agencies, such as the Data Protection Authorities (DPAs) under the General Data Protection Regulation (GDPR) in Europe, are responsible for ensuring compliance with data protection laws. They initiate regulatory investigations and can impose fines and sanctions for non-compliance, making this the most appropriate response for failing to obtain proper consent for data collection.',
                    'An internal administrative investigation might address company policy violations, but it does not address the legal and regulatory implications of data privacy breaches.',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'status' => 'published',
                'irt_a' => 1.6,
                'irt_b' => 0.8,
                'irt_c' => 0.25,
            ],

            // Item 48 - L4 - Analyze
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Criminal Investigations',
                'type_id' => 1,
                'question' => 'Insider trading occurs when individuals buy or sell stocks based on non-public, material information. What type of investigation is MOST appropriate, who will initiate it, and what is the potential punishment?',
                'options' => [
                    'Criminal Investigation, initiated by law enforcement agencies, with potential imprisonment and fines',
                    'Civil Investigation, initiated by affected investors, with potential financial compensation',
                    'Regulatory Investigation, initiated by regulatory bodies, with potential fines and sanctions',
                    'Administrative Investigation, initiated by the company\'s internal compliance team, with potential employment termination',
                ],
                'correct_options' => ['Criminal Investigation, initiated by law enforcement agencies, with potential imprisonment and fines'],
                'justifications' => [
                    'Insider trading is a serious offense that violates securities laws. It often results in criminal investigations led by law enforcement agencies, such as the FBI in the United States. The potential punishments for those found guilty include imprisonment and significant fines.',
                    'Affected investors may file civil lawsuits seeking compensation for damages resulting from insider trading. However, this is usually secondary to the criminal and regulatory actions taken by the authorities.',
                    'Regulatory bodies such as the Securities and Exchange Commission (SEC) in the United States typically initiate investigations into insider trading. They can impose fines and sanctions on individuals and entities involved in insider trading. However, regulatory investigations are often conducted in parallel with criminal investigations.',
                    'While a company\'s internal compliance team may conduct an administrative investigation to determine if insider trading occurred within the organization, the potential punishments are limited to employment termination and do not address the legal ramifications.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
            ],

            // Item 49 - L4 - Analyze
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Evidence Standards',
                'type_id' => 1,
                'question' => 'Which of the following is the GREATEST risk when performing live acquisition of a system\'s memory and processes?',
                'options' => [
                    'Damaging physical evidence',
                    'Modifying file timestamps',
                    'Introducing malware to the system',
                    'Altering system state during acquisition',
                ],
                'correct_options' => ['Altering system state during acquisition'],
                'justifications' => [
                    'Live acquisition is performed on running systems and does not involve physical evidence handling, so physical damage is not a concern.',
                    'While file timestamps may be modified during live acquisition, this is a lesser concern compared to the overall system state changes.',
                    'Introducing malware is a risk that can be mitigated with proper tools and procedures, but is not the greatest inherent risk of live acquisition.',
                    'Altering system state during acquisition is the greatest risk because any interaction with a live system changes its state. This includes loading acquisition tools into memory, which overwrites RAM contents, and the act of reading memory which can trigger system behaviors. This alteration can destroy volatile evidence and make it difficult to prove the integrity of collected evidence.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.8,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
            ],

            // Item 50 - L4 - Analyze
            [
                'topic' => 'Legal, Regulatory, and Compliance',
                'subtopic' => 'Criminal Investigations',
                'question' => 'Match the following types of investigations with their associated punishments:',
                'type_id' => 5, // Matching question
                'options' => [
                    'items' => ['Criminal Investigation', 'Civil Investigation', 'Regulatory Investigation', 'Administrative Investigation'],
                    'responses' => [
                        'Prison sentence',
                        'Financial restitution',
                        'Financial penalty',
                        'Disciplinary action',
                    ],
                ],
                'correct_options' => [
                    'Criminal Investigation' => 'Prison sentence',
                    'Civil Investigation' => 'Financial restitution',
                    'Regulatory Investigation' => 'Financial penalty',
                    'Administrative Investigation' => 'Disciplinary action',
                ],
                'justifications' => [
                    'Criminal Investigation' => 'Criminal investigations can lead to criminal charges and convictions, which may result in prison sentences for individuals found guilty of criminal offenses.',
                    'Civil Investigation' => 'Civil investigations typically result in financial restitution to injured parties, compensating them for damages or losses suffered due to the actions of another party.',
                    'Regulatory Investigation' => 'Regulatory investigations often impose financial penalties or fines for non-compliance with laws, regulations, or industry standards.',
                    'Administrative Investigation' => 'Administrative investigations usually result in internal disciplinary actions such as warnings, suspensions, demotions, or termination for violations of organizational policies.',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'status' => 'published',
                'irt_a' => 1.7,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
            ],
        ];
    }
}
