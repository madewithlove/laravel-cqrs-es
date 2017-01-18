## Sagas

This package makes it easy to setup [sagas](https://github.com/broadway/broadway-saga).

### Configuration

As always sagas can be configured through the `broadway.php` configuration file. We ship with support for `inmemory` and `mongodb` drivers

#### `inmemory`

*No extra configuration is required*

#### `mongodb`

If you want to use the `mongodb` driver you need to add the connection details to `database.php`.

```
<?php

'connections' => [
        'mongodb' => [
            'driver'   => 'mongodb',
            'host'     => '127.0.0.1',
            'port'     => 27017,
            'database' => 'cqrs',
            'username' => '',
            'password' => '',
            'options'  => [
                'database' => 'admin' // sets the authentication database required by mongo 3
            ]
        ],
],
```

### Adding sagas

Refer to [Broadway's example](https://github.com/broadway/broadway-saga/blob/master/examples/ReservationSaga.php) on how to write a saga. Once you've written it you can add the saga's class to the `broadway.saga.sagas` array and it will be loaded:

```
<?php

'saga' => [
    'sagas' => [
        ReservationSaga::class,
    ],
],
```