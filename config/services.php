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

    'google'    => [
        'enable'        => env('GOOGLE_ENABLE', false),
        'client_id'     => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT', 'login/google')
    ],

    'facebook'    => [
        'enable'        => env('FACEBOOK_ENABLE', false),
        'client_id'     => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect'      => env('FACEBOOK_REDIRECT', 'login/facebook')
    ],

    'twitter'    => [
        'enable'        => env('TWITTER_ENABLE', false),
        'client_id'     => env('TWITTER_CLIENT_ID'),
        'client_secret' => env('TWITTER_CLIENT_SECRET'),
        'redirect'      => env('TWITTER_REDIRECT', 'login/twitter')
    ],

    'linkedin'    => [
        'enable'        => env('LINKEDIN_ENABLE', false),
        'client_id'     => env('LINKEDIN_CLIENT_ID'),
        'client_secret' => env('LINKEDIN_CLIENT_SECRET'),
        'redirect'      => env('LINKEDIN_REDIRECT', 'login/linkedin')
    ],

    'github'    => [
        'enable'        => env('GITHUB_ENABLE', false),
        'client_id'     => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect'      => env('GITHUB_REDIRECT', 'login/github')
    ],

    'bitbucket'    => [
        'enable'        => env('BITBUCKET_ENABLE', false),
        'client_id'     => env('BITBUCKET_CLIENT_ID'),
        'client_secret' => env('BITBUCKET_CLIENT_SECRET'),
        'redirect'      => env('BITBUCKET_REDIRECT', 'login/bitbucket')
    ]

];
