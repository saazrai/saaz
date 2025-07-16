<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D20BusinessContinuityDisasterRecoverySeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Business Continuity & Disaster Recovery');
        })->pluck('id', 'name');
        
        
        $items = [
            // Business Impact Analysis (BIA) - Item 1
            [
                'topic_id' => $topics['Business Impact Analysis (BIA)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of conducting a Business Impact Analysis (BIA)?',
                'options' => [
                    'To determine IT infrastructure costs',
                    'To identify critical business functions and their recovery priorities',
                    'To calculate insurance premiums',
                    'To design network architecture'
                ],
                'correct_options' => ['To identify critical business functions and their recovery priorities'],
                'justifications' => [
                    'Cost analysis is separate from BIA',
                    'Correct - BIA identifies critical functions and establishes recovery priorities',
                    'Insurance is informed by BIA but not its purpose',
                    'Technical design is not BIA\'s focus'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Business Impact Analysis (BIA) - Item 2
            [
                'topic_id' => $topics['Business Impact Analysis (BIA)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which elements should be identified during a BIA? (Select all that apply)',
                'options' => [
                    'Critical business processes',
                    'Maximum tolerable downtime',
                    'Employee vacation schedules',
                    'Resource dependencies',
                    'Coffee machine locations',
                    'Financial impact of outages',
                    'Recovery priorities',
                    'Office decoration preferences'
                ],
                'correct_options' => [
                    'Critical business processes',
                    'Maximum tolerable downtime',
                    'Resource dependencies',
                    'Financial impact of outages',
                    'Recovery priorities'
                ],
                'justifications' => [
                    'Correct - Essential to identify what must be protected',
                    'Correct - Determines how long processes can be down',
                    'Not relevant to business continuity',
                    'Correct - Shows what resources are needed for operations',
                    'Not a business continuity concern',
                    'Correct - Quantifies the cost of downtime',
                    'Correct - Establishes recovery sequence',
                    'Not relevant to BIA'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Business Impact Analysis (BIA) - Item 3
            [
                'topic_id' => $topics['Business Impact Analysis (BIA)'] ?? 1,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each BIA component with its description:',
                'options' => [
                    'items' => [
                        'Critical business function',
                        'Single point of failure',
                        'Upstream dependency',
                        'Downstream dependency'
                    ],
                    'responses' => [
                        'Process essential for organization survival',
                        'Component whose failure causes system outage',
                        'Resource required for function to operate',
                        'Process that depends on the function'
                    ]
                ],
                'correct_options' => [
                    'Critical business function' => 'Process essential for organization survival',
                    'Single point of failure' => 'Component whose failure causes system outage',
                    'Upstream dependency' => 'Resource required for function to operate',
                    'Downstream dependency' => 'Process that depends on the function'
                ],
                'justifications' => [
                    'Critical business function' => 'Functions the business cannot operate without',
                    'Single point of failure' => 'No redundancy means failure impacts everything',
                    'Upstream dependency' => 'Inputs needed for the process to work',
                    'Downstream dependency' => 'Processes affected if this function fails'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Maximum Tolerable Downtime (MTD) - Item 4
            [
                'topic_id' => $topics['Maximum Tolerable Downtime (MTD)'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What does Maximum Tolerable Downtime (MTD) represent?',
                'options' => [
                    'The time to restore data from backups',
                    'The maximum time a business function can be unavailable before causing irreparable harm',
                    'The average system uptime percentage',
                    'The time between system backups'
                ],
                'correct_options' => ['The maximum time a business function can be unavailable before causing irreparable harm'],
                'justifications' => [
                    'This describes recovery time, not tolerance',
                    'Correct - MTD is the absolute maximum downtime before unacceptable consequences',
                    'Uptime percentage is availability, not MTD',
                    'Backup frequency is RPO-related, not MTD'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Maximum Tolerable Downtime (MTD) - Item 5
            [
                'topic_id' => $topics['Maximum Tolerable Downtime (MTD)'] ?? 2,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** The Recovery Time Objective (RTO) should always be equal to the Maximum Tolerable Downtime (MTD).',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'RTO should always be less than MTD to provide a safety margin. MTD is the point of irreparable harm, while RTO is the target recovery time. Setting RTO equal to MTD leaves no room for error or delays in the recovery process.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Recovery Time & Recovery Point Objectives - Item 6
            [
                'topic_id' => $topics['Recovery Time & Recovery Point Objectives (RTO/RPO)'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the difference between RTO and RPO?',
                'options' => [
                    'RTO is for data loss, RPO is for system downtime',
                    'RTO is for system recovery time, RPO is for acceptable data loss',
                    'RTO is for backup frequency, RPO is for recovery speed',
                    'There is no difference; they are interchangeable'
                ],
                'correct_options' => ['RTO is for system recovery time, RPO is for acceptable data loss'],
                'justifications' => [
                    'Backwards - RTO is time, RPO is data',
                    'Correct - RTO measures recovery duration, RPO measures data loss tolerance',
                    'Neither directly defines backup frequency or speed',
                    'They measure different aspects of recovery'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Recovery Time & Recovery Point Objectives - Item 7
            [
                'topic_id' => $topics['Recovery Time & Recovery Point Objectives (RTO/RPO)'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization has an RPO of 4 hours. How frequently should backups be performed at minimum?',
                'options' => [
                    'Every 24 hours',
                    'Every 8 hours',
                    'Every 4 hours or less',
                    'Once per week'
                ],
                'correct_options' => ['Every 4 hours or less'],
                'justifications' => [
                    'Would result in up to 24 hours of data loss',
                    'Could result in 8 hours of data loss, exceeding RPO',
                    'Correct - Backup frequency must match or exceed RPO requirements',
                    'Would far exceed the 4-hour RPO'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Recovery Time & Recovery Point Objectives - Item 8
            [
                'topic_id' => $topics['Recovery Time & Recovery Point Objectives (RTO/RPO)'] ?? 3,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these recovery objectives from most aggressive (shortest) to least aggressive (longest) for a critical financial trading system:',
                'options' => [
                    'RPO: 24 hours, RTO: 48 hours',
                    'RPO: 0 minutes, RTO: 5 minutes',
                    'RPO: 1 hour, RTO: 4 hours',
                    'RPO: 15 minutes, RTO: 1 hour',
                    'RPO: 6 hours, RTO: 12 hours'
                ],
                'correct_options' => [
                    'RPO: 0 minutes, RTO: 5 minutes',
                    'RPO: 15 minutes, RTO: 1 hour',
                    'RPO: 1 hour, RTO: 4 hours',
                    'RPO: 6 hours, RTO: 12 hours',
                    'RPO: 24 hours, RTO: 48 hours'
                ],
                'justifications' => ['For critical trading systems, the most aggressive objectives have near-zero data loss (RPO) and minimal downtime (RTO), becoming progressively more relaxed for less critical systems.'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Business Continuity Plan (BCP) - Item 9
            [
                'topic_id' => $topics['Business Continuity Plan (BCP)'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary focus of a Business Continuity Plan (BCP)?',
                'options' => [
                    'Restoring IT systems after a failure',
                    'Maintaining critical business operations during a disruption',
                    'Backing up data regularly',
                    'Preventing all possible disasters'
                ],
                'correct_options' => ['Maintaining critical business operations during a disruption'],
                'justifications' => [
                    'IT restoration is part of DRP, not the BCP focus',
                    'Correct - BCP ensures business functions continue during disruptions',
                    'Backups are a component but not the primary focus',
                    'Prevention is part of risk management, not BCP'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Business Continuity Plan (BCP) - Item 10
            [
                'topic_id' => $topics['Business Continuity Plan (BCP)'] ?? 4,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the essential components of a comprehensive BCP to the drop zone:',
                'options' => [
                    'Emergency response procedures',
                    'Office party planning',
                    'Crisis communication plan',
                    'Employee birthday list',
                    'Alternate work arrangements',
                    'Vacation schedules',
                    'Key personnel contact list',
                    'Cafeteria menus'
                ],
                'correct_options' => [
                    'Emergency response procedures',
                    'Crisis communication plan',
                    'Alternate work arrangements',
                    'Key personnel contact list'
                ],
                'justifications' => [
                    'Essential for immediate response to incidents',
                    'Not related to business continuity',
                    'Critical for stakeholder communication during crisis',
                    'Not relevant to continuity planning',
                    'Enables work to continue from alternate locations',
                    'HR matter, not continuity planning',
                    'Essential for activating response teams',
                    'Not related to business continuity'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Disaster Recovery Plan (DRP) - Item 11
            [
                'topic_id' => $topics['Disaster Recovery Plan (DRP)'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How does a Disaster Recovery Plan (DRP) differ from a Business Continuity Plan (BCP)?',
                'options' => [
                    'DRP is broader than BCP',
                    'DRP focuses on IT systems recovery, BCP on overall business operations',
                    'They are the same thing',
                    'DRP is for natural disasters only'
                ],
                'correct_options' => ['DRP focuses on IT systems recovery, BCP on overall business operations'],
                'justifications' => [
                    'BCP is broader, encompassing DRP',
                    'Correct - DRP is IT-focused, BCP covers entire business continuity',
                    'They have distinct but complementary purposes',
                    'DRP covers all types of IT disasters'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Disaster Recovery Plan (DRP) - Item 12
            [
                'topic_id' => $topics['Disaster Recovery Plan (DRP)'] ?? 5,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each DRP component with its purpose:',
                'options' => [
                    'items' => [
                        'Recovery procedures',
                        'System inventory',
                        'Communication tree',
                        'Vendor contacts'
                    ],
                    'responses' => [
                        'Step-by-step restoration instructions',
                        'Documentation of critical systems',
                        'Notification hierarchy during disaster',
                        'Emergency support resources'
                    ]
                ],
                'correct_options' => [
                    'Recovery procedures' => 'Step-by-step restoration instructions',
                    'System inventory' => 'Documentation of critical systems',
                    'Communication tree' => 'Notification hierarchy during disaster',
                    'Vendor contacts' => 'Emergency support resources'
                ],
                'justifications' => [
                    'Recovery procedures' => 'Detailed steps ensure consistent recovery',
                    'System inventory' => 'Must know what needs to be recovered',
                    'Communication tree' => 'Ensures proper notification sequence',
                    'Vendor contacts' => 'Quick access to external support'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // BCP/DRP Testing Methods - Item 13
            [
                'topic_id' => $topics['BCP/DRP Testing Methods'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which BCP/DRP testing method has the LEAST impact on normal operations?',
                'options' => [
                    'Full interruption test',
                    'Parallel test',
                    'Tabletop exercise',
                    'Simulation test'
                ],
                'correct_options' => ['Tabletop exercise'],
                'justifications' => [
                    'Highest impact - actually interrupts operations',
                    'Moderate impact - runs recovery systems alongside production',
                    'Correct - Discussion-based with no operational impact',
                    'Some impact from simulating disaster conditions'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // BCP/DRP Testing Methods - Item 14
            [
                'topic_id' => $topics['BCP/DRP Testing Methods'] ?? 6,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these BCP/DRP test types from least to most comprehensive:',
                'options' => [
                    'Full interruption test',
                    'Checklist review',
                    'Simulation test',
                    'Tabletop exercise',
                    'Parallel test'
                ],
                'correct_options' => [
                    'Checklist review',
                    'Tabletop exercise',
                    'Simulation test',
                    'Parallel test',
                    'Full interruption test'
                ],
                'justifications' => ['Testing progression starts with simple document review, then discussion exercises, followed by simulations, parallel operations, and finally full interruption testing.'],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // BCP/DRP Testing Methods - Item 15
            [
                'topic_id' => $topics['BCP/DRP Testing Methods'] ?? 6,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** A successful tabletop exercise proves that the BCP/DRP will work effectively during a real disaster.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Tabletop exercises only test understanding and decision-making processes through discussion. They don\'t test actual technical recovery capabilities, resource availability, or real-world timing. More comprehensive testing like parallel or full interruption tests are needed to validate actual recovery capabilities.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Alternate Sites - Item 16
            [
                'topic_id' => $topics['Alternate Sites'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which type of alternate site can be operational in the shortest time?',
                'options' => [
                    'Cold site',
                    'Warm site',
                    'Hot site',
                    'Mobile site'
                ],
                'correct_options' => ['Hot site'],
                'justifications' => [
                    'Requires significant setup time',
                    'Requires some configuration and data restoration',
                    'Correct - Fully equipped and can be operational within hours',
                    'Deployment time varies based on location'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Alternate Sites - Item 17
            [
                'topic_id' => $topics['Alternate Sites'] ?? 7,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each alternate site type with its characteristics:',
                'options' => [
                    'items' => [
                        'Hot site',
                        'Warm site',
                        'Cold site',
                        'Reciprocal agreement'
                    ],
                    'responses' => [
                        'Fully equipped, data synchronized',
                        'Partially equipped, requires setup',
                        'Basic facility, no equipment',
                        'Mutual backup with another organization'
                    ]
                ],
                'correct_options' => [
                    'Hot site' => 'Fully equipped, data synchronized',
                    'Warm site' => 'Partially equipped, requires setup',
                    'Cold site' => 'Basic facility, no equipment',
                    'Reciprocal agreement' => 'Mutual backup with another organization'
                ],
                'justifications' => [
                    'Hot site' => 'Ready to operate with current data',
                    'Warm site' => 'Has hardware but needs configuration',
                    'Cold site' => 'Just space and basic infrastructure',
                    'Reciprocal agreement' => 'Organizations share facilities'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Alternate Sites - Item 18
            [
                'topic_id' => $topics['Alternate Sites'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary disadvantage of a reciprocal agreement for disaster recovery?',
                'options' => [
                    'High cost',
                    'Long setup time',
                    'Both organizations might be affected by the same disaster',
                    'Requires specialized equipment'
                ],
                'correct_options' => ['Both organizations might be affected by the same disaster'],
                'justifications' => [
                    'Reciprocal agreements are typically low-cost',
                    'Setup time depends on the agreement terms',
                    'Correct - Geographic proximity often means shared disaster exposure',
                    'Uses partner\'s existing equipment'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Backup Strategies - Item 19
            [
                'topic_id' => $topics['Backup Strategies'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What does the "3-2-1 backup rule" recommend?',
                'options' => [
                    '3 backups daily, 2 weekly, 1 monthly',
                    '3 copies of data, 2 different media types, 1 offsite copy',
                    '3 hours between backups, 2 verification checks, 1 restore test',
                    '3 backup operators, 2 supervisors, 1 manager'
                ],
                'correct_options' => ['3 copies of data, 2 different media types, 1 offsite copy'],
                'justifications' => [
                    'Not the 3-2-1 rule definition',
                    'Correct - Standard backup best practice for data protection',
                    'Not related to the 3-2-1 rule',
                    'Not about staffing'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Backup Strategies - Item 20
            [
                'topic_id' => $topics['Backup Strategies'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which backup type requires the LEAST storage space but the LONGEST restore time?',
                'options' => [
                    'Full backup',
                    'Incremental backup',
                    'Differential backup',
                    'Mirror backup'
                ],
                'correct_options' => ['Incremental backup'],
                'justifications' => [
                    'Requires most storage space',
                    'Correct - Only backs up changes since last backup, smallest but requires all increments to restore',
                    'Larger than incremental, faster to restore',
                    'Same size as full backup'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Backup Strategies - Item 21
            [
                'topic_id' => $topics['Backup Strategies'] ?? 8,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'For a comprehensive backup strategy, drag the appropriate backup locations to the drop zone:',
                'options' => [
                    'Local server room',
                    'CEO\'s home',
                    'Cloud storage provider',
                    'Employee cars',
                    'Offsite vault facility',
                    'Desk drawers',
                    'Geographically distant data center',
                    'Office kitchen'
                ],
                'correct_options' => [
                    'Local server room',
                    'Cloud storage provider',
                    'Offsite vault facility',
                    'Geographically distant data center'
                ],
                'justifications' => [
                    'Fast recovery for recent backups',
                    'Not secure or professionally managed',
                    'Provides offsite protection',
                    'Not secure or reliable',
                    'Secure offsite storage',
                    'Not secure',
                    'Protection from regional disasters',
                    'Inappropriate for data storage'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Mixed Topics - Comprehensive Scenarios

            // BIA and Recovery Planning - Item 22
            [
                'topic_id' => $topics['Business Impact Analysis (BIA)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A BIA reveals that the order processing system has an MTD of 24 hours and generates $50,000 revenue per hour. What RTO should be set?',
                'options' => [
                    '24 hours',
                    '48 hours',
                    '12 hours or less',
                    '1 week'
                ],
                'correct_options' => ['12 hours or less'],
                'justifications' => [
                    'Too close to MTD, no safety margin',
                    'Exceeds MTD, unacceptable',
                    'Correct - Provides safety margin while minimizing revenue loss',
                    'Far exceeds MTD'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // RPO and Backup Design - Item 23
            [
                'topic_id' => $topics['Recovery Time & Recovery Point Objectives (RTO/RPO)'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A financial application has an RPO of 15 minutes. Which backup solution is MOST appropriate?',
                'options' => [
                    'Daily tape backups shipped offsite',
                    'Continuous data replication to hot site',
                    'Weekly full backups with daily incrementals',
                    'Monthly backups to cloud storage'
                ],
                'correct_options' => ['Continuous data replication to hot site'],
                'justifications' => [
                    'Daily backups cannot meet 15-minute RPO',
                    'Correct - Near real-time replication meets aggressive RPO',
                    'Cannot achieve 15-minute data loss tolerance',
                    'Far exceeds acceptable data loss'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Testing and Validation - Item 24
            [
                'topic_id' => $topics['BCP/DRP Testing Methods'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'After a major system upgrade, which type of BCP/DRP test should be conducted FIRST?',
                'options' => [
                    'Full interruption test',
                    'Tabletop exercise to review updated procedures',
                    'No testing needed if upgrade was successful',
                    'Wait for annual test cycle'
                ],
                'correct_options' => ['Tabletop exercise to review updated procedures'],
                'justifications' => [
                    'Too risky before validating procedures',
                    'Correct - Low-risk method to validate procedure updates',
                    'System changes require BCP/DRP validation',
                    'Changes require immediate test validation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Site Selection Criteria - Item 25
            [
                'topic_id' => $topics['Alternate Sites'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When selecting an alternate site location, which factors are MOST important? (Select all that apply)',
                'options' => [
                    'Geographic distance from primary site',
                    'Different power grid',
                    'Proximity to employees\' favorite restaurants',
                    'Different natural disaster zone',
                    'Office color scheme',
                    'Network connectivity options',
                    'Accessibility for key personnel',
                    'Local sports teams'
                ],
                'correct_options' => [
                    'Geographic distance from primary site',
                    'Different power grid',
                    'Different natural disaster zone',
                    'Network connectivity options',
                    'Accessibility for key personnel'
                ],
                'justifications' => [
                    'Correct - Prevents same disaster affecting both sites',
                    'Correct - Avoids shared infrastructure failures',
                    'Not relevant to disaster recovery',
                    'Correct - Reduces shared risk exposure',
                    'Not a business continuity factor',
                    'Correct - Essential for operations',
                    'Correct - Staff must be able to reach site',
                    'Not relevant to site selection'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Cost-Benefit Analysis - Item 26
            [
                'topic_id' => $topics['Business Continuity Plan (BCP)'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A company estimates disaster recovery costs at $500,000 annually for a hot site protecting systems that could cause $2 million in losses per day if down. Is this justified?',
                'options' => [
                    'No, the annual cost is too high',
                    'Yes, one day of downtime costs more than 4 years of protection',
                    'Cannot determine without more information',
                    'Only if disasters are guaranteed to occur'
                ],
                'correct_options' => ['Yes, one day of downtime costs more than 4 years of protection'],
                'justifications' => [
                    'Cost must be weighed against potential losses',
                    'Correct - Clear cost-benefit justification given the loss exposure',
                    'Sufficient information provided for basic analysis',
                    'Insurance principle - protection against possibility, not certainty'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Plan Maintenance - Item 27
            [
                'topic_id' => $topics['Business Continuity Plan (BCP)'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Once thoroughly tested, BCP/DRP plans only need to be reviewed annually.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'BCP/DRP plans must be updated whenever significant changes occur, including new systems, personnel changes, vendor changes, or lessons learned from incidents. Waiting for annual reviews risks plans becoming outdated and ineffective. Many changes require immediate plan updates.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Backup Restoration Priority - Item 28
            [
                'topic_id' => $topics['Backup Strategies'] ?? 8,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'After a disaster, arrange these systems in the typical restoration priority order:',
                'options' => [
                    'Email system',
                    'Network infrastructure',
                    'Development servers',
                    'Authentication/Directory services',
                    'Customer-facing applications'
                ],
                'correct_options' => [
                    'Network infrastructure',
                    'Authentication/Directory services',
                    'Customer-facing applications',
                    'Email system',
                    'Development servers'
                ],
                'justifications' => ['Recovery follows dependencies: network enables all services, authentication enables access, customer applications generate revenue, email supports communication, and development has lowest business priority.'],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Pandemic Planning - Item 29
            [
                'topic_id' => $topics['Business Continuity Plan (BCP)'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How does pandemic planning differ from traditional disaster recovery planning?',
                'options' => [
                    'Facilities remain available but staff cannot access them',
                    'IT systems are typically unaffected',
                    'Extended duration requires different strategies',
                    'All of the above'
                ],
                'correct_options' => ['All of the above'],
                'justifications' => [
                    'Partial - this is one difference',
                    'Partial - systems work but may lack operators',
                    'Partial - pandemics last months/years vs days/weeks',
                    'Correct - Pandemics present unique challenges requiring special planning'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Supply Chain Continuity - Item 30
            [
                'topic_id' => $topics['Business Impact Analysis (BIA)'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'During BIA, which supply chain factors should be assessed? Drag relevant items to the drop zone:',
                'options' => [
                    'Critical supplier dependencies',
                    'Supplier employee satisfaction',
                    'Alternate supplier options',
                    'Supplier office decor',
                    'Supplier financial stability',
                    'Supplier CEO salary',
                    'Geographic concentration of suppliers',
                    'Supplier company car models'
                ],
                'correct_options' => [
                    'Critical supplier dependencies',
                    'Alternate supplier options',
                    'Supplier financial stability',
                    'Geographic concentration of suppliers'
                ],
                'justifications' => [
                    'Identifies single points of failure',
                    'Internal supplier matter',
                    'Essential for continuity planning',
                    'Not relevant to continuity',
                    'Supplier failure impacts operations',
                    'Not relevant to supply chain risk',
                    'Concentration increases disaster risk',
                    'Not relevant to business continuity'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Recovery Time Calculation - Item 31
            [
                'topic_id' => $topics['Recovery Time & Recovery Point Objectives (RTO/RPO)'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'If a system has an RTO of 4 hours and it takes 1 hour to detect failure, what is the maximum time available for actual recovery?',
                'options' => [
                    '4 hours',
                    '3 hours',
                    '5 hours',
                    '1 hour'
                ],
                'correct_options' => ['3 hours'],
                'justifications' => [
                    'RTO includes detection time',
                    'Correct - RTO (4hrs) minus detection time (1hr) = 3 hours for recovery',
                    'Cannot exceed RTO',
                    'Incorrect calculation'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Crisis Communication - Item 32
            [
                'topic_id' => $topics['Business Continuity Plan (BCP)'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During a business continuity event, who should be the primary spokesperson for external communications?',
                'options' => [
                    'The IT manager who understands the technical details',
                    'Any available employee',
                    'A designated trained spokesperson',
                    'Multiple people to ensure coverage'
                ],
                'correct_options' => ['A designated trained spokesperson'],
                'justifications' => [
                    'Technical knowledge doesn\'t equal communication skills',
                    'Untrained staff may communicate incorrectly',
                    'Correct - Trained spokesperson ensures consistent, appropriate messaging',
                    'Multiple voices create confusion and inconsistency'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Test Documentation - Item 33
            [
                'topic_id' => $topics['BCP/DRP Testing Methods'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should be documented after every BCP/DRP test? (Select all that apply)',
                'options' => [
                    'Test objectives and scope',
                    'Participants\' lunch preferences',
                    'Issues and failures discovered',
                    'Weather during the test',
                    'Actual vs expected recovery times',
                    'Participants\' horoscopes',
                    'Recommendations for improvement',
                    'Lessons learned'
                ],
                'correct_options' => [
                    'Test objectives and scope',
                    'Issues and failures discovered',
                    'Actual vs expected recovery times',
                    'Recommendations for improvement',
                    'Lessons learned'
                ],
                'justifications' => [
                    'Correct - Documents what was tested',
                    'Not relevant to test outcomes',
                    'Correct - Critical for improvement',
                    'Generally not relevant unless weather-related test',
                    'Correct - Validates RTO achievement',
                    'Not relevant',
                    'Correct - Drives plan improvements',
                    'Correct - Captures knowledge for future'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Hot Site Considerations - Item 34
            [
                'topic_id' => $topics['Alternate Sites'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is a major drawback of maintaining a hot site?',
                'options' => [
                    'Cannot be activated quickly',
                    'High ongoing cost',
                    'Requires extensive setup time',
                    'Limited to small organizations'
                ],
                'correct_options' => ['High ongoing cost'],
                'justifications' => [
                    'Hot sites activate quickly by design',
                    'Correct - Duplicate infrastructure and maintenance is expensive',
                    'Hot sites require minimal setup',
                    'Available to any organization that can afford it'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Backup Verification - Item 35
            [
                'topic_id' => $topics['Backup Strategies'] ?? 8,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** If backups complete without errors, restoration testing is unnecessary.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Successful backup completion does not guarantee successful restoration. Backups can be corrupted, incomplete, or incompatible despite showing success. Regular restoration testing is essential to verify backups are actually usable when needed. The only valid backup is one that has been successfully restored.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Integrated BCM Program - Item 36
            [
                'topic_id' => $topics['Business Continuity Plan (BCP)'] ?? 4,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each Business Continuity Management (BCM) lifecycle phase with its primary activity:',
                'options' => [
                    'items' => [
                        'Analysis',
                        'Design',
                        'Implementation',
                        'Validation'
                    ],
                    'responses' => [
                        'Conduct BIA and risk assessment',
                        'Develop strategies and plans',
                        'Deploy solutions and train staff',
                        'Test and exercise plans'
                    ]
                ],
                'correct_options' => [
                    'Analysis' => 'Conduct BIA and risk assessment',
                    'Design' => 'Develop strategies and plans',
                    'Implementation' => 'Deploy solutions and train staff',
                    'Validation' => 'Test and exercise plans'
                ],
                'justifications' => [
                    'Analysis' => 'Understanding requirements through analysis',
                    'Design' => 'Creating solutions based on analysis',
                    'Implementation' => 'Putting plans into action',
                    'Validation' => 'Ensuring plans work as designed'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Recovery Strategy Selection - Item 37
            [
                'topic_id' => $topics['Recovery Time & Recovery Point Objectives (RTO/RPO)'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A system has RTO of 2 hours and RPO of 1 hour. Which recovery strategy is MOST appropriate?',
                'options' => [
                    'Cold site with daily tape backups',
                    'Warm site with 4-hour replication',
                    'Hot site with hourly replication',
                    'Manual procedures with weekly backups'
                ],
                'correct_options' => ['Hot site with hourly replication'],
                'justifications' => [
                    'Cannot meet 2-hour RTO',
                    'Replication interval exceeds RPO',
                    'Correct - Meets both RTO (quick activation) and RPO (hourly data)',
                    'Fails both RTO and RPO requirements'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Plan Activation - Item 38
            [
                'topic_id' => $topics['Disaster Recovery Plan (DRP)'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Who should have the authority to activate the disaster recovery plan?',
                'options' => [
                    'Only the CEO',
                    'Any IT staff member who detects a problem',
                    'Designated personnel with clear activation criteria',
                    'External consultants'
                ],
                'correct_options' => ['Designated personnel with clear activation criteria'],
                'justifications' => [
                    'CEO may not be available or have technical knowledge',
                    'Too broad, could lead to unnecessary activations',
                    'Correct - Authorized personnel with defined thresholds ensure appropriate activation',
                    'Should be internal decision-makers'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Backup Rotation Schemes - Item 39
            [
                'topic_id' => $topics['Backup Strategies'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary advantage of the Grandfather-Father-Son (GFS) backup rotation scheme?',
                'options' => [
                    'Uses minimal storage space',
                    'Provides multiple restore points over extended time',
                    'Requires only one backup set',
                    'Eliminates need for offsite storage'
                ],
                'correct_options' => ['Provides multiple restore points over extended time'],
                'justifications' => [
                    'GFS uses more media than simpler schemes',
                    'Correct - Daily, weekly, and monthly backups provide varied restore points',
                    'GFS requires multiple backup sets',
                    'Offsite storage still recommended for GFS'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Comprehensive BCM Scenario - Item 40
            [
                'topic_id' => $topics['Business Impact Analysis (BIA)'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'A financial services firm is updating its BCM program. Drag the tasks that should be completed FIRST to the drop zone:',
                'options' => [
                    'Purchase hot site facility',
                    'Conduct fresh BIA',
                    'Install new backup software',
                    'Update risk assessment',
                    'Design logo for BC team shirts',
                    'Review regulatory requirements',
                    'Train all staff on evacuation',
                    'Define critical business functions'
                ],
                'correct_options' => [
                    'Conduct fresh BIA',
                    'Update risk assessment',
                    'Review regulatory requirements',
                    'Define critical business functions'
                ],
                'justifications' => [
                    'Strategy decisions come after analysis',
                    'Essential to understand current state',
                    'Technical solutions follow requirements analysis',
                    'Identifies current threat landscape',
                    'Not a BCM priority',
                    'Compliance requirements drive BCM needs',
                    'Training comes after plan development',
                    'Foundation for all BCM planning'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Cloud and BCM - Item 41
            [
                'topic_id' => $topics['Disaster Recovery Plan (DRP)'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How does cloud computing impact traditional disaster recovery planning?',
                'options' => [
                    'Eliminates need for DR planning',
                    'Enables faster RTO and more granular RPO options',
                    'Makes DR more complex and expensive',
                    'Has no impact on DR planning'
                ],
                'correct_options' => ['Enables faster RTO and more granular RPO options'],
                'justifications' => [
                    'Cloud failures still require DR planning',
                    'Correct - Cloud provides flexible, scalable DR options with better metrics',
                    'Often simplifies and reduces DR costs',
                    'Significantly changes DR strategies and options'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Continuous Improvement - Item 42
            [
                'topic_id' => $topics['BCP/DRP Testing Methods'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'After multiple test failures, what should be the primary response?',
                'options' => [
                    'Fire the BC coordinator',
                    'Reduce test frequency to avoid failures',
                    'Analyze root causes and update plans',
                    'Lower recovery objectives to achievable levels'
                ],
                'correct_options' => ['Analyze root causes and update plans'],
                'justifications' => [
                    'Blame doesn\'t improve preparedness',
                    'Testing identifies problems; avoiding tests doesn\'t fix them',
                    'Correct - Failures provide learning opportunities for improvement',
                    'Should improve capabilities, not lower standards'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Vendor Dependency - Item 43
            [
                'topic_id' => $topics['Maximum Tolerable Downtime (MTD)'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A critical vendor has an SLA guaranteeing 8-hour response time, but your MTD is 4 hours. What is the BEST solution?',
                'options' => [
                    'Accept the risk',
                    'Negotiate better SLA or find alternate vendor',
                    'Extend MTD to match vendor SLA',
                    'Hope the vendor responds faster'
                ],
                'correct_options' => ['Negotiate better SLA or find alternate vendor'],
                'justifications' => [
                    'Unacceptable risk to business operations',
                    'Correct - Vendor capabilities must support business requirements',
                    'Business needs should drive requirements, not vendor limitations',
                    'Hope is not a strategy'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Lessons Learned Integration - Item 44
            [
                'topic_id' => $topics['Business Continuity Plan (BCP)'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Lessons learned from actual incidents are more valuable than test results for improving BC plans.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Both actual incidents and tests provide valuable insights. Tests allow for controlled learning without business impact, while real incidents show true capabilities under stress. A comprehensive BCM program values and incorporates lessons from both sources equally, as they provide different perspectives on plan effectiveness.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Final Comprehensive Question - Item 45
            [
                'topic_id' => $topics['Business Continuity Plan (BCP)'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the MOST important success factor for business continuity management?',
                'options' => [
                    'Latest technology and tools',
                    'Detailed documentation',
                    'Executive support and organizational commitment',
                    'External consultant expertise'
                ],
                'correct_options' => ['Executive support and organizational commitment'],
                'justifications' => [
                    'Tools support but don\'t ensure success',
                    'Documentation is important but not sufficient',
                    'Correct - BCM requires resources, culture, and ongoing commitment from leadership',
                    'Consultants help but internal commitment is crucial'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // New Item 46 - RTO/RPO Application
            [
                'topic_id' => $topics['Recovery Time & Recovery Point Objectives (RTO/RPO)'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A company\'s email system has an RTO of 8 hours and RPO of 2 hours. A failure occurs at 9 AM Monday. When must email service be restored to meet the RTO?',
                'options' => [
                    '11 AM Monday',
                    '5 PM Monday',
                    '9 AM Tuesday',
                    '5 PM Tuesday'
                ],
                'correct_options' => ['5 PM Monday'],
                'justifications' => [
                    'This represents RPO timeframe, not RTO',
                    'Correct - 9 AM + 8 hours = 5 PM Monday',
                    'Exceeds the 8-hour RTO requirement',
                    'Far exceeds the RTO requirement'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // New Item 47 - DRP Technical Analysis
            [
                'topic_id' => $topics['Disaster Recovery Plan (DRP)'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During a DRP activation, the network recovery team reports successful connection establishment, but applications fail to start. What should be the next troubleshooting step?',
                'options' => [
                    'Restart the network equipment',
                    'Check database server dependencies',
                    'Contact all users to report the issue',
                    'Immediately switch to manual processes'
                ],
                'correct_options' => ['Check database server dependencies'],
                'justifications' => [
                    'Network is already working according to the team',
                    'Correct - Applications often depend on databases; check infrastructure dependencies first',
                    'User communication comes after technical resolution',
                    'Premature without troubleshooting the technical issue'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // New Item 48 - BIA Risk Analysis
            [
                'topic_id' => $topics['Business Impact Analysis (BIA)'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During a BIA, you discover that the customer service system depends on three external vendors, each with different SLAs. How should this complexity be addressed?',
                'options' => [
                    'Choose the vendor with the best SLA and remove others',
                    'Document all dependencies and their recovery implications',
                    'Ignore vendor dependencies as external factors',
                    'Assume all vendors will fail simultaneously'
                ],
                'correct_options' => ['Document all dependencies and their recovery implications'],
                'justifications' => [
                    'Removing vendors may not be operationally feasible',
                    'Correct - BIA must capture all dependencies to understand true recovery complexity',
                    'External dependencies critically impact recovery planning',
                    'Overly pessimistic and not analytically useful'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // New Item 49 - Test Scenario Application
            [
                'topic_id' => $topics['BCP/DRP Testing Methods'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your organization wants to test recovery procedures without impacting production systems or revealing the test to staff. Which testing approach is MOST appropriate?',
                'options' => [
                    'Full interruption test during business hours',
                    'Simulation test with surprise announcement',
                    'Parallel test with production workload',
                    'Unannounced tabletop exercise'
                ],
                'correct_options' => ['Simulation test with surprise announcement'],
                'justifications' => [
                    'Would impact production systems',
                    'Correct - Simulates conditions without production impact while testing staff response',
                    'Would impact production systems with workload',
                    'Tabletop exercises are discussion-based, not true procedure testing'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // New Item 50 - Backup Strategy Analysis
            [
                'topic_id' => $topics['Backup Strategies'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An organization discovers their incremental backup chain is corrupted, affecting the last 14 days of backups. Their last full backup was 15 days ago. What is the maximum data loss exposure?',
                'options' => [
                    '1 day',
                    '14 days',
                    '15 days',
                    'Total data loss'
                ],
                'correct_options' => ['15 days'],
                'justifications' => [
                    'Understates the loss - can only restore to full backup',
                    'Doesn\'t account for the gap between full backup and chain start',
                    'Correct - Can only restore to the 15-day-old full backup',
                    'Overstates - data from 15 days ago is still recoverable'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 20 (Business Continuity & Disaster Recovery) diagnostic items seeded successfully!');
    }
}