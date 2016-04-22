<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(MethodNameInflector::class, ProjectClassNameInflector::class);
    }

    public function provides()
    {
        return [
            MethodNameInflector::class
        ];
    }
}