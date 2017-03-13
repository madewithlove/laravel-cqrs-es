<?php

namespace Madewithlove\LaravelCqrsEs;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function register()
    {
        // merge config
        $configPath = __DIR__ . '/../config/broadway.php';
        $this->mergeConfigFrom($configPath, 'broadway');

        $this->app->register(EventStore\ServiceProvider::class);
        $this->app->register(ReadModel\ServiceProvider::class);
        $this->app->register(Inflectors\ServiceProvider::class);
        $this->app->register(Serializers\ServiceProvider::class);
        $this->app->register(Reconstitution\ServiceProvider::class);
        $this->app->register(Uuid\ServiceProvider::class);
        $this->app->register(Saga\ServiceProvider::class);
    }

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/broadway.php' => config_path('broadway.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../resources/stubs/' => resource_path('stubs/broadway')
        ], 'migrations');
    }
}