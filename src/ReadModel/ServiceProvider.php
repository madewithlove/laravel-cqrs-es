<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel;

use Broadway\ReadModel\RepositoryInterface;

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

        $this->app->singleton('read_model.driver', function () {
            return (new ReadModelManager($this->app))->driver();
        });
    }

    public function provides()
    {
        return [
            'read_model.driver',
            MethodNameInflector::class,
        ];
    }
}