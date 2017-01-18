<?php

namespace Madewithlove\LaravelCqrsEs\Uuid;

use Broadway\UuidGenerator\Rfc4122\Version4Generator;
use Broadway\UuidGenerator\UuidGeneratorInterface;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UuidGeneratorInterface::class, Version4Generator::class);
    }
}