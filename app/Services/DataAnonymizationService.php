<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DataAnonymizationService
{
    protected array $anonymizationStrategies;

    protected array $replacementValues;

    protected array $excludeFields;

    public function __construct()
    {
        $this->anonymizationStrategies = config('privacy.anonymization.strategies', []);
        $this->replacementValues = config('privacy.anonymization.replacement_values', []);
        $this->excludeFields = config('privacy.anonymization.exclude_fields', []);
    }

    /**
     * Anonymize a user's personal data while preserving system integrity
     * V1: Simplified version focusing on core anonymization
     */
    public function anonymizeUser(User $user, array $preserveFields = []): void
    {
        Log::info("Starting anonymization for user {$user->id}");

        // Anonymize core user fields
        $this->anonymizeUserFields($user, $preserveFields);

        // V1: Skip profile since we don't have user profiles yet
        // if ($user->profile) {
        //     $this->anonymizeProfile($user->profile, $preserveFields);
        // }

        // Anonymize privacy consents (keep structure but remove identifying data)
        $this->anonymizePrivacyConsents($user);

        // V1: Anonymize diagnostic data instead of assessments
        $this->anonymizeDiagnostics($user);

        // V1: Skip orders since we don't have e-commerce yet
        // $this->anonymizeOrders($user);

        Log::info("Completed anonymization for user {$user->id}");
    }

    protected function anonymizeUserFields(User $user, array $preserveFields): void
    {
        $updates = [];

        // Always preserve certain system fields
        $systemFields = ['id', 'created_at', 'updated_at', 'deleted_at'];
        $preserveFields = array_merge($preserveFields, $systemFields);

        // Anonymize name
        if (! in_array('name', $preserveFields)) {
            $updates['name'] = $this->replacementValues['name'] ?? 'Anonymous User';
        }

        // Anonymize email
        if (! in_array('email', $preserveFields)) {
            $updates['email'] = $this->anonymizeEmail($user->email);
        }

        // Remove email verification timestamp
        if (! in_array('email_verified_at', $preserveFields)) {
            $updates['email_verified_at'] = null;
        }

        // Generate new password hash for security
        if (! in_array('password', $preserveFields)) {
            $updates['password'] = Hash::make('anonymized_'.uniqid());
        }

        // Remove remember token
        if (! in_array('remember_token', $preserveFields)) {
            $updates['remember_token'] = null;
        }

        // V1: Remove OAuth fields
        $updates['google_id'] = null;
        $updates['avatar'] = null;

        $user->update($updates);
    }

    protected function anonymizeProfile($profile, array $preserveFields): void
    {
        $updates = [];

        // Anonymize personal information
        if (! in_array('phone', $preserveFields) && $profile->phone) {
            $updates['phone'] = $this->maskPhone($profile->phone);
        }

        if (! in_array('address', $preserveFields)) {
            $updates['address'] = 'Anonymized Address';
        }

        if (! in_array('city', $preserveFields)) {
            $updates['city'] = 'Anonymized City';
        }

        if (! in_array('postal_code', $preserveFields)) {
            $updates['postal_code'] = null;
        }

        // Keep country for statistical purposes but remove specific location
        if (! in_array('state', $preserveFields)) {
            $updates['state'] = null;
        }

        // Remove date of birth
        if (! in_array('date_of_birth', $preserveFields)) {
            $updates['date_of_birth'] = null;
        }

        // Remove profile photo
        if (! in_array('avatar_path', $preserveFields)) {
            $updates['avatar_path'] = null;
        }

        // Remove social links
        if (! in_array('linkedin_url', $preserveFields)) {
            $updates['linkedin_url'] = null;
        }

        if (! in_array('twitter_url', $preserveFields)) {
            $updates['twitter_url'] = null;
        }

        // Anonymize bio/description
        if (! in_array('bio', $preserveFields)) {
            $updates['bio'] = 'This user has requested data anonymization.';
        }

        $profile->update($updates);
    }

    protected function anonymizePrivacyConsents(User $user): void
    {
        // Keep consent records for legal compliance but remove identifying metadata
        $user->privacyConsents()->update([
            'ip_address' => $this->anonymizeIpAddress($user->privacyConsents()->first()?->ip_address ?? ''),
            'user_agent' => 'Anonymized User Agent',
        ]);
    }

    protected function anonymizeDiagnostics(User $user): void
    {
        // V1: Preserve diagnostic results for educational analytics but mark as anonymized
        $user->diagnostics()->update([
            'adaptive_state' => json_encode([
                'anonymized' => true,
                'anonymization_date' => now(),
                'original_state' => 'anonymized',
            ]),
        ]);
    }

    protected function anonymizeOrders(User $user): void
    {
        // Keep transaction records for legal/accounting purposes but anonymize personal data
        foreach ($user->orders as $order) {
            $order->update([
                'billing_name' => $this->replacementValues['name'] ?? 'Anonymous Customer',
                'billing_email' => $this->anonymizeEmail($order->billing_email ?? ''),
                'billing_address' => 'Anonymized Address',
                'billing_city' => 'Anonymized City',
                'billing_state' => null,
                'billing_postal_code' => null,
                'notes' => 'Customer data anonymized per GDPR request',
            ]);
        }
    }

    /**
     * Anonymize email while preserving domain structure for analytics
     */
    protected function anonymizeEmail(string $email): string
    {
        $hash = substr(hash('sha256', $email.config('app.key')), 0, 12);

        return "anonymized_{$hash}@deleted.user";
    }

    /**
     * Mask phone number while preserving format
     */
    protected function maskPhone(string $phone): string
    {
        $cleaned = preg_replace('/[^0-9]/', '', $phone);

        if (strlen($cleaned) < 6) {
            return 'XXX-XXXX';
        }

        $start = substr($cleaned, 0, 3);
        $end = substr($cleaned, -2);
        $middle = str_repeat('X', strlen($cleaned) - 5);

        return $start.'-'.$middle.'-'.$end;
    }

    /**
     * Anonymize IP address by removing last octet
     */
    protected function anonymizeIpAddress(string $ip): string
    {
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $parts = explode('.', $ip);
            $parts[3] = '0';

            return implode('.', $parts);
        }

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $parts = explode(':', $ip);
            // Zero out last 64 bits
            for ($i = 4; $i < 8; $i++) {
                $parts[$i] = '0000';
            }

            return implode(':', $parts);
        }

        return '0.0.0.0';
    }

    /**
     * Check if user data can be safely anonymized
     */
    public function canAnonymizeUser(User $user): array
    {
        $blockers = [];

        // Check for active legal holds
        if ($this->hasActiveLegalHold($user)) {
            $blockers[] = 'User has active legal hold - cannot anonymize';
        }

        // Check for pending transactions
        if ($this->hasPendingTransactions($user)) {
            $blockers[] = 'User has pending financial transactions';
        }

        // Check for recent significant activity
        if ($this->hasRecentActivity($user, 30)) {
            $blockers[] = 'User has recent activity - consider waiting period';
        }

        return [
            'can_anonymize' => empty($blockers),
            'blockers' => $blockers,
        ];
    }

    protected function hasActiveLegalHold(User $user): bool
    {
        // Check if user is subject to legal hold
        // This would depend on your legal hold system
        return false; // Implement based on your requirements
    }

    protected function hasPendingTransactions(User $user): bool
    {
        // V1: No e-commerce, so no pending transactions
        return false;
    }

    protected function hasIncompleteDiagnostics(User $user): bool
    {
        // Check for incomplete diagnostics
        return $user->diagnostics()
            ->where('status', 'in_progress')
            ->exists();
    }

    protected function hasRecentActivity(User $user, int $days): bool
    {
        return $user->updated_at->gt(now()->subDays($days));
    }

    /**
     * Generate anonymization report for audit purposes
     */
    public function generateAnonymizationReport(User $user): array
    {
        return [
            'user_id' => $user->id,
            'original_email' => $user->email, // Log before anonymization
            'anonymization_date' => now(),
            'anonymized_fields' => [
                'user' => ['name', 'email', 'password', 'remember_token', 'google_id', 'avatar'],
                'privacy_consents' => ['ip_address', 'user_agent'],
                'diagnostics' => ['metadata'],
            ],
            'preserved_fields' => ['id', 'created_at', 'updated_at'],
            'reason' => 'GDPR Right to Erasure Request',
            'performed_by' => auth()->id() ?? 'system',
        ];
    }
}
