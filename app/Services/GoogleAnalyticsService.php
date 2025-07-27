<?php

namespace App\Services;

class GoogleAnalyticsService
{
    /**
     * Check if Google Analytics is enabled.
     */
    public static function isEnabled(): bool
    {
        return !config('app.debug') && 
               !empty(config('services.google_analytics.measurement_id'));
    }

    /**
     * Get the Google Analytics measurement ID.
     */
    public static function getMeasurementId(): ?string
    {
        return config('services.google_analytics.measurement_id');
    }

    /**
     * Get the Google Analytics stream configuration.
     */
    public static function getStreamConfig(): array
    {
        return [
            'stream_id' => config('services.google_analytics.stream_id'),
            'stream_url' => config('services.google_analytics.stream_url'),
            'stream_name' => config('services.google_analytics.stream_name'),
            'measurement_id' => static::getMeasurementId(),
        ];
    }

    /**
     * Generate JavaScript code for Google Analytics tracking.
     */
    public static function getTrackingScript(): string
    {
        if (!static::isEnabled()) {
            return '';
        }

        $measurementId = static::getMeasurementId();
        
        return "
        <!-- Google tag (gtag.js) -->
        <script async src=\"https://www.googletagmanager.com/gtag/js?id={$measurementId}\"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '{$measurementId}', {
            page_title: document.title,
            page_location: window.location.href,
            anonymize_ip: true,
            allow_google_signals: false,
            allow_ad_personalization_signals: false
          });
        </script>
        ";
    }

    /**
     * Get JavaScript code for custom event tracking.
     */
    public static function trackEvent(string $eventName, array $parameters = []): string
    {
        if (!static::isEnabled()) {
            return '';
        }

        $parametersJson = json_encode($parameters);
        
        return "
        <script>
          if (typeof gtag !== 'undefined') {
            gtag('event', '{$eventName}', {$parametersJson});
          }
        </script>
        ";
    }

    /**
     * Common events for Saaz Academy tracking.
     */
    public static function trackDiagnosticStart(int $diagnosticId): string
    {
        return static::trackEvent('diagnostic_start', [
            'diagnostic_id' => $diagnosticId,
            'event_category' => 'assessment',
            'event_label' => 'diagnostic_assessment'
        ]);
    }

    public static function trackDiagnosticComplete(int $diagnosticId, float $score): string
    {
        return static::trackEvent('diagnostic_complete', [
            'diagnostic_id' => $diagnosticId,
            'score' => $score,
            'event_category' => 'assessment',
            'event_label' => 'diagnostic_assessment'
        ]);
    }

    public static function trackQuestionAnswer(int $questionNumber, bool $isCorrect): string
    {
        return static::trackEvent('question_answer', [
            'question_number' => $questionNumber,
            'is_correct' => $isCorrect,
            'event_category' => 'engagement',
            'event_label' => 'quiz_interaction'
        ]);
    }

    public static function trackPhaseComplete(int $phase, float $score): string
    {
        return static::trackEvent('phase_complete', [
            'phase' => $phase,
            'score' => $score,
            'event_category' => 'assessment',
            'event_label' => 'phase_progression'
        ]);
    }
}