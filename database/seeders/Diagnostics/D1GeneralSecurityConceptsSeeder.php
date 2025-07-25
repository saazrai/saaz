<?php

namespace Database\Seeders\Diagnostics;

class D1GeneralSecurityConceptsSeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'General Security Concepts';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: 5 Pillars of Information Security - 10 Questions
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 1 - 5 Pillars - L1 Knowledge
            [
                'topic' => '5 Pillars of Information Security',
                'subtopic' => 'Confidentiality',
                'question' => 'Which pillar of information security protects data from unauthorized access?',
                'type_id' => 1,
                'options' => [
                    'Integrity',
                    'Availability',
                    'Confidentiality',
                    'Non-repudiation',
                ],
                'correct_options' => ['Confidentiality'],
                'justifications' => [
                    'Integrity ensures data has not been modified',
                    'Availability ensures data is accessible when needed',
                    'Correct - Confidentiality prevents unauthorized access to sensitive information',
                    'Non-repudiation prevents denial of actions or transactions',
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'irt_a' => 1.2,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 2 - 5 Pillars - L1 Knowledge
            [
                'topic' => '5 Pillars of Information Security',
                'subtopic' => 'Integrity',
                'question' => 'What does data integrity ensure in information security?',
                'type_id' => 1,
                'options' => [
                    'Data is available when needed',
                    'Data has not been altered or corrupted',
                    'Data is kept confidential',
                    'Data access is logged',
                ],
                'correct_options' => ['Data has not been altered or corrupted'],
                'justifications' => [
                    'This describes availability',
                    'Correct - Integrity ensures data remains unaltered and trustworthy',
                    'This describes confidentiality',
                    'This describes auditing/accountability',
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'irt_a' => 1.0,
                'irt_b' => -1.8,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 3 - 5 Pillars - L2 Comprehension
            [
                'topic' => '5 Pillars of Information Security',
                'subtopic' => 'Availability',
                'question' => 'How does the availability pillar differ from the other security pillars?',
                'type_id' => 1,
                'options' => [
                    'It focuses on preventing unauthorized access',
                    'It ensures data can be accessed when needed by authorized users',
                    'It verifies the identity of users',
                    'It prevents data modification',
                ],
                'correct_options' => ['It ensures data can be accessed when needed by authorized users'],
                'justifications' => [
                    'This describes confidentiality, not availability',
                    'Correct - Availability ensures authorized users can access resources when needed',
                    'This describes authentication/authenticity',
                    'This describes integrity',
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 4 - 5 Pillars - L2 Comprehension
            [
                'topic' => '5 Pillars of Information Security',
                'subtopic' => 'Non-repudiation',
                'question' => 'Why is non-repudiation important in digital transactions?',
                'type_id' => 1,
                'options' => [
                    'It prevents unauthorized access to systems',
                    'It ensures data integrity during transmission',
                    'It prevents parties from denying they performed an action',
                    'It encrypts sensitive information',
                ],
                'correct_options' => ['It prevents parties from denying they performed an action'],
                'justifications' => [
                    'This describes access control/confidentiality',
                    'This describes integrity controls',
                    'Correct - Non-repudiation provides proof of origin and delivery',
                    'This describes confidentiality controls',
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 5 - 5 Pillars - L3 Application
            [
                'topic' => '5 Pillars of Information Security',
                'subtopic' => 'Authenticity',
                'question' => 'A company needs to verify that documents received from partners are genuine. Which security pillar addresses this requirement?',
                'type_id' => 1,
                'options' => [
                    'Confidentiality',
                    'Integrity',
                    'Authenticity',
                    'Availability',
                ],
                'correct_options' => ['Authenticity'],
                'justifications' => [
                    'Confidentiality protects against unauthorized access',
                    'Integrity ensures data has not been modified',
                    'Correct - Authenticity verifies the genuineness and source of information',
                    'Availability ensures resources are accessible when needed',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 6 - 5 Pillars - L3 Application
            [
                'topic' => '5 Pillars of Information Security',
                'subtopic' => 'Confidentiality',
                'question' => 'Which control would best protect confidentiality in a database containing customer credit card information?',
                'type_id' => 1,
                'options' => [
                    'Regular database backups',
                    'Database activity logging',
                    'Field-level encryption of sensitive data',
                    'Database performance monitoring',
                ],
                'correct_options' => ['Field-level encryption of sensitive data'],
                'justifications' => [
                    'Backups support availability, not confidentiality',
                    'Logging supports accountability, not direct confidentiality protection',
                    'Correct - Encryption directly protects confidentiality by making data unreadable to unauthorized users',
                    'Performance monitoring supports availability',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 7 - 5 Pillars - L3 Application
            [
                'topic' => '5 Pillars of Information Security',
                'subtopic' => 'Integrity',
                'question' => 'An organization discovers that financial records have been altered without authorization. Which combination of controls would best prevent future integrity violations?',
                'type_id' => 1,
                'options' => [
                    'Access controls and encryption',
                    'Digital signatures and checksums',
                    'Firewalls and antivirus software',
                    'Backup systems and monitoring',
                ],
                'correct_options' => ['Digital signatures and checksums'],
                'justifications' => [
                    'These primarily protect confidentiality and access',
                    'Correct - Digital signatures and checksums directly detect and prevent unauthorized modifications',
                    'These provide general security but not specific integrity protection',
                    'These support availability and detection but not prevention of modifications',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 8 - 5 Pillars - L4 Analysis
            [
                'topic' => '5 Pillars of Information Security',
                'subtopic' => 'Availability',
                'question' => 'Analyze why availability often conflicts with confidentiality and integrity in security design.',
                'type_id' => 1,
                'options' => [
                    'Availability is not related to other security pillars',
                    'Security controls that protect confidentiality and integrity can restrict or slow access',
                    'Availability always takes priority over other pillars',
                    'Confidentiality and integrity controls never affect system performance',
                ],
                'correct_options' => ['Security controls that protect confidentiality and integrity can restrict or slow access'],
                'justifications' => [
                    'All security pillars are interconnected and must be balanced',
                    'Correct - Encryption, access controls, and integrity checks can impact system availability',
                    'Security requires balancing all pillars based on risk and business needs',
                    'Many security controls have performance and accessibility impacts',
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 9 - 5 Pillars - L4 Analysis
            [
                'topic' => '5 Pillars of Information Security',
                'subtopic' => 'Non-repudiation',
                'question' => 'What is the primary challenge in implementing effective non-repudiation controls?',
                'type_id' => 1,
                'options' => [
                    'Technical complexity of encryption algorithms',
                    'Balancing security with usability while ensuring legal admissibility',
                    'High cost of digital certificate infrastructure',
                    'Lack of standardized protocols',
                ],
                'correct_options' => ['Balancing security with usability while ensuring legal admissibility'],
                'justifications' => [
                    'Technical complexity exists but is not the primary challenge',
                    'Correct - Non-repudiation must be legally binding while remaining practical for users',
                    'Cost is a factor but not the primary challenge',
                    'Standards exist for non-repudiation implementations',
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 10 - 5 Pillars - L5 Evaluation
            [
                'topic' => '5 Pillars of Information Security',
                'subtopic' => 'Authenticity',
                'question' => 'Evaluate the relative importance of the five security pillars in a cloud-based e-commerce environment.',
                'type_id' => 1,
                'options' => [
                    'All pillars are equally important in all contexts',
                    'Confidentiality is always the most critical pillar',
                    'The relative importance depends on business context, regulatory requirements, and risk tolerance',
                    'Availability is the only pillar that matters for e-commerce',
                ],
                'correct_options' => ['The relative importance depends on business context, regulatory requirements, and risk tolerance'],
                'justifications' => [
                    'Business context and risk profiles create different priority needs',
                    'While important, confidentiality may not always be the top priority',
                    'Correct - Security pillar priorities must align with business needs and regulatory requirements',
                    'E-commerce requires balancing all pillars, not just availability',
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.2,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 2: Professional Ethics - 10 Questions
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - Professional Ethics - L1 Knowledge
            [
                'topic' => 'Professional Ethics',
                'subtopic' => 'Organizational Code of Ethics',
                'question' => 'What is the primary purpose of a professional code of ethics in cybersecurity?',
                'type_id' => 1,
                'options' => [
                    'To increase salary levels for certified professionals',
                    'To establish standards of conduct and responsibility for practitioners',
                    'To eliminate liability for security breaches',
                    'To replace legal requirements with professional guidelines',
                ],
                'correct_options' => ['To establish standards of conduct and responsibility for practitioners'],
                'justifications' => [
                    'Ethics codes focus on professional conduct, not compensation',
                    'Correct - Professional ethics establish behavioral expectations and responsibilities',
                    'Ethics codes do not eliminate legal or professional liability',
                    'Ethics complement but do not replace legal requirements',
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'irt_a' => 1.0,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 12 - Professional Ethics - L2 Comprehension
            [
                'topic' => 'Professional Ethics',
                'subtopic' => 'Professional Standards and Conduct',
                'question' => 'Why must cybersecurity professionals maintain objectivity in their work?',
                'type_id' => 1,
                'options' => [
                    'To ensure accurate risk assessments and unbiased security recommendations',
                    'To comply with software licensing requirements',
                    'To maintain certification status only',
                    'To avoid technical training requirements',
                ],
                'correct_options' => ['To ensure accurate risk assessments and unbiased security recommendations'],
                'justifications' => [
                    'Correct - Objectivity ensures professional judgments are based on facts, not personal interests',
                    'Licensing compliance is separate from professional objectivity',
                    'While important for certification, objectivity serves broader professional purposes',
                    'Training requirements are unrelated to professional objectivity',
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'irt_a' => 1.2,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 13 - Professional Ethics - L2 Comprehension
            [
                'topic' => 'Professional Ethics',
                'subtopic' => 'Organizational Code of Ethics',
                'question' => 'How do professional ethics relate to legal compliance in cybersecurity?',
                'type_id' => 1,
                'options' => [
                    'Ethics replace the need for legal compliance',
                    'Legal requirements are sufficient without ethical considerations',
                    'Ethics provide higher standards of conduct beyond minimum legal requirements',
                    'Ethics and legal requirements are completely unrelated',
                ],
                'correct_options' => ['Ethics provide higher standards of conduct beyond minimum legal requirements'],
                'justifications' => [
                    'Ethics complement but do not replace legal obligations',
                    'Legal compliance is minimum standard; ethics provide additional guidance',
                    'Correct - Professional ethics often establish higher standards than legal minimums',
                    'Ethics and legal requirements often overlap and reinforce each other',
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 14 - Professional Ethics - L3 Application
            [
                'topic' => 'Professional Ethics',
                'subtopic' => 'Professional Standards and Conduct',
                'question' => 'A security consultant discovers that their client\'s competitor is using the same consulting firm. What is the most ethical approach?',
                'type_id' => 1,
                'options' => [
                    'Share insights between clients to provide better service',
                    'Maintain strict confidentiality and avoid conflicts of interest',
                    'Only work with one client at a time',
                    'Charge higher fees to both clients',
                ],
                'correct_options' => ['Maintain strict confidentiality and avoid conflicts of interest'],
                'justifications' => [
                    'Sharing confidential information violates professional ethics',
                    'Correct - Professional ethics require maintaining client confidentiality and managing conflicts',
                    'While one option, proper conflict management can allow serving multiple clients ethically',
                    'Fee structure is unrelated to ethical conflict resolution',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 15 - Professional Ethics - L3 Application
            [
                'topic' => 'Professional Ethics',
                'subtopic' => 'Organizational Code of Ethics',
                'question' => 'How should a cybersecurity professional handle a situation where management pressures them to approve an inadequate security control?',
                'type_id' => 1,
                'options' => [
                    'Comply with management to maintain employment',
                    'Document concerns and escalate through appropriate channels while maintaining professional standards',
                    'Ignore the issue and let others decide',
                    'Publicly criticize management decisions',
                ],
                'correct_options' => ['Document concerns and escalate through appropriate channels while maintaining professional standards'],
                'justifications' => [
                    'Professional ethics require maintaining security standards despite pressure',
                    'Correct - Ethical professionals must document concerns and use proper escalation procedures',
                    'Professional responsibility requires active engagement with security issues',
                    'Public criticism violates confidentiality and professional conduct standards',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 16 - Professional Ethics - L3 Application
            [
                'topic' => 'Professional Ethics',
                'subtopic' => 'Professional Standards and Conduct',
                'question' => 'When conducting a penetration test, what ethical obligations must be considered?',
                'type_id' => 1,
                'options' => [
                    'Only technical effectiveness of the testing methodology',
                    'Proper authorization, scope limitations, and responsible disclosure of findings',
                    'Maximizing billable time and demonstrating advanced skills',
                    'Showing weaknesses in competitive products',
                ],
                'correct_options' => ['Proper authorization, scope limitations, and responsible disclosure of findings'],
                'justifications' => [
                    'Technical effectiveness alone ignores critical ethical considerations',
                    'Correct - Ethical penetration testing requires proper authorization and responsible handling of vulnerabilities',
                    'Billing considerations should not override ethical testing practices',
                    'Competitive concerns are unrelated to ethical testing obligations',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 17 - Professional Ethics - L4 Analysis
            [
                'topic' => 'Professional Ethics',
                'subtopic' => 'Organizational Code of Ethics',
                'question' => 'Analyze the potential conflicts between organizational loyalty and professional ethical obligations.',
                'type_id' => 1,
                'options' => [
                    'Organizational loyalty always takes precedence over professional ethics',
                    'Professional ethics may require actions that conflict with organizational pressure',
                    'There are never conflicts between organizational and professional obligations',
                    'Ethical obligations are purely personal and don\'t affect professional work',
                ],
                'correct_options' => ['Professional ethics may require actions that conflict with organizational pressure'],
                'justifications' => [
                    'Professional ethics establish standards beyond organizational preferences',
                    'Correct - Ethical professionals may need to resist organizational pressure to maintain standards',
                    'Conflicts frequently arise between business pressures and professional standards',
                    'Professional ethics directly govern workplace conduct and decisions',
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.7,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 18 - Professional Ethics - L4 Analysis
            [
                'topic' => 'Professional Ethics',
                'subtopic' => 'Professional Standards and Conduct',
                'question' => 'What are the primary challenges in enforcing professional ethics in the cybersecurity field?',
                'type_id' => 1,
                'options' => [
                    'Lack of technical standards for security implementations',
                    'Rapid technological change, global scope, and varying legal frameworks',
                    'Insufficient salary levels for security professionals',
                    'Limited availability of security training programs',
                ],
                'correct_options' => ['Rapid technological change, global scope, and varying legal frameworks'],
                'justifications' => [
                    'Technical standards exist but enforcement challenges are broader than technical issues',
                    'Correct - Ethics enforcement faces challenges from technology evolution and global complexity',
                    'Compensation levels are not directly related to ethics enforcement',
                    'Training availability does not address enforcement challenges',
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 19 - Professional Ethics - L5 Evaluation
            [
                'topic' => 'Professional Ethics',
                'subtopic' => 'Organizational Code of Ethics',
                'question' => 'Evaluate the effectiveness of professional certification requirements in promoting ethical conduct.',
                'type_id' => 1,
                'options' => [
                    'Certification requirements guarantee ethical behavior',
                    'Certifications are ineffective at promoting ethics',
                    'Certifications provide foundation but require ongoing reinforcement and accountability',
                    'Only technical skills matter; ethics cannot be taught or measured',
                ],
                'correct_options' => ['Certifications provide foundation but require ongoing reinforcement and accountability'],
                'justifications' => [
                    'Certification alone cannot guarantee ethical behavior in all situations',
                    'While imperfect, certifications do establish baseline ethical expectations',
                    'Correct - Certifications establish foundations but need ongoing support and enforcement',
                    'Ethics can be taught, measured, and are essential for professional practice',
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.1,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Item 20 - Professional Ethics - L5 Evaluation
            [
                'topic' => 'Professional Ethics',
                'subtopic' => 'Professional Standards and Conduct',
                'question' => 'Assess the role of professional ethics in addressing emerging cybersecurity challenges like AI and IoT security.',
                'type_id' => 1,
                'options' => [
                    'Traditional ethics are sufficient for new technologies',
                    'New technologies require completely different ethical frameworks',
                    'Ethical principles must evolve while maintaining core professional values',
                    'Ethics are irrelevant to technological security challenges',
                ],
                'correct_options' => ['Ethical principles must evolve while maintaining core professional values'],
                'justifications' => [
                    'New technologies create novel ethical challenges requiring updated approaches',
                    'While new considerations are needed, fundamental ethical principles remain relevant',
                    'Correct - Ethics must adapt to new challenges while preserving core professional values',
                    'Ethics are central to responsible development and deployment of new technologies',
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 3: Security Controls - 10 Questions
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 21 - Security Controls - L1 Knowledge
            [
                'topic' => 'Security Controls',
                'subtopic' => 'Control Categories',
                'question' => 'What are the three main categories of security controls?',
                'type_id' => 1,
                'options' => [
                    'Physical, Technical, Administrative',
                    'Preventive, Detective, Corrective',
                    'Hardware, Software, Human',
                    'Internal, External, Hybrid',
                ],
                'correct_options' => ['Physical, Technical, Administrative'],
                'justifications' => [
                    'Correct - The three main categories are Physical, Technical (logical), and Administrative (management)',
                    'These are control functions, not categories',
                    'These are implementation types, not the standard control categories',
                    'These are not standard security control classifications',
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'irt_a' => 1.1,
                'irt_b' => -1.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 22 - Security Controls - L2 Comprehension
            [
                'topic' => 'Security Controls',
                'subtopic' => 'Control Functions',
                'question' => 'How do preventive controls differ from detective controls?',
                'type_id' => 1,
                'options' => [
                    'Preventive controls are more expensive than detective controls',
                    'Preventive controls stop incidents before they occur; detective controls identify incidents after they happen',
                    'Detective controls are always automated; preventive controls are manual',
                    'There is no functional difference between these control types',
                ],
                'correct_options' => ['Preventive controls stop incidents before they occur; detective controls identify incidents after they happen'],
                'justifications' => [
                    'Cost differences vary by implementation, not control type',
                    'Correct - Preventive controls proactively prevent; detective controls identify after occurrence',
                    'Both control types can be automated or manual',
                    'These control types have distinct and important functional differences',
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'irt_a' => 1.2,
                'irt_b' => -0.9,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 23 - Security Controls - L2 Comprehension
            [
                'topic' => 'Security Controls',
                'subtopic' => 'Control Categories',
                'question' => 'Why is a layered approach to security controls more effective than relying on a single control type?',
                'type_id' => 1,
                'options' => [
                    'It reduces the total cost of security implementation',
                    'Different controls address different threats and failure modes, providing defense in depth',
                    'It eliminates the need for security policies',
                    'Layered controls are easier to manage than single controls',
                ],
                'correct_options' => ['Different controls address different threats and failure modes, providing defense in depth'],
                'justifications' => [
                    'Layered approaches typically increase costs but improve effectiveness',
                    'Correct - Multiple control layers provide redundancy and address diverse threat vectors',
                    'Policies remain necessary regardless of control architecture',
                    'Multiple layers typically increase management complexity',
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 24 - Security Controls - L3 Application
            [
                'topic' => 'Security Controls',
                'subtopic' => 'Control Functions',
                'question' => 'A company wants to prevent unauthorized access to their data center. Which combination of controls would be most effective?',
                'type_id' => 1,
                'options' => [
                    'Only administrative controls like policies and procedures',
                    'Only technical controls like electronic locks and cameras',
                    'A combination of physical barriers, access controls, and monitoring systems',
                    'Only detective controls to identify intruders after entry',
                ],
                'correct_options' => ['A combination of physical barriers, access controls, and monitoring systems'],
                'justifications' => [
                    'Administrative controls alone cannot physically prevent unauthorized entry',
                    'Technical controls alone may have vulnerabilities or failure points',
                    'Correct - Effective data center security requires multiple control types working together',
                    'Detective controls alone allow intrusions to occur before detection',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 25 - Security Controls - L3 Application
            [
                'topic' => 'Security Controls',
                'subtopic' => 'Control Categories',
                'question' => 'How should an organization implement corrective controls for a malware incident?',
                'type_id' => 1,
                'options' => [
                    'Focus only on removing the malware from infected systems',
                    'Implement system restoration, improve preventive controls, and update incident procedures',
                    'Only update antivirus signatures for future prevention',
                    'Replace all affected systems with new hardware',
                ],
                'correct_options' => ['Implement system restoration, improve preventive controls, and update incident procedures'],
                'justifications' => [
                    'Malware removal alone does not address systemic improvements',
                    'Correct - Corrective controls should restore operations and prevent recurrence',
                    'Signature updates alone are insufficient corrective measures',
                    'Hardware replacement is typically unnecessary and excessively costly',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 26 - Security Controls - L3 Application
            [
                'topic' => 'Security Controls',
                'subtopic' => 'Control Functions',
                'question' => 'What type of security control is a security awareness training program?',
                'type_id' => 1,
                'options' => [
                    'Physical preventive control',
                    'Technical detective control',
                    'Administrative preventive control',
                    'Administrative corrective control',
                ],
                'correct_options' => ['Administrative preventive control'],
                'justifications' => [
                    'Training programs are not physical controls',
                    'Training is administrative, not technical, and preventive rather than detective',
                    'Correct - Security awareness training is an administrative control that prevents incidents',
                    'While administrative, training is primarily preventive, not corrective',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 27 - Security Controls - L4 Analysis
            [
                'topic' => 'Security Controls',
                'subtopic' => 'Control Categories',
                'question' => 'Analyze why technical controls alone are insufficient for comprehensive security.',
                'type_id' => 1,
                'options' => [
                    'Technical controls are always unreliable',
                    'Human factors, policy enforcement, and physical security cannot be addressed by technical controls alone',
                    'Technical controls are too expensive to implement comprehensively',
                    'Administrative controls are always more effective than technical controls',
                ],
                'correct_options' => ['Human factors, policy enforcement, and physical security cannot be addressed by technical controls alone'],
                'justifications' => [
                    'Technical controls can be reliable but have scope limitations',
                    'Correct - Technical controls cannot address all security domains and require support from other control types',
                    'Cost varies but is not the primary limitation of technical controls',
                    'Control effectiveness varies by situation; no single type is universally superior',
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.6,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 28 - Security Controls - L4 Analysis
            [
                'topic' => 'Security Controls',
                'subtopic' => 'Control Functions',
                'question' => 'What is the primary limitation of relying heavily on detective controls?',
                'type_id' => 1,
                'options' => [
                    'Detective controls are more expensive than preventive controls',
                    'They identify incidents after damage has occurred, requiring recovery and remediation',
                    'Detective controls cannot be automated effectively',
                    'They require more technical expertise to implement',
                ],
                'correct_options' => ['They identify incidents after damage has occurred, requiring recovery and remediation'],
                'justifications' => [
                    'Costs vary by implementation; expense is not the primary limitation',
                    'Correct - Detective controls inherently allow incidents to occur before detection',
                    'Many detective controls can be effectively automated',
                    'Implementation complexity varies but is not the primary limitation',
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 0.7,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 29 - Security Controls - L5 Evaluation
            [
                'topic' => 'Security Controls',
                'subtopic' => 'Control Categories',
                'question' => 'Evaluate the optimal balance between preventive, detective, and corrective controls for a financial services organization.',
                'type_id' => 1,
                'options' => [
                    'Focus entirely on preventive controls to avoid all incidents',
                    'Emphasize detective controls for rapid incident response',
                    'Balance all three types based on risk assessment, regulatory requirements, and business context',
                    'Corrective controls are sufficient if implemented properly',
                ],
                'correct_options' => ['Balance all three types based on risk assessment, regulatory requirements, and business context'],
                'justifications' => [
                    'No preventive control is 100% effective; other controls are necessary',
                    'Detective controls alone allow incidents to occur and cause damage',
                    'Correct - Optimal security requires balancing control types based on organizational needs',
                    'Corrective controls alone cannot prevent incidents or provide early detection',
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.0,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Item 30 - Security Controls - L5 Evaluation
            [
                'topic' => 'Security Controls',
                'subtopic' => 'Control Functions',
                'question' => 'Assess the long-term sustainability of a security control program that prioritizes immediate cost savings over comprehensive protection.',
                'type_id' => 1,
                'options' => [
                    'Cost-focused approaches always provide the best security value',
                    'Immediate cost savings typically lead to higher long-term costs due to incidents and remediation',
                    'Security effectiveness is unrelated to investment levels',
                    'Comprehensive protection is always cost-prohibitive',
                ],
                'correct_options' => ['Immediate cost savings typically lead to higher long-term costs due to incidents and remediation'],
                'justifications' => [
                    'Cost-focused approaches may create security gaps leading to incidents',
                    'Correct - Inadequate security investment often results in higher total costs over time',
                    'While not linear, there is generally a relationship between investment and security effectiveness',
                    'Comprehensive protection can be achieved through risk-based, cost-effective approaches',
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.2,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 4: Security Principles - 10 Questions
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 31 - Security Principles - L1 Knowledge
            [
                'topic' => 'Security Principles',
                'subtopic' => 'Access Control Principles',
                'question' => 'What does the principle of least privilege require?',
                'type_id' => 1,
                'options' => [
                    'Users should have maximum access to perform their jobs efficiently',
                    'Users should have the minimum access necessary to perform their job functions',
                    'All users should have identical access levels',
                    'Access should be granted based on seniority in the organization',
                ],
                'correct_options' => ['Users should have the minimum access necessary to perform their job functions'],
                'justifications' => [
                    'Maximum access violates the principle of least privilege',
                    'Correct - Least privilege grants only the minimum necessary access for job performance',
                    'Identical access ignores different job requirements and violates least privilege',
                    'Seniority is not a valid criterion for access control under least privilege',
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'irt_a' => 1.0,
                'irt_b' => -1.7,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 32 - Security Principles - L2 Comprehension
            [
                'topic' => 'Security Principles',
                'subtopic' => 'Design Principles',
                'question' => 'Why is the principle of "fail secure" important in security system design?',
                'type_id' => 1,
                'options' => [
                    'It ensures systems never experience failures',
                    'When systems fail, they default to a secure state rather than an open state',
                    'It makes systems more user-friendly during failures',
                    'It reduces the cost of system maintenance',
                ],
                'correct_options' => ['When systems fail, they default to a secure state rather than an open state'],
                'justifications' => [
                    'Fail secure does not prevent failures; it manages failure behavior',
                    'Correct - Fail secure ensures system failures do not compromise security',
                    'Fail secure may actually reduce usability during failures to maintain security',
                    'Maintenance costs are not the primary concern of fail secure design',
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'irt_a' => 1.2,
                'irt_b' => -0.7,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 33 - Security Principles - L2 Comprehension
            [
                'topic' => 'Security Principles',
                'subtopic' => 'Access Control Principles',
                'question' => 'How does separation of duties enhance security?',
                'type_id' => 1,
                'options' => [
                    'It reduces the number of people needed to complete tasks',
                    'It prevents any single individual from completing critical processes alone',
                    'It eliminates the need for access controls',
                    'It simplifies audit procedures',
                ],
                'correct_options' => ['It prevents any single individual from completing critical processes alone'],
                'justifications' => [
                    'Separation of duties typically requires more people, not fewer',
                    'Correct - Separation of duties requires multiple people for critical tasks, preventing single-person fraud or errors',
                    'Access controls are still necessary with separation of duties',
                    'While it may aid auditing, the primary purpose is preventing single-person control',
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 34 - Security Principles - L3 Application
            [
                'topic' => 'Security Principles',
                'subtopic' => 'Design Principles',
                'question' => 'How should the principle of defense in depth be applied to web application security?',
                'type_id' => 1,
                'options' => [
                    'Implement only the strongest single security control',
                    'Use multiple layers including input validation, authentication, authorization, and logging',
                    'Focus exclusively on perimeter security',
                    'Rely on the web server\'s built-in security features',
                ],
                'correct_options' => ['Use multiple layers including input validation, authentication, authorization, and logging'],
                'justifications' => [
                    'Single controls, regardless of strength, can fail or be bypassed',
                    'Correct - Defense in depth requires multiple security layers for comprehensive protection',
                    'Perimeter security alone cannot protect against all web application threats',
                    'Built-in features alone are insufficient for comprehensive web application security',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 35 - Security Principles - L3 Application
            [
                'topic' => 'Security Principles',
                'subtopic' => 'Access Control Principles',
                'question' => 'A financial system requires dual approval for transactions over $10,000. Which security principle does this implement?',
                'type_id' => 1,
                'options' => [
                    'Principle of least privilege',
                    'Separation of duties',
                    'Defense in depth',
                    'Fail secure',
                ],
                'correct_options' => ['Separation of duties'],
                'justifications' => [
                    'While related, this specifically requires multiple people, not minimum access',
                    'Correct - Dual approval requires two people to complete the transaction, implementing separation of duties',
                    'This is not about multiple layers of different controls',
                    'This is not about failure behavior but normal operational requirements',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 36 - Security Principles - L3 Application
            [
                'topic' => 'Security Principles',
                'subtopic' => 'Design Principles',
                'question' => 'When designing a secure network architecture, how should the principle of "security by design" be implemented?',
                'type_id' => 1,
                'options' => [
                    'Add security features after the network is operational',
                    'Integrate security considerations into every phase of network design and implementation',
                    'Use only the most expensive security products available',
                    'Copy security designs from other organizations',
                ],
                'correct_options' => ['Integrate security considerations into every phase of network design and implementation'],
                'justifications' => [
                    'Security by design requires incorporating security from the beginning, not as an afterthought',
                    'Correct - Security by design integrates security throughout the entire design and implementation process',
                    'Cost is not the determining factor for security by design',
                    'Each organization has unique requirements that require customized security design',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 37 - Security Principles - L4 Analysis
            [
                'topic' => 'Security Principles',
                'subtopic' => 'Access Control Principles',
                'question' => 'Analyze the potential conflicts between the principle of least privilege and operational efficiency.',
                'type_id' => 1,
                'options' => [
                    'There are never conflicts between security and efficiency',
                    'Least privilege can slow operations but provides essential security protection',
                    'Operational efficiency should always override security principles',
                    'These principles are unrelated to each other',
                ],
                'correct_options' => ['Least privilege can slow operations but provides essential security protection'],
                'justifications' => [
                    'Security and efficiency often require balancing competing interests',
                    'Correct - Least privilege may add steps or restrictions but is necessary for security',
                    'Security principles serve important risk management purposes',
                    'Access controls directly impact operational procedures and efficiency',
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.5,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 38 - Security Principles - L4 Analysis
            [
                'topic' => 'Security Principles',
                'subtopic' => 'Design Principles',
                'question' => 'What are the primary challenges in implementing defense in depth in cloud environments?',
                'type_id' => 1,
                'options' => [
                    'Cloud environments don\'t support multiple security layers',
                    'Complexity of managing multiple cloud services, shared responsibility models, and integration challenges',
                    'Defense in depth is not applicable to cloud computing',
                    'Cloud providers handle all security automatically',
                ],
                'correct_options' => ['Complexity of managing multiple cloud services, shared responsibility models, and integration challenges'],
                'justifications' => [
                    'Cloud environments can support multiple layers but implementation can be complex',
                    'Correct - Cloud environments present unique challenges for implementing layered security',
                    'Defense in depth principles apply to cloud environments but require adapted implementation',
                    'Cloud security is a shared responsibility requiring customer implementation of many controls',
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 0.6,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 39 - Security Principles - L5 Evaluation
            [
                'topic' => 'Security Principles',
                'subtopic' => 'Access Control Principles',
                'question' => 'Evaluate the trade-offs between implementing strict separation of duties versus accepting some security risk for operational flexibility.',
                'type_id' => 1,
                'options' => [
                    'Strict separation of duties should never be compromised',
                    'Security risks are never acceptable for any operational benefits',
                    'Risk-based decisions should consider threat likelihood, impact, and business requirements',
                    'Operational flexibility is always more important than security',
                ],
                'correct_options' => ['Risk-based decisions should consider threat likelihood, impact, and business requirements'],
                'justifications' => [
                    'Some situations may justify modified implementations based on risk assessment',
                    'Risk management involves balancing security with business needs',
                    'Correct - Security decisions should be based on comprehensive risk assessment and business context',
                    'Security provides essential protection that cannot be ignored for convenience',
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 0.9,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Item 40 - Security Principles - L5 Evaluation
            [
                'topic' => 'Security Principles',
                'subtopic' => 'Design Principles',
                'question' => 'Assess the long-term effectiveness of security principles developed decades ago in addressing modern cybersecurity challenges.',
                'type_id' => 1,
                'options' => [
                    'Old principles are completely obsolete and should be abandoned',
                    'New technologies require entirely different security approaches',
                    'Core principles remain valid but require modern interpretation and implementation',
                    'Traditional principles are sufficient without any updates',
                ],
                'correct_options' => ['Core principles remain valid but require modern interpretation and implementation'],
                'justifications' => [
                    'Fundamental security principles address timeless security challenges',
                    'While implementation changes, core principles like least privilege remain relevant',
                    'Correct - Security principles provide enduring guidance but need contemporary application',
                    'Modern threats and technologies require updated implementation of traditional principles',
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.1,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 5: Cybersecurity Frameworks - 10 Questions
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 41 - Cybersecurity Frameworks - L1 Knowledge
            [
                'topic' => 'Cybersecurity Frameworks',
                'subtopic' => 'Risk Management Frameworks',
                'question' => 'What is the primary purpose of the NIST Cybersecurity Framework?',
                'type_id' => 1,
                'options' => [
                    'To replace all other security standards',
                    'To provide a voluntary framework for managing cybersecurity risk',
                    'To establish mandatory security requirements for all organizations',
                    'To create new cybersecurity technologies',
                ],
                'correct_options' => ['To provide a voluntary framework for managing cybersecurity risk'],
                'justifications' => [
                    'NIST CSF complements rather than replaces other standards',
                    'Correct - The NIST CSF provides voluntary guidance for cybersecurity risk management',
                    'The framework is voluntary, not mandatory (except for some federal agencies)',
                    'The framework focuses on management approaches, not technology development',
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'irt_a' => 1.0,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 42 - Cybersecurity Frameworks - L1 Knowledge
            [
                'topic' => 'Cybersecurity Frameworks',
                'subtopic' => 'Control Frameworks',
                'question' => 'What are the five core functions of the NIST Cybersecurity Framework?',
                'type_id' => 1,
                'options' => [
                    'Plan, Do, Check, Act, Improve',
                    'Identify, Protect, Detect, Respond, Recover',
                    'Assess, Design, Implement, Monitor, Review',
                    'Prevent, Detect, Contain, Eradicate, Learn',
                ],
                'correct_options' => ['Identify, Protect, Detect, Respond, Recover'],
                'justifications' => [
                    'This describes the PDCA cycle, not NIST CSF functions',
                    'Correct - The five core functions are Identify, Protect, Detect, Respond, Recover',
                    'This describes a general system lifecycle, not NIST CSF functions',
                    'This describes incident response phases, not NIST CSF core functions',
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'irt_a' => 1.1,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 43 - Cybersecurity Frameworks - L2 Comprehension
            [
                'topic' => 'Cybersecurity Frameworks',
                'subtopic' => 'Governance Frameworks',
                'question' => 'How does ISO 27001 differ from other cybersecurity frameworks?',
                'type_id' => 1,
                'options' => [
                    'It focuses only on technical controls',
                    'It provides a certifiable information security management system standard',
                    'It applies only to government organizations',
                    'It replaces the need for other security frameworks',
                ],
                'correct_options' => ['It provides a certifiable information security management system standard'],
                'justifications' => [
                    'ISO 27001 covers management, physical, and technical controls',
                    'Correct - ISO 27001 is unique in providing a certifiable ISMS standard',
                    'ISO 27001 applies to all types of organizations',
                    'ISO 27001 can be used alongside other frameworks',
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'irt_a' => 1.2,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 44 - Cybersecurity Frameworks - L2 Comprehension
            [
                'topic' => 'Cybersecurity Frameworks',
                'subtopic' => 'Control Frameworks',
                'question' => 'Why do organizations often use multiple cybersecurity frameworks simultaneously?',
                'type_id' => 1,
                'options' => [
                    'To increase compliance costs',
                    'Different frameworks address different aspects of cybersecurity and regulatory requirements',
                    'Multiple frameworks are always better than single frameworks',
                    'It is required by law in most jurisdictions',
                ],
                'correct_options' => ['Different frameworks address different aspects of cybersecurity and regulatory requirements'],
                'justifications' => [
                    'Organizations use multiple frameworks for benefits, not to increase costs',
                    'Correct - Different frameworks serve different purposes and regulatory needs',
                    'More frameworks are not automatically better; it depends on organizational needs',
                    'Multiple framework usage is typically voluntary, not legally required',
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'irt_a' => 1.3,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 45 - Cybersecurity Frameworks - L3 Application
            [
                'topic' => 'Cybersecurity Frameworks',
                'subtopic' => 'Risk Management Frameworks',
                'question' => 'How should a healthcare organization choose between NIST CSF and HIPAA Security Rule for cybersecurity guidance?',
                'type_id' => 1,
                'options' => [
                    'Choose only one framework to avoid conflicts',
                    'Use NIST CSF as voluntary guidance while ensuring HIPAA compliance',
                    'HIPAA automatically covers all NIST CSF requirements',
                    'Healthcare organizations cannot use NIST CSF',
                ],
                'correct_options' => ['Use NIST CSF as voluntary guidance while ensuring HIPAA compliance'],
                'justifications' => [
                    'Frameworks can be complementary rather than conflicting',
                    'Correct - NIST CSF can provide additional guidance while meeting mandatory HIPAA requirements',
                    'HIPAA has specific requirements but NIST CSF provides broader cybersecurity guidance',
                    'NIST CSF is applicable to healthcare organizations',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 46 - Cybersecurity Frameworks - L3 Application
            [
                'topic' => 'Cybersecurity Frameworks',
                'subtopic' => 'Governance Frameworks',
                'question' => 'What is the most effective approach for implementing a cybersecurity framework in a mid-sized organization?',
                'type_id' => 1,
                'options' => [
                    'Implement all framework requirements immediately',
                    'Conduct a gap analysis, prioritize based on risk, and implement in phases',
                    'Ignore frameworks and develop custom security measures',
                    'Only implement the least expensive framework requirements',
                ],
                'correct_options' => ['Conduct a gap analysis, prioritize based on risk, and implement in phases'],
                'justifications' => [
                    'Immediate full implementation may be overwhelming and ineffective',
                    'Correct - Phased, risk-based implementation allows for manageable and effective deployment',
                    'Frameworks provide valuable guidance that custom approaches may miss',
                    'Cost should not be the primary factor; risk and effectiveness are more important',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 47 - Cybersecurity Frameworks - L3 Application
            [
                'topic' => 'Cybersecurity Frameworks',
                'subtopic' => 'Control Frameworks',
                'question' => 'How should an organization measure the effectiveness of their cybersecurity framework implementation?',
                'type_id' => 1,
                'options' => [
                    'Count the number of controls implemented',
                    'Measure risk reduction, incident frequency, and control performance metrics',
                    'Only measure compliance with framework requirements',
                    'Framework effectiveness cannot be measured',
                ],
                'correct_options' => ['Measure risk reduction, incident frequency, and control performance metrics'],
                'justifications' => [
                    'Control quantity does not indicate effectiveness or risk reduction',
                    'Correct - Effectiveness should be measured through security outcomes and performance metrics',
                    'Compliance alone does not guarantee security effectiveness',
                    'Framework effectiveness can and should be measured through various metrics',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 48 - Cybersecurity Frameworks - L4 Analysis
            [
                'topic' => 'Cybersecurity Frameworks',
                'subtopic' => 'Risk Management Frameworks',
                'question' => 'Analyze the challenges organizations face when trying to align multiple cybersecurity frameworks.',
                'type_id' => 1,
                'options' => [
                    'There are no challenges because all frameworks are identical',
                    'Different terminology, overlapping requirements, and resource allocation complexity',
                    'Only technical implementation challenges exist',
                    'Alignment is impossible and should not be attempted',
                ],
                'correct_options' => ['Different terminology, overlapping requirements, and resource allocation complexity'],
                'justifications' => [
                    'Frameworks have different approaches and terminology',
                    'Correct - Multiple frameworks create complexity in terminology, requirements, and resource management',
                    'Challenges include management and policy issues beyond technical implementation',
                    'While challenging, framework alignment is possible and often beneficial',
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.4,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 49 - Cybersecurity Frameworks - L4 Analysis
            [
                'topic' => 'Cybersecurity Frameworks',
                'subtopic' => 'Governance Frameworks',
                'question' => 'What is the primary limitation of relying solely on framework compliance for cybersecurity?',
                'type_id' => 1,
                'options' => [
                    'Frameworks are always outdated',
                    'Compliance may create a checkbox mentality without addressing actual security risks',
                    'Frameworks are too expensive to implement properly',
                    'Compliance guarantees perfect security',
                ],
                'correct_options' => ['Compliance may create a checkbox mentality without addressing actual security risks'],
                'justifications' => [
                    'While frameworks may lag behind threats, this is not the primary limitation',
                    'Correct - Framework compliance alone may not address organization-specific risks and threats',
                    'Cost is a consideration but not the primary limitation of compliance-focused approaches',
                    'No framework or compliance approach can guarantee perfect security',
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 0.5,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 50 - Cybersecurity Frameworks - L3 Application
            [
                'topic' => 'Cybersecurity Frameworks',
                'subtopic' => 'Control Frameworks',
                'question' => 'A company implementing NIST CSF wants to address emerging AI security risks. How should they approach framework adaptation?',
                'type_id' => 1,
                'options' => [
                    'Wait for official framework updates before taking action',
                    'Ignore AI risks since they are not in the current framework',
                    'Apply existing framework principles to AI risks while monitoring for formal updates',
                    'Abandon NIST CSF and create a completely new approach',
                ],
                'correct_options' => ['Apply existing framework principles to AI risks while monitoring for formal updates'],
                'justifications' => [
                    'Waiting may leave the organization exposed to evolving risks',
                    'Emerging risks should be addressed proactively, not ignored',
                    'Correct - Framework principles can be applied to new technologies while staying current with updates',
                    'Abandoning proven frameworks eliminates valuable guidance and structure',
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],
        ];
    }
}
