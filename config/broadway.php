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
];
