<?php

namespace Database\Seeders;

use App\Models\DiagnosticItem;
use App\Models\DiagnosticTopic;
use App\Models\QuestionType;
use Illuminate\Database\Seeder;

class DiagnosticItemsSeeder extends Seeder
{
    public function run(): void
    {
        // Get necessary data
        $topics = DiagnosticTopic::with('domain')->get();
        $questionTypes = QuestionType::whereIn('name', ['Multiple Choice Question', 'Multiple Select Question'])->pluck('id', 'name');
        
        // V1 Enhanced: Use simple integer mappings instead of V2+ tables
        $difficulties = ['Easy' => 1, 'Medium' => 2, 'Hard' => 3];
        $blooms = ['Remember' => 1, 'Understand' => 2, 'Apply' => 3, 'Analyze' => 4, 'Evaluate' => 5, 'Create' => 6];
        
        // Sample questions for each domain
        $domainQuestions = [
            'General Security Concepts' => [
                [
                    'topic' => 'CIA Triad',
                    'content' => 'Which of the following BEST describes the principle of "Availability" in the CIA Triad?',
                    'type' => 'Multiple Choice Question',
                    'options' => [
                        'Ensuring data is accurate and has not been tampered with',
                        'Ensuring authorized users have access to resources when needed',
                        'Ensuring only authorized users can access sensitive information',
                        'Ensuring users cannot deny their actions'
                    ],
                    'correct_options' => ['Ensuring authorized users have access to resources when needed'],
                    'justifications' => ['Availability ensures that information and resources are accessible to authorized users when required. This includes maintaining uptime, preventing denial of service, and ensuring business continuity.'],
                    'difficulty' => 'Easy',
                    'bloom' => 'Understand'
                ],
                [
                    'topic' => 'Non-repudiation',
                    'content' => 'Which of the following security mechanisms BEST provides non-repudiation?',
                    'type' => 'Multiple Choice Question',
                    'options' => [
                        'Encryption',
                        'Access control lists',
                        'Digital signatures',
                        'Intrusion detection systems'
                    ],
                    'correct_options' => ['Digital signatures'],
                    'justifications' => ['Digital signatures provide non-repudiation by cryptographically binding a user\'s identity to a message or transaction, making it impossible for them to deny their involvement.'],
                    'difficulty' => 'Medium',
                    'bloom' => 'Apply'
                ],
                [
                    'topic' => 'Security Controls',
                    'content' => 'Which of the following are examples of detective controls? (Select ALL that apply)',
                    'type' => 'Multiple Select Question',
                    'options' => [
                        'Security cameras',
                        'Firewall rules',
                        'Log monitoring',
                        'Access badges',
                        'Intrusion detection systems'
                    ],
                    'correct_options' => ['Security cameras', 'Log monitoring', 'Intrusion detection systems'],
                    'justifications' => [
                        'Security cameras detect and record activities',
                        'Log monitoring detects unusual patterns or behaviors',
                        'IDS detect potential security breaches',
                        'Firewall rules are preventive controls',
                        'Access badges are preventive controls'
                    ],
                    'difficulty' => 'Medium',
                    'bloom' => 'Analyze'
                ]
            ],
            'Risk Management' => [
                [
                    'topic' => 'Risk Assessment',
                    'content' => 'In quantitative risk assessment, what does Annual Loss Expectancy (ALE) represent?',
                    'type' => 'Multiple Choice Question',
                    'options' => [
                        'The cost of implementing a control',
                        'The expected yearly cost of a specific risk',
                        'The probability of a risk occurring',
                        'The maximum acceptable downtime'
                    ],
                    'correct_options' => ['The expected yearly cost of a specific risk'],
                    'justifications' => ['ALE = Single Loss Expectancy (SLE) × Annual Rate of Occurrence (ARO). It represents the expected monetary loss for an asset due to a risk over a one-year period.'],
                    'difficulty' => 'Medium',
                    'bloom' => 'Remember'
                ],
                [
                    'topic' => 'Risk Response & Treatment',
                    'content' => 'A company decides to purchase cyber insurance to cover potential data breach costs. This is an example of which risk treatment strategy?',
                    'type' => 'Multiple Choice Question',
                    'options' => [
                        'Risk avoidance',
                        'Risk mitigation',
                        'Risk transfer',
                        'Risk acceptance'
                    ],
                    'correct_options' => ['Risk transfer'],
                    'justifications' => ['Risk transfer involves shifting the financial burden of a risk to another party, typically through insurance or contractual agreements.'],
                    'difficulty' => 'Easy',
                    'bloom' => 'Apply'
                ]
            ],
            'Access Control' => [
                [
                    'topic' => 'Authentication & MFA',
                    'content' => 'Which of the following authentication factors would be classified as "something you are"?',
                    'type' => 'Multiple Choice Question',
                    'options' => [
                        'Password',
                        'Smart card',
                        'Fingerprint',
                        'SMS code'
                    ],
                    'correct_options' => ['Fingerprint'],
                    'justifications' => ['Biometric factors like fingerprints, facial recognition, and iris scans are classified as "something you are" authentication factors.'],
                    'difficulty' => 'Easy',
                    'bloom' => 'Remember'
                ],
                [
                    'topic' => 'Access-Control Models',
                    'content' => 'In which access control model do data owners assign permissions directly to users?',
                    'type' => 'Multiple Choice Question',
                    'options' => [
                        'Mandatory Access Control (MAC)',
                        'Discretionary Access Control (DAC)',
                        'Role-Based Access Control (RBAC)',
                        'Attribute-Based Access Control (ABAC)'
                    ],
                    'correct_options' => ['Discretionary Access Control (DAC)'],
                    'justifications' => ['In DAC, the owner of a resource has discretion over who can access it and what permissions they have.'],
                    'difficulty' => 'Medium',
                    'bloom' => 'Understand'
                ]
            ]
        ];
        
        // Create questions for each domain
        foreach ($domainQuestions as $domainName => $questions) {
            foreach ($questions as $questionData) {
                // Find the topic
                $topic = $topics->where('name', $questionData['topic'])
                    ->where('domain.name', $domainName)
                    ->first();
                    
                if (!$topic) {
                    continue;
                }
                
                DiagnosticItem::create([
                    'topic_id' => $topic->id,
                    'type_id' => 1, // Always use type_id = 1 (Multiple Choice Question)
                    'dimension' => 'Technical', // Default dimension
                    'content' => $questionData['content'],
                    'options' => $questionData['options'],
                    'correct_options' => $questionData['correct_options'],
                    'justifications' => $questionData['justifications'],
                    'difficulty_level' => $difficulties[$questionData['difficulty']],
                    'bloom_level' => $blooms[$questionData['bloom']],
                    'irt_a' => 1.0, // Default discrimination
                    'irt_b' => 0.0, // Default difficulty
                    'irt_c' => 0.25, // Default guessing
                    'status' => 'published'
                ]);
            }
        }
        
        // Generate additional questions to ensure we have enough for testing
        $this->generateAdditionalQuestions($topics, $questionTypes, $difficulties, $blooms);
    }
    
