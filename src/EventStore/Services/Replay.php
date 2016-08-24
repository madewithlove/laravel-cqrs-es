<?php

namespace Madewithlove\LaravelCqrsEs\EventStore\Services;

use Broadway\Domain\DomainEventStream;
use Broadway\EventHandling\EventBusInterface;
use Broadway\EventStore\CallableEventVisitor;
use Broadway\EventStore\Management\Criteria;
use Broadway\EventStore\Management\EventStoreManagementInterface;
use Madewithlove\LaravelCqrsEs\EventHandling\ReplayingEventBusInterface;

class Replay
{
    /**
     * @var EventBusInterface
     */
    protected $eventBus;

    /**
     * @var EventStoreManagementInterface
     */
    protected $eventManager;

    /**
     * @var array
     */
    protected $eventBuffer = [];

    /**
     * @var int
     */
    protected $eventBufferSize = 20;

    /**
     * @param ReplayingEventBusInterface $eventBus
     * @param EventStoreManagementInterface $eventManager
     */
    public function __construct(ReplayingEventBusInterface $eventBus, EventStoreManagementInterface $eventManager)
    {
        $this->eventBus = $eventBus;
        $this->eventManager = $eventManager;
    }

    /**
     * @param array $parameters
     */
    public function replay($parameters = [])
    {
        $criteria = Criteria::create();

        if (isset($parameters['types'])) {
            $criteria = $criteria->withEventTypes($parameters['types']);
        }

        if (isset($parameters['id'])) {
            $criteria = $criteria->withAggregateRootIds($parameters['id']);
        }

        $visitor = new CallableEventVisitor(function ($event) {
            $this->addEvent($event);
        });

        $this->eventManager->visitEvents($criteria, $visitor);
        $this->publishEvents();
    }

    /**
     * @return void
     */
    protected function publishEvents()
    {
        $this->eventBus->publish(new DomainEventStream($this->eventBuffer));
        $this->eventBuffer = [];
    }

    /**
     * @param $event
     */
    private function addEvent($event)
    {
        $this->eventBuffer[] = $event;

        if ($this->eventBufferSize < count($this->eventBuffer)) {
            $this->publishEvents();
        }
    }
}