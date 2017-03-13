<?php

namespace Madewithlove\LaravelCqrsEs\Tests\EventStore;

use Broadway\EventDispatcher\EventDispatcher;
use Broadway\EventDispatcher\EventDispatcherInterface;
use Broadway\EventHandling\EventBusInterface;
use Broadway\EventHandling\SimpleEventBus;
use Madewithlove\LaravelCqrsEs\EventHandling\ReplayingEventBusInterface;
use Madewithlove\LaravelCqrsEs\EventHandling\SimpleReplayingEventBus;
use Madewithlove\LaravelCqrsEs\Tests\TestCase;

class ServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function itRegistersServices()
    {
        self::assertInstanceOf(EventDispatcher::class, $this->app->make(EventDispatcherInterface::class));
        self::assertInstanceOf(SimpleEventBus::class, $this->app->make(EventBusInterface::class));
        self::assertInstanceOf(SimpleReplayingEventBus::class, $this->app->make(ReplayingEventBusInterface::class));
    }
}