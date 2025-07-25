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
                    'Protect systems in alphabetical order to ensure fair treatment'
                ],
                'correct_options' => ['Prioritize order processing system due to its critical revenue impact, then assess other systems based on business disruption severity'],
                'justifications' => [
                    'Incorrect - Equal protection ignores varying business criticality and impact levels',
                    'Correct - BIA identifies critical processes by business impact, prioritizing resources based on disruption severity',
                    'Incorrect - Technical criteria should not override business impact assessment',
                    'Incorrect - Arbitrary ordering ignores business impact analysis methodology'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => 0.0,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 2 - L2 - Understand
            [
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'How does Maximum Tolerable Downtime (MTD) differ from Recovery Time Objective (RTO)?',
                'options' => [
                    'MTD and RTO are identical concepts with no meaningful difference',
                    'MTD is the absolute maximum time before severe consequences, while RTO is the target recovery time',
                    'MTD applies only to IT systems, while RTO applies to business processes',
                    'MTD is always shorter than RTO for critical systems'
                ],
                'correct_options' => ['MTD is the absolute maximum time before severe consequences, while RTO is the target recovery time'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - MTD is the absolute maximum time before severe consequences, while RTO is the target recovery time',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 3 - L2 - Understand
            [
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'Why is stakeholder input critical for conducting an effective BIA?',
                'options' => [
                    'Stakeholders provide the most cost-effective solutions',
                    'Business process owners understand operational dependencies and impact better than technical teams',
                    'Stakeholder involvement reduces the time required for analysis',
                    'Stakeholders always provide accurate technical specifications'
                ],
                'correct_options' => ['Business process owners understand operational dependencies and impact better than technical teams'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Business process owners understand operational dependencies and impact better than technical teams',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 4 - L3 - Apply
            [
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'A hospital needs to prioritize recovery efforts for different systems during an outage. How should they apply BIA findings?',
                'options' => [
                    'Recover systems in order of implementation cost',
                    'Prioritize based on criticality ratings and impact on patient safety',
                    'Focus on the most technically complex systems first',
                    'Recover all systems simultaneously regardless of priority'
                ],
                'correct_options' => ['Prioritize based on criticality ratings and impact on patient safety'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Prioritize based on criticality ratings and impact on patient safety',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.1,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 5 - L3 - Apply
            [
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'How should an organization determine Recovery Point Objective (RPO) for financial trading systems?',
                'options' => [
                    'Set RPO based on industry average to minimize costs',
                    'Analyze financial impact of data loss and regulatory requirements to determine acceptable loss',
                    'Use the same RPO for all systems to simplify management',
                    'Set RPO to zero for all financial data regardless of cost'
                ],
                'correct_options' => ['Analyze financial impact of data loss and regulatory requirements to determine acceptable loss'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Analyze financial impact of data loss and regulatory requirements to determine acceptable loss',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.3,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 6 - L3 - Apply
            [
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'What is the most effective approach for quantifying business impact in terms of financial loss?',
                'options' => [
                    'Use estimates based on similar organizations in the industry',
                    'Calculate direct costs, indirect costs, and intangible impacts specific to the organization',
                    'Focus only on immediate revenue loss without considering other factors',
                    'Apply a standard percentage across all business processes'
                ],
                'correct_options' => ['Calculate direct costs, indirect costs, and intangible impacts specific to the organization'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Calculate direct costs, indirect costs, and intangible impacts specific to the organization',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.5,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 7 - L4 - Analyze
            [
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'Analyze why interdependency mapping is often the most challenging aspect of conducting a comprehensive BIA.',
                'options' => [
                    'Interdependency mapping requires expensive specialized software',
                    'Complex interconnections between processes, systems, and suppliers are difficult to identify and document completely',
                    'Interdependency mapping only works for manufacturing organizations',
                    'Legal restrictions prevent complete interdependency analysis'
                ],
                'correct_options' => ['Complex interconnections between processes, systems, and suppliers are difficult to identify and document completely'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Complex interconnections between processes, systems, and suppliers are difficult to identify and document completely',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 8 - L4 - Analyze
            [
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'What is the fundamental challenge in conducting BIA for cloud-based and distributed business processes?',
                'options' => [
                    'Cloud environments are inherently more reliable than on-premises',
                    'Shared infrastructure and multi-tenancy create complex dependency relationships',
                    'Cloud providers handle all business impact analysis automatically',
                    'Distributed processes have identical impact characteristics as centralized ones'
                ],
                'correct_options' => ['Shared infrastructure and multi-tenancy create complex dependency relationships'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Shared infrastructure and multi-tenancy create complex dependency relationships',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 9 - L5 - Evaluate
            [
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'A company\'s BIA indicates that all business processes are equally critical and require immediate recovery. Evaluate this conclusion.',
                'options' => [
                    'This is a realistic finding that demonstrates comprehensive business operations',
                    'This suggests insufficient analysis or stakeholder bias, as true priorities should emerge from proper BIA',
                    'Equal criticality is the preferred outcome for business continuity planning',
                    'This finding eliminates the need for priority-based recovery strategies'
                ],
                'correct_options' => ['This suggests insufficient analysis or stakeholder bias, as true priorities should emerge from proper BIA'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - This suggests insufficient analysis or stakeholder bias, as true priorities should emerge from proper BIA',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published'
            ],
            
            // Item 10 - L5 - Evaluate
            [
                'subtopic' => 'Business Impact Analysis (BIA)',
                'question' => 'Assess the effectiveness of using automated tools versus manual processes for conducting organizational BIA.',
                'options' => [
                    'Automated tools always provide more accurate results than manual analysis',
                    'Effective BIA requires both automated data collection and human judgment for context and validation',
                    'Manual processes are always superior for understanding business relationships',
                    'The choice between automated and manual approaches has no impact on BIA quality'
                ],
                'correct_options' => ['Effective BIA requires both automated data collection and human judgment for context and validation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Effective BIA requires both automated data collection and human judgment for context and validation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published'
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
                    'Employee training materials and performance metrics'
                ],
                'correct_options' => ['Risk assessment, business impact analysis, recovery strategies, and response procedures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Risk assessment, business impact analysis, recovery strategies, and response procedures',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 12 - L2 - Understand
            [
                'subtopic' => 'Business Continuity Planning',
                'question' => 'How does business continuity planning differ from disaster recovery planning?',
                'options' => [
                    'Business continuity and disaster recovery are identical concepts',
                    'Business continuity focuses on maintaining operations while disaster recovery focuses on restoring systems',
                    'Business continuity is only for large enterprises, disaster recovery is for small businesses',
                    'Business continuity is less expensive than disaster recovery planning'
                ],
                'correct_options' => ['Business continuity focuses on maintaining operations while disaster recovery focuses on restoring systems'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Business continuity focuses on maintaining operations while disaster recovery focuses on restoring systems',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 13 - L2 - Understand
            [
                'subtopic' => 'Business Continuity Planning',
                'question' => 'Why is senior management support critical for effective business continuity planning?',
                'options' => [
                    'Senior management has the most technical expertise',
                    'Leadership provides resources, authority, and organizational commitment necessary for success',
                    'Senior management is required by law to oversee continuity planning',
                    'Leadership support reduces the cost of business continuity initiatives'
                ],
                'correct_options' => ['Leadership provides resources, authority, and organizational commitment necessary for success'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Leadership provides resources, authority, and organizational commitment necessary for success',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 14 - L3 - Apply
            [
                'subtopic' => 'Business Continuity Planning',
                'question' => 'A manufacturing company experiences a fire in their primary facility. How should their BCP address workforce relocation?',
                'options' => [
                    'Send all employees home until the facility is rebuilt',
                    'Implement predetermined alternate work arrangements and remote operations procedures',
                    'Permanently close operations and liquidate the business',
                    'Wait for insurance settlements before making workforce decisions'
                ],
                'correct_options' => ['Implement predetermined alternate work arrangements and remote operations procedures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement predetermined alternate work arrangements and remote operations procedures',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 15 - L3 - Apply
            [
                'subtopic' => 'Business Continuity Planning',
                'question' => 'How should an organization integrate business continuity planning with their risk management framework?',
                'options' => [
                    'Keep business continuity and risk management completely separate',
                    'Align BCP strategies with identified risks and risk appetite to ensure consistent approach',
                    'Only focus on business continuity for risks that cannot be prevented',
                    'Use identical procedures for both risk management and business continuity'
                ],
                'correct_options' => ['Align BCP strategies with identified risks and risk appetite to ensure consistent approach'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Align BCP strategies with identified risks and risk appetite to ensure consistent approach',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 16 - L3 - Apply
            [
                'subtopic' => 'Business Continuity Planning',
                'question' => 'What is the most effective approach for developing communication plans within a BCP?',
                'options' => [
                    'Use only email communication to maintain written records',
                    'Establish multiple communication channels with clear escalation procedures and stakeholder matrices',
                    'Rely on social media platforms for all emergency communication',
                    'Designate a single person to handle all crisis communications'
                ],
                'correct_options' => ['Establish multiple communication channels with clear escalation procedures and stakeholder matrices'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Establish multiple communication channels with clear escalation procedures and stakeholder matrices',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 17 - L4 - Analyze
            [
                'subtopic' => 'Business Continuity Planning',
                'question' => 'Analyze why many business continuity plans fail during actual disruptions despite thorough preparation.',
                'options' => [
                    'Business continuity plans are inherently flawed concepts',
                    'Plans often lack realistic testing, assume ideal conditions, or fail to account for human factors under stress',
                    'Disruptions are always more severe than anticipated',
                    'Technology failures make all business continuity plans ineffective'
                ],
                'correct_options' => ['Plans often lack realistic testing, assume ideal conditions, or fail to account for human factors under stress'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Plans often lack realistic testing, assume ideal conditions, or fail to account for human factors under stress',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 18 - L4 - Analyze
            [
                'subtopic' => 'Business Continuity Planning',
                'question' => 'What is the fundamental challenge in maintaining business continuity plan relevance in rapidly changing business environments?',
                'options' => [
                    'Business environments never change rapidly enough to affect plans',
                    'Dynamic business processes, technology changes, and organizational evolution require continuous plan updates',
                    'Static plans are always preferable to dynamic ones',
                    'Plan relevance is not important for business continuity effectiveness'
                ],
                'correct_options' => ['Dynamic business processes, technology changes, and organizational evolution require continuous plan updates'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Dynamic business processes, technology changes, and organizational evolution require continuous plan updates',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 19 - L5 - Evaluate
            [
                'subtopic' => 'Business Continuity Planning',
                'question' => 'A global organization implements identical business continuity plans across all locations to ensure consistency. Evaluate this approach.',
                'options' => [
                    'Standardized plans always provide the best business continuity outcomes',
                    'While consistency has benefits, plans must account for local regulations, culture, and risk profiles',
                    'Identical plans eliminate all coordination challenges during global incidents',
                    'Local variations in business continuity plans create unnecessary complexity'
                ],
                'correct_options' => ['While consistency has benefits, plans must account for local regulations, culture, and risk profiles'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - While consistency has benefits, plans must account for local regulations, culture, and risk profiles',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published'
            ],
            
            // Item 20 - L5 - Evaluate
            [
                'subtopic' => 'Business Continuity Planning',
                'question' => 'Assess the balance between comprehensive business continuity planning and organizational agility in responding to unforeseen disruptions.',
                'options' => [
                    'Comprehensive planning always reduces organizational agility',
                    'Effective planning provides structure while enabling adaptive responses to novel situations',
                    'Organizational agility eliminates the need for formal business continuity planning',
                    'Planning and agility are mutually exclusive organizational capabilities'
                ],
                'correct_options' => ['Effective planning provides structure while enabling adaptive responses to novel situations'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Effective planning provides structure while enabling adaptive responses to novel situations',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 2.0,
                'irt_b' => 1.3,
                'irt_c' => 0.15,
                'status' => 'published'
            ],
            
            // Topic 3: Disaster Recovery Planning (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 21 - L1 - Remember
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'What is the primary objective of a Disaster Recovery Plan (DRP)?',
                'options' => [
                    'Preventing all possible disasters from occurring',
                    'Restoring critical IT systems and data after a disruptive event',
                    'Reducing insurance premiums and liability costs',
                    'Improving overall system performance and efficiency'
                ],
                'correct_options' => ['Restoring critical IT systems and data after a disruptive event'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Restoring critical IT systems and data after a disruptive event',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 22 - L1 - Remember
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'What does RTO stand for in disaster recovery planning?',
                'options' => [
                    'Recovery Time Objective',
                    'Real-Time Operations',
                    'Risk Transfer Option',
                    'Resource Technology Optimization'
                ],
                'correct_options' => ['Recovery Time Objective'],
                'justifications' => [
                    'Correct - Recovery Time Objective',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 23 - L2 - Understand
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'How do hot sites, warm sites, and cold sites differ in disaster recovery strategies?',
                'options' => [
                    'They refer to different geographic locations for backup facilities',
                    'They represent different levels of readiness and recovery speed capabilities',
                    'They indicate different temperature control requirements for equipment',
                    'They describe different types of natural disaster scenarios'
                ],
                'correct_options' => ['They represent different levels of readiness and recovery speed capabilities'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - They represent different levels of readiness and recovery speed capabilities',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 24 - L2 - Understand
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'Why is regular backup testing critical for effective disaster recovery?',
                'options' => [
                    'Testing reduces storage costs for backup systems',
                    'Testing validates backup integrity and recovery procedures before they are needed',
                    'Testing is required by law for all organizations',
                    'Testing improves backup performance and speed'
                ],
                'correct_options' => ['Testing validates backup integrity and recovery procedures before they are needed'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Testing validates backup integrity and recovery procedures before they are needed',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 25 - L3 - Apply
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'An e-commerce company requires 99.9% uptime and cannot tolerate more than 15 minutes of downtime. What disaster recovery approach should they implement?',
                'options' => [
                    'Weekly tape backups with cold site recovery',
                    'Real-time replication with hot site failover capabilities',
                    'Monthly backup with manual recovery procedures',
                    'Cloud storage only without redundant systems'
                ],
                'correct_options' => ['Real-time replication with hot site failover capabilities'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Real-time replication with hot site failover capabilities',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 26 - L3 - Apply
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'How should an organization prioritize system recovery when multiple systems fail simultaneously?',
                'options' => [
                    'Recover systems in order of implementation cost',
                    'Use business impact analysis to prioritize based on criticality and dependencies',
                    'Recover the most complex systems first',
                    'Attempt to recover all systems simultaneously'
                ],
                'correct_options' => ['Use business impact analysis to prioritize based on criticality and dependencies'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Use business impact analysis to prioritize based on criticality and dependencies',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 27 - L3 - Apply
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'What is the most effective approach for implementing disaster recovery in a multi-cloud environment?',
                'options' => [
                    'Use only one cloud provider to simplify recovery procedures',
                    'Implement cross-cloud replication with automated failover and consistent recovery procedures',
                    'Rely on cloud providers to handle all disaster recovery automatically',
                    'Avoid cloud environments for critical systems requiring disaster recovery'
                ],
                'correct_options' => ['Implement cross-cloud replication with automated failover and consistent recovery procedures'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement cross-cloud replication with automated failover and consistent recovery procedures',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 28 - L4 - Analyze
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'Analyze why traditional disaster recovery approaches may be inadequate for modern distributed and microservices architectures.',
                'options' => [
                    'Distributed systems never experience failures',
                    'Complex interdependencies and stateless services require different recovery strategies than monolithic systems',
                    'Traditional approaches work better for distributed systems',
                    'Microservices eliminate the need for disaster recovery planning'
                ],
                'correct_options' => ['Complex interdependencies and stateless services require different recovery strategies than monolithic systems'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Complex interdependencies and stateless services require different recovery strategies than monolithic systems',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 29 - L4 - Analyze
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'What is the fundamental challenge in achieving consistent RPOs across globally distributed data centers?',
                'options' => [
                    'Global data centers always have identical network characteristics',
                    'Network latency, bandwidth limitations, and regulatory requirements create synchronization challenges',
                    'Time zone differences prevent effective disaster recovery',
                    'Global consistency is not important for disaster recovery'
                ],
                'correct_options' => ['Network latency, bandwidth limitations, and regulatory requirements create synchronization challenges'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Network latency, bandwidth limitations, and regulatory requirements create synchronization challenges',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 30 - L5 - Evaluate
            [
                'subtopic' => 'Disaster Recovery',
                'question' => 'A company implements disaster recovery as a service (DRaaS) and considers their disaster recovery complete. Evaluate this approach.',
                'options' => [
                    'DRaaS provides complete disaster recovery with no additional requirements',
                    'DRaaS provides infrastructure but requires integration with business processes and regular testing',
                    'DRaaS is inappropriate for any business disaster recovery needs',
                    'External DRaaS eliminates all disaster recovery risks'
                ],
                'correct_options' => ['DRaaS provides infrastructure but requires integration with business processes and regular testing'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - DRaaS provides infrastructure but requires integration with business processes and regular testing',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.5,
                'irt_c' => 0.15,
                'status' => 'published'
            ],
            
            // Topic 4: Crisis Management & Communication (10 questions)
            // Bloom Distribution: L1:2, L2:2, L3:3, L4:2, L5:1
            
            // Item 31 - L1 - Remember
            [
                'subtopic' => 'Recovery Strategy',
                'question' => 'What are the key elements of an effective crisis communication plan?',
                'options' => [
                    'Only internal employee communication procedures',
                    'Stakeholder identification, communication channels, key messages, and spokesperson designation',
                    'Social media monitoring and response capabilities',
                    'Legal disclaimers and liability protection statements'
                ],
                'correct_options' => ['Stakeholder identification, communication channels, key messages, and spokesperson designation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Stakeholder identification, communication channels, key messages, and spokesperson designation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.5,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 32 - L1 - Remember
            [
                'subtopic' => 'Recovery Strategy',
                'question' => 'What is the primary role of a crisis management team?',
                'options' => [
                    'To prevent all crises from occurring in the organization',
                    'To coordinate response efforts and make critical decisions during emergencies',
                    'To handle public relations and media management exclusively',
                    'To investigate the root causes of incidents after they occur'
                ],
                'correct_options' => ['To coordinate response efforts and make critical decisions during emergencies'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - To coordinate response efforts and make critical decisions during emergencies',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.3,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 33 - L2 - Understand
            [
                'subtopic' => 'Recovery Strategy',
                'question' => 'How does crisis communication differ during different phases of incident response?',
                'options' => [
                    'Communication messages remain identical throughout all phases',
                    'Messages evolve from initial alerts to status updates to recovery communications',
                    'Crisis communication is only needed during the recovery phase',
                    'Different phases require completely different communication teams'
                ],
                'correct_options' => ['Messages evolve from initial alerts to status updates to recovery communications'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Messages evolve from initial alerts to status updates to recovery communications',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 34 - L2 - Understand
            [
                'subtopic' => 'Recovery Strategy',
                'question' => 'Why is timing critical in crisis communication?',
                'options' => [
                    'Timing only matters for legal compliance requirements',
                    'Early and regular communication helps control narrative and reduces speculation',
                    'Crisis communication should be delayed until all facts are known',
                    'Timing has no impact on crisis communication effectiveness'
                ],
                'correct_options' => ['Early and regular communication helps control narrative and reduces speculation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Early and regular communication helps control narrative and reduces speculation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.1,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 35 - L3 - Apply
            [
                'subtopic' => 'Recovery Strategy',
                'question' => 'A data breach exposes customer personal information at a retail company. How should they approach initial crisis communication?',
                'options' => [
                    'Wait until the investigation is complete before any communication',
                    'Immediately notify affected customers and stakeholders with known facts and remediation steps',
                    'Only communicate with law enforcement and regulators',
                    'Deny any security incident until proven otherwise'
                ],
                'correct_options' => ['Immediately notify affected customers and stakeholders with known facts and remediation steps'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Immediately notify affected customers and stakeholders with known facts and remediation steps',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 36 - L3 - Apply
            [
                'subtopic' => 'Recovery Strategy',
                'question' => 'How should an organization manage social media communication during a crisis?',
                'options' => [
                    'Disable all social media accounts until the crisis is resolved',
                    'Monitor social media closely and respond with consistent, accurate information',
                    'Let the crisis escalate on social media without any organizational response',
                    'Only use social media for positive news after the crisis ends'
                ],
                'correct_options' => ['Monitor social media closely and respond with consistent, accurate information'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Monitor social media closely and respond with consistent, accurate information',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 37 - L3 - Apply
            [
                'subtopic' => 'Recovery Strategy',
                'question' => 'What is the most effective approach for coordinating crisis communication across multiple locations and time zones?',
                'options' => [
                    'Let each location handle communication independently',
                    'Establish centralized coordination with local implementation and cultural adaptation',
                    'Use only digital communication to ensure consistency',
                    'Delay all communication until business hours in each location'
                ],
                'correct_options' => ['Establish centralized coordination with local implementation and cultural adaptation'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Establish centralized coordination with local implementation and cultural adaptation',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 38 - L4 - Analyze
            [
                'subtopic' => 'Recovery Strategy',
                'question' => 'Analyze why many organizations struggle with maintaining credibility during crisis communication.',
                'options' => [
                    'Credibility is not important during crisis situations',
                    'Inconsistent messages, delayed responses, or appearing to hide information damages trust',
                    'Stakeholders never expect transparency during crises',
                    'Technical complexity makes credible communication impossible'
                ],
                'correct_options' => ['Inconsistent messages, delayed responses, or appearing to hide information damages trust'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Inconsistent messages, delayed responses, or appearing to hide information damages trust',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.9,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 39 - L4 - Analyze
            [
                'subtopic' => 'Recovery Strategy',
                'question' => 'What is the fundamental challenge in balancing transparency with legal and competitive considerations during crisis communication?',
                'options' => [
                    'Legal considerations always override transparency requirements',
                    'Organizations must provide sufficient information to maintain trust while protecting legal interests',
                    'Competitive considerations are irrelevant during crisis situations',
                    'Transparency always increases legal liability'
                ],
                'correct_options' => ['Organizations must provide sufficient information to maintain trust while protecting legal interests'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Organizations must provide sufficient information to maintain trust while protecting legal interests',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.1,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 40 - L5 - Evaluate
            [
                'subtopic' => 'Recovery Strategy',
                'question' => 'A multinational corporation uses identical crisis communication templates across all countries and cultures. Evaluate this approach.',
                'options' => [
                    'Identical templates ensure perfect consistency across all markets',
                    'Templates provide structure but must be adapted for local culture, language, and regulatory requirements',
                    'Cultural differences have no impact on crisis communication effectiveness',
                    'Localized communication creates too much complexity to be practical'
                ],
                'correct_options' => ['Templates provide structure but must be adapted for local culture, language, and regulatory requirements'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Templates provide structure but must be adapted for local culture, language, and regulatory requirements',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 5,
                'difficulty_level' => 5,
                'irt_a' => 1.9,
                'irt_b' => 1.4,
                'irt_c' => 0.15,
                'status' => 'published'
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
                    'Employee surveys and management reviews'
                ],
                'correct_options' => ['Tabletop exercises, walkthroughs, simulation tests, and full operational tests'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Tabletop exercises, walkthroughs, simulation tests, and full operational tests',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.8,
                'irt_b' => -1.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 42 - L1 - Remember
            [
                'subtopic' => 'Testing',
                'question' => 'What is the primary purpose of conducting tabletop exercises for business continuity?',
                'options' => [
                    'To test the actual technical recovery capabilities of systems',
                    'To validate decision-making processes and communication procedures without operational impact',
                    'To satisfy regulatory requirements for disaster recovery testing',
                    'To reduce insurance premiums through demonstrated preparedness'
                ],
                'correct_options' => ['To validate decision-making processes and communication procedures without operational impact'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - To validate decision-making processes and communication procedures without operational impact',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 1,
                'difficulty_level' => 1,
                'irt_a' => 0.9,
                'irt_b' => -1.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 43 - L2 - Understand
            [
                'subtopic' => 'Testing',
                'question' => 'How does progressive testing methodology improve business continuity preparedness?',
                'options' => [
                    'Progressive testing eliminates the need for comprehensive planning',
                    'It builds confidence and identifies issues through increasingly complex test scenarios',
                    'Progressive testing reduces costs by avoiding full-scale tests',
                    'It ensures tests are only conducted during business hours'
                ],
                'correct_options' => ['It builds confidence and identifies issues through increasingly complex test scenarios'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - It builds confidence and identifies issues through increasingly complex test scenarios',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.2,
                'irt_b' => -0.5,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 44 - L2 - Understand
            [
                'subtopic' => 'Testing',
                'question' => 'Why is role-specific training important for business continuity effectiveness?',
                'options' => [
                    'Role-specific training reduces overall training costs',
                    'Individuals need targeted knowledge for their specific responsibilities during disruptions',
                    'Generic training is always more effective than specialized training',
                    'Role-specific training is only needed for senior management'
                ],
                'correct_options' => ['Individuals need targeted knowledge for their specific responsibilities during disruptions'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Individuals need targeted knowledge for their specific responsibilities during disruptions',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 2,
                'difficulty_level' => 3,
                'irt_a' => 1.3,
                'irt_b' => -0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 45 - L3 - Apply
            [
                'subtopic' => 'Testing',
                'question' => 'A financial services firm wants to test their trading system disaster recovery without impacting live operations. What testing approach should they use?',
                'options' => [
                    'Shut down production systems during market hours for full testing',
                    'Conduct parallel testing using isolated test environments that mirror production',
                    'Only perform paper-based reviews without any technical testing',
                    'Wait for an actual disaster to validate recovery procedures'
                ],
                'correct_options' => ['Conduct parallel testing using isolated test environments that mirror production'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Conduct parallel testing using isolated test environments that mirror production',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.4,
                'irt_b' => 0.2,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 46 - L3 - Apply
            [
                'subtopic' => 'Testing',
                'question' => 'How should an organization approach business continuity training for remote and distributed workforces?',
                'options' => [
                    'Only provide training to employees in main office locations',
                    'Use virtual training platforms with interactive scenarios and regular practice sessions',
                    'Assume remote workers do not need business continuity training',
                    'Wait until all employees return to physical offices'
                ],
                'correct_options' => ['Use virtual training platforms with interactive scenarios and regular practice sessions'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Use virtual training platforms with interactive scenarios and regular practice sessions',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.5,
                'irt_b' => 0.4,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 47 - L3 - Apply
            [
                'subtopic' => 'Testing',
                'question' => 'What is the most effective approach for maintaining business continuity plan currency in rapidly changing organizations?',
                'options' => [
                    'Update plans only when major disasters occur',
                    'Implement scheduled reviews with trigger-based updates for significant organizational changes',
                    'Completely rewrite plans annually regardless of changes',
                    'Maintain static plans to ensure consistency'
                ],
                'correct_options' => ['Implement scheduled reviews with trigger-based updates for significant organizational changes'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Implement scheduled reviews with trigger-based updates for significant organizational changes',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 3,
                'difficulty_level' => 3,
                'irt_a' => 1.6,
                'irt_b' => 0.6,
                'irt_c' => 0.25,
                'status' => 'published'
            ],
            
            // Item 48 - L4 - Analyze
            [
                'subtopic' => 'Testing',
                'question' => 'Analyze why many organizations struggle to conduct realistic business continuity tests without disrupting operations.',
                'options' => [
                    'Realistic testing always requires complete operational shutdown',
                    'Balance between test realism and business impact requires careful planning and phased approaches',
                    'Operational disruption is never acceptable for business continuity testing',
                    'Realistic testing provides no additional value over theoretical exercises'
                ],
                'correct_options' => ['Balance between test realism and business impact requires careful planning and phased approaches'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Balance between test realism and business impact requires careful planning and phased approaches',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.7,
                'irt_b' => 0.8,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 49 - L4 - Analyze
            [
                'subtopic' => 'Testing',
                'question' => 'What is the fundamental challenge in measuring the effectiveness of business continuity training programs?',
                'options' => [
                    'Training effectiveness cannot be measured quantitatively',
                    'True effectiveness is only demonstrated during actual disruptions, requiring surrogate metrics',
                    'All training programs have identical effectiveness',
                    'Measuring effectiveness is not important for business continuity'
                ],
                'correct_options' => ['True effectiveness is only demonstrated during actual disruptions, requiring surrogate metrics'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - True effectiveness is only demonstrated during actual disruptions, requiring surrogate metrics',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
                'bloom_level' => 4,
                'difficulty_level' => 4,
                'irt_a' => 1.8,
                'irt_b' => 1.0,
                'irt_c' => 0.20,
                'status' => 'published'
            ],
            
            // Item 50 - L5 - Evaluate
            [
                'subtopic' => 'Testing',
                'question' => 'An organization conducts annual business continuity tests that consistently pass with no issues identified. Evaluate the effectiveness of their testing program.',
                'options' => [
                    'Perfect test results indicate an excellent business continuity program',
                    'Lack of findings may indicate insufficient test rigor or unrealistic scenarios',
                    'Annual testing frequency is always sufficient for business continuity validation',
                    'No issues found means testing can be reduced in frequency'
                ],
                'correct_options' => ['Lack of findings may indicate insufficient test rigor or unrealistic scenarios'],
                'justifications' => [
                    'Incorrect - This option is not the best answer',
                    'Correct - Lack of findings may indicate insufficient test rigor or unrealistic scenarios',
                    'Incorrect - This option is not the best answer',
                    'Incorrect - This option is not the best answer'
                ],
                'type_id' => 1,
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