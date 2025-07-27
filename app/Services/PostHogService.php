<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PostHogService
{
    /**
     * Check if PostHog is enabled.
     */
    public static function isEnabled(): bool
    {
        return config('services.posthog.enabled') && 
               !empty(config('services.posthog.api_key')) &&
               !config('app.debug');
    }

    /**
     * Get PostHog configuration for frontend.
     */
    public static function getConfig(): array
    {
        return [
            'api_key' => config('services.posthog.api_key'),
            'host' => config('services.posthog.host'),
            'enabled' => static::isEnabled(),
            'capture_pageview' => true,
            'capture_pageleave' => true,
            'session_recording' => [
                'recordCrossOriginIframes' => false,
                'maskAllInputs' => true,
                'maskInputOptions' => [
                    'password' => true,
                    'email' => false,
                ],
            ],
        ];
    }

    /**
     * Track an event via server-side API.
     */
    public static function track(
        string $distinctId,
        string $event,
        array $properties = [],
        ?string $timestamp = null
    ): bool {
        if (!static::isEnabled()) {
            return false;
        }

        try {
            $payload = [
                'api_key' => config('services.posthog.api_key'),
                'event' => $event,
                'distinct_id' => $distinctId,
                'properties' => array_merge($properties, [
                    '$lib' => 'laravel',
                    '$lib_version' => '1.0.0',
                    'timestamp' => $timestamp ?: now()->toISOString(),
                ]),
            ];

            $response = Http::timeout(5)
                ->post(config('services.posthog.host') . '/capture/', $payload);

            return $response->successful();
        } catch (\Exception $e) {
            Log::warning('PostHog tracking failed', [
                'event' => $event,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Identify a user.
     */
    public static function identify(
        string $distinctId,
        array $properties = []
    ): bool {
        if (!static::isEnabled()) {
            return false;
        }

        try {
            $payload = [
                'api_key' => config('services.posthog.api_key'),
                'event' => '$identify',
                'distinct_id' => $distinctId,
                'properties' => array_merge($properties, [
                    '$lib' => 'laravel',
                    '$lib_version' => '1.0.0',
                ]),
                '$set' => $properties,
            ];

            $response = Http::timeout(5)
                ->post(config('services.posthog.host') . '/capture/', $payload);

            return $response->successful();
        } catch (\Exception $e) {
            Log::warning('PostHog identify failed', [
                'distinct_id' => $distinctId,
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Get JavaScript initialization code.
     */
    public static function getJavaScriptInit(): string
    {
        if (!static::isEnabled()) {
            return '';
        }

        $config = json_encode(static::getConfig());
        $apiKey = config('services.posthog.api_key');
        $host = config('services.posthog.host');

        return "
        <!-- PostHog Analytics -->
        <script>
            !function(t,e){var o,n,p,r;e.__SV||(window.posthog=e,e._i=[],e.init=function(i,s,a){function g(t,e){var o=e.split(\".\");2==o.length&&(t=t[o[0]],e=o[1]);var n=t;if(\"undefined\"!=typeof e){if(!(e in n))return;n=n[e]}var p=n;return function(){p.apply(this,arguments)}}(p=t.createElement(\"script\")).type=\"text/javascript\",p.async=!0,p.src=s.api_host+\"/static/array.js\",(r=t.getElementsByTagName(\"script\")[0]).parentNode.insertBefore(p,r);var u=e;for(void 0!==a?u=e[a]=[]:a=\"posthog\",u.people=u.people||[],u.toString=function(t){var e=\"posthog\";return\"posthog\"!==a&&(e+=\".\"+a),t||(e+=\" (stub)\"),e},u.people.toString=function(){return u.toString(1)+\".people (stub)\"},o=\"capture identify alias people.set people.set_once set_config register register_once unregister opt_out_capturing has_opted_out_capturing opt_in_capturing reset isFeatureEnabled onFeatureFlags getFeatureFlag getFeatureFlagPayload reloadFeatureFlags group updateEarlyAccessFeatureEnrollment getEarlyAccessFeatures getActiveMatchingSurveys getSurveys\".split(\" \"),n=0;n<o.length;n++)g(u,o[n]);e._i.push([i,s,a])},e.__SV=1)}(document,window.posthog||[]);
            posthog.init('{$apiKey}', {
                api_host: '{$host}',
                capture_pageview: true,
                capture_pageleave: true,
                session_recording: {
                    recordCrossOriginIframes: false,
                    maskAllInputs: true,
                    maskInputOptions: {
                        password: true,
                        email: false
                    }
                },
                persistence: 'localStorage',
                autocapture: true
            });
        </script>
        ";
    }

    /**
     * Educational event tracking helpers.
     */
    public static function trackDiagnosticStart(string $userId, int $diagnosticId, int $phase = null): bool
    {
        return static::track($userId, 'diagnostic_started', [
            'diagnostic_id' => $diagnosticId,
            'phase' => $phase,
            'category' => 'assessment',
        ]);
    }

    public static function trackDiagnosticComplete(
        string $userId, 
        int $diagnosticId, 
        float $score, 
        int $totalQuestions,
        int $duration = null
    ): bool {
        return static::track($userId, 'diagnostic_completed', [
            'diagnostic_id' => $diagnosticId,
            'score' => $score,
            'total_questions' => $totalQuestions,
            'duration_seconds' => $duration,
            'category' => 'assessment',
            'score_tier' => static::getScoreTier($score),
        ]);
    }

    public static function trackQuestionAnswered(
        string $userId,
        int $questionId,
        bool $isCorrect,
        int $responseTime = null,
        string $questionType = null
    ): bool {
        return static::track($userId, 'question_answered', [
            'question_id' => $questionId,
            'is_correct' => $isCorrect,
            'response_time_seconds' => $responseTime,
            'question_type' => $questionType,
            'category' => 'engagement',
        ]);
    }

    public static function trackPhaseComplete(
        string $userId,
        int $phase,
        float $score,
        int $questionsAnswered
    ): bool {
        return static::track($userId, 'phase_completed', [
            'phase' => $phase,
            'score' => $score,
            'questions_answered' => $questionsAnswered,
            'category' => 'assessment',
            'score_tier' => static::getScoreTier($score),
        ]);
    }

    public static function trackUserRegistration(string $userId, string $method = 'email'): bool
    {
        return static::track($userId, 'user_registered', [
            'registration_method' => $method,
            'category' => 'user_lifecycle',
        ]);
    }

    public static function trackFeatureUsage(string $userId, string $feature, array $context = []): bool
    {
        return static::track($userId, 'feature_used', array_merge([
            'feature_name' => $feature,
            'category' => 'engagement',
        ], $context));
    }

    /**
     * Helper to categorize scores.
     */
    private static function getScoreTier(float $score): string
    {
        if ($score >= 90) return 'expert';
        if ($score >= 80) return 'advanced';
        if ($score >= 70) return 'intermediate';
        if ($score >= 60) return 'beginner';
        return 'needs_improvement';
    }

    /**
     * Get user properties for identification.
     */
    public static function getUserProperties(\App\Models\User $user): array
    {
        return [
            'email' => $user->email,
            'name' => $user->name,
            'created_at' => $user->created_at->toISOString(),
            'user_type' => 'student', // Adjust based on your user types
        ];
    }
}