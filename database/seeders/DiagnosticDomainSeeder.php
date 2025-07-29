<?php

namespace Database\Seeders;

use App\Models\DiagnosticDomain;
use App\Models\DiagnosticTopic;
use App\Models\DiagnosticSubtopic;
use Illuminate\Database\Seeder;

class DiagnosticDomainSeeder extends Seeder
{
    public function run(): void
    {
        // Example domain structure
        $domains = [
            [
                'name' => 'Security and Risk Management',
                'code' => 'SRM',
                'description' => 'Fundamental security concepts, risk management, and compliance',
                'category' => 'foundational',
                'color' => 'blue',
                'priority_order' => 1,
                'is_active' => true,
                'topics' => [
                    [
                        'name' => 'Information Security Governance',
                        'description' => 'Security policies, standards, and procedures',
                        'subtopics' => [
                            ['name' => 'Security Policies', 'description' => 'Development and management of security policies'],
                            ['name' => 'Standards and Procedures', 'description' => 'Implementation of security standards'],
                            ['name' => 'Compliance Management', 'description' => 'Regulatory compliance and auditing']
                        ]
                    ],
                    [
                        'name' => 'Risk Management',
                        'description' => 'Risk assessment, analysis, and mitigation strategies',
                        'subtopics' => [
                            ['name' => 'Risk Assessment', 'description' => 'Identifying and evaluating risks'],
                            ['name' => 'Risk Analysis', 'description' => 'Quantitative and qualitative risk analysis'],
                            ['name' => 'Risk Mitigation', 'description' => 'Strategies for risk reduction']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Asset Security',
                'code' => 'AS',
                'description' => 'Protection of organizational assets and data classification',
                'category' => 'technical',
                'color' => 'green',
                'priority_order' => 2,
                'is_active' => true,
                'topics' => [
                    [
                        'name' => 'Data Classification',
                        'description' => 'Categorizing data based on sensitivity',
                        'subtopics' => [
                            ['name' => 'Classification Schemes', 'description' => 'Public, private, confidential, secret'],
                            ['name' => 'Labeling and Handling', 'description' => 'Proper data labeling procedures'],
                            ['name' => 'Data Retention', 'description' => 'Retention policies and disposal']
                        ]
                    ],
                    [
                        'name' => 'Asset Management',
                        'description' => 'Tracking and protecting organizational assets',
                        'subtopics' => [
                            ['name' => 'Asset Inventory', 'description' => 'Maintaining asset registers'],
                            ['name' => 'Asset Ownership', 'description' => 'Assigning asset responsibilities'],
                            ['name' => 'Asset Disposal', 'description' => 'Secure disposal procedures']
                        ]
                    ]
                ]
            ],
            [
                'name' => 'Security Architecture and Engineering',
                'code' => 'SAE',
                'description' => 'Design and implementation of secure systems',
                'category' => 'technical',
                'color' => 'purple',
                'priority_order' => 3,
                'is_active' => true,
                'topics' => [
                    [
                        'name' => 'Secure Design Principles',
                        'description' => 'Fundamental principles of secure system design',
                        'subtopics' => [
                            ['name' => 'Defense in Depth', 'description' => 'Layered security approach'],
                            ['name' => 'Least Privilege', 'description' => 'Minimal access rights principle'],
                            ['name' => 'Separation of Duties', 'description' => 'Dividing critical functions']
                        ]
                    ]
                ]
            ]
        ];

        foreach ($domains as $domainData) {
            $topics = $domainData['topics'];
            unset($domainData['topics']);
            
            $domain = DiagnosticDomain::create($domainData);
            
            foreach ($topics as $topicData) {
                $subtopics = $topicData['subtopics'];
                unset($topicData['subtopics']);
                
                $topic = $domain->topics()->create($topicData);
                
                foreach ($subtopics as $index => $subtopicData) {
                    $subtopicData['sort_order'] = $index + 1;
                    $topic->subtopics()->create($subtopicData);
                }
            }
        }
    }
}