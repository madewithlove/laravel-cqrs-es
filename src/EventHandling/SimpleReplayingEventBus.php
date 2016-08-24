<?php
namespace Madewithlove\LaravelCqrsEs\EventHandling;

use Broadway\EventHandling\SimpleEventBus;

class SimpleReplayingEventBus extends SimpleEventBus implements ReplayingEventBusInterface
{
}