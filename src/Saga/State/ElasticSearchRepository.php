<?php

namespace Madewithlove\LaravelCqrsEs\Saga\State;

use Broadway\Saga\State;
use Broadway\Saga\State\Criteria;
use Broadway\Saga\State\RepositoryException;
use Broadway\Saga\State\RepositoryInterface;
use ElasticSearcher\ElasticSearcher;
use Madewithlove\LaravelCqrsEs\Saga\State\Elasticsearch\CriteriaQuery;
use Madewithlove\LaravelCqrsEs\Saga\State\Elasticsearch\StateIndex;

class ElasticSearchRepository implements RepositoryInterface
{
    /**
     * @var ElasticSearcher
     */
    protected $elasticsearcher;

    /**
     * @var StateIndex
     */
    protected $index;

    /**
     * @param ElasticSearcher $elasticsearcher
     * @param StateIndex $index
     */
    public function __construct(ElasticSearcher $elasticsearcher, StateIndex $index)
    {
        $this->elasticsearcher = $elasticsearcher;
        $this->index = $index;
    }

    /**
     * @param Criteria $criteria
     * @param string $sagaId
     *
     * @return State
     */
    public function findOneBy(Criteria $criteria, $sagaId)
    {
        $query = $this->createQuery($criteria, $sagaId);

        $results = $query->run();
        $count = $results->getTotal();

        if ($count === 1) {
            return State::deserialize($results->getResults()[0]);
        }

        if ($count > 1) {
            throw new RepositoryException('Multiple saga state instances found');
        }

        return null;
    }

    /**
     * @param State $state
     * @param $sagaId
     */
    public function save(State $state, $sagaId)
    {
        $serializedState = $state->serialize();
        $serializedState['sagaId'] = $sagaId;
        $serializedState['removed'] = $state->isDone();

        $this->elasticsearcher->documentsManager()->updateOrIndex(
            $this->index->getInternalName(),
            State::class,
            $state->getId(),
            $serializedState
        );
    }

    /**
     * @param Criteria $criteria
     * @param $sagaId
     *
     * @return CriteriaQuery
     */
    private function createQuery(Criteria $criteria, $sagaId)
    {
        $query = new CriteriaQuery($this->elasticsearcher);
        $query->searchIn($this->index->getInternalName(), State::class);

        foreach ($criteria->getComparisons() as $comparison => $value) {
            $query = $query->addWhere($comparison, $value);
        }

        $query = $query->forSagaId($sagaId);

        return $query;
    }
}