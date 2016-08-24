<?php

namespace Madewithlove\LaravelCqrsEs\EventStore;

use Broadway\EventDispatcher\EventDispatcher;
use Broadway\EventDispatcher\EventDispatcherInterface;
use Broadway\EventHandling\EventBusInterface;
use Broadway\EventHandling\SimpleEventBus;
use Broadway\EventStore\EventStoreInterface;
use Broadway\EventStore\Management\EventStoreManagementInterface;
use Madewithlove\LaravelCqrsEs\EventHandling\ReplayingEventBusInterface;
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

        $this->app->singleton(EventDispatcherInterface::class, function () {
            return new EventDispatcher();
        });
        $this->app->singleton(EventBusInterface::class, function () {
            return new SimpleEventBus();
        });
        $this->app->singleton(ReplayingEventBusInterface::class, function () {
            return new SimpleEventBus();
        });
        $this->app->alias('event_store.driver', EventStoreInterface::class);
        $this->app->alias('event_store.driver', EventStoreManagementInterface::class);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            'event_store.driver',
            EventStoreManagementInterface::class,
            EventStoreInterface::class,
        ];
    }
}