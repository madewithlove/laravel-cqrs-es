<?php

namespace Tinkerlist\Infrastructure\EventStore;

use Broadway\EventStore\DBALEventStore;
use Broadway\EventStore\EventStoreInterface;
use Broadway\EventStore\Management\EventStoreManagementInterface;
use Broadway\Serializer\SerializerInterface;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Madewithlove\LaravelCqrsSe\EventStore\Console\Replay;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @return null
     */
    public function register()
    {
        $this->commands([
            Replay::class,
        ]);

        $this->app->singleton(Connection::class, function () {
            $driver = $this->app['config']->get('database.default');
            $params = $this->app['config']->get("database.connections.{$driver}");
            $params['dbname'] = $params['database'];
            $params['user'] = $params['username'];
            $params['driver'] = "pdo_$driver";

            unset($params['database'], $params['username']);

            return DriverManager::getConnection($params);
        });

        $this->app->singleton(DBALEventStore::class, function () {
            return new DBALEventStore(
                $this->app->make(Connection::class),
                $this->app->make(SerializerInterface::class),
                $this->app->make(SerializerInterface::class),
                $this->app['config']->get('broadway.event-store.table', 'event_store')
            );
        });

        $this->app->singleton(EventStoreInterface::class, DBALEventStore::class);
        $this->app->singleton(EventStoreManagementInterface::class, DBALEventStore::class);
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [
            Connection::class,
            EventStoreManagementInterface::class,
            EventStoreInterface::class,
            DBALEventStore::class,
        ];
    }
}