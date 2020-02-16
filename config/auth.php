<?php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
        'api-penaksir' => [
            'driver' => 'jwt',
            'provider' => 'penaksirs',
        ]
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\User::class
        ],
        'penaksirs' => [
            'driver' => 'eloquent',
            'model' => \App\UserPenaksir::class
        ]
    ]
];
