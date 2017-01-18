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
    | Saga configuration
    |--------------------------------------------------------------------------
    | You can choose a driver, possible options are:
    |
    | mongodb, inmemory
    |
    */
    'saga' => [
        'driver' => 'inmemory',
        'mongodb' => [
            'collection' => 'sagas',
        ],
        'sagas' => [],
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
