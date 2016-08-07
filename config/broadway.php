<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Event Store configuration
    |--------------------------------------------------------------------------
    | You can choose a driver, possible options are:
    | 
    | dbal, inmemory
    |
    */
    'event-store' => [
        'driver' => 'dbal',
        'dbal' => [
            'connection' => 'mysql',
            'table' => 'event_store',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Read model storage configuration
    |--------------------------------------------------------------------------
    | You can choose a driver, possible options are:
    | 
    | elasticsearch, inmemory
    |
    */
    'read-model' => [
        'driver' => 'elasticsearch',
        'elasticsearch' => [
            'hosts' => ['localhost:9200']
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Generator configuration
    |--------------------------------------------------------------------------
    |
    */
    'generators' => [
        'paths' => [
            'stubs' => resource_path('stubs/broadway'),
            'tests' => base_path('tests'),
        ],
    ],
];
