<?php

namespace Database\Seeders\Diagnostics;

class D19IncidentManagementSeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Incident Management';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: Incident Response Planning & Preparation (10 questions)
            // Bloom Distribution: L1:0, L2:2, L3:4, L4:2, L5:2

            // Item 1 - L3 - Apply
            [
                'subtopic' => 'Preparation',
                'question' => 'At 2 AM, your organization detects: (1) Ransomware encrypting financial servers, (2) Customer data being exfiltrated, (3) Multiple systems going offline. Your team is panicking and unsure who should handle what. How does a well-structured IRP address this chaos?',
                'options' => [
                    'Wait for senior management to arrive and make decisions',
                    'Apply predefined detection procedures, response workflows, and recovery steps with clear role assignments',
                    'Focus only on restoring systems without investigating the attack',
                    'Immediately contact law enforcement and media to report the breach',
                ],
                'correct_options' => ['Apply predefined detection procedures, response workflows, and recovery steps with clear role assignments'],
                'justifications' => [
                    'Incorrect - Waiting wastes critical response time and allows further damage',
                    'Correct - IRP provides structured procedures to systematically detect scope, coordinate response, and manage recovery',
                    'Incorrect - Restoration without investigation risks reinfection and loses forensic evidence',
                    'Incorrect - External notifications come after initial containment and assessment per IRP procedures',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 2 - L3 - Apply
            [
                'subtopic' => 'Preparation',
                'question' => 'A major data breach has occurred at a hospital, resulting in the unauthorized access and theft of all patient records. How should this event be classified, and what is the MOST appropriate immediate response?',
                'options' => [
                    'Disaster; activate the Business Continuity and Disaster Recovery Plan (BCP/DRP)',
                    'Security incident; initiate the Incident Response Plan (IRP)',
                    'Risk; implement an appropriate risk response strategy',
                    'Emergency; follow the Emergency Response Plan',
                ],
                'correct_options' => ['Security incident; initiate the Incident Response Plan (IRP)'],
                'justifications' => [
                    'Incorrect - While serious, this is a security incident rather than a disaster. BCP/DRP focuses on business continuity after major disruptions, not security breach response',
                    'Correct - A data breach involving unauthorized access and theft of patient records is classified as a security incident requiring immediate activation of the Incident Response Plan to contain, investigate, and remediate',
                    'Incorrect - This is an active security incident that has already occurred, not a potential risk to be managed through risk response strategies',
                    'Incorrect - Emergency Response Plans typically address physical emergencies or life-threatening situations, not cybersecurity incidents requiring specialized technical and legal responses',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 3 - L2 - Understand
            [
                'subtopic' => 'Preparation',
                'question' => 'How does conducting tabletop exercises benefit incident response preparation?',
                'options' => [
                    'It eliminates the need for technical security controls',
                    'It validates response procedures and identifies gaps without real incident impact',
                    'It guarantees that actual incidents will be handled perfectly',
                    'It replaces the need for incident response team training',
                ],
                'correct_options' => ['It validates response procedures and identifies gaps without real incident impact'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - It validates response procedures and identifies gaps without real incident impact',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 4 - L3 - Apply
            [
                'subtopic' => 'Preparation',
                'question' => 'A financial services company is establishing an incident response team. What is the most critical factor in team composition?',
                'options' => [
                    'All team members should be from the IT department',
                    'Include representatives from technical, legal, communications, and business functions',
                    'Team should only include senior executives',
                    'Focus exclusively on external consultants for objectivity',
                ],
                'correct_options' => ['Include representatives from technical, legal, communications, and business functions'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Include representatives from technical, legal, communications, and business functions',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 5 - L3 - Apply
            [
                'subtopic' => 'Preparation',
                'question' => 'When developing incident response procedures for a healthcare organization, what regulatory requirement must be prioritized?',
                'options' => [
                    'GDPR compliance for all patient data',
                    'HIPAA breach notification requirements within 60 days',
                    'PCI DSS incident response procedures',
                    'SOX financial reporting requirements',
                ],
                'correct_options' => ['HIPAA breach notification requirements within 60 days'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - HIPAA breach notification requirements within 60 days',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 6 - L3 - Apply
            [
                'subtopic' => 'Preparation',
                'question' => 'How should an organization handle incident response preparation for cloud-based infrastructure?',
                'options' => [
                    'Rely entirely on cloud provider\'s incident response',
                    'Develop shared responsibility model procedures covering both provider and customer responsibilities',
                    'Ignore cloud incidents since data is managed externally',
                    'Use only traditional on-premises response procedures',
                ],
                'correct_options' => ['Develop shared responsibility model procedures covering both provider and customer responsibilities'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Develop shared responsibility model procedures covering both provider and customer responsibilities',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 7 - L4 - Analyze
            [
                'subtopic' => 'Preparation',
                'question' => 'Analyze why many organizations struggle with incident response effectiveness despite having formal plans.',
                'options' => [
                    'Plans are too detailed and complex to follow',
                    'Lack of regular testing, training, and plan updates based on lessons learned',
                    'Insufficient budget allocation for response activities',
                    'Over-reliance on external security vendors',
                ],
                'correct_options' => ['Lack of regular testing, training, and plan updates based on lessons learned'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Lack of regular testing, training, and plan updates based on lessons learned',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 8 - L4 - Analyze
            [
                'subtopic' => 'Preparation',
                'question' => 'What is the primary challenge in coordinating incident response across multiple business units?',
                'options' => [
                    'Technical complexity of different systems',
                    'Communication protocols and authority conflicts between units',
                    'Budget constraints for cross-unit activities',
                    'Regulatory requirements vary by business unit',
                ],
                'correct_options' => ['Communication protocols and authority conflicts between units'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Communication protocols and authority conflicts between units',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 9 - L5 - Evaluate
            [
                'subtopic' => 'Preparation',
                'question' => 'Evaluate the effectiveness of outsourcing incident response to a managed security service provider (MSSP).',
                'options' => [
                    'Always superior due to specialized expertise and 24/7 availability',
                    'Can provide expertise but may lack organizational context and create dependency risks',
                    'Never appropriate for critical business functions',
                    'Only suitable for small organizations without internal capabilities',
                ],
                'correct_options' => ['Can provide expertise but may lack organizational context and create dependency risks'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Can provide expertise but may lack organizational context and create dependency risks',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Item 10 - L5 - Evaluate
            [
                'subtopic' => 'Preparation',
                'question' => 'Assess the long-term sustainability of maintaining an internal incident response capability in a mid-sized organization.',
                'options' => [
                    'Always cost-effective due to organizational knowledge',
                    'Requires careful balance of costs, skills retention, and readiness levels',
                    'Impossible due to skill requirements and costs',
                    'Only valuable for organizations with frequent incidents',
                ],
                'correct_options' => ['Requires careful balance of costs, skills retention, and readiness levels'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Requires careful balance of costs, skills retention, and readiness levels',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 2: Detection & Analysis (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L1 - Remember
            [
                'subtopic' => 'Detection, Triage & Analysis',
                'question' => 'What is the primary purpose of Security Information and Event Management (SIEM) systems in incident detection?',
                'options' => [
                    'To prevent all security incidents from occurring',
                    'To collect, correlate, and analyze security events to identify potential incidents',
                    'To automatically respond to all security alerts',
                    'To replace human analysts in security operations',
                ],
                'correct_options' => ['To collect, correlate, and analyze security events to identify potential incidents'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - To collect, correlate, and analyze security events to identify potential incidents',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 12 - L2 - Understand
            [
                'subtopic' => 'Detection, Triage & Analysis',
                'question' => 'What is the PRIMARY reason for conducting triage?',
                'options' => [
                    'To prioritize limited resources when handling incidents',
                    'To align with mandatory process steps in the incident handling process',
                    'To mitigate the chance of an incident occurring',
                    'To detect an incident before it can spread further',
                ],
                'correct_options' => ['To prioritize limited resources when handling incidents'],
                'justifications' => [
                    'Correct - Triage is fundamentally about prioritizing limited resources by assessing incident severity, impact, and urgency to ensure critical incidents receive immediate attention',
                    'Incorrect - While triage may be part of incident handling processes, its primary purpose is resource prioritization rather than process compliance',
                    'Incorrect - Triage occurs after incidents have been detected and is focused on response prioritization, not incident prevention or mitigation',
                    'Incorrect - Detection and containment are separate incident response activities; triage specifically focuses on prioritizing response efforts based on incident characteristics',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 13 - L2 - Understand
            [
                'subtopic' => 'Detection, Triage & Analysis',
                'question' => 'How do threat intelligence feeds enhance incident detection capabilities?',
                'options' => [
                    'They provide real-time updates on normal business activities',
                    'They offer context about current attack patterns, indicators of compromise, and threat actor tactics',
                    'They eliminate the need for security monitoring tools',
                    'They guarantee accurate attribution of security incidents',
                ],
                'correct_options' => ['They offer context about current attack patterns, indicators of compromise, and threat actor tactics'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - They offer context about current attack patterns, indicators of compromise, and threat actor tactics',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 14 - L3 - Apply
            [
                'subtopic' => 'Detection, Triage & Analysis',
                'question' => 'An information security manager has been notified that a server that is used within the entire enterprise has been breached. What is the FIRST step to take?',
                'options' => [
                    'Inform management',
                    'Notify users',
                    'Isolate the server',
                    'Verify the information',
                ],
                'correct_options' => ['Verify the information'],
                'justifications' => [
                    'Incorrect - Management notification is important but should occur after verifying the incident is legitimate to avoid false alarms and unnecessary escalation',
                    'Incorrect - User notification may cause panic and should occur only after incident verification and appropriate containment measures are planned',
                    'Incorrect - Server isolation is a critical containment step but premature action without verification could cause unnecessary business disruption if the report is false',
                    'Correct - The first step is to verify the information and confirm the breach actually occurred before taking disruptive actions, as false positives can cause significant business impact',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 15 - L3 - Apply
            [
                'subtopic' => 'Detection, Triage & Analysis',
                'question' => 'When analyzing a potential phishing incident, what evidence should be collected and preserved?',
                'options' => [
                    'Only the email headers and sender information',
                    'Email contents, headers, attachment analysis, user actions, and system logs',
                    'Just the user\'s account activity logs',
                    'Only network traffic during the incident timeframe',
                ],
                'correct_options' => ['Email contents, headers, attachment analysis, user actions, and system logs'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Email contents, headers, attachment analysis, user actions, and system logs',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 16 - L3 - Apply
            [
                'subtopic' => 'Detection, Triage & Analysis',
                'question' => 'How should an organization approach incident analysis when facing a sophisticated Advanced Persistent Threat (APT)?',
                'options' => [
                    'Focus only on the immediate technical indicators',
                    'Conduct comprehensive timeline analysis across multiple systems and data sources',
                    'Rely solely on automated security tools for analysis',
                    'Limit analysis to the initially affected system',
                ],
                'correct_options' => ['Conduct comprehensive timeline analysis across multiple systems and data sources'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Conduct comprehensive timeline analysis across multiple systems and data sources',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 17 - L4 - Analyze
            [
                'subtopic' => 'Detection, Triage & Analysis',
                'question' => 'Analyze why traditional signature-based detection methods are insufficient for modern cybersecurity threats.',
                'options' => [
                    'Signatures are too complex for analysts to understand',
                    'Modern threats use polymorphic techniques, zero-days, and living-off-the-land attacks that evade signatures',
                    'Signature databases require too much storage space',
                    'Regulatory compliance prohibits signature-based detection',
                ],
                'correct_options' => ['Modern threats use polymorphic techniques, zero-days, and living-off-the-land attacks that evade signatures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Modern threats use polymorphic techniques, zero-days, and living-off-the-land attacks that evade signatures',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 18 - L4 - Analyze
            [
                'subtopic' => 'Detection, Triage & Analysis',
                'question' => 'What is the primary challenge in correlating security events across hybrid cloud environments?',
                'options' => [
                    'Cost of cloud monitoring services',
                    'Inconsistent logging formats, time synchronization, and data integration across diverse platforms',
                    'Limited bandwidth for log transmission',
                    'Regulatory restrictions on cross-border data analysis',
                ],
                'correct_options' => ['Inconsistent logging formats, time synchronization, and data integration across diverse platforms'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Inconsistent logging formats, time synchronization, and data integration across diverse platforms',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 19 - L5 - Evaluate
            [
                'subtopic' => 'Detection, Triage & Analysis',
                'question' => 'Evaluate the effectiveness of implementing machine learning-based behavioral analytics for threat detection.',
                'options' => [
                    'Always superior to traditional methods with zero false positives',
                    'Can improve detection of unknown threats but requires careful tuning and may generate false positives',
                    'Ineffective for cybersecurity applications',
                    'Only useful for compliance reporting, not actual security',
                ],
                'correct_options' => ['Can improve detection of unknown threats but requires careful tuning and may generate false positives'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Can improve detection of unknown threats but requires careful tuning and may generate false positives',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Item 20 - L5 - Evaluate
            [
                'subtopic' => 'Detection, Triage & Analysis',
                'question' => 'Assess the trade-offs between automated incident analysis and human analyst involvement in modern security operations.',
                'options' => [
                    'Automation should completely replace human analysts',
                    'Optimal approach combines automated processing with human judgment for complex analysis and decision-making',
                    'Human analysts are always more accurate than automated systems',
                    'Automation is only useful for simple, repetitive tasks',
                ],
                'correct_options' => ['Optimal approach combines automated processing with human judgment for complex analysis and decision-making'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Optimal approach combines automated processing with human judgment for complex analysis and decision-making',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 3: Containment, Eradication & Recovery (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L2 - Understand
            [
                'subtopic' => 'Containment',
                'question' => 'The PRIMARY objective of incident response is to:',
                'options' => [
                    'investigate and report results of the incident to management',
                    'gather evidence',
                    'minimize business disruptions',
                    'assist law enforcement in investigations',
                ],
                'correct_options' => ['minimize business disruptions'],
                'justifications' => [
                    'Incorrect - While investigation and reporting are important incident response activities, they are secondary to the primary objective of protecting business operations and minimizing impact',
                    'Incorrect - Evidence gathering is a critical component of incident response but serves the broader goal of understanding and preventing future incidents, not the primary immediate objective',
                    'Correct - The primary objective of incident response is to minimize business disruptions by quickly containing threats, restoring operations, and preventing further damage to organizational assets and processes',
                    'Incorrect - Assisting law enforcement may be necessary in certain cases but is not the primary objective, as incident response focuses first on protecting the organization and its stakeholders',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 22 - L1 - Remember
            [
                'subtopic' => 'Containment',
                'question' => 'What is the difference between eradication and recovery in incident response?',
                'options' => [
                    'There is no difference; the terms are interchangeable',
                    'Eradication removes the threat while recovery restores normal operations',
                    'Recovery happens before eradication in the process',
                    'Eradication is only for malware incidents',
                ],
                'correct_options' => ['Eradication removes the threat while recovery restores normal operations'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Eradication removes the threat while recovery restores normal operations',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 23 - L2 - Understand
            [
                'subtopic' => 'Containment',
                'question' => 'Why might an organization choose short-term containment over immediate eradication?',
                'options' => [
                    'Short-term containment is always faster than eradication',
                    'To preserve evidence and maintain business continuity while preparing for comprehensive remediation',
                    'Eradication is more expensive than containment',
                    'Short-term containment eliminates the need for recovery',
                ],
                'correct_options' => ['To preserve evidence and maintain business continuity while preparing for comprehensive remediation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - To preserve evidence and maintain business continuity while preparing for comprehensive remediation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 24 - L2 - Understand
            [
                'subtopic' => 'Containment',
                'question' => 'How does network segmentation support incident containment strategies?',
                'options' => [
                    'It prevents all incidents from occurring',
                    'It limits lateral movement and enables isolation of affected network segments',
                    'It automatically eradicates threats without human intervention',
                    'It only works for external threats, not internal ones',
                ],
                'correct_options' => ['It limits lateral movement and enables isolation of affected network segments'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - It limits lateral movement and enables isolation of affected network segments',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 25 - L3 - Apply
            [
                'subtopic' => 'Containment',
                'question' => 'A ransomware infection is detected on three workstations in the accounting department. What should be the immediate containment action?',
                'options' => [
                    'Shut down the entire network infrastructure',
                    'Isolate affected systems and network segments while assessing spread',
                    'Wait to see if the infection spreads further',
                    'Immediately pay the ransom to prevent spread',
                ],
                'correct_options' => ['Isolate affected systems and network segments while assessing spread'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Isolate affected systems and network segments while assessing spread',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 26 - L3 - Apply
            [
                'subtopic' => 'Containment',
                'question' => 'When recovering from a data breach involving customer information, what is the most critical factor in the recovery process?',
                'options' => [
                    'Restoring systems as quickly as possible',
                    'Ensuring complete eradication of threats and implementing additional safeguards before restoration',
                    'Minimizing the cost of recovery operations',
                    'Avoiding any communication about the incident',
                ],
                'correct_options' => ['Ensuring complete eradication of threats and implementing additional safeguards before restoration'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Ensuring complete eradication of threats and implementing additional safeguards before restoration',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 27 - L3 - Apply
            [
                'subtopic' => 'Containment',
                'question' => 'How should an organization approach system recovery when forensic investigation is required?',
                'options' => [
                    'Restore systems immediately to minimize business impact',
                    'Balance forensic preservation needs with business continuity by using system images and alternate infrastructure',
                    'Wait for complete forensic analysis before any recovery',
                    'Only focus on forensics and ignore business operations',
                ],
                'correct_options' => ['Balance forensic preservation needs with business continuity by using system images and alternate infrastructure'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Balance forensic preservation needs with business continuity by using system images and alternate infrastructure',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 28 - L4 - Analyze
            [
                'subtopic' => 'Containment',
                'question' => 'Analyze the risks of aggressive containment strategies that might impact business operations.',
                'options' => [
                    'Aggressive containment has no negative consequences',
                    'May cause business disruption that could exceed the incident impact, requiring balanced risk assessment',
                    'Business impact is always less important than security',
                    'Containment strategies never affect business operations',
                ],
                'correct_options' => ['May cause business disruption that could exceed the incident impact, requiring balanced risk assessment'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - May cause business disruption that could exceed the incident impact, requiring balanced risk assessment',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 29 - L4 - Analyze
            [
                'subtopic' => 'Containment',
                'question' => 'What is the primary challenge in ensuring complete eradication of sophisticated malware from enterprise networks?',
                'options' => [
                    'Lack of available eradication tools',
                    'Malware persistence mechanisms, encrypted communications, and potential for re-infection from compromised systems',
                    'Insufficient network bandwidth for scanning',
                    'Regulatory restrictions on malware removal',
                ],
                'correct_options' => ['Malware persistence mechanisms, encrypted communications, and potential for re-infection from compromised systems'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Malware persistence mechanisms, encrypted communications, and potential for re-infection from compromised systems',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 30 - L5 - Evaluate
            [
                'subtopic' => 'Containment',
                'question' => 'Evaluate the decision to rebuild compromised systems from scratch versus attempting to clean and restore them.',
                'options' => [
                    'Rebuilding is always superior but more expensive',
                    'Decision depends on threat sophistication, system criticality, and confidence in eradication completeness',
                    'Cleaning is always faster and more cost-effective',
                    'The choice has no impact on long-term security posture',
                ],
                'correct_options' => ['Decision depends on threat sophistication, system criticality, and confidence in eradication completeness'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Decision depends on threat sophistication, system criticality, and confidence in eradication completeness',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 4: Post-Incident Activities (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L1 - Remember
            [
                'subtopic' => 'Post-Incident Activity',
                'question' => 'What is the primary purpose of conducting a post-incident review?',
                'options' => [
                    'To assign blame for the incident',
                    'To identify lessons learned and improve future incident response',
                    'To calculate the exact financial cost of the incident',
                    'To satisfy insurance requirements',
                ],
                'correct_options' => ['To identify lessons learned and improve future incident response'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - To identify lessons learned and improve future incident response',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 32 - L1 - Remember
            [
                'subtopic' => 'Post-Incident Activity',
                'question' => 'What should be included in incident documentation for future reference?',
                'options' => [
                    'Only the technical details of the attack',
                    'Timeline, actions taken, evidence collected, and lessons learned',
                    'Just the names of people involved',
                    'Only the final resolution steps',
                ],
                'correct_options' => ['Timeline, actions taken, evidence collected, and lessons learned'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Timeline, actions taken, evidence collected, and lessons learned',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 33 - L2 - Understand
            [
                'subtopic' => 'Post-Incident Activity',
                'question' => 'Why is it important to preserve evidence even after an incident has been resolved?',
                'options' => [
                    'Evidence is not needed after resolution',
                    'For potential legal proceedings, compliance requirements, and future incident analysis',
                    'To increase storage costs for the organization',
                    'Evidence preservation is only required for external attacks',
                ],
                'correct_options' => ['For potential legal proceedings, compliance requirements, and future incident analysis'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - For potential legal proceedings, compliance requirements, and future incident analysis',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 34 - L2 - Understand
            [
                'subtopic' => 'Post-Incident Activity',
                'question' => 'How do post-incident activities contribute to organizational security maturity?',
                'options' => [
                    'They have no impact on future security',
                    'They provide feedback for improving processes, training, and security controls',
                    'They only help with compliance reporting',
                    'They replace the need for preventive security measures',
                ],
                'correct_options' => ['They provide feedback for improving processes, training, and security controls'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - They provide feedback for improving processes, training, and security controls',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 35 - L3 - Apply
            [
                'subtopic' => 'Post-Incident Activity',
                'question' => 'After a successful phishing attack that compromised employee credentials, what should be the priority post-incident action?',
                'options' => [
                    'Only reset the compromised user\'s password',
                    'Implement comprehensive security awareness training and review email security controls',
                    'Ignore the incident since it was resolved',
                    'Focus only on technical controls without user education',
                ],
                'correct_options' => ['Implement comprehensive security awareness training and review email security controls'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement comprehensive security awareness training and review email security controls',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 36 - L4 - Analyze
            [
                'subtopic' => 'Post-Incident Activity',
                'question' => 'Which of the following BEST helps an information security manager provide an indication of whether a similar incident will reoccur?',
                'options' => [
                    'A vulnerability assessment',
                    'Automated log monitoring',
                    'A root cause analysis',
                    'Forensic investigations',
                ],
                'correct_options' => ['A root cause analysis'],
                'justifications' => [
                    'Incorrect - Vulnerability assessments identify current security weaknesses but do not analyze why specific incidents occurred or predict recurrence based on underlying causes',
                    'Incorrect - Automated log monitoring helps detect ongoing activities but does not provide insight into the fundamental reasons why incidents occur or their likelihood of recurrence',
                    'Correct - Root cause analysis systematically identifies the underlying factors that enabled an incident to occur, allowing organizations to address these causes and assess recurrence probability',
                    'Incorrect - Forensic investigations focus on evidence collection and incident reconstruction but do not typically analyze systemic causes or predict future incident likelihood',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 37 - L3 - Apply
            [
                'subtopic' => 'Post-Incident Activity',
                'question' => 'How should an organization handle communication and reporting after a data breach incident?',
                'options' => [
                    'Never disclose any information about the incident',
                    'Follow legal notification requirements while providing clear, accurate communication to stakeholders',
                    'Only notify law enforcement',
                    'Wait until all investigations are complete before any communication',
                ],
                'correct_options' => ['Follow legal notification requirements while providing clear, accurate communication to stakeholders'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Follow legal notification requirements while providing clear, accurate communication to stakeholders',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 38 - L4 - Analyze
            [
                'subtopic' => 'Post-Incident Activity',
                'question' => 'Analyze why many organizations fail to implement lessons learned from security incidents.',
                'options' => [
                    'Lessons learned are always too complex to implement',
                    'Lack of follow-through, resource constraints, and competing priorities often prevent implementation',
                    'Post-incident activities are not useful for security improvement',
                    'Organizations prefer to focus only on new threats',
                ],
                'correct_options' => ['Lack of follow-through, resource constraints, and competing priorities often prevent implementation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Lack of follow-through, resource constraints, and competing priorities often prevent implementation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 39 - L4 - Analyze
            [
                'subtopic' => 'Post-Incident Activity',
                'question' => 'What is the primary challenge in measuring the effectiveness of incident response improvements?',
                'options' => [
                    'Improvements always show immediate results',
                    'Difficulty in quantifying prevention of future incidents and establishing clear metrics',
                    'Incident response effectiveness cannot be measured',
                    'Organizations don\'t want to measure their security posture',
                ],
                'correct_options' => ['Difficulty in quantifying prevention of future incidents and establishing clear metrics'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Difficulty in quantifying prevention of future incidents and establishing clear metrics',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 40 - L5 - Evaluate
            [
                'subtopic' => 'Post-Incident Activity',
                'question' => 'Evaluate the long-term value of investing in comprehensive post-incident activities versus focusing resources on preventive measures.',
                'options' => [
                    'Post-incident activities are always more valuable than prevention',
                    'Both are essential: post-incident activities inform and improve preventive measures in a continuous cycle',
                    'Prevention is always superior to post-incident analysis',
                    'The choice between them has no impact on security effectiveness',
                ],
                'correct_options' => ['Both are essential: post-incident activities inform and improve preventive measures in a continuous cycle'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Both are essential: post-incident activities inform and improve preventive measures in a continuous cycle',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published',
            ],

            // Topic 5: Legal, Regulatory & Compliance (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 41 - L1 - Remember
            [
                'subtopic' => 'Eradication & Recovery',
                'question' => 'Under HIPAA regulations, within what timeframe must a covered entity notify the Department of Health and Human Services of a data breach?',
                'options' => [
                    '24 hours',
                    '60 days',
                    '72 hours',
                    '30 days',
                ],
                'correct_options' => ['60 days'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - 60 days',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 42 - L1 - Remember
            [
                'subtopic' => 'Eradication & Recovery',
                'question' => 'What is the primary purpose of maintaining a chain of custody for digital evidence?',
                'options' => [
                    'To reduce storage costs',
                    'To ensure evidence integrity and admissibility in legal proceedings',
                    'To speed up incident response',
                    'To comply with insurance requirements',
                ],
                'correct_options' => ['To ensure evidence integrity and admissibility in legal proceedings'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - To ensure evidence integrity and admissibility in legal proceedings',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 43 - L2 - Understand
            [
                'subtopic' => 'Eradication & Recovery',
                'question' => 'Why do different industries have varying incident notification requirements?',
                'options' => [
                    'To make compliance more complex',
                    'Different industries have different risk profiles and stakeholder protection needs',
                    'Regulations are randomly assigned to industries',
                    'All industries should have identical requirements',
                ],
                'correct_options' => ['Different industries have different risk profiles and stakeholder protection needs'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Different industries have different risk profiles and stakeholder protection needs',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 44 - L2 - Understand
            [
                'subtopic' => 'Eradication & Recovery',
                'question' => 'How does the concept of "reasonable security measures" affect incident response legal obligations?',
                'options' => [
                    'It eliminates all legal obligations',
                    'Organizations must demonstrate they implemented appropriate security controls and response procedures',
                    'It only applies to government organizations',
                    'Reasonable security measures are not legally relevant',
                ],
                'correct_options' => ['Organizations must demonstrate they implemented appropriate security controls and response procedures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Organizations must demonstrate they implemented appropriate security controls and response procedures',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 45 - L3 - Apply
            [
                'subtopic' => 'Eradication & Recovery',
                'question' => 'A healthcare organization experiences a breach affecting patient records. What legal notifications are required?',
                'options' => [
                    'Only notify patients affected by the breach',
                    'Notify patients, HHS, and potentially media depending on breach size and state requirements',
                    'No notifications are required if the breach is contained',
                    'Only law enforcement needs to be notified',
                ],
                'correct_options' => ['Notify patients, HHS, and potentially media depending on breach size and state requirements'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Notify patients, HHS, and potentially media depending on breach size and state requirements',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 46 - L3 - Apply
            [
                'subtopic' => 'Eradication & Recovery',
                'question' => 'When collecting digital evidence during incident response, what legal considerations must be addressed?',
                'options' => [
                    'Evidence collection is not subject to legal constraints',
                    'Must ensure proper authorization, chain of custody, and preservation of evidence integrity',
                    'Only technical accuracy matters for evidence collection',
                    'Evidence can be collected without any documentation',
                ],
                'correct_options' => ['Must ensure proper authorization, chain of custody, and preservation of evidence integrity'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Must ensure proper authorization, chain of custody, and preservation of evidence integrity',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 47 - L3 - Apply
            [
                'subtopic' => 'Eradication & Recovery',
                'question' => 'How should an organization handle incident response when multiple jurisdictions and regulations apply?',
                'options' => [
                    'Follow only the easiest regulation to comply with',
                    'Develop response procedures that meet the most stringent requirements across applicable jurisdictions',
                    'Ignore jurisdictional differences',
                    'Only comply with local regulations',
                ],
                'correct_options' => ['Develop response procedures that meet the most stringent requirements across applicable jurisdictions'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Develop response procedures that meet the most stringent requirements across applicable jurisdictions',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 48 - L4 - Analyze
            [
                'subtopic' => 'Eradication & Recovery',
                'question' => 'Analyze the tension between rapid incident response and legal evidence preservation requirements.',
                'options' => [
                    'Legal requirements always take precedence over response speed',
                    'Organizations must balance swift response with proper evidence handling through planned procedures',
                    'Evidence preservation is never important during incident response',
                    'Legal and operational requirements never conflict',
                ],
                'correct_options' => ['Organizations must balance swift response with proper evidence handling through planned procedures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Organizations must balance swift response with proper evidence handling through planned procedures',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 49 - L4 - Analyze
            [
                'subtopic' => 'Eradication & Recovery',
                'question' => 'What are the primary challenges in managing cross-border incident response and data protection requirements?',
                'options' => [
                    'Technical complexity of international networks',
                    'Conflicting legal frameworks, data sovereignty issues, and varying notification requirements',
                    'Language barriers in incident communications',
                    'Time zone differences for response coordination',
                ],
                'correct_options' => ['Conflicting legal frameworks, data sovereignty issues, and varying notification requirements'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Conflicting legal frameworks, data sovereignty issues, and varying notification requirements',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 50 - L5 - Evaluate
            [
                'subtopic' => 'Eradication & Recovery',
                'question' => 'Evaluate the effectiveness of current regulatory frameworks in driving meaningful improvements in incident response capabilities.',
                'options' => [
                    'Regulations always lead to better security outcomes',
                    'Regulations provide minimum standards but organizations must go beyond compliance for effective security',
                    'Regulatory compliance is sufficient for comprehensive security',
                    'Regulations have no impact on incident response effectiveness',
                ],
                'correct_options' => ['Regulations provide minimum standards but organizations must go beyond compliance for effective security'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Regulations provide minimum standards but organizations must go beyond compliance for effective security',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
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
