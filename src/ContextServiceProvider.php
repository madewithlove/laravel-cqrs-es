<?php

namespace Madewithlove\LaravelCqrsEs;

use Broadway\EventHandling\EventBusInterface;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

abstract class ContextServiceProvider extends EventServiceProvider
{
    /**
     * @var array
     */
    protected $projectors = [];

    /**
     * @param DispatcherContract $events
     */
    public function boot(DispatcherContract $events)
    {
        /** @var EventBusInterface $eventBus */
        $eventBus = $this->app->make(EventBusInterface::class);
        foreach ($this->projectors as $projector) {
            $eventBus->subscribe($this->app->make($projector));
        }
        parent::boot($events);
    }
}