<?php

namespace Madewithlove\LaravelCqrsEs\EventStore;

use Broadway\EventStore\EventStoreInterface;
use Broadway\EventStore\Management\EventStoreManagementInterface;
use Madewithlove\LaravelCqrsEs\EventStore\Console\Replay;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @return null
     */
    public function register()
    {
        $this->commands([
            Replay::class,
        ]);

        $this->app->singleton('event_store.driver', function () {
            return (new EventStoreManager($this->app))->driver();
        });

        $this->app->alias(EventStoreInterface::class, 'event_store.driver');
        $this->app->alias(EventStoreManagementInterface::class, 'event_store.driver');
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            EventStoreManagementInterface::class,
            EventStoreInterface::class,
        ];
    }
}