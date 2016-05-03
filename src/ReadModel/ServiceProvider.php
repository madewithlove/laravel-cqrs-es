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

        $this->app->singleton('read_model.repository', function () {
            return (new ReadModelManager($this->app))->driver();
        });

        $this->app->alias('read_model.repository', RepositoryInterface::class);
    }

    public function provides()
    {
        return [
            'read_model.repository',
            MethodNameInflector::class,
        ];
    }
}