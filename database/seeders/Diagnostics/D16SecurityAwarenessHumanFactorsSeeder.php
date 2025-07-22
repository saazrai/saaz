<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;
use Illuminate\Database\Seeder;

class D16SecurityAwarenessHumanFactorsSeeder extends Seeder
{
    public function run(): void
    {
        // Get reference data
        $topics = DiagnosticTopic::whereHas('domain', function($query) {
            $query->where('name', 'Security Awareness & Human Factors');
        })->pluck('id', 'name');
        
        $items = [
            // Social Engineering - Phishing, Vishing, Smishing Attacks (10 items)
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is "smishing"?',
                'options' => [
                    'Email-based phishing attack',
                    'SMS/text message phishing attack',
                    'Voice call phishing attack',
                    'Social media phishing attack'
                ],
                'correct_options' => ['SMS/text message phishing attack'],
                'justifications' => [
                    'That would be traditional email phishing',
                    'Correct - Smishing combines SMS + phishing',
                    'That would be vishing (voice phishing)',
                    'That would be social media phishing'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which characteristic makes vishing (voice phishing) particularly effective?',
                'options' => [
                    'Emails can be easily forwarded',
                    'Voice calls create urgency and personal connection',
                    'Text messages are always trusted',
                    'Social media posts reach many people'
                ],
                'correct_options' => ['Voice calls create urgency and personal connection'],
                'justifications' => [
                    'This describes email phishing, not vishing',
                    'Correct - Voice interaction exploits trust and urgency',
                    'Text messages can be suspicious to recipients',
                    'This describes social media attacks'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each phishing type with its primary delivery method:',
                'options' => [
                    'items' => [
                        'Phishing',
                        'Vishing',
                        'Smishing',
                        'Spear phishing'
                    ],
                    'responses' => [
                        'Email messages',
                        'Voice phone calls',
                        'SMS text messages',
                        'Targeted emails to specific individuals'
                    ]
                ],
                'correct_options' => [
                    'Phishing' => 'Email messages',
                    'Vishing' => 'Voice phone calls',
                    'Smishing' => 'SMS text messages',
                    'Spear phishing' => 'Targeted emails to specific individuals'
                ],
                'justifications' => [
                    'Phishing' => 'Traditional email-based social engineering',
                    'Vishing' => 'Voice calls to manipulate victims',
                    'Smishing' => 'SMS-based phishing attacks',
                    'Spear phishing' => 'Highly targeted email attacks'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is "tailgating" in physical security?',
                'options' => [
                    'Following someone\'s car closely',
                    'Following someone through a secure door without authorization',
                    'Copying someone\'s keycard',
                    'Watching someone enter their password'
                ],
                'correct_options' => ['Following someone through a secure door without authorization'],
                'justifications' => [
                    'That\'s road rage, not a security attack',
                    'Correct - Exploiting politeness to bypass physical access controls',
                    'That would be cloning or skimming',
                    'That would be shoulder surfing'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How does "piggybacking" differ from "tailgating"?',
                'options' => [
                    'Piggybacking involves the authorized person\'s knowledge and consent',
                    'Tailgating involves the authorized person\'s knowledge and consent',
                    'There is no difference between the terms',
                    'Piggybacking only occurs in elevators'
                ],
                'correct_options' => ['Piggybacking involves the authorized person\'s knowledge and consent'],
                'justifications' => [
                    'Correct - Piggybacking is when the authorized person knowingly allows access',
                    'Tailgating is done without the authorized person\'s knowledge',
                    'The terms have distinct meanings in security',
                    'Piggybacking can occur at any access control point'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which technique involves creating a fabricated scenario to gain trust?',
                'options' => [
                    'Baiting',
                    'Pretexting',
                    'Phishing',
                    'Shoulder surfing'
                ],
                'correct_options' => ['Pretexting'],
                'justifications' => [
                    'Baiting uses enticing objects to spark curiosity',
                    'Correct - Pretexting creates false situations to manipulate victims',
                    'Phishing uses deceptive messages, not elaborate scenarios',
                    'Shoulder surfing is visual observation of information'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What makes baiting attacks particularly dangerous?',
                'options' => [
                    'They only target senior executives',
                    'They exploit human curiosity and desire for free items',
                    'They cannot be detected by security tools',
                    'They only work through email'
                ],
                'correct_options' => ['They exploit human curiosity and desire for free items'],
                'justifications' => [
                    'Baiting can target any level of employee',
                    'Correct - Baiting relies on psychological triggers like curiosity',
                    'Many baiting attempts can be detected and blocked',
                    'Baiting can occur through physical means (USB drops, etc.)'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the psychological principles that social engineers commonly exploit:',
                'options' => [
                    'Authority',
                    'Mathematical logic',
                    'Urgency',
                    'Programming skills',
                    'Fear',
                    'Reciprocity'
                ],
                'correct_options' => ['Authority', 'Urgency', 'Fear', 'Reciprocity'],
                'justifications' => [
                    'People comply with authority figures',
                    'Logic doesn\'t trigger emotional responses',
                    'Urgency prevents careful consideration',
                    'Technical skills aren\'t psychological triggers',
                    'Fear clouds judgment and prompts hasty action',
                    'People feel obligated to return favors'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Social engineering attacks can only be successful through digital communication channels.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Social engineering can be conducted through multiple channels including in-person interactions (tailgating, impersonation), physical means (baiting with USB drives), phone calls (vishing), and digital methods. The key is human manipulation, not the medium used.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An employee receives a call from someone claiming to be IT support requesting login credentials to fix an urgent system issue. What should they do?',
                'options' => [
                    'Provide credentials immediately to resolve the urgent issue',
                    'Ask for the caller\'s employee ID number first',
                    'Hang up and contact IT through official channels to verify',
                    'Provide a temporary password instead'
                ],
                'correct_options' => ['Hang up and contact IT through official channels to verify'],
                'justifications' => [
                    'Legitimate IT never requests credentials over the phone',
                    'Employee IDs can be researched or faked by attackers',
                    'Correct - Always verify through independent, official channels',
                    'Any password sharing violates security policy'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Security Awareness & Training (10 items)
            [
                'topic_id' => $topics['Security Awareness & Training'] ?? 2,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange the security awareness training lifecycle phases in correct order:',
                'options' => [
                    'Implementation & Delivery',
                    'Evaluation & Metrics',
                    'Needs Assessment',
                    'Design & Development'
                ],
                'correct_options' => [
                    'Needs Assessment',
                    'Design & Development', 
                    'Implementation & Delivery',
                    'Evaluation & Metrics'
                ],
                'justifications' => ['Effective training programs start by assessing what employees need to learn, then design content to meet those needs, implement the training, and finally evaluate effectiveness to improve future programs.'],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary objective of security awareness training?',
                'options' => [
                    'Meet regulatory compliance requirements',
                    'Change employee behavior to reduce security risks',
                    'Demonstrate security team\'s importance to management',
                    'Punish employees who make security mistakes'
                ],
                'correct_options' => ['Change employee behavior to reduce security risks'],
                'justifications' => [
                    'Compliance is secondary to behavior change',
                    'Correct - The ultimate goal is creating security-conscious behavior',
                    'Training should serve business needs, not politics',
                    'Punishment creates fear and discourages incident reporting'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training'] ?? 2,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each training delivery method with its best application:',
                'options' => [
                    'items' => [
                        'E-learning modules',
                        'Phishing simulations',
                        'In-person workshops',
                        'Security newsletters'
                    ],
                    'responses' => [
                        'Scalable compliance training',
                        'Practical threat recognition testing',
                        'Interactive team-specific topics',
                        'Ongoing awareness reinforcement'
                    ]
                ],
                'correct_options' => [
                    'E-learning modules' => 'Scalable compliance training',
                    'Phishing simulations' => 'Practical threat recognition testing',
                    'In-person workshops' => 'Interactive team-specific topics', 
                    'Security newsletters' => 'Ongoing awareness reinforcement'
                ],
                'justifications' => [
                    'E-learning modules' => 'Cost-effective for mandatory annual training',
                    'Phishing simulations' => 'Tests real-world threat recognition skills',
                    'In-person workshops' => 'Allows discussion of role-specific risks',
                    'Security newsletters' => 'Keeps security top-of-mind between formal training'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which metric best indicates security training effectiveness?',
                'options' => [
                    'Number of training hours completed',
                    'Percentage of employees who attended training',
                    'Reduction in security incidents over time',
                    'Training completion rate within deadlines'
                ],
                'correct_options' => ['Reduction in security incidents over time'],
                'justifications' => [
                    'Hours completed don\'t measure learning effectiveness',
                    'Attendance doesn\'t guarantee understanding or behavior change',
                    'Correct - Fewer incidents indicate improved security behavior',
                    'Meeting deadlines doesn\'t measure training quality'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training'] ?? 2,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag characteristics of effective security awareness programs:',
                'options' => [
                    'Role-specific content',
                    'Generic one-size-fits-all approach',
                    'Interactive and engaging delivery',
                    'Annual single-session training only',
                    'Regular updates for emerging threats',
                    'Focus only on technical details'
                ],
                'correct_options' => ['Role-specific content', 'Interactive and engaging delivery', 'Regular updates for emerging threats'],
                'justifications' => [
                    'Different roles face different security risks',
                    'Generic training lacks relevance and engagement',
                    'Engagement improves retention and application',
                    'One annual session is insufficient for retention',
                    'Threat landscape constantly evolves',
                    'Most employees need behavior guidance, not technical details'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When should security awareness training be scheduled?',
                'options' => [
                    'Only during employee onboarding',
                    'Once annually for all employees',
                    'After security incidents occur',
                    'Regularly scheduled plus event-driven sessions'
                ],
                'correct_options' => ['Regularly scheduled plus event-driven sessions'],
                'justifications' => [
                    'Onboarding alone is insufficient for ongoing awareness',
                    'Annual training misses timely reinforcement opportunities',
                    'Reactive training only misses prevention opportunities',
                    'Correct - Combines regular training with timely reinforcement'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training'] ?? 2,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Security awareness training should focus primarily on technical security controls and configurations.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Security awareness training should focus on human behaviors, threat recognition, and safe practices. Most employees don\'t need to understand technical controls but must know how to identify threats, handle data safely, and follow security policies.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the most effective approach for measuring security awareness program success?',
                'options' => [
                    'Track only training completion rates',
                    'Use multiple metrics including behavioral changes',
                    'Focus solely on quiz scores',
                    'Measure only cost per employee trained'
                ],
                'correct_options' => ['Use multiple metrics including behavioral changes'],
                'justifications' => [
                    'Completion rates don\'t measure learning or behavior change',
                    'Correct - Comprehensive measurement includes knowledge, behavior, and outcomes',
                    'Quiz scores only measure knowledge retention, not application',
                    'Cost metrics don\'t indicate program effectiveness'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How should organizations adapt security awareness training for different generations of employees?',
                'options' => [
                    'Use identical training for all age groups',
                    'Only provide digital training for younger employees',
                    'Adapt delivery methods while maintaining consistent core messages',
                    'Provide less training to senior employees'
                ],
                'correct_options' => ['Adapt delivery methods while maintaining consistent core messages'],
                'justifications' => [
                    'One-size-fits-all ignores generational learning preferences',
                    'Digital literacy varies within generations, not just between them',
                    'Correct - Tailor delivery while ensuring consistent security messages',
                    'Experience doesn\'t exempt employees from current threat awareness'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the best approach for security awareness training in multicultural organizations?',
                'options' => [
                    'Use identical materials globally without modification',
                    'Adapt scenarios and examples to local cultural contexts',
                    'Rely only on visual training materials',
                    'Assume cultural differences don\'t affect security behavior'
                ],
                'correct_options' => ['Adapt scenarios and examples to local cultural contexts'],
                'justifications' => [
                    'Global materials miss cultural nuances that affect effectiveness',
                    'Correct - Culturally relevant examples improve recognition and retention',
                    'Visual-only training may miss important conceptual understanding',
                    'Cultural differences significantly impact communication and trust'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Human Resource Security (10 items)
            [
                'topic_id' => $topics['Human Resource Security'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should pre-employment background checks verify for security-sensitive positions?',
                'options' => [
                    'Only criminal history records',
                    'Employment history, education, criminal records, and references',
                    'Social media activity only',
                    'Financial credit score only'
                ],
                'correct_options' => ['Employment history, education, criminal records, and references'],
                'justifications' => [
                    'Criminal history alone provides incomplete risk assessment',
                    'Correct - Comprehensive verification across multiple dimensions',
                    'Social media is supplementary, not primary verification',
                    'Credit checks are one component but insufficient alone'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Human Resource Security'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which legal requirement must organizations follow when conducting background checks?',
                'options' => [
                    'Check every available database globally',
                    'Obtain written consent before conducting checks',
                    'Share results with all hiring team members',
                    'Keep background check results permanently'
                ],
                'correct_options' => ['Obtain written consent before conducting checks'],
                'justifications' => [
                    'Comprehensive checks aren\'t legally mandated everywhere',
                    'Correct - Fair Credit Reporting Act and similar laws require consent',
                    'Results should be limited to authorized personnel only',
                    'Retention periods are typically regulated and limited'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Human Resource Security'] ?? 3,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these onboarding security tasks in proper sequence:',
                'options' => [
                    'Issue access credentials and badges',
                    'Provide security awareness training',
                    'Complete background check verification',
                    'Sign NDAs and security policies'
                ],
                'correct_options' => [
                    'Complete background check verification',
                    'Sign NDAs and security policies',
                    'Provide security awareness training',
                    'Issue access credentials and badges'
                ],
                'justifications' => ['Background verification must complete before employment begins, legal agreements establish obligations, training provides necessary knowledge, and finally access is granted based on role requirements.'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Human Resource Security'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of security briefings during onboarding?',
                'options' => [
                    'Intimidate new employees about security consequences',
                    'Establish security expectations and provide baseline knowledge',
                    'Test new employees\' existing security knowledge',
                    'Fulfill legal documentation requirements only'
                ],
                'correct_options' => ['Establish security expectations and provide baseline knowledge'],
                'justifications' => [
                    'Intimidation creates negative culture and discourages reporting',
                    'Correct - Sets clear expectations and provides foundational knowledge',
                    'Testing comes after training, not as the primary purpose',
                    'While documentation is important, knowledge transfer is the goal'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Human Resource Security'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Why should security briefings be customized for different job roles?',
                'options' => [
                    'To reduce overall training time and costs',
                    'Different roles face unique security risks and responsibilities',
                    'To meet varying regulatory requirements',
                    'All employees should receive identical training'
                ],
                'correct_options' => ['Different roles face unique security risks and responsibilities'],
                'justifications' => [
                    'Effectiveness matters more than cost reduction',
                    'Correct - Role-specific training improves relevance and retention',
                    'While compliance may require customization, relevance is primary',
                    'Generic training is less effective than targeted instruction'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Human Resource Security'] ?? 3,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the essential elements of security onboarding to the drop zone:',
                'options' => [
                    'Security policy acknowledgment',
                    'Complete system access immediately',
                    'Role-specific security training',
                    'Skip background check if urgent',
                    'Identity verification and badge issuance',
                    'Assume prior security knowledge'
                ],
                'correct_options' => ['Security policy acknowledgment', 'Role-specific security training', 'Identity verification and badge issuance'],
                'justifications' => [
                    'Establishes legal and policy obligations',
                    'Full access should be granted incrementally based on need',
                    'Provides relevant security knowledge for the role',
                    'Background checks are never optional for security positions',
                    'Confirms identity and provides physical access controls',
                    'Never assume security knowledge - always provide baseline training'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Human Resource Security'] ?? 3,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the critical security tasks for employee termination to the drop zone:',
                'options' => [
                    'Disable all system access immediately',
                    'Allow grace period for email access',
                    'Retrieve company devices and credentials',
                    'Keep shared passwords unchanged',
                    'Conduct security-focused exit interview',
                    'Remove physical access controls'
                ],
                'correct_options' => ['Disable all system access immediately', 'Retrieve company devices and credentials', 'Conduct security-focused exit interview', 'Remove physical access controls'],
                'justifications' => [
                    'Prevents unauthorized access post-employment',
                    'Grace periods create unnecessary security risks',
                    'Company property must be returned completely',
                    'Shared passwords must be changed if known by departed employee',
                    'May reveal security concerns or insider threats',
                    'Physical access must be revoked immediately'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Human Resource Security'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should happen to work data stored on an employee\'s personal devices during termination?',
                'options' => [
                    'Employee retains all data as personal property',
                    'Data must be transferred to corporate systems before departure',
                    'All personal devices should be confiscated',
                    'Data ownership depends on device ownership'
                ],
                'correct_options' => ['Data must be transferred to corporate systems before departure'],
                'justifications' => [
                    'Work-related data belongs to the organization regardless of device',
                    'Correct - Business continuity requires work data preservation',
                    'Personal devices cannot be confiscated legally',
                    'Data ownership is determined by content, not device ownership'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Human Resource Security'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Exit interviews should focus only on general employment satisfaction, not security-specific topics.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Security-focused exit interviews can reveal insider threats, security weaknesses, policy violations, or other concerns that departing employees might not report through normal channels. This security intelligence is valuable for improving organizational security.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Human Resource Security'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How should organizations handle the termination of employees with privileged system access?',
                'options' => [
                    'Follow standard termination procedures',
                    'Implement enhanced security procedures with immediate access revocation',
                    'Allow extended notice periods for knowledge transfer',
                    'Require only password changes'
                ],
                'correct_options' => ['Implement enhanced security procedures with immediate access revocation'],
                'justifications' => [
                    'Privileged access requires enhanced procedures beyond standard ones',
                    'Correct - High-risk access requires immediate and comprehensive revocation',
                    'Extended access periods increase risk of malicious activity',
                    'Password changes alone are insufficient for privileged access'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Personnel Safety (10 items)
            [
                'topic_id' => $topics['Personnel Safety'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of duress codes?',
                'options' => [
                    'Speed up authentication processes',
                    'Signal to security that help is needed under threat',
                    'Create backup passwords for forgotten credentials',
                    'Provide temporary access during emergencies'
                ],
                'correct_options' => ['Signal to security that help is needed under threat'],
                'justifications' => [
                    'Duress codes are separate from normal authentication',
                    'Correct - Duress codes covertly alert security to threatening situations',
                    'Duress codes are not backup passwords',
                    'Emergency access uses different mechanisms'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Safety'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Duress codes should be shared among team members for backup purposes.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Duress codes must remain confidential to the individual employee and security personnel only. Sharing compromises their effectiveness and creates confusion about who is actually under duress.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Safety'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When should an employee use their duress code?',
                'options' => [
                    'When they forget their normal password',
                    'When being coerced to provide access under threat',
                    'During routine security testing',
                    'When working overtime hours'
                ],
                'correct_options' => ['When being coerced to provide access under threat'],
                'justifications' => [
                    'Password reset processes handle forgotten credentials',
                    'Correct - Duress codes signal coercion or threat situations',
                    'Testing should use designated test accounts, not duress codes',
                    'Overtime doesn\'t require duress code usage'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Safety'] ?? 4,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange emergency response actions in correct priority order:',
                'options' => [
                    'Contact emergency services',
                    'Ensure personal safety',
                    'Notify management',
                    'Document the incident'
                ],
                'correct_options' => [
                    'Ensure personal safety',
                    'Contact emergency services',
                    'Notify management',
                    'Document the incident'
                ],
                'justifications' => ['Personal safety is the top priority, followed by getting professional emergency help, then organizational notification, and finally documentation when safe to do so.'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Safety'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the first priority during any workplace emergency?',
                'options' => [
                    'Protecting company data and assets',
                    'Ensuring personal and employee safety',
                    'Notifying senior management',
                    'Documenting the emergency for insurance'
                ],
                'correct_options' => ['Ensuring personal and employee safety'],
                'justifications' => [
                    'Data protection is secondary to life safety',
                    'Correct - Human life and safety always take precedence',
                    'Management notification comes after ensuring safety',
                    'Documentation occurs after the emergency is handled'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Safety'] ?? 4,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag essential travel security practices to the drop zone:',
                'options' => [
                    'Use hotel business centers for confidential work',
                    'Keep devices physically secure at all times',
                    'Connect to any available free WiFi',
                    'Use VPN for all internet connections',
                    'Leave devices unattended in hotel rooms',
                    'Avoid discussing business in public areas'
                ],
                'correct_options' => ['Keep devices physically secure at all times', 'Use VPN for all internet connections', 'Avoid discussing business in public areas'],
                'justifications' => [
                    'Hotel business centers pose security risks for sensitive work',
                    'Physical security prevents device compromise',
                    'Public WiFi networks are inherently insecure',
                    'VPNs protect data transmission over untrusted networks',
                    'Unattended devices are vulnerable to compromise',
                    'Public discussions may be overheard by competitors'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Safety'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should employees do if approached by suspicious individuals while traveling on business?',
                'options' => [
                    'Ignore them and continue with planned activities',
                    'Engage politely to avoid creating suspicion',
                    'Remove themselves from the situation and report to security',
                    'Provide fake business information'
                ],
                'correct_options' => ['Remove themselves from the situation and report to security'],
                'justifications' => [
                    'Ignoring may not address persistent threats',
                    'Engagement may provide opportunities for social engineering',
                    'Correct - Prioritize safety and provide intelligence to security',
                    'False information may escalate the situation dangerously'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Safety'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which social media security guideline is most important for employees?',
                'options' => [
                    'Never use social media for personal purposes',
                    'Avoid posting information that reveals work location or schedule',
                    'Only connect with coworkers on social media',
                    'Post frequently to maintain professional visibility'
                ],
                'correct_options' => ['Avoid posting information that reveals work location or schedule'],
                'justifications' => [
                    'Personal social media use is generally acceptable with guidelines',
                    'Correct - Location and schedule information enables physical targeting',
                    'Connection restrictions vary by organization and platform',
                    'Posting frequency should be based on security, not visibility'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Safety'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Employees should post photos of company events on social media to promote workplace culture.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Company event photos may reveal sensitive information including employee identities, security measures, facility layouts, or business relationships. Such posts should follow company social media policy and may require approval before sharing.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Safety'] ?? 4,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each social media risk with its potential security impact:',
                'options' => [
                    'items' => [
                        'Location tagging at work',
                        'Posting vacation schedules',
                        'Sharing work accomplishments',
                        'Connecting with unknown individuals'
                    ],
                    'responses' => [
                        'Reveals physical security locations',
                        'Enables targeted social engineering',
                        'May disclose sensitive business information',
                        'Provides access for reconnaissance'
                    ]
                ],
                'correct_options' => [
                    'Location tagging at work' => 'Reveals physical security locations',
                    'Posting vacation schedules' => 'Enables targeted social engineering',
                    'Sharing work accomplishments' => 'May disclose sensitive business information',
                    'Connecting with unknown individuals' => 'Provides access for reconnaissance'
                ],
                'justifications' => [
                    'Location tagging at work' => 'Exposes facility locations and security measures',
                    'Posting vacation schedules' => 'Attackers know when employees are absent',
                    'Sharing work accomplishments' => 'May inadvertently reveal confidential projects',
                    'Connecting with unknown individuals' => 'Allows potential attackers to gather intelligence'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Personnel Security Controls (10 items)
            [
                'topic_id' => $topics['Personnel Security Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of Separation of Duties (SoD)?',
                'options' => [
                    'Increase employee workload distribution',
                    'Prevent any single person from completing critical processes alone',
                    'Ensure backup coverage during employee absence',
                    'Comply with labor law requirements'
                ],
                'correct_options' => ['Prevent any single person from completing critical processes alone'],
                'justifications' => [
                    'SoD is about security control, not workload management',
                    'Correct - SoD prevents fraud and errors by requiring multiple people',
                    'While SoD provides backup benefits, fraud prevention is primary',
                    'SoD is a security control, not a labor compliance requirement'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Security Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How does "dual control" differ from "separation of duties"?',
                'options' => [
                    'There is no difference between the terms',
                    'Dual control requires two people present simultaneously',
                    'Separation of duties is more secure than dual control',
                    'Dual control only applies to financial transactions'
                ],
                'correct_options' => ['Dual control requires two people present simultaneously'],
                'justifications' => [
                    'The terms have distinct meanings in security',
                    'Correct - Dual control requires simultaneous presence and action',
                    'Both are security controls with different applications',
                    'Dual control applies to any high-risk operations'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Security Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is "split knowledge" in security controls?',
                'options' => [
                    'Training employees on different security topics',
                    'Dividing critical information so no single person has complete access',
                    'Separating technical and business knowledge',
                    'Creating backup documentation in multiple locations'
                ],
                'correct_options' => ['Dividing critical information so no single person has complete access'],
                'justifications' => [
                    'Split knowledge is about information control, not training diversity',
                    'Correct - No individual has complete critical information',
                    'Split knowledge applies to any sensitive information, not just technical',
                    'This describes documentation backup, not split knowledge'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Security Controls'] ?? 5,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each security control with its primary purpose:',
                'options' => [
                    'items' => [
                        'Separation of Duties',
                        'Dual Control',
                        'Split Knowledge',
                        'Job Rotation'
                    ],
                    'responses' => [
                        'Prevents single-person process completion',
                        'Requires simultaneous authorization',
                        'Divides critical information access',
                        'Prevents long-term fraud schemes'
                    ]
                ],
                'correct_options' => [
                    'Separation of Duties' => 'Prevents single-person process completion',
                    'Dual Control' => 'Requires simultaneous authorization',
                    'Split Knowledge' => 'Divides critical information access',
                    'Job Rotation' => 'Prevents long-term fraud schemes'
                ],
                'justifications' => [
                    'Separation of Duties' => 'Critical processes require multiple people',
                    'Dual Control' => 'High-risk actions need two people present',
                    'Split Knowledge' => 'No single person holds complete secrets',
                    'Job Rotation' => 'Moving responsibilities exposes hidden activities'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Security Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How does job rotation help detect fraud?',
                'options' => [
                    'It increases employee job satisfaction',
                    'Fraudulent activities often surface when the perpetrator is absent',
                    'It provides cross-training opportunities',
                    'It reduces overall payroll costs'
                ],
                'correct_options' => ['Fraudulent activities often surface when the perpetrator is absent'],
                'justifications' => [
                    'Job satisfaction is a benefit but not the security purpose',
                    'Correct - Fraud schemes often require daily maintenance to avoid detection',
                    'Cross-training is beneficial but not the primary security goal',
                    'Cost reduction is not the purpose of security-driven job rotation'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Security Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the security purpose of mandatory vacation policies?',
                'options' => [
                    'Ensure employees are well-rested and productive',
                    'Comply with labor regulations',
                    'Force disconnection from work to detect fraud',
                    'Reduce company payroll expenses'
                ],
                'correct_options' => ['Force disconnection from work to detect fraud'],
                'justifications' => [
                    'Employee wellness is beneficial but not the security purpose',
                    'Labor compliance may require vacation but that\'s not security purpose',
                    'Correct - Mandatory time away exposes fraudulent activities',
                    'Vacation policies typically don\'t reduce total payroll'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Security Controls'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Clear desk policies only apply to physical papers and documents.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Clear desk policies apply to all forms of sensitive information including physical documents, electronic devices, removable media, whiteboards, and any other medium containing confidential data. The goal is comprehensive information protection.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Security Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What does "clear screen" policy typically require?',
                'options' => [
                    'Employees clean their monitors weekly',
                    'Screen savers activate after 5 minutes',
                    'Computers lock automatically when unattended',
                    'All screens face away from public areas'
                ],
                'correct_options' => ['Computers lock automatically when unattended'],
                'justifications' => [
                    'Clear screen refers to information security, not physical cleaning',
                    'Screen savers don\'t provide security without locking',
                    'Correct - Clear screen means locking computers to prevent unauthorized viewing',
                    'Screen positioning helps but locking is the core requirement'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Security Controls'] ?? 5,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag effective methods for implementing clear desk policies:',
                'options' => [
                    'Regular awareness training',
                    'Surprise punitive inspections',
                    'Provide secure storage facilities',
                    'Remove all paper from workplace',
                    'Periodic friendly compliance checks',
                    'Install surveillance cameras'
                ],
                'correct_options' => ['Regular awareness training', 'Provide secure storage facilities', 'Periodic friendly compliance checks'],
                'justifications' => [
                    'Education builds understanding and compliance',
                    'Punitive approaches create resistance and negative culture',
                    'Employees need secure places to store sensitive materials',
                    'Eliminating paper entirely is impractical in most environments',
                    'Gentle reinforcement is more effective than punishment',
                    'Surveillance may violate privacy laws and damage trust'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Personnel Security Controls'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When should organizations implement dual control procedures?',
                'options' => [
                    'For all routine business processes',
                    'Only for financial transactions',
                    'For high-risk or high-value operations',
                    'Never, as they reduce efficiency'
                ],
                'correct_options' => ['For high-risk or high-value operations'],
                'justifications' => [
                    'Dual control for all processes would be impractical and expensive',
                    'Dual control applies beyond just financial transactions',
                    'Correct - Use dual control where risks or values are highest',
                    'Dual control is essential for certain high-risk operations'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ]
        ];
        
        // Insert all items
        foreach ($items as $item) {
            DiagnosticItem::create($item);
        }
        
        $this->command->info('Domain 16 (Security Awareness & Human Factors) diagnostic items seeded successfully!');
    }
}