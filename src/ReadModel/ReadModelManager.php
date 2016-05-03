<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel;

use Illuminate\Support\Manager;
use Elasticsearch\ClientBuilder;

class ReadModelManager extends Manager
{
    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']->get('broadway.read-model.driver');
    }

    /**
     * @return \ElasticSearch\Client
     */
    public function createElasticsearchDriver()
    {
        $config = $this->app['config']->get('broadway.read-model.elasticsearch');

        return ClientBuilder::fromConfig($config);
    }
}
