<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;


use Illuminate\Database\Seeder;

class D19IncidentManagementForensicsSeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Incident Management & Forensics');
        })->pluck('id', 'name');
        
        
        $items = [
            // Incident Response Phases - Item 1
            [
                'topic_id' => $topics['Incident Response Phases'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the correct order of incident response phases according to NIST?',
                'options' => [
                    'Detection → Containment → Eradication → Recovery',
                    'Preparation → Detection & Analysis → Containment, Eradication & Recovery → Post-Incident Activity',
                    'Identification → Containment → Investigation → Recovery',
                    'Alert → Response → Remediation → Closure'
                ],
                'correct_options' => ['Preparation → Detection & Analysis → Containment, Eradication & Recovery → Post-Incident Activity'],
                'justifications' => [
                    'Missing preparation and post-incident phases',
                    'Correct - NIST SP 800-61 incident response lifecycle',
                    'Not the standard NIST framework',
                    'Simplified, not the complete NIST model'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Incident Response Phases - Item 2
            [
                'topic_id' => $topics['Incident Response Phases'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During which incident response phase should the root cause analysis be performed?',
                'options' => [
                    'Detection & Analysis',
                    'Containment',
                    'Eradication',
                    'Post-Incident Activity'
                ],
                'correct_options' => ['Post-Incident Activity'],
                'justifications' => [
                    'Focus is on identifying and understanding the incident',
                    'Focus is on limiting damage and preventing spread',
                    'Focus is on removing the threat',
                    'Correct - Root cause analysis happens during lessons learned'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Incident Response Phases - Item 3
            [
                'topic_id' => $topics['Incident Response Phases'] ?? 1,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these incident response activities in the order they typically occur:',
                'options' => [
                    'Isolate affected systems',
                    'Identify indicators of compromise',
                    'Apply patches to vulnerabilities',
                    'Document lessons learned',
                    'Restore systems from backups'
                ],
                'correct_options' => [
                    'Identify indicators of compromise',
                    'Isolate affected systems',
                    'Apply patches to vulnerabilities',
                    'Restore systems from backups',
                    'Document lessons learned'
                ],
                'justifications' => ['Detection (identify IOCs) → Containment (isolate) → Eradication (patch) → Recovery (restore) → Post-incident (lessons learned)'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Incident Response Phases - Item 4
            [
                'topic_id' => $topics['Incident Response Phases'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** The preparation phase of incident response only involves creating an incident response plan.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Preparation involves much more than just planning. It includes establishing an incident response team, creating communication plans, acquiring tools and resources, training personnel, and conducting exercises. Comprehensive preparation is critical for effective incident response.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Playbooks & Runbooks - Item 5
            [
                'topic_id' => $topics['Playbooks & Runbooks'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary difference between an incident response playbook and a runbook?',
                'options' => [
                    'Playbooks are for management, runbooks are for technicians',
                    'Playbooks provide high-level guidance, runbooks provide step-by-step procedures',
                    'Playbooks are confidential, runbooks are public',
                    'There is no difference; the terms are interchangeable'
                ],
                'correct_options' => ['Playbooks provide high-level guidance, runbooks provide step-by-step procedures'],
                'justifications' => [
                    'Both can be used by various roles',
                    'Correct - Playbooks guide strategy, runbooks detail specific actions',
                    'Both are typically internal documents',
                    'The terms have distinct meanings in incident response'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Playbooks & Runbooks - Item 6
            [
                'topic_id' => $topics['Playbooks & Runbooks'] ?? 2,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the scenarios that would benefit from having a specific incident response playbook to the drop zone:',
                'options' => [
                    'Ransomware attack',
                    'Employee birthday party',
                    'Data breach',
                    'Office relocation',
                    'Phishing campaign',
                    'Annual performance reviews',
                    'DDoS attack',
                    'Company picnic planning'
                ],
                'correct_options' => [
                    'Ransomware attack',
                    'Data breach',
                    'Phishing campaign',
                    'DDoS attack'
                ],
                'justifications' => [
                    'Common incident requiring specific response procedures',
                    'Not a security incident',
                    'Critical incident needing structured response',
                    'Not a security incident',
                    'Frequent incident type needing consistent response',
                    'HR process, not security incident',
                    'Network attack requiring rapid response',
                    'Not a security incident'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Reporting & Communication - Item 7
            [
                'topic_id' => $topics['Reporting & Communication (Breach Notice)'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Under GDPR, what is the maximum timeframe for notifying supervisory authorities of a personal data breach?',
                'options' => [
                    '24 hours',
                    '48 hours',
                    '72 hours',
                    '7 days'
                ],
                'correct_options' => ['72 hours'],
                'justifications' => [
                    'Too short for GDPR requirements',
                    'Shorter than GDPR requirement',
                    'Correct - GDPR requires notification within 72 hours where feasible',
                    'Exceeds GDPR requirement'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Reporting & Communication - Item 8
            [
                'topic_id' => $topics['Reporting & Communication (Breach Notice)'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => 'Which stakeholders should be included in the incident communication plan? (Select all that apply)',
                'options' => [
                    'Executive management',
                    'Legal counsel',
                    'Public relations team',
                    'All employees immediately',
                    'Affected customers',
                    'Competitors',
                    'Law enforcement (when appropriate)',
                    'Regulatory bodies'
                ],
                'correct_options' => [
                    'Executive management',
                    'Legal counsel',
                    'Public relations team',
                    'Affected customers',
                    'Law enforcement (when appropriate)',
                    'Regulatory bodies'
                ],
                'justifications' => [
                    'Correct - Need to be informed for decision-making',
                    'Correct - Required for legal compliance guidance',
                    'Correct - Manages external communications',
                    'Only need-to-know basis initially',
                    'Correct - May have legal notification requirements',
                    'Should not share incident details with competitors',
                    'Correct - For criminal incidents or when required',
                    'Correct - When required by regulations'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Reporting & Communication - Item 9
            [
                'topic_id' => $topics['Reporting & Communication (Breach Notice)'] ?? 3,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each communication type with its appropriate timing during an incident:',
                'options' => [
                    'items' => [
                        'Initial executive briefing',
                        'Regulatory notification',
                        'Customer notification',
                        'Post-incident report'
                    ],
                    'responses' => [
                        'Within first hour of confirmation',
                        'Within regulatory timeframe (e.g., 72 hours)',
                        'After legal review and approval',
                        'After incident closure and analysis'
                    ]
                ],
                'correct_options' => [
                    'Initial executive briefing' => 'Within first hour of confirmation',
                    'Regulatory notification' => 'Within regulatory timeframe (e.g., 72 hours)',
                    'Customer notification' => 'After legal review and approval',
                    'Post-incident report' => 'After incident closure and analysis'
                ],
                'justifications' => [
                    'Initial executive briefing' => 'Executives need immediate awareness',
                    'Regulatory notification' => 'Must meet compliance deadlines',
                    'Customer notification' => 'Requires careful legal consideration',
                    'Post-incident report' => 'Complete analysis needed first'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Forensic Investigation - Item 10
            [
                'topic_id' => $topics['Forensic Investigation'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary goal of digital forensics in incident response?',
                'options' => [
                    'Punish the attacker',
                    'Recover deleted files',
                    'Gather and preserve evidence',
                    'Improve system performance'
                ],
                'correct_options' => ['Gather and preserve evidence'],
                'justifications' => [
                    'Punishment is a legal matter, not forensics goal',
                    'File recovery is just one aspect of forensics',
                    'Correct - Evidence collection and preservation is the primary goal',
                    'Not related to forensic investigation'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Forensic Investigation - Item 11
            [
                'topic_id' => $topics['Forensic Investigation'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which principle must be followed when collecting digital evidence?',
                'options' => [
                    'Evidence should be collected as quickly as possible, regardless of method',
                    'Original evidence should be modified to highlight important findings',
                    'Evidence collection should maintain integrity and admissibility',
                    'Only collect evidence that supports the initial hypothesis'
                ],
                'correct_options' => ['Evidence collection should maintain integrity and admissibility'],
                'justifications' => [
                    'Speed should not compromise evidence integrity',
                    'Original evidence must never be modified',
                    'Correct - Proper procedures ensure evidence is legally admissible',
                    'All relevant evidence should be collected objectively'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Evidence Handling & Chain of Custody - Item 12
            [
                'topic_id' => $topics['Evidence Handling & Chain of Custody'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What information must be documented in a chain of custody form?',
                'options' => [
                    'Only the name of the person who found the evidence',
                    'Date, time, location, and all persons who handled the evidence',
                    'Just the final storage location',
                    'Only the evidence description'
                ],
                'correct_options' => ['Date, time, location, and all persons who handled the evidence'],
                'justifications' => [
                    'Incomplete documentation breaks chain of custody',
                    'Correct - Complete documentation ensures evidence admissibility',
                    'Missing critical handling information',
                    'Insufficient for legal requirements'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Evidence Handling & Chain of Custody - Item 13
            [
                'topic_id' => $topics['Evidence Handling & Chain of Custody'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Once digital evidence is collected, it can be analyzed on the original media to save time.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Digital evidence should never be analyzed on original media. Forensic best practice requires creating a bit-for-bit copy (forensic image) and analyzing the copy. This preserves the original evidence integrity and prevents accidental modification that could render it inadmissible.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Evidence Handling & Chain of Custody - Item 14
            [
                'topic_id' => $topics['Evidence Handling & Chain of Custody'] ?? 5,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the actions that could break the chain of custody to the drop zone:',
                'options' => [
                    'Leaving evidence unattended',
                    'Using write-blockers',
                    'Failing to document transfers',
                    'Creating forensic images',
                    'Modifying original evidence',
                    'Sealing evidence in tamper-proof containers',
                    'Missing signatures on custody forms',
                    'Storing in secure evidence locker'
                ],
                'correct_options' => [
                    'Leaving evidence unattended',
                    'Failing to document transfers',
                    'Modifying original evidence',
                    'Missing signatures on custody forms'
                ],
                'justifications' => [
                    'Breaks continuous control requirement',
                    'Proper evidence handling technique',
                    'Gaps in documentation break chain',
                    'Standard forensic practice',
                    'Destroys evidence integrity',
                    'Proper evidence storage method',
                    'Incomplete documentation breaks chain',
                    'Proper evidence storage'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Root-Cause & Post-Incident Analysis - Item 15
            [
                'topic_id' => $topics['Root-Cause & Post-Incident Analysis'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of conducting a root cause analysis after an incident?',
                'options' => [
                    'Assign blame for the incident',
                    'Identify systemic issues to prevent recurrence',
                    'Calculate financial losses',
                    'Justify additional security budget'
                ],
                'correct_options' => ['Identify systemic issues to prevent recurrence'],
                'justifications' => [
                    'RCA focuses on improvement, not blame',
                    'Correct - RCA identifies underlying causes to prevent future incidents',
                    'Financial impact is separate from root cause',
                    'Budget justification is a potential outcome, not the purpose'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Root-Cause & Post-Incident Analysis - Item 16
            [
                'topic_id' => $topics['Root-Cause & Post-Incident Analysis'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When should the post-incident review meeting be conducted?',
                'options' => [
                    'Immediately after detecting the incident',
                    'During the containment phase',
                    'Within 1-2 weeks after incident closure',
                    'Only if requested by management'
                ],
                'correct_options' => ['Within 1-2 weeks after incident closure'],
                'justifications' => [
                    'Too early, incident not yet resolved',
                    'Team is busy containing the incident',
                    'Correct - Allows time for analysis while memories are fresh',
                    'Should be standard practice, not optional'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Root-Cause & Post-Incident Analysis - Item 17
            [
                'topic_id' => $topics['Root-Cause & Post-Incident Analysis'] ?? 6,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each root cause analysis technique with its description:',
                'options' => [
                    'items' => [
                        '5 Whys',
                        'Fishbone Diagram',
                        'Fault Tree Analysis',
                        'Timeline Analysis'
                    ],
                    'responses' => [
                        'Repeatedly asking why to drill down to root cause',
                        'Visual map of potential causes by category',
                        'Top-down analysis of failure paths',
                        'Chronological sequence of events'
                    ]
                ],
                'correct_options' => [
                    '5 Whys' => 'Repeatedly asking why to drill down to root cause',
                    'Fishbone Diagram' => 'Visual map of potential causes by category',
                    'Fault Tree Analysis' => 'Top-down analysis of failure paths',
                    'Timeline Analysis' => 'Chronological sequence of events'
                ],
                'justifications' => [
                    '5 Whys' => 'Simple iterative questioning technique',
                    'Fishbone Diagram' => 'Also called Ishikawa diagram for cause analysis',
                    'Fault Tree Analysis' => 'Analyzes combinations of failures',
                    'Timeline Analysis' => 'Reconstructs incident chronology'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Digital Forensics Tools & Order of Volatility - Item 18
            [
                'topic_id' => $topics['Digital Forensics Tools & Order of Volatility'] ?? 7,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these data sources by order of volatility (most volatile first):',
                'options' => [
                    'Hard drive data',
                    'CPU cache and registers',
                    'Archival backup tapes',
                    'RAM contents',
                    'Temporary file systems'
                ],
                'correct_options' => [
                    'CPU cache and registers',
                    'RAM contents',
                    'Temporary file systems',
                    'Hard drive data',
                    'Archival backup tapes'
                ],
                'justifications' => ['Order of volatility guides evidence collection priority. CPU/registers are lost immediately on power loss, RAM is lost on shutdown, temp files may persist briefly, hard drives retain data, and backups are most persistent.'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Digital Forensics Tools & Order of Volatility - Item 19
            [
                'topic_id' => $topics['Digital Forensics Tools & Order of Volatility'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Why is understanding the order of volatility important in digital forensics?',
                'options' => [
                    'It determines which evidence is most valuable',
                    'It guides the sequence of evidence collection',
                    'It indicates which evidence to ignore',
                    'It shows which systems to shut down first'
                ],
                'correct_options' => ['It guides the sequence of evidence collection'],
                'justifications' => [
                    'All evidence can be valuable regardless of volatility',
                    'Correct - Collect most volatile evidence first before it\'s lost',
                    'All evidence types should be considered',
                    'Systems should be preserved, not shut down during collection'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Digital Forensics Tools & Order of Volatility - Item 20
            [
                'topic_id' => $topics['Digital Forensics Tools & Order of Volatility'] ?? 7,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the appropriate forensic tools to the drop zone for collecting volatile memory:',
                'options' => [
                    'Memory dumping tools',
                    'Disk imaging software',
                    'Network packet analyzers',
                    'Registry editors',
                    'RAM acquisition tools',
                    'File recovery utilities',
                    'Process monitoring tools',
                    'Backup software'
                ],
                'correct_options' => [
                    'Memory dumping tools',
                    'RAM acquisition tools',
                    'Process monitoring tools'
                ],
                'justifications' => [
                    'Captures current memory state',
                    'For non-volatile disk evidence',
                    'For network traffic, not memory',
                    'Registry is on disk, not volatile memory',
                    'Specifically designed for volatile memory capture',
                    'For disk recovery, not memory',
                    'Shows running processes in memory',
                    'For data backup, not forensics'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Mixed Topics - Advanced Scenarios

            // Comprehensive Incident Response - Item 21
            [
                'topic_id' => $topics['Incident Response Phases'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A ransomware attack has encrypted critical servers. What should be the FIRST action?',
                'options' => [
                    'Pay the ransom to restore operations quickly',
                    'Isolate affected systems from the network',
                    'Begin negotiating with the attackers',
                    'Restore from backups immediately'
                ],
                'correct_options' => ['Isolate affected systems from the network'],
                'justifications' => [
                    'Payment should never be the first response',
                    'Correct - Containment prevents spread to other systems',
                    'Negotiation comes after assessment if needed',
                    'Restoration comes after containment and eradication'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Legal and Forensic Considerations - Item 22
            [
                'topic_id' => $topics['Evidence Handling & Chain of Custody'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Law enforcement requests immediate access to a compromised server for evidence. What is the BEST response?',
                'options' => [
                    'Grant immediate physical access to the server',
                    'Create forensic images and provide those instead',
                    'Refuse access citing business confidentiality',
                    'Shut down the server and deliver it to law enforcement'
                ],
                'correct_options' => ['Create forensic images and provide those instead'],
                'justifications' => [
                    'May disrupt business and evidence collection procedures',
                    'Correct - Preserves evidence while maintaining business operations',
                    'May violate legal obligations to cooperate',
                    'Destroys volatile evidence and disrupts business'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Communication During Crisis - Item 23
            [
                'topic_id' => $topics['Reporting & Communication (Breach Notice)'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During a major data breach, conflicting information is circulating on social media. Who should coordinate external communications?',
                'options' => [
                    'The incident response team leader',
                    'The IT security manager',
                    'The designated PR/communications team',
                    'The CEO personally'
                ],
                'correct_options' => ['The designated PR/communications team'],
                'justifications' => [
                    'Should focus on technical response',
                    'May lack media communication skills',
                    'Correct - Trained in crisis communication and media relations',
                    'Should be informed but not primary spokesperson'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Post-Incident Improvement - Item 24
            [
                'topic_id' => $topics['Root-Cause & Post-Incident Analysis'] ?? 6,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'After a security incident, drag the improvements that should result from lessons learned to the drop zone:',
                'options' => [
                    'Updated incident response procedures',
                    'Punishment for involved staff',
                    'Enhanced detection capabilities',
                    'Blame assignment report',
                    'Security awareness training updates',
                    'Reduced security budget',
                    'Technical control improvements',
                    'Decreased monitoring'
                ],
                'correct_options' => [
                    'Updated incident response procedures',
                    'Enhanced detection capabilities',
                    'Security awareness training updates',
                    'Technical control improvements'
                ],
                'justifications' => [
                    'Procedures should evolve based on experience',
                    'Focus should be on improvement, not punishment',
                    'Better detection prevents future incidents',
                    'Blame doesn\'t improve security',
                    'Training addresses human factor issues',
                    'Incidents typically justify increased budget',
                    'Technical gaps should be addressed',
                    'Monitoring should increase, not decrease'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Forensic Tool Selection - Item 25
            [
                'topic_id' => $topics['Digital Forensics Tools & Order of Volatility'] ?? 7,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each forensic task with the appropriate tool type:',
                'options' => [
                    'items' => [
                        'Live memory analysis',
                        'Disk imaging',
                        'Timeline creation',
                        'Password recovery'
                    ],
                    'responses' => [
                        'Volatility Framework',
                        'dd or FTK Imager',
                        'log2timeline/plaso',
                        'John the Ripper or Hashcat'
                    ]
                ],
                'correct_options' => [
                    'Live memory analysis' => 'Volatility Framework',
                    'Disk imaging' => 'dd or FTK Imager',
                    'Timeline creation' => 'log2timeline/plaso',
                    'Password recovery' => 'John the Ripper or Hashcat'
                ],
                'justifications' => [
                    'Live memory analysis' => 'Volatility specializes in memory forensics',
                    'Disk imaging' => 'Standard tools for creating forensic images',
                    'Timeline creation' => 'Specialized timeline analysis tools',
                    'Password recovery' => 'Password cracking and recovery tools'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Incident Classification - Item 26
            [
                'topic_id' => $topics['Incident Response Phases'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How should security incidents be classified for prioritization?',
                'options' => [
                    'By the time of day they occur',
                    'By impact on business operations and data sensitivity',
                    'By the attacker\'s country of origin',
                    'By the age of the affected systems'
                ],
                'correct_options' => ['By impact on business operations and data sensitivity'],
                'justifications' => [
                    'Time of day doesn\'t determine incident severity',
                    'Correct - Business impact and data classification guide response priority',
                    'Attribution is difficult and doesn\'t determine priority',
                    'System age doesn\'t determine incident priority'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Legal Hold Requirements - Item 27
            [
                'topic_id' => $topics['Evidence Handling & Chain of Custody'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** During a legal hold for potential litigation, normal data retention policies should continue to be applied.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Legal hold supersedes normal retention policies. All potentially relevant data must be preserved, even if it would normally be deleted under standard retention schedules. This prevents spoliation of evidence that could result in legal sanctions.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Playbook Effectiveness - Item 28
            [
                'topic_id' => $topics['Playbooks & Runbooks'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the BEST way to validate incident response playbooks?',
                'options' => [
                    'Have management review and approve them',
                    'Wait for a real incident to test them',
                    'Conduct regular tabletop exercises',
                    'Have external auditors review them'
                ],
                'correct_options' => ['Conduct regular tabletop exercises'],
                'justifications' => [
                    'Management approval doesn\'t validate effectiveness',
                    'Too risky to wait for actual incidents',
                    'Correct - Exercises test procedures and identify gaps safely',
                    'External review helps but doesn\'t validate execution'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Forensic Integrity - Item 29
            [
                'topic_id' => $topics['Forensic Investigation'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What method ensures the integrity of forensic evidence during analysis?',
                'options' => [
                    'Analyzing evidence on air-gapped systems',
                    'Using cryptographic hashes before and after analysis',
                    'Having multiple analysts verify findings',
                    'Storing evidence in locked cabinets'
                ],
                'correct_options' => ['Using cryptographic hashes before and after analysis'],
                'justifications' => [
                    'Air-gapping prevents contamination but doesn\'t prove integrity',
                    'Correct - Hash comparison proves evidence hasn\'t been altered',
                    'Verification is good practice but doesn\'t ensure integrity',
                    'Physical security doesn\'t prove digital integrity'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Incident Metrics - Item 30
            [
                'topic_id' => $topics['Root-Cause & Post-Incident Analysis'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which metrics should be tracked to improve incident response capabilities? (Select all that apply)',
                'options' => [
                    'Time to detect',
                    'Number of false positives',
                    'Time to contain',
                    'Coffee consumed during incidents',
                    'Time to recover',
                    'Cost of incidents',
                    'Number of pizza orders',
                    'Lessons learned implemented'
                ],
                'correct_options' => [
                    'Time to detect',
                    'Time to contain',
                    'Time to recover',
                    'Cost of incidents',
                    'Lessons learned implemented'
                ],
                'justifications' => [
                    'Correct - Key metric for detection capability',
                    'Related to detection quality, not incident response',
                    'Correct - Measures containment effectiveness',
                    'Not a meaningful security metric',
                    'Correct - Indicates recovery capability',
                    'Correct - Helps justify security investments',
                    'Not a security metric',
                    'Correct - Shows continuous improvement'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Evidence Preservation - Item 31
            [
                'topic_id' => $topics['Evidence Handling & Chain of Custody'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A critical server involved in an incident needs to remain operational. How should evidence be preserved?',
                'options' => [
                    'Skip evidence collection to maintain availability',
                    'Perform live forensics and memory dumps',
                    'Wait until scheduled maintenance to collect evidence',
                    'Quickly reboot the server to clear the incident'
                ],
                'correct_options' => ['Perform live forensics and memory dumps'],
                'justifications' => [
                    'Evidence collection is critical for investigation',
                    'Correct - Live forensics preserves evidence while maintaining operations',
                    'Evidence may be lost or overwritten by then',
                    'Rebooting destroys volatile evidence'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Breach Notification Decisions - Item 32
            [
                'topic_id' => $topics['Reporting & Communication (Breach Notice)'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What factors determine whether customer notification is required after a data breach? (Select all that apply)',
                'options' => [
                    'Type of data exposed',
                    'Number of records affected',
                    'Time of day the breach occurred',
                    'Regulatory requirements',
                    'Weather conditions',
                    'Risk of harm to individuals',
                    'Company stock price',
                    'Whether data was encrypted'
                ],
                'correct_options' => [
                    'Type of data exposed',
                    'Number of records affected',
                    'Regulatory requirements',
                    'Risk of harm to individuals',
                    'Whether data was encrypted'
                ],
                'justifications' => [
                    'Correct - Sensitive data requires notification',
                    'Correct - Thresholds may trigger requirements',
                    'Time is not a notification factor',
                    'Correct - Laws mandate specific notifications',
                    'Not relevant to notification requirements',
                    'Correct - Harm assessment guides notification',
                    'Stock price not a legal factor',
                    'Correct - Encryption may exempt from notification'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Forensic Prioritization - Item 33
            [
                'topic_id' => $topics['Digital Forensics Tools & Order of Volatility'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Multiple systems are compromised in an incident. Which should be forensically imaged FIRST?',
                'options' => [
                    'The newest servers',
                    'Systems containing the most sensitive data',
                    'The oldest systems',
                    'Systems alphabetically by hostname'
                ],
                'correct_options' => ['Systems containing the most sensitive data'],
                'justifications' => [
                    'Age doesn\'t determine forensic priority',
                    'Correct - Protect most critical evidence and sensitive data first',
                    'Old systems not necessarily priority',
                    'Arbitrary ordering ignores business priorities'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Incident Response Team Roles - Item 34
            [
                'topic_id' => $topics['Incident Response Phases'] ?? 1,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each incident response team role with its primary responsibility:',
                'options' => [
                    'items' => [
                        'Incident Commander',
                        'Technical Lead',
                        'Communications Lead',
                        'Legal Advisor'
                    ],
                    'responses' => [
                        'Overall incident coordination and decisions',
                        'Technical investigation and remediation',
                        'Internal and external messaging',
                        'Regulatory compliance and legal guidance'
                    ]
                ],
                'correct_options' => [
                    'Incident Commander' => 'Overall incident coordination and decisions',
                    'Technical Lead' => 'Technical investigation and remediation',
                    'Communications Lead' => 'Internal and external messaging',
                    'Legal Advisor' => 'Regulatory compliance and legal guidance'
                ],
                'justifications' => [
                    'Incident Commander' => 'Manages overall response effort',
                    'Technical Lead' => 'Leads technical analysis and containment',
                    'Communications Lead' => 'Manages all incident communications',
                    'Legal Advisor' => 'Ensures legal requirements are met'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Lessons Learned Process - Item 35
            [
                'topic_id' => $topics['Root-Cause & Post-Incident Analysis'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Who should participate in the post-incident lessons learned meeting?',
                'options' => [
                    'Only the security team',
                    'All stakeholders involved in the incident response',
                    'Only senior management',
                    'External auditors only'
                ],
                'correct_options' => ['All stakeholders involved in the incident response'],
                'justifications' => [
                    'Limited perspective misses important insights',
                    'Correct - All participants can contribute valuable observations',
                    'Management wasn\'t involved in technical response',
                    'External view is valuable but insufficient alone'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Complex Incident Scenario - Item 36
            [
                'topic_id' => $topics['Incident Response Phases'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During incident response, the team discovers the attacker has been present for 6 months. What additional phase becomes critical?',
                'options' => [
                    'Immediate system rebuild',
                    'Scoping to identify all compromised systems',
                    'Public announcement',
                    'Password reset for all users'
                ],
                'correct_options' => ['Scoping to identify all compromised systems'],
                'justifications' => [
                    'Rebuilding before understanding scope may miss compromised systems',
                    'Correct - Long dwell time requires comprehensive scope assessment',
                    'Public announcement comes after full understanding',
                    'May be needed but scoping comes first'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Evidence Types - Item 37
            [
                'topic_id' => $topics['Forensic Investigation'] ?? 4,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the types of evidence that would be most useful for investigating a data exfiltration incident to the drop zone:',
                'options' => [
                    'Network flow logs',
                    'Building access card logs',
                    'DNS query logs',
                    'Cafeteria purchase records',
                    'Firewall logs',
                    'Employee satisfaction surveys',
                    'Data access audit logs',
                    'Parking lot camera footage'
                ],
                'correct_options' => [
                    'Network flow logs',
                    'DNS query logs',
                    'Firewall logs',
                    'Data access audit logs'
                ],
                'justifications' => [
                    'Shows data volume and destination',
                    'Physical access less relevant for data theft',
                    'May show C2 or exfiltration domains',
                    'Not relevant to data exfiltration',
                    'Shows outbound connections and data transfers',
                    'Not relevant to technical investigation',
                    'Shows who accessed the stolen data',
                    'Unlikely to provide digital evidence'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Chain of Custody Scenarios - Item 38
            [
                'topic_id' => $topics['Evidence Handling & Chain of Custody'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** If evidence is stored in a locked safe, chain of custody documentation is not necessary.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Physical security does not replace chain of custody documentation. Even with secure storage, you must document every access, transfer, and handling of evidence. Chain of custody provides the audit trail proving evidence integrity, regardless of storage security.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Regulatory Notification Matrix - Item 39
            [
                'topic_id' => $topics['Reporting & Communication (Breach Notice)'] ?? 3,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each regulation with its breach notification timeline:',
                'options' => [
                    'items' => [
                        'GDPR',
                        'HIPAA',
                        'PCI DSS',
                        'State breach laws (typical)'
                    ],
                    'responses' => [
                        '72 hours to authorities',
                        '60 days to individuals',
                        'Immediately to card brands',
                        'Without unreasonable delay'
                    ]
                ],
                'correct_options' => [
                    'GDPR' => '72 hours to authorities',
                    'HIPAA' => '60 days to individuals',
                    'PCI DSS' => 'Immediately to card brands',
                    'State breach laws (typical)' => 'Without unreasonable delay'
                ],
                'justifications' => [
                    'GDPR' => 'GDPR requires 72-hour notification to supervisory authority',
                    'HIPAA' => 'HIPAA allows up to 60 days for individual notification',
                    'PCI DSS' => 'PCI requires immediate notification to card brands',
                    'State breach laws (typical)' => 'Most state laws use "reasonable" timeline language'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Incident Response Tabletop - Item 40
            [
                'topic_id' => $topics['Playbooks & Runbooks'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During a tabletop exercise, what should be the primary focus?',
                'options' => [
                    'Testing technical tools and systems',
                    'Evaluating decision-making and communication processes',
                    'Measuring system performance',
                    'Training new employees'
                ],
                'correct_options' => ['Evaluating decision-making and communication processes'],
                'justifications' => [
                    'Tabletops are discussion-based, not technical tests',
                    'Correct - Tabletops test procedures, roles, and communication',
                    'No actual systems are involved in tabletops',
                    'Training is a benefit but not primary focus'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Advanced Forensics Scenario - Item 41
            [
                'topic_id' => $topics['Digital Forensics Tools & Order of Volatility'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A forensic analyst finds anti-forensics techniques were used (log deletion, timestamp modification). What is the BEST response?',
                'options' => [
                    'Give up as evidence is compromised',
                    'Look for additional evidence sources and artifact inconsistencies',
                    'Only report what intact evidence shows',
                    'Recreate the deleted evidence'
                ],
                'correct_options' => ['Look for additional evidence sources and artifact inconsistencies'],
                'justifications' => [
                    'Anti-forensics doesn\'t eliminate all evidence',
                    'Correct - Multiple sources and timeline analysis can reveal tampering',
                    'Should document evidence of anti-forensics activities',
                    'Never fabricate evidence'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Incident Documentation - Item 42
            [
                'topic_id' => $topics['Root-Cause & Post-Incident Analysis'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should be included in the final incident report? (Select all that apply)',
                'options' => [
                    'Timeline of events',
                    'Actions taken',
                    'Names of all involved personnel for blame',
                    'Root cause analysis',
                    'Personal opinions about the incident',
                    'Recommendations for improvement',
                    'Cost and impact assessment',
                    'Speculation about attacker identity'
                ],
                'correct_options' => [
                    'Timeline of events',
                    'Actions taken',
                    'Root cause analysis',
                    'Recommendations for improvement',
                    'Cost and impact assessment'
                ],
                'justifications' => [
                    'Correct - Essential for understanding incident flow',
                    'Correct - Documents the response effort',
                    'Focus on facts and improvement, not blame',
                    'Correct - Identifies underlying issues',
                    'Reports should be factual, not opinion-based',
                    'Correct - Drives security improvements',
                    'Correct - Justifies security investments',
                    'Attribution speculation doesn\'t belong in reports'
                ],
                'settings' => ['isMultiSelect' => true],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Incident Response Team Communication - Item 43 (NEW)
            [
                'topic_id' => $topics['Incident Response Phases'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'You are the incident commander during a major breach. The technical team reports conflicting findings while executives demand immediate answers. How should you handle this situation?',
                'options' => [
                    'Provide the executives with the first technical finding to buy time',
                    'Tell executives to wait until technical analysis is complete',
                    'Acknowledge uncertainty, provide known facts, and establish next update timeline',
                    'Escalate the decision to the CEO immediately'
                ],
                'correct_options' => ['Acknowledge uncertainty, provide known facts, and establish next update timeline'],
                'justifications' => [
                    'Premature information can lead to wrong decisions',
                    'Executives need some information to make informed decisions',
                    'Correct - Transparent communication with clear next steps maintains confidence',
                    'Incident commander should manage the situation first'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Forensic Evidence Prioritization - Item 44 (NEW)
            [
                'topic_id' => $topics['Forensic Investigation'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During investigation, you discover the attacker used stolen administrative credentials to access multiple systems over 3 months. Which forensic analysis approach provides the most comprehensive understanding?',
                'options' => [
                    'Focus only on the most recent attack activities',
                    'Analyze the complete timeline across all affected systems simultaneously',
                    'Start with the entry point and follow the attack path chronologically',
                    'Randomly sample different time periods for analysis'
                ],
                'correct_options' => ['Analyze the complete timeline across all affected systems simultaneously'],
                'justifications' => [
                    'Recent activities miss the full scope of compromise',
                    'Correct - Comprehensive timeline reveals full attack scope and techniques',
                    'Sequential analysis may miss parallel attack activities',
                    'Random sampling misses critical connections'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Incident Response Metrics Analysis - Item 45 (NEW)
            [
                'topic_id' => $topics['Root-Cause & Post-Incident Analysis'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your organization\'s mean time to detect (MTTD) incidents is 45 days while industry average is 7 days. Which factor would have the GREATEST impact on improving this metric?',
                'options' => [
                    'Implementing additional security awareness training',
                    'Deploying behavioral analytics and user entity monitoring',
                    'Hiring more incident response staff',
                    'Updating incident response playbooks'
                ],
                'correct_options' => ['Deploying behavioral analytics and user entity monitoring'],
                'justifications' => [
                    'Training helps prevention but doesn\'t improve detection speed',
                    'Correct - Advanced detection capabilities directly reduce time to identify anomalies',
                    'More staff helps response but not initial detection',
                    'Better playbooks improve response efficiency, not detection speed'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Legal and Regulatory Compliance Analysis - Item 46 (NEW)
            [
                'topic_id' => $topics['Reporting & Communication (Breach Notice)'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'A healthcare organization suffers a breach affecting both HIPAA-covered health records and European customer data. How should notification priorities be determined?',
                'options' => [
                    'HIPAA requirements take precedence as it\'s a healthcare organization',
                    'GDPR requirements are stricter and should be followed for all data',
                    'Apply the most stringent requirements from each regulation to their respective data types',
                    'Choose whichever regulation has the longest notification timeline'
                ],
                'correct_options' => ['Apply the most stringent requirements from each regulation to their respective data types'],
                'justifications' => [
                    'Industry type doesn\'t determine which regulation takes precedence',
                    'GDPR doesn\'t apply to non-EU personal data',
                    'Correct - Each regulation applies to its covered data with its own requirements',
                    'Compliance requires meeting all applicable requirements, not just the easiest'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Advanced Chain of Custody - Item 47 (NEW)
            [
                'topic_id' => $topics['Evidence Handling & Chain of Custody'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'During a cross-border investigation, evidence must be transferred from your US facility to law enforcement in the UK. What additional considerations apply beyond standard chain of custody?',
                'options' => [
                    'Standard chain of custody is sufficient for international transfers',
                    'Mutual Legal Assistance Treaties (MLAT) and export control regulations',
                    'Only encryption of evidence during transit',
                    'Obtaining approval from both countries\' supreme courts'
                ],
                'correct_options' => ['Mutual Legal Assistance Treaties (MLAT) and export control regulations'],
                'justifications' => [
                    'International transfers have additional legal complexities',
                    'Correct - Cross-border transfers require treaty frameworks and export compliance',
                    'Encryption helps but doesn\'t address legal requirements',
                    'Supreme court approval is not typically required for evidence transfer'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Incident Response Resource Allocation - Item 48 (NEW)
            [
                'topic_id' => $topics['Incident Response Phases'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Your organization faces simultaneous incidents: a confirmed data breach, a suspected APT presence, and a ransomware attack on non-critical systems. How should resources be allocated?',
                'options' => [
                    'Equal resources to all three incidents',
                    'Priority: Ransomware > Data breach > APT (based on immediate visibility)',
                    'Priority: Data breach > APT > Ransomware (based on regulatory/business impact)',
                    'Handle incidents sequentially in order of discovery'
                ],
                'correct_options' => ['Priority: Data breach > APT > Ransomware (based on regulatory/business impact)'],
                'justifications' => [
                    'Equal allocation doesn\'t account for varying business impacts',
                    'Immediate visibility doesn\'t equal business priority',
                    'Correct - Business impact and regulatory requirements should drive prioritization',
                    'Discovery order doesn\'t reflect incident severity or impact'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Forensic Tool Validation - Item 49 (NEW)
            [
                'topic_id' => $topics['Digital Forensics Tools & Order of Volatility'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Before using a new forensic tool in a legal investigation, what validation steps are most critical for ensuring evidence admissibility?',
                'options' => [
                    'Verify the tool is included in NIST computer forensics tool testing program',
                    'Test tool accuracy, document validation process, and maintain version control',
                    'Ensure the tool is the most expensive option available',
                    'Confirm the tool is used by other organizations in your industry'
                ],
                'correct_options' => ['Test tool accuracy, document validation process, and maintain version control'],
                'justifications' => [
                    'NIST testing is valuable but not comprehensive for all tools',
                    'Correct - Daubert standards require demonstrable accuracy and documented methodology',
                    'Cost doesn\'t determine forensic reliability or legal acceptance',
                    'Industry usage doesn\'t guarantee tool accuracy or legal admissibility'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Incident Response Effectiveness Evaluation - Item 50 (NEW)
            [
                'topic_id' => $topics['Root-Cause & Post-Incident Analysis'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Six months after implementing incident response improvements, your organization experiences a similar attack type. The response time improved but the business impact was worse. How should this be evaluated?',
                'options' => [
                    'The response improvement proves the changes were successful',
                    'Focus only on the metrics that improved',
                    'Analyze both response efficiency and business protection effectiveness',
                    'Conclude that the improvements were ineffective'
                ],
                'correct_options' => ['Analyze both response efficiency and business protection effectiveness'],
                'justifications' => [
                    'Response time improvement alone doesn\'t indicate overall success',
                    'Partial analysis misses critical aspects of incident response effectiveness',
                    'Correct - Holistic evaluation considers both operational efficiency and business outcomes',
                    'Dismissing improvements ignores valuable progress in response capabilities'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 19 (Incident Management & Forensics) diagnostic items seeded successfully!');
    }
}