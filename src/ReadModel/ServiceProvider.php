<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel;

use Madewithlove\LaravelCqrsEs\Inflectors\MethodNameInflector;
use Madewithlove\LaravelCqrsEs\Inflectors\ProjectClassNameInflector;

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

        $this->app->singleton('read_model.manager', function () {
            return new ReadModelManager($this->app);
        });

        $this->app->singleton('read_model.driver', function () {
            return $this->app->make('read_model.manager')->driver();
        });
    }

    public function provides()
    {
        return [
            'read_model.driver',
            'read_model.manager',
            MethodNameInflector::class,
        ];
    }
}