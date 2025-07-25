<?php

// Domain seeder generator script
$domains = [
    3 => [
        'name' => 'Legal, Regulatory & Compliance',
        'dimension' => 'Managerial',
        'topics' => [
            'Compliance Requirements',
            'Contracts', 
            'Industry Specific Regulations',
            'Intellectual Property',
            'Investigation Types'
        ]
    ],
    4 => [
        'name' => 'Privacy',
        'dimension' => 'Managerial',
        'topics' => [
            'Personal Information',
            'Privacy Principles',
            'Data Subject Rights',
            'Privacy Governance',
            'Privacy Protection'
        ]
    ],
    5 => [
        'name' => 'Risk Management',
        'dimension' => 'Managerial',
        'topics' => [
            'Risk Management Fundamentals',
            'Risk Identification',
            'Risk Assessment',
            'Risk Response & Treatment',
            'Risk Monitoring & Reporting'
        ]
    ],
    6 => [
        'name' => 'Security Audits & Assessments',
        'dimension' => 'Managerial',
        'topics' => [
            'Audit Fundamentals',
            'Evidence Gathering',
            'Control Assessment',
            'Testing Methodologies & Approaches',
            'Security Testing'
        ]
    ],
    7 => [
        'name' => 'Threat & Vulnerability Management',
        'dimension' => 'Technical',
        'topics' => [
            'Threat Actors',
            'TTPs',
            'Vulnerability Management',
            'Vulnerability Assessment',
            'Malware'
        ]
    ],
    8 => [
        'name' => 'Cryptography & Key Management',
        'dimension' => 'Technical',
        'topics' => [
            'Cryptography Algorithms',
            'Cryptographic Applications',
            'Public Key Infrastructure (PKI)',
            'Key Management',
            'Cryptanalysis'
        ]
    ],
    9 => [
        'name' => 'Data Governance',
        'dimension' => 'Managerial',
        'topics' => [
            'Data Classification & Categorization',
            'Data Lifecycle Management',
            'Data Retention & Archival',
            'Data Sanitization',
            'Data Security Controls'
        ]
    ],
    10 => [
        'name' => 'Identity and Access Management (IAM)',
        'dimension' => 'Technical',
        'topics' => [
            'Identification',
            'Authentication',
            'Authorization',
            'Accounting (Auditing)',
            'Federation & Advanced IAM'
        ]
    ],
    11 => [
        'name' => 'Network Concepts',
        'dimension' => 'Technical',
        'topics' => [
            'OSI Model',
            'TCP/IP Protocols',
            'Network Appliances',
            'Network Services',
            'Communication Protocols'
        ]
    ],
    12 => [
        'name' => 'Network Security',
        'dimension' => 'Technical',
        'topics' => [
            'Security Protocols',
            'Network Attacks',
            'Network Segmentation',
            'Wireless Security',
            'Network Diagnostic Tools'
        ]
    ],
    13 => [
        'name' => 'Application Security',
        'dimension' => 'Technical',
        'topics' => [
            'Secure Software Development Lifecycle (SSDLC)',
            'Development Models',
            'Application Vulnerabilities',
            'Security Testing',
            'Secure Coding'
        ]
    ],
    14 => [
        'name' => 'Cloud Security',
        'dimension' => 'Technical',
        'topics' => [
            'Cloud Fundamentals',
            'Cloud Models',
            'Cloud Governance',
            'Cloud Security Controls',
            'Cloud Infrastructure Security'
        ]
    ],
    15 => [
        'name' => 'Endpoint, Mobile & IoT Security',
        'dimension' => 'Technical',
        'topics' => [
            'Endpoint Security',
            'Device Security',
            'Mobile Security',
            'IoT Security',
            'OT Security'
        ]
    ],
    16 => [
        'name' => 'Security Awareness & Human Factors',
        'dimension' => 'Managerial',
        'topics' => [
            'Social Engineering',
            'Security Awareness & Training',
            'Human Resource Security',
            'Personnel Safety',
            'Personnel Security Controls'
        ]
    ],
    17 => [
        'name' => 'Physical & Environmental Security',
        'dimension' => 'Managerial',
        'topics' => [
            'Physical Access Control',
            'Fire',
            'Power',
            'Site Design',
            'Environmental Controls'
        ]
    ],
    18 => [
        'name' => 'Security Operations & Monitoring',
        'dimension' => 'Technical',
        'topics' => [
            'Security Operations Center (SOC)',
            'Log Management',
            'Detection',
            'Response',
            'Monitoring'
        ]
    ],
    19 => [
        'name' => 'Incident Management',
        'dimension' => 'Managerial',
        'topics' => [
            'Preparation',
            'Detection, Triage & Analysis',
            'Containment',
            'Eradication & Recovery',
            'Post-Incident Activity'
        ]
    ],
    20 => [
        'name' => 'Business Continuity & Disaster Recovery',
        'dimension' => 'Managerial',
        'topics' => [
            'Business Impact Analysis (BIA)',
            'Business Continuity Planning',
            'Disaster Recovery',
            'Recovery Strategy',
            'Testing'
        ]
    ]
];

