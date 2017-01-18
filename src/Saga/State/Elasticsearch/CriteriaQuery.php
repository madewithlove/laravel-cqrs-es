<?php

namespace Madewithlove\LaravelCqrsEs\Saga\State\Elasticsearch;

use ElasticSearcher\Abstracts\AbstractQuery;

class CriteriaQuery extends AbstractQuery
{
    /**
     * @var array
     */
    public $body = [
        'query' => [
            'bool' => [
                'must' => [],
            ],
        ],
    ];

    /**
     *
     */
    protected function setup()
    {
        $this->addfilter([
            'term' => [
                'removed' => false,
            ]
        ]);
    }

    /**
     * @param $sagaId
     *
     * @return $this
     */
    public function forSagaId($sagaId)
    {
        $this->addFilter([
            'term' => [
                'sagaId' => $sagaId,
            ]
        ]);

        return $this;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return $this
     */
    public function addWhere($key, $value)
    {
        $key = 'values.'.$key;

        $this->addfilter([
            'term' => [
                $key => $value,
            ]
        ]);

        return $this;
    }

    /**
     * @param $filter
     */
    private function addfilter($filter)
    {
        $this->body['query']['bool']['must'][] = $filter;
    }
}