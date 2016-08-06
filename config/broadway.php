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
        'stubs' => [
            'command' => base_path().'/vendor/madewithlove/laravel-cqrs-es/resources/stubs/command.stub',
            'commandHandler' => base_path().'/vendor/madewithlove/laravel-cqrs-es/resources/stubs/commandHandler.stub',
            'event' => base_path().'/vendor/madewithlove/laravel-cqrs-es/resources/stubs/event.stub',
        ],
    ],
];
