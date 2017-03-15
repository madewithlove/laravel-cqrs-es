<?php

namespace Madewithlove\LaravelCqrsEs\Tests\EventStore;

use Broadway\EventDispatcher\CallableEventDispatcher;
use Broadway\EventDispatcher\EventDispatcher;
use Broadway\EventHandling\EventBus;
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
        self::assertInstanceOf(CallableEventDispatcher::class, $this->app->make(EventDispatcher::class));
        self::assertInstanceOf(SimpleEventBus::class, $this->app->make(EventBus::class));
        self::assertInstanceOf(SimpleReplayingEventBus::class, $this->app->make(ReplayingEventBusInterface::class));
    }
}