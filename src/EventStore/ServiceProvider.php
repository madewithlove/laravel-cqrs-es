<?php

namespace Madewithlove\LaravelCqrsEs\EventStore;

use Broadway\EventDispatcher\CallableEventDispatcher;
use Broadway\EventDispatcher\EventDispatcher;
use Broadway\EventHandling\EventBus;
use Broadway\EventHandling\SimpleEventBus;
use Broadway\EventStore\EventStore;
use Broadway\EventStore\Management\EventStoreManagement;
use Madewithlove\LaravelCqrsEs\EventHandling\ReplayingEventBusInterface;
use Madewithlove\LaravelCqrsEs\EventHandling\SimpleReplayingEventBus;
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

        $this->app->singleton(EventDispatcher::class, function () {
            return new CallableEventDispatcher();
        });
        $this->app->singleton(EventBus::class, function () {
            return new SimpleEventBus();
        });
        $this->app->singleton(ReplayingEventBusInterface::class, function () {
            return new SimpleReplayingEventBus();
        });
        $this->app->alias('event_store.driver', EventStore::class);
        $this->app->alias('event_store.driver', EventStoreManagement::class);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            'event_store.driver',
            EventStoreManagement::class,
            EventStore::class,
            EventBus::class,
            EventDispatcher::class,
        ];
    }
}