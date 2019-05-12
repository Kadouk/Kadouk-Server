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
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    
    'zarinpal' => [
    'merchantID' => 'XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX',
    'zarinGate' => false,
    'sandbox' => true,
    ],
    'google' => [
        'client_id' => '484317972407-dgki475gj530gspqqka8trhdt6nme37g.apps.googleusercontent.com',
        'client_secret' => 'hl-NcvcKvMM_9Csg8MMX3NZq',
        'redirect' => 'http://127.0.0.1:8000/callback'],

];
