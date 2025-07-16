<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable, MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'avatar',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Audit configuration
     */
    protected $auditExclude = [
        'password',
        'remember_token',
        'email_verified_at',
    ];

    protected $auditStrict = true;

    /**
     * Find a user by email address
     */
    public static function findByEmail(string $email): ?self
    {
        return static::where('email', $email)->first();
    }

    /**
     * Privacy consent relationship
     */
    public function privacyConsents()
    {
        return $this->hasMany(PrivacyConsent::class);
    }

    /**
     * Privacy settings relationship
     */
    public function privacySetting()
    {
        return $this->hasOne(PrivacySetting::class);
    }

    /**
     * Get user's consent status for cookie banner
     */
    public function getConsentStatus()
    {
        $latestConsent = $this->privacyConsents()
            ->where('regulation', 'GDPR')
            ->latest()
            ->first();

        if (!$latestConsent) {
            return [
                'consent_given' => false,
                'consent_date' => null,
                'categories' => [
                    'strictly_necessary' => true,
                    'functional' => false,
                    'analytics' => false,
                    'marketing' => false,
                ],
            ];
        }

        $preferences = $latestConsent->consent_preferences ?? [];
        
        return [
            'consent_given' => $latestConsent->is_consent_given && ($preferences['cookie_consent_given'] ?? false),
            'consent_date' => $preferences['cookie_consent_date'] ?? $latestConsent->consent_given_at,
            'categories' => [
                'strictly_necessary' => $preferences['strictly_necessary'] ?? true,
                'functional' => $preferences['functional'] ?? false,
                'analytics' => $preferences['analytics'] ?? false,
                'marketing' => $preferences['marketing'] ?? false,
            ],
        ];
    }

    /**
     * Check if user needs to provide consent
     */
    public function needsConsent()
    {
        $latestConsent = $this->privacyConsents()
            ->where('regulation', 'GDPR')
            ->latest()
            ->first();

        // No consent record = needs consent
        if (!$latestConsent) {
            return true;
        }

        // Check if cookie consent specifically was given
        $preferences = $latestConsent->consent_preferences ?? [];
        if (!($preferences['cookie_consent_given'] ?? false)) {
            return true;
        }

        // Check if consent is older than 1 year (re-consent required)
        if ($latestConsent->consent_given_at && $latestConsent->consent_given_at->lt(now()->subYear())) {
            return true;
        }

        return false;
    }
}
