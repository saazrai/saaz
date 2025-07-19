<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;
use Illuminate\Database\Seeder;

class D1GeneralSecurityConceptsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing items for this domain to prevent duplicates
        DiagnosticItem::whereHas('topic.domain', function($query) {
            $query->where('name', 'General Security Concepts');
        })->forceDelete();
        
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'General Security Concepts');
        })->pluck('id', 'name');
        
        $items = [
            // 5 Pillars of Information Security - 10 Questions (Items 1-10)
            
            // Item 1 - 5 Pillars - L1 Knowledge
            [
                'topic_id' => $topics['5 Pillars of Information Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What are the five pillars of information security?',
                'options' => [
                    'Confidentiality, Integrity, Availability, Authentication, Authorization',
                    'Confidentiality, Integrity, Availability, Authenticity, Non-repudiation',
                    'Prevention, Detection, Response, Recovery, Monitoring',
                    'Physical, Technical, Administrative, Deterrent, Compensating'
                ],
                'correct_options' => ['Confidentiality, Integrity, Availability, Authenticity, Non-repudiation'],
                'justifications' => [
                    'Authentication and authorization are access control mechanisms, not the five pillars',
                    'Correct - These are the five fundamental pillars of information security',
                    'These are incident response phases, not the five pillars',
                    'These are security control categories, not the five pillars'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 2 - 5 Pillars - L1 Knowledge
            [
                'topic_id' => $topics['5 Pillars of Information Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which pillar of information security ensures that data has not been altered or modified?',
                'options' => [
                    'Confidentiality',
                    'Integrity',
                    'Availability',
                    'Authenticity'
                ],
                'correct_options' => ['Integrity'],
                'justifications' => [
                    'Confidentiality protects data from unauthorized access',
                    'Correct - Integrity ensures data remains unaltered and accurate',
                    'Availability ensures data is accessible when needed',
                    'Authenticity verifies the source of data'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 3 - 5 Pillars - L3 Application
            [
                'topic_id' => $topics['5 Pillars of Information Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A healthcare organization implements digital signatures for patient records. Which two pillars of information security are primarily addressed?',
                'options' => [
                    'Confidentiality and Availability',
                    'Integrity and Authenticity',
                    'Availability and Non-repudiation',
                    'Confidentiality and Integrity'
                ],
                'correct_options' => ['Integrity and Authenticity'],
                'justifications' => [
                    'Digital signatures don\'t provide confidentiality protection',
                    'Correct - Digital signatures verify both data integrity and authenticity of the signer',
                    'Digital signatures don\'t directly address availability',
                    'Digital signatures don\'t provide confidentiality protection'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 4 - 5 Pillars - L3 Application
            [
                'topic_id' => $topics['5 Pillars of Information Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'An e-commerce website uses timestamped transaction logs that cannot be denied by customers. Which pillar is primarily demonstrated?',
                'options' => [
                    'Confidentiality',
                    'Integrity', 
                    'Availability',
                    'Non-repudiation'
                ],
                'correct_options' => ['Non-repudiation'],
                'justifications' => [
                    'Confidentiality protects information from unauthorized access',
                    'Integrity ensures data hasn\'t been altered',
                    'Availability ensures systems are accessible',
                    'Correct - Non-repudiation prevents denial of actions or transactions'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 5 - 5 Pillars - L3 Application
            [
                'topic_id' => $topics['5 Pillars of Information Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A company\'s backup system fails during a cyberattack, customer data is stolen, and some records are corrupted. Which pillar is MOST severely impacted?',
                'options' => [
                    'Confidentiality - due to data theft',
                    'Integrity - due to data corruption',
                    'Availability - due to backup failure',
                    'All pillars are equally impacted'
                ],
                'correct_options' => ['Confidentiality - due to data theft'],
                'justifications' => [
                    'Correct - Data theft creates immediate legal liability and reputation damage',
                    'Data corruption is serious but typically has less immediate impact than theft',
                    'Backup failure affects recovery but data theft is more severe',
                    'Data theft typically has the most severe immediate consequences'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 6 - 5 Pillars - L3 Application
            [
                'topic_id' => $topics['5 Pillars of Information Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A financial institution needs to prove that a customer authorized a large transfer. Which pillar should be the primary focus?',
                'options' => [
                    'Confidentiality',
                    'Integrity',
                    'Availability',
                    'Non-repudiation'
                ],
                'correct_options' => ['Non-repudiation'],
                'justifications' => [
                    'Confidentiality protects transaction details but doesn\'t prove authorization',
                    'Integrity ensures transaction data hasn\'t been altered',
                    'Availability ensures the system is accessible',
                    'Correct - Non-repudiation provides proof that the customer authorized the transaction'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 7 - 5 Pillars - L4 Analysis
            [
                'topic_id' => $topics['5 Pillars of Information Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Analyze why availability is often the most challenging pillar to maintain in distributed systems. What is the primary architectural factor?',
                'options' => [
                    'Encryption processes consume excessive computational resources',
                    'System dependencies create multiple failure points that can cascade',
                    'Integrity verification adds latency across distributed components',
                    'Authentication bottlenecks limit concurrent access'
                ],
                'correct_options' => ['System dependencies create multiple failure points that can cascade'],
                'justifications' => [
                    'Encryption affects performance but isn\'t the primary availability challenge',
                    'Correct - Distributed systems have interdependent components where failures cascade',
                    'Integrity checks add overhead but aren\'t the fundamental challenge',
                    'Well-designed authentication shouldn\'t create availability bottlenecks'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 8 - 5 Pillars - L4 Analysis
            [
                'topic_id' => $topics['5 Pillars of Information Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze the trade-offs between the five pillars. Why do organizations struggle to optimize all pillars simultaneously?',
                'options' => [
                    'Technical expertise limitations prevent optimal implementation',
                    'Resource constraints force prioritization between competing security objectives',
                    'Security frameworks don\'t provide adequate guidance for balancing pillars',
                    'Management lacks understanding of pillar importance'
                ],
                'correct_options' => ['Resource constraints force prioritization between competing security objectives'],
                'justifications' => [
                    'Technical expertise affects implementation quality but doesn\'t explain trade-offs',
                    'Correct - Limited resources force difficult choices between potentially conflicting security controls',
                    'Frameworks provide guidance but can\'t eliminate resource constraints',
                    'Management understanding affects investment but doesn\'t eliminate trade-offs'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 9 - 5 Pillars - L3 Application
            [
                'topic_id' => $topics['5 Pillars of Information Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the effectiveness of biometric authentication in addressing the five pillars. Which pillar receives the strongest benefit?',
                'options' => [
                    'Confidentiality - biometrics are harder to steal',
                    'Integrity - biometric data cannot be altered',
                    'Authenticity - biometrics provide unique individual identification',
                    'Non-repudiation - biometric actions cannot be denied'
                ],
                'correct_options' => ['Authenticity - biometrics provide unique individual identification'],
                'justifications' => [
                    'Biometrics can be stolen through various methods',
                    'Biometric data can be altered or spoofed',
                    'Correct - The inherent connection between biometric traits and identity provides strongest authenticity assurance',
                    'Biometrics support non-repudiation but authenticity is the primary strength'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 10 - 5 Pillars - L3 Application
            [
                'topic_id' => $topics['5 Pillars of Information Security'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate the five pillars in a zero-trust architecture implementation. Which pillar presents the greatest implementation challenge?',
                'options' => [
                    'Confidentiality - encrypting all communications',
                    'Integrity - ensuring data hasn\'t been tampered with',
                    'Availability - maintaining performance with additional security checks',
                    'All pillars present equal challenges'
                ],
                'correct_options' => ['Availability - maintaining performance with additional security checks'],
                'justifications' => [
                    'Encryption is well-understood and standardized',
                    'Integrity checks are established practices',
                    'Correct - Zero-trust adds significant latency and complexity that impacts user experience',
                    'Availability challenges are typically most significant in zero-trust'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Professional Ethics - 10 Questions (Items 11-20)
            
            // Item 11 - Professional Ethics - L2 Comprehension
            [
                'topic_id' => $topics['Professional Ethics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of a professional code of ethics in cybersecurity?',
                'options' => [
                    'To provide legal protection for practitioners',
                    'To establish professional standards and guide behavior',
                    'To increase salary and career opportunities',
                    'To comply with government regulations'
                ],
                'correct_options' => ['To establish professional standards and guide behavior'],
                'justifications' => [
                    'Codes of ethics provide guidance but not legal protection',
                    'Correct - Professional codes establish standards and guide ethical decision-making',
                    'Ethics codes focus on behavior standards, not compensation',
                    'Ethics codes are professional standards, not regulatory compliance'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 12 - Professional Ethics - L2 Comprehension
            [
                'topic_id' => $topics['Professional Ethics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which principle is fundamental to cybersecurity professional ethics?',
                'options' => [
                    'Maximizing organizational profits',
                    'Protecting the public interest and safety',
                    'Maintaining competitive advantage',
                    'Minimizing security investment costs'
                ],
                'correct_options' => ['Protecting the public interest and safety'],
                'justifications' => [
                    'Profit maximization may conflict with ethical obligations',
                    'Correct - Protecting public interest and safety is a core ethical principle',
                    'Competitive advantage shouldn\'t override ethical obligations',
                    'Cost minimization may compromise security and ethics'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 13 - Professional Ethics - L3 Application
            [
                'topic_id' => $topics['Professional Ethics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A cybersecurity professional discovers a vulnerability in their employer\'s system that could harm customers. What is the ethical obligation?',
                'options' => [
                    'Ignore it to protect the employer\'s reputation',
                    'Report it immediately to management for remediation',
                    'Disclose it publicly to warn customers',
                    'Use it to test the organization\'s response'
                ],
                'correct_options' => ['Report it immediately to management for remediation'],
                'justifications' => [
                    'Ignoring vulnerabilities violates the duty to protect stakeholders',
                    'Correct - Internal reporting allows remediation while protecting the organization',
                    'Public disclosure should be a last resort after internal processes fail',
                    'Unauthorized testing could cause harm and violate trust'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 14 - Professional Ethics - L2 Comprehension
            [
                'topic_id' => $topics['Professional Ethics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What does "due care" mean in the context of cybersecurity ethics?',
                'options' => [
                    'Investigating risks before making decisions',
                    'Taking reasonable actions to protect stakeholders',
                    'Following all security policies exactly',
                    'Documenting all security activities'
                ],
                'correct_options' => ['Taking reasonable actions to protect stakeholders'],
                'justifications' => [
                    'This describes due diligence, not due care',
                    'Correct - Due care involves taking reasonable protective actions',
                    'Following policies is important but due care is broader',
                    'Documentation supports due care but isn\'t the definition'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 15 - Professional Ethics - L5 Evaluation
            [
                'topic_id' => $topics['Professional Ethics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A CISO is pressured by executives to bypass security controls to meet a business deadline. What is the most ethical response?',
                'options' => [
                    'Comply with executive requests to maintain employment',
                    'Refuse and escalate to the board if necessary',
                    'Implement temporary workarounds without approval',
                    'Compromise by reducing some but not all controls'
                ],
                'correct_options' => ['Refuse and escalate to the board if necessary'],
                'justifications' => [
                    'Compliance with unethical requests violates professional obligations',
                    'Correct - Protecting stakeholders may require escalation despite personal risk',
                    'Unauthorized workarounds could increase risk and violate trust',
                    'Compromising security controls puts stakeholders at risk'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 16 - Professional Ethics - L5 Evaluation
            [
                'topic_id' => $topics['Professional Ethics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A cybersecurity consultant discovers their client is using security tools for employee surveillance beyond stated purposes. What should they do?',
                'options' => [
                    'Continue the engagement since it\'s not their decision',
                    'Address concerns with the client and seek resolution',
                    'Immediately terminate the contract',
                    'Report the client to authorities'
                ],
                'correct_options' => ['Address concerns with the client and seek resolution'],
                'justifications' => [
                    'Professionals have obligations beyond contractual requirements',
                    'Correct - Addressing concerns allows opportunity for ethical resolution',
                    'Immediate termination should follow failed resolution attempts',
                    'Reporting may be premature without attempting resolution'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 17 - Professional Ethics - L4 Analysis
            [
                'topic_id' => $topics['Professional Ethics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze the ethical conflict between organizational loyalty and professional responsibility. When should professional responsibility take precedence?',
                'options' => [
                    'When the organization faces financial difficulties',
                    'When stakeholder safety or public interest is at risk',
                    'When personal career advancement is threatened',
                    'When competitive advantage is at stake'
                ],
                'correct_options' => ['When stakeholder safety or public interest is at risk'],
                'justifications' => [
                    'Financial difficulties don\'t override ethical obligations',
                    'Correct - Professional responsibility prioritizes stakeholder safety over organizational interests',
                    'Personal advancement shouldn\'t drive ethical decisions',
                    'Competitive advantage is secondary to ethical obligations'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 18 - Professional Ethics - L4 Analysis
            [
                'topic_id' => $topics['Professional Ethics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze why cybersecurity professionals have higher ethical obligations than other IT professionals. What is the primary differentiator?',
                'options' => [
                    'Cybersecurity requires more technical expertise',
                    'Cybersecurity professionals have access to sensitive systems',
                    'Cybersecurity decisions directly impact stakeholder safety and trust',
                    'Cybersecurity roles have higher compensation'
                ],
                'correct_options' => ['Cybersecurity decisions directly impact stakeholder safety and trust'],
                'justifications' => [
                    'Technical expertise doesn\'t determine ethical obligations',
                    'Access creates responsibility but impact is the key factor',
                    'Correct - Cybersecurity decisions have broad impact on safety and trust',
                    'Compensation doesn\'t determine ethical obligations'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 19 - Professional Ethics - L3 Application
            [
                'topic_id' => $topics['Professional Ethics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the effectiveness of professional codes of ethics in cybersecurity. What is their primary limitation?',
                'options' => [
                    'They are too complex for practitioners to understand',
                    'They lack legal enforcement mechanisms',
                    'They cannot address all specific ethical dilemmas',
                    'They are not updated frequently enough'
                ],
                'correct_options' => ['They cannot address all specific ethical dilemmas'],
                'justifications' => [
                    'Most codes are designed to be understandable',
                    'Legal enforcement isn\'t the primary purpose of ethical codes',
                    'Correct - Codes provide principles but cannot cover every specific situation',
                    'Update frequency is less important than fundamental guidance'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 20 - Professional Ethics - L1 Knowledge
            [
                'topic_id' => $topics['Professional Ethics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which ethical principle requires cybersecurity professionals to act in the best interest of society?',
                'options' => [
                    'Professional competence',
                    'Public interest',
                    'Organizational loyalty',
                    'Technical excellence'
                ],
                'correct_options' => ['Public interest'],
                'justifications' => [
                    'Professional competence is about skills and knowledge',
                    'Correct - Public interest principle requires acting for society\'s benefit',
                    'Organizational loyalty is important but secondary to public interest',
                    'Technical excellence is about quality, not ethical obligations'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Security Controls - 10 Questions (Items 21-30)
            
            // Item 21 - Security Controls - L2 Comprehension
            [
                'topic_id' => $topics['Security Controls'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which type of security control is a firewall?',
                'options' => [
                    'Administrative',
                    'Physical',
                    'Technical',
                    'Operational'
                ],
                'correct_options' => ['Technical'],
                'justifications' => [
                    'Administrative controls are policies and procedures',
                    'Physical controls protect physical assets',
                    'Correct - Firewalls are technical/logical security controls',
                    'Operational is not a standard control type category'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 22 - Security Controls - L2 Comprehension
            [
                'topic_id' => $topics['Security Controls'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of administrative security controls?',
                'options' => [
                    'To provide technical protection mechanisms',
                    'To establish policies, procedures, and guidelines',
                    'To protect physical assets and facilities',
                    'To monitor and detect security incidents'
                ],
                'correct_options' => ['To establish policies, procedures, and guidelines'],
                'justifications' => [
                    'Technical controls provide technical protection',
                    'Correct - Administrative controls establish governance and procedures',
                    'Physical controls protect physical assets',
                    'Monitoring can be done by various control types'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 23 - Security Controls - L3 Application
            [
                'topic_id' => $topics['Security Controls'] ?? 3,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each security control with its primary category:',
                'options' => [
                    'items' => [
                        'Security awareness training',
                        'Biometric access control',
                        'Encryption software',
                        'Security guards',
                        'Background checks'
                    ],
                    'responses' => [
                        'Administrative',
                        'Physical',
                        'Technical',
                        'Administrative',
                        'Physical'
                    ]
                ],
                'correct_options' => [
                    'Security awareness training' => 'Administrative',
                    'Biometric access control' => 'Physical',
                    'Encryption software' => 'Technical',
                    'Security guards' => 'Physical',
                    'Background checks' => 'Administrative'
                ],
                'justifications' => [
                    'Security awareness training' => 'Training programs are administrative controls',
                    'Biometric access control' => 'Controls physical access to facilities',
                    'Encryption software' => 'Software-based technical control',
                    'Security guards' => 'Human physical security control',
                    'Background checks' => 'Administrative screening procedure'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 24 - Security Controls - L2 Comprehension
            [
                'topic_id' => $topics['Security Controls'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which control function does an intrusion detection system (IDS) primarily serve?',
                'options' => [
                    'Preventive',
                    'Detective',
                    'Corrective',
                    'Deterrent'
                ],
                'correct_options' => ['Detective'],
                'justifications' => [
                    'Preventive controls stop incidents before they occur',
                    'Correct - IDS detects and alerts on security incidents',
                    'Corrective controls fix problems after they occur',
                    'Deterrent controls discourage potential attackers'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 25 - Security Controls - L5 Evaluation
            [
                'topic_id' => $topics['Security Controls'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A company requires 20-character passwords changed every 30 days. Users write passwords on sticky notes. What is the BEST solution?',
                'options' => [
                    'Increase password requirements to 25 characters',
                    'Implement password manager with single sign-on',
                    'Add security cameras to monitor desks',
                    'Require passwords be memorized with testing'
                ],
                'correct_options' => ['Implement password manager with single sign-on'],
                'justifications' => [
                    'This worsens the usability problem',
                    'Correct - Balances security with usability',
                    'Addresses symptoms, not root cause',
                    'Impractical and reduces productivity'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 26 - Security Controls - L3 Application
            [
                'topic_id' => $topics['Security Controls'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A financial institution needs controls for a new payment system. Which approach best addresses regulatory requirements?',
                'options' => [
                    'Technical controls only (encryption, authentication)',
                    'Administrative controls only (policies, procedures)',
                    'Physical controls only (secure facilities, hardware)',
                    'Integrated technical, administrative, and physical controls'
                ],
                'correct_options' => ['Integrated technical, administrative, and physical controls'],
                'justifications' => [
                    'Technical controls alone don\'t address all requirements',
                    'Policies without implementation are insufficient',
                    'Physical security alone doesn\'t address digital threats',
                    'Correct - Comprehensive approach addresses all threat vectors'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 27 - Security Controls - L4 Analysis
            [
                'topic_id' => $topics['Security Controls'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze why layered security controls are necessary. What is the primary architectural benefit?',
                'options' => [
                    'Regulatory compliance requires multiple control types',
                    'Each control type addresses different attack vectors and threats',
                    'Technical controls are strongest with other types as backup',
                    'Multiple layers demonstrate security maturity'
                ],
                'correct_options' => ['Each control type addresses different attack vectors and threats'],
                'justifications' => [
                    'Compliance influences design but isn\'t the primary reason',
                    'Correct - Different threats require different control types for comprehensive coverage',
                    'No single control type is inherently strongest',
                    'Maturity demonstration is secondary to effectiveness'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 28 - Security Controls - L4 Analysis
            [
                'topic_id' => $topics['Security Controls'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze the effectiveness of deterrent controls. What is their primary limitation?',
                'options' => [
                    'They are too expensive to implement',
                    'They only work on rational actors who fear consequences',
                    'They require constant monitoring to be effective',
                    'They cannot be measured or quantified'
                ],
                'correct_options' => ['They only work on rational actors who fear consequences'],
                'justifications' => [
                    'Cost isn\'t the primary limitation',
                    'Correct - Deterrent controls are ineffective against irrational or desperate actors',
                    'Monitoring isn\'t required for deterrence',
                    'Measurement challenges exist but aren\'t the primary limitation'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 29 - Security Controls - L3 Application
            [
                'topic_id' => $topics['Security Controls'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the security control design that leads to password sticky notes. What is the fundamental failure?',
                'options' => [
                    'Users are inherently careless about security',
                    'Controls that are too difficult to use will be circumvented',
                    'Password complexity requirements are fundamentally flawed',
                    'Physical security is less important than logical security'
                ],
                'correct_options' => ['Controls that are too difficult to use will be circumvented'],
                'justifications' => [
                    'This blames users rather than recognizing design problems',
                    'Correct - Poor usability leads to security workarounds that reduce overall security',
                    'Complexity can be good when implemented with proper tools',
                    'Physical exposure of passwords creates multiple security risks'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 30 - Security Controls - L1 Knowledge
            [
                'topic_id' => $topics['Security Controls'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which security control function is primarily performed by antivirus software?',
                'options' => [
                    'Preventive',
                    'Detective',
                    'Corrective',
                    'Deterrent'
                ],
                'correct_options' => ['Preventive'],
                'justifications' => [
                    'Correct - Antivirus software prevents malware from executing',
                    'While it detects threats, its primary function is prevention',
                    'Corrective controls fix problems after they occur',
                    'Deterrent controls discourage attackers'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Security Principles - 10 Questions (Items 31-40)
            
            // Item 31 - Security Principles - L2 Comprehension
            [
                'topic_id' => $topics['Security Principles'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What does the principle of least privilege mean?',
                'options' => [
                    'Users should have the minimum access necessary to perform their job',
                    'Users should have read-only access to all systems',
                    'Users should share accounts to minimize administrative overhead',
                    'Users should only access systems during business hours'
                ],
                'correct_options' => ['Users should have the minimum access necessary to perform their job'],
                'justifications' => [
                    'Correct - Least privilege grants only necessary access for job functions',
                    'Read-only access might be insufficient for job requirements',
                    'Shared accounts violate accountability principles',
                    'Time restrictions are separate from privilege levels'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 32 - Security Principles - L2 Comprehension
            [
                'topic_id' => $topics['Security Principles'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the principle of need-to-know?',
                'options' => [
                    'Information should be shared with everyone in the organization',
                    'Information should only be shared with those who require it for their duties',
                    'Information should only be shared with management',
                    'Information should be publicly available unless classified'
                ],
                'correct_options' => ['Information should only be shared with those who require it for their duties'],
                'justifications' => [
                    'Universal sharing violates need-to-know principle',
                    'Correct - Information access is limited to those who need it for legitimate purposes',
                    'Management doesn\'t automatically have need-to-know for all information',
                    'Default public access violates need-to-know principle'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 33 - Security Principles - L3 Application
            [
                'topic_id' => $topics['Security Principles'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A bank requires two employees to approve wire transfers over $50,000. Which principle is demonstrated?',
                'options' => [
                    'Least privilege',
                    'Need-to-know',
                    'Separation of duties',
                    'Dual control'
                ],
                'correct_options' => ['Dual control'],
                'justifications' => [
                    'Least privilege limits access, not requiring multiple people',
                    'Need-to-know limits information access',
                    'Separation of duties divides responsibilities, not requiring simultaneous approval',
                    'Correct - Dual control requires two people to complete sensitive operations'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 34 - Security Principles - L2 Comprehension
            [
                'topic_id' => $topics['Security Principles'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the difference between separation of duties and dual control?',
                'options' => [
                    'Separation of duties is for technical systems, dual control is for people',
                    'Separation divides tasks among different people, dual control requires simultaneous action',
                    'Separation is preventive, dual control is detective',
                    'There is no difference - they are the same principle'
                ],
                'correct_options' => ['Separation divides tasks among different people, dual control requires simultaneous action'],
                'justifications' => [
                    'Both can apply to technical and human processes',
                    'Correct - Separation divides responsibilities, dual control requires concurrent involvement',
                    'Both are typically preventive controls',
                    'They are related but distinct principles'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 35 - Security Principles - L5 Evaluation
            [
                'topic_id' => $topics['Security Principles'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A developer needs access to production systems to troubleshoot. How should least privilege be applied?',
                'options' => [
                    'Grant full administrative access to resolve issues quickly',
                    'Grant read-only access to production systems',
                    'Grant temporary, specific access for the troubleshooting task',
                    'Deny all access to maintain security'
                ],
                'correct_options' => ['Grant temporary, specific access for the troubleshooting task'],
                'justifications' => [
                    'Full administrative access violates least privilege',
                    'Read-only access might be insufficient for troubleshooting',
                    'Correct - Temporary, specific access aligns with least privilege principles',
                    'Denying necessary access could prevent legitimate business needs'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 36 - Security Principles - L3 Application
            [
                'topic_id' => $topics['Security Principles'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How should split knowledge be implemented for a critical encryption key?',
                'options' => [
                    'Store the complete key in multiple locations',
                    'Divide the key into parts, with each part held by different people',
                    'Share the key with all authorized users',
                    'Store the key in a hardware security module'
                ],
                'correct_options' => ['Divide the key into parts, with each part held by different people'],
                'justifications' => [
                    'Complete key storage doesn\'t implement split knowledge',
                    'Correct - Split knowledge divides sensitive information among multiple parties',
                    'Sharing with all users violates the principle',
                    'HSM provides security but doesn\'t implement split knowledge'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 37 - Security Principles - L4 Analysis
            [
                'topic_id' => $topics['Security Principles'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze why least privilege is difficult to implement in practice. What is the primary challenge?',
                'options' => [
                    'Technical systems cannot support granular permissions',
                    'Users complain about restricted access affecting productivity',
                    'Determining minimum necessary access requires ongoing analysis',
                    'Administrative overhead is too high'
                ],
                'correct_options' => ['Determining minimum necessary access requires ongoing analysis'],
                'justifications' => [
                    'Most modern systems support granular permissions',
                    'User complaints are a concern but not the primary challenge',
                    'Correct - Job functions change, requiring continuous assessment of access needs',
                    'Administrative overhead is manageable with proper tools'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 38 - Security Principles - L4 Analysis
            [
                'topic_id' => $topics['Security Principles'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze the effectiveness of separation of duties in fraud prevention. What is its primary limitation?',
                'options' => [
                    'It cannot prevent collusion between multiple parties',
                    'It requires too many people to complete simple tasks',
                    'It slows down business processes significantly',
                    'It only works for financial transactions'
                ],
                'correct_options' => ['It cannot prevent collusion between multiple parties'],
                'justifications' => [
                    'Correct - Separation of duties is ineffective when multiple parties conspire',
                    'Proper implementation balances security with efficiency',
                    'Process impact can be managed with good design',
                    'Separation of duties applies to many types of sensitive operations'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 39 - Security Principles - L3 Application
            [
                'topic_id' => $topics['Security Principles'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the trade-off between security principles and operational efficiency. Which approach is most effective?',
                'options' => [
                    'Prioritize security principles regardless of efficiency impact',
                    'Prioritize efficiency and implement security where possible',
                    'Balance security and efficiency based on risk assessment',
                    'Implement security principles only for critical operations'
                ],
                'correct_options' => ['Balance security and efficiency based on risk assessment'],
                'justifications' => [
                    'Rigid security focus may harm business objectives',
                    'Efficiency focus may create unacceptable security risks',
                    'Correct - Risk-based approach balances security needs with business requirements',
                    'Limiting to critical operations may miss important security needs'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 40 - Security Principles - L1 Knowledge
            [
                'topic_id' => $topics['Security Principles'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What does split knowledge mean in security?',
                'options' => [
                    'Dividing sensitive information among multiple people',
                    'Separating different types of knowledge',
                    'Distributing knowledge across departments',
                    'Creating knowledge backup systems'
                ],
                'correct_options' => ['Dividing sensitive information among multiple people'],
                'justifications' => [
                    'Correct - Split knowledge divides critical information so no single person has complete access',
                    'This describes knowledge categorization, not split knowledge',
                    'This describes knowledge distribution, not the security principle',
                    'This describes knowledge redundancy, not split knowledge'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Cybersecurity Frameworks - 10 Questions (Items 41-50)
            
            // Item 41 - Cybersecurity Frameworks - L2 Comprehension
            [
                'topic_id' => $topics['Cybersecurity Frameworks'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which framework consists of Identify, Protect, Detect, Respond, and Recover functions?',
                'options' => [
                    'ISO 27001',
                    'NIST Cybersecurity Framework',
                    'COBIT',
                    'CIS Controls'
                ],
                'correct_options' => ['NIST Cybersecurity Framework'],
                'justifications' => [
                    'ISO 27001 is organized by control domains, not these functions',
                    'Correct - NIST CSF is organized into these five core functions',
                    'COBIT focuses on IT governance processes',
                    'CIS Controls are organized by security control categories'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 42 - Cybersecurity Frameworks - L2 Comprehension
            [
                'topic_id' => $topics['Cybersecurity Frameworks'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of ISO/IEC 27001?',
                'options' => [
                    'To provide technical security controls',
                    'To establish an information security management system',
                    'To define incident response procedures',
                    'To create network security standards'
                ],
                'correct_options' => ['To establish an information security management system'],
                'justifications' => [
                    'ISO 27001 is about management systems, not specific technical controls',
                    'Correct - ISO 27001 defines requirements for an information security management system',
                    'ISO 27001 covers management systems, not specific procedures',
                    'ISO 27001 is not specific to network security'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 43 - Cybersecurity Frameworks - L2 Comprehension
            [
                'topic_id' => $topics['Cybersecurity Frameworks'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization wants third-party certification for their security management system. Which framework should they implement?',
                'options' => [
                    'NIST CSF',
                    'ISO 27001',
                    'CIS Controls',
                    'COBIT'
                ],
                'correct_options' => ['ISO 27001'],
                'justifications' => [
                    'NIST CSF is a framework but not certifiable',
                    'Correct - ISO 27001 is the international standard for certifiable security management systems',
                    'CIS Controls are best practices but not certifiable',
                    'COBIT is for IT governance, not security certification'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 44 - Cybersecurity Frameworks - L2 Comprehension
            [
                'topic_id' => $topics['Cybersecurity Frameworks'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the relationship between COBIT and cybersecurity frameworks?',
                'options' => [
                    'COBIT replaces the need for cybersecurity frameworks',
                    'COBIT provides IT governance context for cybersecurity frameworks',
                    'COBIT and cybersecurity frameworks are completely separate',
                    'COBIT is a subset of cybersecurity frameworks'
                ],
                'correct_options' => ['COBIT provides IT governance context for cybersecurity frameworks'],
                'justifications' => [
                    'COBIT complements rather than replaces cybersecurity frameworks',
                    'Correct - COBIT provides governance structure that cybersecurity frameworks operate within',
                    'They are related and complementary',
                    'COBIT is broader, covering overall IT governance'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 45 - Cybersecurity Frameworks - L5 Evaluation
            [
                'topic_id' => $topics['Cybersecurity Frameworks'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A healthcare organization needs to comply with HIPAA while improving cybersecurity. Which framework combination is most appropriate?',
                'options' => [
                    'NIST CSF only',
                    'ISO 27001 only',
                    'NIST CSF with healthcare-specific guidelines',
                    'CIS Controls with COBIT'
                ],
                'correct_options' => ['NIST CSF with healthcare-specific guidelines'],
                'justifications' => [
                    'NIST CSF alone may not address healthcare-specific requirements',
                    'ISO 27001 alone may not address healthcare compliance needs',
                    'Correct - NIST CSF provides comprehensive cybersecurity with healthcare-specific adaptations',
                    'This combination doesn\'t directly address healthcare compliance'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 46 - Cybersecurity Frameworks - L3 Application
            [
                'topic_id' => $topics['Cybersecurity Frameworks'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A small business wants to implement basic cybersecurity controls cost-effectively. Which framework is most appropriate?',
                'options' => [
                    'Full ISO 27001 implementation',
                    'Complete NIST CSF implementation',
                    'CIS Controls focusing on first six controls',
                    'COBIT full framework'
                ],
                'correct_options' => ['CIS Controls focusing on first six controls'],
                'justifications' => [
                    'Full ISO 27001 may be too complex and expensive for small businesses',
                    'Complete NIST CSF may be overwhelming for small businesses',
                    'Correct - CIS Controls prioritize the most effective controls for small organizations',
                    'COBIT is focused on governance, not practical security controls'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 47 - Cybersecurity Frameworks - L4 Analysis
            [
                'topic_id' => $topics['Cybersecurity Frameworks'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze why organizations struggle with cybersecurity framework implementation. What is the primary challenge?',
                'options' => [
                    'Frameworks are too technically complex',
                    'Frameworks lack specific implementation guidance',
                    'Aligning framework requirements with business objectives',
                    'Frameworks are too expensive to implement'
                ],
                'correct_options' => ['Aligning framework requirements with business objectives'],
                'justifications' => [
                    'Most frameworks are designed to be understandable',
                    'Many frameworks provide implementation guidance',
                    'Correct - The biggest challenge is making frameworks relevant to specific business needs',
                    'Cost is a factor but alignment is the primary challenge'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 48 - Cybersecurity Frameworks - L4 Analysis
            [
                'topic_id' => $topics['Cybersecurity Frameworks'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze the effectiveness of combining multiple frameworks. What is the primary benefit?',
                'options' => [
                    'Demonstrates compliance with more regulations',
                    'Provides comprehensive coverage of different security aspects',
                    'Reduces implementation complexity',
                    'Minimizes audit requirements'
                ],
                'correct_options' => ['Provides comprehensive coverage of different security aspects'],
                'justifications' => [
                    'Compliance is a benefit but not the primary one',
                    'Correct - Different frameworks address different aspects, providing comprehensive coverage',
                    'Multiple frameworks typically increase complexity',
                    'Multiple frameworks may increase audit requirements'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 49 - Cybersecurity Frameworks - L5 Evaluation
            [
                'topic_id' => $topics['Cybersecurity Frameworks'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the long-term effectiveness of cybersecurity frameworks in rapidly changing threat landscapes. What is their primary limitation?',
                'options' => [
                    'They become outdated too quickly',
                    'They focus on processes rather than specific threats',
                    'They are too rigid for modern organizations',
                    'They require too many resources to maintain'
                ],
                'correct_options' => ['They focus on processes rather than specific threats'],
                'justifications' => [
                    'Good frameworks are designed to be adaptable',
                    'Correct - Process focus provides stability but may miss emerging specific threats',
                    'Modern frameworks are designed to be flexible',
                    'Resource requirements are manageable with proper planning'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 50 - Cybersecurity Frameworks - L5 Evaluation
            [
                'topic_id' => $topics['Cybersecurity Frameworks'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the strategic value of cybersecurity frameworks for organizational maturity. What is their greatest contribution?',
                'options' => [
                    'Providing specific technical solutions',
                    'Establishing systematic, repeatable security processes',
                    'Ensuring regulatory compliance',
                    'Reducing cybersecurity costs'
                ],
                'correct_options' => ['Establishing systematic, repeatable security processes'],
                'justifications' => [
                    'Frameworks provide structure, not specific technical solutions',
                    'Correct - Frameworks establish systematic approaches that enable organizational maturity',
                    'Compliance is a benefit but not the primary strategic value',
                    'Frameworks may actually increase costs while improving effectiveness'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 1 (General Security Concepts) diagnostic items seeded successfully!');
        $this->command->info('Distribution: L1:7, L2:10, L3:16, L4:10, L5:7 (50 questions total)');
        $this->command->info('Topics: 5 Pillars (10), Professional Ethics (10), Security Controls (10), Security Principles (10), Cybersecurity Frameworks (10)');
    }
}