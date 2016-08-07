# laravel-cqrs-es

A package to kickstart your CQRS/ES development in Laravel using the Broadway event store.

## Installation

```
$ composer require madewithlove/laravel-cqrs-es
```

## Configuration

Add the service provider to config/app.php:

```
Madewithlove\LaravelCqrsEs\ServiceProvider::class
```

## Usage

### Generators

This package ships with some code generators to easily create commands, command handlers and events. To enable generators you have to add `Madewithlove\LaravelCqrEs\Generators\ServiceProvider::class`
to your `app.providers` array. However, we advise you to not enable this service provider on production environments.

All of our generators besides `generate:aggreate` require an `--aggregate` option that is used to generate the proper namespace and directories.

#### `generate:command`

```bash
php artisan generate:command SayHello --aggregate World
# app/World/Commands/SayHello.php
# app/World/CommandHandlers/SayHello.php
# tests/World/CommandHandlers/SayHelloTest.php
```

#### `generate:event`

```bash
php artisan generate:event SaidHello --aggregate World
# app/World/Events/SaidHello.php
```

#### `generate:aggregate`

```bash
php artisan generate:aggregate World
# app/WorldAggregates/World.php
```

## Credits and thanks

This package borrows components from [nWidart/Laravel-broadway](https://github.com/nWidart/Laravel-broadway) and includes a laravel ServiceProvider for [matthiasnoback/broadway-serialization](https://github.com/matthiasnoback/broadway-serialization).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.