<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel;

use Broadway\ReadModel\InMemory\InMemoryRepository;
use Broadway\ReadModel\RepositoryInterface;
use Illuminate\Support\Manager;

class ReadModelManager extends Manager
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']->get('broadway.read_model.driver');
    }

    /**
     * @return RepositoryInterface
     */
    public function createElasticsearchDriver()
    {
        $config = $this->config->get('broadway.read_model.elasticsearch');
        return \Elasticsearch\ClientBuilder::fromConfig($config);
    }

    /**
     * @return RepositoryInterface
     */
    public function createInmemoryDriver()
    {
        return new InMemoryRepository();
    }
}