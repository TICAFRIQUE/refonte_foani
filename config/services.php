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

    'sms_api' => [
        'url' => env('SMS_API_URL'),
        'username' => env('SMS_API_USERNAME'),
        'password' => env('SMS_API_PASSWORD'),
        'sender' => env('SMS_API_SENDER'),
    ],

    // SMS TIC Afrique (alerte « nouvelle commande » envoyée à l'administrateur)
    'ticafrique' => [
        'url' => env('TICAFRIQUE_SMS_URL', 'https://sms.ticafrique.ci/api/v1/sms/send'),
        'key' => env('TICAFRIQUE_SMS_KEY'),
        'sender' => env('TICAFRIQUE_SMS_SENDER', 'FOANI'),
        // un ou plusieurs numéros séparés par des virgules (ex. 2250700000000,2250500000000)
        'admin_phone' => env('SMS_ADMIN_PHONE'),
    ],


];
