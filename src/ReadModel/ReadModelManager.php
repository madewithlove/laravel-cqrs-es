<?php

namespace Madewithlove\LaravelCqrsEs\ReadModel;

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
     * @return \ElasticSearch\Client
     */
    public function createElasticsearchDriver()
    {
        $config = $this->config->get('broadway.read_model.elasticsearch');
        return \ElasticSearch\ClientBuilder::fromConfig($config);
    }
}