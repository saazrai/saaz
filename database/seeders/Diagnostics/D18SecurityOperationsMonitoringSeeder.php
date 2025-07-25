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
                    'Escalate all incidents immediately to external security consultants'
                ],
                'correct_options' => ['Correlate events through continuous monitoring to identify potential coordinated attack patterns'],
                'justifications' => [
                    'Incorrect - Isolated treatment misses potential connections between related security events',
                    'Correct - SOC\'s core function is correlating events to detect, analyze, and respond to coordinated threats',
                    'Incorrect - Focusing on single incidents ignores the broader attack landscape and threat correlation',
                    'Incorrect - Immediate escalation without analysis doesn\'t leverage SOC monitoring and detection capabilities'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 2 - L2 - Understand
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'How do Tier 1, Tier 2, and Tier 3 SOC analysts differ in their responsibilities?',
                'options' => [
                    'They work different shifts but have identical responsibilities',
                    'Tier 1 handles initial triage, Tier 2 performs deeper analysis, Tier 3 focuses on advanced threats',
                    'Tier 1 manages infrastructure, Tier 2 handles incidents, Tier 3 trains staff',
                    'All tiers perform the same tasks with different security clearance levels'
                ],
                'correct_options' => ['Tier 1 handles initial triage, Tier 2 performs deeper analysis, Tier 3 focuses on advanced threats'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Tier 1 handles initial triage, Tier 2 performs deeper analysis, Tier 3 focuses on advanced threats',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 3 - L2 - Understand
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'Why is 24/7 operation critical for modern SOC effectiveness?',
                'options' => [
                    'To comply with regulatory requirements for business hours',
                    'Cyber threats operate continuously and attacks can occur at any time',
                    'To provide technical support to employees during off-hours',
                    'To perform system maintenance during low-usage periods'
                ],
                'correct_options' => ['Cyber threats operate continuously and attacks can occur at any time'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Cyber threats operate continuously and attacks can occur at any time',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 4 - L3 - Apply
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'A financial services company is building a new SOC. What should be their first priority in establishing effective operations?',
                'options' => [
                    'Hiring the maximum number of security analysts possible',
                    'Defining clear processes, playbooks, and escalation procedures',
                    'Purchasing the most expensive security tools available',
                    'Outsourcing all SOC operations to reduce costs'
                ],
                'correct_options' => ['Defining clear processes, playbooks, and escalation procedures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Defining clear processes, playbooks, and escalation procedures',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 5 - L3 - Apply
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'How should a SOC handle the challenge of alert fatigue among analysts?',
                'options' => [
                    'Ignore low-priority alerts to focus only on critical incidents',
                    'Implement alert tuning, automation, and contextual analysis to reduce false positives',
                    'Hire more analysts to distribute the alert workload',
                    'Disable automated alerting systems that generate too many notifications'
                ],
                'correct_options' => ['Implement alert tuning, automation, and contextual analysis to reduce false positives'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement alert tuning, automation, and contextual analysis to reduce false positives',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 6 - L3 - Apply
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'What is the most effective approach for a SOC to handle incident response during a major security breach?',
                'options' => [
                    'Immediately shut down all systems to prevent further damage',
                    'Follow established incident response procedures with clear communication and documentation',
                    'Wait for executive management approval before taking any action',
                    'Focus only on technical remediation without involving other departments'
                ],
                'correct_options' => ['Follow established incident response procedures with clear communication and documentation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Follow established incident response procedures with clear communication and documentation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 7 - L4 - Analyze
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'Analyze why measuring mean time to detection (MTTD) and mean time to response (MTTR) is crucial for SOC performance.',
                'options' => [
                    'These metrics help justify SOC budget increases to management',
                    'They provide quantifiable measures of SOC effectiveness and help identify improvement areas',
                    'They are required by cybersecurity insurance policies',
                    'These metrics eliminate the need for other SOC performance indicators'
                ],
                'correct_options' => ['They provide quantifiable measures of SOC effectiveness and help identify improvement areas'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - They provide quantifiable measures of SOC effectiveness and help identify improvement areas',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 8 - L4 - Analyze
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'What is the fundamental challenge in maintaining SOC analyst retention and expertise?',
                'options' => [
                    'SOC work requires no specialized skills or training',
                    'High stress, repetitive tasks, and limited career progression create turnover challenges',
                    'SOC analysts prefer to work independently without team collaboration',
                    'SOC operations only require part-time staffing commitments'
                ],
                'correct_options' => ['High stress, repetitive tasks, and limited career progression create turnover challenges'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - High stress, repetitive tasks, and limited career progression create turnover challenges',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 9 - L5 - Evaluate
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'A company considers replacing their internal SOC with a managed security service provider (MSSP). Evaluate this decision.',
                'options' => [
                    'MSSPs always provide superior security outcomes at lower costs',
                    'Decision should balance cost, control, expertise, and organizational risk tolerance',
                    'Internal SOCs are always more effective than outsourced solutions',
                    'This decision should be based solely on cost reduction opportunities'
                ],
                'correct_options' => ['Decision should balance cost, control, expertise, and organizational risk tolerance'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Decision should balance cost, control, expertise, and organizational risk tolerance',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published'
            ],
            
            // Item 10 - L5 - Evaluate
            [
                'subtopic' => 'Security Operations Center (SOC)',
                'question' => 'Assess the effectiveness of implementing artificial intelligence and machine learning in SOC operations.',
                'options' => [
                    'AI/ML completely eliminates the need for human analysts in SOCs',
                    'AI/ML can enhance detection and reduce false positives but requires human oversight and expertise',
                    'AI/ML is inappropriate for cybersecurity applications',
                    'AI/ML should only be used for network monitoring, not security analysis'
                ],
                'correct_options' => ['AI/ML can enhance detection and reduce false positives but requires human oversight and expertise'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - AI/ML can enhance detection and reduce false positives but requires human oversight and expertise',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published'
            ],
            
            // Topic 2: Log Management & Analysis (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2
            
            // Item 11 - L1 - Remember
            [
                'subtopic' => 'Log Management',
                'question' => 'What is the primary purpose of centralized log management in security operations?',
                'options' => [
                    'Reducing storage costs for log data',
                    'Aggregating, correlating, and analyzing log data from multiple sources for security insights',
                    'Improving system performance by reducing log overhead',
                    'Meeting compliance requirements for data retention'
                ],
                'correct_options' => ['Aggregating, correlating, and analyzing log data from multiple sources for security insights'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Aggregating, correlating, and analyzing log data from multiple sources for security insights',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 12 - L2 - Understand
            [
                'subtopic' => 'Log Management',
                'question' => 'How does log normalization improve security analysis capabilities?',
                'options' => [
                    'It reduces the storage space required for log data',
                    'It standardizes log formats enabling consistent analysis across different systems',
                    'It encrypts log data to protect sensitive information',
                    'It automatically deletes old log entries to maintain performance'
                ],
                'correct_options' => ['It standardizes log formats enabling consistent analysis across different systems'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - It standardizes log formats enabling consistent analysis across different systems',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 13 - L2 - Understand
            [
                'subtopic' => 'Log Management',
                'question' => 'Why is log integrity critical for security investigations and compliance?',
                'options' => [
                    'Log integrity only affects system performance',
                    'Tampered logs can hide malicious activity and invalidate forensic evidence',
                    'Log integrity is only important for financial applications',
                    'Integrity checks slow down log processing unnecessarily'
                ],
                'correct_options' => ['Tampered logs can hide malicious activity and invalidate forensic evidence'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Tampered logs can hide malicious activity and invalidate forensic evidence',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 14 - L3 - Apply
            [
                'subtopic' => 'Log Management',
                'question' => 'A healthcare organization needs to implement log management for HIPAA compliance. What approach should they prioritize?',
                'options' => [
                    'Store all logs locally without any centralization',
                    'Implement encrypted log storage with access controls and audit trails',
                    'Focus only on application logs and ignore system logs',
                    'Use cloud storage without any security considerations'
                ],
                'correct_options' => ['Implement encrypted log storage with access controls and audit trails'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement encrypted log storage with access controls and audit trails',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 15 - L3 - Apply
            [
                'subtopic' => 'Log Management',
                'question' => 'How should an organization design log retention policies for optimal security and compliance?',
                'options' => [
                    'Delete all logs immediately after generation to save storage',
                    'Implement tiered retention based on log type, regulatory requirements, and investigation needs',
                    'Keep all logs forever regardless of storage costs',
                    'Only retain logs from security tools, not from business applications'
                ],
                'correct_options' => ['Implement tiered retention based on log type, regulatory requirements, and investigation needs'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement tiered retention based on log type, regulatory requirements, and investigation needs',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 16 - L3 - Apply
            [
                'subtopic' => 'Log Management',
                'question' => 'What is the most effective approach for analyzing logs during a suspected data breach?',
                'options' => [
                    'Manually review all logs from the past year',
                    'Use timeline analysis and correlation to focus on relevant log entries',
                    'Only examine logs from the day the breach was discovered',
                    'Ignore logs and focus solely on network traffic analysis'
                ],
                'correct_options' => ['Use timeline analysis and correlation to focus on relevant log entries'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Use timeline analysis and correlation to focus on relevant log entries',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 17 - L4 - Analyze
            [
                'subtopic' => 'Log Management',
                'question' => 'Analyze why traditional signature-based log analysis is insufficient for detecting advanced persistent threats (APTs).',
                'options' => [
                    'Signature-based analysis is too expensive for most organizations',
                    'APTs use novel techniques and living-off-the-land attacks that avoid known signatures',
                    'Signature-based analysis requires too much processing power',
                    'APTs only target systems that do not generate log data'
                ],
                'correct_options' => ['APTs use novel techniques and living-off-the-land attacks that avoid known signatures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - APTs use novel techniques and living-off-the-land attacks that avoid known signatures',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 18 - L4 - Analyze
            [
                'subtopic' => 'Log Management',
                'question' => 'What is the fundamental challenge in achieving comprehensive log visibility in modern cloud and hybrid environments?',
                'options' => [
                    'Cloud environments do not generate log data',
                    'Diverse platforms, ephemeral infrastructure, and complex access controls create visibility gaps',
                    'Log management tools cannot operate in cloud environments',
                    'Cloud providers prohibit log collection by customers'
                ],
                'correct_options' => ['Diverse platforms, ephemeral infrastructure, and complex access controls create visibility gaps'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Diverse platforms, ephemeral infrastructure, and complex access controls create visibility gaps',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 19 - L5 - Evaluate
            [
                'subtopic' => 'Log Management',
                'question' => 'An organization implements real-time log analysis but experiences performance degradation. Evaluate the balance between real-time analysis and system performance.',
                'options' => [
                    'Real-time analysis should always take priority over system performance',
                    'Organizations must balance detection speed with system impact through optimization and prioritization',
                    'System performance is always more important than security monitoring',
                    'Real-time analysis provides no security benefits over batch processing'
                ],
                'correct_options' => ['Organizations must balance detection speed with system impact through optimization and prioritization'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Organizations must balance detection speed with system impact through optimization and prioritization',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published'
            ],
            
            // Item 20 - L5 - Evaluate
            [
                'subtopic' => 'Log Management',
                'question' => 'Assess the effectiveness of using machine learning for anomaly detection in log analysis.',
                'options' => [
                    'Machine learning eliminates all false positives in log analysis',
                    'ML can improve detection of unknown threats but requires tuning and human validation',
                    'Machine learning is inappropriate for log analysis applications',
                    'ML-based anomaly detection works perfectly without any configuration'
                ],
                'correct_options' => ['ML can improve detection of unknown threats but requires tuning and human validation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - ML can improve detection of unknown threats but requires tuning and human validation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published'
            ],
            
            // Topic 3: Threat Detection & Intelligence (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 21 - L1 - Remember
            [
                'subtopic' => 'Detection',
                'question' => 'What is a false positive in the context of security threat detection?',
                'options' => [
                    'A legitimate security alert that indicates a real threat',
                    'An alert that incorrectly identifies benign activity as malicious',
                    'A failed attempt to detect any security threats',
                    'An alert that is generated too late to be actionable'
                ],
                'correct_options' => ['An alert that incorrectly identifies benign activity as malicious'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - An alert that incorrectly identifies benign activity as malicious',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 22 - L1 - Remember
            [
                'subtopic' => 'Detection',
                'question' => 'What does IOC stand for in cybersecurity threat intelligence?',
                'options' => [
                    'Internet Operations Center',
                    'Indicator of Compromise',
                    'Integrated Operations Command',
                    'Information Operations Coordinator'
                ],
                'correct_options' => ['Indicator of Compromise'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Indicator of Compromise',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 23 - L2 - Understand
            [
                'subtopic' => 'Detection',
                'question' => 'How does behavioral analysis improve threat detection compared to signature-based detection?',
                'options' => [
                    'Behavioral analysis is faster than signature-based detection',
                    'Behavioral analysis can identify unknown threats by detecting unusual patterns and activities',
                    'Behavioral analysis requires less computational resources',
                    'Behavioral analysis eliminates all false positive alerts'
                ],
                'correct_options' => ['Behavioral analysis can identify unknown threats by detecting unusual patterns and activities'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Behavioral analysis can identify unknown threats by detecting unusual patterns and activities',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 24 - L2 - Understand
            [
                'subtopic' => 'Detection',
                'question' => 'Why is threat intelligence sharing important for improving organizational security posture?',
                'options' => [
                    'It reduces the cost of security tools and technologies',
                    'Shared intelligence provides broader visibility into threat landscape and attack patterns',
                    'It eliminates the need for internal threat detection capabilities',
                    'Threat sharing is only required for government organizations'
                ],
                'correct_options' => ['Shared intelligence provides broader visibility into threat landscape and attack patterns'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Shared intelligence provides broader visibility into threat landscape and attack patterns',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 25 - L3 - Apply
            [
                'subtopic' => 'Detection',
                'question' => 'A manufacturing company discovers unusual network traffic to external IP addresses from their industrial control systems. How should they approach threat detection?',
                'options' => [
                    'Immediately block all external network traffic from control systems',
                    'Analyze traffic patterns, correlate with threat intelligence, and investigate potential compromise',
                    'Ignore the traffic since industrial systems are air-gapped',
                    'Wait for additional alerts before taking any action'
                ],
                'correct_options' => ['Analyze traffic patterns, correlate with threat intelligence, and investigate potential compromise'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Analyze traffic patterns, correlate with threat intelligence, and investigate potential compromise',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 26 - L3 - Apply
            [
                'subtopic' => 'Detection',
                'question' => 'How should an organization implement threat hunting to proactively identify advanced threats?',
                'options' => [
                    'Only hunt for threats when security incidents have already occurred',
                    'Develop hypothesis-driven hunts based on threat intelligence and environmental knowledge',
                    'Use automated tools exclusively without human analyst involvement',
                    'Focus threat hunting only on perimeter network traffic'
                ],
                'correct_options' => ['Develop hypothesis-driven hunts based on threat intelligence and environmental knowledge'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Develop hypothesis-driven hunts based on threat intelligence and environmental knowledge',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 27 - L3 - Apply
            [
                'subtopic' => 'Detection',
                'question' => 'What is the most effective approach for integrating external threat intelligence into internal detection systems?',
                'options' => [
                    'Manually review all threat intelligence reports daily',
                    'Automate ingestion with contextual analysis and validation against organizational environment',
                    'Only use free threat intelligence sources to reduce costs',
                    'Apply all external IOCs without any filtering or validation'
                ],
                'correct_options' => ['Automate ingestion with contextual analysis and validation against organizational environment'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Automate ingestion with contextual analysis and validation against organizational environment',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 28 - L4 - Analyze
            [
                'subtopic' => 'Detection',
                'question' => 'Analyze why attribution of cyber attacks is challenging and often unreliable for defensive decision-making.',
                'options' => [
                    'Attribution is always accurate with proper forensic analysis',
                    'Attackers use false flags, shared tools, and proxy infrastructure to obscure true identity',
                    'Attribution is only difficult for nation-state level attacks',
                    'Attribution challenges only affect law enforcement, not defensive strategies'
                ],
                'correct_options' => ['Attackers use false flags, shared tools, and proxy infrastructure to obscure true identity'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Attackers use false flags, shared tools, and proxy infrastructure to obscure true identity',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 29 - L4 - Analyze
            [
                'subtopic' => 'Detection',
                'question' => 'What is the fundamental limitation of relying solely on known IOCs for threat detection?',
                'options' => [
                    'IOCs are too expensive to collect and maintain',
                    'Attackers can easily change IOCs while maintaining the same attack methods and objectives',
                    'IOCs only work for network-based attacks, not endpoint attacks',
                    'IOC-based detection requires specialized hardware'
                ],
                'correct_options' => ['Attackers can easily change IOCs while maintaining the same attack methods and objectives'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Attackers can easily change IOCs while maintaining the same attack methods and objectives',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 30 - L5 - Evaluate
            [
                'subtopic' => 'Detection',
                'question' => 'A company implements multiple overlapping threat detection technologies but still experiences successful attacks. Evaluate their detection strategy.',
                'options' => [
                    'Multiple detection tools always guarantee perfect security',
                    'Detection effectiveness requires integration, tuning, and skilled analysis rather than just tool quantity',
                    'The company should eliminate all detection tools to reduce complexity',
                    'Overlapping detection technologies are always counterproductive'
                ],
                'correct_options' => ['Detection effectiveness requires integration, tuning, and skilled analysis rather than just tool quantity'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Detection effectiveness requires integration, tuning, and skilled analysis rather than just tool quantity',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published'
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
                    'Plan, Assess, Implement, Monitor, Review, Improve'
                ],
                'correct_options' => ['Preparation, Detection & Analysis, Containment Eradication & Recovery, Post-Incident Activity'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Preparation, Detection & Analysis, Containment Eradication & Recovery, Post-Incident Activity',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 32 - L1 - Remember
            [
                'subtopic' => 'Response',
                'question' => 'What is the primary goal of evidence preservation in digital forensics?',
                'options' => [
                    'Reducing the time required for investigation',
                    'Maintaining the integrity and chain of custody of digital evidence',
                    'Improving system performance during investigations',
                    'Minimizing storage costs for forensic data'
                ],
                'correct_options' => ['Maintaining the integrity and chain of custody of digital evidence'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Maintaining the integrity and chain of custody of digital evidence',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 33 - L2 - Understand
            [
                'subtopic' => 'Response',
                'question' => 'Why is rapid containment critical in incident response, even before complete analysis?',
                'options' => [
                    'Containment reduces the cost of incident response',
                    'Rapid containment limits damage spread and preserves evidence for analysis',
                    'Containment eliminates the need for further investigation',
                    'Rapid containment automatically resolves all security incidents'
                ],
                'correct_options' => ['Rapid containment limits damage spread and preserves evidence for analysis'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Rapid containment limits damage spread and preserves evidence for analysis',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 34 - L2 - Understand
            [
                'subtopic' => 'Response',
                'question' => 'How does memory forensics differ from disk forensics in incident investigation?',
                'options' => [
                    'Memory forensics is always easier than disk forensics',
                    'Memory forensics captures volatile data and running processes, while disk forensics examines persistent storage',
                    'Memory forensics only works on Windows systems',
                    'There is no significant difference between memory and disk forensics'
                ],
                'correct_options' => ['Memory forensics captures volatile data and running processes, while disk forensics examines persistent storage'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Memory forensics captures volatile data and running processes, while disk forensics examines persistent storage',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 35 - L3 - Apply
            [
                'subtopic' => 'Response',
                'question' => 'During a ransomware incident, what should be the immediate priority for the incident response team?',
                'options' => [
                    'Negotiate with attackers to minimize ransom demands',
                    'Isolate affected systems and assess spread while preserving evidence',
                    'Immediately restore all systems from the most recent backups',
                    'Focus on identifying the attack vector before any containment'
                ],
                'correct_options' => ['Isolate affected systems and assess spread while preserving evidence'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Isolate affected systems and assess spread while preserving evidence',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 36 - L3 - Apply
            [
                'subtopic' => 'Response',
                'question' => 'How should an organization handle communication during a major data breach incident?',
                'options' => [
                    'Maintain complete silence until the investigation is finished',
                    'Implement coordinated internal and external communication following legal and regulatory requirements',
                    'Immediately disclose all known details to the public',
                    'Only communicate with law enforcement and ignore other stakeholders'
                ],
                'correct_options' => ['Implement coordinated internal and external communication following legal and regulatory requirements'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement coordinated internal and external communication following legal and regulatory requirements',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 37 - L3 - Apply
            [
                'subtopic' => 'Response',
                'question' => 'What is the most critical factor when deciding whether to involve law enforcement in a cybersecurity incident?',
                'options' => [
                    'The potential media attention from the incident',
                    'Severity of impact, legal requirements, and investigative needs',
                    'The cost of external forensic investigation services',
                    'Whether the attack originated from international sources'
                ],
                'correct_options' => ['Severity of impact, legal requirements, and investigative needs'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Severity of impact, legal requirements, and investigative needs',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 38 - L4 - Analyze
            [
                'subtopic' => 'Response',
                'question' => 'Analyze why traditional backup and recovery strategies may be insufficient for ransomware incident response.',
                'options' => [
                    'Backups are too expensive for most organizations to maintain',
                    'Ransomware may compromise backup systems and data integrity before encryption occurs',
                    'Backup systems are incompatible with modern IT infrastructure',
                    'Recovery from backups is always faster than paying ransom'
                ],
                'correct_options' => ['Ransomware may compromise backup systems and data integrity before encryption occurs'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Ransomware may compromise backup systems and data integrity before encryption occurs',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 39 - L4 - Analyze
            [
                'subtopic' => 'Response',
                'question' => 'What is the fundamental challenge in conducting forensic analysis of cloud-based incidents?',
                'options' => [
                    'Cloud environments are inherently more secure than on-premises',
                    'Ephemeral infrastructure, shared responsibility, and limited forensic access complicate investigation',
                    'Cloud providers always handle all forensic analysis automatically',
                    'Forensic tools cannot operate in cloud environments'
                ],
                'correct_options' => ['Ephemeral infrastructure, shared responsibility, and limited forensic access complicate investigation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Ephemeral infrastructure, shared responsibility, and limited forensic access complicate investigation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 40 - L5 - Evaluate
            [
                'subtopic' => 'Response',
                'question' => 'An organization\'s incident response plan prioritizes business continuity over forensic evidence preservation. Evaluate this approach.',
                'options' => [
                    'Business continuity should always take absolute priority over forensics',
                    'Organizations must balance business needs with legal, regulatory, and security investigation requirements',
                    'Forensic evidence should always take priority over business operations',
                    'There is never any conflict between business continuity and forensic preservation'
                ],
                'correct_options' => ['Organizations must balance business needs with legal, regulatory, and security investigation requirements'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Organizations must balance business needs with legal, regulatory, and security investigation requirements',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published'
            ],
            
            // Topic 5: Security Monitoring & Metrics (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 41 - L1 - Remember
            [
                'subtopic' => 'Monitoring',
                'question' => 'What is a Security Information and Event Management (SIEM) system designed to provide?',
                'options' => [
                    'Network firewall protection and intrusion prevention',
                    'Centralized collection, correlation, and analysis of security events and logs',
                    'Antivirus scanning and malware removal capabilities',
                    'User authentication and access control management'
                ],
                'correct_options' => ['Centralized collection, correlation, and analysis of security events and logs'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Centralized collection, correlation, and analysis of security events and logs',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 42 - L1 - Remember
            [
                'subtopic' => 'Monitoring',
                'question' => 'What is the difference between a security metric and a security KPI?',
                'options' => [
                    'Metrics measure performance while KPIs are key performance indicators aligned with objectives',
                    'Metrics and KPIs are identical terms with no distinction',
                    'Metrics are only for technical teams while KPIs are for management',
                    'Metrics are qualitative while KPIs are always quantitative'
                ],
                'correct_options' => ['Metrics measure performance while KPIs are key performance indicators aligned with objectives'],
                'justifications' => [
                    'Correct - Metrics measure performance while KPIs are key performance indicators aligned with objectives',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 43 - L2 - Understand
            [
                'subtopic' => 'Monitoring',
                'question' => 'Why is baseline establishment critical for effective security monitoring?',
                'options' => [
                    'Baselines reduce the cost of monitoring infrastructure',
                    'Baselines provide reference points for identifying anomalous behavior and deviations',
                    'Baselines eliminate the need for real-time monitoring',
                    'Baselines automatically prevent all security incidents'
                ],
                'correct_options' => ['Baselines provide reference points for identifying anomalous behavior and deviations'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Baselines provide reference points for identifying anomalous behavior and deviations',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 44 - L2 - Understand
            [
                'subtopic' => 'Monitoring',
                'question' => 'How do leading indicators differ from lagging indicators in security metrics?',
                'options' => [
                    'Leading indicators are more expensive to measure than lagging indicators',
                    'Leading indicators predict future security posture while lagging indicators measure past performance',
                    'Leading indicators are only used by technical teams',
                    'Leading indicators require more complex measurement tools'
                ],
                'correct_options' => ['Leading indicators predict future security posture while lagging indicators measure past performance'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Leading indicators predict future security posture while lagging indicators measure past performance',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 45 - L3 - Apply
            [
                'subtopic' => 'Monitoring',
                'question' => 'A retail company wants to measure the effectiveness of their security awareness training program. What metrics should they track?',
                'options' => [
                    'Only the number of employees who completed training',
                    'Training completion rates, phishing simulation results, and security incident reporting trends',
                    'Just the cost per employee for training delivery',
                    'Only the time spent in training sessions'
                ],
                'correct_options' => ['Training completion rates, phishing simulation results, and security incident reporting trends'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Training completion rates, phishing simulation results, and security incident reporting trends',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 46 - L3 - Apply
            [
                'subtopic' => 'Monitoring',
                'question' => 'How should an organization implement continuous security monitoring in a DevOps environment?',
                'options' => [
                    'Only monitor production systems after deployment',
                    'Integrate security monitoring throughout the CI/CD pipeline with automated feedback',
                    'Perform monthly security reviews of all systems',
                    'Only monitor traditional infrastructure, not containerized applications'
                ],
                'correct_options' => ['Integrate security monitoring throughout the CI/CD pipeline with automated feedback'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Integrate security monitoring throughout the CI/CD pipeline with automated feedback',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 47 - L3 - Apply
            [
                'subtopic' => 'Monitoring',
                'question' => 'What is the most effective approach for presenting security metrics to executive leadership?',
                'options' => [
                    'Provide detailed technical logs and raw data',
                    'Focus on business impact, risk reduction, and trend analysis with clear visualizations',
                    'Only report metrics when security incidents occur',
                    'Use complex statistical analysis without interpretation'
                ],
                'correct_options' => ['Focus on business impact, risk reduction, and trend analysis with clear visualizations'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Focus on business impact, risk reduction, and trend analysis with clear visualizations',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 48 - L4 - Analyze
            [
                'subtopic' => 'Monitoring',
                'question' => 'Analyze why vanity metrics can be counterproductive for security program management.',
                'options' => [
                    'Vanity metrics are too expensive to collect',
                    'They may look impressive but do not provide actionable insights for security improvement',
                    'Vanity metrics require specialized tools to measure',
                    'They are only appropriate for large organizations'
                ],
                'correct_options' => ['They may look impressive but do not provide actionable insights for security improvement'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - They may look impressive but do not provide actionable insights for security improvement',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 49 - L4 - Analyze
            [
                'subtopic' => 'Monitoring',
                'question' => 'What is the fundamental challenge in correlating security events across hybrid cloud and on-premises environments?',
                'options' => [
                    'Hybrid environments do not generate security events',
                    'Different platforms, time synchronization, and data formats create correlation complexity',
                    'Correlation is only possible within single cloud providers',
                    'On-premises systems cannot integrate with cloud monitoring'
                ],
                'correct_options' => ['Different platforms, time synchronization, and data formats create correlation complexity'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Different platforms, time synchronization, and data formats create correlation complexity',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 50 - L5 - Evaluate
            [
                'subtopic' => 'Monitoring',
                'question' => 'An organization implements comprehensive security monitoring but struggles with alert fatigue and false positives. Assess their monitoring strategy.',
                'options' => [
                    'More monitoring always improves security effectiveness',
                    'Effective monitoring requires balance between coverage and actionability through tuning and prioritization',
                    'Organizations should eliminate all automated monitoring',
                    'False positives indicate monitoring systems are working correctly'
                ],
                'correct_options' => ['Effective monitoring requires balance between coverage and actionability through tuning and prioritization'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Effective monitoring requires balance between coverage and actionability through tuning and prioritization',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published'
            ]
        ];
    }
}