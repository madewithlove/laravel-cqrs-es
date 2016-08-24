<?php

namespace Madewithlove\LaravelCqrsEs;

use Broadway\EventHandling\EventBusInterface;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;
use ReplayingEventBusInterface;

abstract class ContextServiceProvider extends EventServiceProvider
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
     * @param DispatcherContract $events
     */
    public function boot(DispatcherContract $events)
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
        parent::boot($events);
    }
}