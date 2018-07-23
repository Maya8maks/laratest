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
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => '1009475482538256',
        'client_secret' => '02475dcb047f64c64fc3f299c9fe1181',
        'redirect' => "http://laratest.galactika-it.ru/auth/facebook/callback",
    ],
    'github' => [
        'client_id' => 'e2b67675d6ae4d5889d4',
        'client_secret' => '03d789cb70826e367d2b8debc7612c0e23196a93',
        'redirect' => 'http://laratest.galactika-it.ru/auth/github/callback',
    ],
    'google' => [
        'client_id' => '150090616616-76ucn5au6q4f7dc5vdpnt3oteuq7vgcs.apps.googleusercontent.com',
        'client_secret' => 'PHch-7uEm0dd9ByUyT_2izgB',
        'redirect' => 'http://laratest.galactika-it.ru/auth/google/callback',
    ],
    'twitter' => [
        'client_id' => 'j10XFHoftMHSbkE3hCUcb5owR',
        'client_secret' => 'CnHfsOCgbg8uosdSRrtAMILsgvSWsYf3VgzdEbVhCfssApVcNN',
        'redirect' => 'http://laratest.galactika-it.ru/auth/twitter/callback',
    ],
    'linkedin' => [
        'client_id' => '78f47k74pcxh73',
        'client_secret' => '1lQOE2bhD3NkrZJw',
        'redirect' => 'http://laratest.galactika-it.ru/auth/linkedin/callback',
    ],
];
