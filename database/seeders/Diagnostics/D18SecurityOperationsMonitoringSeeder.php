<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D18SecurityOperationsMonitoringSeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Security Operations & Monitoring');
        })->pluck('id', 'name');
        
        
        $items = [
            // Security Operations Center (SOC) - Item 1
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary function of a Security Operations Center (SOC)?',
                'options' => [
                    'Developing security policies and procedures',
                    'Continuous monitoring and incident response',
                    'Conducting security awareness training',
                    'Managing user access permissions'
                ],
                'correct_options' => ['Continuous monitoring and incident response'],
                'justifications' => [
                    'Policy development is typically done by governance teams',
                    'Correct - SOCs focus on 24/7 monitoring and responding to security events',
                    'Training is usually handled by security awareness teams',
                    'Access management is typically an IT/IAM function'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Security Operations Center (SOC) - Item 2
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which SOC tier is typically responsible for advanced incident analysis and threat hunting?',
                'options' => [
                    'Tier 1 - Alert Triage',
                    'Tier 2 - Incident Response',
                    'Tier 3 - Advanced Analysis',
                    'Tier 4 - SOC Management'
                ],
                'correct_options' => ['Tier 3 - Advanced Analysis'],
                'justifications' => [
                    'Tier 1 handles initial alert triage and basic analysis',
                    'Tier 2 performs deeper investigation of escalated incidents',
                    'Correct - Tier 3 analysts perform advanced analysis, threat hunting, and tool tuning',
                    'Tier 4 is not a standard analyst tier; management oversees operations'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Security Operations Center (SOC) - Item 3
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each SOC role with its primary responsibility:',
                'options' => [
                    'items' => [
                        'SOC Analyst Tier 1',
                        'SOC Analyst Tier 2',
                        'SOC Analyst Tier 3',
                        'SOC Manager'
                    ],
                    'responses' => [
                        'Alert triage and initial investigation',
                        'Incident escalation and deeper analysis',
                        'Threat hunting and advanced forensics',
                        'Team oversight and metrics reporting'
                    ]
                ],
                'correct_options' => [
                    'SOC Analyst Tier 1' => 'Alert triage and initial investigation',
                    'SOC Analyst Tier 2' => 'Incident escalation and deeper analysis',
                    'SOC Analyst Tier 3' => 'Threat hunting and advanced forensics',
                    'SOC Manager' => 'Team oversight and metrics reporting'
                ],
                'justifications' => [
                    'SOC Analyst Tier 1' => 'Entry-level analysts handle initial alert review',
                    'SOC Analyst Tier 2' => 'Mid-level analysts investigate escalated issues',
                    'SOC Analyst Tier 3' => 'Senior analysts perform advanced security tasks',
                    'SOC Manager' => 'Manages team performance and reports to leadership'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Operational Metrics - Item 4
            [
                'topic_id' => $topics['Operational Metrics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does MTTD stand for in security operations metrics?',
                'options' => [
                    'Mean Time to Deploy',
                    'Mean Time to Detect',
                    'Maximum Time to Defend',
                    'Minimum Time to Diagnose'
                ],
                'correct_options' => ['Mean Time to Detect'],
                'justifications' => [
                    'Deploy is not a standard security metric',
                    'Correct - MTTD measures the average time to detect security incidents',
                    'Not a standard security operations metric',
                    'Diagnose is not the standard term used'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Operational Metrics - Item 5
            [
                'topic_id' => $topics['Operational Metrics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which operational metric is MOST critical for measuring SOC effectiveness in minimizing breach impact?',
                'options' => [
                    'Number of alerts generated daily',
                    'Mean Time to Respond (MTTR)',
                    'Total number of security tools deployed',
                    'Percentage of false positives'
                ],
                'correct_options' => ['Mean Time to Respond (MTTR)'],
                'justifications' => [
                    'Alert volume alone does not indicate effectiveness',
                    'Correct - Faster response times minimize breach impact and damage',
                    'Tool quantity does not equal effectiveness',
                    'Important for efficiency but not directly related to breach impact'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Operational Metrics - Item 6
            [
                'topic_id' => $topics['Operational Metrics'] ?? 2,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Arrange these incident response time metrics in the typical order they occur during an incident:',
                'options' => [
                    'Time to Contain',
                    'Time to Detect',
                    'Time to Recover',
                    'Time to Respond',
                    'Time to Eradicate'
                ],
                'correct_options' => [
                    'Time to Detect',
                    'Time to Respond',
                    'Time to Contain',
                    'Time to Eradicate',
                    'Time to Recover'
                ],
                'justifications' => ['The incident lifecycle follows: Detection (identifying the incident), Response (initiating action), Containment (stopping spread), Eradication (removing threat), and Recovery (restoring normal operations).'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Log & Event Management - Item 7
            [
                'topic_id' => $topics['Log & Event Management'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the recommended minimum log retention period for security-critical systems?',
                'options' => [
                    '30 days',
                    '90 days',
                    '180 days',
                    '365 days'
                ],
                'correct_options' => ['90 days'],
                'justifications' => [
                    'Often insufficient for thorough investigation',
                    'Correct - Industry standard minimum for security logs',
                    'Good practice but exceeds typical minimum requirements',
                    'Recommended for high-security environments but not minimum'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Log & Event Management - Item 8
            [
                'topic_id' => $topics['Log & Event Management'] ?? 3,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the log sources that should be collected in a comprehensive security monitoring program to the drop zone:',
                'options' => [
                    'Firewall logs',
                    'Employee personal emails',
                    'Authentication logs',
                    'Social media posts',
                    'Application logs',
                    'Network flow data',
                    'Personal device contacts',
                    'Database audit logs'
                ],
                'correct_options' => [
                    'Firewall logs',
                    'Authentication logs',
                    'Application logs',
                    'Network flow data',
                    'Database audit logs'
                ],
                'justifications' => [
                    'Essential for perimeter security monitoring',
                    'Privacy violation and not security-relevant',
                    'Critical for detecting unauthorized access',
                    'Not appropriate for corporate monitoring',
                    'Important for application-level security events',
                    'Valuable for network behavior analysis',
                    'Privacy violation',
                    'Essential for database security monitoring'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Log & Event Management - Item 9
            [
                'topic_id' => $topics['Log & Event Management'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Log data should be stored on the same system that generates it to ensure quick access during investigations.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Logs should be centralized and stored separately from source systems. This prevents attackers from deleting logs after compromising a system and enables centralized analysis. Local storage alone makes logs vulnerable to tampering or deletion.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Patch & Configuration Management - Item 10
            [
                'topic_id' => $topics['Patch & Configuration Management'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the MOST important factor when prioritizing patch deployment?',
                'options' => [
                    'Age of the vulnerability',
                    'Criticality rating and exploitability',
                    'Size of the patch file',
                    'Vendor reputation'
                ],
                'correct_options' => ['Criticality rating and exploitability'],
                'justifications' => [
                    'Old vulnerabilities may be low risk',
                    'Correct - CVSS score and active exploitation determine urgency',
                    'File size is irrelevant to security priority',
                    'Vendor reputation does not determine patch priority'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Patch & Configuration Management - Item 11
            [
                'topic_id' => $topics['Patch & Configuration Management'] ?? 4,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each patch management phase with its primary activity:',
                'options' => [
                    'items' => [
                        'Assessment',
                        'Testing',
                        'Deployment',
                        'Verification'
                    ],
                    'responses' => [
                        'Identify missing patches and vulnerabilities',
                        'Validate patches in non-production environment',
                        'Roll out patches to production systems',
                        'Confirm successful installation and functionality'
                    ]
                ],
                'correct_options' => [
                    'Assessment' => 'Identify missing patches and vulnerabilities',
                    'Testing' => 'Validate patches in non-production environment',
                    'Deployment' => 'Roll out patches to production systems',
                    'Verification' => 'Confirm successful installation and functionality'
                ],
                'justifications' => [
                    'Assessment' => 'Initial phase identifies what needs patching',
                    'Testing' => 'Critical to test before production deployment',
                    'Deployment' => 'Actual installation in production',
                    'Verification' => 'Ensures patches were successful'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Change Management - Item 12
            [
                'topic_id' => $topics['Change Management'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of a Change Advisory Board (CAB) in security operations?',
                'options' => [
                    'To delay all changes for security review',
                    'To assess and approve changes based on risk',
                    'To implement all security changes',
                    'To document changes after implementation'
                ],
                'correct_options' => ['To assess and approve changes based on risk'],
                'justifications' => [
                    'CAB facilitates, not delays, necessary changes',
                    'Correct - CAB evaluates change risks and approves based on impact',
                    'CAB approves but does not implement changes',
                    'Documentation happens throughout, not just after'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Change Management - Item 13
            [
                'topic_id' => $topics['Change Management'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which type of change typically requires emergency CAB approval?',
                'options' => [
                    'Monthly security updates',
                    'Critical security patch for actively exploited vulnerability',
                    'New feature deployment',
                    'Routine configuration update'
                ],
                'correct_options' => ['Critical security patch for actively exploited vulnerability'],
                'justifications' => [
                    'Regular updates follow normal change procedures',
                    'Correct - Active exploitation requires emergency change process',
                    'Features are not emergency changes',
                    'Routine updates follow standard procedures'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Intrusion Detection & Prevention (IDS/IPS) - Item 14
            [
                'topic_id' => $topics['Intrusion Detection & Prevention (IDS/IPS)'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the key difference between IDS and IPS?',
                'options' => [
                    'IDS is hardware-based, IPS is software-based',
                    'IDS detects and alerts, IPS detects and blocks',
                    'IDS is for networks, IPS is for hosts',
                    'IDS is real-time, IPS is batch-processed'
                ],
                'correct_options' => ['IDS detects and alerts, IPS detects and blocks'],
                'justifications' => [
                    'Both can be hardware or software',
                    'Correct - IDS is passive monitoring, IPS actively blocks threats',
                    'Both can be network or host-based',
                    'Both operate in real-time'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Intrusion Detection & Prevention (IDS/IPS) - Item 15
            [
                'topic_id' => $topics['Intrusion Detection & Prevention (IDS/IPS)'] ?? 6,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the IDS/IPS detection methods to the drop zone:',
                'options' => [
                    'Signature-based detection',
                    'Password complexity checking',
                    'Anomaly-based detection',
                    'File encryption',
                    'Behavioral analysis',
                    'Data backup verification',
                    'Heuristic detection',
                    'User training completion'
                ],
                'correct_options' => [
                    'Signature-based detection',
                    'Anomaly-based detection',
                    'Behavioral analysis',
                    'Heuristic detection'
                ],
                'justifications' => [
                    'Matches known attack patterns',
                    'Not an IDS/IPS function',
                    'Detects deviations from baseline',
                    'Not an IDS/IPS function',
                    'Analyzes behavior patterns',
                    'Not an IDS/IPS function',
                    'Uses rules to identify suspicious activity',
                    'Not an IDS/IPS function'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Intrusion Detection & Prevention (IDS/IPS) - Item 16
            [
                'topic_id' => $topics['Intrusion Detection & Prevention (IDS/IPS)'] ?? 6,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Using the IDS console, analyze the alert and determine the most likely attack type:',
                'options' => [
                    'SQL Injection',
                    'Buffer Overflow',
                    'Port Scanning',
                    'Denial of Service'
                ],
                'correct_options' => ['Port Scanning'],
                'justifications' => [
                    'SQL injection would show database query patterns',
                    'Buffer overflow would show memory corruption attempts',
                    'Correct - Sequential connection attempts to multiple ports indicates scanning',
                    'DoS would show high volume traffic to specific services'
                ],
                'settings' => [
                    'shell' => 'ids-console',
                    'commands' => [
                        [
                            'pattern' => '^show alert 1247$',
                            'response' => "Alert ID: 1247\nSource IP: 192.168.10.55\nDestination: 10.0.0.10\nPattern: TCP SYN to ports 21,22,23,25,80,110,443,3389\nDuration: 30 seconds\nStatus: No established connections",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Security Alerts & Tuning - Item 17
            [
                'topic_id' => $topics['Security Alerts & Tuning'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary goal of security alert tuning?',
                'options' => [
                    'Eliminate all alerts',
                    'Maximize the number of alerts',
                    'Reduce false positives while maintaining detection',
                    'Create more complex alert rules'
                ],
                'correct_options' => ['Reduce false positives while maintaining detection'],
                'justifications' => [
                    'Eliminating all alerts would miss real threats',
                    'Too many alerts cause alert fatigue',
                    'Correct - Balance between noise reduction and threat detection',
                    'Complexity does not equal effectiveness'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Security Alerts & Tuning - Item 18
            [
                'topic_id' => $topics['Security Alerts & Tuning'] ?? 7,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** A high false positive rate in security alerts can lead to analysts missing real security incidents.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['True'],
                'justifications' => [
                    'explanation' => 'Alert fatigue from excessive false positives causes analysts to become desensitized and potentially ignore or quickly dismiss alerts. This increases the risk of missing genuine security incidents hidden among the noise.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Security Information & Event Management (SIEM) - Item 19
            [
                'topic_id' => $topics['Security Information & Event Management (SIEM)'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What are the core functions of a SIEM system? (Select all that apply)',
                'options' => [
                    'Log aggregation and normalization',
                    'Correlation and analysis',
                    'Patch management',
                    'Real-time alerting',
                    'User authentication',
                    'Compliance reporting'
                ],
                'correct_options' => [
                    'Log aggregation and normalization',
                    'Correlation and analysis',
                    'Real-time alerting',
                    'Compliance reporting'
                ],
                'justifications' => [
                    'Correct - SIEM collects and standardizes logs',
                    'Correct - SIEM correlates events to identify threats',
                    'Patch management is a separate function',
                    'Correct - SIEM provides real-time security alerts',
                    'Authentication is handled by IAM systems',
                    'Correct - SIEM supports compliance through reporting'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Security Information & Event Management (SIEM) - Item 20
            [
                'topic_id' => $topics['Security Information & Event Management (SIEM)'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which SIEM correlation rule would best detect a brute force attack?',
                'options' => [
                    'Single failed login from one IP',
                    'Multiple failed logins followed by success from same IP',
                    'Successful login from new geographic location',
                    'Password change request'
                ],
                'correct_options' => ['Multiple failed logins followed by success from same IP'],
                'justifications' => [
                    'Single failure is normal user error',
                    'Correct - Pattern indicates password guessing until success',
                    'Could be legitimate travel',
                    'Normal user activity'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Security Information & Event Management (SIEM) - Item 21
            [
                'topic_id' => $topics['Security Information & Event Management (SIEM)'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A security analyst needs to create a SIEM query to detect potential data exfiltration. Which network pattern would be MOST indicative of data exfiltration?',
                'options' => [
                    'Large inbound data transfer to database servers',
                    'Outbound transfer > 1GB to external IP after hours',
                    'Multiple login attempts during business hours',
                    'System backup jobs running overnight'
                ],
                'correct_options' => ['Outbound transfer > 1GB to external IP after hours'],
                'justifications' => [
                    'Inbound to databases is normal operation',
                    'Correct - Large outbound transfers after hours suggest exfiltration',
                    'Normal business activity',
                    'Expected maintenance activity'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // User & Entity Behavior Analytics (UEBA) - Item 22
            [
                'topic_id' => $topics['User & Entity Behavior Analytics (UEBA)'] ?? 9,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary advantage of UEBA over traditional rule-based detection?',
                'options' => [
                    'Lower cost of implementation',
                    'Faster processing speed',
                    'Detection of unknown threats through behavioral anomalies',
                    'Simpler configuration requirements'
                ],
                'correct_options' => ['Detection of unknown threats through behavioral anomalies'],
                'justifications' => [
                    'UEBA systems are typically more expensive',
                    'Processing speed varies by implementation',
                    'Correct - UEBA detects deviations without predefined signatures',
                    'UEBA requires complex baseline establishment'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // User & Entity Behavior Analytics (UEBA) - Item 23
            [
                'topic_id' => $topics['User & Entity Behavior Analytics (UEBA)'] ?? 9,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Drag the behavioral indicators that UEBA systems typically monitor to the drop zone:',
                'options' => [
                    'Login times and locations',
                    'CPU temperature',
                    'Data access patterns',
                    'Printer toner levels',
                    'Network traffic volumes',
                    'Office lighting schedules',
                    'Application usage patterns',
                    'Coffee machine usage'
                ],
                'correct_options' => [
                    'Login times and locations',
                    'Data access patterns',
                    'Network traffic volumes',
                    'Application usage patterns'
                ],
                'justifications' => [
                    'Indicates abnormal access patterns',
                    'Hardware monitoring, not user behavior',
                    'Shows unusual data access behavior',
                    'Not security-relevant',
                    'Reveals abnormal transfer patterns',
                    'Not related to user behavior',
                    'Identifies unusual application usage',
                    'Not security-relevant behavior'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Security Orchestration, Automation & Response (SOAR) - Item 24
            [
                'topic_id' => $topics['Security Orchestration, Automation & Response (SOAR)'] ?? 10,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary benefit of implementing SOAR in security operations?',
                'options' => [
                    'Replacing all security analysts',
                    'Automating repetitive tasks and response workflows',
                    'Eliminating the need for SIEM',
                    'Preventing all security incidents'
                ],
                'correct_options' => ['Automating repetitive tasks and response workflows'],
                'justifications' => [
                    'SOAR augments, not replaces, human analysts',
                    'Correct - SOAR automates routine tasks freeing analysts for complex work',
                    'SOAR complements SIEM, does not replace it',
                    'No tool can prevent all incidents'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Security Orchestration, Automation & Response (SOAR) - Item 25
            [
                'topic_id' => $topics['Security Orchestration, Automation & Response (SOAR)'] ?? 10,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each SOAR capability with its primary benefit:',
                'options' => [
                    'items' => [
                        'Playbook automation',
                        'Case management',
                        'Threat intelligence integration',
                        'Automated containment'
                    ],
                    'responses' => [
                        'Consistent incident response',
                        'Centralized incident tracking',
                        'Enriched alert context',
                        'Rapid threat mitigation'
                    ]
                ],
                'correct_options' => [
                    'Playbook automation' => 'Consistent incident response',
                    'Case management' => 'Centralized incident tracking',
                    'Threat intelligence integration' => 'Enriched alert context',
                    'Automated containment' => 'Rapid threat mitigation'
                ],
                'justifications' => [
                    'Playbook automation' => 'Ensures consistent response procedures',
                    'Case management' => 'Provides single view of incidents',
                    'Threat intelligence integration' => 'Adds external context to alerts',
                    'Automated containment' => 'Reduces response time significantly'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Continuous Monitoring & Threat Hunting - Item 26
            [
                'topic_id' => $topics['Continuous Monitoring & Threat Hunting'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What distinguishes threat hunting from traditional security monitoring?',
                'options' => [
                    'Threat hunting is automated, monitoring is manual',
                    'Threat hunting is proactive, monitoring is reactive',
                    'Threat hunting is cheaper than monitoring',
                    'Threat hunting replaces monitoring'
                ],
                'correct_options' => ['Threat hunting is proactive, monitoring is reactive'],
                'justifications' => [
                    'Threat hunting is typically manual, monitoring can be automated',
                    'Correct - Hunting actively seeks threats, monitoring waits for alerts',
                    'Threat hunting requires skilled analysts, often more expensive',
                    'Both are complementary security activities'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Continuous Monitoring & Threat Hunting - Item 27
            [
                'topic_id' => $topics['Continuous Monitoring & Threat Hunting'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which skills are MOST important for effective threat hunting? (Select all that apply)',
                'options' => [
                    'Deep knowledge of attacker TTPs',
                    'Ability to write complex queries',
                    'Understanding of normal network behavior',
                    'Graphic design skills',
                    'Critical thinking and hypothesis testing',
                    'Social media expertise'
                ],
                'correct_options' => [
                    'Deep knowledge of attacker TTPs',
                    'Ability to write complex queries',
                    'Understanding of normal network behavior',
                    'Critical thinking and hypothesis testing'
                ],
                'justifications' => [
                    'Correct - Essential to know what to hunt for',
                    'Correct - Required to search through data effectively',
                    'Correct - Must distinguish abnormal from normal',
                    'Not relevant to threat hunting',
                    'Correct - Core skill for developing hunt hypotheses',
                    'Not directly relevant to threat hunting'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Continuous Monitoring & Threat Hunting - Item 28
            [
                'topic_id' => $topics['Continuous Monitoring & Threat Hunting'] ?? 11,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Threat hunting should only be performed after receiving threat intelligence about specific indicators.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Threat hunting can be hypothesis-driven based on attacker behaviors, environmental knowledge, or crown jewel analysis. While threat intelligence can inform hunts, waiting only for specific indicators would miss many threats that have no known signatures.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Mixed Topics - Advanced Items

            // SOC and Metrics Integration - Item 29
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A SOC reports MTTD of 180 days and MTTR of 2 hours. What does this indicate?',
                'options' => [
                    'Excellent detection and response capabilities',
                    'Poor detection but good response capabilities',
                    'Good detection but poor response capabilities',
                    'Both detection and response need improvement'
                ],
                'correct_options' => ['Poor detection but good response capabilities'],
                'justifications' => [
                    '180-day detection time is extremely poor',
                    'Correct - Very slow to detect (180 days) but fast to respond (2 hours)',
                    '2-hour response time is quite good',
                    'Only detection needs improvement; response is good'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Log Management and SIEM - Item 30
            [
                'topic_id' => $topics['Log & Event Management'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'An organization is approaching log storage capacity. What is the BEST approach?',
                'options' => [
                    'Delete all logs older than 30 days',
                    'Stop collecting non-critical logs',
                    'Implement log compression and tiered storage',
                    'Only keep logs from critical systems'
                ],
                'correct_options' => ['Implement log compression and tiered storage'],
                'justifications' => [
                    'May violate compliance requirements',
                    'Could miss important security events',
                    'Correct - Maintains compliance while managing storage efficiently',
                    'May miss lateral movement through non-critical systems'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // IDS/IPS and Alert Tuning - Item 31
            [
                'topic_id' => $topics['Intrusion Detection & Prevention (IDS/IPS)'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'An IPS is blocking legitimate traffic. What is the BEST initial response?',
                'options' => [
                    'Disable the IPS entirely',
                    'Switch from blocking to detection mode for that signature',
                    'Increase the sensitivity threshold',
                    'Remove all custom rules'
                ],
                'correct_options' => ['Switch from blocking to detection mode for that signature'],
                'justifications' => [
                    'Leaves system unprotected',
                    'Correct - Allows traffic while investigating the false positive',
                    'Would likely cause more false positives',
                    'May remove valid security rules'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // SIEM and SOAR Integration - Item 32
            [
                'topic_id' => $topics['Security Information & Event Management (SIEM)'] ?? 8,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Arrange these SIEM-SOAR integration steps in the correct order:',
                'options' => [
                    'SOAR executes response playbook',
                    'SIEM generates correlated alert',
                    'SOAR enriches alert with threat intelligence',
                    'Logs ingested into SIEM',
                    'Alert forwarded to SOAR platform'
                ],
                'correct_options' => [
                    'Logs ingested into SIEM',
                    'SIEM generates correlated alert',
                    'Alert forwarded to SOAR platform',
                    'SOAR enriches alert with threat intelligence',
                    'SOAR executes response playbook'
                ],
                'justifications' => ['The workflow begins with log ingestion, then SIEM correlation creates alerts, which are sent to SOAR for enrichment and automated response execution.'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // UEBA and Threat Hunting - Item 33
            [
                'topic_id' => $topics['User & Entity Behavior Analytics (UEBA)'] ?? 9,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'UEBA detects a user accessing files they have never accessed before at 3 AM. What additional context would be MOST valuable?',
                'options' => [
                    'The user\'s job title',
                    'Whether the user is on vacation',
                    'The color of the user\'s badge',
                    'The user\'s password complexity'
                ],
                'correct_options' => ['Whether the user is on vacation'],
                'justifications' => [
                    'Job title alone doesn\'t explain 3 AM access',
                    'Correct - Vacation status would indicate impossible legitimate access',
                    'Badge color is irrelevant to behavior analysis',
                    'Password complexity doesn\'t explain behavior'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Patch Management and Change Control - Item 34
            [
                'topic_id' => $topics['Patch & Configuration Management'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A critical zero-day patch is released on Friday afternoon. When should it be deployed?',
                'options' => [
                    'Wait until the next monthly patch cycle',
                    'Deploy immediately to all systems',
                    'Test over weekend and deploy Monday with proper change control',
                    'Deploy only to development systems'
                ],
                'correct_options' => ['Test over weekend and deploy Monday with proper change control'],
                'justifications' => [
                    'Zero-day is too critical to wait a month',
                    'Untested deployment could cause outages',
                    'Correct - Balances urgency with proper testing and change control',
                    'Leaves production systems vulnerable'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Comprehensive SOC Operations - Item 35
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'A new SOC is being established. Drag the components that should be implemented in Phase 1 to the drop zone:',
                'options' => [
                    'Basic SIEM deployment',
                    'Advanced threat hunting team',
                    'Log collection infrastructure',
                    'Machine learning analytics',
                    'Incident response procedures',
                    'Automated SOAR platform',
                    '24/7 monitoring coverage',
                    'Custom threat intelligence feeds'
                ],
                'correct_options' => [
                    'Basic SIEM deployment',
                    'Log collection infrastructure',
                    'Incident response procedures',
                    '24/7 monitoring coverage'
                ],
                'justifications' => [
                    'Essential for basic SOC operations',
                    'Advanced capability for mature SOCs',
                    'Foundation for all monitoring',
                    'Advanced capability requiring baseline data',
                    'Critical for handling detected incidents',
                    'Automation comes after manual processes are defined',
                    'Core SOC function from day one',
                    'Advanced capability for later phases'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Alert Fatigue Management - Item 36
            [
                'topic_id' => $topics['Security Alerts & Tuning'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A SOC analyst is receiving 10,000 alerts per day with 99% false positives. What is the BEST approach?',
                'options' => [
                    'Hire more analysts to review all alerts',
                    'Implement alert correlation and tuning',
                    'Ignore low and medium severity alerts',
                    'Turn off noisy alert sources'
                ],
                'correct_options' => ['Implement alert correlation and tuning'],
                'justifications' => [
                    'Doesn\'t solve the root cause of noise',
                    'Correct - Reduces false positives while maintaining detection',
                    'Could miss real attacks rated as low/medium',
                    'Reduces visibility into the environment'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // SIEM Use Cases - Item 37
            [
                'topic_id' => $topics['Security Information & Event Management (SIEM)'] ?? 8,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Match each SIEM use case with its primary detection goal:',
                'options' => [
                    'items' => [
                        'Impossible travel detection',
                        'Privilege escalation monitoring',
                        'Data exfiltration detection',
                        'Malware communication detection'
                    ],
                    'responses' => [
                        'Account compromise',
                        'Insider threat or compromise',
                        'Data breach',
                        'System infection'
                    ]
                ],
                'correct_options' => [
                    'Impossible travel detection' => 'Account compromise',
                    'Privilege escalation monitoring' => 'Insider threat or compromise',
                    'Data exfiltration detection' => 'Data breach',
                    'Malware communication detection' => 'System infection'
                ],
                'justifications' => [
                    'Impossible travel detection' => 'Login from distant locations indicates stolen credentials',
                    'Privilege escalation monitoring' => 'Unusual privilege changes suggest compromise',
                    'Data exfiltration detection' => 'Large data transfers indicate potential breach',
                    'Malware communication detection' => 'C2 traffic indicates infected systems'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Threat Hunting Methodology - Item 38
            [
                'topic_id' => $topics['Continuous Monitoring & Threat Hunting'] ?? 11,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Arrange these threat hunting steps in the correct order:',
                'options' => [
                    'Document findings and update detections',
                    'Form a hypothesis',
                    'Collect and analyze data',
                    'Identify hunt objectives',
                    'Test the hypothesis'
                ],
                'correct_options' => [
                    'Identify hunt objectives',
                    'Form a hypothesis',
                    'Collect and analyze data',
                    'Test the hypothesis',
                    'Document findings and update detections'
                ],
                'justifications' => ['Threat hunting follows a scientific method: define objectives, create hypothesis, gather data, test hypothesis, and document results to improve future detection.'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // SOAR Playbook Design - Item 39
            [
                'topic_id' => $topics['Security Orchestration, Automation & Response (SOAR)'] ?? 10,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which incident types are BEST suited for SOAR automation? (Select all that apply)',
                'options' => [
                    'Phishing email analysis',
                    'Nation-state APT investigation',
                    'Password reset requests',
                    'Malware sandboxing',
                    'Executive targeted attacks',
                    'Threat intelligence enrichment'
                ],
                'correct_options' => [
                    'Phishing email analysis',
                    'Password reset requests',
                    'Malware sandboxing',
                    'Threat intelligence enrichment'
                ],
                'justifications' => [
                    'Correct - Repetitive task ideal for automation',
                    'Too complex, requires human analysis',
                    'Correct - Simple, repetitive process',
                    'Correct - Automated sandbox submission and analysis',
                    'Requires careful human handling',
                    'Correct - Automated IOC enrichment saves time'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Log Retention and Compliance - Item 40
            [
                'topic_id' => $topics['Log & Event Management'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'An organization must meet multiple compliance requirements: PCI DSS (1 year), HIPAA (6 years), and internal policy (90 days). What should be the log retention period?',
                'options' => [
                    '90 days to meet internal policy',
                    '1 year to meet PCI DSS',
                    '6 years to meet all requirements',
                    '3 years as a compromise'
                ],
                'correct_options' => ['6 years to meet all requirements'],
                'justifications' => [
                    'Fails to meet regulatory requirements',
                    'Fails to meet HIPAA requirements',
                    'Correct - Must meet the most stringent requirement',
                    'Still fails HIPAA requirements'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Advanced IDS/IPS Configuration - Item 41
            [
                'topic_id' => $topics['Intrusion Detection & Prevention (IDS/IPS)'] ?? 6,
                'type_id' => 7,
                'dimension' => 'Technical',
                'content' => 'Configure the IPS to protect a web server while minimizing false positives:',
                'options' => [
                    'Block all traffic except port 443',
                    'Enable all signatures in blocking mode',
                    'Enable web-specific signatures in detect mode first',
                    'Disable IPS for web servers'
                ],
                'correct_options' => ['Enable web-specific signatures in detect mode first'],
                'justifications' => [
                    'Too restrictive, blocks legitimate services',
                    'Will cause excessive false positives',
                    'Correct - Allows tuning before blocking legitimate traffic',
                    'Leaves server unprotected'
                ],
                'settings' => [
                    'shell' => 'ips-config',
                    'commands' => [
                        [
                            'pattern' => '^set profile web-server mode detect signatures web-attacks$',
                            'response' => "Configuration applied:\n- Profile: web-server\n- Mode: Detect (log only)\n- Signatures: web-attacks category\n- Status: Monitoring for false positives\nRecommendation: Run in detect mode for 48 hours before enabling blocking",
                            'isError' => false
                        ]
                    ]
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Security Metrics Dashboard - Item 42
            [
                'topic_id' => $topics['Operational Metrics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which metrics should be included in an executive security dashboard? (Select all that apply)',
                'options' => [
                    'Mean Time to Detect (MTTD)',
                    'Number of firewall rules',
                    'Security incident trends',
                    'Patch compliance percentage',
                    'IDS signature count',
                    'Critical vulnerability exposure time'
                ],
                'correct_options' => [
                    'Mean Time to Detect (MTTD)',
                    'Security incident trends',
                    'Patch compliance percentage',
                    'Critical vulnerability exposure time'
                ],
                'justifications' => [
                    'Correct - Key performance indicator',
                    'Too technical for executive level',
                    'Correct - Shows security posture trends',
                    'Correct - Indicates vulnerability management effectiveness',
                    'Technical detail not executive-relevant',
                    'Correct - Shows risk exposure duration'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Integrated Security Operations - Item 43
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A security operations team has limited resources. Which capability should be prioritized FIRST?',
                'options' => [
                    'Advanced threat hunting program',
                    'Comprehensive log collection and basic monitoring',
                    'Automated response platform',
                    'Custom threat intelligence feeds'
                ],
                'correct_options' => ['Comprehensive log collection and basic monitoring'],
                'justifications' => [
                    'Requires mature operations as foundation',
                    'Correct - Foundation for all other security operations',
                    'Needs established processes to automate',
                    'Advanced capability requiring operational maturity'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // SIEM Query Optimization - Item 44
            [
                'topic_id' => $topics['Security Information & Event Management (SIEM)'] ?? 8,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** SIEM queries should always search all available data to ensure nothing is missed.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'SIEM queries should be optimized with appropriate time ranges, data sources, and filters. Searching all data is resource-intensive, slow, and often unnecessary. Targeted queries based on specific use cases and time windows are more efficient and practical.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Change Management in Security Operations - Item 45
            [
                'topic_id' => $topics['Change Management'] ?? 5,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Which changes require emergency change advisory board (ECAB) approval? Drag applicable scenarios to the drop zone:',
                'options' => [
                    'Critical security patch for zero-day exploit',
                    'Quarterly SIEM rule updates',
                    'Firewall rule to block active attack',
                    'New employee onboarding',
                    'IPS signature for ongoing incident',
                    'Monthly vulnerability scan schedule',
                    'Disabling compromised account',
                    'Annual security tool upgrade'
                ],
                'correct_options' => [
                    'Critical security patch for zero-day exploit',
                    'Firewall rule to block active attack',
                    'IPS signature for ongoing incident',
                    'Disabling compromised account'
                ],
                'justifications' => [
                    'Urgent response to active vulnerability',
                    'Regular maintenance, standard change',
                    'Emergency response to active threat',
                    'Standard HR/IT process',
                    'Immediate response to ongoing attack',
                    'Routine scheduled activity',
                    'Urgent security response required',
                    'Planned change, not emergency'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Security Operations Center (SOC) - Item 46 (Bloom Level 1)
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does SOC stand for in cybersecurity?',
                'options' => [
                    'Security Operations Center',
                    'System Operational Control',
                    'Secure Online Computing',
                    'Safety Operations Committee'
                ],
                'correct_options' => ['Security Operations Center'],
                'justifications' => [
                    'Correct - Central facility for monitoring and defending information systems',
                    'Not a security term',
                    'Not a standard cybersecurity acronym',
                    'Not related to cybersecurity operations'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Operational Metrics - Item 47 (Bloom Level 1)
            [
                'topic_id' => $topics['Operational Metrics'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What does MTTR stand for in security operations?',
                'options' => [
                    'Mean Time to Repair',
                    'Mean Time to Respond',
                    'Maximum Time to Recovery',
                    'Minimum Time to Report'
                ],
                'correct_options' => ['Mean Time to Respond'],
                'justifications' => [
                    'General IT term, not security-specific',
                    'Correct - Average time to respond to security incidents',
                    'Not a standard security metric',
                    'Not a recognized security metric'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Log & Event Management - Item 48 (Bloom Level 2)
            [
                'topic_id' => $topics['Log & Event Management'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Why is centralized log management important for security operations?',
                'options' => [
                    'It reduces storage costs',
                    'It enables correlation of events across systems',
                    'It increases network performance',
                    'It simplifies user authentication'
                ],
                'correct_options' => ['It enables correlation of events across systems'],
                'justifications' => [
                    'Cost is not the primary security benefit',
                    'Correct - Centralization allows analysts to see patterns across the environment',
                    'Log management does not directly improve network performance',
                    'Log management is separate from authentication systems'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Intrusion Detection & Prevention (IDS/IPS) - Item 49 (Bloom Level 3)
            [
                'topic_id' => $topics['Intrusion Detection & Prevention (IDS/IPS)'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'An organization wants to deploy IDS/IPS for a high-speed network backbone. Which deployment method would be most appropriate?',
                'options' => [
                    'Inline deployment blocking all traffic',
                    'Out-of-band deployment with network TAPs',
                    'Host-based deployment on all endpoints',
                    'Cloud-based IDS only'
                ],
                'correct_options' => ['Out-of-band deployment with network TAPs'],
                'justifications' => [
                    'Could create bottlenecks and single points of failure',
                    'Correct - TAPs provide full visibility without impacting network performance',
                    'Does not monitor network backbone traffic',
                    'Would not have visibility into backbone traffic'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Security Orchestration, Automation & Response (SOAR) - Item 50 (Bloom Level 3)
            [
                'topic_id' => $topics['Security Orchestration, Automation & Response (SOAR)'] ?? 10,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When implementing SOAR playbooks, which approach ensures the best results?',
                'options' => [
                    'Automate all incident response activities immediately',
                    'Start with manual processes, then gradually automate',
                    'Only automate low-priority incidents',
                    'Create complex multi-vendor integrations first'
                ],
                'correct_options' => ['Start with manual processes, then gradually automate'],
                'justifications' => [
                    'Can lead to errors and missed edge cases',
                    'Correct - Understanding manual processes first ensures proper automation',
                    'Limits the value of automation',
                    'Complexity without proven processes leads to failures'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 18 (Security Operations & Monitoring) diagnostic items seeded successfully!');
    }
}