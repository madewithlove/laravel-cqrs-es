<?php

namespace Madewithlove\LaravelCqrsEs\EventStore;

use Broadway\EventStore\Dbal\DBALEventStore;
use Broadway\EventStore\InMemoryEventStore;
use Broadway\Serializer\Serializer;
use Broadway\UuidGenerator\Converter\BinaryUuidConverter;
use Doctrine\DBAL\DriverManager;
use Illuminate\Support\Arr;
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
        $params['user'] = array_key_exists('username', $params) ? $params['username'] : null;
        $params['driver'] = "pdo_$driver";

        unset($params['database'], $params['username']);

        $connection = DriverManager::getConnection($params);

        return new DBALEventStore(
            $connection,
            $this->app->make(Serializer::class),
            $this->app->make(Serializer::class),
            Arr::get($config, 'table', 'event_store'),
            false,
            new BinaryUuidConverter()
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
