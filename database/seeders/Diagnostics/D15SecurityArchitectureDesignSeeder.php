<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D15SecurityArchitectureDesignSeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Security Architecture & Design');
        })->pluck('id', 'name');
        
        
        $items = [
            // Security by Design - 5 items
            [
                'topic_id' => $topics['Security by Design'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the fundamental principle of "Security by Design"?',
                'options' => [
                    'Adding security features after development',
                    'Integrating security from the earliest design phases',
                    'Focusing only on perimeter security',
                    'Prioritizing functionality over security'
                ],
                'correct_options' => ['Integrating security from the earliest design phases'],
                'justifications' => [
                    'Security by Design means proactive, not reactive security',
                    'Correct - Security must be built-in from the start',
                    'Security by Design encompasses all layers, not just perimeter',
                    'Security by Design balances both functionality and security'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security by Design'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the practices that exemplify "Security by Design" to the drop zone:',
                'options' => [
                    'Threat modeling during design',
                    'Patching after deployment',
                    'Privacy impact assessments',
                    'Security as an afterthought',
                    'Secure coding standards',
                    'Fixing vulnerabilities in production'
                ],
                'correct_options' => ['Threat modeling during design', 'Privacy impact assessments', 'Secure coding standards'],
                'justifications' => [
                    'Threat modeling identifies risks early in design',
                    'Patching is reactive, not by design',
                    'Privacy assessments embed privacy in design',
                    'Afterthought contradicts "by design"',
                    'Secure coding standards prevent vulnerabilities',
                    'Production fixes are reactive measures'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security by Design'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Security by Design increases development costs but reduces total lifecycle costs.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'While Security by Design may increase initial development costs due to additional planning and security measures, it significantly reduces lifecycle costs by preventing expensive breaches, avoiding costly retrofitting, and reducing incident response expenses.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security by Design'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which activity is MOST important in the Security by Design approach?',
                'options' => [
                    'Purchasing security tools',
                    'Risk assessment and threat modeling',
                    'Hiring security guards',
                    'Installing antivirus software'
                ],
                'correct_options' => ['Risk assessment and threat modeling'],
                'justifications' => [
                    'Tools support but don\'t define Security by Design',
                    'Correct - Understanding risks shapes secure design decisions',
                    'Physical security is just one component',
                    'Antivirus is an operational control, not design'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security by Design'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How does Security by Design differ from traditional security approaches?',
                'options' => [
                    'It costs less',
                    'It\'s proactive rather than reactive',
                    'It requires fewer resources',
                    'It focuses only on external threats'
                ],
                'correct_options' => ['It\'s proactive rather than reactive'],
                'justifications' => [
                    'Initial costs may be higher',
                    'Correct - Prevents issues rather than fixing them later',
                    'May require more upfront resources',
                    'Considers all threat vectors, not just external'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Secure Defaults - 5 items
            [
                'topic_id' => $topics['Secure Defaults'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the principle of "Secure Defaults"?',
                'options' => [
                    'Systems require hardening after installation',
                    'Systems are secure without any configuration changes',
                    'Default passwords are acceptable',
                    'Security features must be manually enabled'
                ],
                'correct_options' => ['Systems are secure without any configuration changes'],
                'justifications' => [
                    'Secure defaults mean no hardening needed',
                    'Correct - Security is the default state out-of-box',
                    'Default passwords violate secure defaults',
                    'Secure defaults mean security is on by default'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Defaults'] ?? 2,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each scenario with whether it follows secure defaults:',
                'options' => [
                    'items' => [
                        'Firewall blocks all traffic by default',
                        'Admin account has password "admin"',
                        'Encryption enabled automatically',
                        'All services running on install'
                    ],
                    'responses' => [
                        'Follows secure defaults',
                        'Violates secure defaults'
                    ]
                ],
                'correct_options' => [
                    'Firewall blocks all traffic by default' => 'Follows secure defaults',
                    'Admin account has password "admin"' => 'Violates secure defaults',
                    'Encryption enabled automatically' => 'Follows secure defaults',
                    'All services running on install' => 'Violates secure defaults'
                ],
                'justifications' => [
                    'Firewall blocks all traffic by default' => 'Deny-by-default is secure',
                    'Admin account has password "admin"' => 'Default passwords are insecure',
                    'Encryption enabled automatically' => 'Security features on by default',
                    'All services running on install' => 'Minimal services is more secure'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Defaults'] ?? 2,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag examples of secure default configurations to the drop zone:',
                'options' => [
                    'Password complexity enforced',
                    'Guest account enabled',
                    'Audit logging activated',
                    'Remote access allowed',
                    'Automatic updates enabled',
                    'Debug mode on'
                ],
                'correct_options' => ['Password complexity enforced', 'Audit logging activated', 'Automatic updates enabled'],
                'justifications' => [
                    'Strong passwords should be required by default',
                    'Guest accounts should be disabled by default',
                    'Logging should be on for security monitoring',
                    'Remote access should require explicit enabling',
                    'Security updates should apply automatically',
                    'Debug mode exposes sensitive information'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Defaults'] ?? 2,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Review this application\'s default configuration and identify the security issue:',
                'options' => [
                    'HTTPS not enforced',
                    'Database connection encrypted',
                    'Logging enabled',
                    'Strong password policy'
                ],
                'correct_options' => ['HTTPS not enforced'],
                'justifications' => [
                    'Correct - HTTP allowed by default violates secure defaults',
                    'Encrypted database connections are secure',
                    'Default logging is a secure default',
                    'Strong password requirements are secure'
                ],
                'settings' => [
                    'shell' => 'config-review',
                    'commands' => [
                        [
                            'pattern' => '^show defaults$',
                            'response' => "Application Default Configuration:\n[WARNING] Protocol: HTTP (HTTPS optional)\n[OK] Database: TLS required\n[OK] Logging: Enabled (INFO level)\n[OK] Password Policy: Min 12 chars, complexity required\n[OK] Session Timeout: 15 minutes\n[WARNING] Debug Mode: Disabled",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 1,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Secure Defaults'] ?? 2,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Secure defaults may reduce usability but improve overall security posture.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'Secure defaults often require additional steps (like changing default passwords or explicitly enabling features), which can reduce initial usability. However, this trade-off significantly improves security by preventing common attack vectors.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Least Privilege & Need to Know - 5 items
            [
                'topic_id' => $topics['Least Privilege & Need to Know'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the difference between "least privilege" and "need to know"?',
                'options' => [
                    'They are the same principle',
                    'Least privilege is about access rights, need to know is about information',
                    'Need to know is broader than least privilege',
                    'Least privilege only applies to administrators'
                ],
                'correct_options' => ['Least privilege is about access rights, need to know is about information'],
                'justifications' => [
                    'They are related but distinct principles',
                    'Correct - Least privilege limits actions, need to know limits information access',
                    'Both are specific, complementary principles',
                    'Least privilege applies to all users'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Least Privilege & Need to Know'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A developer needs to debug a production issue. According to least privilege, what access should they receive?',
                'options' => [
                    'Full administrative access to fix anything',
                    'Read-only access to relevant logs and data',
                    'No access - only admins can view production',
                    'Permanent elevated privileges for future issues'
                ],
                'correct_options' => ['Read-only access to relevant logs and data'],
                'justifications' => [
                    'Full admin access exceeds what\'s needed for debugging',
                    'Correct - Minimal access required for the specific task',
                    'Too restrictive - prevents legitimate troubleshooting',
                    'Permanent elevation violates least privilege'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Least Privilege & Need to Know'] ?? 3,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the practices that implement least privilege to the drop zone:',
                'options' => [
                    'Role-based access control',
                    'Everyone gets admin rights',
                    'Just-in-time access',
                    'Shared accounts',
                    'Regular privilege reviews',
                    'Permanent elevated access'
                ],
                'correct_options' => ['Role-based access control', 'Just-in-time access', 'Regular privilege reviews'],
                'justifications' => [
                    'RBAC assigns minimal necessary permissions',
                    'Universal admin violates least privilege',
                    'JIT provides temporary elevated access when needed',
                    'Shared accounts prevent accountability',
                    'Reviews ensure privileges remain appropriate',
                    'Permanent elevation violates least privilege'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Least Privilege & Need to Know'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Need to know principle applies only to classified government information.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Need to know applies to all sensitive information in any organization, including corporate data, personal information, trade secrets, and internal processes. It\'s a fundamental security principle for any confidential information.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Least Privilege & Need to Know'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which technology best enforces both least privilege and need to know principles?',
                'options' => [
                    'Antivirus software',
                    'Attribute-based access control (ABAC)',
                    'Intrusion detection systems',
                    'Backup systems'
                ],
                'correct_options' => ['Attribute-based access control (ABAC)'],
                'justifications' => [
                    'Antivirus doesn\'t control access',
                    'Correct - ABAC can enforce complex policies based on attributes',
                    'IDS monitors but doesn\'t enforce access',
                    'Backups preserve data, not control access'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Separation of Duties (SoD) - 5 items
            [
                'topic_id' => $topics['Separation of Duties (SoD)'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary goal of separation of duties?',
                'options' => [
                    'Increase efficiency',
                    'Prevent fraud and errors',
                    'Reduce staffing costs',
                    'Simplify processes'
                ],
                'correct_options' => ['Prevent fraud and errors'],
                'justifications' => [
                    'SoD may reduce efficiency due to multiple approvals',
                    'Correct - SoD prevents single person from committing fraud',
                    'SoD typically requires more staff',
                    'SoD adds complexity to ensure security'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Separation of Duties (SoD)'] ?? 4,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each scenario with whether it violates separation of duties:',
                'options' => [
                    'items' => [
                        'Same person writes and deploys code',
                        'Different teams for development and QA',
                        'One person approves their own expenses',
                        'Maker-checker for financial transactions'
                    ],
                    'responses' => [
                        'Violates SoD',
                        'Follows SoD'
                    ]
                ],
                'correct_options' => [
                    'Same person writes and deploys code' => 'Violates SoD',
                    'Different teams for development and QA' => 'Follows SoD',
                    'One person approves their own expenses' => 'Violates SoD',
                    'Maker-checker for financial transactions' => 'Follows SoD'
                ],
                'justifications' => [
                    'Same person writes and deploys code' => 'Developer shouldn\'t deploy own code',
                    'Different teams for development and QA' => 'Proper separation of functions',
                    'One person approves their own expenses' => 'Self-approval enables fraud',
                    'Maker-checker for financial transactions' => 'Two-person control prevents fraud'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Separation of Duties (SoD)'] ?? 4,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'In software development, drag the activities that should be separated to the drop zone:',
                'options' => [
                    'Code development & code review',
                    'Writing unit tests & writing code',
                    'Deployment approval & deployment execution',
                    'Bug reporting & bug fixing',
                    'Security testing & fixing vulnerabilities',
                    'Documentation & coding'
                ],
                'correct_options' => ['Code development & code review', 'Deployment approval & deployment execution', 'Security testing & fixing vulnerabilities'],
                'justifications' => [
                    'Developers shouldn\'t review their own code',
                    'Same developer can write tests and code',
                    'Approval and execution should be separate',
                    'Same person can report and fix bugs',
                    'Security testers shouldn\'t fix what they find',
                    'Documentation by developer is acceptable'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Separation of Duties (SoD)'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** In small organizations, separation of duties is impossible to implement.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'While challenging, small organizations can implement SoD through compensating controls like mandatory vacations, job rotation, audit trails, and external reviews. Complete SoD may not be possible, but the principle can still be applied.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Separation of Duties (SoD)'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which control best compensates for inability to implement full separation of duties?',
                'options' => [
                    'Stronger passwords',
                    'Detailed audit logging and review',
                    'Faster computers',
                    'More firewalls'
                ],
                'correct_options' => ['Detailed audit logging and review'],
                'justifications' => [
                    'Passwords don\'t address SoD issues',
                    'Correct - Audit trails can detect violations after the fact',
                    'Computing power is irrelevant to SoD',
                    'Firewalls don\'t enforce internal SoD'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Defense in Depth - 5 items
            [
                'topic_id' => $topics['Defense in Depth'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the core concept of defense in depth?',
                'options' => [
                    'Using the strongest firewall available',
                    'Multiple layers of security controls',
                    'Focusing on perimeter security',
                    'Implementing one perfect security solution'
                ],
                'correct_options' => ['Multiple layers of security controls'],
                'justifications' => [
                    'Single control, even strong, isn\'t defense in depth',
                    'Correct - Multiple overlapping controls provide redundancy',
                    'Perimeter-only violates defense in depth',
                    'No single solution is perfect'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Defense in Depth'] ?? 5,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Arrange these security layers from outermost to innermost in a defense in depth strategy:',
                'options' => [
                    'Data encryption',
                    'Perimeter firewall',
                    'Host-based controls',
                    'Network segmentation',
                    'Physical security'
                ],
                'correct_options' => [
                    'Physical security',
                    'Perimeter firewall',
                    'Network segmentation',
                    'Host-based controls',
                    'Data encryption'
                ],
                'justifications' => ['Physical security is the outermost layer, followed by network perimeter controls, internal network segmentation, individual host protections, and finally data-level encryption as the innermost layer.'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Defense in Depth'] ?? 5,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the controls that represent different layers in defense in depth to the drop zone:',
                'options' => [
                    'Security awareness training',
                    'Using only one vendor',
                    'Network firewall',
                    'Single sign-on only',
                    'Endpoint protection',
                    'Putting everything in DMZ'
                ],
                'correct_options' => ['Security awareness training', 'Network firewall', 'Endpoint protection'],
                'justifications' => [
                    'People layer - training reduces human risks',
                    'Single vendor creates single point of failure',
                    'Network layer - filters traffic between segments',
                    'SSO alone is single control, not layered',
                    'Host layer - protects individual systems',
                    'DMZ is one layer, not defense in depth'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Defense in Depth'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Defense in depth means if one control fails, the entire security posture is compromised.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Defense in depth specifically prevents total compromise when one control fails. Multiple layers ensure that if attackers bypass one control, they face additional barriers. This redundancy is the key benefit of the strategy.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Defense in Depth'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which scenario best demonstrates defense in depth?',
                'options' => [
                    'One very expensive firewall',
                    'Firewall, IDS, antivirus, and security training',
                    'Multiple firewalls from same vendor',
                    'Focus all resources on endpoint security'
                ],
                'correct_options' => ['Firewall, IDS, antivirus, and security training'],
                'justifications' => [
                    'Single control, regardless of cost',
                    'Correct - Multiple different controls at different layers',
                    'Same control type doesn\'t provide depth',
                    'Single layer focus isn\'t defense in depth'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Zero Trust - 6 items
            [
                'topic_id' => $topics['Zero Trust'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the fundamental principle of Zero Trust architecture?',
                'options' => [
                    'Trust internal network traffic',
                    'Never trust, always verify',
                    'Trust but verify',
                    'Trust verified users forever'
                ],
                'correct_options' => ['Never trust, always verify'],
                'justifications' => [
                    'Zero Trust explicitly doesn\'t trust internal traffic',
                    'Correct - Every access request must be verified',
                    'This is the old model, not Zero Trust',
                    'Zero Trust requires continuous verification'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Zero Trust'] ?? 6,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each Zero Trust component with its function:',
                'options' => [
                    'items' => [
                        'Policy Engine',
                        'Policy Enforcement Point',
                        'Continuous monitoring',
                        'Microsegmentation'
                    ],
                    'responses' => [
                        'Makes access decisions',
                        'Enforces access decisions',
                        'Detects anomalies',
                        'Limits lateral movement'
                    ]
                ],
                'correct_options' => [
                    'Policy Engine' => 'Makes access decisions',
                    'Policy Enforcement Point' => 'Enforces access decisions',
                    'Continuous monitoring' => 'Detects anomalies',
                    'Microsegmentation' => 'Limits lateral movement'
                ],
                'justifications' => [
                    'Policy Engine' => 'Evaluates policies and decides access',
                    'Policy Enforcement Point' => 'Implements the engine\'s decisions',
                    'Continuous monitoring' => 'Watches for suspicious behavior',
                    'Microsegmentation' => 'Creates small security zones'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Zero Trust'] ?? 6,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the principles that are core to Zero Trust architecture to the drop zone:',
                'options' => [
                    'Verify explicitly',
                    'Trust the internal network',
                    'Use least privilege access',
                    'Grant permanent access',
                    'Assume breach',
                    'Perimeter is sufficient'
                ],
                'correct_options' => ['Verify explicitly', 'Use least privilege access', 'Assume breach'],
                'justifications' => [
                    'Every access must be verified explicitly',
                    'Zero Trust doesn\'t trust any network',
                    'Minimal necessary access aligns with Zero Trust',
                    'Zero Trust uses time-limited access',
                    'Design assumes attackers are already inside',
                    'Zero Trust goes beyond perimeter security'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Zero Trust'] ?? 6,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Analyze this network access request and determine if it follows Zero Trust principles:',
                'options' => [
                    'Follows Zero Trust',
                    'Violates Zero Trust - No MFA',
                    'Violates Zero Trust - Permanent access',
                    'Violates Zero Trust - No device validation'
                ],
                'correct_options' => ['Violates Zero Trust - Permanent access'],
                'justifications' => [
                    'Has some Zero Trust elements but not all',
                    'MFA is shown as completed',
                    'Correct - Indefinite access violates Zero Trust time limits',
                    'Device compliance check was performed'
                ],
                'settings' => [
                    'shell' => 'zt-analyzer',
                    'commands' => [
                        [
                            'pattern' => '^analyze access-request$',
                            'response' => "Access Request Analysis:\nUser: john.doe@company.com\nAuthentication: Password + MFA completed\nDevice: Corporate laptop (compliant)\nResource: Financial Database\nAccess Level: Read/Write\nDuration: Indefinite\nLocation: Office network\nRisk Score: Medium",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Zero Trust'] ?? 6,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Zero Trust eliminates the need for firewalls and network segmentation.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Zero Trust complements, not replaces, traditional controls. Firewalls and segmentation remain important for defense in depth, traffic filtering, and limiting lateral movement. Zero Trust adds identity-centric controls on top of network controls.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Zero Trust'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary challenge in implementing Zero Trust?',
                'options' => [
                    'High cost of firewalls',
                    'Complexity of implementation and cultural change',
                    'Lack of security benefits',
                    'Slower network speeds'
                ],
                'correct_options' => ['Complexity of implementation and cultural change'],
                'justifications' => [
                    'Zero Trust isn\'t primarily about firewalls',
                    'Correct - Requires rearchitecting and mindset shift',
                    'Zero Trust provides significant security benefits',
                    'Performance impact can be minimized'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Threat Modeling - 5 items
            [
                'topic_id' => $topics['Threat Modeling'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does STRIDE stand for in threat modeling?',
                'options' => [
                    'Security, Trust, Risk, Identity, Defense, Encryption',
                    'Spoofing, Tampering, Repudiation, Information disclosure, DoS, Elevation',
                    'System, Threat, Response, Impact, Detection, Elimination',
                    'Secure, Test, Review, Implement, Deploy, Evaluate'
                ],
                'correct_options' => ['Spoofing, Tampering, Repudiation, Information disclosure, DoS, Elevation'],
                'justifications' => [
                    'Not the correct STRIDE components',
                    'Correct - Microsoft\'s threat categorization model',
                    'Not related to STRIDE',
                    'Not the STRIDE model'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Threat Modeling'] ?? 7,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each STRIDE threat with an example:',
                'options' => [
                    'items' => [
                        'Spoofing',
                        'Tampering',
                        'Information Disclosure',
                        'Denial of Service'
                    ],
                    'responses' => [
                        'Impersonating another user',
                        'Modifying data in transit',
                        'Exposing sensitive data',
                        'Overwhelming system resources'
                    ]
                ],
                'correct_options' => [
                    'Spoofing' => 'Impersonating another user',
                    'Tampering' => 'Modifying data in transit',
                    'Information Disclosure' => 'Exposing sensitive data',
                    'Denial of Service' => 'Overwhelming system resources'
                ],
                'justifications' => [
                    'Spoofing' => 'Spoofing involves false identity claims',
                    'Tampering' => 'Tampering modifies data integrity',
                    'Information Disclosure' => 'Violates confidentiality',
                    'Denial of Service' => 'Attacks availability'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Threat Modeling'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When should threat modeling be performed in the SDLC?',
                'options' => [
                    'Only after deployment',
                    'During the design phase',
                    'Only when problems occur',
                    'After all coding is complete'
                ],
                'correct_options' => ['During the design phase'],
                'justifications' => [
                    'Too late to influence design',
                    'Correct - Early identification allows design changes',
                    'Reactive approach, not proactive',
                    'Missing opportunity to prevent issues'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Threat Modeling'] ?? 7,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the essential components of threat modeling to the drop zone:',
                'options' => [
                    'System decomposition',
                    'Buying more hardware',
                    'Threat identification',
                    'Ignoring unlikely threats',
                    'Risk assessment',
                    'Implementing everything'
                ],
                'correct_options' => ['System decomposition', 'Threat identification', 'Risk assessment'],
                'justifications' => [
                    'Understanding system components is essential',
                    'Hardware purchases aren\'t threat modeling',
                    'Core activity of identifying potential threats',
                    'All threats should be considered',
                    'Assessing and prioritizing risks is key',
                    'Not all mitigations are cost-effective'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Threat Modeling'] ?? 7,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** PASTA (Process for Attack Simulation and Threat Analysis) is a risk-centric threat modeling methodology.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'PASTA is indeed a risk-centric threat modeling methodology that focuses on business objectives and simulates attacker perspectives. It consists of seven stages that align technical threats with business impact.'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Additional mixed topics - 14 items
            [
                'topic_id' => $topics['Economy of Mechanism'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does the "economy of mechanism" principle advocate?',
                'options' => [
                    'Use the cheapest security solutions',
                    'Keep security mechanisms simple',
                    'Implement as many controls as possible',
                    'Prioritize performance over security'
                ],
                'correct_options' => ['Keep security mechanisms simple'],
                'justifications' => [
                    'Not about cost, but simplicity',
                    'Correct - Simple mechanisms are easier to verify and have fewer bugs',
                    'Contradicts the principle of simplicity',
                    'Security shouldn\'t be sacrificed for performance'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Fail Secure'] ?? 9,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A firewall loses power. According to "fail secure" principles, what should happen?',
                'options' => [
                    'Allow all traffic to maintain availability',
                    'Block all traffic until power is restored',
                    'Switch to battery backup only',
                    'Redirect traffic to another path'
                ],
                'correct_options' => ['Block all traffic until power is restored'],
                'justifications' => [
                    'Fail open compromises security',
                    'Correct - Fail secure defaults to denying access',
                    'Battery is about continuity, not fail secure',
                    'Bypassing the firewall isn\'t secure'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Complete Mediation'] ?? 10,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Complete mediation means checking access permissions only during initial authentication.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Complete mediation requires checking access permissions for every access attempt, not just at initial authentication. This prevents privilege escalation and ensures that changed permissions take effect immediately.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Models'] ?? 11,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each security model with its primary focus:',
                'options' => [
                    'items' => [
                        'Bell-LaPadula',
                        'Biba',
                        'Clark-Wilson',
                        'Brewer-Nash'
                    ],
                    'responses' => [
                        'Confidentiality - no read up',
                        'Integrity - no write up',
                        'Integrity through transactions',
                        'Conflict of interest prevention'
                    ]
                ],
                'correct_options' => [
                    'Bell-LaPadula' => 'Confidentiality - no read up',
                    'Biba' => 'Integrity - no write up',
                    'Clark-Wilson' => 'Integrity through transactions',
                    'Brewer-Nash' => 'Conflict of interest prevention'
                ],
                'justifications' => [
                    'Bell-LaPadula' => 'Focuses on preventing unauthorized disclosure',
                    'Biba' => 'Prevents corruption of high-integrity data',
                    'Clark-Wilson' => 'Uses well-formed transactions for integrity',
                    'Brewer-Nash' => 'Chinese Wall prevents conflicts of interest'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Trusted Computing Base (TCB) & Protection Rings'] ?? 12,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which protection ring has the highest privileges?',
                'options' => [
                    'Ring 0',
                    'Ring 1',
                    'Ring 2',
                    'Ring 3'
                ],
                'correct_options' => ['Ring 0'],
                'justifications' => [
                    'Correct - Ring 0 (kernel mode) has unrestricted access',
                    'Ring 1 has fewer privileges than Ring 0',
                    'Ring 2 is less privileged',
                    'Ring 3 (user mode) has least privileges'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Common Criteria & Evaluation Assurance Levels (EAL)'] ?? 13,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does EAL4 certification indicate?',
                'options' => [
                    'Functionally tested',
                    'Methodically designed, tested, and reviewed',
                    'Formally verified design',
                    'Structurally tested'
                ],
                'correct_options' => ['Methodically designed, tested, and reviewed'],
                'justifications' => [
                    'EAL1 is functionally tested',
                    'Correct - EAL4 requires methodical design and testing',
                    'EAL7 requires formal verification',
                    'EAL2 is structurally tested'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Architecture Frameworks'] ?? 14,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the characteristics of SABSA framework to the drop zone:',
                'options' => [
                    'Business-driven approach',
                    'Technology-first focus',
                    'Six-layer model',
                    'Prescriptive controls',
                    'Risk-based',
                    'One-size-fits-all'
                ],
                'correct_options' => ['Business-driven approach', 'Six-layer model', 'Risk-based'],
                'justifications' => [
                    'SABSA aligns security with business needs',
                    'SABSA is business-driven, not tech-first',
                    'SABSA uses six architectural layers',
                    'SABSA is framework, not prescriptive',
                    'Risk assessment is core to SABSA',
                    'SABSA is adaptable to context'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Through Obscurity'] ?? 15,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the main criticism of "security through obscurity"?',
                'options' => [
                    'It\'s too expensive',
                    'It provides false confidence when used alone',
                    'It\'s too complex',
                    'It\'s highly effective'
                ],
                'correct_options' => ['It provides false confidence when used alone'],
                'justifications' => [
                    'Obscurity is often cheap to implement',
                    'Correct - Hiding details isn\'t real security by itself',
                    'Obscurity is usually simple',
                    'This is opposite of the criticism'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Additional 6 questions to reach 50 total with proper Bloom distribution
            [
                'topic_id' => $topics['Security Architecture Frameworks'] ?? 14,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Design a secure architecture for this multi-tier application and identify the critical security control points:',
                'options' => [
                    'API Gateway authentication only',
                    'Database encryption + API Gateway + Network segmentation',
                    'Client-side validation only',
                    'Single firewall protection'
                ],
                'correct_options' => ['Database encryption + API Gateway + Network segmentation'],
                'justifications' => [
                    'Authentication at one point isn\'t sufficient',
                    'Correct - Multiple layers protect different tiers',
                    'Client-side validation can be bypassed',
                    'Single control violates defense in depth'
                ],
                'settings' => [
                    'shell' => 'arch-designer',
                    'commands' => [
                        [
                            'pattern' => '^design secure-architecture$',
                            'response' => "Multi-tier Application Architecture:\n\nClient Tier: Web browsers, mobile apps\nWeb Tier: Load balancer, web servers\nApplication Tier: API servers, business logic\nData Tier: Database cluster\n\nCurrent Security: Basic firewall\nTraffic Flow: Internet -> Firewall -> All tiers\n\nIdentify optimal security control placement.",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security by Design'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate this security architecture decision: "We will implement all security controls after the application is fully developed and tested."',
                'options' => [
                    'Excellent - ensures no development delays',
                    'Poor - violates Security by Design principles',
                    'Acceptable - common industry practice',
                    'Good - allows focus on functionality first'
                ],
                'correct_options' => ['Poor - violates Security by Design principles'],
                'justifications' => [
                    'Security delays are better than security breaches',
                    'Correct - Security must be integrated from the start',
                    'Common but not best practice',
                    'Functionality and security must be balanced from start'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Zero Trust'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Analyze this scenario: A user connects from their home office to access company files. What Zero Trust controls should be implemented?',
                'options' => [
                    'VPN connection only',
                    'Device compliance check, MFA, conditional access policies',
                    'IP allowlisting for home office',
                    'Trust home network as corporate extension'
                ],
                'correct_options' => ['Device compliance check, MFA, conditional access policies'],
                'justifications' => [
                    'VPN alone doesn\'t verify user or device state',
                    'Correct - Multiple verification factors align with Zero Trust',
                    'Static IP lists don\'t verify current security posture',
                    'Zero Trust doesn\'t extend trust to any network'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Threat Modeling'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'During threat modeling, you identify that insider threats pose the highest risk. What architectural control would be most effective?',
                'options' => [
                    'Stronger perimeter firewalls',
                    'Increased security awareness training',
                    'Comprehensive logging and behavioral analytics',
                    'More restrictive internet access'
                ],
                'correct_options' => ['Comprehensive logging and behavioral analytics'],
                'justifications' => [
                    'Perimeter controls don\'t address insider threats',
                    'Training helps but doesn\'t provide detection capability',
                    'Correct - Detects unusual insider behavior patterns',
                    'Internet restrictions don\'t prevent insider misuse'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Defense in Depth'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Evaluate this defense strategy: "Our advanced AI-powered security platform provides complete protection, eliminating the need for other security measures."',
                'options' => [
                    'Excellent - AI provides superior security',
                    'Poor - violates defense in depth principles',
                    'Good - simplifies security management',
                    'Acceptable - reduces complexity'
                ],
                'correct_options' => ['Poor - violates defense in depth principles'],
                'justifications' => [
                    'No single technology, even AI, provides complete protection',
                    'Correct - Single point of failure violates layered defense',
                    'Simplification at cost of security is poor strategy',
                    'Reduced complexity shouldn\'t compromise security'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Least Privilege & Need to Know'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A security architect must design access controls for a financial system. Which approach best implements least privilege?',
                'options' => [
                    'All users get read access, managers get write access',
                    'Role-based access with job-specific permissions and time limits',
                    'Department-based access with broad permissions',
                    'All authenticated users get full access'
                ],
                'correct_options' => ['Role-based access with job-specific permissions and time limits'],
                'justifications' => [
                    'Too broad - not all users need read access to everything',
                    'Correct - Specific permissions based on actual job requirements',
                    'Department-level access is still too broad',
                    'Violates least privilege entirely'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 15 (Security Architecture & Design) diagnostic items seeded successfully!');
    }
}