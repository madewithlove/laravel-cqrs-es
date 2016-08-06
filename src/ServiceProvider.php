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
        $this->app->register(Serializers\ServiceProvider::class);
        $this->app->register(Reconstitution\ServiceProvider::class);
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
    }
}