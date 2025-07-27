<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI'),
    ],

    'google_analytics' => [
        'measurement_id' => env('GA_MEASUREMENT_ID') ?: env('GOOGLE_ANALYTICS_ID'),
        'stream_id' => env('GOOGLE_ANALYTICS_STREAM_ID', '2360896180'),
        'stream_url' => env('GOOGLE_ANALYTICS_STREAM_URL', 'https://saazacademy.com'),
        'stream_name' => env('GOOGLE_ANALYTICS_STREAM_NAME', 'Saaz Academy'),
    ],

    'posthog' => [
        'api_key' => env('POSTHOG_API_KEY'),
        'host' => env('POSTHOG_HOST') ?: env('POSTHOG_API_HOST', 'https://app.posthog.com'),
        'project_id' => env('POSTHOG_PROJECT_ID'),
        'enabled' => env('POSTHOG_ENABLED', true),
    ],

];
