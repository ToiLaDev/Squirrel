<?php

return [
    'system' => [],
    'employee' => [
        'new_sign_in'   => [
            'title'         => 'A new browser used to sign in',
            //'description'   => '',
            //'type'         => ['email', 'browser', 'app', 'sms'],
            'default'       => ['email','sms']
        ]
    ],
    'user' => [],
    'email_enable'      => env('NOTIFY_EMAIL_ENABLE', true),
    'browser_enable'    => env('NOTIFY_BROWSER_ENABLE', false),
    'app_enable'        => env('NOTIFY_APP_ENABLE', false),
    'sms_enable'        => env('NOTIFY_SMS_ENABLE', false),
];
