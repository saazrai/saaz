<?php

namespace App\Models;

use OwenIt\Auditing\Contracts\Auditable;

class PrivacySetting extends BaseModel implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'user_id',
        'marketing_consent',
        'analytics_consent',
        'third_party_consent',
        'consent_given_at',
        'consent_version',
        'consent_history',
    ];

    protected $casts = [
        'marketing_consent' => 'boolean',
        'analytics_consent' => 'boolean',
        'third_party_consent' => 'boolean',
        'consent_history' => 'array',
        'consent_given_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
