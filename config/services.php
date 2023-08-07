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

    'github' => [
        'client_id'     => env('GITHUB_CLIENT_ID', ''),
        'client_secret' => env('GITHUB_CLIENT_SECRET', ''),
        'redirect'      => env('APP_URL').'/oauth/github/callback',
    ],

    'qq' => [
        'client_id'     => env('QQ_CLIENT_ID', ''),
        'client_secret' => env('QQ_CLIENT_SECRET', ''),
        'redirect'      => env('APP_URL').'/oauth/qq/callback',
    ],

    'gitee' => [
        'client_id'		=> env('GITEE_CLIENT_ID', ''),
        'client_secret' => env('GITEE_CLIENT_SECRET', ''),
        'redirect'		=> env('APP_URL').'/oauth/gitee/callback',
    ],

    'outlook' => [
        'client_id'		=> env('OUTLOOK_CLIENT_ID', ''),
        'client_secret' => env('OUTLOOK_CLIENT_SECRET', ''),
        'redirect'		=> env('APP_URL').'/oauth/outlook/callback',
    ],

    'weibo'	=> [
        'client_id'		=> env('WEIBO_CLIENT_ID', ''),
        'client_secret' => env('WEIBO_CLIENT_SECRET', ''),
        'redirect'		=> env('APP_URL').'/oauth/weibo/callback',
    ],
];
