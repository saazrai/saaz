<?php

namespace Database\Seeders\Diagnostics;

class D20BusinessContinuityDisasterRecoverySeeder extends BaseDiagnosticSeeder
{
    protected string $domainName = 'Business Continuity & Disaster Recovery';

    protected function getQuestions(): array
    {
        return [
            // Topic 1: Business Impact Analysis (BIA) (10 questions)
            // Bloom Distribution: L1:0, L2:2, L3:4, L4:2, L5:2

            // Item 1 - L3 - Apply
            [
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'Your company has: (1) Order processing system (generates 80% of revenue), (2) Email system (used for communication), (3) HR payroll system (runs monthly). A flood threatens the data center. You have limited backup resources. How should you apply BIA principles to prioritize protection?',
                'options' => [
                    'Protect all systems equally since they are all important to the organization',
                    'Prioritize order processing system due to its critical revenue impact, then assess other systems based on business disruption severity',
                    'Focus only on the newest and most expensive system infrastructure',
                    'Protect systems in alphabetical order to ensure fair treatment',
                ],
                'correct_options' => ['Prioritize order processing system due to its critical revenue impact, then assess other systems based on business disruption severity'],
                'justifications' => [
                    'Incorrect - Equal protection ignores varying business criticality and impact levels',
                    'Correct - BIA identifies critical processes by business impact, prioritizing resources based on disruption severity',
                    'Incorrect - Technical criteria should not override business impact assessment',
                    'Incorrect - Arbitrary ordering ignores business impact analysis methodology',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 2 - L2 - Understand
            [
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'How does Maximum Tolerable Downtime (MTD) differ from Recovery Time Objective (RTO)?',
                'options' => [
                    'MTD and RTO are identical concepts with no meaningful difference',
                    'MTD is the absolute maximum time before severe consequences, while RTO is the target recovery time',
                    'MTD applies only to IT systems, while RTO applies to business processes',
                    'MTD is always shorter than RTO for critical systems',
                ],
                'correct_options' => ['MTD is the absolute maximum time before severe consequences, while RTO is the target recovery time'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - MTD is the absolute maximum time before severe consequences, while RTO is the target recovery time',
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

            // Item 3 - L2 - Understand
            [
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'Why is stakeholder input critical for conducting an effective BIA?',
                'options' => [
                    'Stakeholders provide the most cost-effective solutions',
                    'Business process owners understand operational dependencies and impact better than technical teams',
                    'Stakeholder involvement reduces the time required for analysis',
                    'Stakeholders always provide accurate technical specifications',
                ],
                'correct_options' => ['Business process owners understand operational dependencies and impact better than technical teams'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Business process owners understand operational dependencies and impact better than technical teams',
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
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'A hospital needs to prioritize recovery efforts for different systems during an outage. How should they apply BIA findings?',
                'options' => [
                    'Recover systems in order of implementation cost',
                    'Prioritize based on criticality ratings and impact on patient safety',
                    'Focus on the most technically complex systems first',
                    'Recover all systems simultaneously regardless of priority',
                ],
                'correct_options' => ['Prioritize based on criticality ratings and impact on patient safety'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Prioritize based on criticality ratings and impact on patient safety',
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
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'How should an organization determine Recovery Point Objective (RPO) for financial trading systems?',
                'options' => [
                    'Set RPO based on industry average to minimize costs',
                    'Analyze financial impact of data loss and regulatory requirements to determine acceptable loss',
                    'Use the same RPO for all systems to simplify management',
                    'Set RPO to zero for all financial data regardless of cost',
                ],
                'correct_options' => ['Analyze financial impact of data loss and regulatory requirements to determine acceptable loss'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Analyze financial impact of data loss and regulatory requirements to determine acceptable loss',
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
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'What is the most effective approach for quantifying business impact in terms of financial loss?',
                'options' => [
                    'Use estimates based on similar organizations in the industry',
                    'Calculate direct costs, indirect costs, and intangible impacts specific to the organization',
                    'Focus only on immediate revenue loss without considering other factors',
                    'Apply a standard percentage across all business processes',
                ],
                'correct_options' => ['Calculate direct costs, indirect costs, and intangible impacts specific to the organization'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Calculate direct costs, indirect costs, and intangible impacts specific to the organization',
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
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'Analyze why interdependency mapping is often the most challenging aspect of conducting a comprehensive BIA.',
                'options' => [
                    'Interdependency mapping requires expensive specialized software',
                    'Complex interconnections between processes, systems, and suppliers are difficult to identify and document completely',
                    'Interdependency mapping only works for manufacturing organizations',
                    'Legal restrictions prevent complete interdependency analysis',
                ],
                'correct_options' => ['Complex interconnections between processes, systems, and suppliers are difficult to identify and document completely'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Complex interconnections between processes, systems, and suppliers are difficult to identify and document completely',
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
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'What is the fundamental challenge in conducting BIA for cloud-based and distributed business processes?',
                'options' => [
                    'Cloud environments are inherently more reliable than on-premises',
                    'Shared infrastructure and multi-tenancy create complex dependency relationships',
                    'Cloud providers handle all business impact analysis automatically',
                    'Distributed processes have identical impact characteristics as centralized ones',
                ],
                'correct_options' => ['Shared infrastructure and multi-tenancy create complex dependency relationships'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Shared infrastructure and multi-tenancy create complex dependency relationships',
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
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'A company\'s BIA indicates that all business processes are equally critical and require immediate recovery. Evaluate this conclusion.',
                'options' => [
                    'This is a realistic finding that demonstrates comprehensive business operations',
                    'This suggests insufficient analysis or stakeholder bias, as true priorities should emerge from proper BIA',
                    'Equal criticality is the preferred outcome for business continuity planning',
                    'This finding eliminates the need for priority-based recovery strategies',
                ],
                'correct_options' => ['This suggests insufficient analysis or stakeholder bias, as true priorities should emerge from proper BIA'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - This suggests insufficient analysis or stakeholder bias, as true priorities should emerge from proper BIA',
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
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'Assess the effectiveness of using automated tools versus manual processes for conducting organizational BIA.',
                'options' => [
                    'Automated tools always provide more accurate results than manual analysis',
                    'Effective BIA requires both automated data collection and human judgment for context and validation',
                    'Manual processes are always superior for understanding business relationships',
                    'The choice between automated and manual approaches has no impact on BIA quality',
                ],
                'correct_options' => ['Effective BIA requires both automated data collection and human judgment for context and validation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Effective BIA requires both automated data collection and human judgment for context and validation',
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

            // Topic 2: Business Continuity Planning (10 questions)
            // Bloom Distribution: L1:1, L2:2, L3:3, L4:2, L5:2

            // Item 11 - L1 - Remember
            [
                'subtopic' => 'Business Continuity Planning',
                'question' => 'What are the key components of a comprehensive Business Continuity Plan (BCP)?',
                'options' => [
                    'Only technical recovery procedures and contact lists',
                    'Risk assessment, business impact analysis, recovery strategies, and response procedures',
                    'Budget planning and resource allocation documents',
                    'Employee training materials and performance metrics',
                ],
                'correct_options' => ['Risk assessment, business impact analysis, recovery strategies, and response procedures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Risk assessment, business impact analysis, recovery strategies, and response procedures',
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
                'subtopic' => 'Business Continuity Planning',
                'question' => 'How does business continuity planning differ from disaster recovery planning?',
                'options' => [
                    'Business continuity and disaster recovery are identical concepts',
                    'Business continuity focuses on maintaining operations while disaster recovery focuses on restoring systems',
                    'Business continuity is only for large enterprises, disaster recovery is for small businesses',
                    'Business continuity is less expensive than disaster recovery planning',
                ],
                'correct_options' => ['Business continuity focuses on maintaining operations while disaster recovery focuses on restoring systems'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Business continuity focuses on maintaining operations while disaster recovery focuses on restoring systems',
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

            // Item 13 - L2 - Understand
            [
                'subtopic' => 'Business Continuity Planning',
                'question' => 'Why is senior management support critical for effective business continuity planning?',
                'options' => [
                    'Senior management has the most technical expertise',
                    'Leadership provides resources, authority, and organizational commitment necessary for success',
                    'Senior management is required by law to oversee continuity planning',
                    'Leadership support reduces the cost of business continuity initiatives',
                ],
                'correct_options' => ['Leadership provides resources, authority, and organizational commitment necessary for success'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Leadership provides resources, authority, and organizational commitment necessary for success',
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
                'subtopic' => 'Business Continuity Planning',
                'question' => 'A manufacturing company experiences a fire in their primary facility. How should their BCP address workforce relocation?',
                'options' => [
                    'Send all employees home until the facility is rebuilt',
                    'Implement predetermined alternate work arrangements and remote operations procedures',
                    'Permanently close operations and liquidate the business',
                    'Wait for insurance settlements before making workforce decisions',
                ],
                'correct_options' => ['Implement predetermined alternate work arrangements and remote operations procedures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement predetermined alternate work arrangements and remote operations procedures',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 15 - L3 - Apply
            [
                'subtopic' => 'Business Continuity Planning',
                'question' => 'How should an organization integrate business continuity planning with their risk management framework?',
                'options' => [
                    'Keep business continuity and risk management completely separate',
                    'Align BCP strategies with identified risks and risk appetite to ensure consistent approach',
                    'Only focus on business continuity for risks that cannot be prevented',
                    'Use identical procedures for both risk management and business continuity',
                ],
                'correct_options' => ['Align BCP strategies with identified risks and risk appetite to ensure consistent approach'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Align BCP strategies with identified risks and risk appetite to ensure consistent approach',
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
                'subtopic' => 'Business Continuity Planning',
                'question' => 'What is the most effective approach for developing communication plans within a BCP?',
                'options' => [
                    'Use only email communication to maintain written records',
                    'Establish multiple communication channels with clear escalation procedures and stakeholder matrices',
                    'Rely on social media platforms for all emergency communication',
                    'Designate a single person to handle all crisis communications',
                ],
                'correct_options' => ['Establish multiple communication channels with clear escalation procedures and stakeholder matrices'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Establish multiple communication channels with clear escalation procedures and stakeholder matrices',
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
                'subtopic' => 'Business Continuity Planning',
                'question' => 'Analyze why many business continuity plans fail during actual disruptions despite thorough preparation.',
                'options' => [
                    'Business continuity plans are inherently flawed concepts',
                    'Plans often lack realistic testing, assume ideal conditions, or fail to account for human factors under stress',
                    'Disruptions are always more severe than anticipated',
                    'Technology failures make all business continuity plans ineffective',
                ],
                'correct_options' => ['Plans often lack realistic testing, assume ideal conditions, or fail to account for human factors under stress'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Plans often lack realistic testing, assume ideal conditions, or fail to account for human factors under stress',
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
                'subtopic' => 'Business Continuity Planning',
                'question' => 'What is the fundamental challenge in maintaining business continuity plan relevance in rapidly changing business environments?',
                'options' => [
                    'Business environments never change rapidly enough to affect plans',
                    'Dynamic business processes, technology changes, and organizational evolution require continuous plan updates',
                    'Static plans are always preferable to dynamic ones',
                    'Plan relevance is not important for business continuity effectiveness',
                ],
                'correct_options' => ['Dynamic business processes, technology changes, and organizational evolution require continuous plan updates'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Dynamic business processes, technology changes, and organizational evolution require continuous plan updates',
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
                'subtopic' => 'Business Continuity Planning',
                'question' => 'A global organization implements identical business continuity plans across all locations to ensure consistency. Evaluate this approach.',
                'options' => [
                    'Standardized plans always provide the best business continuity outcomes',
                    'While consistency has benefits, plans must account for local regulations, culture, and risk profiles',
                    'Identical plans eliminate all coordination challenges during global incidents',
                    'Local variations in business continuity plans create unnecessary complexity',
                ],
                'correct_options' => ['While consistency has benefits, plans must account for local regulations, culture, and risk profiles'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - While consistency has benefits, plans must account for local regulations, culture, and risk profiles',
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
                'subtopic' => 'Business Continuity Planning',
                'question' => 'Assess the balance between comprehensive business continuity planning and organizational agility in responding to unforeseen disruptions.',
                'options' => [
                    'Comprehensive planning always reduces organizational agility',
                    'Effective planning provides structure while enabling adaptive responses to novel situations',
                    'Organizational agility eliminates the need for formal business continuity planning',
                    'Planning and agility are mutually exclusive organizational capabilities',
                ],
                'correct_options' => ['Effective planning provides structure while enabling adaptive responses to novel situations'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Effective planning provides structure while enabling adaptive responses to novel situations',
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

            // Topic 3: Disaster Recovery Planning (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 21 - L1 - Remember
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'When is a disaster considered to be officially over?',
                'options' => [
                    'When the danger has passed and the disaster has been contained',
                    'When the organization\'s processes are up and running at the alternate site',
                    'When all business operations at the original site have returned to normal',
                    'When all employees have been reimbursed for their expenses',
                ],
                'correct_options' => ['When all business operations at the original site have returned to normal'],
                'justifications' => [
                    'Incorrect - This indicates the immediate threat is over but recovery may still be ongoing',
                    'Incorrect - Operating at alternate site is part of recovery, not the end of disaster',
                    'Correct - A disaster is officially over when normal operations are fully restored at the original site',
                    'Incorrect - Employee reimbursement is administrative and not the defining end of a disaster',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 22 - L2 - Understand
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'Which of the following BEST differentiates recovery from restoration in the context of disaster management?',
                'options' => [
                    'Recovery focuses on repairing IT infrastructure, while restoration involves restoring services',
                    'Recovery involves returning all systems to their pre-disaster state, while restoration focuses on resuming business operations',
                    'Recovery focuses on resuming essential operations, while restoration involves returning to full operational capability',
                    'Recovery and restoration are the same, as both focus on the immediate return to normal operations',
                ],
                'correct_options' => ['Recovery focuses on resuming essential operations, while restoration involves returning to full operational capability'],
                'justifications' => [
                    'Incorrect - This oversimplifies the distinction and focuses only on technical aspects',
                    'Incorrect - This reverses the typical sequence and scope of recovery vs restoration',
                    'Correct - Recovery focuses on resuming essential operations, while restoration involves returning to full operational capability',
                    'Incorrect - Recovery and restoration are distinct phases with different objectives and scope',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 23 - L4 - Analyze
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'Which of the following is the MOST important risk an enterprise must consider when developing a disaster recovery plan?',
                'options' => [
                    'Budgets have not yet been finalized',
                    'A business impact analysis has not been conducted',
                    'No risk strategy has been established',
                    'All employees have not attended disaster recovery training',
                ],
                'correct_options' => ['A business impact analysis has not been conducted'],
                'justifications' => [
                    'Incorrect - While budgets are important, they follow after understanding business impact priorities',
                    'Correct - Without BIA, the organization cannot identify critical processes, dependencies, and recovery priorities essential for effective DR planning',
                    'Incorrect - Risk strategy is important but BIA provides the foundation for understanding what needs protection',
                    'Incorrect - Training is crucial but secondary to having a sound plan based on proper impact analysis',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.6,
                'irt_b' => 0.7,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 24 - L3 - Apply
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'What is the PRIMARY factor to be taken into account when designing a backup strategy that will be consistent with a disaster recovery strategy?',
                'options' => [
                    'Volume of sensitive data',
                    'Recovery point objective',
                    'Recovery time objective',
                    'Interruption window',
                ],
                'correct_options' => ['Recovery point objective'],
                'justifications' => [
                    'Incorrect - While data sensitivity affects backup security, RPO determines backup frequency and strategy',
                    'Correct - RPO defines acceptable data loss, directly determining backup frequency and strategy design',
                    'Incorrect - RTO affects recovery speed but RPO determines the backup strategy itself',
                    'Incorrect - Interruption window is important for scheduling but RPO drives the fundamental backup approach',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 25 - L4 - Analyze
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'Which of the following factors is MOST important when selecting a disaster recovery (DR) site?',
                'options' => [
                    'Recovery Time Objective (RTO)',
                    'Recovery Point Objective (RPO)',
                    'Mean Time to Repair (MTTR)',
                    'Available budget',
                ],
                'correct_options' => ['Recovery Time Objective (RTO)'],
                'justifications' => [
                    'Correct - RTO determines site readiness level needed (hot, warm, cold) and directly drives site selection criteria',
                    'Incorrect - RPO affects backup strategy but RTO determines the type and capability of DR site required',
                    'Incorrect - MTTR is important for maintenance planning but not the primary factor for site selection',
                    'Incorrect - Budget constrains options but RTO requirements should drive the selection within budget limits',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.5,
                'irt_b' => 0.5,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 26 - L1 - Remember
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'An offsite information processing facility with electrical wiring, air conditioning and flooring, but no computer or communications equipment, is a:',
                'options' => [
                    'cold site',
                    'warm site',
                    'hot site',
                    'mirror site',
                ],
                'correct_options' => ['cold site'],
                'justifications' => [
                    'Correct - A cold site has basic infrastructure (power, HVAC, space) but no equipment or data',
                    'Incorrect - A warm site includes some equipment and infrastructure, partially configured',
                    'Incorrect - A hot site is fully operational with equipment, data, and ready for immediate use',
                    'Incorrect - A mirror site is a real-time duplicate of the primary site with continuous data replication',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -1.0,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 27 - L1 - Remember
            [
                'subtopic' => 'Testing',
                'question' => 'Which DRP testing method is least disruptive, involving a facilitated discussion of the plan\'s components and potential scenarios?',
                'options' => [
                    'Tabletop exercise',
                    'Simulation test',
                    'Parallel test',
                    'Full interruption test',
                ],
                'correct_options' => ['Tabletop exercise'],
                'justifications' => [
                    'Correct - Tabletop exercises are discussion-based with no system interaction, making them least disruptive',
                    'Incorrect - Simulation tests involve actual system testing in non-production environments',
                    'Incorrect - Parallel tests run recovery systems alongside production systems',
                    'Incorrect - Full interruption tests shut down production systems, causing maximum disruption',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 28 - L2 - Understand
            [
                'subtopic' => 'Testing',
                'question' => 'A "Walkthrough" test is best described as:',
                'options' => [
                    'A complete failover to a recovery site',
                    'A step-by-step review of the DRP with key personnel',
                    'Live systems running simultaneously',
                    'A surprise drill for all staff',
                ],
                'correct_options' => ['A step-by-step review of the DRP with key personnel'],
                'justifications' => [
                    'Incorrect - Complete failover describes a full interruption test, not a walkthrough',
                    'Correct - A walkthrough is a structured review of procedures with responsible personnel',
                    'Incorrect - Live systems running simultaneously describes a parallel test',
                    'Incorrect - Surprise drills are unannounced tests, not walkthroughs which are planned reviews',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 29 - L2 - Understand
            [
                'subtopic' => 'Testing',
                'question' => 'Which testing method involves activating parts of the DRP on actual systems in a non-production environment, without impacting live services?',
                'options' => [
                    'Full Interruption',
                    'Parallel',
                    'Simulation',
                    'Walkthrough',
                ],
                'correct_options' => ['Simulation'],
                'justifications' => [
                    'Incorrect - Full interruption tests shut down production systems and impact live services',
                    'Incorrect - Parallel tests run alongside production but may use production systems',
                    'Correct - Simulation tests use non-production environments to test DRP components without affecting live services',
                    'Incorrect - Walkthroughs are discussion-based and do not involve activating actual systems',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 30 - L2 - Understand
            [
                'subtopic' => 'Testing',
                'question' => 'The key characteristic of a "Parallel Test" is that:',
                'options' => [
                    'The primary site is shut down',
                    'Recovery operations run concurrently with normal business operations',
                    'It is only a theoretical discussion',
                    'Only IT systems are involved',
                ],
                'correct_options' => ['Recovery operations run concurrently with normal business operations'],
                'justifications' => [
                    'Incorrect - Shutting down the primary site describes a full interruption test',
                    'Correct - Parallel tests run recovery systems alongside production without shutting down primary operations',
                    'Incorrect - Theoretical discussions describe tabletop exercises or walkthroughs',
                    'Incorrect - Parallel tests involve both IT systems and business processes, not just IT',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Topic 4: Crisis Management & Communication (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 31 - L4 - Analyze
            [
                'subtopic' => 'Recovery Strategy',
                'question' => 'A ransomware attack is detected within your organization. After 45 minutes of investigation, it is found that three mission-critical systems are encrypted and backups appear potentially compromised. The incident response team is actively containing the threat. Which of the following is the BEST course of action at this point?',
                'options' => [
                    'Wait for two more hours to complete a full forensic analysis before declaring a disaster',
                    'Notify law enforcement and defer internal action until legal approval is obtained',
                    'Declare a disaster immediately based on initial impact assessment and activate the DRP',
                    'Isolate the affected systems and continue monitoring before deciding whether to declare a disaster',
                ],
                'correct_options' => ['Declare a disaster immediately based on initial impact assessment and activate the DRP'],
                'justifications' => [
                    'Incorrect - Waiting extends downtime when mission-critical systems are already compromised',
                    'Incorrect - While law enforcement should be notified, internal recovery actions should not be delayed',
                    'Correct - With mission-critical systems encrypted and backup integrity questioned, disaster declaration enables full recovery resources',
                    'Incorrect - Systems are already isolated; further delay prevents recovery when disaster criteria are clearly met',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 32 - L1 - Remember
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'A common method for backup verification is:',
                'options' => [
                    'Simply checking the file size',
                    'Performing checksums or hash comparisons',
                    'Running a virus scan on the backup',
                    'Renaming the backup files',
                ],
                'correct_options' => ['Performing checksums or hash comparisons'],
                'justifications' => [
                    'Incorrect - File size alone does not verify data integrity or completeness',
                    'Correct - Checksums and hash comparisons verify data integrity by detecting any changes or corruption',
                    'Incorrect - Virus scans check for malware but do not verify backup data integrity',
                    'Incorrect - Renaming files is not a verification method and provides no integrity checking',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -1.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 33 - L2 - Understand
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'Why are regular backup verification and restoration testing crucial?',
                'options' => [
                    'They speed up the backup process',
                    'To ensure data is recoverable when needed',
                    'They reduce the amount of data backed up',
                    'They eliminate the need for offsite storage',
                ],
                'correct_options' => ['To ensure data is recoverable when needed'],
                'justifications' => [
                    'Incorrect - Verification and testing do not affect backup speed',
                    'Correct - Testing ensures backups are valid and data can actually be restored during disasters',
                    'Incorrect - Verification does not reduce backup data volume',
                    'Incorrect - Testing does not eliminate the need for offsite backup storage',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.6,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 34 - L2 - Understand
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'To fully restore from an incremental backup scheme, you typically need:',
                'options' => [
                    'Only the latest incremental',
                    'The last full backup plus all subsequent incrementals',
                    'The last full backup and the latest differential',
                    'Any single backup file',
                ],
                'correct_options' => ['The last full backup plus all subsequent incrementals'],
                'justifications' => [
                    'Incorrect - Latest incremental only contains changes since the previous backup, not complete data',
                    'Correct - Incremental backups require the full backup plus all incremental backups in sequence to rebuild complete data',
                    'Incorrect - This describes differential backup restoration, not incremental',
                    'Incorrect - Single backup files cannot provide complete data restoration in incremental schemes',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 35 - L1 - Remember
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'A "differential backup" includes all data that has changed since the:',
                'options' => [
                    'Last incremental backup',
                    'Last full backup',
                    'Previous day',
                    'System installation',
                ],
                'correct_options' => ['Last full backup'],
                'justifications' => [
                    'Incorrect - Differential backups are not based on incremental backups',
                    'Correct - Differential backups capture all changes since the last full backup, regardless of when that occurred',
                    'Incorrect - Differential backups are not time-based but reference the last full backup',
                    'Incorrect - System installation is not the reference point for differential backups',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.9,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 36 - L1 - Remember
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'What does the 3-2-1 backup rule recommend?',
                'options' => [
                    'Keep three different types of backups daily',
                    'Maintain three copies of data, on two different media types, with one offsite',
                    'Use three backups per week, with two air-gapped, and one immutable',
                    'Perform backups every three hours, with two snapshots and one mirror copy',
                ],
                'correct_options' => ['Maintain three copies of data, on two different media types, with one offsite'],
                'justifications' => [
                    'Incorrect - The rule is not about different types of backups but about copies and locations',
                    'Correct - The 3-2-1 rule: 3 copies of data, 2 different media types, 1 offsite for protection',
                    'Incorrect - This describes frequency and protection methods, not the 3-2-1 rule',
                    'Incorrect - This describes backup frequency and methods, not the standard 3-2-1 rule',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.8,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 37 - L2 - Understand
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'In the Grandfather-Father-Son (GFS) backup rotation scheme, which backup typically represents the monthly full backup?',
                'options' => [
                    'Son',
                    'Clone',
                    'Grandfather',
                    'Father',
                ],
                'correct_options' => ['Grandfather'],
                'justifications' => [
                    'Incorrect - Son represents daily backups in the GFS rotation scheme',
                    'Incorrect - Clone is not part of the traditional GFS backup terminology',
                    'Correct - Grandfather represents the monthly backup in the GFS rotation scheme',
                    'Incorrect - Father represents weekly backups in the GFS rotation scheme',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 38 - L2 - Understand
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'What is the main advantage of incremental backups over differential backups?',
                'options' => [
                    'Faster full recovery time',
                    'More frequent restore points',
                    'Reduced backup storage and time',
                    'Eliminates need for full backups',
                ],
                'correct_options' => ['Reduced backup storage and time'],
                'justifications' => [
                    'Incorrect - Incremental backups actually require longer recovery time due to multiple restore steps',
                    'Incorrect - Both incremental and differential can provide frequent restore points',
                    'Correct - Incremental backups use less storage space and time by only backing up changes since last backup',
                    'Incorrect - Both incremental and differential backups require periodic full backups as a baseline',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 39 - L3 - Apply
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'Which of the following metrics could include the statement "If the primary database is corrupted by an incident, the organization might lose 30 seconds of data at the recovery site"?',
                'options' => [
                    'Recovery time objective (RTO)',
                    'Maximum tolerable downtime (MTD)',
                    'Mean Time to Repair (MTTR)',
                    'Recovery point objective (RPO)',
                ],
                'correct_options' => ['Recovery point objective (RPO)'],
                'justifications' => [
                    'Incorrect - RTO measures how long it takes to restore service, not data loss amount',
                    'Incorrect - MTD measures maximum acceptable downtime, not data loss',
                    'Incorrect - MTTR measures repair time, not data loss tolerance',
                    'Correct - RPO defines acceptable data loss measured in time, such as losing 30 seconds of data',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 40 - L3 - Apply
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'Which of the following answers the question "How long can it take for our system to recover after we were notified of a business disruption?"',
                'options' => [
                    'Recovery time objective (RTO)',
                    'Maximum tolerable downtime (MTD)',
                    'Mean Time Between Failures (MTBF)',
                    'Recovery point objective (RPO)',
                ],
                'correct_options' => ['Recovery time objective (RTO)'],
                'justifications' => [
                    'Correct - RTO defines the target time for system recovery after a disruption is identified',
                    'Incorrect - MTD is the absolute maximum downtime before severe consequences, not recovery time target',
                    'Incorrect - MTBF measures reliability between failures, not recovery time after disruption',
                    'Incorrect - RPO measures acceptable data loss, not recovery time duration',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Topic 5: Testing, Training & Maintenance (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1

            // Item 41 - L1 - Remember
            [
                'subtopic' => 'Testing',
                'question' => 'What are the main types of business continuity and disaster recovery tests?',
                'options' => [
                    'Only full-scale operational tests that shut down primary systems',
                    'Tabletop exercises, walkthroughs, simulation tests, and full operational tests',
                    'Annual compliance audits and regulatory inspections',
                    'Employee surveys and management reviews',
                ],
                'correct_options' => ['Tabletop exercises, walkthroughs, simulation tests, and full operational tests'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Tabletop exercises, walkthroughs, simulation tests, and full operational tests',
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

            // Item 42 - L3 - Apply
            [
                'subtopic' => 'Testing',
                'question' => 'Which DRP testing method poses the highest risk of service disruption to the live environment?',
                'options' => [
                    'Tabletop exercise',
                    'Simulation test',
                    'Full Interruption Test',
                    'Walkthrough',
                ],
                'correct_options' => ['Full Interruption Test'],
                'justifications' => [
                    'Incorrect - Tabletop exercises are discussion-based with no system impact',
                    'Incorrect - Simulation tests use non-production environments',
                    'Correct - Full interruption tests shut down production systems, creating the highest risk of service disruption',
                    'Incorrect - Walkthroughs are procedural reviews with no system interaction',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 43 - L2 - Understand
            [
                'subtopic' => 'Testing',
                'question' => 'A primary benefit of a "Full Interruption Test" is its ability to:',
                'options' => [
                    'Minimize costs',
                    'Validate the plan in a real-world scenario',
                    'Keep all systems online',
                    'Only involve a small team',
                ],
                'correct_options' => ['Validate the plan in a real-world scenario'],
                'justifications' => [
                    'Incorrect - Full interruption tests are typically the most expensive testing method',
                    'Correct - Full interruption tests provide the most realistic validation by actually shutting down production systems',
                    'Incorrect - Full interruption tests specifically shut down systems, the opposite of keeping them online',
                    'Incorrect - Full interruption tests typically require extensive team involvement due to their complexity',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.3,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 44 - L3 - Apply
            [
                'subtopic' => 'Testing',
                'question' => 'When conducting a "Simulation Test," what is a common challenge?',
                'options' => [
                    'Lack of participant engagement',
                    'Ensuring the test environment accurately mirrors production',
                    'It\'s too costly for most organizations',
                    'It always causes downtime',
                ],
                'correct_options' => ['Ensuring the test environment accurately mirrors production'],
                'justifications' => [
                    'Incorrect - Simulation tests typically have good engagement as they involve hands-on activities',
                    'Correct - The main challenge is creating test environments that accurately represent production complexity and dependencies',
                    'Incorrect - Simulation tests are generally cost-effective compared to full interruption tests',
                    'Incorrect - Simulation tests specifically avoid downtime by using non-production environments',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 45 - L4 - Analyze
            [
                'subtopic' => 'Testing',
                'question' => 'Different types of tests exist for testing the effectiveness of recovery plans. Which of the following choices would occur during a parallel test but not occur during a simulation test?',
                'options' => [
                    'The team members step through the individual recovery tasks',
                    'The primary site operations are interrupted',
                    'A fictitious scenario is used for the test',
                    'The recovery site is brought to operational readiness',
                ],
                'correct_options' => ['The recovery site is brought to operational readiness'],
                'justifications' => [
                    'Incorrect - Both parallel and simulation tests involve stepping through recovery tasks',
                    'Incorrect - Neither parallel nor simulation tests interrupt primary site operations',
                    'Incorrect - Both test types can use fictitious scenarios',
                    'Correct - Parallel tests bring the recovery site to full operational readiness alongside production, while simulation tests use non-production environments',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.6,
                'irt_b' => 0.5,
                'irt_c' => 0.20,
                'status' => 'published',
            ],

            // Item 46 - L1 - Remember
            [
                'subtopic' => 'Testing',
                'question' => 'The "Lessons Learned" process typically begins:',
                'options' => [
                    'Before the DRP is written',
                    'After a DRP test or actual incident',
                    'Only when a new tool is implemented',
                    'At the start of a new fiscal year',
                ],
                'correct_options' => ['After a DRP test or actual incident'],
                'justifications' => [
                    'Incorrect - Lessons learned require experience from testing or incidents to analyze',
                    'Correct - Lessons learned sessions analyze what worked and what didn\'t after tests or actual events',
                    'Incorrect - Lessons learned are not limited to new tool implementations',
                    'Incorrect - Lessons learned are event-driven, not calendar-driven',
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 2,
                'irt_a' => 1.0,
                'irt_b' => -0.9,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 47 - L2 - Understand
            [
                'subtopic' => 'Testing',
                'question' => 'The goal of a "Lessons Learned" session is primarily:',
                'options' => [
                    'To close the incident quickly',
                    'To improve future response capabilities',
                    'To justify current practices',
                    'To prove the plan was perfect',
                ],
                'correct_options' => ['To improve future response capabilities'],
                'justifications' => [
                    'Incorrect - Closing incidents quickly is not the purpose of lessons learned sessions',
                    'Correct - The primary goal is to identify improvements and enhance future disaster response effectiveness',
                    'Incorrect - Lessons learned should objectively analyze performance, not justify existing practices',
                    'Incorrect - Lessons learned assume there are areas for improvement, not perfection',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.1,
                'irt_b' => -0.7,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 48 - L2 - Understand
            [
                'subtopic' => 'Testing',
                'question' => '"Continuous Improvement" for DRP is best achieved through:',
                'options' => [
                    'Setting the plan once and never touching it',
                    'Regular reviews, updates, and testing',
                    'Only responding to actual disasters',
                    'Automating all recovery steps',
                ],
                'correct_options' => ['Regular reviews, updates, and testing'],
                'justifications' => [
                    'Incorrect - Static plans become outdated and ineffective over time',
                    'Correct - Continuous improvement requires ongoing assessment, updates, and validation through regular testing',
                    'Incorrect - Waiting for disasters is reactive and misses opportunities for proactive improvement',
                    'Incorrect - While automation helps, continuous improvement requires human analysis and planning updates',
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 2,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 49 - L3 - Apply
            [
                'subtopic' => 'Testing',
                'question' => 'A key indicator of effective continuous improvement in DRP is:',
                'options' => [
                    'The plan remains unchanged for years',
                    'Post-test reports consistently show the same issues',
                    'RTO and RPO targets are consistently met or improved',
                    'No one needs to read the plan',
                ],
                'correct_options' => ['RTO and RPO targets are consistently met or improved'],
                'justifications' => [
                    'Incorrect - Unchanged plans indicate lack of improvement and adaptation',
                    'Incorrect - Recurring issues suggest continuous improvement is not working effectively',
                    'Correct - Meeting or improving RTO/RPO targets demonstrates measurable improvement in recovery capabilities',
                    'Incorrect - Team familiarity with the plan is important, but not reading it suggests poor engagement',
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published',
            ],

            // Item 50 - L4 - Analyze
            [
                'subtopic' => 'Testing',
                'question' => 'Which of the following is the BEST indication that the disaster recovery plan (DRP) testing was successful?',
                'options' => [
                    'The recovery time objective was maintained during testing',
                    'The test report was shared with the senior management',
                    'The business process owners were active participants during testing',
                    'Systems were restored in the order of priority during testing',
                ],
                'correct_options' => ['The recovery time objective was maintained during testing'],
                'justifications' => [
                    'Correct - Meeting RTO demonstrates the plan can achieve its primary objective of timely recovery',
                    'Incorrect - Sharing reports is good communication but doesn\'t indicate test success',
                    'Incorrect - Stakeholder participation is important but doesn\'t measure recovery effectiveness',
                    'Incorrect - Following priority order is good but doesn\'t guarantee meeting time objectives',
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published',
            ],
        ];
    }
}
