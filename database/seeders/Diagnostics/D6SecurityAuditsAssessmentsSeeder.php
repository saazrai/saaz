<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D6SecurityAuditsAssessmentsSeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Security Audits & Assessments');
        })->pluck('id', 'name');
        
        
        $items = [
            // Audit Life-Cycle Phases - Item 1
            [
                'topic_id' => $topics['Audit Life-Cycle Phases'] ?? 111,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the correct order of audit lifecycle phases?',
                'options' => [
                    'Fieldwork → Planning → Reporting → Follow-up',
                    'Planning → Fieldwork → Reporting → Follow-up',
                    'Reporting → Planning → Fieldwork → Follow-up',
                    'Planning → Reporting → Fieldwork → Follow-up'
                ],
                'correct_options' => ['Planning → Fieldwork → Reporting → Follow-up'],
                'justifications' => [
                    'Cannot conduct fieldwork without planning',
                    'Correct - Planning establishes scope, fieldwork gathers evidence, reporting communicates findings, follow-up ensures remediation',
                    'Cannot report before conducting the audit',
                    'Fieldwork must precede reporting'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Security Audits Types - Item 2
            [
                'topic_id' => $topics['Security Audits (Internal, External)'] ?? 112,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary advantage of external security audits over internal audits?',
                'options' => [
                    'Lower cost',
                    'Greater independence and objectivity',
                    'Deeper knowledge of systems',
                    'Faster completion time'
                ],
                'correct_options' => ['Greater independence and objectivity'],
                'justifications' => [
                    'External audits typically cost more',
                    'Correct - External auditors provide unbiased perspective without internal pressures',
                    'Internal auditors know systems better',
                    'External audits often take longer due to learning curve'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Compliance vs Substantive Testing - Item 3
            [
                'topic_id' => $topics['Compliance vs Substantive Testing'] ?? 113,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each testing approach with its focus:',
                'options' => [
                    'items' => [
                        'Verifying controls are in place and operating',
                        'Detailed examination of transactions and balances',
                        'Testing control design effectiveness',
                        'Analyzing actual data for errors or fraud'
                    ],
                    'targets' => [
                        'Compliance Testing',
                        'Substantive Testing'
                    ]
                ],
                'correct_options' => [
                    'Verifying controls are in place and operating' => 'Compliance Testing',
                    'Detailed examination of transactions and balances' => 'Substantive Testing',
                    'Testing control design effectiveness' => 'Compliance Testing',
                    'Analyzing actual data for errors or fraud' => 'Substantive Testing'
                ],
                'justifications' => [
                    'Verifying controls are in place and operating' => 'Compliance testing focuses on control existence',
                    'Detailed examination of transactions and balances' => 'Substantive testing examines actual data',
                    'Testing control design effectiveness' => 'Control testing is compliance focused',
                    'Analyzing actual data for errors or fraud' => 'Direct data testing is substantive'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Evidence-Gathering Techniques - Item 4
            [
                'topic_id' => $topics['Evidence-Gathering Techniques'] ?? 114,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Select valid evidence-gathering techniques for security audits:',
                'options' => [
                    'Document review',
                    'Guessing outcomes',
                    'System observation',
                    'Making assumptions',
                    'Re-performance of controls',
                    'Ignoring anomalies'
                ],
                'correct_options' => ['Document review', 'System observation', 'Re-performance of controls'],
                'justifications' => [
                    'Documents provide evidence of policies and procedures',
                    'Guessing is not evidence-based',
                    'Direct observation validates actual practices',
                    'Assumptions lack evidentiary value',
                    'Re-performance confirms control effectiveness',
                    'Anomalies must be investigated, not ignored'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Sampling Methods - Item 5
            [
                'topic_id' => $topics['Sampling Methods & Sampling Risk'] ?? 115,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which sampling method is most appropriate when looking for fraud or rare control failures?',
                'options' => [
                    'Random sampling',
                    'Attribute sampling',
                    'Discovery sampling',
                    'Systematic sampling'
                ],
                'correct_options' => ['Discovery sampling'],
                'justifications' => [
                    'Random may miss rare events',
                    'Attribute tests compliance rates',
                    'Correct - Discovery sampling is designed to find at least one instance of rare events',
                    'Systematic uses intervals, may miss patterns'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Gap Analysis - Item 6
            [
                'topic_id' => $topics['Gap Analysis'] ?? 116,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'In a security gap analysis, what are you comparing?',
                'options' => [
                    'Last year\'s budget vs this year\'s budget',
                    'Current state vs desired/required state',
                    'Employee satisfaction scores',
                    'Competitor security practices'
                ],
                'correct_options' => ['Current state vs desired/required state'],
                'justifications' => [
                    'Budget comparison is financial analysis',
                    'Correct - Gap analysis identifies differences between where you are and where you need to be',
                    'Employee satisfaction is HR metrics',
                    'Competitive analysis is market research'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Control Testing - Item 7
            [
                'topic_id' => $topics['Control Design & Operating-Effectiveness Testing'] ?? 117,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** A well-designed control that is not operating effectively can still provide adequate security.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Both design effectiveness AND operating effectiveness are required. A perfectly designed control provides no value if it\'s not functioning properly in practice.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Continuous Control Monitoring - Item 8
            [
                'topic_id' => $topics['Continuous Control Monitoring (CCM)'] ?? 118,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary benefit of Continuous Control Monitoring (CCM) over periodic audits?',
                'options' => [
                    'Lower implementation cost',
                    'Real-time detection of control failures',
                    'Less technical expertise required',
                    'Eliminates need for auditors'
                ],
                'correct_options' => ['Real-time detection of control failures'],
                'justifications' => [
                    'CCM typically requires significant initial investment',
                    'Correct - CCM provides ongoing assurance rather than point-in-time',
                    'CCM requires more technical expertise',
                    'CCM supplements but doesn\'t replace audit functions'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Vulnerability Assessment - Item 9
            [
                'topic_id' => $topics['Vulnerability Assessment & Management'] ?? 119,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How does vulnerability assessment differ from penetration testing?',
                'options' => [
                    'They are the same thing',
                    'VA identifies weaknesses; PT exploits them',
                    'PT identifies weaknesses; VA exploits them',
                    'VA is more invasive than PT'
                ],
                'correct_options' => ['VA identifies weaknesses; PT exploits them'],
                'justifications' => [
                    'Clear differences exist between them',
                    'Correct - VA scans and reports vulnerabilities; PT attempts to exploit them',
                    'This reverses their actual roles',
                    'PT is more invasive as it attempts exploitation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Penetration Testing Types - Item 10
            [
                'topic_id' => $topics['Penetration Testing & Red/Purple Teaming'] ?? 120,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'In a "black box" penetration test, what information does the tester have?',
                'options' => [
                    'Full system documentation and credentials',
                    'Partial system information',
                    'Only publicly available information',
                    'Source code access'
                ],
                'correct_options' => ['Only publicly available information'],
                'justifications' => [
                    'This describes white box testing',
                    'This describes gray box testing',
                    'Correct - Black box simulates external attacker with no inside knowledge',
                    'Source code access is white box testing'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Red vs Purple Teams - Item 11
            [
                'topic_id' => $topics['Penetration Testing & Red/Purple Teaming'] ?? 120,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What distinguishes purple team exercises from red team exercises?',
                'options' => [
                    'Purple teams are more aggressive',
                    'Purple teams collaborate with defenders',
                    'Purple teams only test physical security',
                    'Purple teams work independently'
                ],
                'correct_options' => ['Purple teams collaborate with defenders'],
                'justifications' => [
                    'Purple emphasizes collaboration, not aggression',
                    'Correct - Purple teams combine red team (attackers) with blue team (defenders) for knowledge transfer',
                    'Purple teams test all security aspects',
                    'Collaboration is the key purple team characteristic'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // SOC Reports - Item 12
            [
                'topic_id' => $topics['Service Organization Control (SOC) Reports'] ?? 121,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each SOC report type with its primary purpose:',
                'options' => [
                    'items' => [
                        'Financial reporting controls',
                        'Security, availability, and privacy',
                        'Public-facing trust report',
                        'Customized criteria'
                    ],
                    'targets' => [
                        'SOC 1',
                        'SOC 2',
                        'SOC 3',
                        'SOC 2+'
                    ]
                ],
                'correct_options' => [
                    'Financial reporting controls' => 'SOC 1',
                    'Security, availability, and privacy' => 'SOC 2',
                    'Public-facing trust report' => 'SOC 3',
                    'Customized criteria' => 'SOC 2+'
                ],
                'justifications' => [
                    'Financial reporting controls' => 'SOC 1 focuses on controls affecting financial statements',
                    'Security, availability, and privacy' => 'SOC 2 covers Trust Service Criteria',
                    'Public-facing trust report' => 'SOC 3 is a seal for public confidence',
                    'Customized criteria' => 'SOC 2+ adds client-specific requirements'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // ISO 27001 Audit - Item 13
            [
                'topic_id' => $topics['ISO 27001 Certification Audits'] ?? 122,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What type of audit must be passed to achieve ISO 27001 certification?',
                'options' => [
                    'Internal audit only',
                    'Stage 1 and Stage 2 certification audits',
                    'Self-assessment',
                    'Vendor audit'
                ],
                'correct_options' => ['Stage 1 and Stage 2 certification audits'],
                'justifications' => [
                    'Internal audits support but don\'t grant certification',
                    'Correct - Stage 1 reviews documentation, Stage 2 verifies implementation',
                    'Self-assessment isn\'t sufficient for certification',
                    'Vendor audits are different from certification audits'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Audit Planning - Item 14
            [
                'topic_id' => $topics['Audit Life-Cycle Phases'] ?? 111,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Select essential elements of an audit plan:',
                'options' => [
                    'Audit objectives and scope',
                    'Auditor vacation schedules',
                    'Risk assessment results',
                    'Office seating arrangements',
                    'Resource requirements',
                    'Lunch menu options'
                ],
                'correct_options' => ['Audit objectives and scope', 'Risk assessment results', 'Resource requirements'],
                'justifications' => [
                    'Objectives and scope define audit boundaries',
                    'Personal schedules aren\'t audit plan elements',
                    'Risk assessment guides audit focus',
                    'Office logistics aren\'t audit planning',
                    'Resources needed for audit execution',
                    'Meal planning isn\'t audit planning'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Audit Evidence Quality - Item 15
            [
                'topic_id' => $topics['Evidence-Gathering Techniques'] ?? 114,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which type of audit evidence is generally considered most reliable?',
                'options' => [
                    'Verbal confirmations from management',
                    'Auditor\'s direct observation',
                    'Copies of documents',
                    'Management representations'
                ],
                'correct_options' => ['Auditor\'s direct observation'],
                'justifications' => [
                    'Verbal evidence is least reliable',
                    'Correct - Direct observation by auditor is independent and verifiable',
                    'Copies may be altered; originals preferred',
                    'Management assertions require corroboration'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Computer-Assisted Audit Techniques - Item 16
            [
                'topic_id' => $topics['Evidence-Gathering Techniques'] ?? 114,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is a key advantage of using Computer-Assisted Audit Techniques (CAATs)?',
                'options' => [
                    'Eliminates need for audit judgment',
                    'Ability to test 100% of transactions',
                    'Reduces audit documentation requirements',
                    'Removes need for control testing'
                ],
                'correct_options' => ['Ability to test 100% of transactions'],
                'justifications' => [
                    'Professional judgment still required',
                    'Correct - CAATs enable complete population testing vs sampling',
                    'Documentation requirements remain the same',
                    'Control testing still necessary'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Stop-or-Go Sampling - Item 17
            [
                'topic_id' => $topics['Sampling Methods & Sampling Risk'] ?? 115,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When would stop-or-go sampling be most appropriate?',
                'options' => [
                    'When expecting high error rates',
                    'When expecting low error rates',
                    'For substantive testing only',
                    'For financial audits only'
                ],
                'correct_options' => ['When expecting low error rates'],
                'justifications' => [
                    'Would require large samples with high errors',
                    'Correct - Efficient when errors are rare; can stop early if none found',
                    'Can be used for compliance testing too',
                    'Applicable to various audit types'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Risk-Based Auditing - Item 18
            [
                'topic_id' => $topics['Audit Life-Cycle Phases'] ?? 111,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'In risk-based auditing, audit resources are primarily allocated to:',
                'options' => [
                    'Areas with the most employees',
                    'Newest systems and processes',
                    'Areas with highest risk',
                    'Departments requesting audits'
                ],
                'correct_options' => ['Areas with highest risk'],
                'justifications' => [
                    'Employee count doesn\'t indicate risk',
                    'New systems may be lower risk',
                    'Correct - Risk-based approach focuses efforts where impact is greatest',
                    'Requests don\'t determine risk levels'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Audit Findings - Item 19
            [
                'topic_id' => $topics['Audit Life-Cycle Phases'] ?? 111,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Select the essential components of a well-written audit finding:',
                'options' => [
                    'Condition (what is)',
                    'Auditor opinions',
                    'Criteria (what should be)',
                    'Personal preferences',
                    'Effect (impact)',
                    'Blame assignment'
                ],
                'correct_options' => ['Condition (what is)', 'Criteria (what should be)', 'Effect (impact)'],
                'justifications' => [
                    'Describes current state',
                    'Findings should be factual, not opinion-based',
                    'Standard or requirement being measured against',
                    'Professional standards, not preferences',
                    'Business impact of the gap',
                    'Focus on issues, not blame'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Audit Independence - Item 20
            [
                'topic_id' => $topics['Security Audits (Internal, External)'] ?? 112,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which situation would most compromise internal audit independence?',
                'options' => [
                    'Reporting to the audit committee',
                    'Auditing areas previously managed by the auditor',
                    'Having professional certifications',
                    'Following audit standards'
                ],
                'correct_options' => ['Auditing areas previously managed by the auditor'],
                'justifications' => [
                    'Audit committee reporting enhances independence',
                    'Correct - Self-review threat compromises objectivity',
                    'Certifications enhance professionalism',
                    'Standards support independence'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Vulnerability Scanning Frequency - Item 21
            [
                'topic_id' => $topics['Vulnerability Assessment & Management'] ?? 119,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'How often should critical systems undergo vulnerability scanning?',
                'options' => [
                    'Annually',
                    'When convenient',
                    'Monthly or more frequently',
                    'Only after incidents'
                ],
                'correct_options' => ['Monthly or more frequently'],
                'justifications' => [
                    'Annual scanning misses too many vulnerabilities',
                    'Security requires regular scheduling',
                    'Correct - Critical systems need frequent scanning to catch new vulnerabilities',
                    'Reactive approach is insufficient'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // False Positive Management - Item 22
            [
                'topic_id' => $topics['Vulnerability Assessment & Management'] ?? 119,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'A vulnerability scanner reports 1000 high-risk findings, but investigation shows 950 are false positives. What should be done?',
                'options' => [
                    'Ignore all future scanner results',
                    'Tune the scanner to reduce false positives',
                    'Only investigate critical findings',
                    'Switch to manual testing only'
                ],
                'correct_options' => ['Tune the scanner to reduce false positives'],
                'justifications' => [
                    'Scanner still has value if properly configured',
                    'Correct - Scanner tuning improves accuracy and reduces wasted effort',
                    'Could miss real vulnerabilities',
                    'Manual testing alone isn\'t scalable'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Penetration Test Scope - Item 23
            [
                'topic_id' => $topics['Penetration Testing & Red/Purple Teaming'] ?? 120,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which element is MOST critical to define in a penetration testing scope?',
                'options' => [
                    'Tester dress code',
                    'Systems explicitly out of scope',
                    'Coffee break schedule',
                    'Report font size'
                ],
                'correct_options' => ['Systems explicitly out of scope'],
                'justifications' => [
                    'Irrelevant to test execution',
                    'Correct - Clear boundaries prevent testing critical systems that could cause outages',
                    'Not a scope consideration',
                    'Formatting is secondary to content'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Social Engineering Testing - Item 24
            [
                'topic_id' => $topics['Penetration Testing & Red/Purple Teaming'] ?? 120,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Penetration tests should always include social engineering attacks to be comprehensive.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Social engineering tests require explicit authorization and careful planning due to potential impact on employees. They should only be included when specifically scoped and approved by management.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // SOC 2 Trust Services Criteria - Item 25
            [
                'topic_id' => $topics['Service Organization Control (SOC) Reports'] ?? 121,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Select the Trust Services Criteria categories for SOC 2 reports:',
                'options' => [
                    'Security',
                    'Profitability',
                    'Availability',
                    'Market share',
                    'Confidentiality',
                    'Employee satisfaction'
                ],
                'correct_options' => ['Security', 'Availability', 'Confidentiality'],
                'justifications' => [
                    'Security is a core TSC criterion',
                    'Financial performance isn\'t a TSC',
                    'Availability is a TSC criterion',
                    'Market position isn\'t evaluated',
                    'Confidentiality is a TSC criterion',
                    'HR metrics aren\'t in scope'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Type I vs Type II Reports - Item 26
            [
                'topic_id' => $topics['Service Organization Control (SOC) Reports'] ?? 121,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the key difference between SOC 2 Type I and Type II reports?',
                'options' => [
                    'Type I is more expensive',
                    'Type II tests operating effectiveness over time',
                    'Type I covers more criteria',
                    'Type II is for public distribution'
                ],
                'correct_options' => ['Type II tests operating effectiveness over time'],
                'justifications' => [
                    'Type II typically costs more due to extended testing',
                    'Correct - Type I is point-in-time; Type II covers a period (usually 6-12 months)',
                    'Both can cover same criteria',
                    'Neither SOC 2 type is for public distribution'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // ISO 27001 Requirements - Item 27
            [
                'topic_id' => $topics['ISO 27001 Certification Audits'] ?? 122,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which of the following is mandatory for ISO 27001 certification?',
                'options' => [
                    'Implementing all 114 controls',
                    'Statement of Applicability (SoA)',
                    'Zero security incidents',
                    'Specific security technologies'
                ],
                'correct_options' => ['Statement of Applicability (SoA)'],
                'justifications' => [
                    'Can exclude non-applicable controls with justification',
                    'Correct - SoA documents which controls apply and why others don\'t',
                    'Incidents can occur; response matters',
                    'ISO 27001 is technology-agnostic'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Management Review - Item 28
            [
                'topic_id' => $topics['ISO 27001 Certification Audits'] ?? 122,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How often must management reviews be conducted for ISO 27001 compliance?',
                'options' => [
                    'Monthly',
                    'At planned intervals',
                    'Only when problems occur',
                    'Every three years'
                ],
                'correct_options' => ['At planned intervals'],
                'justifications' => [
                    'Monthly may be excessive for some organizations',
                    'Correct - ISO requires regular planned reviews, frequency depends on organization',
                    'Reviews must be proactive, not reactive',
                    'Three years is too infrequent'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Control Deficiency Severity - Item 29
            [
                'topic_id' => $topics['Control Design & Operating-Effectiveness Testing'] ?? 117,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A control deficiency that could result in material misstatement or significant security breach is classified as:',
                'options' => [
                    'Minor deficiency',
                    'Significant deficiency',
                    'Observation only',
                    'Best practice gap'
                ],
                'correct_options' => ['Significant deficiency'],
                'justifications' => [
                    'Material impact indicates more than minor',
                    'Correct - Significant deficiencies have potential for material impact',
                    'Observations are typically lower risk',
                    'Best practice gaps aren\'t necessarily deficiencies'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Continuous Monitoring Tools - Item 30
            [
                'topic_id' => $topics['Continuous Control Monitoring (CCM)'] ?? 118,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select appropriate tools/techniques for continuous control monitoring:',
                'options' => [
                    'Automated log analysis',
                    'Annual questionnaires',
                    'Real-time dashboards',
                    'Quarterly meetings',
                    'Exception reporting',
                    'Five-year plans'
                ],
                'correct_options' => ['Automated log analysis', 'Real-time dashboards', 'Exception reporting'],
                'justifications' => [
                    'Automation enables continuous monitoring',
                    'Annual reviews aren\'t continuous',
                    'Real-time visibility supports CCM',
                    'Quarterly isn\'t continuous',
                    'Automated exception alerts enable rapid response',
                    'Long-term planning isn\'t monitoring'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Audit Trail Requirements - Item 31
            [
                'topic_id' => $topics['Evidence-Gathering Techniques'] ?? 114,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What characteristic makes an audit trail most effective for security investigations?',
                'options' => [
                    'Ability to be modified by administrators',
                    'Immutability and time-stamping',
                    'Minimal detail to save space',
                    'Retention for 30 days only'
                ],
                'correct_options' => ['Immutability and time-stamping'],
                'justifications' => [
                    'Modifiable logs lose evidentiary value',
                    'Correct - Tamper-proof logs with timestamps provide reliable evidence',
                    'Detailed logs aid investigations',
                    'Longer retention often required'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Compensating Controls - Item 32
            [
                'topic_id' => $topics['Control Design & Operating-Effectiveness Testing'] ?? 117,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When are compensating controls typically implemented?',
                'options' => [
                    'To replace all existing controls',
                    'When primary controls cannot be implemented',
                    'Only in small organizations',
                    'To eliminate audit requirements'
                ],
                'correct_options' => ['When primary controls cannot be implemented'],
                'justifications' => [
                    'Compensating controls supplement, not replace all controls',
                    'Correct - Used when standard controls are not feasible but risk must be managed',
                    'Applicable to any size organization',
                    'Audit requirements remain regardless'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Integrated Auditing - Item 33
            [
                'topic_id' => $topics['Security Audits (Internal, External)'] ?? 112,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the main advantage of integrated auditing (combining IT and business process audits)?',
                'options' => [
                    'Reduced audit time',
                    'Holistic view of risks and controls',
                    'Lower costs',
                    'Simplified reporting'
                ],
                'correct_options' => ['Holistic view of risks and controls'],
                'justifications' => [
                    'May actually take more time initially',
                    'Correct - Integrated approach reveals interdependencies between IT and business',
                    'May require more resources',
                    'Reporting can be more complex'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Audit Automation Benefits - Item 34
            [
                'topic_id' => $topics['Evidence-Gathering Techniques'] ?? 114,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which task is LEAST suitable for audit automation?',
                'options' => [
                    'Transaction matching',
                    'Professional judgment calls',
                    'Data extraction',
                    'Compliance checking'
                ],
                'correct_options' => ['Professional judgment calls'],
                'justifications' => [
                    'Easily automated with rules',
                    'Correct - Human judgment cannot be automated',
                    'Standard automation use case',
                    'Rule-based checks are automatable'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Third-Party Assessments - Item 35
            [
                'topic_id' => $topics['Security Audits (Internal, External)'] ?? 112,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When relying on a vendor\'s SOC 2 report, what should you additionally review?',
                'options' => [
                    'The vendor\'s marketing materials',
                    'Complementary user entity controls',
                    'The vendor\'s profit margins',
                    'Employee satisfaction surveys'
                ],
                'correct_options' => ['Complementary user entity controls'],
                'justifications' => [
                    'Marketing doesn\'t provide assurance',
                    'Correct - CUECs identify controls you must implement for vendor controls to be effective',
                    'Financial performance isn\'t security-relevant',
                    'Employee satisfaction doesn\'t indicate security'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Security Metrics - Item 36
            [
                'topic_id' => $topics['Continuous Control Monitoring (CCM)'] ?? 118,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which metric best indicates the effectiveness of a vulnerability management program?',
                'options' => [
                    'Number of scans performed',
                    'Mean time to remediate critical vulnerabilities',
                    'Scanner license costs',
                    'Number of security staff'
                ],
                'correct_options' => ['Mean time to remediate critical vulnerabilities'],
                'justifications' => [
                    'Activity doesn\'t equal effectiveness',
                    'Correct - Remediation speed directly measures program effectiveness',
                    'Cost doesn\'t indicate effectiveness',
                    'Staffing levels don\'t guarantee results'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Audit Follow-up - Item 37
            [
                'topic_id' => $topics['Audit Life-Cycle Phases'] ?? 111,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of audit follow-up activities?',
                'options' => [
                    'To find more issues',
                    'To verify remediation of findings',
                    'To assign blame',
                    'To reduce future audit scope'
                ],
                'correct_options' => ['To verify remediation of findings'],
                'justifications' => [
                    'Follow-up focuses on prior findings',
                    'Correct - Ensures identified issues have been properly addressed',
                    'Focus is remediation, not blame',
                    'Scope determined by risk, not past findings'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Assessment vs Audit - Item 38
            [
                'topic_id' => $topics['Security Audits (Internal, External)'] ?? 112,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What distinguishes a security assessment from a security audit?',
                'options' => [
                    'Assessments are more formal and provide attestation',
                    'Audits are informal reviews',
                    'Assessments are consultative; audits provide independent opinion',
                    'They are the same thing'
                ],
                'correct_options' => ['Assessments are consultative; audits provide independent opinion'],
                'justifications' => [
                    'Audits are more formal with attestation',
                    'Audits follow formal standards',
                    'Correct - Assessments advise on improvements; audits provide assurance',
                    'Clear distinctions exist between them'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Zero-Day Testing - Item 39
            [
                'topic_id' => $topics['Vulnerability Assessment & Management'] ?? 119,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => '**True or False:** Vulnerability scanners can effectively detect zero-day vulnerabilities.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Vulnerability scanners rely on known vulnerability databases and signatures. Zero-day vulnerabilities are by definition unknown and unpatched, so traditional scanners cannot detect them. Other techniques like behavior analysis or penetration testing may be needed.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            
            // Audit Program Development - Item 40
            [
                'topic_id' => $topics['Audit Life-Cycle Phases'] ?? 111,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should drive the development of an organization\'s annual audit program?',
                'options' => [
                    'Available audit resources only',
                    'Risk assessment results',
                    'Department requests',
                    'Previous year\'s program'
                ],
                'correct_options' => ['Risk assessment results'],
                'justifications' => [
                    'Resources are a constraint, not a driver',
                    'Correct - Risk-based approach ensures focus on highest impact areas',
                    'Requests don\'t necessarily reflect risk',
                    'Risks change; programs must adapt'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Penetration Test Deliverables - Item 41
            [
                'topic_id' => $topics['Penetration Testing & Red/Purple Teaming'] ?? 120,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Select essential components of a penetration test report:',
                'options' => [
                    'Executive summary',
                    'Tester biographical details',
                    'Technical findings with evidence',
                    'Coffee consumption statistics',
                    'Risk ratings and remediation advice',
                    'Tester\'s personal opinions'
                ],
                'correct_options' => ['Executive summary', 'Technical findings with evidence', 'Risk ratings and remediation advice'],
                'justifications' => [
                    'Leadership needs high-level overview',
                    'Tester background irrelevant to findings',
                    'Evidence supports findings validity',
                    'Irrelevant to security findings',
                    'Guides prioritization and fixes',
                    'Professional facts, not opinions'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Audit Quality Assurance - Item 42
            [
                'topic_id' => $topics['Security Audits (Internal, External)'] ?? 112,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which practice best ensures audit quality?',
                'options' => [
                    'Rushing to meet deadlines',
                    'Independent review of audit work',
                    'Minimizing documentation',
                    'Avoiding difficult areas'
                ],
                'correct_options' => ['Independent review of audit work'],
                'justifications' => [
                    'Speed shouldn\'t compromise quality',
                    'Correct - Peer review catches errors and ensures standards compliance',
                    'Thorough documentation ensures quality',
                    'Must audit based on risk, not ease'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            
            // Basic Security Audit Concepts - Item 43 (L1)
            [
                'topic_id' => $topics['Security Audits (Internal, External)'] ?? 112,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the definition of an audit trail in security contexts?',
                'options' => [
                    'A physical path through secure areas',
                    'A chronological record of security events and activities',
                    'A list of security policies',
                    'A backup schedule'
                ],
                'correct_options' => ['A chronological record of security events and activities'],
                'justifications' => [
                    'Physical paths are not audit trails',
                    'Correct - Audit trails provide chronological documentation for accountability',
                    'Policies define requirements, not activities',
                    'Backup schedules are operational, not audit records'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            
            // Vulnerability Assessment Application - Item 44 (L3)
            [
                'topic_id' => $topics['Vulnerability Assessment & Management'] ?? 119,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When implementing a vulnerability management program, what should be the first priority after discovery?',
                'options' => [
                    'Documenting all findings in detail',
                    'Risk assessment and prioritization',
                    'Immediately patching everything',
                    'Notifying all stakeholders'
                ],
                'correct_options' => ['Risk assessment and prioritization'],
                'justifications' => [
                    'Documentation is important but not the first priority',
                    'Correct - Risk-based prioritization ensures critical vulnerabilities are addressed first',
                    'Immediate patching without prioritization can disrupt operations',
                    'Notification comes after understanding risk levels'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Risk-Based Testing Application - Item 45 (L3)
            [
                'topic_id' => $topics['Compliance vs Substantive Testing'] ?? 113,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How should audit testing procedures be modified when inherent risk is assessed as high?',
                'options' => [
                    'Reduce testing procedures to save time',
                    'Increase extent and rigor of testing',
                    'Switch to inquiry only',
                    'Test only automated controls'
                ],
                'correct_options' => ['Increase extent and rigor of testing'],
                'justifications' => [
                    'High risk requires more, not less, testing',
                    'Correct - Higher risk requires more extensive and detailed testing to provide adequate assurance',
                    'Inquiry alone is insufficient for high-risk areas',
                    'Both manual and automated controls should be tested'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Evidence Evaluation Application - Item 46 (L3)
            [
                'topic_id' => $topics['Evidence-Gathering Techniques'] ?? 114,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When applying evidence evaluation criteria, what makes evidence more persuasive?',
                'options' => [
                    'Obtained from management only',
                    'Generated externally and obtained directly',
                    'Verbal confirmations',
                    'Photocopied documents'
                ],
                'correct_options' => ['Generated externally and obtained directly'],
                'justifications' => [
                    'Management-provided evidence has inherent bias',
                    'Correct - External generation and direct receipt increases reliability and persuasiveness',
                    'Verbal evidence is less reliable than documented',
                    'Originals are more persuasive than copies'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Control Testing Implementation - Item 47 (L3)
            [
                'topic_id' => $topics['Control Design & Operating-Effectiveness Testing'] ?? 117,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When implementing control testing for segregation of duties, what approach provides the strongest evidence?',
                'options' => [
                    'Review organizational charts only',
                    'Test actual transaction processing through complete cycles',
                    'Interview personnel about their duties',
                    'Review job descriptions'
                ],
                'correct_options' => ['Test actual transaction processing through complete cycles'],
                'justifications' => [
                    'Charts show intended structure, not actual practice',
                    'Correct - Transaction walk-throughs demonstrate actual segregation in practice',
                    'Interviews reveal understanding but not actual performance',
                    'Job descriptions show intent, not actual duties performed'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            
            // Assessment vs Penetration Testing Analysis - Item 48 (L4)
            [
                'topic_id' => $topics['Penetration Testing & Red/Purple Teaming'] ?? 120,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Analyze the scenario: A company wants to understand their security posture before a major system deployment. They need comprehensive coverage but cannot risk system disruption. What approach should they choose?',
                'options' => [
                    'Full penetration testing with exploitation',
                    'Vulnerability assessment with limited safe testing',
                    'Red team exercise',
                    'Social engineering campaign'
                ],
                'correct_options' => ['Vulnerability assessment with limited safe testing'],
                'justifications' => [
                    'Full exploitation could disrupt pre-deployment systems',
                    'Correct - VA provides comprehensive coverage without exploitation risks',
                    'Red teams typically involve exploitation attempts',
                    'Social engineering tests people, not technical systems'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Audit Sampling Risk Analysis - Item 49 (L4)
            [
                'topic_id' => $topics['Sampling Methods & Sampling Risk'] ?? 115,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Analyze this situation: An auditor tests 50 items from a population of 10,000 and finds no exceptions. What sampling risk concerns should be considered?',
                'options' => [
                    'No risk - the sample proves the population is clean',
                    'Risk that the population actually contains material exceptions',
                    'Risk that the sample size was too large',
                    'Risk that testing was too thorough'
                ],
                'correct_options' => ['Risk that the population actually contains material exceptions'],
                'justifications' => [
                    'Small samples cannot prove population characteristics',
                    'Correct - Sampling risk means exceptions could exist in untested items',
                    'Larger samples reduce risk, not increase it',
                    'Thorough testing reduces rather than increases risk'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            
            // Continuous Monitoring Strategy Application - Item 50 (L3)
            [
                'topic_id' => $topics['Continuous Control Monitoring (CCM)'] ?? 118,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When implementing continuous control monitoring for access controls, which approach would be most effective?',
                'options' => [
                    'Manual quarterly access reviews only',
                    'Automated daily monitoring with exception reporting',
                    'Annual penetration testing',
                    'Relying on user self-reporting'
                ],
                'correct_options' => ['Automated daily monitoring with exception reporting'],
                'justifications' => [
                    'Quarterly reviews miss real-time access issues',
                    'Correct - Automated monitoring provides continuous assurance with timely alerts',
                    'Annual testing is insufficient for access control monitoring',
                    'Self-reporting is unreliable and not comprehensive'
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
        
        $this->command->info('Domain 6 (Security Audits & Assessments) diagnostic items seeded successfully!');
    }
}