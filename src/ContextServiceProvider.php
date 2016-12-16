<?php

namespace Madewithlove\LaravelCqrsEs;

use Broadway\EventHandling\EventBusInterface;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Madewithlove\LaravelCqrsEs\EventHandling\ReplayingEventBusInterface;

abstract class ContextServiceProvider extends BaseServiceProvider
{
    /**
     * @var array
     */
    protected $projectors = [];

    /**
     * @var array
     */
    protected $processManagers = [];

    /**
     *
     */
    public function boot()
    {
        /** @var EventBusInterface $eventBus */
        $liveEventBus = $this->app->make(EventBusInterface::class);
        $replayOnlyEventBus = $this->app->make(ReplayingEventBusInterface::class);

        // Subscribe Projectors to both live events and replayed events
        foreach ($this->projectors as $projector) {
            $projectorInstance = $this->app->make($projector);
            $liveEventBus->subscribe($projectorInstance);
            $replayOnlyEventBus->subscribe($projectorInstance);
        }

        // Subscribe ProcessManagers only to live events
        foreach ($this->processManagers as $processManager) {
            $liveEventBus->subscribe($this->app->make($processManager));
        }
    }
}