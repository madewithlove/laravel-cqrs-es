> :warning: **This package is no longer maintained**: Consider using https://github.com/spatie/laravel-event-sourcing instead.

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

Run

```bash
php artisan vendor:publish --provider="Madewithlove\LaravelCqrsEs\ServiceProvider"
```

## Documentation

- [Generators](./docs/generators.md)
- [Sagas](./docs/sagas.md)

## Credits and thanks

This package borrows components from [nWidart/Laravel-broadway](https://github.com/nWidart/Laravel-broadway) and includes a Laravel ServiceProvider for [matthiasnoback/broadway-serialization](https://github.com/matthiasnoback/broadway-serialization).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
