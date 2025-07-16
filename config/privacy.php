<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Privacy Regulation Versions
    |--------------------------------------------------------------------------
    |
    | Define version numbers for different privacy regulations to track
    | consent versions and ensure compliance with updated policies.
    |
    */
    'versions' => [
        'GDPR' => '1.0',
        'CCPA' => '1.0',
        'PIPEDA' => '1.0',
        'DPDP' => '1.0', // India's Digital Personal Data Protection Act
    ],

    /*
    |--------------------------------------------------------------------------
    | Current Privacy Policy Version
    |--------------------------------------------------------------------------
    |
    | This is used to check if users need to re-consent to updated policies.
    |
    */
    'current_version' => '1.0',

    /*
    |--------------------------------------------------------------------------
    | Data Retention Policies
    |--------------------------------------------------------------------------
    |
    | Define retention periods for different types of data in days.
    | Set to null for indefinite retention.
    |
    */
    'retention' => [
        'user_data' => 2555, // 7 years (legal requirement)
        'audit_logs' => 2555, // 7 years (compliance)
        'privacy_consents' => 2555, // 7 years (legal proof)
        'session_data' => 30, // 1 month
        'temporary_files' => 7, // 1 week
        'export_files' => 30, // 1 month
        'analytics_data' => 1095, // 3 years
        'marketing_data' => 730, // 2 years (with consent)
        'course_progress' => null, // Indefinite (core service)
        'assessment_results' => null, // Indefinite (core service)
        'payment_records' => 2555, // 7 years (legal requirement)
    ],

    /*
    |--------------------------------------------------------------------------
    | Data Anonymization Settings
    |--------------------------------------------------------------------------
    |
    | Configure which fields should be anonymized during data cleanup
    | and the anonymization strategy for each field type.
    |
    */
    'anonymization' => [
        'strategies' => [
            'email' => 'hash', // Hash with salt
            'name' => 'replace', // Replace with generic value
            'ip_address' => 'truncate', // Remove last octet
            'user_agent' => 'remove', // Complete removal
            'phone' => 'mask', // Mask middle digits
        ],
        'replacement_values' => [
            'name' => 'Anonymous User',
            'email' => 'anonymized@deleted.user',
        ],
        'exclude_fields' => [
            'id', 'created_at', 'updated_at', 'deleted_at',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Automated Cleanup Settings
    |--------------------------------------------------------------------------
    |
    | Configure automatic cleanup processes for expired data.
    |
    */
    'cleanup' => [
        'enabled' => env('PRIVACY_CLEANUP_ENABLED', true),
        'schedule' => 'daily', // How often to run cleanup
        'chunk_size' => 1000, // Process records in batches
        'dry_run' => env('PRIVACY_CLEANUP_DRY_RUN', false),
        'notify_admin' => true, // Send notifications for cleanup actions
    ],

    /*
    |--------------------------------------------------------------------------
    | Consent Enforcement
    |--------------------------------------------------------------------------
    |
    | Configure how consent is enforced throughout the application.
    |
    */
    'consent' => [
        'required_for_registration' => true,
        'required_for_oauth' => true,
        'grace_period_days' => 30, // Days to use service before forced consent
        'auto_expire_days' => 730, // Days before consent expires (2 years)
        'require_explicit_consent' => [
            'analytics' => true,
            'marketing' => true,
            'third_party_sharing' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Data Subject Rights
    |--------------------------------------------------------------------------
    |
    | Configure automated handling of data subject rights requests.
    |
    */
    'rights' => [
        'access' => [
            'enabled' => true,
            'format' => 'json', // json, xml, csv
            'include_metadata' => true,
        ],
        'portability' => [
            'enabled' => true,
            'format' => 'json',
            'include_files' => false, // Include uploaded files
        ],
        'rectification' => [
            'enabled' => true,
            'require_verification' => true,
        ],
        'erasure' => [
            'enabled' => true,
            'soft_delete_period' => 30, // Days before hard delete
            'preserve_legal_basis' => true, // Keep data required by law
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cross-Border Transfer Settings
    |--------------------------------------------------------------------------
    |
    | Configure data transfer compliance for international operations.
    |
    */
    'transfers' => [
        'adequacy_countries' => [
            'CA', 'CH', 'GB', 'JP', 'KR', 'NZ', 'UY', 'IL', 'AD', 'AR', 'FO',
        ],
        'standard_contractual_clauses' => [
            'enabled' => true,
            'version' => '2021', // EU SCC version
        ],
        'data_processing_addendum' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Privacy Impact Assessment
    |--------------------------------------------------------------------------
    |
    | Settings for Data Protection Impact Assessment (DPIA) triggers.
    |
    */
    'dpia' => [
        'required_for' => [
            'high_risk_processing' => true,
            'new_technologies' => true,
            'large_scale_monitoring' => true,
            'sensitive_data' => true,
        ],
        'threshold_users' => 10000, // DPIA required above this user count
    ],

    /*
    |--------------------------------------------------------------------------
    | Notification Settings
    |--------------------------------------------------------------------------
    |
    | Configure privacy-related notifications and alerts.
    |
    */
    'notifications' => [
        'breach_notification' => [
            'enabled' => true,
            'authorities_hours' => 72, // Hours to notify authorities
            'subjects_days' => 30, // Days to notify data subjects
        ],
        'consent_expiry' => [
            'enabled' => true,
            'warning_days' => 30, // Days before expiry to warn users
        ],
        'data_export_ready' => true,
        'account_deletion' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Third-Party Integration Settings
    |--------------------------------------------------------------------------
    |
    | Configure privacy compliance for third-party services.
    |
    */
    'third_parties' => [
        'google_analytics' => [
            'consent_required' => true,
            'anonymize_ip' => true,
            'data_retention_months' => 26,
        ],
        'stripe' => [
            'consent_required' => false, // Necessary for service
            'data_minimization' => true,
        ],
        'mailchimp' => [
            'consent_required' => true,
            'double_opt_in' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Audit and Logging
    |--------------------------------------------------------------------------
    |
    | Configure privacy-related audit trails and logging.
    |
    */
    'audit' => [
        'enabled' => true,
        'events' => [
            'consent_given',
            'consent_withdrawn',
            'data_exported',
            'data_deleted',
            'privacy_settings_updated',
            'data_breach_detected',
        ],
        'retention_days' => 2555, // 7 years
    ],

    /*
    |--------------------------------------------------------------------------
    | Emergency Procedures
    |--------------------------------------------------------------------------
    |
    | Settings for privacy emergency responses.
    |
    */
    'emergency' => [
        'data_freeze' => [
            'enabled' => true,
            'contacts' => [
                'dpo@securestart.com',
                'legal@securestart.com',
            ],
        ],
        'breach_response' => [
            'auto_notify' => false, // Manual approval required
            'incident_team' => [
                'security@securestart.com',
                'dpo@securestart.com',
            ],
        ],
    ],
];