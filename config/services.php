<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'facebook' => [
        'client_id' => '358124921549657',
        'client_secret' => '277bfe9955e2da8e1de0706d8fbe25fa',
        'redirect' => 'http://localhost/webstudent/public/callback/facebook',
    ],

    'google' => [
        'client_id' => '677100530778-7khlq1l1f68npnlvpev8rki1ibt7c85p.apps.googleusercontent.com',
        'client_secret' => 'CmgmHivT5k_r9YnEiUYkKM66',
        'redirect' => 'https://localhost/webstudent/public/callback/google',
    ],

    'twitter' => [
        'client_id' => 'LuksLmqEjMsaceX230wd10bvW',
        'client_secret' => 'K9P8otngCpl3Z89D778FPpt8oISLVQDbIKJpnYRdTMe69MkhxE',
        'redirect' => 'https://localhost/webstudent/public/callback/twitter',
    ],

];
