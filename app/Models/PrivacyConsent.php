<?php

namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable;

class PrivacyConsent extends BaseModel implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'regulation',
        'consent_version',
        'is_consent_given',
        'consent_given_at',
        'consent_preferences',
        'ip_address',
        'user_agent',
        'consent_region',
        'consent_type',
        'consented_at',
        'withdrawn_at',
        'withdrawal_ip',
    ];

    protected $casts = [
        'is_consent_given' => 'boolean',
        'consent_given_at' => 'datetime',
        'consent_preferences' => 'array',
        'consented_at' => 'datetime',
        'withdrawn_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
