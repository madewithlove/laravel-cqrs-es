<?php
namespace Madewithlove\LaravelCqrsEs\EventHandling;

use Broadway\EventHandling\EventBus;

/**
 * Use this event bus only for replays.
 * Only listeners that are interested in replayed events should subscribe to this.
 */
interface ReplayingEventBusInterface extends EventBus
{
}