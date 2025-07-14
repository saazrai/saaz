<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosticMode extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'question_count',
        'duration_minutes',
        'cooldown_hours',
        'is_active',
        'is_dev_only',
        'sort_order',
        'color_scheme',
        'icon',
        'description',
        'features',
        'price',
        'badge_text',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
        'is_dev_only' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeForEnvironment($query)
    {
        if (app()->environment('production')) {
            return $query->where('is_dev_only', false);
        }
        return $query;
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function isAvailableForUser($user = null)
    {
        if (!$this->is_active) {
            return false;
        }
        
        if ($this->is_dev_only && app()->environment('production')) {
            return $user && $user->hasRole('admin');
        }
        
        return true;
    }

    public function canUserRetake($user)
    {
        if ($this->cooldown_hours === null || $this->cooldown_hours === 0) {
            return true;
        }

        $lastAttempt = $user->diagnostics()
            ->where('mode', $this->slug)
            ->where('status', 'completed')
            ->latest()
            ->first();

        if (!$lastAttempt) {
            return true;
        }

        $cooldownEndsAt = $lastAttempt->created_at->addHours($this->cooldown_hours);
        return now()->gte($cooldownEndsAt);
    }

    public function getTimeUntilRetake($user)
    {
        if ($this->cooldown_hours === null || $this->cooldown_hours === 0) {
            return null;
        }

        $lastAttempt = $user->diagnostics()
            ->where('mode', $this->slug)
            ->where('status', 'completed')
            ->latest()
            ->first();

        if (!$lastAttempt) {
            return null;
        }

        $cooldownEndsAt = $lastAttempt->created_at->addHours($this->cooldown_hours);
        
        if (now()->gte($cooldownEndsAt)) {
            return null;
        }

        return now()->diff($cooldownEndsAt);
    }

    public function getColorClasses()
    {
        $colors = [
            'orange' => 'border-orange-300 bg-orange-100',
            'green' => 'border-green-300 bg-green-100',
            'blue' => 'border-blue-300 bg-blue-100',
            'purple' => 'border-purple-300 bg-purple-100',
            'red' => 'border-red-300 bg-red-100',
            'yellow' => 'border-yellow-300 bg-yellow-100',
        ];

        return $colors[$this->color_scheme] ?? 'border-gray-300 bg-gray-100';
    }

    public function getButtonColorClasses()
    {
        $colors = [
            'orange' => 'bg-orange-600 hover:bg-orange-700',
            'green' => 'bg-green-600 hover:bg-green-700',
            'blue' => 'bg-blue-600 hover:bg-blue-700',
            'purple' => 'bg-purple-600 hover:bg-purple-700',
            'red' => 'bg-red-600 hover:bg-red-700',
            'yellow' => 'bg-yellow-600 hover:bg-yellow-700',
        ];

        return $colors[$this->color_scheme] ?? 'bg-gray-600 hover:bg-gray-700';
    }

    /**
     * Get domain selection configuration
     */
    public function getDomainSelectionConfig(): array
    {
        return $this->features['domain_selection'] ?? [
            'total_domains' => $this->getDefaultDomainCount(),
            'questions_per_domain' => 5,
            'selection_strategy' => $this->getDefaultSelectionStrategy(),
        ];
    }

    /**
     * Get question selection configuration
     */
    public function getQuestionSelectionConfig(): array
    {
        return $this->features['question_selection'] ?? [
            'starting_bloom_level' => 3,
            'adaptive_progression' => true,
            'fallback_strategy' => 'adjacent_bloom',
            'domain_balancing' => 'strict',
        ];
    }

    /**
     * Get early termination configuration
     */
    public function getEarlyTerminationConfig(): array
    {
        return $this->features['early_termination'] ?? [
            'enabled' => true,
            'min_questions' => $this->getDefaultMinQuestions(),
            'mastery_threshold' => 0.8,
            'poor_performance' => [
                'consecutive_failures' => 8,
                'accuracy_threshold' => 0.2,
                'min_questions_before_stop' => $this->getDefaultMinQuestionsBeforeStop(),
            ],
            'stability_check' => [
                'required_stable_questions' => 10,
                'stability_window' => 4,
            ],
        ];
    }

    /**
     * Get scoring configuration
     */
    public function getScoringConfig(): array
    {
        return $this->features['scoring'] ?? [
            'domain_mastery_bloom' => 6,
            'proficiency_levels' => [
                'needs_foundation' => '1-2',
                'emerging' => '3',
                'developing' => '4',
                'proficient' => '5',
                'mastered' => '6',
            ],
            'report_detail_level' => 'standard',
        ];
    }

    /**
     * Get algorithm configuration
     */
    public function getAlgorithmConfig(): array
    {
        return $this->features['algorithm'] ?? [
            'type' => 'standard',
            'adaptive_enabled' => true,
            'early_stopping' => true,
            'domain_balancing' => true,
            'difficulty_adaptation' => true,
        ];
    }

    /**
     * Get timing configuration
     */
    public function getTimingConfig(): array
    {
        return $this->features['timing'] ?? [
            'strict_timing' => false,
            'time_warnings' => [15, 5],
            'pause_allowed' => true,
            'auto_submit' => true,
        ];
    }

    /**
     * Get display features (for backward compatibility)
     */
    public function getDisplayFeatures(): array
    {
        if (isset($this->features['display_features'])) {
            return $this->features['display_features'];
        }
        
        // Fallback to current array format for backward compatibility
        if (is_array($this->features) && !isset($this->features['domain_selection'])) {
            return $this->features;
        }
        
        return [];
    }

    /**
     * Get default domain count based on question count
     */
    private function getDefaultDomainCount(): int
    {
        return match (true) {
            $this->question_count <= 50 => 10,
            $this->question_count <= 75 => 15,
            default => 20,
        };
    }

    /**
     * Get default selection strategy based on domain count
     */
    private function getDefaultSelectionStrategy(): array
    {
        $domainCount = $this->getDefaultDomainCount();
        
        return match ($domainCount) {
            10 => ['foundational' => 3, 'technical' => 5, 'managerial' => 2],
            15 => ['foundational' => 4, 'technical' => 8, 'managerial' => 3],
            20 => ['foundational' => 5, 'technical' => 10, 'managerial' => 5],
            default => ['foundational' => 3, 'technical' => 5, 'managerial' => 2],
        };
    }

    /**
     * Get default minimum questions before termination
     */
    private function getDefaultMinQuestions(): int
    {
        return (int) ($this->question_count * 0.4); // 40% minimum completion
    }

    /**
     * Get default minimum questions before poor performance stop
     */
    private function getDefaultMinQuestionsBeforeStop(): int
    {
        return (int) ($this->question_count * 0.5); // 50% minimum before poor performance stop
    }

    /**
     * Validate configuration structure
     */
    public function validateConfiguration(): array
    {
        $errors = [];
        
        $domainConfig = $this->getDomainSelectionConfig();
        $questionConfig = $this->getQuestionSelectionConfig();
        $terminationConfig = $this->getEarlyTerminationConfig();
        
        // Validate domain selection
        if (($domainConfig['total_domains'] * $domainConfig['questions_per_domain']) !== $this->question_count) {
            $errors[] = "Domain configuration doesn't match question count: {$domainConfig['total_domains']} × {$domainConfig['questions_per_domain']} ≠ {$this->question_count}";
        }
        
        // Validate bloom level
        if ($questionConfig['starting_bloom_level'] < 1 || $questionConfig['starting_bloom_level'] > 6) {
            $errors[] = "Starting bloom level must be between 1 and 6";
        }
        
        // Validate termination config
        if ($terminationConfig['min_questions'] > $this->question_count) {
            $errors[] = "Minimum questions for termination cannot exceed total questions";
        }
        
        return $errors;
    }
}
