<?php

namespace Madewithlove\LaravelCqrsEs\Saga;

use Broadway\Saga\State\InMemoryRepository;
use Broadway\Saga\State\MongoDBRepository;
use Doctrine\MongoDB\Connection;
use Illuminate\Support\Manager;
use MongoDB\Client;

class SagaManager extends Manager
{
    /**
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']->get('broadway.saga.driver');
    }

    /**
     * @return InMemoryRepository
     */
    protected function createInmemoryDriver()
    {
        return new InMemoryRepository();
    }

    /**
     * @return MongoDBRepository
     */
    protected function createMongodbDriver()
    {
        $databaseConfig = $this->app['config']->get('database.connections.mongodb');
        $broadwayConfig = $this->app['config']->get('broadway.saga.mongodb');

        $options = array_get($databaseConfig, 'options', []);

        $dsn = $this->getDsn($databaseConfig);
        $connection = $this->createConnection($dsn, $databaseConfig, $options);

        return new MongoDBRepository($connection->selectCollection($databaseConfig['database'], $broadwayConfig['collection']));
    }

    /**
     * @param $dsn
     * @param array $config
     * @param array $options
     *
     * @return Connection
     */
    private function createConnection($dsn, array $config, array $options)
    {
        // By default driver options is an empty array.
        $driverOptions = [];
        if (isset($config['driver_options']) && is_array($config['driver_options'])) {
            $driverOptions = $config['driver_options'];
        }
        // Check if the credentials are not already set in the options
        if (!isset($options['username']) && !empty($config['username'])) {
            $options['username'] = $config['username'];
        }
        if (!isset($options['password']) && !empty($config['password'])) {
            $options['password'] = $config['password'];
        }

        return new Connection(new Client($dsn, $options, $driverOptions));
    }

    /**
     * @param array $config
     *
     * @return string
     */
    private function getDsn(array $config)
    {
        // Check if the user passed a complete dsn to the configuration.
        if (!empty($config['dsn'])) {
            return $config['dsn'];
        }
        // Treat host option as array of hosts
        $hosts = is_array($config['host']) ? $config['host'] : [$config['host']];
        foreach ($hosts as &$host) {
            // Check if we need to add a port to the host
            if (strpos($host, ':') === false && !empty($config['port'])) {
                $host = $host.':'.$config['port'];
            }
        }
        // Check if we want to authenticate against a specific database.
        $auth_database = isset($config['options']) && !empty($config['options']['database']) ? $config['options']['database'] : null;
        return 'mongodb://'.implode(',', $hosts).($auth_database ? '/'.$auth_database : '');
    }
}