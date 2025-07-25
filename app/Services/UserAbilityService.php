<?php

namespace App\Services;

use App\Models\User;

/**
 * Simplified UserAbilityService for diagnostics
 *
 * In V1, this service provides basic ability tracking for diagnostic assessments.
 * Future versions may expand this to include full adaptive learning capabilities.
 */
class UserAbilityService
{
    /**
     * Get user's ability level for diagnostics
     *
     * For V1, returns a default middle-level ability.
     * Future versions will calculate based on assessment history.
     */
    public function getUserAbilityLevel(int $userId, ?int $domainId = null): float
    {
        // V1: Return default middle ability level
        // Future: Calculate based on diagnostic history and performance
        return 0.5;
    }

    /**
     * Update user abilities based on diagnostic results
     *
     * For V1, this is a no-op as we focus on assessment completion.
     * Future versions will update ability profiles based on performance.
     */
    public function updateAbilitiesFromDiagnosticResults(User $user, array $diagnosticResults): void
    {
        // V1: No-op - focus on completing assessments
        // Future: Implement Bayesian updates to ability estimates
    }

    /**
     * Get recommended starting level for a domain
     *
     * For V1, returns Bloom level 3 (Apply) as default.
     * Future versions will use warm-start logic based on history.
     */
    public function getRecommendedStartingLevel(User $user, int $domainId): int
    {
        // V1: Always start at Bloom level 3
        // Future: Implement warm-start logic from ADAPTIVE-DIAGNOSTICS.md
        return 3;
    }
}
