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
            // Social Engineering - Pretexting Techniques - Item 1
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which social engineering technique involves creating a fabricated scenario to gain a victim\'s trust?',
                'options' => [
                    'Phishing',
                    'Pretexting',
                    'Shoulder surfing',
                    'Dumpster diving'
                ],
                'correct_options' => ['Pretexting'],
                'justifications' => [
                    'Phishing uses deceptive messages, not elaborate scenarios',
                    'Correct - Pretexting creates false situations to manipulate victims',
                    'Shoulder surfing is visual observation',
                    'Dumpster diving is physical information gathering'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each social engineering attack with its description:',
                'options' => [
                    'items' => [
                        'Baiting',
                        'Quid pro quo',
                        'Tailgating',
                        'Watering hole'
                    ],
                    'responses' => [
                        'Offering something enticing to spark curiosity',
                        'Offering a service in exchange for information',
                        'Following someone through a secure door',
                        'Compromising websites frequently visited by targets'
                    ]
                ],
                'correct_options' => [
                    'Baiting' => 'Offering something enticing to spark curiosity',
                    'Quid pro quo' => 'Offering a service in exchange for information',
                    'Tailgating' => 'Following someone through a secure door',
                    'Watering hole' => 'Compromising websites frequently visited by targets'
                ],
                'justifications' => [
                    'Baiting' => 'Like leaving infected USB drives for victims to find',
                    'Quid pro quo' => 'Attacker offers help in exchange for access',
                    'Tailgating' => 'Physical security breach through social means',
                    'Watering hole' => 'Targets specific groups through their browsing habits'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the psychological principles that social engineers exploit to the drop zone:',
                'options' => [
                    'Authority',
                    'Logic',
                    'Urgency',
                    'Mathematics',
                    'Fear',
                    'Programming'
                ],
                'correct_options' => ['Authority', 'Urgency', 'Fear'],
                'justifications' => [
                    'People tend to comply with authority figures',
                    'Logic is not an emotional manipulation',
                    'Urgency prevents careful thinking',
                    'Mathematics is not psychological manipulation',
                    'Fear clouds judgment and prompts action',
                    'Programming is technical, not psychological'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Social engineering attacks can only be conducted through digital means like email and phone calls.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Social engineering can be conducted through many channels including in-person interactions (tailgating, impersonation), physical means (baiting with USB drives, dumpster diving), and digital methods (phishing, vishing). It\'s about manipulating people, not the medium used.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'An employee receives a call from someone claiming to be from IT support asking for their password to fix an urgent issue. What should they do?',
                'options' => [
                    'Provide the password to fix the issue quickly',
                    'Refuse and hang up, then contact IT through official channels',
                    'Ask for the caller\'s employee ID first',
                    'Give a fake password to test them'
                ],
                'correct_options' => ['Refuse and hang up, then contact IT through official channels'],
                'justifications' => [
                    'IT should never ask for passwords',
                    'Correct - Verify through known, official channels',
                    'Social engineers can fake employee IDs',
                    'This wastes time and doesn\'t address the threat'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Insider Threats - 5 items
            [
                'topic_id' => $topics['Insider Threats'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which type of insider threat is typically the most common?',
                'options' => [
                    'Malicious insiders seeking revenge',
                    'Negligent employees making mistakes',
                    'Compromised credentials',
                    'Corporate espionage'
                ],
                'correct_options' => ['Negligent employees making mistakes'],
                'justifications' => [
                    'Malicious insiders exist but are less common',
                    'Correct - Most insider incidents are accidental, not malicious',
                    'Compromised credentials are serious but less frequent',
                    'Espionage is rare compared to accidents'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Insider Threats'] ?? 2,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each insider threat indicator with its category:',
                'options' => [
                    'items' => [
                        'Accessing data unrelated to job',
                        'Financial difficulties',
                        'Downloading large amounts of data',
                        'Disgruntlement with management'
                    ],
                    'responses' => [
                        'Behavioral indicator',
                        'Personal stressor',
                        'Technical indicator',
                        'Emotional indicator'
                    ]
                ],
                'correct_options' => [
                    'Accessing data unrelated to job' => 'Technical indicator',
                    'Financial difficulties' => 'Personal stressor',
                    'Downloading large amounts of data' => 'Technical indicator',
                    'Disgruntlement with management' => 'Emotional indicator'
                ],
                'justifications' => [
                    'Accessing data unrelated to job' => 'System logs show unauthorized access patterns',
                    'Financial difficulties' => 'Personal issues that may motivate theft',
                    'Downloading large amounts of data' => 'Technical activity indicating possible exfiltration',
                    'Disgruntlement with management' => 'Emotional state that may lead to malicious actions'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Insider Threats'] ?? 2,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the controls that help mitigate insider threats to the drop zone:',
                'options' => [
                    'Separation of duties',
                    'Unlimited data access',
                    'User activity monitoring',
                    'Trust all employees equally',
                    'Background checks',
                    'No access logging'
                ],
                'correct_options' => ['Separation of duties', 'User activity monitoring', 'Background checks'],
                'justifications' => [
                    'Prevents single person from causing major damage',
                    'Violates least privilege principle',
                    'Helps detect anomalous behavior',
                    'Trust but verify is needed',
                    'Screens for risk factors before hiring',
                    'Logging is essential for detection'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Insider Threats'] ?? 2,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Insider threats only come from current employees.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Insider threats can come from anyone with legitimate access including current employees, contractors, business partners, former employees who still have access, and even customers with system access. The key factor is authorized access, not employment status.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Insider Threats'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the most effective approach to managing insider threat risk?',
                'options' => [
                    'Trust no one in the organization',
                    'Monitor only IT staff activities',
                    'Implement a comprehensive insider threat program',
                    'Focus only on preventing data downloads'
                ],
                'correct_options' => ['Implement a comprehensive insider threat program'],
                'justifications' => [
                    'Zero trust internally damages culture',
                    'All employees pose potential risk, not just IT',
                    'Correct - Combines prevention, detection, and response',
                    'Insider threats involve more than data theft'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Security Awareness & Training Lifecycle - 6 items
            [
                'topic_id' => $topics['Security Awareness & Training Lifecycle'] ?? 3,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange the security awareness program lifecycle phases in order:',
                'options' => [
                    'Design & Development',
                    'Implementation',
                    'Evaluation & Metrics',
                    'Needs Assessment'
                ],
                'correct_options' => [
                    'Needs Assessment',
                    'Design & Development',
                    'Implementation',
                    'Evaluation & Metrics'
                ],
                'justifications' => ['First assess what training is needed, then design content to meet those needs, implement the training program, and finally evaluate its effectiveness to improve future iterations.'],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training Lifecycle'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the BEST approach to scheduling security awareness training for employees?',
                'options' => [
                    'During the onboarding process',
                    'Annually',
                    'Based on both scheduled intervals and triggering events',
                    'After major security incidents'
                ],
                'correct_options' => ['Based on both scheduled intervals and triggering events'],
                'justifications' => [
                    'Onboarding is important but insufficient for ongoing awareness',
                    'Annual training alone misses timely opportunities for reinforcement',
                    'Correct - Combines regular training with event-driven awareness for maximum effectiveness',
                    'Reactive training only misses prevention and baseline awareness building'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training Lifecycle'] ?? 3,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the characteristics of effective security awareness training to the drop zone:',
                'options' => [
                    'Role-specific content',
                    'Generic one-size-fits-all',
                    'Interactive and engaging',
                    'Lengthy technical lectures',
                    'Regular updates for new threats',
                    'Set-and-forget approach'
                ],
                'correct_options' => ['Role-specific content', 'Interactive and engaging', 'Regular updates for new threats'],
                'justifications' => [
                    'Different roles face different risks',
                    'Generic training lacks relevance',
                    'Engagement improves retention',
                    'Long lectures lose audience attention',
                    'Threat landscape constantly evolves',
                    'Training needs continuous improvement'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training Lifecycle'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary goal of security awareness training?',
                'options' => [
                    'Meet compliance requirements',
                    'Change employee behavior to reduce risk',
                    'Punish employees who make mistakes',
                    'Demonstrate security team importance'
                ],
                'correct_options' => ['Change employee behavior to reduce risk'],
                'justifications' => [
                    'Compliance is secondary to behavior change',
                    'Correct - The goal is to create security-conscious behavior',
                    'Punishment creates fear, not awareness',
                    'Not about organizational politics'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training Lifecycle'] ?? 3,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Security awareness training should focus primarily on technical controls and system configurations.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Security awareness training should focus on human behavior, recognizing threats, and safe practices rather than technical details. Most employees don\'t need to understand technical controls but do need to know how to identify phishing, handle data safely, and follow security policies.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Security Awareness & Training Lifecycle'] ?? 3,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each training delivery method with its best use case:',
                'options' => [
                    'items' => [
                        'E-learning modules',
                        'Phishing simulations',
                        'Lunch-and-learn sessions',
                        'Posters and newsletters'
                    ],
                    'responses' => [
                        'Annual compliance training',
                        'Practical skill testing',
                        'Team-specific topics',
                        'Continuous reinforcement'
                    ]
                ],
                'correct_options' => [
                    'E-learning modules' => 'Annual compliance training',
                    'Phishing simulations' => 'Practical skill testing',
                    'Lunch-and-learn sessions' => 'Team-specific topics',
                    'Posters and newsletters' => 'Continuous reinforcement'
                ],
                'justifications' => [
                    'E-learning modules' => 'Scalable for mandatory annual training',
                    'Phishing simulations' => 'Tests real-world threat recognition',
                    'Lunch-and-learn sessions' => 'Interactive format for targeted groups',
                    'Posters and newsletters' => 'Keeps security top-of-mind daily'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Phishing Simulation Metrics & Gamification - 5 items
            [
                'topic_id' => $topics['Phishing Simulation Metrics & Gamification'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of phishing simulations?',
                'options' => [
                    'Identify employees to punish',
                    'Test and improve threat recognition skills',
                    'Prove the security team\'s value',
                    'Meet audit requirements'
                ],
                'correct_options' => ['Test and improve threat recognition skills'],
                'justifications' => [
                    'Punishment discourages reporting real incidents',
                    'Correct - Simulations are educational tools',
                    'Not about organizational politics',
                    'Education is primary, compliance secondary'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Phishing Simulation Metrics & Gamification'] ?? 4,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag the key metrics for measuring phishing simulation effectiveness to the drop zone:',
                'options' => [
                    'Click rate',
                    'Employee names who failed',
                    'Report rate',
                    'Time to punishment',
                    'Time to report',
                    'Number of emails sent'
                ],
                'correct_options' => ['Click rate', 'Report rate', 'Time to report'],
                'justifications' => [
                    'Measures how many fall for phishing',
                    'Focus on metrics, not individuals',
                    'Shows how many recognize and report threats',
                    'Simulations should educate, not punish',
                    'Faster reporting limits damage',
                    'Volume less important than outcomes'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Phishing Simulation Metrics & Gamification'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How can gamification improve security awareness programs?',
                'options' => [
                    'Makes security seem less serious',
                    'Increases engagement and retention',
                    'Replaces formal training entirely',
                    'Only works for younger employees'
                ],
                'correct_options' => ['Increases engagement and retention'],
                'justifications' => [
                    'Can make serious topics more engaging',
                    'Correct - Game elements motivate participation and learning',
                    'Supplements but doesn\'t replace training',
                    'Effective across all age groups when well-designed'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Phishing Simulation Metrics & Gamification'] ?? 4,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Employees who repeatedly fail phishing simulations should face disciplinary action.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Punishing employees for failing simulations creates a negative security culture and discourages reporting of real incidents. Instead, provide additional training and support. Reserve discipline for willful security violations, not training failures.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Phishing Simulation Metrics & Gamification'] ?? 4,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each gamification element with its benefit:',
                'options' => [
                    'items' => [
                        'Leaderboards',
                        'Badges',
                        'Points system',
                        'Team challenges'
                    ],
                    'responses' => [
                        'Creates friendly competition',
                        'Recognizes achievements',
                        'Tracks progress',
                        'Builds collective responsibility'
                    ]
                ],
                'correct_options' => [
                    'Leaderboards' => 'Creates friendly competition',
                    'Badges' => 'Recognizes achievements',
                    'Points system' => 'Tracks progress',
                    'Team challenges' => 'Builds collective responsibility'
                ],
                'justifications' => [
                    'Leaderboards' => 'Competition motivates improvement',
                    'Badges' => 'Visual recognition of security accomplishments',
                    'Points system' => 'Quantifies and gamifies learning progress',
                    'Team challenges' => 'Encourages peer support and accountability'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Behavioral Analytics & User Risk Scoring - 4 items
            [
                'topic_id' => $topics['Behavioral Analytics & User Risk Scoring'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary benefit of user behavior analytics (UBA)?',
                'options' => [
                    'Replacing traditional access controls',
                    'Detecting anomalies that may indicate threats',
                    'Monitoring employee productivity',
                    'Reducing security staff'
                ],
                'correct_options' => ['Detecting anomalies that may indicate threats'],
                'justifications' => [
                    'UBA complements, not replaces access controls',
                    'Correct - UBA identifies unusual patterns indicating compromise',
                    'UBA is for security, not productivity monitoring',
                    'UBA requires skilled analysts to investigate alerts'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Behavioral Analytics & User Risk Scoring'] ?? 5,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag factors that contribute to user risk scores to the drop zone:',
                'options' => [
                    'Access to sensitive data',
                    'Years of employment',
                    'Failed login attempts',
                    'Hair color',
                    'Unusual access patterns',
                    'Office location'
                ],
                'correct_options' => ['Access to sensitive data', 'Failed login attempts', 'Unusual access patterns'],
                'justifications' => [
                    'Higher privileges mean higher potential impact',
                    'Tenure doesn\'t determine risk',
                    'May indicate compromise attempts',
                    'Not relevant to security risk',
                    'Deviations from baseline indicate issues',
                    'Physical location rarely affects risk score'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Behavioral Analytics & User Risk Scoring'] ?? 5,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** User risk scores should be static and set during employee onboarding.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'User risk scores must be dynamic and continuously updated based on behavior, access changes, security incidents, and threat intelligence. Static scores quickly become outdated and fail to reflect current risk levels.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Behavioral Analytics & User Risk Scoring'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How should organizations respond to high user risk scores?',
                'options' => [
                    'Immediately terminate the employee',
                    'Implement adaptive controls based on risk level',
                    'Ignore scores from automated systems',
                    'Make the scores public to shame users'
                ],
                'correct_options' => ['Implement adaptive controls based on risk level'],
                'justifications' => [
                    'High scores need investigation, not automatic termination',
                    'Correct - Adjust security controls proportionally to risk',
                    'Automated insights need human verification, not dismissal',
                    'Public shaming damages security culture'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Security Policies - 5 items
            [
                'topic_id' => $topics['Acceptable Use Policy (AUP)'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary purpose of an Acceptable Use Policy?',
                'options' => [
                    'Limit employee internet access',
                    'Define appropriate use of organizational resources',
                    'Block all personal activities',
                    'Monitor employee communications'
                ],
                'correct_options' => ['Define appropriate use of organizational resources'],
                'justifications' => [
                    'AUP guides behavior, not just restricts',
                    'Correct - Sets expectations for responsible resource use',
                    'Some personal use may be acceptable',
                    'AUP defines rules, not monitoring methods'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Bring Your Own Device (BYOD) Policy'] ?? 7,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag essential elements of a BYOD policy to the drop zone:',
                'options' => [
                    'Supported device types',
                    'Employee device color',
                    'Security requirements',
                    'Personal app restrictions',
                    'Data separation methods',
                    'Device brand preferences'
                ],
                'correct_options' => ['Supported device types', 'Security requirements', 'Data separation methods'],
                'justifications' => [
                    'Defines which devices can access corporate data',
                    'Aesthetic preferences aren\'t security relevant',
                    'Minimum security standards for BYOD',
                    'May be too restrictive for personal devices',
                    'How corporate and personal data are kept separate',
                    'Brand doesn\'t matter if security requirements met'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Clear Desk / Clear Screen Policy'] ?? 8,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Clear desk policies only apply to papers and documents, not electronic devices.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'Clear desk policies cover all sensitive information regardless of format. This includes papers, electronic devices, removable media, whiteboards, and any other medium containing confidential information. The goal is preventing unauthorized access to any sensitive data.'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Non-Disclosure Agreement (NDA)'] ?? 9,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'When should employees sign NDAs?',
                'options' => [
                    'Only when handling classified information',
                    'Before accessing any company confidential information',
                    'Only senior management needs NDAs',
                    'After they leave the company'
                ],
                'correct_options' => ['Before accessing any company confidential information'],
                'justifications' => [
                    'NDAs cover all confidential info, not just classified',
                    'Correct - Protection must be in place before access',
                    'All employees with access need NDAs',
                    'Too late - NDAs must be signed while employed'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Acceptable Use Policy (AUP)'] ?? 6,
                'type_id' => 5,
                'dimension' => 'Managerial',
                'content' => 'Match each AUP violation with its severity level:',
                'options' => [
                    'items' => [
                        'Checking personal email',
                        'Downloading pirated software',
                        'Brief social media use',
                        'Accessing inappropriate content'
                    ],
                    'responses' => [
                        'Minor violation',
                        'Major violation',
                        'Depends on company policy'
                    ]
                ],
                'correct_options' => [
                    'Checking personal email' => 'Depends on company policy',
                    'Downloading pirated software' => 'Major violation',
                    'Brief social media use' => 'Depends on company policy',
                    'Accessing inappropriate content' => 'Major violation'
                ],
                'justifications' => [
                    'Checking personal email' => 'Some companies allow limited personal use',
                    'Downloading pirated software' => 'Illegal activity is always major violation',
                    'Brief social media use' => 'Policies vary on personal use during breaks',
                    'Accessing inappropriate content' => 'Creates hostile work environment'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Personnel Security - 5 items
            [
                'topic_id' => $topics['Candidate Screening & Background Checks'] ?? 10,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should background checks verify for security-sensitive positions?',
                'options' => [
                    'Only criminal history',
                    'Employment, education, criminal history, and references',
                    'Social media posts only',
                    'Credit score only'
                ],
                'correct_options' => ['Employment, education, criminal history, and references'],
                'justifications' => [
                    'Criminal history alone is insufficient',
                    'Correct - Comprehensive checks verify multiple aspects',
                    'Social media is just one component',
                    'Credit may be relevant but not sufficient alone'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 1,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['On-Boarding & Security Briefings'] ?? 11,
                'type_id' => 4,
                'dimension' => 'Managerial',
                'content' => 'Arrange these onboarding security tasks in logical order:',
                'options' => [
                    'Issue access badges and credentials',
                    'Security awareness training',
                    'Sign NDAs and security policies',
                    'Background check clearance'
                ],
                'correct_options' => [
                    'Background check clearance',
                    'Sign NDAs and security policies',
                    'Security awareness training',
                    'Issue access badges and credentials'
                ],
                'justifications' => ['Background checks must clear before employment, then legal agreements are signed, followed by training on security expectations, and finally providing actual access to systems and facilities.'],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Job Rotation & Mandatory Vacation'] ?? 12,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How does mandatory vacation help detect fraud?',
                'options' => [
                    'Employees are happier and less likely to steal',
                    'Fraudulent activities often surface when perpetrator is absent',
                    'It reduces payroll costs',
                    'Vacations are rewards for good behavior'
                ],
                'correct_options' => ['Fraudulent activities often surface when perpetrator is absent'],
                'justifications' => [
                    'While true, not the security purpose',
                    'Correct - Fraud schemes often require daily maintenance',
                    'Not related to fraud detection',
                    'Mandatory vacation is a control, not reward'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 2,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Termination / Exit Process'] ?? 13,
                'type_id' => 3,
                'dimension' => 'Managerial',
                'content' => 'Drag critical security tasks for employee termination to the drop zone:',
                'options' => [
                    'Disable accounts immediately',
                    'Allow grace period for access',
                    'Retrieve company property',
                    'Keep email active indefinitely',
                    'Exit interview',
                    'Change shared passwords'
                ],
                'correct_options' => ['Disable accounts immediately', 'Retrieve company property', 'Exit interview', 'Change shared passwords'],
                'justifications' => [
                    'Access must be revoked promptly',
                    'Grace periods create security risks',
                    'Devices, badges, keys must be returned',
                    'Email should be disabled or forwarded appropriately',
                    'Can reveal security concerns or threats',
                    'Terminated employee may know shared credentials'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],
            [
                'topic_id' => $topics['Job Rotation & Mandatory Vacation'] ?? 12,
                'type_id' => 2,
                'dimension' => 'Managerial',
                'content' => '**True or False:** Job rotation is primarily implemented to develop employee skills.',
                'options' => [
                    'True',
                    'False'
                ],
                'correct_options' => ['False'],
                'justifications' => [
                    'explanation' => 'While job rotation does develop skills, from a security perspective it\'s primarily implemented to prevent fraud and collusion. By rotating duties, no single person maintains long-term control over sensitive processes, making fraud schemes harder to perpetrate and easier to detect.'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Social Engineering - Advanced Attack Vectors - Item 36 (Bloom 1)
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is "smishing"?',
                'options' => [
                    'Email-based phishing',
                    'SMS/text message phishing',
                    'Voice call phishing',
                    'Physical mail phishing'
                ],
                'correct_options' => ['SMS/text message phishing'],
                'justifications' => [
                    'That would be traditional phishing',
                    'Correct - Smishing combines SMS + phishing',
                    'That would be vishing',
                    'That would be traditional mail fraud'
                ],
                'difficulty_level' => 1,
                'bloom_level' => 1,
                'status' => 'published'
            ],

            // Security Awareness & Training Lifecycle - Effectiveness Measurement - Item 37 (Bloom 3)
            [
                'topic_id' => $topics['Security Awareness & Training Lifecycle'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which metric best indicates security awareness training effectiveness?',
                'options' => [
                    'Number of training hours completed',
                    'Reduction in security incidents over time',
                    'Percentage of employees who attended',
                    'Cost per trainee'
                ],
                'correct_options' => ['Reduction in security incidents over time'],
                'justifications' => [
                    'Hours don\'t measure learning effectiveness',
                    'Correct - Behavioral change is the ultimate goal',
                    'Attendance doesn\'t equal understanding',
                    'Cost efficiency doesn\'t measure effectiveness'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Phishing Simulation Metrics & Gamification - Advanced Analytics - Item 38 (Bloom 3)
            [
                'topic_id' => $topics['Phishing Simulation Metrics & Gamification'] ?? 4,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How should organizations respond to departments with consistently high phishing click rates?',
                'options' => [
                    'Punish the entire department',
                    'Provide targeted additional training and support',
                    'Remove their email access',
                    'Ignore the results'
                ],
                'correct_options' => ['Provide targeted additional training and support'],
                'justifications' => [
                    'Punishment damages security culture',
                    'Correct - Address root causes with education',
                    'Email access is necessary for business',
                    'High-risk groups need intervention'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Behavioral Analytics & User Risk Scoring - Risk Response Strategies - Item 39 (Bloom 4)
            [
                'topic_id' => $topics['Behavioral Analytics & User Risk Scoring'] ?? 5,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which adaptive control is most appropriate for users with elevated risk scores?',
                'options' => [
                    'Immediate account suspension',
                    'Additional authentication requirements',
                    'Complete system access removal',
                    'Public notification of risk status'
                ],
                'correct_options' => ['Additional authentication requirements'],
                'justifications' => [
                    'Suspension may be premature without investigation',
                    'Correct - Step-up authentication based on risk level',
                    'Complete removal may harm business operations',
                    'Public notification violates privacy'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Insider Threats - Detection and Response - Item 40 (Bloom 3)
            [
                'topic_id' => $topics['Insider Threats'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the most effective approach for detecting malicious insider behavior?',
                'options' => [
                    'Installing security cameras everywhere',
                    'Combining technical monitoring with behavioral indicators',
                    'Randomly searching employee belongings',
                    'Requiring polygraph tests'
                ],
                'correct_options' => ['Combining technical monitoring with behavioral indicators'],
                'justifications' => [
                    'Cameras don\'t detect digital threats',
                    'Correct - Multi-layered approach is most effective',
                    'Physical searches are invasive and limited',
                    'Polygraphs are unreliable and invasive'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Acceptable Use Policy (AUP) - Policy Enforcement - Item 41 (Bloom 4)
            [
                'topic_id' => $topics['Acceptable Use Policy (AUP)'] ?? 6,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How should AUP violations be handled to maintain security culture?',
                'options' => [
                    'Immediate termination for any violation',
                    'Progressive discipline based on violation severity',
                    'Ignore minor violations completely',
                    'Public shaming of violators'
                ],
                'correct_options' => ['Progressive discipline based on violation severity'],
                'justifications' => [
                    'Extreme responses damage trust',
                    'Correct - Proportional response maintains fairness',
                    'Ignoring violations undermines policy',
                    'Public shaming creates negative culture'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // BYOD Policy - Risk Management - Item 42 (Bloom 3)
            [
                'topic_id' => $topics['Bring Your Own Device (BYOD) Policy'] ?? 7,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What is the primary security challenge with BYOD implementations?',
                'options' => [
                    'Device compatibility issues',
                    'Mixing personal and corporate data on same device',
                    'Higher device costs',
                    'Reduced employee productivity'
                ],
                'correct_options' => ['Mixing personal and corporate data on same device'],
                'justifications' => [
                    'Compatibility is technical, not security issue',
                    'Correct - Data separation is the key security challenge',
                    'BYOD typically reduces costs',
                    'BYOD often improves productivity'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Clear Desk / Clear Screen Policy - Implementation Strategies - Item 43 (Bloom 3)
            [
                'topic_id' => $topics['Clear Desk / Clear Screen Policy'] ?? 8,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'How can organizations effectively enforce clear desk policies?',
                'options' => [
                    'Surprise inspections with penalties',
                    'Regular education combined with periodic friendly audits',
                    'Installing surveillance cameras',
                    'Making employees work without any papers'
                ],
                'correct_options' => ['Regular education combined with periodic friendly audits'],
                'justifications' => [
                    'Punitive approaches create resistance',
                    'Correct - Education plus gentle enforcement builds compliance',
                    'Surveillance may violate privacy laws',
                    'Paperless isn\'t always practical or secure'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Non-Disclosure Agreement (NDA) - Legal Requirements - Item 44 (Bloom 4)
            [
                'topic_id' => $topics['Non-Disclosure Agreement (NDA)'] ?? 9,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What makes an NDA legally enforceable?',
                'options' => [
                    'It must be notarized',
                    'Reasonable scope, consideration, and clear terms',
                    'It must be written by a lawyer',
                    'Employee must initial every page'
                ],
                'correct_options' => ['Reasonable scope, consideration, and clear terms'],
                'justifications' => [
                    'Notarization is not required for enforceability',
                    'Correct - These elements make contracts legally binding',
                    'Legal review helps but lawyer authorship not required',
                    'Initials are good practice but not legally required'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // Candidate Screening & Background Checks - Compliance Requirements - Item 45 (Bloom 4)
            [
                'topic_id' => $topics['Candidate Screening & Background Checks'] ?? 10,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Which legal requirement must organizations follow when conducting background checks?',
                'options' => [
                    'Check every possible database',
                    'Obtain written consent before conducting checks',
                    'Share results with all hiring managers',
                    'Keep results indefinitely'
                ],
                'correct_options' => ['Obtain written consent before conducting checks'],
                'justifications' => [
                    'Comprehensive checks aren\'t legally required',
                    'Correct - Fair Credit Reporting Act requires consent',
                    'Results should be limited to need-to-know',
                    'Retention periods are typically limited'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 4,
                'status' => 'published'
            ],

            // On-Boarding & Security Briefings - Role-Based Training - Item 46 (Bloom 3)
            [
                'topic_id' => $topics['On-Boarding & Security Briefings'] ?? 11,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Why should security briefings be tailored to specific job roles?',
                'options' => [
                    'To save training time',
                    'Different roles face different security risks and responsibilities',
                    'To comply with regulations',
                    'All employees need identical training'
                ],
                'correct_options' => ['Different roles face different security risks and responsibilities'],
                'justifications' => [
                    'Effectiveness matters more than time savings',
                    'Correct - Relevance improves engagement and retention',
                    'While compliance may require this, relevance is primary reason',
                    'One-size-fits-all training is less effective'
                ],
                'difficulty_level' => 2,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Termination / Exit Process - Security Handover - Item 47 (Bloom 3)
            [
                'topic_id' => $topics['Termination / Exit Process'] ?? 13,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'What should happen to data created by an employee on their personal devices for work?',
                'options' => [
                    'Employee keeps all data',
                    'Data must be transferred to corporate systems before termination',
                    'Delete all data immediately',
                    'Data ownership is unclear'
                ],
                'correct_options' => ['Data must be transferred to corporate systems before termination'],
                'justifications' => [
                    'Corporate work product belongs to the company',
                    'Correct - Work data must be preserved for business continuity',
                    'Deletion may violate legal or business requirements',
                    'Policies should clearly define data ownership'
                ],
                'difficulty_level' => 3,
                'bloom_level' => 3,
                'status' => 'published'
            ],

            // Social Engineering - Cultural Adaptation - Item 48 (Bloom 5)
            [
                'topic_id' => $topics['Social Engineering'] ?? 1,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the most effective strategy for social engineering awareness in multicultural organizations:',
                'options' => [
                    'Use identical training materials for all locations',
                    'Adapt scenarios and examples to local cultural contexts',
                    'Focus only on technical controls',
                    'Assume cultural differences don\'t matter'
                ],
                'correct_options' => ['Adapt scenarios and examples to local cultural contexts'],
                'justifications' => [
                    'One-size-fits-all misses cultural nuances',
                    'Correct - Culturally relevant scenarios improve recognition',
                    'Technical controls alone are insufficient',
                    'Cultural differences significantly impact social engineering effectiveness'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Security Awareness & Training Lifecycle - Program Evolution - Item 49 (Bloom 5)
            [
                'topic_id' => $topics['Security Awareness & Training Lifecycle'] ?? 3,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Assess the best approach for evolving security awareness programs to address emerging threats:',
                'options' => [
                    'Wait for major incidents before updating training',
                    'Continuously monitor threat landscape and adapt content accordingly',
                    'Update training every five years',
                    'Focus only on traditional threats'
                ],
                'correct_options' => ['Continuously monitor threat landscape and adapt content accordingly'],
                'justifications' => [
                    'Reactive approach leaves employees vulnerable',
                    'Correct - Proactive adaptation keeps training relevant',
                    'Annual or bi-annual updates are too infrequent',
                    'Emerging threats require new training approaches'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
                'status' => 'published'
            ],

            // Insider Threats - Program Design - Item 50 (Bloom 5)
            [
                'topic_id' => $topics['Insider Threats'] ?? 2,
                'type_id' => 1,
                'dimension' => 'Managerial',
                'content' => 'Evaluate the most balanced approach to insider threat programs:',
                'options' => [
                    'Maximum surveillance with minimal employee privacy',
                    'Balance security monitoring with employee rights and trust',
                    'Trust employees completely without monitoring',
                    'Focus only on technical controls'
                ],
                'correct_options' => ['Balance security monitoring with employee rights and trust'],
                'justifications' => [
                    'Excessive surveillance damages culture and may violate laws',
                    'Correct - Effective programs balance protection with privacy',
                    'Complete trust ignores real insider threat risks',
                    'Human factors are crucial in insider threat programs'
                ],
                'difficulty_level' => 4,
                'bloom_level' => 5,
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