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
            $query->where('name', 'Incident Management');
        })->pluck('id', 'name');
        
        
        $items = [
            // Preparation - Item 1
            [
                'topic_id' => $topics['Preparation'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which component is most critical during the Preparation phase of incident response?',
                'options' => [
                    'Installing forensic tools',
                    'Establishing incident response policies and procedures',
                    'Creating network diagrams',
                    'Training only technical staff'
                ],
                'correct_options' => ['Establishing incident response policies and procedures'],
                'justifications' => [
                    'Tools are important but not the foundation',
                    'Correct - Policies and procedures form the foundation of effective incident response',
                    'Documentation is helpful but not the most critical',
                    'All staff need training, not just technical'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Preparation - Item 2
            [
                'topic_id' => $topics['Preparation'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of incident response playbooks?',
                'options' => [
                    'To replace human decision-making',
                    'To provide standardized procedures for common incidents',
                    'To document all possible security threats',
                    'To automate incident response completely'
                ],
                'correct_options' => ['To provide standardized procedures for common incidents'],
                'justifications' => [
                    'Playbooks guide but don\'t replace human judgment',
                    'Correct - Playbooks ensure consistent, repeatable responses',
                    'Threat documentation is separate from response procedures',
                    'Full automation isn\'t always possible or advisable'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Preparation - Item 3
            [
                'topic_id' => $topics['Preparation'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => 'During incident response preparation, establishing communication channels is essential.',
                'correct_options' => ['True'],
                'justifications' => [
                    'Correct - Clear communication channels are vital for coordinated incident response',
                    'Wrong - Communication planning is a critical preparation activity'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Preparation - Item 4
            [
                'topic_id' => $topics['Preparation'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which tools should be prepared in advance for incident response?',
                'options' => [
                    'Only network monitoring tools',
                    'Forensic imaging, analysis tools, and clean OS media',
                    'Just antivirus software',
                    'Only backup restoration tools'
                ],
                'correct_options' => ['Forensic imaging, analysis tools, and clean OS media'],
                'justifications' => [
                    'Network monitoring alone is insufficient',
                    'Correct - Comprehensive forensic toolkit enables effective response',
                    'Antivirus is reactive, not comprehensive',
                    'Backups are important but not the complete toolkit'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Preparation - Item 5
            [
                'topic_id' => $topics['Preparation'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What frequency is recommended for incident response training and exercises?',
                'options' => [
                    'Once per year only',
                    'Quarterly exercises with annual comprehensive training',
                    'Only when new staff join',
                    'After each major incident'
                ],
                'correct_options' => ['Quarterly exercises with annual comprehensive training'],
                'justifications' => [
                    'Annual only is insufficient for skill retention',
                    'Correct - Regular practice maintains readiness and identifies gaps',
                    'New staff training alone doesn\'t maintain team skills',
                    'Reactive training doesn\'t prevent incidents'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Preparation - Item 6
            [
                'topic_id' => $topics['Preparation'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => 'Legal and regulatory notification requirements should be defined during preparation.',
                'correct_options' => ['True'],
                'justifications' => [
                    'Correct - Pre-planning notification requirements enables timely compliance',
                    'Wrong - Understanding legal obligations is essential preparation'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Preparation - Item 7
            [
                'topic_id' => $topics['Preparation'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which stakeholder roles should be clearly defined during incident response preparation?',
                'options' => [
                    'Only IT security team members',
                    'Incident commander, communications lead, technical leads, legal counsel',
                    'Just the CISO and CTO',
                    'Only external law enforcement contacts'
                ],
                'correct_options' => ['Incident commander, communications lead, technical leads, legal counsel'],
                'justifications' => [
                    'IT security alone cannot handle all incident aspects',
                    'Correct - Cross-functional team ensures comprehensive response',
                    'Senior leadership alone cannot execute detailed response',
                    'External contacts are important but internal roles are primary'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Preparation - Item 8
            [
                'topic_id' => $topics['Preparation'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Arrange the incident response preparation activities in logical order:',
                'options' => [
                    'Develop policies',
                    'Train staff',
                    'Test procedures',
                    'Deploy tools'
                ],
                'correct_options' => ['Develop policies', 'Deploy tools', 'Train staff', 'Test procedures'],
                'justifications' => [
                    'Policies provide the foundation',
                    'Tools enable the procedures',
                    'Training builds capability',
                    'Testing validates readiness'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Preparation - Item 9
            [
                'topic_id' => $topics['Preparation'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Baseline system configurations should be documented before incidents occur.',
                'correct_options' => ['True'],
                'justifications' => [
                    'Correct - Baselines help identify anomalies and guide restoration',
                    'Wrong - Pre-incident baselines are essential for effective response'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Preparation - Item 10
            [
                'topic_id' => $topics['Preparation'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should be included in incident response contact lists?',
                'options' => [
                    'Only internal IT contacts',
                    'Internal teams, vendors, law enforcement, legal counsel, and media contacts',
                    'Just executive management',
                    'Only law enforcement agencies'
                ],
                'correct_options' => ['Internal teams, vendors, law enforcement, legal counsel, and media contacts'],
                'justifications' => [
                    'Internal IT alone cannot handle all incident aspects',
                    'Correct - Comprehensive contact list enables full response capability',
                    'Management is important but insufficient',
                    'Law enforcement is one component of broader response'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Detection, Triage & Analysis - Item 11
            [
                'topic_id' => $topics['Detection, Triage & Analysis'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary goal of incident triage?',
                'options' => [
                    'To immediately resolve the incident',
                    'To prioritize incidents based on severity and impact',
                    'To assign blame for the incident',
                    'To document all incident details'
                ],
                'correct_options' => ['To prioritize incidents based on severity and impact'],
                'justifications' => [
                    'Resolution comes after proper assessment',
                    'Correct - Triage ensures resources focus on highest-priority incidents',
                    'Blame assignment is not part of triage',
                    'Documentation is important but not the primary triage goal'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Detection, Triage & Analysis - Item 12
            [
                'topic_id' => $topics['Detection, Triage & Analysis'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which factor is most critical when determining incident severity during triage?',
                'options' => [
                    'Time of day when incident occurred',
                    'Number of people who reported it',
                    'Business impact and scope of affected systems',
                    'Experience level of the analyst'
                ],
                'correct_options' => ['Business impact and scope of affected systems'],
                'justifications' => [
                    'Time of day affects response but not severity assessment',
                    'Number of reporters may indicate scale but not business impact',
                    'Correct - Business impact determines incident priority and resource allocation',
                    'Analyst experience affects response quality but not incident severity'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Detection, Triage & Analysis - Item 13
            [
                'topic_id' => $topics['Detection, Triage & Analysis'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the correct order of volatility for memory forensics collection?',
                'options' => [
                    'Hard disk → RAM → Network traffic → Registry',
                    'CPU registers → RAM → Swap files → Hard disk',
                    'Network logs → System logs → RAM → Hard disk',
                    'Registry → RAM → Hard disk → Archive media'
                ],
                'correct_options' => ['CPU registers → RAM → Swap files → Hard disk'],
                'justifications' => [
                    'Incorrect order - starts with persistent storage',
                    'Correct - Follows order of volatility from most to least volatile',
                    'Logs are important but not the complete volatility order',
                    'Registry is less volatile than RAM'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Detection, Triage & Analysis - Item 14
            [
                'topic_id' => $topics['Detection, Triage & Analysis'] ?? 2,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Initial incident analysis should focus on containment over evidence preservation.',
                'correct_options' => ['False'],
                'justifications' => [
                    'Wrong - Both containment and evidence preservation must be balanced',
                    'Correct - Evidence preservation is critical; containment must not destroy evidence'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Detection, Triage & Analysis - Item 15
            [
                'topic_id' => $topics['Detection, Triage & Analysis'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which forensic tool characteristic is most important during initial analysis?',
                'options' => [
                    'User-friendly interface',
                    'Low cost',
                    'Write-blocking capability',
                    'Advanced reporting features'
                ],
                'correct_options' => ['Write-blocking capability'],
                'justifications' => [
                    'Interface is helpful but not most critical',
                    'Cost is a factor but not most important for evidence integrity',
                    'Correct - Write-blocking prevents evidence contamination during analysis',
                    'Reporting is valuable but evidence integrity comes first'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Detection, Triage & Analysis - Item 16
            [
                'topic_id' => $topics['Detection, Triage & Analysis'] ?? 2,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Match each analysis phase with its primary objective:',
                'options' => [
                    'Initial triage',
                    'Detailed analysis',
                    'Root cause analysis',
                    'Timeline reconstruction'
                ],
                'sub_options' => [
                    'Determine how the incident occurred',
                    'Establish sequence of events',
                    'Assess severity and priority',
                    'Examine evidence in depth'
                ],
                'correct_options' => [
                    'Initial triage → Assess severity and priority',
                    'Detailed analysis → Examine evidence in depth',
                    'Root cause analysis → Determine how the incident occurred',
                    'Timeline reconstruction → Establish sequence of events'
                ],
                'justifications' => [
                    'Triage focuses on prioritization',
                    'Detailed analysis examines evidence thoroughly',
                    'Root cause analysis identifies the how',
                    'Timeline reconstruction shows sequence'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Detection, Triage & Analysis - Item 17
            [
                'topic_id' => $topics['Detection, Triage & Analysis'] ?? 2,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Network-based evidence is more volatile than host-based evidence.',
                'correct_options' => ['True'],
                'justifications' => [
                    'Correct - Network traffic is transient while host data may persist',
                    'Wrong - Network traffic is more ephemeral than stored host data'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Detection, Triage & Analysis - Item 18
            [
                'topic_id' => $topics['Detection, Triage & Analysis'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'During incident analysis, what should be the priority when live system analysis is required?',
                'options' => [
                    'Minimize system downtime',
                    'Preserve evidence integrity while gathering data',
                    'Complete analysis as quickly as possible',
                    'Focus only on identifying the attacker'
                ],
                'correct_options' => ['Preserve evidence integrity while gathering data'],
                'justifications' => [
                    'Uptime is important but evidence integrity is critical',
                    'Correct - Evidence integrity ensures forensic findings are legally defensible',
                    'Speed shouldn\'t compromise evidence quality',
                    'Attribution is important but evidence integrity comes first'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Detection, Triage & Analysis - Item 19
            [
                'topic_id' => $topics['Detection, Triage & Analysis'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Who should typically perform the initial incident triage?',
                'options' => [
                    'Only senior security analysts',
                    'Trained SOC analysts following established procedures',
                    'System administrators',
                    'External forensic consultants'
                ],
                'correct_options' => ['Trained SOC analysts following established procedures'],
                'justifications' => [
                    'Senior analysts are valuable but not always immediately available',
                    'Correct - SOC analysts are trained for rapid initial assessment',
                    'System admins may lack security incident training',
                    'External consultants aren\'t available for immediate triage'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Detection, Triage & Analysis - Item 20
            [
                'topic_id' => $topics['Detection, Triage & Analysis'] ?? 2,
                'type_id' => 5,
                'dimension' => 'Technical',
                'content' => 'Arrange forensic collection activities in correct order of volatility (most to least volatile):',
                'options' => [
                    'Network connections',
                    'System memory',
                    'Temporary files',
                    'Registry data',
                    'Hard disk files'
                ],
                'correct_options' => ['System memory', 'Network connections', 'Temporary files', 'Registry data', 'Hard disk files'],
                'justifications' => [
                    'Memory is most volatile - lost on power off',
                    'Network state changes rapidly',
                    'Temp files may be deleted but persist longer than memory',
                    'Registry persists but can be modified',
                    'Hard disk files are least volatile'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Containment - Item 21
            [
                'topic_id' => $topics['Containment'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary goal of incident containment?',
                'options' => [
                    'To identify the root cause',
                    'To prevent further damage while preserving evidence',
                    'To restore normal operations immediately',
                    'To identify the attacker'
                ],
                'correct_options' => ['To prevent further damage while preserving evidence'],
                'justifications' => [
                    'Root cause identification comes in later phases',
                    'Correct - Containment balances stopping damage with preserving evidence',
                    'Full restoration comes after containment and eradication',
                    'Attribution is important but not the primary containment goal'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Containment - Item 22
            [
                'topic_id' => $topics['Containment'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which containment strategy is most appropriate for a critical production system under attack?',
                'options' => [
                    'Immediate shutdown of the system',
                    'Isolate the system from the network while maintaining monitoring',
                    'Leave system running with no changes',
                    'Only disable user accounts'
                ],
                'correct_options' => ['Isolate the system from the network while maintaining monitoring'],
                'justifications' => [
                    'Immediate shutdown may destroy volatile evidence',
                    'Correct - Network isolation prevents spread while preserving evidence and enabling monitoring',
                    'No action allows continued damage',
                    'Account disabling alone may not stop the attack'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Containment - Item 23
            [
                'topic_id' => $topics['Containment'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Evidence preservation requirements should be ignored during urgent containment activities.',
                'correct_options' => ['False'],
                'justifications' => [
                    'Wrong - Evidence preservation is critical even during urgent response',
                    'Correct - Containment must balance urgency with evidence preservation for legal proceedings'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Containment - Item 24
            [
                'topic_id' => $topics['Containment'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Who should make containment decisions for critical business systems?',
                'options' => [
                    'Any available IT staff member',
                    'Incident commander in consultation with business stakeholders',
                    'Only the CISO',
                    'External law enforcement'
                ],
                'correct_options' => ['Incident commander in consultation with business stakeholders'],
                'justifications' => [
                    'IT staff may lack business impact understanding',
                    'Correct - Incident commander coordinates with business to balance security and operations',
                    'CISO alone may not understand immediate business needs',
                    'Law enforcement lacks business context for operational decisions'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Containment - Item 25
            [
                'topic_id' => $topics['Containment'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What should be documented during containment activities?',
                'options' => [
                    'Only the final containment state',
                    'All actions taken, evidence preserved, and business impact',
                    'Just the time containment was completed',
                    'Only technical configuration changes'
                ],
                'correct_options' => ['All actions taken, evidence preserved, and business impact'],
                'justifications' => [
                    'Final state documentation is insufficient',
                    'Correct - Comprehensive documentation supports investigation and legal proceedings',
                    'Timeline alone doesn\'t provide complete context',
                    'Technical changes are important but incomplete'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Containment - Item 26
            [
                'topic_id' => $topics['Containment'] ?? 3,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Arrange containment actions in recommended order:',
                'options' => [
                    'Assess business impact',
                    'Implement isolation measures',
                    'Document current state',
                    'Notify stakeholders'
                ],
                'correct_options' => ['Document current state', 'Assess business impact', 'Notify stakeholders', 'Implement isolation measures'],
                'justifications' => [
                    'Document before changing anything',
                    'Understand impact before action',
                    'Communicate before major changes',
                    'Implement after planning'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Containment - Item 27
            [
                'topic_id' => $topics['Containment'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Physical isolation is always preferable to logical isolation during containment.',
                'correct_options' => ['False'],
                'justifications' => [
                    'Wrong - Physical isolation may not always be practical or necessary',
                    'Correct - Containment method should match the threat and business requirements'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Containment - Item 28
            [
                'topic_id' => $topics['Containment'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'When should evidence imaging occur during containment?',
                'options' => [
                    'Only after containment is complete',
                    'Before implementing containment measures when possible',
                    'Evidence imaging is not needed during containment',
                    'Only if law enforcement is involved'
                ],
                'correct_options' => ['Before implementing containment measures when possible'],
                'justifications' => [
                    'Waiting may result in evidence loss',
                    'Correct - Image before containment actions that might alter evidence',
                    'Evidence preservation is always important',
                    'Internal investigations also need evidence'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Containment - Item 29
            [
                'topic_id' => $topics['Containment'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the most important consideration when containing an incident in a 24/7 operation?',
                'options' => [
                    'Minimizing containment costs',
                    'Balancing security needs with business continuity',
                    'Completing containment as quickly as possible',
                    'Avoiding any business disruption'
                ],
                'correct_options' => ['Balancing security needs with business continuity'],
                'justifications' => [
                    'Cost is important but not the primary consideration',
                    'Correct - Critical operations require balanced approach to maintain service',
                    'Speed shouldn\'t compromise business operations',
                    'Some disruption may be necessary for effective containment'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Containment - Item 30
            [
                'topic_id' => $topics['Containment'] ?? 3,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Match each containment method with its appropriate scenario:',
                'options' => [
                    'Network isolation',
                    'Account disabling',
                    'System shutdown',
                    'Process termination'
                ],
                'sub_options' => [
                    'Compromised user credentials',
                    'Lateral movement in progress',
                    'Malicious process running',
                    'Data destruction imminent'
                ],
                'correct_options' => [
                    'Network isolation → Lateral movement in progress',
                    'Account disabling → Compromised user credentials',
                    'System shutdown → Data destruction imminent',
                    'Process termination → Malicious process running'
                ],
                'justifications' => [
                    'Network isolation stops lateral movement',
                    'Account disabling prevents credential abuse',
                    'Shutdown prevents data destruction',
                    'Process termination stops malicious activity'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Eradication & Recovery - Item 31
            [
                'topic_id' => $topics['Eradication & Recovery'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the primary goal of the eradication phase?',
                'options' => [
                    'To restore systems to normal operation',
                    'To completely remove threats and vulnerabilities from the environment',
                    'To identify the attack vector',
                    'To implement new security controls'
                ],
                'correct_options' => ['To completely remove threats and vulnerabilities from the environment'],
                'justifications' => [
                    'Restoration is the recovery phase goal',
                    'Correct - Eradication eliminates threats and underlying vulnerabilities',
                    'Attack vector identification occurs during analysis',
                    'New controls are part of improvement, not eradication'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Eradication & Recovery - Item 32
            [
                'topic_id' => $topics['Eradication & Recovery'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'Which activity is most critical before beginning system recovery?',
                'options' => [
                    'Updating incident documentation',
                    'Verifying complete threat eradication',
                    'Notifying all users of the incident',
                    'Conducting vulnerability scans'
                ],
                'correct_options' => ['Verifying complete threat eradication'],
                'justifications' => [
                    'Documentation is important but not the priority before recovery',
                    'Correct - Recovery without complete eradication risks reinfection',
                    'User notification timing depends on communication strategy',
                    'Vulnerability scans are part of verification but not the complete picture'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Eradication & Recovery - Item 33
            [
                'topic_id' => $topics['Eradication & Recovery'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Systems should be restored from backups before threat eradication is confirmed.',
                'correct_options' => ['False'],
                'justifications' => [
                    'Wrong - Restoration before eradication risks reinfection',
                    'Correct - Complete eradication must be verified before safe restoration'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Eradication & Recovery - Item 34
            [
                'topic_id' => $topics['Eradication & Recovery'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What should be done with potentially infected backup media during recovery?',
                'options' => [
                    'Use backups immediately to restore operations',
                    'Scan backups for threats before restoration',
                    'Discard all backups as potentially compromised',
                    'Only use the most recent backup'
                ],
                'correct_options' => ['Scan backups for threats before restoration'],
                'justifications' => [
                    'Immediate use risks reintroducing threats',
                    'Correct - Backup validation prevents reinfection during recovery',
                    'Discarding all backups may be unnecessary if older backups are clean',
                    'Recent backups are most likely to be infected'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Eradication & Recovery - Item 35
            [
                'topic_id' => $topics['Eradication & Recovery'] ?? 4,
                'type_id' => 3,
                'dimension' => 'Technical',
                'content' => 'Arrange recovery activities in recommended order:',
                'options' => [
                    'Restore from clean backups',
                    'Apply security patches',
                    'Validate system functionality',
                    'Return to normal monitoring'
                ],
                'correct_options' => ['Restore from clean backups', 'Apply security patches', 'Validate system functionality', 'Return to normal monitoring'],
                'justifications' => [
                    'Clean restoration provides the foundation',
                    'Patches prevent reinfection',
                    'Validation ensures proper function',
                    'Normal monitoring resumes after validation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Eradication & Recovery - Item 36
            [
                'topic_id' => $topics['Eradication & Recovery'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Who should authorize the return to normal operations after recovery?',
                'options' => [
                    'IT operations team',
                    'Incident commander after validation and business stakeholder approval',
                    'System administrators',
                    'External auditors'
                ],
                'correct_options' => ['Incident commander after validation and business stakeholder approval'],
                'justifications' => [
                    'IT operations executes but shouldn\'t authorize alone',
                    'Correct - Incident commander coordinates validation with business approval',
                    'System admins implement but don\'t have authority to authorize',
                    'External auditors may validate but don\'t authorize operations'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Eradication & Recovery - Item 37
            [
                'topic_id' => $topics['Eradication & Recovery'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Technical',
                'content' => 'Enhanced monitoring should continue for an extended period after recovery.',
                'correct_options' => ['True'],
                'justifications' => [
                    'Correct - Enhanced monitoring helps detect any residual threats or reinfection',
                    'Wrong - Normal monitoring alone may miss subtle signs of incomplete eradication'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Eradication & Recovery - Item 38
            [
                'topic_id' => $topics['Eradication & Recovery'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Technical',
                'content' => 'What is the most reliable method to ensure complete malware eradication?',
                'options' => [
                    'Running multiple antivirus scans',
                    'Rebuilding systems from known-good media',
                    'Applying all available security patches',
                    'Changing all passwords'
                ],
                'correct_options' => ['Rebuilding systems from known-good media'],
                'justifications' => [
                    'Antivirus may miss sophisticated threats',
                    'Correct - Complete rebuild ensures no malware persistence',
                    'Patches prevent reinfection but don\'t remove existing threats',
                    'Password changes prevent credential abuse but don\'t remove malware'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Eradication & Recovery - Item 39
            [
                'topic_id' => $topics['Eradication & Recovery'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should guide the priority order for system recovery?',
                'options' => [
                    'Alphabetical order of system names',
                    'Business criticality and dependencies',
                    'Size of the systems',
                    'Age of the systems'
                ],
                'correct_options' => ['Business criticality and dependencies'],
                'justifications' => [
                    'Alphabetical order ignores business importance',
                    'Correct - Business priority ensures critical functions resume first',
                    'System size doesn\'t indicate business importance',
                    'System age doesn\'t determine business priority'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Eradication & Recovery - Item 40
            [
                'topic_id' => $topics['Eradication & Recovery'] ?? 4,
                'type_id' => 4,
                'dimension' => 'Technical',
                'content' => 'Match each recovery validation method with its primary purpose:',
                'options' => [
                    'Vulnerability scanning',
                    'Penetration testing',
                    'Log analysis',
                    'User acceptance testing'
                ],
                'sub_options' => [
                    'Verify business functionality',
                    'Confirm no persistent threats',
                    'Identify remaining vulnerabilities',
                    'Validate security controls'
                ],
                'correct_options' => [
                    'Vulnerability scanning → Identify remaining vulnerabilities',
                    'Penetration testing → Validate security controls',
                    'Log analysis → Confirm no persistent threats',
                    'User acceptance testing → Verify business functionality'
                ],
                'justifications' => [
                    'Vulnerability scanning identifies weaknesses',
                    'Penetration testing validates defenses',
                    'Log analysis reveals threat activity',
                    'User testing confirms functionality'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Post-Incident Activity - Item 41
            [
                'topic_id' => $topics['Post-Incident Activity'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of post-incident analysis?',
                'options' => [
                    'To assign blame for the incident',
                    'To identify lessons learned and improve incident response',
                    'To calculate the cost of the incident',
                    'To satisfy compliance requirements only'
                ],
                'correct_options' => ['To identify lessons learned and improve incident response'],
                'justifications' => [
                    'Blame assignment discourages reporting and learning',
                    'Correct - Post-incident analysis drives continuous improvement',
                    'Cost calculation is important but not the primary purpose',
                    'Compliance is one benefit but not the main goal'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Post-Incident Activity - Item 42
            [
                'topic_id' => $topics['Post-Incident Activity'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When should the post-incident review meeting be conducted?',
                'options' => [
                    'Immediately after containment',
                    'Within days to weeks after recovery completion',
                    'Only if the incident was severe',
                    'At the end of the fiscal year'
                ],
                'correct_options' => ['Within days to weeks after recovery completion'],
                'justifications' => [
                    'Too early - recovery and analysis may be incomplete',
                    'Correct - Allows time for complete analysis while memories are fresh',
                    'All incidents provide learning opportunities',
                    'Too late - details may be forgotten'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Post-Incident Activity - Item 43
            [
                'topic_id' => $topics['Post-Incident Activity'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => 'Post-incident reports should focus on technical details rather than process improvements.',
                'correct_options' => ['False'],
                'justifications' => [
                    'Wrong - Process improvements are crucial for preventing future incidents',
                    'Correct - Both technical and process lessons are important for comprehensive improvement'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Post-Incident Activity - Item 44
            [
                'topic_id' => $topics['Post-Incident Activity'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should be included in regulatory breach notifications?',
                'options' => [
                    'Only the number of affected individuals',
                    'Timeline, scope, impact, and remediation actions taken',
                    'Just the date the breach was discovered',
                    'Only technical details of the attack'
                ],
                'correct_options' => ['Timeline, scope, impact, and remediation actions taken'],
                'justifications' => [
                    'Number affected is important but incomplete',
                    'Correct - Comprehensive information helps regulators assess compliance',
                    'Discovery date alone is insufficient',
                    'Technical details alone don\'t address regulatory concerns'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Post-Incident Activity - Item 45
            [
                'topic_id' => $topics['Post-Incident Activity'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which metric is most valuable for measuring incident response effectiveness?',
                'options' => [
                    'Number of incidents detected',
                    'Mean time to detection and response (MTTD/MTTR)',
                    'Total cost of incident response',
                    'Number of people involved in response'
                ],
                'correct_options' => ['Mean time to detection and response (MTTD/MTTR)'],
                'justifications' => [
                    'Detection numbers don\'t indicate response quality',
                    'Correct - MTTD/MTTR measures response speed and effectiveness',
                    'Cost is important but doesn\'t measure effectiveness',
                    'People count doesn\'t indicate efficiency or effectiveness'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Post-Incident Activity - Item 46
            [
                'topic_id' => $topics['Post-Incident Activity'] ?? 5,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Arrange post-incident activities in recommended order:',
                'options' => [
                    'Document lessons learned',
                    'Update incident response procedures',
                    'Conduct post-incident review meeting',
                    'Submit regulatory notifications'
                ],
                'correct_options' => ['Submit regulatory notifications', 'Conduct post-incident review meeting', 'Document lessons learned', 'Update incident response procedures'],
                'justifications' => [
                    'Regulatory notifications have time requirements',
                    'Review meeting gathers stakeholder input',
                    'Documentation captures insights',
                    'Procedures updated based on lessons'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Post-Incident Activity - Item 47
            [
                'topic_id' => $topics['Post-Incident Activity'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => 'Root cause analysis should identify both technical and human factors.',
                'correct_options' => ['True'],
                'justifications' => [
                    'Correct - Comprehensive root cause analysis addresses all contributing factors',
                    'Wrong - Human factors often contribute significantly to incidents'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],

            // Post-Incident Activity - Item 48
            [
                'topic_id' => $topics['Post-Incident Activity'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the most important outcome of post-incident analysis?',
                'options' => [
                    'Identifying individual responsibility',
                    'Actionable recommendations for improvement',
                    'Detailed technical timeline',
                    'Financial impact assessment'
                ],
                'correct_options' => ['Actionable recommendations for improvement'],
                'justifications' => [
                    'Individual responsibility can discourage learning culture',
                    'Correct - Actionable recommendations drive actual improvements',
                    'Timeline is important but improvement is the goal',
                    'Financial impact is valuable but improvement is primary'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Post-Incident Activity - Item 49
            [
                'topic_id' => $topics['Post-Incident Activity'] ?? 5,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Match each post-incident document type with its primary audience:',
                'options' => [
                    'Executive summary',
                    'Technical report',
                    'Regulatory notification',
                    'Lessons learned document'
                ],
                'sub_options' => [
                    'Incident response team',
                    'Senior management',
                    'Government agencies',
                    'Technical staff'
                ],
                'correct_options' => [
                    'Executive summary → Senior management',
                    'Technical report → Technical staff',
                    'Regulatory notification → Government agencies',
                    'Lessons learned document → Incident response team'
                ],
                'justifications' => [
                    'Executives need high-level impact summary',
                    'Technical staff need detailed implementation details',
                    'Regulators require compliance information',
                    'Response team needs operational improvements'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Post-Incident Activity - Item 50
            [
                'topic_id' => $topics['Post-Incident Activity'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How should post-incident improvements be tracked and validated?',
                'options' => [
                    'Document them and assume implementation',
                    'Assign owners, set deadlines, and verify completion',
                    'Include them in the next annual review',
                    'Leave implementation to individual discretion'
                ],
                'correct_options' => ['Assign owners, set deadlines, and verify completion'],
                'justifications' => [
                    'Documentation without tracking doesn\'t ensure implementation',
                    'Correct - Formal tracking ensures improvements are actually implemented',
                    'Annual review is too infrequent for timely implementation',
                    'Individual discretion may result in missed improvements'
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