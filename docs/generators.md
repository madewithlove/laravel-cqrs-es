## Generators

This package ships with some code generators to easily create commands, command handlers and events. To enable generators you have to add `Madewithlove\LaravelCqrEs\Generators\ServiceProvider::class`
to your `app.providers` array. However, we advise you to not enable this service provider on production environments.

All of our generators besides `make:cqrs:aggreate` require an `--aggregate` option that is used to make:cqrs the proper namespace and directories.

#### `make:cqrs:command`

```bash
php artisan make:cqrs:command SayHello --aggregate World
# app/World/Commands/SayHello.php
# app/World/CommandHandlers/SayHello.php
# tests/World/CommandHandlers/SayHelloTest.php
```

#### `make:cqrs:event`

```bash
php artisan make:cqrs:event SaidHello --aggregate World
# app/World/Events/SaidHello.php
```

#### `make:cqrs:aggregate`

```bash
php artisan make:cqrs:aggregate World
# app/WorldAggregates/World.php
# app/WorldAggregates/Repositories/WriteRepository.php
# app/WorldAggregates/Repositories/DbalWriteRepository.php
# app/WorldAggregates/ServiceProvider.php
```