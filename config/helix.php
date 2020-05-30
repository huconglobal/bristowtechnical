<?php
return [
    'defaults' => [
        // Default Phone Extension
        'phone_ext' => '+47',
        // Available App Locales
        'locales' => [
            'en' => 'English',
            'nb' => 'Norsk'
        ],
        // Default settings for all users
        'settings' => [
            'locale'      => 'en',
            'weekstart'   => 1,
            'dateformat'  => 'dmy',
            'timeformat'  => '24hour',
            'measurement' => 'metric'
        ]
    ],
    // Password Rule
    'password' => [
        // At least two lowercase letters, an uppercase letters and a number
        'required_characters' => '/^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z].*[a-z]).*$/',
        'minimum_length'      => 8,
        // this uses the default error message. Replace if customization is required
        'error_message'       => null
    ],
    // User company info
    'company' => [
        'fullname'   => 'Bristow Norway',
        'shortname'  => 'Bristow',
        'address'    => 'Flyplassvegen 260',
        'postalcode' => '4050',
        'city'       => 'Sola',
        'state'      => 'Rogaland',
        'phone'      => '51646600',
        'website'    => 'http:\\www.bristowgroup.com',
        'logo_url'   => 'img/logo.png'
    ]
];
