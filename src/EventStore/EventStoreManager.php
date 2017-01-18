<?php

namespace Madewithlove\LaravelCqrsEs\EventStore;

use Broadway\EventStore\DBALEventStore;
use Broadway\EventStore\InMemoryEventStore;
use Broadway\Serializer\SerializerInterface;
use Doctrine\DBAL\DriverManager;
use Illuminate\Support\Manager;

class EventStoreManager extends Manager
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']->get('broadway.event-store.driver');
    }

    /**
     * @return DBALEventStore
     */
    protected function createDbalDriver()
    {
        $config = $this->app['config']->get('broadway.event-store.dbal');
        $driver = $config['connection'];

        $params = $this->app['config']->get("database.connections.{$driver}");
        $params['dbname'] = $params['database'];
        $params['user'] = $params['username'];
        $params['driver'] = "pdo_$driver";

        unset($params['database'], $params['username']);

        $connection = DriverManager::getConnection($params);

        return new DBALEventStore(
            $connection,
            $this->app->make(SerializerInterface::class),
            $this->app->make(SerializerInterface::class),
            array_get($config, 'table', 'event_store')
        );
    }

    /**
     * @return InMemoryEventStore
     */
    protected function createInmemoryDriver()
    {
        return new InMemoryEventStore();
    }
}