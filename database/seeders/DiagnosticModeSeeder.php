<?php

namespace Database\Seeders;

use App\Models\DiagnosticMode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DiagnosticModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modes = [
            [
                'slug' => 'test',
                'name' => 'Test Mode',
                'question_count' => 20,
                'duration_minutes' => 15,
                'cooldown_hours' => 0,
                'is_active' => true,
                'is_dev_only' => true,
                'sort_order' => 0,
                'color_scheme' => 'orange',
                'icon' => 'beaker',
                'badge_text' => 'TEST MODE',
                'description' => 'Quick functionality test covering 4 core security domains. Perfect for experiencing the platform before committing to a full assessment.',
                'features' => [
                    'display_features' => [
                        'Covers 4 foundational domains',
                        '5 questions per domain',
                        'No cooldown period',
                        'Instant results'
                    ],
                    'domain_selection' => [
                        'total_domains' => 4,
                        'questions_per_domain' => 5,
                        'selection_strategy' => [
                            'foundational' => 2,
                            'technical' => 2,
                            'managerial' => 0
                        ]
                    ],
                    'question_selection' => [
                        'starting_bloom_level' => 3,
                        'adaptive_progression' => true,
                        'fallback_strategy' => 'adjacent_bloom',
                        'domain_balancing' => 'strict'
                    ],
                    'early_termination' => [
                        'enabled' => false,
                        'min_questions' => 15,
                        'mastery_threshold' => 0.75
                    ],
                    'algorithm' => [
                        'type' => 'standard',
                        'adaptive_enabled' => false,
                        'early_stopping' => false,
                        'domain_balancing' => true
                    ]
                ],
                'price' => 0,
            ],
            [
                'slug' => 'quick',
                'name' => 'Quick Diagnostic',
                'question_count' => 50,
                'duration_minutes' => 30,
                'cooldown_hours' => 24,
                'is_active' => true,
                'is_dev_only' => false,
                'sort_order' => 1,
                'color_scheme' => 'green',
                'icon' => 'lightning-bolt',
                'description' => 'Rapid assessment covering 10 critical security domains. Get a quick overview of your cybersecurity knowledge in just 30 minutes.',
                'features' => [
                    'display_features' => [
                        'Covers 10 security domains',
                        'Adaptive difficulty adjustment',
                        '24-hour cooldown period',
                        'Personalized skill report'
                    ],
                    'domain_selection' => [
                        'total_domains' => 10,
                        'questions_per_domain' => 5,
                        'selection_strategy' => [
                            'foundational' => 3,
                            'technical' => 5,
                            'managerial' => 2
                        ]
                    ],
                    'question_selection' => [
                        'starting_bloom_level' => 3,
                        'adaptive_progression' => true,
                        'fallback_strategy' => 'adjacent_bloom',
                        'domain_balancing' => 'strict'
                    ],
                    'early_termination' => [
                        'enabled' => true,
                        'min_questions' => 30,
                        'mastery_threshold' => 0.8,
                        'poor_performance' => [
                            'consecutive_failures' => 8,
                            'accuracy_threshold' => 0.2,
                            'min_questions_before_stop' => 35
                        ]
                    ],
                    'algorithm' => [
                        'type' => 'adaptive',
                        'adaptive_enabled' => true,
                        'early_stopping' => true,
                        'domain_balancing' => true
                    ],
                    'scoring' => [
                        'domain_mastery_bloom' => 6,
                        'report_detail_level' => 'standard'
                    ]
                ],
                'price' => 0,
            ],
            [
                'slug' => 'standard',
                'name' => 'Standard Diagnostic',
                'question_count' => 75,
                'duration_minutes' => 45,
                'cooldown_hours' => 48,
                'is_active' => true,
                'is_dev_only' => false,
                'sort_order' => 2,
                'color_scheme' => 'blue',
                'icon' => 'check-circle',
                'badge_text' => 'RECOMMENDED',
                'description' => 'Our recommended assessment covering 15 security domains. Provides comprehensive insights while respecting your time investment.',
                'features' => [
                    'display_features' => [
                        'Covers 15 security domains',
                        'Balanced technical & managerial',
                        'Detailed competency analysis',
                        'Career pathway recommendations'
                    ],
                    'domain_selection' => [
                        'total_domains' => 15,
                        'questions_per_domain' => 5,
                        'selection_strategy' => [
                            'foundational' => 4,
                            'technical' => 8,
                            'managerial' => 3
                        ]
                    ],
                    'question_selection' => [
                        'starting_bloom_level' => 3,
                        'adaptive_progression' => true,
                        'fallback_strategy' => 'adjacent_bloom',
                        'domain_balancing' => 'strict'
                    ],
                    'early_termination' => [
                        'enabled' => true,
                        'min_questions' => 45,
                        'mastery_threshold' => 0.85,
                        'poor_performance' => [
                            'consecutive_failures' => 8,
                            'accuracy_threshold' => 0.2,
                            'min_questions_before_stop' => 50
                        ],
                        'stability_check' => [
                            'required_stable_questions' => 10,
                            'stability_window' => 4
                        ]
                    ],
                    'algorithm' => [
                        'type' => 'adaptive',
                        'adaptive_enabled' => true,
                        'early_stopping' => true,
                        'domain_balancing' => true,
                        'difficulty_adaptation' => true
                    ],
                    'scoring' => [
                        'domain_mastery_bloom' => 6,
                        'report_detail_level' => 'detailed'
                    ],
                    'timing' => [
                        'strict_timing' => false,
                        'pause_allowed' => true,
                        'time_warnings' => [15, 5]
                    ]
                ],
                'price' => 0,
            ],
            [
                'slug' => 'indepth',
                'name' => 'In-depth Diagnostic',
                'question_count' => 100,
                'duration_minutes' => 90,
                'cooldown_hours' => 72,
                'is_active' => true,
                'is_dev_only' => false,
                'sort_order' => 3,
                'color_scheme' => 'purple',
                'icon' => 'clipboard-list',
                'description' => 'Complete assessment covering all 20 security domains. The most thorough evaluation for serious cybersecurity professionals.',
                'features' => [
                    'display_features' => [
                        'Covers all 20 security domains',
                        'Complete knowledge assessment',
                        'Granular skill analysis',
                        'Professional development roadmap'
                    ],
                    'domain_selection' => [
                        'total_domains' => 20,
                        'questions_per_domain' => 5,
                        'selection_strategy' => [
                            'foundational' => 5,
                            'technical' => 10,
                            'managerial' => 5
                        ]
                    ],
                    'question_selection' => [
                        'starting_bloom_level' => 3,
                        'adaptive_progression' => true,
                        'fallback_strategy' => 'adjacent_bloom',
                        'domain_balancing' => 'strict'
                    ],
                    'early_termination' => [
                        'enabled' => true,
                        'min_questions' => 60,
                        'mastery_threshold' => 0.9,
                        'poor_performance' => [
                            'consecutive_failures' => 10,
                            'accuracy_threshold' => 0.15,
                            'min_questions_before_stop' => 70
                        ],
                        'stability_check' => [
                            'required_stable_questions' => 15,
                            'stability_window' => 5
                        ]
                    ],
                    'algorithm' => [
                        'type' => 'adaptive',
                        'adaptive_enabled' => true,
                        'early_stopping' => true,
                        'domain_balancing' => true,
                        'difficulty_adaptation' => true
                    ],
                    'scoring' => [
                        'domain_mastery_bloom' => 6,
                        'report_detail_level' => 'comprehensive'
                    ],
                    'timing' => [
                        'strict_timing' => false,
                        'pause_allowed' => true,
                        'time_warnings' => [30, 15, 5],
                        'auto_submit' => true
                    ]
                ],
                'price' => 0,
            ],
        ];

        foreach ($modes as $mode) {
            DiagnosticMode::updateOrCreate(
                ['slug' => $mode['slug']],
                $mode
            );
        }
    }
}
