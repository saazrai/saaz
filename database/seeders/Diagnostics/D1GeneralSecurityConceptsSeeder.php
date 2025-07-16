<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;
use Illuminate\Database\Seeder;

class D1GeneralSecurityConceptsSeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'General Security Concepts');
        })->pluck('id', 'name');
        
        $items = [
            // CIA Triad - Item 1 (Converting to Level 2)
            [
                'topic_id' => $topics['CIA Triad'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Explain why availability is often the most challenging component of the CIA Triad to maintain in modern distributed systems:',
                'options' => [
                    'Because encryption makes data unavailable to unauthorized users',
                    'Because system dependencies and complexity create multiple failure points',
                    'Because integrity checks slow down system performance',
                    'Because confidentiality controls block legitimate access attempts'
                ],
                'correct_options' => ['Because system dependencies and complexity create multiple failure points'],
                'justifications' => ['In distributed systems, availability becomes challenging due to network dependencies, service interdependencies, and the complexity of maintaining synchronization across multiple components. A failure in any component can cascade and affect overall system availability.'],
                'difficulty_level' => 2,
                'bloom_level' => 2, // Understand level
                'status' => 'published'
            ],
            
            // CIA Triad - Item 10 (Converting to Level 2)
            [
                'topic_id' => $topics['CIA Triad'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Explain the relationship between digital signatures and the CIA Triad. Which components do they primarily support and why?',
                'options' => [
                    'Only confidentiality through encryption',
                    'Only integrity through tamper detection',
                    'Both integrity and authenticity through cryptographic verification',
                    'All three components equally'
                ],
                'correct_options' => ['Both integrity and authenticity through cryptographic verification'],
                'justifications' => [
                    'Digital signatures don\'t provide confidentiality - they verify authenticity and integrity',
                    'Partially correct but digital signatures also provide authenticity verification',
                    'Correct - Digital signatures verify both data integrity and authenticity of the signer',
                    'Digital signatures don\'t directly support availability'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            
            // CIA Triad - Item 14 (Converting to Level 2)
            [
                'topic_id' => $topics['CIA Triad'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze why organizations often face trade-offs between CIA Triad components. What underlying factor drives these conflicts?',
                'options' => [
                    'Limited technical expertise in security teams',
                    'Resource constraints and competing security requirements',
                    'Lack of security awareness in management',
                    'Inadequate security frameworks and standards'
                ],
                'correct_options' => ['Resource constraints and competing security requirements'],
                'justifications' => [
                    'Technical expertise affects implementation quality but not fundamental trade-offs',
                    'Correct - Limited resources force prioritization decisions between security controls that serve different CIA components',
                    'Management awareness affects investment but not the inherent conflicts between controls',
                    'Frameworks help guide decisions but don\'t eliminate resource-driven trade-offs'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Authenticity - Item 16 (Converting to Level 2)
            [
                'topic_id' => $topics['Authenticity'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Explain why biometric authentication provides stronger authenticity assurance compared to password-based authentication:',
                'options' => [
                    'Biometrics are impossible to steal or duplicate',
                    'Biometrics are inherently tied to the individual and difficult to transfer',
                    'Biometric systems never produce false positives or negatives',
                    'Biometrics eliminate the need for any other authentication factors'
                ],
                'correct_options' => ['Biometrics are inherently tied to the individual and difficult to transfer'],
                'justifications' => [
                    'Biometrics can be stolen (fingerprints, photos) and sophisticated attacks can duplicate them',
                    'Correct - The inherent connection between biometric traits and identity makes them much harder to transfer or share',
                    'All biometric systems have error rates and can produce false results',
                    'Biometrics should be combined with other factors for maximum security'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Non-repudiation - Item 46 (Converting to Level 2)
            [
                'topic_id' => $topics['Non-repudiation'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Explain why digital signatures provide stronger non-repudiation than symmetric key-based authentication methods:',
                'options' => [
                    'Digital signatures use longer cryptographic keys',
                    'Private keys are unique to individuals and cannot be shared legitimately',
                    'Digital signatures provide better encryption of the message content',
                    'Asymmetric cryptography is inherently more secure than symmetric'
                ],
                'correct_options' => ['Private keys are unique to individuals and cannot be shared legitimately'],
                'justifications' => [
                    'Key length affects security strength but not the fundamental non-repudiation properties',
                    'Correct - Since only the signer should possess their private key, they cannot credibly deny creating the signature',
                    'Digital signatures verify authenticity/integrity, not message confidentiality',
                    'Security depends on implementation; the key difference is the unique key ownership model'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Non-repudiation - Item 46 (Converting to Level 2)
            [
                'topic_id' => $topics['Non-repudiation'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Analyze why timestamping services are crucial for addressing disputes about when digital signatures were created. What problem do they solve?',
                'options' => [
                    'They encrypt the signature to prevent tampering',
                    'They provide independent verification of signature creation time',
                    'They authenticate the signer\'s identity',
                    'They increase the cryptographic strength of the signature'
                ],
                'correct_options' => ['They provide independent verification of signature creation time'],
                'justifications' => [
                    'Timestamping doesn\'t provide encryption - that\'s done by the signature algorithm',
                    'Correct - Independent timestamp prevents claims of "I was compromised before I signed this"',
                    'Identity authentication is provided by the PKI certificate, not the timestamp',
                    'Timestamps don\'t affect cryptographic strength - they provide temporal proof'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Safety vs Security - Item 19
            [
                'topic_id' => $topics['Safety vs Security'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When implementing security controls for a hospital\'s life support systems, which principle should take precedence?',
                'options' => [
                    'Maximum security regardless of impact',
                    'Human safety over security controls',
                    'Equal balance of safety and security',
                    'Security controls with safety overrides'
                ],
                'correct_options' => ['Human safety over security controls'],
                'justifications' => [
                    'Maximum security could endanger lives if it prevents emergency access',
                    'Correct - Human life must always take precedence over security measures',
                    'Safety should take clear precedence in life-critical systems',
                    'While good, safety should be the primary concern, not an override'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            
            
            // Control Types - Item 21
            [
                'topic_id' => $topics['Control Types'] ?? 5,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each security control with its primary category:',
                'options' => [
                    'items' => [
                        'Security awareness training',
                        'Firewall',
                        'Security guards',
                        'Intrusion detection system',
                        'Acceptable use policy',
                        'Biometric locks'
                    ],
                    'responses' => [
                        'Administrative',
                        'Technical', 
                        'Physical',
                        'Administrative',
                        'Technical',
                        'Physical'
                    ]
                ],
                'correct_options' => [
                    'Firewall' => 'Technical',
                    'Biometric locks' => 'Physical',
                    'Security guards' => 'Physical',
                    'Acceptable use policy' => 'Administrative',
                    'Intrusion detection system' => 'Technical',
                    'Security awareness training' => 'Administrative'
                ],
                'justifications' => [
                    'Firewall' => 'Firewalls are technical/logical controls',
                    'Biometric locks' => 'Biometric locks control physical access',
                    'Security guards' => 'Guards are physical security controls',
                    'Acceptable use policy' => 'Policies are administrative controls',
                    'Intrusion detection system' => 'IDS is a technical monitoring control',
                    'Security awareness training' => 'Training is a procedural/administrative control'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Control Types - Item 21 (Converting to Level 2)
            [
                'topic_id' => $topics['Control Types'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Explain why organizations typically need all three categories of security controls (administrative, technical, and physical) rather than relying on just one type:',
                'options' => [
                    'Regulatory compliance requires all three categories',
                    'Each category addresses different attack vectors and threat sources',
                    'Technical controls are most important but others provide backup',
                    'It makes security appear more comprehensive to stakeholders'
                ],
                'correct_options' => ['Each category addresses different attack vectors and threat sources'],
                'justifications' => [
                    'While some regulations require comprehensive controls, the fundamental reason is risk coverage',
                    'Correct - Human, technological, and physical threats require different types of controls to address effectively',
                    'No single category is inherently most important - threats span all domains',
                    'Appearance is secondary to actual security effectiveness'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Security vs Usability - Item 24
            [
                'topic_id' => $topics['Security vs Usability'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A company requires 20-character complex passwords changed every 30 days. Users are writing passwords on sticky notes. What is the **BEST** solution?',
                'options' => [
                    'Increase password requirements to 25 characters',
                    'Implement password manager with single sign-on',
                    'Add security cameras to monitor desks',
                    'Require passwords be memorized with testing'
                ],
                'correct_options' => ['Implement password manager with single sign-on'],
                'justifications' => [
                    'This worsens the usability problem leading to more insecure behavior',
                    'Correct - This balances security (strong passwords) with usability',
                    'This addresses the symptom, not the root cause',
                    'This is impractical and will reduce productivity'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Security vs Usability - Item 24 (Converting to Level 2)
            [
                'topic_id' => $topics['Security vs Usability'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze why users writing passwords on sticky notes represents a failure in security vs. usability balance. What principle does this violate?',
                'options' => [
                    'Users are inherently careless about security',
                    'Security controls that are too difficult to use correctly will be circumvented',
                    'Password complexity requirements are fundamentally flawed',
                    'Physical security is less important than logical security'
                ],
                'correct_options' => ['Security controls that are too difficult to use correctly will be circumvented'],
                'justifications' => [
                    'This blames users rather than recognizing the systemic design problem',
                    'Correct - When security controls create excessive friction, users will find workarounds that often reduce overall security',
                    'Complexity can be good when implemented with usable tools like password managers',
                    'Physical exposure of passwords creates both physical and logical security risks'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            
            
            
            
            
            
            
            
            
            
            
            // Security Awareness - Item 44
            [
                'topic_id' => $topics['Security Awareness'] ?? 9,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'An effective security awareness program includes multiple components. Drag the ESSENTIAL elements to the drop zone:',
                'options' => [
                    'Executive support',
                    'Expensive training software',
                    'Metrics and measurement',
                    'Punishment for failures',
                    'Regular reinforcement',
                    'Complex technical details',
                    'Tailored content',
                    'One-time training'
                ],
                'correct_options' => [
                    'Executive support',
                    'Metrics and measurement',
                    'Regular reinforcement',
                    'Tailored content'
                ],
                'justifications' => [
                    'Executive support ensures resources and culture',
                    'Expensive software is not essential for effectiveness',
                    'Metrics help measure and improve the program',
                    'Punishment creates fear, not security awareness',
                    'Regular reinforcement maintains awareness levels',
                    'Technical complexity reduces comprehension',
                    'Content must be relevant to user roles',
                    'One-time training quickly becomes outdated'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Additional Level 1 questions (REMEMBER) - Adding 4 questions as requested
            [
                'topic_id' => $topics['CIA Triad'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does the "C" in CIA Triad stand for?',
                'options' => [
                    'Confidentiality',
                    'Consistency',
                    'Centralization',
                    'Certification'
                ],
                'correct_options' => ['Confidentiality'],
                'justifications' => [
                    'Correct - Confidentiality is the first component of the CIA Triad',
                    'Incorrect - Consistency is not part of the CIA Triad',
                    'Incorrect - Centralization is not part of the CIA Triad',
                    'Incorrect - Certification is not part of the CIA Triad'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Control Types'] ?? 5,
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
                    'Incorrect - Administrative controls are policies and procedures',
                    'Incorrect - Physical controls protect physical assets',
                    'Correct - Firewalls are technical/logical security controls',
                    'Incorrect - Operational is not a standard control type category'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Authenticity'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does authenticity in security refer to?',
                'options' => [
                    'Verifying the identity of users or systems',
                    'Ensuring data is not modified',
                    'Keeping information confidential',
                    'Maintaining system availability'
                ],
                'correct_options' => ['Verifying the identity of users or systems'],
                'justifications' => [
                    'Correct - Authenticity confirms that users or systems are who they claim to be',
                    'Incorrect - This describes integrity, not authenticity',
                    'Incorrect - This describes confidentiality, not authenticity',
                    'Incorrect - This describes availability, not authenticity'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Non-repudiation'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of non-repudiation in security?',
                'options' => [
                    'Preventing denial of actions or communications',
                    'Ensuring data confidentiality',
                    'Maintaining system availability',
                    'Controlling access to resources'
                ],
                'correct_options' => ['Preventing denial of actions or communications'],
                'justifications' => [
                    'Correct - Non-repudiation prevents users from denying they performed an action',
                    'Incorrect - This describes confidentiality, not non-repudiation',
                    'Incorrect - This describes availability, not non-repudiation',
                    'Incorrect - This describes access control, not non-repudiation'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Threat Landscape - Item 32
            [
                'topic_id' => $topics['Threat Landscape'] ?? 10,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which characteristic distinguishes Advanced Persistent Threats (APTs) from common malware?',
                'options' => [
                    'They use encryption',
                    'They target specific organizations long-term',
                    'They spread quickly across networks',
                    'They demand ransom payments'
                ],
                'correct_options' => ['They target specific organizations long-term'],
                'justifications' => [
                    'Many types of malware use encryption',
                    'Correct - APTs are characterized by targeted, long-term campaigns',
                    'APTs typically move slowly and stealthily, not quickly',
                    'This describes ransomware, not necessarily APTs'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Threat Landscape - Item 33
            [
                'topic_id' => $topics['Threat Landscape'] ?? 10,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each threat actor with their typical primary motivation:',
                'options' => [
                    'items' => [
                        'Nation-state actors',
                        'Hacktivists',
                        'Cybercriminals',
                        'Script kiddies'
                    ],
                    'responses' => [
                        'Financial gain',
                        'Political/ideological goals',
                        'Espionage/strategic advantage',
                        'Recognition/curiosity'
                    ]
                ],
                'correct_options' => [
                    'Hacktivists' => 'Political/ideological goals',
                    'Cybercriminals' => 'Financial gain',
                    'Script kiddies' => 'Recognition/curiosity',
                    'Nation-state actors' => 'Espionage/strategic advantage'
                ],
                'justifications' => [
                    'Hacktivists' => 'Hacktivists are motivated by political or ideological causes',
                    'Cybercriminals' => 'Cybercriminals primarily seek monetary profit',
                    'Script kiddies' => 'Script kiddies often seek recognition or act out of curiosity',
                    'Nation-state actors' => 'Nation-states seek intelligence and strategic advantages'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Threat Landscape - Item 34
            [
                'topic_id' => $topics['Threat Landscape'] ?? 10,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which trends are currently shaping the threat landscape? (Select all that apply)',
                'options' => [
                    'Increase in supply chain attacks',
                    'Decrease in ransomware incidents',
                    'Growth of AI-powered attacks',
                    'Reduction in nation-state activity',
                    'Rise in cloud-targeted attacks',
                    'Decline in phishing effectiveness'
                ],
                'correct_options' => ['Increase in supply chain attacks', 'Growth of AI-powered attacks', 'Rise in cloud-targeted attacks'],
                'justifications' => [
                    'Correct - Supply chain attacks have increased significantly',
                    'Incorrect - Ransomware continues to grow',
                    'Correct - AI is increasingly used in sophisticated attacks',
                    'Incorrect - Nation-state activity remains high',
                    'Correct - Cloud infrastructure is increasingly targeted',
                    'Incorrect - Phishing remains highly effective'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // BLOOM LEVEL 2 QUESTIONS (UNDERSTAND) - Adding 2 questions
            [
                'topic_id' => $topics['Defense in Depth'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How does the principle of defense in depth improve overall security posture?',
                'options' => [
                    'By creating multiple layers of security controls',
                    'By using only the strongest security control',
                    'By eliminating all security vulnerabilities',
                    'By focusing security efforts on the perimeter'
                ],
                'correct_options' => ['By creating multiple layers of security controls'],
                'justifications' => [
                    'Correct - Defense in depth uses multiple independent layers of security',
                    'Incorrect - Single controls can fail, multiple layers provide redundancy',
                    'Incorrect - Complete elimination of vulnerabilities is impossible',
                    'Incorrect - Perimeter-only security ignores internal threats'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Controls'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the relationship between preventive, detective, and corrective controls?',
                'options' => [
                    'They are completely independent and serve different purposes',
                    'They work together in a layered security approach',
                    'Preventive controls eliminate the need for detective controls',
                    'Corrective controls are only needed when preventive controls fail'
                ],
                'correct_options' => ['They work together in a layered security approach'],
                'justifications' => [
                    'Incorrect - While serving different purposes, they complement each other',
                    'Correct - All three types work together to provide comprehensive security',
                    'Incorrect - No preventive control is 100% effective',
                    'Incorrect - Corrective controls address incidents from various sources'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // BLOOM LEVEL 3 QUESTIONS (APPLY) - Adding 16 questions
            [
                'topic_id' => $topics['CIA Triad'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A database containing customer records becomes corrupted during a power outage. Which CIA principle is primarily compromised?',
                'options' => [
                    'Confidentiality',
                    'Integrity',
                    'Availability',
                    'Non-repudiation'
                ],
                'correct_options' => ['Integrity'],
                'justifications' => [
                    'Incorrect - Data disclosure is not mentioned in this scenario',
                    'Correct - Data corruption compromises the accuracy and trustworthiness of data',
                    'Incorrect - The database can still be accessed, just with corrupted data',
                    'Incorrect - Non-repudiation relates to proving actions occurred'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Risk Management'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your organization faces a high-impact, low-probability cyber attack scenario. What risk treatment strategy would be most appropriate?',
                'options' => [
                    'Risk acceptance - the probability is too low to worry about',
                    'Risk avoidance - eliminate all systems that could be targeted',
                    'Risk mitigation - implement layered security controls',
                    'Risk transfer - purchase cyber insurance coverage'
                ],
                'correct_options' => ['Risk mitigation - implement layered security controls'],
                'justifications' => [
                    'Incorrect - High impact scenarios require proactive measures regardless of probability',
                    'Incorrect - Eliminating all systems would severely impact business operations',
                    'Correct - Layered controls reduce both likelihood and impact of high-impact threats',
                    'Partially correct but incomplete - insurance transfers financial risk but not operational impact'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Defense in Depth'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Applying defense in depth principles, which combination provides the strongest protection for a web application?',
                'options' => [
                    'Web Application Firewall (WAF) only',
                    'WAF + Input validation + Database encryption',
                    'Strong authentication + HTTPS encryption',
                    'Network firewall + Antivirus software'
                ],
                'correct_options' => ['WAF + Input validation + Database encryption'],
                'justifications' => [
                    'Incorrect - Single layer of protection violates defense in depth',
                    'Correct - Multiple complementary layers addressing different attack vectors',
                    'Incorrect - Only addresses authentication and transport, not application vulnerabilities',
                    'Incorrect - Network-level protection insufficient for application-specific threats'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Controls'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A security incident involving unauthorized data access has occurred. Which sequence of control activation is most appropriate?',
                'options' => [
                    'Preventive → Detective → Corrective',
                    'Detective → Corrective → Preventive',
                    'Corrective → Preventive → Detective',
                    'All controls should activate simultaneously'
                ],
                'correct_options' => ['Detective → Corrective → Preventive'],
                'justifications' => [
                    'Incorrect - Preventive controls should have already been in place',
                    'Correct - Detect the incident, correct the immediate issue, then improve prevention',
                    'Incorrect - Must detect the incident before taking corrective action',
                    'Incorrect - Controls have different activation timing in incident response'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Threat Modeling'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When conducting threat modeling for a new e-commerce application, which approach would identify the most relevant threats?',
                'options' => [
                    'Focus only on external threats from the internet',
                    'Use STRIDE methodology to systematically identify threats',
                    'Copy threat models from similar applications',
                    'Focus only on the most probable threats'
                ],
                'correct_options' => ['Use STRIDE methodology to systematically identify threats'],
                'justifications' => [
                    'Incorrect - Internal threats and supply chain risks are also significant',
                    'Correct - STRIDE provides systematic coverage of threat categories',
                    'Incorrect - Each application has unique characteristics requiring custom analysis',
                    'Incorrect - Low-probability, high-impact threats should also be considered'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Controls'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your organization needs to implement access controls for a new cloud-based HR system. How should you apply the principle of least privilege?',
                'options' => [
                    'Give all employees read access to promote transparency',
                    'Grant minimum necessary permissions based on job function',
                    'Provide admin access to all IT staff for efficiency',
                    'Use the same permissions as the previous HR system'
                ],
                'correct_options' => ['Grant minimum necessary permissions based on job function'],
                'justifications' => [
                    'Incorrect - HR data contains sensitive personal information requiring restricted access',
                    'Correct - Least privilege grants only the minimum access needed for job functions',
                    'Incorrect - Admin access should be limited to those who specifically need it',
                    'Incorrect - New systems require fresh evaluation of access requirements'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['CIA Triad'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A financial services company needs to ensure transaction data cannot be altered after processing. Which CIA principle and implementation approach is most appropriate?',
                'options' => [
                    'Confidentiality - Encrypt all transaction data',
                    'Integrity - Implement digital signatures and audit logs',
                    'Availability - Use redundant database systems',
                    'All three - Implement comprehensive security controls'
                ],
                'correct_options' => ['Integrity - Implement digital signatures and audit logs'],
                'justifications' => [
                    'Incorrect - Encryption protects confidentiality, not alteration prevention',
                    'Correct - Digital signatures and audit logs specifically prevent and detect unauthorized changes',
                    'Incorrect - Redundancy improves availability but not integrity',
                    'Incorrect - While comprehensive security is good, the specific requirement is for integrity'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Defense in Depth'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'An organization wants to protect against advanced persistent threats (APTs). Which defense in depth strategy would be most effective?',
                'options' => [
                    'Focus on perimeter security with advanced firewalls',
                    'Implement behavioral analysis and zero trust architecture',
                    'Rely on antivirus and endpoint protection only',
                    'Use network segmentation exclusively'
                ],
                'correct_options' => ['Implement behavioral analysis and zero trust architecture'],
                'justifications' => [
                    'Incorrect - APTs often bypass perimeter security through social engineering',
                    'Correct - Behavioral analysis detects unusual activity, zero trust limits lateral movement',
                    'Incorrect - APTs use sophisticated techniques that evade traditional signature-based detection',
                    'Incorrect - Segmentation helps but is insufficient alone against APT lateral movement'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Risk Management'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A small business cannot afford enterprise-grade security solutions but faces real cyber threats. How should they apply risk management principles?',
                'options' => [
                    'Accept all risks due to budget constraints',
                    'Focus on the highest impact, most probable threats first',
                    'Purchase cyber insurance and rely on that alone',
                    'Wait until they can afford comprehensive solutions'
                ],
                'correct_options' => ['Focus on the highest impact, most probable threats first'],
                'justifications' => [
                    'Incorrect - Even with limited budget, some risks must be addressed',
                    'Correct - Risk-based prioritization maximizes security ROI with limited resources',
                    'Incorrect - Insurance transfers financial risk but doesn\'t prevent incidents',
                    'Incorrect - Waiting increases exposure time and may lead to incidents'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Threat Modeling'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'During threat modeling of a mobile banking app, you identify that client-side data storage could be compromised. What mitigation strategy should you recommend?',
                'options' => [
                    'Store all sensitive data on the client device encrypted',
                    'Minimize local storage and use server-side sessions',
                    'Rely on mobile device built-in security features',
                    'Implement strong user authentication only'
                ],
                'correct_options' => ['Minimize local storage and use server-side sessions'],
                'justifications' => [
                    'Incorrect - Client-side storage inherently increases attack surface even when encrypted',
                    'Correct - Reducing client-side data minimizes exposure if device is compromised',
                    'Incorrect - Built-in features vary by device and may have vulnerabilities',
                    'Incorrect - Authentication doesn\'t protect data if device is physically compromised'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Controls'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A company needs to implement security controls for a new IoT device deployment. Which combination addresses the unique IoT security challenges?',
                'options' => [
                    'Network firewalls and antivirus software',
                    'Device authentication, encrypted communication, and lifecycle management',
                    'Physical security and access control lists',
                    'Traditional endpoint security solutions'
                ],
                'correct_options' => ['Device authentication, encrypted communication, and lifecycle management'],
                'justifications' => [
                    'Incorrect - Traditional network security doesn\'t address IoT-specific challenges',
                    'Correct - Addresses device identity, communication security, and long-term management',
                    'Incorrect - Physical security alone insufficient for networked IoT devices',
                    'Incorrect - Traditional endpoint solutions often incompatible with IoT constraints'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Defense in Depth'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'An organization experiences a ransomware attack that bypassed their perimeter defenses. Which additional defense-in-depth layers should they prioritize?',
                'options' => [
                    'Stronger perimeter firewalls and intrusion detection',
                    'Endpoint detection and response with behavioral analysis',
                    'Employee training and email filtering',
                    'All of the above in equal priority'
                ],
                'correct_options' => ['Endpoint detection and response with behavioral analysis'],
                'justifications' => [
                    'Incorrect - Since perimeter was already bypassed, strengthening it alone is insufficient',
                    'Correct - EDR with behavioral analysis can detect ransomware activities after perimeter bypass',
                    'Partially correct but insufficient - addresses initial infection vector but not response',
                    'Incorrect - Resources should be prioritized based on the specific attack vector experienced'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['CIA Triad'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A healthcare organization must balance patient care efficiency with security requirements. How should they prioritize the CIA triad?',
                'options' => [
                    'Availability first, then confidentiality, then integrity',
                    'Confidentiality first due to HIPAA requirements',
                    'All three equally with context-specific implementations',
                    'Integrity first to ensure accurate medical records'
                ],
                'correct_options' => ['All three equally with context-specific implementations'],
                'justifications' => [
                    'Incorrect - While availability is critical for patient care, confidentiality and integrity are equally important',
                    'Incorrect - HIPAA requires all three aspects of the CIA triad',
                    'Correct - Healthcare requires balancing all three with appropriate controls for each situation',
                    'Incorrect - While integrity is crucial, availability during emergencies can be life-critical'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Risk Management'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your organization identifies a new vulnerability in a critical system. The vendor patch won\'t be available for 60 days. What risk treatment approach should you apply?',
                'options' => [
                    'Accept the risk and wait for the vendor patch',
                    'Implement compensating controls and monitoring',
                    'Immediately shut down the affected system',
                    'Transfer the risk through insurance only'
                ],
                'correct_options' => ['Implement compensating controls and monitoring'],
                'justifications' => [
                    'Incorrect - Accepting risk of a known vulnerability in critical systems is inappropriate',
                    'Correct - Compensating controls reduce risk while maintaining business operations',
                    'Incorrect - Shutting down critical systems may cause more harm than the vulnerability',
                    'Incorrect - Insurance doesn\'t prevent the incident, only transfers financial consequences'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Threat Modeling'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'You\'re threat modeling a cloud-based collaboration platform. Which threat scenario should receive the highest priority?',
                'options' => [
                    'Distributed denial of service attacks',
                    'Unauthorized access to shared documents',
                    'Data breaches due to misconfigurations',
                    'Insider threats from privileged users'
                ],
                'correct_options' => ['Data breaches due to misconfigurations'],
                'justifications' => [
                    'Incorrect - DDoS affects availability but cloud platforms typically have DDoS protection',
                    'Partially correct but access controls are typically well-understood',
                    'Correct - Cloud misconfigurations are common and can expose large amounts of data',
                    'Partially correct but insider threats require different controls than technical misconfigurations'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Controls'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A financial institution needs to implement controls for a new payment processing system. Which control combination best addresses regulatory requirements?',
                'options' => [
                    'Technical controls only (encryption, authentication)',
                    'Administrative controls only (policies, procedures)',
                    'Physical controls only (secure facilities, hardware)',
                    'Integrated technical, administrative, and physical controls'
                ],
                'correct_options' => ['Integrated technical, administrative, and physical controls'],
                'justifications' => [
                    'Incorrect - Technical controls alone don\'t address all regulatory requirements',
                    'Incorrect - Policies without technical implementation are insufficient',
                    'Incorrect - Physical security alone doesn\'t address digital payment threats',
                    'Correct - Financial regulations require comprehensive controls across all categories'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // BLOOM LEVEL 4 QUESTIONS (ANALYZE) - Adding 10 questions
            [
                'topic_id' => $topics['CIA Triad'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Analyze this scenario: A company\'s backup system fails during a cyberattack, customer data is stolen, and some records are corrupted. Rank the CIA impacts from most to least severe.',
                'options' => [
                    'Confidentiality > Availability > Integrity',
                    'Availability > Confidentiality > Integrity',
                    'Integrity > Confidentiality > Availability',
                    'Confidentiality > Integrity > Availability'
                ],
                'correct_options' => ['Confidentiality > Integrity > Availability'],
                'justifications' => [
                    'Incorrect - Data corruption (integrity) typically has longer-term impact than temporary unavailability',
                    'Incorrect - Stolen data (confidentiality breach) often has the most severe long-term consequences',
                    'Incorrect - While integrity is critical, data theft often has broader impact including legal liability',
                    'Correct - Data theft creates immediate legal/reputation risk, corruption affects trust, downtime is temporary'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Risk Management'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze the effectiveness of these risk mitigation strategies for a supply chain attack. Which provides the most comprehensive protection?',
                'options' => [
                    'Vendor security assessments and contractual requirements',
                    'Code signing verification and software composition analysis',
                    'Network segmentation and zero-trust architecture',
                    'All strategies combined with continuous monitoring'
                ],
                'correct_options' => ['All strategies combined with continuous monitoring'],
                'justifications' => [
                    'Partially effective - Addresses vendor selection but not technical verification',
                    'Partially effective - Technical verification but doesn\'t address vendor processes',
                    'Partially effective - Limits impact but doesn\'t prevent initial compromise',
                    'Correct - Supply chain attacks require multi-layered approach addressing all attack vectors'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Defense in Depth'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Analyze why a defense-in-depth strategy failed to prevent a data breach. The attacker used: phishing → credential theft → lateral movement → data exfiltration. Which layer was most critical to strengthen?',
                'options' => [
                    'Email security to prevent phishing',
                    'Multi-factor authentication to prevent credential theft',
                    'Network segmentation to prevent lateral movement',
                    'Data loss prevention to prevent exfiltration'
                ],
                'correct_options' => ['Multi-factor authentication to prevent credential theft'],
                'justifications' => [
                    'Important but reactive - phishing awareness has limited effectiveness against sophisticated attacks',
                    'Correct - MFA would break the attack chain early, preventing subsequent stages',
                    'Important but late in chain - attacker already has legitimate credentials',
                    'Important but last line of defense - better to stop attack earlier in chain'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Threat Modeling'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Compare the effectiveness of threat modeling approaches for a microservices architecture. Which methodology would identify the most relevant security issues?',
                'options' => [
                    'STRIDE applied to each individual microservice',
                    'PASTA focusing on business objectives and data flows',
                    'Attack trees modeling service interdependencies',
                    'Hybrid approach combining multiple methodologies'
                ],
                'correct_options' => ['Hybrid approach combining multiple methodologies'],
                'justifications' => [
                    'Limited - Misses inter-service communication and orchestration threats',
                    'Good for business alignment but may miss technical implementation details',
                    'Good for dependency analysis but may miss business context',
                    'Correct - Microservices complexity requires multiple perspectives to be comprehensive'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Controls'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the security control effectiveness for a remote work scenario. Which control provides the highest risk reduction for the least cost?',
                'options' => [
                    'VPN with multi-factor authentication',
                    'Endpoint detection and response software',
                    'Security awareness training for remote workers',
                    'Cloud-based email security with sandbox analysis'
                ],
                'correct_options' => ['VPN with multi-factor authentication'],
                'justifications' => [
                    'Correct - Addresses the fundamental remote access risk with proven, cost-effective technology',
                    'Important but more expensive and addresses post-compromise rather than prevention',
                    'Important but relies on human behavior which is inherently variable',
                    'Addresses specific attack vector but doesn\'t secure the overall remote connection'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['CIA Triad'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Analyze the CIA triad implications of implementing a zero-trust architecture. Which aspect presents the greatest implementation challenge?',
                'options' => [
                    'Confidentiality - encrypting all communications',
                    'Integrity - ensuring data hasn\'t been tampered with',
                    'Availability - maintaining performance with additional security checks',
                    'All three present equal challenges'
                ],
                'correct_options' => ['Availability - maintaining performance with additional security checks'],
                'justifications' => [
                    'Moderate challenge - Encryption is well-understood and standardized',
                    'Moderate challenge - Integrity checks are established practices',
                    'Correct - Zero-trust adds latency and complexity that can significantly impact user experience',
                    'Incorrect - Availability challenges are typically most significant in zero-trust implementations'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Risk Management'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze the risk treatment decision for a cloud migration project. The organization is concerned about data sovereignty and vendor lock-in. Which strategy best balances these concerns?',
                'options' => [
                    'Single cloud provider with comprehensive SLAs',
                    'Multi-cloud strategy with data replication',
                    'Hybrid cloud with sensitive data on-premises',
                    'Private cloud implementation only'
                ],
                'correct_options' => ['Hybrid cloud with sensitive data on-premises'],
                'justifications' => [
                    'Doesn\'t address data sovereignty concerns or vendor lock-in',
                    'Reduces vendor lock-in but increases complexity and may not address sovereignty',
                    'Correct - Addresses both sovereignty (sensitive data controlled) and reduces vendor dependence',
                    'Avoids cloud risks but eliminates cloud benefits and may be cost-prohibitive'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Defense in Depth'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate the defense-in-depth strategy for protecting against AI-powered attacks. Which layer provides the most effective defense against adversarial machine learning?',
                'options' => [
                    'Input validation and sanitization',
                    'Behavioral analysis and anomaly detection',
                    'Model versioning and rollback capabilities',
                    'Human oversight and review processes'
                ],
                'correct_options' => ['Behavioral analysis and anomaly detection'],
                'justifications' => [
                    'Limited effectiveness - AI attacks can craft inputs that pass traditional validation',
                    'Correct - Behavioral analysis can detect the subtle patterns of AI-generated attacks',
                    'Important for recovery but doesn\'t prevent or detect attacks',
                    'Important but may not scale or detect sophisticated AI-generated attacks in real-time'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Threat Modeling'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Compare threat modeling approaches for a machine learning system that processes personal data. Which threat category requires the most attention?',
                'options' => [
                    'Model inversion attacks revealing training data',
                    'Adversarial examples causing misclassification',
                    'Data poisoning during model training',
                    'Traditional application security vulnerabilities'
                ],
                'correct_options' => ['Model inversion attacks revealing training data'],
                'justifications' => [
                    'Correct - With personal data, privacy breaches through model inversion have the highest regulatory and reputational impact',
                    'Important but typically affects system functionality rather than privacy',
                    'Critical but often detected during model validation phases',
                    'Important but well-understood compared to ML-specific threats'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Controls'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze the security control requirements for a financial services merger. Which integration challenge poses the highest security risk?',
                'options' => [
                    'Harmonizing different security policies and procedures',
                    'Integrating disparate identity and access management systems',
                    'Consolidating security monitoring and incident response',
                    'Managing data classification during system integration'
                ],
                'correct_options' => ['Integrating disparate identity and access management systems'],
                'justifications' => [
                    'Important but primarily a governance issue rather than immediate security risk',
                    'Correct - IAM integration errors can create immediate access control vulnerabilities',
                    'Important but typically doesn\'t create immediate vulnerabilities',
                    'Critical but usually involves careful planning that mitigates immediate risks'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // BLOOM LEVEL 5 QUESTIONS (EVALUATE) - Adding 7 questions
            [
                'topic_id' => $topics['CIA Triad'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the long-term strategic implications of prioritizing availability over confidentiality for a social media platform. What are the most significant consequences?',
                'options' => [
                    'Improved user experience leading to higher engagement',
                    'Increased regulatory scrutiny and potential legal liability',
                    'Competitive advantage through better service reliability',
                    'Enhanced reputation for technical excellence'
                ],
                'correct_options' => ['Increased regulatory scrutiny and potential legal liability'],
                'justifications' => [
                    'Short-term benefit but overshadowed by privacy risks',
                    'Correct - Privacy regulations globally are increasing penalties for data mishandling',
                    'Temporary advantage that could be lost due to privacy incidents',
                    'Technical reputation means little if user privacy is compromised'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Risk Management'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the effectiveness of current industry approaches to supply chain risk management. What fundamental paradigm shift is most needed?',
                'options' => [
                    'Increased vendor security assessments and auditing',
                    'Transition from trust-based to verification-based relationships',
                    'Greater investment in supply chain monitoring technologies',
                    'Standardization of security requirements across industries'
                ],
                'correct_options' => ['Transition from trust-based to verification-based relationships'],
                'justifications' => [
                    'Incremental improvement but doesn\'t address fundamental trust assumptions',
                    'Correct - "Trust but verify" approach addresses the core issue of assumed vendor security',
                    'Technological solution but doesn\'t address relationship and process fundamentals',
                    'Helpful but doesn\'t change the fundamental trust paradigm'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Defense in Depth'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate the evolution of defense-in-depth strategies for cloud-native applications. Which traditional layer is becoming least relevant?',
                'options' => [
                    'Network perimeter security',
                    'Host-based security controls',
                    'Application-level security',
                    'Data-level security controls'
                ],
                'correct_options' => ['Network perimeter security'],
                'justifications' => [
                    'Correct - Cloud-native apps with microservices and dynamic scaling make traditional perimeters ineffective',
                    'Still relevant - Containers and serverless still need host-level protections',
                    'Increasingly important - Application security is critical for cloud-native architectures',
                    'More important than ever - Data protection remains fundamental'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Threat Modeling'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate the adequacy of current threat modeling methodologies for quantum computing environments. What is the most significant gap?',
                'options' => [
                    'Lack of quantum-specific attack vectors in existing frameworks',
                    'Insufficient consideration of cryptographic obsolescence timelines',
                    'Absence of quantum supremacy impact assessments',
                    'Limited integration with post-quantum cryptography planning'
                ],
                'correct_options' => ['Insufficient consideration of cryptographic obsolescence timelines'],
                'justifications' => [
                    'Important but existing frameworks can be extended with new attack vectors',
                    'Correct - Current methodologies don\'t adequately address the timing of quantum threats to existing crypto',
                    'Important but more of a strategic planning issue than threat modeling gap',
                    'Implementation detail rather than fundamental methodology gap'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Controls'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the long-term sustainability of current security control frameworks for autonomous systems. Which aspect requires the most fundamental rethinking?',
                'options' => [
                    'Human oversight and accountability mechanisms',
                    'Real-time decision-making algorithms',
                    'Ethical considerations in automated responses',
                    'Integration with existing security infrastructures'
                ],
                'correct_options' => ['Human oversight and accountability mechanisms'],
                'justifications' => [
                    'Correct - Autonomous systems challenge traditional human-in-the-loop security models',
                    'Technical challenge but existing AI/ML frameworks provide foundation',
                    'Important but typically addressed through policy rather than control frameworks',
                    'Technical integration challenge but doesn\'t require fundamental rethinking'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['CIA Triad'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate whether the CIA triad remains sufficient for emerging technologies like brain-computer interfaces. What additional security principle is most critical?',
                'options' => [
                    'Cognitive liberty - protecting mental autonomy',
                    'Temporal integrity - ensuring consistent data across time',
                    'Contextual privacy - protecting inference-based insights',
                    'Quantum uncertainty - handling probabilistic security states'
                ],
                'correct_options' => ['Cognitive liberty - protecting mental autonomy'],
                'justifications' => [
                    'Correct - Brain-computer interfaces introduce unprecedented concerns about mental autonomy and cognitive freedom',
                    'Important but typically covered under traditional integrity principles',
                    'Important but extension of existing privacy concepts',
                    'Relevant for quantum systems but not specifically for brain-computer interfaces'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Risk Management'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the societal implications of AI-driven automated risk management decisions in critical infrastructure. What is the primary ethical concern?',
                'options' => [
                    'Algorithmic bias affecting different communities unequally',
                    'Lack of transparency in automated decision-making processes',
                    'Potential for cascading failures across interconnected systems',
                    'Erosion of human expertise in critical decision-making'
                ],
                'correct_options' => ['Algorithmic bias affecting different communities unequally'],
                'justifications' => [
                    'Correct - Biased risk algorithms can systematically disadvantage certain populations in critical services',
                    'Important but primarily a governance rather than ethical issue',
                    'Technical risk rather than ethical concern',
                    'Important but doesn\'t raise the same equity and justice concerns as bias'
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
    }
}