// Generate sample questions for each domain
function generateQuestions($domainNum, $domainName, $dimension, $topics) {
    $questions = [];
    $bloomCounts = [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0];
    $targetDistribution = [1 => 7, 2 => 10, 3 => 16, 4 => 10, 5 => 5, 6 => 5];
    
    // Generate 10 questions per topic (50 total)
    foreach ($topics as $topicIdx => $topic) {
        for ($i = 0; $i < 10; $i++) {
            // Determine bloom level to match distribution
            $bloomLevel = 3; // Default
            foreach ($targetDistribution as $level => $target) {
                if ($bloomCounts[$level] < $target) {
                    $bloomLevel = $level;
                    break;
                }
            }
            $bloomCounts[$bloomLevel]++;
            
            // Set difficulty based on bloom level
            if ($bloomLevel <= 2) {
                $difficulty = 'easy';
                $irtB = rand(-20, -5) / 10; // -2.0 to -0.5
            } elseif ($bloomLevel <= 4) {
                $difficulty = 'medium';
                $irtB = rand(-5, 5) / 10; // -0.5 to 0.5
            } elseif ($bloomLevel == 5) {
                $difficulty = 'hard';
                $irtB = rand(5, 15) / 10; // 0.5 to 1.5
            } else {
                $difficulty = 'expert';
                $irtB = rand(10, 20) / 10; // 1.0 to 2.0
            }
            
            $questions[] = [
                'topic' => $topic,
                'subtopic' => "Subtopic for $topic",
                'question' => "Sample question for $topic in $domainName (Q" . (count($questions) + 1) . ")?",
                'options' => [
                    'Option A - First choice',
                    'Option B - Second choice',
                    'Option C - Third choice',
                    'Option D - Fourth choice'
                ],
                'correct_answer' => chr(65 + rand(0, 3)), // Random A-D
                'bloom_level' => $bloomLevel,
                'difficulty' => $difficulty,
                'irt_a' => rand(8, 18) / 10, // 0.8 to 1.8
                'irt_b' => $irtB,
                'irt_c' => 0.2
            ];
        }
    }
    
    return $questions;
}

