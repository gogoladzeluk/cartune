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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sms_office' => [
        'key' => env('SMS_OFFICE_KEY'),
        'admin_mobile' => env('ADMIN_MOBILE'),
        'reference_types' => [
            \App\Models\MobileVerification::class => 'MV',
        ],
    ],

    'discord_webhooks' => [
        'requests' => [
            'id' => env('DISCORD_WEBHOOKS_REQUESTS_ID'),
            'token' => env('DISCORD_WEBHOOKS_REQUESTS_TOKEN'),
        ],
        'reports' => [
            'id' => env('DISCORD_WEBHOOKS_REPORTS_ID'),
            'token' => env('DISCORD_WEBHOOKS_REPORTS_TOKEN'),
        ],
    ]
];
