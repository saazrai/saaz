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
            $query->where('name', 'Security Operations');
        })->pluck('id', 'name');
        
        
        $items = [
            // Security Operations Center (SOC) - Item 1
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of a Security Operations Center (SOC)?',
                'options' => [
                    'To develop security policies',
                    'To provide centralized monitoring and incident response',
                    'To conduct penetration testing',
                    'To manage user access controls'
                ],
                'correct_options' => ['To provide centralized monitoring and incident response'],
                'justifications' => [
                    'Policy development is typically done by governance teams',
                    'Correct - SOC provides 24/7 monitoring and coordinated incident response',
                    'Penetration testing is usually done by specialized teams',
                    'Access control management is typically IAM responsibility'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Security Operations Center (SOC) - Item 2
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which SOC model provides the highest level of control and customization?',
                'options' => [
                    'Outsourced SOC',
                    'In-house SOC',
                    'Hybrid SOC',
                    'Virtual SOC'
                ],
                'correct_options' => ['In-house SOC'],
                'justifications' => [
                    'Outsourced SOC provides less direct control',
                    'Correct - In-house SOC offers maximum control and customization',
                    'Hybrid SOC balances control with external expertise',
                    'Virtual SOC is a service delivery model, not ownership model'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Security Operations Center (SOC) - Item 3
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the typical career progression path in SOC operations?',
                'options' => [
                    'SOC Manager → SOC Analyst → Senior Analyst',
                    'SOC Analyst → Senior Analyst → SOC Manager',
                    'Senior Analyst → SOC Analyst → SOC Manager',
                    'All roles have equal seniority'
                ],
                'correct_options' => ['SOC Analyst → Senior Analyst → SOC Manager'],
                'justifications' => [
                    'Manager position requires experience, not entry level',
                    'Correct - Typical progression from analyst to senior to management',
                    'Senior analyst is more experienced than entry-level analyst',
                    'Roles have clear hierarchy based on experience and responsibility'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Security Operations Center (SOC) - Item 4
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => 'SOC procedures should be documented and regularly updated.',
                'correct_options' => ['True'],
                'justifications' => [
                    'Correct - Documented procedures ensure consistency and enable continuous improvement',
                    'Wrong - Undocumented procedures lead to inconsistent responses and knowledge loss'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Security Operations Center (SOC) - Item 5
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which metric is most important for measuring SOC effectiveness?',
                'options' => [
                    'Number of alerts processed',
                    'Mean Time to Detection (MTTD) and Mean Time to Response (MTTR)',
                    'Number of SOC analysts',
                    'Amount of security tools deployed'
                ],
                'correct_options' => ['Mean Time to Detection (MTTD) and Mean Time to Response (MTTR)'],
                'justifications' => [
                    'Alert volume doesn\'t indicate quality or effectiveness',
                    'Correct - MTTD/MTTR measures how quickly threats are identified and addressed',
                    'Staff count doesn\'t measure effectiveness',
                    'Tool quantity doesn\'t indicate operational effectiveness'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Security Operations Center (SOC) - Item 6
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Arrange SOC implementation phases in correct order:',
                'options' => [
                    'Deploy technology',
                    'Establish governance',
                    'Train staff',
                    'Define processes'
                ],
                'correct_options' => ['Establish governance', 'Define processes', 'Deploy technology', 'Train staff'],
                'justifications' => [
                    'Governance provides the foundation',
                    'Processes guide operations',
                    'Technology enables processes',
                    'Training ensures effective use'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Security Operations Center (SOC) - Item 7
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => 'SOC analysts should have both technical and communication skills.',
                'correct_options' => ['True'],
                'justifications' => [
                    'Correct - SOC analysts need technical expertise and communication skills for escalation and reporting',
                    'Wrong - Communication skills are essential for effective incident response coordination'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Security Operations Center (SOC) - Item 8
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the most critical factor for SOC workflow efficiency?',
                'options' => [
                    'Having the most expensive tools',
                    'Clearly defined procedures and playbooks',
                    'Working only during business hours',
                    'Having unlimited budget'
                ],
                'correct_options' => ['Clearly defined procedures and playbooks'],
                'justifications' => [
                    'Expensive tools don\'t guarantee efficiency',
                    'Correct - Clear procedures ensure consistent, efficient responses',
                    '24/7 operations are typically required for SOC',
                    'Budget is important but procedures drive efficiency'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Security Operations Center (SOC) - Item 9
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which SOC tier typically handles initial alert triage?',
                'options' => [
                    'Tier 3 (Expert analysts)',
                    'Tier 1 (Junior analysts)',
                    'Tier 2 (Experienced analysts)',
                    'SOC Manager'
                ],
                'correct_options' => ['Tier 1 (Junior analysts)'],
                'justifications' => [
                    'Tier 3 handles complex investigations',
                    'Correct - Tier 1 performs initial triage and basic analysis',
                    'Tier 2 handles escalated incidents',
                    'SOC Manager provides oversight, not frontline triage'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Security Operations Center (SOC) - Item 10
            [
                'topic_id' => $topics['Security Operations Center (SOC)'] ?? 1,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Match each SOC role with its primary responsibility:',
                'options' => [
                    'SOC Analyst',
                    'SOC Manager',
                    'Incident Commander',
                    'Threat Hunter'
                ],
                'sub_options' => [
                    'Proactive threat identification',
                    'Alert triage and initial analysis',
                    'SOC operations oversight',
                    'Major incident coordination'
                ],
                'correct_options' => [
                    'SOC Analyst → Alert triage and initial analysis',
                    'SOC Manager → SOC operations oversight',
                    'Incident Commander → Major incident coordination',
                    'Threat Hunter → Proactive threat identification'
                ],
                'justifications' => [
                    'SOC Analysts handle day-to-day monitoring',
                    'SOC Manager oversees operations and staff',
                    'Incident Commander leads major incident response',
                    'Threat Hunter proactively searches for threats'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Log Management - Item 11
            [
                'topic_id' => $topics['Log Management'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of centralized log collection?',
                'options' => [
                    'To reduce storage costs',
                    'To enable comprehensive security monitoring and analysis',
                    'To comply with audit requirements only',
                    'To reduce network traffic'
                ],
                'correct_options' => ['To enable comprehensive security monitoring and analysis'],
                'justifications' => [
                    'Centralization may actually increase storage needs',
                    'Correct - Centralized logs enable correlation and comprehensive analysis',
                    'Compliance is a benefit but not the primary purpose',
                    'Centralization typically increases network traffic'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Log Management - Item 12
            [
                'topic_id' => $topics['Log Management'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which log sources are most critical for security monitoring?',
                'options' => [
                    'Only application logs',
                    'Firewalls, endpoints, servers, and authentication systems',
                    'Just network device logs',
                    'Only database logs'
                ],
                'correct_options' => ['Firewalls, endpoints, servers, and authentication systems'],
                'justifications' => [
                    'Application logs alone provide limited security visibility',
                    'Correct - Comprehensive log collection from multiple sources enables thorough monitoring',
                    'Network logs alone miss host-based activity',
                    'Database logs are important but insufficient alone'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Log Management - Item 13
            [
                'topic_id' => $topics['Log Management'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary benefit of event correlation in SIEM systems?',
                'options' => [
                    'Reducing log storage requirements',
                    'Identifying patterns and relationships across multiple log sources',
                    'Eliminating the need for human analysts',
                    'Increasing log collection speed'
                ],
                'correct_options' => ['Identifying patterns and relationships across multiple log sources'],
                'justifications' => [
                    'Correlation analysis may require additional processing and storage',
                    'Correct - Correlation reveals attack patterns invisible in individual log sources',
                    'Human analysis remains essential for complex threats',
                    'Correlation focuses on analysis quality, not collection speed'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Log Management - Item 14
            [
                'topic_id' => $topics['Log Management'] ?? 2,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Log retention periods should be based solely on storage capacity.',
                'correct_options' => ['False'],
                'justifications' => [
                    'Wrong - Retention should consider legal, compliance, and investigative requirements',
                    'Correct - Multiple factors including regulatory, legal, and business needs determine retention'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Log Management - Item 15
            [
                'topic_id' => $topics['Log Management'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which factor is most important when designing log aggregation architecture?',
                'options' => [
                    'Minimizing costs',
                    'Ensuring scalability and availability',
                    'Using only open-source tools',
                    'Collecting only critical logs'
                ],
                'correct_options' => ['Ensuring scalability and availability'],
                'justifications' => [
                    'Cost is important but not the primary design consideration',
                    'Correct - Log infrastructure must handle volume and remain available for security operations',
                    'Tool selection should be based on requirements, not licensing model',
                    'Comprehensive log collection is needed for effective security monitoring'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Log Management - Item 16
            [
                'topic_id' => $topics['Log Management'] ?? 2,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Arrange log management activities in recommended order:',
                'options' => [
                    'Analyze and correlate',
                    'Collect and aggregate',
                    'Store and retain',
                    'Normalize and parse'
                ],
                'correct_options' => ['Collect and aggregate', 'Normalize and parse', 'Store and retain', 'Analyze and correlate'],
                'justifications' => [
                    'Collection is the first step',
                    'Normalization prepares data for analysis',
                    'Storage preserves data for analysis',
                    'Analysis uses processed, stored data'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Log Management - Item 17
            [
                'topic_id' => $topics['Log Management'] ?? 2,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Real-time log analysis is more important than log retention for security monitoring.',
                'correct_options' => ['False'],
                'justifications' => [
                    'Wrong - Both real-time analysis and retention are important for different purposes',
                    'Correct - Real-time analysis detects active threats; retention enables investigation and compliance'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Log Management - Item 18
            [
                'topic_id' => $topics['Log Management'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the main challenge in log event correlation?',
                'options' => [
                    'High storage costs',
                    'Managing false positives while detecting true threats',
                    'Limited log sources',
                    'Slow network connections'
                ],
                'correct_options' => ['Managing false positives while detecting true threats'],
                'justifications' => [
                    'Storage costs are manageable with proper architecture',
                    'Correct - Balancing sensitivity to catch threats while minimizing false alerts',
                    'Modern environments typically have abundant log sources',
                    'Network speed is rarely the limiting factor'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Log Management - Item 19
            [
                'topic_id' => $topics['Log Management'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Who should typically be responsible for log retention policy decisions?',
                'options' => [
                    'IT operations team only',
                    'Legal, compliance, and security teams collaboratively',
                    'Individual system owners',
                    'External auditors'
                ],
                'correct_options' => ['Legal, compliance, and security teams collaboratively'],
                'justifications' => [
                    'IT operations implements but doesn\'t set policy',
                    'Correct - Multiple stakeholder input ensures comprehensive policy',
                    'Individual owners may not understand broader requirements',
                    'Auditors review but don\'t set internal policies'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Log Management - Item 20
            [
                'topic_id' => $topics['Log Management'] ?? 2,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Arrange log processing stages in correct order (first to last):',
                'options' => [
                    'Enrichment',
                    'Collection',
                    'Normalization',
                    'Correlation',
                    'Storage'
                ],
                'correct_options' => ['Collection', 'Normalization', 'Enrichment', 'Storage', 'Correlation'],
                'justifications' => [
                    'Collection gathers raw logs',
                    'Normalization standardizes format',
                    'Enrichment adds context',
                    'Storage preserves processed logs',
                    'Correlation analyzes stored data'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Detection - Item 21
            [
                'topic_id' => $topics['Detection'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary difference between IDS and IPS?',
                'options' => [
                    'IDS monitors networks, IPS monitors hosts',
                    'IDS detects and alerts, IPS detects and blocks',
                    'IDS uses signatures, IPS uses behavior analysis',
                    'There is no significant difference'
                ],
                'correct_options' => ['IDS detects and alerts, IPS detects and blocks'],
                'justifications' => [
                    'Both IDS and IPS can monitor networks or hosts',
                    'Correct - Key difference is IPS takes active blocking action',
                    'Both can use signatures and behavioral analysis',
                    'The blocking capability is a significant operational difference'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Detection - Item 22
            [
                'topic_id' => $topics['Detection'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which SIEM capability is most valuable for detecting advanced persistent threats (APTs)?',
                'options' => [
                    'Real-time dashboards',
                    'Historical data analysis and correlation',
                    'Automatic report generation',
                    'User access controls'
                ],
                'correct_options' => ['Historical data analysis and correlation'],
                'justifications' => [
                    'Dashboards show current status but may miss subtle patterns',
                    'Correct - APTs often use long-term, low-profile activities requiring historical analysis',
                    'Reports summarize known information but don\'t detect new threats',
                    'Access controls secure the SIEM but don\'t detect threats'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Detection - Item 23
            [
                'topic_id' => $topics['Detection'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary advantage of UEBA over traditional signature-based detection?',
                'options' => [
                    'Lower cost of implementation',
                    'Ability to detect unknown threats through behavioral anomalies',
                    'Faster processing speed',
                    'Simpler configuration requirements'
                ],
                'correct_options' => ['Ability to detect unknown threats through behavioral anomalies'],
                'justifications' => [
                    'UEBA implementation can be complex and costly',
                    'Correct - UEBA detects previously unknown threats by identifying abnormal behavior',
                    'Behavioral analysis typically requires more processing than signature matching',
                    'UEBA often requires complex tuning and baseline establishment'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Detection - Item 24
            [
                'topic_id' => $topics['Detection'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Network-based IDS can detect attacks that occur entirely within encrypted traffic.',
                'correct_options' => ['False'],
                'justifications' => [
                    'Wrong - Network IDS cannot inspect encrypted traffic content',
                    'Correct - Encrypted traffic limits network IDS visibility to metadata and patterns'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Detection - Item 25
            [
                'topic_id' => $topics['Detection'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which detection method is most effective against zero-day exploits?',
                'options' => [
                    'Signature-based detection',
                    'Behavioral and anomaly-based detection',
                    'Rule-based correlation',
                    'Manual log review'
                ],
                'correct_options' => ['Behavioral and anomaly-based detection'],
                'justifications' => [
                    'Signatures don\'t exist for zero-day exploits',
                    'Correct - Behavioral detection can identify anomalous activity patterns',
                    'Rules are typically based on known attack patterns',
                    'Manual review is too slow and limited for comprehensive detection'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Detection - Item 26
            [
                'topic_id' => $topics['Detection'] ?? 3,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Match each detection technology with its primary strength:',
                'options' => [
                    'IDS/IPS',
                    'SIEM',
                    'UEBA',
                    'Network monitoring'
                ],
                'sub_options' => [
                    'User behavior analysis',
                    'Multi-source correlation',
                    'Real-time blocking',
                    'Traffic pattern analysis'
                ],
                'correct_options' => [
                    'IDS/IPS → Real-time blocking',
                    'SIEM → Multi-source correlation',
                    'UEBA → User behavior analysis',
                    'Network monitoring → Traffic pattern analysis'
                ],
                'justifications' => [
                    'IPS provides active threat blocking',
                    'SIEM excels at correlating diverse data sources',
                    'UEBA specializes in behavioral analysis',
                    'Network monitoring analyzes traffic patterns'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Detection - Item 27
            [
                'topic_id' => $topics['Detection'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'SIEM systems require significant tuning to reduce false positives.',
                'correct_options' => ['True'],
                'justifications' => [
                    'Correct - SIEM tuning is critical for balancing detection sensitivity with manageable alert volumes',
                    'Wrong - Untuned SIEM systems typically generate excessive false positives'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Detection - Item 28
            [
                'topic_id' => $topics['Detection'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the most significant challenge in implementing UEBA?',
                'options' => [
                    'High licensing costs',
                    'Establishing accurate behavioral baselines',
                    'Integration with existing tools',
                    'Training staff on new technology'
                ],
                'correct_options' => ['Establishing accurate behavioral baselines'],
                'justifications' => [
                    'Cost is a factor but not the most significant technical challenge',
                    'Correct - UEBA effectiveness depends on accurate baseline establishment',
                    'Integration challenges exist but baselines are more fundamental',
                    'Training is important but baseline accuracy is more critical'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Detection - Item 29
            [
                'topic_id' => $topics['Detection'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which deployment model provides the best network visibility for IDS?',
                'options' => [
                    'Inline deployment',
                    'Mirror port (SPAN) deployment',
                    'Network tap deployment',
                    'Agent-based deployment'
                ],
                'correct_options' => ['Network tap deployment'],
                'justifications' => [
                    'Inline deployment provides blocking but may introduce latency',
                    'Mirror ports may drop packets under high load',
                    'Correct - Network taps provide complete, reliable traffic visibility',
                    'Agent-based deployment is for host-based, not network detection'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Detection - Item 30
            [
                'topic_id' => $topics['Detection'] ?? 3,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Arrange SIEM implementation phases in recommended order:',
                'options' => [
                    'Deploy use cases',
                    'Configure log sources',
                    'Tune correlation rules',
                    'Install SIEM platform'
                ],
                'correct_options' => ['Install SIEM platform', 'Configure log sources', 'Deploy use cases', 'Tune correlation rules'],
                'justifications' => [
                    'Platform installation provides the foundation',
                    'Log sources provide data for analysis',
                    'Use cases define detection requirements',
                    'Tuning optimizes performance and accuracy'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Response - Item 31
            [
                'topic_id' => $topics['Response'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of SOAR platforms?',
                'options' => [
                    'To replace security analysts',
                    'To orchestrate and automate security response workflows',
                    'To generate compliance reports',
                    'To monitor network traffic'
                ],
                'correct_options' => ['To orchestrate and automate security response workflows'],
                'justifications' => [
                    'SOAR augments but doesn\'t replace human analysts',
                    'Correct - SOAR automates repetitive tasks and orchestrates complex workflows',
                    'Compliance reporting is a secondary capability',
                    'Network monitoring is typically done by other tools'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Response - Item 32
            [
                'topic_id' => $topics['Response'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which type of incident response should be automated first in a SOAR implementation?',
                'options' => [
                    'Complex forensic analysis',
                    'High-volume, low-risk alerts',
                    'Executive-level incident notifications',
                    'Legal and regulatory reporting'
                ],
                'correct_options' => ['High-volume, low-risk alerts'],
                'justifications' => [
                    'Complex forensics typically require human expertise',
                    'Correct - Automating routine, low-risk responses provides immediate value',
                    'Executive notifications often require human judgment',
                    'Legal reporting typically requires review and approval'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Response - Item 33
            [
                'topic_id' => $topics['Response'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Incident response procedures should be fully automated without human oversight.',
                'correct_options' => ['False'],
                'justifications' => [
                    'Wrong - Human oversight ensures appropriate response to complex situations',
                    'Correct - Automation should enhance human decision-making, not replace it entirely'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Response - Item 34
            [
                'topic_id' => $topics['Response'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the most important factor for successful threat response automation?',
                'options' => [
                    'Having the most advanced tools',
                    'Well-defined playbooks and procedures',
                    'Large security team',
                    'Unlimited budget'
                ],
                'correct_options' => ['Well-defined playbooks and procedures'],
                'justifications' => [
                    'Advanced tools are helpful but procedures are more fundamental',
                    'Correct - Clear procedures enable effective automation and consistent response',
                    'Team size is less important than procedure clarity',
                    'Budget is important but doesn\'t guarantee successful automation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Response - Item 35
            [
                'topic_id' => $topics['Response'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which containment action can be most safely automated?',
                'options' => [
                    'Shutting down critical production systems',
                    'Blocking known malicious IP addresses',
                    'Disabling user accounts without verification',
                    'Deleting suspected malware files'
                ],
                'correct_options' => ['Blocking known malicious IP addresses'],
                'justifications' => [
                    'Production system shutdown requires careful consideration',
                    'Correct - IP blocking is reversible and typically low-risk',
                    'Account disabling should include verification to prevent false positives',
                    'File deletion should be done carefully to preserve evidence'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Response - Item 36
            [
                'topic_id' => $topics['Response'] ?? 4,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Arrange automated response actions in order of increasing risk:',
                'options' => [
                    'System isolation',
                    'Alert generation',
                    'Evidence collection',
                    'Account disabling'
                ],
                'correct_options' => ['Alert generation', 'Evidence collection', 'Account disabling', 'System isolation'],
                'justifications' => [
                    'Alert generation has minimal operational impact',
                    'Evidence collection is typically non-disruptive',
                    'Account disabling affects user access',
                    'System isolation has highest operational impact'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Response - Item 37
            [
                'topic_id' => $topics['Response'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'SOAR platforms can integrate with most security tools through APIs.',
                'correct_options' => ['True'],
                'justifications' => [
                    'Correct - Modern SOAR platforms typically offer extensive API integration capabilities',
                    'Wrong - API integration is a core SOAR capability for tool orchestration'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Response - Item 38
            [
                'topic_id' => $topics['Response'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary benefit of incident response playbooks?',
                'options' => [
                    'Reducing staff training requirements',
                    'Ensuring consistent and repeatable responses',
                    'Eliminating the need for escalation',
                    'Reducing tool licensing costs'
                ],
                'correct_options' => ['Ensuring consistent and repeatable responses'],
                'justifications' => [
                    'Training is still required to understand and execute playbooks',
                    'Correct - Playbooks standardize responses for consistent outcomes',
                    'Escalation may still be necessary for complex incidents',
                    'Playbooks don\'t directly impact licensing costs'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Response - Item 39
            [
                'topic_id' => $topics['Response'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which metric best measures the effectiveness of automated threat response?',
                'options' => [
                    'Number of automated actions taken',
                    'Reduction in mean time to containment (MTTC)',
                    'Percentage of incidents that are fully automated',
                    'Cost savings from automation'
                ],
                'correct_options' => ['Reduction in mean time to containment (MTTC)'],
                'justifications' => [
                    'Action count doesn\'t indicate effectiveness',
                    'Correct - Faster containment reduces threat impact',
                    'Full automation percentage doesn\'t measure effectiveness',
                    'Cost savings are important but containment speed is more critical'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Response - Item 40
            [
                'topic_id' => $topics['Response'] ?? 4,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Match each response automation level with its appropriate use case:',
                'options' => [
                    'Full automation',
                    'Semi-automation',
                    'Manual with tools',
                    'Fully manual'
                ],
                'sub_options' => [
                    'Complex forensic investigation',
                    'Routine malware blocking',
                    'Incident escalation decisions',
                    'Evidence collection'
                ],
                'correct_options' => [
                    'Full automation → Routine malware blocking',
                    'Semi-automation → Evidence collection',
                    'Manual with tools → Incident escalation decisions',
                    'Fully manual → Complex forensic investigation'
                ],
                'justifications' => [
                    'Routine blocking can be safely automated',
                    'Evidence collection benefits from automation with oversight',
                    'Escalation decisions need human judgment with tool support',
                    'Complex forensics require human expertise and judgment'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Monitoring - Item 41
            [
                'topic_id' => $topics['Monitoring'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary purpose of real-time security monitoring?',
                'options' => [
                    'To generate compliance reports',
                    'To detect and respond to threats as they occur',
                    'To perform forensic analysis',
                    'To manage user access controls'
                ],
                'correct_options' => ['To detect and respond to threats as they occur'],
                'justifications' => [
                    'Compliance reporting is typically not time-critical',
                    'Correct - Real-time monitoring enables immediate threat detection and response',
                    'Forensic analysis is typically performed after incident detection',
                    'Access control management is usually not a real-time monitoring function'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Monitoring - Item 42
            [
                'topic_id' => $topics['Monitoring'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which alerting strategy helps reduce alert fatigue in SOCs?',
                'options' => [
                    'Sending all alerts to all analysts',
                    'Alert prioritization and intelligent routing',
                    'Disabling low-priority alerts entirely',
                    'Only alerting during business hours'
                ],
                'correct_options' => ['Alert prioritization and intelligent routing'],
                'justifications' => [
                    'Sending all alerts increases fatigue and reduces effectiveness',
                    'Correct - Prioritization and routing ensure analysts focus on relevant, high-priority alerts',
                    'Disabling alerts may miss legitimate threats',
                    'Threats don\'t follow business hours'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Monitoring - Item 43
            [
                'topic_id' => $topics['Monitoring'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which security metric is most valuable for executive reporting?',
                'options' => [
                    'Number of log entries processed',
                    'Mean time to detect and respond to incidents',
                    'Number of security tools deployed',
                    'Percentage of alerts that are false positives'
                ],
                'correct_options' => ['Mean time to detect and respond to incidents'],
                'justifications' => [
                    'Log processing volume is an operational metric',
                    'Correct - MTTD/MTTR demonstrates security program effectiveness to executives',
                    'Tool count doesn\'t indicate effectiveness',
                    'False positive rate is important operationally but less meaningful to executives'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Monitoring - Item 44
            [
                'topic_id' => $topics['Monitoring'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Security dashboards should display only technical metrics.',
                'correct_options' => ['False'],
                'justifications' => [
                    'Wrong - Dashboards should include business-relevant metrics for different audiences',
                    'Correct - Effective dashboards combine technical and business metrics for comprehensive visibility'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Monitoring - Item 45
            [
                'topic_id' => $topics['Monitoring'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the most important characteristic of security monitoring alerts?',
                'options' => [
                    'High volume to catch everything',
                    'Actionable information with clear next steps',
                    'Detailed technical logs only',
                    'Automated resolution without human input'
                ],
                'correct_options' => ['Actionable information with clear next steps'],
                'justifications' => [
                    'High volume often leads to alert fatigue and missed threats',
                    'Correct - Actionable alerts enable effective response and reduce analyst confusion',
                    'Technical details alone may not provide clear action guidance',
                    'Not all alerts can or should be automatically resolved'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Monitoring - Item 46
            [
                'topic_id' => $topics['Monitoring'] ?? 5,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Arrange security reporting activities in recommended order:',
                'options' => [
                    'Present findings',
                    'Collect metrics',
                    'Analyze trends',
                    'Define KPIs'
                ],
                'correct_options' => ['Define KPIs', 'Collect metrics', 'Analyze trends', 'Present findings'],
                'justifications' => [
                    'KPIs define what to measure',
                    'Metrics collection provides data',
                    'Trend analysis reveals patterns',
                    'Presentation communicates insights'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Monitoring - Item 47
            [
                'topic_id' => $topics['Monitoring'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Performance monitoring of security tools is as important as security monitoring itself.',
                'correct_options' => ['True'],
                'justifications' => [
                    'Correct - Security tool performance directly impacts detection and response capability',
                    'Wrong - Poor tool performance can create security blind spots'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Monitoring - Item 48
            [
                'topic_id' => $topics['Monitoring'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary challenge in measuring security monitoring effectiveness?',
                'options' => [
                    'Lack of monitoring tools',
                    'Defining meaningful metrics that reflect actual security posture',
                    'Insufficient storage capacity',
                    'Limited network bandwidth'
                ],
                'correct_options' => ['Defining meaningful metrics that reflect actual security posture'],
                'justifications' => [
                    'Monitoring tools are widely available',
                    'Correct - Meaningful metrics are challenging to define but essential for effectiveness assessment',
                    'Storage capacity is typically manageable',
                    'Bandwidth is rarely the limiting factor'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Monitoring - Item 49
            [
                'topic_id' => $topics['Monitoring'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How often should security monitoring effectiveness be formally reviewed?',
                'options' => [
                    'Only when incidents occur',
                    'Quarterly with annual comprehensive review',
                    'Daily during shift changes',
                    'Only during budget planning'
                ],
                'correct_options' => ['Quarterly with annual comprehensive review'],
                'justifications' => [
                    'Incident-driven reviews are reactive and insufficient',
                    'Correct - Regular quarterly reviews with annual deep assessment ensure continuous improvement',
                    'Daily reviews may be too frequent for strategic assessment',
                    'Budget-driven reviews don\'t address operational effectiveness'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Monitoring - Item 50
            [
                'topic_id' => $topics['Monitoring'] ?? 5,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Match each monitoring component with its primary purpose:',
                'options' => [
                    'Real-time dashboards',
                    'Alert management',
                    'Trend analysis',
                    'Performance metrics'
                ],
                'sub_options' => [
                    'Tool health monitoring',
                    'Current threat status',
                    'Alert prioritization',
                    'Long-term pattern identification'
                ],
                'correct_options' => [
                    'Real-time dashboards → Current threat status',
                    'Alert management → Alert prioritization',
                    'Trend analysis → Long-term pattern identification',
                    'Performance metrics → Tool health monitoring'
                ],
                'justifications' => [
                    'Dashboards provide current situational awareness',
                    'Alert management prioritizes and routes alerts',
                    'Trend analysis identifies patterns over time',
                    'Performance metrics monitor tool effectiveness'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ]
        ];

        // Insert all diagnostic items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
    }
}