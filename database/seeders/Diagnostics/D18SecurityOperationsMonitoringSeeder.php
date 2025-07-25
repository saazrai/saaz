<?php

namespace Database\Seeders\Diagnostics;

class D18SecurityOperationsMonitoringSeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Security Operations & Monitoring';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: Security Operations Center (SOC) Operations (10 questions)
            // Bloom Distribution: L1:0, L2:2, L3:4, L4:2, L5:2

            // Item 1 - L3 - Apply
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'Your organization experiences: (1) Multiple failed login attempts from foreign IPs, (2) Unusual data transfers at 3 AM, (3) Malware detected on 5 workstations. The IT team wants to handle these separately. How should a SOC approach these incidents?',
                'options' => [
                    'Treat each incident independently and assign to different team members',
                    'Correlate events through continuous monitoring to identify potential coordinated attack patterns',
                    'Focus only on the malware incident as it\'s the most visible threat',
                    'Escalate all incidents immediately to external security consultants',
                ],
                'correct_options' => ['Correlate events through continuous monitoring to identify potential coordinated attack patterns'],
                'justifications' => [
                    'Incorrect - Isolated treatment misses potential connections between related security events',
                    'Correct - SOC\'s core function is correlating events to detect, analyze, and respond to coordinated threats',
                    'Incorrect - Focusing on single incidents ignores the broader attack landscape and threat correlation',
                    'Incorrect - Immediate escalation without analysis doesn\'t leverage SOC monitoring and detection capabilities',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 2 - L2 - Understand
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'What is the primary role of a Tier 1 SOC analyst?',
                'options' => [
                    'Managing the SOC infrastructure and security tools',
                    'Monitoring alerts and performing initial triage of security events',
                    'Conducting advanced threat hunting and malware analysis',
                    'Training new SOC personnel and developing procedures',
                ],
                'correct_options' => ['Monitoring alerts and performing initial triage of security events'],
                'justifications' => [
                    'Incorrect - Infrastructure management is typically handled by IT operations teams, not Tier 1 SOC analysts who focus on security monitoring',
                    'Correct - Tier 1 SOC analysts serve as the first line of defense, continuously monitoring security alerts and performing initial assessment to determine if events require escalation',
                    'Incorrect - Advanced threat hunting and malware analysis are typically performed by more senior Tier 2 or Tier 3 analysts with specialized expertise',
                    'Incorrect - Training and procedure development are usually responsibilities of senior analysts, team leads, or SOC managers rather than entry-level Tier 1 personnel',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 3 - L2 - Understand
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'Which of the following is NOT a typical SOC procedure?',
                'options' => [
                    'Event triage and classification',
                    'Incident escalation and communication',
                    'Access request approval and provisioning',
                    'Threat intelligence analysis and correlation',
                ],
                'correct_options' => ['Access request approval and provisioning'],
                'justifications' => [
                    'Incorrect - Event triage and classification is a core SOC function where analysts assess and categorize security alerts to determine their severity and required response',
                    'Incorrect - Incident escalation and communication are fundamental SOC procedures for ensuring appropriate stakeholders are notified when security incidents occur',
                    'Correct - Access request approval and provisioning is typically handled by Identity and Access Management (IAM) teams or IT operations, not SOC analysts whose focus is security monitoring and incident response',
                    'Incorrect - Threat intelligence analysis and correlation is a key SOC activity that helps analysts understand current threat landscapes and identify potential security risks',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 4 - L4 - Analyze
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'What is a key challenge in establishing effective SOC governance?',
                'options' => [
                    'Lack of security tools',
                    'Defining clear roles and responsibilities',
                    'Too much access to data',
                    'Over-automation',
                ],
                'correct_options' => ['Defining clear roles and responsibilities'],
                'justifications' => [
                    'Incorrect - While having adequate security tools is important, the lack of tools is typically not the primary governance challenge, as tools can be procured once governance frameworks are established',
                    'Correct - Establishing clear roles and responsibilities is a fundamental governance challenge, as SOCs involve multiple stakeholders, teams, and decision-making processes that require well-defined accountability structures',
                    'Incorrect - Too much access to data is generally not a primary governance challenge; rather, SOCs typically struggle with getting sufficient access to relevant data for effective monitoring and analysis',
                    'Incorrect - Over-automation is rarely a governance challenge in SOC establishment, as most organizations struggle with under-automation rather than excessive automation in their security operations',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 5 - L2 - Understand
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'What is the main challenge of excessive alerting in a SOC?',
                'options' => [
                    'Too few incidents detected',
                    'Alert fatigue and slower response',
                    'Reduced storage capacity',
                    'Slower network performance',
                ],
                'correct_options' => ['Alert fatigue and slower response'],
                'justifications' => [
                    'Incorrect - Excessive alerting typically indicates over-detection rather than under-detection of incidents, leading to too many alerts rather than too few',
                    'Correct - Excessive alerting causes alert fatigue where analysts become overwhelmed and desensitized, leading to slower response times and potential missed critical incidents',
                    'Incorrect - While alerts consume some storage, the primary challenge is operational impact on analysts rather than storage capacity limitations',
                    'Incorrect - Alert generation and processing typically have minimal impact on network performance compared to the human operational challenges they create',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 6 - L3 - Apply
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'What is the most effective approach for a SOC to handle incident response during a major security breach?',
                'options' => [
                    'Immediately shut down all systems to prevent further damage',
                    'Follow established incident response procedures with clear communication and documentation',
                    'Wait for executive management approval before taking any action',
                    'Focus only on technical remediation without involving other departments',
                ],
                'correct_options' => ['Follow established incident response procedures with clear communication and documentation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Follow established incident response procedures with clear communication and documentation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 7 - L2 - Understand
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'What is a key performance indicator (KPI) for measuring the efficiency of a SOC\'s incident response process?',
                'options' => [
                    'Number of firewall rules configured',
                    'Volume of logs ingested per day',
                    'Mean Time to Respond (MTTR)',
                    'Number of open support tickets',
                ],
                'correct_options' => ['Mean Time to Respond (MTTR)'],
                'justifications' => [
                    'Incorrect - The number of firewall rules configured is a technical configuration metric that does not measure the efficiency or effectiveness of incident response processes',
                    'Incorrect - Volume of logs ingested per day measures data collection capacity but does not indicate how efficiently the SOC responds to actual security incidents',
                    'Correct - Mean Time to Respond (MTTR) directly measures how quickly the SOC can respond to security incidents, making it a key efficiency indicator for incident response processes',
                    'Incorrect - Number of open support tickets is a general IT service metric that does not specifically measure the efficiency of security incident response activities',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 8 - L4 - Analyze
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'In a large enterprise, a decentralized SOC model might be chosen for what primary reason?',
                'options' => [
                    'Reduced overall security budget',
                    'Compliance with local regulations',
                    'Simplification of tool deployment',
                    'Elimination of central oversight',
                ],
                'correct_options' => ['Compliance with local regulations'],
                'justifications' => [
                    'Incorrect - Decentralized SOC models typically increase costs due to duplicated resources, infrastructure, and staffing across multiple locations rather than reducing overall security budget',
                    'Correct - Large enterprises often choose decentralized SOC models to comply with local data sovereignty laws, regulatory requirements that mandate in-country monitoring, and jurisdiction-specific compliance obligations',
                    'Incorrect - Decentralized models actually complicate tool deployment by requiring management of multiple installations, configurations, and integrations across different locations',
                    'Incorrect - Decentralized SOCs still require central oversight and coordination to maintain consistent security standards and threat intelligence sharing across the enterprise',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.6,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 9 - L3 - Apply
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'For a small organization with limited resources, which SOC model is often most cost-effective?',
                'options' => [
                    'Fully in-house',
                    'Outsourced (MSSP)',
                    'Global SOC',
                    'Compliance-only',
                ],
                'correct_options' => ['Outsourced (MSSP)'],
                'justifications' => [
                    'Incorrect - Fully in-house SOCs require significant capital investment in infrastructure, tools, and specialized personnel that small organizations often cannot afford or justify',
                    'Correct - Outsourced MSSP models provide cost-effective access to enterprise-grade security monitoring, expertise, and 24/7 coverage without the overhead of building internal capabilities',
                    'Incorrect - Global SOC models are typically used by large multinational organizations and involve higher costs and complexity that exceed small organization requirements and budgets',
                    'Incorrect - Compliance-only approaches focus narrowly on regulatory requirements rather than comprehensive security operations, leaving organizations vulnerable to threats outside compliance scope',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 10 - L2 - Understand
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'SOC effectiveness is primarily measured by its ability to:',
                'options' => [
                    'Generate many alerts daily',
                    'Proactively identify and respond to incidents',
                    'Occupy a large physical space',
                    'Collect vast amounts of data',
                ],
                'correct_options' => ['Proactively identify and respond to incidents'],
                'justifications' => [
                    'Incorrect - Generating many alerts daily often indicates poor tuning and creates alert fatigue rather than demonstrating effective security operations',
                    'Correct - SOC effectiveness is fundamentally measured by the ability to proactively detect threats, rapidly respond to incidents, and minimize security impact through timely intervention',
                    'Incorrect - Physical space size has no correlation with SOC effectiveness and does not contribute to security outcomes or operational capabilities',
                    'Incorrect - Collecting vast amounts of data without proper analysis and actionable insights does not improve security posture and can actually hinder effective operations',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Topic 2: Log Management & Analysis (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L1 - Remember
            [
                'subtopic' => 'Log Management',
                'question' => 'In Linux, syslog uses different severity levels to categorize messages. Which of the following correctly matches the severity level to its numeric value?',
                'options' => [
                    'Emergency: 0, Warning: 4, Debug: 7',
                    'Emergency: 1, Alert: 2, Error: 3',
                    'Alert: 0, Critical: 1, Notice: 5',
                    'Debug: 0, Critical: 4, Emergency: 7',
                ],
                'correct_options' => ['Emergency: 0, Warning: 4, Debug: 7'],
                'justifications' => [
                    'Correct - In Linux syslog, Emergency has the highest priority (0), Warning is assigned level 4, and Debug has the lowest priority (7), following the RFC 3164 standard',
                    'Incorrect - This sequence incorrectly assigns Emergency to level 1 instead of 0, and does not follow the standard syslog severity level numbering system',
                    'Incorrect - This option incorrectly assigns Alert to level 0 (which should be Emergency) and Critical to level 1 (which should be Alert), violating the RFC standard',
                    'Incorrect - This completely reverses the severity hierarchy by assigning Debug the highest priority (0) and Emergency the lowest priority (7), which is opposite to the actual standard',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 12 - L2 - Understand
            [
                'subtopic' => 'Log Management',
                'question' => 'What is the primary purpose of log normalization in a SIEM system?',
                'options' => [
                    'To reduce storage space by compressing log files',
                    'To convert logs from different sources into a consistent, standardized format',
                    'To encrypt sensitive information within log entries',
                    'To automatically delete unnecessary log data',
                ],
                'correct_options' => ['To convert logs from different sources into a consistent, standardized format'],
                'justifications' => [
                    'Incorrect - While compression can reduce storage space, log normalization is not primarily about data compression but rather about format standardization',
                    'Correct - Log normalization converts diverse log formats from different systems (firewalls, servers, applications) into a unified structure, enabling consistent parsing, correlation, and analysis across all data sources',
                    'Incorrect - Encryption of sensitive log data is a separate security function and not the primary purpose of normalization, which focuses on format standardization',
                    'Incorrect - Automatic deletion of log data is related to retention policies and data lifecycle management, not to the normalization process that standardizes format structures',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 13 - L3 - Apply
            [
                'subtopic' => 'Log Management',
                'question' => 'Why is event correlation critical in a SIEM system?',
                'options' => [
                    'To reduce the number of log files stored in the system',
                    'To detect complex attack patterns that span multiple systems and time periods',
                    'To automatically patch vulnerabilities discovered in log analysis',
                    'To improve the speed of log data collection processes',
                ],
                'correct_options' => ['To detect complex attack patterns that span multiple systems and time periods'],
                'justifications' => [
                    'Incorrect - Event correlation is not focused on reducing log storage but rather on analyzing relationships between events to identify security threats',
                    'Correct - Event correlation enables SIEM systems to identify sophisticated attacks by connecting seemingly unrelated events across different systems, time frames, and data sources to reveal complex attack campaigns',
                    'Incorrect - SIEM systems perform analysis and detection but do not automatically patch vulnerabilities - that requires separate vulnerability management and patch deployment processes',
                    'Incorrect - Event correlation focuses on analyzing relationships between events for threat detection, not on improving the technical performance of log collection mechanisms',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 14 - L1 - Remember
            [
                'subtopic' => 'Log Management',
                'question' => 'Which Event ID in Windows Event Viewer is typically associated with detecting multiple failed login attempts, which could indicate a brute-force attack?',
                'options' => [
                    'Event ID 4624',
                    'Event ID 4625',
                    'Event ID 4672',
                    'Event ID 4771',
                ],
                'correct_options' => ['Event ID 4625'],
                'justifications' => [
                    'Incorrect - Event ID 4624 indicates a successful logon event, which represents legitimate authentication rather than failed login attempts that characterize brute-force attacks',
                    'Correct - Event ID 4625 represents failed logon attempts in Windows Security logs, and multiple occurrences of this event can indicate brute-force attack patterns',
                    'Incorrect - Event ID 4672 indicates special privileges assigned to a new logon, which is related to privilege escalation rather than failed authentication attempts',
                    'Incorrect - Event ID 4771 is related to Kerberos pre-authentication failures, which while security-relevant, is not the primary indicator for brute-force login detection',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 15 - L2 - Understand
            [
                'subtopic' => 'Log Management',
                'question' => 'Which of the following best meets compliance requirements for log retention?',
                'options' => [
                    'Retain logs for 3 days only',
                    'Delete logs older than 30 days',
                    'Follow applicable regulatory retention durations',
                    'Store logs only in endpoint agents',
                ],
                'correct_options' => ['Follow applicable regulatory retention durations'],
                'justifications' => [
                    'Incorrect - A 3-day retention period is insufficient for most compliance requirements, which typically mandate much longer retention periods for audit and investigation purposes',
                    'Incorrect - A blanket 30-day deletion policy may not meet specific regulatory requirements that often require retention periods of months or years depending on the industry and data type',
                    'Correct - Compliance requirements vary by industry and regulation (HIPAA, SOX, PCI-DSS, etc.) with specific retention durations, and organizations must follow these applicable regulatory mandates',
                    'Incorrect - Storing logs only in endpoint agents creates availability and centralization issues, and does not address the retention duration requirements specified by compliance frameworks',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 16 - L1 - Remember
            [
                'subtopic' => 'Log Management',
                'question' => 'Windows log-on and log-off activities are stored under which category in Event Viewer?',
                'options' => [
                    'Application',
                    'Security',
                    'System',
                    'Setup',
                ],
                'correct_options' => ['Security'],
                'justifications' => [
                    'Incorrect - Application logs contain events logged by applications and programs, not Windows authentication activities like logon and logoff events',
                    'Correct - Security logs in Windows Event Viewer contain authentication and authorization events including logon/logoff activities, privilege use, and access control events',
                    'Incorrect - System logs contain events logged by Windows system components and services, but not user authentication activities like logon and logoff events',
                    'Incorrect - Setup logs contain events related to application installation and system setup processes, not ongoing authentication activities like logon and logoff events',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.0,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 17 - L1 - Remember
            [
                'subtopic' => 'Log Management',
                'question' => 'Which of the following is the correct set of Windows Event types categorized in the Event Viewer?',
                'options' => [
                    'Information, Error, Success Audit, Failure Audit',
                    'Error, Warning, Security, Critical',
                    'Information, Warning, Error, Audit Success, Audit Failure',
                    'Critical, Audit, Warning, Error, Information',
                ],
                'correct_options' => ['Information, Warning, Error, Audit Success, Audit Failure'],
                'justifications' => [
                    'Incorrect - While this includes some correct event types, "Success Audit" and "Failure Audit" are not the standard terminology used in Windows Event Viewer classifications',
                    'Incorrect - This option incorrectly includes "Security" as an event type rather than a log category, and omits several standard event types like Information and Warning',
                    'Correct - Windows Event Viewer categorizes events into these five standard types: Information (informational events), Warning (potential problems), Error (significant problems), Audit Success (successful security events), and Audit Failure (failed security events)',
                    'Incorrect - While this includes some valid event types, "Audit" by itself is not a standard event type, and the order does not reflect the typical Windows Event Viewer classification system',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.7,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 18 - L1 - Remember
            [
                'subtopic' => 'Log Management',
                'question' => 'Most of the Linux system logs are located in which directory?',
                'options' => [
                    '/var/log',
                    '/etc/log',
                    '/usr/log',
                    '/opt/log',
                ],
                'correct_options' => ['/var/log'],
                'justifications' => [
                    'Correct - /var/log is the standard directory in Linux systems where most system logs are stored, including syslog, kernel logs, application logs, and security logs',
                    'Incorrect - /etc/log is not a standard Linux directory for system logs; /etc typically contains configuration files rather than log files',
                    'Incorrect - /usr/log is not a standard directory for Linux system logs; /usr typically contains user programs and data rather than system log files',
                    'Incorrect - /opt/log is not a standard Linux directory for system logs; /opt typically contains optional software packages rather than system log files',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 19 - L1 - Remember
            [
                'subtopic' => 'Log Management',
                'question' => 'Linux operating systems generate log files that can be classified into four different categories. Which of the following are the correct categories of Linux log files?',
                'options' => [
                    'System logs, service logs, application logs, event logs',
                    'Kernel logs, user logs, error logs, application logs',
                    'Debug logs, security logs, kernel logs, system logs',
                    'Error logs, performance logs, security logs, user logs',
                ],
                'correct_options' => ['System logs, service logs, application logs, event logs'],
                'justifications' => [
                    'Correct - Linux log files are typically categorized into these four main types: System logs (general system activities), Service logs (daemon and service activities), Application logs (user application activities), and Event logs (specific system events)',
                    'Incorrect - While this includes some valid log types, "user logs" is not a standard Linux log category, and "error logs" is more of a severity level than a category type',
                    'Incorrect - This option mixes severity levels (debug) with categories and omits key categories like service logs and application logs that are fundamental to Linux logging',
                    'Incorrect - This option focuses on severity levels and specific types rather than the four main categorical classifications used to organize Linux log files systematically',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'irt_a' => 0.9,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 20 - L5 - Evaluate
            [
                'subtopic' => 'Log Management',
                'question' => 'Assess the effectiveness of using machine learning for anomaly detection in log analysis.',
                'options' => [
                    'Machine learning eliminates all false positives in log analysis',
                    'ML can improve detection of unknown threats but requires tuning and human validation',
                    'Machine learning is inappropriate for log analysis applications',
                    'ML-based anomaly detection works perfectly without any configuration',
                ],
                'correct_options' => ['ML can improve detection of unknown threats but requires tuning and human validation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - ML can improve detection of unknown threats but requires tuning and human validation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 3: Threat Detection & Intelligence (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L1 - Remember
            [
                'subtopic' => 'Detection',
                'question' => 'When an IDS does not detect an attack, it is known as?',
                'options' => [
                    'False Positive',
                    'False Negative',
                    'True Positive',
                    'True Negative',
                ],
                'correct_options' => ['False Negative'],
                'justifications' => [
                    'Incorrect - A false positive occurs when the IDS incorrectly identifies benign activity as malicious, not when it fails to detect an actual attack',
                    'Correct - A false negative occurs when an IDS fails to detect an actual attack that is occurring, missing a real security threat',
                    'Incorrect - A true positive occurs when the IDS correctly identifies and alerts on an actual attack, which is the opposite of not detecting an attack',
                    'Incorrect - A true negative occurs when the IDS correctly does not alert on benign activity, not when it fails to detect an actual attack',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 22 - L4 - Analyze
            [
                'subtopic' => 'Detection',
                'question' => 'Which of the following represents the greatest risk to an organization in the context of Intrusion Prevention System (IPS) errors?',
                'options' => [
                    'False Positive',
                    'False Negative',
                    'True Positive',
                    'True Negative',
                ],
                'correct_options' => ['False Negative'],
                'justifications' => [
                    'Incorrect - While false positives can cause business disruption by blocking legitimate traffic, they do not allow actual attacks to succeed',
                    'Correct - False negatives represent the greatest risk because the IPS fails to block actual attacks, allowing malicious traffic to reach targets and potentially cause system compromise, data loss, or other serious security incidents',
                    'Incorrect - True positives are correct detections that successfully block actual attacks, representing proper IPS function rather than risk',
                    'Incorrect - True negatives are correct decisions to allow legitimate traffic, representing proper IPS function rather than risk',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => 0.1,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 23 - L2 - Understand
            [
                'subtopic' => 'Detection',
                'question' => 'A false positive in an Intrusion Prevention System (IPS) could potentially result in:',
                'options' => [
                    'business disruption',
                    'system compromise',
                    'data exfiltration',
                    'privilege escalation',
                ],
                'correct_options' => ['business disruption'],
                'justifications' => [
                    'Correct - False positives occur when an IPS incorrectly identifies legitimate traffic as malicious and blocks it, potentially disrupting normal business operations and blocking legitimate user access',
                    'Incorrect - System compromise results from false negatives (missed attacks) or actual successful attacks, not from false positive detections',
                    'Incorrect - Data exfiltration occurs when attackers successfully steal data, which would result from false negatives allowing attacks through, not false positives',
                    'Incorrect - Privilege escalation is an attack technique that succeeds when threats are not detected (false negatives), not when legitimate traffic is incorrectly blocked (false positives)',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 24 - L3 - Apply
            [
                'subtopic' => 'Detection',
                'question' => 'Alice wants to improve the detection capabilities for her security environment. A major concern for her company is detection of insider threats. What type of technology can she deploy to help with this type of proactive threat detection?',
                'options' => [
                    'IDS',
                    'UEBA',
                    'SOAR',
                    'SIEM',
                ],
                'correct_options' => ['UEBA'],
                'justifications' => [
                    'Incorrect - IDS (Intrusion Detection System) primarily focuses on network-based threat detection and is less effective at identifying insider threats based on user behavior patterns',
                    'Correct - UEBA (User and Entity Behavior Analytics) is specifically designed to detect insider threats by analyzing user behavior patterns, identifying anomalies, and detecting unusual activities that may indicate malicious insider activity',
                    'Incorrect - SOAR (Security Orchestration, Automation, and Response) is focused on automating incident response workflows rather than proactive threat detection',
                    'Incorrect - While SIEM (Security Information and Event Management) can help with threat detection, UEBA is more specialized and effective for insider threat detection through behavioral analysis',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 25 - L1 - Remember
            [
                'subtopic' => 'Detection',
                'question' => 'Which type of IDS detects threats by comparing traffic to known patterns or signatures?',
                'options' => [
                    'Behavioral IDS',
                    'Signature-based IDS',
                    'Anomaly-based IDS',
                    'Statistical IDS',
                ],
                'correct_options' => ['Signature-based IDS'],
                'justifications' => [
                    'Incorrect - Behavioral IDS analyzes user and system behavior patterns rather than comparing traffic to predefined signatures or known attack patterns',
                    'Correct - Signature-based IDS works by comparing network traffic and system activities against a database of known attack signatures and malicious patterns',
                    'Incorrect - Anomaly-based IDS detects threats by identifying deviations from established baselines of normal behavior rather than using predefined signatures',
                    'Incorrect - Statistical IDS uses statistical analysis to identify unusual patterns but does not rely on comparing traffic to known signatures like signature-based systems',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 26 - L2 - Understand
            [
                'subtopic' => 'Detection',
                'question' => 'What is a key benefit of SOAR for a SOC team?',
                'options' => [
                    'Increased manual effort',
                    'Reduction in false positives',
                    'Faster, more consistent incident response',
                    'Elimination of human analysts',
                ],
                'correct_options' => ['Faster, more consistent incident response'],
                'justifications' => [
                    'Incorrect - SOAR (Security Orchestration, Automation, and Response) is designed to reduce manual effort through automation, not increase it',
                    'Incorrect - While SOAR can help with workflow efficiency, reducing false positives is primarily achieved through better detection tuning and analytics, not orchestration platforms',
                    'Correct - SOAR enables faster, more consistent incident response by automating repetitive tasks, standardizing procedures, and orchestrating coordinated responses across security tools',
                    'Incorrect - SOAR enhances human analyst capabilities through automation but does not eliminate the need for human expertise, judgment, and oversight in security operations',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 27 - L3 - Apply
            [
                'subtopic' => 'Detection',
                'question' => 'What is the most effective approach for integrating external threat intelligence into internal detection systems?',
                'options' => [
                    'Manually review all threat intelligence reports daily',
                    'Automate ingestion with contextual analysis and validation against organizational environment',
                    'Only use free threat intelligence sources to reduce costs',
                    'Apply all external IOCs without any filtering or validation',
                ],
                'correct_options' => ['Automate ingestion with contextual analysis and validation against organizational environment'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Automate ingestion with contextual analysis and validation against organizational environment',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
                'subtopic' => 'Detection',
                'question' => 'Analyze why attribution of cyber attacks is challenging and often unreliable for defensive decision-making.',
                'options' => [
                    'Attribution is always accurate with proper forensic analysis',
                    'Attackers use false flags, shared tools, and proxy infrastructure to obscure true identity',
                    'Attribution is only difficult for nation-state level attacks',
                    'Attribution challenges only affect law enforcement, not defensive strategies',
                ],
                'correct_options' => ['Attackers use false flags, shared tools, and proxy infrastructure to obscure true identity'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Attackers use false flags, shared tools, and proxy infrastructure to obscure true identity',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
                'subtopic' => 'Detection',
                'question' => 'What is the fundamental limitation of relying solely on known IOCs for threat detection?',
                'options' => [
                    'IOCs are too expensive to collect and maintain',
                    'Attackers can easily change IOCs while maintaining the same attack methods and objectives',
                    'IOCs only work for network-based attacks, not endpoint attacks',
                    'IOC-based detection requires specialized hardware',
                ],
                'correct_options' => ['Attackers can easily change IOCs while maintaining the same attack methods and objectives'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Attackers can easily change IOCs while maintaining the same attack methods and objectives',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
                'subtopic' => 'Detection',
                'question' => 'A company implements multiple overlapping threat detection technologies but still experiences successful attacks. Evaluate their detection strategy.',
                'options' => [
                    'Multiple detection tools always guarantee perfect security',
                    'Detection effectiveness requires integration, tuning, and skilled analysis rather than just tool quantity',
                    'The company should eliminate all detection tools to reduce complexity',
                    'Overlapping detection technologies are always counterproductive',
                ],
                'correct_options' => ['Detection effectiveness requires integration, tuning, and skilled analysis rather than just tool quantity'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Detection effectiveness requires integration, tuning, and skilled analysis rather than just tool quantity',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 4: Incident Response & Forensics (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L1 - Remember
            [
                'subtopic' => 'Response',
                'question' => 'What are the six phases of the NIST Incident Response lifecycle?',
                'options' => [
                    'Prevention, Detection, Analysis, Containment, Recovery, Lessons Learned',
                    'Preparation, Detection & Analysis, Containment Eradication & Recovery, Post-Incident Activity',
                    'Identify, Protect, Detect, Respond, Recover, Monitor',
                    'Plan, Assess, Implement, Monitor, Review, Improve',
                ],
                'correct_options' => ['Preparation, Detection & Analysis, Containment Eradication & Recovery, Post-Incident Activity'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Preparation, Detection & Analysis, Containment Eradication & Recovery, Post-Incident Activity',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 32 - L3 - Apply
            [
                'subtopic' => 'Response',
                'question' => 'Which tool is most suitable for automatically assigning incidents to appropriate teams?',
                'options' => [
                    'IDS',
                    'UEBA',
                    'SOAR',
                    'VPN',
                ],
                'correct_options' => ['SOAR'],
                'justifications' => [
                    'Incorrect - IDS (Intrusion Detection System) is designed for threat detection and alerting, not for incident assignment or workflow automation',
                    'Incorrect - UEBA (User and Entity Behavior Analytics) focuses on behavioral analysis and anomaly detection, not on incident workflow management and team assignment',
                    'Correct - SOAR (Security Orchestration, Automation, and Response) platforms are specifically designed to automate incident response workflows, including intelligent assignment of incidents to appropriate teams based on predefined criteria',
                    'Incorrect - VPN (Virtual Private Network) provides secure remote access connectivity and has no relationship to incident management or team assignment processes',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 2,
                'irt_a' => 1.2,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 33 - L2 - Understand
            [
                'subtopic' => 'Response',
                'question' => 'Why is rapid containment critical in incident response, even before complete analysis?',
                'options' => [
                    'Containment reduces the cost of incident response',
                    'Rapid containment limits damage spread and preserves evidence for analysis',
                    'Containment eliminates the need for further investigation',
                    'Rapid containment automatically resolves all security incidents',
                ],
                'correct_options' => ['Rapid containment limits damage spread and preserves evidence for analysis'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Rapid containment limits damage spread and preserves evidence for analysis',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
                'subtopic' => 'Response',
                'question' => 'How does memory forensics differ from disk forensics in incident investigation?',
                'options' => [
                    'Memory forensics is always easier than disk forensics',
                    'Memory forensics captures volatile data and running processes, while disk forensics examines persistent storage',
                    'Memory forensics only works on Windows systems',
                    'There is no significant difference between memory and disk forensics',
                ],
                'correct_options' => ['Memory forensics captures volatile data and running processes, while disk forensics examines persistent storage'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Memory forensics captures volatile data and running processes, while disk forensics examines persistent storage',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 35 - L3 - Apply
            [
                'subtopic' => 'Response',
                'question' => 'During a ransomware incident, what should be the immediate priority for the incident response team?',
                'options' => [
                    'Negotiate with attackers to minimize ransom demands',
                    'Isolate affected systems and assess spread while preserving evidence',
                    'Immediately restore all systems from the most recent backups',
                    'Focus on identifying the attack vector before any containment',
                ],
                'correct_options' => ['Isolate affected systems and assess spread while preserving evidence'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Isolate affected systems and assess spread while preserving evidence',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 36 - L3 - Apply
            [
                'subtopic' => 'Response',
                'question' => 'How should an organization handle communication during a major data breach incident?',
                'options' => [
                    'Maintain complete silence until the investigation is finished',
                    'Implement coordinated internal and external communication following legal and regulatory requirements',
                    'Immediately disclose all known details to the public',
                    'Only communicate with law enforcement and ignore other stakeholders',
                ],
                'correct_options' => ['Implement coordinated internal and external communication following legal and regulatory requirements'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement coordinated internal and external communication following legal and regulatory requirements',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 37 - L3 - Apply
            [
                'subtopic' => 'Response',
                'question' => 'What is the most critical factor when deciding whether to involve law enforcement in a cybersecurity incident?',
                'options' => [
                    'The potential media attention from the incident',
                    'Severity of impact, legal requirements, and investigative needs',
                    'The cost of external forensic investigation services',
                    'Whether the attack originated from international sources',
                ],
                'correct_options' => ['Severity of impact, legal requirements, and investigative needs'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Severity of impact, legal requirements, and investigative needs',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 38 - L4 - Analyze
            [
                'subtopic' => 'Response',
                'question' => 'Analyze why traditional backup and recovery strategies may be insufficient for ransomware incident response.',
                'options' => [
                    'Backups are too expensive for most organizations to maintain',
                    'Ransomware may compromise backup systems and data integrity before encryption occurs',
                    'Backup systems are incompatible with modern IT infrastructure',
                    'Recovery from backups is always faster than paying ransom',
                ],
                'correct_options' => ['Ransomware may compromise backup systems and data integrity before encryption occurs'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Ransomware may compromise backup systems and data integrity before encryption occurs',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
                'subtopic' => 'Response',
                'question' => 'What is the fundamental challenge in conducting forensic analysis of cloud-based incidents?',
                'options' => [
                    'Cloud environments are inherently more secure than on-premises',
                    'Ephemeral infrastructure, shared responsibility, and limited forensic access complicate investigation',
                    'Cloud providers always handle all forensic analysis automatically',
                    'Forensic tools cannot operate in cloud environments',
                ],
                'correct_options' => ['Ephemeral infrastructure, shared responsibility, and limited forensic access complicate investigation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Ephemeral infrastructure, shared responsibility, and limited forensic access complicate investigation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
                'subtopic' => 'Response',
                'question' => 'An organization\'s incident response plan prioritizes business continuity over forensic evidence preservation. Evaluate this approach.',
                'options' => [
                    'Business continuity should always take absolute priority over forensics',
                    'Organizations must balance business needs with legal, regulatory, and security investigation requirements',
                    'Forensic evidence should always take priority over business operations',
                    'There is never any conflict between business continuity and forensic preservation',
                ],
                'correct_options' => ['Organizations must balance business needs with legal, regulatory, and security investigation requirements'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Organizations must balance business needs with legal, regulatory, and security investigation requirements',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 5: Security Monitoring & Metrics (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 41 - L4 - Analyze
            [
                'subtopic' => 'Monitoring',
                'question' => 'What is a limitation of traditional SIEM systems?',
                'options' => [
                    'Lack of centralized log collection',
                    'No real-time alerting',
                    'High false positives and limited behavioral context',
                    'Inability to ingest syslogs',
                ],
                'correct_options' => ['High false positives and limited behavioral context'],
                'justifications' => [
                    'Incorrect - Centralized log collection is actually a core strength of SIEM systems, not a limitation, as they are specifically designed to aggregate logs from multiple sources',
                    'Incorrect - Real-time alerting is a fundamental capability of SIEM systems, enabling immediate notification of security events and threats as they occur',
                    'Correct - Traditional SIEM systems often generate excessive false positives due to rule-based detection and lack sophisticated behavioral analysis capabilities that provide context for distinguishing legitimate activities from actual threats',
                    'Incorrect - Syslog ingestion is a standard feature of SIEM systems, as they are designed to collect and process various log formats including syslogs from network devices and servers',
                ],
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 42 - L2 - Understand
            [
                'subtopic' => 'Monitoring',
                'question' => 'What is the purpose of a "Service Level Objective (SLO)" in a SOC?',
                'options' => [
                    'Define employee salaries',
                    'Set measurable targets for SOC processes',
                    'Outline the SOC\'s physical layout',
                    'List all security tools',
                ],
                'correct_options' => ['Set measurable targets for SOC processes'],
                'justifications' => [
                    'Incorrect - Employee salaries are determined by human resources policies and compensation structures, not by Service Level Objectives which focus on operational performance',
                    'Correct - SLOs establish measurable performance targets for SOC processes such as incident response times, detection rates, and availability metrics to ensure service quality',
                    'Incorrect - Physical layout planning is related to facility management and space design, not to Service Level Objectives which define performance standards',
                    'Incorrect - Security tool inventories are maintained in asset management systems, not in Service Level Objectives which focus on measurable performance targets',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 43 - L2 - Understand
            [
                'subtopic' => 'Monitoring',
                'question' => '"Tuning" a monitoring system primarily involves:',
                'options' => [
                    'Disabling all alerts',
                    'Adjusting rules to reduce false positives',
                    'Increasing data collection',
                    'Changing dashboard colors',
                ],
                'correct_options' => ['Adjusting rules to reduce false positives'],
                'justifications' => [
                    'Incorrect - Disabling all alerts would eliminate security monitoring capabilities entirely, which defeats the purpose of having a monitoring system',
                    'Correct - Tuning involves adjusting detection rules, thresholds, and parameters to optimize the balance between detecting real threats and minimizing false positive alerts',
                    'Incorrect - While data collection may be adjusted during tuning, the primary focus is on improving detection accuracy rather than simply increasing data volume',
                    'Incorrect - Dashboard colors are cosmetic user interface elements that do not affect the monitoring system\'s detection capabilities or performance',
                ],
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 44 - L2 - Understand
            [
                'subtopic' => 'Monitoring',
                'question' => 'How do leading indicators differ from lagging indicators in security metrics?',
                'options' => [
                    'Leading indicators are more expensive to measure than lagging indicators',
                    'Leading indicators predict future security posture while lagging indicators measure past performance',
                    'Leading indicators are only used by technical teams',
                    'Leading indicators require more complex measurement tools',
                ],
                'correct_options' => ['Leading indicators predict future security posture while lagging indicators measure past performance'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Leading indicators predict future security posture while lagging indicators measure past performance',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
                'subtopic' => 'Monitoring',
                'question' => 'A retail company wants to measure the effectiveness of their security awareness training program. What metrics should they track?',
                'options' => [
                    'Only the number of employees who completed training',
                    'Training completion rates, phishing simulation results, and security incident reporting trends',
                    'Just the cost per employee for training delivery',
                    'Only the time spent in training sessions',
                ],
                'correct_options' => ['Training completion rates, phishing simulation results, and security incident reporting trends'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Training completion rates, phishing simulation results, and security incident reporting trends',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
                'subtopic' => 'Monitoring',
                'question' => 'How should an organization implement continuous security monitoring in a DevOps environment?',
                'options' => [
                    'Only monitor production systems after deployment',
                    'Integrate security monitoring throughout the CI/CD pipeline with automated feedback',
                    'Perform monthly security reviews of all systems',
                    'Only monitor traditional infrastructure, not containerized applications',
                ],
                'correct_options' => ['Integrate security monitoring throughout the CI/CD pipeline with automated feedback'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Integrate security monitoring throughout the CI/CD pipeline with automated feedback',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
                'subtopic' => 'Monitoring',
                'question' => 'What is the most effective approach for presenting security metrics to executive leadership?',
                'options' => [
                    'Provide detailed technical logs and raw data',
                    'Focus on business impact, risk reduction, and trend analysis with clear visualizations',
                    'Only report metrics when security incidents occur',
                    'Use complex statistical analysis without interpretation',
                ],
                'correct_options' => ['Focus on business impact, risk reduction, and trend analysis with clear visualizations'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Focus on business impact, risk reduction, and trend analysis with clear visualizations',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
                'subtopic' => 'Monitoring',
                'question' => 'Analyze why vanity metrics can be counterproductive for security program management.',
                'options' => [
                    'Vanity metrics are too expensive to collect',
                    'They may look impressive but do not provide actionable insights for security improvement',
                    'Vanity metrics require specialized tools to measure',
                    'They are only appropriate for large organizations',
                ],
                'correct_options' => ['They may look impressive but do not provide actionable insights for security improvement'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - They may look impressive but do not provide actionable insights for security improvement',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
                'subtopic' => 'Monitoring',
                'question' => 'What is the fundamental challenge in correlating security events across hybrid cloud and on-premises environments?',
                'options' => [
                    'Hybrid environments do not generate security events',
                    'Different platforms, time synchronization, and data formats create correlation complexity',
                    'Correlation is only possible within single cloud providers',
                    'On-premises systems cannot integrate with cloud monitoring',
                ],
                'correct_options' => ['Different platforms, time synchronization, and data formats create correlation complexity'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Different platforms, time synchronization, and data formats create correlation complexity',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
                'subtopic' => 'Monitoring',
                'question' => 'An organization implements comprehensive security monitoring but struggles with alert fatigue and false positives. Assess their monitoring strategy.',
                'options' => [
                    'More monitoring always improves security effectiveness',
                    'Effective monitoring requires balance between coverage and actionability through tuning and prioritization',
                    'Organizations should eliminate all automated monitoring',
                    'False positives indicate monitoring systems are working correctly',
                ],
                'correct_options' => ['Effective monitoring requires balance between coverage and actionability through tuning and prioritization'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Effective monitoring requires balance between coverage and actionability through tuning and prioritization',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
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
