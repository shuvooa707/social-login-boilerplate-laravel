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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],



    // socialite configs
    'facebook' => [
        'client_id' => "526579792781784",
        'client_secret' => "1d37c7092a2f2f29a5c585b8a95119ef",
        'redirect' => 'https://shuvooa707-reimagined-engine-v66g7jggxxjhwgv9-8000.preview.app.github.dev/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => 'http://example.com/callback-url',
    ],

    'twitter' => [
        'client_id' => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect' => 'http://example.com/callback-url',
    ],

    'github' => [
        'client_id' => "4bac6964a58fcd26a68f",
        'client_secret' => "1ca834502b0fd8cb291ac4deb448f27a5986fc26",
        'redirect' => 'https://shuvooa707-reimagined-engine-v66g7jggxxjhwgv9-8000.preview.app.github.dev/auth/github/callback',
    ],


    'google' => [
        'client_id' => "1042635223908-0trfes0g859ifv72npecnb9p9v55ms3b.apps.googleusercontent.com",
        'client_secret' => "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",
        'redirect' => 'https://shuvooa707-reimagined-engine-v66g7jggxxjhwgv9-8000.preview.app.github.dev/auth/google/callback',
    ],

    'microsoft' => [    
        'client_id' => env('MICROSOFT_CLIENT_ID'),  
        'client_secret' => env('MICROSOFT_CLIENT_SECRET'),  
        'redirect' => env("MICROSOFT_REDIRECT_URL")
      ],
      
];