// Generate seeders for each domain
foreach ($domains as $domainNum => $domainInfo) {
    $className = "D{$domainNum}" . str_replace(['&', ',', ' ', '-'], '', $domainInfo['name']) . "Seeder";
    $fileName = "/Users/saaz/Library/Mobile Documents/com~apple~CloudDocs/Sites/saaz/database/seeders/Diagnostics/{$className}.php";
    
    $questions = generateQuestions($domainNum, $domainInfo['name'], $domainInfo['dimension'], $domainInfo['topics']);
    
    // Generate PHP array code for questions
    $questionsCode = "[\n";
    foreach ($questions as $q) {
        $questionsCode .= "            [\n";
        $questionsCode .= "                'topic' => '{$q['topic']}',\n";
        $questionsCode .= "                'subtopic' => '{$q['subtopic']}',\n";
        $questionsCode .= "                'question' => '{$q['question']}',\n";
        $questionsCode .= "                'options' => [\n";
        foreach ($q['options'] as $opt) {
            $questionsCode .= "                    '$opt',\n";
        }
        $questionsCode .= "                ],\n";
        $questionsCode .= "                'correct_answer' => '{$q['correct_answer']}',\n";
        $questionsCode .= "                'bloom_level' => {$q['bloom_level']},\n";
        $questionsCode .= "                'difficulty' => '{$q['difficulty']}',\n";
        $questionsCode .= "                'irt_a' => {$q['irt_a']},\n";
        $questionsCode .= "                'irt_b' => {$q['irt_b']},\n";
        $questionsCode .= "                'irt_c' => {$q['irt_c']}\n";
        $questionsCode .= "            ],\n";
    }
    $questionsCode .= "        ]";
    
    $content = <<<PHP
<?php

namespace Database\Seeders\Diagnostics;

use App\Models\DiagnosticDomain;
use App\Models\DiagnosticItem;
use App\Models\DiagnosticSubtopic;
use App\Models\DiagnosticTopic;
use Illuminate\Database\Seeder;

class {$className} extends Seeder
{
    public function run(): void
    {
        \$domain = DiagnosticDomain::where('name', '{$domainInfo['name']}')->first();
        
        if (!\$domain) {
            \$this->command->error('{$domainInfo['name']} domain not found!');
            return;
        }
        
        // Get topics
        \$topics = DiagnosticTopic::where('domain_id', \$domain->id)
            ->orderBy('id')
            ->get()
            ->keyBy('name');
        
        // Get subtopics
        \$subtopics = DiagnosticSubtopic::whereHas('topic.domain', function(\$query) {
            \$query->where('name', '{$domainInfo['name']}');
        })->get()->groupBy('topic_id')->map(function(\$items) {
            return \$items->pluck('id', 'name');
        });
        
        \$questions = $questionsCode;
        
        // Insert questions
        foreach (\$questions as \$index => \$q) {
            \$topic = \$topics[\$q['topic']] ?? null;
            if (!\$topic) {
                \$this->command->error("Topic not found: {\$q['topic']}");
                continue;
            }
            
            \$subtopicId = null;
            if (isset(\$subtopics[\$topic->id]) && isset(\$q['subtopic'])) {
                \$subtopicId = \$subtopics[\$topic->id][\$q['subtopic']] ?? null;
            }
            
            // Convert correct answer letter to option text
            \$correctOption = \$q['options'][ord(\$q['correct_answer']) - ord('A')];
            
            // Generate justifications
            \$justifications = [];
            foreach (\$q['options'] as \$idx => \$option) {
                \$isCorrect = (chr(ord('A') + \$idx) === \$q['correct_answer']);
                \$justifications[] = \$isCorrect ? "Correct - This is the right answer" : "Incorrect - This is not the best answer";
            }
            
            // Map difficulty to numeric level
            \$difficultyMap = [
                'easy' => 1,
                'medium' => 3,
                'hard' => 5,
                'expert' => 6
            ];
            
            DiagnosticItem::create([
                'topic_id' => \$topic->id,
                'subtopic_id' => \$subtopicId,
                'type_id' => 1,
                'dimension' => '{$domainInfo['dimension']}',
                'content' => \$q['question'],
                'options' => \$q['options'],
                'correct_options' => [\$correctOption],
                'justifications' => \$justifications,
                'difficulty_level' => \$difficultyMap[\$q['difficulty']] ?? 3,
                'bloom_level' => \$q['bloom_level'],
                'irt_a' => \$q['irt_a'],
                'irt_b' => \$q['irt_b'],
                'irt_c' => \$q['irt_c'],
                'status' => 'published'
            ]);
        }
        
        \$this->command->info('D{$domainNum}: {$domainInfo['name']} questions seeded successfully!');
    }
}
PHP;
    
    file_put_contents($fileName, $content);
    echo "Created: $fileName\n";
}

echo "All domain seeders created!\n";