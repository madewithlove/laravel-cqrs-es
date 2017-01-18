<?php

namespace Madewithlove\LaravelCqrsEs\Saga\State\Elasticsearch;

use Broadway\Saga\State;
use ElasticSearcher\Abstracts\AbstractIndex;

class StateIndex extends AbstractIndex
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;

        parent::__construct();
    }

    /**
     *
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     */
    public function setup()
    {
        $this->setTypes([
            State::class => [
                'properties' => [
                    'id' => ['type' => 'string', 'index' => 'not_analyzed'],
                ],
            ],
        ]);
    }
}