    private function generateAdditionalQuestions($topics, $questionTypes, $difficulties, $blooms)
    {
        // Expanded question templates for variety
        $sampleQuestions = [
            [
                'content' => 'What is the PRIMARY purpose of {topic}?',
                'options' => [
                    'To ensure compliance with regulations',
                    'To protect organizational assets',
                    'To reduce operational costs',
                    'To improve system performance'
                ],
                'correct_index' => 1
            ],
            [
                'content' => 'Which of the following BEST describes {topic}?',
                'options' => [
                    'A technical control measure',
                    'An administrative procedure',
                    'A physical security mechanism',
                    'A risk management strategy'
                ],
                'correct_index' => 0
            ],
            [
                'content' => 'In the context of {topic}, what should be the FIRST step?',
                'options' => [
                    'Implement security controls',
                    'Conduct risk assessment',
                    'Define policies and procedures',
                    'Train personnel'
                ],
                'correct_index' => 2
            ],
            [
                'content' => 'Which control type is MOST effective for {topic}?',
                'options' => [
                    'Preventive controls',
                    'Detective controls',
                    'Corrective controls',
                    'Compensating controls'
                ],
                'correct_index' => 0
            ],
            [
                'content' => 'What is the MAIN challenge when implementing {topic}?',
                'options' => [
                    'Technical complexity',
                    'User resistance',
                    'Cost constraints',
                    'Regulatory requirements'
                ],
                'correct_index' => 1
            ],
            [
                'content' => 'Which framework BEST supports {topic} implementation?',
                'options' => [
                    'NIST Cybersecurity Framework',
                    'ISO 27001',
                    'COBIT',
                    'ITIL'
                ],
                'correct_index' => 0
            ],
            [
                'content' => 'How does {topic} contribute to organizational security posture?',
                'options' => [
                    'By reducing attack surface',
                    'By improving incident response',
                    'By ensuring business continuity',
                    'By enhancing user awareness'
                ],
                'correct_index' => 0
            ],
            [
                'content' => 'What metric BEST measures the effectiveness of {topic}?',
                'options' => [
                    'Number of incidents prevented',
                    'Time to detect threats',
                    'Compliance score',
                    'User satisfaction rating'
                ],
                'correct_index' => 0
            ],
            [
                'content' => 'Which stakeholder is PRIMARILY responsible for {topic}?',
                'options' => [
                    'Chief Information Security Officer',
                    'IT Operations Manager',
                    'Business Unit Leaders',
                    'End Users'
                ],
                'correct_index' => 0
            ],
            [
                'content' => 'What is the MOST critical success factor for {topic}?',
                'options' => [
                    'Executive support',
                    'Adequate funding',
                    'Technical expertise',
                    'User training'
                ],
                'correct_index' => 0
            ]
        ];
        
        // Need 900 total questions (45 per domain for 20 domains)
        $currentCount = DiagnosticItem::count();
        $needed = max(0, 900 - $currentCount);
        
        // Get domain counts to ensure balanced distribution
        $domainCounts = [];
        $domains = \App\Models\DiagnosticDomain::all();
        
        foreach ($domains as $domain) {
            $domainTopics = $topics->where('domain_id', $domain->id);
            $domainQuestionCount = DiagnosticItem::whereIn('topic_id', $domainTopics->pluck('id'))->count();
            $domainCounts[$domain->id] = [
                'current' => $domainQuestionCount,
                'needed' => max(0, 45 - $domainQuestionCount),
                'topics' => $domainTopics->toArray()
            ];
        }
        
        $typeIds = array_values($questionTypes->toArray());
        $difficultyLevels = array_values($difficulties);
        $bloomLevels = array_values($blooms);
        
        // Generate questions ensuring balanced distribution across domains
        foreach ($domainCounts as $domainId => $domainData) {
            if (empty($domainData['topics'])) {
                continue;
            }
            
            for ($i = 0; $i < $domainData['needed']; $i++) {
                $topic = $domainData['topics'][array_rand($domainData['topics'])];
                $template = $sampleQuestions[array_rand($sampleQuestions)];
                
                $content = str_replace('{topic}', $topic['name'], $template['content']);
                $correctOption = $template['options'][$template['correct_index']];
                
                // Vary dimensions between Technical and Managerial
                $dimension = rand(0, 1) ? 'Technical' : 'Managerial';
                
                DiagnosticItem::create([
                    'topic_id' => $topic['id'],
                    'type_id' => 1, // Always use type_id = 1 (Multiple Choice Question)
                    'dimension' => $dimension,
                    'content' => $content,
                    'options' => $template['options'],
                    'correct_options' => [$correctOption],
                    'justifications' => ["This answer is correct because it directly relates to the core concept of {$topic['name']}."],
                    'difficulty_level' => $difficultyLevels[array_rand($difficultyLevels)],
                    'bloom_level' => $bloomLevels[array_rand($bloomLevels)],
                    'irt_a' => rand(50, 150) / 100, // 0.5 to 1.5
                    'irt_b' => rand(-200, 200) / 100, // -2.0 to 2.0
                    'irt_c' => rand(15, 35) / 100, // 0.15 to 0.35
                    'status' => 'published'
                ]);
            }
        }
    }
}