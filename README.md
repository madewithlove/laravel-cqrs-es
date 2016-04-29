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

## Credits and thanks

This package borrows components from [nWidart/Laravel-broadway](https://github.com/nWidart/Laravel-broadway) and includes a laravel ServiceProvider for [matthiasnoback/broadway-serialization](https://github.com/matthiasnoback/broadway-serialization).

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.