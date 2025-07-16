<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D2InformationSecurityGovernanceSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing items for this domain to prevent duplicates
        DiagnosticItem::whereHas('topic.domain', function($query) {
            $query->where('name', 'Information Security Governance');
        })->forceDelete();
        
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Information Security Governance');
        })->pluck('id', 'name');
        
        
        $items = [
            // Security Roles & Responsibilities - Item 1
            [
                'topic_id' => $topics['Security Roles & Responsibilities'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Who is ULTIMATELY responsible for information security in an organization?',
                'options' => [
                    'Chief Information Security Officer (CISO)',
                    'Board of Directors and Senior Management',
                    'IT Department',
                    'All employees'
                ],
                'correct_options' => ['Board of Directors and Senior Management'],
                'justifications' => [
                    'The CISO executes security strategy but is not ultimately responsible',
                    'Correct - The board and senior management have ultimate accountability for all organizational risks including security',
                    'IT implements security but does not have ultimate responsibility',
                    'While everyone has security responsibilities, ultimate accountability rests at the top'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Security Roles & Responsibilities - Item 2
            [
                'topic_id' => $topics['Security Roles & Responsibilities'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the PRIMARY role of a Data Protection Officer (DPO) under GDPR?',
                'options' => [
                    'Implementing technical security controls',
                    'Monitoring compliance with data protection regulations',
                    'Managing the IT security team',
                    'Conducting security awareness training'
                ],
                'correct_options' => ['Monitoring compliance with data protection regulations'],
                'justifications' => [
                    'DPOs focus on compliance, not technical implementation',
                    'Correct - The DPO ensures the organization complies with data protection laws and regulations',
                    'DPOs are independent and do not manage security teams',
                    'While DPOs may support awareness, their primary role is compliance monitoring'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Security Roles & Responsibilities - Item 3
            [
                'topic_id' => $topics['Security Roles & Responsibilities'] ?? 11,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each security role with their primary responsibility:',
                'options' => [
                    'items' => [
                        'CISO',
                        'Data Owner',
                        'Data Custodian',
                        'Security Auditor'
                    ],
                    'responses' => [
                        'Implements security controls for data',
                        'Determines data classification and access',
                        'Develops security strategy and policies',
                        'Independently assesses security effectiveness'
                    ]
                ],
                'correct_options' => [
                    'CISO' => 'Develops security strategy and policies',
                    'Data Owner' => 'Determines data classification and access',
                    'Data Custodian' => 'Implements security controls for data',
                    'Security Auditor' => 'Independently assesses security effectiveness'
                ],
                'justifications' => [
                    'CISO' => 'The CISO is responsible for overall security strategy and policy development',
                    'Data Owner' => 'Data owners make decisions about data classification and who can access it',
                    'Data Custodian' => 'Custodians implement the controls specified by data owners',
                    'Security Auditor' => 'Auditors provide independent assessment of security controls'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Security Roles & Responsibilities - Item 4
            [
                'topic_id' => $topics['Security Roles & Responsibilities'] ?? 11,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** The Chief Information Officer (CIO) and Chief Information Security Officer (CISO) roles should be combined to ensure better coordination.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. These roles should be separate to avoid conflicts of interest. The CIO focuses on IT service delivery and efficiency, while the CISO focuses on security and risk management. Combining them could compromise security decisions in favor of operational efficiency.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Security Roles & Responsibilities - Item 5
            [
                'topic_id' => $topics['Security Roles & Responsibilities'] ?? 11,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these roles in order of accountability hierarchy from HIGHEST to LOWEST:',
                'options' => [
                    'Security Administrator',
                    'Chief Executive Officer',
                    'Data Custodian',
                    'Board of Directors',
                    'Chief Information Security Officer'
                ],
                'correct_options' => [
                    'Board of Directors',
                    'Chief Executive Officer',
                    'Chief Information Security Officer',
                    'Security Administrator',
                    'Data Custodian'
                ],
                'justifications' => ['The board has ultimate accountability, followed by CEO, then CISO who reports to executive management, then administrators and custodians who implement controls.'],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Policy, Standard, Procedure, Guideline - Item 6
            [
                'topic_id' => $topics['Policy, Standard, Procedure, Guideline'] ?? 12,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which document type is MANDATORY and specifies high-level security requirements?',
                'options' => [
                    'Security guidelines',
                    'Security procedures',
                    'Security policies',
                    'Security baselines'
                ],
                'correct_options' => ['Security policies'],
                'justifications' => [
                    'Guidelines are recommended practices, not mandatory',
                    'Procedures are mandatory but detail how to implement policies',
                    'Correct - Policies are mandatory high-level statements of management intent',
                    'Baselines are specific standards, not high-level requirements'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Policy, Standard, Procedure, Guideline - Item 7
            [
                'topic_id' => $topics['Policy, Standard, Procedure, Guideline'] ?? 12,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the document types that are MANDATORY to the drop zone:',
                'options' => [
                    'Information Security Policy',
                    'Security Best Practices Guide',
                    'Password Standards',
                    'Security Awareness Tips',
                    'Incident Response Procedures',
                    'Encryption Guidelines'
                ],
                'correct_options' => [
                    'Information Security Policy',
                    'Password Standards',
                    'Incident Response Procedures'
                ],
                'justifications' => [
                    'Policies are mandatory high-level requirements',
                    'Best practices are recommendations, not mandatory',
                    'Standards are mandatory specific requirements',
                    'Tips are helpful suggestions, not requirements',
                    'Procedures are mandatory step-by-step instructions',
                    'Guidelines are recommended approaches, not mandatory'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Policy, Standard, Procedure, Guideline - Item 8
            [
                'topic_id' => $topics['Policy, Standard, Procedure, Guideline'] ?? 12,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each example with the correct document type:',
                'options' => [
                    'items' => [
                        '"All systems must use AES-256 encryption"',
                        '"The organization shall protect information assets"',
                        '"Consider using passphrases for better security"',
                        '"To reset a password: 1) Click forgot password 2) Enter email..."'
                    ],
                    'responses' => [
                        'Policy',
                        'Standard',
                        'Procedure',
                        'Guideline'
                    ]
                ],
                'correct_options' => [
                    '"All systems must use AES-256 encryption"' => 'Standard',
                    '"The organization shall protect information assets"' => 'Policy',
                    '"Consider using passphrases for better security"' => 'Guideline',
                    '"To reset a password: 1) Click forgot password 2) Enter email..."' => 'Procedure'
                ],
                'justifications' => [
                    '"All systems must use AES-256 encryption"' => 'Standards specify exact technical requirements',
                    '"The organization shall protect information assets"' => 'Policies state high-level management intentions',
                    '"Consider using passphrases for better security"' => 'Guidelines offer recommendations and best practices',
                    '"To reset a password: 1) Click forgot password 2) Enter email..."' => 'Procedures provide step-by-step instructions'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Security Frameworks - Item 9
            [
                'topic_id' => $topics['Security Frameworks'] ?? 13,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which framework is specifically designed for cybersecurity and consists of Identify, Protect, Detect, Respond, and Recover functions?',
                'options' => [
                    'ISO 27001',
                    'COBIT',
                    'NIST Cybersecurity Framework',
                    'ITIL'
                ],
                'correct_options' => ['NIST Cybersecurity Framework'],
                'justifications' => [
                    'ISO 27001 is an ISMS standard, not organized by these five functions',
                    'COBIT is for IT governance, not specifically cybersecurity',
                    'Correct - NIST CSF is organized into these five core functions',
                    'ITIL is for IT service management, not cybersecurity'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Security Frameworks - Item 10
            [
                'topic_id' => $topics['Security Frameworks'] ?? 13,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization wants to achieve third-party certification for their Information Security Management System. Which framework should they implement?',
                'options' => [
                    'NIST CSF',
                    'ISO 27001',
                    'CIS Controls',
                    'OWASP Top 10'
                ],
                'correct_options' => ['ISO 27001'],
                'justifications' => [
                    'NIST CSF is a framework but not certifiable',
                    'Correct - ISO 27001 is the international standard for ISMS certification',
                    'CIS Controls are security best practices but not certifiable',
                    'OWASP Top 10 is for web application security awareness, not certification'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Security Frameworks - Item 11
            [
                'topic_id' => $topics['Security Frameworks'] ?? 13,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A retail company processes credit card transactions and stores cardholder data. Which security framework would be MOST appropriate for ensuring compliance?',
                'options' => [
                    'ISO 27001',
                    'NIST CSF',
                    'PCI DSS',
                    'HIPAA Security Rule'
                ],
                'correct_options' => ['PCI DSS'],
                'justifications' => [
                    'ISO 27001 is comprehensive but not payment card specific',
                    'NIST CSF is general cybersecurity, not payment focused',
                    'Correct - PCI DSS is specifically required for payment card processing',
                    'HIPAA is for healthcare data, not payment cards'
                ],
                'settings' => [
                    'shell' => 'framework-analyzer',
                    'commands' => [
                        [
                            'pattern' => '^analyze --requirements$',
                            'response' => "Analyzing organizational requirements...\n[INFO] Industry: E-commerce\n[INFO] Data types: Customer names, payment card numbers\n[INFO] Annual transaction volume: 10 million\n[REQUIREMENT] Must be compliant for credit card processing\n[REQUIREMENT] Must protect cardholder data",
                            'isError' => false
                        ]
                    ],
                    'scenario' => 'E-commerce company processing credit card payments'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // IT Governance vs IT Management - Item 12
            [
                'topic_id' => $topics['IT Governance vs IT Management'] ?? 14,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which activity is an example of IT Governance rather than IT Management?',
                'options' => [
                    'Monitoring server performance',
                    'Setting IT investment priorities aligned with business strategy',
                    'Installing security patches',
                    'Managing help desk tickets'
                ],
                'correct_options' => ['Setting IT investment priorities aligned with business strategy'],
                'justifications' => [
                    'Server monitoring is operational IT management',
                    'Correct - Setting strategic priorities and alignment is governance',
                    'Patch management is operational IT management',
                    'Help desk operations are IT management activities'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // IT Governance vs IT Management - Item 13
            [
                'topic_id' => $topics['IT Governance vs IT Management'] ?? 14,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** IT Governance focuses on doing things right, while IT Management focuses on doing the right things.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. It\'s the opposite: IT Governance focuses on doing the RIGHT things (strategic direction, value delivery), while IT Management focuses on doing things RIGHT (operational efficiency, service delivery).'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Three Lines of Defense - Item 14
            [
                'topic_id' => $topics['Three Lines of Defense'] ?? 15,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'In the Three Lines of Defense model, who represents the FIRST line of defense?',
                'options' => [
                    'Internal audit',
                    'Risk management and compliance functions',
                    'Operational management and staff',
                    'Board of directors'
                ],
                'correct_options' => ['Operational management and staff'],
                'justifications' => [
                    'Internal audit is the third line of defense',
                    'Risk and compliance functions are the second line',
                    'Correct - Operational management who own and manage risks are the first line',
                    'The board provides oversight but is not a line of defense'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Three Lines of Defense - Item 15
            [
                'topic_id' => $topics['Three Lines of Defense'] ?? 15,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each function with its line of defense:',
                'options' => [
                    'items' => [
                        'Business unit implementing controls',
                        'Chief Risk Officer monitoring risks',
                        'Internal auditors reviewing effectiveness',
                        'Security operations center'
                    ],
                    'responses' => [
                        'First Line',
                        'Second Line',
                        'Third Line'
                    ]
                ],
                'correct_options' => [
                    'Business unit implementing controls' => 'First Line',
                    'Chief Risk Officer monitoring risks' => 'Second Line',
                    'Internal auditors reviewing effectiveness' => 'Third Line',
                    'Security operations center' => 'First Line'
                ],
                'justifications' => [
                    'Business unit implementing controls' => 'Business units managing daily operations are first line',
                    'Chief Risk Officer monitoring risks' => 'Risk management functions providing oversight are second line',
                    'Internal auditors reviewing effectiveness' => 'Internal audit providing independent assurance is third line',
                    'Security operations center' => 'SOC operates controls daily, making them first line'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Three Lines of Defense - Item 16
            [
                'topic_id' => $topics['Three Lines of Defense'] ?? 15,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange the Three Lines of Defense from CLOSEST to FURTHEST from daily operations:',
                'options' => [
                    'Internal Audit',
                    'Risk Management & Compliance',
                    'Operational Management'
                ],
                'correct_options' => [
                    'Operational Management',
                    'Risk Management & Compliance',
                    'Internal Audit'
                ],
                'justifications' => ['First line (operational management) is closest to daily operations, second line provides oversight, and third line (internal audit) maintains the most independence.'],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Key Performance / Risk / Control Indicators - Item 17
            [
                'topic_id' => $topics['Key Performance / Risk / Control Indicators (KPI/KRI/KCI)'] ?? 16,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An indicator showing "Number of unpatched critical vulnerabilities" is BEST classified as a:',
                'options' => [
                    'Key Performance Indicator (KPI)',
                    'Key Risk Indicator (KRI)',
                    'Key Control Indicator (KCI)',
                    'Key Goal Indicator (KGI)'
                ],
                'correct_options' => ['Key Risk Indicator (KRI)'],
                'justifications' => [
                    'KPIs measure performance achievement, not risk exposure',
                    'Correct - Unpatched vulnerabilities indicate risk exposure level',
                    'KCIs measure control effectiveness, not vulnerability status',
                    'KGIs measure goal achievement, not risk factors'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Key Performance / Risk / Control Indicators - Item 18
            [
                'topic_id' => $topics['Key Performance / Risk / Control Indicators (KPI/KRI/KCI)'] ?? 16,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which type of security metric measures the effectiveness of implemented security controls?',
                'options' => [
                    'KPI (Key Performance Indicator)',
                    'KRI (Key Risk Indicator)', 
                    'KCI (Key Control Indicator)',
                    'KQI (Key Quality Indicator)'
                ],
                'correct_options' => ['KCI (Key Control Indicator)'],
                'justifications' => [
                    'KPIs measure performance against objectives, not control effectiveness',
                    'KRIs measure risk levels and potential threats',
                    'Correct - KCIs specifically measure how well security controls are functioning',
                    'KQIs measure quality aspects, not security control effectiveness'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Due Care & Due Diligence - Item 19
            [
                'topic_id' => $topics['Due Care & Due Diligence'] ?? 17,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Conducting a thorough security assessment before acquiring another company is an example of:',
                'options' => [
                    'Due care',
                    'Due diligence',
                    'Due process',
                    'Duty of care'
                ],
                'correct_options' => ['Due diligence'],
                'justifications' => [
                    'Due care is about implementing controls, not investigation',
                    'Correct - Due diligence involves investigating and understanding risks before decisions',
                    'Due process relates to fair procedures, not security assessment',
                    'Duty of care is a legal obligation, not an assessment activity'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Due Care & Due Diligence - Item 20
            [
                'topic_id' => $topics['Due Care & Due Diligence'] ?? 17,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Due care is about researching and understanding risks, while due diligence is about taking action to address those risks.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. It\'s the opposite: Due diligence is about researching, investigating, and understanding risks (doing your homework), while due care is about taking reasonable actions to address and manage those risks (implementing appropriate controls).'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Due Care & Due Diligence - Item 21
            [
                'topic_id' => $topics['Due Care & Due Diligence'] ?? 17,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the activities that demonstrate DUE CARE to the drop zone:',
                'options' => [
                    'Implementing security controls based on risk assessment',
                    'Researching vendor security practices',
                    'Maintaining and updating security systems',
                    'Conducting background checks on vendors',
                    'Regular security awareness training',
                    'Reviewing third-party audit reports'
                ],
                'correct_options' => [
                    'Implementing security controls based on risk assessment',
                    'Maintaining and updating security systems',
                    'Regular security awareness training'
                ],
                'justifications' => [
                    'Implementing controls is taking action (due care)',
                    'Research is investigation (due diligence)',
                    'Maintenance is ongoing action (due care)',
                    'Background checks are investigation (due diligence)',
                    'Training is taking action to reduce risk (due care)',
                    'Reviewing reports is investigation (due diligence)'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Security Culture & Tone at the Top - Item 22
            [
                'topic_id' => $topics['Security Culture & Tone at the Top'] ?? 18,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which action BEST demonstrates "tone at the top" for security culture?',
                'options' => [
                    'Publishing comprehensive security policies',
                    'CEO personally attending security training with employees',
                    'Increasing the security budget',
                    'Hiring a qualified CISO'
                ],
                'correct_options' => ['CEO personally attending security training with employees'],
                'justifications' => [
                    'Policies alone don\'t demonstrate leadership commitment',
                    'Correct - Leaders participating shows security is important to everyone',
                    'Budget increases don\'t necessarily show cultural commitment',
                    'Hiring experts doesn\'t demonstrate personal leadership commitment'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Security Culture & Tone at the Top - Item 23
            [
                'topic_id' => $topics['Security Culture & Tone at the Top'] ?? 18,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization\'s executives frequently bypass security controls for convenience. What is the MOST likely outcome?',
                'options' => [
                    'Improved operational efficiency',
                    'Employees will follow security controls more strictly',
                    'Widespread disregard for security policies',
                    'Better understanding of security importance'
                ],
                'correct_options' => ['Widespread disregard for security policies'],
                'justifications' => [
                    'Short-term efficiency gains are offset by security risks',
                    'Employees follow leadership examples, not official policies',
                    'Correct - Employees will model leadership behavior and bypass controls too',
                    'This demonstrates security is not important, reducing understanding'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Security Strategy Development - Item 24
            [
                'topic_id' => $topics['Security Strategy Development'] ?? 19,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should be the FIRST step in developing an information security strategy?',
                'options' => [
                    'Define security controls to implement',
                    'Determine the security budget',
                    'Understand business objectives and risk appetite',
                    'Select security technologies'
                ],
                'correct_options' => ['Understand business objectives and risk appetite'],
                'justifications' => [
                    'Controls come after understanding what needs protection',
                    'Budget follows strategy, not the other way around',
                    'Correct - Security strategy must align with business objectives',
                    'Technology selection comes after strategy is defined'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Security Strategy Development - Item 25
            [
                'topic_id' => $topics['Security Strategy Development'] ?? 19,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these security strategy development steps in the CORRECT order:',
                'options' => [
                    'Define security initiatives and roadmap',
                    'Assess current security posture',
                    'Identify business objectives and requirements',
                    'Perform gap analysis',
                    'Obtain executive approval'
                ],
                'correct_options' => [
                    'Identify business objectives and requirements',
                    'Assess current security posture',
                    'Perform gap analysis',
                    'Define security initiatives and roadmap',
                    'Obtain executive approval'
                ],
                'justifications' => ['Start with business objectives, assess current state, identify gaps, develop initiatives to close gaps, then get approval for the strategy.'],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Security Strategy Development - Item 26
            [
                'topic_id' => $topics['Security Strategy Development'] ?? 19,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'For a financial technology company with limited security budget and critical intellectual property, which strategic approach is MOST appropriate?',
                'options' => [
                    'Risk-based approach focusing on critical assets',
                    'Compliance-driven approach meeting all regulations',
                    'Technology-first approach with latest tools',
                    'Cost-optimization approach minimizing expenses'
                ],
                'correct_options' => ['Risk-based approach focusing on critical assets'],
                'justifications' => [
                    'Correct - With limited resources and critical assets, risk-based prioritization is most effective',
                    'Compliance is important but not the primary driver for this organization',
                    'Technology without strategy alignment wastes resources',
                    'Pure cost minimization compromises necessary security'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Third-Party Governance - Item 27
            [
                'topic_id' => $topics['Third-Party Governance'] ?? 20,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the MOST important consideration when outsourcing data processing to a cloud provider?',
                'options' => [
                    'Cost savings from outsourcing',
                    'Technical capabilities of the provider',
                    'Ensuring data protection requirements are maintained',
                    'Geographic location of data centers'
                ],
                'correct_options' => ['Ensuring data protection requirements are maintained'],
                'justifications' => [
                    'Cost is important but not the primary security concern',
                    'Technical capabilities matter but security requirements are paramount',
                    'Correct - Organizations remain responsible for data protection regardless of outsourcing',
                    'Location matters for compliance but overall protection is most critical'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Third-Party Governance - Item 28
            [
                'topic_id' => $topics['Third-Party Governance'] ?? 20,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the controls that should be included in third-party governance to the drop zone:',
                'options' => [
                    'Right to audit clauses',
                    'Unlimited liability acceptance',
                    'Security requirements in contracts',
                    'Blanket trust agreements',
                    'Incident notification requirements',
                    'Periodic security assessments'
                ],
                'correct_options' => [
                    'Right to audit clauses',
                    'Security requirements in contracts',
                    'Incident notification requirements',
                    'Periodic security assessments'
                ],
                'justifications' => [
                    'Right to audit ensures ongoing compliance verification',
                    'Unlimited liability is unrealistic and won\'t be accepted',
                    'Contracts must specify security requirements',
                    'Blanket trust violates security principles',
                    'Notification ensures timely incident response',
                    'Regular assessments verify ongoing compliance'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Third-Party Governance - Item 29
            [
                'topic_id' => $topics['Third-Party Governance'] ?? 20,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Once a vendor passes initial security assessment, no further monitoring is needed if they have security certifications.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'False. Continuous monitoring is essential for third-party governance. Security certifications provide a point-in-time assessment, but ongoing monitoring is needed to ensure continued compliance, identify new risks, and verify that security controls remain effective.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Third-Party Governance - Item 30
            [
                'topic_id' => $topics['Third-Party Governance'] ?? 20,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each third-party risk management activity with its lifecycle phase:',
                'options' => [
                    'items' => [
                        'Security questionnaire and assessment',
                        'Continuous monitoring and audits',
                        'Secure data destruction verification',
                        'Contract security requirements negotiation'
                    ],
                    'responses' => [
                        'Vendor selection',
                        'Ongoing management',
                        'Vendor termination',
                        'Contract negotiation'
                    ]
                ],
                'correct_options' => [
                    'Security questionnaire and assessment' => 'Vendor selection',
                    'Continuous monitoring and audits' => 'Ongoing management',
                    'Secure data destruction verification' => 'Vendor termination',
                    'Contract security requirements negotiation' => 'Contract negotiation'
                ],
                'justifications' => [
                    'Security questionnaire and assessment' => 'Assessments help evaluate vendors during selection',
                    'Continuous monitoring and audits' => 'Ongoing activities ensure continued compliance',
                    'Secure data destruction verification' => 'Critical during termination to prevent data exposure',
                    'Contract security requirements negotiation' => 'Security terms must be established during contracting'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Mixed Topics - Advanced Questions
            
            // Item 31 - Integrating multiple governance concepts
            [
                'topic_id' => $topics['Security Strategy Development'] ?? 19,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A newly appointed CISO finds that security policies exist but are not followed, executives bypass controls, and security is seen as IT\'s problem. What should be their FIRST priority?',
                'options' => [
                    'Implement stricter technical controls',
                    'Rewrite all security policies',
                    'Work with leadership to establish tone at the top',
                    'Increase security awareness training'
                ],
                'correct_options' => ['Work with leadership to establish tone at the top'],
                'justifications' => [
                    'Technical controls won\'t help if culture doesn\'t support them',
                    'Policies already exist; the issue is compliance',
                    'Correct - Without leadership support and example, other efforts will fail',
                    'Training alone won\'t overcome poor leadership example'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 32 - Framework selection scenario
            [
                'topic_id' => $topics['Security Frameworks'] ?? 13,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A multinational organization needs to comply with GDPR, SOX, and various national privacy laws. Which framework approach would be MOST effective?',
                'options' => [
                    'Implement each regulation\'s requirements separately',
                    'Use ISO 27001 as an overarching framework with specific controls for each regulation',
                    'Focus only on the strictest regulation',
                    'Implement NIST CSF for all requirements'
                ],
                'correct_options' => ['Use ISO 27001 as an overarching framework with specific controls for each regulation'],
                'justifications' => [
                    'Separate implementation creates redundancy and gaps',
                    'Correct - ISO 27001 provides a comprehensive base that can be extended for specific requirements',
                    'Other regulations still apply and need compliance',
                    'NIST CSF is good but ISO 27001 better supports international compliance'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 33 - KPI/KRI/KCI scenario
            [
                'topic_id' => $topics['Key Performance / Risk / Control Indicators (KPI/KRI/KCI)'] ?? 16,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'The board wants a single metric to understand overall security posture. Which would be MOST appropriate?',
                'options' => [
                    'Number of security incidents',
                    'Percentage of systems patched within SLA',
                    'Composite security score based on multiple KPIs, KRIs, and KCIs',
                    'Total security budget spent'
                ],
                'correct_options' => ['Composite security score based on multiple KPIs, KRIs, and KCIs'],
                'justifications' => [
                    'Incident count alone doesn\'t show control effectiveness',
                    'Patching is important but only one aspect of security',
                    'Correct - A balanced composite score provides comprehensive view',
                    'Budget spent doesn\'t indicate security effectiveness'
                ],
                'difficulty_level' => $difficulties['Very Hard'] ?? 5,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 34 - Three Lines of Defense failure
            [
                'topic_id' => $topics['Three Lines of Defense'] ?? 15,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A major breach occurred despite having all three lines of defense. Investigation shows: operations didn\'t follow procedures, risk management didn\'t detect non-compliance, and audit only reviewed documentation. This represents a failure of:',
                'options' => [
                    'First line only',
                    'Second and third lines only',
                    'All three lines of defense',
                    'The governance model itself'
                ],
                'correct_options' => ['All three lines of defense'],
                'justifications' => [
                    'First line failed but others should have detected this',
                    'Second and third failed but first line started the failure',
                    'Correct - Each line failed its responsibility: first didn\'t execute, second didn\'t monitor, third didn\'t verify',
                    'The model is sound; implementation failed'
                ],
                'difficulty_level' => $difficulties['Very Hard'] ?? 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 35 - Integrated governance scenario
            [
                'topic_id' => $topics['IT Governance vs IT Management'] ?? 14,
                'type_id' => 6,
                'dimension' => 'Managerial',
                'content' => 'Click on the governance structure element that is MISSING in this scenario: "The CISO reports to the CIO, who prioritizes operational efficiency. Security incidents are handled by IT operations. The board receives quarterly IT reports that focus on uptime and help desk metrics."',
                'options' => [
                    ['x' => 100, 'y' => 100], // 'Independent security reporting to board'
                    ['x' => 300, 'y' => 100], // 'Security operations team'
                    ['x' => 200, 'y' => 200], // 'Risk committee'
                    ['x' => 200, 'y' => 300]  // 'Security awareness program'
                ],
                'correct_options' => ['x' => 100, 'y' => 100],
                'justifications' => ['The scenario lacks independent security reporting to the board. The CISO reports through the CIO, creating a conflict of interest and preventing the board from receiving unfiltered security risk information.'],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 36 - Policy hierarchy
            [
                'topic_id' => $topics['Policy, Standard, Procedure, Guideline'] ?? 12,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these documents in order from MOST GENERAL to MOST SPECIFIC:',
                'options' => [
                    'Password configuration standard',
                    'Information security policy',
                    'Security best practices guideline',
                    'Password reset procedure',
                    'Acceptable use policy'
                ],
                'correct_options' => [
                    'Information security policy',
                    'Acceptable use policy',
                    'Password configuration standard',
                    'Password reset procedure',
                    'Security best practices guideline'
                ],
                'justifications' => ['Information security policy is the highest level, followed by specific policies (AUP), then standards, procedures, and finally guidelines which provide additional recommendations.'],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 37 - Due care vs due diligence scenario
            [
                'topic_id' => $topics['Due Care & Due Diligence'] ?? 17,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'After a breach, investigation reveals the organization had conducted risk assessments, implemented controls, maintained them properly, but hadn\'t researched emerging threats in their industry. This represents a failure of:',
                'options' => [
                    'Due care only',
                    'Due diligence only',
                    'Both due care and due diligence',
                    'Neither - they met their obligations'
                ],
                'correct_options' => ['Due diligence only'],
                'justifications' => [
                    'They took appropriate actions (due care) by implementing and maintaining controls',
                    'Correct - They failed to research and stay informed about emerging threats (due diligence)',
                    'Due care was demonstrated through control implementation',
                    'They failed due diligence by not researching industry threats'
                ],
                'difficulty_level' => $difficulties['Very Hard'] ?? 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 38 - Security culture measurement
            [
                'topic_id' => $topics['Security Culture & Tone at the Top'] ?? 18,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which indicator BEST measures the maturity of an organization\'s security culture?',
                'options' => [
                    'Number of security policies published',
                    'Employees proactively reporting security concerns',
                    'Security budget size',
                    'Mandatory training completion rates'
                ],
                'correct_options' => ['Employees proactively reporting security concerns'],
                'justifications' => [
                    'Policy count doesn\'t indicate cultural adoption or employee engagement',
                    'Correct - Proactive reporting shows security is valued, trusted, and psychologically safe to discuss',
                    'Budget size doesn\'t reflect cultural maturity or employee behavior',
                    'Mandatory completion shows compliance, not genuine cultural adoption'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 39 - Role conflict scenario
            [
                'topic_id' => $topics['Security Roles & Responsibilities'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'The IT Director is assigned as both Data Owner for customer data and Data Custodian for implementing controls. What is the PRIMARY concern?',
                'options' => [
                    'Too much workload for one person',
                    'Conflict of interest between making rules and implementing them',
                    'Lack of technical skills for both roles',
                    'Violation of separation of duties'
                ],
                'correct_options' => ['Conflict of interest between making rules and implementing them'],
                'justifications' => [
                    'Workload is a concern but not the primary issue',
                    'Correct - The same person deciding controls and implementing them creates conflict',
                    'Technical skills aren\'t the main concern',
                    'While related to separation of duties, the specific issue is conflict of interest'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 40 - Comprehensive governance assessment
            [
                'topic_id' => $topics['Security Strategy Development'] ?? 19,
                'type_id' => 7,
                'dimension' => 'Managerial',
                'content' => 'An organization has implemented multiple technical security controls and maintains current policies, but struggles with strategic security direction and lacks executive engagement. What is the MOST critical governance gap?',
                'options' => [
                    'Lack of technical security controls',
                    'Absence of board-level security oversight',
                    'Insufficient security budget',
                    'Outdated security policies'
                ],
                'correct_options' => ['Absence of board-level security oversight'],
                'justifications' => [
                    'Technical controls are mentioned as already implemented',
                    'Correct - Without board oversight, security lacks strategic governance and executive engagement',
                    'Budget issues are secondary to governance structure',
                    'Policies are mentioned as current, governance oversight is missing'
                ],
                'settings' => [
                    'shell' => 'governance-assess',
                    'commands' => [
                        [
                            'pattern' => '^assess --current-state$',
                            'response' => "Assessing governance maturity...\n[OK] Security policies: Updated 2024\n[OK] Technical controls: Industry standard\n[OK] Security team: Qualified CISO and staff\n[WARNING] Board reporting: Through CIO only\n[FAIL] Board security committee: None\n[FAIL] Independent security oversight: None\n[OK] Security budget: 8% of IT budget",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => $difficulties['Very Hard'] ?? 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Additional questions to ensure comprehensive coverage
            
            // Item 41 - RACI matrix
            [
                'topic_id' => $topics['Security Roles & Responsibilities'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'In a RACI matrix for security incident response, who should be "Accountable" for the overall process?',
                'options' => [
                    'Security Operations Center analyst',
                    'CISO or Security Manager',
                    'IT Help Desk',
                    'External incident response consultant'
                ],
                'correct_options' => ['CISO or Security Manager'],
                'justifications' => [
                    'SOC analysts are responsible for execution, not accountability',
                    'Correct - Senior security leadership must be accountable for incident response',
                    'Help desk may be informed but not accountable',
                    'Consultants can be responsible but not accountable for organizational processes'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 42 - Governance metrics
            [
                'topic_id' => $topics['Key Performance / Risk / Control Indicators (KPI/KRI/KCI)'] ?? 16,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which metric would BEST indicate the effectiveness of security governance?',
                'options' => [
                    'Number of security incidents per month',
                    'Percentage of projects with security review in design phase',
                    'Time to patch critical vulnerabilities',
                    'Security training completion rate'
                ],
                'correct_options' => ['Percentage of projects with security review in design phase'],
                'justifications' => [
                    'Incident count shows operational metrics, not governance',
                    'Correct - Security integration in project lifecycle indicates governance effectiveness',
                    'Patching time is operational, not governance',
                    'Training completion is important but doesn\'t show governance integration'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 43 - Framework implementation
            [
                'topic_id' => $topics['Security Frameworks'] ?? 13,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** An organization can be compliant with ISO 27001 without being certified.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'True. Organizations can implement ISO 27001 requirements and be compliant without pursuing formal certification. Certification requires external audit and is optional, while compliance means meeting the standard\'s requirements regardless of certification status.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 44 - Strategic alignment
            [
                'topic_id' => $topics['Security Strategy Development'] ?? 19,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A security strategy states "Implement latest AI-powered security tools" but the business strategy focuses on "Cost optimization and operational efficiency." This represents a failure in:',
                'options' => [
                    'Technical planning',
                    'Strategic alignment',
                    'Risk assessment',
                    'Budget allocation'
                ],
                'correct_options' => ['Strategic alignment'],
                'justifications' => [
                    'Technical planning isn\'t the issue',
                    'Correct - Security strategy must align with business strategy',
                    'Risk assessment wouldn\'t fix the misalignment',
                    'Budget is a symptom, not the root cause'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 45 - Policy lifecycle
            [
                'topic_id' => $topics['Policy, Standard, Procedure, Guideline'] ?? 12,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How often should information security policies typically be reviewed?',
                'options' => [
                    'Only when regulations change',
                    'Annually or when significant changes occur',
                    'Every 3-5 years',
                    'Monthly'
                ],
                'correct_options' => ['Annually or when significant changes occur'],
                'justifications' => [
                    'Waiting for regulations is reactive, not proactive',
                    'Correct - Annual review ensures currency, with updates for significant changes',
                    '3-5 years is too long in changing threat landscape',
                    'Monthly is excessive and impractical for policy-level documents'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Item 46 - Third-party integration
            [
                'topic_id' => $topics['Third-Party Governance'] ?? 20,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A cloud provider suffers a breach affecting your organization\'s data. Who is liable to regulators for the data breach?',
                'options' => [
                    'The cloud provider only',
                    'Your organization only',
                    'Both parties equally',
                    'Your organization primarily, with potential recourse against provider'
                ],
                'correct_options' => ['Your organization primarily, with potential recourse against provider'],
                'justifications' => [
                    'Providers have liability but organizations retain regulatory responsibility',
                    'Organizations cannot fully transfer regulatory liability',
                    'Liability isn\'t necessarily equal',
                    'Correct - Organizations remain liable to regulators but may seek compensation from providers'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 47 - Governance maturity
            [
                'topic_id' => $topics['IT Governance vs IT Management'] ?? 14,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these governance maturity indicators from LEAST to MOST mature:',
                'options' => [
                    'Security integrated into enterprise risk management',
                    'Basic security policies exist',
                    'Regular board reporting on security metrics',
                    'Ad hoc security decisions',
                    'Security part of strategic planning'
                ],
                'correct_options' => [
                    'Ad hoc security decisions',
                    'Basic security policies exist',
                    'Regular board reporting on security metrics',
                    'Security integrated into enterprise risk management',
                    'Security part of strategic planning'
                ],
                'justifications' => ['Maturity progresses from ad hoc decisions, to basic policies, to governance reporting, to risk integration, and finally to strategic planning integration.'],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 48 - Cultural transformation
            [
                'topic_id' => $topics['Security Culture & Tone at the Top'] ?? 18,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the MOST effective way to improve security culture in an organization with poor security practices?',
                'options' => [
                    'Implement punitive measures for security violations',
                    'Increase security awareness training frequency',
                    'Get visible executive sponsorship and participation',
                    'Deploy more security monitoring tools'
                ],
                'correct_options' => ['Get visible executive sponsorship and participation'],
                'justifications' => [
                    'Punishment creates fear, not positive culture',
                    'Training alone won\'t overcome poor leadership example',
                    'Correct - Visible leadership commitment drives cultural change',
                    'Tools don\'t change culture, people do'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Item 49 - Integrated scenario
            [
                'topic_id' => $topics['Three Lines of Defense'] ?? 15,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Internal audit discovers that the risk management function hasn\'t been monitoring key security controls for six months. This represents a breakdown in which line of defense?',
                'options' => [
                    'First line',
                    'Second line',
                    'Third line',
                    'All lines'
                ],
                'correct_options' => ['Second line'],
                'justifications' => [
                    'First line implements controls, not monitors them',
                    'Correct - Second line (risk management) failed to monitor controls',
                    'Third line (audit) detected the issue, so it\'s working',
                    'Only the second line failed in this scenario'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 50 - Governance effectiveness
            [
                'topic_id' => $topics['Key Performance / Risk / Control Indicators (KPI/KRI/KCI)'] ?? 16,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the indicators that demonstrate EFFECTIVE security governance (not just management) to the drop zone:',
                'options' => [
                    'Security considered in board decisions',
                    '99.9% firewall uptime',
                    'Risk appetite defined and communicated',
                    'All servers patched monthly',
                    'Security investment aligned to business value',
                    'Zero security incidents'
                ],
                'correct_options' => [
                    'Security considered in board decisions',
                    'Risk appetite defined and communicated',
                    'Security investment aligned to business value'
                ],
                'justifications' => [
                    'Board integration shows governance maturity',
                    'Firewall uptime is operational management',
                    'Risk appetite is a governance function',
                    'Patching is operational management',
                    'Investment alignment shows strategic governance',
                    'Zero incidents is unrealistic and operational'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Additional questions to reach 50 total with 7-10-16-10-7 distribution
            // Need: +2 Level 2, +6 Level 3, +2 Level 4, +1 Level 5
            
            // Item 51 - Level 2 (Understand)
            [
                'topic_id' => $topics['Security Roles & Responsibilities'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the main difference between data owner and data steward roles?',
                'options' => [
                    'Data owners handle technical aspects, stewards handle business aspects',
                    'Data owners make policy decisions, stewards ensure day-to-day compliance',
                    'Data owners are temporary, stewards are permanent',
                    'Data owners are external, stewards are internal'
                ],
                'correct_options' => ['Data owners make policy decisions, stewards ensure day-to-day compliance'],
                'justifications' => [
                    'Both roles can involve technical and business aspects',
                    'Correct - Owners set policies and make decisions, stewards ensure ongoing compliance',
                    'Role duration isn\'t the key difference',
                    'Both roles are typically internal'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 52 - Level 2 (Understand)
            [
                'topic_id' => $topics['Security Frameworks'] ?? 13,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which framework is specifically designed for IT service management but includes security management processes?',
                'options' => [
                    'COBIT',
                    'ITIL',
                    'ISO 27001',
                    'NIST CSF'
                ],
                'correct_options' => ['ITIL'],
                'justifications' => [
                    'COBIT is for IT governance, not service management',
                    'Correct - ITIL includes security management as part of service management',
                    'ISO 27001 is for information security management specifically',
                    'NIST CSF is for cybersecurity risk management'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Item 53 - Level 3 (Apply)
            [
                'topic_id' => $topics['Policy, Standard, Procedure, Guideline'] ?? 12,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your organization needs to implement a new password policy. What is the FIRST step?',
                'options' => [
                    'Research industry best practices',
                    'Analyze current password-related incidents',
                    'Assess business requirements and risk tolerance',
                    'Select password management tools'
                ],
                'correct_options' => ['Assess business requirements and risk tolerance'],
                'justifications' => [
                    'Research comes after understanding organizational needs',
                    'Incident analysis is important but comes after understanding requirements',
                    'Correct - Policy development must start with business requirements and risk context',
                    'Tool selection comes after policy is defined'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 54 - Level 3 (Apply)
            [
                'topic_id' => $topics['Third-Party Governance'] ?? 20,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A critical vendor fails their security assessment. What is the MOST appropriate immediate action?',
                'options' => [
                    'Terminate the vendor relationship immediately',
                    'Implement additional monitoring and risk controls',
                    'Reduce the vendor\'s access to non-critical systems only',
                    'Require the vendor to obtain security certification'
                ],
                'correct_options' => ['Implement additional monitoring and risk controls'],
                'justifications' => [
                    'Immediate termination may not be practical for critical vendors',
                    'Correct - Additional controls can mitigate risks while addressing issues',
                    'Reducing access may not be sufficient for critical services',
                    'Certification takes time and doesn\'t provide immediate risk reduction'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 55 - Level 3 (Apply)
            [
                'topic_id' => $topics['Security Culture & Tone at the Top'] ?? 18,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How should a CISO respond when executives consistently bypass security procedures?',
                'options' => [
                    'Implement technical controls to prevent bypass',
                    'Escalate to the board of directors',
                    'Document the violations and continue enforcement',
                    'Meet with executives to understand their concerns and find solutions'
                ],
                'correct_options' => ['Meet with executives to understand their concerns and find solutions'],
                'justifications' => [
                    'Technical controls alone won\'t address cultural issues',
                    'Escalation should come after attempting direct resolution',
                    'Documentation is important but doesn\'t solve the problem',
                    'Correct - Understanding concerns enables collaborative solutions'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 56 - Level 3 (Apply)
            [
                'topic_id' => $topics['Key Performance / Risk / Control Indicators (KPI/KRI/KCI)'] ?? 16,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which approach is MOST effective for establishing security metrics baselines?',
                'options' => [
                    'Use industry benchmarks as baselines',
                    'Set baselines based on regulatory requirements',
                    'Collect 3-6 months of organizational data',
                    'Use vendor-recommended baseline values'
                ],
                'correct_options' => ['Collect 3-6 months of organizational data'],
                'justifications' => [
                    'Industry benchmarks may not reflect organizational specifics',
                    'Regulations provide minimums, not operational baselines',
                    'Correct - Organizational data provides realistic and relevant baselines',
                    'Vendor recommendations may not fit organizational context'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 57 - Level 3 (Apply)
            [
                'topic_id' => $topics['Due Care & Due Diligence'] ?? 17,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When evaluating a new cloud service, what demonstrates BOTH due care and due diligence?',
                'options' => [
                    'Implementing multi-factor authentication only',
                    'Researching the provider\'s security practices and implementing appropriate controls',
                    'Relying on the provider\'s security certifications',
                    'Conducting only a cost-benefit analysis'
                ],
                'correct_options' => ['Researching the provider\'s security practices and implementing appropriate controls'],
                'justifications' => [
                    'MFA alone shows due care but not due diligence',
                    'Correct - Research shows due diligence, controls show due care',
                    'Relying on certifications shows neither thorough research nor action',
                    'Cost analysis doesn\'t address security due diligence or care'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 58 - Level 3 (Apply)
            [
                'topic_id' => $topics['Security Strategy Development'] ?? 19,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A security strategy review reveals that 80% of security incidents are caused by outdated systems. What should be the strategic response?',
                'options' => [
                    'Increase incident response team size',
                    'Prioritize system modernization and lifecycle management',
                    'Implement more monitoring tools',
                    'Enhance security awareness training'
                ],
                'correct_options' => ['Prioritize system modernization and lifecycle management'],
                'justifications' => [
                    'Increasing response team treats symptoms, not causes',
                    'Correct - Addressing root cause through modernization is strategic',
                    'More monitoring doesn\'t fix vulnerable systems',
                    'Training doesn\'t address technical vulnerabilities'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 59 - Level 4 (Analyze)
            [
                'topic_id' => $topics['Three Lines of Defense'] ?? 15,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization has strong technical controls (1st line) and active risk management (2nd line), but still experiences repeated compliance failures. What is the MOST likely cause?',
                'options' => [
                    'Inadequate technical controls',
                    'Ineffective risk management processes',
                    'Weak third line of defense (internal audit)',
                    'Lack of board oversight'
                ],
                'correct_options' => ['Weak third line of defense (internal audit)'],
                'justifications' => [
                    'Technical controls are described as strong',
                    'Risk management is described as active',
                    'Correct - If 1st and 2nd lines are strong but failures persist, 3rd line isn\'t providing effective oversight',
                    'Board oversight is important but 3rd line weakness is more direct'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 60 - Level 4 (Analyze)
            [
                'topic_id' => $topics['IT Governance vs IT Management'] ?? 14,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A company has excellent IT operations (99.9% uptime, fast response times) but struggles with security incidents and regulatory compliance. This suggests a weakness in:',
                'options' => [
                    'IT Management',
                    'IT Governance',
                    'Technical capabilities',
                    'Resource allocation'
                ],
                'correct_options' => ['IT Governance'],
                'justifications' => [
                    'IT Management appears strong based on operational metrics',
                    'Correct - Governance ensures strategy, risk management, and compliance alignment',
                    'Technical capabilities seem adequate for operations',
                    'Resources aren\'t necessarily the issue'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Item 61 - Level 5 (Evaluate)
            [
                'topic_id' => $topics['Security Strategy Development'] ?? 19,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A security strategy has been in place for 2 years with limited progress. Stakeholders cite unclear priorities and competing objectives. What is the MOST critical evaluation criterion?',
                'options' => [
                    'Budget adequacy',
                    'Technical solution effectiveness',
                    'Strategic alignment and stakeholder buy-in',
                    'Compliance with security frameworks'
                ],
                'correct_options' => ['Strategic alignment and stakeholder buy-in'],
                'justifications' => [
                    'Budget issues are symptoms, not root causes',
                    'Technical solutions can\'t succeed without strategic clarity',
                    'Correct - Unclear priorities and competing objectives indicate alignment and buy-in failures',
                    'Framework compliance doesn\'t address stakeholder alignment issues'
                ],
                'difficulty_level' => 5,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Final 3 questions to reach perfect 7-10-16-10-7 distribution
            
            // Item 62 - Level 3 (Apply)
            [
                'topic_id' => $topics['Security Roles & Responsibilities'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A data breach affects customer information across multiple business units. Which role should coordinate the overall response?',
                'options' => [
                    'Data Protection Officer',
                    'Chief Information Security Officer',
                    'Business unit managers',
                    'Legal counsel'
                ],
                'correct_options' => ['Chief Information Security Officer'],
                'justifications' => [
                    'DPO focuses on regulatory compliance aspects',
                    'Correct - CISO coordinates overall incident response across business units',
                    'Business unit managers handle unit-specific aspects',
                    'Legal counsel provides legal guidance but doesn\'t coordinate response'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 63 - Level 3 (Apply)
            [
                'topic_id' => $topics['Security Frameworks'] ?? 13,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization wants to demonstrate security maturity to customers and investors. Which framework implementation would be MOST valuable?',
                'options' => [
                    'Internal security assessment using NIST CSF',
                    'ISO 27001 certification through third-party audit',
                    'Completion of cybersecurity awareness training',
                    'Implementation of technical security controls'
                ],
                'correct_options' => ['ISO 27001 certification through third-party audit'],
                'justifications' => [
                    'Internal assessments lack third-party validation',
                    'Correct - Third-party certification provides credible external validation',
                    'Training is important but doesn\'t demonstrate overall maturity',
                    'Technical controls are necessary but certification shows comprehensive management'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Item 64 - Level 5 (Evaluate)
            [
                'topic_id' => $topics['Security Culture & Tone at the Top'] ?? 18,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Two years after implementing a security culture program, metrics show high training completion (95%) but continued policy violations. What is the MOST likely root cause?',
                'options' => [
                    'Insufficient training content quality',
                    'Lack of consequences for violations',
                    'Misalignment between stated values and leadership behavior',
                    'Inadequate communication of policies'
                ],
                'correct_options' => ['Misalignment between stated values and leadership behavior'],
                'justifications' => [
                    'Training completion is high, suggesting content is delivered',
                    'Consequences alone don\'t create positive culture',
                    'Correct - High training completion with continued violations indicates leadership behavior contradicts stated values',
                    'Communication seems adequate given high completion rates'
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
        
        $this->command->info('Domain 2 (Information Security Governance) diagnostic items seeded successfully!');
    }
}